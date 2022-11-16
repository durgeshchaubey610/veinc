<?php
/**
 * For displaying banner
 * @package Marjoram
*/

if ( ! is_active_sidebar( 'banner' ) ) {
	return;
}
 
?>
	
<?php if ( is_active_sidebar( 'banner' ) ) : ?>
<div id="banner-sidebar" class="widget-area">
<div class="container-fluid">
	<div class="row no-gutters">
		<div class="col-lg-12">
			<?php dynamic_sidebar( 'banner' ); ?>
		</div>
	</div>
	</div>
</div>
<?php endif; ?>