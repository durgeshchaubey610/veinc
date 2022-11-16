<?php
/**
 * Template part for the blog navigation - previous and next
 * @package Majoram
*/

the_posts_pagination( array(
	'prev_text' => '<span class="prev">' . esc_html__( 'Previous page', 'marjoram' ) . '</span>',
	'next_text' => '<span class="next">' . esc_html__( 'Next page', 'marjoram' ) . '</span>',
	'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'marjoram' ) . ' </span>',
) );


?>