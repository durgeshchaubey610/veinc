<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Edulab
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="grid-box-wrap">
		<div class="grid-img" itemprop="image">
			<?php 
			if( has_post_thumbnail() ){
				the_post_thumbnail( 'edulab-image-372x244' );
			}else{ ?>
				<img src="<?php echo esc_url( get_template_directory_uri() . '/images/image-372x244.jpg' ); ?>"><?php
			} ?>
		</div>
		<div class="grid-body">
			<?php 
			if ( 'post' === get_post_type() ) : ?>
				<div class="post-meta" itemprop="date">
					<?php echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_html( get_the_time() ) . '</a>'; ?><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?> "><?php echo esc_html( get_the_author() ); ?></a><?php edulab_comment_count(); ?>
				</div><?php 
			endif;
			if ( is_singular() ) :
				the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			the_excerpt(); ?>
			<footer class="article-footer">
				<a href="<?php the_permalink(); ?>"> <?php esc_html_e( 'Read More', 'edulab' ); ?> <i class="fas fa-long-arrow-alt-right"></i></a>
				<?php edulab_article_footer_edit(); ?>
			</footer>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->