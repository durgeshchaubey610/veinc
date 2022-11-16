<?php
/**
 * Custom template tags for this theme
 * Eventually, some of the functionality here could be replaced by core features.
 * @package Marjoram
 */

 
 /**
 * Gets a nicely formatted string for the published date.
 */
	if ( ! function_exists( 'marjoram_time_link' ) ) :
	function marjoram_time_link() {
		$bloglayout = esc_attr(get_theme_mod( 'marjoram_blog_layout', 'blog1' ));
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		
		$posted_on = sprintf(
			/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'marjoram' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

		// Output the posted date
		echo '<li class="posted-on">' . $posted_on . '</li>'; // WPCS: XSS OK.	
		
		// Add the comments link to the post meta info
		if ( is_home() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<li class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'marjoram' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</li>';
		}
		
	}
endif;
 
 
// Display the post meta info for the blog
if ( ! function_exists( 'marjoram_date_block' ) ) :
function marjoram_date_block() {
	$time_string = '<span class="block-month-day">%1$s %2$s</span><span class="block-year">%3$s</span>';

	$posted_on = sprintf( $time_string,
         get_the_date( 'M' ),
		 get_the_date( 'd' ),			
		get_the_date( 'Y' )
	);

	echo '<span class="date-block published">' . wp_kses_post($posted_on) . '</span>';

}
endif; 
 
 
/**
 * Prints HTML with meta information for the current post-date/time.
 */
	if ( ! function_exists( 'marjoram_posted_on' ) ) :
	function marjoram_posted_on() {
		$bloglayout = esc_attr(get_theme_mod( 'marjoram_blog_layout', 'blog1' ));
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<li class="entry-date"><time class="published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">' . __( '<span class="update-label">Updated</span>', 'marjoram') . ' %4$s</time></li>';
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
	
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'marjoram' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'	);
			echo '<li class="byline"> ' . $byline . '</li>'; // WPCS: XSS OK.
		
		$posted_on = sprintf(
			/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'marjoram' ),
		$time_string );

		// Output the posted date
		echo '<li class="posted-on">' . $posted_on . '</li>'; // WPCS: XSS OK.	

		
		// Add the comments link to the post meta info
		if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<li class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'marjoram' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</li>';
		}
		
		// Add the edit link to the post meta info
		if ( esc_attr(get_theme_mod( 'marjoram_show_edit_link', false ) ) ) :
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
			'<li class="edit-link">',
			'</li>'
		);	
			endif;
	}
endif;

 
/**
 * Prints HTML with meta information for the current post-date/time.
 */
	if ( ! function_exists( 'marjoram_single_posted_on' ) ) :
	function marjoram_single_posted_on() {
		$bloglayout = esc_attr(get_theme_mod( 'marjoram_blog_layout', 'blog1' ));
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
	
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'marjoram' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'	);
			echo '<li class="byline"> ' . $byline . '</li>'; // WPCS: XSS OK.
		
		$posted_on = sprintf(
			/* translators: %s: post date */
		__( '<span class="screen-reader-text">Posted on</span> %s', 'marjoram' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );
	
		// Add categories to the post meta info
		$categories_list = get_the_category_list( esc_html__( ', ', 'marjoram' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<li class="cat-links">' . esc_html__( 'In %1$s', 'marjoram' ) . '</li>', $categories_list ); // WPCS: XSS OK.
		}

		// Output the posted date
		echo '<li class="posted-on">' . $posted_on . '</li>'; // WPCS: XSS OK.	
		
		// Add the comments link to the post meta info
		if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<li class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'marjoram' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</li>';
		}
		
		// Add the edit link to the post meta info
		if ( esc_attr(get_theme_mod( 'marjoram_show_edit_link', false ) ) ) :
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
			'<li class="edit-link">',
			'</li>'
		);	
		endif;		
	}
endif;

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if ( ! function_exists( 'marjoram_entry_footer' ) ) :
	function marjoram_entry_footer() {
		/* get tags list */
		if(get_the_tag_list()) {
			echo wp_kses_post( get_the_tag_list('<ul class="entry-tags"><li>','</li><li>','</li></ul>') );
		}
	}
endif;

/**
 * Returns an accessibility-friendly link to edit a post or page.
 * This also gives us a little context about what exactly we're editing
 * (post or page?) so that users understand a bit more where they are in terms
 * of the template hierarchy and their content. Helpful when/if the single-page
 * layout with multiple posts/pages shown gets confusing.
 */
if ( ! function_exists( 'marjoram_edit_link' ) ) :
function marjoram_edit_link() {
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'marjoram' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Displays an optional post thumbnail.
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
if ( ! function_exists( 'marjoram_post_thumbnail' ) ) :
function marjoram_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}
if ( is_singular() ) :
?>
	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div>

<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
		?>
	</a>

<?php endif; 
}
endif;
