<?php

$prefix = EPCL_THEMEPREFIX.'_';
$prefix_key = 'epcl_post_categories_';

// Categories
acf_add_local_field_group( array(
	'key' => 'epcl_post_categories',
	'title' => esc_html__('General Information', 'epcl_framework'),
	'fields' => array (
        array (
			'key' => $prefix_key.'bg_color',
			'name' => 'bg_color',
			'label' => esc_html__('Button Background Color', 'epcl_framework'),
			'instructions' => esc_html__('(Optional) add a custom background color for this category.', 'epcl_framework'),
			'type' => 'color_picker',
            'default_value' => '',
        ),
        array (
			'key' => $prefix_key.'text_color',
			'name' => 'text_color',
			'label' => esc_html__('Button Text Color', 'epcl_framework'),
			'instructions' => esc_html__('(Optional) add a custom text color for this category.', 'epcl_framework'),
			'type' => 'color_picker',
            'default_value' => '',
        ),
        array (
			'key' => $prefix_key.'archives_image',
			'name' => 'archives_image',
			'label' => esc_html__('Background image for Archive\'s pages', 'epcl_framework'),
			'type' => 'image',
			'instructions' => __('Optional: you can set a background image for this particular category on Archive\'s page.', 'epcl_framework'),
			'required' => false,
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
        ),
        array (
			'key' => $prefix_key.'archives_icon',
			'name' => 'archives_icon',
			'label' => esc_html__('Custom Icon', 'epcl_framework'),
			'type' => 'image',
			'instructions' => __('Optional: you can upload your own custom icon for this particular Category.<br>Recommended size: 128x128px', 'epcl_framework'),
			'required' => false,
			'return_format' => 'array',
			'preview_size' => 'thumbnail',
			'library' => 'all',
        ),
	),
	'menu_order' => 3,
	'label_placement' => 'left',
	'instruction_placement' => 'label',
	'location' => array (
		array (
			array (
				'param' => 'taxonomy',
				'operator' => '==',
				'value' => 'category',
			),
		),
	)
));