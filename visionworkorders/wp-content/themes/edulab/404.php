<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package edulab
 */
get_header(); ?>

	<!-- 404 starts -->
	<div class="page-content">

		<!-- Container starts -->
		<div class="container">

			<!-- 404 grid starts -->
			<div class="no-found-content">
				<p>
					<?php 
					esc_html_e( 'It looks like nothing was found at this location. Please search to get the exact content.', 'edulab' ); ?>
				</p>
				<div class="search">
					<?php 
					get_search_form();  ?>
				</div>
			</div>
			<!-- 404 grid ends -->

			<?php get_sidebar(); ?>
		</div>
		<!-- Container ends -->

	</div>
	<!-- 404 ends --><?php
	
get_footer();
