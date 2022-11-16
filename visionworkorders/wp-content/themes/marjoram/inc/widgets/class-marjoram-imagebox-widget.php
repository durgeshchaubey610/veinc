<?php
/**
 * Ad widget for a imagebox with read more
 * @package Marjoram
 */
 
 
/**
 * Imagebox Widget
 */
class Marjoram_imagebox_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array( 'classname' => 'widget_imagebox', 'description' => esc_html__( 'Create Your Imagebox', 'marjoram' ) );
		$control_ops = array( 'width' => 420, 'height' => 275 );
		parent::__construct( false, $name = esc_html__( 'Marjoram: Imagebox', 'marjoram' ), $widget_ops );
	}

	function form( $instance ) {
		$instance = wp_parse_args( ( array ) $instance, array( 'title' => '', 'imagebox_url' => '', 'imagebox_link' => '' ) );
		$title    = esc_attr( $instance[ 'title' ] );

		$imagebox_link = 'imagebox_link';
		$imagebox_url  = 'imagebox_url';

		$instance[ $imagebox_link ] = esc_url( $instance[ $imagebox_link ] );
		$instance[ $imagebox_url ]  = esc_url( $instance[ $imagebox_url ] );
		
		$intro = isset( $instance[ 'intro' ] ) ? $instance[ 'intro' ] : '';
		$readmore = isset( $instance[ 'readmore' ] ) ? $instance[ 'readmore' ] : '';
		
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'marjoram' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<label><?php esc_html_e( 'Add your Imagebox Link Here', 'marjoram' ); ?></label>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( $imagebox_link )); ?>"> <?php esc_html_e( 'Image Link ', 'marjoram' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( $imagebox_link )); ?>" name="<?php echo esc_attr($this->get_field_name( $imagebox_link )); ?>" value="<?php echo esc_attr($instance[ $imagebox_link ] ); ?>"/>
		</p>

				<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'intro' )); ?>"><?php esc_html_e( 'Intro:', 'marjoram' ); ?></label>
			<textarea id="<?php echo esc_attr($this->get_field_id( 'intro' )); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name( 'intro' )); ?>" value="<?php echo esc_attr( $intro ); ?>"><?php echo esc_html( $intro ); ?></textarea>
		</p>		
				<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'readmore' )); ?>"><?php esc_html_e( 'Button Label:', 'marjoram' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'readmore' )); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name( 'readmore' )); ?>" type="text" value="<?php echo esc_attr( $readmore ); ?>"/>
		</p>
		
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( $imagebox_url )); ?>"> <?php esc_html_e( 'Image ', 'marjoram' ); ?></label>
		<div class="media-uploader" id="<?php echo esc_attr($this->get_field_id( $imagebox_url )); ?>">
			<div class="custom_media_preview">
				<?php if ( $instance[ $imagebox_url ] != '' ) : ?>
					<img class="custom_media_preview_default" src="<?php echo esc_url( $instance[ $imagebox_url ] ); ?>" style="max-width:100%;"/>
				<?php endif; ?>
			</div>
			<input type="text" class="widefat custom_media_input" id="<?php echo esc_attr($this->get_field_id( $imagebox_url )); ?>" name="<?php echo esc_attr($this->get_field_name( $imagebox_url )); ?>" value="<?php echo esc_url( $instance[ $imagebox_url ] ); ?>" style="margin-top:5px;"/>
			<button class="custom_media_upload button button-secondary button-large" id="<?php echo esc_attr($this->get_field_id( $imagebox_url )); ?>" data-choose="<?php esc_attr_e( 'Upload an image', 'marjoram' ); ?>" data-update="<?php esc_attr_e( 'Use image', 'marjoram' ); ?>" style="width:100%;margin-top:6px;margin-right:30px;"><?php esc_html_e( 'Select an Image', 'marjoram' ); ?></button>
		</div>
		</p>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance            = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'intro' ] = strip_tags( $new_instance[ 'intro' ] );
		$instance[ 'readmore' ] = strip_tags( $new_instance[ 'readmore' ] );

		$imagebox_link = 'imagebox_link';
		$imagebox_url  = 'imagebox_url';

		$instance[ $imagebox_link ] = esc_url_raw( $new_instance[ $imagebox_link ] );
		$instance[ $imagebox_url ]  = esc_url_raw( $new_instance[ $imagebox_url ] );

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		
		$intro = isset( $instance[ 'intro' ] ) ? $instance[ 'intro' ] : '';
		$readmore = isset( $instance[ 'readmore' ] ) ? $instance[ 'readmore' ] : '';

		$imagebox_link = 'imagebox_link';
		$imagebox_url  = 'imagebox_url';

		$imagebox_link = isset( $instance[ $imagebox_link ] ) ? $instance[ $imagebox_link ] : '';
		$imagebox_url  = isset( $instance[ $imagebox_url ] ) ? $instance[ $imagebox_url ] : '';

		echo wp_kses_post( $before_widget );
		?>

		
			<?php 
			$output = '';
			if ( ! empty( $imagebox_url ) ) {
				$imagebox_id  = attachment_url_to_postid( $imagebox_url );
				$imagebox_alt = get_post_meta( $imagebox_id, '_wp_attachment_imagebox_alt', true );
				$output    .= '<div class="imagebox-content">';
				
				if ( ! empty( $imagebox_link ) ) {
					$output .= '<a href="' . $imagebox_link . '" class="imagebox-link" target="_blank" rel="nofollow">
                                    <img class="imagebox-thumbnail" src="' . $imagebox_url . '" alt="' . $imagebox_alt . '">
                           </a>';
				} else {
					$output .= '<img src="' . $imagebox_url . '" alt="' . $imagebox_alt . '">';
				}
				$output    .= '<h3 class="widget-title imagebox-title">' . $title . '</h3>';
				$output .= '<div class="imagebox-intro-box"><p class="imagebox-intro">' . $intro . '</p>' . '<p><a class="imagebox-readmore" href="' . $imagebox_link . '">' . $readmore . '</a></p>' . '</div></div>';
				
						   
				echo wp_kses_post( $output );
			}
			?>
		
		<?php
		echo wp_kses_post( $after_widget );
	}

}
?>