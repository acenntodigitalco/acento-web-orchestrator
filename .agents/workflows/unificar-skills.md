---
description: Audita la colección de skills, genera la matriz de coincidencias (Fase 1) y, solo tras aprobación, crea las master skills (Fase 2).
---

# /unificar-skills

Actúa como Arquitecto de Agentes IA y Desarrollador Web Senior en UX/UI, WordPress personalizado, WooCommerce y Astro. Trabaja en 2 fases con una pausa obligatoria entre ambas.

## Reglas estrictas
- Los archivos originales no se editan, renombran, mueven ni borran. Toda salida va a carpetas nuevas.
- Al terminar la Fase 1, DETENTE y espera mi aprobación. No empieces la Fase 2 por tu cuenta.

## Paso 0. Datos de entrada
La raíz del workspace es `./`. Aquí viven el orquestador y las skills originales, cada skill en su propia subcarpeta.

**Carpetas reservadas del orquestador (NO son skills, no las audites):** `.agents`, `_templates`, `_prompts`, `_auditoria`, `master-skills`.

**Skills originales:** todas las demás subcarpetas de la raíz. Si no te dije otra ruta, usa esas. Pregunta también si quiero solo las 4 categorías base o también las opcionales.

**Salidas** (siempre dentro de la raíz, nunca dentro de una carpeta de skill original):
- `_auditoria\inventario-skills.md`
- `_auditoria\matriz-auditoria-skills.md`
- `_auditoria\trazabilidad\<master>.md`
- `master-skills\<master>\SKILL.md`

La carpeta superior `../` contiene otros proyectos ya existentes. Nunca leas, edites ni borres nada fuera de `frontend\`, salvo que un workflow lo pida expresamente.

Ignora todo lo que no sea una skill: `node_modules`, `.git`, imágenes sueltas, archivos de proyectos, zips y carpetas sin `SKILL.md` ni instrucciones. Lístalos al final en "Sin categoría / Revisar" en vez de leerlos.

Categorías base: `UX/UI`, `WordPress`, `WooCommerce`, `Astro`.
Categorías opcionales (según lo que responda): `SEO técnico`, `Copywriting`, `Animaciones`, `Dashboard`.

## FASE 1. Auditoría y matriz de coincidencias

1. Recorre la ruta de skills carpeta por carpeta, una a una, y haz el inventario de archivos (SKILL.md y archivos de apoyo). Guarda `_auditoria\inventario-skills.md` con una fila por skill: carpeta, nombre, descripción en una línea, tamaño aproximado.
2. Clasifica cada skill en una categoría y agrega la columna "categoría" al inventario. Lo que no encaje va a la sección "Sin categoría / Revisar".
3. Lanza un `auditor-skills` por categoría, **en paralelo**, pasándole las rutas de esa categoría. Si una categoría tiene más de 12 skills, divídela en lotes y pide a un último auditor que compare los lotes entre sí.
4. Con los informes de los auditores, escribe `_auditoria\matriz-auditoria-skills.md` con estas secciones:
   - Resumen ejecutivo y métricas por categoría (reglas totales, % duplicado, conflictos, únicas).
   - **Tabla de coincidencias** por categoría: qué reglas se repiten, en qué skills y cuál es la redacción exacta duplicada.
   - **Conflictos detectados**: postura A contra postura B, con tu recomendación técnica y cuál conservar. Enumera los conflictos (C1, C2, ...) para que pueda responder por número.
   - **Reglas únicas de alto valor** por categoría, con su skill de origen.
   - **Sin categoría / Revisar**.
5. Preséntame en el chat un resumen ejecutivo de máximo 15 líneas: cuántas skills, qué categorías son las más redundantes, la lista numerada de conflictos con tu recomendación y cualquier archivo ambiguo.
6. **DETENTE.** Termina con esta frase: "Fase 1 lista. Dime qué apruebas o qué ajustas de los conflictos (C1, C2...) y arranco la Fase 2."

## FASE 2. Master skills (solo tras mi aprobación explícita)

1. Aplica mis ajustes a la matriz y deja constancia de la decisión final de cada conflicto.
2. Crea la carpeta `master-skills/` con una subcarpeta y un `SKILL.md` por categoría aprobada: `master-ux-ui`, `master-wp-custom`, `master-woocommerce`, `master-astro-dev` (y las opcionales que haya aceptado).
3. Lanza un `consolidador-skills` por master skill, **en paralelo**, pasándole la sección aprobada de la matriz.
4. Guarda cada resultado en `master-skills/<nombre>/SKILL.md` y su trazabilidad en `_auditoria/trazabilidad/<nombre>.md` (fuera de la carpeta de la skill para no gastar contexto).
5. Cada `SKILL.md` lleva: bloque YAML con `name` y `description` (cuándo activarse) y las secciones 1. Rol y alcance, 2. Reglas obligatorias, 3. Mejores prácticas y arquitectura, 4. Antipatrones, 5. Checklist de validación.
6. Verifica: cada master skill tiene el YAML correcto, no pasa de unas 350 líneas, no contiene reglas contradictorias y no repite reglas de otra master. Si dos masters comparten una regla, déjala solo en la más específica.
7. Entrégame un resumen: archivos creados, tamaño de cada uno, reglas rescatadas y reglas descartadas con motivo.
