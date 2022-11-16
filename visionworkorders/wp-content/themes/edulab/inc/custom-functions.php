<?php 
if ( ! function_exists( 'edulab_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function edulab_setup() {

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

		// Image sizes
		add_image_size( 'edulab-image-372x244', 372, 244, true );
		add_image_size( 'edulab-image-394x262', 394, 262, true );
		add_image_size( 'edulab-image-90x90', 90, 90, true );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'edulab' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'edulab_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 120,
			'width'       => 100,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'edulab_setup' );

if ( ! function_exists( 'edulab_content_width' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function edulab_content_width() {
		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'edulab_content_width', 640 );
	}
endif;
add_action( 'after_setup_theme', 'edulab_content_width', 0 );

if ( ! function_exists( 'edulab_widgets_init' ) ) :
	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function edulab_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'edulab' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'edulab' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 1', 'edulab' ),
			'id'            => 'footer-one',
			'description'   => esc_html__( 'Add widgets here.', 'edulab' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 2', 'edulab' ),
			'id'            => 'footer-two',
			'description'   => esc_html__( 'Add widgets here.', 'edulab' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 3', 'edulab' ),
			'id'            => 'footer-three',
			'description'   => esc_html__( 'Add widgets here.', 'edulab' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		register_sidebar( array(
			'name'          => esc_html__( 'Footer 4', 'edulab' ),
			'id'            => 'footer-four',
			'description'   => esc_html__( 'Add widgets here.', 'edulab' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
endif;
add_action( 'widgets_init', 'edulab_widgets_init' );

if ( ! function_exists( 'edulab_scripts' ) ) :
	/**
	 * Enqueue scripts and styles.
	 */
	function edulab_scripts() {
		// CSS
	    $google_font_args = array(
	        'family' => 'Poppins:300,400,500,600,700,800,900',
	    );
	    wp_enqueue_style( 'edulab-google-fonts', add_query_arg( $google_font_args, "//fonts.googleapis.com/css" ) ); //Google Fonts

	    wp_enqueue_style( 'fontawesome', get_template_directory_uri(). '/css/all.css' ); //fontawesome

	    wp_enqueue_style( 'lightbox', get_template_directory_uri(). '/css/lightbox.css' ); //lightbox

	    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css/owl.carousel.css' );//owl-carousel

	    wp_enqueue_style( 'owl-theme-default', get_template_directory_uri(). '/css/owl.theme.default.css' );//owl-carousel
	  
	    wp_enqueue_style( 'custom-style', get_template_directory_uri(). '/css/custom-style.css' ); //custom style

		wp_enqueue_style( 'edulab-style', get_stylesheet_uri() ); //Style.css

		wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/style.css'); //Custom Style

		wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css');

	    // JS
	    wp_enqueue_script( 'owlCarousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '2.3.4', true );//owl-carousel js

	    wp_enqueue_script( 'fontawesome', get_template_directory_uri() . '/js/all.js', array('jquery'), '5.3.1', true );//fontawesome

	    wp_enqueue_script( 'lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), '2.10.0', true );//lightbox

	    wp_enqueue_script( 'edulab-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );//custom js

		wp_enqueue_script( 'edulab-navigation', get_template_directory_uri() . '/js/navigation.js', array(), wp_get_theme()->get( 'Version' ), true );

		wp_enqueue_script( 'labnews-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'edulab_scripts' );