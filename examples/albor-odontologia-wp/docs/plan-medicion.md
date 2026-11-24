# Plan de Medición — Albor Odontología `[DEMO]`

- **Consent Mode v2:** `denied` por defecto (`analytics_storage`, `ad_storage`, `ad_user_data`, `ad_personalization`) antes de cargar etiquetas externas.
- **Eventos (`snake_case`):**
  1. `consent_update`: al aceptar, rechazar o guardar preferencias en `<dialog>`.
  2. `treatment_filter`: al usar el bloque interactivo de orientación de tratamiento (**Secondary**).
  3. `generate_lead`: disparado **exclusivamente** cuando `POST /wp-json/albor/v1/valoracion` responde HTTP `200/201` con `{ ok: true }` — nunca en el evento `submit` del DOM. Conteo **Once**.
  4. `whatsapp_click`: al hacer clic real en enlaces WhatsApp con `data-price` numérico y `currency: "COP"`.
