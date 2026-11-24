# Prompt: unificar skills (versión autónoma)

Úsalo pegado en una sesión de Antigravity (o en cualquier chat con acceso a tus archivos) si todavía no instalaste el workflow `/unificar-skills`. Reemplaza `[RUTA_DE_TUS_SKILLS]` antes de enviarlo.

---

Actúa como un Arquitecto de Agentes IA y Desarrollador Web Senior especializado en diseño UX/UI, WordPress personalizado, WooCommerce y Astro Framework.

Tu objetivo es auditar, depurar y consolidar la colección de skills ubicada en: `[RUTA_DE_TUS_SKILLS]`

### REGLAS ESTRICTAS
- NO edites, renombres, muevas ni elimines ninguno de los archivos originales. Todo lo que generes va en carpetas nuevas.
- Trabaja en **2 fases**. Al terminar la Fase 1, **DETENTE** y espera mi aprobación antes de ejecutar la Fase 2.
- Si `[RUTA_DE_TUS_SKILLS]` también contiene archivos del orquestador, ignora las carpetas `.agents`, `_templates`, `_prompts`, `_auditoria` y `master-skills`: no son skills. No leas ni modifiques nada fuera de la raíz de trabajo (hay otros proyectos en la carpeta superior).
- No inventes reglas. Toda regla que escribas debe poder rastrearse a un archivo original.
- Si puedes delegar en subagentes, lanza uno por categoría en paralelo para auditar y no saturar tu contexto.

### CATEGORÍAS
Base: **UX/UI**, **WordPress**, **WooCommerce**, **Astro**.
Opcionales (borra las que no quieras): **SEO técnico**, **Copywriting**, **Animaciones**, **Dashboard**.
Lo que no encaje en ninguna va a una sección "Sin categoría / Revisar".

---

### FASE 1: Auditoría y matriz de coincidencias
1. Recorre `[RUTA_DE_TUS_SKILLS]` carpeta por carpeta, una a una, e ignora lo que no sea una skill (node_modules, .git, imágenes, zips, archivos de otros proyectos). Lee cada skill completa, incluidos sus archivos de apoyo, y guarda `_auditoria/inventario-skills.md` con una fila por skill: carpeta, descripción en una línea, categoría.
2. Descompón cada skill en reglas atómicas (una instrucción verificable por regla) y clasifícalas por categoría. Compara por significado, no por redacción.
3. Crea `_auditoria/matriz-auditoria-skills.md` con:
   - **Métricas por categoría**: skills, reglas totales, porcentaje duplicado, conflictos, reglas únicas.
   - **Tabla de coincidencias**: regla normalizada, skills donde aparece (rutas) y la redacción duplicada más clara.
   - **Conflictos detectados**, numerados (C1, C2...): postura A contra postura B con su skill de origen, tu recomendación técnica y cuál conservar.
   - **Reglas únicas de alto valor**: regla, skill de origen y por qué vale la pena rescatarla.
   - **Sin categoría / Revisar**.
4. Preséntame en el chat un resumen ejecutivo (máximo 15 líneas) con la lista numerada de conflictos y tu recomendación, y **DETENTE**. Termina diciendo: "Fase 1 lista. Dime qué apruebas o qué ajustas y arranco la Fase 2."

---

### FASE 2: Creación de las Master Skills (solo tras mi aprobación explícita)
1. Aplica mis ajustes y deja registrada la decisión final de cada conflicto.
2. Crea la carpeta `/master-skills/` con una subcarpeta y `SKILL.md` por categoría: `master-ux-ui`, `master-wp-custom`, `master-woocommerce`, `master-astro-dev` (más las opcionales aprobadas).

**Requisitos de cada master skill:**
- Bloque YAML inicial con `name` y `description`. La descripción dice qué hace y **cuándo activarse**, con disparadores concretos (tecnologías, tareas, frases típicas).
- Fusiona únicamente las reglas únicas y mejores prácticas aprobadas en la Fase 1.
- Sin relleno, frases repetitivas ni contradicciones. Si dos masters comparten una regla, déjala solo en la más específica.
- Máximo unas 350 líneas. El detalle largo (tablas, ejemplos extensos) va en `references/<tema>.md` dentro de la misma carpeta, para cargar solo cuando se necesite.
- Estructura escaneable con estas secciones:
  1. **Rol y alcance**
  2. **Reglas obligatorias** (estándares no negociables)
  3. **Mejores prácticas y arquitectura**
  4. **Antipatrones** (qué evitar siempre)
  5. **Checklist de validación** (verificación rápida antes de entregar código o diseño)
3. Guarda la trazabilidad (regla → skills de origen) en `_auditoria/trazabilidad/<nombre>.md`, fuera de la carpeta de cada skill.
4. Al final entrégame: archivos creados, tamaño de cada uno, reglas rescatadas y reglas descartadas con su motivo.

Comienza ahora con la Fase 1.
