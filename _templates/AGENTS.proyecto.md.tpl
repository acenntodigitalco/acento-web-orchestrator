# {{nombre_proyecto}}: instrucciones para agentes

Lee primero `brief-proyecto.md`. Es la fuente de verdad del proyecto.

## Stack
- Tecnología: {{astro | wordpress | wordpress + woocommerce | headless wordpress (astro + wp) | plugin wordpress}}
- Constructor o base: {{block theme | tema propio | divi 5 | astro sin framework UI | otro}}
- Sistema de estilos: {{CSS nativo (Web Platform First) | Tailwind v4 | Bootstrap 5}}
- Idioma del sitio: {{es-CO}}

## Skills activas (en `.agents/skills/`)
{{lista de master skills copiadas}}

## Reglas del proyecto
1. Responde en español.
2. **Web Platform First:** prioriza HTML y CSS nativos modernos antes de añadir JavaScript o librerías, y respeta el sistema de estilos elegido (nunca mezcles Tailwind con Bootstrap).
3. Todo el código vive en `desarrollo/`. Nada se escribe en `referencias/`.
4. `referencias/plantillas-terceros/` es solo lectura. Úsala únicamente a través de `referencias/analisis/`. El código del proyecto nunca copia clases, estructura, bloques CSS/JS, textos ni imágenes de una plantilla.
5. Datos del cliente, Schema.org y textos legales salen de `brief-proyecto.md` y `seo/datos-schema.md`. No inventes datos: si falta uno, déjalo como `PENDIENTE` y avisa.
6. **SEO técnico automático:** todo sitio web público debe generar siempre `robots.txt` (RFC 9309), `sitemap.xml` (directo en HTML estático, `@astrojs/sitemap` en Astro o validado sin duplicados en WordPress) y Schema.org JSON-LD `@graph` vigente sin necesidad de que el usuario lo pida.
7. Cumple el checklist de validación de cada master skill antes de dar una tarea por terminada.
8. Antes de la entrega final, ejecuta `validador-originalidad` si hubo plantillas de terceros.

## Páginas del sitio
{{tabla de páginas}}

## Requerimientos especiales
{{lista}}

## Comandos útiles
{{dev, build, preview, despliegue}}
