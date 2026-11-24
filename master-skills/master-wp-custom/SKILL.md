---
name: master-wp-custom
description: >
  Estándar de ingeniería para proyectos WordPress a medida: temas (Block, Classic, Hybrid, Child), plugins privados, bloques Gutenberg (`apiVersion: 3`), Interactivity API, ACF, REST API, Headless WP/WPGraphQL, seguridad, performance, PHPStan, WP-CLI, migraciones, CI/CD y entorno local.
  Activar al desarrollar o auditar temas, plugins, bloques, patrones, endpoints REST/GraphQL, consultas `WP_Query`, migraciones de BD o despliegues WordPress (ej. "crea un bloque Gutenberg", "desarrolla un plugin a medida", "optimiza rendimiento o seguridad en WordPress", "configura Headless WP, Playground o wp-env").
---

# Master WordPress Custom

## 1. Rol y alcance
- Desarrolla y audita sitios WordPress a medida: temas (Block Theme por defecto en proyectos nuevos; Classic, Hybrid y Child en mantenimiento), plugins privados de agencia, bloques Gutenberg, Interactivity API, REST API, Headless WP / WPGraphQL, seguridad, performance, PHPStan, WP-CLI, migraciones, CI/CD y entorno local.
- Confirma las versiones de WordPress y PHP, el tipo de artefacto (`theme`, `plugin`, `mu-plugin`, `site`) y el stack activo (ACF, Headless, Bedrock) antes de modificar código.
- Aplica el modo privado de agencia por defecto y activa el bloque condicional WordPress.org únicamente cuando el entregable se publique en el directorio oficial.
- Mantén fuera de esta skill las reglas específicas de WooCommerce, UX/UI general y SEO técnico general.

## 2. Reglas obligatorias

### 2.1 Seguridad
- Aplica `wp_unslash()` antes de sanitizar cualquier superglobal (`$_POST`, `$_GET`, `$_REQUEST`, `$_COOKIE`) con `sanitize_text_field()`, `absint()`, `sanitize_email()` o `esc_url_raw()`.
- Verifica nonce (`wp_verify_nonce()`, `check_admin_referer()` o `check_ajax_referer()`), capacidad (`current_user_can()`) y propiedad del recurso (*ownership*) en toda mutación de estado.
- Escapa toda salida lo más tarde posible según su contexto (`esc_html()`, `esc_attr()`, `esc_url()`, `wp_json_encode()` o `wp_kses()`).
- Exige nonce en `wp_ajax_nopriv_*` únicamente cuando el handler muta estado; expón lecturas públicas mediante endpoints REST `GET` cacheables.
- Parametriza toda consulta SQL directa con `$wpdb->prepare()` y evita el placeholder `%i` si el proyecto soporta WordPress `< 6.2`.
- Aplica `wp_kses_post()` únicamente sobre HTML de usuario o metadatos y omítelo sobre `$content` de `InnerBlocks` para no romper embeds ni bloques core (escapa los atributos del bloque en su lugar).
- Bloquea la ejecución directa con `defined( 'ABSPATH' ) || exit;` como requisito `CRITICAL` en archivos con código ejecutable de nivel superior y `WARNING` en archivos declarativos privados.
- Sanitiza todo archivo SVG con una librería XML/SVG validada antes de autorizar `image/svg+xml` en `upload_mimes`.
- Desactiva `WP_DEBUG`, `WP_DEBUG_DISPLAY` y `SAVEQUERIES` en producción.
- Escapa cada variable interpolada según su contexto cuando uses Heredoc/Nowdoc y prefiere `printf` o plantillas PHP separadas.

### 2.2 Bloques Gutenberg, Temas y Patrones
- Declara `"apiVersion": 3` y `"$schema"` en el `block.json` de todo bloque nuevo.
- Registra en `block.json` todos los handles de scripts y estilos del bloque para garantizar compatibilidad con el editor iframe.
- Usa `useBlockProps()` en React y `get_block_wrapper_attributes()` en PHP para envolver el nodo raíz del bloque.
- Declara `render` (`"file:./render.php"`) y devuelve `save() => null` en todo bloque dinámico.
- Carga JavaScript exclusivo de frontend mediante `viewScriptModule` o `viewScript` en `block.json`, reservando `script` para código compartido editor + frontend.
- Limita cada bloque a una sola instancia de `InnerBlocks`.
- Lee y escribe metadatos de post en el editor con `useEntityProp`.
- Ordena el array `deprecated` de bloques de la versión más reciente a la más antigua acompañado de fixtures de prueba.
- Escribe `templates/*.html` y `parts/*.html` en HTML puro de bloques sin etiquetas `<?php` y sin subdirectorios anidados.
- Delega lógica dinámica o cadenas traducibles desde `templates/` y `parts/` a `<!-- wp:pattern {"slug":"..."} /-->`.
- Usa `core/query`, `core/post-featured-image` (junto a `add_theme_support( 'post-thumbnails' )` en archivos/singles), encabezado raíz `<h2>`, tokens de `theme.json` y `esc_url( get_theme_file_uri( ... ) )` dentro de `patterns/*.php`, sin `get_posts()`, `the_title()`, estado de usuario ni estilos inline; reserva el `<h1>` único exclusivamente para la plantilla o un patrón no reutilizado en otras vistas.
- Declara la cabecera `Categories` en todo patrón visible de `patterns/*.php` (auto-registro WP 6.0+), marca `Inserter: no` en patrones internos y registra categorías personalizadas en PHP con `register_block_pattern_category()`.
- Valida que todo patrón y bloque inserte y guarde en el editor sin disparar "Attempt Block Recovery".

### 2.3 Interactivity API (WP 6.9+)
- Activa `supports.interactivity: true` y `viewScriptModule` en `block.json` para interactividad nativa del cliente; si el bloque no usa build externo, declara un `*.asset.php` hermano con la dependencia `'@wordpress/interactivity'` para que WordPress imprima el `<script type="importmap">`.
- Implementa el estado interactivo con `store()`, `getContext()` y getters nativos.
- Inyecta el contexto inicial desde PHP con `wp_interactivity_data_wp_context()` y registra el estado derivado en PHP con `wp_interactivity_state()` mediante closures para que el SSR no vacíe directivas `data-wp-text` o `data-wp-bind--*`.
- Separa IDs únicos de directiva con `---` y utiliza `data-wp-on-async--*` para eventos que no bloqueen el hilo principal.

### 2.4 Modelado de contenido (Bloques vs ACF)
- Construye layouts y composición editorial con bloques nativos y patrones de Gutenberg.
- Modela entidades y datos estructurados de dominio con CPTs, Taxonomías y ACF.
- Versiona todos los grupos de campos ACF en `acf-json/` dentro del repositorio.
- Modela cualquier dato consultable o filtrable como taxonomía personalizada o tabla dedicada en lugar de `meta_query` sobre `meta_value`.

### 2.5 REST API y Headless WP / WPGraphQL
- Registra toda ruta REST en `rest_api_init` bajo un namespace propio `vendor/v1`, extendiendo `WP_REST_Controller` y usando constantes `WP_REST_Server::*`.
- Define `permission_callback` explícito y esquema tipado en `args` (`validate_callback` y `sanitize_callback`) en cada endpoint REST.
- Devuelve respuestas REST mediante `rest_ensure_response()` o `WP_Error` y utiliza REST API en lugar de `admin-ajax.php` para todo endpoint nuevo.
- Autentica llamadas REST de administración con `X-WP-Nonce` y clientes externos con Application Passwords.
- Impón paginación explícita y acotada en todas las conexiones WPGraphQL.
- Resuelve relaciones en WPGraphQL mediante batching/DataLoader para evitar consultas N+1.
- Protege vistas previas Headless con tokens seguros de corta duración y dispara revalidación bajo demanda mediante webhooks al publicar o actualizar contenido.

### 2.6 Performance y Datos
- Acota `posts_per_page` en toda consulta pública, añade `'no_found_rows' => true` sin paginación y `'fields' => 'ids'` cuando solo necesites IDs.
- Valida todo ID dinámico con `absint( $id ) > 0` antes de pasarlo a `WP_Query` (`p`, `post__in`).
- Reemplaza exclusiones pesadas (`post__not_in`) por inclusión positiva (`post__in`) o listas de IDs precomputadas.
- Almacena opciones grandes o transitorias con `autoload = false` (`update_option( $key, $value, false )`) y mantén `alloptions < 1MB`.
- Configura `timeout <= 2` segundos en toda petición HTTP externa y cachea su respuesta.
- Asigna TTL explícito, invalidación por claves versionadas y protección anti-stampede (`wp_cache_add()` o *stale-while-revalidate*) en Object Cache.
- Precarga cachés o agrupa consultas en lote para eliminar N+1 y llamadas HTTP dentro de bucles.
- Mantén `edit()` en bloques Gutenberg liviano sin data fetching amplio ni suscripciones redundantes al store.

### 2.7 Ciclo de vida, Migraciones y WP-CLI
- Registra `register_activation_hook()` y `register_deactivation_hook()` en el archivo principal de nivel superior del plugin.
- Limpia datos del plugin al desinstalar en `uninstall.php` comprobando `defined( 'WP_UNINSTALL_PLUGIN' )`.
- Ejecuta upgrades de esquema de forma independiente a `register_activation_hook()`, guardados con `version_compare()` contra una opción de versión almacenada.
- Crea o actualiza tablas personalizadas mediante `dbDelta()` incluyendo `$wpdb->get_charset_collate()`.
- Separa cambios DDL de backfills de datos, copia y verifica integridad antes de borrar estructuras previas y procesa backfills por lotes en Action Scheduler o WP-CLI.
- Confirma entorno, `--path` y `--url` antes de ejecutar comandos WP-CLI con efectos de escritura.
- Ejecuta modificaciones de base de datos en secuencia `wp db export` → `--dry-run` → ejecución con `--skip-columns=guid`, acotando tablas por defecto (usa `--all-tables-with-prefix` solo en migraciones completas de dominio omitiendo columnas binarias).
- Especifica explícitamente `--url` (sitio individual) o `--network` (red completa) en toda operación WP-CLI sobre multisite.

### 2.8 Bloque condicional WordPress.org (solo si se publica en WordPress.org)
- Garantiza licencia 100% compatible con GPL, respeta trademarks y sincroniza `Version:` del plugin con `Stable tag` en `readme.txt`.
- Incluye el código fuente legible de todos los assets compilados y supera `wp plugin check` sin errores.
- Omite auto-updaters externos, trialware y telemetría sin opt-in explícito, restringiendo avisos admin descartables a pantallas propias.
- Exige `defined( 'ABSPATH' ) || exit;` en todos los archivos PHP del entregable y aplica WPCS estricto.

## 3. Mejores prácticas y arquitectura

### 3.1 Temas (`theme.json` v3 / WP 6.9+) y Admin UI
- Crea proyectos nuevos como Block Theme y mantén Classic, Hybrid o Child Themes respetando su arquitectura base.
- Expresa el sistema visual en `theme.json` v3 con `"useRootPaddingAwareAlignments": true`, padding horizontal en `styles.spacing.padding`, presets `var(--wp--preset--*)`, `styles.elements.textInput`, `styles.elements.select`, `settings.border.radiusSizes` y estados `:hover`/`:focus` en botones.
- Si incluyes bloques `wp:html` o layouts propios en Block Themes, añade `box-sizing: border-box`, `img, svg { max-width: 100%; height: auto; }` y `.wp-block-column { min-width: 0; }` en la hoja del tema para evitar desbordes horizontales.
- Prevé la conversión `_wp_to_kebab_case()` al nombrar slugs en `theme.json` (`3xl` genera `--wp--preset--*--3-xl`; `cardShadow` genera `card-shadow`).
- Respeta la cascada `core → theme.json → child theme.json → wp_global_styles (BD)` verificando que estilos guardados en BD no sobreescriban cambios en `theme.json`.
- Declara bajo `patterns` en `theme.json` únicamente un array de slugs del directorio oficial.
- Construye pantallas de ajustes del admin clásico con Settings API y `sanitize_callback`, aislando lógica admin tras `is_admin()` y encolando assets solo en su `$hook_suffix`.
- Emplea `@wordpress/components` únicamente en el editor de bloques o apps React admin, conservando i18n, capacidades y nonces.
- Implementa accesibilidad nativa en bloques y admin: controles HTML semánticos, gestión de foco en overlays/modales y regiones `aria-live`.

### 3.2 Estilo PHP, PHPStan y Testing
- Sigue el `phpcs.xml` del repositorio (sintaxis PHP moderna `[]` por defecto en proyectos privados de agencia; WPCS `array()` y Yoda conditions cuando el proyecto o cliente lo exija).
- Versiona `phpstan.neon.dist` con `szepeviktor/phpstan-wordpress`, `reportUnmatchedIgnoredErrors: true` y `paths` acotado a código propio excluyendo `vendor/`, ejecutándolo vía Composer (`-c phpstan.neon.dist`).
- Instala stubs oficiales de terceros (por ejemplo `acf-pro-stubs`) y anota tipos con PHPDoc (`WP_REST_Request<array{...}>`, `@phpstan-type`, `array<WP_Post>`) antes de añadir `ignoreErrors` estrechos.
- Usa baseline de PHPStan únicamente para deuda legacy en modo *ratchet up* (nunca para silenciar errores nuevos).
- Excluye `tests/` de PHPStan durante la adopción en repositorios legacy e inclúyelo en proyectos nuevos con stubs de PHPUnit y WordPress test suite.
- Implementa pruebas en pirámide de 3 capas: unitarias sin WordPress, integración con `WP_UnitTestCase` (hooks, REST, BD, capacidades) y E2E con Playwright (bloques, JS admin, flujos críticos).

### 3.3 Operación, Perfilado, CI/CD y Entorno Local
- Protege comandos WP-CLI personalizados con `defined( 'WP_CLI' )`, extiende `WP_CLI_Command` y sustituye ejecuciones repetitivas de `wp eval` por comandos versionados.
- Escribe scripts operativos con `set -euo pipefail` y modo dry-run por defecto exigiendo la bandera `--apply` para mutaciones.
- Expón disparadores manuales en CLI o admin para tareas WP-Cron y evalúa `DISABLE_WP_CRON` + cron real del sistema (`INFO` por defecto; `WARNING` en alto tráfico o tareas pesadas).
- Diagnostica rendimiento con `wp doctor`, `wp profile`, cabeceras Query Monitor headless (`x-qm-*`), `Server-Timing` y `newrelic_record_custom_event()`.
- Construye artefactos de release desde un checkout limpio usando lockfiles (`npm ci`), excluyendo dependencias dev, tests, secretos y sourcemaps.
- Fija GitHub Actions por SHA de commit y protege despliegues a producción con tags, aprobación manual, smoke checks y plan de rollback.
- Elige `wp-playground` por defecto para pruebas rápidas sin Docker y `wp-env` (Docker + Node `>= 18.12`, verificando `docker info`) cuando necesites MySQL real, PHPUnit, Composer, extensiones PHP o exista `.wp-env.json`.
- Configura Blueprints con `$schema` en `.net`, `preferredVersions` en `major.minor`, `features` limitado a `networking`/`intl`, `pluginData`/`themeData`, `refType` en `git:directory`, `--blueprint=<archivo>`, `--blueprint-may-read-adjacent-files`, `--mount-dir` en Windows, `.zip` únicamente con `"resource": "bundled"`, y `require '/wordpress/wp-load.php'` solo dentro de `runPHP`.
- Declara plugins y temas en `.wp-env.json` mediante URL ZIP, repo GitHub o ruta local, contempla que `.wp-env.override.json` reemplaza arrays completos de `plugins`/`themes`, ejecuta comandos con `wp-env run <env> --env-cwd=<dir> -- <cmd>` y usa el puerto `9003` para Xdebug.

## 4. Antipatrones
- No uses `query_posts()`, `posts_per_page => -1` en tráfico público ni `meta_query` filtrando sobre `meta_value` sin índice.
- No uses ACF Flexible Content como page-builder libre ni declares atributos de bloque con `source: "meta"`.
- No llames a `eval()`, `unserialize()`, `extract()`, ni concatenes variables en consultas SQL, ni habilites SVG sin sanitizar.
- No omitas `wp_unslash()` antes de sanitizar entradas ni apliques `wp_kses_post()` sobre `$content` de `InnerBlocks`.
- No ejecutes `flush_rewrite_rules()` en `init`, ni upgrades de BD en cada carga de página, ni backfills masivos dentro de un request web.
- No llames a `session_start()` o `setcookie()` en frontend público cacheable ni implementes polling JS continuo al servidor.
- No respondas endpoints REST con `wp_send_json()`, no registres rutas bajo el namespace `wp/*` ni omitas `permission_callback`.
- No incluyas `<?php` en `templates/*.html`/`parts/*.html`, no ejecutes `get_posts()` en `patterns/*.php` ni uses `data-wp-ignore` en Interactivity API.
- No empaquetes releases con `zip -r .` desde un working tree sucio ni ejecutes `wp plugin update --all`, `wp theme update --all`, `wp cron event run --all` o `--allow-root` en producción.
- No invalides Object Cache con `wp_cache_flush_group()` en backends no portables (como Memcached) ni llames a `newrelic_start_transaction()` en requests web.
- No reportes `get_template_part()` en bucles como fallo de I/O bajo OPcache ni infles hallazgos `CRITICAL` por complejidad normal sin impacto real.

## 5. Checklist de validación
- [ ] Seguridad verificada: `wp_unslash()` + sanitización temprana, nonce + `current_user_can()` + ownership, escape tardío, `$wpdb->prepare()`, cero `eval`/`unserialize`/`extract`/SVG crudo, `ABSPATH` correcto y `WP_DEBUG`/`SAVEQUERIES` desactivados en producción.
- [ ] Bloques y temas verificados: `apiVersion: 3`, `useBlockProps()`/`get_block_wrapper_attributes()`, `viewScriptModule`/`viewScript` (`*.asset.php` si no hay build), `templates/` y `parts/` en HTML puro sin subdirectorios, `patterns/*.php` con `core/post-featured-image` sin `get_posts()`/estilos inline, `<h1>` único por vista y cero "Attempt Block Recovery".
- [ ] Interactivity API verificada (si aplica): `supports.interactivity: true`, `store()`, `getContext()`, `wp_interactivity_data_wp_context()` + `wp_interactivity_state()` en PHP, separador `---`, sin `data-wp-ignore`.
- [ ] Modelado verificado: bloques/patrones para layout, `acf-json/` versionado para datos estructurados, cero `meta_query` en `meta_value` y cero Flexible Content como page-builder libre.
- [ ] Performance verificada: `posts_per_page` acotado, `no_found_rows`/`fields => 'ids'`, `absint() > 0` en IDs, `alloptions < 1MB` (`autoload = false`), HTTP externo `timeout <= 2s` cacheado, Object Cache con TTL/claves versionadas y cero `session_start()`/`setcookie()` en frontend público.
- [ ] REST y Headless verificados: namespace `vendor/v1`, `WP_REST_Controller`, `permission_callback`, `args` tipados, `rest_ensure_response()`/`WP_Error`; WPGraphQL paginado con DataLoader, preview tokens seguros y revalidación webhook.
- [ ] Calidad y Ops verificados: `phpcs` acorde a `phpcs.xml`, `phpstan.neon.dist` sin errores nuevos, pirámide de testing 3 capas, migraciones `version_compare` + `dbDelta()` separadas de activación, WP-CLI con `wp db export` → `--dry-run` → `--skip-columns=guid`, CI limpio + rollback y bloque WordPress.org cumplido si aplica.
