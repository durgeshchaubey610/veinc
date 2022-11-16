<?php
/**
 * Portfolio Section
 * 
 * @package edulab
*/
$edulab_ed_portfolio 		= get_theme_mod( 'ed_portfolio_section', false );
$edulab_portfolio_title 	= get_theme_mod( 'portfolio_title', __( 'Portfolio', 'edulab' ) );
$edulab_portfolio_desc 	= get_theme_mod( 'portfolio_desc' );
$edulab_portfolio_cat 		= get_theme_mod( 'portfolio_cat' ); 
$edulab_portfolio_args = array(
    'post_type' => 'post',
    'cat' => $edulab_portfolio_cat,
    
);
$edulab_portfolio_qry = new WP_Query( $edulab_portfolio_args );

if( $edulab_ed_portfolio ){
	if( $edulab_portfolio_cat ){ ?>

		<!-- portfolio section start -->

		<!-- portfolio section heading -->
		<section class="portfolio page-heading">
			<div class="container">
				<?php

				// title
	        	if( $edulab_portfolio_title ) echo '<h2 class="section-title">' . esc_html( $edulab_portfolio_title ) . '</h2>';

	        	// Description
	        	if( $edulab_portfolio_desc ) echo '<div class="section-desc"><p>' . wp_kses_post( $edulab_portfolio_desc ) . '</p></div>'; 

	        	?>
			</div>
		</section>
		<!-- portfolio section heading ends -->

		<?php 
		if( $edulab_portfolio_qry->have_posts() ){ ?>

			<!-- portfolio start -->
			<section class="gallery-images-section">
				<?php  
				while( $edulab_portfolio_qry->have_posts() ){ // while loop starts
	            	$edulab_portfolio_qry->the_post();

					if( has_post_thumbnail() ){
						global $post;
		            	?>
						<div class="gallery-img-wrap">

							<!-- title -->
							<a href="<?php echo esc_url( get_the_post_thumbnail_url( $post->ID ) ); ?>" data-lightbox="example-set" data-title="<?php the_title_attribute(); ?>">

								<!-- Image -->
								<?php the_post_thumbnail(); ?>

							</a>

						</div>
						<?php 
					}
				} // end whileloop
				wp_reset_postdata(); ?>
			</section>
			<!-- portfolio ends --><?php
		}
		// Portfolio section ends
	}
}