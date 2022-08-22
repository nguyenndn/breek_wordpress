<?php

/* Scripts and Styles */

if( !function_exists('epcl_enqueue_scripts') ){

    add_action('wp', 'epcl_disable_cf7_home');

    function epcl_disable_cf7_home() {
        $epcl_theme = epcl_get_theme_options();
        if( empty($epcl_theme) ) return;
        if( epcl_get_option('enable_optimization') || defined('W3TC') ){
            if( is_front_page() || is_home() ){
                add_filter( 'wpcf7_load_css', '__return_false' );
                add_filter( 'wpcf7_load_js', '__return_false' );
            }
        }        
    }

    add_action('wp_enqueue_scripts', 'epcl_enqueue_scripts');

	function epcl_enqueue_scripts() {

		$epcl_theme = epcl_get_theme_options();

		$assets_folder = EPCL_THEMEPATH.'/assets';
        $prefix = EPCL_THEMEPREFIX.'-';

        $theme = wp_get_theme( EPCL_THEMESLUG );
        $ver = $theme->version;
        // $ver = '1.0.8';    

        /* Styles */

        wp_register_style($prefix.'google-fonts', epcl_google_fonts_url(), NULL, NULL);

        // AMP styles
        if( epcl_is_amp() ){   
            if( epcl_get_option('amp_enable_google_fonts') !== '0' ){
                wp_enqueue_style($prefix.'google-fonts');     
            }
            wp_enqueue_style($prefix.'theme', $assets_folder.'/dist/style.min.css', NULL, $ver);
            wp_enqueue_style($prefix.'amp', $assets_folder.'/dist/amp.min.css', NULL, $ver);
            wp_enqueue_style($prefix.'plugins', $assets_folder.'/dist/plugins.min.css', NULL, $ver);
            wp_enqueue_style($prefix.'fontawesome', $assets_folder.'/dist/fontawesome.min.css', NULL, $ver);
            wp_enqueue_style($prefix.'remixicons', $assets_folder.'/dist/remixicons.min.css', NULL, $ver);   
            return;
        }

        // If theme options is installed and enabled optimization is on, the theme will load combined and minified CSS and JS
        if( epcl_get_option('enable_optimization') == '1' ){
            // wp_enqueue_style($prefix.'theme', $assets_folder.'/dist/style.min.css', NULL, $ver);
            wp_enqueue_style($prefix.'plugins', $assets_folder.'/dist/plugins.min.css', NULL, $ver);
            wp_enqueue_script($prefix.'scripts', $assets_folder.'/dist/scripts.min.js', array('jquery'), $ver, true);
            wp_localize_script($prefix.'scripts', 'ajax_var', array(
                'url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('epcl_download'),
                'assets_folder' => $assets_folder
            ));
        }else{
            // Not combined libraries
            wp_enqueue_script('lazy-load', $assets_folder.'/js/jquery.lazyload.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('masonry', $assets_folder.'/js/masonry.pkgd.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('aos', $assets_folder.'/js/aos.js', array('jquery'), $ver, true);
            wp_enqueue_script('slick', $assets_folder.'/js/slick.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('nice-select', $assets_folder.'/js/jquery.nice-select.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('jflickrfeed', $assets_folder.'/js/jflickrfeed.min.js', array('jquery'), $ver, true);            
            wp_enqueue_script('magnific-popup', $assets_folder.'/js/jquery.magnific-popup.min.js', array('jquery'), $ver, true);            
            wp_enqueue_script('sticky-sidebar', $assets_folder.'/js/jquery.sticky-sidebar.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('theia-sidebar', $assets_folder.'/js/theia-sidebar.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('sticky', $assets_folder.'/js/jquery.sticky.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('tooltipster', $assets_folder.'/js/jquery.tooltipster.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('pace', $assets_folder.'/js/pace.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('preload-css', $assets_folder.'/js/preload-css.min.js', array('jquery'), $ver, true);
            wp_enqueue_script('prism', $assets_folder.'/js/prism.min.js', array('jquery'), $ver, true);
            wp_enqueue_script($prefix.'functions', $assets_folder.'/js/functions.js', array('jquery'), $ver, true);
            wp_enqueue_script($prefix.'shortcodes', $assets_folder.'/js/shortcodes.js', array('jquery'), $ver, true);
            wp_enqueue_style($prefix.'theme', $assets_folder.'/dist/style.min.css', NULL, $ver); // There is a style.un-minified.css file if needed
            wp_enqueue_style('plugins', $assets_folder.'/dist/plugins.min.css', NULL, $ver); // There is a plugins.un-minified.css file if needed
            // wp_enqueue_style($prefix.'fontawesome', $assets_folder.'/dist/fontawesome.min.css', NULL, $ver);
            // wp_enqueue_style($prefix.'font-icons', $assets_folder.'/dist/remixicons.min.css', NULL, $ver);
            wp_localize_script($prefix.'functions', 'ajax_var', array(
                'url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('epcl_download')
            ));
        }

        if( epcl_get_option('fonts_icons_method', 'footer') == 'standard' ){
            wp_enqueue_style($prefix.'fontawesome', $assets_folder.'/dist/fontawesome.min.css', NULL, $ver);
            wp_enqueue_style($prefix.'remixicons', $assets_folder.'/dist/remixicons.min.css', NULL, $ver);
        }

        if( empty($epcl_theme) || epcl_get_option('enable_google_fonts') !== '0' ){
            wp_enqueue_style($prefix.'google-fonts');
        }

        

        if( !defined('W3TC') ){
            $custom_css = epcl_generate_custom_styles();
            if( epcl_get_option('enable_optimization') == '1'){
                // wp_add_inline_style( $prefix.'plugins', $custom_css );
            }else{
                wp_add_inline_style( 'plugins', $custom_css );
            }
        }     

        /* Scripts */
        
        // W3 Total Cache optimization

        if( !empty($epcl_theme) && $epcl_theme['move_jquery_footer'] ){ // Only enabled by panel
            wp_scripts()->add_data( 'jquery', 'group', 1 );
            wp_scripts()->add_data( 'jquery-core', 'group', 1 );
            wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
        }		

		if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
			wp_enqueue_script( 'comment-reply', 'wp-includes/js/comment-reply', array(), false, true );
        }

        // Disqus inline JS

        if( !empty($epcl_theme) && $epcl_theme['hosted_comments'] == 2 && $epcl_theme['disqus_id'] ){
            $custom_js = epcl_add_disqus_scripts();
            if( epcl_get_option('enable_optimization') == '1'){
                wp_add_inline_script($prefix.'scripts', $custom_js);
            }else{
                wp_add_inline_script($prefix.'functions', $custom_js);
            }
        }

        // Facebook Comments
        if( !empty($epcl_theme) && $epcl_theme['hosted_comments'] == 3 ){
            $fb_lang_code = 'en_US';
            $app_id = '';
            if( epcl_get_option('facebook_lang_code') !== '' ){
                $fb_lang_code = epcl_get_option('facebook_lang_code');
            }
         
            if( epcl_get_option('facebook_app_id') !== '' ){
                $app_id = '&appId='.epcl_get_option('facebook_app_id');
            }
            wp_enqueue_script( $prefix.'facebook-comments', 'https://connect.facebook.net/'.esc_attr($fb_lang_code).'/sdk.js#xfbml=1&version=v3.3'.$app_id, array(), false, true ); 
        }

    }

    function epcl_amp_scripts() {
        if( epcl_is_amp() ){
            global $wp_scripts;
            $wp_scripts->queue = array();
        }
    }
    add_action('wp_print_scripts', 'epcl_amp_scripts', 100);

    function epcl_footer_styles() {
        $prefix = EPCL_THEMEPREFIX;
        if( epcl_is_amp() ){
            if( empty($epcl_theme) || epcl_get_option('enable_google_fonts') !== '0' ){
                // wp_register_style($prefix.'google-fonts', epcl_google_fonts_url(), NULL, NULL);
                // wp_enqueue_style($prefix.'google-fonts');
            }    
        }
        
        
    };
    add_action( 'wp_footer', 'epcl_footer_styles' );

    function epcl_add_disqus_scripts(){
        $epcl_theme = epcl_get_theme_options();

        $js = 
        '
        var disqus_shortname = "'.esc_attr( $epcl_theme['disqus_id']).'";
        
        !function(){var e=document.createElement("script");e.async=!0,e.type="text/javascript",e.src="//"+disqus_shortname+".disqus.com/count.js",document.getElementsByTagName("BODY")[0].appendChild(e)}();
        ';
        if( is_single() || ( is_page() && !is_page_template() ) ){
            if( !comments_open() ){
                return;
            }
            $js .= '
            var disqus_config = function () {
                this.page.url = "'.get_the_permalink().'"; 
                this.page.identifier = "'.get_the_ID().'";
            };
            (function() { 
                var d = document, s = d.createElement("script");
                s.src = "//" + disqus_shortname + ".disqus.com/embed.js";
                s.setAttribute("data-timestamp", +new Date());
                (d.head || d.body).appendChild(s);
            })();';
        }
        return $js;
            
    }

    function epcl_google_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* Translators: If there are characters in your language that are not supported by Poppins, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'breek' ) ) {
            $fonts[] = 'Poppins:400,400i,500,600,600i,700,700i';
        }

        /* Translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'breek' ) ) {
            $fonts[] = 'Montserrat:400,500,600,700';
        }
        
        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
                'display' => 'swap',
            ), 'https://fonts.googleapis.com/css' );
        }
        return $fonts_url;
    }
    
}