<?php
/**
 * Template Name: Left &amp; Right Column
 * @package Marjoram
*/

get_header(); ?>

	<div id="content" class="site-content container">
	<div class="row">
<div id="primary" class="content-area col-lg-6 order-lg-2">	

	<main id="main" class="site-main ">
					
			<?php while ( have_posts() ) : the_post(); 
			get_template_part( 'template-parts/page/content', 'page' ); 
			if ( comments_open() || get_comments_number() ) :
			comments_template();
			endif;
			endwhile; ?>	
			 		
	</main>

</div>

<div class="col-lg-3 order-3 order-lg-1">        
	<?php get_template_part( 'template-parts/sidebars/sidebar', 'left' ); ?>       
</div>

<div class="col-lg-3 order-12">        
	<?php get_template_part( 'template-parts/sidebars/sidebar', 'right' ); ?>       
</div>

	</div><!-- .row -->
	</div><!-- .container -->
	
<?php 
get_footer();