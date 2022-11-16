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
          
          <div class="col-lg-6">
              <figure> <img src="<?php echo get_template_directory_uri(); ?>/images/logo_foot.png" alt="" class="img-responsive" width="220" /> </figure>        
          </div>
          
          
          <div class="col-lg-6">
              <ul class="footerNav">
                  <?php  dynamic_sidebar('sidebar-5'); ?>
                  
              </ul>
          </div>
          
          
         
          
<!--        <div class="vt_foot_nav_wrap"
          <div class="col-sm-3 vt_logo_foot">
            
          </div>
          <div class="col-md-2 col-sm-3 col-sm-offset-1">
            <h3>Company</h3>
           <?php //wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
          </div>
          
          <div class="clearfix"></div>
        </div>-->
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

<script src="<?php echo get_template_directory_uri(); ?>/js/slider/jssor.slider-22.0.6.min.js"></script> 
  <script type="text/javascript">
        jssor_1_slider_init = function() {
            var jssor_1_options = {
              $AutoPlay: true,
              $Idle: 0,
              $AutoPlaySteps: 4,
              $SlideDuration: 2500,
              $SlideEasing: $Jease$.$Linear,
              $PauseOnHover: 4,
              $SlideWidth: 140,
              $SlideSpacing: 20,
              $Cols: 13
            };
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            /*responsive code begin*/
            /*you can remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1200);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 130);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*responsive code end*/
        };
    </script>
    <script type="text/javascript">jssor_1_slider_init();</script>
<script>
    $('.carousel').carousel();
      //$("#menu-header-menu li a").last().addClass("vt_buy");
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
   
   jQuery('.sub-menu').addClass('dropdown-menu');
   jQuery('.dropdown-menu').removeClass('sub-menu');
   jQuery('.dropdown-menu').parent('li').addClass('dropdown');
   jQuery('.dropdown').children('a:first').attr('data-toggle',"dropdown");
   jQuery('.dropdown').children('a:first').attr('aria-expanded',"true");
   jQuery('.dropdown').children('a:first').attr('aria-expanded',"true");
   jQuery('.dropdown').children('a:first').append('<span class="caret"></span>');
   jQuery('.dropdown').children('a:first').addClass("dropdown-toggle");
	
	
 	  jQuery('#menu-footer-menu').find('.dropdown').addClass('dropup');
	 jQuery('#menu-footer-menu').find('.dropup').removeClass('dropdown');
	 
	  jQuery('.dropup').children('a:first').attr('data-toggle',"dropdown");
   jQuery('.dropup').children('a:first').attr('aria-expanded',"true");
   jQuery('.dropup').children('a:first').attr('aria-expanded',"true");
   jQuery('.dropup').children('a:first').append('<span class="caret"></span>');
   jQuery('.dropup').children('a:first').addClass("dropdown-toggle");
   
    
	jQuery(window).scroll(function(){
	  var sticky = jQuery('header'),
		  scroll = jQuery(window).scrollTop();

	  if (scroll >= 3) sticky.addClass('fixed-header');
	  else sticky.removeClass('fixed-header');
	});
	

	
        
      
</script>
</body>
</html>
