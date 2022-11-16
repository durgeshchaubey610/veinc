<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package business_contra
 */

?>

	</div><!-- #content -->

	<?php 

				if( 'no' != get_theme_mod('business_contra_show_quote') ): 

				$business_contraQuoteTitle = '';
				$business_contraQuoteDesc = '';
				$business_contraQuoteContent = '';

				if( '' != get_theme_mod('business_contra_quote_post') && 'select' != get_theme_mod('business_contra_quote_post') ){

					$business_contraQuoteId = get_theme_mod('business_contra_quote_post');

					if( ctype_alnum($business_contraQuoteId) ){

						$business_contraQuote = get_post( $business_contraQuoteId );

						$business_contraQuoteTitle = $business_contraQuote->post_title;
						$business_contraQuoteDesc = $business_contraQuote->post_excerpt;
						$business_contraQuoteContent = $business_contraQuote->post_content;

					}

				}



		?>		
		<div class="frontQuoteContainer">
		
			<div class="frontQuoteInnerContainer">
				
				<p>
				<?php 

					if( '' != $business_contraQuoteDesc ){

						echo esc_html($business_contraQuoteDesc);

					}else{

						echo esc_html(business_contra_limitedstring($business_contraQuoteContent, 300));

					}

				?>			
				</p>
				<p><span><?php echo esc_html($business_contraQuoteTitle); ?></span></p>
				
			</div><!-- .frontQuoteInnerContainer -->
			
		</div><!-- .frontQuoteContainer -->
	<?php endif; ?>

	<?php if( 'no' != get_theme_mod('business_contra_show_social') ): ?>
	<div class="frontpage-social">

			<?php if( '' != get_theme_mod('business_contra_facebook') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_contra_facebook')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/facebook.png'; ?>"></a>
			<?php endif; ?>
			
			<?php if( '' != get_theme_mod('business_contra_flickr') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_contra_flickr')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/flickr.png'; ?>"></a>
			<?php endif; ?>	

			<?php if( '' != get_theme_mod('business_contra_gplus') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_contra_gplus')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/gplus.png'; ?>"></a>
			<?php endif; ?>	

			<?php if( '' != get_theme_mod('business_contra_linkedin') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_contra_linkedin')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/linkedin.png'; ?>"></a>
			<?php endif; ?>	

			<?php if( '' != get_theme_mod('business_contra_reddit') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_contra_reddit')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/reddit.png'; ?>"></a>
			<?php endif; ?>	

			<?php if( '' != get_theme_mod('business_contra_stumble') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_contra_stumble')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/stumble.png'; ?>"></a>
			<?php endif; ?>		

			<?php if( '' != get_theme_mod('business_contra_twitter') ): ?>
			<a href="<?php echo esc_url(get_theme_mod('business_contra_twitter')); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/twitter.png'; ?>"></a>
			<?php endif; ?>				
					
	</div><!-- .frontpage-social -->	
	<?php endif; ?>

	<footer id="colophon" class="site-footer">

		<div class="site-logo">
		
			<?php
			
				$business_contra_custom_logo_id = get_theme_mod( 'custom_logo' );
				$business_contra_logo = wp_get_attachment_image_src( $business_contra_custom_logo_id , 'full' );
				if ( has_custom_logo() ) {
						echo '<a href="' . esc_url(get_site_url()) . '"><img src="'. esc_url( $business_contra_logo[0] ) .'"></a>';
				} else {
						echo '<h1>'. esc_html(get_bloginfo( 'name' )) .'</h1>';
				}			
			
			?>
			<p><?php esc_html_e( 'All rights reserved.', 'business-contra' ); ?></p>
			<p>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'business-contra' ), 'business contra', '<a href="https://themealley.com/">ThemeAlley</a>' );
			?>
			</a>
		</div><!-- .site-logo -->
		
		<div class="footer-widgets">
		
			<div class="footerWidgetContainer">
			<?php if ( dynamic_sidebar('footer-left') ){ } else { ?>
			
				<section class="widget">
					
					<div class="widgetContainerInner">
					
						<h2 class="widget-title"><span><?php _e( 'Pages', 'business-contra' ); ?></span></h2>
                        <ul>
                            <?php wp_list_pages('title_li='); ?>
                        </ul>						
					
					</div>
					
				</section>
			
			<?php } ?> 
			</div><!-- .footerWidgetContainer -->
			
			<div class="footerWidgetContainer">
			<?php if ( dynamic_sidebar('footer-middle') ){ } else { ?>
			
				<section class="widget">
					
					<div class="widgetContainerInner">
					
						<h2 class="widget-title"><span><?php _e( 'Meta', 'business-contra' ); ?></span></h2>
                        <ul>
                            <?php wp_register(); ?>
                            <li><?php wp_loginout(); ?></li>
                            <?php wp_meta(); ?>
                        </ul>						
					
					</div>
					
				</section>		
			
			<?php } ?> 			
			</div><!-- .footerWidgetContainer -->
			
			<div class="footerWidgetContainer">
			<?php if ( dynamic_sidebar('footer-right') ){ } else { ?>
			
				<section class="widget">
					
					<div class="widgetContainerInner">
					
						<h2 class="widget-title"><span><?php _e( 'Archives', 'business-contra' ); ?></span></h2>
                        <ul>
							 <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                        </ul>						
					
					</div>
					
				</section>			
			
			<?php } ?> 			
			</div><!-- .footerWidgetContainer -->			
		
		</div><!-- .footer-widgets -->
		
	
	</footer><!-- #colophon -->
</div><!-- #page -->
</div><!-- .outerContainer -->
<?php wp_footer(); ?>

</body>
</html>
