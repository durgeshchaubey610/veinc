<?php
/**
 * Add inline styles to the head area
 * @package Marjoram
*/
 
 // Dynamic styles
function marjoram_inline_styles($custom) {
	
// BEGIN CUSTOM CSS	

// body font family
if( get_theme_mod( 'marjoram_body_font_family' ) ) :
		$marjoram_body_font_family = get_theme_mod( 'marjoram_body_font_family' );	
		$custom .= "html, body { font-family: " . esc_attr($marjoram_body_font_family) . "; }"."\n";		
	endif;
	
// heading font family	
	if( get_theme_mod( 'marjoram_heading_font_family' ) ) :
		$marjoram_heading_font_family = get_theme_mod('marjoram_heading_font_family');		
		$custom .= "h1, h2, h3, h4, h5, h6, .entry-title a, #site-title { font-family: " . esc_attr($marjoram_heading_font_family) . "; }	"."\n";	
	endif;
	
// content
	$marjoram_body_text = get_theme_mod( 'marjoram_body_text', '#656565' );
	$marjoram_header_bg = get_theme_mod( 'marjoram_header_bg', '#fff' );
	$marjoram_content_bg = get_theme_mod( 'marjoram_content_bg', '#fff' );
	$marjoram_bottom_bg = get_theme_mod( 'marjoram_bottom_bg', '#ef9d87' );
	$marjoram_bottom_text = get_theme_mod( 'marjoram_bottom_text', '#fff' );
	$marjoram_headings = get_theme_mod( 'marjoram_headings', '#222' );
	$marjoram_sitetitle = get_theme_mod( 'marjoram_sitetitle', '#000' );
	$marjoram_site_tagline = get_theme_mod( 'marjoram_site_tagline', '#989898' );
	$marjoram_double_border = get_theme_mod( 'marjoram_double_border', '#c1c1c1' );
	$marjoram_site_footer_text = get_theme_mod( 'marjoram_site_footer_text', '#656565' );	
	$marjoram_links = get_theme_mod( 'marjoram_links', '#ef9d87' );
	$marjoram_vlinks = get_theme_mod( 'marjoram_vlinks', '#d28d7b' );	
	$marjoram_meta = get_theme_mod( 'marjoram_meta', '#989898' );
	$marjoram_featured_label = get_theme_mod( 'marjoram_featured_label', '#ef9d87' );
	$marjoram_alternate_blog_bg = get_theme_mod( 'marjoram_alternate_blog_bg', '#f5f5f5' );
	$marjoram_datecircle_bg = get_theme_mod( 'marjoram_datecircle_bg', '#ef9d87' );
	$marjoram_datecircle_text = get_theme_mod( 'marjoram_datecircle_text', '#fff' );	
	$marjoram_tags_bg = get_theme_mod( 'marjoram_tags_bg', '#f2f2f2' );
	$marjoram_tags_text = get_theme_mod( 'marjoram_tags_text', '#000' );
	$marjoram_tags_hbg = get_theme_mod( 'marjoram_tags_hbg', '#ef9d87' );
	$marjoram_tags_htext = get_theme_mod( 'marjoram_tags_htext', '#fff' );		
	$marjoram_bottom_tags_bg = get_theme_mod( 'marjoram_bottom_tags_bg', '#d2917f' );
	$marjoram_bottom_tags_text = get_theme_mod( 'marjoram_bottom_tags_text', '#fff' );
	$custom .= "body {color:" . esc_attr($marjoram_body_text) . ";}
	#masthead {background-color:" . esc_attr($marjoram_header_bg) . ";}
	#header-border, #site-footer, h1:after, h2:after, h3:after, h4:after, h5:after, h6:after, .entry-title:after, .widget-title:after {border-color:" . esc_attr($marjoram_double_border) . ";}
	#page {background-color:" . esc_attr($marjoram_content_bg) . ";}
	#bottom-sidebar {background-color:" . esc_attr($marjoram_bottom_bg) . "; }
	#bottom-sidebar, #bottom-sidebar a, #bottom-sidebar a:visited {color:" . esc_attr($marjoram_bottom_text) . ";}	
	#bottom-sidebar li {border-color:" . esc_attr($marjoram_bottom_text) . ";}
	h1,h2,h3,h4,h5,h6,.entry-title a, .entry-title a:visited,.widget-title {color:" . esc_attr($marjoram_headings) . ";}
	.site-title a, .site-title a:visited {color:" . esc_attr($marjoram_sitetitle) . ";}
	.site-description {color:" . esc_attr($marjoram_site_tagline) . ";}
	a, #left-sidebar .widget_nav_menu a:hover, #right-sidebar .widget_nav_menu a:hover {color:" . esc_attr($marjoram_links) . ";}
	a:visited, a:hover, a:focus, a:active {color:" . esc_attr($marjoram_vlinks) . ";}	
	#site-footer, #site-footer a, #site-footer a:visited,#site-footer .widget-title {color:" . esc_attr($marjoram_site_footer_text) . ";}
	.date-block {background-color:" . esc_attr($marjoram_datecircle_bg) . "; color:" . esc_attr($marjoram_datecircle_text) . ";}
	.entry-meta, .entry-meta a, .entry-meta a:visited {color:" . esc_attr($marjoram_meta) . ";}
	.sticky-post {color:" . esc_attr($marjoram_featured_label) . ";}
	.blog14 .hentry {background-color:" . esc_attr($marjoram_alternate_blog_bg) . "}	
	.entry-tags a, .widget_tag_cloud a, .entry-tags a:visited, .widget_tag_cloud a:visited {background-color:" . esc_attr($marjoram_tags_bg) . "; color:" . esc_attr($marjoram_tags_text) . ";}
	.entry-tags a:hover, .widget_tag_cloud a:hover {background-color:" . esc_attr($marjoram_tags_hbg) . "; color:" . esc_attr($marjoram_tags_htext) . ";}
	#bottom-sidebar .widget_tag_cloud a {background-color:" . esc_attr($marjoram_bottom_tags_bg) . "; color:" . esc_attr($marjoram_bottom_tags_text) . ";}
	"."\n";
	

// slider
	$marjoram_slider_arrows = get_theme_mod( 'marjoram_slider_arrows', '#0f0f0f' );
	$marjoram_slider_dots = get_theme_mod( 'marjoram_slider_dots', '#e0e0e0' );
	$marjoram_slider_active_dots = get_theme_mod( 'marjoram_slider_active_dots', '#fff' );
	$marjoram_slider_category = get_theme_mod( 'marjoram_slider_category', '#e8dddd' );
	$marjoram_slider_title = get_theme_mod( 'marjoram_slider_title', '#fff' );
	$marjoram_slider_excerpt = get_theme_mod( 'marjoram_slider_excerpt', '#fff' );
	$marjoram_slider_readmore_button = get_theme_mod( 'marjoram_slider_readmore_button', '#ef9d87' );
	$marjoram_slider_readmore_label = get_theme_mod( 'marjoram_slider_readmore_label', '#fff' );
	$custom .= "#featured-slider .prev-arrow, #featured-slider .next-arrow {color:" . esc_attr($marjoram_slider_arrows) . "}
	.slider-dots {color:" . esc_attr($marjoram_slider_dots) . "}
	.slider-dots li:hover,.slick-active {color:" . esc_attr($marjoram_slider_active_dots) . "; color:" . esc_attr($marjoram_slider_active_dots) . "}
	.slide-category a {color:" . esc_attr($marjoram_slider_dots) . "}
	.slider-title a {color:" . esc_attr($marjoram_slider_title) . "}
	.slider-content {color:" . esc_attr($marjoram_slider_excerpt) . "}
	.slider-readmore a {background-color:" . esc_attr($marjoram_slider_readmore_button) . "; color:" . esc_attr($marjoram_slider_readmore_label) . "}
	"."\n";
	
// navigation
	$marjoram_social_bg = get_theme_mod( 'marjoram_social_bg', '#ef9d87' );
	$marjoram_social_icon = get_theme_mod( 'marjoram_social_icon', '#fff' );
	$marjoram_mobile_toggle_bg = get_theme_mod( 'marjoram_mobile_toggle_bg', '#ef9d87' );
	$marjoram_mobile_toggle_icon = get_theme_mod( 'marjoram_mobile_toggle_icon', '#fff' );
	$marjoram_mobile_bg = get_theme_mod( 'marjoram_mobile_bg', '#000' );
	$marjoram_mobile_links = get_theme_mod( 'marjoram_mobile_links', '#c5c5c5' );
	$marjoram_mobile_hlinks = get_theme_mod( 'marjoram_mobile_hlinks', '#bfbb9c' );
	$marjoram_menu_links = get_theme_mod( 'marjoram_menu_links', '#333' );
	$marjoram_menu_hlinks = get_theme_mod( 'marjoram_menu_hlinks', '#ef9d87' );
	$marjoram_submenu_border = get_theme_mod( 'marjoram_submenu_border', '#424242' );
	$marjoram_submenu_bottom_border = get_theme_mod( 'marjoram_submenu_bottom_border', '#222' );
	$custom .= ".social-menu a {background-color:" . esc_attr($marjoram_social_bg) . "}
	.social-menu a:before {color:" . esc_attr($marjoram_social_icon) . "}	
	#mobile-nav-toggle, body.mobile-nav-active #mobile-nav-toggle {background-color:" . esc_attr($marjoram_mobile_toggle_bg) . "; color:" . esc_attr($marjoram_mobile_toggle_icon) . "}	
	#mobile-nav {background-color:" . esc_attr($marjoram_mobile_bg) . ";}	
	#mobile-nav ul li a, #mobile-nav ul .menu-item-has-children i.fa-angle-up, #mobile-nav ul i.fa-angle-down {color:" . esc_attr($marjoram_mobile_links) . ";}	
	#mobile-nav ul li a:hover, #mobile-nav ul .current_page_item a {color:" . esc_attr($marjoram_mobile_hlinks) . ";}
	#main-nav a {color:" . esc_attr($marjoram_menu_links) . ";}
	#main-nav a:hover, #main-nav li:hover > a,#main-nav .current-menu-item > a,#main-nav .current-menu-ancestor > a {color:" . esc_attr($marjoram_menu_hlinks) . ";}	
	#main-nav ul li {border-color:" . esc_attr($marjoram_submenu_border) . ";}
	#main-nav ul {border-bottom-color:" . esc_attr($marjoram_submenu_bottom_border) . ";}	
	"."\n";
	
// forms
	$marjoram_button_bg = get_theme_mod( 'marjoram_button_bg', '#ef9d87' );
	$marjoram_button_label = get_theme_mod( 'marjoram_button_label', '#fff' );
	$marjoram_button_hbg = get_theme_mod( 'marjoram_button_hbg', '#0f0f0f' );
	$marjoram_button_hlabel = get_theme_mod( 'marjoram_button_hlabel', '#fff' );
	$marjoram_field_bg = get_theme_mod( 'marjoram_field_bg', '#f7f7f7' );
	$marjoram_field_border = get_theme_mod( 'marjoram_field_border', '#d1d1d1' );
	$custom .= ".imagebox-readmore,.button,button,button:visited,input[type=button],input[type=button]:visited,input[type=reset],input[type=reset]:visited,input[type=submit],input[type=submit]:visited,.image-navigation a,
.image-navigation a:visited {background-color:" . esc_attr($marjoram_button_bg) . "; color:" . esc_attr($marjoram_button_label) . "}
	.imagebox-readmore:hover, .button:hover, .button:focus, button:hover, button:focus,  input[type=button]:hover,input[type=button]:focus,input[type=reset]:hover,input[type=reset]:focus,input[type=submit]:hover,input[type=submit]:focus,.image-navigation a:focus,
.image-navigation a:hover {background-color:" . esc_attr($marjoram_button_hbg) . "; color:" . esc_attr($marjoram_button_hlabel) . "}
	input[type=date], input[type=time], input[type=datetime-local], input[type=week], input[type=month], input[type=text], input[type=email], input[type=url], input[type=password], input[type=search], input[type=tel], input[type=number], textarea {background-color:" . esc_attr($marjoram_field_bg) . "; border-color:" . esc_attr($marjoram_field_border) . "}
	"."\n";
	
// dropcap		
	if( get_theme_mod( 'marjoram_show_dropcap', false ) ) :
		$marjoram_dropcap_colour = get_theme_mod( 'marjoram_dropcap_colour', '#333' );		
		$custom .= ".single-post .entry-content > p:first-of-type::first-letter {
		font-weight: 700;
		font-style: normal;
		font-family: \"Times New Roman\", Times, serif;
		font-size: 5.25rem;
		font-weight: normal;
		line-height: 0.8;
		float: left;
		margin: 4px 0 0;
		padding-right: 8px;
		text-transform: uppercase;
		}
		.single-post .entry-content h2 ~ p:first-of-type::first-letter {
			font-size: initial;	
			font-weight: initial;	
			line-height: initial; 
			float: initial;	
			margin-bottom: initial;	
			padding-right: initial;	
			text-transform: initial;
		}	
		.single-post .entry-content > p:first-of-type::first-letter {color:" . esc_attr($marjoram_dropcap_colour) . "}"."\n";
	endif;

 
// END CUSTOM CSS

//Output all the styles
	wp_add_inline_style( 'marjoram-style', $custom );	
}
add_action( 'wp_enqueue_scripts', 'marjoram_inline_styles' );	