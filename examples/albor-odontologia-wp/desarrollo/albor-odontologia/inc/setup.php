<?php
/**
 * Registro de soporte de tema, patrones, bloque propio y assets condicionales.
 *
 * @package Albor_Odontologia
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/albor.css' );
} );

add_action( 'init', function () {
	register_block_pattern_category(
		'albor-secciones',
		array(
			'label' => __( 'Secciones Albor Odontología', 'albor-odontologia' ),
		)
	);

	$block_dir = ALBOR_THEME_DIR . '/blocks/orientador-citas';
	if ( file_exists( $block_dir . '/block.json' ) ) {
		register_block_type( $block_dir );
	}
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'albor-fonts',
		'https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,500;0,6..72,600;0,6..72,700;1,6..72,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'albor-theme-css',
		ALBOR_THEME_URI . '/assets/css/albor.css',
		array(),
		ALBOR_THEME_VERSION
	);

	wp_enqueue_script(
		'albor-tracking',
		ALBOR_THEME_URI . '/assets/js/tracking.js',
		array(),
		ALBOR_THEME_VERSION,
		false
	);

	// Cargar script del formulario CRO únicamente en Contacto, Portada o páginas con el formulario.
	if ( is_page( 'contacto' ) || is_front_page() ) {
		wp_enqueue_script(
			'albor-contacto',
			ALBOR_THEME_URI . '/assets/js/contacto.js',
			array( 'albor-tracking' ),
			ALBOR_THEME_VERSION,
			true
		);

		wp_localize_script(
			'albor-contacto',
			'AlborRest',
			array(
				'endpoint' => esc_url_raw( rest_url( 'albor/v1/valoracion' ) ),
				'nonce'    => wp_create_nonce( 'wp_rest' ),
			)
		);
	}
} );
