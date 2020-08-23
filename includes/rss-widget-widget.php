<?php

/**
 * Adds Foo_Widget widget.
 */
class RSS_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'rss_widget', // Base ID
			esc_html__( 'RSS Widget', 'rss-widget' ), // Name
			array( 'description' => esc_html__( 'A Wiget To Display RSS Feeds', 'rss-widget' ), ) // Args
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
                $rss_feed = $instance['rss_feed'];
                $rss_items = $instance['rss_items'];
                $rss_date = $instance['rss_date'];
                $rss_summary = $instance['rss_summary'];
                if(!empty($rss_feed)){
                    wp_widget_rss_output(array(
                        'url'=>$rss_feed ,
                        'title'=>$title ,
                        'items'=>$rss_items ,
                        'show_date'=>$rss_date ,
                        'show_summary'=>$rss_summary ,
                        'show_author'=>0
                        
                    ));
                }
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
                $rss_feed = $instance['rss_feed'];
                $rss_items = $instance['rss_items'];
                $rss_date = $instance['rss_date'];
                $rss_summary = $instance['rss_summary'];
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
                
                <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'rss_feed' ) ); ?>"><?php esc_attr_e( 'RSS Feed:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rss_feed' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rss_feed' ) ); ?>" type="text" value="<?php echo esc_attr( $rss_feed ); ?>">
		</p>
                
                <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'rss_items' ) ); ?>"><?php esc_attr_e( 'RSS Items:', 'text_domain' ); ?></label> 
                <select id ="<?php echo esc_attr( $this->get_field_id( 'rss_items' ) ); ?>" name ="<?php echo esc_attr( $this->get_field_name( 'rss_items' ) ); ?>">
                    <option value="1" <?php selected($rss_items ,1) ; ?>>1</option>
                    <option value="2" <?php selected($rss_items ,2) ; ?>>2</option>
                    <option value="3" <?php selected($rss_items ,3) ; ?>>3</option>
                    <option value="4" <?php selected($rss_items ,4) ; ?>>4</option>
                </select>
		</p>
                 <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'rss_date' ) ); ?>"><?php esc_attr_e( 'Show RSS Date:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rss_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rss_date' ) ); ?>" type="checkbox" <?php checked($rss_date ,'on') ;?>>
		</p>
                <p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'rss_summary' ) ); ?>"><?php esc_attr_e( 'Show RSS Summary:', 'text_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rss_summary' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rss_summary' ) ); ?>" type="checkbox" <?php checked($rss_summary ,'on') ;?>>
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
		$instance = array(
                                'title' => (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '',
                                'rss_feed' => (!empty($new_instance['rss_feed'])) ? strip_tags($new_instance['rss_feed']) : '',
                                'rss_items' => (!empty($new_instance['rss_items'])) ? strip_tags($new_instance['rss_items']) : '',
                                'rss_date' => (!empty($new_instance['rss_date'])) ? strip_tags($new_instance['rss_date']) : '',
                                'rss_summary' => (!empty($new_instance['rss_summary'])) ? strip_tags($new_instance['rss_summary']) : ''
                                );
		

		return $instance;
	}

} 
function register_rss_widget() {
    register_widget( 'RSS_Widget' );
}
add_action( 'widgets_init', 'register_rss_widget' );

