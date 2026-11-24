---
name: master-bootstrap-5
description: >
  Reglas y arquitectura limpia de Bootstrap 5.3 (grid mobile-first, propiedades lógicas, variables `--bs-*`,
  mapas Sass, `data-bs-theme`, accesibilidad y carga modular SCSS/JS) armonizada con `master-ux-ui`. Activar
  solo si `brief-proyecto.md` exige Bootstrap 5 para maquetar layouts, formularios, modales, navbars o plantillas
  ("usa Bootstrap 5", "maqueta con Bootstrap", "componentes Bootstrap 5.3", "migra esta plantilla Bootstrap").
---

# Master Bootstrap 5

## 1. Rol y alcance

- Activa esta skill únicamente cuando el proyecto declare explícitamente **Bootstrap 5** en `brief-proyecto.md`.
- No mezcles Bootstrap 5 con Tailwind CSS en el mismo proyecto.
- Usa esta skill como capa complementaria de `master-ux-ui` sin duplicar sus reglas generales de WCAG 2.2 AA, dirección estética Anti-AI ni 5 estados UI.
- Verifica que la versión instalada sea Bootstrap `5.3.x` antes de emplear `data-bs-theme` o tokens CSS `--bs-*`.

## 2. Reglas obligatorias

### Tokens, temas y personalización
- Personaliza Bootstrap mediante variables y mapas Sass antes de importar los parciales, o sobrescribiendo propiedades CSS `--bs-*` en el alcance adecuado.
- Usa tokens semánticos de tema (`.text-bg-*`, `.bg-body`, `.bg-body-tertiary`, `.text-body-secondary`, `--bs-body-bg`, `--bs-body-color`) en lugar de valores hexadecimales crudos o colores estáticos.
- Implementa los modos claro y oscuro con el atributo nativo `data-bs-theme="light"` o `data-bs-theme="dark"` en `<html>` o en contenedores acotados.
- No apliques estilos inline arbitrarios (como `style="width: 18rem;"`); define tamaños con columnas de grid (`.col-*`), utilidades (`.w-*`, `.mw-100`) o variables CSS.
- Aplica un único mecanismo de elevación por tarjeta o contenedor (`.border` o `.shadow-sm`/`.shadow`, nunca ambos simultáneamente).

### Grid responsive y propiedades lógicas
- Maqueta *mobile-first*: declara clases base para `<576px` y agrega infijos progresivos (`sm` ≥576px, `md` ≥768px, `lg` ≥992px, `xl` ≥1200px, `xxl` ≥1400px).
- Construye layouts con `.container` / `.container-{breakpoint}` / `.container-fluid`, `.row`, columnas `.col-*` o `.row-cols-*` y gutters `g-*`, `gx-*`, `gy-*`.
- Usa propiedades lógicas de Bootstrap 5 (`ms-*`, `me-*`, `ps-*`, `pe-*`, `start-*`, `end-*`, `text-start`, `text-end`) para garantizar soporte LTR y RTL.
- Combina utilidades nativas de flexbox, grid, espaciado y visibilidad (`d-flex`, `d-grid`, `gap-*`, `m*-*`, `p*-*`, `d-none d-md-block`) antes de escribir CSS custom.

### Semántica y armonización con `master-ux-ui`
- Usa `<button type="button" class="btn ...">` (o `type="submit"` en formularios) para acciones, dropdowns, modales, offcanvas y acordeones.
- Reserva `<a href="..." class="btn ...">` exclusivamente para navegación real con destino válido; nunca uses `<a href="#" role="button">`.
- Usa placeholders nativos (`.placeholder-glow` y `.placeholder`) dentro de contenedores con `role="status"` y `aria-busy="true"` para carga de contenido.
- Reserva `.spinner-border` y `.spinner-border-sm` únicamente para botones o acciones puntuales en curso.
- Preserva un indicador `:focus-visible` con `outline` nativo y `outline-offset` compatible con `forced-colors` sobre `.btn`, `.form-control`, `.form-select`, `.nav-link` y `.accordion-button`.
- Mantén la jerarquía semántica real de encabezados (`h1`→`h2`→`h3`) en `.card-title`, `.modal-title` y `.offcanvas-title`, aplicando `.h1`–`.h6` o `.fs-*` solo para ajustar el tamaño visual.

### Accesibilidad nativa en componentes Bootstrap
- Usa `.visually-hidden` para etiquetas de lector de pantalla (incluidos spinners) y `.visually-hidden-focusable` para el enlace *skip to content*.
- Asocia cada `.form-control`, `.form-select` y `.form-check-input` a un `<label>` explícito y enlaza `.form-text` y `.is-invalid`/`.invalid-feedback` con `aria-describedby`.
- Declara `aria-expanded` y `aria-controls` en disparadores de `.collapse`, `.navbar-toggler` y `.accordion-button`.
- Declara `aria-current="page"` en el `.nav-link` y `.breadcrumb-item` activo, `aria-label` en botones de solo icono y `.btn-close`, y `aria-labelledby` en `.modal` y `.offcanvas`.
- Declara `role="alert"` y `aria-live` en `.alert` y `.toast`, y `role="progressbar"` con `aria-valuenow`, `aria-valuemin` y `aria-valuemax` en `.progress`.

### Carga modular y rendimiento
- Importa únicamente los parciales SCSS y módulos JS de Bootstrap usados por el proyecto (`bootstrap/js/dist/modal`, `dropdown`, `collapse`, `offcanvas`, `toast`) en lugar del bundle completo para proteger el tamaño de bundle y CWV.
- Incluye Popper (`@popperjs/core`) solo cuando existan componentes de posicionamiento dinámico (`Dropdown`, `Tooltip`, `Popover`).

## 3. Mejores prácticas y arquitectura

### Patrones de layout y componentes
- Iguala la altura de tarjetas en grillas combinando `.row.row-cols-1.row-cols-md-3.g-4` con `.card.h-100` dentro de cada `.col`.
- Usa `.img-fluid` con atributos `width` y `height` explícitos en imágenes responsivas, y `d-flex flex-column min-vh-100` en `<body>` con `flex-grow-1` en `<main>` para pies de página fijos al fondo.
- Usa `.d-grid.gap-2.d-md-flex.justify-content-md-end` para acciones que ocupen ancho completo en móvil y se alineen en fila desde `md`.
- Prefiere atributos declarativos `data-bs-toggle` y `data-bs-target` para interacciones estándar; instancia clases JS (`new bootstrap.Modal(...)`, `Dropdown`, `Toast`, `Collapse`) solo para control programático y llama a `.dispose()` al desmontar vistas en SPA.
- Importa primero `functions`, define sobrescrituras de variables y mapas Sass del proyecto, y carga únicamente los parciales SCSS de layout, utilidades y componentes necesarios.
- Valida el diseño en todos los breakpoints (`320px`, `576px`, `768px`, `992px`, `1200px`, `1400px`) y en modos `light` y `dark`.

### Ejemplos de marcado armonizado

Formulario con validación accesible, botón de acción y enlace real:
```html
<form class="needs-validation" novalidate>
  <div class="mb-3">
    <label for="correo" class="form-label">Correo electrónico</label>
    <input id="correo" type="email" class="form-control is-invalid" aria-describedby="correo-ayuda correo-error" required />
    <div id="correo-ayuda" class="form-text">Usaremos este correo solo para responderte.</div>
    <div id="correo-error" class="invalid-feedback">Ingresa un correo válido.</div>
  </div>
  <button type="submit" class="btn btn-primary">Enviar consulta</button>
  <a href="/privacidad" class="btn btn-link">Política de privacidad</a>
</form>
```

Skeleton nativo para carga de contenido:
```html
<div class="card" role="status" aria-busy="true">
  <div class="card-body placeholder-glow">
    <span class="placeholder col-6 mb-2"></span>
    <span class="placeholder col-10"></span>
    <span class="visually-hidden">Cargando contenido…</span>
  </div>
</div>
```

## 4. Antipatrones

- **Mezclar Bootstrap 5 con Tailwind CSS:** evita duplicar motores de utilidades y conflictos de reset CSS en el mismo proyecto.
- **Usar `<a href="#" role="button">` para acciones:** rompe la semántica nativa y la activación con barra espaciadora; usa `<button type="button" class="btn ...">`.
- **Escribir estilos inline arbitrarios (`style="width: 18rem;"`):** acopla dimensiones fijas fuera del grid y del sistema de tokens.
- **Usar `.spinner-border` para cargar páginas o listas completas:** degrada la percepción de carga; usa `.placeholder-glow` y `.placeholder`.
- **Usar clases físicas o colores fijos (`ml-*`, `mr-*`, `text-left`, `bg-light` sin token de tema):** rompe el soporte RTL y el cambio a `data-bs-theme="dark"`.
- **Cargar `bootstrap.min.css` y `bootstrap.bundle.min.js` completos sin filtrar:** infla el bundle y perjudica los Core Web Vitals.
- **Sobrescribir componentes con CSS de alta especificidad o `!important`:** genera deuda técnica; personaliza vía mapas Sass o `--bs-*`.
- **Depender únicamente de `box-shadow` para el foco o eliminar `outline`:** el indicador desaparece en Windows High Contrast (`forced-colors`).
- **Combinar `.border` y `.shadow-*` en la misma tarjeta:** duplica la elevación y rompe la jerarquía definida en `master-ux-ui`.
- **Saltar niveles de encabezado dentro de `.card-title` o `.modal-title`:** usa el nivel semántico correcto y ajusta el tamaño con `.h5` o `.fs-5`.

## 5. Checklist de validación

- [ ] `brief-proyecto.md` declara explícitamente Bootstrap 5 y no existe Tailwind CSS en el proyecto.
- [ ] El tema personaliza mapas Sass o variables `--bs-*`, usa tokens semánticos y funciona en `data-bs-theme="light"` y `dark` sin hexadecimales crudos.
- [ ] Todo el espaciado, alineación y posicionamiento usa propiedades lógicas (`ms-*`, `me-*`, `ps-*`, `pe-*`, `text-start`, `text-end`).
- [ ] Cero `<a href="#" role="button">`, cero estilos inline arbitrarios (`style="width: ..."`) y cero tarjetas con `.border` y `.shadow-*` a la vez.
- [ ] Las acciones usan `<button>`, la navegación real usa `<a href="...">` y la carga de contenido usa `.placeholder-glow`/`.placeholder` (spinners solo en botones).
- [ ] Cada campo de formulario enlaza `<label>`, `.form-text` y `.is-invalid`/`.invalid-feedback` mediante `aria-describedby`.
- [ ] Los componentes interactivos incluyen `.visually-hidden` / `.visually-hidden-focusable`, `aria-expanded`, `aria-controls`, `aria-current="page"`, `aria-label` en `.btn-close` y `:focus-visible` con `outline` nativo.
- [ ] El build importa solo los módulos SCSS y JS realmente usados y se validó de `320px` a `1400px` en modos claro y oscuro.
