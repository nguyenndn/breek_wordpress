<?php

/* Unique options for every EP theme */

$opt_name = EPCL_FRAMEWORK_VAR;

/* General Settings */

CSF::createSection( $opt_name, array(
	'title' => esc_html__('Subscribe Settings', 'epcl_framework'),
	'icon' => ' fa fa-envelope',
	'fields' => array(
        array(
			'id' => 'enable_subscribe',
			'type' => 'switcher',
			'title' => esc_html__('Display subscribe button on Header', 'epcl_framework'),
			'desc' => esc_html__('You must enter a valid Mailchimp url to use this section.', 'epcl_framework'),
			'default' => false
        ),
		array(
			'id' => 'mailchimp_url',
			'type' => 'text',
			// 'validate' => 'csf_validate_url',
			'title' => esc_html__('Subscribe Url', 'epcl_framework'),
			'subtitle' => esc_html__('You can use a Mailchimp Form or any mailing system that generate a public Url. (Mailchimp is recommended, check the documentation).', 'epcl_framework'),
			'fullwidth' => true,
			'desc' => esc_html__('e.g. http://eepurl.com/dxHIUz', 'epcl_framework')
        ),
        array(
			'id' => 'title_subscribe_button',
			'type' => 'text',
			'title' => esc_html__('Title of subscribe button', 'epcl_framework'),
			'desc' => esc_html__('e.g. Subscribe', 'epcl_framework'),
        ),
	)
) );
