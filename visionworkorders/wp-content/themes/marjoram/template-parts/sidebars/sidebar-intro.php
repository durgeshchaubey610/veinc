<?php
/**
 * For the intro Sidebar
 * @package Marjoram
*/

if (   ! is_active_sidebar( 'intro'  )	)
		return;
	// If we get this far, we have widgets. Let do this.
?>


<aside id="intro-sidebar" class="widget-area">		             
	<?php dynamic_sidebar( 'intro' ); ?> 	
</aside> 
