<?php
/**
 * Template file for the grid blog content
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Marjoram
 */
 
 $bloglayout = esc_attr(get_theme_mod( 'marjoram_blog_layout', 'blog1' ));
 $marjoram_blog_title = get_theme_mod( 'marjoram_blog_title', __('Welcome to Our Blog','marjoram' ));
 $marjoram_blog_intro = get_theme_mod( 'marjoram_blog_intro', __('Welcome to our blog where you can read amazing articles and stories for anyone who wants to know more.','marjoram' ));
 
?>

<?php if ( is_home() || is_front_page() ) : ?>	
	<header id="page-header" class="screen-reader-text">
		<h2 class="page-title"><?php esc_html_e( 'Posts', 'marjoram' ); ?></h2>
	</header>
<?php else : ?>
		<header id="page-header">
		<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="description lead">', '</div>' );
		?>
	</header>	
<?php endif; ?>

<div class="row row-eq-height">	
<?php if ( have_posts() ) :
	/* Start the Loop */
	while ( have_posts() ) : the_post(); ?>
			
		
			<div class="col-lg-6">	
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
					<?php if ( '' !== get_the_post_thumbnail() ) : ?>
						<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>">			
								<?php 
								if ( esc_attr(get_theme_mod( 'marjoram_grid_thumbnails', false )) ) :
									the_post_thumbnail( 'marjoram-grid' );  
								else :
									the_post_thumbnail( 'post-thumbnails' ); 
								endif;				
								?>
							</a>				

						</div>
					<?php endif; ?>
					
					<div class="card-body">
					<header class="entry-header">	
					<?php if ( $bloglayout == 'blog6' && esc_attr(get_theme_mod( 'marjoram_show_date_circle', 1 ) ) ) :
										echo '<div class="date-block-wrapper">' . esc_html( marjoram_date_block() ) . '</div>';
									
									endif; ?>
					
				
						<div class="title-meta-wrapper">		
						<?php // get the post title and posted date info
							if( is_sticky()  && esc_attr(get_theme_mod( 'marjoram_show_featured_tag', true ) ) ) { 
							echo '<div class="sticky-post">', esc_html_e('Featured', 'marjoram'), '</div>';
							}
							the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );							
							if ( 'post' === get_post_type()) {
							echo '<ul class="entry-meta">';							
							marjoram_posted_on();								
							echo '</ul>';
						};
						?>
						</div>
																	
					</header>			
						<div class="entry-content">
							<?php	the_excerpt(); ?>
						</div>				
				
					</div>
					</article>
			  </div>
	
		
				
	<?php
	endwhile;
		
	else :
		get_template_part( 'template-parts/post/content', 'none' );
	endif; ?>
</div>

<?php the_posts_navigation(); ?>