<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

add_filter( 'excerpt_length', 'epcl_small_excerpt_length', 999 );

$per_page = get_option('posts_per_page');
$grid_posts_column = 3;
$module_class = '';
if( !empty($epcl_module) ){
    if( $epcl_module['grid_cat_enable_masonry'] ){
		$module_class .= ' enable-masonry';
    } 
    if( $epcl_module['grid_cat_posts_column'] ){
		$grid_posts_column = $epcl_module['grid_cat_posts_column'];
    }    
    if( $epcl_module['grid_cat_posts_column'] == 4 ){
        add_filter( 'excerpt_length', 'epcl_usmall_excerpt_length', 999 );
    }
    if( $epcl_module['grid_cat_posts_per_page'] != '' ){
		$per_page = $epcl_module['grid_cat_posts_per_page'];
    } 
}else{
    $module_class = 'enable-masonry';
}

$var = is_front_page() ? 'page' : 'paged';
$paged = ( get_query_var($var) ) ? get_query_var($var) : 1;

$paged_offset = ($paged - 1) * $per_page;

$args = array(
    'orderby' => 'count',
    'order' => 'DESC',
);

$total_categories = get_categories( $args );
$total =  ceil( count( $total_categories ) / $per_page );   

$args = array(
    'orderby' => 'count',
    'order' => 'DESC',
    'number' => $per_page,
    'paged' => $paged,
    'offset' => $paged_offset
);

if( isset($epcl_module['grid_cat_exclude']) && $epcl_module['grid_cat_exclude'] != '' ){
    $args['exclude'] = $epcl_module['grid_cat_exclude'];
}

$categories = get_categories( $args );


?>
<div class="grid-container module-wrapper <?php echo esc_attr($module_class); ?>" data-aos="fade-up">

    <div class="row">
        
        <!-- start: .content-wrapper -->
        <div class="content-wrapper grid-posts <?php if(!is_archive()) echo 'content'; ?>">

            <?php if( !empty($categories) ): ?>

                <!-- start: .articles -->
                <div class="articles grid-category columns-<?php echo esc_attr($grid_posts_column); ?>">
                    <?php foreach($categories as $cat): ?>
                        <?php set_query_var('cat_elem', $cat); ?>
                        <?php get_template_part('partials/loops/grid-category'); ?>
                    <?php endforeach; ?>
                </div>
                <!-- end: .articles -->

                <div class="clear"></div>

                <!-- start: .epcl-pagination -->
                <div class="epcl-pagination section">
                    <div class="nav">
                        <?php echo get_previous_posts_link( esc_html__('Previous', 'breek') ); ?>
                        <span class="page-number">
                            <?php esc_html_e('Page', 'breek'); ?> <?php echo max(1, $paged ); ?>
                            <?php esc_html_e('of', 'breek'); ?> <?php echo intval( $total ); ?>
                        </span>
                        <?php echo get_next_posts_link( esc_html__('Next', 'breek'), $total ); ?>
                    </div>
                </div>
                 <!-- end: .epcl-pagination -->

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