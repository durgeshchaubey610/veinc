<?php
/**
 * Template part for displaying a message that posts cannot be found
 * @package Marjoram
*/

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'marjoram' ); ?></h1>
	</header>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( 
			/* translators: %s: post title */
			wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'marjoram' ), esc_url( admin_url( 'post-new.php' ) ) ) ); ?></p>

		<?php else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'marjoram' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div>
</section>