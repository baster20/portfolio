<?php get_header(); ?>
<article class="cv-page-content">
    <h1 class="border"><?php esc_attr_e('404 - Page Not Found!', 'divergent'); ?></h1>
    <div class="cv-box cv-light">
        <p><strong><?php esc_attr_e( 'You can return', 'divergent'); ?> <a href="<?php esc_url( home_url( '/' ) ); ?>/" title="<?php esc_attr_e( 'Home', 'divergent' ); ?>"><?php esc_attr_e( 'home', 'divergent'); ?></a> <?php esc_attr_e( 'or search for the page you were looking for;', 'divergent'); ?></strong></p>
    </div>
    <?php get_search_form(); ?>
</article>
<?php $blogimg = get_option('divergent_blogimage'); ?>
<?php $defaultimg = get_option('divergent_defaultimage'); ?>
    <script type="text/javascript">
        <?php if (!empty($blogimg)) { ?>
        jQuery(document).ready(function () {
            "use strict";
            jQuery('#cv-page-left').backstretch("<?php echo esc_js($blogimg); ?>");
        });
        <?php } else { ?>
        jQuery(document).ready(function () {
            "use strict";
            jQuery('#cv-page-left').backstretch("<?php if (!empty($defaultimg)) { echo esc_js($defaultimg); } else { echo esc_js( get_template_directory_uri() . '/images/placeholder.jpg'); } ?>");
        });
        <?php } ?>
    </script>
<?php get_footer(); ?>