    <div class="site-slider business_contra-owl-basic">

        <div id="business_contra-owl-basic" class="owl-carousel owl-theme">
    
    		<?php 
			
				if(get_theme_mod('business_contra_slider_num')){
					$business_contra_slider_num = get_theme_mod('business_contra_slider_num');
				}else{
					$business_contra_slider_num = '5';
				}
			
				if(get_theme_mod('business_contra_slider_cat')){
					$business_contra_slider_cat = get_theme_mod('business_contra_slider_cat');
				}else{
					$business_contra_slider_cat = 0;
				}			
			
				$business_contra_slider_args = array(
                    // Change these category SLUGS to suit your use.
                    'ignore_sticky_posts' => 1,
                    'post_type' => array('post'),
                    'posts_per_page'=> $business_contra_slider_num,
					'cat' => $business_contra_slider_cat
               );
        
			   $business_contra_slider = new WP_Query($business_contra_slider_args);
			
            if ( $business_contra_slider->have_posts() ) : ?>            
			<?php /* Start the Loop */ ?>
			<?php while ( $business_contra_slider->have_posts() ) : $business_contra_slider->the_post(); ?>
            <div class="owl-carousel-slide">
                
                <?php if ( has_post_thumbnail()) : ?>	
                <?php the_post_thumbnail('business_contra-owl'); ?>
                <?php else : ?>
                    <img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/2000.png">
                <?php endif; ?>
                
                <div class="owl-carousel-caption-container">
                    <h3>
						<a href="<?php the_permalink() ?>">
						<?php the_title(); ?>
                        </a>
                    </h3>
                    <div class="owl-carousel-caption">
						<p><?php echo esc_html(business_contra_limitedstring(get_the_excerpt())); ?></p>
						<p><a href="<?php the_permalink() ?>"><?php echo __( 'Read More', 'business-contra' ); ?></a></p>
					</div>
                </div>
                 	
            </div>
    		<?php endwhile; wp_reset_postdata(); endif; ?>
            
         </div>
    
    </div><!-- .site-slider --> 