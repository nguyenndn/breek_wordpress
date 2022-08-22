<?php
$class = 'item';
$post_id = get_the_ID();
$thumb_size = 'epcl_widget_thumb';
?>
<?php if( !has_post_thumbnail() ) $class .= ' no-thumb'; ?>
<article <?php post_class($class); ?>>

    <?php if( has_post_thumbnail() ): ?>
        <?php
        $thumb_id = get_post_thumbnail_id($post_id);
        $thumb_type = get_post_mime_type($thumb_id);
        $image_alt = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true);
        if( !$image_alt ){
            $image_alt = get_the_title($post_id);
        }
        if($thumb_type == 'image/gif'){
            $thumb_size = '';
        }
        if( epcl_is_amp() && isset( $epcl_theme['enable_lazyload'] ) ){
            unset($epcl_theme['enable_lazyload']);
        }
        ?>
        <a href="<?php the_permalink(); ?>" class="thumb hover-effect" aria-label="<?php the_title(); ?>">
            <?php if( !empty($epcl_theme) && $epcl_theme['enable_lazyload'] == '1' ): ?>
                <span class="fullimage cover lazy" role="img" aria-label="<?php echo esc_attr($image_alt); ?>" data-src="<?php the_post_thumbnail_url($thumb_size); ?>"></span>
            <?php else: ?>
                <span class="fullimage cover" role="img" aria-label="<?php echo esc_attr($image_alt); ?>" style="background: url('<?php the_post_thumbnail_url($thumb_size); ?>');"></span>
            <?php endif; ?>
        </a>
    <?php endif; ?>

    <div class="info gradient-effect">
        <?php if( epcl_get_option('enable_global_date') !== '0' ): ?>
            <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time( get_option('date_format') ); ?></time>
        <?php endif; ?>
        <h4 class="title usmall"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>								
    </div>

    <div class="clear"></div>
</article>