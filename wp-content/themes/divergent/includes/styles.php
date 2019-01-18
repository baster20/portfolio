<?php
function divergentcompress($buffer) {
    /* remove comments */
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    /* remove tabs, spaces, newlines, etc. */
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}

function divergent_print_styles()
{
    $divergentfirstfont = str_replace("'", '', get_option('divergent_fontheadingfamily'));
    $divergentsecondfont = str_replace("'", '', get_option('divergent_fontfamily'));
    $divergenth1size = esc_attr(get_option('divergent_h1'));
    $divergenth2size = esc_attr(get_option('divergent_h2'));
    $divergenth3size = esc_attr(get_option('divergent_h3'));
    $divergenth4size = esc_attr(get_option('divergent_h4'));
    $divergenth5size = esc_attr(get_option('divergent_h5'));
    $divergenth6size = esc_attr(get_option('divergent_h6'));
    $divergentpsize = esc_attr(get_option('divergent_p'));
    $divergentblogheight = esc_attr(get_option('divergent_blogheight'));
    $divergentloadingimage = esc_attr(get_option('divergent_loadingimage'));
    $divergentsloadingimage = esc_attr(get_option('divergent_sloadingimage'));
    $divergentfirstcolor = esc_attr(get_option('divergent_first_color'));
    $divergentsecondcolor = esc_attr(get_option('divergent_second_color'));
    $divergentthirdcolor = esc_attr(get_option('divergent_third_color'));
    $divergentfourthcolor = esc_attr(get_option('divergent_fourth_color'));
    $divergentfifthcolor = esc_attr(get_option('divergent_fifth_color'));
    $divergentsixthcolor = esc_attr(get_option('divergent_sixth_color'));
    $divergenttransparent = esc_attr(get_option('divergent_transparent_color'));
    $divergentsectransparent = esc_attr(get_option('divergent_sectransparent_color'));    
    $divergentnamefsize = esc_attr(get_option('divergent_namefsize'));
    $divergentnamemobile = esc_attr(get_option('divergent_namemobile'));
    $divergentinfofsize = esc_attr(get_option('divergent_infofsize'));
    $divergentinfomobile = esc_attr(get_option('divergent_infomobile'));
    $divergentmaxwidth = esc_attr(get_option('divergent_maxwidth'));
    $divergentsliderheight = esc_attr(get_option('divergent_sliderheight'));
    
    ob_start("divergentcompress");
?>
<style type="text/css">
<?php if ( is_admin_bar_showing() ) { ?>
#cv-page-left,#cv-page-right,#cv-menu,#cv-sidebar,.floor,.cv-left-slider {
    padding-top:32px !important;
}
@media only screen and (max-width: 780px) {
    #cv-page-left,#cv-page-right,#cv-menu,#cv-sidebar,.floor,.cv-left-slider {
        padding-top:45px !important;
    }
}     
<?php } ?>
<?php $divergentfooterhide = get_option('divergent_hidefooter'); ?>
<?php if ($divergentfooterhide == "true") { ?>
.blogpager {
    padding-bottom: 0px !important;
}
<?php } ?>   
/* ================= FONTS ================== */
body,p,input,textarea {
    <?php if (!empty($divergentsecondfont)) { echo stripslashes(esc_attr($divergentsecondfont)); } else { echo esc_attr("font-family: ralewayregular;"); } ?>
    font-weight: normal;
}
h1,h2,h3,h4,h5,h6,strong,label,.tooltipster-content,.cv-table-left,.cv-button,.skillbar,.cv-resume-title p, .cvfilters li,#home-slide-title span,#home-title p,blockquote .cite,.nav-numbers li a,.meta,.page-date,.cv-box-title,.cv-readmore,input[type="submit"] {
    <?php if (!empty($divergentfirstfont)) { echo stripslashes(esc_attr($divergentfirstfont)); } else { echo esc_attr("font-family: ralewaybold;"); } ?>
    font-weight: normal;
}    
/* ================= GENERAL STYLES  ================== */
body,p,input[type="text"], input[type="email"], input[type="number"], input[type="date"], input[type="password"], textarea,.cv-button,table,.widget_nav_menu div ul ul li a,#wp-calendar tfoot #prev,#wp-calendar tfoot #next,#wp-calendar caption, .cv-submenu ul ul li a, cv-table .cv-table-text,.skillbar-title span,.skill-bar-percent,.tooltipster-gototop .tooltipster-content {
    font-size: <?php if (!empty($divergentpsize)) { echo $divergentpsize; } else { echo esc_attr("16"); } ?>px;
}    
h1 {
    font-size: <?php if (!empty($divergenth1size)) { echo $divergenth1size; } else { echo esc_attr("44"); } ?>px;
}
h2 {
    font-size: <?php if (!empty($divergenth2size)) { echo $divergenth2size; } else { echo esc_attr("38"); } ?>px;
}
h3 {
    font-size: <?php if (!empty($divergenth3size)) { echo $divergenth3size; } else { echo esc_attr("30"); } ?>px;
}
h4 {
    font-size: <?php if (!empty($divergenth4size)) { echo $divergenth4size; } else { echo esc_attr("26"); } ?>px;
}
h5 {
    font-size: <?php if (!empty($divergenth5size)) { echo $divergenth5size; } else { echo esc_attr("22"); } ?>px;
}
h6,.widget_nav_menu div ul li a,.cv-submenu ul li a,.cv-table li,.cv-resume-title p,.cvfilters li,.tooltipster-dark .tooltipster-content,.tooltipster-light .tooltipster-content,.tooltipster-red .tooltipster-content,.accordion-header,.blogcontainer .postdate, .page-date,.resp-tabs-list li,h2.resp-accordion,.cv-box-title {
    font-size: <?php if (!empty($divergenth6size)) { echo $divergenth6size; } else { echo esc_attr("18"); } ?>px;
} 
blockquote p {
    font-size: <?php if (!empty($divergenth6size)) { echo $divergenth6size + 2; } else { echo esc_attr("20"); } ?>px;
}  
#home-title h1 span, #home-slide-title span {
    font-size: <?php if (!empty($divergentnamefsize)) { echo $divergentnamefsize; } else { echo esc_attr("60"); } ?>px;
}    
#home-title p{
    font-size: <?php if (!empty($divergentinfofsize)) { echo $divergentinfofsize; } else { echo esc_attr("30"); } ?>px;
}    
@media only screen and (max-width:1170px) {
    #home-title h1 span,
    #home-slide-title span {
        font-size: <?php if (!empty($divergentnamefsize)) { echo $divergentnamefsize - 16; } else { echo esc_attr("44"); } ?>px;
    }
    #home-title p {
        font-size: <?php if (!empty($divergentinfofsize)) { echo $divergentinfofsize - 6; } else { echo esc_attr("24"); } ?>px;
    }
}
@media only screen and (max-width: 1024px) {
    #home-title h1 span,
    #home-slide-title span {
        font-size: <?php if (!empty($divergentnamemobile)) { echo $divergentnamemobile + 4; } else { echo esc_attr("38"); } ?>px;
    }
}
@media only screen and (max-width: 640px) {
    #home-title h1 span,
    #home-slide-title span {
        font-size: <?php if (!empty($divergentnamemobile)) { echo $divergentnamemobile; } else { echo esc_attr("34"); } ?>px;
    }
    h1{
        font-size: <?php if (!empty($divergenth1size)) { echo $divergenth1size - 6; } else { echo esc_attr("38"); } ?>px;
    }
    h2 {
        font-size: <?php if (!empty($divergenth2size)) { echo $divergenth2size - 4; } else { echo esc_attr("34"); } ?>px;
    }
    h3 {
        font-size: <?php if (!empty($divergenth3size)) { echo $divergenth3size - 2; } else { echo esc_attr("28"); } ?>px;
    }
    h4 {
        font-size: <?php if (!empty($divergenth4size)) { echo $divergenth4size - 2; } else { echo esc_attr("24"); } ?>px;
    }
    blockquote p {
    font-size: <?php if (!empty($divergenth6size)) { echo $divergenth6size; } else { echo esc_attr("18"); } ?>px;
} 
}  
@media only screen and (max-width: 480px) {
    #home-title h1 span,
    #home-slide-title span {
        font-size: <?php if (!empty($divergentnamemobile)) { echo $divergentnamemobile - 4; } else { echo esc_attr("30"); } ?>px;
    }
    #home-title p {
        font-size: <?php if (!empty($divergentinfomobile)) { echo $divergentinfomobile; } else { echo esc_attr("18"); } ?>px;
    }
    h1 {
        font-size: <?php if (!empty($divergenth1size)) { echo $divergenth1size - 12; } else { echo esc_attr("32"); } ?>px;
    }
    h2 {
        font-size: <?php if (!empty($divergenth2size)) { echo $divergenth2size - 10; } else { echo esc_attr("28"); } ?>px;
    }
    h3 {
        font-size: <?php if (!empty($divergenth3size)) { echo $divergenth3size - 6; } else { echo esc_attr("24"); } ?>px;
    }
    h4 {
        font-size: <?php if (!empty($divergenth4size)) { echo $divergenth4size - 4; } else { echo esc_attr("22"); } ?>px;
    }
    h5 {
        font-size: <?php if (!empty($divergenth5size)) { echo $divergenth5size - 2; } else { echo esc_attr("20"); } ?>px;
    }
    h6,.cv-resume-title p,.cvfilters li,.accordion-header,.page-date,.resp-tabs-list li,h2.resp-accordion,.cv-box-title,blockquote p,.cv-submenu ul li a,.cv-table li,.blogcontainer .postdate {
        font-size: <?php if (!empty($divergenth6size)) { echo $divergenth6size - 2; } else { echo esc_attr("16"); } ?>px;
    }
}
@media only screen and (max-height: 20em) {
    #home-title h1 span,
    #home-slide-title span {
        font-size: <?php if (!empty($divergentnamemobile)) { echo $divergentnamemobile - 8 ; } else { echo esc_attr("26"); } ?>px;
    }
    #home-title p {
        font-size: <?php if (!empty($divergentinfomobile)) { echo $divergentinfomobile - 2; } else { echo esc_attr("16"); } ?>px;
    } 
}
body {
    background-color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
h1,h2,h3,h4,h5,h6 {
    color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
h1.border:after,h2.border:after,h3.border:after,h4.border:after,
h5.border:after,h6.border:after,#site-loader-block:before, #site-loader-block:after,#site-loader-box {
    background-color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
p {
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
a {
    color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
a:hover {
    color:<?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
.label {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
    border-left: 3px solid <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
blockquote, pre {
    background: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
blockquote:before {
	background-color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
    border:5px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
hr {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.floor {
    background-color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.cv-logo img{
    max-width:<?php if (!empty($divergentmaxwidth)) { echo $divergentmaxwidth; } else { echo esc_attr("400"); } ?>px;
}
/* ================= FORMS ================== */
input,
textarea {
    background-color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    border: 1px solid <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
input:focus,
textarea:focus {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
    color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.cv-button {
    background-color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    border: 3px solid <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
	color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.cv-button.primary {
    background-color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
input[type="submit"] {
    border: 3px solid <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
    background-color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.cv-button:hover,input[type="submit"]:hover {
    background-color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
    border: 3px solid <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
#cv-sidebar input,#cv-sidebar textarea {
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
#cv-sidebar input:focus,#cv-sidebar textarea:focus {
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
#cv-sidebar .cv-button,.widget_categories ul li span {
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?> !important;
}
#cv-sidebar .cv-button:hover,.widget_categories ul li span {
    background-color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.searchbox .cv-button {
    border-left:1px solid <?php if (!empty($divergentsixthcolor)) { echo $divergentsixthcolor; } else { echo '#333333'; } ?> !important;
}
.searchbox .cv-button:hover {
    border-left:1px solid <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?> !important;
}
div.wpcf7-mail-sent-ok,div.wpcf7-mail-sent-ng,div.wpcf7-spam-blocked,div.wpcf7-validation-errors {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}     
/* ================= LOADING ANIMATION ================== */
#site-error{
    background-color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>; 
}
#site-error h3{
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
#site-loading {
    background: url('<?php if (!empty($divergentloadingimage)) { echo $divergentloadingimage; } else {echo esc_attr(get_template_directory_uri() .'/images/loading.gif');} ?>') no-repeat scroll center center <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
} 
#site-loading-css {
    background-color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}     
#site-loader-block {
    border: 5px solid <?php if (!empty($divergentsixthcolor)) { echo $divergentsixthcolor; } else { echo '#333333'; } ?>;
}    
/* ================= PAGE STRUCTURE ================== */
.cv-page-content {
    border-bottom: 50px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
#cv-page-right {
    background-color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
/* ================= MAIN MENU ================== */
#cv-menu{
    background-color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
#cv-main-menu ul li a {
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
#cv-main-menu ul li.cv-menu-icon a {
    background: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
/* ================= SIDEBAR ================== */
#cv-sidebar {
    background-color: <?php if (!empty($divergentsixthcolor)) { echo $divergentsixthcolor; } else { echo '#333333'; } ?>;
}
#cv-sidebar h1, #cv-sidebar h2, #cv-sidebar h3, #cv-sidebar h4, #cv-sidebar h5, #cv-sidebar h6{
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
#cv-sidebar, #cv-sidebar p{
    color:<?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.cv-panel-widget a{
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.cv-panel-widget a:hover{
    color:<?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
.widget_recent_entries ul li a,
.widget_categories ul li a,
.widget_recent_comments ul li a,
.widget_pages ul li a,
.widget_meta ul li a,
.widget_archive ul li a,
.widget_recent-posts ul li a,
.widget_rss ul li a,
#recentcomments a {
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.widget_recent_entries ul li a:hover,
.widget_categories ul li a:hover,
.widget_recent_comments ul li a:hover,
.widget_pages ul li a:hover,
.widget_meta ul li a:hover,
.widget_archive ul li a:hover,
.widget_archives ul li a:hover,
.widget_recent-posts ul li a:hover,
.widget_rss ul li a:hover,
.recentcomments span a:hover{
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
#cv-sidebar .tagcloud a,#cv-sidebar a[class^="tag"] {
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
#cv-sidebar .tagcloud a:hover,#cv-sidebar a[class^="tag"]:hover{
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    background-color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
a.cv-sidebar-post-title{
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
a.cv-sidebar-post-title:hover{
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.cv-sidebar-posts li img:hover {
    border:3px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
/* ================= SIDEBAR DROPDOWN MENU ================== */
.widget_nav_menu div ul li a {
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.widget_nav_menu div ul li a:hover {
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.widget_nav_menu div ul ul a{
    color:<?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.widget_nav_menu div ul > li > a.cvdropdown2 {
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
/* ================= SUBMENU ================== */
.cv-submenu ul li a {
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.cv-submenu ul li a:hover {
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.cv-submenu ul ul a{
    color:<?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.cv-submenu ul > li > a.cvdropdown2 {
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
/* ================= FLICKR FEED ================== */
.cv-flickr-box li img:hover {
    border:3px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
/* ================= HOMEPAGE ================== */
#home-title h1 span{
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    background-color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
#home-slide-title span, #home-title h1 .mobile-title{
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    background-color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
#home-title p{
    color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
    background-color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
/* ================= HOME SOCIAL BAR ================== */
#cv-home-social-bar ul li a {
    color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
    border-right: 1px solid <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
    background-color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
#cv-home-social-bar ul li a:hover {
    color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
/* ================= CV TABLE ================== */
.cv-table li {
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.cv-table li {
    border-bottom: 1px solid <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.cv-box .cv-table li {
    border-bottom: 1px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.cv-table li:first-child {
    border-top: 1px solid <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.cv-box .cv-table li:first-child {
    border-top: 1px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.cv-table .cv-table-title {
    color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
/* ================= ICON CONTAINERS ================== */
.cv-icon-container {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.cv-icon-container a {
    color:<?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.cv-icon-container a:before {
    color:<?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
/* ================= SKILLS ================== */
.skillbar {
    background-color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    border:1px solid <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.skillbar-title {
    color:<?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.skillbar-bar {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.skill-bar-percent {
	color:<?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
/* ================= RESUME ================== */
.cv-resume-title {
    border-bottom: 1px solid <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
/* ================= PORTFOLIO ================== */
.cvgrid li figure figcaption {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.cvfilters li {
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.cvfilters li:hover {
    color:<?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.cvfilters li.gridactive {
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    background-color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
.cvfilters li.gridactive:hover {
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.cvgrid li figure figcaption .cvgrid-title {
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.cvgrid > li > figure > a:after {
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    background-color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
.dvsquare > a:after {
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.dvsquare {
    background-color:<?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
/* ================= LIGHTGALLERY ================== */
.lg-actions .lg-next, .lg-actions .lg-prev {
    background-color: <?php if (!empty($divergenttransparent)) { echo $divergenttransparent; } else { echo 'rgba(34,34,34,0.5)'; } ?>;
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.lg-actions .lg-next:hover, .lg-actions .lg-prev:hover {
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.lg-toolbar {
    background-color: <?php if (!empty($divergenttransparent)) { echo $divergenttransparent; } else { echo 'rgba(34,34,34,0.5)'; } ?>;
}
.lg-toolbar .lg-icon {
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.lg-toolbar .lg-icon:hover {
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.lg-sub-html {
    background-color: <?php if (!empty($divergenttransparent)) { echo $divergenttransparent; } else { echo 'rgba(34,34,34,0.5)'; } ?>;
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
#lg-counter {
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.lg-outer .lg-item {
    background: url('<?php if (!empty($divergentloadingimage)) { echo $divergentloadingimage; } else {echo esc_attr(get_template_directory_uri() .'/images/loading.gif');} ?>') no-repeat scroll center center transparent;
}       
.lg-outer .lg-thumb-outer {
    background-color: <?php if (!empty($divergentsixthcolor)) { echo $divergentsixthcolor; } else { echo '#333333'; } ?>;
}
.lg-outer .lg-toogle-thumb {
    background-color: <?php if (!empty($divergentsixthcolor)) { echo $divergentsixthcolor; } else { echo '#333333'; } ?>;
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.lg-outer .lg-toogle-thumb:hover {
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.lg-progress-bar {
    background-color: <?php if (!empty($divergentsixthcolor)) { echo $divergentsixthcolor; } else { echo '#333333'; } ?>;
}
.lg-progress-bar .lg-progress {
    background-color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
.lg-backdrop {
    background-color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
/* ================= TOOLTIPS ================== */
.tooltipster-light {
	background: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
	color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.tooltipster-dark,.tooltipster-gototop {
	background: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
	color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.tooltipster-red {
	background: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
	color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
/* ================= TESTIMONIALS ================== */
.quovolve-nav a {
    background: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.quovolve-nav a:hover {
    background: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
      color:<?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.nav-numbers li a:hover {
    color:<?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
    background: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.nav-numbers li.active a{
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    background: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
/* ================= ACCORDION  ================== */
.accordion-container {
	border-top: 1px solid <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.accordion-header {
	border-bottom: 1px solid <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.accordion-header:hover {
	color:<?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.active-header {
	color:<?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.accordion-content {
	border-bottom: 1px solid <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
/* ================= BLOG ================== */
.blog-img {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.blog-img .blog-img-caption {
    margin-bottom: <?php if (!empty($divergentblogheight)) { echo $divergentblogheight; } else { echo esc_attr("120"); } ?>px;
}
.blog-img-caption h4{
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    background: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.without-featured-title {
    background: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.without-featured-title h4{
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.blog-img:hover .blog-img-caption h4, .without-featured-link:hover .without-featured-title{
    background: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
.blogcontainer .postdate {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.cv-readmore {
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.cv-readmore:hover {
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    background-color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.blogpager .previous, .blogpager .next{
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.blogpager .cv-button {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
    border-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
    color:<?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.blogpager .cv-button:hover {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
    border: 3px solid <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
    color:<?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
.blogmetadata a{
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}  
.blogmetadata a:hover{
    color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}     
.blogmetadata span{
    color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.comments_content {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.comments_content:before {
    border-bottom-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?> !important;
}
.reply:before {
    color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
/* ================= TABS ================== */
.resp-tab-active {
    border-top: 3px solid <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?> !important;
}
.resp-tabs-list li:hover {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.resp-tabs-list li.resp-tab-active {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.resp-tabs-container {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.resp-tab-active {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
/*-----------Vertical tabs-----------*/

.resp-vtabs .resp-tabs-list li:hover {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
    border-left: 3px solid <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
.resp-vtabs .resp-tabs-list li.resp-tab-active {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
    border-left: 3px solid <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
h2.resp-tab-active {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
@media only screen and (max-width: 640px) {
    .resp-tab-active {
        background-color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?> !important;
        color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?> !important;
    }
}
/* ================= FLEX IMAGE ================== */
.caption-image img {
    border:10px solid <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.caption-image figcaption {
    background-color:<?php if (!empty($divergentsectransparent)) { echo $divergentsectransparent; } else { echo 'rgba(243,243,243,0.9)'; } ?>;
}
/* ================= CV BOXES ================== */
.cv-box.cv-light,.blogmetadata {
    background-color: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?>;
}
.cv-box.cv-dark {
    background-color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.cv-box.cv-red {
    background-color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
.cv-box-title {
    color:<?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.cv-box.cv-dark .cv-box-title,.cv-box.cv-red .cv-box-title{
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.cv-box.cv-red p{
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
/* ================= YOUTUBE VIDEO ================== */
.mb_YTPBar,.mb_YTPBar span.mb_YTPUrl a{
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.mb_YTPlayer .loading{
    color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
    background:<?php if (!empty($divergentsixthcolor)) { echo $divergentsixthcolor; } else { echo '#333333'; } ?>;
}
.inline_YTPlayer{
    background:<?php if (!empty($divergentsixthcolor)) { echo $divergentsixthcolor; } else { echo '#333333'; } ?>;
}
.mb_YTPBar{
    background:<?php if (!empty($divergentsixthcolor)) { echo $divergentsixthcolor; } else { echo '#333333'; } ?>;
}
.mb_YTPBar:hover .buttonBar{
    background:<?php if (!empty($divergentsixthcolor)) { echo $divergentsixthcolor; } else { echo '#333333'; } ?>;
}
.mb_YTPBar .mb_YTPProgress{
    background:<?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
.mb_YTPBar .mb_YTPseekbar{
    background:<?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?>;
}
.mb_YTPBar .simpleSlider{
    border:1px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
.mb_YTPBar .level{
    background-color:<?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?>;
}
#cv-page-left{
    background: url('<?php if (!empty($divergentsloadingimage)) { echo $divergentsloadingimage; } else {echo esc_attr(get_template_directory_uri() .'/images/loading2.gif');} ?>') no-repeat scroll center center <?php if (!empty($divergentsixthcolor)) { echo $divergentsixthcolor; } else { echo '#333333'; } ?>;
}    
/* ================= FOOTER ================== */
#footer {
    background-color: <?php if (!empty($divergentsectransparent)) { echo $divergentsectransparent; } else { echo 'rgba(243,243,243,0.9)'; } ?>;
}
.cv-credits a {
    color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
.cv-credits a:hover {
    color:<?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
#cv-back-to-top:before {
    color:<?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?>;
}
#cv-back-to-top:hover:before {
    color:<?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?>;
}
/* ================= SLIDER HEIGHT ================== */    
.slider-mobile-only {
    height: <?php if (!empty($divergentsliderheight)) { echo $divergentsliderheight; } else { echo esc_attr("400"); } ?>px;
}
@media only screen and (max-width: 640px) {
    .slider-mobile-only {
        height: <?php if (!empty($divergentsliderheight)) { echo $divergentsliderheight - 100; } else { echo esc_attr("300"); } ?>px;
    }
}    
@media only screen and (max-width: 480px) {
    .slider-mobile-only {
        height: <?php if (!empty($divergentsliderheight)) { echo $divergentsliderheight - 150; } else { echo esc_attr("250"); } ?>px;
    }
}
</style>
<?php ob_end_flush(); ?>
<?php } ?>
<?php add_action('wp_head', 'divergent_print_styles', 1); ?>