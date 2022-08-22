<?php

/* Unique options for every EP theme */

$admin_url = EPCL_PLUGIN_URL.'/functions/admin';

$opt_name = EPCL_FRAMEWORK_VAR;

/* Typography */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Typography', 'epcl_framework'),
	'icon' => 'fa fa-font',
	'fields' => array(
        array(
			'id' => 'enable_google_fonts',
			'type' => 'switcher',
            'title' => esc_html__('Load default Google Fonts', 'epcl_framework'),
            'subtitle' => esc_html__('Montserrat and Poppins.', 'epcl_framework'),
			'desc' => esc_html__('Enable/disable theme default Google Fonts, you can disable them if you are using a system font or you are adding heavy optimizations. Use with caution.', 'epcl_framework'),
            'default' => 1,
        ),
		array(
			'id' => 'general_fonts',
			'type' => 'subheading',
			'title' => __('Generals Fonts', 'epcl_framework'),
			'subtitle' => __('Global font families for all sections, including pages, posts, sidebar and footer.', 'epcl_framework'),
			'indent' => true
		),
		array(
			'id' => 'body_font',
			'type' => 'typography',
			'title' => esc_html__('Regular Text Font', 'epcl_framework'),
			'subtitle' => esc_html__('Default: Poppins, 15px normal', 'epcl_framework'),
			'google' => true,
			'subset' => true,
			'font_size' => true,
			'line_height' => false,
            'text_align' => false,
            'text_transform' => false,
            'letter_spacing' => false,
			'color' => false,
			'default' => array(
				'font-size' => '15px',
				'font-family' => '',
				'font-weight' => '400'
			)
		),
		array(
			'id' => 'primary_titles_font',
			'type' => 'typography',
			'title' => esc_html__('Primary Titles Font Family', 'epcl_framework'),
			'subtitle' => esc_html__('Default: Montserrat, semibold (600)', 'epcl_framework'),
			'desc' => esc_html__('e.g. Article titles, box titles, page titles, etc.', 'epcl_framework'),
			'google' => true,
			'subset' => true,
            'font_size' => false,
			'line_height' => false,
            'text_align' => false,
            'text_transform' => false,
            'letter_spacing' => false,
			'color' => false,
			'default' => array(
				'font-family' => '',
				'font-weight' => '',
			)
		),
		array(
			'id' => 'sidebar_fonts',
			'type' => 'subheading',
			'title' => __('Sidebar Fonts', 'epcl_framework'),
			'subtitle' => __('Font families only for Sidebar, leave blank if you want the same fonts as general section.', 'epcl_framework'),
		),
		array(
			'id' => 'sidebar_titles_font',
			'type' => 'typography',
			'title' => esc_html__('Sidebar Titles Font Family', 'epcl_framework'),
			'subtitle' => esc_html__('Default: Montserrat, bold', 'epcl_framework'),
			'google' => true,
			'subset' => true,
			'font_size' => false,
			'line_height' => false,
            'text_align' => false,
            'text_transform' => false,
            'letter_spacing' => false,
			'color' => false,
			'default' => array(
				'font-family' => '',
				'font-weight' => '',
			)
		),
		array(
			'id' => 'sidebar_font',
			'type' => 'typography',
			'title' => esc_html__('Sidebar regular Font Family', 'epcl_framework'),
			'subtitle' => esc_html__('Default: Poppins, 15px normal', 'epcl_framework'),
			'google' => true,
			'subset' => true,
			'font_size' => false,
			'line_height' => false,
            'text_align' => false,
            'text_transform' => false,
            'letter_spacing' => false,
			'color' => false,
			'default' => array(
				'font-family' => '',
				'font-weight' => '',
			)
		),
		array(
			'id' => 'footer_fonts',
			'type' => 'subheading',
			'title' => __('Footer Fonts', 'epcl_framework'),
			'subtitle' => __('Font families only for Footer, leave blank if you want the same fonts as general section.', 'epcl_framework'),
		),
		array(
			'id' => 'footer_titles_font',
			'type' => 'typography',
			'title' => esc_html__('Footer Titles Font Family', 'epcl_framework'),
			'subtitle' => esc_html__('Default: Montserrat, bold', 'epcl_framework'),
			'google' => true,
			'subset' => true,
			'font_size' => false,
			'line_height' => false,
            'text_align' => false,
            'text_transform' => false,
            'letter_spacing' => false,
			'color' => false,
			'default' => array(
				'font-family' => '',
				'font-weight' => '',
			)
		),
		array(
			'id' => 'footer_font',
			'type' => 'typography',
			'title' => esc_html__('Footer regular Font Family', 'epcl_framework'),
			'subtitle' => esc_html__('Default: Poppins, 15px normal', 'epcl_framework'),
			'google' => true,
			'subset' => true,
			'font_size' => false,
			'line_height' => false,
            'text_align' => false,
            'text_transform' => false,
            'letter_spacing' => false,
			'color' => false,
			'default' => array(
				'font-family' => '',
				'font-weight' => '',
			)
		),
		array(
			'id' => 'info_fonts',
			'type' => 'content',
			'notice' => true,
			'style' => 'info',
			'icon' => 'el-icon-info-sign',
			'title' => esc_html__('Important!', 'epcl_framework'),
			'content' => esc_html__('If you are using Montserrat and Poppins fonts, just leave blank the font family select box. We are loading a better rendering version for these fonts.', 'epcl_framework')
		),
		array(
			'id' => 'title_font_size',
			'type' => 'heading', 'notice' => false,
			'title' => __( 'Post Content Sizes (single)', 'epcl_framework')
        ),
        array(
			'id' => 'editor_font_size',
			'type' => 'slider',
			'title' => esc_html__('Editor Font Size', 'epcl_framework'),
			'subtitle' => esc_html__('Paragraphs and general content.', 'epcl_framework'),
			'desc' => esc_html__('Default: 17 pixels.', 'epcl_framework'),
			'default' => '17',
			'min' => '10',
			'step' => '1',
            'max' => '24',
            'unit' => 'px',
		),
		array(
			'id' => 'h1_font_size',
			'type' => 'slider',
			'title' => esc_html__('H1 Font Size', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 34 pixels.', 'epcl_framework'),
			'default' => '34',
			'min' => '10',
			'step' => '1',
            'max' => '50',
            'unit' => 'px'
		),
		array(
			'id' => 'h2_font_size',
			'type' => 'slider',
			'title' => esc_html__('H2 Font Size', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 28 pixels.', 'epcl_framework'),
			'default' => '28',
			'min' => '10',
			'step' => '1',
            'max' => '50',
            'unit' => 'px'
		),
		array(
			'id' => 'h3_font_size',
			'type' => 'slider',
			'title' => esc_html__('H3 Font Size', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 24 pixels.', 'epcl_framework'),
			'default' => '24',
			'min' => '10',
			'step' => '1',
            'max' => '50',
            'unit' => 'px'
		),
		array(
			'id' => 'h4_font_size',
			'type' => 'slider',
			'title' => esc_html__('H4 Font Size', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 18 pixels.', 'epcl_framework'),
			'default' => '18',
			'min' => '10',
			'step' => '1',
            'max' => '50',
            'unit' => 'px'
		),
		array(
			'id' => 'h5_font_size',
			'type' => 'slider',
			'title' => esc_html__('H5 Font Size', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 16 pixels.', 'epcl_framework'),
			'default' => '16',
			'min' => '10',
			'step' => '1',
            'max' => '50',
            'unit' => 'px'
		),
		array(
			'id' => 'h6_font_size',
			'type' => 'slider',
			'title' => esc_html__('H6 Font Size', 'epcl_framework'),
			'subtitle' => '',
			'desc' => esc_html__('Default: 14 pixels.', 'epcl_framework'),
			'default' => '14',
			'min' => '10',
			'step' => '1',
            'max' => '50',
            'unit' => 'px'
        ),
        array(
			'id' => 'mobile_fonts',
			'type' => 'subheading',
			'title' => __('Mobile Font Size', 'epcl_framework'),
			'subtitle' => __('Font Size for content on Mobile Devices (below 768px)', 'epcl_framework'),
			'indent' => true
        ),
        array(
			'id' => 'mobile_body_font_size',
			'type' => 'slider',
			'title' => esc_html__('Body Mobile Font Size', 'epcl_framework'),
			'subtitle' => esc_html__('Paragraphs and general content (on Articles list, archives, etc).', 'epcl_framework'),
			'desc' => esc_html__('Default: 13 pixels.', 'epcl_framework'),
			'default' => '13',
			'min' => '10',
			'step' => '1',
            'max' => '24',
            'unit' => 'px',
        ),
        array(
			'id' => 'mobile_single_font_size',
			'type' => 'slider',
			'title' => esc_html__('Single Post Mobile Font Size', 'epcl_framework'),
			'subtitle' => esc_html__('Paragraphs and lists inside Single Post Page.', 'epcl_framework'),
			'desc' => esc_html__('Default: 14 pixels.', 'epcl_framework'),
			'default' => '14',
			'min' => '10',
			'step' => '1',
            'max' => '24',
            'unit' => 'px',
		),
	)
) );
