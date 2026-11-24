<?php
/**
 * Title: Enfoque conservador y confianza clínica
 * Slug: albor/enfoque-clinico
 * Categories: albor-secciones
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"align":"full","style":{"color":{"background":"var:preset|color|surface-sage"},"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-surface-sage-background-color has-background" style="padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg)">
	<!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"2rem","left":"3rem"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
			<!-- wp:html -->
			<figure style="margin:0">
				<img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/consultorio-equipo.svg' ) ); ?>" width="720" height="480" loading="lazy" decoding="async" alt="Equipo de especialistas de Albor Odontología y protocolo de esterilización [DEMO]" style="width:100%;height:auto;border-radius:1.25rem;border:1px solid #DCE2DC">
			</figure>
			<!-- /wp:html -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">
			<!-- wp:paragraph {"className":"albor-eyebrow"} -->
			<p class="albor-eyebrow">Por qué nos eligen en Medellín</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading">Primero explicamos lo que realmente necesitas</h2>
			<!-- /wp:heading -->
			<!-- wp:list -->
			<ul class="wp-block-list">
				<li><strong>Anestesia controlada sin prisas:</strong> aplicamos gel tópico previo y tiempos de espera reales antes de iniciar cualquier procedimiento.</li>
				<li><strong>Plan escrito antes de tocar un diente:</strong> conoces qué es urgente, qué puede esperar y el costo exacto por etapa.</li>
				<li><strong>Esterilización auditada por ciclo:</strong> instrumental sellado individualmente y trazabilidad en autoclave en cada consulta.</li>
			</ul>
			<!-- /wp:list -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
