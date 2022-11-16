<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

	<?php /* ?>	</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php if ( has_nav_menu( 'primary' ) ) : ?>
				<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'twentysixteen' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_class'     => 'primary-menu',
						 ) );
					?>
				</nav><!-- .main-navigation -->
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'social',
							'menu_class'     => 'social-links-menu',
							'depth'          => 1,
							'link_before'    => '<span class="screen-reader-text">',
							'link_after'     => '</span>',
						) );
					?>
				</nav><!-- .social-navigation -->
			<?php endif; ?>

			<div class="site-info">
				<?php
					/**
					 * Fires before the twentysixteen footer text for footer customization.
					 *
					 * @since Twenty Sixteen 1.0
					 *//*
					do_action( 'twentysixteen_credits' );
				?>
				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentysixteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentysixteen' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
<?php */ ?>

<!--clients close here-->
   <footer class="row ">
    <div class="vt_footer_wrapper">
      <div class="container">          
         <?php  dynamic_sidebar('sidebar-5'); ?> 
          
        <div class="vt_foot_nav_wrap">
          <div class="col-sm-3 vt_logo_foot">
            <figure> <img src="<?php echo get_template_directory_uri(); ?>/images/logo_foot.png" alt="" class="img-responsive" /> </figure>
          </div>
          <div class="col-md-2 col-sm-3 col-sm-offset-1">
            <h3>Company</h3>
           <?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
          </div>
          
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
    <div class="vt_copyright_wrapper">
      <div class="container">
        <p>Copyright © 2016 | Vocational Technologies</p>
      </div>
    </div>
  </footer>
</div>
<!--js files--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script> 
<script>
    $('.carousel').carousel()
      $("#menu-header-menu li a").last().addClass("vt_buy");
//$.noConflict();
// Code that uses other library's $ can follow here.
</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/wow.js"></script>
<!-- Wow --> 
 
<script>
   
    wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
    /* document.getElementById = function() {
      var section = document.createElement('section');      
      this.parentNode.insertBefore(section, this);
    };*/
    
   document.getElementById('temp');

	jQuery(window).scroll(function(){
	  var sticky = jQuery('header'),
		  scroll = jQuery(window).scrollTop();

	  if (scroll >= 3) sticky.addClass('fixed-header');
	  else sticky.removeClass('fixed-header');
	});
        
      
</script>
</body>
</html>
