<?php
if ( ! class_exists( 'epcl_social' ) ) {
	class epcl_social extends WP_Widget{

		function __construct(){
			$widget_ops = array('description' => esc_html__('Display your social profiles.', 'epcl_framework'));
			parent::__construct( false, esc_html__('(EP) Social', 'epcl_framework'), $widget_ops);
		}

		function widget($args, $instance){
            // WP 5.9 Patch: always disable widget preview in the backend
            if ( defined( 'REST_REQUEST' ) && REST_REQUEST ) {
                return false;
            }
			global $epcl_theme;
			extract($args);
			$title = apply_filters('widget_title', $instance['title'] );

			$enable_twitter = $instance[ 'enable_twitter' ] ? true : false;
			$enable_facebook = $instance[ 'enable_facebook' ] ? true : false;
			$enable_instagram = $instance[ 'enable_instagram' ] ? true : false;
			$enable_linkedin = $instance[ 'enable_linkedin' ] ? true : false;
			$enable_pinterest = $instance[ 'enable_pinterest' ] ? true : false;
			$enable_dribbble = $instance[ 'enable_dribbble' ] ? true : false;
			$enable_tumblr = $instance[ 'enable_tumblr' ] ? true : false;
			$enable_youtube = $instance[ 'enable_youtube' ] ? true : false;
            $enable_flickr = $instance[ 'enable_flickr' ] ? true : false;
            $enable_twitch = isset( $instance[ 'enable_twitch' ] ) && $instance[ 'enable_twitch' ] ? true : false;
            $enable_vk = isset( $instance[ 'enable_vk' ] ) && $instance[ 'enable_vk' ] ? true : false;
            $enable_telegram = isset( $instance[ 'enable_telegram' ] ) && $instance[ 'enable_telegram' ] ? true : false;
            $enable_rss = $instance[ 'enable_rss' ] ? true : false;
            $enable_tiktok = isset( $instance[ 'enable_tiktok' ] ) && $instance[ 'enable_tiktok' ] ? true : false;
            $enable_patreon = isset( $instance[ 'enable_patreon' ] ) && $instance[ 'enable_patreon' ] ? true : false;

			echo $before_widget;

				if($title) echo $before_title.$title.$after_title;
				echo '<div class="icons title">';

					if( $epcl_theme['twitter_url'] && $enable_twitter != false )
						echo '<a href="'.$epcl_theme['twitter_url'].'" class="twitter" target="_blank" rel="nofollow noopener"><i class="fa fa-twitter"></i><p>'.esc_html__('Twitter', 'breek').' <span>'.esc_html__('Follow me!', 'breek').'</span></p></a>';

					if( $epcl_theme['facebook_url'] && $enable_facebook != false )
						echo '<a href="'.$epcl_theme['facebook_url'].'" class="facebook" target="_blank" rel="nofollow noopener"><i class="fa fa-facebook"></i><p>'.esc_html__('Facebook', 'breek').' <span>'.esc_html__('Follow me!', 'breek').'</span></p></a>';

					if( $epcl_theme['instagram_url'] && $enable_instagram != false )
                        echo '<a href="'.$epcl_theme['instagram_url'].'" class="instagram" target="_blank" rel="nofollow noopener"><i class="fa fa-instagram"></i><p>'.esc_html__('Instagram', 'breek').' <span>'.esc_html__('Our photos!', 'breek').'</span></p></a>';

                    if( $epcl_theme['linkedin_url'] && $enable_linkedin != false )
						echo '<a href="'.esc_url( $epcl_theme['linkedin_url'] ).'" class="linkedin" target="_blank" rel="nofollow noopener"><i class="fa fa-linkedin"></i> <p>'.esc_html__('Linkedin', 'breek').' <span>'.esc_html__('Visit me!', 'breek').'</span></p></a>';

					if( $epcl_theme['pinterest_url'] && $enable_pinterest != false )
						echo '<a href="'.$epcl_theme['pinterest_url'].'" class="pinterest" target="_blank" rel="nofollow noopener"><i class="fa fa-pinterest"></i><p>'.esc_html__('Pinterest', 'breek').' <span>'.esc_html__('Pin it!', 'breek').'</span></p></a>';

					if( $epcl_theme['dribbble_url'] && $enable_dribbble != false )
						echo '<a href="'.$epcl_theme['dribbble_url'].'" class="dribbble" target="_blank" rel="nofollow noopener"><i class="fa fa-dribbble"></i><p>'.esc_html__('Dribbble', 'breek').' <span>'.esc_html__('Our work!', 'breek').'</span></p></a>';

					if( $epcl_theme['tumblr_url'] && $enable_tumblr != false )
						echo '<a href="'.$epcl_theme['tumblr_url'].'" class="tumblr" target="_blank" rel="nofollow noopener"><i class="fa fa-tumblr"></i><p>'.esc_html__('Tumblr', 'breek').' <span>'.esc_html__('Visit me!', 'breek').'</span></p></a>';

					if( $epcl_theme['youtube_url'] && $enable_youtube != false )
						echo '<a href="'.$epcl_theme['youtube_url'].'" class="youtube" target="_blank" rel="nofollow noopener"><i class="fa fa-youtube"></i> <p>'.esc_html__('Youtube', 'breek').' <span>'.esc_html__('Check my videos!', 'breek').'</span></p></a>';

					if( $epcl_theme['flickr_url'] && $enable_flickr != false )
                        echo '<a href="'.$epcl_theme['flickr_url'].'" class="flickr" target="_blank" rel="nofollow noopener"><i class="fa fa-flickr"></i><p>'.esc_html__('Flickr', 'breek').' <span>'.esc_html__('See more photos!', 'breek').'</span></p></a>';

                    if( $epcl_theme['twitch_url'] && $enable_twitch != false )
                        echo '<a href="'.$epcl_theme['twitch_url'].'" class="twitch" target="_blank" rel="nofollow noopener"><i class="fa fa-twitch"></i><p>'.esc_html__('Twitch', 'breek').' <span>'.esc_html__('Check my videos!', 'breek').'</span></p></a>';
                        
                    if( $epcl_theme['vk_url'] && $enable_vk != false )
                        echo '<a href="'.$epcl_theme['vk_url'].'" class="vk" target="_blank" rel="nofollow noopener"><i class="fa fa-vk"></i><p>'.esc_html__('VKontakte', 'breek').' <span>'.esc_html__('Follow me!', 'breek').'</span></p></a>';   
                        
                    if( $epcl_theme['telegram_url'] && $enable_telegram != false )
                        echo '<a href="'.$epcl_theme['telegram_url'].'" class="telegram" target="_blank" rel="nofollow"><i class="fa fa-telegram"></i><p>'.esc_html__('Telegram', 'breek').' <span>'.esc_html__('Follow me!', 'breek').'</span></p></a>';  
                        
                    if( $epcl_theme['tiktok_url'] && $enable_tiktok != false )
                        echo '<a href="'.$epcl_theme['tiktok_url'].'" class="tiktok" target="_blank" rel="nofollow noopener"><span class="icon"><svg><use xlink:href="#tiktok-icon"></use></svg></span><p>'.esc_html__('TikTok', 'breek').' <span>'.esc_html__('Follow me!', 'breek').'</span></p></a>';

                    if( $epcl_theme['patreon_url'] && $enable_patreon != false )
                        echo '<a href="'.$epcl_theme['patreon_url'].'" class="patreon" target="_blank" rel="nofollow noopener"><span class="icon"><svg><use xlink:href="#patreon-icon"></use></svg></span><p>'.esc_html__('Patreon', 'breek').' <span>'.esc_html__('Our work!', 'breek').'</span></p></a>';

					if( $epcl_theme['rss_url'] && $enable_rss != false )
						echo '<a href="'.$epcl_theme['rss_url'].'" class="rss" target="_blank" rel="nofollow"><i class="fa fa-rss"></i><p>'.esc_html__('RSS', 'breek').' <span>'.esc_html__('Get our latest news!', 'breek').'</span></p></a>';

				echo '</div>';
			echo $after_widget;
		}

		function update($new_instance, $old_instance){
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance[ 'enable_twitter' ] = $new_instance[ 'enable_twitter' ];
			$instance[ 'enable_facebook' ] = $new_instance[ 'enable_facebook' ];
			$instance[ 'enable_instagram' ] = $new_instance[ 'enable_instagram' ];
			$instance[ 'enable_linkedin' ] = $new_instance[ 'enable_linkedin' ];
			$instance[ 'enable_pinterest' ] = $new_instance[ 'enable_pinterest' ];
			$instance[ 'enable_dribbble' ] = $new_instance[ 'enable_dribbble' ];
			$instance[ 'enable_tumblr' ] = $new_instance[ 'enable_tumblr' ];
			$instance[ 'enable_youtube' ] = $new_instance[ 'enable_youtube' ];
            $instance[ 'enable_flickr' ] = $new_instance[ 'enable_flickr' ];
            $instance[ 'enable_twitch' ] = $new_instance[ 'enable_twitch' ];
            $instance[ 'enable_vk' ] = $new_instance[ 'enable_vk' ];
            $instance[ 'enable_telegram' ] = $new_instance[ 'enable_telegram' ];
            $instance[ 'enable_rss' ] = $new_instance[ 'enable_rss' ];
            $instance[ 'enable_tiktok' ] = $new_instance[ 'enable_tiktok' ];
            $instance[ 'enable_patreon' ] = $new_instance[ 'enable_patreon' ];
            // foreach( $instance as $key => $value  ){ 
            //     $instance[ $key ] = ( $new_instance[ $key ] );
            // }
            // $instance = array_map( 'sanitize_text_field', $new_instance );
			return $instance;
		}

		function form($instance){
			$defaults = array(
				'title' => 'Social',
				'enable_twitter' => 'on',
				'enable_facebook' => 'on',
				'enable_instagram' => 'on',
				'enable_linkedin' => 'on',
				'enable_pinterest' => 'on',
				'enable_dribbble' => 'on',
				'enable_tumblr' => 'on',
				'enable_youtube' => 'on',
                'enable_flickr' => 'on',
                'enable_twitch' => 'on',
                'enable_vk' => 'on',
                'enable_telegram' => 'on',
                'enable_rss' => 'on',
                'enable_tiktok' => 'off',
                'enable_patreon' => 'off',
			);
			$instance = wp_parse_args( (array)$instance, $defaults );
			?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">
					<?php esc_html_e('Title:', 'epcl_framework'); ?>
					<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
				</label>
			</p>
			<p><small><?php esc_html_e('Don\'t forget to fill your social profiles', 'epcl_framework'); ?> <a href="<?php echo admin_url(); ?>admin.php?page=epcl-theme-options#tab=social-profiles"><?php esc_html_e('here', 'epcl_framework'); ?>.</a></small></p>
            <p>
                <?php foreach( $defaults as $key => $value ): if($key != 'title'): ?>
                    <input class="checkbox" type="checkbox" <?php checked( $instance[ $key ], 'on' ); ?> id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" />
                    <label for="<?php echo $this->get_field_id( $key ); ?>"> <?php echo 'Enable '.ucfirst( str_replace('enable_', '', $key) ); ?></label>
                    <br>
                <?php  endif; endforeach; ?>
            </p>
			<?php
		}

	}
}

function epcl_register_social() {
	register_widget('epcl_social');
}

add_action('widgets_init', 'epcl_register_social');
