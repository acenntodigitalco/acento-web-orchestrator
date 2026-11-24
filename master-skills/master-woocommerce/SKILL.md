---
name: master-woocommerce
description: >
  Estándar técnico para desarrollar, extender y auditar tiendas y plugins WooCommerce (8.2+ a 10.x):
  compatibilidad HPOS y CRUD, pasarelas PCI, webhooks, Checkout Blocks vs. clásico, envíos, Action Scheduler,
  rendimiento y plantillas. Activar cuando el usuario mencione WooCommerce, tienda online en WordPress,
  HPOS, WC_Order, pasarela de pago, envíos, carrito, checkout, cupones, emails WC o wc-cart-fragments.
---

# Master WooCommerce

## 1. Rol y alcance

- Aplica este estándar al diseñar, implementar o revisar plugins, pasarelas, métodos de envío, integraciones REST/Blocks y personalizaciones de tema para WooCommerce 8.2+ hasta 10.x.
- Asume HPOS (High-Performance Order Storage) como arquitectura de almacenamiento activa por defecto y garantiza compatibilidad dual con almacenamiento heredado mediante APIs CRUD.
- Delega seguridad general de WordPress, arquitectura genérica de plugins/bloques, PHPStan y WP-CLI a `master-wp-custom`.
- Delega SEO de catálogo, Schema `Product`/`Offer`, facetas, feeds y auditoría completa de comercio agéntico a `master-seo-tecnico`.
- Limita las revisiones de pasarelas a seguridad de código; la auditoría de cumplimiento PCI-DSS de infraestructura queda fuera de alcance.

## 2. Reglas obligatorias

### 2.1 HPOS y API CRUD

- Declara compatibilidad con HPOS (`custom_order_tables`) y bloques (`cart_checkout_blocks`) en el archivo principal del plugin dentro de `before_woocommerce_init` (**CRITICAL** si falta HPOS).

```php
add_action( 'before_woocommerce_init', function () {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'cart_checkout_blocks', __FILE__, true );
    }
} );
```

- Accede, consulta y modifica pedidos exclusivamente mediante CRUD (`wc_get_order()`, `wc_get_orders()`, `wc_create_order()`, `$order->get_meta()`, `$order->update_meta_data()`, `$order->add_meta_data()`, `$order->delete_meta_data()`).
- Agrupa todas las modificaciones sobre un objeto `WC_Data` y ejecuta una única llamada a `$order->save()` al final.
- Llama siempre a `$order->save()` después de `$order->set_status( $status, $note )`, o utiliza `$order->update_status( $status, $note )` para persistir la transición de estado.
- Ejecuta `$order->calculate_totals()` antes de `$order->save()` cada vez que añadas o modifiques productos, tarifas o envíos de un pedido.
- Cuenta pedidos con `wc_orders_count( $status )` en lugar de consultas directas de posts o SQL.
- Al registrar notas con `$order->add_order_note( $note, $is_customer_note, $added_by_user )`, pasa `false` en `$added_by_user` para notas de sistema/extensión y `true` solo para acciones iniciadas por un usuario humano.
- Usa `OrderUtil::custom_orders_table_usage_is_enabled()` únicamente si requieres bifurcación explícita de almacenamiento y valida toda extensión con HPOS activado y desactivado.
- Consulta y modifica productos con `wc_get_product()`, `wc_get_products()` o `WC_Product_Query` (**CRITICAL** si hay SQL directa sobre productos; **WARNING** si usa `WP_Query`).

### 2.2 Pasarelas de pago, seguridad PCI, webhooks y AJAX

- Extiende `WC_Payment_Gateway`, registra el guardado con `woocommerce_update_options_payment_gateways_{$this->id}` y devuelve `['result' => 'success', 'redirect' => $this->get_return_url( $order )]` o `['result' => 'failure']` desde `process_payment()`.
- Nunca almacenes en base de datos ni sesiones ni escribas en logs (`error_log()`, `wc_get_logger()`) números de tarjeta o CVV (**CRITICAL**); usa tokenización (`WC_Payment_Token_CC`) o redirección alojada y registra solo IDs de transacción.
- Verifica `is_ssl()` antes de procesar pagos cuando `'yes' !== $this->get_option( 'testmode' )` (**CRITICAL** si hay captura local de datos; **WARNING** si es pasarela hosted-redirect).
- Carga claves y secretos de pasarela con `$this->get_option()` y decláralos con `'type' => 'password'` en `init_form_fields()` (**WARNING** si están hardcodeados).
- Finaliza pagos exitosos con `$order->payment_complete( $transaction_id )` seguido de `WC()->cart->empty_cart()`.
- Implementa `process_refund( $order_id, $amount = null, $reason = '' )` cuando la pasarela declare `'refunds'` en `$this->supports`, verificando `$order->get_transaction_id()` y devolviendo `true` o `WP_Error`.
- Valida todo webhook entrante comparando `X-WC-Webhook-Signature` con `hash_equals()` sobre HMAC-SHA256 en base64 (**CRITICAL** si falta), deduplica por `X-WC-Webhook-Delivery-ID` con transient, encola el trabajo en Action Scheduler y responde `200` de inmediato.

```php
function handle_wc_webhook( WP_REST_Request $request ) {
    $payload  = $request->get_body();
    $expected = base64_encode( hash_hmac( 'sha256', $payload, get_option( 'my_webhook_secret' ), true ) );
    if ( ! hash_equals( $expected, (string) $request->get_header( 'X-WC-Webhook-Signature' ) ) ) {
        return new WP_Error( 'invalid_signature', 'Unauthorized', [ 'status' => 401 ] );
    }
    $delivery_id = sanitize_key( (string) $request->get_header( 'X-WC-Webhook-Delivery-ID' ) );
    if ( $delivery_id && get_transient( 'wc_wh_' . $delivery_id ) ) {
        return rest_ensure_response( [ 'status' => 'already_processed' ] );
    }
    set_transient( 'wc_wh_' . $delivery_id, 1, DAY_IN_SECONDS );
    as_enqueue_async_action( 'my_process_webhook', [ 'payload' => $payload ], 'wc-webhooks' );
    return rest_ensure_response( [ 'status' => 'received' ] );
}
```

- Protege cualquier endpoint AJAX de carrito o tienda (`wp_ajax_*` / `wp_ajax_nopriv_*`) con `check_ajax_referer()` y fuerza enteros con `absint()` en IDs y cantidades.

### 2.3 Checkout (Clásico vs. Blocks) y REST API

- Detecta si la tienda usa Checkout Blocks inspeccionando `has_block( 'woocommerce/checkout', get_post_field( 'post_content', wc_get_page_id( 'checkout' ) ) )`.
- En Checkout Clásico, añade campos con `woocommerce_checkout_fields`, valida en `woocommerce_checkout_process` y guarda metadatos en `woocommerce_checkout_create_order` con `$order->update_meta_data()`.
- En Checkout Blocks (WC 8.6+), registra campos adicionales dentro de `woocommerce_init` mediante `woocommerce_register_additional_checkout_field()` con ID `namespace/campo` y extiende el flujo vía Store API (**CRITICAL** si la extensión depende de overrides en `woocommerce/cart/` o `woocommerce/checkout/` cuando Blocks está activo).
- Expón endpoints REST personalizados extendiendo `WC_REST_Controller` (integrados mediante `woocommerce_rest_api_get_rest_namespaces`) o bajo un namespace propio (`vendor/v1`), siempre con `permission_callback` estricto (`current_user_can( 'manage_woocommerce' )`).
- Exige OAuth 1.0a sobre HTTPS para integraciones REST de WooCommerce en producción y reserva Basic Auth únicamente para entornos de desarrollo local sobre HTTPS.

### 2.4 Plantillas, hooks y emails

- Aplica siempre una estrategia hooks-first (`add_action`, `remove_action`, `add_filter`) antes de sobrescribir plantillas; usa las prioridades reales de core en `woocommerce_before_shop_loop` (`20` para `woocommerce_result_count` y `30` para `woocommerce_catalog_ordering`).
- Ubica los overrides estrictamente en `child-theme/woocommerce/` conservando la ruta relativa, la guarda `defined( 'ABSPATH' ) || exit;` y la etiqueta `@version` sincronizada (**WARNING** si lleva 2 o más versiones de atraso).
- Preserva absolutamente todas las llamadas `do_action()` y `apply_filters()` de la plantilla original dentro de cualquier override (**CRITICAL** si se elimina alguna).
- Implementa correos transaccionales extendiendo `WC_Email` y registrándolos en `woocommerce_email_classes`; en hooks `woocommerce_email_*`, bifurca siempre según el parámetro booleano `$plain_text`.

### 2.5 Severidades y formato de reporte en auditorías

- Clasifica hallazgos en tres niveles: **CRITICAL** (rompe HPOS, SQL directa a pedidos/productos, fuga PCI/tarjeta, falta `is_ssl()` en captura local, webhook sin firma HMAC, override sin hooks o incompatible con Blocks), **WARNING** (`WP_Query` de productos, `wc-cart-fragments.js` global, `wp_cron()` en procesos masivos, sesión >30 días, credenciales hardcodeadas, `is_ssl()` en hosted-redirect, plantillas desactualizadas ≥2 versiones, override en tema padre) e **INFO** (override sustituible por hook, falta de caché de objetos, oportunidades Blocks/WC 10.5+).
- Agrupa el informe de revisión por archivo con números de línea, etiqueta de severidad, pares `BAD`/`GOOD` y una tabla resumen final de conteos por severidad.
- Evita falsos positivos: no reportes `get_posts()`, `WP_Query`, `get_post_meta()` ni `$wpdb` cuando operen sobre CPTs ajenos a `shop_order`/`product` o tablas propias de la extensión.

## 3. Mejores prácticas y arquitectura

### 3.1 Carrito, envíos, productos personalizados y cupones

- Implementa el ciclo completo de datos personalizados en ítems del carrito con los tres hooks obligatorios: `woocommerce_add_cart_item_data` (captura sanitizada), `woocommerce_get_item_data` (visualización) y `woocommerce_checkout_create_order_line_item` (persistencia con `$item->update_meta_data()`).
- Protege todo callback en `woocommerce_cart_calculate_fees` con `if ( is_admin() && ! defined( 'DOING_AJAX' ) ) { return; }`.
- Valida restricciones de compra en `woocommerce_add_to_cart_validation` (al añadir) y `woocommerce_check_cart_items` (en carrito/checkout) notificando con `wc_add_notice( $msg, 'error' )`.
- Extiende `WC_Shipping_Method` declarando soporte `'shipping-zones'`, `'instance-settings'` e `'instance-settings-modal'`, generando el identificador con `$this->get_rate_id()` y evaluando clases de envío mediante `$product->get_shipping_class_id()`.
- Crea tipos de producto extendiendo `WC_Product` y registrándolos con `product_type_selector`, `woocommerce_product_class`, `woocommerce_product_data_tabs`, `woocommerce_product_data_panels` y `woocommerce_process_product_meta` (persistiendo con CRUD).
- Valida lógica personalizada de cupones en el filtro `woocommerce_coupon_is_valid` lanzando `Exception( $mensaje, $codigo )`, y registra tipos propios con `woocommerce_coupon_discount_types` y `woocommerce_coupon_get_discount_amount`.

### 3.2 Rendimiento, Action Scheduler, sesiones y caché

- Procesa tareas masivas, sincronizaciones y webhooks con Action Scheduler (`as_enqueue_async_action()`, `as_schedule_single_action()`, `as_schedule_recurring_action()`) usando grupos nombrados, lotes recursivos acotados (`limit => 100`, `return => 'ids'`) y guarda `as_next_scheduled_action()` para evitar duplicados.
- Desactiva `wc-cart-fragments.js` fuera de vistas de comercio desencolándolo en `wp_enqueue_scripts` prioridad `100`, o migra al Mini-Cart Block (`<!-- wp:woocommerce/mini-cart /-->`).

```php
add_action( 'wp_enqueue_scripts', function () {
    if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
        wp_dequeue_script( 'wc-cart-fragments' );
        wp_deregister_script( 'wc-cart-fragments' );
    }
}, 100 );
```

- Mantén el filtro `wc_session_expiration` en `<= 30 * DAY_IN_SECONDS` (límite aplicado desde WC 10.1+), conserva `WC_Session_Handler` y almacena persistencia mayor a 30 días (listas de deseos, carritos guardados) en tablas personalizadas.
- Elimina consultas N+1 precargando lotes con `wc_get_orders( [ 'include' => $ids ] )` y `wc_get_products( [ 'include' => $ids ] )`; usa `'return' => 'ids'` y límites explícitos en listados.
- Filtra productos por atributos usando `attribute` y `attribute_term` en `wc_get_products()` para aprovechar la tabla indexada `wc_product_attributes_lookup` (WC 6.3+).
- Usa `$product->get_variation_price( 'min' | 'max' )` para aprovechar el cacheo nativo de precios de variaciones (WC 10.5+) sin consultas manuales sobre variaciones.
- Sustituye `wc_enqueue_js()` (deprecado en WC 10.4+) por `wp_add_inline_script()`.
- Cachea tarifas externas o agregaciones costosas en transients/object cache invalidándolos en `woocommerce_update_product`, limpia transients expirados con Action Scheduler, desactiva `autoload` en opciones voluminosas y nunca cachees stock volátil en tiempo real.

### 3.3 Mi Cuenta y puentes técnicos hacia `master-seo-tecnico`

- Registra pestañas de Mi Cuenta combinando `add_rewrite_endpoint()`, `woocommerce_account_menu_items` y `woocommerce_account_{slug}_endpoint`, llamando a `flush_rewrite_rules()` exclusivamente en `register_activation_hook()`.
- Preserva la salida nativa de `WC_Structured_Data` y usa sus filtros `woocommerce_structured_data_*` coordinados con el plugin SEO para evitar bloques JSON-LD `Product`/`Offer` duplicados.
- Asegura en plantillas de ficha y archivo un único `<h1>` por vista (sin duplicarlo en selectores de variación) y excluye `loading="lazy"` de la imagen hero principal LCP del producto.
- Almacena y lee GTIN/EAN/UPC/ISBN mediante el campo CRUD nativo de WC 9.2+ (`get_global_unique_id()` / `set_global_unique_id()`) y MPN mediante CRUD meta (`get_meta()` / `update_meta_data()`).
- Si la tienda habilita comercio agéntico, coordina la exposición de `/.well-known/ucp` y toda validación de Schema/indexabilidad siguiendo `master-seo-tecnico`.

## 4. Antipatrones

- Usar `get_posts()`, `WP_Query`, `get_post_meta()`, `update_post_meta()`, `wp_count_posts()` o `$wpdb` sobre `wp_posts`/`wp_postmeta` para leer, contar o escribir pedidos (**CRITICAL**).
- Llamar a `$order->set_status()` sin `$order->save()`, o invocar `$order->save()` repetidas veces dentro del mismo flujo.
- Almacenar o registrar números de tarjeta/CVV en BD, sesiones o logs, o hardcodear claves API en código (**CRITICAL** / **WARNING**).
- Procesar webhooks sin validar `X-WC-Webhook-Signature` con `hash_equals()`, o ejecutar lógica pesada sincrónicamente dentro del endpoint webhook (**CRITICAL**).
- Crear tipos de producto mediante `register_post_type()` en lugar de extender `WC_Product`.
- Ejecutar `wp_cron()` (`wp_schedule_event`) para procesos masivos de pedidos, inventarios o reportes (**WARNING**).
- Cargar `wc-cart-fragments.js` en páginas no-WooCommerce (**WARNING**) o usar `wc_enqueue_js()` en WC 10.4+.
- Ejecutar `wc_get_products( [ 'limit' => -1 ] )` o `wc_get_orders( [ 'limit' => -1 ] )` en tráfico público, o invocar `wc_get_product()` repetidamente dentro de bucles sin precarga.
- Extender `wc_session_expiration` por encima de `30 * DAY_IN_SECONDS` (**WARNING**) o cachear niveles de stock volátiles.
- Modificar archivos dentro de `plugins/woocommerce/templates/`, colocar overrides en el tema padre o eliminar `do_action()`/`apply_filters()` (**CRITICAL**).
- Enviar correos de pedido con `wp_mail()` directo en lugar de extender `WC_Email`, o emitir HTML en correos con `$plain_text === true`.
- Ejecutar `flush_rewrite_rules()` en `init` al registrar endpoints de Mi Cuenta.
- Duplicar JSON-LD `Product` rompiendo `WC_Structured_Data` o aplicar `loading="lazy"` a la imagen principal LCP del producto.

## 5. Checklist de validación

- [ ] `FeaturesUtil::declare_compatibility()` declara `'custom_order_tables'` y `'cart_checkout_blocks'` en `before_woocommerce_init`.
- [ ] Cero accesos directos a `wp_posts`/`wp_postmeta` o `wp_count_posts()` para pedidos; todas las operaciones usan CRUD + un único `$order->save()` (y `calculate_totals()` si cambian ítems/tarifas).
- [ ] Extensión probada con HPOS activado y desactivado.
- [ ] Pasarelas sin almacenamiento/log de tarjetas o CVV, con `is_ssl()`, API keys en `'type' => 'password'` vía `$this->get_option()`, `payment_complete()` + `empty_cart()` y `process_refund()`.
- [ ] Webhooks con HMAC-SHA256 + `hash_equals()`, deduplicación por `X-WC-Webhook-Delivery-ID` y ejecución en Action Scheduler; handlers AJAX con `check_ajax_referer()` + `absint()`.
- [ ] Compatibilidad verificada con Checkout Clásico (`woocommerce_checkout_create_order`) y/o Checkout Blocks (`has_block('woocommerce/checkout')` + `woocommerce_register_additional_checkout_field()`).
- [ ] Rutas REST sobre `WC_REST_Controller` o namespace propio con `permission_callback`, envíos con `$this->get_rate_id()`, productos extendiendo `WC_Product`, 3 hooks de datos de carrito y guard `is_admin() && ! defined( 'DOING_AJAX' )` en fees.
- [ ] Procesos masivos en Action Scheduler con lotes recursivos + `as_next_scheduled_action()`; sesiones `<= 30` días; sin N+1 ni `limit => -1`; `wc_enqueue_js()` reemplazado por `wp_add_inline_script()`.
- [ ] `wc-cart-fragments.js` desencolado en `wp_enqueue_scripts` prioridad `100` fuera de WC o sustituido por Mini-Cart Block.
- [ ] Overrides solo en `child-theme/woocommerce/` con `ABSPATH`, `@version` vigente y 100% de `do_action()`/`apply_filters()` preservados; emails extendiendo `WC_Email` respetando `$plain_text`.
- [ ] Puentes SEO verificados: `WC_Structured_Data` sin JSON-LD duplicado, un solo `<h1>` sin `loading="lazy"` en hero LCP, GTIN/EAN/MPN vía CRUD WC 9.2+ y referencia `/.well-known/ucp` coordinada con `master-seo-tecnico`.
