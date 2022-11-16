<?php 
/**
 * Register theme sidebars
 * @package Marjoram
*/
 
function relative_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Blog Right Sidebar', 'marjoram' ),
		'id' => 'blogright',
		'description' => esc_html__( 'Right sidebar for the blog', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Blog Left Sidebar', 'marjoram' ),
		'id' => 'blogleft',
		'description' => esc_html__( 'Left sidebar for the blog', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => esc_html__( 'Page Right Sidebar', 'marjoram' ),
		'id' => 'pageright',
		'description' => esc_html__( 'Right sidebar for pages', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => esc_html__( 'Page Left Sidebar', 'marjoram' ),
		'id' => 'pageleft',
		'description' => esc_html__( 'Left sidebar for pages', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );		
	register_sidebar( array(
		'name' => esc_html__( 'Banner', 'marjoram' ),
		'id' => 'banner',
		'description' => esc_html__( 'For Images and Sliders.', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );	

	register_sidebar( array(
		'name' => esc_html__( 'Breadcrumbs', 'marjoram' ),
		'id' => 'breadcrumbs',
		'description' => esc_html__( 'For adding breadcrumb navigation if using a plugin, or you can add content here.', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Intro', 'marjoram' ),
		'id' => 'intro',
		'description' => esc_html__( 'This is a sidebar position that sits below your header and above the main content.', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );	

	register_sidebar( array(
		'name' => esc_html__( 'Featured 1', 'marjoram' ),
		'id' => 'featured1',
		'description' => esc_html__( 'Featured 1 position', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	register_sidebar( array(
		'name' => esc_html__( 'Featured 2', 'marjoram' ),
		'id' => 'featured2',
		'description' => esc_html__( 'Featured 2 position', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Featured 3', 'marjoram' ),
		'id' => 'featured3',
		'description' => esc_html__( 'Featured 3 position', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Featured 4', 'marjoram' ),
		'id' => 'featured4',
		'description' => esc_html__( 'Featured 4 position', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Bottom 1', 'marjoram' ),
		'id' => 'bottom1',
		'description' => esc_html__( 'Bottom 1 position', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Bottom 2', 'marjoram' ),
		'id' => 'bottom2',
		'description' => esc_html__( 'Bottom 2 position', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Bottom 3', 'marjoram' ),
		'id' => 'bottom3',
		'description' => esc_html__( 'Bottom 3 position', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Bottom 4', 'marjoram' ),
		'id' => 'bottom4',
		'description' => esc_html__( 'Bottom 4 position', 'marjoram' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	
	
	// Register imagebox widget
	register_widget( 'Marjoram_imagebox_widget' );	
	
	// Register recent posts widget
	register_widget( 'Marjoram_Recent_Posts_Widget' );

}
add_action( 'widgets_init', 'relative_widgets_init' );


// Count the number of widgets to enable resizable widgets in the featured group.
function marjoram_featured() {
	$count = 0;
	if ( is_active_sidebar( 'featured1' ) )
		$count++;
	if ( is_active_sidebar( 'featured2' ) )
		$count++;
	if ( is_active_sidebar( 'featured3' ) )
		$count++;		
	if ( is_active_sidebar( 'featured4' ) )
		$count++;
	$class = '';
	switch ( $count ) {
		case '1':
			$class = 'col-lg-12';
			break;
		case '2':
			$class = 'col-lg-6';
			break;
		case '3':
			$class = 'col-lg-4';
			break;
		case '4':
			$class = 'col-sm-12 col-md-6 col-lg-3';
			break;
	}
	if ( $class )
		echo 'class="' . esc_attr( $class ) . '"';
}

// Count the number of widgets to enable resizable widgets in the bottom group.
function marjoram_bottom_group() {
	$count = 0;
	if ( is_active_sidebar( 'bottom1' ) )
		$count++;
	if ( is_active_sidebar( 'bottom2' ) )
		$count++;
	if ( is_active_sidebar( 'bottom3' ) )
		$count++;		
	if ( is_active_sidebar( 'bottom4' ) )
		$count++;
	$class = '';
	switch ( $count ) {
		case '1':
			$class = 'col-lg-12';
			break;
		case '2':
			$class = 'col-lg-6';
			break;
		case '3':
			$class = 'col-lg-4';
			break;
		case '4':
			$class = 'col-sm-12 col-md-6 col-lg-3';
			break;
	}
	if ( $class )
		echo 'class="' . esc_attr( $class ) . '"';
}
