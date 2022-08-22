<?php 
$epcl_theme = epcl_get_theme_options();

$views = 0;
if( function_exists('get_field') && function_exists('get_fields') ){
    $fields = get_fields();
    $views = get_field('views_counter'); // Fix when views are not created
} 
$post_thumbnail = get_the_post_thumbnail_url($post, 'epcl_page_header');
// Author information
$author_id = get_the_author_meta('ID');
$author_avatar = get_avatar_url( get_the_author_meta('email') );
$optimized_avatar = get_the_author_meta('avatar');
if( $optimized_avatar ){
    $author_avatar = wp_get_attachment_url( $optimized_avatar );
}
$author_name = get_the_author();
?>
<div class="featured-image cover" style="background-image: url('<?php echo esc_url($post_thumbnail); ?>');">
    <?php if( empty($epcl_theme) || $epcl_theme['single_enable_meta_data'] !== '0' ): ?>
        <div class="meta top">
            <?php if( epcl_get_option('enable_global_date') !== '0' ): ?>
                <time class="meta-info" datetime="<?php the_time('Y-m-d'); ?>"><i class="remixicon remixicon-calendar-line"></i> <?php the_time( get_option('date_format') ); ?></time>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>#comments" class="comments meta-info" title="<?php esc_attr_e('Go to comments', 'breek'); ?>">
                <!-- <svg><use xlink:href="#comments-icon"></use></svg> -->
                <i class="remixicon remixicon-chat-1-line fa-flip-horizontal"></i>
                <?php if($epcl_theme['hosted_comments'] == 1 || empty($epcl_theme) ): ?>
                    <span class="comment-count"><?php echo get_comments_number($post->ID); ?></span>
                    <!-- <span class="comment-text hide-on-mobile"><?php printf( _n( 'Comment', 'Comments', get_comments_number($post->ID), 'breek'), get_comments_number($post->ID) ); ?></span> -->
                <?php elseif( $epcl_theme['hosted_comments'] == 3 ): // Facebook commments ?>
                    <span class="fb-comments-count" data-href="<?php the_permalink(); ?>">0</span>
                <?php else: ?>
                    <span class="disqus-comment-count" data-disqus-url="<?php the_permalink(); ?>" data-disqus-identifier="<?php the_ID(); ?>">0</span>
                <?php endif; ?>
            </a>
            <?php if( isset($epcl_theme['enable_global_views']) && $epcl_theme['enable_global_views'] === '1' ): ?>
                <span class="views-counter meta-info">
                    <!-- <svg><use xlink:href="#eye-icon"></use></svg> <?php echo absint( $views ); ?> -->
                    <i class="remixicon remixicon-fire-line"></i> <?php echo absint( $views ); ?>
                </span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
	<div class="info">
        <?php echo epcl_render_categories( '' ); ?>
        <h1 class="title ularge white bold"><?php the_title(); ?></h1>
	</div>
</div>