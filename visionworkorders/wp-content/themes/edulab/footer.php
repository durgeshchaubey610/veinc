<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Edulab
 */
    get_template_part( '/sections/cta' );  
	?>
	</div>
		<!-- Footer starts -->
		<footer class="page-footer">

			<!-- Footer widgets starts -->
			<div class="footer-first-section">
				<div class="container">
					<?php 
					$edulab_footer_sidebars = array( 'footer-one', 'footer-two', 'footer-three', 'footer-four' );
					$edulab_active_sidebars = array();
				    $edulab_sidebar_count   = 0;
				    foreach ( $edulab_footer_sidebars as $edulab_sidebar ) {
				        if( is_active_sidebar( $edulab_sidebar ) ){
				            array_push( $edulab_active_sidebars, $edulab_sidebar );
				            $edulab_sidebar_count++ ;
				        }
				    }          
				    if( $edulab_active_sidebars ){
		                foreach( $edulab_active_sidebars as $edulab_active ){ ?>
		    				<div class="box-wrap">
		    				   <?php dynamic_sidebar( $edulab_active ); ?>	
		    				</div><?php 
		                }
				    } ?>
				</div>
			</div>
			<!-- Footer widgets ends -->

			<!-- Footer social icon starts -->
			<?php  
			$edulab_ed_social = get_theme_mod( 'ed_social_links',  true );
			if( $edulab_ed_social ){ ?>
				<div class="footer-second-section">
					<div class="container">
						<hr class="footer-line">
						<?php edulab_social_icons(); ?>
						<hr class="footer-line">
					</div>
				</div>
			<?php } ?>
			<!-- Footer social icon ends -->

			<!-- Footer copyright starts -->
			<div class="footer-last-section">
				<div class="container">
					<?php
					$edulab_copyright = get_theme_mod( 'footer_copyright' );
				    echo '<p>' . wp_kses_post( $edulab_copyright ) . esc_html__( 'Theme designed and developed by', 'edulab' ) . '<a href="https://www.labtheme.com"> Lab Theme </a></p>' . esc_html__( 'Powered by WordPress', 'edulab' ); ?>
				</div>
			</div>
			<!-- Footer copyright ends -->

		</footer>
		<!-- Footer ends -->

	</div>
	<!-- Page ends -->
	<script type="text/javascript">
		
	</script>
	<?php wp_footer();  ?>
</body>
<!-- Body ends -->
</html>
