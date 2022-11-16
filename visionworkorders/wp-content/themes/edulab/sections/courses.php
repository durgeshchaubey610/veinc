<?php
/**
 * Course Section
 * 
 * @package edulab
*/

$edulab_ed_course 		= get_theme_mod( 'ed_courses_section', false );
$edulab_courses_title 	= get_theme_mod( 'courses_title', __( 'Popular Courses', 'edulab' ) );
$edulab_courses_1 		= get_theme_mod( 'courses_no_1' );
$edulab_courses_2 		= get_theme_mod( 'courses_no_2' );
$edulab_courses_3 		= get_theme_mod( 'courses_no_3' );
$edulab_courses_4 		= get_theme_mod( 'courses_no_4' );
$edulab_courses_5 		= get_theme_mod( 'courses_no_5' );
$edulab_courses_6 		= get_theme_mod( 'courses_no_6' );

$edulab_courses 		= array( $edulab_courses_1, $edulab_courses_2, $edulab_courses_3, $edulab_courses_4, $edulab_courses_5, $edulab_courses_6 );			
$edulab_courses 		= array_diff( array_unique( $edulab_courses ), array('') );

$edulab_courses_args = array(
    'post_type'  			=> 'post',
    'post__in'   			=> $edulab_courses,
    'orderby'   			=> 'post__in',
    'ignore_sticky_posts' 	=> true,
);
if( $edulab_ed_course ){
	$edulab_courses_qry = new WP_Query( $edulab_courses_args );
	if( $edulab_courses_1 || $edulab_courses_2 || $edulab_courses_3 || $edulab_courses_4 || $edulab_courses_5 || $edulab_courses_6 ){ ?> 

		<!-- Courses section start -->

		<!-- Course section title -->
		<div class="course page-heading">
			<div class="container">

				<!-- title -->
				<h2 class="section-title"><?php echo esc_html( $edulab_courses_title ); ?></h2>

			</div>
		</div>
		<!-- Course section title ends -->

		<div class="learn-courses">
			<div class="container">
				<?php 
				if( $edulab_courses_qry->have_posts() ){ ?>

					<!-- courses starts -->
					<div class="courses">
						<div class="owl-one owl-carousel">
							<?php 
							while( $edulab_courses_qry->have_posts() ){ 
			            		$edulab_courses_qry->the_post();
			                	?>

			                	<!-- Course item starts -->
								<div class="box-wrap" itemscope itemtype=" http://schema.org/Course">

									<!-- Feature image wrap -->
									<div class="img-wrap" itemprop="image">
										<?php 
										if( has_post_thumbnail() ){

											// Post feature image
											the_post_thumbnail( 'edulab-image-394x262' );

										} ?>

										<!-- Course tile -->
										<a href="<?php the_permalink(); ?>" class="learn-desining-banner" itemprop="name"><?php the_title(); ?></a>

									</div>
									<!-- Feature image wrap ends -->

									<!-- Courses details -->
									<div class="box-body">

										<!-- content starts -->
										<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 40 ) ); ?></p>

									</div>
									<!-- Courses details ends -->

								</div>
								<!-- Course item ends -->
								<?php 
							} // while loop ends
							wp_reset_postdata(); ?>
						</div>
					</div>
					<!-- courses ends --><?php

				} ?>
			</div>
		</div>
		<!-- Courses ends -->
		
		<?php 
	}
}