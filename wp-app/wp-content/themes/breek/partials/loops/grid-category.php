<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();
$cat = get_query_var('cat_elem');

$index = absint( get_query_var('index') );

$column_class = 'grid-33';
$grid_posts_column = 3;
$post_class = $thumb_url = '';

if( !get_post_format() && !has_post_thumbnail() ){
    $post_class .= ' no-thumb';
}
// Loaded by Flexible content ACF
if( !empty($epcl_module) ){
    $column_class = 'grid-33';
    if( !empty($epcl_module['grid_cat_posts_column']) ){
        $grid_posts_column = $epcl_module['grid_cat_posts_column'];
    }
	
	switch ($grid_posts_column) {
		case '1':
			$column_class = 'grid-50';
		break;
		case '2':
			$column_class = 'grid-50';
        break;
        case '4':
			$column_class = 'grid-25';
		break;
		default:
			$column_class = 'grid-33';
		break;
	}
	if( $epcl_module['acf_fc_layout'] == 'grid_sidebar' ){
		$grid_posts_column = 2;
	    $column_class = 'grid-50';
    }
}

$thumb_url = get_the_post_thumbnail_url(get_the_ID());
$views = 0;
$image_alt = '';
if( function_exists('get_fields') ){
    $fields = get_fields($cat);
    $views = get_field('views_counter');
    if( !empty( $fields['archives_image'] ) && $fields['archives_image']['sizes']['epcl_single_content'] != '' ){
        $thumb_url = $fields['archives_image']['sizes']['epcl_single_content'];
        $image_alt = $fields['archives_image']['alt'];
    }
}
if( !empty($epcl_theme) && $epcl_theme['grid_display_author'] == '0'){
	$post_class .= ' no-author';
}
set_query_var( 'epcl_post_style', 'grid' );
if( isset($_GET['ads']) ){
    $epcl_theme['ads_enabled_grid_loop'] = '1';
}
// Ads integration
if( !epcl_is_amp() && !empty($epcl_theme) && function_exists( 'epcl_render_global_ads' ) && $epcl_theme['ads_enabled_grid_loop'] == '1' && $index === ( absint($epcl_theme['ads_position_grid_loop']) - 1  ) ){
    if( $epcl_theme['ads_mobile_grid_loop'] == '0' && wp_is_mobile() ){

    }else{
        echo '<article class="index-'.$index.' '.$column_class.' tablet-grid-50 np-mobile">';
            epcl_render_global_ads('grid_loop');
        echo '<div class="border"></div></article>';
        $index++;
    }
}
?>

<article <?php post_class('default index-'.$index.' '.$column_class.$post_class.' tablet-grid-50 mobile-grid-100 np-mobile"'); ?>>
    <div class="article-wrapper">

        <header>

            <div class="post-format-image post-format-wrapper">
                <div class="featured-image">
                    <?php if( $thumb_url ): ?>
                        <a href="<?php echo get_category_link($cat); ?>" class="thumb hover-effect">
                            <?php if( !empty($epcl_theme) && $epcl_theme['enable_lazyload'] == '1' ): ?>
                                <span class="fullimage cover lazy" role="img" aria-label="<?php echo esc_attr($image_alt); ?>" data-src="<?php echo esc_url($thumb_url); ?>" ></span>
                            <?php else: ?>
                                <span class="fullimage cover" role="img" aria-label="<?php echo esc_attr($image_alt); ?>" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"></span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            
            <h1 class="title main-title gradient-effect"><a href="<?php echo get_category_link($cat); ?>"><?php echo esc_html($cat->name); ?></a></h1>
        </header>

        <?php if( !empty($epcl_module) && $epcl_module['grid_cat_enable_description'] != 0 && $cat->description != ''): ?>
            <div class="post-excerpt">            
                <?php echo apply_filters('the_excerpt', $cat->description); ?>
                <div class="clear"></div>             
            </div>  
        <?php endif; ?>  
        

        <?php
        $author_id = get_the_author_meta('ID');
        $author_avatar = get_avatar_url( get_the_author_meta('email') );
        $optimized_avatar = get_the_author_meta('avatar');
        if( $optimized_avatar ){
            $author_avatar = wp_get_attachment_url( $optimized_avatar );
        }
        $author_name = get_the_author();
        $footer_class = '';
        ?>

        <?php if( !empty($epcl_module) && $epcl_module['grid_cat_enable_count'] != 0): ?>
            <footer class="author-meta textcenter">
                <div class="meta-info no-margin">
                    <a href="<?php echo get_category_link($cat); ?>"><i class="remixicon remixicon-article-line" style="top: -1px;"></i> <?php esc_html( printf( _n( '%1$s Article', '%1$s Articles', $cat->category_count, 'breek'), number_format_i18n( $cat->category_count ) ) );
                    ?></a>
                </div>
                <div class="clear"></div>
            </footer>
        <?php endif; ?>

        <div class="clear"></div>
        
        <div class="border"></div>        
    </div>
</article>

<?php $index++; set_query_var('index', $index); ?>

<?php if($index % $grid_posts_column == 0): ?>
	<div class="clear hide-on-tablet"></div>
<?php endif; ?>

<?php if($index % 2 == 0): ?>
	<div class="clear hide-on-desktop hide-on-mobile"></div>
<?php endif; ?>
