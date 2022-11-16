<?php
/**
 * Marjoram functions and definitions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package Marjoram
 */

if ( ! function_exists( 'marjoram_setup' ) ) :

	// Set the default content width.
		$GLOBALS['content_width'] = 1160;
		
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function marjoram_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Marjoram, use a find and replace
		 * to change 'marjoram' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'marjoram', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		
		// create recent posts thumbnails
		add_image_size( 'marjoram-recent', 360, 100, true );
		
		// create small wp gallery thumbnails
		if( esc_attr(get_theme_mod( 'marjoram_widget_gallery_thumbnails', false ) ) ) :
		add_image_size( 'marjoram-widget-gallery', 100, 100, true );		
		endif;
		
		// create related post thumbnails
		if( esc_attr(get_theme_mod( 'marjoram_related_post_thumbnails', false ) ) ) :
			add_image_size( 'marjoram-related-posts', 225, 150, true );
		endif;	

		// create featured images for the default blog style
		if( esc_attr(get_theme_mod( 'marjoram_default_thumbnails', false ) ) ) :
			add_image_size( 'marjoram-default', 760, 400, true );
		endif;
		
		// create featured images for the grid blog style
		if( esc_attr(get_theme_mod( 'marjoram_grid_thumbnails', false ) ) ) :
			add_image_size( 'marjoram-grid', 660, 350, true );
		endif;			

		// create featured images for the single post thumbnail
		if( esc_attr(get_theme_mod( 'marjoram_singlepost_thumbnails', false ) ) ) :
			add_image_size( 'singlepost', 750, 500, true );
		endif;
	
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'marjoram' ),
			'footer' => esc_html__( 'Footer', 'marjoram' ),
			'social' => esc_html__( 'Social', 'marjoram' ),
		) );
		
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'marjoram_custom_background_args', array(
			'default-image' => get_template_directory_uri() . '/images/marjoram-bg.png',
			'default-color' => 'ffffff',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		
		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
		 */
		add_editor_style( array( '/css/editor.css', marjoram_fonts_url() ) );
		
	}
endif;
add_action( 'after_setup_theme', 'marjoram_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function marjoram_content_width() {
	$content_width = $GLOBALS['content_width'];
	// Check if is single post and there is no sidebar.
	if ( is_active_sidebar( 'pageleft'  ) || is_active_sidebar( 'blogleft' ) || is_active_sidebar( 'blogright' ) || is_active_sidebar( 'blogright' ) ) {
		$content_width = 760;
	}
  $GLOBALS['content_width'] = apply_filters( 'marjoram_content_width', $content_width );
}
add_action( 'template_redirect', 'marjoram_content_width', 0 );

/**
 * Register Google Fonts.
 */
if ( ! function_exists( 'marjoram_fonts_url' ) ) :

function marjoram_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	// Translators: If there are characters in your language that are not supported by this font, translate this to 'off'. Do not translate into your own language.
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'marjoram' ) ) {
		$fonts[] = 'Montserrat:300,400,600,700';
	}

	// Translators: If there are characters in your language that are not supported by Noto Serif, translate this to 'off'. Do not translate into your own language.
	if ( 'off' !== _x( 'on', 'Playfair Display font: on or off', 'marjoram' ) ) {
		$fonts[] = 'Playfair Display:400,700';
	}	
	
	// Translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'marjoram' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
endif;


/**
 * Add preconnect for Google Fonts.
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function marjoram_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'marjoram-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'marjoram_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function marjoram_scripts() {
	
	$bloglayout = esc_attr(get_theme_mod( 'marjoram_blog_layout', 'blog1' ));
	
	// fonts
	wp_enqueue_style( 'marjoram-fonts', marjoram_fonts_url(), array(), null );	
	
	// FontAwesome 5
	if( esc_attr(get_theme_mod( 'marjoram_fa5', true ) ) ) :
		wp_enqueue_style( 'font-awesome-5', get_template_directory_uri() . '/css/fontawesome5.css', array(), '5.0.8' );
	endif; 
	
	// Font Awesome 4
	if( esc_attr(get_theme_mod( 'marjoram_fa4', false ) ) ) :
		wp_enqueue_style( 'font-awesome-4', get_template_directory_uri() . '/css/fontawesome4.css', '', '4.7.0' );
	endif;
	
	// stylesheets	
	wp_enqueue_style( 'marjoram-style', get_stylesheet_uri() );
	
	// scripts
	wp_enqueue_script( 'superfish-navigation', get_template_directory_uri() . '/js/superfish.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'marjoram-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'marjoram-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
		
	// comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'marjoram_scripts' );

/**
 * Enqueue scripts for the admin.
 * Script for our custom ad widgets to allow image uploading
 */
	function marjoram_image_uploader() {
		wp_enqueue_media();
		wp_enqueue_script( 'marjoram-widget-image-upload', get_template_directory_uri() . '/js/image-uploader.js', false, '20150309', true );
	}
	add_action( 'admin_enqueue_scripts', 'marjoram_image_uploader' );

// THEME INFO PAGE CLASS
require get_template_directory() . '/inc/theme-info/marjoram-info-class-about.php';
	
// Register imagebox widget
require get_template_directory() . '/inc/widgets/class-marjoram-imagebox-widget.php';

// Register recent posts widget
require get_template_directory() . '/inc/widgets/class-marjoram-recent-posts-widget.php';
	
// WordPress Custom header
require get_template_directory() . '/inc/custom-header.php';

// Theme Info Page
require get_template_directory() . '/inc/theme-info/marjoram-info.php';

// Implement the Custom Header feature.
require get_template_directory() . '/inc/sidebars.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Functions which enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Customizer additions.
require get_template_directory() . '/inc/customizer.php';

// Load CSS overrides
require get_template_directory() . '/inc/inline-styles.php';

// Load Jetpack compatibility file.
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
