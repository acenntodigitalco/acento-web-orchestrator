# Brief del proyecto: Tayrona Travel

Fecha de creación: 2026-11-23
Estado: en desarrollo (proyecto piloto / prueba integral)

> **Nota sobre datos `[DEMO]`:** Los servicios, precios, horarios, logística de recogida/retorno y número de WhatsApp (`+57 300 000 0000`) son **datos reales provistos en el arranque**. Los datos legales, dirección exacta, correo, redes sociales y métricas de prueba social marcados con `[DEMO]` son ficticios para esta prueba y deben reemplazarse antes de salir a producción real.

## 1. Resumen
- **Tecnología:** HTML5 + CSS3 moderno + JavaScript nativo (Vanilla JS, **sin jQuery**) + GSAP ScrollTrigger
- **Sistema de estilos:** CSS nativo (*Web Platform First*: OKLCH, Container Queries, `@starting-style`, Media Queries)
- **Objetivo principal:** Generar conversaciones calificadas y cierre directo de reservas por **WhatsApp (`+57 300 000 0000`)** — sin formularios de contacto.
- **Público objetivo:** Viajeros nacionales y turistas en Santa Marta / El Rodadero (parejas, amigos y familias) buscando hospedaje en el Parque Nacional Natural Tayrona (camping o cabañas) o pasadía de un día a Cartagena e Isla Barú con salida coordinada.
- **Descripción completa:** Agencia operadora en Santa Marta especializada en dos experiencias clave:
  1. **Camping y cabañas en el Parque Nacional Natural Tayrona** (con y sin aire acondicionado), saliendo desde Santa Marta, con tarifas desde **\$175.000 COP por noche**.
  2. **Pasadía a Cartagena e Isla Barú** por **\$185.000 COP por persona**, con salidas desde El Rodadero (Santa Marta) a las **3:00 AM** y **7:00 AM**. La agencia recoge a los pasajeros en la puerta de su casa u hotel a la salida; el regreso finaliza en **El Rodadero**, donde el traslado final hacia su alojamiento corre por cuenta del pasajero.

## 2. Requerimientos especiales
- **CRO / Conversión:** One-Page Landing de alta conversión orientada 100% a WhatsApp (cero formularios de contacto), selector interactivo de plan/horario que prellena el mensaje de WhatsApp, comparativa transparente en HTML seleccionable y resolución explícita de objeciones (logística de recogida/regreso, precios reales, horarios de atención).
- **Animaciones (CSS/WAAPI + GSAP):** Botones llamativos con microinteracciones de alta atención (sin flicker, GPU-composited), animaciones con scroll (`ScrollTrigger`) y parallax fluido en hero y bandas visuales, respetando `prefers-reduced-motion: reduce`.
- **Analítica / Tracking y Meta Ads:** `dataLayer` en `snake_case`, Consent Mode v2 (`denied` por defecto), banner de consentimiento accesible + modal `<dialog>` de preferencias, preservación de UTMs y `fbclid`/`gclid` para campañas de **Meta Ads**, medición de clics a WhatsApp por plan/ubicación con `data-price` y `currency: "COP"`.
- **Blog SEO/GEO:** 1 artículo de ejemplo completo sobre la guía práctica para visitar el Parque Tayrona desde Santa Marta con apertura *answer-first* y CTA contextual a WhatsApp.
- **Idioma:** Solo español (`es-CO`).

## 3. Datos del cliente
| Campo | Valor |
|---|---|
| Nombre comercial | Tayrona Travel |
| Razón social | Tayrona Travel Operador Turístico S.A.S. `[DEMO]` |
| NIT | 901.482.319-4 `[DEMO]` |
| RNT (Registro Nacional de Turismo) | RNT 98412 `[DEMO]` |
| Tipo de organización | Agencia de viajes / Operador turístico local (`TravelAgency`) |
| Dirección | Carrera 2 # 11-45, Local 3, El Rodadero, Santa Marta, Magdalena, Colombia `[DEMO]` |
| Coordenadas | `11.20438, -74.22714` `[DEMO]` |
| Sedes adicionales | Ninguna (operación centralizada en El Rodadero, Santa Marta) |
| Teléfono | +57 300 000 0000 |
| WhatsApp | +57 300 000 0000 (`https://wa.me/573000000000`) |
| Correo | reservas@tayronatravel.example `[DEMO]` |
| Horarios | Lunes a viernes: 8:00 AM – 5:00 PM · Sábados: 8:00 AM – 2:00 PM · Domingos: cerrado en oficina (salidas programadas operan normal) |
| Año de fundación | 2019 `[DEMO]` |
| Fundadores o representantes | Camila Restrepo y Mateo Iguarán `[DEMO]` |
| Áreas de servicio | Santa Marta, El Rodadero, Parque Nacional Natural Tayrona, Cartagena de Indias, Isla Barú |
| Medios de pago | Nequi, Daviplata, transferencia Bancolombia, tarjeta débito/crédito y efectivo en punto de encuentro `[DEMO]` |
| Rango de precios | \$175.000 COP – \$380.000 COP |
| Redes sociales | Instagram `@example-tayrona`, Facebook `/tayronatravelco`, TikTok `@example-tayrona` `[DEMO]` |
| Marca (dirección visual) | Editorial caribeño-selvático cálido (OKLCH: arena `#FAF6EF`, selva profunda `#123128`, terracota solar `#C8552D`, agua caribe `#0E6E6E`); tipografía `Fraunces` (editorial) + `Plus Jakarta Sans` (UI/lectura) |
| Prueba social (referencia visual) | 4,9 / 5 en 318 viajeros acompañados desde Santa Marta `[DEMO — reemplazar con reseñas verificadas antes de publicar]` |

## 4. SEO y GEO/AEO
- **Palabras clave principales:** tours al Parque Tayrona desde Santa Marta, cabañas y camping en el Parque Tayrona, pasadía Cartagena e Isla Barú desde Santa Marta.
- **Palabras clave secundarias:** alojamiento Parque Tayrona precios, cabañas con aire acondicionado Tayrona, tour Isla Barú saliendo desde El Rodadero, agencia de tours en Santa Marta.
- **Ciudad o región objetivo:** Santa Marta y El Rodadero, Magdalena (Colombia).
- **Nuevo o rediseño (URL actual):** Sitio nuevo — dominio de prueba `https://tayronatravel.example`.
- **Política bots IA (entrenamiento vs. búsqueda):** Búsqueda y citabilidad IA permitidas (`OAI-SearchBot`, `PerplexityBot`, `Claude-SearchBot`, `Googlebot`, `ChatGPT-User`, `Claude-User`, `Perplexity-User`). `robots.txt` permisivo por defecto (`User-agent: *`) sin bloqueos innecesarios y preparado para excepciones explícitas del cliente.

## 5. Estructura del sitio
| # | Página | Ruta | Propósito | Contenido listo |
|---|---|---|---|---|
| 1 | Landing One-Page Principal | `desarrollo/index.html` | Captar atención, comparar los 2 planes, resolver objeciones de logística y convertir directo a WhatsApp | Redactado en arranque |
| 2 | Artículo de Blog (Ejemplo SEO/GEO) | `desarrollo/blog/guia-parque-tayrona-santa-marta.html` | Captar búsquedas informativas/IA sobre cómo ir al Tayrona desde Santa Marta y derivar a WhatsApp | Redactado en arranque |

## 6. Materiales y referencias
- **Entregados por el cliente:** Ninguno (proyecto piloto).
- **Plantillas de terceros (solo referencia):** Ninguna — diseño y código 100% originales desde cero.
- **Imágenes:** 4 fotografías editoriales generadas a medida y optimizadas en WebP (`hero-tayrona.webp`, `cabanas-camping-tayrona.webp`, `cartagena-isla-baru.webp`, `sendero-tayrona-blog.webp`).
- **Competencia o inspiración:** Posicionamiento diferenciado frente a agencias genéricas de Santa Marta (claridad total en precios y logística de retorno en El Rodadero).

## 7. Entrega
- **GitHub:** No (prueba local).
- **Dominio y hosting:** `https://tayronatravel.example` `[DEMO]` / hosting estático ligero.
- **Fecha objetivo:** Entrega inmediata en prueba piloto.

## 8. Pendientes (antes de lanzar a producción real)
- Sustituir todos los campos marcados `[DEMO]` (razón social, NIT, RNT, dirección, correo, redes y testimonios) por los reales del cliente.
- Reemplazar IDs placeholder de GTM (`GTM-XXXXXXX`), GA4 y Meta Pixel por los contenedores reales del cliente.
- Confirmar precios exactos de cabaña con A/C vs. sin A/C si tienen tarifas diferenciadas superiores a la base de \$175.000/noche.

## 9. Decisiones tomadas
- **2026-11-23:** Se descarta jQuery en favor de HTML5 + CSS3 moderno + Vanilla JS (*Web Platform First*) para proteger Core Web Vitals.
- **2026-11-23:** Se elige arquitectura **One-Page Landing** + 1 artículo de blog de ejemplo, 100% orientada a conversaciones por WhatsApp sin formularios de contacto.
- **2026-11-23:** Se incluye GSAP + ScrollTrigger (con `gsap.matchMedia()` y `prefers-reduced-motion`) para scroll reveals, parallax y microinteracciones llamativas en botones.
