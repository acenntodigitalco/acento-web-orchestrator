---
name: master-animaciones
description: Estándar de animaciones web CSS/WAAPI primero y GSAP profesional (Astro/Vanilla, React y WordPress). Actívala al diseñar, implementar o auditar microinteracciones, transiciones CSS, `@starting-style`, View Transitions, Scroll-driven CSS, timelines GSAP, ScrollTrigger, Flip, SplitText o SVG animado, y ante peticiones como "anima esta sección", "mejora las animaciones", "añade animaciones de scroll" o "optimiza el rendimiento del motion".
---

# Master Animaciones

## 1. Rol y alcance

- Diseña, implementa y audita animaciones web orientadas a explicar estado, jerarquía, continuidad y feedback sin sacrificar rendimiento ni accesibilidad.
- Aplica este estándar a CSS nativo, Web Animations API (WAAPI), View Transitions y GSAP en proyectos Astro/Vanilla, React/Next.js y WordPress.
- Delega tokens visuales de color, tipografía, espaciado y auditoría WCAG general a `master-ux-ui`.

## 2. Reglas obligatorias

### 2.1 Estrategia Web Platform First
- Usa CSS transitions, `@keyframes`, `@starting-style`, View Transitions y Scroll-driven CSS para estados declarativos y secuencias acotadas.
- Usa Web Animations API (WAAPI) cuando necesites control imperativo ligero o interrumpibilidad sin añadir librería.
- Escala a GSAP únicamente para timelines complejas, FLIP avanzado, morphing o dibujo SVG y coreografía ligada al scroll.
- Evita añadir dependencias externas si el stack actual expresa el efecto con limpieza.

### 2.2 Escala de duraciones, curvas y criterio UX
- Aplica `100–150ms` para feedback inmediato (botones, toggles, confirmaciones).
- Aplica `150–300ms` para cambios de estado rutinarios (tabs, tooltips, dropdowns, acordeones).
- Aplica `300–500ms` para overlays, transiciones de layout y View Transitions.
- Aplica `500–800ms` exclusivamente para una entrada focal deliberada.
- Configura las salidas entre un 60% y un 70% más rápidas que sus entradas.
- Asigna `0ms` a atajos de teclado e interacciones de alta frecuencia (`100+/día`, como paletas de comandos o hovers repetitivos de lista).
- Usa desaceleración natural `cubic-bezier(0.16, 1, 0.3, 1)` para entradas confiadas.
- Extiende los tokens `--ease-*` y `--duration-*` existentes en el proyecto sin inventar escalas paralelas.
- Ajusta la densidad al modo de superficie: en `Persuade`/`Experience` diseña una sola secuencia focal con propósito y stagger de `30–50ms` acotado en listas; en `Operate`/`Read` limita el movimiento a transiciones rápidas de estado sin coreografía de carga.
- Mantén el contenido visible por defecto en HTML y CSS para que un fallo de JavaScript nunca oculte la página.
- Garantiza que toda animación interactiva sea interrumpible ante clics rápidos o cambios repetidos de estado.
- Anima un elemento hijo en `:hover` manteniendo inmóvil el contenedor objetivo para eliminar el flicker en bordes.
- Aplica `transition-delay` solo en el estado `:hover` para previews opcionales, dejando la salida sin retardo.

### 2.3 Rendimiento y accesibilidad del movimiento
- Anima únicamente `transform` y `opacity` para mantener el trabajo en el compositor.
- Evita animar propiedades de layout (`width`, `height`, `top`, `left`, `margin`, `padding`) y evita animaciones continuas de `box-shadow` o `filter`.
- Aplica `will-change` únicamente durante animaciones medidas y retíralo al finalizar.
- Pausa o detiene todo bucle no esencial cuando salga del viewport o la pestaña quede oculta.
- Agrupa las lecturas del DOM antes de las escrituras para evitar layout thrashing.
- Preserva el scroll nativo y la navegación por teclado por defecto; usa `ScrollSmoother` únicamente bajo excepción explícita tras verificar teclado y móvil.
- Implementa `prefers-reduced-motion: reduce` con criterio semántico: elimina movimiento espacial y parallax, preservando transiciones de opacidad, color y estado que confirman acciones.
- Respeta las preferencias de autoplay y sonido del usuario.

### 2.4 Ciclo de vida y seguridad en GSAP
- Instala GSAP y todos sus plugins desde `npm install gsap` (incluye `SplitText`, `MorphSVGPlugin`, `DrawSVGPlugin`, `Flip` y `ScrollSmoother` de forma gratuita, sin registro privado ni `.npmrc`).
- Registra cada plugin una sola vez a nivel de aplicación con `gsap.registerPlugin()` antes de su primer uso.
- Acota todos los selectores GSAP al contenedor raíz del componente pasando `scope` en `gsap.context(fn, scope)` o `useGSAP(fn, { scope })`.
- Revierte cada contexto en el desmontaje mediante `ctx.revert()`, `useGSAP()` o `mm.revert()` para limpiar tweens, `ScrollTrigger` y estilos inline.
- Gestiona `prefers-reduced-motion` y breakpoints en GSAP con `gsap.matchMedia()` y nunca anides `gsap.context()` dentro de `gsap.matchMedia()`.
- Nunca ejecutes `gsap.*` ni `ScrollTrigger.*` durante el renderizado en servidor (SSR).
- Nunca despliegues `GSDevTools`, `MotionPathHelper` ni `markers: true` a producción.

## 3. Mejores prácticas y arquitectura

### 3.1 Planificación y patrones CSS/WAAPI
- Redacta una tesis de movimiento breve antes de implementar: momento focal, continuidad, feedback y presupuesto de rendimiento.
- Selecciona propiedades según el significado: FLIP o View Transitions para continuidad; máscaras/`clip-path` para reveals acotados; `blur`, `filter`, canvas o shaders solo en regiones aisladas.
- Aplica `stagger` únicamente cuando un conjunto aparece como lista real y fija un tope de retardo total.
- Delega el desplazamiento de hover al elemento hijo para preservar estable la zona de puntero:
```css
.card:hover .card-surface {
  transform: translateY(-2px);
  transition: transform var(--duration-fast, 150ms) cubic-bezier(0.16, 1, 0.3, 1);
}
```
- Usa `@starting-style` para entradas CSS declarativas de `<dialog>`, popovers y elementos recién montados sin JavaScript.
- Envuelve animaciones CSS Scroll-driven en `@supports (animation-timeline: view())` con fallback estable.

### 3.2 GSAP por plataforma

#### Astro, Vanilla, Vue y Svelte
- Crea tweens y `ScrollTrigger` únicamente tras estar listo el DOM (`DOMContentLoaded`, `astro:page-load`, `onMounted` en Vue o `onMount` en Svelte).
- Envuelve la inicialización en `gsap.context(fn, rootEl)` y ejecuta `ctx.revert()` al desmontar (`astro:before-swap`, `onUnmounted` o función de retorno de `onMount`).
- Haz lazy-load dinámico (`import("gsap/SplitText")`, `import("gsap/MorphSVGPlugin")`) de plugins pesados usados solo en rutas o secciones puntuales.
- Llama `ScrollTrigger.refresh()` tras actualizaciones reactivas de DOM (`nextTick` en Vue, `tick` en Svelte o carga asíncrona).

#### React y Next.js
- Instala `@gsap/react`, registra `gsap.registerPlugin(useGSAP)` una sola vez a nivel de aplicación y usa `useGSAP()` en lugar de `useEffect()`.
- Pasa `scope: containerRef` y usa `refs` para targets en vez de selectores globales.
- Activa `revertOnUpdate: true` cuando las animaciones dependan de props o estado en `dependencies`.
- Envuelve con `contextSafe()` cualquier tween creado en handlers de eventos posteriores al montaje y remueve los listeners manuales en el cleanup:
```tsx
useGSAP((_ctx, contextSafe) => {
  const mm = gsap.matchMedia();
  mm.add(
    { reduce: "(prefers-reduced-motion: reduce)", motion: "(prefers-reduced-motion: no-preference)" },
    (c) => {
      const { reduce } = c.conditions!;
      gsap.from(".item", { autoAlpha: 0, y: reduce ? 0 : 24, stagger: reduce ? 0 : 0.04, duration: reduce ? 0.2 : 0.55 });
    },
    containerRef
  );
  const onClick = contextSafe!(() => gsap.to(".panel", { x: 0, duration: 0.25 }));
  btnRef.current?.addEventListener("click", onClick);
  return () => btnRef.current?.removeEventListener("click", onClick);
}, { scope: containerRef, dependencies: [open], revertOnUpdate: true });
```

#### WordPress
- Encola GSAP y sus plugins condicionalmente solo en las vistas que los requieren o decláralos mediante `viewScript`/`viewScriptModule` en bloques.
- Inicializa cada bloque o sección tras DOM ready pasando el nodo raíz del bloque como `scope` en `gsap.context()` para soportar múltiples instancias en la misma página.
- Ejecuta `ctx.revert()` antes de destruir o reemplazar nodos en vistas dinámicas.

### 3.3 Core, Timelines, ScrollTrigger, Plugins y Utilidades GSAP

#### Core y rendimiento
- Usa propiedades en `camelCase` y alias de transform (`x`, `y`, `xPercent`, `yPercent`, `scale`, `rotation`) en lugar de cadenas `transform`.
- Usa `autoAlpha` en vez de `opacity` cuando el elemento oculto deba quedar con `visibility: hidden` y sin capturar eventos de puntero.
- Configura `immediateRender: false` en tweens `from()` o `fromTo()` encadenados sobre la misma propiedad del mismo elemento.
- Usa `clearProps` al finalizar un tween cuando clases CSS deban retomar el control de estilos.
- Usa `gsap.quickTo()` para propiedades actualizadas a alta frecuencia como seguidores de cursor.
- Usa `stagger` en lugar de múltiples tweens con `delay` manual y virtualiza o anima solo elementos visibles en listas largas.
- Elige `svgOrigin` o `transformOrigin` sobre un elemento SVG, nunca ambos a la vez.

#### Timelines
- Secuencia pasos múltiples con `gsap.timeline({ defaults: { duration, ease } })` en lugar de encadenar `delay`.
- Usa el parámetro de posición (`"<"`, `">"`, `"+=0.2"`, `"-=0.1"`) y etiquetas `addLabel()` para coordinar pasos legibles.
- Almacena la instancia del tween o timeline cuando necesites controlar reproducción (`play`, `pause`, `reverse`, `kill`).

#### ScrollTrigger
- Adjunta `scrollTrigger` únicamente en tweens o timelines de nivel superior, nunca en tweens hijos de una timeline.
- Elige `scrub` para progreso ligado al scroll o `toggleActions` para disparos discretos, nunca ambos en el mismo trigger.
- Anima los elementos hijos cuando configures `pin: true`; nunca animes el propio elemento fijado.
- Configura `ease: "none"` en la animación horizontal que alimenta `containerAnimation`.
- Crea las instancias de `ScrollTrigger` en orden de aparición de arriba hacia abajo o asigna `refreshPriority` explícito en cargas asíncronas.
- Llama `ScrollTrigger.refresh()` tras cambios de DOM, carga de fuentes o inyección de contenido dinámico.
- Usa `ScrollTrigger.batch()` para animar por lotes elementos de cuadrículas o listas que entran juntos al viewport.

#### Plugins y utilidades
- Usa `Flip.getState()` → mutación de DOM → `Flip.from()` para transiciones complejas de layout.
- Inicializa `SplitText` tras `document.fonts.ready` o con `autoSplit: true` retornando la animación desde `onSplit()`, dividiendo solo las unidades animadas.
- Mantén `aria: "auto"` en `SplitText` (o `aria: "none"` con duplicado accesible si hay enlaces anidados) y revierte la instancia en el cleanup.
- Convierte primitivas SVG (`circle`, `rect`, `ellipse`, `line`) con `MorphSVGPlugin.convertToPath()` antes de hacer morph y ajusta `shapeIndex` si el trazo se cruza o invierte.
- Usa `gsap.utils` (`clamp`, `mapRange`, `normalize`, `interpolate`, `snap`, `wrap`, `pipe`, `toArray`) omitiendo el último argumento para obtener funciones curried reutilizables en callbacks.
- Pasa `true` como último argumento en `gsap.utils.random(min, max, snap, true)` cuando necesites una función generadora reutilizable.

## 4. Antipatrones

- Prohibido usar `ease-in` en transiciones de UI interactiva.
- Prohibido escalar desde `scale(0)` al mostrar elementos UI.
- Prohibido usar `transition: all` en CSS.
- Prohibido aplicar curvas `bounce` o `elastic` por reflejo en interfaces estándar.
- Prohibido animar acciones de alta frecuencia (`100+/día`) o atajos de teclado.
- Prohibido animar el contenedor objetivo en `:hover` provocando flicker en el borde del puntero.
- Prohibido ocultar contenido por defecto en CSS dependiendo de JavaScript para revelarlo.
- Prohibido animar propiedades de layout (`width`, `height`, `top`, `left`, `margin`, `padding`) o animar `box-shadow`/`filter` de forma continua.
- Prohibido dejar `will-change` fijo de forma permanente en CSS sobre múltiples elementos.
- Prohibido llamar `ScrollTrigger.getAll().forEach(t => t.kill())` al desmontar un componente individual.
- Prohibido anidar `gsap.context()` dentro de `gsap.matchMedia()`.
- Prohibido omitir `scope` en `gsap.context()` o `useGSAP()` dejando selectores globales.
- Prohibido adjuntar `ScrollTrigger` a tweens hijos dentro de una `timeline` o combinar `scrub` y `toggleActions` en el mismo trigger.
- Prohibido animar directamente un elemento con `pin: true` o usar un `ease` distinto de `"none"` en `containerAnimation`.
- Prohibido mezclar `svgOrigin` y `transformOrigin` en el mismo elemento SVG.
- Prohibido ejecutar `gsap.*` en SSR, registrar plugins dentro de renders repetitivos o desplegar `GSDevTools`, `MotionPathHelper` o `markers: true` a producción.

## 5. Checklist de validación

- [ ] Estrategia Web Platform First aplicada: CSS/WAAPI cubre estados declarativos y GSAP solo timelines complejas, FLIP, SVG o coreografía de scroll.
- [ ] Duraciones dentro de la escala (`100–150ms`, `150–300ms`, `300–500ms`, `500–800ms`), salidas 60–70% más rápidas y `0ms` en teclado/alta frecuencia.
- [ ] Curvas con desaceleración natural `cubic-bezier(0.16, 1, 0.3, 1)`, sin `ease-in`, `scale(0)`, `transition: all` ni `bounce`/`elastic` por reflejo.
- [ ] Densidad acorde al modo (`Persuade`/`Experience` con 1 secuencia focal y stagger `30–50ms` solo en listas; `Operate`/`Read` sin coreografía de carga).
- [ ] Contenido visible por defecto sin JS, hover sin flicker (hijo animado) e interacciones 100% interrumpibles.
- [ ] Solo `transform` y `opacity` animados, `will-change` temporal/medido, bucles pausados offscreen y scroll nativo/teclado preservados.
- [ ] `prefers-reduced-motion: reduce` verificado: sin movimiento espacial ni parallax, preservando fades, color y estado.
- [ ] En GSAP: `npm install gsap`, `registerPlugin()` único a nivel app, `scope` en selectores, cleanup acotado (`ctx.revert()`/`useGSAP()`/`mm.revert()`) y cero ejecución SSR.
- [ ] En `ScrollTrigger`/`SplitText`/`MorphSVG`: triggers solo top-level, sin `pin` animado, `refresh()` tras cambios de DOM, `autoSplit`/`fonts.ready` con `aria`, `convertToPath()` y cero `GSDevTools`/`MotionPathHelper`/`markers: true`.
- [ ] Feel-check realizado en cámara lenta y dispositivo real validando curvas, origen y gestos.
