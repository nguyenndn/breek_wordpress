<?php
$epcl_theme = epcl_get_theme_options();
$epcl_module = epcl_get_module_options();

$index = $wp_query->current_post+1;
$post_class = $optimized_image = '';
if( !get_post_format() && !has_post_thumbnail() ){
    if( function_exists('get_field') ){
        $optimized_image = get_field('optimized_image');
    }
    if( !$optimized_image ){
        $post_class .= ' no-thumb';
    }    
}

$author_id = get_the_author_meta('ID');
$author_avatar = get_avatar_url( get_the_author_meta('email') );
$optimized_avatar = get_the_author_meta('avatar');
if( $optimized_avatar ){
    $author_avatar = wp_get_attachment_url( $optimized_avatar );
}
$author_name = get_the_author();
$views = 0;
if( function_exists('get_fields') ){
    $fields = get_fields();
    $views = get_field('views_counter');
}
set_query_var( 'epcl_post_style', 'classic' );
?>
<article <?php post_class('default index-'.$index.$post_class.' np-mobile"'); ?>>

    <div class="article-wrapper">

        <?php if( !has_post_thumbnail()  && !get_post_format() && get_the_category() ): ?>
            <?php echo epcl_render_categories( 'no-thumb' ); ?>
        <?php endif; ?>

        <div class="top">
            <?php epcl_display_post_format( get_post_format(), get_the_ID() );  ?>
        </div>
        
        <!-- start: .bottom -->
        <div class="bottom">

            <header>        
                <?php if( is_archive() || is_search() ): ?>
                    <h2 class="title large gradient-effect"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php else: ?>
                    <h1 class="title large gradient-effect"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <?php endif; ?>                
                <?php if( empty($epcl_theme) || $epcl_theme['classic_enable_meta_data'] !== '0' || $epcl_theme['classic_display_author'] !== '0' ): ?>
                    <div class="meta">
                        <?php if( empty($epcl_theme) || $epcl_theme['classic_display_author'] !== '0' ): ?>
                        <a href="<?php echo get_author_posts_url($author_id); ?>" class="author meta-info" title="<?php echo esc_attr($author_name); ?>">
                            <?php if($author_avatar): ?>
                                <span class="author-image cover" style="background-image: url('<?php echo esc_url($author_avatar); ?>');"></span>
                            <?php endif; ?>
                            <span class="author-name"><?php echo esc_attr($author_name); ?></span>
                        </a>
                        <?php endif; ?>
                        <?php if( empty($epcl_theme) || $epcl_theme['classic_enable_meta_data'] !== '0' ): ?>
                            <?php if( epcl_get_option('enable_global_date') !== '0' ): ?>
                                <time class="meta-info" datetime="<?php the_time('Y-m-d'); ?>"><i class="remixicon remixicon-calendar-line"></i> <?php the_time( get_option('date_format') ); ?></time>
                            <?php endif; ?>

                            <a href="<?php the_permalink(); ?>#comments" class="comments meta-info" title="<?php esc_attr_e('Go to comments', 'breek'); ?>"> 
                                <i class="remixicon remixicon-chat-1-line fa-flip-horizontal"></i>               
                                <?php if( epcl_get_option('hosted_comments') !== '2' && epcl_get_option('hosted_comments') !== '3' ): ?>
                                    <span class="comment-count"><?php echo get_comments_number($post->ID); ?></span>
                                <?php elseif( $epcl_theme['hosted_comments'] == 3 ): // Facebook commments ?>
                                    <span class="fb-comments-count" data-href="<?php the_permalink(); ?>">0</span>
                                <?php else: // Disqus Comments ?>
                                    <span class="disqus-comment-count" data-disqus-url="<?php the_permalink(); ?>" data-disqus-identifier="<?php the_ID(); ?>">0</span>
                                <?php endif; ?>                        
                            </a>

                            <?php if( isset($epcl_theme['enable_global_views']) && $epcl_theme['enable_global_views'] === '1' ): ?>
                                <span class="views-counter" title="<?php esc_attr_e('Views', 'breek'); ?>">
                                    <i class="remixicon remixicon-fire-line"></i> <?php echo absint( $views ); ?>
                                </span>
                            <?php endif; ?>
                            
                        <?php endif; ?>
                        <div class="clear"></div>
                    </div>
                <?php endif; ?>    
                
            </header>

            <div class="post-excerpt grid-container grid-usmall np-mobile">
                <?php if( empty($epcl_theme) || $epcl_theme['classic_display_excerpt'] !== '0' ): ?>
                    <?php the_excerpt(); ?>
                <?php endif; ?>
                <div class="clear"></div>
                <a href="<?php the_permalink(); ?>" class="epcl-button red"><?php esc_html_e('Continue reading', 'breek'); ?></a>
            </div>

            <div class="clear"></div>

        </div>
        <!-- end: .bottom -->
    
    </div>
</article>

<div class="separator hide-on-tablet hide-on-mobile"></div>

<?php $index++; set_query_var('index', $index); ?>