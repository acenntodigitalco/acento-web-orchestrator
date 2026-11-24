# Plan de Medición y Tracking — Tayrona Travel

Cumple `master-tracking`: `snake_case` estricto en eventos y `dataLayer`, `kebab-case` en UTMs sin PII, Consent Mode v2 `denied` por defecto, `data-price` numérico + `currency` separada y preparación para campañas de **Meta Ads**.

## 1. Matriz de eventos (`window.dataLayer`)

| Evento (`snake_case`) | Disparador | Propiedades clave | Conteo recomendado | Notas Meta Ads / GA4 |
|---|---|---|---|---|
| `consent_update` | Usuario acepta, rechaza o personaliza el banner/modal | `analytics_storage`, `ad_storage`, `ad_user_data`, `ad_personalization` | Cada cambio | Actualiza Consent Mode v2 antes de disparar píxeles |
| `plan_select` | Usuario selecciona un plan u horario en el armador de mensaje | `plan_id`, `plan_name`, `departure_time`, `guests`, `value` (`data-price`), `currency` (`COP`) | Cada interacción | Señal **Secondary** (no entrenar pujas solo con selección) |
| `whatsapp_click` | Clic real en cualquier enlace `https://wa.me/573000000000` | `cta_location`, `plan_id`, `plan_name`, `value`, `currency`, `utm_source`, `utm_medium`, `utm_campaign`, `utm_content`, `fbclid_present` | **Once** por sesión (lead) | Mapea a `generate_lead` (GA4) y `Contact` (Meta) tras consentimiento `granted`. **Importante:** mide intención de conversación; la venta real se confirma al cerrar el pago en WhatsApp/CRM |
| `faq_toggle` | Usuario abre una pregunta frecuente `<details>` | `question_id` | Cada apertura | Diagnóstico de objeciones reales (alimenta `master-cro`) |
| `scroll_depth` | Usuario cruza 25%, 50%, 75% o 90% de la landing | `percent_scrolled`, `page_path` | 1 vez por umbral | Señal **Secondary** de lectura |

## 2. Taxonomía UTM recomendada para campañas Meta Ads

- `utm_source=meta`
- `utm_medium=paid-social`
- `utm_campaign=tayrona-cabanas-2026-11` o `pasadia-baru-2026-11`
- `utm_content=video-cabo-san-juan` / `carrusel-precios`

El script `assets/js/tracking.js` captura y conserva en `sessionStorage` los parámetros UTM, `fbclid` y `gclid` durante toda la sesión (sin almacenar PII) y los adjunta a los eventos de `dataLayer`.

## 3. Verificación antes de producción
1. Reemplazar los IDs placeholder en `assets/js/tracking.js` (contenedor GTM / GA4 / Meta Pixel).
2. Confirmar en GTM Preview que el consentimiento inicial es `denied` y cambia a `granted` solo al aceptar.
3. Confirmar `whatsapp_click` en GA4 DebugView y `Contact` en Meta Test Events con un parámetro `?utm_source=meta&utm_medium=paid-social&utm_campaign=test-qa&fbclid=TEST123`.
4. Si se conecta WhatsApp Business API / CRM en el futuro, enviar evento `Purchase` vía CAPI con `event_id` único al confirmar abono real.
