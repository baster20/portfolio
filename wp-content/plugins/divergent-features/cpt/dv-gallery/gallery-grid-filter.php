<?php
$galleryfilterargs = array(
    'post_type' => 'dvgalleries',
    'posts_per_page' => $max
);
$filtergallery_query = new WP_Query( $galleryfilterargs );
$random = rand();
$offset = get_option('divergent_spaceoffset');
$lgzoom = get_option('divergent_lgzoom');
$lgfullscreen = get_option('divergent_lgfullscreen');
$lgthumbnails = get_option('divergent_lgthumbnails');
$lgdownload = get_option('divergent_lgdownload');
$lgcounter = get_option('divergent_lgcounter');
$lghide = get_option('divergent_lghide');
?>
<?php $terms = get_terms( 'dvgallerytaxonomy'); ?>
<?php if ($terms && !is_wp_error($terms)) { ?>
<ul id="cvfilters<?php echo esc_attr($random); ?>" class="cvfilters">
<li data-filter="gridall" class="gridactive"><?php esc_attr_e( 'All', 'divergentcpt') ?></li>
<?php 
foreach( $terms as $term ) { 
$termname = $term->name;
$termid = $term->term_id;
?>
<li data-filter="<?php echo esc_attr('dvfilter' . $termid); ?>"><?php echo esc_attr($termname); ?></li>
<?php } ?>
</ul>
<div class="clear"></div>
<?php } ?>
<ul id="cvgrid<?php echo esc_attr($random); ?>" class="cvgrid">
    <?php while($filtergallery_query->have_posts()) : $filtergallery_query->the_post(); ?>
    <?php $looprandom = rand(); ?>
    <?php $gallerytext = get_post_meta( get_the_id(), 'dvgallerytext', true ); ?>
    <?php $gallerytype = get_post_meta( get_the_id(), 'dvgallerytype', true ); ?>
    <?php $galleryimages = get_post_meta( get_the_id(), 'dvgalleryimages', true ); ?>
    <?php $galleryvideos = get_post_meta( get_the_id(), 'dvgalleryvideos', true ); ?>
    <?php $externallink = get_post_meta( get_the_id(), 'dvexternallink', true ); ?>
    <?php $newindow = get_post_meta( get_the_id(), 'dvblank', true ); ?>
    <?php $gridterms = get_the_terms( get_the_id(), 'dvgallerytaxonomy' ); ?>
    <?php $galleryautoplay = get_post_meta( get_the_id(), 'dvactivateauto', true ); ?>
    <?php $galleryautoplayduration = get_post_meta( get_the_id(), 'dvautoplaypause', true ); ?>
    <?php if ($gridterms && !is_wp_error($gridterms)) {
    $filter_links = array();
	foreach ( $gridterms as $gridterm ) {
		$filter_links[] = '"dvfilter' . esc_attr($gridterm->term_id) . '"';
	}					
	$filters = join( ", ", $filter_links );
    ?>
    <li data-filter-class='["gridall",<?php echo $filters; ?>]'>
    <?php } else { ?>
    <li data-filter-class='["gridall"]'>
    <?php } ?>
    <figure id="cvgridbox<?php echo esc_attr($looprandom); ?><?php the_ID(); ?>">
        <?php if ( has_post_thumbnail() ) { ?>
        <?php 
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
$thumb_url = $thumb_url_array[0];  
        ?>
        <a href="<?php if ($gallerytype == 'link') { echo esc_url($externallink); } else {echo esc_attr('#');} ?>" class="<?php if ($gallerytype == 'photo') { echo esc_attr('openlightbox cvgrid-img'); } ?> <?php if ($gallerytype == 'video') { echo esc_attr('openlightbox cvgrid-video'); } ?> <?php if ($gallerytype == 'link') { echo esc_attr('cvgrid-link'); } ?>" <?php if ($newindow == 'on') { echo 'target="_blank"'; } ?>>
            <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($gallerytext); ?>" />
        </a>
        <?php } ?>
        <figcaption>
            <?php if(!empty ($gallerytext)) { ?>
            <a href="<?php if ($gallerytype == 'link') { echo esc_url($externallink); } else {echo esc_attr('#');} ?>" class="<?php if ($gallerytype == 'photo') { echo esc_attr('openlightbox cvgrid-img'); } ?> <?php if ($gallerytype == 'video') { echo esc_attr('openlightbox cvgrid-video'); } ?> <?php if ($gallerytype == 'link') { echo esc_attr('cvgrid-link'); } ?>" <?php if ($newindow == 'on') { echo 'target="_blank"'; } ?>>
            <div class="cvgrid-title">
                <?php echo esc_attr($gallerytext); ?>
            </div>
            </a>
            <?php } ?>
            <?php if (($gallerytype != 'video') && (!empty($galleryimages))) { ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#cvgridbox<?php echo esc_js($looprandom); ?><?php the_ID(); ?> .openlightbox').click(function (e) {
            e.preventDefault();
            jQuery(this).lightGallery({
                dynamic: true,
                    preload: 2,
                    zoom: <?php if (!empty($lgzoom)) { echo esc_js($lgzoom); } else { echo esc_js('true'); } ?>,
                    fullScreen: <?php if (!empty($lgfullscreen)) { echo esc_js($lgfullscreen); } else { echo esc_js('true'); } ?>,
                    thumbnail: <?php if (!empty($lgthumbnails)) { echo esc_js($lgthumbnails); } else { echo esc_js('true'); } ?>,
                    download: <?php if (!empty($lgdownload)) { echo esc_js($lgdownload); } else { echo esc_js('true'); } ?>,
                    counter: <?php if (!empty($lgcounter)) { echo esc_js($lgcounter); } else { echo esc_js('true'); } ?>,
                    hideBarsDelay: <?php if (!empty($lghide)) { echo esc_js($lghide); } else { echo esc_js('6'); } ?>000,
                <?php if ($galleryautoplay == 'on') { ?>
                autoplay: true,
                pause: <?php if(!empty($galleryautoplayduration)) { echo esc_js($galleryautoplayduration); } else { echo esc_js('4'); } ?>000,
                <?php } ?>
                dynamicEl: [
                    <?php foreach ($galleryimages as $image => $link) { ?> 
                    <?php $fullimage = wp_get_attachment_image_src( $image, 'full' ); ?>
                    <?php $large = wp_get_attachment_image_src( $image, 'large' ); ?>
                    <?php $medium = wp_get_attachment_image_src( $image, 'medium' ); ?>
                    <?php $thumb = wp_get_attachment_image_src( $image, 'thumbnail' ); ?>
                    <?php $attachment = get_post($image); ?>
                    {
                        "src": "<?php echo esc_js($fullimage['0']); ?>",
                        "thumb": "<?php echo esc_js($thumb['0']); ?>",
                        "subHtml": "<?php echo esc_js($attachment->post_excerpt); ?>",
                        "responsive": "<?php echo $medium[0]; ?> 480, <?php echo $large[0]; ?> 1024"
                    },
                    <?php } ?>                    
                ]
            });
        })
    });
</script> 
        <?php } if (($gallerytype == 'video') && (!empty($galleryvideos))) { ?>
        <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('#cvgridbox<?php echo esc_js($looprandom); ?><?php the_ID(); ?> .openlightbox').click(function (e) {
                e.preventDefault();
                jQuery(this).lightGallery({
                    youtubePlayerParams: {rel: 0},
                    dynamic: true,
                    zoom: false,
                    fullScreen: false,
                    autoplay: false,
                    autoplayControls: false,
                    thumbnail: false,
                    download: <?php if (!empty($lgdownload)) { echo esc_js($lgdownload); } else { echo esc_js('true'); } ?>,
                    counter: <?php if (!empty($lgcounter)) { echo esc_js($lgcounter); } else { echo esc_js('true'); } ?>,
                    hideBarsDelay: <?php if (!empty($lghide)) { echo esc_js($lghide); } else { echo esc_js('6'); } ?>000,
                    dynamicEl: [
                        <?php foreach ($galleryvideos as $video => $link) { ?> 
                        <?php if (isset($link['dvvideourl'])) { $videourl = esc_js($link['dvvideourl']); } ?>
                        <?php if (isset($link['dvvideotitle'])) { $videotitle = esc_js($link['dvvideotitle']); } ?>
                        {
                            "src": "<?php if (isset($link['dvvideourl'])) { echo esc_js($videourl); } ?>",
                            "subHtml": "<?php if (isset($link['dvvideotitle'])) { echo esc_js($videotitle); } ?>",
                        },
                        <?php } ?>
                    ]
                });
            })
        });
    </script>
        <?php } ?> 
        </figcaption>
    </figure>        
    </li>
<?php endwhile; ?>
</ul>
<div class="clear"></div>
<?php $align = esc_attr(get_option('divergent_thumbnailalign')); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        "use strict";
        var wookmark;
        imagesLoaded('#cvgrid<?php echo esc_js($random); ?>', function () {
            wookmark = new Wookmark('#cvgrid<?php echo esc_js($random); ?>', {
                itemWidth: <?php if (!empty($itemwidth)) { echo esc_js($itemwidth); } else { echo esc_js('250'); } ?>,
                autoResize: true,
                resizeDelay: 500,
                <?php if (is_rtl()) { echo stripslashes(esc_js("direction: 'right',")); } ?>
                align: '<?php if (!empty($align)) { echo esc_js($align); } else { echo esc_js('left'); } ?>',
                container: jQuery('#cvgrid<?php echo esc_js($random); ?>'),
                offset: <?php if (!empty($offset)) { echo esc_js($offset); } elseif ($offset == '0') { echo esc_js('0'); } else { echo esc_js('20'); } ?>,
                outerOffset: 0,
                fillEmptySpace: false,
                flexibleWidth: '100%'
            });
            setTimeout(function(){
                jQuery("#cvgrid<?php echo esc_js($random); ?>").css('visibility','visible');
                jQuery('#cvgrid<?php echo esc_js($random); ?>').find('li').addClass('cvgrid-animate');
            }, 500);
        });
        var $filters = jQuery('#cvfilters<?php echo esc_attr($random); ?> li');
        var onClickFilter = function (event) {
        var $item = jQuery(event.currentTarget),
            itemActive = $item.hasClass('gridactive');
            if (!itemActive) {
                $filters.removeClass('gridactive');
                itemActive = true;
            } else {
                itemActive = false;
            }
            $item.toggleClass('gridactive');
            wookmark.filter(itemActive ? [$item.data('filter')] : []);
        }
        jQuery('#cvfilters<?php echo esc_attr($random); ?>').on('click.wookmark-filter', 'li', onClickFilter);
    });
    jQuery(window).on('resize orientationchange', function () {
        "use strict";
        jQuery('#cvgrid<?php echo esc_js($random); ?>').find('li').removeClass('cvgrid-animate');
    });
</script>
<?php wp_reset_postdata(); ?>