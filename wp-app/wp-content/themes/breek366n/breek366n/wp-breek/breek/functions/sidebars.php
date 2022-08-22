<?php
/*
* This file can be overridden by child theme, paste it into breek-child/functions/sidebars.php
*/

if( !function_exists('register_sidebar') ) return;

add_action( 'widgets_init', 'epcl_widgets_init' );

function epcl_widgets_init() {

	/* Default Sidebar Widgets (right) */

	register_sidebar(array(
		'name' => esc_html__('Article Sidebar', 'breek'),
		'id' => 'epcl_sidebar_default',
		'description' => esc_html__('Right sidebar inside single posts.', 'breek'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '<div class="clear"></div></section>',
		'before_title' => '<h4 class="widget-title title bordered">',
		'after_title' => '</h4>',
	));

	/* Home Widgets */

	register_sidebar(array(
		'name' => esc_html__('Home Sidebar', 'breek'),
		'id' => 'epcl_sidebar_home',
		'description' => esc_html__('Sidebar for home, archives and results', 'breek'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '<div class="clear"></div></section>',
		'before_title' => '<h4 class="widget-title title bordered">',
		'after_title' => '</h4>',
    ));

	/* Footer Widgets */

	register_sidebar(array(
		'name' => esc_html__('Footer', 'breek'),
		'id' => 'epcl_sidebar_footer',
		'description' => esc_html__('Footer Sidebar', 'breek'),
		'before_widget' => '<div class="grid-33 tablet-grid-50 mobile-grid-100"><section id="%1$s" class="widget %2$s underline-effect">',
		'after_widget' => '<div class="clear"></div></section></div>',
		'before_title' => '<h4 class="widget-title title white bordered">',
		'after_title' => '</h4>',
    ));
    
    /* Footer AMP Widgets */

	register_sidebar(array(
		'name' => esc_html__('Footer AMP', 'breek'),
		'id' => 'epcl_sidebar_footer_amp',
		'description' => esc_html__('Footer AMP Sidebar', 'breek'),
		'before_widget' => '<div class="grid-33 tablet-grid-50 mobile-grid-100"><section id="%1$s" class="widget %2$s underline-effect">',
		'after_widget' => '<div class="clear"></div></section></div>',
		'before_title' => '<h4 class="widget-title title white bordered">',
		'after_title' => '</h4>',
	));

	/* Dynamic Sidebars */

	$epcl_theme = epcl_get_theme_options();
    if( !empty($epcl_theme['custom_sidebar']) ){

        if( !isset($epcl_theme['custom_sidebar'][0]) && !is_array( $epcl_theme['custom_sidebar'][0] ) ){
            array_unique($epcl_theme['custom_sidebar']);
        }

        foreach( $epcl_theme['custom_sidebar'] as $name ){

            if( is_array($name) ){
                foreach($name as $item){
                    $id = sanitize_title($item);
                    register_sidebar(array(
                        'name' => $item,
                        'id' => $id,
                        'before_widget' => '<section id="%1$s" class="custom-sidebar widget %2$s">',
                        'after_widget' => '<div class="clear"></div></section>',
                        'before_title' => '<h4 class="widget-title title bordered">',
                        'after_title' => '</h4>',
                    ));
                }
            } elseif( !empty($name) ){
                $id = sanitize_title($name);
                register_sidebar(array(
                    'name' => $name,
                    'id' => $id,
                    'before_widget' => '<section id="%1$s" class="custom-sidebar widget %2$s">',
                    'after_widget' => '<div class="clear"></div></section>',
                    'before_title' => '<h4 class="widget-title title bordered">',
                    'after_title' => '</h4>',
                ));
            }
        }
    }

}