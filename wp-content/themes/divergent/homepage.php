<?php	
/*
Template Name: Homepage
*/
?>
<?php get_header('homepage'); ?>
<?php if ( function_exists( 'divergent_homepage_template') ) { ?>
<?php divergent_homepage_template(); ?>
<?php } else { ?>
<div id="site-error">
        <h3><?php esc_attr_e( 'You should upload/activate "Divergent Features" plugin to use this page template.', 'divergent'); ?></h3>
</div>
<?php } ?>
<?php get_footer('homepage'); ?>