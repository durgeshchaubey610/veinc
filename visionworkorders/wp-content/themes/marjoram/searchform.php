<?php
/**
 * Template for displaying the search form
 * @package Marjoram
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label><span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'marjoram' ); ?></span></label>
	<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'marjoram' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />	
	<button type="submit" class="search-submit"><i class="fas fa fa-search"></i><span class="screen-reader-text"><?php echo esc_attr_x( 'Search', 'submit button', 'marjoram' ); ?></span></button>
</form>