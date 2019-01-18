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
    <!-- MAIN MENU -->
    <div id="cv-menu">
        <nav id="cv-main-menu">
            <ul>
                <?php $hidesidebar = get_option('divergent_hidesidebar'); ?>
                <?php $hometitle = get_option('divergent_hometitle'); ?>
                <?php $menuicon = get_option('divergent_menuicon'); ?>
                <?php $homeicon = get_option('divergent_homeicon'); ?>
                <?php 
$menuargs = array(
    'post_type' => 'dvsections',
    'posts_per_page' => 99
);
$menu_query = new WP_Query( $menuargs );
                ?>
                <?php if ($hidesidebar != "true") { ?>
                <li class="cv-menu-icon"><a href="#" class="cv-menu-button fa <?php if (!empty($menuicon)) { echo esc_attr($menuicon); } else { echo esc_attr('fa-bars'); } ?>"><?php echo esc_attr__('Menu', 'divergent'); ?></a>
                </li>
                <?php } ?>
                <?php if ( function_exists( 'divergent_slug' ) ) { ?>
                <?php
if (function_exists( 'icl_get_home_url' )) {
    $homeurl = icl_get_home_url();
}
else {
    $homeurl = home_url( '/' );
}
                ?>
                <li><a href="<?php echo esc_attr($homeurl); ?>" class="fa <?php if (!empty($homeicon)) { echo esc_attr($homeicon); } else { echo esc_attr('fa-home'); } ?> tooltip-menu" title="<?php if (!empty($hometitle)) { echo esc_attr($hometitle); } else { echo esc_attr('HOME'); } ?>"><?php if (!empty($hometitle)) { echo esc_attr($hometitle); } else { echo esc_attr('HOME'); } ?></a>
                </li>
                <?php while($menu_query->have_posts()) : $menu_query->the_post(); ?>
                <?php $icon = get_fa($format = false, get_the_ID()); ?>
                <li><a href="<?php echo $homeurl; ?>#<?php echo divergent_slug(); ?>" class="fa <?php if (!empty($icon)) { echo esc_attr($icon); } else { echo esc_attr('fa-file'); } ?> tooltip-menu" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                </li>
                <?php endwhile; ?>
                <?php } ?>
                <?php wp_reset_postdata(); ?>
            </ul>
        </nav>
    </div>
    <div id="cv-page-left"></div>
    <div id="cv-page-right">