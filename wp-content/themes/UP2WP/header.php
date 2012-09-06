<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> xmlns:fb="http://www.facebook.com/2008/fbml">

    <head profile="http://gmpg.org/xfn/11">

        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

        <?php if (is_search()) { ?>
            <meta name="robots" content="noindex, nofollow" /> 
        <?php } ?>

        <title><?php
        if (function_exists('is_tag') && is_tag()) {
            single_tag_title("Taggarkiv för &quot;");
            echo '&quot; - ';
        } elseif (is_archive()) {
            wp_title('');
            echo ' Arkiv - ';
        } elseif (is_search()) {
            echo 'Sökning för &quot;' . wp_specialchars($s) . '&quot; - ';
        } elseif (!(is_404()) && (is_single()) || (is_page())) {
            wp_title('');
            echo ' - ';
        } elseif (is_404()) {
            echo 'Hittades inte - ';
        }
        if (is_home()) {
            bloginfo('name');
            echo ' - ';
            bloginfo('description');
        } else {
            bloginfo('name');
        }
        if ($paged > 1) {
            echo ' - sida ' . $paged;
        }
        ?></title>

        <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" type="image/x-icon" />
      <link href="https://plus.google.com/102493225939093732338/" rel="publisher" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
        <!--[if lte IE 8]>
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/ie.css" type="text/css" />
        <![endif]-->
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/nivo-slider.css" type="text/css" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <?php if (is_singular()) {
            wp_enqueue_script('comment-reply'); ?>

        <?php } else {
            
        } ?>
        <?php wp_head(); ?>
        <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.nivo.slider.pack.js"></script>
        <script type="text/javascript">
            jQuery(window).load(function() {
                jQuery('#slider').nivoSlider();
            });
        </script>
    </head>

    <body <?php body_class(); ?> onload="initialize();">
        <div id="container">
            <div id="container_bg">
                <div id="page-wrap">
                    <div id="header">
                        <div id="logo">
                            <?php if (is_front_page()) { ?>
                                <div id="lfp">
                                <?php } else { ?> 
                                    <div id="lnfp">   
                                    <?php } ?> 
                                    <h1><a href="<?php echo get_option('home'); ?>/"><img src="<?php echo get_bloginfo('template_url') ?>/images/logo.png" width="174px" height="144px" alt="Ung Pirat" /></a></h1>
                                </div>
                            </div>
                            <div id="nav">
                                <?php wp_nav_menu(); ?>
                            </div>
                        </div>
                        <div id="content_wrapper" class="upbox group">
                            <div id="header_img">
                            </div>