<?php
/**
 * Just Blog Theme Customizer
 *
 * @package Marjoram
 */

 /**
 * Control type.
 * @access public
 * @var string
 */
if ( ! class_exists( 'Marjoram_Customize_Static_Text_Control' ) ){
	if ( ! class_exists( 'WP_Customize_Control' ) )
    return NULL;
		class Marjoram_Customize_Static_Text_Control extends WP_Customize_Control {
		public $type = 'static-text';
		public function esc_html__construct( $manager, $id, $args = array() ) {
			parent::__construct( $manager, $id, $args );
		}
		protected function render_content() {
			if ( ! empty( $this->label ) ) :
				?><span class="marjoram-customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
			endif;
			if ( ! empty( $this->description ) ) :
				?><div class="marjoram-description marjoram-customize-control-description"><?php

				if( is_array( $this->description ) ) {
					echo '<p>' . implode( '</p><p>', wp_kses_post( $this->description )) . '</p>';
					
				} else {
					echo wp_kses_post( $this->description );
				}
				?>
							
			<h1><?php esc_html_e('Marjoram Pro', 'marjoram') ?></h1>
			
			<p><?php esc_html_e('If you decide to upgrade to the pro version of this theme, use this discount code on checkout.','marjoram'); ?></p>	
			<div id="promotion-header"><p class="main-title"><?php esc_html_e('Upgrade to Pro (Save $5)', 'marjoram') ?><br><?php esc_html_e('Use Code:', 'marjoram') ?> <strong><?php esc_html_e('SAVEFIVE', 'marjoram') ?></strong></p>
			<p><a href="https://www.bloggingthemestyles.com/wordpress-themes/marjoram-pro/" target="_blank" class="button button-primary"><?php esc_html_e('Get the Pro - Save $5', 'marjoram') ?></a></p></div>

			<p style="font-weight: 700;"><?php esc_html_e('Pro Features:', 'marjoram') ?></p>
			<ul>
				<li><?php esc_html_e('&bull; 14 Blog Styles', 'marjoram')?></li>
				<li><?php esc_html_e('&bull; 19 Sidebar Positions', 'marjoram')?></li>
				<li><?php esc_html_e('&bull; WooCommerce', 'marjoram')?></li>
				<li><?php esc_html_e('&bull; Thumbnail Creation for the Blogs', 'marjoram')?></li>
				<li><?php esc_html_e('&bull; Built-in Slider for Featured Posts', 'marjoram')?></li>
				<li><?php esc_html_e('&bull; Add More Google Fonts', 'marjoram')?></li>
				<li><?php esc_html_e('&bull; Typography Options', 'marjoram')?></li>
				<li><?php esc_html_e('&bull; Custom Styled Archive Titles', 'marjoram')?></li>
				<li><?php esc_html_e('&bull; Premium Support', 'marjoram')?></li>
			</ul>
					
			<?php
			endif;
		}
	}
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function marjoram_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'marjoram_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'marjoram_customize_partial_blogdescription',
		) );

   // SECTION - UPGRADE
    $wp_customize->add_section( 'marjoram_upgrade', array(
        'title'       => esc_html__( 'Upgrade to Pro', 'marjoram' ),
        'priority'    => 0
    ) );
	
		$wp_customize->add_setting( 'marjoram_upgrade_pro', array(
			'default' => '',
			'sanitize_callback' => '__return_false'
		) );
		
		$wp_customize->add_control( new Marjoram_Customize_Static_Text_Control( $wp_customize, 'marjoram_upgrade_pro', array(
			'label'	=> esc_html__('Get The Pro Version:','marjoram'),
			'section'	=> 'marjoram_upgrade',
			'description' => array('')
		) ) );	
		
// SECTION - ADD to SITE IDENTITY		
	// Show site title
	$wp_customize->add_setting( 'marjoram_show_site_title',	array(
		'default' => true,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_show_site_title', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Site Title', 'marjoram' ),
		'section'  => 'title_tagline',
	) );		
		
	// Show site description
	$wp_customize->add_setting( 'marjoram_show_site_desc',	array(
		'default' => true,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_show_site_desc', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Site Description', 'marjoram' ),
		'section'  => 'title_tagline',
	) );		

// Site Title Colour
 	$wp_customize->add_setting( 'marjoram_sitetitle', array(
		'default'        => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_sitetitle', array(
		'label'   => esc_html__( 'Site Title Colour', 'marjoram' ),
		'section' => 'title_tagline',
		'settings'   => 'marjoram_sitetitle',
	) ) );
	
// Site Title tagline
 	$wp_customize->add_setting( 'marjoram_site_tagline', array(
		'default'        => '#989898',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_site_tagline', array(
		'label'   => esc_html__( 'Site Tagline Colour', 'marjoram' ),
		'section' => 'title_tagline',
		'settings'   => 'marjoram_site_tagline',
	) ) );			


// SECTION - THEME OPTIONS
	$wp_customize->add_section( 'marjoram_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'marjoram' ),
		'priority' => 30, 
	) );		
	

	// Setting group for the boxed layout
	$wp_customize->add_setting( 'marjoram_boxed_layout', array(
		'default' => 'full',
		'sanitize_callback' => 'marjoram_sanitize_select',
	) );  
	$wp_customize->add_control( 'marjoram_boxed_layout', array(
		  'type' => 'radio',
		  'label' => esc_html__( 'Boxed Layout', 'marjoram' ),
		  'section' => 'marjoram_theme_options',
		  'choices' => array(
			  'full' => esc_html__( 'Full Width', 'marjoram' ),
			  'boxed1800' => esc_html__( 'Boxed 1800px Width', 'marjoram' ),
			  'boxed1600' => esc_html__( 'Boxed 1600px Width', 'marjoram' ),
			  'boxed1400' => esc_html__( 'Boxed 1400px Width', 'marjoram' ),			 
	) ) );			
		
	// Setting group for blog layout
	$wp_customize->add_setting( 'marjoram_blog_layout', array(
		'default' => 'blog1',
		'sanitize_callback' => 'marjoram_sanitize_select',
	) );  
	$wp_customize->add_control( 'marjoram_blog_layout', array(
		  'type' => 'radio',
		  'label' => esc_html__( 'Blog Layout', 'marjoram' ),
		  'section' => 'marjoram_theme_options',
		  'choices' => array(	
				'blog1' => esc_html__( 'Default With Right Sidebar', 'marjoram' ),	  
				'blog2' => esc_html__( 'Default With Left Sidebar', 'marjoram' ),	
				'blog6' => esc_html__( 'Grid With No Sidebar', 'marjoram' ),
				'blog7' => esc_html__( 'Grid With Right Sidebar', 'marjoram' ),
				'blog8' => esc_html__( 'Grid With Left Sidebar', 'marjoram' ),				
		) ) );	

	// Setting group for full post (single) layout  
	$wp_customize->add_setting( 'marjoram_single_layout', array(
		'default' => 'single1',
		'sanitize_callback' => 'marjoram_sanitize_select',
	) );  
	$wp_customize->add_control( 'marjoram_single_layout', array(
		  'type' => 'radio',
		  'label' => esc_html__( 'Full Post Style', 'marjoram' ),
		  'section' => 'marjoram_theme_options',
		  'choices' => array(	
				'single1' => esc_html__( 'Single With Right Sidebar', 'marjoram' ),	 
				'single2' => esc_html__( 'Single With Left Sidebar', 'marjoram' ), 
				'single3' => esc_html__( 'Single With No Sidebars', 'marjoram' ),
		) ) );	

    // header size
    $wp_customize->add_setting( 'marjoram_header_size',  array(
            'sanitize_callback' => 'absint',
            'default'           => '2',
        ) );
    $wp_customize->add_control( 'marjoram_header_size', array(
        'type'        => 'number',
        'section'     => 'marjoram_theme_options',
        'label'       => esc_html__('Header Size', 'marjoram'),
		'description' => esc_html__('You can change the height of your site header in increments of 1 which represents percentage like 1%. The default is 2, but you can go as high as 5.', 'marjoram'), 
        'input_attrs' => array(
            'min'   => 1,
            'max'   => 5,
            'step'  => 1,
        ),
    ) );	

    // featured sidebar size
    $wp_customize->add_setting( 'marjoram_featured_size',  array(
            'sanitize_callback' => 'absint',
            'default'           => '1200',
        ) );
    $wp_customize->add_control( 'marjoram_featured_size', array(
        'type'        => 'number',
        'section'     => 'marjoram_theme_options',
        'label'       => esc_html__('Featured Sidebar Size', 'marjoram'),
		'description' => esc_html__('You can adjust the maximum width of your featured sidebar group of widgets from a minimum width of 1200 up to 2450 pixels with increments of 50 pixels.', 'marjoram'), 
        'input_attrs' => array(
            'min'   => 1200,
            'max'   => 2450,
            'step'  => 50,
        ),
    ) );

	// Use FontAwesome version 4
	$wp_customize->add_setting( 'marjoram_fa4',	array(
		'default' => false,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_fa4', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Use FontAwesome 4', 'marjoram' ),
		'description' => esc_html__( 'For compatibility reasons when using the new FontAwesome version 4 (turned off by default). You also have the option to disable both v4 and v5 if you are using a plugin for Font Awesome.', 'marjoram' ),
		'section'  => 'marjoram_theme_options',
	) );

	// Use FontAwesome version 5
	$wp_customize->add_setting( 'marjoram_fa5',	array(
		'default' => true,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_fa5', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Use FontAwesome 5', 'marjoram' ),
		'description' => esc_html__( 'For compatibility reasons when using the new FontAwesome version 5 (turned on by default), if you find icons are missing or look odd, you can switch to FontAwesome version 4. You also have the option to disable both v4 and v5 if you are using a plugin for Font Awesome.', 'marjoram' ),
		'section'  => 'marjoram_theme_options',
	) );
	
	 // Use excerpts for blog posts
	  $wp_customize->add_setting( 'marjoram_use_excerpt',  array(
		  'default' => 1,
		  'sanitize_callback' => 'marjoram_sanitize_checkbox',
		) );  
	  $wp_customize->add_control( 'marjoram_use_excerpt', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Use Excerpts', 'marjoram' ),
		'description' => esc_html__( 'Use excerpts for your blog post summaries or uncheck the box to use the standard Read More tag. NOTE: Some blog styles only use excerpts.', 'marjoram' ),
		'section'  => 'marjoram_theme_options',
	  ) );

    // Excerpt size
    $wp_customize->add_setting( 'marjoram_excerpt_size',  array(
            'sanitize_callback' => 'absint',
            'default'           => '35',
        ) );
    $wp_customize->add_control( 'marjoram_excerpt_size', array(
        'type'        => 'number',
        'section'     => 'marjoram_theme_options',
        'label'       => esc_html__('Excerpt Size', 'marjoram'),
		'description' => esc_html__('You can change the size of your blog summary excerpts with increments of 5 words.', 'marjoram'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 200,
            'step'  => 1,
        ),
    ) );	  

	// Show date circle
	$wp_customize->add_setting( 'marjoram_show_date_circle',	array(
		'default' => true,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_show_date_circle', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Post Date Circle', 'marjoram' ),
		'description' => esc_html__( 'This lets you show the date circle on the post summary and full post views.', 'marjoram' ),
		'section'  => 'marjoram_theme_options',
	) );

	// show hide edit link
	$wp_customize->add_setting( 'marjoram_show_edit_link',	array(
		'default' => false,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_show_edit_link', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Edit Link', 'marjoram' ),
		'description' => esc_html__( 'This lets you show or hide the front-end edit link.', 'marjoram' ),
		'section'  => 'marjoram_theme_options',
	) );
	
	// Show featured label
	$wp_customize->add_setting( 'marjoram_show_featured_tag',	array(
		'default' => true,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_show_featured_tag', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Featured Tag', 'marjoram' ),
		'description' => esc_html__( 'This lets you show the featured tag in the post meta info. Note: It does not show on the blog 13 blog style.', 'marjoram' ),
		'section'  => 'marjoram_theme_options',
	) );
	
	// Show single featured image
	$wp_customize->add_setting( 'marjoram_show_single_featured',	array(
		'default' => true,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_show_single_featured', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Full Post Featured Image', 'marjoram' ),
		'description' => esc_html__( 'This lets you show the featured image also on the full post view.', 'marjoram' ),
		'section'  => 'marjoram_theme_options',
	) );	
	
	// Show full post footer group
	$wp_customize->add_setting( 'marjoram_show_post_tags',	array(
		'default' => true,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_show_post_tags', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Full Post Footer Group', 'marjoram' ),
		'description' => esc_html__( 'This lets you show or hide the full post footer group that includes the tags list.', 'marjoram' ),
		'section'  => 'marjoram_theme_options',
	) );	
	
	// Show full post nav
	$wp_customize->add_setting( 'marjoram_show_post_nav',	array(
		'default' => true,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_show_post_nav', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Post Navigation', 'marjoram' ),
		'description' => esc_html__( 'This lets you show the Next and Previous post navigation on the full post view.', 'marjoram' ),
		'section'  => 'marjoram_theme_options',
	) );	

	// Show author bio section
	$wp_customize->add_setting( 'marjoram_show_author_bio',	array(
		'default' => true,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_show_author_bio', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Author Bio Section', 'marjoram' ),
		'description' => esc_html__( 'This lets you show the author biography info section on the full article view.', 'marjoram' ),
		'section'  => 'marjoram_theme_options',
	) );	
	
	
	// Show related posts section
	$wp_customize->add_setting( 'marjoram_show_related_posts',	array(
		'default' => true,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_show_related_posts', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show the Related Posts Section', 'marjoram' ),
		'description' => esc_html__( 'This lets you show the related posts section on the full article view.', 'marjoram' ),
		'section'  => 'marjoram_theme_options',
	) );
	
	// Related Posts
   $wp_customize->add_setting('marjoram_related_posts', array(
      'default' => 'categories',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'marjoram_sanitize_select'
   ));

   $wp_customize->add_control('marjoram_related_posts', array(
      'type' => 'radio',
      'label' => esc_html__('Related Posts Displayed From:', 'marjoram'),
      'section' => 'marjoram_theme_options',
      'settings' => 'marjoram_related_posts',
      'choices' => array(
         'categories' => esc_html__('Related Posts By Categories', 'marjoram'),
         'tags' => esc_html__('Related Posts By Tags', 'marjoram')
      )
   ));
	
	// Copyright
	$wp_customize->add_setting( 'marjoram_copyright', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'marjoram_copyright', array(
		'settings' => 'marjoram_copyright',
		'label'    => esc_html__( 'Your Copyright Name', 'marjoram' ),
		'section'  => 'marjoram_theme_options',		
		'type'     => 'text',
	) ); 		

	
	
// SECTION - THUMBNAILS
	$wp_customize->add_section( 'marjoram_thumbnail_options' , array(
		'title'      => esc_html__( 'Thumbnail Options', 'marjoram' ),
		'priority' => 32,
	) );
	
	// Enable default thumbnails
	$wp_customize->add_setting( 'marjoram_default_thumbnails',	array(
		'default' => false,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_default_thumbnails', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Default Style Blog Thumbnails', 'marjoram' ),
		'description' => esc_html__( 'This will create featured images for the blog 1 and 2 styled layouts. Size = 760x400 pixels.', 'marjoram' ),
		'section'  => 'marjoram_thumbnail_options',
	) );	

	// Enable Grid thumbnails
	$wp_customize->add_setting( 'marjoram_grid_thumbnails',	array(
		'default' => false,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_grid_thumbnails', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Grid Style Blog Thumbnails', 'marjoram' ),
		'description' => esc_html__( 'This will create featured images for the grid styled layouts. Size = 660x350 pixels.', 'marjoram' ),
		'section'  => 'marjoram_thumbnail_options',
	) );	

	// Enable full post thumbnails
	$wp_customize->add_setting( 'marjoram_singlepost_thumbnails',	array(
		'default' => false,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_singlepost_thumbnails', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Enable Full Post Thumbnail Creation', 'marjoram' ),
		'description' => esc_html__( 'When enabled, a custom thumbnail will be created for the full post view. (Images will be 750x500 pixels.', 'marjoram' ),
		'section'  => 'marjoram_thumbnail_options',
	) );	
	
	// Enable related post thumbnails
	$wp_customize->add_setting( 'marjoram_related_post_thumbnails',	array(
		'default' => false,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_related_post_thumbnails', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Enable Related Post Thumbnail Creation', 'marjoram' ),
		'description' => esc_html__( 'When enabled, a custom thumbnail will be created for the related posts sections on the full post view.', 'marjoram' ),
		'section'  => 'marjoram_thumbnail_options',
	) );		

	// Enable widget gallery thumbnails
	$wp_customize->add_setting( 'marjoram_widget_gallery_thumbnails',	array(
		'default' => false,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_widget_gallery_thumbnails', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Widget Gallery Thumbnails', 'marjoram' ),
		'description' => esc_html__( 'This will create smaller thumbnails when creating galleries with the Gallery Widget by WordPress. Size will be 100x100 pixels.', 'marjoram' ),
		'section'  => 'marjoram_thumbnail_options',
	) );	
		
// ADD TO COLOUR SECTION	

// body text
 	$wp_customize->add_setting( 'marjoram_body_text', array(
		'default'        => '#656565',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_body_text', array(
		'label'   => esc_html__( 'Body Text Colour', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_body_text',
	) ) );		

// header background colour
 	$wp_customize->add_setting( 'marjoram_header_bg', array(
		'default'        => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_header_bg', array(
		'label'   => esc_html__( 'Header Background Colour', 'marjoram' ),
		'description' => esc_html__( 'This is the background colour for the header area.', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_header_bg',
	) ) );	
	
// header border colour
 	$wp_customize->add_setting( 'marjoram_double_border', array(
		'default'        => '#c1c1c1',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_double_border', array(
		'label'   => esc_html__( 'Double Lines Colour', 'marjoram' ),
		'description' => esc_html__( 'This is the colour for the header double lines, footer top, and the lines that are below headings.', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_double_border',
	) ) );		
	
// content area
 	$wp_customize->add_setting( 'marjoram_content_bg', array(
		'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_content_bg', array(
		'label'   => esc_html__( 'Main Content Area Background', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_content_bg',
	) ) );	

// bottom sidebar background
 	$wp_customize->add_setting( 'marjoram_bottom_bg', array(
		'default'        => '#ef9d87',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_bottom_bg', array(
		'label'   => esc_html__( 'Bottom Sidebar Background', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_bottom_bg',
	) ) );	
// bottom sidebar text
 	$wp_customize->add_setting( 'marjoram_bottom_text', array(
		'default'        => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_bottom_text', array(
		'label'   => esc_html__( 'Bottom Sidebar Text', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_bottom_text',
	) ) );		
// headings
 	$wp_customize->add_setting( 'marjoram_headings', array(
		'default'        => '#222',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_headings', array(
		'label'   => esc_html__( 'Headings Colour', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_headings',
	) ) );		


// site footer  text
 	$wp_customize->add_setting( 'marjoram_site_footer_text', array(
		'default'        => '#656565',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_site_footer_text', array(
		'label'   => esc_html__( 'Site Footer Text', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_site_footer_text',
	) ) );		

// date circle
 	$wp_customize->add_setting( 'marjoram_datecircle_bg', array(
		'default'        => '#ef9d87',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_datecircle_bg', array(
		'label'   => esc_html__( 'Date Circle Background', 'marjoram' ),
		'description'   => esc_html__( 'This is for the post circle date background.', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_datecircle_bg',
	) ) );	
	
// date circle text
 	$wp_customize->add_setting( 'marjoram_datecircle_text', array(
		'default'        => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_datecircle_text', array(
		'label'   => esc_html__( 'Date Circle Text', 'marjoram' ),
		'description'   => esc_html__( 'This is for the post circle date text.', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_datecircle_text',
	) ) );	
	
// meta info
 	$wp_customize->add_setting( 'marjoram_meta', array(
		'default'        => '#989898',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_meta', array(
		'label'   => esc_html__( 'Post Meta Info Colour', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_meta',
	) ) );	

// featured label
 	$wp_customize->add_setting( 'marjoram_featured_label', array(
		'default'        => '#ef9d87',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_featured_label', array(
		'label'   => esc_html__( 'Post Featured Label', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_featured_label',
	) ) );	
	
// Alternating blog background
 	$wp_customize->add_setting( 'marjoram_alternate_blog_bg', array(
		'default'        => '#f5f5f5',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_alternate_blog_bg', array(
		'label'   => esc_html__( 'Alternating Blog Style Background', 'marjoram' ),
		'description'   => esc_html__( 'This is for the Alternating blog style background.', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_alternate_blog_bg',
	) ) );	

// social background
 	$wp_customize->add_setting( 'marjoram_social_bg', array(
		'default'        => '#ef9d87',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_social_bg', array(
		'label'   => esc_html__( 'Social Icon Background', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_social_bg',
	) ) );

// social icon
 	$wp_customize->add_setting( 'marjoram_social_icon', array(
		'default'        => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_social_icon', array(
		'label'   => esc_html__( 'Social Icon', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_social_icon',
	) ) );

// links
 	$wp_customize->add_setting( 'marjoram_links', array(
		'default'        => '#ef9d87',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_links', array(
		'label'   => esc_html__( 'Link Colour', 'marjoram' ),
		'description'   => esc_html__( 'This also colours the hover state of Left Sidebar and Right Sidebar list based links as well.', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_links',
	) ) );

// link visit
 	$wp_customize->add_setting( 'marjoram_vlinks', array(
		'default'        => '#d28d7b',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_vlinks', array(
		'label'   => esc_html__( 'Link Visited Colour', 'marjoram' ),
		'description'   => esc_html__( 'This shows your visitors that they have already clicked on a link.', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_vlinks',
	) ) );

// tags background
 	$wp_customize->add_setting( 'marjoram_tags_bg', array(
		'default'        => '#f2f2f2',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_tags_bg', array(
		'label'   => esc_html__( 'Tags Background Colour', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_tags_bg',
	) ) );

// tags text
 	$wp_customize->add_setting( 'marjoram_tags_text', array(
		'default'        => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_tags_text', array(
		'label'   => esc_html__( 'Tags Text Colour', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_tags_text',
	) ) );
	
// tags hover background
 	$wp_customize->add_setting( 'marjoram_tags_hbg', array(
		'default'        => '#ef9d87',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_tags_hbg', array(
		'label'   => esc_html__( 'Tags Hover Background', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_tags_hbg',
	) ) );

// tags hover text
 	$wp_customize->add_setting( 'marjoram_tags_htext', array(
		'default'        => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_tags_htext', array(
		'label'   => esc_html__( 'Tags Hover Text', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_tags_htext',
	) ) );	
	
// mobile menu toggle bg
 	$wp_customize->add_setting( 'marjoram_mobile_toggle_bg', array(
		'default'        => '#ef9d87',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_mobile_toggle_bg', array(
		'label'   => esc_html__( 'Mobile Menu Toggle Background', 'marjoram' ),
		'description'   => esc_html__( 'This is the colour for your toggle button background.', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_mobile_toggle_bg',
	) ) );	

// mobile menu toggle icon
 	$wp_customize->add_setting( 'marjoram_mobile_toggle_icon', array(
		'default'        => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_mobile_toggle_icon', array(
		'label'   => esc_html__( 'Mobile Menu Toggle Icon', 'marjoram' ),
		'description'   => esc_html__( 'This is the colour for your toggle button icon.', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_mobile_toggle_icon',
	) ) );	

// mobile menu background
 	$wp_customize->add_setting( 'marjoram_mobile_bg', array(
		'default'        => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_mobile_bg', array(
		'label'   => esc_html__( 'Mobile Menu Toggle Icon', 'marjoram' ),
		'description'   => esc_html__( 'This is the colour for your mobile menu background flyout panel.', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_mobile_bg',
	) ) );	

// mobile menu links
 	$wp_customize->add_setting( 'marjoram_mobile_links', array(
		'default'        => '#c5c5c5',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_mobile_links', array(
		'label'   => esc_html__( 'Mobile Menu Links', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_mobile_links',
	) ) );	

// mobile menu hover links
 	$wp_customize->add_setting( 'marjoram_mobile_hlinks', array(
		'default'        => '#bfbb9c',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_mobile_hlinks', array(
		'label'   => esc_html__( 'Mobile Menu Hover Links', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_mobile_hlinks',
	) ) );	

// menu links
 	$wp_customize->add_setting( 'marjoram_menu_links', array(
		'default'        => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_menu_links', array(
		'label'   => esc_html__( 'Main Menu Links', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_menu_links',
	) ) );	

// menu hover and active links
 	$wp_customize->add_setting( 'marjoram_menu_hlinks', array(
		'default'        => '#ef9d87',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_menu_hlinks', array(
		'label'   => esc_html__( 'Main Menu Hover & Active Colour', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_menu_hlinks',
	) ) );


// submenu border
 	$wp_customize->add_setting( 'marjoram_submenu_border', array(
		'default'        => '#424242',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_submenu_border', array(
		'label'   => esc_html__( 'Main Menu Submenu Link Borders', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_submenu_border',
	) ) );

// submenu bottom border
 	$wp_customize->add_setting( 'marjoram_submenu_bottom_border', array(
		'default'        => '#222',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_submenu_bottom_border', array(
		'label'   => esc_html__( 'Main Menu Submenu Bottom Border', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_submenu_bottom_border',
	) ) );	
	
	
// button background
 	$wp_customize->add_setting( 'marjoram_button_bg', array(
		'default'        => '#ef9d87',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_button_bg', array(
		'label'   => esc_html__( 'Button Background', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_button_bg',
	) ) );
// button label
 	$wp_customize->add_setting( 'marjoram_button_label', array(
		'default'        => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_button_label', array(
		'label'   => esc_html__( 'Button Label', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_button_label',
	) ) );
// button hover background
 	$wp_customize->add_setting( 'marjoram_button_hbg', array(
		'default'        => '#0f0f0f',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_button_hbg', array(
		'label'   => esc_html__( 'Button Hover Background', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_button_hbg',
	) ) );
// button label
 	$wp_customize->add_setting( 'marjoram_button_hlabel', array(
		'default'        => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_button_hlabel', array(
		'label'   => esc_html__( 'Button Hover Label', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_button_hlabel',
	) ) );	
	
// field background
 	$wp_customize->add_setting( 'marjoram_field_bg', array(
		'default'        => '#f7f7f7',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_field_bg', array(
		'label'   => esc_html__( 'Input Field Background', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_field_bg',
	) ) );	

// field border
 	$wp_customize->add_setting( 'marjoram_field_border', array(
		'default'        => '#d1d1d1',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_field_border', array(
		'label'   => esc_html__( 'Input Field Border', 'marjoram' ),
		'section' => 'colors',
		'settings'   => 'marjoram_field_border',
	) ) );	
	

// SECTION - TYPOGRAPHY SETTINGS
    $wp_customize->add_section( 'marjoram_typography_settings', array(
        'title'       => esc_html__( 'Typography Settings', 'marjoram' ),
        'priority'    => 41
    ) ); 	
			
		// Body Font family
		$wp_customize->add_setting('marjoram_body_font_family', array(
			'default' => '',
			'sanitize_callback' => 'marjoram_sanitize_strip_slashes'
		));		
		$wp_customize->add_control('marjoram_body_font_family', array(
			 'label' => __('Font Family for the Body', 'marjoram'),
			 'section' => 'marjoram_typography_settings',
			 'type'    => 'text',
			 'description' => esc_html__( 'Insert Font Family for the main body text by name and separate additional fonts with a comma.', 'marjoram' ),			
		));	
		// Heading Font family
		$wp_customize->add_setting('marjoram_heading_font_family', array(
			'default' => '',
			'sanitize_callback' => 'marjoram_sanitize_strip_slashes'
		));		
		$wp_customize->add_control('marjoram_heading_font_family', array(
			 'label' => __('Font Family for Headings', 'marjoram'),
			 'section' => 'marjoram_typography_settings',
			 'type'    => 'text',
			 'description' => esc_html__( 'Insert Font Family for the headings (and site title) by name and separate additional fonts with a comma.', 'marjoram' ),			
		));		

	// Show dropcaps
	$wp_customize->add_setting( 'marjoram_show_dropcap',	array(
		'default' => false,
		'sanitize_callback' => 'marjoram_sanitize_checkbox',
	) );  
	$wp_customize->add_control( 'marjoram_show_dropcap', array(
		'type'     => 'checkbox',
		'label'    => esc_html__( 'Show Full Post Dropcap', 'marjoram' ),
		'description' => esc_html__( 'This lets you show the drop cap style on the first letter of the first paragraph.', 'marjoram' ),
		'section'  => 'marjoram_typography_settings',
	) );
	
// dropcap colour
 	$wp_customize->add_setting( 'marjoram_dropcap_colour', array(
		'default'        => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
	) );	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'marjoram_dropcap_colour', array(
		'label'   => esc_html__( 'Dropcap Letter Colour', 'marjoram' ),
		'section' => 'marjoram_typography_settings',
		'settings'   => 'marjoram_dropcap_colour',
	) ) );		
	
	
		
	}
}
add_action( 'customize_register', 'marjoram_customize_register' );

/**
 * SANITIZATION
 * Required for cleaning up bad inputs
 */

// Strip Slashes
	function marjoram_sanitize_strip_slashes($input) {
		return wp_kses_stripslashes($input);
	}	
	
// Radio and Select	
	function marjoram_sanitize_select( $input, $setting ) {
		// Ensure input is a slug.
		$input = sanitize_key( $input );
		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;
		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
	}
	 	
// Checkbox
	function marjoram_sanitize_checkbox( $input ) {
		// Boolean check 
		return ( ( isset( $input ) && true == $input ) ? true : false );
	}
	
// Array of valid image file types
	function marjoram_sanitize_image( $image, $setting ) {
		$mimes = array(
			'jpg|jpeg|jpe' => 'image/jpeg',
			'gif'          => 'image/gif',
			'png'          => 'image/png',
		);
		// Return an array with file extension and mime_type.
		$file = wp_check_filetype( $image, $mimes );
		// If $image has a valid mime_type, return it; otherwise, return the default.
		return ( $file['ext'] ? $image : $setting->default );
	}

// Adds sanitization callback function: Number
function marjoram_sanitize_number( $input ) {
	if ( isset( $input ) && is_numeric( $input ) ) {
		return $input;
	}
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function marjoram_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function marjoram_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function marjoram_customize_preview_js() {
	wp_enqueue_script( 'marjoram-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'marjoram_customize_preview_js' );
