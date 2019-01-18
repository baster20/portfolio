<?php get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php $secondimage = get_post_meta( get_the_id(), 'divergent_featured_image_key', true ); ?>
<?php if (!empty($secondimage)) { ?>
<div class="img-mobile-only">
    <img src="<?php echo esc_url($secondimage); ?>" alt="" />
</div>
<?php } ?>
<article class="cv-page-content">
    <h1 class="border"><?php the_title(); ?></h1>
    <?php the_content(); ?>
    <?php wp_link_pages(); ?>
</article>
<?php endwhile; ?>
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
<?php get_footer(); ?>