<?php
$hidedots = get_option('divergent_hidedots');
$hidetimer = get_option('divergent_hidetimer');
$hidearrows = get_option('divergent_hidearrows');
$hideplaypause = get_option('divergent_hideplaypause');
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php $galleryimages = get_post_meta( get_the_id(), 'divergentgalleryimages', true ); ?>
<?php $mobilegalleryimages = get_post_meta( get_the_id(), 'divergentmobilegalleryimages', true ); ?>
<?php $galleryautoplay = get_post_meta( get_the_id(), 'divergentactivateauto', true ); ?>
<?php $galleryautoplayduration = get_post_meta( get_the_id(), 'divergentautoplaypause', true ); ?>
<div id="cv-page-left">
<?php if (!empty($galleryimages)) { ?>    
    <div id="cv-page-slider">
        <?php foreach ($galleryimages as $image => $link) { ?> 
        <?php $fullimage = wp_get_attachment_image_src( $image, 'full' ); ?>
        <img src="<?php echo esc_js($fullimage['0']); ?>" alt="">
        <?php } ?>
    </div> 
<?php } else { ?> 
<?php $defaultimg = get_option('divergent_defaultimage'); ?>
    <script type="text/javascript">
        <?php if (has_post_thumbnail()) { ?>
        <?php $post_thumbnail_id = get_post_thumbnail_id(); ?>
        <?php $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id ); ?>
        jQuery(document).ready(function () {
            "use strict";
            jQuery('#cv-page-left').backstretch("<?php echo esc_js($post_thumbnail_url); ?>");
        });
        <?php } else { ?>
        jQuery(document).ready(function () {
            "use strict";
            jQuery('#cv-page-left').backstretch("<?php if (!empty($defaultimg)) { echo esc_js($defaultimg); } else { echo esc_js( get_template_directory_uri() . '/images/placeholder.jpg'); } ?>");
        });
        <?php } ?>
    </script>
<?php } ?>    
</div>
<div id="cv-page-right">
<?php if (!empty($mobilegalleryimages)) { ?>    
    <div class="slider-mobile-only">
        <div id="cv-mobile-slider">
            <?php foreach ($mobilegalleryimages as $image => $link) { ?>
            <?php $fullimage = wp_get_attachment_image_src( $image, 'full' ); ?>
            <img src="<?php echo esc_js($fullimage['0']); ?>" alt="">
            <?php } ?>
        </div>
    </div>
<?php } else { ?> 
<?php $secondimage = get_post_meta( get_the_id(), 'divergent_featured_image_key', true ); ?>
<?php if (!empty($secondimage)) { ?>
<div class="img-mobile-only">
    <img src="<?php echo esc_url($secondimage); ?>" alt="" />
</div>
<?php } ?>    
<?php } ?>    
<article class="cv-page-content">
    <h1 class="border"><?php the_title(); ?></h1>
    <?php the_content(); ?>
    <?php wp_link_pages(); ?>
</article>
<?php endwhile; ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cv-page-slider").nerveSlider({
            sliderAutoPlay: <?php if ($galleryautoplay == 'on') { echo esc_js('true'); } else { echo esc_js('false'); } ?>,
            slideTransitionDelay: <?php if(!empty($galleryautoplayduration)) { echo esc_js($galleryautoplayduration); } else { echo esc_js('4'); } ?>000,
            sliderWidth: "100%",
            sliderHeight: "100%",
            slideTransitionEasing: 'easeInOutQuint',
            slideTransitionSpeed: 1000,
            sliderResizable: true,
            sliderKeepAspectRatio: false,
            slideTransitionDirection: "down",
            allowKeyboardEvents: false,
            slidesDraggable: false,
            showDots: <?php if ($hidedots != "true") { echo esc_js('true'); } else { echo esc_js('false'); } ?>,
            showTimer: <?php if ($hidetimer != "true") { echo esc_js('true'); } else { echo esc_js('false'); } ?>,
            showArrows: <?php if ($hidearrows != "true") { echo esc_js('true'); } else { echo esc_js('false'); } ?>,
            showPause: <?php if ($hideplaypause != "true") { echo esc_js('true'); } else { echo esc_js('false'); } ?>
        });
        jQuery("#cv-mobile-slider").nerveSlider({
            sliderAutoPlay: <?php if ($galleryautoplay == 'on') { echo esc_js('true'); } else { echo esc_js('false'); } ?>,
            slideTransitionDelay: <?php if(!empty($galleryautoplayduration)) { echo esc_js($galleryautoplayduration); } else { echo esc_js('4'); } ?>000,
            sliderWidth: "100%",
            sliderHeight: "100%",
            slideTransitionEasing: 'easeInOutQuint',
            slideTransitionSpeed: 1000,
            sliderResizable: true,
            sliderKeepAspectRatio: false,
            slideTransitionDirection: "left",
            allowKeyboardEvents: false,
            slidesDraggable: false,
            showDots: <?php if ($hidedots != "true") { echo esc_js('true'); } else { echo esc_js('false'); } ?>,
            showTimer: <?php if ($hidetimer != "true") { echo esc_js('true'); } else { echo esc_js('false'); } ?>,
            showArrows: <?php if ($hidearrows != "true") { echo esc_js('true'); } else { echo esc_js('false'); } ?>,
            showPause: <?php if ($hideplaypause != "true") { echo esc_js('true'); } else { echo esc_js('false'); } ?>
        });
        });
    </script>