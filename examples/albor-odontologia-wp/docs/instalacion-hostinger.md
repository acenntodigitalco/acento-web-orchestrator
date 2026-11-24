# Guía rápida de instalación en Hostinger (WordPress)

## 1. Subir el tema desde el panel de WordPress
1. Entra a tu sitio temporal `.hostinger` → `/wp-admin`.
2. Ve a **Apariencia → Temas → Añadir nuevo tema → Subir tema**.
3. Selecciona `desarrollo/albor-odontologia.zip` y haz clic en **Instalar ahora → Activar**.

## 2. Qué ocurre automáticamente al activar el tema
El tema incluye un sembrador idempotente (`inc/demo-setup.php`) que se ejecuta una sola vez al activar:
- Crea las 5 páginas base si no existen: **Inicio**, **Quiénes somos** (`/quienes-somos/`), **Servicios** (`/servicios/`), **Blog** (`/blog/`) y **Contacto** (`/contacto/`).
- Asigna **Inicio** como portada estática y **Blog** como página de entradas.
- Publica 1 artículo de blog de ejemplo (*"Implantes dentales en Medellín: tiempos reales, cuidados y valoración"*).

## 3. Qué probar en vivo en Hostinger
- **Editor del sitio (Gutenberg):** ve a *Apariencia → Editor* y verifica que no aparezca ningún aviso *"Attempt Block Recovery"* y que `theme.json` v3 aplique colores y tipografía.
- **Bloque propio (`apiVersion: 3` + Interactivity API):** en la portada prueba el **Orientador rápido** tocando *Valoración general*, *Implantes dentales*, *Ortodoncia estética* y *Dolor o urgencia*.
- **Formulario CRO + REST API:** en `/contacto/` envía una prueba; en WP Admin verás el registro en el menú **Solicitudes de cita** y en la consola (`window.dataLayer`) verás `generate_lead` disparado solo tras el HTTP `201`.
- **SEO Técnico 2026:** abre `/robots.txt`, `/wp-sitemap.xml` y revisa el `<script type="application/ld+json">` en el código fuente (`Dentist` + `BreadcrumbList`, y `Article` + `Person` en el post).
