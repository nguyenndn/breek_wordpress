<?php
if ( ! class_exists( 'epcl_featured_category' ) ) {
	class epcl_featured_category extends WP_Widget{

		function __construct(){
			$widget_ops = array( 'description' => esc_html__('Display posts from a certain category.', 'epcl_framework') );
			parent::__construct( false, esc_html__('(EP) Posts by Category', 'epcl_framework'), $widget_ops);
		}

		function widget($args, $instance){
            // WP 5.9 Patch: always disable widget preview in the backend
            if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
                return false;
            }
		    global $epcl_theme;
			extract($args);
			$title = apply_filters('widget_title', $instance['title']);
            if( !isset($instance['orderby']) ){
                $instance['orderby'] = 'date';
            }
			$args = array(
				'posts_per_page' => $instance['number'],
				'cat' => $instance['category'],
				'post_type' => 'post',
				'order' => 'DESC',
                'orderby' => $instance['orderby'],
                'ignore_sticky_posts' => true
            );

            if( $instance['orderby'] == 'views' ){
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = 'views_counter';
            }
            
            if( is_single() ){
                $args['post__not_in'] = array( get_the_ID() );
            }
            
			$query = new WP_Query($args);
			if( !$query->have_posts() ) return;
			echo $before_widget;
				if($title) echo $before_title.$title.$after_title;
				if(!$instance['number']) $instance['number'] = 5;
				if(!$instance['category']) $instance['category'] = '';
				if($query->have_posts()):

					while($query->have_posts()): $query->the_post();
                        include( 'partials/loop-article.php' );
                    endwhile;
                    
                    wp_reset_postdata();
                    
				endif;
			echo $after_widget;
		}

		function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['number'] = (int) $new_instance['number'];
            $instance['orderby'] = $new_instance['orderby'];
			$instance['category'] = $new_instance['category'];
			return $instance;
		}

		function form($instance){
			$defaults = array(
				'title' => 'Featured posts',
				'number' => 5,
                'orderby' => 'date',
				'category' => ''
			);
			$instance = wp_parse_args((array)$instance, $defaults);
			$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 4;
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">
					<?php esc_html_e('Title:', 'epcl_framework'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
				</label>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e( 'Number of posts to show:', 'epcl_framework'); ?></label>
				<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
			</p>
            <p>
				<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php esc_html_e('Order by:', 'epcl_framework') ?> </label>
				<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
					<option <?php if ($instance['orderby'] == 'date') echo 'selected="selected"'; ?> value="date"><?php esc_html_e('Recent Posts', 'epcl_framework'); ?></option>
                    <option <?php if ($instance['orderby'] == 'rand') echo 'selected="selected"'; ?> value="rand"><?php esc_html_e('Random Posts', 'epcl_framework'); ?></option>
                    <?php if( function_exists('get_field') ): // By views ?>
                        <option <?php if ($instance['orderby'] == 'views') echo 'selected="selected"'; ?> value="views"><?php esc_html_e('Post views', 'epcl_framework'); ?></option>
                    <?php endif; ?>
				</select>
            </p>
			<p>
				<label for="<?php echo $this->get_field_id('category'); ?>"><?php esc_html_e('Category:', 'epcl_framework') ?> </label>
				<?php wp_dropdown_categories( array('name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] ) ); ?>
			</p>
			<?php
		}

	}

	function epcl_register_featured_category() {
		register_widget('epcl_featured_category');
	}

	add_action('widgets_init', 'epcl_register_featured_category');

}
