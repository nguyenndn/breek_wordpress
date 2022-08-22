<?php /* Template Name: Home */ ?>

<?php get_header(); ?>

<!-- start: #home -->
<main id="home" class="main">

	<?php
		if( function_exists('get_field') && function_exists('get_row_layout') && defined('EPCL_PLUGIN_PATH') ){
			$modules = get_field('modules');
			if( !empty($modules) ) {
                foreach ( $modules as $epcl_module ):
					switch ( $epcl_module['acf_fc_layout'] ) {
						case 'grid_posts':
							get_template_part( 'partials/home-blocks/grid-posts' );
                        break;
						case 'grid_sidebar':
							get_template_part( 'partials/home-blocks/grid-sidebar' );
                        break;
                        case 'grid_categories':         
                            $var = is_front_page() ? 'page' : 'paged';
                            $paged = ( get_query_var($var) ) ? get_query_var($var) : 1;
							get_template_part( 'partials/home-blocks/grid-categories' );
                        break;
						case 'classic_posts':
							get_template_part( 'partials/home-blocks/classic-posts' );
                        break;
						case 'carousel':
							get_template_part( 'partials/home-blocks/carousel' );
                        break;
						case 'advertising':
							get_template_part( 'partials/home-blocks/advertising' );
                        break;
                        case 'text_editor':
							get_template_part( 'partials/home-blocks/text-editor' );
                        break;
					}
				endforeach;
			}else{
			    echo '<div class="title large white textcenter section">'.esc_html__('You must add some module before publish this page', 'breek').'</div>';
            }
		}
	?>

</main>
<!-- end: #home -->
<?php get_footer(); ?>
