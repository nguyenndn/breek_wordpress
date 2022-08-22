<?php
function epcl_render_ads(){
    global $epcl_module;
    if ( epcl_is_amp() ) return;
    if( empty($epcl_module) ) return;
    if( $epcl_module['advertising_type'] == 'image'){
        $advertising_image_url = $epcl_module['advertising_image']['url'];
        $advertising_url = $epcl_module['advertising_url'];
    }else{
        $advertising_code = $epcl_module['advertising_code'];
    }
?>
    <!-- start: .epcl-banner -->
    <div class="epcl-banner textcenter section grid-container">
        <?php if( $epcl_module['advertising_type']  == 'image' && $advertising_image_url ): ?>
            <a href="<?php echo esc_url($advertising_url); ?>" target="_blank" rel="nofollow">
                <img src="<?php echo esc_attr( $advertising_image_url ); ?>" class="custom-image" alt="<?php esc_attr_e('Banner', 'breek'); ?>">
            </a>
        <?php else: ?>
            <?php echo do_shortcode( $advertising_code ); ?>
        <?php endif; ?>
    </div>
    <!-- end: .epcl-banner -->
<?php
}

function epcl_render_header_ads(){
    global $epcl_theme;
    if ( epcl_is_amp() ) return;
?>
    <!-- start: .epcl-banner -->
    <div class="epcl-banner textcenter hide-on-tablet hide-on-mobile">
        <?php if( !empty($epcl_theme['header_advertising_image']) && $epcl_theme['header_advertising_type'] == 'image' ): ?>
            <a href="<?php echo esc_url( $epcl_theme['header_advertising_url'] ) ; ?>" target="_blank" rel="nofollow">
                <img src="<?php echo esc_attr( $epcl_theme['header_advertising_image']['url'] ); ?>" class="custom-image" alt="<?php esc_attr_e('Banner', 'breek'); ?>">
            </a>
        <?php else: ?>
            <?php echo do_shortcode( $epcl_theme['header_advertising_code'] ); ?>
        <?php endif; ?>
    </div>
    <!-- end: .epcl-banner -->
    <div class="clear ad"></div>
<?php
}
function epcl_render_global_ads( $section = '' ){
    global $epcl_theme;
    if ( epcl_is_amp() ) return;
	if( !$section || empty($epcl_theme) ) return;

    if( $epcl_theme['ads_enabled_'.$section] !== '1' && !( isset($_GET['ads']) && $section == 'grid_loop' ) ) return;
    
    if( isset($epcl_theme['ads_mobile_'.$section]) && $epcl_theme['ads_mobile_'.$section] == '0' && wp_is_mobile() ) return;

	$margin_top = '0';
    $margin_bottom = '0';
    $class = '';
	if( $epcl_theme['ads_mt_'.$section] ){
	    $margin_top = $epcl_theme['ads_mt_'.$section];
    }
	if( $epcl_theme['ads_mb_'.$section] ){
		$margin_bottom = $epcl_theme['ads_mb_'.$section];
    }
    if( $section == 'below_header'){
        $class .= 'grid-container';
    }
    if( isset($epcl_theme['ads_mobile_'.$section]) && $epcl_theme['ads_mobile_'.$section] == '0'){
        $class .= ' hide-on-mobile hide-on-tablet';
    }
	?>
    <!-- start: .epcl-banner -->
    <div class="epcl-banner textcenter mobile-grid-100 epcl-banner-<?php echo esc_attr($section); ?> <?php echo esc_attr($class); ?>" style="margin-top: <?php echo esc_attr($margin_top); ?>px; margin-bottom: <?php echo esc_attr($margin_bottom); ?>px;">
		<?php if( !empty($epcl_theme['ads_image_'.$section]) && $epcl_theme['ads_type_'.$section] == 'image' ): ?>
            <a href="<?php echo esc_url( $epcl_theme['ads_url_'.$section] ) ; ?>" target="_blank" rel="nofollow">
                <img src="<?php echo esc_attr( $epcl_theme['ads_image_'.$section]['url'] ); ?>" class="custom-image" alt="<?php esc_attr_e('Banner', 'breek'); ?>">
            </a>
		<?php else: ?>
			<?php echo do_shortcode( $epcl_theme['ads_code_'.$section] ); ?>
        <?php endif; ?>
    </div>
    <!-- end: .epcl-banner -->
    <div class="clear"></div>
	<?php
}

function epcl_insert_ad_single_post( $text ) {
    global $epcl_theme;
    if( empty($epcl_theme) ) return;

    if ( is_single() ) :
        $section = 'single_paragraph';
        if( $epcl_theme['ads_enabled_'.$section] !== '1' && !( isset($_GET['ads']) && $section == 'grid_loop' ) ) return $text;
    
        if( isset($epcl_theme['ads_mobile_'.$section]) && $epcl_theme['ads_mobile_'.$section] == '0' && wp_is_mobile() ) return $text;
    
        $margin_top = '0';
        $margin_bottom = '0';
        $class = '';
        if( $epcl_theme['ads_mt_'.$section] ){
            $margin_top = $epcl_theme['ads_mt_'.$section];
        }
        if( $epcl_theme['ads_mb_'.$section] ){
            $margin_bottom = $epcl_theme['ads_mb_'.$section];
        }
        if( $section == 'below_header'){
            $class .= 'grid-container';
        }
        if( isset($epcl_theme['ads_mobile_'.$section]) && $epcl_theme['ads_mobile_'.$section] == '0'){
            $class .= ' hide-on-mobile hide-on-tablet';
        }
        if( !empty($epcl_theme['ads_image_'.$section]) && $epcl_theme['ads_type_'.$section] == 'image' ){ 
            $ads_type = '<a href="'.esc_url( $epcl_theme['ads_url_'.$section] ).'" target="_blank" rel="nofollow">
                <img src="'.esc_attr( $epcl_theme['ads_image_'.$section]['url'] ).'" class="custom-image" alt="'.esc_attr('Banner', 'reco').'">
            </a>';
        }else{
            $ads_type = do_shortcode( $epcl_theme['ads_code_'.$section] );
        }
        $ads_text = '
        <!-- start: .epcl-banner -->
        <div class="epcl-banner textcenter mobile-grid-100 epcl-banner-'.esc_attr($section).' '.esc_attr($class).'" style="margin-top: '.esc_attr($margin_top).'px; margin-bottom: '.esc_attr($margin_bottom).'px;">
            '.$ads_type.'
        </div>
        <!-- end: .epcl-banner -->
        <div class="clear"></div>';

        $split_by = "</p>";
        $insert_after = absint($epcl_theme['ads_amount_single_paragraph']); //number of paragraphs
        if( !$insert_after ) $insert_after = 10;

        // make array of paragraphs
        $paragraphs = explode( $split_by, $text);

        if ( count( $paragraphs ) > $insert_after ) {

            $new_text = '';     // new text
            $i = 1;             // current ad index
            $c = 0; // Ads counter per page            

            // loop through array and build string for output
            foreach( $paragraphs as $paragraph ) {
                // add paragraph, preceeded by an ad after every $insert_after
                if( absint($epcl_theme['ads_max_single_paragraph']) > 0 && $c >= absint($epcl_theme['ads_max_single_paragraph']) ){
                    $new_text .= $paragraph;
                }else{
                    $new_text .= ( $i % $insert_after == 0 ? $ads_text : '' ) . $paragraph;
                    if( $i % $insert_after == 0 ){
                        $c++;
                    }
                }
                
                // increase index
                $i++;
                
            }

            return $new_text;
        }

        // otherwise just add the ad to the end of the text
        return $text . $ads_text;

    endif;

    return $text;

}
add_filter('the_content', 'epcl_insert_ad_single_post');