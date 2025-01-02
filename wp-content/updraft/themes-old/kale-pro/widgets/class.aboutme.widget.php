<?php 
class Kale_AboutMe_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'scripts'));
		parent::__construct(
			'kale_aboutme_widget', 
			esc_html__( 'Kale Pro - About Me', 'kale' ), 
			array(  'classname' => 'widget_text', 
                    'description' => esc_html__( 'Show some information about yourself along with an image.', 'kale' ), ) 
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
        echo "<div class='textwidget'>";
        if ( ! empty( $instance['image'] ) ) {
			echo "<img src='".esc_url($instance['image'])."' class='img-responsive pull-left' />";
		}
        if ( ! empty( $instance['description'] ) ) {
            echo apply_filters( 'widget_text', $instance['description'] );
        }
        echo "</div>";
        echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Title of widget.', 'kale' );
        $description = ! empty( $instance['description'] ) ? $instance['description'] : esc_html__( 'Some description text goes here.', 'kale' );
        $image = ! empty( $instance['image'] ) ? $instance['image'] : '';
		?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e( 'Title:', 'kale' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_attr_e( 'Description:', 'kale' ); ?></label> 
		<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" rows="8" cols="20"><?php echo wp_kses_post( force_balance_tags($description) ); ?></textarea>
		</p>
        <p>
        <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php esc_attr_e( 'Image:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
        <button class="upload_image_button button button-primary">Upload Image</button>
        </p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? esc_html( $new_instance['title'] ) : '';
        $instance['description'] = ( ! empty( $new_instance['description'] ) ) ? wp_kses_post( force_balance_tags( $new_instance['description'] ) ) : '';
        $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? esc_url( $new_instance['image'] ) : '';

		return $instance;
	}
    
    public function scripts()
    {
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_media();
        wp_enqueue_script('kale_aboutme_widget', get_template_directory_uri() . '/widgets/aboutme_widget.js', array('jquery'));
    }

} // class Kale_AboutMe_Widget
?>