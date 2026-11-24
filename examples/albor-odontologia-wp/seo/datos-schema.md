# Datos Estructurados Schema.org — Albor Odontología `[DEMO]`

Emitidos dinámicamente desde PHP (`inc/schema.php`) leyendo la configuración centralizada del tema en un único bloque `<script type="application/ld+json">` con `@graph` y escape `wp_json_encode( $graph, JSON_HEX_TAG | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE )` (protección `\u003c`).

## Entidades
1. **`Dentist`** (subtipo específico vigente de `LocalBusiness` / `MedicalBusiness`):
   - `name`: `Albor Odontología`
   - `priceRange`: `$95.000 - $4.200.000 COP`
   - `telephone`: `+57-300-000-0000` `[DEMO]`
   - `address`: Calle 10A # 36-24, El Poblado, Medellín, Antioquia, CO `[DEMO]`
   - `geo`: `6.20892`, `-75.56648` (5 decimales)
   - `openingHoursSpecification`: L–V `07:30–18:30`, Sáb `08:00–14:00`
   - `areaServed`: Medellín, El Poblado, Laureles, Envigado, Sabaneta
2. **`BreadcrumbList`** en cada vista.
3. **`MedicalWebPage` / `Article` + `Person`** en entradas de Blog (autor clínico con `jobTitle` y `sameAs`).

## Exclusiones 2026
- Cero `FAQPage`, cero `HowTo`, cero `SearchAction` y cero `AggregateRating` / `Review` sobre `Dentist`.
