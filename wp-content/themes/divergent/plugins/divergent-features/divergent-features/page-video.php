<?php
$startat = get_option('divergent_video_startat');
$stopat = get_option('divergent_video_stopat');
$mute = get_option('divergent_video_mute');
$autoplay = get_option('divergent_video_autoplay');
$loop = get_option('divergent_video_loop');
$quality = get_option('divergent_video_quality');
$showcontrols = get_option('divergent_video_showcontrols');
$showytlogo = get_option('divergent_video_showytlogo');
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php $videoid = get_post_meta( get_the_id(), 'divergentvideoid', true ); ?>
<div id="cv-page-left">
    <div class="cv-youtube-player" data-property="{videoURL:'http://youtu.be/<?php if (!empty($videoid)) { echo esc_attr($videoid); } else { echo esc_attr('keDneypw3HY'); } ?>',containment:'#cv-page-left',startAt:<?php if ((!empty($startat)) || ($startat == '0')) { echo esc_attr($startat); } else { echo esc_attr('0'); } ?>,stopAt:<?php if ((!empty($stopat)) || ($stopat == '0')) { echo esc_attr($stopat); } else { echo esc_attr('0'); } ?>,mute:<?php if (!empty($mute)) { echo esc_attr($mute); } else { echo esc_attr('true'); } ?>,autoPlay:<?php if (!empty($autoplay)) { echo esc_attr($autoplay); } else { echo esc_attr('true'); } ?>,loop:<?php if (!empty($loop)) { echo esc_attr($loop); } else { echo esc_attr('false'); } ?>,quality:'<?php if (!empty($quality)) { echo esc_attr($quality); } else { echo esc_attr('default'); } ?>',showControls:<?php if (!empty($showcontrols)) { echo esc_attr($showcontrols); } else { echo esc_attr('true'); } ?>,showYTLogo:<?php if (!empty($showytlogo)) { echo esc_attr($showytlogo); } else { echo esc_attr('true'); } ?>}">
    </div>   
</div>
<div id="cv-page-right">
<div class="video-mobile-only">
            <div class="flex-video">
                <iframe src="http://www.youtube.com/embed/<?php if (!empty($videoid)) { echo esc_attr($videoid); } else { echo esc_attr('keDneypw3HY'); } ?>?wmode=transparent"></iframe>
            </div>
        </div>   
<article class="cv-page-content">
    <h1 class="border"><?php the_title(); ?></h1>
    <?php the_content(); ?>
    <?php wp_link_pages(); ?>
</article>
<?php endwhile; ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        if (jQuery(window).width() > 1024) {
            jQuery('body').find(".cv-youtube-player").mb_YTPlayer();
        }
    });
</script>