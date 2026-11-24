<?php
/**
 * Render dinámico + estado SSR de Interactivity API para albor/orientador-citas.
 *
 * @var array    $attributes Atributos del bloque.
 * @var string   $content    Contenido interno (no usado).
 * @var WP_Block $block      Instancia del bloque.
 */

defined( 'ABSPATH' ) || exit;

if ( function_exists( 'wp_enqueue_script_module' ) ) {
	wp_enqueue_script_module( '@wordpress/interactivity' );
}

$titulo   = isset( $attributes['titulo'] ) ? $attributes['titulo'] : '¿Qué te gustaría revisar en tu primera cita?';
$opciones = array(
	'valoracion' => array(
		'label'    => 'Valoración general',
		'duracion' => '40 min con especialista',
		'precio'   => 'Desde $95.000 COP',
		'detalle'  => 'Revisión clínica completa, explicación clara en lenguaje sencillo y plan de cuidado sin procedimientos innecesarios.',
		'waText'   => 'Hola Albor Odontología, quiero agendar una Valoración general en Medellín.',
	),
	'implantes'  => array(
		'label'    => 'Implantes dentales',
		'duracion' => '45 min diagnóstico 3D',
		'precio'   => 'Valoración desde $120.000 COP',
		'detalle'  => 'Evaluación de hueso, tiempos reales de cicatrización y presupuesto por etapas con el Dr. Andrés Saldarriaga [DEMO].',
		'waText'   => 'Hola Albor Odontología, quiero información y valoración para Implantes dentales.',
	),
	'ortodoncia' => array(
		'label'    => 'Ortodoncia estética',
		'duracion' => '40 min escaneo inicial',
		'precio'   => 'Planes desde $210.000 COP/mes',
		'detalle'  => 'Comparativa honesta entre alineadores transparentes y brackets estéticos según tu mordida y tiempo estimado.',
		'waText'   => 'Hola Albor Odontología, quiero agendar valoración de Ortodoncia estética.',
	),
	'urgencia'   => array(
		'label'    => 'Dolor o urgencia',
		'duracion' => 'Atención prioritaria el mismo día',
		'precio'   => 'Consulta prioritaria $110.000 COP',
		'detalle'  => 'Alivio seguro del dolor dental, control de fracturas o sensibilidad aguda dentro de nuestros horarios de atención.',
		'waText'   => 'Hola Albor Odontología, tengo una urgencia odontológica hoy en Medellín.',
	),
);

if ( function_exists( 'wp_interactivity_state' ) ) {
	wp_interactivity_state(
		'albor/orientador',
		array(
			'current'    => function () {
				$ctx      = wp_interactivity_get_context();
				$items    = isset( $ctx['items'] ) ? $ctx['items'] : array();
				$selected = isset( $ctx['selected'] ) ? $ctx['selected'] : 'valoracion';
				return isset( $items[ $selected ] ) ? $items[ $selected ] : ( isset( $items['valoracion'] ) ? $items['valoracion'] : array() );
			},
			'isSelected' => function () {
				$ctx      = wp_interactivity_get_context();
				$selected = isset( $ctx['selected'] ) ? $ctx['selected'] : 'valoracion';
				$slug     = isset( $ctx['buttonSlug'] ) ? $ctx['buttonSlug'] : '';
				return $slug === $selected;
			},
			'waHref'     => function () {
				$ctx      = wp_interactivity_get_context();
				$items    = isset( $ctx['items'] ) ? $ctx['items'] : array();
				$selected = isset( $ctx['selected'] ) ? $ctx['selected'] : 'valoracion';
				$wa_text  = isset( $items[ $selected ]['waText'] ) ? $items[ $selected ]['waText'] : 'Hola Albor Odontología, quiero agendar una valoración.';
				return 'https://wa.me/573000000000?text=' . rawurlencode( $wa_text );
			},
		)
	);
}

$context_json = wp_interactivity_data_wp_context(
	array(
		'selected' => 'valoracion',
		'items'    => $opciones,
	)
);

$wrapper_attributes = get_block_wrapper_attributes(
	array(
		'class'               => 'albor-orientador',
		'data-wp-interactive' => 'albor/orientador',
	)
);
$inicial            = $opciones['valoracion'];
?>
<section <?php echo $wrapper_attributes; ?> <?php echo $context_json; ?>>
	<div class="albor-orientador__head">
		<p class="albor-orientador__eyebrow">Orientador rápido antes de agendar</p>
		<h3 class="albor-orientador__title"><?php echo esc_html( $titulo ); ?></h3>
	</div>

	<div class="albor-orientador__tabs" role="group" aria-label="<?php echo esc_attr__( 'Motivos de consulta odontológica', 'albor-odontologia' ); ?>">
		<?php
		foreach ( $opciones as $slug => $item ) :
			$btn_ctx = wp_interactivity_data_wp_context( array( 'buttonSlug' => $slug ) );
			?>
			<button
				type="button"
				class="albor-orientador__pill"
				<?php echo $btn_ctx; ?>
				data-motivo="<?php echo esc_attr( $slug ); ?>"
				data-wp-on--click="actions.selectMotivo"
				data-wp-bind--aria-pressed="state.isSelected"
				aria-pressed="<?php echo ( 'valoracion' === $slug ) ? 'true' : 'false'; ?>"
			>
				<?php echo esc_html( $item['label'] ); ?>
			</button>
		<?php endforeach; ?>
	</div>

	<div class="albor-orientador__panel" aria-live="polite">
		<div class="albor-orientador__meta">
			<span class="albor-badge" data-wp-text="state.current.duracion"><?php echo esc_html( $inicial['duracion'] ); ?></span>
			<span class="albor-badge albor-badge--warm" data-wp-text="state.current.precio"><?php echo esc_html( $inicial['precio'] ); ?></span>
		</div>
		<p class="albor-orientador__desc" data-wp-text="state.current.detalle"><?php echo esc_html( $inicial['detalle'] ); ?></p>
		<div class="albor-orientador__actions">
			<a class="albor-btn albor-btn--primary" href="<?php echo esc_url( home_url( '/contacto/#agenda-valoracion' ) ); ?>">
				Solicitar esta cita online
			</a>
			<a
				class="albor-btn albor-btn--ghost"
				target="_blank"
				rel="noopener noreferrer"
				data-wp-bind--href="state.waHref"
				data-albor-wa
				data-cta-location="bloque_orientador"
				href="<?php echo esc_url( 'https://wa.me/573000000000?text=' . rawurlencode( $inicial['waText'] ) ); ?>"
			>
				Consultar por WhatsApp
			</a>
		</div>
	</div>
</section>
