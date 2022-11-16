<?php 
/**
 * Testimonial Section
 * 
 * @package edulab
*/
$edulab_ed_testimonial 	= get_theme_mod( 'ed_testimonial_section', false );
$edulab_testimonial_title 	= get_theme_mod( 'testimonial_title', __( 'WHAT OTHER SAY ABOUT US', 'edulab' ) );
$edulab_testimonial_desc 	= get_theme_mod( 'testimonial_desc', __( 'You can trust our clients', 'edulab' ) );
$edulab_testimonial_cat 	= get_theme_mod( 'testimonial_cat' ); 
$edulab_testimonial_args 	= array(
    'post_type' => 'post',
    'cat' => $edulab_testimonial_cat,
    
);
$edulab_testimonial_qry = new WP_Query( $edulab_testimonial_args );
if( $edulab_testimonial_cat && $edulab_ed_testimonial ){
	?>
	<!-- Testimonial section Start -->
	<section class="what-other-say">
		<div class="container">
			<?php 


			// Heading title
    		if( $edulab_testimonial_title ) echo '<h2 class="head">' . esc_html( $edulab_testimonial_title ) . '</h2>';
    		
    		// Heading description
    		if( $edulab_testimonial_desc ) echo '<div class="section-desc"><p>' . esc_html( $edulab_testimonial_desc ) . '</p></div>';

    		if( $edulab_testimonial_qry->have_posts() ){ ?>
				<div class="three owl-carousel owl-theme">
					<?php 
					while( $edulab_testimonial_qry->have_posts() ){
		            	$edulab_testimonial_qry->the_post();
		            	?>

						<div class="customer-item" itemscope itemtype="http://schema.org/Rating">
							<div class="border">
								<div class="customer">
									<figure>
										<?php 
										if( has_post_thumbnail() ){
											the_post_thumbnail( 'edulab-image-90x90' );	
										} ?>
										<figcaption>
											<span itemprop="author"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
										</figcaption>
									</figure>
								</div>
								<div class="customer-review">
									<p><?php echo esc_html( wp_trim_words( get_the_content(), 100 ) ); ?></p>
								</div>
							</div>
						</div>
						<?php 
					}
					wp_reset_postdata(); ?>
				</div>
				<?php 
			} ?>
		</div>
	</section>
	<?php 
}