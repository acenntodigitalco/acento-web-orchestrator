<?php
/**
 * Title: Footer Albor Odontología
 * Slug: albor/footer-albor
 * Categories: albor-secciones
 * Inserter: no
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"align":"full","style":{"color":{"background":"var:preset|color|eucalyptus","text":"var:preset|color|canvas"},"spacing":{"padding":{"top":"var:preset|spacing|lg","bottom":"var:preset|spacing|md"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-canvas-color has-eucalyptus-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--lg);padding-bottom:var(--wp--preset--spacing--md)">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"2rem","left":"2.5rem"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"40%"} -->
		<div class="wp-block-column" style="flex-basis:40%">
			<!-- wp:heading {"level":3,"style":{"color":{"text":"var:preset|color|surface"}}} -->
			<h3 class="wp-block-heading has-surface-color has-text-color">Albor Odontología</h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.94rem"}}} -->
			<p style="font-size:0.94rem">Odontología conservadora, implantología y estética natural en El Poblado, Medellín. Diagnósticos honestos en tiempo real sin tratamientos innecesarios.</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.82rem"}}} -->
			<p style="font-size:0.82rem">Albor Salud Oral S.A.S. · NIT 901.734.812-6 · Habilitación REPS 05001-88412-DEMO [DEMO]</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"30%"} -->
		<div class="wp-block-column" style="flex-basis:30%">
			<!-- wp:heading {"level":3,"style":{"color":{"text":"var:preset|color|surface"}}} -->
			<h3 class="wp-block-heading has-surface-color has-text-color">Consultorio y horarios</h3>
			<!-- /wp:heading -->
			<!-- wp:html -->
			<ul style="list-style:none;padding:0;margin:0;display:grid;gap:0.45rem;font-size:0.92rem">
				<li>Calle 10A # 36-24, El Poblado, Medellín [DEMO]</li>
				<li>Tel / WhatsApp: <a href="tel:+573000000000" style="color:#F8F6F1">+57 300 000 0000 [DEMO]</a></li>
				<li>Correo: <a href="mailto:citas@alborodontologia.example" style="color:#F8F6F1">citas@alborodontologia.example</a></li>
				<li>Lunes a viernes: 7:30 AM – 6:30 PM</li>
				<li>Sábados: 8:00 AM – 2:00 PM</li>
			</ul>
			<!-- /wp:html -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"30%"} -->
		<div class="wp-block-column" style="flex-basis:30%">
			<!-- wp:heading {"level":3,"style":{"color":{"text":"var:preset|color|surface"}}} -->
			<h3 class="wp-block-heading has-surface-color has-text-color">Secciones</h3>
			<!-- /wp:heading -->
			<!-- wp:html -->
			<ul style="list-style:none;padding:0;margin:0;display:grid;gap:0.45rem;font-size:0.92rem">
				<li><a href="<?php echo esc_url( home_url( '/quienes-somos/' ) ); ?>" style="color:#F8F6F1">Quiénes somos y equipo</a></li>
				<li><a href="<?php echo esc_url( home_url( '/servicios/' ) ); ?>" style="color:#F8F6F1">Especialidades y tarifas</a></li>
				<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" style="color:#F8F6F1">Guías de salud dental</a></li>
				<li><a href="<?php echo esc_url( home_url( '/contacto/' ) ); ?>" style="color:#F8F6F1">Agendar valoración</a></li>
				<li><button type="button" data-albor-open-privacy style="background:none;border:0;padding:0;color:#F8F6F1;text-decoration:underline;cursor:pointer;font-size:0.92rem">Preferencias de privacidad</button></li>
			</ul>
			<!-- /wp:html -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:html -->
<aside class="albor-consent" id="albor-consent-banner" aria-label="Preferencias de privacidad" hidden>
	<p style="margin:0;font-weight:700;font-size:0.9rem">Privacidad y medición</p>
	<p style="margin:0;font-size:0.81rem;color:#4A5A55">Solo activamos analítica web si lo autorizas. Puedes rechazarlas y agendar tu cita igualmente.</p>
	<div class="albor-consent__actions">
		<button type="button" class="albor-consent-btn albor-consent-btn--primary" data-albor-accept>Aceptar</button>
		<button type="button" class="albor-consent-btn" data-albor-reject>Rechazar</button>
		<button type="button" class="albor-consent-btn" data-albor-open-privacy>Configurar</button>
	</div>
</aside>

<dialog class="albor-dialog" id="albor-privacy-dialog" aria-labelledby="albor-dialog-title">
	<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.75rem">
		<h3 id="albor-dialog-title" style="margin:0;font-size:1.25rem">Preferencias de privacidad</h3>
		<form method="dialog"><button type="submit" aria-label="Cerrar" style="min-width:44px;min-height:44px;border-radius:50%;border:1px solid #DCE2DC;background:#F8F6F1;cursor:pointer">×</button></form>
	</div>
	<p style="font-size:0.9rem;color:#4A5A55">Consent Mode v2 inicia desactivado por defecto. Elige tus preferencias:</p>
	<label style="display:flex;justify-content:space-between;align-items:center;padding:0.7rem 0;border-bottom:1px solid #DCE2DC">
		<span><strong>Analítica (GA4)</strong></span>
		<input type="checkbox" id="albor-consent-analytics" style="width:1.2rem;height:1.2rem">
	</label>
	<label style="display:flex;justify-content:space-between;align-items:center;padding:0.7rem 0">
		<span><strong>Medición de anuncios</strong></span>
		<input type="checkbox" id="albor-consent-ads" style="width:1.2rem;height:1.2rem">
	</label>
	<div class="albor-consent__actions" style="margin-top:1rem">
		<button type="button" class="albor-consent-btn albor-consent-btn--primary" id="albor-save-privacy">Guardar preferencias</button>
		<button type="button" class="albor-consent-btn" data-albor-reject>Rechazar todo</button>
	</div>
</dialog>
<!-- /wp:html -->
