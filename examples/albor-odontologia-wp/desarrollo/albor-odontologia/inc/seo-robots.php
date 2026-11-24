<?php
/**
 * Configuración automática de robots.txt RFC 9309 (GEO/AEO 2026) y referencia a sitemap nativo.
 *
 * @package Albor_Odontologia
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'robots_txt', function ( $output, $public ) {
	if ( ! $public ) {
		return $output;
	}

	$sitemap_url = home_url( '/wp-sitemap.xml' );
	if ( false === stripos( $output, 'Sitemap:' ) ) {
		$output .= "\n# Sitemap nativo WordPress\nSitemap: " . esc_url_raw( $sitemap_url ) . "\n";
	}

	return $output;
}, 10, 2 );
