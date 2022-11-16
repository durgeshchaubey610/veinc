<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Edulab
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<!-- Head starts -->
<head itemscope itemtype="http://schema.org/WebSite">
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head><!-- Head ends -->

<!-- Body starts -->
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php wp_body_open(); ?>

	<!-- Page starts -->
	<div id="page" class="site" itemscope itemtype="http://schema.org/EducationalOrganization">
		<a class="skip-link screen-reader-text" href="#content">
		<?php _e( 'Skip to content', 'edulab' ); ?></a>

		<!-- Header starts -->
		<header class="site-header" itemscope itemtype="http://schema.org/WPHeader">

			<!-- Top Header starts -->
			<?php do_action( 'edulab_top_header' ); ?>
			<!-- Top Header ends -->

			<!-- Main Header starts -->
			<div class="main-header">
				<div class="container">

					<?php
					//site branding 
					edulab_header_site_branding();

					// Header Menu
					edulab_header_menu() ?>

				</div>
			</div>
			<!-- Main Header ends -->

		</header>
		<!-- Header ends -->
		<div id="content">