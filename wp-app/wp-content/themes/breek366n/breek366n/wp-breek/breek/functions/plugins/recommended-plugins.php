<?php
add_action( 'tgmpa_register', 'epcl_register_required_plugins' );
/**
 * Register required plugins
 * @return void
 * @since  1.0
 */

function epcl_register_required_plugins(){

    $theme = wp_get_theme( EPCL_THEMESLUG );
    $ver = $theme->version;
    // $ver = '1.1.0';

	$config  = array(
        'id' => EPCL_THEMESLUG,
        'domain' => EPCL_THEMESLUG,
        'menu' => 'install-required-plugins',
        'has_notices' => true,
        'is_automatic' => true,
        'dismissable'  => true,
        'strings' => array(
            'nag_type' => 'error',
        )
    );

    $plugins = array(	
		// array(
        //     'name'               => 'One Click Demo Importer',
        //     'slug'               => 'one-click-demo-import',
        //     'required'           => false,
        //     'force_activation'   => false,
        //     'force_deactivation' => false,
        // ),		
        array(
            'name'               => 'Contact Form 7',
            'slug'               => 'contact-form-7',
            'required'           => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        //array(
        //    'name'               => 'Redux Framework (Theme Options)',
        //    'slug'               => 'redux-framework',
        //    'required'           => true,
        //    'force_activation'   => false,
        //    'force_deactivation' => false,
        //),
        array(
            'name'               => 'Advanced Custom Fields Pro',
            'slug'               => 'advanced-custom-fields-pro',
            'source'             => 'http://estudiopatagon.com/wp-plugins/advanced-custom-fields-pro.zip',
            'version'            => '5.7.8',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => 'Breek Theme Functions',
            'slug'               => 'breek-functions',
            'source'             => 'http://estudiopatagon.com/wp-plugins/breek-functions.zip',
            'version'            => $ver,
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
    );

    tgmpa( $plugins, $config );
}
