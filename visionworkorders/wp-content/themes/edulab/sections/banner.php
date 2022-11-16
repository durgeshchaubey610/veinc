<?php
/**
 * Banner Section
 * 
 * @package edulab
*/
$edulab_ed_banner 		 	= get_theme_mod( 'ed_banner_section', true );
$edulab_banner_title	 	= get_theme_mod( 'banner_title', __( 'Welcome to Education', 'edulab' ) );
$edulab_banner_desc  	 	= get_theme_mod( 'banner_subtitle', __( 'you can now find the courses for you', 'edulab' ) );
$edulab_read_more			= get_theme_mod( 'banner_readmore', __( 'Read More', 'edulab' ) );
$edulab_read_more_link		= get_theme_mod( 'banner_readmore_link', '#' );

// <!-- Banner starts -->

// Check if the banner is static banner with header content
if ( has_custom_header() && $edulab_ed_banner ) { 
 	$edulab_class = has_header_video() ? 'video-banner' : ''; ?>

	<!-- Static banner starts -->
	<div class="banner <?php echo esc_attr( $edulab_class ); ?>">

		<!-- Image or Video section -->
		<?php the_custom_header_markup(); ?>

		<!-- Banner title and description starts -->
		<div class="container">

			<!-- Banner title -->
			<h2><?php echo esc_html( $edulab_banner_title ); ?></h2>

			<!-- Banner description -->
			<h3><?php echo esc_html( $edulab_banner_desc ); ?></h3>

			<!-- Read More -->
			<?php
            if( ! empty( $edulab_read_more ) ){
                echo  '<a href="'. esc_url( $edulab_read_more_link ) .'" class="banner read-more-btn">'. esc_html( $edulab_read_more ) .'</a>';
            }
            ?>
		</div>
		<!-- Banner title and description ends -->

	</div>
	<!-- Static banner ends --><?php

} ?>
<!-- Banner ends -->