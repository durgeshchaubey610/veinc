<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Edulab
 */

// Home sections => page-templates -> home-sections
$edulab_home_sections = array( 'courses', 'whyus', 'portfolio', 'testimonial', 'blog' );

$edulab_section = edulab_home_section();

// Check the home page is static page or blog page.
if ( 'posts' == get_option( 'show_on_front' ) ) { 
	//Show Static Blog Page

    get_template_part( 'index' );

}elseif( $edulab_section ){  
	//Show homepage sections

    get_header();
    
    get_template_part( 'sections/banner' );  
    //If any one section are enabled then show custom home page.
    foreach( $edulab_home_sections as $edulab_section ){
        get_template_part( 'sections/' .  $edulab_section );  
    }

    get_footer();

}else {
    //If all section are disabled then show respective page template. 

    get_template_part( 'page' );

}