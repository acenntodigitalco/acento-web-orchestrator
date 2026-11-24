---
name: master-astro-dev
description: >
  Desarrolla, configura, integra y migra sitios web con Astro 5/6, TypeScript estricto, Content Layer API, Tailwind v4 o CSS scoped e islas con cero JS por defecto.
  Activar al trabajar con archivos `.astro`, `astro.config.*`, colecciones de contenido, adaptadores SSR/SSG (Node, Vercel, Netlify, Cloudflare) o frontends Headless WP en Astro.
  Disparadores típicos: "crear componente Astro", "configurar colección de contenido", "añadir integración o adaptador", "instalar Tailwind v4 en Astro", "migrar a Astro 6".
---

# Master Astro Dev

## 1. Rol y alcance

- Aplica esta skill en todo proyecto Astro 5/6 y en frontends Astro conectados a Headless WordPress.
- Prioriza arquitectura Web Platform First y cero JavaScript en cliente por defecto.
- Delega reglas generales WCAG y tokens de diseño a `master-ux-ui`, Schema.org y métricas CWV a `master-seo-tecnico`, y animaciones complejas o GSAP a `master-animaciones`.

## 2. Reglas obligatorias

### Entorno, configuración y rendering

- Verifica Node `22.12.0` o superior en local y en despliegue antes de depurar fallos en Astro 6.
- Configura `site` con la URL final de producción en `astro.config.{ts,mjs,js,cjs}` para generar sitemaps y URLs canónicas.
- Mantén `astro.config.*` en la raíz del proyecto (`./`) salvo que indiques una ruta explícita con `--config`.
- Mantén `output: 'static'` por defecto para generación estática.
- Añade un adaptador oficial (`node`, `cloudflare`, `netlify`, `vercel`) para habilitar renderizado on-demand por ruta con `export const prerender = false`.
- Configura `output: 'server'` únicamente cuando el sitio sea mayoritariamente dinámico y requiera ejecución por request.

### Componentes `.astro`, TypeScript, estilos e islas

- Construye toda UI estática o mayoritariamente estática con componentes `.astro`.
- Define `interface Props` tipada con valores por defecto sensatos en todo componente `.astro`.
- Restringe `Props` a parámetros que alteren el renderizado de forma real y acuerda `<slot />` o slots nombrados antes de generar el componente.
- Usa `class:list` para clases condicionales en `.astro`.
- Usa elementos HTML semánticos nativos (`header`, `nav`, `main`, `article`, `section`, `footer` y jerarquía lógica de encabezados) en lugar de `<div>` genéricos en `.astro`.
- Aplica `<style>` scoped por defecto y CSS custom properties para tokens reutilizables.
- Configura Tailwind v4 mediante `@tailwindcss/vite` e importa `@import "tailwindcss";` desde un layout o entrypoint compartido, sin `tailwind.config.*`.
- Hidrata únicamente islas hoja pequeñas con framework UI cuando exista estado local o interactividad real en cliente.
- Selecciona la directiva de hidratación más ligera válida: `client:visible` para UI diferida, `client:idle` para mejoras no críticas, `client:load` solo para interactividad crítica inmediata y `client:only` solo al omitir SSR intencionalmente.
- Procesa imágenes con `astro:assets` declarando dimensiones explícitas o contenedores estables para evitar CLS.
- Reserva `public/` exclusivamente para assets sin procesar (fuentes, favicons y archivos estáticos copiados tal cual).

### Content Layer API

- Define colecciones de tiempo de build en `src/content.config.{ts,js,mjs}`.
- Define colecciones en `src/live.config.*` únicamente cuando los datos requieran frescura por request.
- Declara un `loader` explícito en cada colección (`glob()` para directorios en la ubicación elegida o `file()` para un archivo único de datos).
- Importa `z` desde `astro/zod` para definir esquemas estrictos.
- Usa `schema: ({ image }) => ...` para validar imágenes, `z.coerce.date()` para fechas, `z.enum(...)` para valores acotados y `reference('<coleccion>')` para relaciones entre colecciones.
- Usa `entry.id` como identificador en URLs y consultas; emplea `entry.filePath` solo cuando necesites la ruta física de origen.
- Consulta colecciones con `getCollection()` (con filtro para borradores/publicados), `getEntry()` para una entrada conocida y `getEntries()` para arreglos de referencias.
- Genera rutas dinámicas en `getStaticPaths()` a partir de `entry.id`, pasa la entrada en `props` y renderiza el cuerpo con `render(entry)`.
- Ejecuta `npx astro sync` tras crear o modificar colecciones o integraciones y valida al menos una entrada real por colección.
- Corrige los datos o el esquema ante fallos de validación; nunca debilites tipos para ocultar datos rotos.

```ts
import { defineCollection, reference } from 'astro:content';
import { glob } from 'astro/loaders';
import { z } from 'astro/zod';
const blog = defineCollection({
  loader: glob({ base: './src/data/blog', pattern: '**/*.{md,mdx}' }),
  schema: ({ image }) => z.object({
    title: z.string(),
    publishDate: z.coerce.date(),
    author: reference('authors'),
    cover: image().optional(),
  }),
});
export const collections = { blog };
```

```astro
---
import { getCollection, render } from 'astro:content';
export async function getStaticPaths() {
  const posts = await getCollection('blog', ({ data }) => !data.draft);
  return posts.map((post) => ({ params: { slug: post.id }, props: { post } }));
}
const { post } = Astro.props;
const { Content } = await render(post);
---
<article><h1>{post.data.title}</h1><Content /></article>
```

### Integraciones, protocolo documental y verificación

- Clasifica cada integración antes de instalarla (framework UI, estilos, adaptador, contenido o utilidades) para evaluar su impacto en rendering, hidratación y build.
- Instala integraciones y adaptadores oficiales con `npx astro add <nombre> --yes` y revisa manualmente `astro.config.*` tras la instalación.
- Instala integraciones comunitarias con el gestor de paquetes del proyecto y regístralas manualmente en `astro.config.*`.
- Preserva el orden existente en el array `integrations` salvo que la documentación oficial exija una secuencia específica.
- Actualiza Astro junto con todas sus integraciones y adaptadores oficiales en la misma operación.
- Consulta `docs.astro.build` (o `docs.astro.build/llms.txt` / MCP oficial de Astro) para APIs, configuración, integraciones y cambios sensibles a versión; nunca adivines comportamientos no verificados.
- Declara explícitamente cualquier comportamiento que no pueda confirmarse en la documentación oficial vigente.
- Valida todo cambio ejecutando `npx astro check`, `npx astro build` y confirmando que `dist/` exista y no esté vacío antes de desplegar.

## 3. Mejores prácticas y arquitectura

### Estructura, flujo de datos y configuración

- Mantén la estructura estándar: `src/pages/` (obligatorio para rutas), `src/components/`, `src/layouts/`, `src/styles/`, `src/assets/` y `public/`.
- Elige la primitiva más simple antes de crear archivos: componente reutilizable en `src/components/`, ruta en `src/pages/`, envoltorio compartido en `src/layouts/` o isla solo si hay interactividad real.
- Obtén datos del lado del servidor en el frontmatter de Astro salvo motivo justificado.
- Mantén el flujo de datos cerca de la página o componente dueño y conserva imports relativos legibles.
- Modela los esquemas de colección según las consultas reales del sitio y evita dispersar contenido de una misma colección en carpetas de rutas.
- Separa la generación de rutas en `getStaticPaths()` de la lógica de renderizado de la entrada.
- Completa la configuración periférica tras añadir una integración: imports de hojas de estilo, variables de entorno, requisitos del adaptador y ajustes del host de despliegue.
- Acota las búsquedas en `docs.astro.build` al paquete oficial, clave de configuración, guía de upgrade o mensaje de error exacto.

### Migraciones y upgrade a Astro 6

- Inventaria antes de migrar: rutas, layouts, fuentes de datos, estilos, componentes interactivos, manejo de imágenes y requisitos de runtime/despliegue.
- Planifica migraciones incrementales mapeando conceptos a primitivas de Astro: app shell a layout, vista a página o ruta dinámica, contenido markdown a colección, widget interactivo a isla hoja y helper de imagen a `astro:assets`.
- Ejecuta `npx @astrojs/upgrade` apoyándote en la guía oficial para subir versiones mayores de Astro.
- Aplica el checklist de breaking changes de Astro 6 al actualizar:
  - Verifica Node `22.12.0+` en local y en despliegue.
  - Migra `src/content/config.*` a `src/content.config.*`, define `loader` en cada colección y elimina `type` y `legacy.collections`.
  - Cambia `z` de `astro:content` a `astro/zod`, `entry.slug` a `entry.id`, `entry.render()` a `render(entry)` y `getEntryBySlug()`/`getDataEntryById()` a `getEntry()`.
  - Reemplaza `Astro.glob()` por `import.meta.glob()` o `getCollection()`.
  - Reemplaza `<ViewTransitions />` por `<ClientRouter />`.
  - Elimina `Astro.generator` y reemplaza `Astro.site` por `import.meta.env.SITE` dentro de `getStaticPaths()`.
  - Revisa esquemas Zod personalizados por compatibilidad con Zod 4.
- Verifica tras migrar: paridad de rutas, metadatos/`<head>`, renderizado de imágenes, formularios, navegación por teclado, build/preview y requisitos del entorno de despliegue.

## 4. Antipatrones

- No uses componentes de React, Vue, Svelte u otro framework para UI estática resoluble en `.astro`.
- No hidrates layouts completos ni secciones amplias cuando baste una isla hoja.
- No uses `client:load` por defecto donde `client:visible` o `client:idle` cubran la interacción.
- No actives `output: 'server'` cuando el sitio pueda generarse de forma estática o con rutas on-demand puntuales.
- No declares colecciones con `type: 'content'`, `type: 'data'`, `src/content/config.*` ni `legacy.collections`.
- No importes `z` desde `astro:content` ni uses `entry.slug`, `entry.render()`, `getEntryBySlug()` o `getDataEntryById()`.
- No debilites esquemas Zod ni uses `any` para ocultar datos rotos.
- No omitas `interface Props` ni sustituyas elementos semánticos por `<div>` genéricos en `.astro`.
- No crees `tailwind.config.*` en proyectos con Tailwind v4 ni dejes hojas de estilo instaladas sin importar.
- No coloques imágenes que requieran optimización en `public/`.
- No instales integraciones sin registrarlas en `astro.config.*` ni actualices Astro dejando integraciones oficiales desfasadas.
- No portes una SPA entera sin adaptar ni inventes carpetas fuera de la estructura estándar sin justificación.
- No te bases en blogs o snippets antiguos para sintaxis sensible a versión ni adivines APIs sin verificar en `docs.astro.build`.

## 5. Checklist de validación

- [ ] Node `22.12.0+` confirmado en local y despliegue (Astro 6).
- [ ] `site` configurado en `astro.config.*` y `output` coherente con el adaptador y el tipo de sitio.
- [ ] UI estática escrita en `.astro` con `interface Props` tipada, HTML semántico y `<style>` scoped o Tailwind v4 (`@tailwindcss/vite` + `@import "tailwindcss";`).
- [ ] Islas acotadas a componentes hoja con la directiva `client:*` más ligera y sin errores de hidratación.
- [ ] Imágenes optimizadas mediante `astro:assets` con dimensiones explícitas; `public/` solo para assets sin procesar.
- [ ] Colecciones en `src/content.config.*` con `loader`, `z` desde `astro/zod`, `entry.id`, `render(entry)` y al menos una entrada real validada.
- [ ] Integraciones registradas en `astro.config.*` preservando el orden de `integrations`, con estilos, entorno y runtime alineados.
- [ ] `npx astro sync` ejecutado tras cambios en colecciones o integraciones, sin advertencias de loaders o imports deprecados.
- [ ] `npx astro check` y `npx astro build` ejecutados sin errores de tipos ni configuración.
- [ ] Directorio `dist/` verificado existente y no vacío antes de desplegar.
- [ ] En migraciones: paridad comprobada en rutas, metadatos/`<head>`, imágenes, formularios, navegación por teclado y preview.
