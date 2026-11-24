<?php
/**
 * Title: Archivo de Blog con Query Loop nativo
 * Slug: albor/blog-archivo
 * Categories: albor-secciones
 * Inserter: no
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|lg"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--lg)">
	<!-- wp:paragraph {"className":"albor-eyebrow"} -->
	<p class="albor-eyebrow">Guías clínicas para pacientes</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"level":1} -->
	<h1 class="wp-block-heading">Respuestas claras antes de sentarte en el consultorio</h1>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":1,"query":{"perPage":6,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","inherit":true},"align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|md"}}}} -->
	<div class="wp-block-query alignwide" style="margin-top:var(--wp--preset--spacing--md)">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":2}} -->
			<!-- wp:group {"className":"albor-card","layout":{"type":"constrained"}} -->
			<div class="wp-block-group albor-card">
				<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9","style":{"border":{"radius":"0.9rem"},"spacing":{"margin":{"bottom":"0.5rem"}}}} /-->
				<!-- wp:post-date {"style":{"typography":{"fontSize":"0.84rem"},"color":{"text":"var:preset|color|terracotta"}}} /-->
				<!-- wp:post-title {"isLink":true,"level":2,"style":{"typography":{"fontSize":"1.5rem"}}} /-->
				<!-- wp:post-excerpt {"moreText":"Leer guía completa"} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
			<!-- wp:query-pagination-previous /-->
			<!-- wp:query-pagination-numbers /-->
			<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->

		<!-- wp:query-no-results -->
			<!-- wp:paragraph -->
			<p>Aún no hay guías publicadas.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:query-no-results -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
