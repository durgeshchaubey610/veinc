<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package edulab
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function edulab_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	 if( ! is_active_sidebar( 'sidebar-1' ) ){
        $classes[] = 'full-width'; 
    }

	if( is_page() ){
        $edulab_sidebar_layout = edulab_sidebar_layout();
        if( $edulab_sidebar_layout == 'no-sidebar' )
        $classes[] = 'full-width';
    }   

	return $classes;
}
add_filter( 'body_class', 'edulab_body_classes' );

function edulab_post_classes( $classes ){

    if( is_singular() ){
        $classes[] = 'page-article';
    }
    if( is_home() || is_archive()  ){
        $classes[] = 'grid-box-wrap';
    }
    return $classes;

}
add_filter( 'post_class', 'edulab_post_classes' );	

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function edulab_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'edulab_pingback_header' );


if( ! function_exists( 'edulab_top_header' ) ) :
    function edulab_top_header(){
        $ed_header      = get_theme_mod( 'ed_header', true );
        $mail_text      = get_theme_mod( 'header_email', 'site@example.com' );
        $phone_text     = get_theme_mod( 'header_phone', '+0 000 0000' );
        $header_text    = get_theme_mod( 'header_text', __( 'Join Now', 'edulab' ) );
        $header_link    = get_theme_mod( 'header_link', '#' );

        if( $ed_header ){ ?>
	        <div class="top-header">
	            <div class="container">
	                <div class="top-header-left">
	                    <div class="top-header-block email">
	                        <a href="<?php echo esc_url( 'mailto:' . $mail_text ); ?>">
	                            <i class="fas fa-envelope"></i> 
	                            <?php echo esc_html( $mail_text ); ?>
	                        </a>
	                    </div>
	                    <div class="top-header-block phone">
	                        <a href="<?php echo esc_url( 'tel:' . $phone_text ); ?> ">
	                            <i class="fas fa-phone"></i> 
	                            <?php echo esc_html( $phone_text ); ?>
	                        </a>
	                    </div>
	                </div>
	                <div class="top-header-right">
	                    <div class="social-block">
	                        <?php edulab_social_icons(); ?>
	                    </div>
	                    <div class="login-block">
	                        <a href="<?php echo esc_url( $header_link ); ?>"><?php echo esc_html( $header_text ); ?></a>
	                    </div>
	                </div>
	            </div>
	        </div><?php
	    }
    }
	add_action( 'edulab_top_header', 'edulab_top_header' );
endif;
