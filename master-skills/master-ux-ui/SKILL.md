---
name: master-ux-ui
description: >
  Estándar transversal de diseño UX/UI, arquitectura de componentes, accesibilidad WCAG 2.2 AA, tokens OKLCH y patrones de backoffice bajo la regla rectora Web Platform First (Baseline).
  Activar al diseñar interfaces, maquetar pantallas o layouts, definir design systems, revisar contraste/accesibilidad, construir formularios, tablas o dashboards, o auditar calidad visual en HTML, CSS, Tailwind v4, Astro, React o WordPress.
---

# Master UX/UI

## 1. Rol y alcance
- Diseñar, maquetar y auditar interfaces web accesibles, coherentes y libres de estética genérica IA sobre estándares nativos del navegador.
- Detectar el stack real del proyecto antes de escribir código; nunca asumir frameworks ni librerías no instalados.
- Aplicar el alcance transversal de UI/UX, design system, WCAG 2.2 AA, SVG, Tailwind v4 condicional y backoffice; delegar animaciones complejas a `master-animaciones`, SEO/CWV/Schema a `master-seo-tecnico`, redacción comercial a `master-copywriting`, conversión a `master-cro` y Bootstrap 5 a `master-bootstrap-5`.

## 2. Reglas obligatorias

### 2.1 Regla #1: Web Platform First (Baseline)
- Usar primitivas nativas HTML, CSS y JS **Baseline (`Widely available`)** antes de introducir dependencias o JavaScript adicional: `<dialog>`, Popover API (`popover`), `<details>`/`<summary>`, `@container`, `:has()`, `@starting-style`, CSS Grid/Subgrid y View Transitions.
- Adaptar APIs nativas del navegador de forma segura a frameworks y SSR inicializando controles imperativos solo en el cliente para evitar errores de hidratación.
- Evaluar toda dependencia UI existente o nueva con la rúbrica `keepWhen` / `dropWhen` y eliminar librerías que dupliquen capacidades Baseline nativas.

### 2.2 Dirección visual Anti-AI y jerarquía del brief
- Subordinar siempre las preferencias por defecto al brief explícito del cliente (estética, tipografía, paleta, era o referencias solicitadas).
- Aplicar estética Anti-AI cuando el brief no especifique dirección visual, evitando los 5 clichés por defecto: grillas de tarjetas idénticas, métricas hero decorativas, glassmorphism/gradientes púrpura gratuitos, numeración `01/02/03` sin secuencia real y `monospace` como disfraz técnico.
- Clasificar cada pantalla en uno de los 4 Modos de Superficie y respetar sus reglas:
  - `Persuade` (marketing y landings): foco narrativo y radios de tarjeta `12–16px`.
  - `Operate` (apps, herramientas y dashboards): densidad funcional, estabilidad visual y radios `8px`.
  - `Read` (editorial y documentación): comodidad lectora y contraste objetivo AAA `7:1`.
  - `Experience` (narrativa inmersiva o 3D): activar únicamente si el brief lo solicita.
- Distinguir explícitamente entre refinamiento incremental (preservar estructura) y rediseño completo antes de modificar una interfaz existente.
- Prohibir eyebrows o kickers sobre titulares por defecto; incorporarlos únicamente cuando el brief del cliente los solicite de forma explícita.
- Restringir `backdrop-filter` / glassmorphism a usos funcionales (modales, sheets o barras flotantes con contraste verificado) y 3D a `Experience`/`Persuade` bajo petición.
- Aplicar un único mecanismo de elevación por superficie (borde O sombra, nunca ambos combinados).
- Definir superficies de navegador (`::selection`, `caret-color`, `text-underline-offset`), teñir el texto secundario con el matiz de la superficie sobre fondos de color y determinar tema claro/oscuro según contexto de luz ambiental.
- Respetar el ritmo vertical de encabezados (más espacio arriba que abajo), evitar tarjetas anidadas, barras laterales decorativas en cajas redondeadas y máscaras geométricas crudas sobre fotografías.
- Etiquetar hallazgos y propuestas de diseño con el contrato de evidencia `observed` / `inferred` / `proposed` y marcar explícitamente todo dato o token ilustrativo sin inventar cifras reales.

### 2.3 Accesibilidad WCAG 2.2 AA bloqueante
- Cumplir contraste **WCAG 2.2 AA** sin redondear ratios al alza: `≥ 4.5:1` en texto normal y `≥ 3:1` en texto grande (`≥ 24px` normal o `≥ 18.67px` negrita) y componentes UI; apuntar a `≥ 7:1` en modo `Read`.
- Garantizar texto mínimo `≥ 12px`, área interactiva mínima `24×24px` (AA) y `44×44px` en móvil (`48×48dp` Android) con separación mínima de `8px` entre targets adyacentes.
- Mantener indicador de foco visible con `:focus-visible` y `outline` nativo compatible con `forced-colors` (Windows High Contrast), sin que cabeceras fijas u overlays tapen el elemento enfocado (`focus-not-obscured`).

```css
:focus-visible {
  outline: 2px solid var(--color-focus);
  outline-offset: 2px;
}
```

- Escribir HTML semántico nativo primero: usar `<button type="button|submit">` exclusivamente para acciones y `<a href>` exclusivamente para navegación; añadir ARIA solo cuando HTML nativo no exprese el patrón.
- Incluir enlace *skip-to-content*, landmarks semánticos (`header`, `nav`, `main`, `footer`), un único `<h1>` con jerarquía secuencial sin saltos de nivel y orden DOM coherente con el orden visual.
- Garantizar operabilidad completa por teclado sin trampas, gestionar focus trap y retorno de foco al disparador al cerrar modales o drawers, etiquetar botones solo-icono con `aria-label` o texto `sr-only`, y anunciar cambios dinámicos con `aria-live` (`polite` o `assertive`).
- Nunca usar el color como único indicador de estado; acompañarlo siempre de texto, icono o patrón visual.
- Implementar una guarda real de `prefers-reduced-motion: reduce` en CSS y JS que elimine movimiento espacial.
- Asociar cada control de formulario con `<label>`, vincular mensajes de error debajo del campo con `aria-describedby` y `aria-invalid`, limpiar el error al corregirlo, declarar `autocomplete`, permitir pegar (`allow-paste`), agrupar opciones relacionadas en `<fieldset>`/`<legend>` y soportar composición `IME`.
- Garantizar legibilidad con zoom al `200%` sin pérdida de contenido ni desbordamiento horizontal y compatibilidad total con `forced-colors`.
- Bloquear la entrega ante cualquier hallazgo `Critical` o `Serious` en auditorías automáticas ejecutadas mediante `npx` efímero fijado en versión (`@axe-core/cli` / `pa11y`) sin modificar `package.json`, y registrar la prueba manual con el par navegador + lector de pantalla.

### 2.4 Tokens OKLCH, tipografía, escalas e iconografía SVG
- Organizar los tokens en 3 capas (`Primitive → Semantic → Component`) expresados en **OKLCH** (alineados a W3C DTCG `$value`/`$type`) y consumir únicamente variables semánticas (`var(--*)`) en componentes.
- Usar escala discreta en `rem` con base `4px` para espaciado y tipografía de UI/cuerpo; reservar `clamp()` exclusivamente para titulares display y espaciado entre secciones.
- Limitar cada proyecto a 1–2 familias tipográficas (aumentar `line-height` en serif), mantener medida de lectura de `60–75ch` (`< 80ch`), piso de tracking `-0.04em`, `text-wrap: balance` en titulares cortos, `tabular-nums` en precios/datos/tablas y `overflow-wrap: anywhere` para evitar desbordes.
- Usar propiedades lógicas CSS (`margin-inline`, `padding-inline-start/end`, `inset-inline`) para soporte nativo LTR/RTL y gestionar `z-index` mediante una escala controlada de tokens.
- Construir el modo oscuro con paletas tonales desaturadas y pares semánticos superficie/`-foreground`, nunca mediante inversión de colores.
- Estandarizar toda iconografía con SVG consistente (`viewBox="0 0 24 24"`, `currentColor`, grosor de trazo uniforme, `<title>` en iconos informativos, `aria-hidden="true"` en decorativos, sin rásters embebidos) y verificar legibilidad a `16px` y `48px`.

### 2.5 Estados UI, formularios y límites de componente
- Implementar los 5 estados obligatorios en toda pantalla o módulo con datos: `loading`, `empty`, `error` (causa concreta y acción de recuperación), `success` y `permissions`.
- Respetar la precedencia visual de estados interactivos: `disabled > loading > active > focus > hover > default`.
- Mostrar skeleton screens (`role="status" aria-busy="true"`) durante la carga de contenido o listas; reservar spinners únicamente para acciones puntuales en botones, preservando cohesión botón → feedback.
- Mantener componentes UI co-ubicados por carpeta, enfocados en composición y con tamaño máximo `≤ 200 líneas` por componente (`≤ 1.000 líneas` como techo estricto en archivos no-componente), prop drilling `≤ 3` niveles y optimistic updates siempre con rollback ante error.
- Diseñar formularios usables: no pre-deshabilitar el botón submit para ocultar errores, validar en `blur` y revalidar al corregir, conservar los datos escritos ante error y advertir sobre cambios sin guardar (`unsaved-changes-guard`).

## 3. Mejores prácticas y arquitectura

### 3.1 Flujo de diseño en 2 pasadas y Reference-led UI
- Ejecutar un flujo en 2 pasadas en pantallas nuevas: (1) plan visual, tesis espacial, wireframe ASCII y autocrítica; (2) implementación verificada sobre capturas reales aplicando *squint test* (la jerarquía debe leerse al entrecerrar los ojos).
- Aplicar *Reference-led UI*: usar referencias o plantillas solo como guía de proporciones y ritmo; reescribir desde cero la estructura HTML, nombres de clases, tokens y componentes sin copiar código, layout exacto ni branding.
- Documentar el sistema visual multipantalla en `MASTER.md` y overrides específicos en `pages/<page>.md`, calibrando los diales `variance`, `motion` y `density`.
- Escalar el estado de menor a mayor alcance: estado local → estado levantado → parámetros de URL / contexto / store global solo cuando múltiples ramas lo requieran.
- Validar esquemas de formulario con tipado fuerte y atributos accesibles (`aria-invalid`, `aria-describedby`, `<fieldset>`/`<legend>`), usando librerías como React Hook Form + Zod cuando el proyecto use React.

### 3.2 Responsive, rendimiento de interfaz y entrega
- Maquetar mobile-first priorizando Container Queries (`@container`) y un máximo de 2–3 breakpoints por elemento.
- Verificar visualmente toda interfaz en la matriz QA agnóstica de 4 anchos: `320px`, `768px`, `1024px` y `1440px`.
- Proveer alternativa accesible (resumen textual o tabla) y contraste verificable en gráficos y mapas, sin exponer datos sensibles en cliente.
- Aplicar degradación adaptativa de efectos pesados en dispositivos con `navigator.hardwareConcurrency < 4`.
- Incluir página `404` cuidada y metadato `og:image` de `1200×630` en entregas de producción.

### 3.3 Módulo condicional: Tailwind CSS v4
*Aplicar esta subsección únicamente cuando el proyecto utilice Tailwind CSS.*
- Declarar tokens OKLCH y pares semánticos superficie/`-foreground` dentro de `@theme` en el CSS principal.

```css
@theme {
  --color-surface: oklch(0.98 0.004 260);
  --color-surface-foreground: oklch(0.2 0.01 260);
  --color-accent: oklch(0.55 0.16 250);
}
```

- Prohibir la interpolación dinámica de clases Tailwind (`bg-${color}-500`); mapear variantes con diccionarios de clases estáticas completas.
- Evitar FOUC en modo oscuro aplicando la clase/atributo de tema en un script bloqueante mínimo antes del render y añadiendo `suppressHydrationWarning` en el nodo raíz en frameworks SSR.
- Preservar foco visible en `forced-colors` usando `focus-visible:outline-2 focus-visible:outline-offset-2` (o `outline-transparent` si el diseño añade `ring`).

### 3.4 Patrones de Dashboard / Backoffice
*Aplicar al construir paneles administrativos, intranets o aplicaciones de gestión.*
- Estructurar el shell en 3 regiones (`sidebar` + `topbar` + `main` con scroll independiente) colapsando el sidebar a un drawer accesible en móvil.
- Implementar tablas de datos con 6 estados explícitos: `loading` (skeletons), `empty` (sin registros), `empty-search` (sin coincidencias + acción limpiar filtros), `error` (con botón reintentar), `populated` y `selection` (barra de acciones masivas).
- Gestionar formularios administrativos con bandera `touched` evaluada en `onblur`, feedback inmediato al corregir tras el primer error y foco automático al primer campo inválido al enviar.
- Incluir mini-sidebar colapsable, breadcrumbs con `aria-current="page"` y *page header* estandarizado (título, contexto breve y acción primaria).
- Proveer pantallas dedicadas de autenticación (login y recuperación con mensajes neutros) y de error operativo (`403`, `404` y fallo de red con `retry`).
- Definir tokens de superficie duales luz/oscuro diferenciando contraste entre lienzo base, barra lateral, cabecera y contenedores de datos.
- Asignar landmarks semánticos a cada región (`nav`, `aside`, `header`, `main`), usar `role="switch"` con `aria-checked` en interruptores booleanos y atrapar/restaurar foco en todos los modales y drawers.

## 4. Antipatrones
- Usar `<div onClick>`, `<span onClick>` o `<a href="#" role="button">` para acciones interactivas.
- Escribir colores hexadecimales crudos, estilos `inline` arbitrarios o valores mágicos fuera de la escala de tokens.
- Eliminar el foco del navegador con `outline: none` sin alternativa compatible con `forced-colors`.
- Usar emojis o símbolos Unicode en lugar de iconografía SVG consistente, o añadir grano `feTurbulence` y SVG "doodle" decorativos.
- Declarar `tabindex > 0`, contenido con parpadeo `> 3/s` o multimedia con autoplay sin controles de pausa.
- Combinar borde `1px` y sombra en la misma tarjeta, anidar tarjetas dentro de tarjetas o añadir barras de acento en cajas redondeadas.
- Usar spinners bloqueantes de pantalla completa para cargar listas o contenido en lugar de skeletons.
- Usar `word-break: break-all` para evitar desbordes de texto o aplicar `clamp()` indiscriminadamente a tamaños de UI y cuerpo.
- Modificar `package.json` instalando paquetes de auditoría temporales en lugar de ejecutar `npx` efímero fijado.
- Interpolar nombres de clases Tailwind en tiempo de ejecución o invertir colores mecánicamente para crear modo oscuro.
- Copiar código, nombres de clases, textos o layout literal desde plantillas compradas o referencias visuales.

## 5. Checklist de validación
- [ ] Primitivas Baseline (`<dialog>`, Popover, `<details>`, `@container`, `:has()`) usadas antes de añadir librerías o JS.
- [ ] Brief del cliente respetado por encima de defaults; modo de superficie (`Persuade`/`Operate`/`Read`/`Experience`) coherente y cero clichés IA no pedidos.
- [ ] Contraste WCAG 2.2 AA verificado sin redondear (`4.5:1` / `3:1`, meta `7:1` en `Read`), texto `≥ 12px` y targets `≥ 24×24px` (`≥ 44×44px` en móvil con `≥ 8px` de separación).
- [ ] Navegación completa por teclado, `:focus-visible` con `outline` nativo compatible `forced-colors`, `focus-not-obscured`, skip link y `prefers-reduced-motion` operativo.
- [ ] Auditoría automática vía `npx` fijado (`axe-core`/`pa11y`) con 0 errores `Critical`/`Serious`, `package.json` intacto y prueba manual registrada (navegador + lector de pantalla).
- [ ] Tokens OKLCH en 3 capas sin hex crudos ni inline styles arbitrarios; escala discreta `4px` en UI; `tabular-nums`, `60–75ch`, propiedades lógicas LTR/RTL y SVG `24×24` `currentColor`.
- [ ] Los 5 estados UI (`loading` con skeletons, `empty`, `error`, `success`, `permissions`) implementados y precedencia de estados respetada.
- [ ] Componentes UI `≤ 200 líneas`, prop drilling `≤ 3`, formularios accesibles con validación en `blur` y `allow-paste`.
- [ ] Capturas reales + *squint test* revisadas en `320px / 768px / 1024px / 1440px` y zoom `200%` sin desbordes.
- [ ] Si aplica Tailwind v4: `@theme` OKLCH, cero clases interpoladas y modo oscuro sin FOUC.
- [ ] Si aplica Dashboard: layout 3 regiones + drawer, tabla 6 estados, `touched` en `onblur`, breadcrumbs/`page header`, auth/error, tokens duales y `role="switch"` + foco en modales.
