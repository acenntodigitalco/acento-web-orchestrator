<?php
/**
 * Datos estructurados Schema.org JSON-LD 2026 (@graph sin tipos retirados).
 *
 * @package Albor_Odontologia
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_head', function () {
	$home_url   = home_url( '/' );
	$agencia_id = trailingslashit( $home_url ) . '#clinica';
	$logo_url   = ALBOR_THEME_URI . '/assets/img/clinica-hero.svg';

	$graph = array(
		array(
			'@type'                     => 'Dentist',
			'@id'                       => $agencia_id,
			'name'                      => 'Albor Odontología',
			'legalName'                 => 'Albor Salud Oral S.A.S.',
			'url'                       => $home_url,
			'image'                     => $logo_url,
			'telephone'                 => '+57-300-000-0000',
			'email'                     => 'citas@alborodontologia.example',
			'priceRange'                => '$95.000 - $4.200.000 COP',
			'address'                   => array(
				'@type'           => 'PostalAddress',
				'streetAddress'   => 'Calle 10A # 36-24, El Poblado',
				'addressLocality' => 'Medellín',
				'addressRegion'   => 'Antioquia',
				'postalCode'      => '050021',
				'addressCountry'  => 'CO',
			),
			'geo'                       => array(
				'@type'     => 'GeoCoordinates',
				'latitude'  => 6.20892,
				'longitude' => -75.56648,
			),
			'areaServed'                => array( 'Medellín', 'El Poblado', 'Laureles', 'Envigado', 'Sabaneta' ),
			'openingHoursSpecification' => array(
				array(
					'@type'     => 'OpeningHoursSpecification',
					'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ),
					'opens'     => '07:30',
					'closes'    => '18:30',
				),
				array(
					'@type'     => 'OpeningHoursSpecification',
					'dayOfWeek' => 'Saturday',
					'opens'     => '08:00',
					'closes'    => '14:00',
				),
			),
			'sameAs'                    => array(
				'https://www.instagram.com/example-albor',
				'https://www.facebook.com/example-albor',
			),
		),
	);

	// BreadcrumbList según la vista activa.
	$breadcrumbs = array(
		array(
			'@type'    => 'ListItem',
			'position' => 1,
			'name'     => 'Inicio',
			'item'     => $home_url,
		),
	);

	if ( is_singular( 'post' ) ) {
		$blog_id = (int) get_option( 'page_for_posts' );
		if ( $blog_id > 0 ) {
			$breadcrumbs[] = array(
				'@type'    => 'ListItem',
				'position' => 2,
				'name'     => 'Blog',
				'item'     => get_permalink( $blog_id ),
			);
			$breadcrumbs[] = array(
				'@type'    => 'ListItem',
				'position' => 3,
				'name'     => wp_strip_all_tags( get_the_title() ),
				'item'     => get_permalink(),
			);
		} else {
			$breadcrumbs[] = array(
				'@type'    => 'ListItem',
				'position' => 2,
				'name'     => wp_strip_all_tags( get_the_title() ),
				'item'     => get_permalink(),
			);
		}

		$thumb_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		$graph[]   = array(
			'@type'         => 'Article',
			'@id'           => get_permalink() . '#articulo',
			'headline'      => wp_strip_all_tags( get_the_title() ),
			'datePublished' => get_the_date( 'c' ),
			'dateModified'  => get_the_modified_date( 'c' ),
			'image'         => $thumb_url ? $thumb_url : ALBOR_THEME_URI . '/assets/img/guia-implantes.svg',
			'author'        => array(
				'@type'    => 'Person',
				'name'     => 'Dr. Andrés Saldarriaga',
				'jobTitle' => 'Implantólogo Oral [DEMO]',
				'sameAs'   => 'https://www.instagram.com/example-albor',
			),
			'publisher'     => array(
				'@id' => $agencia_id,
			),
		);
	} elseif ( ! is_front_page() ) {
		$breadcrumbs[] = array(
			'@type'    => 'ListItem',
			'position' => 2,
			'name'     => wp_strip_all_tags( wp_get_document_title() ),
			'item'     => home_url( add_query_arg( array() ) ),
		);
	}

	$graph[] = array(
		'@type'           => 'BreadcrumbList',
		'itemListElement' => $breadcrumbs,
	);

	$payload = array(
		'@context' => 'https://schema.org',
		'@graph'   => $graph,
	);

	echo "\n<script type=\"application/ld+json\">" . wp_json_encode( $payload, JSON_HEX_TAG | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
} );
