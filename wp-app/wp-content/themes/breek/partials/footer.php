<?php
$epcl_theme = epcl_get_theme_options();
if(function_exists('icl_get_home_url')) $home = icl_get_home_url();
else $home = home_url('/');

$footer_class = '';
if( epcl_get_option('enable_mobile_footer_sidebar') == false ){
    $footer_class = 'no-sidebar';
}
if( epcl_get_option('enable_mobile_footer_sidebar') == true && epcl_get_option('mobile_footer_sidebar') ){
    $footer_class = 'hide-default';
}
?>
<!-- start: #footer -->
<footer id="footer" class="grid-container <?php echo esc_attr($footer_class); ?>">

    <?php if( is_active_sidebar('epcl_sidebar_footer')  || is_active_sidebar( epcl_get_option('mobile_footer_sidebar') ) ): ?>
        <div class="widgets row gradient-effect">
            <div class="default-sidebar border-effect"><?php dynamic_sidebar('epcl_sidebar_footer'); ?></div>
            <div class="clear"></div>
            <?php if( epcl_get_option('enable_mobile_footer_sidebar') == true && epcl_get_option('mobile_footer_sidebar') ): ?>
                <div class="mobile-sidebar hide-on-desktop"><?php dynamic_sidebar( epcl_get_option('mobile_footer_sidebar') ); ?></div>
            <?php endif; ?>
            <div class="clear"></div>
        </div>
    <?php endif; ?>

    <?php if( !isset($epcl_theme['enable_footer_logo']) || $epcl_theme['enable_footer_logo'] == '1' ): ?>
        <?php
        if( isset($epcl_theme['enable_footer_custom_logo']) && $epcl_theme['enable_footer_custom_logo'] === '1' ){
            $epcl_theme['logo_type'] = $epcl_theme['footer_logo_type'];
            if( $epcl_theme['footer_logo_type'] === '1' ){
                $epcl_theme['logo_image'] = $epcl_theme['footer_logo_image'];
                $epcl_theme['logo_width'] = $epcl_theme['footer_logo_width'];
            }else{
                $epcl_theme['logo_icon'] = $epcl_theme['footer_logo_icon'];
            }
        }
        ?>
        <?php if($epcl_theme['logo_type'] == 1 && $epcl_theme['logo_image']['url'] ): ?>
            <h2 class="logo"><a href="<?php echo esc_url($home); ?>"><img src="<?php echo esc_url( $epcl_theme['logo_image']['url'] ); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo esc_attr( $epcl_theme['logo_width'] ); ?>" /></a></h2>
        <?php else: ?>
            <h2 class="logo">
                <a href="<?php echo esc_url($home); ?>" class="title white medium">
                    <?php if(  isset( $epcl_theme['logo_icon'] ) && $epcl_theme['logo_icon'] != '' ): ?>
                        <i class="fa <?php echo esc_attr( $epcl_theme['logo_icon'] ); ?>"></i>
                    <?php endif; ?>
                    <?php bloginfo('name'); ?>
                </a>
            </h2>
        <?php endif; ?>
    <?php else: ?>
        <br>
    <?php endif; ?>

	<?php if( epcl_get_option('copyright_text') ): ?>
		<div class="published border-effect">
            <?php echo wpautop( do_shortcode( epcl_get_option('copyright_text') ) ); ?>
		</div>
	<?php endif; ?>
    <?php if( empty($epcl_theme) || !isset($epcl_theme['enable_back_to_top']) || $epcl_theme['enable_back_to_top'] == '1' ): ?>
        <a id="back-to-top" class="epcl-button dark"><i class="remixicon remixicon-arrow-up-line"></i></a>
    <?php endif; ?>

</footer>
<!-- end: #footer -->