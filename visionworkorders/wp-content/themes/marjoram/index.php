<?php
/**
 * This template sets the foundation layout for the blog and archive pages.
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package Marjoram
 */

$bloglayout = esc_attr(get_theme_mod( 'marjoram_blog_layout', 'blog1' ));
 
get_header();
?>
	<div id="content" class="site-content container">
	<div class="row">


<?php // grid with left sidebar
if ( $bloglayout == 'blog8')  : ?>

	<div id="primary" class="content-area col-lg-8 order-lg-2">
		<main id="main" class="site-main <?php echo esc_attr( $bloglayout ); ?>">
		<?php get_template_part( 'template-parts/layouts/blog', 'grid' ); ?></main>
	</div>
	<div class="col-lg-4 order-3 order-lg-1">
		<?php get_template_part( 'template-parts/sidebars/sidebar', 'left' ); ?>       
	</div>

<?php // grid with right sidebar
elseif ( $bloglayout == 'blog7')  : ?>

	<div id="primary" class="content-area col-lg-8">
		<main id="main" class="site-main <?php echo esc_attr( $bloglayout ); ?>">
		<?php get_template_part( 'template-parts/layouts/blog', 'grid' ); ?></main>
	</div>
	<div class="col-lg-4">
	<?php get_template_part( 'template-parts/sidebars/sidebar', 'right' ); ?>
	</div>

<?php // grid blog no sidebars
elseif ( $bloglayout == 'blog6')  : ?>

	<div id="primary" class="content-area col-lg-12">
		<main id="main" class="site-main <?php echo esc_attr( $bloglayout ); ?>">
		<?php get_template_part( 'template-parts/layouts/blog', 'grid' ); ?></main>
	</div>

<?php // standard blog left sidebar
elseif ( $bloglayout == 'blog2')  : ?>

	<div id="primary" class="content-area col-lg-8 order-lg-2">
		<main id="main" class="site-main <?php echo esc_attr( $bloglayout ); ?>">
		<?php get_template_part( 'template-parts/layouts/blog', 'default' ); ?></main>
	</div>
	<div class="col-lg-4 order-3 order-lg-1">
		<?php get_template_part( 'template-parts/sidebars/sidebar', 'left' ); ?>       
	</div>		
	
<?php // standard blog right sidebar
else : ?>

	<div id="primary" class="content-area col-lg-8">
		<main id="main" class="site-main <?php echo esc_attr( $bloglayout ); ?>">
		<?php get_template_part( 'template-parts/layouts/blog', 'default' ); ?></main>
	</div>
	<div class="col-lg-4">
	<?php get_template_part( 'template-parts/sidebars/sidebar', 'right' ); ?>
	</div>
	
<?php endif; ?>

</div><!-- .row -->
</div><!-- .container -->	

<?php
get_footer();