<?php
/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Marjoram
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site <?php echo esc_attr(get_theme_mod( 'marjoram_boxed_layout', 'full' ) ) ; ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'marjoram' ); ?></a>

	<header id="masthead" class="site-header" <?php if ( has_header_image() ) { ?> style="background-image: url(<?php header_image(); ?>);" <?php } ?>>
		<div class="site-branding" style="margin:<?php echo esc_attr(get_theme_mod( 'marjoram_header_size', '2' ) ); ?>% auto;">		

			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php endif; ?>
			
			<?php if ( esc_attr(get_theme_mod( 'marjoram_show_site_title', true ) ) ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php endif; ?>
			
			<?php	if (esc_attr(get_theme_mod( 'marjoram_show_site_desc', true ) ) ) :
				$marjoram_description = get_bloginfo( 'description', 'display' );
					if ( $marjoram_description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $marjoram_description;  /* WPCS: xss ok. */ ?></p>
			<?php 
					endif;
				endif; ?>
				
		</div><!-- .site-branding -->
		<hr id="header-border">


	<div id="menu-wrapper" class="container">
		<div class="row">
			<div class="col-lg-12">
				<?php 
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'menu_class' => 'nav-menu ',
						'menu_id' => 'main-nav',
						'container' => 'nav',
						'container_id' => 'main-nav-container'
					) );					
				?>					
			</div>
		</div>
	</div>		
	
		
	</header><!-- #masthead -->
		
	<?php get_template_part( 'template-parts/sidebars/sidebar', 'banner' ); ?>			
	<?php get_template_part( 'template-parts/sidebars/sidebar', 'intro' ); ?>
	<?php get_template_part( 'template-parts/sidebars/sidebar', 'featured' ); ?>
