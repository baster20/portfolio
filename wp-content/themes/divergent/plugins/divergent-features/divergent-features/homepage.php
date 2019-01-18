<?php
$name = get_option('divergent_name');
$surname = get_option('divergent_surname');
$additional = get_option('divergent_additional');
$leftimage = get_option('divergent_leftimage');
$rightimage = get_option('divergent_rightimage');
$rightimage = get_option('divergent_rightimage');
$hideicons = get_option('divergent_hideicons');
$mapmarker = get_option('divergent_mapmarker');
$mapzoom = get_option('divergent_mapzoom');
$grayscale = get_option('divergent_grayscale');
$logo = get_option('divergent_logo');
?>
<?php
$sectionsargs = array(
    'post_type' => 'dvsections',
    'posts_per_page' => 99
);
$sections_query = new WP_Query( $sectionsargs );
$count = 2;
?>
<!-- LEFT SLIDER -->
    <div class="cv-left-slider">
        <div id="cv-left-slider">
            <!-- 1. SLIDE -->
            <div>
                <?php if (!empty($leftimage)) { ?>
                <img src="<?php echo esc_url($leftimage); ?>" alt="">
                <?php } else { ?>
                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/placeholder.jpg'); ?>" alt="">
                <?php } ?>
                <?php if ((!empty($name)) && (empty($logo))) { ?>
                <div id="home-slide-title">
                    <span><?php echo esc_attr($name); ?></span>
                </div>
                <?php } ?>
            </div>
            <?php while($sections_query->have_posts()) : $sections_query->the_post(); ?>
            <?php $showmap = get_post_meta( get_the_id(), 'divergentdvmap', true ); ?>
            <?php divergent_map_scripts_output($showmap); ?>
            <?php if ($showmap == "on") { ?>
            <div>
                <!-- GOOGLE MAP -->
                <div class="google-map-container">
                    <div id="google-map<?php the_ID(); ?>" class="google-map"></div>
                </div>
            </div>
            <?php } elseif (has_post_thumbnail()) { ?>
            <?php 
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
$thumb_url = $thumb_url_array[0];  
            ?>
            <img src="<?php echo esc_url($thumb_url); ?>" alt="">
            <?php } else { ?>
            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/placeholder.jpg'); ?>" alt="">
            <?php } ?>
            <?php endwhile; ?>
        </div>
    </div>
    <!-- PAGES -->
    <div id="ascensorBuilding">
        <section class="floor floor-1">
            <div id="home-image">
                <div id="home-title">
                    <?php if (empty($logo)) { ?>
                    <?php if ((!empty($name)) || (!empty($surnamename))) { ?>
                    <h1>
                        <?php if (!empty($name)) { ?>
                        <span class="mobile-title"><?php echo esc_attr($name); ?></span>
                        <?php } ?>
                        <?php if (!empty($surname)) { ?>
                        <span><?php echo esc_attr($surname); ?></span>
                        <?php } ?>
                    </h1>
                    <?php } ?>
                    <?php } else { ?>
                    <div class="cv-logo">
                        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($name); ?> <?php echo esc_attr($surname); ?>" />
                    </div>
                    <?php } ?>
                    <?php if (!empty($additional)) { ?>
                    <p><?php echo esc_attr($additional); ?></p>
                    <?php } ?>
                </div>
                <!-- SOCIAL ICONS -->
                <?php $dvsocialicons = dvsocial_get_option( 'dvsocialicons' ) ?>
                <?php if (($hideicons != "true") && (!empty($dvsocialicons))) { ?>
                <div id="cv-home-social-bar-container">
                    <nav id="cv-home-social-bar">
                        <ul>
                            <?php 
    foreach ( (array) $dvsocialicons as $key => $entry ) { 
    $dvicontitle = $dviconimg = $dviconcustom = $dviconlink  = '';
    if ( isset( $entry['dvicontitle'] ) ) {
        $dvicontitle = $entry['dvicontitle'];
    }
    if ( isset( $entry['dviconimg'] ) ) {            
        $dviconimg = $entry['dviconimg'];
    }
    if ( isset( $entry['dviconcustom'] ) ) {            
        $dviconcustom = $entry['dviconcustom'];
    }
    if ( isset( $entry['dviconlink'] ) ) {            
        $dviconlink = $entry['dviconlink'];
    } 
                            ?>
                            <li>
                                <a href="<?php echo esc_url($dviconlink); ?>" class="fa fa-<?php if (empty($dviconcustom)) { echo esc_attr($dviconimg); } else { echo esc_attr($dviconcustom); } ?> tooltip-social" title="<?php echo esc_attr($dvicontitle); ?>"><?php echo esc_attr($dvicontitle); ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
                <?php } ?>
            </div>
            <script type="text/javascript">
                <?php if (!empty($rightimage)) { ?>
                jQuery(document).ready(function () {
                    "use strict";
                    jQuery('#home-image').backstretch("<?php echo esc_js($rightimage); ?>");
                });
                <?php } else { ?>
                jQuery(document).ready(function () {
                    "use strict";
                    jQuery('#home-image').backstretch("<?php if (!empty($defaultimg)) { echo esc_js($defaultimg); } else { echo esc_js( get_template_directory_uri() . '/images/placeholder.jpg'); } ?>");
                });
                <?php } ?>
            </script>
        </section>
        <?php while($sections_query->have_posts()) : $sections_query->the_post(); ?>
        <?php $mobileimage = get_post_meta( get_the_id(), 'divergent_featured_image_key', true ); ?>
        <?php $showmap = get_post_meta( get_the_id(), 'divergentdvmap', true ); ?>
        <?php $latitute = get_post_meta( get_the_id(), 'divergentdvlocation_latitude', true ); ?>
        <?php $longitude = get_post_meta( get_the_id(), 'divergentdvlocation_longitude', true ); ?>
        <section class="floor floor-<?php echo $count++; ?>">
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
            <div class="cv-page-content">
                <?php the_content(); ?>
            </div>
        </section>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>