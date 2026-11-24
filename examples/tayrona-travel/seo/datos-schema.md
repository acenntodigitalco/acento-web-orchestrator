# Datos Estructurados Schema.org — Tayrona Travel

Fuente única de verdad: `brief-proyecto.md`. Cumple `master-seo-tecnico` (JSON-LD 2026 con `@graph`, sin tipos retirados como `FAQPage` o `HowTo`, y sin *self-serving review markup* en `LocalBusiness`).

## Entidades implementadas en `index.html`

1. **`TravelAgency`** (subtipo específico vigente de `LocalBusiness`):
   - `@id`: `https://tayronatravel.example/#agencia`
   - `name`: `Tayrona Travel`
   - `legalName`: `Tayrona Travel Operador Turístico S.A.S.` *(DEMO)*
   - `url`: `https://tayronatravel.example/`
   - `image`: `https://tayronatravel.example/assets/img/hero-tayrona.webp`
   - `telephone`: `+57-300-000-0000`
   - `email`: `reservas@tayronatravel.example` *(DEMO)*
   - `priceRange`: `$175.000 - $380.000 COP`
   - `address`: Carrera 2 # 11-45, Local 3, El Rodadero, Santa Marta, Magdalena, 470006, CO *(DEMO)*
   - `geo`: `11.20438`, `-74.22714` (≥5 decimales)
   - `areaServed`: Santa Marta, El Rodadero, Parque Nacional Natural Tayrona, Cartagena de Indias, Isla Barú
   - `openingHoursSpecification`:
     - Lunes a viernes: `08:00` – `17:00`
     - Sábado: `08:00` – `14:00`
   - `sameAs`: perfiles Instagram, Facebook y TikTok *(DEMO)*

2. **`TouristTrip` #1 — Camping y Cabañas en el Parque Tayrona**:
   - `@id`: `https://tayronatravel.example/#tour-tayrona`
   - `name`: `Camping y Cabañas en el Parque Nacional Natural Tayrona`
   - `provider`: `@id` agencia
   - `offers` (`Offer`): `price: "175000"`, `priceCurrency: "COP"`, `availability: "https://schema.org/InStock"`, `url: "https://tayronatravel.example/#planes"`

3. **`TouristTrip` #2 — Pasadía Cartagena e Isla Barú desde Santa Marta**:
   - `@id`: `https://tayronatravel.example/#tour-baru`
   - `name`: `Pasadía a Cartagena e Isla Barú desde El Rodadero, Santa Marta`
   - `provider`: `@id` agencia
   - `offers` (`Offer`): `price: "185000"`, `priceCurrency: "COP"`, `availability: "https://schema.org/InStock"`, `url: "https://tayronatravel.example/#planes"`

4. **`BreadcrumbList`** en ambas páginas (`Inicio` y `Inicio > Blog > Guía Parque Tayrona`).

## Entidades implementadas en `blog/guia-parque-tayrona-santa-marta.html`

- **`Article`** enlazado a `@id` agencia (`publisher`) y **`Person`** (`author`: Camila Restrepo, operadora local `[DEMO]`, con `sameAs`), `datePublished` y `dateModified` reales (`2026-11-23`), imagen editorial `sendero-tayrona-blog.webp` y `BreadcrumbList`.

## Tipos excluidos deliberadamente (cumplimiento 2026)
- `FAQPage`: retirado por Google en mayo 2026 (las preguntas frecuentes existen en HTML nativo `<details>` para UX y GEO, sin marcado `FAQPage`).
- `SearchAction` / `HowTo`: retirados.
- `AggregateRating` / `Review` dentro de `TravelAgency`: prohibido por regla anti *self-serving review markup*.
