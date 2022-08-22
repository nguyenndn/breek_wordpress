<?php get_header(); ?>
<?php
$obj = get_queried_object();
$fields = '';
$icon = '<svg><use xlink:href="#tag"></use></svg>';
if( function_exists('get_fields') && !empty($obj) ){
    $fields = get_fields($obj);
    if( isset($fields['archives_icon']) && !empty( $fields['archives_icon'] ) ){
        $icon = '<img src="'.$fields['archives_icon']['url'].'" class="custom-icon">';
    }
}
?>
<!-- start: #archives-->
<main id="archives" class="main">
    
    <div class="grid-container section">
        <div class="tag-description section textcenter cover <?php if( isset( $fields['archives_image'] ) ) echo 'background'; ?>" <?php if( isset( $fields['archives_image']['sizes'] ) ) echo 'style="background-image: url('.$fields['archives_image']['sizes']['large'].');"'; ?>>
            <div class="grid-container grid-small">
                <h1 class="title large white fw-bold <?php if(!term_description()) echo 'nm-bottom'; ?>"><?php single_cat_title(); ?></h1>
                <?php if( term_description() ): ?>
                    <p><?php echo term_description(); ?></p>
                <?php endif; ?>
                <span class="icon"><?php echo wp_kses( $icon, epcl_svg_kses_ruleset() ); ?></span>
                <div class="clear"></div>
            </div>
            <div class="overlay"></div>
        </div>
    </div>

    <?php if( empty($epcl_theme) || !$epcl_theme['archive_layout'] || $epcl_theme['archive_layout'] == 'grid_3_cols' || $epcl_theme['archive_layout'] == 'grid_4_cols'  ): ?>
        <?php get_template_part('partials/home-blocks/grid-posts'); ?>
    <?php elseif( $epcl_theme['archive_layout'] == 'classic' ):  ?>
        <?php get_template_part('partials/home-blocks/classic-posts'); ?>
    <?php elseif( $epcl_theme['archive_layout'] == 'grid_sidebar'  ): ?>
        <?php get_template_part('partials/home-blocks/grid-sidebar'); ?>
    <?php endif; ?>

</main>
<!-- end: #archives -->
<?php get_footer(); ?>
