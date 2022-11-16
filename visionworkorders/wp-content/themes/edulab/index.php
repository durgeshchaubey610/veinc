<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Edulab
 */

get_header(); ?>

	<!-- Blog starts -->
	<div class="page-content">

		<!-- Container starts -->
		<div class="container">

			<!-- Blog grid starts -->
			<div class="grid-container" itemscope itemtype=" http://schema.org/Blog">

				<?php
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

					/* Pagination starts */
					the_posts_pagination(
			            array(
			                'mid_size'  => 3,
			                'prev_text' => __( 'Previous', 'edulab' ),
			                'next_text' => __( 'Next', 'edulab' ),
			            )
			        );
			        /* Pagination ends */

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div>
			<!-- Blog grid ends -->

			<?php get_sidebar(); ?>
		</div>
		<!-- Container ends -->

	</div>
	<!-- Blog ends --><?php
	
get_footer();
