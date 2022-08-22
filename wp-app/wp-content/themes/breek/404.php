<?php get_header(); ?>

<?php
$enable_sidebar = $page_class = '';
if( !is_active_sidebar('epcl_sidebar_home') ){
    $enable_sidebar = false;
    $page_class .= ' no-sidebar';
}
?>

<!-- start: #page-404 -->
<main id="page-404" class="main grid-container">

	<!-- start: .center -->
    <div class="center content <?php echo esc_attr($page_class); ?>">
    
        <article>
            <div class="not-found section">
                <i class="fa fa-exclamation-circle"></i>
                <h2 class="title ularge"><strong><?php esc_html_e("404", 'breek'); ?></strong><br><?php esc_html_e("Page not found", 'breek'); ?></h2>
            </div>
            <div class="text textcenter">
                <h3 class="title white large no-margin"><?php esc_html_e("Something's wrong here...", 'breek'); ?></h3>
                <p><?php esc_html_e("We can't find the page you're looking.", 'breek'); ?></p>
            </div>
            <div class="buttons">
                <a href="<?php echo home_url('/'); ?>" class="epcl-button"><i class="fa fa-share fa-flip-horizontal"></i> &nbsp;<?php esc_html_e("Go back to home", 'breek'); ?></a>
            </div>
            
        </article>

        <div class="clear"></div>

	</div>
	<!-- end: .center -->
</main>
<!-- end: #page-404 -->
<?php get_footer(); ?>
