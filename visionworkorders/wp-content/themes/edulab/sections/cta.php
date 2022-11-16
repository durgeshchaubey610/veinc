<?php
/**
 * CTA Section
 * 
 * @package edulab
*/

$edulab_cta_text 	  = get_theme_mod( 'cta_section', __( 'Any Queries? Ask us a question at<a href="tel:+0000000000"><i class="fas fa-phone"></i> +0000000000</a>', 'edulab' ) );
?>
<!-- CTA section start -->
<section class="query-section">
	<div class="container">

		<!-- CTA Conte nt -->
		<p><?php echo wp_kses_post( $edulab_cta_text ); ?></p>

	</div>
</section>
<!-- CTA section ends -->