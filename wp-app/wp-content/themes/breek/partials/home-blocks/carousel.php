<?php
$epcl_module = epcl_get_module_options();
if( empty($epcl_module) ) return; // no data from carousel module
$prefix = EPCL_THEMEPREFIX.'_';
$args = array(
	'post_type' => 'post',
	'showposts' => $epcl_module['carousel_limit'],
	'suppress_filters' => false,
	'category' => $epcl_module['carousel_category'],
	'meta_key' => '_thumbnail_id'
);

if( isset($epcl_module['carousel_excluded_categories']) && !empty($epcl_module['carousel_excluded_categories']) ){
    $args['category__not_in'] = $epcl_module['carousel_excluded_categories'];
}

if( isset($epcl_module['carousel_orderby']) && $epcl_module['carousel_orderby'] == 'views' ){
    $args['orderby'] = 'meta_value_num';
    $args['meta_key'] = 'views_counter';
}

if( isset($epcl_module['carousel_orderby']) && $epcl_module['carousel_orderby'] == 'random' ){
    $args['orderby'] = 'rand';
}

if( isset($epcl_module['carousel_date']) && $epcl_module['carousel_date'] != 'alltime' ){
    $year = date('Y');
    $month = absint( date('m') );
    $week = absint( date('W') );

    $args['year'] = $year;

    if( $epcl_module['carousel_date'] == 'pastmonth' ){
        $args['monthnum'] = $month - 1;
    }
    if( $epcl_module['carousel_date'] == 'pastweek' ){
        $args['w'] = $week - 1;
    }
}

$carousel = get_posts($args);
$thumbnail_size = 'epcl_single_related';
if($epcl_module['carousel_show_limit'] == 1){
	$thumbnail_size = 'large';
}
?>

<?php if( !empty($carousel) ): ?>
	<!-- start: .carousel -->
	<section class="epcl-carousel slick-slider section outer-arrows slides-<?php echo intval( $epcl_module['carousel_show_limit'] ); ?>" data-show="<?php echo intval( $epcl_module['carousel_show_limit'] ); ?>" data-rtl="<?php echo is_rtl(); ?>" data-aos="fade">
		<?php foreach($carousel as $post): setup_postdata($post); ?>
        	<?php
                $image_id = get_post_thumbnail_id($post->ID);
                $thumb = wp_get_attachment_image_src( $image_id, $thumbnail_size );
                $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
				$image_url = $thumb[0];
                if( function_exists('get_field') ){
                    $optimized_image = get_field('optimized_image', $post->ID);
                    if( isset($optimized_image['alt']) ){
                        $image_alt = $optimized_image['alt'];
                    }                    
                    if( !empty($optimized_image) ){
                        $image_url = $optimized_image['url'];
                    }
                }                
                if( !$image_alt ){
                    $image_alt = get_the_title();
                }
			?>
            <div class="item">
                <article>
					<img class="img" alt="<?php echo esc_attr($image_alt); ?>" data-lazy="<?php echo esc_url($image_url); ?>">
					<div class="info border-effect">
                        <time datetime="<?php the_time('Y-m-d'); ?>">
                            <i class="remixicon remixicon-calendar-line"></i>
                            <?php the_time( get_option('date_format') ); ?>
                        </time>
						<h2 class="title white"><?php the_title(); ?></h2>
					</div>
					<div class="clear"></div>
	                <?php
	                $author_id = get_the_author_meta('ID');
                    $author_avatar = get_avatar_url( get_the_author_meta('email') );
                    $optimized_avatar = get_the_author_meta('avatar');
                    if( $optimized_avatar ){
                        $author_avatar = wp_get_attachment_url( $optimized_avatar );
                    }
	                $author_name = get_the_author();
                    ?>
                    <?php if( $epcl_module['carousel_enable_author'] !== false ): ?>
                        <footer class="author-meta">
                            <a href="<?php echo get_author_posts_url($author_id); ?>" title="<?php echo esc_attr($author_name); ?>">
                                <?php if($author_avatar): ?>
                                    <span class="author-image cover" style="background-image: url('<?php echo esc_url($author_avatar); ?>');"></span>
                                <?php endif; ?>
                                <span class="author-name"><?php echo esc_attr($author_name); ?></span>
                            </a>
                            <div class="clear"></div>
                        </footer>
                    <?php endif; ?>
					<a href="<?php the_permalink(); ?>" class="full-link" aria-label="<?php the_title(); ?>"><span style="display:none;"><?php the_title(); ?></span></a>
					<div class="overlay"></div>
                </article>
            </div>
        <?php endforeach; wp_reset_postdata(); ?>
	</section>
	<!-- end: .carousel -->
<?php endif; ?>
