<?php

/* Unique options for every EP theme */

$opt_name = EPCL_FRAMEWORK_VAR;

CSF::createSection( $opt_name, array(
    'title'       => 'Backup',
    'icon'        => 'fa fa-cloud-download',
    'description' => esc_html__('Remember to backup your Theme Options before update the theme.', 'epcl_framework'),
    'fields'      => array(
        array(
            'type' => 'backup',
        ),  
    )
) );

