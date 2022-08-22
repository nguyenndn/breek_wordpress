<?php get_header(); ?>
<?php
add_filter('excerpt_length', 'epcl_small_excerpt_length', 999);
?>
<!-- start: #archives-->
<main id="archives" class="main grid-container">

    <div class="row">

        <!-- start: .content-wrapper -->
        <div class="content-wrapper">

            <div class="grid-container section">
                <?php get_template_part('partials/author-box'); ?>
            </div>
            
            <?php if( have_posts() ): ?>

                <!-- start: .articles -->
                <div class="articles">

                    <?php while( have_posts() ): the_post(); ?>
                        <?php if( function_exists('get_field') && get_field('loop_style') == 'bgstyle'): ?>
                            <?php get_template_part('partials/loops/grid-bgstyle'); ?>
                        <?php else: ?>
                            <?php get_template_part('partials/loops/grid-article'); ?>
                        <?php endif; ?>
                    <?php endwhile; ?>

                </div>
                <!-- end: .articles -->

                <?php epcl_pagination(); ?>
            
            <?php else: ?>

                <!-- start: .articles -->
                <div class="articles classic">
                    <div class="section">
                        <div class="text textcenter">
                            <h3 class="title large no-margin"><?php esc_html_e("Something's wrong here...", 'breek'); ?></h3>
                            <p><?php esc_html_e("We can't find any result for this author.", 'breek'); ?></p>
                        </div>
                        <div class="buttons textcenter">
                            <a href="<?php echo home_url('/'); ?>" class="button outline"><i class="fa fa-share fa-flip-horizontal"></i> <?php esc_html_e("Go back to home", "breek"); ?></a>
                        </div>
                    </div>
                </div>
                <!-- end: .articles -->

            <?php endif; ?>
        </div>
        <!-- end: .content-wrapper -->
    
    </div>

</main>
<!-- end: #archives -->
<?php get_footer(); ?>
