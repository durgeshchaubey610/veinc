<?php
/**
 * Displays social navigation
 * @package Marjoram
 */
?>

<?php	if ( has_nav_menu( 'social' ) ) : ?>
	<nav class="social-navigation" aria-label="<?php esc_attr_e( 'Social Menu', 'marjoram' ); ?>">
		<?php
			wp_nav_menu( array(
				'container' => false,
				'theme_location' => 'social',
				'menu_class'     => 'social-menu',
				'link_before'    => '<span class="screen-reader-text">',
				'link_after'     => '</span>',
				'depth'          => 1,
			) );
		?>
	</nav>
<?php endif; ?>
	
