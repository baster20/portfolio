<?php
if (empty($categoryid)) {
    $dvblogargs = array(
        'posts_per_page' => $max
    );
}
else {
    $dvblogargs = array(
        'posts_per_page' => $max,
        'cat' => $categoryid
    );
}
$dvblog_query = new WP_Query( $dvblogargs );
?>
<div class="blog-shortcode-container">
<?php while($dvblog_query->have_posts()) : $dvblog_query->the_post(); ?>
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
<?php if (!empty($viewall)) { ?>
<!-- VIEW ALL BUTTON -->
<div class="blogpager">
    <div class="previous viewall">
        <a class="cv-button" href="<?php if ( $categoryid == '' ) { echo get_permalink( get_option( 'page_for_posts' ) ); } else { echo get_category_link( $categoryid ); } ?>"><?php echo esc_attr($viewall); ?></a>
    </div>
</div>
<?php } ?>
</div>    
<?php wp_reset_postdata(); ?>