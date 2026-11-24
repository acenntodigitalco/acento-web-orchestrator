<?php
/**
 * Funciones principales del Block Theme Albor Odontología.
 *
 * @package Albor_Odontologia
 */

defined( 'ABSPATH' ) || exit;

define( 'ALBOR_THEME_VERSION', '1.0.2' );
define( 'ALBOR_THEME_DIR', get_template_directory() );
define( 'ALBOR_THEME_URI', get_template_directory_uri() );

require_once ALBOR_THEME_DIR . '/inc/setup.php';
require_once ALBOR_THEME_DIR . '/inc/rest-valoracion.php';
require_once ALBOR_THEME_DIR . '/inc/schema.php';
require_once ALBOR_THEME_DIR . '/inc/seo-robots.php';
require_once ALBOR_THEME_DIR . '/inc/demo-setup.php';
