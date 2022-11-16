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

get_header();
	?>
	<div class="page-content" itemscope itemtype=" http://schema.org/Blog">
		<div class="container">
			<div class="primary">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'single' );

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

					if ( is_singular( 'attachment' ) ) {
						// Parent post navigation.
						the_post_navigation(
							array(
								/* translators: %s: parent post link */
								'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'edulab' ), '%title' ),
							)
						);
					} elseif ( is_singular( 'post' ) ) {
						// Previous/next post navigation.
						the_post_navigation(
							array(
								'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next Post', 'edulab' ) . '</span> ' .
									'<span class="screen-reader-text">' . __( 'Next post:', 'edulab' ) . '</span> <br/>' .
									'<span class="post-title">%title</span>',
								'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous Post', 'edulab' ) . '</span> ' .
									'<span class="screen-reader-text">' . __( 'Previous post:', 'edulab' ) . '</span> <br/>' .
									'<span class="post-title">%title</span>',
							)
						);
					}
				endwhile;
				?>
			</div>
			<?php 
			get_sidebar(); ?>
		</div>
	</div><?php
get_footer();
