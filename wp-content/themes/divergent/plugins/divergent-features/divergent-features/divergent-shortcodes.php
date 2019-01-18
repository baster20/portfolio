<?php 
add_shortcode('iframecode', 'iframecode');
add_shortcode('fleximage', 'fleximage');
add_shortcode('accordioncontainer', 'accordioncontainer');
add_shortcode('accordion', 'accordion');
add_shortcode('dvtestimonials', 'dvtestimonials');
add_shortcode('tabgroup', 'jquery_tab_group');
add_shortcode('dvbutton', 'dvbutton');
add_shortcode('dvsectionbutton', 'dvsectionbutton');
add_shortcode('dvlabel', 'dvlabel');
add_shortcode('dvtable', 'dvtable');
add_shortcode('dvtableitem', 'dvtableitem');
add_shortcode('dviconcontainer', 'dviconcontainer');
add_shortcode('dvicon', 'dvicon');
add_shortcode('dvresume', 'dvresume');
add_shortcode('dvbox', 'dvbox');
add_shortcode('dvskill', 'dvskill');
add_shortcode('dvblog', 'dvblog');

add_filter("the_content", "divergent_content_filter");
add_filter("widget_text", "divergent_content_filter", 9);


function divergent_content_filter($content) {
 
	// array of custom shortcodes requiring the fix 
	$block = join("|",array("iframecode","fleximage","accordioncontainer","accordion","dvtestimonials","tabgroup","tab","dvbutton","dvlabel","dvtable","dvtableitem","dviconcontainer","dvicon","dvsectionbutton","dvresume","dvbox","dvskill","dvblog"));
 
	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		
	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
 
	return $rep;
 
}

// Blog
function dvblog($atts) {
    extract(shortcode_atts(array(
		"max" => 'max',
        "categoryid" => 'categoryid',
        "viewall" => 'viewall'
	), $atts));
    ob_start();
    include('latestposts.php');
    $content = ob_get_clean();
    return $content;
}

// Skill
function dvskill($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => 'title',
        "percent" => 'percent'
	), $atts));
        return '<div class="skillbar" data-percent="' . esc_attr($percent) . '%"><div class="skillbar-title"><span>' . esc_attr($title) . '</span></div><div class="skillbar-bar"></div><div class="skill-bar-percent">' . esc_attr($percent) . '%</div></div>';
}

// Box
function dvbox($atts, $content = null) {
	extract(shortcode_atts(array(
        "title" => 'title',
		"style" => 'style'
	), $atts));
        return '<div class="cv-box cv-' . esc_attr($style) . '"><div class="cv-box-title">' . esc_attr($title) . '</div>' . $content . '</div>';
}

// Resume
function dvresume($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => 'title',
        "subtitle" => 'subtitle'
	), $atts));
        return '<div class="cv-resume-box"><div class="cv-resume-title"><h5>' . esc_attr($title) . '</h5><p>' . esc_attr($subtitle) . '</p></div>' . $content . '</div>';
}

// Label
function dvlabel($atts, $content = null) {
    return '<p class="label">' . $content . '</p>';
}

// Button
function dvbutton($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => 'url',
        "style" => 'style',
        "newtab" => 'newtab'
	), $atts));
    if ($newtab != 'yes') {
        return '<a href="' . esc_url($url) . '" class="cv-button ' . esc_attr($style) . '">' . esc_html($content) . '</a>';
    }
    else
    {
        return '<a href="' . esc_url($url) . '" target="_blank" class="cv-button ' . esc_attr($style) . '">' . esc_html($content) . '</a>';
    }
}

// Section Button
function dvsectionbutton($atts, $content = null) {
	extract(shortcode_atts(array(
		"id" => 'id',
        "slug" => 'slug',
        "style" => 'style'
	), $atts));
        return '<a href="#' . esc_attr($slug) . '" class="cv-button go-to-floor ' . esc_attr($style) . '" data-id="' . esc_attr($id) . '" data-slug="' . esc_attr($slug) . '">' . esc_html($content) . '</a>';
}

// Table
function dvtable($atts, $content = null) {
    return '<ul class="cv-table">' . do_shortcode($content) . '</ul>';
}
function dvtableitem($atts, $content = null) {
	extract(shortcode_atts(array(
		"left" => 'left',
        "right" => 'right',
        "icon" => 'icon'
	), $atts));
    if (empty($icon)) {
		return '<li><div class="cv-table-left">' . $left . '</div><div class="cv-table-right">' . $right . '</div></li>';
    }
    else {
        return '<li><div class="cv-table-left"><i class="cv-icon fa fa-' . $icon . '"></i>' . $left . '</div><div class="cv-table-right">' . $right . '</div></li>';
    }
}

// Flex Iframe
function iframecode($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => 'url'
	), $atts));
		return '<div class="flex-video"><iframe src="' . esc_html($url) . '" frameborder="0" allowfullscreen></iframe></div>';
}

// Flex Image
function fleximage($atts, $content = null) {
	extract(shortcode_atts(array(
		"imgcaption" => 'imgcaption'
	), $atts));
    if (empty($imgcaption)) {
            return '<div class="flex-img">' . $content . '</div>';
    }
    else
    {
            return '<figure class="caption-image"><div>' . $content . '</div><figcaption>' . $imgcaption . '</figcaption></figure>';         
    }
}

// Testimonials
function dvtestimonials($atts) {
    extract(shortcode_atts(array(
		"autoplay" => 'autoplay',
        "duration" => 'duration',
        "arrows" => 'arrows',
        "numbers" => 'numbers'
	), $atts));
    ob_start();
    include('testimonials.php');
    $content = ob_get_clean();
    return $content;
}

// Accordion Container
function accordioncontainer($atts, $content = null) {
    return '<div class="accordion-container">' . do_shortcode(stripslashes($content)) . '</div>';
}

// Accordion
function accordion($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => 'title',
        "icon" => 'icon'
	), $atts));
    if (empty($icon)) {
       return '<div class="accordion-header"><strong>' . $title . '</strong></div><div class="accordion-content">' . do_shortcode(stripslashes($content)) . '</div>';
    }
    else
    {
       return '<div class="accordion-header"><strong><i class="cv-icon fa fa-' . $icon . '"></i> ' . $title . '</strong></div><div class="accordion-content">' . do_shortcode(stripslashes($content)) . '</div>';        
    }
}

// DV Icon Container
function dviconcontainer($atts, $content = null) {
    return '<div class="cv-main-icon-container">' . do_shortcode(stripslashes($content)) . '</div>';
}

// DV Icon
function dvicon($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => 'title',
        "link" => 'link',
        "icon" => 'icon'
	), $atts));
    if (empty($link)) {
       return '<div class="cv-icon-block"><div class="cv-icon-container"><a href="#" class="fa fa-' . $icon . '">' . $title . '</a></div><div class="cv-icon-text"><h4>' . $title . '</h4>' . $content . '</div></div>';
    }
    else
    {
       return '<div class="cv-icon-block"><div class="cv-icon-container"><a href="' . esc_url($link) . '" class="fa fa-' . $icon . '">' . $title . '</a></div><div class="cv-icon-text"><h4>' . $title . '</h4>' . $content . '</div></div>';      
    }
}

// Tabs
function jquery_tab_group( $atts, $content ){
    extract(shortcode_atts(array(
        "type" => 'type'
	), $atts));
    
$GLOBALS['tab_count'] = 0;
$GLOBALS['tabs'] = array();

do_shortcode( $content );

if( is_array( $GLOBALS['tabs']) ){
$int = '1';
$random = rand();    
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '
    <li>'.$tab['title'].'</li>
';
$panes[] = '
<div>
'.do_shortcode($tab['content']).'

</div>
';
$int++;
}
$return = "\n".'

<div class="dvtabs"><div id="tabs-'.$random.'">'."\n".'
<ul class="resp-tabs-list">'.implode( "\n", $tabs ).'</ul>
<div class="resp-tabs-container">'."\n".' '.implode( "\n", $panes ).'

</div></div><div class="clear"></div></div>
<script type="text/javascript">jQuery(document).ready(function() { jQuery("#tabs-'.$random.'").easyResponsiveTabs({ type: "'.$type.'", width: "auto", fit: true }); }); </script>
'."\n";
}

return $return;
}

add_shortcode( 'tab', 'jquery_tab' );

function jquery_tab( $atts, $content ){
extract(shortcode_atts(array(
'title' => 'Tab %d'
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' => $content );

$GLOBALS['tab_count']++;
}
?>