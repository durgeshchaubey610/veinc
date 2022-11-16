<div class="businessContraTwoContainer">
	
	<div class="businessContraTwoServices">
		
		<?php if( '' != get_theme_mod('business_contra_two_welcome_post') && 'select' != get_theme_mod('business_contra_two_welcome_post') ) : 

				$business_contra_TwoWelcomePostTitle = '';
				$business_contra_TwoWelcomePostDesc = '';
				$business_contra_TwoWelcomePostContent = '';


				$business_contra_TwoWelcomePostId = get_theme_mod('business_contra_two_welcome_post');

				if( ctype_alnum($business_contra_TwoWelcomePostId) ){

					$business_contra_TwoWelcomePost = get_post( $business_contra_TwoWelcomePostId );

					$business_contra_TwoWelcomePostTitle = $business_contra_TwoWelcomePost->post_title;
					$business_contra_TwoWelcomePostDesc = $business_contra_TwoWelcomePost->post_excerpt;
					$business_contra_TwoWelcomePostContent = $business_contra_TwoWelcomePost->post_content;

				}			

		?>

		<div class="businessContraTwoWelcome">

			<h2><?php echo esc_html($business_contra_TwoWelcomePostTitle); ?></h2>
			<p>
			<?php 

				if( '' != $business_contra_TwoWelcomePostDesc ){

					echo esc_html($business_contra_TwoWelcomePostDesc);

				}else{

					echo esc_html($business_contra_TwoWelcomePostContent);

				}

			?>			
			</p>

		</div>
		
		<?php endif; ?>
		
		<?php
			if( '' != get_theme_mod('business_contra_two_services_cat') && 'select' != get_theme_mod('business_contra_two_services_cat') ):
		?>
		<div class="businessContraTwoServicesItems">

			<?php

				$business_contra_Two_cat = '';

				if(get_theme_mod('business_contra_two_services_cat')){
						$business_contra_Two_cat = get_theme_mod('business_contra_two_services_cat');
				}else{
						$business_contra_Two_cat = 0;
				}

				if(get_theme_mod('business_contra_two_services_num')){
						$business_contra_Two_cat_num = get_theme_mod('business_contra_two_services_num');
				}else{
						$business_contra_Two_cat_num = 4;
				}		

				$business_contra_Two_args = array(
					   // Change these category SLUGS to suit your use.
					   'ignore_sticky_posts' => 1,
					   'post_type' => array('post'),
					   'posts_per_page'=> $business_contra_Two_cat_num,
					   'cat' => $business_contra_Two_cat
				);

				$business_contra_Two = new WP_Query($business_contra_Two_args);		

				if ( $business_contra_Two->have_posts() ) : while ( $business_contra_Two->have_posts() ) : $business_contra_Two->the_post();

			?>		

			<div class="businessContraTwoServicesItem">

				<div class="businessContraTwoServicesItemImage">

					<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail('business_contra-home-posts');
							}else{
								echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/frontsix.png" />';
							}						
					?>

				</div>

				<div class="businessContraTwoServicesItemContent">

					<?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
					<p>
						<?php  

							//$frontPostExcerpt = '';
							//$frontPostExcerpt = get_the_excerpt();

							if( has_excerpt() ){
								echo esc_html(get_the_excerpt());
							}else{
								echo esc_html(business_contra_limitedstring(get_the_content(), 50));
							}

						?>
					</p>

				</div>			

			</div>
			<?php endwhile; wp_reset_postdata(); endif;?>

		</div>
		<?php endif; ?>		
		
	</div>
	
	<div class="businessContraTwoPortfolio">
		
		<div class="businessContraTwoPortfolioHeading">
			
			<?php 

				$businessContraPortfolioHeading = __('Portfolio', 'business-contra');	


				if( '' != get_theme_mod('business_contra_two_portfolio_title') ){
					$businessContraPortfolioHeading = get_theme_mod('business_contra_two_portfolio_title');
				}			

			?>
			<h3><?php echo esc_html($businessContraPortfolioHeading); ?></h3>
			
		</div>
		
		<div class="businessContraTwoPortfolioItems">

			<?php

				$business_contra_Two_port = '';

				if(get_theme_mod('business_contra_two_portfolio_cat')){
						$business_contra_Two_port = get_theme_mod('business_contra_two_portfolio_cat');
				}else{
						$business_contra_Two_port = 0;
				}

				if(get_theme_mod('business_contra_two_portfolio_num')){
						$business_contra_Two_port_num = get_theme_mod('business_contra_two_portfolio_num');
				}else{
						$business_contra_Two_port_num = 4;
				}		

				$business_contra_Two_port_args = array(
					   // Change these category SLUGS to suit your use.
					   'ignore_sticky_posts' => 1,
					   'post_type' => array('post'),
					   'posts_per_page'=> $business_contra_Two_port_num,
					   'cat' => $business_contra_Two_port
				);

				$business_contra_TwoPort = new WP_Query($business_contra_Two_port_args);		

				if ( $business_contra_TwoPort->have_posts() ) : while ( $business_contra_TwoPort->have_posts() ) : $business_contra_TwoPort->the_post();

			?>
			<div class="businessContraTwoPortfolioItem">
			
				<div class="businessContraTwoPortfolioItemImage">

				<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('business_contra-home-posts');
					}else{
						echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/frontsix.png" />';
					}						
				?>

				</div>
				
				<?php the_title( '<h2><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
				
			</div>
			<?php endwhile; wp_reset_postdata(); endif;?>
		
		</div>		
		
	</div>	
	
</div>