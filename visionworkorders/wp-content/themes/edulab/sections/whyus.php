<?php 
/**
 * Why us Section
 * 
 * @package edulab
*/

$edulab_ed_whyus 		= get_theme_mod( 'ed_whyus_section', false );
$edulab_why_us_about 	= get_theme_mod( 'why_us_about' );
$edulab_why_us 		= get_theme_mod( 'why_us' );
$edulab_readmore 		= get_theme_mod( 'whyus_readmore', __( 'Read More', 'edulab' ) );

if( $edulab_ed_whyus && ( $edulab_why_us_about || $edulab_why_us ) ){ ?>

	<!-- Why us section start -->
	<section class="whyUs-section">
		<div class="container">
			<?php 
			if( $edulab_why_us ){ ?>

				<!-- Why us feature points -->
				<div class="featured-points">
					<ul>
						<?php 
						foreach ( $edulab_why_us as $edulab_why ) { ?>
							<li><i class="<?php echo esc_attr( $edulab_why['font'] ); ?>"></i><?php echo esc_html( $edulab_why['title'] ); ?></li>
							<?php
						} ?>
					</ul>
				</div>
				<!-- Why us feature points ends -->
				<?php
			} 
			if( $edulab_why_us_about ){
				$edulab_whyus_query = new WP_Query( array('page_id'=>$edulab_why_us_about ) );

				// <!-- Why us desc -->
				while( $edulab_whyus_query->have_posts() ){ // start while loop
		    		$edulab_whyus_query->the_post(); ?>
					<div class="whyus-wrap">

						<!-- title -->
						<h2><?php the_title(); ?></h2>

						<!-- Excerpt -->
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 100 ) ); ?></p>

						<!-- Read More -->
						<a href="<?php the_permalink(); ?>" class="read-more-btn"><?php echo esc_html( $edulab_readmore ); ?></a>
					</div><?php 
				} // end whileloop
				wp_reset_postdata();
			} ?>
		</div>
	</section>
	<!-- Why us section ends -->
	<?php 
} ?>
