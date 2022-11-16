<?php
/**
 * Template part for displaying post navigation - next and previous posts
 * @package Marjoram
*/

the_post_navigation( array(
	'next_text' => '<div class="meta-nav" aria-hidden="true">' . esc_html__( 'Next Post', 'marjoram' ) . '</div> ' .
		'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'marjoram' ) . '</span> ' .
		'<span class="post-title">%title</span>',
	'prev_text' => '<div class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous Post', 'marjoram' ) . '</div> ' .
		'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'marjoram' ) . '</span> ' .
		'<span class="post-title">%title</span>',
) );	
							
?>