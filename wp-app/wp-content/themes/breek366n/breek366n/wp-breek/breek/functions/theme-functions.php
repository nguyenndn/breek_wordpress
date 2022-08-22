<?php
/*
* Functions just for this particular theme
* This file can be overridden by child theme, paste it into breek-child/functions/theme-functions.php
*/

function epcl_is_amp() {
    $amp_enabled = epcl_get_option('amp_enabled', false);
    // return false;
    return function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() && $amp_enabled && !is_admin();
}

// Fix CSF framework on Customizer
if( !function_exists('epcl_customizer_preview') ) {
    function epcl_customizer_preview() {
        global $epcl_theme;
        $epcl_theme = get_option( EPCL_FRAMEWORK_VAR );
    }
    add_action('customize_preview_init', 'epcl_customizer_preview');
}

// Replace global $epcl_theme with function (security)
if( !function_exists('epcl_get_theme_options') ){
    function epcl_get_theme_options() {
        global $epcl_theme;
        if( empty($epcl_theme) ){
            $epcl_theme = get_option( EPCL_FRAMEWORK_VAR );
        }
        if( !empty($epcl_theme) ){
            return $epcl_theme;
        }else{
            return false;
        }     
    }
}

// Replace global $epcl_module with function (security)
if( !function_exists('epcl_get_module_options') ){
    function epcl_get_module_options() {
        global $epcl_module;
        if( !empty($epcl_module) ){
            return $epcl_module;
        }else{
            return false;
        }     
    }
}

if( !function_exists('epcl_get_option') ){
    function epcl_get_option( $option = '', $default = '' ) {
        global $epcl_theme;
        if( empty($epcl_theme) ){
            $epcl_theme = get_option( EPCL_FRAMEWORK_VAR );
        }
        if( !empty($epcl_theme) && isset( $epcl_theme[ $option ] ) ){
            return $epcl_theme[ $option ];
        }else{
            if( $default !== '' ){
                return $default;
            }
            return false;
        }
    }
}

// Gutenberg fonts on admin
function epcl_gutenberg_fonts_url() {
    $epcl_theme = epcl_get_theme_options();
    $fonts_url = '';
    $font_families[] = 'Poppins:400,400i,500,600,600i,700,700i';
    $font_families[] = 'Montserrat:400,500,600,700';

    // Customs fonts from Theme options
    if( !empty($epcl_theme) && ( !empty($epcl_theme['body_font']['font-family']) || !empty($epcl_theme['primary_titles_font']['font-family']) ) ){
        if( $epcl_theme['body_font']['font-family'] != '' && $epcl_theme['body_font']['font-weight'] != '' ){
            $font_families[] = $epcl_theme['body_font']['font-family'].':'.$epcl_theme['body_font']['font-weight'];   
        }else if( $epcl_theme['body_font']['font-family'] != '' ){
            $font_families[] = $epcl_theme['body_font']['font-family'];
        }
        if( !empty( $epcl_theme['primary_titles_font'] ) ){            
            if( $epcl_theme['primary_titles_font']['font-family'] != '' && $epcl_theme['primary_titles_font']['font-weight'] != '' ){
                $font_families[] = $epcl_theme['primary_titles_font']['font-family'].':'.$epcl_theme['primary_titles_font']['font-weight'];   
            }else if( $epcl_theme['primary_titles_font']['font-family'] != '' ){
                $font_families[] = $epcl_theme['primary_titles_font']['font-family'];
            }
        }
    }

    $query_args = array(
        'family' => rawurlencode( implode( '|', $font_families ) ),
        'subset' => rawurlencode( 'latin,latin-ext' ),
    );
    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    
    return esc_url_raw( $fonts_url );
}

// Customs fonts to match Gutenberg with Front-End, only enabled by theme options
add_action('admin_head', 'epcl_admin_custom_css', 20);
function epcl_admin_custom_css() {
    $custom_css = epcl_generate_gutenberg_custom_styles();
    echo '<style id="epcl-custom-css-admin">.column-epcl_post_image{ width: 120px; }'.$custom_css.'</style>';
}

/* Add small excerpt length */

function epcl_usmall_excerpt_length($length){
    $length = 12;

	return $length;
}

function epcl_small_excerpt_length($length){
    $epcl_theme = epcl_get_theme_options();
    $length = 17;

    if( !empty($epcl_theme) && $epcl_theme['small_excerpt_length'] ){
        $length = absint( $epcl_theme['small_excerpt_length'] );
    }
	return $length;
}

function epcl_large_excerpt_length($length){
    $epcl_theme = epcl_get_theme_options();
    $length = 30;

    if( !empty($epcl_theme) && $epcl_theme['large_excerpt_length'] ){
        $length = absint( $epcl_theme['large_excerpt_length'] );
    }
	return $length;
}

// Custom title length Grid Posts

function epcl_grid_title_length( $title, $id ){
    $epcl_theme = epcl_get_theme_options();
    $length = '';
    if( !empty($epcl_theme) && isset($epcl_theme['grid_title_length']) && $epcl_theme['grid_title_length'] != '' && get_post_type($id) == 'post' ){
        $length = absint( $epcl_theme['grid_title_length'] );
        if( mb_strlen($title) > $length){
            return mb_substr( $title, 0, $length ).'...';
        }        
    }    
    return $title;   
}

// Custom title length Classic Posts

function epcl_classic_title_length( $title, $id ){
    $epcl_theme = epcl_get_theme_options();
    $length = '';
    if( !empty($epcl_theme) && isset($epcl_theme['classic_title_length']) && $epcl_theme['classic_title_length'] != '' && get_post_type($id) == 'post' ){
        $length = absint( $epcl_theme['classic_title_length'] );
        if( mb_strlen($title) > $length){
            return mb_substr( $title, 0, $length ).'...';
        }    
    }
    return $title;
}

/* Custom Pagination */

function epcl_pagination($query = NULL){
	global $wp_query, $paged;
    if($query) $wp_query = $query;
    if( !empty($wp_query->query['paged']) ){
        $paged = $wp_query->query['paged'];
    }
    
?>
    <div class="separator last hide-on-tablet hide-on-mobile"></div>
    <div class="clear"></div>
    <!-- start: .epcl-pagination -->
    <div class="epcl-pagination section">
        <div class="nav">
            <?php echo get_previous_posts_link( esc_html__('Previous', 'breek') ); ?>
            <span class="page-number">
                <?php esc_html_e('Page', 'breek'); ?> <?php echo max(1, get_query_var('paged') ); ?>
                <?php esc_html_e('of', 'breek'); ?> <?php echo intval($wp_query->max_num_pages); ?>
            </span>
            <?php echo get_next_posts_link( esc_html__('Next', 'breek') ); ?>
        </div>
    </div>
    <!-- end: .epcl-pagination -->
<?php
}

add_filter( 'image_size_names_choose', 'epcl_media_settings_custom_sizes' );

function epcl_media_settings_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'epcl_single_content' => esc_html__( 'EP Article Thumb', 'breek' ),
	) );
}

add_filter('wp_list_categories', 'epcl_at_count_span');
add_filter('get_archives_link', 'epcl_archives_count');

function epcl_at_count_span($links) {
    $links = str_replace('</a> (', '</a> <span>', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}

function epcl_archives_count($links){
    $links = str_replace('</a>&nbsp;(', '</a> <span>', $links);
    $links = str_replace(')</li>', '</span></li>', $links);
    return $links;
}

// Add search button to the end of the main menu
function epcl_search_nav_item($items, $args) {
    if ($args->theme_location == 'epcl_header') {
        return $items .= '<li class="search-menu-item hide-on-mobile hide-on-tablet"><a href="#search-lightbox" class="lightbox mfp-inline"><i class="remixicon remixicon-search-line"></i></a></li>';
    }
    return $items;
}

// Add subscribe button to the end of the main menu
function epcl_subscribe_nav_item($items, $args) {
    $subscribe_title = esc_html__("Subscribe", 'breek');
    if( function_exists('epcl_get_option') ){
        $subscribe_title = epcl_get_option('title_subscribe_button');
    }
    if ($args->theme_location == 'epcl_header') {
        return $items .= '<li class="subscribe-menu-item hide-on-mobile hide-on-tablet"><a href="'.epcl_get_option('mailchimp_url').'" target="_blank" class="subscribe epcl-button red hide-on-tablet hide-on-mobile" rel="nofollow noopener">'.$subscribe_title.' <i class="fa fa-paper-plane"></i></a></li>';
    }
    return $items;
}

// Render categories with colors

function epcl_render_categories( $class = 'absolute' ){
    $categories = get_the_category();

    if( empty($categories) ) return;

    if( function_exists('epcl_get_option') && epcl_get_option('enable_single_category') === '0' && is_single() ){
        return;
    }

    $html = '<div class="tags '.$class.'">';
    $i = 0;
    $limit = 2;
    if( epcl_get_option('category_limit') ){
        $limit = absint( epcl_get_option('category_limit') );
    }
    foreach($categories as $c){
        if( $i == $limit ) break;
        $html .= '<a href="'.get_category_link($c).'" class="tag-link-'.$c->term_id.'">'.$c->name.'</a>';
        $i++;
    }
    $html .= '</div>';

    return $html;
}

// SVG sanitization
function epcl_svg_kses_ruleset() {
    $kses_defaults = wp_kses_allowed_html( 'post' );

    $svg_args = array(
        'svg'   => array(
            'xlink'           => true,
            'class'           => true,
            'aria-hidden'     => true,
            'aria-labelledby' => true,
            'role'            => true,
            'xmlns'           => true,
            'width'           => true,
            'height'          => true,
            'viewbox'         => true, // <= Must be lower case!
        ),
        'use' => array(
            'xlink:href' => true,
        ),
        'g'     => array( 'fill' => true ),
        'title' => array( 'title' => true ),
        'path'  => array(
            'd'    => true,
            'fill' => true,
        ),
    );
    return array_merge( $kses_defaults, $svg_args );
}

function epcl_return_image_path($thumbID, $size = 'medium') {
    $thumbID = get_post_thumbnail_id( $post->ID );
    $image = wp_get_attachment_image_src($thumbID, $size);
    $upload_dir = wp_upload_dir();
    $base_dir = $upload_dir['basedir'];
    $base_url = $upload_dir['baseurl'];
    $imagepath = str_replace($base_url, $base_dir, $image[0]);
    if ( file_exists( $imagepath) ) return $imagepath;
    return false;
}

/* Ajax for views counter */

function epcl_views_counter() {

    // Check for nonce security for logged in users
    $nonce = sanitize_text_field( $_POST['nonce'] );

    $post_id = sanitize_text_field( $_POST['post_id'] );    

    if( function_exists('get_field') && function_exists('get_fields') ){
        $views = absint( get_field('views_counter', $post_id) );
		if(!$views) $views = 0;
        update_post_meta($post_id, 'views_counter', ++$views);
        die('success');
	}

    die('error');
}
add_action('wp_ajax_nopriv_epcl_views_counter', 'epcl_views_counter');
add_action('wp_ajax_epcl_views_counter', 'epcl_views_counter');