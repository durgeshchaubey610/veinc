<?php
/**
 * The template for displaying the footer
 * @package Marjoram
 */

?>


<?php get_template_part( 'template-parts/sidebars/sidebar', 'bottom' ); ?>

	<footer id="site-footer">
				
		<?php get_template_part( 'template-parts/navigation/navigation', 'social' ); ?>
		<?php get_template_part( 'template-parts/navigation/navigation', 'footer' ); ?>	
		<?php get_template_part( 'template-parts/sidebars/sidebar', 'footer' ); ?>
		
		<p id="copyright">
			<?php esc_html_e('Copyright &copy;', 'marjoram'); ?> 
			<?php 	echo date_i18n( esc_html__( 'Y', 'marjoram' ) );  // WPCS: XSS OK ?>
			<?php echo esc_html(get_theme_mod( 'marjoram_copyright' )); ?>. <?php esc_html_e('All rights reserved.', 'marjoram'); ?>
		</p>

	</footer><!-- #site-footer -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
