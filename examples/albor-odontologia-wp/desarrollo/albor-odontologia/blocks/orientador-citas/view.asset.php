<?php
/**
 * Dependencias de módulo para Interactivity API sin build externo.
 *
 * @package Albor_Odontologia
 */

defined( 'ABSPATH' ) || exit;

return array(
	'dependencies' => array(
		array(
			'id'     => '@wordpress/interactivity',
			'import' => 'static',
		),
	),
	'version'      => '1.0.1',
);
