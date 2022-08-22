<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

$args = array('post_type' => 'post', 'paged' => get_query_var('paged') );

// ACF custom builder
if( is_page_template('page-templates/home.php') ){

    $var = is_front_page() ? 'page' : 'paged';
    $paged = ( get_query_var($var) ) ? get_query_var($var) : 1;
    // Fix AMP v2.0 and higher
    if( epcl_is_amp() && isset($_GET['amp']) ){
        $paged = get_query_var('paged');
    }
    $args['paged'] = $paged;

    if( !empty($epcl_module) ){
        if( isset($epcl_module['classic_category']) && $epcl_module['classic_category'] != '' ){
            $args['cat'] = $epcl_module['classic_category'];
        }
        if( isset($epcl_module['classic_excluded_categories']) && $epcl_module['classic_excluded_categories'] != '' ){
            $args['category__not_in'] = $epcl_module['classic_excluded_categories'];
        }
        if( isset($epcl_module['classic_posts_per_page']) && $epcl_module['classic_posts_per_page'] != '' ){
            $args['posts_per_page'] = $epcl_module['classic_posts_per_page'];
        }
        if( isset($epcl_module['classic_orderby']) && $epcl_module['classic_orderby'] != '' ){
            $args['orderby'] = $epcl_module['classic_orderby'];
            if( $epcl_module['classic_orderby'] == 'views' ){
                $args['orderby'] = 'meta_value_num';
                $args['meta_key'] = 'views_counter';
            }
        }
        if( isset($epcl_module['classic_order']) && $epcl_module['classic_order'] != '' ){
            $args['order'] = $epcl_module['classic_order'];
        }
    }
	
}

$custom_query = new WP_Query($args);
if( !is_page_template('page-templates/home.php') ){
    $custom_query = $wp_query;
}

add_filter( 'excerpt_length', 'epcl_large_excerpt_length', 999 );
add_filter( 'the_title', 'epcl_classic_title_length', 999, 2 );

$module_class = '';
$sidebar_name = 'epcl_sidebar_home';
if( !empty($epcl_module) ){
    if( isset($epcl_module['sidebar']) &&  $epcl_module['sidebar'] != ''){
        $sidebar_name = $epcl_module['sidebar'];
    }
}
if( !is_active_sidebar( $sidebar_name ) ){
    $module_class .= ' no-active-sidebar';
}
?>

<div class="grid-container module-wrapper <?php echo esc_attr($module_class); ?>">

    <!-- start: .content-wrapper -->
    <div class="content-wrapper classic <?php if(!is_archive()) echo 'content'; ?>">
        <!-- start: .center -->
        <div class="center left-content grid-70">

            <?php if( $custom_query->have_posts() ): ?>
                <!-- start: .articles -->
                <div class="articles classic">
                    <?php while( $custom_query->have_posts() ): $custom_query->the_post(); ?>
                        <?php get_template_part('partials/loops/classic-article'); ?>
                    <?php endwhile; ?>
                </div>
                <!-- end: .articles -->
                <?php epcl_pagination($custom_query); ?>

                <?php wp_reset_postdata(); ?>

            <?php else: ?>

                <!-- start: .articles -->
                <div class="articles classic bg-white">
                    <div class="section">
                        <div class="text textcenter">
                            <h3 class="title large no-margin"><?php esc_html_e("Something's wrong here...", 'breek'); ?></h3>
                            <p><?php esc_html_e("We can't find any result for your search term.", 'breek'); ?></p>
                        </div>
                        <div class="buttons textcenter">
                            <a href="<?php echo home_url('/'); ?>" class="button outline"><i class="fa fa-share fa-flip-horizontal"></i> <?php esc_html_e("Go back to home", "breek"); ?></a>
                        </div>
                    </div>
                </div>
                <!-- end: .articles -->

            <?php endif; ?>

        </div>
        <!-- end: .center -->
        <?php get_sidebar(); ?>

    </div>
    <!-- end: .content-wrapper -->
</div>