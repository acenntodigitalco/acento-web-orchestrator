# Tayrona Travel: instrucciones para agentes

Lee primero `brief-proyecto.md`. Es la fuente de verdad del proyecto.

## Stack
- Tecnología: HTML5 + CSS3 moderno + JavaScript nativo (Vanilla JS, sin jQuery) + GSAP ScrollTrigger
- Constructor o base: Sitio estático limpio sin framework pesado
- Sistema de estilos: CSS nativo (Web Platform First — OKLCH, Container Queries, `@starting-style`, Media Queries)
- Idioma del sitio: `es-CO`

## Skills activas (en `.agents/skills/`)
1. `master-ux-ui` — Web Platform First, WCAG 2.2 AA, OKLCH, dirección editorial Anti-AI y 5 estados UI.
2. `master-seo-tecnico` — SEO técnico en código, GEO/AEO 2026, JSON-LD sin tipos retirados, `robots.txt`, `sitemap.xml` y CWV.
3. `master-copywriting` — Voz de marca local, *Seven Sweeps*, humanización anti-IA y `references/`.
4. `master-cro` — Arquitectura de conversión 100% WhatsApp (sin formularios), matriz O/CO, precios AI-ready y ofertas honestas.
5. `master-tracking` — `dataLayer` `snake_case`, Consent Mode v2 (`denied` por defecto), UTMs/`fbclid` para Meta Ads y `data-price`.
6. `master-animaciones` — CSS/WAAPI primero + GSAP ScrollTrigger/parallax con `gsap.context()` y `prefers-reduced-motion`.

## Reglas del proyecto
1. Responde en español.
2. **Web Platform First:** prioriza HTML y CSS nativos modernos antes de añadir JavaScript o librerías. **Prohibido introducir jQuery, Bootstrap o Tailwind** en este proyecto.
3. **Canal único de conversión:** el cliente NO quiere formularios de contacto; toda conversión dirige a WhatsApp `+57 300 000 0000` con mensaje prellenado por plan/horario.
4. Todo el código vive en `desarrollo/`. Nada se escribe en `referencias/`.
5. Datos del cliente, Schema.org y textos legales salen de `brief-proyecto.md` y `seo/datos-schema.md`. No inventes datos nuevos; conserva la etiqueta `[DEMO]` en los datos ficticios de prueba hasta que el cliente entregue los definitivos.
6. Cumple el checklist de validación de las 6 master skills antes de dar una tarea por terminada.

## Páginas del sitio
| # | Archivo | Propósito |
|---|---|---|
| 1 | `desarrollo/index.html` | One-Page Landing de conversión (Camping/Cabañas Tayrona + Pasadía Cartagena e Isla Barú + WhatsApp) |
| 2 | `desarrollo/blog/guia-parque-tayrona-santa-marta.html` | Artículo SEO/GEO de ejemplo con apertura *answer-first* y CTA a WhatsApp |

## Requerimientos especiales
- Botones de WhatsApp con animaciones llamativas de alto rendimiento (`transform`/`opacity`, sin flicker).
- Animaciones con scroll y efecto parallax fluido vía GSAP + ScrollTrigger, con contenido siempre visible por defecto si JS falla y soporte completo de `prefers-reduced-motion: reduce`.
- Tracking listo para campaña en **Meta Ads** + GA4/GTM con Consent Mode v2.
- Transparencia total en la logística del pasadía (recogida en puerta en Santa Marta a la ida; regreso finaliza en El Rodadero y transporte de vuelta a casa corre por cuenta del pasajero).

## Comandos útiles
- Vista previa local rápida (Python): `python -m http.server 8080 --directory desarrollo`
- Vista previa local rápida (Node): `npx serve desarrollo`
