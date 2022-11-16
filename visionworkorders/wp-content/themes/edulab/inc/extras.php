<?php 
    if( ! function_exists( 'edulab_header_site_branding' ) ) :
        /**
         * Site Branding
        */
        function edulab_header_site_branding(){
            if( has_custom_logo() ){ ?>
                <div class="logo-wrap" itemprop="logo">
                    <?php the_custom_logo(); ?>
                </div><?php 
            }  ?>
            <div class="site-branding">
                <?php
                if( is_front_page() ){ ?>
                    <h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php 
                } else { ?>
                    <p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></p><?php 
                }
                $description  = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ){ ?>
                    <p class="site-description" itemprop="description"><?php echo esc_html( $description ); ?></p>
                    <?php
                }
                ?>
            </div><?php
        }
    endif;

    if( ! function_exists( 'edulab_header_menu' ) ) :
        /**
         * Header Menu
        */
        function edulab_header_menu(){ ?>
            <div class="nav-wrap">
                <nav class="main-navigation nav-desktop">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'menu-1',
                        'menu_class'     => "menu-list",
                        'container'      => "ul",
                        'menu_id'        => 'primary-menu',
                    ) );
                    ?>
                </nav>
                <div id="bar">
                    <i class="fas fa-bars"></i>
                </div>
                <div id="close">
                    <i class="fas fa-times"></i>
                </div>
            </div><?php
        }
    endif;

    if( ! function_exists( 'edulab_social_icons' ) ) :
        // Social icons 
        function edulab_social_icons(){
            $default =  array(
                array(
                    'font' => 'fab fa-facebook',
                    'link' => 'https://www.facebook.com/',                        
                ),
                array(
                    'font' => 'fab fa-twitter',
                    'link' => 'https://twitter.com/',
                ),
                array(
                    'font' => 'fab fa-youtube',
                    'link' => 'https://www.youtube.com/',
                ),
                array(
                    'font' => 'fab fa-instagram',
                    'link' => 'https://www.instagram.com/',
                )
            );
            $ed_social    = get_theme_mod( 'ed_social_links',  true );
            $social_links = get_theme_mod( 'social_links',  $default );

            if( $ed_social ){ ?>
                <ul class="social-list">
                    <?php 
                    foreach ($social_links as $social ) { ?>
                        <li><a href="<?php echo esc_url( $social['link'] ); ?>" target="_blank" ><i class="<?php echo esc_attr( $social['font'] ); ?>"></i></a></li>
                        <?php
                    } ?>
                </ul><?php
            }
        }
    endif;

    if( ! function_exists( 'edulab_article_footer_edit') ):
        function edulab_article_footer_edit(){
            if ( get_edit_post_link() ){
                edit_post_link(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Edit <span class="screen-reader-text">%s</span>', 'edulab' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            }
        }
    endif;

    if( ! function_exists( 'edulab_home_section') ):
        /*
         *
         * Check if home page section are enable or not.
        */
        function edulab_home_section(){

            $home_sections = array( 'courses'=>false, 'whyus'=>false, 'portfolio'=>false, 'testimonial'=>false, 'blog'=>true );       
            $enable_section = false;
            foreach( $home_sections as $h_section => $value ){ 
                if( get_theme_mod( 'ed_' . $h_section . '_section', $value ) == true ){
                    $enable_section = true;
                }
            }
            return $enable_section;
        }
    endif;

    /**
     * Function to list post categories in customizer options
    */
    function edulab_get_categories( $select = true, $taxonomy = 'category', $slug = false ){

        /* Option list of all categories */
        $categories = array();
        if( $select ) $categories[''] = __( 'Choose Category', 'edulab' );
        
        if( taxonomy_exists( $taxonomy ) ){
            $args = array( 
                'hide_empty' => false,
                'taxonomy'   => $taxonomy 
            );
            
            $catlists = get_terms( $args );
            
            foreach( $catlists as $category ){
                if( $slug ){
                    $categories[$category->slug] = $category->name;
                }else{
                    $categories[$category->term_id] = $category->name;    
                }        
            }
        }
        return $categories;
    }


    /**
    * Fuction to list Post Type
    */
    function edulab_get_posts( $post_type = 'post' ){
        
        $args = array(
            'posts_per_page'   => -1,
            'post_type'        => $post_type,
            'post_status'      => 'publish',
            //'suppress_filters' => true 
        );
        $posts_array = get_posts( $args );
        
        // Initate an empty array
        $post_options = array();
        $post_options[''] = __( ' -- Choose -- ', 'edulab' );
        if ( ! empty( $posts_array ) ) {
            foreach ( $posts_array as $posts ) {
                $post_options[ $posts->ID ] = $posts->post_title;
            }
        }
        return $post_options;
    }

    if( ! function_exists( 'edulab_sidebar_layout' ) ) :
        /**
         * Return sidebar layouts for pages
        */
        function edulab_sidebar_layout(){
            global $post;
            
            if( get_post_meta( $post->ID, '_sidebar_layout', true ) ){
                return get_post_meta( $post->ID, '_sidebar_layout', true );    
            }else{
                return 'right-sidebar';
            }
        }
    endif;

    if ( ! function_exists( 'wp_body_open' ) ) {
        function wp_body_open() {
            do_action( 'wp_body_open' );
        }
    }
