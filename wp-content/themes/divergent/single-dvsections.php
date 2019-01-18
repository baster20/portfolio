<?php get_header(); ?>
<?php
$mapmarker = get_option('divergent_mapmarker');
$mapzoom = get_option('divergent_mapzoom');
$grayscale = get_option('divergent_grayscale');
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php $mobileimage = get_post_meta( get_the_id(), 'divergent_featured_image_key', true ); ?>
<?php $showmap = get_post_meta( get_the_id(), 'divergentdvmap', true ); ?>
<?php $latitute = get_post_meta( get_the_id(), 'divergentdvlocation_latitude', true ); ?>
<?php $longitude = get_post_meta( get_the_id(), 'divergentdvlocation_longitude', true ); ?>
<?php divergent_map_scripts_output($showmap); ?>
<?php if ($showmap == "on") { ?>
            <div class="mobile-map-container">
                <div id="mobile-map<?php the_ID(); ?>" class="mobile-map"></div>
            </div>
            <script type="text/javascript">
                    jQuery(document).ready(function(){    
                        jQuery("#google-map<?php the_ID(); ?>").dvmap({
                            fullscreen: 'google-map<?php the_ID(); ?>',
                            mobile: 'mobile-map<?php the_ID(); ?>',
                            latitute: '<?php if (!empty($latitute)) { echo esc_js($latitute); } else { echo esc_js('40.714353'); } ?>',
                            longitude: '<?php if (!empty($longitude)) { echo esc_js($longitude); } else { echo esc_js('-74.005973'); } ?>',
                            mapmarker: '<?php if (!empty($mapmarker)) { echo esc_js($mapmarker); } else { echo esc_js( get_template_directory_uri() . '/images/pin.png'); } ?>',
                            zoom:<?php if (!empty($mapzoom)) { echo esc_js($mapzoom); } else { echo esc_js('17'); } ?>,
                            grayscale:<?php if ($grayscale != "true") { echo esc_js('true'); } else { echo esc_js('false'); } ?>
                        });
                    });    
                </script>
            <?php } elseif (!empty($mobileimage)) { ?>
            <div class="img-mobile-only">
                <img src="<?php echo esc_url($mobileimage); ?>" alt="" />
            </div>
            <?php } ?>
<article class="cv-page-content">
    <?php the_content(); ?>
    <?php wp_link_pages(); ?>
</article>
<?php endwhile; ?>
<?php $defaultimg = get_option('divergent_defaultimage'); ?>
    <script type="text/javascript">
        <?php if ($showmap == "on") { ?>
            "use strict";
            jQuery( "#cv-page-left" ).append( '<div class="google-map-container"><div id="google-map<?php the_ID(); ?>" class="google-map"></div></div>' );
        <?php } elseif (has_post_thumbnail()) { ?>
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
<?php get_footer(); ?>