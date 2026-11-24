<?php
/**
 * Title: Hero editorial Albor (58/42)
 * Slug: albor/hero-albor
 * Categories: albor-secciones
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|md"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--md)">
	<!-- wp:columns {"align":"wide","verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"2rem","left":"3rem"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"58%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%">
			<!-- wp:paragraph {"className":"albor-eyebrow"} -->
			<p class="albor-eyebrow">El Poblado, Medellín · Odontología conservadora</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":1} -->
			<h1 class="wp-block-heading">Odontología honesta que cuida tus dientes reales antes que venderte de más</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"style":{"color":{"text":"var:preset|color|ink-muted"},"typography":{"fontSize":"var:preset|font-size|lg"}}} -->
			<p class="has-ink-muted-color has-text-color" style="font-size:var(--wp--preset--font-size--lg)">Explicamos tu diagnóstico con calma, mostramos tarifas claras desde la primera valoración ($95.000 COP) y atendemos urgencias el mismo día dentro de nuestros horarios.</p>
			<!-- /wp:paragraph -->

			<!-- wp:html -->
			<div style="display:flex;flex-wrap:wrap;gap:0.75rem;margin-top:1.35rem">
				<a class="albor-btn albor-btn--primary" href="#agenda-valoracion">Agendar valoración ($95.000)</a>
				<a class="albor-btn albor-btn--ghost" target="_blank" rel="noopener noreferrer" data-albor-wa data-cta-location="hero_whatsapp" href="https://wa.me/573000000000?text=Hola%20Albor%20Odontolog%C3%ADa%2C%20quiero%20agendar%20una%20valoraci%C3%B3n%20en%20Medell%C3%ADn.">Escribir por WhatsApp</a>
			</div>
			<p style="margin-top:1rem;font-size:0.86rem;color:#4A5A55;font-weight:600">Lunes a viernes 7:30 AM – 6:30 PM · Sábados 8:00 AM – 2:00 PM [DEMO]</p>
			<!-- /wp:html -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"42%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:42%">
			<!-- wp:html -->
			<figure style="margin:0">
				<img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/clinica-hero.svg' ) ); ?>" width="800" height="560" fetchpriority="high" decoding="async" alt="Ilustración editorial del consultorio Albor Odontología en El Poblado, Medellín" style="width:100%;height:auto;border-radius:1.4rem;border:1px solid #DCE2DC">
			</figure>
			<!-- /wp:html -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
