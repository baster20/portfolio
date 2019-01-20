<?php
/**
 * Plugin Name: Divergent Features
 * Plugin URI: http://themeforest.net/user/egemenerd/portfolio?ref=egemenerd
 * Description: Divergent custom post types, widgets, shortcodes
 * Version: 1.7
 * Author: Egemenerd
 * Author URI: http://themeforest.net/user/egemenerd?ref=egemenerd
 * License: http://themeforest.net/licenses?ref=egemenerd
 */

/* Language File */

add_action( 'init', 'divergentcptdomain' );

function divergentcptdomain() {
    load_plugin_textdomain( 'divergentcpt', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/* Register Scripts */

function divergentcpt_scripts(){
    $divergentapikey = get_option('divergent_apikey');
    wp_enqueue_style('divergentcpt_styles', plugin_dir_url( __FILE__ ) . 'css/style.css', true, '1.0');
    wp_enqueue_style('dv_lightgallery_style', plugin_dir_url( __FILE__ ) . 'css/lightgallery.css', true, '1.0');  
    if (( is_page_template('homepage.php') ) || ( is_page_template('pagewithslider.php'))) { 
        wp_enqueue_style('divergent_nerveslider_styles', plugin_dir_url( __FILE__ ) . 'css/nerveslider.css', true, '1.0');
        wp_register_script('divergentcpt_nerveslider',plugin_dir_url( __FILE__ ).'js/nerveslider.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-draggable');
        wp_enqueue_script('jquery-ui-droppable');
        wp_enqueue_script('jquery-effects-core');
        wp_enqueue_script('divergentcpt_nerveslider');
    }
    if ( is_page_template('homepage.php') ) {
        wp_register_script('divergentcpt_ascensor',plugin_dir_url( __FILE__ ).'js/ascensor.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script('divergentcpt_ascensor');
    }
    if ( is_page_template('pagewithvideo.php') ) {
        wp_enqueue_style('divergent_video_styles', plugin_dir_url( __FILE__ ) . 'css/youtube-player.css', true, '1.0');
        wp_register_script('divergentcpt_video',plugin_dir_url( __FILE__ ).'js/youtube-player.js', array( 'jquery' ), '1.0.0', true );
        wp_enqueue_script('divergentcpt_video');
    }
    wp_register_script('divergentcpt_map', '//maps.google.com/maps/api/js?key=' . $divergentapikey,'', null,false);
    wp_register_script('divergentcpt_dvmap',plugin_dir_url( __FILE__ ).'js/dvmap.js','','',true);
    
    wp_register_script('dv_wookmark',plugin_dir_url( __FILE__ ).'js/wookmark.js', array( 'jquery' ), '1.0.0', true );
    wp_register_script('divergentcpt_tabs',plugin_dir_url( __FILE__ ).'js/tabs.js', array( 'jquery' ), '1.0.0', true );
    wp_register_script('dv_lightgallery',plugin_dir_url( __FILE__ ).'js/lightgallery.js', array( 'jquery' ), '1.0.0', true );
    wp_register_script('divergent_accordion',plugin_dir_url( __FILE__ ).'js/accordion.js', array( 'jquery' ), '1.0.0', true );
    wp_register_script('divergent_quovolver',plugin_dir_url( __FILE__ ).'js/quovolver.js', array( 'jquery' ), '1.0.0', true );
    wp_register_script('divergent_flickr',plugin_dir_url( __FILE__ ).'js/flickr.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script('dv_wookmark');
    wp_enqueue_script('divergentcpt_tabs');
    wp_enqueue_script('dv_lightgallery');
    wp_enqueue_script('divergent_accordion');
    wp_enqueue_script('divergent_quovolver');
    wp_enqueue_script('divergent_flickr');
    if ( is_page_template('homepage.php') ) {
        wp_register_script('divergentcpt_custom',plugin_dir_url( __FILE__ ).'js/home-custom.js','','',true);
        wp_enqueue_script('divergentcpt_custom');
    }
}
add_action('wp_enqueue_scripts','divergentcpt_scripts', 99, 1);

/* Add Google Map Scripts Only When It Is Used */

function divergent_map_scripts() {
    wp_enqueue_script('divergentcpt_map');
    wp_enqueue_script('divergentcpt_dvmap');
}

function divergent_map_scripts_output($showmap) {
    if ($showmap == "on") {
        add_action('wp_footer','divergent_map_scripts');
    }
}

/* Admin Scripts */

function divergentshc_css() {
	wp_enqueue_style('divergentshc-adminstyle', plugins_url('css/admin.css', __FILE__));
    wp_enqueue_script('dv_panel_script', plugin_dir_url( __FILE__ ) . 'js/admin.js','','',true);
}

add_action('admin_enqueue_scripts', 'divergentshc_css');

/*---------------------------------------------------
Show/Hide some divergent custom post type fields
----------------------------------------------------*/
function divergent_posttype_admin_css() {
    global $post_type;
    $post_types = array(
        'dvgalleries',
        'dvtestimonials'
    );
    if(in_array($post_type, $post_types)) { ?>
<style type="text/css">
    #post-preview, #view-post-btn, .updated > p > a, #wp-admin-bar-view, #edit-slug-box{display: none !important;}
</style>
    <?php } if($post_type == 'dvsections') { ?>
<style type="text/css">
    #slugdiv{display: block !important;}
    #slugdiv input[type="text"] {width:100% !important;}
    #edit-slug-box{display: none !important;}
</style>
    <?php }
}
add_action( 'admin_head-post-new.php', 'divergent_posttype_admin_css' );
add_action( 'admin_head-post.php', 'divergent_posttype_admin_css' );

function divergent_row_actions( $actions )
{
    if((get_post_type() != 'dvgalleries') && (get_post_type() != 'dvtestimonials')){
        return $actions;
    }
    else {
        unset( $actions['view'] );
        return $actions;
    }
}
add_filter( 'post_row_actions', 'divergent_row_actions', 10, 1 );

/* ---------------------------------------------------------
Get the post slug
----------------------------------------------------------- */

function divergent_slug($postID="") {
    global $post;
	$postID = ( $postID != "" ) ? $postID : $post->ID;
	$post_data = get_post($postID, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug;
}

/* ---------------------------------------------------------
Add slider images field to the pages
----------------------------------------------------------- */

function divergent_galleryimages( $meta_boxes ) {
    $prefix = 'divergent'; // Prefix for all fields
    $meta_boxes['divergent_galleryimg'] = array(
        'id' => 'divergent_galleryimg',
        'title' => esc_attr__( 'Slider Images', 'divergentcpt'),
        'object_types' => array('page'), // post type
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => esc_attr__( 'Activate Autoplay', 'divergentcpt'),
                'desc' => esc_attr__( 'To activate autoplay, check this box.', 'divergentcpt'),
                'id' => $prefix . 'activateauto',
                'type' => 'checkbox'
            ),
            array(
                'name' => esc_attr__( 'Autoplay duration:', 'divergentcpt'),
                'id' => $prefix . 'autoplaypause',
                'desc' => esc_attr__( 'The time (in seconds) between each auto transition', 'divergentcpt'),
                'type' => 'select',
                'options' => array(
                    '4' => esc_attr__( '4 Seconds', 'divergentcpt' ),
                    '2' => esc_attr__( '2 Seconds', 'divergentcpt' ),
                    '3' => esc_attr__( '3 Seconds', 'divergentcpt' ),
                    '5' => esc_attr__( '5 Seconds', 'divergentcpt' ),
                    '6' => esc_attr__( '6 Seconds', 'divergentcpt' ),
                    '7' => esc_attr__( '7 Seconds', 'divergentcpt' ),
                    '8' => esc_attr__( '8 Seconds', 'divergentcpt' ),
                    '9' => esc_attr__( '9 Seconds', 'divergentcpt' ),
                    '10' => esc_attr__( '10 Seconds', 'divergentcpt' ),
                    '11' => esc_attr__( '11 Seconds', 'divergentcpt' ),
                    '12' => esc_attr__( '12 Seconds', 'divergentcpt' ),
                    '13' => esc_attr__( '13 Seconds', 'divergentcpt' ),
                    '14' => esc_attr__( '14 Seconds', 'divergentcpt' ),
                    '15' => esc_attr__( '15 Seconds', 'divergentcpt' ),
                ),
            ),
            array(
                'id' => $prefix . 'galleryimages',
                'name' => esc_attr__( 'Images:', 'divergentcpt'),
                'desc' => esc_attr__( 'You can make a multiselection with CTRL + click', 'divergentcpt'),
                'type' => 'file_list',
                'preview_size' => array( 100, 100 )
            ),
            array(
                'id' => $prefix . 'mobilegalleryimages',
                'name' => esc_attr__( 'Images for Mobile Devices:', 'divergentcpt'),
                'desc' => esc_attr__( 'You can make a multiselection with CTRL + click', 'divergentcpt'),
                'type' => 'file_list',
                'preview_size' => array( 100, 100 )
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'divergent_galleryimages' );

/* ---------------------------------------------------------
Add video field to the pages
----------------------------------------------------------- */

function divergent_video( $meta_boxes ) {
    $prefix = 'divergent'; // Prefix for all fields
    $meta_boxes['divergent_videourl'] = array(
        'id' => 'divergent_videourl',
        'title' => esc_attr__( 'You Tube Video', 'divergentcpt'),
        'object_types' => array('page'), // post type
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => esc_attr__( 'Video ID', 'divergentcpt'),
                'desc' => esc_attr__( 'YouTube have the video id directly in the url. For example; keDneypw3HY', 'divergentcpt'),
                'id' => $prefix . 'videoid',
                'type' => 'text'
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'divergent_video' );

/*---------------------------------------------------
Add id column to admin post category view
----------------------------------------------------*/
foreach ( get_taxonomies() as $taxonomy ) {
    add_action( "manage_edit-${taxonomy}_columns",          'divergentcat_add_col' );
    add_filter( "manage_edit-${taxonomy}_sortable_columns", 'divergentcat_add_col' );
    add_filter( "manage_${taxonomy}_custom_column",         'divergentcat_show_id', 10, 3 );
}

function divergentcat_add_col( $columns )
{
    return $columns + array ( 'cat_id' => 'ID' );
}
function divergentcat_show_id( $v, $name, $id )
{    
    return 'cat_id' === $name ? $id : $v;
}

/*---------------------------------------------------
Tinymce custom button
----------------------------------------------------*/

if ( ! function_exists( 'divergentshortcodes_add_button' ) ) {
add_action('init', 'divergentshortcodes_add_button');  
function divergentshortcodes_add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'divergent_add_plugin', 99);  
     add_filter('mce_buttons', 'divergent_register_button', 99);  
   }  
} 
}

if ( ! function_exists( 'divergent_register_button' ) ) {
function divergent_register_button($buttons) {
    array_push($buttons, "divergent_mce_button");
    return $buttons;  
}  
}

if ( ! function_exists( 'divergent_add_plugin' ) ) {
function divergent_add_plugin($plugin_array) {
    $plugin_array['divergent_mce_button'] = plugin_dir_url( __FILE__ ) . 'js/shortcodes.js';
    return $plugin_array;  
}
}

/* ---------------------------------------------------------
Custom Metaboxes - https://github.com/WebDevStudios/CMB2
----------------------------------------------------------- */

// Check for PHP version and use the correct one
$divergentdir = ( version_compare( PHP_VERSION, '5.3.0' ) >= 0 ) ? __DIR__ : dirname( __FILE__ );

if ( file_exists(  $divergentdir . '/cmb2/init.php' ) ) {
	require_once  $divergentdir . '/cmb2/init.php';
} elseif ( file_exists(  $divergentdir . '/CMB2/init.php' ) ) {
	require_once  $divergentdir . '/CMB2/init.php';
}

/* Include Plugins */
if ( file_exists(  $divergentdir . '/plugins/font-awesome-field.php' ) ) {
    include_once( $divergentdir . '/plugins/font-awesome-field.php');
}
if ( file_exists(  $divergentdir . '/plugins/font-awesome-field.php' ) ) {
    include_once($divergentdir . '/plugins/divergent-social.php');
}

/* Include gallery files */

include($divergentdir . '/cpt/dv-gallery/gallery_cpt.php');
include($divergentdir . '/cpt/dv-gallery/dv-shortcodes.php');
include($divergentdir . '/cpt/dv-gallery/dv-widgets.php');

/* Include Other Required Files */

include($divergentdir . '/cpt/sections_cpt.php');
include($divergentdir . '/cpt/testimonials_cpt.php');
include('divergent-shortcodes.php');
include('divergent-widgets.php');

/* Templates */

function divergent_homepage_template(){
    include('homepage.php');
}
function divergent_homepage_nav_template(){
    include('homepage-nav.php');
}
function divergent_page_slider_template(){
    include('page-slider.php');
}
function divergent_page_video_template(){
    include('page-video.php');
}
?>