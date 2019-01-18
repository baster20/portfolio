<?php 
$xlposts = get_option('divergent_xlposts');
if ($xlposts != "true") {
    get_header(); 
}
else {
    get_header('large');
}
?>
<?php $divergent_remove_sharing = get_option('divergent_remove_sharing'); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<?php $secondimage = get_post_meta( get_the_id(), 'divergent_featured_image_key', true ); ?>
<?php if (!empty($secondimage)) { ?>
<div class="img-mobile-only">
    <img src="<?php echo esc_url($secondimage); ?>" alt="" />
</div>
<?php } ?>
<article class="cv-page-content">
    <h1 class="border"><?php the_title(); ?></h1>
    <p class="page-date"><?php echo esc_attr(the_time(get_option('date_format'))); ?></p>
    <?php the_content(); ?>
    <?php $blogmeta = get_option('divergent_removemeta'); ?>                
            <?php if ($blogmeta != "true") { ?>
            <div class="blogmetadata">
                <p><strong><?php esc_attr_e( 'Author: ', 'divergent' ); ?></strong><?php the_author(); ?><span> | </span><strong><?php esc_attr_e( 'Category: ', 'divergent' ); ?></strong><?php the_category(', '); ?>
                    <?php if( has_tag() ) { ?>  
                    <span>| </span><strong><?php esc_attr_e( 'Tags: ', 'divergent' ); ?></strong><?php the_tags('',', ', ''); ?> 
                    <?php } ?>   
                </p>
            </div>
            <?php } ?>
    <?php wp_link_pages(); ?>
    <?php 
if ( $divergent_remove_sharing != 'true' ) {   
    get_template_part( 'includes/share', 'template');
}
?> 
    <?php comments_template(); ?>
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
<?php 
if ($xlposts != "true") {
    get_footer(); 
}
else {
    get_footer('large');
}
?>