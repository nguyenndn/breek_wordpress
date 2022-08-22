<?php /* Template Name: Fullwidth (no sidebar) */ ?>
<?php get_header(); ?>
<?php
$wrapper_class = '';
$prefix = EPCL_THEMEPREFIX.'_';
?>
<!-- start: #page -->
<main id="page" class="main grid-container">
	<?php if(have_posts()): the_post(); ?>
		<!-- start: .center -->
	    <div id="single" class="center content fullcover">

            <?php if( has_post_thumbnail() ): ?>
                <div class="featured-image cover" style="background: url('<?php the_post_thumbnail_url('epcl_page_header'); ?>');'">
                    <div class="center grid-container">
                        <div class="info">
                            <!-- start: .meta -->
                            <div class="meta">
                                <h1 class="title large white bordered"><?php the_title(); ?></h1>
                            </div>
                            <!-- end: .meta -->
                        </div>
                    </div>
                </div>
            <?php endif; ?>

	        <!-- start: .left-content -->
	        <div class="left-content section np-mobile">
	            <article <?php post_class(); ?>>

	                <section class="post-content">
                        <?php if( !has_post_thumbnail() ): ?>
                            <h1 class="title ularge bordered bold"><?php the_title(); ?></h1>
                        <?php endif; ?>
	                    <div class="text">
	                        <?php the_content(); ?>
	                    </div>
	                    <div class="clear"></div>
	                </section>

	            </article>
	        </div>
	        <!-- end: .content -->

	        <div class="clear"></div>

	    </div>
	    <!-- end: .center -->
    <?php endif; ?>
</main>
<!-- end: #page -->
<?php get_footer(); ?>
