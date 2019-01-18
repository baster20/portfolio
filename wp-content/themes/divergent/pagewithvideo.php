<?php	
/*
Template Name: Page with video
*/
?>
<?php get_header('slider'); ?>
<?php if ( function_exists( 'divergent_page_video_template') ) { ?>
<?php divergent_page_video_template(); ?>
<?php } else { ?>
<div id="site-error">
        <h3><?php esc_attr_e( 'You should upload/activate "Divergent Features" plugin to use this page template.', 'divergent'); ?></h3>
</div>
<div>
<?php } ?>
<?php get_footer(); ?>