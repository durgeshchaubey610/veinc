<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Edulab
 */

get_header(); ?>

	<!-- Blog starts -->
	<div class="page-content">
		<!-- Blog grid starts -->
		<header class="page-header">
			<div class="container">
				<h1 class="page-title">
					<?php echo esc_html__( 'Search results for:', 'edulab' ); ?>
				</h1>
				<div class="page-description"><?php echo get_search_query(); ?></div>
			</div>
		</header><!-- .page-header -->

		<!-- Container starts -->
		<div class="container">
			<div class="primary">

				<?php
				if ( have_posts() ) : ?>
					<div class="grid-container" itemscope itemtype=" http://schema.org/Blog">

						<?php /* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						/* Pagination starts */
						the_posts_pagination(
				            array(
				                'mid_size'  => 3,
				                'prev_text' => __( 'Previous', 'edulab' ),
				                'next_text' => __( 'Next', 'edulab' ),
				            )
				        );
				        /* Pagination ends */ ?>
				    </div>

			    	<?php
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
