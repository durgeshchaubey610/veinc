<?php
/**
 * Template part for displaying page content in page.php
 * @package Marjoram
*/

?>

<?php get_template_part( 'template-parts/sidebars/sidebar', 'breadcrumbs' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php 
// featured image for pages
 if ( '' !== get_the_post_thumbnail() ) : 
		echo '<div class="post-thumbnail">';		
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ), 'class' => ''));
		echo '</div>';
endif;		
?>
	
	<header class="entry-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'marjoram' ),
				'after'  => '</div>',
			) );
		?>
	</div>

	<?php if ( esc_attr(get_theme_mod( 'marjoram_show_edit_link', false ) ) ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'marjoram' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer>
	<?php endif; ?>
	
</article>
