<div class="wooOneContainer">

	<div class="wooOneWelcomeContainer">
		
			<?php
			
				$business_contraWelcomePostTitle = '';
				$business_contraWelcomePostDesc = '';

				if( '' != get_theme_mod('business_contra_wooone_welcome_post') && 'select' != get_theme_mod('business_contra_wooone_welcome_post') ){

					$business_contraWelcomePostId = get_theme_mod('business_contra_wooone_welcome_post');

					if( ctype_alnum($business_contraWelcomePostId) ){

						$business_contraWelcomePost = get_post( $business_contraWelcomePostId );

						$business_contraWelcomePostTitle = $business_contraWelcomePost->post_title;
						$business_contraWelcomePostDesc = $business_contraWelcomePost->post_excerpt;
						$business_contraWelcomePostContent = $business_contraWelcomePost->post_content;

					}

				}			
			
			?>
			
			<h1><?php echo esc_html($business_contraWelcomePostTitle); ?></h1>
			<div class="wooOneWelcomeContent">
				<p>
					<?php 
					
						if( '' != $business_contraWelcomePostDesc ){
							
							echo esc_html($business_contraWelcomePostDesc);
							
						}else{
							
							echo esc_html($business_contraWelcomePostContent);
							
						}
					
					?>
				</p>
			</div><!-- .wooOneWelcomeContent -->	
		
	</div><!-- .wooOneWelcomeContainer -->
	
	
	<div class="new-arrivals-container">
		
		<?php 
					
			if( 'no' != get_theme_mod('business_contra_show_wooone_heading') ): 
			
				$business_contraWooOneLatestHeading = __('Latest Products', 'business-contra');	
				$business_contraWooOneLatestText = __('Some of our latest products', 'business-contra');
			
					
				if( '' != get_theme_mod('business_contra_wooone_latest_heading') ){
					$business_contraWooOneLatestHeading = get_theme_mod('business_contra_wooone_latest_heading');
				}
				
				if( '' != get_theme_mod('business_contra_wooone_latest_text') ){
					$business_contraWooOneLatestText = get_theme_mod('business_contra_wooone_latest_text');
				}				
			
					
		?>
		<div class="new-arrivals-title">
		
			<h3><?php echo esc_html($business_contraWooOneLatestHeading); ?></h3>
			<p><?php echo esc_html($business_contraWooOneLatestText); ?></p>
		
		</div><!-- .new-arrivals-title -->
		<?php endif; ?>
		
		<?php
			
			$business_contraWooOnePaged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
			
			$business_contra_front_page_ecom = array(
				'post_type' => 'product',
				'paged' => $business_contraWooOnePaged
			);
			$business_contra_front_page_ecom_the_query = new WP_Query( $business_contra_front_page_ecom );
			
			$business_contra_front_page_temp_query = $wp_query;
			$wp_query   = NULL;
			$wp_query   = $business_contra_front_page_ecom_the_query;
			
		?>		
		
		<div class="new-arrivals-content">
		<?php if ( have_posts() && post_type_exists('product') ) : ?>
		
		
			<div class="business_contra-woocommerce-content">
			
				<ul class="products">
			
					<?php /* Start the Loop */ ?>
					<?php while ( $business_contra_front_page_ecom_the_query->have_posts() ) : $business_contra_front_page_ecom_the_query->the_post(); ?>			
					<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
				
				</ul><!-- .products -->
				
				<?php //the_posts_navigation(); ?>
				
				<?php business_contra_pagination( $business_contraWooOnePaged, $business_contra_front_page_ecom_the_query->max_num_pages); // Pagination Function ?>
				
			</div><!-- .business_contra-woocommerce-content -->
			
		<?php else : ?>
		
			<p><?php echo __('Please install wooCommerce and add products.', 'business-contra') ?></p>

		<?php 
			
			endif; 
			wp_reset_postdata();
			$wp_query = NULL;
			$wp_query = $business_contra_front_page_temp_query;
		?>			
		
		
		</div><!-- .new-arrivals-content -->		
	
	</div><!-- .new-arrivals-container -->	

</div>