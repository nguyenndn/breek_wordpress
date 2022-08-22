<?php
require_once(EPCL_PLUGIN_PATH.'/widgets/about.php');
require_once(EPCL_PLUGIN_PATH.'/widgets/posts-thumbs.php');
require_once(EPCL_PLUGIN_PATH.'/widgets/featured-category.php');
require_once(EPCL_PLUGIN_PATH.'/widgets/related-articles.php');
require_once(EPCL_PLUGIN_PATH.'/widgets/video.php');
require_once(EPCL_PLUGIN_PATH.'/widgets/tweets.php');
require_once(EPCL_PLUGIN_PATH.'/widgets/flickr.php');
require_once(EPCL_PLUGIN_PATH.'/widgets/ads-125.php');
require_once(EPCL_PLUGIN_PATH.'/widgets/ads-fluid.php');
require_once(EPCL_PLUGIN_PATH.'/widgets/social.php');
require_once(EPCL_PLUGIN_PATH.'/widgets/tag-cloud.php');
require_once(EPCL_PLUGIN_PATH.'/widgets/instagram.php');

function epcl_widgets_js($hook) {

    if ('widgets.php' !== $hook) {
        return;
    }
    wp_enqueue_script('my_custom_script', EPCL_PLUGIN_URL . '/widgets/js/functions.js');
}

add_action('admin_enqueue_scripts', 'epcl_widgets_js');