<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Edulab
 */
$edulab_sidebar_layout = edulab_sidebar_layout();

get_header();
?>
	<div class="page-content" itemscope itemtype=" http://schema.org/Blog">
		<div class="container">
			<div class="primary">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'page' );

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif; 

				endwhile;

				?>
			</div><?php
			if( $edulab_sidebar_layout === 'right-sidebar' )
			get_sidebar();
			?>
		</div>
	</div><?php
get_footer();