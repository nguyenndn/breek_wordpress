<?php

$prefix = EPCL_THEMEPREFIX.'_';
$prefix_key = 'epcl_user_';

$fa_icons = epcl_get_font_icons();
$array_icons = array();
foreach( $fa_icons as $fa ){
	$array_icons[$fa] = '<i class="'.$fa.'" style="font-size: 120%;"></i>&nbsp;&nbsp;'.str_replace('fa ', '', $fa);
}

// Custom user fields
acf_add_local_field_group( array(
	'key' => 'epcl_user',
	'title' => esc_html__('Aditional Information', 'epcl_framework'),
	'fields' => array (
		array (
			'key' => $prefix_key.'facebook',
			'name' => 'facebook',
			'label' => esc_html__('Facebook URL', 'epcl_framework'),
			'instructions' => esc_html__('e.g. http://www.facebook.com/estudiopatagon', 'epcl_framework'),
			'type' => 'url',
		),
		array (
			'key' => $prefix_key.'twitter',
			'name' => 'twitter',
			'label' => esc_html__('Twitter URL', 'epcl_framework'),
			'instructions' => esc_html__('e.g: https://twitter.com/wordpress', 'epcl_framework'),
			'type' => 'url',
        ),
        array(
            'key' => $prefix_key.'custom_social',
            'label' => esc_html__('Custom Social Profiles', 'epcl_framework'),
            'name' => 'custom_social',
            'type' => 'repeater',
            'instructions' => '',
            'layout' => 'row',
            'button_label' => esc_html__('Add Custom Profile', 'epcl_framework'),
            'sub_fields' => array(
                array(
                    'key' => $prefix_key.'custom_social_icon',
                    'label' => esc_html__('Icon', 'epcl_framework'),
                    'name' => 'custom_social_icon',
                    'type' => 'select',
                    'choices' => $array_icons,
                    'allow_null' => true,
                    'multiple' => false,
                    'ui' => 1,
                    'ajax' => 0,
                    'return_format' => 'value',
                    'required' => true,
                    'instructions' => esc_html__('e.g. fa-instagram', 'epcl_framework'),
                ),
                array (
                    'key' => $prefix_key.'custom_social_url',
                    'name' => 'custom_social_url',
                    'label' => esc_html__('URL', 'epcl_framework'),
                    'type' => 'url',
                    'instructions' => esc_html__('https://instagram.com/myusername', 'epcl_framework'),
                    'required' => true
                ),
                array (
                    'key' => $prefix_key.'custom_social_title',
                    'name' => 'custom_social_title',
                    'label' => esc_html__('Title', 'epcl_framework'),
                    'type' => 'text',
                    'instructions' => esc_html__('e.g. Follow me on Instagram', 'epcl_framework'),
                    'required' => false
                ),
            ),
        ),
        array (
            'key' => $prefix_key.'avatar',
            'name' => 'avatar',
            'label' => esc_html__('Optimized Avatar', 'epcl_framework'),
            'type' => 'image',
            'instructions' => esc_html__('Recommended size: 150x150. This step is totally optional, it\'s just boost a little the web speed rendering the image directly from your hosting, instead of gravatar.', 'epcl_framework'),
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
        ),
	),
	'label_placement' => 'left',
	'instruction_placement' => 'field',
	'location' => array (
		array (
			array (
				'param' => 'user_form',
				'operator' => '==',
				'value' => 'edit',
			),
		),
	)
));