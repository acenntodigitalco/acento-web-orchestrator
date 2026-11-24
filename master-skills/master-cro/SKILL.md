---
name: master-cro
description: Optimiza la conversión en sitios web, landing pages, formularios, páginas de precios, popups, lead magnets y experimentos A/B con rigor estadístico. Actívala cuando el usuario pida mejorar tasas de conversión, auditar por qué una página o formulario no convierte, trabajar objeciones y ofertas honestas, diseñar páginas de pricing legibles por humanos y agentes IA, configurar captura no intrusiva o planificar y evaluar tests A/B.
---

# Master CRO — Optimización de Conversión y Experimentación

## 1. Rol y alcance

- Optimiza la arquitectura de conversión, formularios, manejo de objeciones, ofertas honestas, páginas de precios, captura de leads y experimentación A/B en páginas web y landing pages.
- Aplica heurísticas probadas de CRO en lanzamientos iniciales sin tráfico y exige experimentación basada en datos en iteraciones post-lanzamiento con tráfico suficiente.
- Delega la instrumentación de GA4, GTM, píxeles, CAPI, Consent Mode y `dataLayer` a `master-tracking`.
- Delega la voz de marca, redacción extensa y edición anti-IA a `master-copywriting`.
- Coordina el marcado estructurado `Product`/`Offer` JSON-LD y los permisos de crawlers de búsqueda IA con `master-seo-tecnico`.
- Excluye de esta skill los `paywalls` in-app SaaS, la consultoría de fijación de precios o empaquetado comercial y la distribución orgánica en redes sociales.

## 2. Reglas obligatorias

### 2.1 Arquitectura de conversión por página
- Comunica la propuesta de valor clara en menos de 5 segundos usando lenguaje del cliente y sin jerga interna.
- Asegura *message match* exacto entre el titular de llegada y el anuncio, enlace o correo de la fuente de tráfico.
- Define un único objetivo de conversión por página y muestra un único CTA principal visible *above-the-fold*.
- Redacta el CTA orientado a resultado con la fórmula `Acción + beneficio` (ej. "Solicitar demo", "Descargar guía"); evita textos genéricos ("Submit", "Sign Up", "Enviar", "Learn More").
- Establece jerarquía visual clara entre CTA primario y secundario y repite el CTA principal en los puntos clave de decisión.
- Coloca prueba social específica junto a los CTAs y puntos de fricción, nunca aislada solo al pie o dentro de FAQs.
- Muestra cifras exactas no redondeadas en prueba social (ej. "4.832 clientes" en lugar de "casi 5.000").
- Verifica que todo testimonio, caso de estudio, estadística o sello de confianza sea real y comprobable.
- Retira la navegación principal únicamente en landing pages de campañas pagadas (`noindex`), conservando siempre el footer legal mínimo; mantén la navegación completa en páginas orgánicas.

### 2.2 Objeciones, persuasión y ofertas honestas
- Investiga las objeciones reales (confianza, precio, encaje, momento y esfuerzo) mediante encuestas de salida de una sola pregunta, encuestas post-compra en `<7` días, tickets de soporte, chats y llamadas de ventas.
- Construye la Matriz O/CO (Objeción → Contra-objeción con prueba) ubicando las objeciones primarias *above-the-fold* y las secundarias en el punto exacto donde surgen.
- Aplica la técnica *CO Only* en objeciones implícitas: resuelve la duda con evidencia o claridad operativa sin enunciar la objeción en negativo.
- Estructura las afirmaciones clave con *Proof Sandwich*: `Promesa concreta → Prueba verificable → Refuerzo secundario`.
- Usa escasez o urgencia solo cuando exista una restricción real y verificable (capacidad, cohorte, inventario, fecha real de vencimiento de bono o cambio de precio) y hazla cumplir al llegar al límite.
- Prohíbe contadores que se reinician por sesión, cupos inventados ("solo 3 lugares") y FOMO simulado.
- Redacta ofertas con vocabulario anti-humo verificable; prohíbe superlativos vacíos ("game-changing", "revolucionario", "10x", "secreto", "valorado en $X" sin comparable, "100% garantizado" sin condiciones).
- Presenta garantías claras junto al CTA con un máximo de 2–3 condiciones verificables acordes al modelo de negocio; prioriza prueba sólida antes que depender de la garantía.
- Restringe descuentos de adquisición en popups exclusivamente a e-commerce B2C bajo decisión comercial explícita; en servicios, B2B y SaaS ofrece valor o *lead magnet*.

### 2.3 Formularios de alta conversión
- Minimiza los campos al mínimo indispensable (3 campos como línea base; cada campo extra reduce la tasa de completación) y traslada calificación o enriquecimiento al post-envío.
- Usa layout de 1 sola columna; admite 2 columnas únicamente en desktop para pares cortos inseparables (ej. Nombre y Apellido).
- Mantén `<label>` siempre visible encima de cada campo; usa `placeholder` solo para ejemplos de formato y nunca como única etiqueta.
- Ordena los campos de menor a mayor fricción (fáciles primero como nombre y email; sensibles al final como teléfono o empresa) y deja teléfono y comentarios opcionales salvo necesidad justificada.
- Garantiza ergonomía móvil con tap targets `≥44px` de altura, teclados semánticos (`type="email"`, `type="tel"`, `inputmode="numeric"`) y atributos `autocomplete` para autofill.
- Usa radio buttons en lugar de desplegables `<select>` cuando existan menos de 5 opciones.
- Ejecuta validación *inline* en `on-blur` con mensajes específicos que indiquen cómo corregir, sin borrar jamás el contenido introducido ante un error.
- Mueve el foco al primer campo con error al enviar y preserva todos los valores completados.
- Convierte formularios de `>5–6` campos en flujos multi-paso con barra de progreso ("Paso X de Y"), un tema por paso, navegación atrás y persistencia local para no perder avances al recargar.
- Muestra estado de carga en el botón de envío para bloquear envíos duplicados y añade microcopy de confianza junto al CTA (privacidad, tiempo estimado de respuesta o "sin tarjeta").
- Protege el envío cuando dependa de APIs de enriquecimiento o enrutamiento CRM: guarda siempre toda entrega válida, impón un timeout estricto al lookup y proporciona un fallback inmediato útil si la consulta falla o expira.

### 2.4 Pricing Page UX y AI-Agent Readiness
- Presenta *above-the-fold* una comparativa clara de planes, el plan recomendado destacado, un toggle mensual/anual con ahorro visible y un CTA principal por plan.
- Indica explícitamente "para quién es" cada plan, mantén la decisión resoluble en `<30` segundos y acompaña los CTAs con señales de confianza, garantía y FAQ de compra (límites, cancelación, prueba y facturación).
- Renderiza precios, divisas, periodicidades, cuotas, límites e inclusiones de cada plan en texto HTML semántico seleccionable en la carga inicial, nunca dentro de imágenes, SVG, PDFs, muros de login ni solo como checkmarks (`✓`/`✗`).
- Publica precios reales o un precio "desde" / rango representativo; evita ocultar todos los planes bajo "Contactar ventas".
- Valida la página con el *"paste test"* (pasa la URL o el texto renderizado a un agente web y verifica que extrae planes, precios y límites sin omisiones) y enlaza con `master-seo-tecnico` para `Product`/`Offer` JSON-LD.

### 2.5 Popups, Lead Magnets y Thank You Page
- Prohíbe intersticiales *full-screen* en móvil (penalización SEO de Google) y disparadores por tiempo inferiores a 30 segundos.
- Prioriza disparadores no intrusivos: *click-triggered*, *slide-in* discreto en esquina o base móvil, profundidad de scroll (`25–50%` en contenido largo) o *exit-intent* en desktop.
- Aplica *frequency capping*: máximo 1 aparición por sesión, persiste el cierre en cookie/`localStorage` con *cool-down* de `7–30` días, excluye usuarios convertidos y bloquea popups en flujos de checkout o conversión críticos.
- Asegura cierre trivial y accesibilidad completa: botón `×` visible en esquina superior derecha (`≥44px`), cierre por clic externo y tecla `Esc`, navegación completa por teclado y *focus trap* mientras el modal esté abierto.
- Usa textos de rechazo neutros ("No, gracias", "Quizá luego") sin *confirmshaming*, no premarques casillas de consentimiento e incluye enlace visible a la política de privacidad.
- Diseña *lead magnets* que resuelvan un problema específico, consumibles en `<30` minutos (ideal `<10` min), con vista previa visual en su landing y captura mínima (email o email + nombre).
- Inserta *content upgrades* contextuales *inline* dentro de artículos de blog alineados con el tema exacto del contenido.
- Implementa entrega híbrida (acceso inmediato en *Thank You Page* + copia por correo) y optimiza la *Thank You Page* con confirmación de entrega y el siguiente paso del embudo (demo, prueba o recurso relacionado).

### 2.6 Experimentación y A/B testing riguroso (post-lanzamiento)
- Documenta una hipótesis verificable antes de cada experimento: `Porque [observación/dato], creemos que [cambio] causará [resultado esperado] en [audiencia], medido por [métrica primaria]`.
- Prioriza el backlog con `ICE = (Impact + Confidence + Ease) / 3` (escala `1–10` respaldada por datos, revisada periódicamente).
- Adapta el tamaño del cambio al volumen de tráfico: ejecuta cambios audaces de alto impacto en tráfico bajo/medio y aísla una sola variable significativa en sitios de alto tráfico; descarta micro-tests de color de botón.
- Pre-calcula el tamaño muestral antes de lanzar con tasa de conversión base real de la página, MDE (efecto mínimo detectable), `α = 0.05` bilateral y potencia `80%`, aplicando corrección por comparaciones múltiples (ej. Bonferroni) en `A/B/n`.
- Ejecuta cada experimento al menos 1 semana completa (1–2 ciclos de negocio incluyendo días laborables y fin de semana) y evita superar 4–8 semanas.
- Prohíbe el *peeking* (detener antes de completar la muestra planificada), modificar variantes en curso o inyectar nuevas fuentes de tráfico durante el test.
- Define siempre 1 métrica primaria, métricas secundarias de contexto y métricas *guardrail*; detén antes de tiempo solo si los *guardrails* empeoran significativamente.
- Reporta tamaño de efecto, intervalo de confianza (IC 95%) y p-value según los criterios de la ASA; nunca interpretes el p-value como probabilidad de azar o de veracidad de la hipótesis nula, ni extiendas un test concluido buscando significancia.
- Usa *Triggered Analysis* para elementos *opt-in* (videos, calculadoras, widgets): registra el mismo punto de exposición en ambos brazos y compara solo usuarios expuestos, nunca filtrando por clics alterados por la variante.
- Prefiere implementación *server-side* o en el *edge* para evitar *flicker* visual, proteger Core Web Vitals y mantener asignación consistente por usuario recurrente.
- Aplica alternativas válidas si el tráfico no alcanza muestra en `<60` días: subir el MDE con cambios más audaces, probar más arriba en el embudo, reducir a 2 variantes, agrupar páginas equivalentes o decidir mediante investigación cualitativa.
- Documenta cada experimento —ganador, perdedor o inconcluso— en un playbook reutilizable (hipótesis, muestra, efecto, IC 95%, p-value, guardrails, aprendizajes y dónde escalar).

## 3. Mejores prácticas y arquitectura

### 3.1 Patrones por tipo de página
- **Homepage:** posiciona el valor para tráfico frío y separa la ruta de quien está listo para comprar de quien investiga.
- **Landing page:** concentra el argumento completo en una sola página con *message match*, contra-objeciones y un único CTA repetido.
- **Pricing page:** usa anclaje visual destacando el plan intermedio recomendado, indica el ahorro anual y detalla cada plan en texto seleccionable.
- **Feature page:** conecta cada funcionalidad con un beneficio medible, casos de uso reales y acceso directo a prueba o compra.
- **Blog:** ubica CTAs contextuales y *content upgrades* *inline* en pausas naturales de lectura y al final del artículo.

### 3.2 Jerarquía de prueba social (mayor a menor impacto)
1. Resultados específicos con contexto y cifras exactas verificables.
2. Testimonios atribuidos con nombre, cargo/empresa, foto y resultado concreto.
3. Casos de estudio con situación inicial, intervención y resultado medible.
4. Estadísticas exactas, credenciales verificables y menciones de autoridad.
5. Logos reconocibles de clientes, sellos de seguridad y certificaciones.

### 3.3 Referencia rápida de muestra por variante (`α = 0.05` bilateral, potencia `80%`)
| Tasa base | Lift relativo 10% | Lift relativo 20% | Lift relativo 50% |
|---|---:|---:|---:|
| 1% | 160.000 | 43.000 | 7.700 |
| 3% | 53.000 | 14.000 | 2.500 |
| 5% | 31.000 | 8.200 | 1.500 |
| 10% | 15.000 | 3.800 | 690 |

- Estima duración con `Días = (Muestra por variante × N.º variantes) / (Tráfico diario elegible × % exposición)` (o el brazo más lento en asignaciones desiguales) respetando el mínimo de 1 semana completa.

### 3.4 Diagnóstico de embudo y escalado
- Mapea el embudo completo para priorizar "arterias bloqueadas" (alto tráfico con baja conversión) y "eslabones faltantes" antes de retocar páginas secundarias.
- Inventaria los 5 bloques de persuasión (credenciales/autoridad, prueba social, reversión de riesgo, datos específicos, proceso/metodología) y adquiere activamente los activos ausentes.
- Escala los patrones ganadores del playbook hacia páginas hermanas, anuncios y correos del mismo embudo.

## 4. Antipatrones

- Usar textos de CTA genéricos ("Submit", "Sign Up", "Enviar", "Learn More") o mostrar varios CTAs competidores *above-the-fold*.
- Colocar `placeholder` como única etiqueta de un campo o borrar los datos escritos al fallar la validación.
- Presentar formularios de `>6` campos en un bloque único sin pasos progresivos ni justificación por campo.
- Bloquear un envío válido por timeout o caída de una API de enriquecimiento o enrutamiento CRM.
- Ocultar precios en imágenes, SVG, PDFs, detrás de login o bajo "Contactar ventas" en todos los planes.
- Diferenciar planes únicamente con checkmarks (`✓`/`✗`) sin explicar cuotas ni inclusiones en texto HTML.
- Mostrar popups *full-screen* en móvil, con delay `<30s` o durante procesos de checkout.
- Aplicar *confirmshaming* en el rechazo de popups o activar casillas de consentimiento premarcadas.
- Fabricar escasez o urgencia falsa (contadores que se reinician, cupos ficticios, FOMO simulado) o promesas de garantía insostenibles.
- Ofrecer cupones de descuento de adquisición por defecto en popups de servicios, B2B o SaaS.
- Copiar competidores o decidir por opinión jerárquica (HiPPO) sin investigar objeciones reales.
- Lanzar micro-tests de bajo impacto (ej. color de botón) desperdiciando muestra.
- Practicar *peeking*, alargar un test terminado buscando `p < 0.05`, declarar ganadores por segmentos *post-hoc* o filtrar elementos *opt-in* por clics en lugar de exposición.
- Usar A/B testing client-side con *flicker* perceptible cuando exista alternativa *server-side* o *edge*.

## 5. Checklist de validación

### Arquitectura, objeciones y ofertas
- [ ] La propuesta de valor se entiende en `<5` segundos y mantiene *message match* con la fuente de tráfico.
- [ ] Existe un único CTA principal *above-the-fold* con estructura `Acción + beneficio`.
- [ ] Las objeciones investigadas (Matriz O/CO) se resuelven junto a cada punto de fricción y las implícitas aplican *CO Only*.
- [ ] La prueba social usa cifras exactas verificables, sin escasez falsa ni vocabulario anti-humo prohibido.
- [ ] La garantía muestra `≤3` condiciones claras junto al CTA y no sustituye a la prueba.
- [ ] La navegación solo se elimina en landings pagadas (`noindex`), manteniendo siempre el footer legal mínimo.

### Formularios, pricing y captura
- [ ] El formulario usa 1 columna, mínimo de campos justificados, `<label>` visible encima, tap targets `≥44px`, teclados semánticos y `autocomplete`.
- [ ] La validación opera `on-blur` sin borrar inputs; formularios `>5–6` campos usan multi-paso con persistencia; el botón tiene estado de carga y existe fallback ante fallos de API/CRM.
- [ ] La página de precios muestra planes, recomendado, toggle mensual/anual, "para quién es" y FAQ, y supera el *"paste test"* en HTML semántico seleccionable.
- [ ] Ningún popup es *full-screen* en móvil ni aparece antes de `30s`; todos aplican *frequency capping* (`1/sesión`, *cool-down* `7–30` días), excluyen checkout, cierran de forma accesible (`×`, clic fuera, `Esc`, *focus trap*) y enlazan a privacidad sin *confirmshaming*.
- [ ] Los *lead magnets* usan entrega híbrida (acceso inmediato + email) y la *Thank You Page* dirige al siguiente paso del embudo.

### Experimentación A/B (post-lanzamiento)
- [ ] El experimento tiene hipótesis documentada, puntuación ICE, métricas primaria/secundarias/guardrail y tamaño muestral pre-calculado (`α = 0.05`, potencia `80%`).
- [ ] El test dura `≥1` semana completa sin *peeking*, sin cambios en caliente y preferiblemente *server-side*/*edge* sin *flicker*.
- [ ] Los elementos *opt-in* emplean *Triggered Analysis* por exposición y todo resultado (efecto, IC 95%, p-value, guardrails y aprendizajes) se registra en el playbook.
