<?php
/**
 * Title: Cabecera de navegación Albor (Desktop limpio + Móvil compacto)
 * Slug: albor/header-nav
 * Categories: albor-secciones
 * Inserter: no
 */

defined( 'ABSPATH' ) || exit;

$nav_items = array(
	array(
		'label'  => 'Inicio',
		'url'    => home_url( '/' ),
		'active' => is_front_page(),
	),
	array(
		'label'  => 'Quiénes somos',
		'url'    => home_url( '/quienes-somos/' ),
		'active' => is_page( 'quienes-somos' ),
	),
	array(
		'label'  => 'Servicios',
		'url'    => home_url( '/servicios/' ),
		'active' => is_page( 'servicios' ),
	),
	array(
		'label'  => 'Blog',
		'url'    => home_url( '/blog/' ),
		'active' => is_home() || is_singular( 'post' ),
	),
	array(
		'label'  => 'Contacto',
		'url'    => home_url( '/contacto/' ),
		'active' => is_page( 'contacto' ),
	),
);
?>
<!-- wp:html -->
<a class="albor-skip-link" href="#contenido-principal">Ir al contenido principal</a>
<div class="albor-header-wrap">
	<div class="albor-header-bar">
		<a class="albor-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<span class="albor-brand__mark" aria-hidden="true">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round">
					<path d="M12 4c-3.8 0-6.5 2.7-6.5 6.3 0 2.5 1 4.6 1.8 7.5.4 1.5 1.1 2.2 1.9 2.2s1.2-1.9 2.8-1.9 2 1.9 2.8 1.9 1.5-.7 1.9-2.2c.8-2.9 1.8-5 1.8-7.5C18.5 6.7 15.8 4 12 4Z"/>
				</svg>
			</span>
			<span>Albor Odontología</span>
		</a>

		<nav class="albor-nav-desktop" aria-label="Navegación principal">
			<?php foreach ( $nav_items as $item ) : ?>
				<a
					class="albor-nav-link"
					href="<?php echo esc_url( $item['url'] ); ?>"
					<?php echo $item['active'] ? 'aria-current="page"' : ''; ?>
				>
					<?php echo esc_html( $item['label'] ); ?>
				</a>
			<?php endforeach; ?>
			<a class="albor-btn albor-btn--primary" href="<?php echo esc_url( home_url( '/contacto/#agenda-valoracion' ) ); ?>" style="margin-left:0.5rem">Agendar cita</a>
		</nav>

		<details class="albor-nav-mobile">
			<summary aria-label="Abrir menú principal">
				<span>Menú</span>
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
					<line x1="4" y1="7" x2="20" y2="7"/>
					<line x1="4" y1="12" x2="20" y2="12"/>
					<line x1="4" y1="17" x2="20" y2="17"/>
				</svg>
			</summary>
			<nav class="albor-nav-drawer" aria-label="Navegación móvil">
				<?php foreach ( $nav_items as $item ) : ?>
					<a
						href="<?php echo esc_url( $item['url'] ); ?>"
						<?php echo $item['active'] ? 'aria-current="page"' : ''; ?>
					>
						<?php echo esc_html( $item['label'] ); ?>
					</a>
				<?php endforeach; ?>
				<a class="albor-btn albor-btn--primary" href="<?php echo esc_url( home_url( '/contacto/#agenda-valoracion' ) ); ?>" style="margin-top:0.35rem;width:100%">Agendar cita</a>
			</nav>
		</details>
	</div>
</div>
<!-- /wp:html -->
