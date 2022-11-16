<?php
/**
 * Blog Section
 * 
 * @package edulab
*/

$edulab_ed_blog 		 	= get_theme_mod( 'ed_blog_section', true );
$edulab_blog_title  = get_theme_mod( 'blog_section_title', __( 'Recent Posts', 'edulab' ) );
$edulab_blog_sub_title  	= get_theme_mod( 'blog_section_subtitle', __( 'See what other people are saying about us', 'edulab' ) );
$edulab_blog_cat 	= get_theme_mod( 'blog_cat', '1' ); 
$edulab_blog_args 	= array(
    'post_type' 			=> 'post',
    'cat'					=> $edulab_blog_cat,
    'orderby'   			=> 'post__in',
    'post_status'       	=> 'publish',
    'posts_per_page'      	=> 5,
    'ignore_sticky_posts' 	=> true    
);

	$edulab_blog_qry = new WP_Query( $edulab_blog_args );

if( $edulab_ed_blog ){
	if( $edulab_blog_title || $edulab_blog_sub_title || $edulab_blog_qry->have_posts() ){ ?>

		<!-- Blog section starts -->

		<!-- Blog section heading title and subtitle starts -->
		<section class="blog page-heading">
			<div class="container">
				<?php 

				// Section heading title
	        	if( $edulab_blog_title ) echo '<h2 class="section-title">' . esc_html( $edulab_blog_title ) . '</h2>';

	        	// Section heading subtitle
	        	if( $edulab_blog_sub_title ) echo '<div class="section-desc"><p>' . wp_kses_post( $edulab_blog_sub_title ) . '</p></div>'; 

	        	?>
			</div>
		</section>
		<!-- Blog section heading title and subtitle ends -->

		<?php
		if( $edulab_blog_qry->have_posts() ){ ?>

			<!-- Blog post starts -->
			<section class="latest-news">
				<div class="container">
					<div class="owl-two owl-carousel">
						<?php 
						while( $edulab_blog_qry->have_posts() ){ //while loop starts
		                	$edulab_blog_qry->the_post(); ?>

		                	<!-- Blog items starts -->
							<div class="news-wrap">

								<!-- Feature image -->
								<div class="news-img-wrap">
									<?php
		                            if( has_post_thumbnail() ){

		                            	// Blog feature image
		                                the_post_thumbnail( 'edulab-571x349', array( 'itemprop' => 'image' ) );

		                            }else{  ?>

		                            	<!--  Default image -->
		                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/latest-new-img.png' ); ?>" alt="">
		                                <?php
		                            } ?>
			                    </div>
			                    <!-- Feature image ends -->

			                    <!-- Blog post details -->
								<div class="news-detail">

									<!-- blog title -->
									<a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
									<h2><?php 
										edulab_posted_by();  //posted by
										echo '<span class="seperator"></span>';  // seperator	
										the_time(); // published date ?>
									</h2>

									<!-- Blog Content -->
									<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 15 ) ); ?></p>

								</div>
								<!-- Blog post details ends -->

							</div>
							<!-- Blog items ends -->
							<?php 
						} //whileloop ends
						wp_reset_postdata(); ?>
					</div>
				</div>
			</section>
			<!-- Blog post ends -->
			<?php 
		}
		// Blog Section ends 
	}
}