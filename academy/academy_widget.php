<?php
/**
 * academy widget
**/

// The widget class
class academy_widget extends WP_Widget {
	// Main constructor
	public function __construct() {
		parent::__construct(
			// Base ID of your widget
			'academy_widget',
			// Widget name will appear in UI
			__( '&raquo; Academy social icons', 'academy' ),
			array(
			'classname' => 'academy_widget',
			'description' => __('This Widget displays the social icons','academy'),
				'customize_selective_refresh' => true,
			)
		);
    }

    // The widget form (for the backend )
	public function form( $instance ) {
		// Set widget defaults
		$defaults = array(
			'title'    => '',
			'facebook'     => '',
			'twitter' => '',
			'instagram' => '',
			'linkedin'   => '',
		);

		// Parse current settings with defaults
        extract( wp_parse_args( ( array ) $instance, $defaults ) ); 

        // Widget Title ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php _e( 'Widget Title', 'academy' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<?php // Facebook Field ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>">
				<?php _e( 'Facebook:', 'academy' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
		</p>

		<?php // Twitter Field ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>">
				<?php _e( 'Twitter:', 'academy' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
		</p>

		<?php // Instagram Field ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>">
				<?php _e( 'Instagram:', 'academy' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_attr( $instagram ); ?>" />
		</p>

		<?php // Linkedin Field ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>">
				<?php _e( 'Linkedin:', 'academy' ); ?>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_attr( $linkedin ); ?>" />
		</p>


    <?php }
    
// Update widget settings
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title']    = isset( $new_instance['title'] ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['facebook']     = isset( $new_instance['facebook'] ) ? wp_strip_all_tags( $new_instance['facebook'] ) : '';
		$instance['twitter'] = isset( $new_instance['twitter'] ) ? wp_strip_all_tags( $new_instance['twitter'] ) : '';
		$instance['instagram'] = isset( $new_instance['instagram'] ) ? wp_strip_all_tags( $new_instance['instagram'] ) : '';
		$instance['linkedin']   = isset( $new_instance['linkedin'] ) ? wp_strip_all_tags( $new_instance['linkedin'] ) : '';
		return $instance;
	}

    // Display the widget
	public function widget( $args, $instance ) {
		extract( $args );
		// Check the widget options
		$title    = isset( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$facebook     = isset( $instance['facebook'] ) ? $instance['facebook'] : '';
		$twitter = isset( $instance['twitter'] ) ?$instance['twitter'] : '';
		$instagram   = isset( $instance['instagram'] ) ? $instance['instagram'] : '';
		$linkedin = isset( $instance['linkedin'] ) ? $instance['linkedin'] : '';
		// WordPress core before_widget hook (always include )
		echo $before_widget;
		// Display the widget
		echo '<div class="social-icons">';
		// Display widget title if defined
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
		echo '<div class="social-icons-wraper">';
		// Display Facebook field
		if ( $facebook ) {
			echo '<a class="facebook" href="' . esc_url($facebook) . '"><i class="fa fa-facebook"></i></a>';
		}
		// Display Twitter field
		if ( $twitter ) {
			echo '<a class="twitter" href="' . esc_url($twitter) . '"><i class="fa fa-twitter"></i></a>';
		}
		// Display Instagram field
		if ( $instagram ) {
			echo '<a class="instagram" href="' . esc_url($instagram) . '"><i class="fa fa-instagram"></i></a>';
		}
		// Display Linkedin field
		if ( $linkedin ) {
			echo '<a class="linkedin" href="' . esc_url($linkedin) . '"><i class="fa fa-linkedin"></i></a>';
		}
		echo '</div>';
		echo '</div>';
		// WordPress core after_widget hook (always include )
		echo $after_widget;
	}
}

// Register the widget
function register_academy_widget() {
	register_widget( 'academy_widget' );
}
add_action( 'widgets_init', 'register_academy_widget' );