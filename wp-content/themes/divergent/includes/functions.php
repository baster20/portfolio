<?php
if ( !defined('ABSPATH')) exit;

add_theme_support( 'menus' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );

load_theme_textdomain( 'divergent', get_template_directory() .'/languages' );
$divergentlocale = get_locale();
$divergentlocale_file = get_template_directory() ."/languages/$divergentlocale.php";
if ( is_readable($divergentlocale_file) ) {
	require_once($divergentlocale_file);
}

if ( ! isset( $content_width ) ) {
    $content_width = 1400; 
}
if ( is_singular() ) {
    wp_enqueue_script( "comment-reply" );
}

/*---------------------------------------------------
Wrap category widget post count in a span
----------------------------------------------------*/
if ( ! function_exists( 'divergent_cat_count_span' ) ) {
function divergent_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>', $links);
  $links = str_replace(')', '</span>', $links);
  return $links;
}
}
add_filter('wp_list_categories', 'divergent_cat_count_span');

/*---------------------------------------------------
Ecwid Custom Styles
----------------------------------------------------*/

if (get_option('divergent_ecwidstyle') == "true") {
function divergent_ecwid_styles()  
{ 
    wp_register_style( 'divergent-ecwid-style', get_template_directory_uri() . '/includes/css/ecwid.css', false, '1.0');
    wp_enqueue_style( 'divergent-ecwid-style' );
}
add_action('wp_enqueue_scripts', 'divergent_ecwid_styles');
include ( get_template_directory() . '/includes/ecwid_css.php' );
}

/*---------------------------------------------------
Remove Ecwid Button from Sections
----------------------------------------------------*/
function divergentecwid_posttype_admin_css() {
    global $post_type;
    $post_types = array(
        'dvsections'
    );
    if(in_array($post_type, $post_types)) { ?>
    <style type="text/css">#insert-ecwid-button {display:none !important;}</style>
    <?php }
}
add_action( 'admin_head-post-new.php', 'divergentecwid_posttype_admin_css' );
add_action( 'admin_head-post.php', 'divergentecwid_posttype_admin_css' );

/*---------------------------------------------------
admin pointer
----------------------------------------------------*/

function divergent_enqueue_pointer_script_style( $hook_suffix ) {
	
	$enqueue_pointer_script_style = false;
	$dismissed_pointers = explode( ',', get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
    
	if( !in_array( 'divergent_settings_pointer', $dismissed_pointers ) ) {
		$enqueue_pointer_script_style = true;
		add_action( 'admin_print_footer_scripts', 'divergent_pointer_print_scripts' );
	}

	if( $enqueue_pointer_script_style ) {
		wp_enqueue_style( 'wp-pointer' );
		wp_enqueue_script( 'wp-pointer' );
	}
	
}
add_action( 'admin_enqueue_scripts', 'divergent_enqueue_pointer_script_style' );

function divergent_pointer_print_scripts() {

	$pointer_content  = "<h3>" . esc_attr__( 'Theme Settings', 'divergent' ) . "</h3>";
	$pointer_content .= "<p>" . esc_attr__( 'First of all, please read the', 'divergent' ) . " <a href='" . get_template_directory_uri() . "/documentation/index.html' target='_blank'>" . esc_attr__( 'HELP DOCUMENTATION', 'divergent' ) . "</a></p>";
	?>
	
	<script type="text/javascript">
	//<![CDATA[
	jQuery(document).ready( function($) {
		$('#menu-appearance').pointer({
			content:		"<?php echo $pointer_content; ?>",
			position:		{
								edge:	'left', // arrow direction
								align:	'middle' // vertical alignment
							},
			pointerWidth:	350,
			close:			function() {
								$.post( ajaxurl, {
										pointer: 'divergent_settings_pointer', // pointer ID
										action: 'dismiss-wp-pointer'
								});
							}
		}).pointer('open');
	});
	//]]>
	</script>

<?php
}
 
/*---------------------------------------------------
theme settings scripts
----------------------------------------------------*/

if ( ! function_exists( 'divergent_theme_settings_init' ) ) {
function divergent_theme_settings_init($hook){
    global $egemenerd_settings_page;
    if( $hook != $egemenerd_settings_page ) {
		return;
    }
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/includes/css/font-awesome.min.css', false, '4.7.0');
    wp_enqueue_style('divergent_panel_style', get_template_directory_uri() . '/includes/css/panel.css', false, '1.0');
    if ( is_rtl() ) {
        wp_enqueue_style('divergent_panelrtl_style', get_template_directory_uri() . '/includes/css/panel-rtl.css', false, '1.0');
    }
    if ( !is_rtl() ) {
        wp_enqueue_script( 'ace_code_highlighter_js', get_template_directory_uri() . '/ace/ace.js', '', '1.0.0', true );
        wp_enqueue_script( 'ace_mode_js', get_template_directory_uri() . '/ace/mode-css.js', array( 'ace_code_highlighter_js' ), '1.0.0', true );
    }
    wp_enqueue_style('divergent_toggles_style', get_template_directory_uri() . '/includes/css/toggles.css', false, '1.0');
    wp_enqueue_style('divergent_select_style', get_template_directory_uri() . '/includes/css/select.css', false, '1.0');
    wp_enqueue_style('egemenerd_ui_slider', get_template_directory_uri() . '/includes/css/ui-slider.css', false, '1.0');
    wp_enqueue_style('egemenerd_admin_icon_picker', get_template_directory_uri() . '/includes/css/iconpicker.css', false, '1.0');
    wp_enqueue_script('divergent_toggles_script', get_template_directory_uri() . '/includes/js/toggles.js', array( 'jquery' ),'',true);
    wp_enqueue_script('divergent_select_script', get_template_directory_uri() . '/includes/js/select.js', array( 'jquery' ),'',true);
    wp_enqueue_script('egemenerd_admin_icon_picker', get_template_directory_uri() . '/includes/js/iconpicker.js', array( 'jquery' ),'',true);
    wp_enqueue_script('divergent_panel_script', get_template_directory_uri() . '/includes/js/panel.js', array( 'jquery', 'jquery-ui-slider', 'wp-color-picker' ),'',true);
}
add_action( 'admin_enqueue_scripts', 'divergent_theme_settings_init' );
}

if ( ! function_exists( 'divergent_theme_admin_scripts' ) ) {
function divergent_theme_admin_scripts(){
    wp_enqueue_style('divergent_theme_admin_style', get_template_directory_uri() . '/includes/css/panel-general.css', false, '1.0');
}
}
add_action( 'admin_enqueue_scripts', 'divergent_theme_admin_scripts' );

/*---------------------------------------------------
stylesheets
----------------------------------------------------*/

if ( ! function_exists( 'divergent_theme_styles' ) ) {
function divergent_theme_styles()  
{ 
    $divergent_sharing_css_check = get_option('divergent_remove_sharing');
    
    wp_enqueue_style( 'divergent-normalize-style', get_template_directory_uri() . '/css/normalize.css', false, '1.0');
    wp_enqueue_style( 'divergent-animation-style', get_template_directory_uri() . '/css/animate.css', false, '1.0'); 
    if (empty($divergent_sharing_css_check) && ($divergent_sharing_css_check != 'true') && is_single()) {
        wp_enqueue_style('rrssb', get_template_directory_uri() . '/css/rrssb.css', false, '4.6.3');
    }
    wp_enqueue_style( 'divergent-font-style', get_template_directory_uri() . '/css/font-awesome.min.css', false, '1.0');
    wp_enqueue_style( 'divergent-scrollbar-style', get_template_directory_uri() . '/css/scrollbar.css', false, '1.0');
    wp_enqueue_style( 'divergent-tooltipster-style', get_template_directory_uri() . '/css/tooltipster.css', false, '1.0');
    wp_enqueue_style( 'divergent-custom-style', get_stylesheet_directory_uri() . '/style.css', false, '1.0');
}
add_action('wp_enqueue_scripts', 'divergent_theme_styles');
}

/*---------------------------------------------------
javascript files
----------------------------------------------------*/

if ( ! function_exists( 'divergent_script_register' ) ) {
function divergent_script_register() {
    $divergent_sharing_js_check = get_option('divergent_remove_sharing');
    
    wp_enqueue_script('dv_backstretch', get_template_directory_uri() . '/js/backstretch.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script('divergentscrollbar', get_template_directory_uri() . '/js/scrollbar.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script('divergenttooltips', get_template_directory_uri() . '/js/tooltips.js', array( 'jquery' ), '1.0.0', true );
    if (empty($divergent_sharing_js_check) && ($divergent_sharing_js_check != 'true') && is_single()) {
        wp_enqueue_script('rrssb', get_template_directory_uri() . '/js/rrssb.min.js', array( 'jquery' ), '1.0.9', true );
    }
    if ( !is_page_template('homepage.php') ) {
        wp_enqueue_script('divergentcustom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), '1.0.0', true );
    }
}
    add_action( 'wp_enqueue_scripts', 'divergent_script_register' ); 
}

/*---------------------------------------------------
Register Sidebar
----------------------------------------------------*/

if ( ! function_exists( 'divergent_sidebars_widgets_init' ) ) {
function divergent_sidebars_widgets_init() {
    register_sidebar( array(
        'name' => esc_attr__( 'Home Sidebar', 'divergent'),
        'id' => 'divergenthomesidebar',
        'description' => esc_attr__( 'Homepage Sidebar Widget Field', 'divergent' ),
        'before_widget' => '<div id="%1$s" class="%2$s cv-panel-widget">',
        'after_widget' => "</div>",
        'before_title' => '<div class="cv-sidebar-title"><h5>',
        'after_title' => '</h5></div>',
    ));
    register_sidebar( array(
        'name' => esc_attr__( 'Main Sidebar', 'divergent'),
        'id' => 'divergentmainsidebar',
        'description' => esc_attr__( 'Main Sidebar Widget Field', 'divergent' ),
        'before_widget' => '<div id="%1$s" class="%2$s cv-panel-widget">',
        'after_widget' => "</div>",
        'before_title' => '<div class="cv-sidebar-title"><h5>',
        'after_title' => '</h5></div>',
    ));
}
add_action( 'widgets_init', 'divergent_sidebars_widgets_init' );
}

/*---------------------------------------------------
Sidebar Menu
----------------------------------------------------*/
if ( ! function_exists( 'divergent_menu' ) ) {
    function divergent_menu() {
        register_nav_menus(
            array(
                'divergent-menu' => esc_attr__( 'Sidebar Menu', 'divergent' )    
            )
        );
    }
    add_action( 'init', 'divergent_menu' );
}

/* ---------------------------------------------------------
Second Featured Image
----------------------------------------------------------- */

function divergent_featured_image() {

    $screens = array( 'post', 'page', 'dvsections' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'divergent_featured_image_id',
            esc_attr__( 'Second Featured Image', 'divergent' ),
            'divergent_featured_image_box',
            $screen,
            'side',
            'low'
        );
    }
}
add_action( 'add_meta_boxes', 'divergent_featured_image' );


function divergent_featured_image_box( $post ) {

  wp_nonce_field( 'divergent_featured_image_box', 'divergent_featured_image_box_nonce' );
  $value = get_post_meta( $post->ID, 'divergent_featured_image_key', true );
    
?>
<p><?php echo esc_attr__( "Featured image for mobile devices", 'divergent' ); ?></p>
<img id="divergent_featured_thumbnail" src="<?php echo esc_attr( $value ); ?>" alt="" style="width:100%;height:auto;margin-bottom:5px;vertical-align:bottom;<?php if(empty($value)) { echo esc_attr('display:none'); } ?>" />
<input type="hidden" id="divergent_featured_image" name="divergent_featured_image" value="<?php echo esc_attr( $value ); ?>" />
<p><input id="divergent_featured_image_button" class="button" type="button" value="<?php echo esc_attr__( 'Upload Image', 'divergent') ?>" /></p>
<a id="divergent_remove_featured" href="#" style="<?php if(empty($value)) { echo esc_attr('display:none'); } ?>"><?php echo esc_attr__( 'Remove featured image', 'divergent') ?></a>
<script type="text/javascript">
jQuery(document).ready(function($){ 
    var custom_uploader; 
    $("#divergent_featured_image_button").click(function(e) { 
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: "<?php echo esc_attr__( 'Choose Image', 'divergent') ?>",
            button: {
                text: "<?php echo esc_attr__( 'Choose Image', 'divergent') ?>"
            },
            multiple: false
        });
        custom_uploader.on("select", function() {
            attachment = custom_uploader.state().get("selection").first().toJSON();
            $("#divergent_featured_image").val(attachment.url);
            $("#divergent_featured_thumbnail").attr('src', attachment.url);
            $("#divergent_featured_thumbnail").css('display', 'block');
            $("#divergent_remove_featured").css('display', 'block');
        });
        custom_uploader.open(); 
    }); 
    $("#divergent_remove_featured").click(function(e) {
        e.preventDefault();
        $("#divergent_featured_thumbnail").css('display', 'none');
        $("#divergent_featured_image").val('');
        $(this).css('display', 'none');
    });
});    
</script>   
<?php
}
function featured_image_save_postdata( $post_id ) {
  if ( ! isset( $_POST['divergent_featured_image_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['divergent_featured_image_box_nonce'];
  if ( ! wp_verify_nonce( $nonce, 'divergent_featured_image_box' ) )
      return $post_id;

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  $mydata = sanitize_text_field( $_POST['divergent_featured_image'] );

  update_post_meta( $post_id, 'divergent_featured_image_key', $mydata );
}
add_action( 'save_post', 'featured_image_save_postdata' );


/*---------------------------------------------------
custom read more link
----------------------------------------------------*/

if ( ! function_exists( 'divergent_excerpt_read_more' ) ) {
function divergent_excerpt_read_more($output) {
    global $post;
    return $output . '<a class="cv-readmore" href="'. get_permalink($post->ID) . '">' . esc_attr__('Read More', 'divergent') . '</a>';
}
add_filter('the_excerpt', 'divergent_excerpt_read_more');
}

/*---------------------------------------------------
add class to next-previous post links
----------------------------------------------------*/

add_filter('next_posts_link_attributes', 'divergent_link_attributes');
add_filter('previous_posts_link_attributes', 'divergent_link_attributes');

function divergent_link_attributes() {
    return 'class="cv-button"';
}

/*---------------------------------------------------
Add Custom Css
----------------------------------------------------*/
 
if ( ! function_exists( 'divergent_display_css' ) ) {
function divergent_display_css() {
    $divergent_custom_css = get_option( 'divergent_customcode' );
    if ( !empty( $divergent_custom_css ) ) {
?>
<style type="text/css">
<?php print stripslashes($divergent_custom_css); ?>
</style>
<?php
    }
}
add_action( 'wp_head', 'divergent_display_css', 99); 
}

/*---------------------------------------------------
custom tag cloud
----------------------------------------------------*/
if ( ! function_exists( 'divergent_tag_cloud_args' ) ) {
    function divergent_tag_cloud_args($args) {
        $divergent_args = array('smallest' => 15, 'largest' => 15, 'orderby' => 'count','unit' => 'px','order' => 'DESC');
        $args = wp_parse_args( $args, $divergent_args );
        return $args;
    }
}
add_filter('widget_tag_cloud_args','divergent_tag_cloud_args');

/*---------------------------------------------------
Custom comments field
----------------------------------------------------*/
if ( ! function_exists( 'divergent_comment' ) ) {
function divergent_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">      
<div id="comment-<?php comment_ID(); ?>" class="comments"> 
 <?php if ($comment->comment_approved == '0') : ?>
         <em><?php echo esc_attr('Your comment is awaiting moderation.', 'divergent'); ?></em>
         <br />
      <?php endif; ?>   
     <p class="meta">
     <cite class="fn"><?php printf(esc_attr('%s'), get_comment_author_link()) ?></cite><span class="says"> -</span>   
     <a href="<?php echo htmlspecialchars( esc_attr(get_comment_link( $comment->comment_ID )) ) ?>"><?php printf(esc_attr__('%1$s at %2$s', 'divergent'), get_comment_date(),  get_comment_time()) ?></a> - <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?><?php edit_comment_link(esc_attr__('(Edit)', 'divergent'),'  ','') ?></p>
      <div class="comments_content">
          <div class="comments_content_inner">
              <?php comment_text(); ?>
          </div>
       <div class="clr"></div>       
</div>
    
<?php
}          
}

/* ---------------------------------------------------------
TGM Activation Class
----------------------------------------------------------- */

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'divergent_register_required_plugins' );

function divergent_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'Divergent Features',
			'slug'     				=> 'divergent-features',
			'source'   				=> get_template_directory_uri() . '/plugins/divergent-features.zip',
			'required' 				=> true,
			'version' 				=> '1.6.7',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
        array(
			'name'     				=> 'Intuitive Custom Post Order',
			'slug'     				=> 'intuitive-custom-post-order',
			'required' 				=> false,
		),
        array(
			'name'     				=> 'Contact Form 7',
			'slug'     				=> 'contact-form-7',
			'required' 				=> false,
		),
	);
    
    $config = array(
		'id'           => 'divergent',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '', 
        );

	tgmpa( $plugins, $config );

}

/* ---------------------------------------------------------
Declare theme settings
----------------------------------------------------------- */

$divergenttheme = "divergent";
 
$egemenerd_theme_options = array (
 
/* ---------------------------------------------------------
General
----------------------------------------------------------- */
array( "name" => esc_attr__( 'General', 'divergent'),
"icon" => "dashicons-admin-generic",  
"type" => "section"),
array( "type" => "open"),

array( "name" => esc_attr__( 'Custom CSS', 'divergent'),
"desc" => "",
"id" => $divergenttheme."_customcode",
"type" => "csseditor",
"std" => ""), 
    
array( "name" => esc_attr__( 'Activate CSS Loader', 'divergent'),
"desc" => esc_attr__( 'To disable loading image and activate css loader, switch on.', 'divergent'),
"id" => $divergenttheme."_enable_cssloader",
"type" => "checkbox",
"std" => ""),    
    
array( "name" => esc_attr__( 'Loading image (80x80 px)', 'divergent'),
"desc" => esc_attr__( 'Loading image (80x80 px)', 'divergent'),
"id" => $divergenttheme."_loadingimage",
"type" => "media",
"std" => get_template_directory_uri() ."/images/loading.gif"),
    
array( "name" => esc_attr__( 'Second Loading image (64x64 px)', 'divergent'),
"desc" => esc_attr__( 'Second Loading image (64x64 px)', 'divergent'),
"id" => $divergenttheme."_sloadingimage",
"type" => "media",
"std" => get_template_directory_uri() ."/images/loading2.gif"),    
    
array( "name" => esc_attr__( 'Hide Sidebar', 'divergent'),
"desc" => esc_attr__( 'To disable sidebar, check this box.', 'divergent'),
"id" => $divergenttheme."_hidesidebar",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_attr__( 'Sidebar Icon', 'divergent'),
"desc" => esc_attr__( 'Select a FontAwesome icon', 'divergent'),
"id" => $divergenttheme."_menuicon",
"type" => "fontawesome",
"std" => "fa-bars"),     
    
array( "name" => esc_attr__( 'XL Single Posts', 'divergent'),
"desc" => esc_attr__( 'To use Page - XL Template on single posts, check this box.', 'divergent'),
"id" => $divergenttheme."_xlposts",
"type" => "checkbox",
"std" => ""),  
    
array( "name" => esc_attr__( 'Remove Meta Data', 'divergent'),
"desc" => esc_attr__( 'To remove meta data (Author name, categories, tags) from single post pages, check this box.', 'divergent'),
"id" => $divergenttheme."_removemeta",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_html__( 'Remove Social Sharing Buttons', 'divergent'),
"desc" => esc_html__( 'There are social sharing buttons at the bottom of the single post pages. To remove them, switch on.', 'divergent'),
"id" => $divergenttheme."_remove_sharing",
"type" => "checkbox",
"std" => ""),  
    
array( "type" => "close"), 
    
/* ---------------------------------------------------------
Homepage
----------------------------------------------------------- */  

array( "name" => esc_attr__( 'Homepage', 'divergent'),
"icon" => "dashicons-admin-home",      
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_attr__( 'Name', 'divergent'),
"desc" => esc_attr__( 'Your Name', 'divergent'),
"id" => $divergenttheme."_name",
"type" => "text",
"std" => ""),    
    
array( "name" => esc_attr__( 'Surname', 'divergent'),
"desc" => esc_attr__( 'Your Surname', 'divergent'),
"id" => $divergenttheme."_surname",
"type" => "text",
"std" => ""),
    
array( "name" => esc_attr__( 'Name/Surname Font Size', 'divergent'),
"desc" => esc_attr__( 'Font size of your name and surname (px)', 'divergent'),
"id" => $divergenttheme."_namefsize",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 120,      
"std" => 60),   
    
array( "name" => esc_attr__( 'Font Size (Mobile Devices)', 'divergent'),
"desc" => esc_attr__( 'Font size of your name and surname for mobile devices (px)', 'divergent'),
"id" => $divergenttheme."_namemobile",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 120,      
"std" => 34),    
    
array( "name" => esc_attr__( 'Additional Info', 'divergent'),
"desc" => esc_attr__( 'Additional Information', 'divergent'),
"id" => $divergenttheme."_additional",
"type" => "text",
"std" => ""),
    
array( "name" => esc_attr__( 'Info Font Size', 'divergent'),
"desc" => esc_attr__( 'Font size of your additional information (px)', 'divergent'),
"id" => $divergenttheme."_infofsize",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 120,      
"std" => 30), 
    
array( "name" => esc_attr__( 'Font Size (Mobile Devices)', 'divergent'),
"desc" => esc_attr__( 'Font size of your additional information for mobile devices (px)', 'divergent'),
"id" => $divergenttheme."_infomobile",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 120,      
"std" => 18),     
    
array( "name" => esc_attr__( 'Left Side Image', 'divergent'),
"desc" => '',
"id" => $divergenttheme."_leftimage",
"type" => "media",
"std" => ""),
    
array( "name" => esc_attr__( 'Right Side Image', 'divergent'),
"desc" => '',
"id" => $divergenttheme."_rightimage",
"type" => "media",
"std" => ""),
    
array( "name" => esc_attr__( 'Hide Social Icons', 'divergent'),
"desc" => esc_attr__( 'To hide social icons, check this box.', 'divergent'),
"id" => $divergenttheme."_hideicons",
"type" => "checkbox",
"std" => ""),  
    
array( "name" => esc_attr__( 'Logo (Optional)', 'divergent'),
"desc" => '',
"id" => $divergenttheme."_logo",
"type" => "media",
"std" => ""),
    
array( "name" => esc_attr__( 'Width of the logo', 'divergent'),
"desc" => esc_attr__( 'Maximum width of the logo (px)', 'divergent'),
"id" => $divergenttheme."_maxwidth",
"type" => "number",
"std" => "400"),
    
array( "name" => esc_attr__( 'Home Icon', 'divergent'),
"desc" => esc_attr__( 'Select a FontAwesome icon', 'divergent'),
"id" => $divergenttheme."_homeicon",
"type" => "fontawesome",
"std" => "fa-home"),     
    
array( "name" => esc_attr__( 'Home Title', 'divergent'),
"desc" => esc_attr__( 'Tooltip text', 'divergent'),
"id" => $divergenttheme."_hometitle",
"type" => "text",
"std" => "HOME"),    
    
array( "name" => esc_attr__( 'Home Slug', 'divergent'),
"desc" => esc_attr__( 'You should use only latin characters.', 'divergent'),
"id" => $divergenttheme."_homeslug",
"type" => "text",
"std" => "home"),    
    
array( "type" => "close"), 
    
/* ---------------------------------------------------------
Google Map
----------------------------------------------------------- */  

array( "name" => esc_attr__( 'Google Map', 'divergent'),
"icon" => "dashicons-location-alt",      
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_attr__( 'Google Map API KEY (Required)', 'divergent'),
"desc" => esc_attr__( 'To use the Google Map, you must get an API KEY from Google. For more information, please read the help documentation', 'divergent'),
"id" => $divergenttheme."_apikey",
"type" => "text",
"std" => ""),    
    
array( "name" => esc_attr__( 'Google Map Marker (64x64 px)', 'divergent'),
"desc" => esc_attr__( 'Google Map Marker (64x64 px)', 'divergent'),
"id" => $divergenttheme."_mapmarker",
"type" => "media",
"std" => get_template_directory_uri() ."/images/pin.png"),
    
array( "name" => esc_attr__( 'Google Map Zoom', 'divergent'),
"desc" => esc_attr__( 'Google Map Zoom Value', 'divergent'),
"id" => $divergenttheme."_mapzoom",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 19,      
"std" => 17),  
    
array( "name" => esc_attr__( 'Google Map Grayscale', 'divergent'),
"desc" => esc_attr__( 'To disable Google Map grayscale view, check this box.', 'divergent'),
"id" => $divergenttheme."_grayscale",
"type" => "checkbox",
"std" => ""),    
    
array( "type" => "close"),     
    
/* ---------------------------------------------------------
Featured Image
----------------------------------------------------------- */  

array( "name" => esc_attr__( 'Featured Image', 'divergent'),
"icon" => "dashicons-format-image",      
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_attr__( "If you don't add a featured image to a post/page, following image will be displayed. ", 'divergent'),
"type" => "info2"),     
    
array( "name" => esc_attr__( 'Default Image', 'divergent'),
"desc" => '',
"id" => $divergenttheme."_defaultimage",
"type" => "media",
"std" => get_template_directory_uri() ."/images/placeholder.jpg"),      
    
array( "name" => esc_attr__( 'Following image will be displayed on standard WordPress blog,archive,search,404 etc. pages.', 'divergent'),
"type" => "info2"),    
    
array( "name" => esc_attr__( 'Blog Image', 'divergent'),
"desc" => '',
"id" => $divergenttheme."_blogimage",
"type" => "media",
"std" => ""), 
    
array( "name" => esc_attr__( 'Blog Thumbnail Height', 'divergent'),
"desc" => esc_attr__( 'The distance between the title and the date', 'divergent'),
"id" => $divergenttheme."_blogheight",
"type" => "number",
"std" => "120"),    
    
array( "type" => "close"),
    
/* ---------------------------------------------------------
Galleries
----------------------------------------------------------- */
array( "name" => esc_attr__( 'Galleries', 'divergent'),
"icon" => "dashicons-format-gallery",      
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_attr__( 'Outer Spacing (Grid)', 'divergent'),
"desc" => esc_attr__( 'The distance between galleries (px).', 'divergent'),
"id" => $divergenttheme . "_spaceoffset",
"type" => "number",
"std" => "20"),
    
array( "name" => esc_attr__( 'Align', 'divergent'),
"desc" => esc_attr__( 'Thumbnail Alignment', 'divergent'),
"id" => $divergenttheme . "_thumbnailalign",
"type" => "select",
"std" => array('left' => 'Left','center' => 'Center','right' => 'Right')),    
    
array( "name" => __( 'Activate Zoom', 'divergent'),
"desc" => __( 'Activate Zoom', 'divergent'),
"id" => $divergenttheme."_lgzoom",
"type" => "select",
"std" => array('true' => 'Yes','false' => 'No')),
    
array( "name" => __( 'Activate Fullscreen', 'divergent'),
"desc" => __( 'Activate Fullscreen', 'divergent'),
"id" => $divergenttheme."_lgfullscreen",
"type" => "select",
"std" => array('true' => 'Yes','false' => 'No')), 
    
array( "name" => __( 'Activate Thumbnails', 'divergent'),
"desc" => __( 'Activate Thumbnails', 'divergent'),
"id" => $divergenttheme."_lgthumbnails",
"type" => "select",
"std" => array('true' => 'Yes','false' => 'No')),
    
array( "name" => __( 'Activate Download Link', 'divergent'),
"desc" => __( 'Activate Download Link', 'divergent'),
"id" => $divergenttheme."_lgdownload",
"type" => "select",
"std" => array('true' => 'Yes','false' => 'No')),
    
array( "name" => __( 'Activate Counter', 'divergent'),
"desc" => __( 'Activate Counter', 'divergent'),
"id" => $divergenttheme."_lgcounter",
"type" => "select",
"std" => array('true' => 'Yes','false' => 'No')),
    
array( "name" => esc_attr__( 'Hide Bars Delay', 'divergent'),
"desc" =>  esc_attr__( 'Delay for hiding gallery controls in second', 'divergent'),
"id" => $divergenttheme."_lghide",
"type" => "number",
"std" => "6"),     
    
array( "type" => "close"),  
    
/* ---------------------------------------------------------
Page with Slider
----------------------------------------------------------- */  

array( "name" => esc_attr__( 'Page with slider', 'divergent'),
"icon" => "dashicons-image-flip-horizontal",      
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_attr__( 'Dots', 'divergent'),
"desc" => esc_attr__( 'To disable navigation dots, check this box.', 'divergent'),
"id" => $divergenttheme."_hidedots",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_attr__( 'Timer', 'divergent'),
"desc" => esc_attr__( 'To disable timer, check this box.', 'divergent'),
"id" => $divergenttheme."_hidetimer",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_attr__( 'Arrows', 'divergent'),
"desc" => esc_attr__( 'To disable navigation arrows, check this box.', 'divergent'),
"id" => $divergenttheme."_hidearrows",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_attr__( 'Play-Pause', 'divergent'),
"desc" => esc_attr__( 'To disable play-pause buttons, check this box.', 'divergent'),
"id" => $divergenttheme."_hideplaypause",
"type" => "checkbox",
"std" => ""),
    
array( "name" => esc_attr__( 'Slider Height (Mobile)', 'divergent'),
"desc" =>  esc_attr__( 'Slider height on mobile mode (px)', 'divergent'),
"id" => $divergenttheme."_sliderheight",
"type" => "number",
"std" => "400"),    
    
array( "type" => "close"),
    
/* ---------------------------------------------------------
Page with Video
----------------------------------------------------------- */  

array( "name" => esc_attr__( 'Page with video (You Tube)', 'divergent'),
"icon" => "dashicons-format-video",      
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_attr__( 'Start at', 'divergent'),
"desc" =>  esc_attr__( 'Set the seconds the video should start at', 'divergent'),
"id" => $divergenttheme."_video_startat",
"type" => "number",
"std" => "0"),
    
array( "name" => esc_attr__( 'Stop at', 'divergent'),
"desc" =>  esc_attr__( 'Set the seconds the video should stop at. If 0 is ignored', 'divergent'),
"id" => $divergenttheme."_video_stopat",
"type" => "number",
"std" => "0"),
    
array( "name" => __( 'Mute', 'divergent'),
"desc" => __( 'Mute the audio', 'divergent'),
"id" => $divergenttheme."_video_mute",
"type" => "select",
"std" => array('false' => 'No','true' => 'Yes')),
    
array( "name" => __( 'Autoplay', 'divergent'),
"desc" => __( 'Play the video once ready', 'divergent'),
"id" => $divergenttheme."_video_autoplay",
"type" => "select",
"std" => array('true' => 'Yes','false' => 'No')),
    
array( "name" => __( 'Loop', 'divergent'),
"desc" => __( 'Loops the movie once ended', 'divergent'),
"id" => $divergenttheme."_video_loop",
"type" => "select",
"std" => array('false' => 'No','true' => 'Yes')),
    
array( "name" => __( 'Quality', 'divergent'),
"desc" => __( 'Quality od the video', 'divergent'),
"id" => $divergenttheme."_video_quality",
"type" => "select",
"std" => array('default' => 'Default','small' => 'Small','medium' => 'Medium','large' => 'Large','hd720' => 'HD 720','hd1080' => 'HD 1080','highres' => 'Highres')), 
    
array( "name" => __( 'Show Controls', 'divergent'),
"desc" => __( 'Show or hide the player controls', 'divergent'),
"id" => $divergenttheme."_video_showcontrols",
"type" => "select",
"std" => array('true' => 'Yes','false' => 'No')),  
    
array( "name" => __( 'Show YT Logo', 'divergent'),
"desc" => __( 'Show or hide the You Tube logo and the link to the original video URL', 'divergent'),
"id" => $divergenttheme."_video_showytlogo",
"type" => "select",
"std" => array('true' => 'Yes','false' => 'No')),    
    
array( "type" => "close"),    

/* ---------------------------------------------------------
Fonts
----------------------------------------------------------- */  

array( "name" => esc_attr__( 'Fonts', 'divergent'),
"icon" => "dashicons-edit",      
"type" => "section"),
array( "type" => "open"),   
    
array( "name" => esc_attr__( 'First Google Web Fonts Code (Titles)', 'divergent'),
"desc" => esc_attr__( 'Google Web Fonts Code (For more information please look at the HELP DOCUMENTION)', 'divergent'),
"id" => $divergenttheme."_fontheadinglink",
"type" => "text",
"std" => ""),

array( "name" => esc_attr__( 'First Font-Family (Titles)', 'divergent'),
"desc" => esc_attr__( 'First Font-Family (Titles)', 'divergent'),
"id" => $divergenttheme."_fontheadingfamily",
"type" => "text",
"std" => ""),

array( "name" => esc_attr__( 'Second Google Web Fonts Code', 'divergent'),
"desc" => esc_attr__( 'Google Web Fonts Code', 'divergent'),
"id" => $divergenttheme."_fontlink",
"type" => "text",
"std" => ""),

array( "name" => esc_attr__( 'Second Font-Family', 'divergent'),
"desc" => esc_attr__( 'Second Font-Family', 'divergent'),
"id" => $divergenttheme."_fontfamily",
"type" => "text",
"std" => ""), 
    
array( "name" => esc_attr__( 'H1 (px)', 'divergent'),
"desc" => esc_attr__( 'H1 Title Font Size (px)', 'divergent'),
"id" => $divergenttheme."_h1",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 120,      
"std" => 44),  

array( "name" => esc_attr__( 'H2 (px)', 'divergent'),
"desc" => esc_attr__( 'H2 Title Font Size (px)', 'divergent'),
"id" => $divergenttheme."_h2",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 120,      
"std" => 38),  

array( "name" => esc_attr__( 'H3 (px)', 'divergent'),
"desc" => esc_attr__( 'H3 Title Font Size (px)', 'divergent'),
"id" => $divergenttheme."_h3",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 120,      
"std" => 30),   

array( "name" => esc_attr__( 'H4 (px)', 'divergent'),
"desc" => esc_attr__( 'H4 Title Font Size (px)', 'divergent'),
"id" => $divergenttheme."_h4",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 120,      
"std" => 26),  

array( "name" => esc_attr__( 'H5 (px)', 'divergent'),
"desc" => esc_attr__( 'H5 Title Font Size (px)', 'divergent'),
"id" => $divergenttheme."_h5",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 120,      
"std" => 22),   

array( "name" => esc_attr__( 'H6 (px)', 'divergent'),
"desc" => esc_attr__( 'H6 Title Font Size (px)', 'divergent'),
"id" => $divergenttheme."_h6",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 120,      
"std" => 18),   

array( "name" => esc_attr__( 'p (px)', 'divergent'),
"desc" => esc_attr__( 'Paragraphs and other texts font size (px)', 'divergent'),
"id" => $divergenttheme."_p",
"type" => "uislider",
"step" => 1,      
"min" => 1, 
"max" => 120,      
"std" => 16),      
    
array( "type" => "close"), 
    
/* ---------------------------------------------------------
Colors
----------------------------------------------------------- */

array( "name" => esc_attr__( 'Colors', 'divergent'),
"icon" => "dashicons-admin-appearance",      
"type" => "section"),
array( "type" => "open"),   
    
array( "name" => esc_attr__( 'First Color', 'divergent'),
"desc" => esc_attr__( 'First Color', 'divergent'),
"id" => $divergenttheme."_first_color",
"type" => "colorpicker",
"std" => "#222222"),

array( "name" => esc_attr__( 'Second Color', 'divergent'),
"desc" => esc_attr__( 'Second Color', 'divergent'),
"id" => $divergenttheme."_second_color",
"type" => "colorpicker",
"std" => "#949494"),

array( "name" => esc_attr__( 'Third Color', 'divergent'),
"desc" => __( 'Third Color', 'divergent'),
"id" => $divergenttheme."_third_color",
"type" => "colorpicker",
"std" => "#f3f3f3"),

array( "name" => esc_attr__( 'Fourth Color', 'divergent'),
"desc" => esc_attr__( 'Fourth Color', 'divergent'),
"id" => $divergenttheme."_fourth_color",
"type" => "colorpicker",
"std" => "#de3926"),
    
array( "name" => esc_attr__( 'Fifth Color', 'divergent'),
"desc" => esc_attr__( 'Fifth Color', 'divergent'),
"id" => $divergenttheme."_fifth_color",
"type" => "colorpicker",
"std" => "#ffffff"),
    
array( "name" => esc_attr__( 'Sixth Color', 'divergent'),
"desc" => esc_attr__( 'Sixth Color', 'divergent'),
"id" => $divergenttheme."_sixth_color",
"type" => "colorpicker",
"std" => "#333333"),    
    
array( "name" => esc_attr__( 'Transparent Color', 'divergent'),
"desc" => esc_attr__( 'Menu info box and blog transparent background color.', 'divergent'),
"id" => $divergenttheme."_transparent_color",
"type" => "rgbacolorpicker",
"std" => "rgba(34,34,34,0.5)"),
    
array( "name" => esc_attr__( 'Second Transparent Color', 'divergent'),
"desc" => esc_attr__( 'Footer and Image caption background color.', 'divergent'),
"id" => $divergenttheme."_sectransparent_color",
"type" => "rgbacolorpicker",
"std" => "rgba(243,243,243,0.9)"),    
    
array( "type" => "close"),  
    
/* ---------------------------------------------------------
Tooltips
----------------------------------------------------------- */
array( "name" => esc_attr__( 'Tooltips', 'divergent'),
"icon" => "dashicons-admin-comments",       
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_attr__( 'Disable Tooltips on Mobile Devices', 'divergent'),
"desc" => esc_attr__( 'To disable the tooltip plugin on mobile devices, switch on.', 'divergent'),
"id" => $divergenttheme."_disablemobiletooltips",
"type" => "checkbox",
"std" => ""),    
    
array( "name" => esc_attr__( 'Disable Menu Tooltips', 'divergent'),
"desc" => esc_attr__( 'To disable icon menu tooltips, switch on.', 'divergent'),
"id" => $divergenttheme."_disablemenutooltips",
"type" => "checkbox",
"std" => ""), 
    
array( "name" => __( 'Menu Icon Tooltip Animation', 'divergent'),
"desc" => __( 'Menu Icon Tooltip Animation', 'divergent'),
"id" => $divergenttheme."_menutooltipanim",
"type" => "select",
"std" => array('swing' => 'Swing','fade' => 'Fade','grow' => 'Grow','slide' => 'Slide','fall' => 'Fall')),     
    
array( "name" => esc_attr__( 'Disable Social Icon Tooltips', 'divergent'),
"desc" => esc_attr__( 'To disable social icon tooltips, switch on.', 'divergent'),
"id" => $divergenttheme."_disablesocialtooltips",
"type" => "checkbox",
"std" => ""),
    
array( "name" => __( 'Social Icon Tooltip Animation', 'divergent'),
"desc" => __( 'Social Icon Animation', 'divergent'),
"id" => $divergenttheme."_socialtooltipanim",
"type" => "select",
"std" => array('swing' => 'Swing','fade' => 'Fade','grow' => 'Grow','slide' => 'Slide','fall' => 'Fall')),      
    
array( "name" => esc_attr__( 'Disable Go to Top Tooltips', 'divergent'),
"desc" => esc_attr__( 'To disable go to top button tooltips, switch on.', 'divergent'),
"id" => $divergenttheme."_disablegotoptooltips",
"type" => "checkbox",
"std" => ""),
    
array( "name" => __( 'Go To Top Tooltip Animation', 'divergent'),
"desc" => __( 'Menu Tooltip Animation', 'divergent'),
"id" => $divergenttheme."_gotoptooltipanim",
"type" => "select",
"std" => array('grow' => 'Grow','swing' => 'Swing','fade' => 'Fade','slide' => 'Slide','fall' => 'Fall')),      
    
array( "type" => "close"),    
    
/* ---------------------------------------------------------
Ecwid
----------------------------------------------------------- */
array( "name" => esc_attr__( 'Ecwid Store', 'divergent'),
"icon" => "dashicons-cart",       
"type" => "section"),
array( "type" => "open"), 
    
array( "name" => esc_attr__( 'For more information about Ecwid, please read the help documentation', 'divergent'),
"type" => "info"),
    
array( "name" => esc_attr__( 'Activate Custom Ecwid Skin', 'divergent'),
"desc" => esc_attr__( 'To activate built-in Ecwid skin, check this box.', 'divergent'),
"id" => $divergenttheme."_ecwidstyle",
"type" => "checkbox",
"std" => ""),    
    
array( "name" => esc_attr__( 'Ecwid Loading Image (64x64 px)', 'divergent'),
"desc" => esc_attr__( 'Loading image (64x64 px)', 'divergent'),
"id" => $divergenttheme."_ecwidloading",
"type" => "media",
"std" => get_template_directory_uri() ."/images/ecwidloader.gif"),     

array( "type" => "close"),    

/* ---------------------------------------------------------
Footer
----------------------------------------------------------- */ 
    
array( "name" => esc_attr__( 'Footer', 'divergent'),
"icon" => "dashicons-info",      
"type" => "section"),
array( "type" => "open"),
    
array( "name" => esc_attr__( 'Hide Footer', 'divergent'),
"desc" => esc_attr__( 'To hide footer widget field, check this box.', 'divergent'),
"id" => $divergenttheme."_hidefooter",
"type" => "checkbox",
"std" => ""),  
    
array( "name" => esc_attr__( 'Footer Text', 'divergent'),
"desc" => esc_attr__( 'If you dont need to add a copyright message to your website, leave this field blank.', 'divergent'),
"id" => $divergenttheme."_footermessage",
"type" => "text",
"std" => ""),
 
array( "type" => "close")
);
 
/*---------------------------------------------------
Theme Panel Output
----------------------------------------------------*/

if ( ! function_exists( 'egemenerd_add_settings_page' ) ) {
    function egemenerd_add_settings_page() {
        global $egemenerd_settings_page;
        $egemenerd_settings_page = add_theme_page( esc_html__( 'Theme Settings', 'divergent'), esc_html__( 'Theme Settings', 'divergent'), 'manage_options', 'egemenerd-settings', 'egemenerd_theme_settings_page');
    }
    add_action( 'admin_menu', 'egemenerd_add_settings_page' );    
}

function egemenerd_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'parent' => false,
		'id' => 'egemenerd-theme-settings',
		'title' => __( 'Theme Settings', 'divergent'),
		'href' => admin_url( 'themes.php?page=egemenerd-settings'),
		'meta' => false
	));
}
add_action( 'wp_before_admin_bar_render', 'egemenerd_admin_bar_render' );

if ( ! function_exists( 'egemenerd_theme_settings_page' ) ) {
function egemenerd_theme_settings_page() {
if ( ! did_action( 'wp_enqueue_media' ) ){
    wp_enqueue_media();
}    
global $themename,$egemenerd_theme_options;
$i=0;
$message='';
if ( 'save' == @$_REQUEST['action'] ) {

foreach ($egemenerd_theme_options as $value) {
update_option( @$value['id'], @$_REQUEST[ $value['id'] ] ); }
 
foreach ($egemenerd_theme_options as $value) {
if( isset( $_REQUEST[ @$value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
$message='saved';
}
else if( 'reset' == @$_REQUEST['action'] ) {
 
foreach ($egemenerd_theme_options as $value) {
delete_option( @$value['id'] ); }
$message='reset';
}
 
if ( $message=='saved' ) {
?>
    <div id="egemenerd-message" class="updated notice notice-success is-dismissible"><p><strong><?php echo esc_attr__( 'Theme settings saved', 'divergent'); ?></strong></p></div>
<?php
}
if ( $message=='reset' ) {
?>
    <div id="egemenerd-message" class="updated notice notice-success is-dismissible"><p><strong><?php echo esc_attr__( 'Theme settings reset', 'divergent'); ?></strong></p></div>
<?php    
}
 
?>
<?php $egemenerd_version = wp_get_theme(); ?> 
<div id="egemenerd-panel-wrapper">
<div id="egemenerd-panel-wrapper-inner">    
<div class="egemenerd_options_header">
<div class="egemenerd_options_header_left">
<h1><?php echo esc_attr($egemenerd_version->get( 'Name' )); ?> <small> - <?php echo esc_attr($egemenerd_version->get( 'Version' )); ?></small></h1>    
</div>
<div class="egemenerd_options_header_right">    
<ul>
<li><a class="egemenerd-link" href="https://themeforest.net/item/divergent-personal-vcard-resume-wordpress-theme/13224711/support?ref=egemenerd" target="_blank"><?php echo esc_attr( 'Support', 'divergent'); ?></a></li> 
<li><a class="egemenerd-link" href="http://www.wp4life.com/online/divergent/demo.zip"><?php echo esc_attr__( 'Demo XML', 'divergent'); ?></a></li>    
<li><a class="egemenerd-link" href="http://help.wp4life.com/" target="_blank"><?php echo esc_attr( 'Knowledge Base', 'divergent'); ?></a></li>    
<li><a class="egemenerd-link primary" href="http://www.wp4life.com/online/divergent/index.html" target="_blank"><?php echo esc_attr( 'Help Documentation', 'divergent'); ?></a></li>
</ul>
</div>
</div>     
<div class="egemenerd_options_wrap"> 
<div>
<form id="egemenerd_form" method="post">
 
<?php foreach ($egemenerd_theme_options as $value) {
 
switch ( $value['type'] ) {
 
case "open": ?>
<?php break;
 
case "close": ?>
</div>
</div>

<?php break;
 
case 'text': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <input id="<?php echo esc_attr($value['id']); ?>" type="<?php echo esc_attr($value['type']); ?>" name="<?php echo esc_attr($value['id']); ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { echo esc_attr($value['std']); } ?>" />
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
<?php break;    
    
case 'select': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <select class="egemenerd-select" name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>">
<?php foreach ($value['std'] as $key => $optiontext) { ?>
<option value="<?php echo esc_attr($key); ?>" <?php if (get_option( $value['id'] ) == $key) { echo esc_attr('selected="selected"'); } ?>><?php echo esc_attr($optiontext); ?></option>
<?php } ?>
        </select>
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
<?php break;    
    
case 'colorpicker': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <input id="<?php echo esc_attr($value['id']); ?>" class="egemenerd-color" type="<?php echo esc_attr($value['type']); ?>" name="<?php echo esc_attr($value['id']); ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { echo esc_attr($value['std']); } ?>" />
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
<?php break;
    
case 'rgbacolorpicker': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <input id="<?php echo esc_attr($value['id']); ?>" class="egemenerd-wp-color-picker" type="<?php echo esc_attr($value['type']); ?>" name="<?php echo esc_attr($value['id']); ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { echo esc_attr($value['std']); } ?>" />
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
<?php break;     
    
case 'number': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <input id="<?php echo esc_attr($value['id']); ?>" type="<?php echo esc_attr($value['type']); ?>" onkeypress="return validate(event)" name="<?php echo esc_attr($value['id']); ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { echo esc_attr($value['std']); } ?>" />
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
<?php break;    
 
case 'textarea': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <textarea name="<?php echo esc_attr($value['id']); ?>" rows="" cols=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { echo esc_attr($value['std']); } ?></textarea>
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
<?php break;
    
case 'info': ?>
<div class="egemenerd_option_input">
<div class="egemenerd_info_box"><h4><i class="egemenerd-i-icon dashicons-info"></i>&nbsp;<?php echo esc_attr($value['name']); ?></h4></div>
<div class="clearfix"></div>
</div>
<?php break;
        
case 'info2': ?>
<div class="egemenerd_option_input noborder">
<div class="egemenerd_info_box"><h4><i class="egemenerd-i-icon dashicons-info"></i>&nbsp;<?php echo esc_attr($value['name']); ?></h4></div>
<div class="clearfix"></div>
</div>
<?php break;      
 
case 'editor': ?>
<div class="egemenerd_option_input">
<?php wp_editor( stripslashes(get_option( $value['id'])), $value['id'], array( 'wpautop' => false, 'editor_height' => 300 )); ?> 
<div class="clearfix"></div>
<div class="egemenerd-editor-desc"><?php echo esc_attr($value['desc']); ?></div>
<div class="clearfix"></div>
</div>
<?php break; 
    
case 'teenyeditor': ?>
<div class="egemenerd_option_input">
<?php wp_editor( stripslashes(get_option( $value['id'])), $value['id'], array( 'wpautop' => false, 'teeny' => true, 'editor_height' => 200 )); ?> 
<div class="clearfix"></div>
<div class="egemenerd-editor-desc"><?php echo esc_attr($value['desc']); ?></div>
<div class="clearfix"></div>
</div>
<?php break;     
    
case 'media': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <input id="<?php echo esc_attr($value['id']); ?>_image" type="text" name="<?php echo esc_attr($value['id']); ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { echo esc_attr($value['std']); } ?>" />
        <div id="<?php echo esc_attr($value['id']); ?>_thumb" class="egemenerd-upload-thumb">
            <div id="<?php echo esc_attr($value['id']); ?>_close" class="egemenerd-thumb-close"><i class="egemenerd-i-icon dashicons-dismiss"></i></div>
            <img src="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { echo esc_attr($value['std']); } ?>" alt="" />
        </div>
    </div>
    <div class="egemenerd-option-right">
        <input id="<?php echo esc_js($value['id']); ?>_image_button" class="egemenerd-button uploadbutton" type="button" value="<?php echo esc_js( 'Upload', 'divergent') ?>" />
<script type="text/javascript">
    jQuery("#<?php echo esc_js($value['id']); ?>_image").change(function() { 
        if(jQuery.trim(jQuery("#<?php echo esc_attr($value['id']); ?>_image").val()).length > 0)
        {
            jQuery("#<?php echo esc_js($value['id']); ?>_thumb").show();
            jQuery("#<?php echo esc_js($value['id']); ?>_thumb img").attr('src', jQuery("#<?php echo esc_attr($value['id']); ?>_image").val());
            jQuery("#<?php echo esc_js($value['id']); ?>_thumb img").error(function(){jQuery(this).attr('src', '<?php echo get_template_directory_uri(); ?>/includes/css/error.png');});
        }
        else {
            jQuery("#<?php echo esc_js($value['id']); ?>_thumb").hide();
        }
    });
jQuery(document).ready(function($){ 
    var inp = $("#<?php echo esc_js($value['id']); ?>_image").val();
    if($.trim(inp).length > 0)
    {
        $("#<?php echo esc_js($value['id']); ?>_thumb").show();
    }
    else {
        $("#<?php echo esc_js($value['id']); ?>_thumb").hide();
    }
    var custom_uploader; 
    $('#<?php echo esc_js($value['id']); ?>_image_button').click(function(e) { 
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: '<?php echo esc_js( 'Choose Image', 'divergent') ?>',
            button: {
                text: '<?php echo esc_js( 'Choose Image', 'divergent') ?>'
            },
            multiple: false
        });
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#<?php echo esc_js($value['id']); ?>_image').val(attachment.url);
            $("#<?php echo esc_js($value['id']); ?>_thumb img").attr('src', attachment.url);
            $("#<?php echo esc_js($value['id']); ?>_thumb").show();
        });
        custom_uploader.open(); 
    }); 
    $('#<?php echo esc_js($value['id']); ?>_close').click(function(e) {
        $("#<?php echo esc_js($value['id']); ?>_thumb").hide();
        $("#<?php echo esc_js($value['id']); ?>_image").val('');
    });    
});    
</script>
    </div>
<div class="clearfix"></div>
</div>
<?php break;    
 
case "checkbox": ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <?php if(get_option($value['id'])){ $checked = 'checked="checked"'; } else { $checked = ""; } ?>
        <div id="<?php echo esc_attr($value['id']); ?>-toggle" class="egemenerd-toggle toggle-modern" data-toggle-on="<?php if(get_option($value['id'])){ echo get_option($value['id']); } else { echo esc_attr('false'); } ?>"></div>
        <input id="<?php echo esc_attr($value['id']); ?>" type="checkbox" class="egemenerd-checkbox" name="<?php echo esc_attr($value['id']); ?>" value="true" <?php echo esc_attr($checked); ?> />
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#<?php echo esc_attr($value['id']); ?>-toggle').toggles({
            checkbox: jQuery('#<?php echo esc_attr($value['id']); ?>'),
            text: {
                on: '<?php echo esc_attr( 'ON', 'divergent') ?>',
                off: '<?php echo esc_attr( 'OFF', 'divergent') ?>'
            },
            width: 70,
            height: 30,
            type: 'select'
        });
    });
</script>    
</div>
<?php break;
        
case 'uislider': ?>
<div class="egemenerd-slider-container">    
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <div class="egemenerd-slider-field"></div>      
        <input id="<?php echo esc_attr($value['id']); ?>" class="egemenerd-slider-field-value" type="hidden" name="<?php echo esc_attr($value['id']); ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { echo esc_attr($value['std']); } ?>" readonly="readonly" data-step="<?php echo esc_attr($value['step']); ?>" data-start="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { echo esc_attr($value['std']); } ?>" data-min="<?php echo esc_attr($value['min']); ?>" data-max="<?php echo esc_attr($value['max']); ?>" />
        <div class="egemenerd-slider-field-value-display">
            <span class="egemenerd-slider-field-value-text"></span>
        </div>
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>
</div>    
<?php break;        

case 'fontawesome': ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <div class="form-group">
            <div class="input-group">
                <input id="<?php echo esc_attr($value['id']); ?>" data-placement="bottomRight" class="form-control egemenerd-icon-picker" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { echo esc_attr($value['std']); } ?>" type="text" name="<?php echo esc_attr($value['id']); ?>" />
                <span class="input-group-addon"></span>
            </div>
        </div>
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>   
</div>
<?php break;   
        
case 'csseditor': ?>
<?php if ( is_rtl() ) { ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
    </div>
    <div class="egemenerd-option-center">
        <textarea name="<?php echo esc_attr($value['id']); ?>" rows="" cols=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { echo esc_attr($value['std']); } ?></textarea>
    </div>
    <div class="egemenerd-option-right">
        <small><?php echo esc_attr($value['desc']); ?></small>
    </div>
    <div class="clearfix"></div>
</div>    
<?php } else { ?>
<div class="egemenerd_option_input">
    <div class="egemenerd-option-left">
        <label for="<?php echo esc_attr($value['id']); ?>"><?php echo esc_attr($value['name']); ?></label>
    </div>
    <div class="egemenerd-option-double">
            <div id="<?php echo esc_attr($value['id']); ?>_custom_css_container" class="egemenerd-css-editor-container">
                <div name="<?php echo esc_attr($value['id']); ?>" id="<?php echo esc_attr($value['id']); ?>" class="egemenerd-css-editor"></div>
            </div>
            <textarea id="<?php echo esc_attr($value['id']); ?>_css_editor" name="<?php echo esc_attr($value['id']); ?>" style="display: none;"><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { echo esc_attr($value['std']); } ?></textarea>
<script type="text/javascript">
( function( global, $ ) {
    var editor,
        syncCSS = function() {
            $( '#<?php echo esc_attr($value['id']); ?>_css_editor' ).val( editor.getSession().getValue() );
        },
        loadAce = function() {
            editor = ace.edit( '<?php echo esc_attr($value['id']); ?>' );
            global.safecss_editor = editor;
            editor.getSession().setUseWrapMode( true );
            editor.setShowPrintMargin( false );
            editor.getSession().setValue( $( '#<?php echo esc_attr($value['id']); ?>_css_editor' ).val() );
            editor.getSession().setMode( "ace/mode/css" );
            jQuery.fn.spin&&$( '#<?php echo esc_attr($value['id']); ?>_custom_css_container' ).spin( false );
            $( '#egemenerd_form' ).submit( syncCSS );
        };
    if ( $.browser.msie&&parseInt( $.browser.version, 10 ) <= 7 ) {
        $( '#<?php echo esc_attr($value['id']); ?>_custom_css_container' ).hide();
        $( '#<?php echo esc_attr($value['id']); ?>_css_editor' ).show();
        return false;
    } else {
        $( global ).load( loadAce );
    }
    global.aceSyncCSS = syncCSS;
} )( this, jQuery );    
</script>  
    </div>
    <div class="clearfix"></div>
</div> 
<?php } ?>    
<?php break;        
 
case "section":
$i++; ?>
<div class="egemenerd_input_section">
<div class="egemenerd_input_title">
 
<h3><i class="egemenerd-i-icon <?php echo esc_attr($value['icon']); ?>"></i>&nbsp;<?php echo esc_attr($value['name']); ?></h3>
<span class="submit"><input name="save<?php echo esc_attr($i); ?>" type="submit" value="<?php echo esc_attr( 'Save Changes', 'divergent') ?>" class="egemenerd-button" /></span>
<div class="clearfix"></div>
</div>
<div class="egemenerd_all_options">
<?php break;
 
}
}?>
<input type="hidden" name="action" value="save" />
</form>
</div>
<div class="egemenerd-footer">
    <div class="egemenerd-footer-left">
        <a href="http://themeforest.net/user/egemenerd?ref=egemenerd" target="_blank" ><img class="egemenerd-logo" src="<?php echo get_template_directory_uri() . '/includes/css/logo.png' ?>" alt="egemenerd" /></a>
    </div>
    <div class="egemenerd-footer-right">
        <form method="post">
            <p class="submit">
                <input name="reset" type="submit" value="<?php echo esc_attr( 'Reset All Settings', 'divergent') ?>" onclick="return confirm('<?php echo esc_attr( 'Are you sure you want to reset all theme settings?', 'divergent') ?>')" class="egemenerd-link" />
                <input type="hidden" name="action" value="reset" />
            </p>
        </form>
    </div>
</div>
</div>
</div>
</div>
<?php
}
}
?>