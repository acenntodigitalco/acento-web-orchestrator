<?php
/**
 * Siembra inicial idempotente de páginas demo al activar el tema (solo 1 vez).
 *
 * @package Albor_Odontologia
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_switch_theme', function () {
	if ( get_option( 'albor_demo_seeded' ) ) {
		return;
	}

	$pages = array(
		'inicio'        => array(
			'title'    => 'Inicio',
			'template' => '',
		),
		'quienes-somos' => array(
			'title'    => 'Quiénes somos',
			'template' => 'page-quienes-somos',
		),
		'servicios'     => array(
			'title'    => 'Servicios',
			'template' => 'page-servicios',
		),
		'blog'          => array(
			'title'    => 'Blog',
			'template' => '',
		),
		'contacto'      => array(
			'title'    => 'Contacto',
			'template' => 'page-contacto',
		),
	);

	$created_ids = array();

	foreach ( $pages as $slug => $cfg ) {
		$existing = get_page_by_path( $slug, OBJECT, 'page' );
		if ( $existing instanceof WP_Post ) {
			$created_ids[ $slug ] = $existing->ID;
			continue;
		}

		$page_id = wp_insert_post(
			array(
				'post_type'   => 'page',
				'post_status' => 'publish',
				'post_title'  => $cfg['title'],
				'post_name'   => $slug,
			)
		);

		if ( ! is_wp_error( $page_id ) && $page_id > 0 ) {
			if ( ! empty( $cfg['template'] ) ) {
				update_post_meta( $page_id, '_wp_page_template', $cfg['template'] );
			}
			$created_ids[ $slug ] = $page_id;
		}
	}

	if ( ! empty( $created_ids['inicio'] ) && ! empty( $created_ids['blog'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', (int) $created_ids['inicio'] );
		update_option( 'page_for_posts', (int) $created_ids['blog'] );
	}

	// Pasar a borrador la entrada por defecto "Hello world!" si sigue intacta en una instalación nueva.
	$hello = get_page_by_path( 'hello-world', OBJECT, 'post' );
	if ( $hello instanceof WP_Post && 'publish' === $hello->post_status ) {
		wp_update_post(
			array(
				'ID'          => $hello->ID,
				'post_status' => 'draft',
			)
		);
	}

	// Crear 1 artículo de blog de ejemplo si aún no existe ninguno con este slug.
	$sample_slug = 'implantes-dentales-medellin-guia-tiempos';
	$has_post    = get_page_by_path( $sample_slug, OBJECT, 'post' );
	if ( ! $has_post ) {
		$post_content = <<<'HTML'
<!-- wp:paragraph {"className":"albor-answer-first"} -->
<p class="albor-answer-first">Un implante dental sustituye la raíz de un diente perdido con una pieza de titanio biocompatible y una corona hecha a medida. En Albor Odontología [DEMO], en El Poblado, Medellín, el proceso comienza con una valoración diagnóstica desde $95.000 COP para definir tiempos reales y presupuesto sin sorpresas.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">1. Cuándo conviene un implante y qué revisamos primero</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Antes de hablar de cirugía evaluamos la calidad del hueso, la salud de la encía y tu mordida mediante radiografía o tomografía. Nuestro principio es conservar primero el diente natural siempre que sea viable.</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">2. Tiempos reales paso a paso</h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol class="wp-block-list"><li><strong>Valoración y diagnóstico:</strong> revisión clínica, lectura de imágenes y plan escrito con fechas.</li><li><strong>Colocación del implante:</strong> procedimiento ambulatorio bajo anestesia local controlada.</li><li><strong>Integración y corona definitiva:</strong> tras la cicatrización del hueso, instalamos la corona con color idéntico al de tus dientes.</li></ol>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">3. Cuidados durante los primeros días</h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Durante las primeras 48 horas recomendamos dieta blanda tibia, compresas frías externas, cero tabaco y cepillado suave siguiendo exactamente las indicaciones de tu especialista.</p>
<!-- /wp:paragraph -->
HTML;

		wp_insert_post(
			array(
				'post_type'    => 'post',
				'post_status'  => 'publish',
				'post_title'   => 'Implantes dentales en Medellín: tiempos reales, cuidados y valoración',
				'post_name'    => $sample_slug,
				'post_excerpt' => 'Qué revisamos en la primera cita, cuánto tarda realmente la integración del hueso y qué cuidados garantizan un resultado duradero.',
				'post_content' => $post_content,
			)
		);
	}

	update_option( 'albor_demo_seeded', '1', false );
} );
