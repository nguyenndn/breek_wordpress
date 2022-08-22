<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

add_filter( 'excerpt_length', 'epcl_small_excerpt_length', 999 );
add_filter( 'the_title', 'epcl_grid_title_length', 999, 2 );

$args = array('post_type' => 'post', 'paged' => get_query_var('paged') );

if( is_page_template('page-templates/home.php') ){

    $var = is_front_page() ? 'page' : 'paged';
    $paged = ( get_query_var($var) ) ? get_query_var($var) : 1;
    // Fix AMP v2.0 and higher
    if( epcl_is_amp() && isset($_GET['amp']) ){
        $paged = get_query_var('paged');
    }
    $args['paged'] = $paged;

    if( !empty($epcl_module) ){
        if( isset($epcl_module['grid_category']) && $epcl_module['grid_category'] != '' ){
            $args['cat'] = $epcl_module['grid_category'];
        }
        if( isset($epcl_module['grid_excluded_categories']) && $epcl_module['grid_excluded_categories'] != '' ){
            $args['category__not_in'] = $epcl_module['grid_excluded_categories'];
        }
        if( isset($epcl_module['grid_posts_per_page']) && $epcl_module['grid_posts_per_page'] != '' ){
            $args['posts_per_page'] = $epcl_module['grid_posts_per_page'];
        }
        if( isset($epcl_module['grid_posts_orderby']) && $epcl_module['grid_posts_orderby'] != '' ){
            $args['orderby'] = $epcl_module['grid_posts_orderby'];
            if( $epcl_module['grid_posts_orderby'] == 'views' ){
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = 'views_counter';
            }
        }
        if( isset($epcl_module['grid_posts_order']) && $epcl_module['grid_posts_order'] != '' ){
            $args['order'] = $epcl_module['grid_posts_order'];
        }
    }
	
}

$custom_query = new WP_Query($args);
if( !is_page_template('page-templates/home.php') ){
    $custom_query = $wp_query;
}

if( isset($_GET['ads']) ){
    $args['posts_per_page'] = 8;
    $wp_query = new WP_Query($args);
}
$grid_posts_column = 3;
$module_class = '';
if( !empty($epcl_module) ){
    if( $epcl_module['grid_enable_masonry'] ){
		$module_class .= ' enable-masonry';
    } 
    if( $epcl_module['grid_posts_column'] ){
		$grid_posts_column = $epcl_module['grid_posts_column'];
    }    
    if( $epcl_module['grid_posts_column'] == 4 ){
        add_filter( 'excerpt_length', 'epcl_usmall_excerpt_length', 999 );
    }
}else{
    $module_class = 'enable-masonry';
}

if( !empty($epcl_theme) ){
    if( is_archive() && $epcl_theme['archive_layout'] == 'grid_4_cols' ){
        $grid_posts_column = 4;
        add_filter( 'excerpt_length', 'epcl_usmall_excerpt_length', 999 );
    }
    if( is_search() && $epcl_theme['search_layout'] == 'grid_4_cols' ){
        $grid_posts_column = 4;
        add_filter( 'excerpt_length', 'epcl_usmall_excerpt_length', 999 );
    }
}
?>
<div class="grid-container module-wrapper <?php echo esc_attr($module_class); ?>" data-aos="fade-up">

    <div class="row">
        
        <!-- start: .content-wrapper -->
        <div class="content-wrapper grid-posts <?php if(!is_archive()) echo 'content'; ?>">

            <?php if( $custom_query->have_posts() ): ?>

                <!-- start: .articles -->
                <div class="articles columns-<?php echo esc_attr($grid_posts_column); ?>">
                    <?php while( $custom_query->have_posts() ): $custom_query->the_post(); ?>
                        <?php if( function_exists('get_field') && get_field('loop_style') == 'bgstyle'): ?>
                            <?php get_template_part('partials/loops/grid-bgstyle'); ?>
                        <?php else: ?>
                            <?php get_template_part('partials/loops/grid-article'); ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
                <!-- end: .articles -->

                <?php epcl_pagination($custom_query); ?>

                <?php wp_reset_postdata(); ?>

            <?php else: ?>
                <!-- start: .articles -->
                <div class="articles classic grid-container grid-small">
                    <div class="section bg-white">
                        <div class="text textcenter">
                            <h3 class="title large no-margin"><?php esc_html_e("Something's wrong here...", 'breek'); ?></h3>
                            <p><?php esc_html_e("We can't find any result for your search term.", 'breek'); ?></p><br>
                        </div>
                        <div class="buttons textcenter">
                            <a href="<?php echo home_url('/'); ?>" class="button"><i class="fa fa-share fa-flip-horizontal"></i> &nbsp;<?php esc_html_e("Go back to home", 'breek'); ?></a>
                        </div>
                    </div>
                </div>
                <!-- end: .articles -->
            <?php endif; ?>     
        </div>
        <!-- end: .content-wrapper -->

    </div>

</div>