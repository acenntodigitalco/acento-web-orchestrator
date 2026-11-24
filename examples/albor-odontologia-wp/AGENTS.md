# Albor Odontología: instrucciones para agentes

Lee primero `brief-proyecto.md`. Es la fuente de verdad del proyecto.

## Stack
- Tecnología: WordPress Block Theme nativo (Gutenberg `apiVersion: 3` + Interactivity API)
- Base: Tema de bloques desde cero (`theme.json` v3, `templates/*.html`, `parts/*.html`, `patterns/*.php`)
- Sistema de estilos: `theme.json` v3 + CSS nativo (*Web Platform First*, sin Tailwind, sin Bootstrap, sin jQuery)
- Idioma del sitio: `es-CO`

## Skills activas (en `.agents/skills/`)
1. `master-wp-custom` — Block Theme `theme.json` v3, bloques `apiVersion: 3`, Interactivity API, seguridad 3 pilares, REST API, performance y WPCS/PHP.
2. `master-ux-ui` — Web Platform First, WCAG 2.2 AA, OKLCH, estética clínica cálida no genérica y 5 estados UI.
3. `master-seo-tecnico` — Schema `Dentist` + `Person` + `Article` + `BreadcrumbList`, `robots.txt`, sitemap nativo WP sin duplicados y CWV.
4. `master-copywriting` — Tono clínico cercano y transparente, E-E-A-T salud (`Who/How/Why`), *Seven Sweeps*, humanización anti-IA y `references/`.
5. `master-cro` — Formulario de valoración de 1 columna con validación accesible, matriz de objeciones O/CO y precios orientativos claros.
6. `master-tracking` — Consent Mode v2 `denied` por defecto, `generate_lead` exclusivamente en respuesta REST `2xx` y `whatsapp_click`.

## Reglas del proyecto
1. Responde en español.
2. **Web Platform First & Gutenberg nativo:** prioriza bloques core, `theme.json` v3, `<details>`, `<dialog>` y CSS moderno antes de añadir JavaScript. Prohibido jQuery, Bootstrap o Tailwind.
3. Todo el código entregable vive en `desarrollo/albor-odontologia/`. Nada se escribe en `referencias/`.
4. `referencias/plantillas-terceros/` es solo lectura. Úsala únicamente a través de `referencias/analisis/smilorahtml-10.md`. Jamás copies clases, HTML, CSS, JS, textos ni imágenes de la plantilla comprada.
5. **SEO técnico automático:** todo sitio WordPress público debe mantener `robots.txt` compatible con RFC 9309, sitemap nativo WP (`wp-sitemap.xml`) o SEO único sin duplicados y Schema.org JSON-LD `@graph` vigente (`Dentist`, `Person`, `Article`, `BreadcrumbList` — sin `FAQPage`, `HowTo` ni *self-serving reviews*).
6. Seguridad PHP obligatoria: `defined( 'ABSPATH' ) || exit;`, `wp_unslash()` + sanitización temprana, nonce + validación REST en formulario de citas y escape tardío en toda salida.
7. Cumple los checklists de las 6 master skills y ejecuta `validador-originalidad` antes de empaquetar el `.zip` final.

## Vistas del sitio
| # | Vista | Plantilla |
|---|---|---|
| 1 | Home | `templates/front-page.html` |
| 2 | Quiénes somos | `templates/page-quienes-somos.html` |
| 3 | Servicios | `templates/page-servicios.html` |
| 4 | Blog | `templates/home.html` |
| 5 | Post individual | `templates/single.html` |
| 6 | Contacto | `templates/page-contacto.html` |

## Comandos útiles
- Empaquetar tema `.zip` para Hostinger: comprimir la carpeta `desarrollo/albor-odontologia/` limpia (sin `.git`, `node_modules` ni temporales).
- Validar sintaxis PHP (si hay `php` local): `Get-ChildItem -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }`
