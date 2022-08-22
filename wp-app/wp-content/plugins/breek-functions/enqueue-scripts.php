<?php

add_action('wp_enqueue_scripts', 'epcl_enqueue_scripts_plugin', 11);

function epcl_enqueue_scripts_plugin() {
    $epcl_theme = epcl_get_theme_options();

    $prefix = EPCL_THEMEPREFIX.'-';

    /* CSS */

    $fonts = array(
        $epcl_theme['primary_titles_font'], $epcl_theme['body_font'],
        $epcl_theme['sidebar_titles_font'], $epcl_theme['sidebar_font'],
        $epcl_theme['footer_titles_font'], $epcl_theme['footer_font'],
    );

    wp_register_style( $prefix . 'theme-options-google-fonts' , epcl_theme_options_google_fonts( $fonts ), NULL, NULL );
    wp_enqueue_style( $prefix . 'theme-options-google-fonts' );

}

function epcl_theme_options_google_fonts( $google_fonts ) {
    $link = $fonts_url = "";
    $subsets = array();
    $fonts = array();

    foreach ( $google_fonts as $font ) {        
        $link = '';
        if(  isset($font['type']) && $font['type'] == 'google' ){
            
            $link .= $font['font-family'];
            if( !empty($font['font-family']) && !empty($font['font-weight']) ){
                $link .= ':'.$font['font-weight'] ;
            }

            if( $link ){
                $fonts[] = $link;   
            }            
    
            if ( ! empty( $font['subsets'] ) ) {
                if ( ! in_array( $font['subsets'], $subsets ) ) {
                    array_push( $subsets, $font['subsets'] );
                }
            }
        }           
        
    }

    if ( !empty($fonts) ) {
        $fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $fonts ) ),
            'subset' => urlencode( implode( ',', $subsets ) ),
            'display' => 'swap',
        ), '//fonts.googleapis.com/css' );
    }

    return $fonts_url;
}

if( function_exists('autoptimize') ){
    add_filter('autoptimize_filter_css_exclude','epcl_autoptimize_css_exclude');
    function epcl_autoptimize_css_exclude($in) {
        return $in.',fontawesome.min.css,remixicons.min.css';
    } 
}

function epcl_styles_footer() {
    $epcl_theme = epcl_get_theme_options();

    $assets_folder = EPCL_THEMEPATH.'/assets';
    $prefix = EPCL_THEMEPREFIX.'-';

    $theme = wp_get_theme( EPCL_THEMESLUG );
    $ver = $theme->version;

    if( epcl_get_option('fonts_icons_method', 'footer') == 'footer' ){
        wp_enqueue_style($prefix.'fontawesome', $assets_folder.'/dist/fontawesome.min.css', NULL, $ver);
        wp_enqueue_style($prefix.'remixicons', $assets_folder.'/dist/remixicons.min.css', NULL, $ver);
    }

    if( epcl_get_option('fonts_icons_method', 'footer') == 'javascript' ){
        $custom_js = epcl_font_icons_scripts();
        if( epcl_get_option('enable_optimization') == '1'){
            wp_add_inline_script($prefix.'scripts', $custom_js);
        }else{
            wp_add_inline_script($prefix.'functions', $custom_js);
        }
    }

}

add_action( 'get_footer', 'epcl_styles_footer' );

function epcl_font_icons_scripts(){
    $delay = absint( epcl_get_option('font_icons_delay', '500') );
    $assets_folder = EPCL_THEMEPATH.'/assets';
    $js = "
    setTimeout(function(){
        epcl_load_css_file('$assets_folder/dist/remixicons.min.css');
        epcl_load_css_file('$assets_folder/dist/fontawesome.min.css');
    }, $delay);
    function epcl_load_css_file(filename){
        var head = document.getElementsByTagName('head')[0];
        var style = document.createElement('link');
        style.href = filename;
        style.type = 'text/css';
        style.rel = 'stylesheet';
        head.appendChild(style);
    }
    ";
    return $js;
}