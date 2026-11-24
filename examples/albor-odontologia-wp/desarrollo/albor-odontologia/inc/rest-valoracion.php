<?php
/**
 * Endpoint REST seguro para solicitudes de valoración dental y registro privado.
 *
 * @package Albor_Odontologia
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_post_type(
		'albor_solicitud',
		array(
			'labels'       => array(
				'name'          => __( 'Solicitudes de cita', 'albor-odontologia' ),
				'singular_name' => __( 'Solicitud de cita', 'albor-odontologia' ),
			),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'menu_icon'    => 'dashicons-calendar-alt',
			'supports'     => array( 'title', 'custom-fields' ),
			'capabilities' => array(
				'create_posts' => 'do_not_allow',
			),
			'map_meta_cap' => true,
		)
	);
} );

/**
 * Controlador REST para recibir valoraciones desde el frontend.
 */
class Albor_Valoracion_Controller extends WP_REST_Controller {

	/**
	 * Namespace propio del tema.
	 *
	 * @var string
	 */
	protected $namespace = 'albor/v1';

	/**
	 * Recurso base.
	 *
	 * @var string
	 */
	protected $rest_base = 'valoracion';

	/**
	 * Registra la ruta de creación.
	 */
	public function register_routes() {
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'create_item' ),
				'permission_callback' => array( $this, 'create_item_permissions_check' ),
				'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::CREATABLE ),
			)
		);
	}

	/**
	 * Verifica nonce REST anti-CSRF enviado por el frontend.
	 *
	 * @param WP_REST_Request $request Petición entrante.
	 * @return true|WP_Error
	 */
	public function create_item_permissions_check( $request ) {
		$nonce = $request->get_header( 'X-WP-Nonce' );
		if ( empty( $nonce ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $nonce ) ), 'wp_rest' ) ) {
			return new WP_Error(
				'albor_invalid_nonce',
				__( 'Tu sesión expiró. Recarga la página e intenta nuevamente.', 'albor-odontologia' ),
				array( 'status' => 403 )
			);
		}
		return true;
	}

	/**
	 * Define esquema y saneamiento estricto por campo.
	 *
	 * @param string $method Método HTTP.
	 * @return array<string, array<string, mixed>>
	 */
	public function get_endpoint_args_for_item_schema( $method = WP_REST_Server::CREATABLE ) {
		return array(
			'nombre'  => array(
				'required'          => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'validate_callback' => function ( $val ) {
					return is_string( $val ) && strlen( trim( $val ) ) >= 2 && strlen( trim( $val ) ) <= 120;
				},
			),
			'celular' => array(
				'required'          => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'validate_callback' => function ( $val ) {
					return is_string( $val ) && preg_match( '/^[0-9+\s()-]{7,20}$/', trim( $val ) ) === 1;
				},
			),
			'motivo'  => array(
				'required'          => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_key',
				'enum'              => array( 'valoracion', 'implantes', 'ortodoncia', 'urgencia', 'estetica' ),
			),
			'franja'  => array(
				'required'          => true,
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_key',
				'enum'              => array( 'manana', 'tarde', 'sabado' ),
			),
		);
	}

	/**
	 * Persiste la solicitud en el CPT privado y responde 201 para tracking.
	 *
	 * @param WP_REST_Request $request Petición validada.
	 * @return WP_REST_Response|WP_Error
	 */
	public function create_item( $request ) {
		$nombre  = (string) $request->get_param( 'nombre' );
		$celular = (string) $request->get_param( 'celular' );
		$motivo  = (string) $request->get_param( 'motivo' );
		$franja  = (string) $request->get_param( 'franja' );

		$post_id = wp_insert_post(
			array(
				'post_type'   => 'albor_solicitud',
				'post_status' => 'publish',
				'post_title'  => sprintf( '%s — %s (%s)', $nombre, ucfirst( $motivo ), wp_date( 'Y-m-d H:i' ) ),
			),
			true
		);

		if ( is_wp_error( $post_id ) ) {
			return new WP_Error(
				'albor_save_error',
				__( 'No pudimos guardar tu solicitud. Escríbenos por WhatsApp para atenderte de inmediato.', 'albor-odontologia' ),
				array( 'status' => 500 )
			);
		}

		update_post_meta( $post_id, '_albor_celular', $celular );
		update_post_meta( $post_id, '_albor_motivo', $motivo );
		update_post_meta( $post_id, '_albor_franja', $franja );

		$response = rest_ensure_response(
			array(
				'ok'      => true,
				'lead_id' => (int) $post_id,
				'message' => __( 'Recibimos tu solicitud. Te contactaremos en tu franja preferida.', 'albor-odontologia' ),
			)
		);
		$response->set_status( 201 );

		return $response;
	}
}

add_action( 'rest_api_init', function () {
	$controller = new Albor_Valoracion_Controller();
	$controller->register_routes();
} );
