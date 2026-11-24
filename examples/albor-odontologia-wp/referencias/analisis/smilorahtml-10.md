# Especificación de diseño de referencia (arquitectura para WordPress Block Theme)

## 1. Resumen en 5 líneas
Sitio web corporativo de clínica odontológica y salud bucodental con estética limpia, clínica y cercana. Combina una base blanca luminosa con bloques encapsulados de esquinas muy redondeadas en tonos lavanda pálido y azul índigo profundo. La jerarquía visual prioriza la captación inmediata de citas mediante doble llamado a la acción en portada y un formulario integrado en páginas clave. Transmite confianza profesional, tecnología moderna y trato familiar sin resultar frío ni saturado. Está orientado a pacientes adultos y familias que buscan atención preventiva, estética o especializada con reserva ágil.

---

## 2. Mapa de páginas y secciones

### Estructura global compartida
- **Barra superior de aviso:** franja encapsulada de altura compacta en azul primario; muestra un mensaje promocional a la izquierda y enlaces sociales separados por líneas finas a la derecha. Propósito: comunicar disponibilidad de citas y canales sociales.
- **Cabecera principal:** logotipo a la izquierda, menú horizontal de 6 ítems al centro (con submenús desplegables y estado activo en píldora) y bloque de contacto rápido a la derecha (botón tipo píldora para chat/contacto + teléfono destacado con icono circular).
- **Pie de página encapsulado:** bloque ancho en azul primario con bordes muy redondeados y margen inferior; distribuido en 4 columnas (marca + descripción + copyright separado por línea superior, enlaces de navegación, datos de contacto con icono por línea y redes sociales circulares).

### A. Portada (Home)
1. **Hero dividido a pantalla amplia:** columna izquierda sobre fondo lavanda con insignia de estado, titular principal dominante, bajada con línea horizontal acento, dos botones (primario y secundario) y dos tarjetas de acceso rápido abajo; columna derecha ocupada por fotografía a sangre con tarjeta flotante blanca en la esquina inferior derecha (disparador de video + avatares apilados + contador numérico de clientes).
2. **Cinta continua de especialidades (Marquee):** banda horizontal de desplazamiento infinito con nombres de tratamientos separados por un icono de estrella geométrica. Propósito: reforzar amplitud de servicios sin peso visual.
3. **Sobre la clínica / Propuesta de valor:** dos columnas asimétricas; a la izquierda collage de dos fotografías con marco desplazado de color primario y tarjeta superpuesta de años de experiencia; a la derecha subtítulo, H2, frase destacada, párrafo, lista breve de 3 pilares con icono y fila de 3 métricas numéricas separadas por divisores verticales.
4. **Rejilla de servicios principales:** sección encapsulada con fondo visual suave, encabezado centrado y cuadrícula de 3×2 tarjetas blancas con icono circular, título y descripción corta.
5. **Por qué elegirnos (Confianza del paciente):** dos columnas balanceadas; tarjeta izquierda en tono lavanda con acento gráfico circular detrás de la esquina, lista de 4 beneficios con icono de verificación y botón CTA; derecha con fotografía redondeada y distintivo circular blanco superpuesto en esquina inferior derecha.
6. **Reserva de cita online:** sección encapsulada sobre fondo fotográfico/oscurecido con encabezado centrado en blanco y formulario de 3 filas (selectores de especialidad y profesional, nombre y correo, teléfono/fecha/hora + botón de confirmación).
7. **Videos de la clínica:** composición asimétrica; izquierda con dos tarjetas verticales de video con icono de reproducción centrado; derecha con narrativa institucional y botón CTA hacia video modal.
8. **Testimonios y marcas aliadas:** sección encapsulada con radios amplios y fondo lavanda claro; encabezado centrado, carrusel de testimonios de una sola tarjeta ancha con flechas laterales flotantes y tira horizontal de 5 logotipos institucionales al pie.
9. **Últimos artículos del blog:** encabezado centrado y carrusel de 3 tarjetas visibles; cada tarjeta muestra imagen superior, insignia circular de fecha (día/mes) montada sobre la unión imagen-contenido, título centrado y enlace de lectura.
10. **Galería fotográfica continua:** tira horizontal de 6 fotografías de formato variable con esquinas redondeadas que cierra el recorrido antes del pie de página.

### B. Quiénes somos / Equipo
1. **Sub-banner de cabecera interior:** bloque encapsulado con fondo suave, título H1 centrado, breve bajada descriptiva y miga de pan tipo píldora blanca con separador decorativo.
2. **Cinta continua de especialidades:** mismo patrón que en Portada.
3. **Sobre la clínica (métrica + collage):** reutiliza el bloque asimétrico con collage de dos fotos, tarjeta de experiencia, lista y 3 estadísticas.
4. **Filosofía de atención (zig-zag):** sección de fondo lavanda claro con encabezado centrado y dos filas alternadas (imagen izquierda / texto derecha, luego texto izquierda / imagen derecha) con amplio padding interior.
5. **Por qué elegirnos:** reutiliza el bloque de confianza en dos columnas.
6. **Equipo médico (Nuestra plantilla):** encabezado centrado con descripción amplia y rejilla de 4 columnas; cada tarjeta tiene retrato circular con superposición azul y aparición de 3 iconos sociales al pasar el cursor, nombre y especialidad.
7. **Banda CTA intermedia:** franja encapsulada azul con titular centrado y botón negro/blanco de alto contraste.
8. **Testimonios y marcas aliadas** + **Últimos artículos** + **Galería fotográfica continua** (cierre secuencial idéntico a Portada).

### C. Servicios
1. **Sub-banner interior:** título H1, bajada y miga de pan.
2. **Cinta continua de especialidades.**
3. **Listado detallado de servicios en alternancia (zig-zag):** encabezado centrado y 5 bloques consecutivos de servicio (alternando fondo blanco y contenedor redondeado lavanda claro). Cada bloque tiene imagen con acento circular decorativo en esquina superior en una columna, y en la otra: título, subtítulo, lista de 3 prestaciones con check, nota destacada con icono y botón de contacto.
4. **Reserva de cita online:** formulario completo encapsulado.
5. **Por qué elegirnos.**
6. **Testimonios y marcas.**
7. **Últimos artículos** + **Galería fotográfica continua.**

### D. Blog (Archivo con filtros)
1. **Sub-banner interior:** título H1, bajada y miga de pan.
2. **Archivo filtrable por pestañas:** fila superior de pestañas en píldora (Todas + 5 categorías), cuadrícula de 2 columnas con tarjetas horizontales/verticales sombreadas (imagen superior, fila de metadatos autor/fecha con icono, título H2, extracto y enlace subrayado con acento corto) y paginación numérica centrada al pie.

### E. Post individual (Single)
1. **Sub-banner interior:** título H1, bajada y miga de pan.
2. **Cuerpo de artículo + barra lateral (8/4 columnas):**
   - **Columna principal (tarjeta sombreada):** imagen destacada redondeada, título H2, metadatos (autor/fecha), cuerpo de texto, bloque de cita destacada en fondo negro con texto blanco en cursiva e icono de comillas, segunda imagen intercalada + texto, fila de etiquetas en píldora + botones sociales de compartir, navegación Anterior/Siguiente, tarjeta de biografía de autor en fondo primario con avatar circular superpuesto arriba, listado de comentarios con avatar cuadrado redondeado y botón Responder, y formulario de comentario con inputs de borde inferior limpio.
   - **Barra lateral (5 tarjetas apiladas):** buscador con botón integrado, lista de categorías centrada, iconos sociales de seguimiento, nube de etiquetas en píldora y lista de entradas recientes con miniatura rectangular + título.

### F. Contacto
1. **Sub-banner interior:** título H1, bajada y miga de pan.
2. **Cinta continua de especialidades.**
3. **Tarjetas de información de contacto:** encabezado centrado y rejilla de 3 columnas iguales sobre fondo lavanda claro y borde sutil (ubicación, teléfonos, correos electrónicos), cada una con icono superior, título y enlaces/texto.
4. **Reserva de cita / Consulta online:** formulario completo de 3 filas sobre bloque oscuro/fotográfico.
5. **Mapa embebido:** iframe a ancho de contenedor con esquinas muy redondeadas y filtro en escala de grises que recupera color al interactuar.
6. **Galería fotográfica continua.**

---

## 3. Sistema visual (tokens)

| Categoría | Token funcional | Valor exacto / Rango | Uso principal |
| :--- | :--- | :--- | :--- |
| **Color** | Primario marca | `#3a4498` | Barra superior, footer, botones principales, iconos, acentos |
| **Color** | Superficie base | `#ffffff` | Fondo general de página, tarjetas internas, texto sobre oscuro |
| **Color** | Contraste / Oscuro | `#000000` | Hover de botones, bloque de cita, botón CTA oscuro |
| **Color** | Tinta títulos | `#0f0200` | Encabezados H1–H6 en fondos claros |
| **Color** | Tinta alternativa oscura | `#060b2c` | Variantes de contraste oscuro |
| **Color** | Texto cuerpo | `#575764` | Párrafos, descripciones, placeholders, metadatos |
| **Color** | Superficie suave | `#f1f3fe` | Fondos de secciones alternas, tarjetas de blog/servicios/confianza |
| **Color** | Superficie hero / activo | `#e3e8fe` | Mitad izquierda del hero, estado activo del menú principal |
| **Color** | Borde sutil | `#dfe4f3` | Bordes de tarjetas, divisores finos, contorno de iconos |
| **Color** | Acento lavanda | `#99a2dc` | Botón contacto cabecera, flechas en tarjetas hero, botón volver arriba |
| **Color** | Lavanda grisáceo | `#9ca1ca` | Controles de navegación secundarios |
| **Tipografía** | Familia Display / Títulos | `Urbanist` (sans-serif) | Todos los encabezados (H1–H6), cifras de métricas y teléfonos |
| **Tipografía** | Familia Cuerpo / UI | `Inter` (sans-serif) | Párrafos, formularios, menús, botones, etiquetas |
| **Escala** | Hero Display (H1) | `80px` / alto línea `94px` (700) | Titular único de portada (`44px` tablet, `30px` móvil) |
| **Escala** | Banner interior (H1) | `60px` / alto línea `70px` (700) | Titular de páginas interiores (`44px` tablet, `30px` móvil) |
| **Escala** | Título de sección (H2) | `46px` / alto línea `54px` (700) | Encabezados de sección (`36px` tablet, `26px` móvil) |
| **Escala** | Destacado / CTA (H2) | `30px` / alto línea `34px` (700) | Banners CTA, precios, día en badge de artículo |
| **Escala** | Subtítulo de bloque | `28px` / alto línea `32px` (700) | Títulos de filosofía y lista de servicios |
| **Escala** | Título de tarjeta | `24px` / alto línea `30px` (700) | Tarjetas de servicio, equipo, contacto, entradas de blog |
| **Escala** | Título compacto | `20px`–`22px` / `24px`–`28px` (700) | Cajas hero, acordeones, columnas de footer, post en carrusel |
| **Escala** | Párrafo base | `18px` / alto línea `28px` (400) | Lectura principal (`16px` tablet, `15px` móvil) |
| **Escala** | Texto secundario / UI | `16px` / alto línea `24px` (400–500) | Enlaces de menú, botones, extractos, formularios |
| **Escala** | Metadatos / Microtexto | `14px` / alto línea `20px` (400–500) | Barra superior, etiquetas, fechas, copyright |
| **Espaciado** | Contenedor maestro | `1660px` máx. (interior `1140px`–`1280px`) | Envoltorio de secciones encapsuladas y contenido centrado |
| **Espaciado** | Margen lateral encapsulado | `30px` (`1%` bajo `1750px`) | Aire lateral constante entre secciones redondeadas y borde de pantalla |
| **Espaciado** | Ritmo vertical secciones | `135px` arriba/abajo (`60px` tablet, `40px` móvil) | Respiro entre bloques mayores de contenido |
| **Espaciado** | Separador entre bloques | `30px` (`15px` ≤1440px, `10px` ≤575px) | Distancia vertical entre secciones encapsuladas |
| **Radios** | Contenedor macro | `50px` (`30px` tablet, `20px` móvil) | Sección de testimonios y pie de página |
| **Radios** | Contenedor estándar / tarjeta | `20px` (variantes `15px` y `30px`) | Hero, servicios, artículos, formularios, imágenes, mapa |
| **Radios** | Contenedor compacto | `10px` | Barra superior, desplegables, inputs de búsqueda y acordeón |
| **Radios** | Píldora / Circular | `30px` / `100px` (`50%`) | Botones principales, pestañas, etiquetas, avatares, badges |
| **Sombras** | Elevación de tarjeta blog | Difusión `25px`, offset `3px`, negro `7%` | Tarjetas del archivo de blog, contenedor de post y widgets laterales |
| **Sombras** | Elevación de menús | Difusión `100px`, offset `0`, negro `10%`–`15%` | Menú desplegable en escritorio y panel desplegable en móvil |

---

## 4. Patrones de layout y componentes

### Patrones de layout
- **Encapsulamiento con margen perimetral:** Las secciones de alto impacto (barra superior, hero, servicios, reserva, testimonios, CTA y footer) no tocan los bordes de la ventana; se encierran en cajas con `30px` de margen horizontal y radios de `20px` o `50px`, creando un efecto visual de "tarjetas modulares apiladas".
- **Asimetría controlada en 2 columnas:** Tanto el bloque "Sobre la clínica" (`45% / 49%` con brecha de `95px`) como el bloque "Videos" (`38% / 56%` con brecha de `120px`) desplazan el peso visual hacia composiciones desalineadas respecto a la rejilla tradicional de 12 columnas.
- **Alternancia de ritmo visual (zig-zag):** En Filosofía y Servicios detallados, las filas alternan imagen-texto y texto-imagen, reforzando la separación con bloques alternados blancos y lavanda claro (`20px` de radio).

### Componentes reutilizables y variantes
1. **Botón con icono circular interno:** Forma de píldora (`60px` de alto en desktop), texto centrado-izquierda y círculo de `42px` anclado a la derecha con flecha diagonal. Tres variantes:
   - *Primario:* fondo azul primario, texto blanco, círculo blanco.
   - *Secundario:* fondo blanco, texto negro, círculo negro/primario.
   - *Alto contraste (CTA):* fondo negro, texto blanco, círculo blanco (invierte en hover).
2. **Encabezado de sección estándar:** Antetítulo en color primario (`18px`, opcionalmente precedido de un punto circular lavanda) + H2 (`46px`) + párrafo opcional, en versión centrada o alineada a la izquierda.
3. **Tarjeta de servicio (Home):** Caja blanca con radio de `20px`, icono dentro de círculo con borde de `2px`, H3 y párrafo breve; en estado hover invierte completamente a fondo azul primario y texto blanco.
4. **Tarjeta de servicio extendida (Página Servicios):** Bloque horizontal de 2 columnas con foto con adorno circular en esquina, lista de 3 viñetas con check, nota destacada con icono y botón primario.
5. **Tarjeta de miembro del equipo:** Retrato circular con superposición azul translúcida en hover que revela una fila centrada de 3 botones sociales circulares blancos, seguido de nombre y cargo centrados.
6. **Tarjeta de testimonio:** Contenedor blanco amplio (`padding: 48px 99px`, radio `20px`) centrado con icono de comillas superior, cita extensa, nombre en color primario y rol.
7. **Tarjeta de artículo de blog (2 variantes):**
   - *Carrusel Home:* fondo lavanda claro, borde sutil, imagen superior y insignia circular de fecha (`104px`) con borde del color de fondo montada justo entre la foto y el cuerpo centrado.
   - *Archivo de blog:* fondo blanco con sombra difusa, metadatos con icono (autor/fecha), H2 enlazado, extracto y enlace con barra inferior corta de color primario.
8. **Tarjeta de contacto:** Caja lavanda claro con borde fino, icono superior, H3 y enlaces de teléfono/correo o dirección; elevación suave (`-3px` en Y) y cambio de borde a primario en hover.
9. **Formulario de cita online:** Grid de inputs altos (`70px`, radio `20px`) sobre fondo oscuro; incluye una pestaña decorativa superior en el primer selector y botón de envío oscuro centrado.
10. **Pestañas de filtro y paginación (Blog):** Pestañas en píldora espaciadas horizontalmente (fondo primario en activa) y paginación minimalista centrada sin bordes con estado activo en color primario.
11. **Widgets de barra lateral (Post individual):** 5 módulos uniformes con radio `20px` y sombra suave: buscador con botón cuadrado integrado, lista de enlaces, fila de redes, nube de etiquetas en píldora y lista de entradas recientes con miniatura.

---

## 5. Interacciones y animaciones

- **Preloader inicial:** Cortina blanca a pantalla completa con dos círculos pulsantes en color primario que escala alternadamente hasta desaparecer al cargar el documento.
- **Botón flotante "Volver arriba":** Círculo lavanda fijo en esquina inferior derecha con animación continua de onda/pulso expansiva; aparece solo al hacer scroll y asciende con desplazamiento suave.
- **Revelado de bloques al hacer scroll:** Entrada progresiva de títulos, columnas y tarjetas desde los laterales o desde abajo con duración pausada (~2s) y micro-retardo.
- **Contadores numéricos animados:** Los valores estadísticos (clientes, especialistas, porcentaje de satisfacción, días en tarjetas de blog) cuentan desde `0` hasta su cifra objetivo al mostrarse.
- **Cinta infinita pausable:** El carrusel textual de especialidades se desplaza horizontalmente en bucle lineal constante (`18s`) y se detiene al pasar el cursor sobre la banda.
- **Carruseles interactivos:** Testimonios (1 ítem visible, autoplay `6.5s`, flechas laterales), entradas recientes (1–3 ítems según ancho, autoplay `4.5s`, flechas) y tira de fotos (2–6 ítems, autoplay `6s`, sin flechas).
- **Modal de video:** Al pulsar el icono de reproducción en el hero o en la sección de videos se abre un visor modal centrado sobre fondo oscurecido.
- **Micro-interacciones de hover:**
  - Tarjetas de servicio invierten fondo y tipografía suavemente (`0.6s`).
  - Tarjetas de equipo escalan sutilmente la foto (`1.05`), muestran velo azul y revelan enlaces sociales.
  - Botones de contacto, iconos sociales y tarjetas informativas realizan un desplazamiento vertical sutil (`-3px` a `-4px`).
  - El mapa embebido pasa de escala de grises al 100% a color completo al situar el cursor encima.

---

## 6. Responsive

### Tablet ancha y laptop compacto (`≤ 1199px`)
- Reducción progresiva de escala tipográfica (H1 de `80px` a `50px`, H2 de `46px` a `40px`) y padding de sección (`135px` → `80px`).
- Ajuste de brechas en menú de navegación (`52px` → `9px`–`18px`) y reducción del ancho de botones (`230px` → `215px`–`200px`).
- Los bloques asimétricos ajustan sus proporciones de columnas (`48% / 49%` y `49% / 48%`) y eliminan paddings laterales internos excesivos.

### Tablet vertical (`≤ 991px`)
- **Cabecera:** El menú horizontal colapsa en botón hamburguesa animado (3 líneas que rotan formando una X) y despliega un panel flotante blanco redondeado (`20px`) con sombra; el bloque de contacto permanece visible a la izquierda del botón hamburguesa.
- **Hero:** Se reduce altura de `878px` a `550px`; H1 baja a `44px`; las dos tarjetas inferiores del hero se estrechan (`168px`–`200px`).
- **Rejillas:** La cuadrícula de servicios y la de equipo pasan de 3/4 columnas a 2 columnas; el footer centra su bloque de marca arriba y distribuye las 3 columnas restantes debajo.
- **Blog:** El archivo mantiene 2 columnas compactas; el post individual apila la barra lateral debajo del artículo.

### Móvil (`≤ 767px` y `≤ 575px`)
- **Topbar:** El aviso promocional y los iconos sociales se apilan centrados verticalmente.
- **Cabecera (`≤ 575px`):** Se oculta el bloque de teléfono/chat para dejar espacio limpio al logo y hamburguesa.
- **Hero (`≤ 767px`):** Las dos mitades del hero se superponen (la imagen pasa a ser fondo completo con velo lavanda semitransparente encima) y todo el contenido textual, botones y tarjeta de video/clientes se centra en flujo vertical único.
- **Secciones asimétricas y zig-zag:** Pasan a 1 sola columna centrada (`100%`); en las filas alternadas de Filosofía y Servicios se fuerza el orden visual para mostrar siempre la imagen antes o después de forma consistente; se ocultan adornos vectoriales flotantes que puedan estorbar.
- **Blog (`≤ 767px` / `≤ 575px`):** Las pestañas de categoría pasan a rejilla de 3 columnas (y 2 columnas en móvil pequeño); las tarjetas de blog pasan a 1 columna centrada; en el post individual se ajustan márgenes de comentarios y se apilan etiquetas y botones de compartir.
- **Footer (`≤ 575px`):** Todas las columnas se centran en una sola columna vertical con márgenes y radios reducidos (`20px`).

---

## 7. Qué conservamos como idea y qué cambiamos (Block Theme WordPress / Gutenberg nativo)

### Qué conservamos como concepto
- **Estética clínica luminosa con encapsulamiento suave:** El uso de secciones con bordes redondeados y márgenes laterales frente a fondos claros funciona muy bien con bloques `Group` de Gutenberg (`alignwide` / `alignfull` con padding horizontal).
- **Flujo de conversión claro:** Hero con doble CTA + prueba social inmediata + bloque de reserva accesible en Home, Servicios y Contacto.
- **Estructuras limpias de archivo y single:** Pestañas/filtros por categoría en Blog y lectura cómoda en 8/4 columnas en entradas individuales.

### Qué cambiamos para un WordPress Block Theme moderno y original
1. **Tokens y arquitectura CSS nativa (`theme.json`):** Reemplazar los estilos sueltos y utilidades redundantes por un `theme.json` con paleta semántica propia (`brand-primary`, `surface-soft`, `ink-heading`), escala tipográfica fluida (`clamp()`) en lugar de 6 media queries rígidas, y nomenclatura propia con prefijo del proyecto.
2. **Eliminación de librerías pesadas en sliders y animaciones:**
   - Sustituir carruseles externos dependientes de jQuery por bloques nativos o slider ligero sin dependencias (o CSS Scroll Snap con controles accesibles en JS vanilla).
   - Reemplazar la animación basada en scripts pesados de scroll por `IntersectionObserver` nativo ligero con respeto a `prefers-reduced-motion`.
   - Construir la cinta de especialidades con animación CSS pura sobre un bloque de lista reutilizable.
3. **Mejoras de UX y accesibilidad:**
   - **Hero en móvil:** En lugar de poner texto oscuro sobre una foto con velo al 64% (que compromete el contraste), apilar texto sobre fondo sólido arriba e imagen limpia abajo en móvil.
   - **Formulario de reserva:** Convertir el formulario estático en bloque nativo / plugin compatible con WordPress, añadiendo etiquetas `<label>` visibles accesibles (en la plantilla solo usa `placeholder`), estados de foco claros y validación accesible.
   - **Archivo de Blog dinámico:** Reemplazar las pestañas estáticas con contenido duplicado en el DOM por un bloque `Query Loop` nativo de WordPress conectado a filtros reales por taxonomía/categoría y paginación nativa real.
   - **Navegación y comentarios en Single:** Usar bloques nativos de Gutenberg (`Post Title`, `Post Featured Image`, `Post Author`, `Comments`, `Post Navigation`) estilizados mediante variaciones de bloque (`block-styles`), eliminando elementos rígidos posicionados de forma absoluta que se rompen si cambia la longitud del texto (por ejemplo, la insignia de fecha del blog o el botón "Responder" en comentarios).
   - **Mapa de contacto interactivo:** Permitir activar el mapa con un clic o quitar el bloqueo de puntero permanente para que el usuario pueda hacer zoom y desplazarse en móvil sin quedar atrapado ni perder interactividad.
   - **Cabecera sticky opcional y simplificación de menú:** Limpiar el menú de enlaces de demostración y limitar la navegación a los ítems reales del cliente con submenús accesibles por teclado.

---

## 8. Banderas de originalidad (elementos a rediseñar para evitar parecido excesivo)

1. **Composición exacta del Hero dividido 50/50 con dos tarjetas blancas inferiores y tarjeta de video flotante:** Es la firma visual más reconocible de la plantilla. Conviene rediseñar la disposición del hero (por ejemplo, asimetría 60/40, imagen recortada con forma orgánica/editorial propia o tarjetas de valor integradas fuera del hero) para no replicar su silueta exacta.
2. **Badge circular de fecha montado sobre el borde entre foto y texto en tarjetas de blog:** Ese círculo centrado con borde grueso del color de fondo es muy característico; conviene sustituirlo por una pastilla discreta arriba de la foto o metadato en línea superior.
3. **Collage de dos imágenes con rectángulo sólido desplazado detrás de la segunda foto + caja flotante de años:** Es un patrón muy específico en la sección "Sobre nosotros"; conviene reinterpretarlo con una sola imagen protagonista o un mosaico distinto con proporciones diferentes.
4. **Botón píldora con círculo blanco/negro incrustado y flecha diagonal:** Si se mantiene exactamente el mismo tamaño, radio y animación de flecha en todos los botones del sitio, se percibirá idéntico a la plantilla; conviene definir un estilo de botón propio (por ejemplo, icono integrado en línea, borde sutil o radio distinto).
5. **Adorno circular superpuesto en esquina superior izquierda de las fotos de Servicios + distintivo circular blanco en la esquina de "Por qué elegirnos":** Conviene sustituir esos recursos gráficos puntuales por tratamientos de imagen limpios o elementos visuales propios de la identidad de marca del cliente.
6. **Cinta de marquee con icono de estrella entre especialidades:** Cambiar el separador geométrico y valorar si aporta valor real o si funciona mejor una banda estática de especialidades o métricas clave.
7. **Paleta idéntica (`#3a4498` + `#f1f3fe` + `#e3e8fe`) combinada con `Urbanist` + `Inter`:** Mantener exactamente el mismo tándem cromático y tipográfico garantiza parecido visual inmediato; se debe adaptar la paleta y/o al menos una de las fuentes a la identidad del cliente.
