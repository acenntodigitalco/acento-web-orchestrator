# Prompt de Ejemplo #2 — WordPress Block Theme Nativo desde Cero (Gutenberg + Referencia Visual)

Copia y adapta este prompt tras instalar **Acento Web Orchestrator** (perfil `wordpress` o kit completo) y ejecutar `/quiero-iniciar-proyecto`:

```text
Quiero iniciar un proyecto WordPress llamado "Albor Odontología" usando /quiero-iniciar-proyecto y datos [DEMO].

1. Tecnología: WordPress Block Theme 100% nativo en Gutenberg (theme.json v3, templates/*.html, parts/*.html, patterns/*.php y 1 bloque propio con apiVersion: 3 + Interactivity API). Sin constructores pesados, sin jQuery, sin Bootstrap y sin Tailwind.
2. Vistas requeridas (6): Home, Quiénes somos, Servicios, Blog, Post individual (con soporte nativo de Imagen Destacada) y Contacto.
3. Conversión y CRO:
   - Formulario accesible de 1 columna para solicitar valoración dental conectado a un endpoint REST API seguro (nonce + validación), guardando las solicitudes en WP Admin y disparando `generate_lead` solo tras respuesta HTTP 2xx.
   - Botón secundario hacia WhatsApp y bloque interactivo para orientar al paciente por motivo de consulta.
4. Referencia visual (opcional):
   - Si tengo una plantilla o captura de referencia en `referencias/plantillas-terceros/`, analízala primero con `analista-plantillas` sin copiar código ni imágenes, diseña una identidad visual nueva (paleta cálida anti-genérica) y valida al final con `validador-originalidad`.
5. SEO técnico automático:
   - Schema.org JSON-LD `@graph` (`Dentist`, `BreadcrumbList`, `Article` + `Person` sin tipos retirados), `robots.txt` apuntando a `/wp-sitemap.xml` y entrega en `.zip` listo para subir a WordPress.
```

> Resultado real incluido en [`examples/albor-odontologia-wp/`](../albor-odontologia-wp/) y visible en vivo en [stellar-red-wallaby-67.hostingersite.com](https://stellar-red-wallaby-67.hostingersite.com/).
