<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemprop="blogPost">
	<?php 
	the_title( '<h1 class="entry-title" itemprop="name">', '</h1>' ); ?>
	<div class="meta-items"><?php
		if ( 'post' === get_post_type() ) { ?>
				<?php edulab_posted_by(); ?>
				<?php edulab_category(); ?>
				<?php edulab_posted_on(); ?>
				<?php edulab_comment_count();
		} ?>
	</div>
	<?php
	if( has_post_thumbnail() ) the_post_thumbnail();
	the_content();  ?>
	<?php edulab_article_footer_edit(); ?>
</article><!-- #post-<?php the_ID(); ?> -->