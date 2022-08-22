<?php

global $epcl_theme;

// Only enabled when redux options is active, W3 total cache is installed and enable optimization is "on"

add_action ( 'wp_head', 'epcl_generate_header_styles' );
function epcl_generate_header_styles(){
    
    if( epcl_is_amp() ) return;

    global $epcl_theme;
    if( empty($epcl_theme) ) return;
    if( $epcl_theme['enable_optimization'] || defined('W3TC') ):
?>
        <style id="epcl-theme-critical-css"><?php get_template_part('assets/dist/critical-css'); ?></style>
<?php
    endif;
    if( $epcl_theme['enable_optimization'] || defined('W3TC') ){
        $custom_css = epcl_generate_custom_styles();
        echo '<style id="epcl-theme-header-css">'.$custom_css.'</style>';
    }
}

function epcl_style_loader_tag($tag){

    global $epcl_theme;

    if( empty($epcl_theme) || is_admin() ||  ( !$epcl_theme['enable_optimization'] && !defined('W3TC') ) ) return $tag;

    if( epcl_is_amp() ) return $tag;

    if( $epcl_theme['enable_optimization'] || defined('W3TC') ){

        switch( epcl_get_option('secondary_css_method', 'preload') ){
            // case 'prefetch': default:
            //     $onload = 'onload="this.onload=null;this.rel=`stylesheet`"';
            //     $rel = 'rel="prefetch" as="style"';
            // break;
            case 'preload': default:
                $onload = 'onload="this.onload=null;this.rel=`stylesheet`"';
                $rel = 'rel="preload" as="style"';
            break;
            case 'standard':
                return $tag;
            break;
        }

        // // $onload = "this.rel=`stylesheet`";
        // // $onload = 'onload="this.rel=\'stylesheet\'"';
        // $onload = 'onload="this.onload=null;this.rel=`stylesheet`"';
        // $rel = 'rel="prefetch" as="style"';
        // $onload = 'onload="this.media=`all`;this.onload=null;"';
        // $rel = 'rel="stylesheet" media="print"';

        $tag = preg_replace("/rel='stylesheet' id='epcl-google-fonts-css'/", "$rel id='epcl-google-fonts-css' $onload ", $tag);

        $tag = preg_replace("/rel='stylesheet' id='epcl-theme-css'/", "$rel id='epcl-theme-css' $onload ", $tag);

        $tag = preg_replace("/rel='stylesheet' id='epcl-plugins-css'/", "$rel id='epcl-plugins-css' $onload ", $tag);

        $tag = preg_replace("/rel='stylesheet' id='wp-block-library-css'/", "$rel id='wp-block-library-css' $onload ", $tag);

        $tag = preg_replace("/rel='stylesheet' id='epcl-theme-options-google-fonts-css'/", "$rel id='epcl-theme-options-google-fonts-css' $onload ", $tag);

        return $tag;
    }
}

function wps_deregister_styles() {
    global $epcl_theme;
    if( !empty($epcl_theme) && isset($epcl_theme['remove_gutenberg_styles']) && $epcl_theme['remove_gutenberg_styles'] === '1' ){
        wp_dequeue_style( 'wp-block-library' );
    }

}
add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );

// Only enabled when redux options is active

add_action ( 'wp_head', 'epcl_generate_header_codes', 1 );
function epcl_generate_header_codes(){
    global $epcl_theme;
    if( empty($epcl_theme) || epcl_is_amp() ) return;

    // echo '<link rel="preload" href="'.EPCL_THEMEPATH.'/assets/dist/style.min.css" as="style" type="text/css">';
    // echo '<link rel="preload" href="'.EPCL_THEMEPATH.'/assets/fonts/fontawesome-webfont.woff2?v=4.7.0" as="font" type="font/woff2" crossorigin="anonymous">';
    // echo '<link rel="preload" href="'.EPCL_THEMEPATH.'/assets/fonts/remixicon.woff2?v=4.7.0" as="font" type="font/woff2" crossorigin="anonymous">';
    // echo '<link rel="preload" href="'.EPCL_THEMEPATH.'/assets/dist/plugins.min.css" as="style" type="text/css">';

    if( isset( $epcl_theme['custom_scripts'] ) && $epcl_theme['custom_scripts'] ){
        echo $epcl_theme['custom_scripts'];
    }
}

add_action ( 'wp_footer', 'epcl_generate_footer_codes', 100 );
function epcl_generate_footer_codes(){
    global $epcl_theme;
    if( empty($epcl_theme) || epcl_is_amp() ) return;

    if( isset( $epcl_theme['custom_scripts_footer'] ) && $epcl_theme['custom_scripts_footer'] ){
        echo $epcl_theme['custom_scripts_footer'];
    }
}

function epcl_remove_async_scripts($buffer){
    $custom_ajax_scripts = epcl_get_option('custom_ajax_scripts', false);
    if( !empty($custom_ajax_scripts) ){
        foreach( $custom_ajax_scripts as $item ){
            if( $item['script_src'] !== '' ){
                $buffer = str_replace( $item['script_src'] , '', $buffer);
            }
        }
        
    }
    return $buffer;
}
function epcl_buffer_start(){ ob_start("epcl_remove_async_scripts"); }
function epcl_buffer_end(){ ob_end_flush(); }

function epcl_check_remove_async(){

    if( epcl_get_option('remove_custom_ajax_scripts', false) && !empty(epcl_get_option('custom_ajax_scripts', false) ) && !isset($_GET['amp']) ){
        add_action('get_header', 'epcl_buffer_start');
        add_action('wp_footer', 'epcl_buffer_end');
    }

}

add_action ('init','epcl_check_remove_async');

