# Acento Web Orchestrator

**Sistema de agentes y 10 Master Skills modulares para diseñar y desarrollar sitios web enfocados en conversión, rendimiento real y SEO/GEO/AEO 2026.**

Creado y compartido con la comunidad por **Acento Digital by Elkin De Ávila** — *Agencia de Marketing Digital especializada en convertir visitantes en clientes con sistemas que atraen, convierten, capturan y fidelizan.*

---

## ¿Qué problema resuelve?

Muchos proyectos con agentes de IA terminan con diseños genéricos, código heredado (dependencias pesadas innecesarias), choques entre frameworks (por ejemplo mezclar Tailwind con Bootstrap o cargar reglas de WordPress en proyectos Astro) y sitios bonitos que **no posicionan ni convierten**.

**Acento Web Orchestrator** organiza el trabajo en un **equipo de 5 agentes** y **10 Master Skills separadas por capas**, de modo que cada proyecto recibe **solo las skills que realmente necesita**, sin contradicciones ni relleno.

---

## Instalación rápida

Clona este repositorio y ejecuta el instalador en tu sistema operativo. Ofrece **dos modos**:
1. **Kit completo (recomendado):** instala el orquestador, 4 subagentes, workflows (`/quiero-iniciar-proyecto`, `/unificar-skills`), plantillas y las 10 master skills.
2. **Por perfil de stack:** copia únicamente las master skills necesarias dentro de `.agents/skills/` de un proyecto existente (`landing`, `astro`, `wordpress`, `woocommerce` o `bootstrap`).

### Multiplataforma (Node.js ≥ 18, sin dependencias externas)
```bash
git clone https://github.com/acenntodigitalco/acento-web-orchestrator.git
cd acento-web-orchestrator
node install.mjs
```

### Windows (PowerShell)
```powershell
.\install.ps1
```

### macOS / Linux (Bash)
```bash
chmod +x install.sh
./install.sh
```

### Instalación directa sin preguntas (CI o scripts)
```bash
# Kit completo en una carpeta nueva
node install.mjs --mode=full --target=./mi-orquestador

# Solo las skills necesarias para un proyecto Astro o WooCommerce
node install.mjs --mode=profile --profile=astro --target=./mi-sitio-astro
node install.mjs --mode=profile --profile=woocommerce --target=./mi-tienda
```

---

## Arquitectura por 3 capas (cero choques entre stacks)

### Capa 1 — Base web transversal
| Master Skill | Qué garantiza en tu proyecto |
|---|---|
| `master-ux-ui` | **Regla #1 Web Platform First** (HTML/CSS nativo Baseline antes que JS extra), paleta OKLCH, WCAG 2.2 AA, dirección visual anti-genérica, 5 estados UI y patrones de dashboard. |
| `master-seo-tecnico` | SEO técnico en código, **GEO/AEO 2026** (bots de búsqueda IA vs. entrenamiento), Schema.org JSON-LD `@graph` sin tipos retirados, `robots.txt`, `sitemap.xml`, `hreflang`, e-commerce técnico y Core Web Vitals. |

### Capa 2 — Plataforma y sistema de estilos (solo lo que usa el proyecto)
| Master Skill | Cuándo se activa |
|---|---|
| `master-astro-dev` | Proyectos en **Astro 5/6** + TypeScript estricto + arquitectura de islas mínimas + Tailwind v4 o CSS scoped. |
| `master-wp-custom` | **WordPress a medida**: Block Themes (`theme.json` v3), Classic/Hybrid, plugins privados, Gutenberg `apiVersion: 3`, Interactivity API, ACF (`acf-json`), REST API, Headless WP/WPGraphQL, seguridad 3 pilares, PHPStan y WP-CLI. |
| `master-woocommerce` | Tiendas **WooCommerce**: HPOS/CRUD, seguridad PCI, Checkout Blocks, Action Scheduler, dequeue `wc-cart-fragments` y puentes SEO. |
| `master-bootstrap-5` | Condicional: solo si el proyecto declara **Bootstrap 5.3** (prohibido mezclarlo con Tailwind). |

### Capa 3 — Especialidad (conversión, texto, medición y movimiento)
| Master Skill | Qué aporta |
|---|---|
| `master-copywriting` | Voz de marca, Voz del Cliente (VoC), edición *Seven Sweeps*, humanización estructural anti-IA (con `references/`) y comparativas BOFU. |
| `master-cro` | Propuesta de valor en `<5s`, matriz de objeciones O/CO, ofertas honestas sin FOMO falso, formularios de 1 columna, pricing legible por humanos e IA y experimentación A/B rigurosa (ASA). |
| `master-tracking` | `dataLayer` en `snake_case`, Consent Mode v2 (`denied` por defecto), atribución UTM/`fbclid`/`gclid` para Meta Ads y Google Ads, `data-price` numérico + moneda separada y deduplicación CAPI. |
| `master-animaciones` | CSS/WAAPI primero y **GSAP + ScrollTrigger** profesional (Astro, React y WordPress) con `gsap.matchMedia()`, `prefers-reduced-motion` semántico y cero animaciones de layout. |

---

## Equipo de agentes y workflows incluidos

- **`orquestador-web` (principal):** dirige la entrevista de arranque en rondas cortas, crea la estructura del proyecto y coordina a los subagentes.
- **`auditor-skills` (solo lectura):** audita colecciones de skills para detectar duplicados y conflictos.
- **`consolidador-skills` (solo lectura):** redacta master skills limpias desde una matriz aprobada.
- **`analista-plantillas` (solo lectura):** convierte referencias visuales o plantillas compradas en especificaciones escritas **sin copiar código**.
- **`validador-originalidad` (sandbox):** verifica antes de entregar que el código final es 100% original.

### Workflows disponibles
- **`/quiero-iniciar-proyecto`**: entrevista por rondas, crea la carpeta del proyecto (`../<nombre>/`), genera `brief-proyecto.md`, `AGENTS.md`, `seo/palabras-clave.md`, `seo/datos-schema.md` y copia solo las master skills necesarias.
- **`/unificar-skills`**: permite auditar y consolidar nuevas skills que agregues en el futuro sin tocar los originales.

---

## Desarrollo desde cero a partir de tus referencias (HTML, imágenes o Figma)

Puedes entregar como referencia el sitio que le gustó a tu cliente (archivos `.html`/`.html5`, capturas `.png`/`.jpg`, Figma o plantillas compradas) y el sistema construirá **un sitio nuevo y original**: un tema de WordPress a medida (Block Theme, Classic o Hybrid), un proyecto Astro o un sitio estático.

**La regla de originalidad es innegociable:** la referencia es solo una guía visual y estructural. **Nunca se reutiliza su HTML, clases, CSS, JavaScript, textos ni imágenes.**

| Paso | Qué ocurre |
|---|---|
| 1. Entrega | Colocas la referencia en `referencias/` (las plantillas de terceros van en `referencias/plantillas-terceros/`, en solo lectura y excluidas de Git). |
| 2. Análisis | `analista-plantillas` la convierte en una **especificación escrita** (secciones, jerarquía visual, patrones de layout, interacciones) sin copiar código. Se guarda en `referencias/analisis/`. |
| 3. Desarrollo | Se programa desde cero con otra estructura, otros nombres de clases y otra organización, usando solo la especificación y `brief-proyecto.md`. |
| 4. Verificación | `validador-originalidad` compara el código final contra la referencia y no se da por entregado sin veredicto `APROBADO`. |

> **Nota legal:** inspirarse en la estructura y el estilo de un diseño es práctica habitual, pero copiar código, textos, imágenes o rasgos distintivos protegidos no lo es. Si usas una plantilla comprada, respeta su licencia y úsala solo como referencia.

---

## Qué resultados concretos puedes esperar en cada proyecto

Al construir un sitio web público con este sistema, obtienes por defecto:
1. **Diseño original y accesible** (paleta OKLCH, tipografía con carácter, cero plantillas genéricas, WCAG 2.2 AA).
2. **Rendimiento real (*Web Platform First*)** sin frameworks innecesarios ni scripts obsoletos, imágenes WebP optimizadas (`<200KB` hero, `<100KB` contenido) y `fetchpriority="high"` en LCP.
3. **SEO técnico y GEO/AEO automáticos:** `robots.txt` (RFC 9309), `sitemap.xml` limpio y Schema.org JSON-LD `@graph` vigente sin tipos retirados (`FAQPage`, `HowTo`, `SearchAction`) ni *self-serving reviews*.
4. **Enfoque en conversión (CRO + Copy humano):** mensajes claros sin clichés de IA, objeciones resueltas con transparencia y CTAs orientados a acción (formularios limpios o cierre directo por WhatsApp).
5. **Medición profesional:** Consent Mode v2 en `denied` por defecto, modal nativo `<dialog>` de privacidad, captura de UTMs/`fbclid` y eventos `snake_case` listos para GA4, GTM y Meta Ads.
6. **Animaciones fluidas y responsables:** microinteracciones GPU-composited (`transform`/`opacity`), scroll reveals y parallax con GSAP respetando `prefers-reduced-motion`.

---

## Ejemplos reales incluidos (`examples/`)

Incluimos dos proyectos reales generados con este sistema (con datos de negocio `[DEMO]`) y sus **prompts listos para replicar** en [`examples/prompts/`](examples/prompts/):

### Ejemplo 1 — One-Page Landing HTML5 + GSAP (`examples/tayrona-travel/`)
- **Prompt replicable:** [`01-landing-html-whatsapp.md`](examples/prompts/01-landing-html-whatsapp.md)
- **Stack:** HTML5 + CSS3 moderno (OKLCH, Container Queries, `@starting-style`, `<details>`, `<dialog>`) + Vanilla JS (sin jQuery) + GSAP ScrollTrigger.
- **Incluye:** landing enfocada 100% en WhatsApp (armador de mensaje en 3 toques), artículo de blog SEO/GEO, `robots.txt`, `sitemap.xml`, `tracking.js` (Consent Mode v2 + `dataLayer`) y 4 imágenes WebP optimizadas.
- **Probar localmente:**
  ```bash
  python -m http.server 8080 --directory examples/tayrona-travel/desarrollo
  ```

### Ejemplo 2 — WordPress Block Theme Nativo desde Cero (`examples/albor-odontologia-wp/`)
- **Demo en vivo:** **[stellar-red-wallaby-67.hostingersite.com](https://stellar-red-wallaby-67.hostingersite.com/)** *(entorno WordPress activo en Hostinger para ver el tema funcionando en directo)*
- **Prompt replicable:** [`02-wordpress-block-theme.md`](examples/prompts/02-wordpress-block-theme.md)
- **Stack:** WordPress Block Theme 100% nativo en Gutenberg (`theme.json` v3, `templates/*.html`, `parts/*.html`, `patterns/*.php`), sin constructores pesados ni jQuery.
- **Qué demuestra en producción real:**
  - **Diseño original desde una plantilla de referencia:** construido desde cero tras analizar una plantilla de terceros con `analista-plantillas` y certificado con `validador-originalidad` (`APROBADO`, 0 clases ni código copiado; la plantilla original no se incluye en este repositorio).
  - **6 vistas completas:** Portada, Quiénes somos, Servicios, Blog (con `core/query` e imagen destacada nativa), Post individual y Contacto.
  - **Bloque Gutenberg propio (`apiVersion: 3` + Interactivity API):** selector interactivo *Orientador de Valoración Dental* con renderizado SSR (`wp_interactivity_state`) e `importmap` nativo sin requerir `npm build`.
  - **Formulario CRO + REST API:** endpoint `POST /wp-json/albor/v1/valoracion` con `WP_REST_Controller`, nonce anti-CSRF, almacenamiento privado en WP Admin y evento `generate_lead` disparado únicamente tras confirmación HTTP `201`.
  - **SEO técnico 2026:** JSON-LD `@graph` (`Dentist`, `BreadcrumbList`, `Article` + `Person`) y filtro `robots_txt` enlazado a `/wp-sitemap.xml`.
- **Cómo instalar este tema en tu propio WordPress:** comprime la carpeta `examples/albor-odontologia-wp/desarrollo/albor-odontologia` en un `.zip` y súbela desde **Apariencia → Temas → Añadir nuevo tema → Subir tema** (al activarlo, crea automáticamente las páginas demo de ejemplo).

---

## Licencia y créditos

Publicado bajo licencia **MIT** ([LICENSE](LICENSE)). Lee [CREDITS.md](CREDITS.md) para los agradecimientos a la comunidad open-source.

Desarrollado y compartido por **Acento Digital by Elkin De Ávila**.
