<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">    
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<!-- NOSCRIPT -->
    <noscript>
        <link href="<?php echo get_template_directory_uri(); ?>/css/nojs.css" rel="stylesheet" type="text/css">
    </noscript> 
<?php
// Allow only correct Google web font tags
$divergentfirstfontlink = wp_kses(get_option('divergent_fontheadinglink'), array('link' => array('href' => array(),'rel' => array(),'type' => array())));
$divergentsecondfontlink = wp_kses(get_option('divergent_fontlink'), array('link' => array('href' => array(),'rel' => array(),'type' => array())));

if (!empty($divergentfirstfontlink)) { echo str_replace("&amp;", '&', $divergentfirstfontlink); }  
if (!empty($divergentsecondfontlink)) { echo str_replace("&amp;", '&', $divergentsecondfontlink); }
?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php $enable_cssloader = get_option('divergent_enable_cssloader'); ?>
    <!-- LOADING ANIMATION -->
    <?php if ($enable_cssloader != "true") { ?>
    <div id="site-loading" style="block;"></div>
    <?php } else { ?>
    <div id="site-loading-css" style="block;">
        <div id="site-loader">
            <div id="site-loader-block">
                <div id="site-loader-box"></div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if ( function_exists( 'divergent_homepage_nav_template') ) { ?>
    <?php divergent_homepage_nav_template(); ?>
    <?php } ?>