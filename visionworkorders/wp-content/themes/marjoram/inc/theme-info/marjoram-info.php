<?php
/**
 * Theme Info Page
 * Special thanks to the Consulting theme by ThinkUpThemes for this info page to be used as a foundation.
 * @package Marjoram
 */
 
function marjoram_info() {    


	// About page instance
	// Get theme data
	$theme_data     = wp_get_theme();

	// Get name of parent theme

		$theme_name    = trim( ucwords( str_replace( ' (Lite)', '', $theme_data->get( 'Name' ) ) ) );
		$theme_slug    = trim( strtolower( str_replace( ' (Lite)', '-lite', $theme_data->get( 'Name' ) ) ) );
		$theme_version = $theme_data->get( 'Version' );

	$config = array(
		// translators: %1$s: menu title under appearance
		'menu_name'             => sprintf( esc_html__( 'About %1$s', 'marjoram' ), ucfirst( $theme_name ) ),
		// translators: %1$s: page name 
		'page_name'             => sprintf( esc_html__( 'About %1$s', 'marjoram' ), ucfirst( $theme_name ) ),
		// translators: %1$s: welcome title 
		'welcome_title'         => sprintf( esc_html__( 'Welcome to %1$s - v', 'marjoram' ), ucfirst( $theme_name ) ),
		// translators: %1$s: welcome content 
		'welcome_content'       => sprintf( esc_html__(  '%1$s is a clean, modern blog theme, tailored for food-based blogging. Its flexibility lets you use this for a wide range of other types of concepts. With unlimited colours, you can find something for you. Marjoram also boasts a custom Image Widget, thumbnail related posts widget, off-canvas menu, custom header, backgrounds, and an abundance of blog & layout options. Marjoram has a fresh, contemporary design and is guaranteed to wow and inspire your readers.', 'marjoram' ), ucfirst( $theme_name ) ),
		
		/**
		 * Tabs array.
		 *
		 * The key needs to be ONLY consisted from letters and underscores. If we want to define outside the class a function to render the tab,
		 * the will be the name of the function which will be used to render the tab content.
		 */
		'upgrade'             => array(
			'upgrade_url'     => 'https://www.bloggingthemestyles.com/wordpress-themes/marjoram-pro/',
			'price_discount'  => __( 'Upgrade and Save 5%', 'marjoram' ),
			'price_normal'	  => __( 'Use coupon at checkout.', 'marjoram' ),
			'coupon'	      =>  __( 'SAVEFIVE', 'marjoram' ),
			'button'	      => __( 'Get the Pro', 'marjoram' ),
		),		
		'tabs'                 => array(
			'getting_started'  => esc_html__( 'Getting Started', 'marjoram' ),
			'support_content'  => esc_html__( 'Support', 'marjoram' ),
			'theme_review'  => esc_html__( 'Reviews', 'marjoram' ),
			'changelog'           => esc_html__( 'Changelog', 'marjoram' ),
			'free_pro'         => esc_html__( 'Free VS PRO', 'marjoram' ),
		),
		// Getting started tab
		'getting_started' => array(
			'first' => array (
				'title'               => esc_html__( 'Setup Documentation', 'marjoram' ),
				'text'                => sprintf( esc_html__( 'To help you get started with the initial setup of this theme and to learn about the various features, you can check out our detailed setup documentation.', 'marjoram' ) ),
				// translators: %1$s: theme name 
				'button_label'        => sprintf( esc_html__( 'View %1$s Tutorials', 'marjoram' ), ucfirst( $theme_name ) ),
				'button_link'         => esc_url( '//www.bloggingthemestyles.com/documentation/' ),
				'is_button'           => true,
				'recommended_actions' => false,
                'is_new_tab'          => true,
			),
			'second' => array(
				'title'               => esc_html__( 'Go to Customizer', 'marjoram' ),
				'text'                => esc_html__( 'Using the WordPress Customizer, you can easily customize every aspect of the theme.', 'marjoram' ),
				'button_label'        => esc_html__( 'Go to Customizer', 'marjoram' ),
				'button_link'         => esc_url( admin_url( 'customize.php' ) ),
				'is_button'           => true,
				'recommended_actions' => false,
                'is_new_tab'          => true,
			),
			
			'third' => array(
				'title'               => esc_html__( 'Using a Child Theme', 'marjoram' ),
				'text'                => sprintf( esc_html__( 'If you plan to customize this theme, I recommend looking into using a child theme. To learn more about child themes and why it\'s important to use one, check out the WordPress documentation.', 'marjoram' ) ),
				'button_label'        => sprintf( esc_html__( 'Child Themes', 'marjoram' ), ucfirst( $theme_name ) ),
				'button_link'         => esc_url( '//developer.wordpress.org/themes/advanced-topics/child-themes/' ),
				'is_button'           => true,
				'recommended_actions' => false,
                'is_new_tab'          => true,
			),		
		),

		// Changelog content tab.
		'changelog'      => array(
			'first' => array (				
				'title'        => esc_html__( 'Changelog', 'marjoram' ),
				'text'         => esc_html__( 'I generally recommend you always read the CHANGELOG before updating so that you can see what was fixed, changed, deleted, or added to the theme.', 'marjoram' ),	
				'button_label' => '',
				'button_link'  => '',
				'is_button'    => false,
				'is_new_tab'   => false,				
				),
		),			
		// Support content tab.
		'support_content'      => array(
			'first' => array (
				'title'        => esc_html__( 'Free Support', 'marjoram' ),
				'icon'         => 'dashicons dashicons-sos',
				'text'         => esc_html__( 'If you experience any problems, please post your questions to support and we will be more than happy to help you out.', 'marjoram' ),
				'button_label' => esc_html__( 'Get Free Support', 'marjoram' ),
				'button_link'  => esc_url( '//www.bloggingthemestyles.com/support' ),
				'is_button'    => true,
				'is_new_tab'   => true,
			),
			'second' => array(
				'title'        => esc_html__( 'Common Problems', 'marjoram' ),
				'icon'         => 'dashicons dashicons-editor-help',
				'text'         => esc_html__( 'For quick answers to the most common problems, you can check out the tutorials which can provide instant solutions and answers.', 'marjoram' ),
				'button_label' => sprintf( esc_html__( 'Get Answers', 'marjoram' ) ),
				'button_link'  => '//www.bloggingthemestyles.com/common-problems',
				'is_button'    => true,
				'is_new_tab'   => true,
			),

		),
		// Review content tab.
		'theme_review'      => array(
			'first' => array (
				'title'        => esc_html__( 'Theme Review', 'marjoram' ),
				'icon'         => 'dashicons dashicons-thumbs-up',
				'text'         => esc_html__( 'We would love to request a 5-star rating from you! If so, please visit the theme page and add your review and your star rating. If you have suggestions to help improve this theme, please let us know. If you experience problems, request support and we will be happy to help you out.', 'marjoram' ),
				'button_label' => esc_html__( 'Add Your Star Rating', 'marjoram' ),
				'button_link'  => esc_url( '//wordpress.org/support/theme/marjoram/reviews/' ),
				'is_button'    => true,
				'is_new_tab'   => true,
			),
		),		
		// Free vs pro array.
		'free_pro'                => array(
			'free_theme_name'     => ucfirst( $theme_name ) . ' (free)',
			'pro_theme_name'      => esc_html__('Marjoram Pro','marjoram' ),
			'pro_theme_link'      => '//www.bloggingthemestyles.com/wordpress-themes/marjoram-pro/',
			'get_pro_theme_label' => sprintf( esc_html__( 'Get Marjoram Pro', 'marjoram' ) ),
			'features'            => array(
				array(
					'title'            => esc_html__( 'Mobile Friendly', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),		
				array(
					'title'            => esc_html__( 'Unlimited Colours', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
				array(
					'title'            => esc_html__( 'Adjustable Page Width', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
				
				array(
					'title'            => esc_html__( 'Header Image', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),				
				array(
					'title'            => esc_html__( 'Background Image', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),
				array(
					'title'            => esc_html__( 'Built-In Social Menu', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),
				array(
					'title'            => esc_html__( 'Show or Hide Elements', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),				
				array(
					'title'            => esc_html__( 'Custom Error Page', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),		
				
				array(
					'title'            => esc_html__( 'Blog Styles', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '6',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '14',
					'hidden'           => '',
				),				
				array(
					'title'            => esc_html__( 'Sidebar Positions', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '15',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '19',
					'hidden'           => '',
				),
				array(
					'title'            => esc_html__( 'Page Templates', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '5',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '5',
					'hidden'           => '',
				),

				array(
					'title'            => esc_html__( 'Recent Posts Widget with Thumbnails', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
				array(
					'title'            => esc_html__( 'Related Posts with Thumbnails', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => 'true',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),	
			
				array(
					'title'            => esc_html__( 'Theme Options', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => '',
					'is_in_lite_text'  => 'Basic',
					'is_in_pro'        => '',
					'is_in_pro_text'   => 'Advanced',
					'hidden'           => '',
				),		
				array(
					'title'            => esc_html__( 'Support', 'marjoram' ),
					'description'      => '',
					'is_in_lite'       => '',
					'is_in_lite_text'  => 'Basic',
					'is_in_pro'        => '',
					'is_in_pro_text'   => 'Premium',
					'hidden'           => '',
				),	
				array(
					'title'            => esc_html__( 'Featured Post Slider', 'marjoram' ),
					'description'      => esc_html__('Showcase featured posts with an amazing built-in slick Slider!', 'marjoram'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),					

				array(
					'title'            => esc_html__( 'Custom Blog Title &amp; Introduction', 'marjoram' ),
					'description'      => esc_html__('WordPress does not have this, but we have added a customizable blog title and intro option.', 'marjoram'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),				
				array(
					'title'            => esc_html__( 'Blog Thumbnail Creation', 'marjoram' ),
					'description'      => esc_html__('Automatically have post featured images cropped when uploading for up to 14 blog styled layouts.', 'marjoram'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),		
				array(
					'title'            => esc_html__( 'WooCommerce', 'marjoram' ),
					'description'      => esc_html__('Includes WooCommerce with custom styling in the customizer.', 'marjoram'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),					
				array(
					'title'            => esc_html__( 'Custom Widget Style', 'marjoram' ),
					'description'      => esc_html__('We included a minimal custom style for your widgets that you can enable.', 'marjoram'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),								
				array(
					'title'            => esc_html__( 'Add Google Fonts', 'marjoram' ),
					'description'      => esc_html__('Add up to 2 more Google Fonts.', 'marjoram'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),
				array(
					'title'            => esc_html__( 'Typography Options', 'marjoram' ),
					'description'      => esc_html__('Includes basic settings for your main text and headings, and a few more items.', 'marjoram'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),						
				array(
					'title'            => esc_html__( 'Custom Styled Archive Titles', 'marjoram' ),
					'description'      => esc_html__('We customized the style of archive titles for tags, categories, etc.', 'marjoram'),
					'is_in_lite'       => 'false',
					'is_in_lite_text'  => '',
					'is_in_pro'        => 'true',
					'is_in_pro_text'   => '',
					'hidden'           => '',
				),					
		
				
			),
		),
	);
	marjoram_info_page::init( $config );

}

add_action('after_setup_theme', 'marjoram_info');

?>