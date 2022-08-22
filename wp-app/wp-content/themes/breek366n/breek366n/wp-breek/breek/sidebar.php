<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

$prefix = EPCL_THEMEPREFIX.'_';
$sidebar_name = 'epcl_sidebar_default';

$sidebar_class = '';
if( epcl_get_option('enable_mobile_sidebar') == false || epcl_get_option('mobile_sidebar') ){
	$sidebar_class = 'no-sidebar';
}
if( function_exists('get_field') ){
    if( get_field('sidebar') != '' ) $sidebar_name = get_field('sidebar');
}
if( is_home() || is_archive() || is_search() || is_page_template('page-templates/home.php') ){
	$sidebar_name = 'epcl_sidebar_home';
}
if( !empty($epcl_theme) && $epcl_theme['enable_sticky_sidebar'] == '1'){
    $sidebar_class .= ' sticky-enabled';
}
if( !empty($epcl_module) && isset($epcl_module['sidebar']) &&  $epcl_module['sidebar'] != ''){
    $sidebar_name = $epcl_module['sidebar'];
}
?>
<?php if( is_active_sidebar( $sidebar_name ) ): ?>
    <!-- start: #sidebar -->
    <aside id="sidebar" class="grid-30 np-mobile <?php echo esc_attr($sidebar_class); ?>">
        <div class="default-sidebar"><?php dynamic_sidebar($sidebar_name); ?></div>
        <?php if( epcl_get_option('enable_mobile_sidebar') == true && epcl_get_option('mobile_sidebar') ): ?>
            <div class="mobile-sidebar hide-on-desktop"><?php dynamic_sidebar( $epcl_theme['mobile_sidebar'] ); ?></div>
        <?php endif; ?>
    </aside>
    <!-- end: #sidebar -->
<?php endif; ?>