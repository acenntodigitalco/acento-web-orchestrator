<?php
/**
 * Title: Detalle de artículo con bloques core nativos
 * Slug: albor/post-detalle
 * Categories: albor-secciones
 * Inserter: no
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg)">
	<!-- wp:post-date {"style":{"typography":{"fontSize":"0.86rem"},"color":{"text":"var:preset|color|terracotta"}}} /-->
	<!-- wp:post-title {"level":1} /-->
	<!-- wp:post-author {"showAvatar":false,"byline":"Revisado clínicamente por [DEMO]"} /-->
	<!-- wp:post-featured-image {"aspectRatio":"16/9","style":{"border":{"radius":"1.25rem"},"spacing":{"margin":{"top":"1.5rem","bottom":"1.5rem"}}}} /-->
	<!-- wp:post-content {"layout":{"type":"constrained"}} /-->

	<!-- wp:group {"className":"albor-card albor-card--sage","style":{"spacing":{"margin":{"top":"var:preset|spacing|md"}}},"layout":{"type":"constrained"}} -->
	<div class="wp-block-group albor-card albor-card--sage" style="margin-top:var(--wp--preset--spacing--md)">
		<!-- wp:heading {"level":3} -->
		<h3 class="wp-block-heading">¿Quieres resolver tu caso con un especialista?</h3>
		<!-- /wp:heading -->
		<!-- wp:paragraph -->
		<p>Agenda una valoración diagnóstica en El Poblado, Medellín desde $95.000 COP y recibe un plan escrito sin presiones.</p>
		<!-- /wp:paragraph -->
		<!-- wp:html -->
		<a class="albor-btn albor-btn--primary" href="<?php echo esc_url( home_url( '/contacto/#agenda-valoracion' ) ); ?>">Agendar valoración</a>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"style":{"spacing":{"margin":{"top":"var:preset|spacing|md"}}},"layout":{"type":"flex","justifyContent":"space-between"}} -->
	<div class="wp-block-group" style="margin-top:var(--wp--preset--spacing--md)">
		<!-- wp:post-navigation-link {"type":"previous"} /-->
		<!-- wp:post-navigation-link /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:comments {"style":{"spacing":{"margin":{"top":"var:preset|spacing|md"}}}} /-->
</div>
<!-- /wp:group -->
