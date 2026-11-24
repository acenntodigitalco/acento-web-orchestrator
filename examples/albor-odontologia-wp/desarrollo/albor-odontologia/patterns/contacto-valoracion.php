<?php
/**
 * Title: Formulario CRO de valoración dental + contacto
 * Slug: albor/contacto-valoracion
 * Categories: albor-secciones
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|md","bottom":"var:preset|spacing|xl"}}},"layout":{"type":"constrained"}} -->
<div id="agenda-valoracion" class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--md);padding-bottom:var(--wp--preset--spacing--xl)">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"2rem","left":"3rem"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"48%"} -->
		<div class="wp-block-column" style="flex-basis:48%">
			<!-- wp:paragraph {"className":"albor-eyebrow"} -->
			<p class="albor-eyebrow">Agenda directa</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading">Solicita tu valoración en menos de 1 minuto</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>Déjanos solo cuatro datos y confirmamos tu horario en la misma jornada laboral. Si prefieres, escríbenos directo por WhatsApp.</p>
			<!-- /wp:paragraph -->
			<!-- wp:html -->
			<div class="albor-card albor-card--sage" style="margin-top:1.25rem;display:grid;gap:0.55rem;font-size:0.94rem">
				<strong>Albor Odontología — El Poblado, Medellín [DEMO]</strong>
				<span>Calle 10A # 36-24, Medellín · L–V 7:30 AM a 6:30 PM · Sáb 8:00 AM a 2:00 PM</span>
				<div>
					<a class="albor-btn albor-btn--ghost" target="_blank" rel="noopener noreferrer" data-albor-wa data-cta-location="contacto_sidebar" href="https://wa.me/573000000000?text=Hola%20Albor%20Odontolog%C3%ADa%2C%20quiero%20agendar%20una%20cita%20en%20Medell%C3%ADn.">Hablar por WhatsApp (+57 300 000 0000)</a>
				</div>
			</div>
			<!-- /wp:html -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"52%"} -->
		<div class="wp-block-column" style="flex-basis:52%">
			<!-- wp:html -->
			<form class="albor-form" id="albor-valoracion-form" novalidate>
				<div class="albor-field">
					<label for="albor-nombre">Nombre completo</label>
					<input id="albor-nombre" name="nombre" type="text" autocomplete="name" required placeholder="Ej. Carolina Gómez">
					<span class="albor-field__error" id="albor-nombre-error" aria-live="polite"></span>
				</div>

				<div class="albor-field">
					<label for="albor-celular">Celular o WhatsApp</label>
					<input id="albor-celular" name="celular" type="tel" inputmode="tel" autocomplete="tel" required placeholder="Ej. 300 000 0000">
					<span class="albor-field__hint">Lo usamos únicamente para confirmar tu horario disponible.</span>
					<span class="albor-field__error" id="albor-celular-error" aria-live="polite"></span>
				</div>

				<div class="albor-field">
					<label for="albor-motivo">Motivo principal</label>
					<select id="albor-motivo" name="motivo" required>
						<option value="valoracion">Valoración general ($95.000)</option>
						<option value="implantes">Implantes dentales</option>
						<option value="ortodoncia">Ortodoncia estética / alineadores</option>
						<option value="estetica">Estética conservadora</option>
						<option value="urgencia">Dolor o urgencia odontológica</option>
					</select>
					<span class="albor-field__error" id="albor-motivo-error" aria-live="polite"></span>
				</div>

				<fieldset class="albor-field" style="border:0;padding:0;margin:0">
					<legend style="font-weight:700;font-size:0.92rem;margin-bottom:0.45rem">Franja preferida</legend>
					<div class="albor-radios">
						<label class="albor-radio-pill"><input type="radio" name="franja" value="manana" checked> Mañana (7:30–12:00)</label>
						<label class="albor-radio-pill"><input type="radio" name="franja" value="tarde"> Tarde (1:00–6:30)</label>
						<label class="albor-radio-pill"><input type="radio" name="franja" value="sabado"> Sábado</label>
					</div>
				</fieldset>

				<button type="submit" id="albor-submit-btn" class="albor-btn albor-btn--primary">Solicitar valoración</button>
				<div id="albor-form-status" class="albor-form-status" role="status" aria-live="polite" hidden></div>
			</form>
			<!-- /wp:html -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
