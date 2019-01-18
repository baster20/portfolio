<?php get_header(); ?>
        <div class="blog-title">
            <h1 class="border">
                <?php the_archive_title( '', '' ); ?>
            </h1>
        </div>
<?php while($wp_query->have_posts()) : $wp_query->the_post(); ?>
        <article class="blogcontainer">
            <div <?php post_class(); ?>  id="post-<?php the_ID(); ?>">
            <?php if ( has_post_thumbnail() ) { ?>
                <?php 
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
$thumb_url = $thumb_url_array[0];
                ?>
            <a href="<?php the_permalink(); ?>">
                <div class="blog-img" data-image="<?php echo esc_url($thumb_url); ?>">
                    <div class="blog-img-caption">
                        <h4><?php the_title(); ?></h4>
                    </div>
                </div>
            </a>
            <?php } else { ?>
                <a class="without-featured-link" href="<?php the_permalink(); ?>">
                    <div class="without-featured-title">
                        <h4><?php the_title(); ?></h4>
                    </div>
                </a>
            <?php } ?>
            <div class="postdate"><strong><?php echo esc_attr(the_time(get_option('date_format'))); ?></strong>
            </div>
            <!-- POST CONTENT -->
            <div class="postcontent">
                <?php the_excerpt(); ?>
            </div>
            </div>
        </article>
<?php endwhile; ?>
<div class="blogpager">
<?php if ( $wp_query->max_num_pages > 1 ) : ?>   
            <div class="previous">
                <?php next_posts_link( esc_attr__( '&#8249; Older posts', 'divergent' ) ); ?>
            </div>
            <div class="next">
                <?php previous_posts_link( esc_attr__( 'Newer posts &#8250;', 'divergent' ) ); ?>
            </div>
<?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>
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