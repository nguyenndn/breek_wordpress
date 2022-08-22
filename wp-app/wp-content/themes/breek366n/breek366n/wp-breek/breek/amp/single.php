<?php
// $this->load_parts( [ 'html-start' ] );
get_template_part('amp/header');
// get_header();
$epcl_theme = epcl_get_theme_options();
?>

<?php //$this->load_parts( [ 'header' ] ); ?>

<?php while(have_posts()): the_post();  ?>
    <?php
	$post_id = get_the_ID();
	$post_thumbnail = get_the_post_thumbnail_url();
	$post_format = get_post_format();

	$post_style = 'standard';
	$single_class = '';
    $enable_sidebar = true;
    $sidebar_name = 'epcl_sidebar_default';

	if( function_exists('get_field') && function_exists('get_fields') ){
        $views = absint( get_field('views_counter') );
		if(!$views) $views = 0;
        update_post_meta($post_id, 'views_counter', ++$views);

        $fields = get_fields();
		$post_style = get_field('style');
		if( $post_style === '' ) $post_style = 'standard';

		$enable_sidebar = get_field('enable_sidebar');
		if( $enable_sidebar === false ) $single_class .= ' no-sidebar';

	}
	if( $post_style == 'fullcover' ){
		$post_thumbnail = get_the_post_thumbnail_url($post, 'epcl_page_header');
    }
    if( $fields['sidebar'] != ''){
        $sidebar_name = $fields['sidebar'];
    }
    if( !is_active_sidebar( $sidebar_name ) ){
        $enable_sidebar = false;
        $single_class .= ' no-sidebar';
    }
    if( !$post_style || !has_post_thumbnail() ){
        $post_style = 'standard';
    }
    
    if( !empty($epcl_theme) && $epcl_theme['single_post_layout'] === '2' && $post_format == ''){
        $post_style = 'standard';
    }
    if( !empty($epcl_theme) && $epcl_theme['single_post_layout'] === '3' && $post_format == ''){
        $post_style = 'fullcover';
    }
    if( !empty($epcl_theme) && $epcl_theme['enable_post_sidebar'] === '2'){
        $enable_sidebar = true;
        $single_class = '';
    }
    if( !empty($epcl_theme) && $epcl_theme['enable_post_sidebar'] === '3'){
        $enable_sidebar = false;
        $single_class .= ' no-sidebar';
    }
    // Disable featured image globally
    if( !empty($epcl_theme) && isset($epcl_theme['enable_featured_image']) && $epcl_theme['enable_featured_image'] === '0'){
        $post_style = 'standard';
    }
    // Fix featured image titles
    if( !$post_style || !has_post_thumbnail() ){
        $post_style = 'standard';
    }
    set_query_var('epcl_share_bottom', false);
	?>
	<!-- start: #single -->
	<main id="single" class="main grid-container <?php echo esc_attr($post_style.$single_class); ?>">

		<!-- start: .center -->
	    <div class="center content">

			<!-- Fullcover Style -->
            <?php if( has_post_thumbnail() && $post_style == 'fullcover' && $post_format == '' ): ?>
                <?php get_template_part('partials/single/fullcover'); ?>
            <?php endif; ?>

            <!-- start: .epcl-page-wrapper -->
            <div class="epcl-page-wrapper">            

                <!-- start: .content -->
                <div class="left-content grid-70 np-mobile">

                    <article <?php post_class('main-article'); ?>>

                        <?php edit_post_link( esc_html__('Edit this post', 'breek'), '', '', '', 'edit-post-button epcl-button dark'); ?>
                    
                        <?php if( $post_style == 'standard'): ?>
                            <?php get_template_part('partials/single/standard'); ?>
                        <?php endif; ?>

                        <section class="post-content">

                            <div class="text">
                                <?php the_content(); ?>
                                <?php
                                    if ( is_singular( 'attachment' ) ) {
                                        echo '<h2 class="title usmall">'.esc_html__('Published in:', 'breek').'</h2>';
                                        // Parent post navigation.
                                        the_post_navigation();
                                    }
                                ?>
                            </div>
                            <div class="clear"></div>

                            <!-- <p class="textcenter"><a  data-ampdevmode href="<?php echo get_permalink() ?>#comments" class="button red"><?php esc_html_e('Leave a comment', 'breek'); ?></a></p> -->

                            <?php if( comments_open() ): ?>
                                <div id="go-to-comments" class="go-to-comments section textcenter np-bottom">
                                    <a href="<?php the_permalink(); ?>#comments" rel="noamphtml" class="epcl-button red medium"><?php esc_html_e('Leave a comment', 'breek'); ?></a>
                                </div>
                            <?php endif; ?>

                            <?php if( $epcl_theme['enable_share_buttons'] != false && !empty($epcl_theme) ): ?>
                                <!-- start: .share-buttons -->
                                <div class="share-buttons section">
                                    <h5 class="title small"><?php esc_html_e('Share Article:', 'breek'); ?></h5>
                                    <?php set_query_var('epcl_share_bottom', 'true'); ?>
                                    <!-- <amp-social-share type="facebook" width="40" height="40"></amp-social-share>
                                    <amp-social-share type="twitter" width="40" height="40"></amp-social-share>
                                    <amp-social-share type="email" width="40" height="40"></amp-social-share>
                                    <amp-social-share type="whatsapp" width="40" height="40"></amp-social-share> -->
                                    <?php get_template_part('amp/partials/share-buttons'); ?>
                                    <div class="clear"></div>
                                </div>
                                <!-- end: .share-buttons -->

                                
    
                            <?php endif; ?>                            

                        </section>

                        <?php if( get_the_tags() ): ?>
                            <div class="bottom-tags">
                                <i class="remixicon remixicon-price-tag-3-line"></i>
                                <?php the_tags(''); ?>
                            </div>
                        <?php endif; ?>

                        <?php
                            $link_pages_args = array(
                                'before'           => '<div class="epcl-pagination link-pages section"><div class="nav"><span class="page-number">'.esc_html__( 'Pages', 'breek' ).'</span>',
                                'after'            => '</div></div>',
                                'link_before'      => '',
                                'link_after'       => '',
                                'next_or_number'   => 'number',
                                'separator'        => '',
                                'nextpagelink'     => esc_html__( 'Next', 'breek'),
                                'previouspagelink' => esc_html__( 'Previous', 'breek' ),
                                'pagelink'         => '<span class="page-number">%</span>',
                                'echo'             => 1
                            );
                            wp_link_pages( $link_pages_args );
                        ?>

 

                    </article>
                    <div class="clear"></div>

                    <?php get_template_part('partials/author-box'); ?>

                    <?php if($epcl_theme['siblings_posts'] != false): ?>

                        <section class="related section">
                            <?php
                            $prev_post = get_previous_post();
                            if( !empty($prev_post) ){
                                $prev_url = get_the_permalink($prev_post->ID);
                                $prev_thumb = get_the_post_thumbnail_url($prev_post->ID, 'epcl_single_content');
                                $prev_title = get_the_title($prev_post->ID);
                            }
                            ?>
                            <?php if( !empty($prev_post) ): ?>
                                <article class="prev grid-50 tablet-grid-50 grid-parent">
                                    <?php if($prev_thumb): ?>              
                                        <div class="thumb cover" style="background: url('<?php echo esc_url($prev_thumb); ?>');"></div>                               
                                    <?php endif; ?>
                                    <a href="<?php echo esc_url($prev_url); ?>" class="full-link"></a>                              
                                    <div class="info">
                                        <?php if( epcl_get_option('enable_global_date') !== '0' ): ?>
                                            <time datetime="<?php echo get_the_time('Y-m-d', $prev_post); ?>">
                                                <?php echo get_the_time( get_option('date_format'), $prev_post ); ?>
                                            </time>
                                        <?php endif; ?>
                                        <h4 class="title white no-margin"><?php echo esc_attr($prev_title); ?></h4>
                                    </div>                                
                                    <span class="epcl-button red"><img src="<?php echo EPCL_THEMEPATH; ?>/assets/images/left-arrow.svg" width="15" alt="<?php esc_attr_e('Left Arrow', 'breek'); ?>"></span>
                                    <div class="overlay"></div>
                                </article>
                            <?php endif; ?>

                            <?php
                            $next_post = get_next_post();
                            if( !empty($next_post) ){
                                $next_url = get_the_permalink($next_post->ID);
                                $next_thumb = get_the_post_thumbnail_url($next_post->ID, 'epcl_single_content');
                                $next_title = get_the_title($next_post->ID);
                            }
                            ?>
                            <?php if( !empty($next_post) ): ?>
                                <article class="next grid-50 tablet-grid-50 grid-parent">
                                    <?php if($next_thumb): ?>                   
                                        <div class="thumb cover" style="background: url('<?php echo esc_url($next_thumb); ?>');"></div>
                                    <?php endif; ?>
                                    <a href="<?php echo esc_url($next_url); ?>" class="full-link"></a>                            
                                    <div class="info">
                                        <?php if( epcl_get_option('enable_global_date') !== '0' ): ?>
                                            <time datetime="<?php echo get_the_time('Y-m-d', $next_post); ?>">
                                                <?php echo get_the_time( get_option('date_format'), $next_post ); ?>
                                            </time>
                                        <?php endif; ?>
                                        <h4 class="title white no-margin"><?php echo esc_attr($next_title); ?></h4>                                
                                    </div>
                                    <span class="epcl-button red"><img src="<?php echo EPCL_THEMEPATH; ?>/assets/images/right-arrow.svg" width="15" alt="<?php esc_attr_e('Right Arrow', 'breek'); ?>"></span>
                                    <div class="overlay"></div>
                                </article>
                            <?php endif; ?>
                            <div class="clear"></div>
                        </section>

                    <?php endif; ?>

                    <div class="clear"></div>

                </div>
                <!-- end: .content -->

                <?php
                if( $enable_sidebar !== false ){
                    get_sidebar();
                }
                ?>

            </div>
            <!-- end: .epcl-page-wrapper -->            
        
        </div>
        <!-- end: .center -->

	</main>
	<!-- end: #single -->

<?php endwhile; ?>

<?php get_template_part('amp/footer'); ?>