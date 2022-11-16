<?php
/**
 * Displays the feature sidebar group
 * @package Marjoram
*/

if (   ! is_active_sidebar( 'featured1'  )
	&& ! is_active_sidebar( 'featured2' )
	&& ! is_active_sidebar( 'featured3'  )		
	&& ! is_active_sidebar( 'featured4'  )	
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>
   
<div id="featured-sidebar" style="max-width: <?php echo esc_attr(get_theme_mod( 'marjoram_featured_size', '1200' )); ?>px;">   
<aside class="widget-area container-fluid">

		<div class="row">		   
			<?php if ( is_active_sidebar( 'featured1' ) ) : ?>
				<div id="featured1" <?php marjoram_featured(); ?>>
					<?php dynamic_sidebar( 'featured1' ); ?>
				</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'featured2' ) ) : ?>      
				<div id="featured2" <?php marjoram_featured(); ?>>
					<?php dynamic_sidebar( 'featured2' ); ?>
				</div>         
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'featured3' ) ) : ?>        
				<div id="featured3" <?php marjoram_featured(); ?>>
					<?php dynamic_sidebar( 'featured3' ); ?>
				</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'featured4' ) ) : ?>        
				<div id="featured4" <?php marjoram_featured(); ?>>
					<?php dynamic_sidebar( 'featured4' ); ?>
				</div>
			<?php endif; ?>		
		</div>

</aside>         
</div>