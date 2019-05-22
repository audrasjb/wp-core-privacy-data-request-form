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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$description = ! empty( $instance['description'] ) ? $instance['description'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		// Enqueue CSS/JS
		wp_enqueue_script( 'gdrf-public-scripts' );
		wp_enqueue_style( 'gdrf-public-styles' );

		// Captcha
		$number_one = rand( 1, 9 );
		$number_two = rand( 1, 9 );

		?>
		
		<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" class="widget_data_request_form">
			<input type="hidden" name="action" value="data_request">
			<input type="hidden" name="data-request-form_data_human_key" value="<?php echo $number_one . '000' . $number_two; ?>" />
			<input type="hidden" name="data-request-form-nonce" value="<?php echo wp_create_nonce( 'data-request-form-nonce' ); ?>" />

		<?php if ( ! empty( $description ) ) : ?>
			<div class="data-request-form-field-description">
				<?php echo apply_filters( 'the_content', $description ); ?>
			</div>
		<?php endif; ?>

			<div class="data-request-form-field-action" role="radiogroup" aria-labelledby="data-request-form-radio-label">
				<p class="data-request-form-radio-label">
					<?php esc_html_e( 'Select your request:' ); ?>
				</p>

				<input class="data-request-form-type-input" type="radio" name="data-request-form-type-export" value="export_personal_data">
				<label for="data-request-form-type-export" class="data-request-form-type-label">
					<?php esc_html_e( 'Export Personal Data' ); ?>
				</label>
				<br />
				<input class="data-request-form-type-input" type="radio" name="data-request-form-type" value="remove_personal_data">
				<label for="data-request-form-type-remove" class="data-request-form-type-label">
					<?php esc_html_e( 'Remove Personal Data' ); ?>
				</label>
			</div>

			<p class="data-request-form-field-email">
				<label for="data-request-form-email">
					<?php esc_html_e( 'Your email address (required)' ); ?>
				</label>
				<input type="email" name="data-request-form-email" required />
			</p>

			<p class="data-request-form-field-human">
				<label for="data-request-form-human">
					<?php esc_html_e( 'Human verification (required):' ); ?>
					<?php echo $number_one . ' + ' . $number_two . ' = ?'; ?>
				</label>
				<input type="text" name="data-request-form-human" required />
			</p>

			<p class="data-request-form-field-submit">
				<input type="submit" value="<?php esc_html_e( 'Send request' ); ?>" />
			</p>
		</form>

		<?php
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
		$instance    = wp_parse_args( (array) $instance, array( 'title' => '', 'description' => '' ) );
		$title       = $instance['title'];
		$description = $instance['description'];
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description:' ); ?> <textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo sanitize_textarea_field( $description ); ?></textarea></label></p>
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
		$instance                = wp_parse_args( (array) $instance, array( 'title' => '', 'description' => '' ) );
		$instance                = $old_instance;
		$instance['title']       = sanitize_text_field( $new_instance['title'] );
		$instance['description'] = sanitize_textarea_field( $new_instance['description'] );
		return $instance;
	}

}
