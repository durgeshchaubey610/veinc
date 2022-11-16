<?php
/**
 * business_contra Theme Customizer
 *
 * @package business_contra
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function business_contra_customize_register( $wp_customize ) {

	global $business_contraPostsPagesArray, $business_contraYesNo, $business_contraSliderType, $business_contraServiceLayouts, $business_contraAvailableCats, $business_contraBusinessLayoutType;

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'business_contra_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'business_contra_customize_partial_blogdescription',
		) );
	}
	
	$wp_customize->add_panel( 'business_contra_general', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'title'      => __('General Settings', 'business-contra'),
		'active_callback' => '',
	) );

	$wp_customize->get_section( 'title_tagline' )->panel = 'business_contra_general';
	$wp_customize->get_section( 'background_image' )->panel = 'business_contra_general';
	$wp_customize->get_section( 'background_image' )->title = __('Site background', 'business-contra');
	$wp_customize->get_section( 'header_image' )->panel = 'business_contra_general';
	$wp_customize->get_section( 'header_image' )->title = __('Header Settings', 'business-contra');
	$wp_customize->get_control( 'header_image' )->priority = 20;
	$wp_customize->get_control( 'header_image' )->active_callback = 'business_contra_show_wp_header_control';	
	$wp_customize->get_section( 'static_front_page' )->panel = 'business_contra_';
	$wp_customize->get_section( 'static_front_page' )->title = __('Select frontpage type', 'business-contra');
	$wp_customize->get_section( 'static_front_page' )->priority = 9;
	$wp_customize->remove_section('colors');
	$wp_customize->add_control( 
			new WP_Customize_Color_Control( 
			$wp_customize, 
			'background_color', 
			array(
				'label'      => __( 'Background Color', 'business-contra' ),
				'section'    => 'background_image',
				'priority'   => 9
			) ) 
	);
	//$wp_customize->remove_section('static_front_page');	
	//$wp_customize->remove_section('header_image');	

	/* Upgrade */	
	$wp_customize->add_section( 'business_contra_business_upgrade', array(
		'priority'       => 8,
		'capability'     => 'edit_theme_options',
		'title'      => __('Upgrade to PRO', 'business-contra'),
		'active_callback' => '',
	) );		
	$wp_customize->add_setting( 'business_contra_show_sliderr',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new business_contra_Customize_Control_Upgrade(
		$wp_customize,
		'business_contra_show_sliderr',
		array(
			'label'      => __( 'Show headerr?', 'business-contra' ),
			'settings'   => 'business_contra_show_sliderr',
			'priority'   => 10,
			'section'    => 'business_contra_business_upgrade',
			'choices' => '',
			'input_attrs'  => 'yes',
			'active_callback' => ''			
		)
	) );
	
	/* Usage guide */	
	$wp_customize->add_section( 'business_contra_business_usage', array(
		'priority'       => 9,
		'capability'     => 'edit_theme_options',
		'title'      => __('Theme Usage Guide', 'business-contra'),
		'active_callback' => '',
	) );		
	$wp_customize->add_setting( 'business_contra_show_sliderrr',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new business_contra_Customize_Control_Guide(
		$wp_customize,
		'business_contra_show_sliderrr',
		array(

			'label'      => __( 'Show headerr?', 'business-contra' ),
			'settings'   => 'business_contra_show_sliderrr',
			'priority'   => 10,
			'section'    => 'business_contra_business_usage',
			'choices' => '',
			'input_attrs'  => 'yes',
			'active_callback' => ''				
		)
	) );
	
	/* Header Section */
	$wp_customize->add_setting( 'business_contra_show_slider',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'business_contra_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_show_slider',
		array(
			'label'      => __( 'Show header?', 'business-contra' ),
			'settings'   => 'business_contra_show_slider',
			'priority'   => 10,
			'section'    => 'header_image',
			'type'    => 'select',
			'choices' => $business_contraYesNo,
		)
	) );	
	$wp_customize->add_setting( 'business_contra_header_type',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'business_contra_sanitize_slider_type_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_header_type',
		array(
			'label'      => __( 'Header type :', 'business-contra' ),
			'settings'   => 'business_contra_header_type',
			'priority'   => 11,
			'section'    => 'header_image',
			'type'    => 'select',
			'choices' => $business_contraSliderType,
		)
	) );
	
	$wp_customize->add_setting( 'business_contra_slider_cat',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'business_contra_sanitize_cat_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_slider_cat',
		array(
			'label'      => __( 'Select a category for owl slider :', 'business-contra' ),
			'settings'   => 'business_contra_slider_cat',
			'priority'   => 20,
			'section'    => 'header_image',
			'type'    => 'select',
			'choices' => $business_contraAvailableCats,
		)
	) );	
	
	
	/* Business page panel */
	$wp_customize->add_panel( 'business_contra_', array(
		'priority'       => 20,
		'capability'     => 'edit_theme_options',
		'title'      => __('Home/Front Page Settings', 'business-contra'),
		'active_callback' => '',
	) );
	
	$wp_customize->add_section( 'business_contra_layout_selection', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'title'      => __('Select FrontPage Layout', 'business-contra'),
		'active_callback' => 'business_contra_front_page_sections',
		'panel'  => 'business_contra_',
	) );
	$wp_customize->add_setting( 'business_contra_layout_type',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'business_contra_sanitize_layout_type',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_layout_type',
		array(
			'label'      => __( 'Layout type :', 'business-contra' ),
			'settings'   => 'business_contra_layout_type',
			'priority'   => 10,
			'section'    => 'business_contra_layout_selection',
			'type'    => 'select',
			'choices' => $business_contraBusinessLayoutType,
		)
	) );	
	
	
	$wp_customize->add_section( 'business_contra_layout_two', array(
		'priority'       => 30,
		'capability'     => 'edit_theme_options',
		'title'      => __('Two settings', 'business-contra'),
		'active_callback' => 'business_contra_front_page_sections',
		'panel'  => 'business_contra_',
	) );
	$wp_customize->add_setting( 'business_contra_two_welcome_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'business_contra_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_six_welcome_post',
		array(
			'label'      => __( 'Welcome post :', 'business-contra' ),
			'settings'   => 'business_contra_two_welcome_post',
			'priority'   => 10,
			'section'    => 'business_contra_layout_two',
			'type'    => 'select',
			'choices' => $business_contraPostsPagesArray,
		)
	) );
	
	$wp_customize->add_setting( 'business_contra_two_services_cat',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'business_contra_sanitize_cat_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_two_services_cat',
		array(
			'label'      => __( 'Select a category :', 'business-contra' ),
			'settings'   => 'business_contra_two_services_cat',
			'priority'   => 20,
			'section'    => 'business_contra_layout_two',
			'type'    => 'select',
			'choices' => $business_contraAvailableCats,
		)
	) );	
	
	$wp_customize->add_setting( 'business_contra_two_services_num',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_two_services_num',
		array(
			'label'      => __( 'Number of posts :', 'business-contra' ),
			'settings'   => 'business_contra_two_services_num',
			'priority'   => 20,
			'section'    => 'business_contra_layout_two',
			'type'    => 'text',
		)
	) );
	
	$wp_customize->add_setting( 'business_contra_two_portfolio_title',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_two_portfolio_title',
		array(
			'label'      => __( 'Portfolio section title :', 'business-contra' ),
			'settings'   => 'business_contra_two_portfolio_title',
			'priority'   => 20,
			'section'    => 'business_contra_layout_two',
			'type'    => 'text',
		)
	) );	
	
	$wp_customize->add_setting( 'business_contra_two_portfolio_cat',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'business_contra_sanitize_cat_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_two_portfolio_cat',
		array(
			'label'      => __( 'Select a category :', 'business-contra' ),
			'settings'   => 'business_contra_two_portfolio_cat',
			'priority'   => 20,
			'section'    => 'business_contra_layout_two',
			'type'    => 'select',
			'choices' => $business_contraAvailableCats,
		)
	) );	
	
	$wp_customize->add_setting( 'business_contra_two_portfolio_num',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_two_portfolio_num',
		array(
			'label'      => __( 'Number of posts :', 'business-contra' ),
			'settings'   => 'business_contra_two_portfolio_num',
			'priority'   => 20,
			'section'    => 'business_contra_layout_two',
			'type'    => 'text',
		)
	) );	
	
	$wp_customize->add_section( 'business_contra_layout_wooone', array(
		'priority'       => 60,
		'capability'     => 'edit_theme_options',
		'title'      => __('Woo One settings', 'business-contra'),
		'active_callback' => 'business_contra_front_page_sections',
		'panel'  => 'business_contra_',
	) );

	$wp_customize->add_setting( 'business_contra_wooone_welcome_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'business_contra_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_wooone_welcome_post',
		array(
			'label'      => __( 'Welcome post :', 'business-contra' ),
			'settings'   => 'business_contra_wooone_welcome_post',
			'priority'   => 10,
			'section'    => 'business_contra_layout_wooone',
			'type'    => 'select',
			'choices' => $business_contraPostsPagesArray,
		)
	) );
	$wp_customize->add_setting( 'business_contra_wooone_latest_heading',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_wooone_latest_heading',
		array(
			'label'      => __( 'Products Heading :', 'business-contra' ),
			'settings'   => 'business_contra_wooone_latest_heading',
			'priority'   => 20,
			'section'    => 'business_contra_layout_wooone',
			'type'    => 'text',
		)
	) );
	$wp_customize->add_setting( 'business_contra_wooone_latest_text',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_wooone_latest_text',
		array(
			'label'      => __( 'Products Text :', 'business-contra' ),
			'settings'   => 'business_contra_wooone_latest_text',
			'priority'   => 30,
			'section'    => 'business_contra_layout_wooone',
			'type'    => 'text',
		)
	) );	

	$wp_customize->add_section( 'business_contra_quote', array(
		'priority'       => 110,
		'capability'     => 'edit_theme_options',
		'title'      => __('Quote Settings', 'business-contra'),
		'active_callback' => '',
		'panel'  => 'business_contra_general',
	) );
	$wp_customize->add_setting( 'business_contra_show_quote',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'business_contra_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_show_quote',
		array(
			'label'      => __( 'Show quote?', 'business-contra' ),
			'settings'   => 'business_contra_show_quote',
			'priority'   => 10,
			'section'    => 'business_contra_quote',
			'type'    => 'select',
			'choices' => $business_contraYesNo,
		)
	) );
	$wp_customize->add_setting( 'business_contra_quote_post',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'business_contra_sanitize_post_selection',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_quote_post',
		array(
			'label'      => __( 'Select post', 'business-contra' ),
			'description' => __( 'Select a post/page you want to show in quote section', 'business-contra' ),
			'settings'   => 'business_contra_quote_post',
			'priority'   => 11,
			'section'    => 'business_contra_quote',
			'type'    => 'select',
			'choices' => $business_contraPostsPagesArray,
		)
	) );	
	
	$wp_customize->add_section( 'business_contra_social', array(
		'priority'       => 120,
		'capability'     => 'edit_theme_options',
		'title'      => __('Social Settings', 'business-contra'),
		'active_callback' => '',
		'panel'  => 'business_contra_general',
	) );	
	$wp_customize->add_setting( 'business_contra_show_social',
		array(
			'default'    => 'select',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'business_contra_sanitize_yes_no_setting',
		) 
	);	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'business_contra_show_social',
		array(
			'label'      => __( 'Show social?', 'business-contra' ),
			'settings'   => 'business_contra_show_social',
			'priority'   => 10,
			'section'    => 'business_contra_social',
			'type'    => 'select',
			'choices' => $business_contraYesNo,
		)
	) );
	$wp_customize->add_setting( 'business_contra_facebook',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_contra_facebook', array(
	  'type' => 'text',
	  'section' => 'business_contra_social', // Add a default or your own section
	  'label' => __( 'Facebook', 'business-contra' ),
	  'description' => __( 'Enter your facebook url.', 'business-contra' ),
	) );
	$wp_customize->add_setting( 'business_contra_flickr',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_contra_flickr', array(
	  'type' => 'text',
	  'section' => 'business_contra_social', // Add a default or your own section
	  'label' => __( 'Flickr', 'business-contra' ),
	  'description' => __( 'Enter your flickr url.', 'business-contra' ),
	) );
	$wp_customize->add_setting( 'business_contra_gplus',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_contra_gplus', array(
	  'type' => 'text',
	  'section' => 'business_contra_social', // Add a default or your own section
	  'label' => __( 'Gplus', 'business-contra' ),
	  'description' => __( 'Enter your gplus url.', 'business-contra' ),
	) );
	$wp_customize->add_setting( 'business_contra_linkedin',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_contra_linkedin', array(
	  'type' => 'text',
	  'section' => 'business_contra_social', // Add a default or your own section
	  'label' => __( 'Linkedin', 'business-contra' ),
	  'description' => __( 'Enter your linkedin url.', 'business-contra' ),
	) );
	$wp_customize->add_setting( 'business_contra_reddit',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_contra_reddit', array(
	  'type' => 'text',
	  'section' => 'business_contra_social', // Add a default or your own section
	  'label' => __( 'Reddit', 'business-contra' ),
	  'description' => __( 'Enter your reddit url.', 'business-contra' ),
	) );
	$wp_customize->add_setting( 'business_contra_stumble',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_contra_stumble', array(
	  'type' => 'text',
	  'section' => 'business_contra_social', // Add a default or your own section
	  'label' => __( 'Stumble', 'business-contra' ),
	  'description' => __( 'Enter your stumble url.', 'business-contra' ),
	) );
	$wp_customize->add_setting( 'business_contra_twitter',
		array(
			'default'    => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) 
	);
	$wp_customize->add_control( 'business_contra_twitter', array(
	  'type' => 'text',
	  'section' => 'business_contra_social', // Add a default or your own section
	  'label' => __( 'Twitter', 'business-contra' ),
	  'description' => __( 'Enter your twitter url.', 'business-contra' ),
	) );	
	
}
add_action( 'customize_register', 'business_contra_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function business_contra_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function business_contra_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function business_contra_customize_preview_js() {
	wp_enqueue_script( 'business_contra-customizer', esc_url( get_template_directory_uri() ) . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'business_contra_customize_preview_js' );

require get_template_directory() . '/inc/variables.php';

function business_contra_sanitize_yes_no_setting( $value ){
	global $business_contraYesNo;
    if ( ! array_key_exists( $value, $business_contraYesNo ) ){
        $value = 'select';
	}
    return $value;	
}

function business_contra_sanitize_post_selection( $value ){
	global $business_contraPostsPagesArray;
    if ( ! array_key_exists( $value, $business_contraPostsPagesArray ) ){
        $value = 'select';
	}
    return $value;	
}

function business_contra_front_page_sections(){
	
	$value = false;
	
	if( 'page' == get_option( 'show_on_front' ) ){
		$value = true;
	}
	
	return $value;
	
}

function business_contra_show_wp_header_control(){
	
	$value = false;
	
	if( 'header' == get_theme_mod( 'header_type' ) ){
		$value = true;
	}
	
	return $value;
	
}

function business_contra_show_header_one_control(){
	
	$value = false;
	
	if( 'header-one' == get_theme_mod( 'header_type' ) ){
		$value = true;
	}
	
	return $value;
	
}

function business_contra_sanitize_slider_type_setting( $value ){

	global $business_contraSliderType;
    if ( ! array_key_exists( $value, $business_contraSliderType ) ){
        $value = 'select';
	}
    return $value;	
	
}

function business_contra_sanitize_cat_setting( $value ){
	
	global $business_contraAvailableCats;
	
	if( ! array_key_exists( $value, $business_contraAvailableCats ) ){
		
		$value = 'select';
		
	}
	return $value;
	
}

function business_contra_sanitize_layout_type( $value ){
	
	global $business_contraBusinessLayoutType;
	
	if( ! array_key_exists( $value, $business_contraBusinessLayoutType ) ){
		
		$value = 'select';
		
	}
	return $value;
	
}

add_action( 'customize_register', 'business_contra_load_customize_classes', 0 );
function business_contra_load_customize_classes( $wp_customize ) {
	
	class business_contra_Customize_Control_Upgrade extends WP_Customize_Control {

		public $type = 'business_contra-upgrade';
		
		public function enqueue() {

		}

		public function to_json() {
			
			parent::to_json();

			$this->json['link']    = $this->get_link();
			$this->json['value']   = $this->value();
			$this->json['id']      = $this->id;
			//$this->json['default'] = $this->default;
			
		}	
		
		public function render_content() {}
		
		public function content_template() { ?>

			<div id="business_contra-upgrade-container" class="business_contra-upgrade-container">

				<ul>
					<li>More sliders</li>
					<li>More layouts</li>
					<li>Color customization</li>
					<li>Font customization</li>
				</ul>

				<p>
					<a href="https://www.themealley.com/business/">Upgrade</a>
				</p>
									
			</div><!-- .business_contra-upgrade-container -->
			
		<?php }	
		
	}
	
	class business_contra_Customize_Control_Guide extends WP_Customize_Control {

		public $type = 'business_contra-guide';
		
		public function enqueue() {

		}

		public function to_json() {
			
			parent::to_json();

			$this->json['link']    = $this->get_link();
			$this->json['value']   = $this->value();
			$this->json['id']      = $this->id;
			//$this->json['default'] = $this->default;
			
		}	
		
		public function render_content() {}
		
		public function content_template() { ?>

			<div id="business_contra-upgrade-container" class="business_contra-upgrade-container">

				<ol>
					<li>Select 'A static page' for "your homepage displays" in 'select frontpage type' section of 'Home/Front Page settings' tab.</li>
					<li>Enter details for various section like header, welcome, services, quote, social sections.</li>
				</ol>
									
			</div><!-- .business_contra-upgrade-container -->
			
		<?php }	
		
	}	

	$wp_customize->register_control_type( 'business_contra_Customize_Control_Upgrade' );
	$wp_customize->register_control_type( 'business_contra_Customize_Control_Guide' );
	
	
}