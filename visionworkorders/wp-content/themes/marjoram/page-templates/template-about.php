<?php
/**
 * Template Name: About
 * @package Marjoram
*/

get_header(); ?>

<div id="content" class="site-content">
	<div class="row">
		<div id="primary" class="content-area about-page">

			<main id="main" class="site-main ">
							
					<?php while ( have_posts() ) : the_post(); 
					get_template_part( 'template-parts/page/content', 'page' ); 
					endwhile; ?>	
			</main>
			
		</div>

	</div>
</div>

<?php 
get_footer();