# Brief del proyecto: Albor Odontología (Estudio de caso WordPress Gutenberg)

Fecha de creación: 2026-11-24
Estado: en desarrollo (estudio de caso piloto WordPress Block Theme)

> **Nota sobre datos `[DEMO]`:** Este proyecto es un estudio de caso integral para validar **WordPress nativo (Block Theme + Gutenberg `apiVersion: 3`)** partiendo de una referencia HTML de terceros (`smilorahtml-10`) sin copiar código, clases ni assets. Todos los datos comerciales, clínicos y legales marcados con `[DEMO]` son ficticios.

## 1. Resumen
- **Tecnología:** WordPress Block Theme nativo desde cero (Gutenberg + `theme.json` v3 + `templates/*.html` + `parts/*.html` + `patterns/*.php` + bloque dinámico propio `apiVersion: 3` con Interactivity API).
- **Sistema de estilos:** `theme.json` v3 + CSS nativo (*Web Platform First*: OKLCH, `@starting-style`, `<details>`, sin Tailwind ni Bootstrap ni jQuery).
- **Objetivo principal:** Captar citas de valoración odontológica mediante un **formulario CRO accesible** (sin fricción, 1 columna, confirmación real) y contacto directo por **WhatsApp**.
- **Público objetivo:** Adultos y familias en **Medellín (El Poblado / Laureles)** buscando odontología conservadora, implantes, ortodoncia estética o urgencias sin sensación fría de hospital.
- **Descripción completa:** Clínica odontológica boutique enfocada en diagnósticos honestos, mínima intervención y transparencia total en tiempos y presupuestos iniciales.

## 2. Requerimientos especiales
- **CRO / Conversión:** Formulario de solicitud de valoración dental (nombre, teléfono/WhatsApp, motivo de consulta y franja horaria preferida) con manejo explícito de objeciones (miedo al dolor, costos claros "desde", horarios extendidos) + CTA secundario a WhatsApp.
- **Bloque Gutenberg propio (`apiVersion: 3`):** Selector interactivo de orientación de tratamiento con **Interactivity API** (el paciente filtra por necesidad —Dolor/Urgencia, Estética, Implantes o Ortodoncia— y ve qué incluye la valoración y tiempo estimado).
- **Analítica / Tracking:** Consent Mode v2 (`denied` por defecto), `dataLayer` en `snake_case`, disparo de `generate_lead` exclusivamente cuando el endpoint REST/formulario responde HTTP `2xx` (nunca en el `submit` crudo del DOM) y `whatsapp_click` por ubicación.
- **Blog SEO/GEO:** Listado de blog + plantilla de artículo individual con apertura *answer-first*, autoría clínica `Person` (E-E-A-T YMYL) y CTA contextual hacia valoración.
- **Referencia visual (solo guía estructural):** `smilorahtml-10` en `referencias/plantillas-terceros/` (solo lectura, especificación en `referencias/analisis/smilorahtml-10.md`).
- **Idioma:** Español (`es-CO`).

## 3. Datos del cliente `[DEMO]`
| Campo | Valor |
|---|---|
| Nombre comercial | Albor Odontología |
| Razón social | Albor Salud Oral S.A.S. `[DEMO]` |
| NIT | 901.734.812-6 `[DEMO]` |
| Habilitación sanitaria | REPS 05001-88412-DEMO `[DEMO]` |
| Tipo de organización | Clínica odontológica local (`Dentist` / `MedicalClinic`) |
| Dirección | Calle 10A # 36-24, El Poblado, Medellín, Antioquia, Colombia `[DEMO]` |
| Coordenadas | `6.20892, -75.56648` `[DEMO]` |
| Teléfono / WhatsApp | +57 300 000 0000 `[DEMO]` (`https://wa.me/573000000000`) |
| Correo | citas@alborodontologia.example `[DEMO]` |
| Horarios | Lunes a viernes: 7:30 AM – 6:30 PM · Sábados: 8:00 AM – 2:00 PM |
| Año de fundación | 2020 `[DEMO]` |
| Equipo clínico | Dra. Sofía Vélez (Rehabilitación Oral, TP-DEMO-1042) · Dr. Andrés Saldarriaga (Implantología, TP-DEMO-2188) · Dra. Valeria Muñoz (Ortodoncia, TP-DEMO-3091) `[DEMO]` |
| Áreas de servicio | Medellín (El Poblado, Laureles, Envigado, Sabaneta) |
| Medios de pago | Tarjetas débito/crédito, transferencia Bancolombia, Nequi, efectivo y financiación por cuotas sin sobrecosto en tratamientos largos `[DEMO]` |
| Rango de precios | \$95.000 COP – \$4.200.000 COP `[DEMO]` |
| Redes sociales | Instagram `@alborodontologia.example`, Facebook `/alborodontologia.example` `[DEMO]` |
| Dirección visual (anti-genérica) | Editorial clínica cálida: marfil piedra (`#F8F6F1`), verde eucalipto profundo (`#17332D`), arcilla suave (`#B96A4B`) y turquesa mineral (`#2C6E73`); tipografía `Newsreader` (editorial) + `Plus Jakarta Sans` (lectura) — distinta a la plantilla de referencia |

## 4. SEO y GEO/AEO
- **Palabras clave principales:** clínica dental en El Poblado Medellín, odontología estética y conservadora Medellín, implantes dentales Medellín.
- **Palabras clave secundarias:** diseño de sonrisa natural Medellín, ortodoncia invisible precios Medellín, urgencia odontológica Medellín.
- **Ciudad o región objetivo:** Medellín (El Poblado y Laureles), Antioquia.
- **Dominio demo:** `https://alborodontologia.example` (o subdominio `.hostinger` temporal durante la prueba en vivo).
- **Política bots IA:** Búsqueda y citabilidad IA permitidas por defecto en `robots.txt`; incompatible con tipos Schema retirados (`FAQPage`/`HowTo`).

## 5. Estructura del sitio (6 vistas requeridas)
| # | Vista | Plantilla WordPress | Contenido |
|---|---|---|---|
| 1 | Home | `templates/front-page.html` | Hero editorial, bloque interactivo de orientación clínica, servicios, enfoque conservador, opiniones `[DEMO]`, guía reciente y CTA de valoración |
| 2 | Quiénes somos | `templates/page-quienes-somos.html` | Filosofía de mínima intervención, equipo clínico `[DEMO]` con registro profesional y estándares de esterilización |
| 3 | Servicios | `templates/page-servicios.html` | Catálogo transparente de 4 especialidades con precios orientativos "desde" y bloque de valoración |
| 4 | Blog | `templates/home.html` | Índice de artículos educativos para pacientes con apertura clara y filtro por categorías nativo |
| 5 | Post individual | `templates/single.html` | Artículo completo de ejemplo con apertura *answer-first*, autoría clínica `Person` y CTA a valoración |
| 6 | Contacto / Cita | `templates/page-contacto.html` | Formulario CRO accesible de 1 columna (endpoint REST seguro) + WhatsApp directo + mapa diferido y horarios |

## 6. Materiales y referencias
- **Plantilla de terceros (solo lectura):** `referencias/plantillas-terceros/smilorahtml-10/`
- **Especificación extraída:** `referencias/analisis/smilorahtml-10.md`
- **Regla de originalidad:** código, `theme.json`, clases CSS, patrones PHP, textos e ilustraciones SVG 100% escritos desde cero. Cero reutilización de archivos de `smilorahtml-10`.

## 7. Entrega
- **Entorno de prueba:** Hosting Business en Hostinger (subdominio `.hostinger`) mediante paquete `.zip` instalable como **Tema WordPress** estándar desde *Apariencia → Temas → Subir tema* (+ `wp_block` / páginas creadas automáticamente o guía rápida de asignación de slugs en 1 minuto).
