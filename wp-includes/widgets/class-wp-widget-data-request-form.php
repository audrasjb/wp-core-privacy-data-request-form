<?php
/**
 * Widget API: WP_Widget_Data_Request class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 5.3.0
 */

/**
 * Core class used to implement a Privacy Data Request Form.
 *
 * @since 5.3.0
 *
 * @see WP_Widget
 */
class WP_Widget_Data_Request extends WP_Widget {

	/**
	 * Sets up a new Data Request Form widget instance.
	 *
	 * @since 5.3.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_data_request_form',
			'description'                 => __( 'A Privacy Data Request Form for your site.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'data-request', _x( 'Data Request Form', 'Data Request Form widget' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Data Request widget instance.
	 *
	 * @since 5.3.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Data Request widget instance.
	 */
	public function widget( $args, $instance ) {
		$title        = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$description  = ! empty( $instance['description'] ) ? $instance['description'] : '';
		$request_type = ! empty( $instance['request_type'] ) ? $instance['request_type'] : 'both';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>
		
		<?php if ( ! empty( $description ) ) : ?>
			<div class="data-request-form-field-description">
				<?php echo apply_filters( 'the_content', $description ); ?>
			</div>
		<?php endif; ?>

		<?php
		echo wp_get_privacy_data_request_form( array( 'request_type' => $request_type ) );

		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings form for the Data Request widget.
	 *
	 * @since 5.3.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance     = wp_parse_args( (array) $instance, array( 'title' => '', 'description' => '', 'request_type' => 'both' ) );
		$title        = $instance['title'];
		$description  = $instance['description'];
		$request_type = $instance['request_type'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title:' ); ?> 
				<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>">
				<?php _e( 'Description:' ); ?> 
				<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo sanitize_textarea_field( $description ); ?></textarea>
			</label>
		</p>
		<div role="radiogroup" aria-labelledby="wp-privacy-form-radio-label">
			<p id="wp-privacy-form-radio-label"><?php esc_html_e( 'Request type available in the form:' ); ?></p>
			<p>
				<label for="<?php echo $this->get_field_id( 'request_type' ); ?>-both">
					<input type="radio" name="<?php echo $this->get_field_name( 'request_type' ); ?>" id="<?php echo $this->get_field_id( 'request_type' ); ?>-both" value="both"<?php checked( $request_type, 'both' ); ?> />
					<?php esc_html_e( 'Both Export and Remove' ); ?>
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'request_type' ); ?>-export">
					<input type="radio" name="<?php echo $this->get_field_name( 'request_type' ); ?>" id="<?php echo $this->get_field_id( 'request_type' ); ?>-export" value="export"<?php checked( $request_type, 'export' ); ?> />
					<?php esc_html_e( 'Export' ); ?>
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'request_type' ); ?>-remove">
					<input type="radio" name="<?php echo $this->get_field_name( 'request_type' ); ?>" id="<?php echo $this->get_field_id( 'request_type' ); ?>-remove" value="remove" <?php checked( $request_type, 'remove' ); ?> />
					<?php esc_html_e( 'Remove' ); ?>
				</label>
			</p>
		</div>
		<?php
	}

	/**
	 * Handles updating settings for the current Search widget instance.
	 *
	 * @since 5.3.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                 = wp_parse_args( (array) $instance, array( 'title' => '', 'description' => '' ) );
		$instance                 = $old_instance;
		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['description']  = sanitize_textarea_field( $new_instance['description'] );
		$instance['request_type'] = sanitize_text_field( $new_instance['request_type'] );
		return $instance;
	}

}
