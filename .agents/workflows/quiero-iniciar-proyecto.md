---
description: Entrevista de arranque de un proyecto web (Astro o WordPress), crea la carpeta, el brief, el AGENTS.md del proyecto y copia las master skills necesarias.
---

# /quiero-iniciar-proyecto

Ejecuta estos pasos en orden. Pregunta en rondas de 4 a 5 preguntas, espera la respuesta y sigue. No repitas lo que el usuario ya dijo. Lo que no sepa se marca `PENDIENTE`.

## Ronda 0. Saludo
Responde: "Listo, vamos a montar el proyecto. Te hago unas preguntas por bloques." Y pasa a la ronda 1.

## Ronda 1. Identidad del proyecto
1. Nombre del proyecto.
2. Tecnología: **Astro**, **WordPress** (tema propio, Block Theme, Divi 5 o plugin), **WordPress + WooCommerce** o **Headless WordPress (Astro + WP)**.
3. Sistema de estilos: **CSS nativo (Web Platform First)**, **Tailwind v4** o **Bootstrap 5** *(nunca se mezclan Tailwind y Bootstrap en un mismo proyecto)*.
4. Descripción completa: qué es el negocio, qué problema resuelve la web, quién es el público y cuál es el objetivo principal (leads, ventas, reservas, posicionamiento).

Con el nombre confirmado, crea la carpeta con un nombre en minúsculas, sin tildes y con guiones: `../<nombre-del-proyecto>/`.

Ojo con las rutas: el orquestador corre desde `./`, pero cada proyecto nuevo se crea como carpeta **hermana** de `frontend`, dentro de `../` (equivale a `..\<nombre-del-proyecto>\`). Usa siempre la ruta absoluta. En `../` ya hay proyectos existentes: si ya existe una carpeta con ese nombre, pregunta si continuar sobre ella o usar otro nombre, y no sobrescribas nada. Nunca modifiques carpetas de otros proyectos. Si Antigravity niega escribir fuera del workspace, dile al usuario que agregue `../` como carpeta accesible y reintenta.

## Ronda 2. Requerimientos especiales
Ofrece esta lista y deja que marque lo que aplique, más lo que agregue:
- Enfoque fuerte en conversión / CRO (landing de campaña, formularios avanzados, página de pricing, lead magnets o A/B testing)
- Dashboard o panel de métricas (¿de qué datos y para quién?)
- Calendario o sistema de reservas
- Webhooks e integraciones (WhatsApp, CRM, formularios, automatizaciones, pasarelas de pago)
- Blog o comparativas BOFU
- Multi-idioma (`hreflang`)
- Área privada o login de clientes
- Animaciones destacadas (CSS/WAAPI nativo vs. GSAP / ScrollTrigger)
- Analítica, tracking y píxeles (GA4, GTM, Google Ads, Meta Pixel/CAPI, Consent Mode v2)

Para cada opción marcada, haz 1 o 2 preguntas de detalle (por ejemplo: qué sistema de CRM, qué eventos disparan el webhook).

Si el proyecto es WooCommerce: cantidad aproximada de productos, ¿hay variaciones?, pasarela de pago, métodos de envío, impuestos, cupones, ¿suscripciones o reservas?

## Ronda 3. Datos del cliente (sirven para la web y para Schema.org)
Pide estos datos en bloque y acepta que pegue todo junto:
- Nombre comercial, razón social y NIT (o equivalente)
- Tipo de organización (empresa local, tienda, persona, servicio profesional, sin ánimo de lucro)
- Dirección completa y coordenadas si las conoce; ¿hay varias sedes?
- Teléfono, WhatsApp, correo, horarios de atención
- Redes sociales y perfiles (URLs)
- Año de fundación, fundadores o representantes
- Áreas o ciudades de servicio
- Logo y colores de marca (¿hay manual de marca?)
- Medios de pago aceptados, rango de precios si aplica
- Reseñas o certificaciones que se puedan mostrar

## Ronda 4. SEO, GEO/AEO y estructura
1. Palabras clave principales y secundarias (acepta pegado o archivo .xls, .xlsx, .md, .txt).
2. Ciudad o región objetivo para SEO local.
3. Cuántas páginas y cuáles: Home, Quiénes somos, Servicios (¿una página por servicio?), Pricing, Contacto, Blog, otras.
4. ¿La web es nueva o es un rediseño? Si es rediseño, URL actual.
5. ¿Hay contenido (textos) listo o debe redactarse/humanizarse? ¿Alguna preferencia sobre acceso de bots de entrenamiento IA (`GPTBot`, `ClaudeBot`, `Google-Extended`) o dejamos la configuración recomendada (búsqueda IA permitida)?

## Ronda 5. Referencias y materiales
1. ¿Qué archivos entrega el cliente? (.figma, png, jpg, html, html5, logos, fotos)
2. ¿Hay plantillas compradas en Envato, ThemeForest u otro sitio que le gustaron al cliente? Pide ruta o enlace de cada una y qué le gustó (estilo, estructura, animaciones, sección específica).
3. Confirma en voz alta la regla: "La plantilla es solo referencia. El código final se escribe desde cero y no será igual al de la plantilla."
4. Sitios de la competencia o referencias visuales adicionales.

## Ronda 6. Entrega y repositorio
1. ¿Se sube a GitHub? Si sí: nombre del repositorio, cuenta u organización, público o privado.
2. Dominio y hosting (o PENDIENTE).
3. Fecha objetivo de entrega.
4. ¿Algo más que debamos tener en cuenta?

## Cierre de preguntas
Resume en máximo 12 líneas lo recogido y pregunta: "¿Falta algo o corrijo algo antes de generar los archivos?". Espera confirmación.

## Generación de archivos
Con la confirmación, crea dentro de la carpeta del proyecto:

```
<proyecto>/
├── AGENTS.md                  (plantilla _templates/AGENTS.proyecto.md.tpl rellenada)
├── brief-proyecto.md          (plantilla _templates/brief-proyecto.md.tpl rellenada)
├── .agents/
│   └── skills/                (solo las master skills necesarias, copiadas)
├── referencias/
│   ├── cliente/               (figma, png, jpg, html, html5 entregados)
│   ├── plantillas-terceros/   (plantillas compradas, SOLO LECTURA)
│   └── analisis/              (especificaciones generadas por analista-plantillas)
├── contenido/                 (textos, fotos, logos)
├── seo/
│   ├── palabras-clave.md
│   └── datos-schema.md        (datos del cliente ordenados para Schema.org)
├── docs/
└── desarrollo/                (src de Astro, tema de WordPress o HTML estático)
```

### Entregables SEO técnicos automáticos (en todo proyecto web público)
Siempre que se construya el código en `desarrollo/` de un sitio web público (sin esperar a que el usuario lo pida):
- **`robots.txt`** (RFC 9309, buscadores y crawlers de búsqueda IA permitidos por defecto, apuntando al sitemap).
- **`sitemap.xml`** limpio (sin `<priority>` ni `<changefreq>`, con `<lastmod>` real): archivo directo en HTML estático, `@astrojs/sitemap` en Astro, o validación del sitemap nativo/SEO sin duplicados en WordPress.
- **Schema.org JSON-LD `@graph`** vigente desde `seo/datos-schema.md` (sin tipos retirados ni *self-serving reviews*).

### Qué skills se copian (arquitectura por capas — mínimas necesarias)

#### 1. Capa base web (siempre en proyectos con interfaz web; omitir si es plugin backend puro)
| Condición | Master skill |
|---|---|
| Todo proyecto web con UI (incluye Web Platform First, WCAG 2.2 AA y patrones de dashboard) | `master-ux-ui` |
| Todo proyecto web público indexable (SEO técnico en código + GEO/AEO 2026 + Schema + CWV) | `master-seo-tecnico` |

#### 2. Capa de plataforma y estilos (copiar solo lo elegido en Ronda 1)
| Stack elegido | Master skill(s) a copiar |
|---|---|
| Astro | `master-astro-dev` |
| WordPress (tema propio, Block Theme, Hybrid, Child o plugin) | `master-wp-custom` |
| WordPress + WooCommerce | `master-wp-custom`, `master-woocommerce` |
| Headless WordPress (Astro + WP) | `master-astro-dev`, `master-wp-custom` (+ `master-woocommerce` si hay tienda) |
| Sistema de estilos = **Bootstrap 5** *(prohibido junto con Tailwind)* | `master-bootstrap-5` |

#### 3. Capa de especialidad (copiar solo si aplica según Rondas 1, 2 y 4)
| Requerimiento activo | Master skill a copiar |
|---|---|
| Foco en conversión (leads, ventas, landing, formularios, pricing, lead magnets o A/B testing) | `master-cro` |
| Textos por redactar, reescribir, humanizar o páginas comparativas BOFU | `master-copywriting` *(copiar carpeta completa con `references/`)* |
| Analítica, eventos, GA4, GTM, Google Ads, Meta Pixel/CAPI o Consent Mode v2 | `master-tracking` |
| Animaciones destacadas, coreografía de scroll o GSAP | `master-animaciones` |

Copia cada carpeta completa (incluyendo `references/` si existe) desde `./master-skills/` hacia `<proyecto>\.agents\skills\`. No copies nunca las skills originales de `frontend\skills\`. Si una master skill no existe, avisa y sugiere ejecutar `/unificar-skills` primero; no inventes su contenido.

### Archivos de referencia
- Mueve o copia los materiales que el usuario indique a `referencias/`. Las plantillas compradas van en `referencias/plantillas-terceros/` y nunca dentro de `desarrollo/`.
- Si hay plantillas, delega a `analista-plantillas` una por una (en paralelo si son varias) y guarda cada especificación en `referencias/analisis/<plantilla>.md`.

### Si se sube a GitHub
Ejecuta `git init`, crea `.gitignore` adecuado a la tecnología, y agrega `referencias/plantillas-terceros/` al `.gitignore` (las plantillas compradas no se publican). Crea el repositorio remoto solo si el usuario lo confirma y la herramienta `gh` está disponible; si no, deja las instrucciones en `docs/github.md`.

## Entrega final al usuario
Resumen ejecutivo: ruta de la carpeta, tecnología, skills copiadas, páginas definidas, datos `PENDIENTE` que quedan, y siguiente paso recomendado.

## Antes de cerrar el proyecto (cuando se construya la web)
Ejecuta `validador-originalidad` si hubo plantillas de terceros, y no des el proyecto por entregado hasta que el veredicto sea `APROBADO` o `APROBADO CON OBSERVACIONES` con las observaciones resueltas.
