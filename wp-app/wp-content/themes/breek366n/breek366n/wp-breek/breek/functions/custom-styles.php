<?php

/* Custom styles generated from theme options panel */

if( function_exists('epcl_generate_custom_styles') ) return;

function epcl_generate_custom_styles(){
    $epcl_theme = epcl_get_theme_options();

    $css = '';

    if( empty($epcl_theme) ) return;

    $red = $primary_color = '#E84E89';
    $yellow = $secondary_color = '#00BEC1';
    $text_color = '#333333';
    $border_color = '#f4f4f4';
    $black = '#222222';
    $white = '#ffffff';

    /* @group General Settings */

    if( $epcl_theme['background_type'] == 1 && $epcl_theme['bg_body_pattern']['url'] )
        $css .= 'body:before{ background: url('.$epcl_theme['bg_body_pattern']['url'].') repeat; }';

    if( $epcl_theme['background_type'] == 2  && $epcl_theme['bg_body_color'] != '')
        $css .= 'body:before{ background: '.$epcl_theme['bg_body_color'].'; }';

    if( $epcl_theme['background_type'] == 3 && $epcl_theme['bg_body_full']['url'] )
        $css = 'body:before{ background: url('.$epcl_theme['bg_body_full']['url'].') no-repeat top center !important; }';

    if( $epcl_theme['background_type'] == 4 && $epcl_theme['bg_body_gradient'] )
        $css = 'body:before{
            background: -webkit-linear-gradient(0deg, '.$epcl_theme['bg_body_gradient']['from'].' 30%, '.$epcl_theme['bg_body_gradient']['to'].' 100%);
            background: linear-gradient(90deg, '.$epcl_theme['bg_body_gradient']['from'].' 30%, '.$epcl_theme['bg_body_gradient']['to'].' 100%);
        }';

    // Logo with icons
    if( $epcl_theme['logo_type'] == 2){

        $css .= '#header .logo a, #header a.sticky-logo{ 
            color: '.$epcl_theme['logo_text_color'].'; }';

        $css .= '#header .logo a i.fa, #footer .logo a i.fa{ 
            color: '.$epcl_theme['logo_icon_color'].'; }';

    }

    // Primary Color
    if( $epcl_theme['primary_color'] != $primary_color ){
        
        if( strpos($epcl_theme['primary_color'], 'rgb') > -1 ){
            $color = new Color( epcl_rgb2hex($epcl_theme['primary_color']) );
        }else{
            $color = new Color( $epcl_theme['primary_color'] );
        }        

        $css .= '

        #header nav ul.sub-menu li.current-menu-item a, .author-meta .meta-info i, .author-meta a.meta-info:hover, div.meta .remixicon, div.meta a:hover, div.epcl-share a, .author-meta a.author:hover,
        .widget_archive>ul>li:before, .widget_categories>ul>li:before, .widget_recent_comments>ul>li:before, .widget_recent_entries>ul>li:before, .widget_rss>ul>li:before,
        
        .author-meta a, .pagination div.nav a, div.text a:not([class]), .pagination div.nav a, section.widget_epcl_tweets p a, #single #comments nav.pagination a:hover, section.widget_epcl_tweets p a, div.text .wp-block-categories li span, div.text .wp-block-categories li a:hover, div.text .wp-block-archives li span, div.text .wp-block-archives li a:hover, div.text .wp-block-archives li a:hover, div.text .wp-block-categories li a:hover, div.text .wp-block-latest-posts li a:hover{ 
            color: '.$epcl_theme['primary_color'].'; }';

        $css .= '#single .share-buttons .permalink .copy svg{ 
            fill: '.$epcl_theme['primary_color'].'; }';

        $css .= '
        .button, .epcl-button.red, div.tags a, div.tags span, .epcl-pagination div.nav a, #single .share-buttons .epcl-button,
        .widget_archive ul li span, .widget_categories ul li span, .widget_tag_cloud a, .widget_tag_cloud span, .widget_epcl_tag_cloud a, .widget_epcl_tag_cloud span, #single #comments.hosted nav.pagination a,
        div.text .wp-block-archives li:not(.option) span, div.text .wp-block-categories li:not(.option) span, div.text .wp-block-latest-posts li:not(.option) span,
        
        button, input[type=submit]:hover, .widget .nice-select:hover, .nice-select.open, .widget .nice-select:focus, input[type=submit], #single section.related article .button, .slick-arrow, .slick-arrow:hover, .widget .nice-select{ 
            background-color: '.$epcl_theme['primary_color'].'; }';

        $css .= 'select.custom-select, #single #comments .comment .outline.comment-reply-link, .button.outline, .pagination div.nav a, input[type=submit], .button, .widget .nice-select, .widget .nice-select:hover, input[type=submit]:hover, .pagination div.nav a:hover, div.epcl-download a, div.epcl-download a:hover, .widget .nice-select:focus{ 
            border-color: '.$epcl_theme['primary_color'].'; }';

    }

    // Secondary Color
    if( $epcl_theme['secondary_color'] != $secondary_color ){

        $css .= 'a:hover{ 
            color: '.$epcl_theme['secondary_color'].'; }';

        $css .= '
        .widget_epcl_about .social, form.search-form input.search-field, .epcl-button, div.text blockquote:before, .tag-description .icon, #single #comments.hosted nav.pagination a,
        
        .button:hover, div.text .wp-block-quote:before, div.text .wp-block-pullquote:after, div.text .wp-block-pullquote:before{ 
            background-color: '.$epcl_theme['secondary_color'].'; }';

        $css .= '
        .widget_epcl_about .avatar a, .tag-description .icon, #author div.avatar a, .wpcf7 label.bordered:after{ 
            border-color: '.$epcl_theme['secondary_color'].'; }';

    }

    // Third Color
    if( $epcl_theme['third_color'] != '#111111' ){

        $css .= 'a{ 
            color: '.$epcl_theme['third_color'].'; }';

        $css .= '.button.dark, div.tags a:hover, .widget_tag_cloud a:hover{ 
            background-color: '.$epcl_theme['third_color'].'; }';

        $css .= 'h1, h2, h3, h4, h5, h6{ 
            color: '.$epcl_theme['third_color'].'; }';

    }

    // Text Color
    if( $epcl_theme['text_color'] != $text_color ){

        if( strpos($epcl_theme['text_color'], 'rgb') > -1 ){
            $color = new Color( epcl_rgb2hex($epcl_theme['text_color']) );
        }else{
            $color = new Color( $epcl_theme['text_color'] );
        }   

        $css .= 'body, div.text, div.text .wp-block-archives li a, div.text .wp-block-categories li a, div.text .wp-block-latest-posts li a, .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta, .woocommerce .woocommerce-breadcrumb, .woocommerce .woocommerce-breadcrumb a{ 
            color: '.$epcl_theme['text_color'].'; }';

        $css .= '.widget_epcl_featured_category .item time, .widget_epcl_posts_thumbs .item time, .widget_epcl_related_articles .item time, .widget_recent_entries .post-date, section.widget_epcl_tweets p small{ 
            color: #'.$color->lighten('25').'; }';

        $css .= 'div.meta a.comments:hover{ 
            color: #'.$color->darken('20').'; }';

    }

    if( $epcl_theme['main_link_gradient']['from'] != $secondary_color || $epcl_theme['main_link_gradient']['to'] != $secondary_color ){
        $css .= '.gradient-effect a:not(.epcl-button){
            background-image: -webkit-gradient(linear, left top, right top, from('.$epcl_theme['main_link_gradient']['from'].'), to('.$epcl_theme['main_link_gradient']['to'].'));
            background-image: linear-gradient(to right, '.$epcl_theme['main_link_gradient']['from'].' 0%, '.$epcl_theme['main_link_gradient']['to'].' 100%);
            background-size: 0px 4px;
            background-repeat: no-repeat;
            background-position: left 87%;
        }
        ';
    }

    /* @end */

    /* @group Header Colors */

    if( $epcl_theme['header_bg_color'] != 'transparent' ){
        $css .= '#header{ 
            background-color: '.$epcl_theme['header_bg_color'].'; }';
    }

    if( $epcl_theme['header_sticky_bg_color'] != $white ){

        $css .= '#header.is-sticky div.menu-wrapper{ 
            background-color: '.$epcl_theme['header_sticky_bg_color'].'; }';
    }

    if( isset($epcl_theme['header_sticky_link_color']) && $epcl_theme['header_sticky_link_color'] != $text_color ){

        $css .= '#header.is-sticky div.menu-wrapper nav ul.menu>li>a:not(.epcl-button),
        #header.is-sticky div.menu-wrapper nav ul.menu>li.menu-item-has-children:after{ 
            color: '.$epcl_theme['header_sticky_link_color'].'; }';
    }

    // Header menu links
    if( isset($epcl_theme['header_menu_link_color']['regular']) && $epcl_theme['header_menu_link_color']['regular'] != $white ){

        $css .= '#header nav ul.menu > li > a:not(.epcl-button), #header nav ul.menu li.menu-item-has-children:after{ 
            color: '.$epcl_theme['header_menu_link_color']['regular'].'; }';
    }
    // Csf
    if( isset($epcl_theme['header_menu_link_color']['color']) && $epcl_theme['header_menu_link_color']['color'] != $white ){

        $css .= '#header nav ul.menu > li > a:not(.epcl-button), #header nav ul.menu li.menu-item-has-children:after{ 
            color: '.$epcl_theme['header_menu_link_color']['color'].'; }';
    }

    if( $epcl_theme['header_menu_link_color']['hover'] != $white ){

        $css .= '#header nav ul.menu > li > a:hover{ 
            color: '.$epcl_theme['header_menu_link_color']['hover'].'; }';
    }

    if( $epcl_theme['header_menu_link_color']['active'] != $white ){

        $css .= '#header nav ul.menu li.current-menu-ancestor>a, #header nav ul.menu li.current-menu-item>a{ 
            color: '.$epcl_theme['header_menu_link_color']['active'].'; }';
    }

    // Header submenu links
    if( isset($epcl_theme['header_submenu_link_color']['regular']) && $epcl_theme['header_submenu_link_color']['regular'] != $text_color ){

        $css .= '#header nav ul.sub-menu li a{ 
            color: '.$epcl_theme['header_submenu_link_color']['regular'].'; }
            @media screen and (max-width: 980px){ #header nav ul.menu>li>a, #header nav ul.menu li.menu-item-has-children:after{ color: '.$epcl_theme['header_submenu_link_color']['regular'].'; }}';
    }
    // CSF
    if( isset($epcl_theme['header_submenu_link_color']['color']) && $epcl_theme['header_submenu_link_color']['color'] != $text_color ){

        $css .= '#header nav ul.sub-menu li a{ 
            color: '.$epcl_theme['header_submenu_link_color']['color'].'; }
            @media screen and (max-width: 980px){ #header nav ul.menu>li>a, #header nav ul.menu li.menu-item-has-children:after{ color: '.$epcl_theme['header_submenu_link_color']['color'].'; }}';
    }

    if( $epcl_theme['header_submenu_link_color']['hover'] != $text_color ){

        $css .= '#header nav ul.sub-menu li a:hover{ 
            color: '.$epcl_theme['header_submenu_link_color']['hover'].'; }';
    }

    if( $epcl_theme['header_submenu_link_color']['active'] != $red ){
        $css .= '#header nav ul.sub-menu li.current-menu-item a{ 
            color: '.$epcl_theme['header_submenu_link_color']['active'].'; }';
    }

    if( $epcl_theme['header_submenu_bg_color'] != $white ){
        $css .= '#header nav ul.sub-menu{ 
            background: '.$epcl_theme['header_submenu_bg_color'].' !important; }';
        $css .= '@media screen and (max-width: 980px){ #header nav { 
            background: '.$epcl_theme['header_submenu_bg_color'].' !important; } }';
    }

    if( $epcl_theme['header_mobile_icon_color'] != $white && $epcl_theme['header_mobile_icon_color'] != '' ){
        $css .= '#header div.menu-mobile i, .epcl-search-button{ 
            color: '.$epcl_theme['header_mobile_icon_color'].'; }';
    }

    /* @end */

    /* @group Content Colors */

    if( isset($epcl_theme['selection_bg_color']) && $epcl_theme['selection_bg_color'] != $red ){
        $css .= '::selection{ background-color: '.$epcl_theme['selection_bg_color'].'; }';
    }
    if( isset($epcl_theme['selection_text_color']) && $epcl_theme['selection_text_color'] != $white ){
        $css .= '::selection{ color: '.$epcl_theme['selection_text_color'].'; }';
    }

    if( $epcl_theme['main_content_bg_color'] != $white ){
        $css .= '.pagination, div.epcl-share, .bg-white, div.left-content .main-article, div.articles article .article-wrapper, #sidebar .widget{ 
            background-color: '.$epcl_theme['main_content_bg_color'].'; }';
    }

    if( $epcl_theme['content_border_color'] != $border_color ){

        $css .= '.title.bordered:after{ 
            background: '.$epcl_theme['content_border_color'].'; }';

        $css .= '
        .author-meta, div.articles article.bgstyle .author-meta,

        div.articles article, .pagination, aside:before, div.left-content, aside .widget, #single .share-buttons, .section.bordered, .widget_archive ul>li, .widget_categories ul>li, .widget_meta ul>li, .widget_nav_menu ul>li, .widget_pages ul>li, .widget_recent_comments ul>li, .widget_recent_entries ul>li, .widget_rss ul>li, .widget_archive ul>li ul.children, .widget_archive ul>li ul.sub-menu, .widget_categories ul>li ul.children, .widget_categories ul>li ul.sub-menu, .widget_meta ul>li ul.children, .widget_meta ul>li ul.sub-menu, .widget_nav_menu ul>li ul.children, .widget_nav_menu ul>li ul.sub-menu, .widget_pages ul>li ul.children, .widget_pages ul>li ul.sub-menu, .widget_recent_comments ul>li ul.children, .widget_recent_comments ul>li ul.sub-menu, .widget_recent_entries ul>li ul.children, .widget_recent_entries ul>li ul.sub-menu, .widget_rss ul>li ul.children, .widget_rss ul>li ul.sub-menu, .widget_calendar table td{ 
            border-color: '.$epcl_theme['content_border_color'].'; }';
    }

    if( $epcl_theme['main_title_color'] != $black ){
        $css .= '.title, .title a, h1, h2, h3, h4, h5, h6, .epcl-shortcode.epcl-tabs ul.tab-links li a{ 
            color: '.$epcl_theme['main_title_color'].'; }';
    }

    /* @end */

    /* @group Buttons Colors */

    // Content links
    if( isset($epcl_theme['content_link_color']['regular']) && $epcl_theme['content_link_color']['regular'] != $text_color ){
        $css .= 'a, div.text a:not([class]), .widget a:not(.tag-cloud-link), section.widget_epcl_tweets p a, .author-meta a, .woocommerce table.shop_table td a{ 
            color: '.$epcl_theme['content_link_color']['regular'].'; }';
    }
    // CSF
    if( isset($epcl_theme['content_link_color']['color']) && $epcl_theme['content_link_color']['color'] != $text_color ){
        $css .= 'a, div.text a:not([class]), .widget a:not(.tag-cloud-link), section.widget_epcl_tweets p a, .author-meta a, .woocommerce table.shop_table td a{ 
            color: '.$epcl_theme['content_link_color']['color'].'; }';
    }

    if( $epcl_theme['content_link_color']['hover'] != $secondary_color ){
        $css .= 'a:hover, .widget a:not(.tag-cloud-link):hover, section.widget_epcl_tweets p a:hover, .author-meta a:hover, .gradient-effect a:hover{ 
            color: '.$epcl_theme['content_link_color']['hover'].'; }';
    }

    // Main button
    if( $epcl_theme['button_bg_color'] != $red ){
        $css .= '.epcl-button.red, input[type="submit"], .slick-arrow, .slick-arrow:hover, .epcl-pagination div.nav a{ 
            background-color: '.$epcl_theme['button_bg_color'].'; }';
        $css .= '.epcl-pagination div.nav a, .epcl-button.red:hover{ 
            border-color: '.$epcl_theme['button_bg_color'].'; }';
        $css .= '.epcl-pagination div.nav a:hover{ 
            border-color: '.$epcl_theme['button_bg_color'].'; 
            background-color: '.$epcl_theme['button_bg_color'].'; }';
    }
    if( $epcl_theme['button_text_color'] != $white ){
        $css .= '.epcl-button.red, input[type="submit"], .epcl-pagination div.nav a, .epcl-pagination div.nav a:hover{ 
            color: '.$epcl_theme['button_text_color'].' !important; }';
    }

    // Secondary button
    if( $epcl_theme['button_secondary_bg_color'] != $secondary_color ){
        $css .= '.epcl-button, #single #comments.hosted nav.pagination a{ 
            background-color: '.$epcl_theme['button_secondary_bg_color'].'; }';
    }
    if( $epcl_theme['button_secondary_text_color'] != $white ){
        $css .= '.epcl-button, #single #comments.hosted nav.pagination a{ 
            color: '.$epcl_theme['button_secondary_text_color'].'; }';
    }

    // Tag color
    if( isset($epcl_theme['tag_text_color']['regular']) && $epcl_theme['tag_text_color']['regular'] != $white ){
        $css .= '.widget_tag_cloud a, .widget_tag_cloud span, .widget_epcl_tag_cloud a, .widget_epcl_tag_cloud span, div.tags a, div.tags span{ 
            color: '.$epcl_theme['tag_text_color']['regular'].'; }';
    }
    if( isset($epcl_theme['tag_text_color']['color']) && $epcl_theme['tag_text_color']['color'] != $white ){
        $css .= '.widget_tag_cloud a, .widget_tag_cloud span, .widget_epcl_tag_cloud a, .widget_epcl_tag_cloud span, div.tags a, div.tags span{ 
            color: '.$epcl_theme['tag_text_color']['color'].'; }';
    }
    if( $epcl_theme['tag_text_color']['hover'] != $white ){
        $css .= '.widget_tag_cloud a:hover, div.tags a:hover{ 
            color: '.$epcl_theme['tag_text_color']['hover'].'; }';
    }
    if( isset($epcl_theme['tag_bg_color']['regular']) && $epcl_theme['tag_bg_color']['regular'] != $red ){
        $css .= '.widget_tag_cloud a, .widget_tag_cloud span, .widget_epcl_tag_cloud a, .widget_epcl_tag_cloud span, div.tags a, div.tags span, .woocommerce.widget_product_tag_cloud a{ 
            background-color: '.$epcl_theme['tag_bg_color']['regular'].'; }';
    }
    // CSF
    if( isset($epcl_theme['tag_bg_color']['color']) && $epcl_theme['tag_bg_color']['color'] != $red ){
        $css .= '.widget_tag_cloud a, .widget_tag_cloud span, .widget_epcl_tag_cloud a, .widget_epcl_tag_cloud span, div.tags a, div.tags span, .woocommerce.widget_product_tag_cloud a{ 
            background-color: '.$epcl_theme['tag_bg_color']['color'].'; }';
    }
    if( $epcl_theme['tag_bg_color']['hover'] != $red ){
        $css .= '.widget_tag_cloud a:hover, .widget_epcl_tag_cloud a:hover, div.tags a:hover, .woocommerce.widget_product_tag_cloud a:hover{ 
            background-color: '.$epcl_theme['tag_bg_color']['hover'].'; }';
    }

    /* @end */

    /* @group Author box Colors */

    if( isset($epcl_theme['author_bg_color']) && $epcl_theme['author_bg_color'] != 'rgba(0,0,0,0.15' ){
        $css .= '#author{ 
            background-color: '.$epcl_theme['author_bg_color'].'; }';
    }

    if( isset($epcl_theme['author_text_color']) && $epcl_theme['author_text_color'] != $white ){
        $css .= '#author{ 
            color: '.$epcl_theme['author_text_color'].'; }';
    }

    if( isset($epcl_theme['author_link_color']['color']) && $epcl_theme['author_link_color']['color'] != $white ){
        $css .= '#author div.social a, #author .author-name a{ 
            color: '.$epcl_theme['author_link_color']['color'].'; }';
    }
    if( isset($epcl_theme['author_link_color']['hover']) && $epcl_theme['author_link_color']['hover'] != $white ){
        $css .= '#author div.social a:hover, #author .author-name a:hover{ 
            color: '.$epcl_theme['author_link_color']['hover'].'; }';
    }

     /* @end */

    /* @group Sidebar Colors */

    if( $epcl_theme['sidebar_bg_color'] != $white ){
        $css .= '#sidebar .widget{ 
            background-color: '.$epcl_theme['sidebar_bg_color'].'; }';
    }

    if( $epcl_theme['sidebar_text_color'] != $text_color && strlen($epcl_theme['sidebar_text_color']) > 2){
        if( strpos($epcl_theme['sidebar_text_color'], 'rgb') > -1 ){
            $color = new Color( epcl_rgb2hex($epcl_theme['sidebar_text_color']) );
        }else{
            $color = new Color( $epcl_theme['sidebar_text_color'] );
        }
        $css .= '#sidebar{ 
            color: '.$epcl_theme['sidebar_text_color'].'; }';

        $css .= '#sidebar .widget_recent_entries .post-date, #sidebar section.widget_epcl_tweets p small,
        #sidebar .widget_epcl_featured_category .item time, #sidebar .widget_epcl_posts_thumbs .item time, #sidebar .widget_epcl_related_articles .item time{ 
            color: #'.$color->lighten('25').'; }';
    }

    if( isset($epcl_theme['sidebar_link_color']['regular']) && $epcl_theme['sidebar_link_color']['regular'] != $text_color ){
        $css .= '#sidebar .widget a:not(.tag-cloud-link){ 
            color: '.$epcl_theme['sidebar_link_color']['regular'].'; }';
    }
    // CSF
    if( isset($epcl_theme['sidebar_link_color']['color']) && $epcl_theme['sidebar_link_color']['color'] != $text_color ){
        $css .= '#sidebar .widget a:not(.tag-cloud-link){ 
            color: '.$epcl_theme['sidebar_link_color']['color'].'; }';
    }

    if( $epcl_theme['sidebar_link_color']['hover'] != $secondary_color ){
        $css .= '#sidebar .widget a:not(.tag-cloud-link):hover{ 
            color: '.$epcl_theme['sidebar_link_color']['hover'].'; }';
    }

    if( $epcl_theme['sidebar_title_color'] != $black ){
        $css .= '#sidebar .widget .widget-title{ 
            color: '.$epcl_theme['sidebar_title_color'].'; }';
    }
    if( $epcl_theme['sidebar_title_decoration_color'] != $border_color ){
        $css .= '#sidebar .widget .widget-title.bordered:after{ 
            background: '.$epcl_theme['sidebar_title_decoration_color'].'; }';
    }

    /* @end */

    /* @group Forms Colors */

    if( $epcl_theme['input_bg_color'] != '#f2f2f2' ){
        $css .= 'input[type=email], input[type=number], input[type=password], input[type=tel], input[type=text], input[type=url], textarea, .woocommerce .select2-container--default .select2-selection--single, select{ 
            background-color: '.$epcl_theme['input_bg_color'].'; }';
        $css .= 'input[type=email], input[type=number], input[type=password], input[type=tel], input[type=text], input[type=url], textarea, select{ 
            border-color: '.$epcl_theme['input_bg_color'].'; }';
        $css .= 'input[type=email]:focus, input[type=number]:focus, input[type=password]:focus, input[type=tel]:focus, input[type=text]:focus, input[type=url]:focus, textarea:focus, select:focus{ 
            border-color: '.$epcl_theme['input_bg_color'].'; }';
    }
    if( $epcl_theme['input_text_color'] != $text_color ){
        $css .= 'input[type=email], input[type=number], input[type=password], input[type=tel], input[type=text], input[type=url], textarea, .select2-container--default .select2-selection--single .select2-selection__rendered, select{ 
            color: '.$epcl_theme['input_text_color'].'; }';
        $css .= 'input[type=email]::-webkit-input-placeholder, input[type=number]::-webkit-input-placeholder, input[type=password]::-webkit-input-placeholder, input[type=tel]::-webkit-input-placeholder, input[type=text]::-webkit-input-placeholder, input[type=url]::-webkit-input-placeholder, textarea::-webkit-input-placeholder, select{ 
            color: '.$epcl_theme['input_text_color'].'; }';
        $css .= 'input[type=email]:-moz-placeholder, input[type=number]:-moz-placeholder, input[type=password]:-moz-placeholder, input[type=tel]:-moz-placeholder, input[type=text]:-moz-placeholder, input[type=url]:-moz-placeholder, textarea:-moz-placeholder, select{ 
            color: '.$epcl_theme['input_text_color'].'; }';
        $css .= 'input[type=email]::-moz-placeholder, input[type=number]::-moz-placeholder, input[type=password]::-moz-placeholder, input[type=tel]::-moz-placeholder, input[type=text]::-moz-placeholder, input[type=url]::-moz-placeholder, textarea::-moz-placeholder, select{ 
            color: '.$epcl_theme['input_text_color'].'; }';
        $css .= 'input[type=email]:-ms-input-placeholder, input[type=number]:-ms-input-placeholder, input[type=password]:-ms-input-placeholder, input[type=tel]:-ms-input-placeholder, input[type=text]:-ms-input-placeholder, input[type=url]:-ms-input-placeholder, textarea:-ms-input-placeholder, select{ 
            color: '.$epcl_theme['input_text_color'].'; }';
    }

    if( $epcl_theme['label_text_color'] != $text_color ){
        $css .= 'label{ 
            color: '.$epcl_theme['label_text_color'].'; }';
    }

    if( $epcl_theme['custom_select_bg_color'] != $red ){
        $css .= '.widget .nice-select{ 
            background-color: '.$epcl_theme['custom_select_bg_color'].' !important;
            border-color: '.$epcl_theme['custom_select_bg_color'].' !important; }';
    }
    if( $epcl_theme['custom_select_text_color'] != $white ){
        $css .= '.widget .nice-select{ 
            color: '.$epcl_theme['custom_select_text_color'].' !important; }';
        $css .= '.widget .nice-select:after{ 
            border-bottom-color: '.$epcl_theme['custom_select_text_color'].'; 
            border-right-color: '.$epcl_theme['custom_select_text_color'].'; }';
    }

    if( $epcl_theme['submit_bg_color'] != $red ){
        $css .= 'input[type=submit]{ 
            background-color: '.$epcl_theme['submit_bg_color'].'; }';
        // $css .= 'input[type=submit]:hover{
        //     border-color: '.$epcl_theme['submit_bg_color'].';
        //     color: '.$epcl_theme['submit_bg_color'].'; }';
    }
    if( $epcl_theme['submit_text_color'] != $white ){
        $css .= 'input[type=submit]{ 
            color: '.$epcl_theme['submit_text_color'].'; }';
    }

    /* @end */

    /* @group Footer Colors */

    if( $epcl_theme['footer_bg_color'] != 'transparent' ){
        $css .= '#footer .widgets{ 
            background-color: '.$epcl_theme['footer_bg_color'].'; }';
    }

    if( $epcl_theme['footer_text_color'] != '#ffffff' ){
        $css .= '#footer .widgets, #footer .widget_archive ul li span, #footer .widget_categories ul li span{ 
            color: '.$epcl_theme['footer_text_color'].'; }';
    }

    if( isset($epcl_theme['footer_link_color']['regular']) && $epcl_theme['footer_link_color']['regular'] != '#ffffff' ){
        $css .= '#footer .widgets a:not(.tag-cloud-link){ 
            color: '.$epcl_theme['footer_link_color']['regular'].'; }';
    }
    // CSF
    if( isset($epcl_theme['footer_link_color']['color']) && $epcl_theme['footer_link_color']['color'] != '#ffffff' ){
        $css .= '#footer .widgets a:not(.tag-cloud-link){ 
            color: '.$epcl_theme['footer_link_color']['color'].'; }';
    }

    if( $epcl_theme['footer_link_color']['hover'] != '#ffffff' ){
        $css .= '#footer .widgets a:not(.tag-cloud-link):hover{ 
            color: '.$epcl_theme['footer_link_color']['hover'].'; }';
    }

    if( $epcl_theme['footer_title_color'] != '#ffffff' ){
        $css .= '#footer .widget .widget-title, #footer .mobile-sidebar .widget .widget-title{ 
            color: '.$epcl_theme['footer_title_color'].'; }';
    }

    if( isset($epcl_theme['footer_title_decoration_color']) && $epcl_theme['footer_title_decoration_color'] != 'rgba(255,255,255,0.25)' ){
        $css .= '#footer .widget .widget-title.bordered:after, #footer .mobile-sidebar .widget .widget-title.bordered:after, #footer .widgets .title.bordered:after{ 
            background: '.$epcl_theme['footer_title_decoration_color'].'; }';
    }

    if( isset( $epcl_theme['footer_widget_border_color'] ) && $epcl_theme['footer_widget_border_color'] != 'rgba(255,255,255,0.25)' ){
        $css .= '#footer .widget_archive ul>li, #footer .widget_categories ul>li, #footer .widget_meta ul>li, #footer .widget_nav_menu ul>li, #footer .widget_pages ul>li, #footer .widget_recent_comments ul>li, #footer .widget_recent_entries ul>li, #footer .widget_rss ul>li, #footer .widget_archive ul>li ul.children, #footer .widget_archive ul>li ul.sub-menu, #footer .widget_categories ul>li ul.children, #footer .widget_categories ul>li ul.sub-menu, #footer .widget_meta ul>li ul.children, #footer .widget_meta ul>li ul.sub-menu, #footer .widget_nav_menu ul>li ul.children, #footer .widget_nav_menu ul>li ul.sub-menu, #footer .widget_pages ul>li ul.children, #footer .widget_pages ul>li ul.sub-menu, #footer .widget_recent_comments ul>li ul.children, #footer .widget_recent_comments ul>li ul.sub-menu, #footer .widget_recent_entries ul>li ul.children, #footer .widget_recent_entries ul>li ul.sub-menu, #footer .widget_rss ul>li ul.children, #footer .widget_rss ul>li ul.sub-menu, #footer .widget_calendar table td{ 
            border-color: '.$epcl_theme['footer_widget_border_color'].'; }';
    }

    if( $epcl_theme['footer_copyright_color'] != $white ){

        $css .= '#footer .published{ 
            color: '.$epcl_theme['footer_copyright_color'].'; }';
    }

    if( $epcl_theme['footer_copyright_link_color'] != $white ){

        $css .= '#footer .published a{ 
            color: '.$epcl_theme['footer_copyright_link_color'].'; }';
    }

    // /* @end */

    /* @group Typography */

    // Regular Text
    if( $epcl_theme['body_font']['font-family'] && $epcl_theme['body_font']['font-family'] != 'Poppins')
        $css .= 'body, .epcl-button, .pagination div.nav a, .pagination div.nav>span, div.epcl-download a, input[type=text], input[type=password], input[type=email], input[type=tel], input[type=submit], input[type=url], textarea, select, select.custom-select, button, label, .wpcf7 label, #header nav ul.sub-menu li a, .nice-select .list li, .woocommerce button.button, .woocommerce a.button{ font-family: '.$epcl_theme['body_font']['font-family'].'; }';

    if( $epcl_theme['body_font']['font-weight'] && $epcl_theme['body_font']['font-weight'] != '400' )
        $css .= 'body, input[type=text], input[type=password], input[type=email], input[type=tel], input[type=submit], input[type=url], textarea, select, select.custom-select, button, label, .wpcf7 label{ font-weight: '.$epcl_theme['body_font']['font-weight'].'; }';

    if($epcl_theme['body_font']['font-size'] != 'px' && $epcl_theme['body_font']['font-size'] != '15px')
        $css .= 'body{ font-size: '.$epcl_theme['body_font']['font-size'].'; }';
    // CSF
    if( class_exists('CSF') && $epcl_theme['body_font']['font-size'] != '' && $epcl_theme['body_font']['font-size'] != '15')
        $css .= 'body{ font-size: '.$epcl_theme['body_font']['font-size'].'; }';

    // Primary Titles
    if( $epcl_theme['primary_titles_font']['font-family'] && $epcl_theme['primary_titles_font']['font-family'] != 'Montserrat' )
        $css .= '.title, div.text h1, div.text h2, div.text h3, div.text h4, div.text h5, div.text h6, #header nav ul.menu > li > a, input[type=submit], #single #comments.hosted nav.pagination a, .epcl-button{ font-family: '.$epcl_theme['primary_titles_font']['font-family'].'; }';

    if( $epcl_theme['primary_titles_font']['font-weight'] )
        $css .= '.title, div.text h1, div.text h2, div.text h3, div.text h4, div.text h5, div.text h6, input[type=submit], #single #comments.hosted nav.pagination a, .epcl-button{ font-weight: '.$epcl_theme['primary_titles_font']['font-weight'].'; }';

    // Sidebar Titles
    if( $epcl_theme['sidebar_titles_font']['font-family'] && $epcl_theme['sidebar_titles_font']['font-family'] != 'Roboto' )
        $css .= 'aside .widget .widget-title, aside .title, .widget_rss a, aside .nice-select{ font-family: '.$epcl_theme['sidebar_titles_font']['font-family'].'; }';

    // Sidebar regular text
    if( $epcl_theme['sidebar_font']['font-family'] && $epcl_theme['sidebar_font']['font-family'] != 'Poppins' )
        $css .= 'aside .widget, aside .nice-select li{ font-family: '.$epcl_theme['sidebar_font']['font-family'].'; }';

    // Footer Titles
    if( $epcl_theme['footer_titles_font']['font-family'] && $epcl_theme['footer_titles_font']['font-family'] != 'Roboto' )
        $css .= '#footer .widget .widget-title, #footer .title,  #footer .widget_rss a, #footer .nice-select{ font-family: '.$epcl_theme['footer_titles_font']['font-family'].'; }';

    // Footer regular text
    if( $epcl_theme['footer_font']['font-family'] && $epcl_theme['footer_font']['font-family'] != 'Poppins' )
        $css .= '#footer .widget, #footer .nice-select li{ font-family: '.$epcl_theme['footer_font']['font-family'].'; }';

    // Blog single text
    if($epcl_theme['editor_font_size'] != '17')
        $css .= 'div.text{ font-size: '.$epcl_theme['editor_font_size'].'px; }';

    if($epcl_theme['h1_font_size'] != '34')
        $css .= 'div.text h1{ font-size: '.$epcl_theme['h1_font_size'].'px; }';

    if($epcl_theme['h2_font_size'] != '28')
        $css .= 'div.text h2{ font-size: '.$epcl_theme['h2_font_size'].'px; }';

    if($epcl_theme['h3_font_size'] != '24')
        $css .= 'div.text h3{ font-size: '.$epcl_theme['h3_font_size'].'px; }';

    if($epcl_theme['h4_font_size'] != '18')
        $css .= 'div.text h4{ font-size: '.$epcl_theme['h4_font_size'].'px; }';

    if($epcl_theme['h5_font_size'] != '16')
        $css .= 'div.text h5{ font-size: '.$epcl_theme['h5_font_size'].'px; }';

    if($epcl_theme['h6_font_size'] != '14')
        $css .= 'div.text h6{ font-size: '.$epcl_theme['h6_font_size'].'px; }';

    // Mobile Font Sizes
    if(isset($epcl_theme['mobile_body_font_size']) && $epcl_theme['mobile_body_font_size'] != '13')
        $css .= '@media screen and (max-width: 767px){ body{ font-size: '.$epcl_theme['mobile_body_font_size'].'px; } }';

    if(isset($epcl_theme['mobile_single_font_size']) && $epcl_theme['mobile_single_font_size'] != '14')
        $css .= '@media screen and (max-width: 767px){ div.text{ font-size: '.$epcl_theme['mobile_single_font_size'].'px; } }';

    /* @end */

    // Enable Scroll on Sub Menus
    if( $epcl_theme['enable_scroll_submenu'] === '1' ){
        $css .= '#header nav ul.sub-menu{ max-height: 50vh; overflow-y: auto; overflow-x: hidden; }';
    }

    /* @group Categories Color */

    if( function_exists('get_fields') ){
        $categories = get_categories();
        foreach( $categories as $c ){
            $fields = get_fields( $c );
            if( !empty($fields) ){
                if( isset($fields['bg_color']) && $fields['bg_color'] != '' ){
                    $css .=
                        'div.tags a.tag-link-'.$c->term_id.', #sidebar .tagcloud a.tag-link-'.$c->term_id.', #footer .tagcloud a.tag-link-'.$c->term_id.'{ background-color: '.$fields['bg_color'].'; }';
                }
                if( isset($fields['text_color']) && $fields['text_color'] != '' ){
                    $css .= '
                    div.tags a.tag-link-'.$c->term_id.', #sidebar .tagcloud a.tag-link-'.$c->term_id.', #footer .tagcloud a.tag-link-'.$c->term_id.', #footer .tagcloud a.tag-link-'.$c->term_id.':hover{ color: '.$fields['text_color'].'; }';
                }
            }
        }
    }

    /* @end */

    // Disable categories globally
    if( isset($epcl_theme['enable_global_category']) && $epcl_theme['enable_global_category'] === '0' ){
        $css .= 'div.tags{ display: none !important; }';
    }

    // Disable date globally
    if( isset($epcl_theme['enable_global_date']) && $epcl_theme['enable_global_date'] === '0' ){
        $css .= 'time{ display: none !important; }';
    }

    // Disable comments globally
    if( isset($epcl_theme['enable_global_comments']) && $epcl_theme['enable_global_comments'] === '0' ){
        $css .= 'div.meta a.comments{ display: none !important; }';
    }

    // Disable featured image globally
    if( isset($epcl_theme['enable_featured_image']) && $epcl_theme['enable_featured_image'] === '0' ){
        $css .= '#single.standard .featured-image{ display: none !important; }';
    }

    /* @group AMP CSS */

    if( epcl_is_amp() ){
        if( $epcl_theme['amp_body_font']['font-family'] && $epcl_theme['amp_body_font']['font-family'] != 'Poppins')
        $css .= 'body, .epcl-button, .pagination div.nav a, .pagination div.nav>span, div.epcl-download a, input[type=text], input[type=password], input[type=email], input[type=tel], input[type=submit], input[type=url], textarea, select, select.custom-select, button, label, .wpcf7 label, #header nav ul.sub-menu li a, .nice-select .list li, .woocommerce button.button, .woocommerce a.button{ font-family: '.$epcl_theme['amp_body_font']['font-family'].', Arial, Helvetica, sans-serif; }';

        if( $epcl_theme['amp_body_font']['font-weight'] && $epcl_theme['amp_body_font']['font-weight'] != '400' )
            $css .= 'body, input[type=text], input[type=password], input[type=email], input[type=tel], input[type=submit], input[type=url], textarea, select, select.custom-select, button, label, .wpcf7 label, div.text{ font-weight: '.$epcl_theme['amp_body_font']['font-weight'].'; }'; 

        if( $epcl_theme['amp_primary_titles_font']['font-family'] && $epcl_theme['amp_primary_titles_font']['font-family'] != 'Montserrat' )
            $css .= '.title, div.text h1, div.text h2, div.text h3, div.text h4, div.text h5, div.text h6, #header nav ul.menu > li > a, input[type=submit], #single #comments.hosted nav.pagination a, .epcl-button{ font-family: '.$epcl_theme['amp_primary_titles_font']['font-family'].', Arial, Helvetica, sans-serif; }';
    
        if( $epcl_theme['amp_primary_titles_font']['font-weight'] )
            $css .= '.title, div.text h1, div.text h2, div.text h3, div.text h4, div.text h5, div.text h6, input[type=submit], #single #comments.hosted nav.pagination a, .epcl-button{ font-weight: '.$epcl_theme['amp_primary_titles_font']['font-weight'].'; }';

    }


    /* @end */

    /* @group Advanced CSS */

    if( !empty($epcl_theme['css_code']) )
        $css .= $epcl_theme['css_code'];

    /* @end */

    if( !epcl_get_option('enable_desktop_animation', true) ){
        $css .= '[data-aos="fade-up"]:not(#single), [data-aos="fade"]:not(#single){ opacity: 1 !important; transform: none !important; }';
    }

    if( !epcl_get_option('enable_single_desktop_animation', false) ){
        $css .= '#single[data-aos="fade-up"],  #single[data-aos="fade"]{ opacity: 1 !important; transform: none !important; }';
    }


    $prefix = EPCL_THEMEPREFIX.'_';

    // $css = '';

    if($css)
        return $css;
}

function epcl_generate_gutenberg_custom_styles(){
    $epcl_theme = epcl_get_theme_options();
    $css = '';

    if( empty($epcl_theme) ) return;

    $red = $primary_color = '#E84E89';
    $yellow = $secondary_color = '#00BEC1';
    $text_color = '#333333';
    $border_color = '#f4f4f4';
    $black = '#222222';
    $white = '#ffffff';

    /* @group General Settings */


    // Primary Color
    if( $epcl_theme['primary_color'] != $primary_color ){

        $css .= '.editor-styles-wrapper .editor-block-list__layout a:not([class]), .editor-styles-wrapper div.text a:not([class]){ 
            color: '.$epcl_theme['primary_color'].' !important; }';

        $css .= '.editor-block-list__layout .wp-block-categories li a, .editor-styles-wrapper .editor-block-list__layout .wp-block-archives li a, .editor-styles-wrapper .editor-block-list__layout .wp-block-categories li a{ 
            color: #191e23 !important; }';

        $css .= '.editor-block-list__layout .wp-block-categories li span, .editor-styles-wrapper .editor-block-list__layout .wp-block-archives li span{
            background-color: '.$epcl_theme['primary_color'].' !important; }';
    }

    // Secondary Color
    if( $epcl_theme['secondary_color'] != $secondary_color ){

        $css .= '.editor-styles-wrapper .editor-block-list__layout .wp-block-quote:before, .editor-styles-wrapper div.text .wp-block-quote:before, .editor-styles-wrapper .editor-block-list__layout .wp-block-pullquote:after, .editor-styles-wrapper .editor-block-list__layout .wp-block-pullquote:before, .editor-styles-wrapper .editor-post-title__block:after{ 
            background-color: '.$epcl_theme['secondary_color'].' !important; }';

    }

    /* @end */

    /* @group Typography */

    // Regular Text
    if( $epcl_theme['body_font']['font-family'] && $epcl_theme['body_font']['font-family'] != 'Poppins')
        $css .= '.editor-block-list__layout{ font-family: '.$epcl_theme['body_font']['font-family'].' !important; }';

    if( $epcl_theme['body_font']['font-weight'] && $epcl_theme['body_font']['font-weight'] != '400' )
        $css .= '.editor-block-list__layout{ font-weight: '.$epcl_theme['body_font']['font-weight'].' !important; }';

    // Primary Titles
    if( $epcl_theme['primary_titles_font']['font-family'] && $epcl_theme['primary_titles_font']['font-family'] != 'Roboto' )
        $css .= '.editor-block-list__layout h1,.editor-block-list__layout h2, .editor-block-list__layout h3, .editor-block-list__layout h4, .editor-block-list__layout h5, .editor-block-list__layout h6, .editor-post-title__block .editor-post-title__input{ font-family: '.$epcl_theme['primary_titles_font']['font-family'].' !important; }';

    if( $epcl_theme['primary_titles_font']['font-weight'] )
        $css .= '.editor-block-list__layout h1, .editor-block-list__layout h2, .editor-block-list__layout h3, .editor-block-list__layout h4, .editor-block-list__layout h5, .editor-block-list__layout h6{ font-weight: '.$epcl_theme['primary_titles_font']['font-weight'].' !important; }';

    // Blog single text
    if($epcl_theme['editor_font_size'] != '17')
        $css .= '.editor-styles-wrapper .editor-block-list__layout{ font-size: '.$epcl_theme['editor_font_size'].'px !important; }';

    if($epcl_theme['h1_font_size'] != '34')
        $css .= '.editor-block-list__layout h1{ font-size: '.$epcl_theme['h1_font_size'].'px; }';

    if($epcl_theme['h2_font_size'] != '28')
        $css .= '.editor-styles-wrapper .editor-block-list__layout h2{ font-size: '.$epcl_theme['h2_font_size'].'px !important; }';

    if($epcl_theme['h3_font_size'] != '24')
        $css .= '.editor-styles-wrapper .editor-block-list__layouth3{ font-size: '.$epcl_theme['h3_font_size'].'px !important; }';

    if($epcl_theme['h4_font_size'] != '18')
        $css .= '.editor-styles-wrapper .editor-block-list__layout h4{ font-size: '.$epcl_theme['h4_font_size'].'px !important; }';

    if($epcl_theme['h5_font_size'] != '16')
        $css .= '.editor-styles-wrapper .editor-block-list__layout h5{ font-size: '.$epcl_theme['h5_font_size'].'px !important; }';

    if($epcl_theme['h6_font_size'] != '14')
        $css .= '.editor-styles-wrapper .editor-block-list__layout h6{ font-size: '.$epcl_theme['h6_font_size'].'px !important; }';

    /* @end */

    $prefix = EPCL_THEMEPREFIX.'_';

    if($css)
        return $css;
}


if ( ! function_exists( 'epcl_hex2rgba' ) ) {

    function epcl_hex2rgba($color, $opacity = false){
        $default = 'rgb(0,0,0)';
        if(empty($color))
            return $default;
        if($color[0] == '#'){
            $color = substr($color, 1);
        }
        if(strlen($color) == 6){
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        }elseif(strlen($color) == 3){
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }
        $rgb =  array_map('hexdec', $hex);
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        }else{
            $output = 'rgb('.implode(",",$rgb).')';
        }
        return $output;
    }
}

function epcl_rgb2hex( $color ){
    if( strpos($color, 'rgb') < 0 ){
        return $color;
    }
    $color_array = explode(",", $color, 3);
    return sprintf( "#%02x%02x%02x", $color_array[0], $color_array[1], $color_array[2] );
}