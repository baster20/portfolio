<?php
		
$args = array(
    'post_type' => 'dvtestimonials',
    'posts_per_page'  => 99
);

$the_query = new WP_Query( $args );

if (is_rtl()) { 
    $array_rev = array_reverse($the_query->posts);
    $the_query->posts = $array_rev;
}

if ( $the_query->have_posts() ) {
    $random = rand();   
?>

<div id="testimonials<?php echo esc_attr($random); ?>">
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <?php $dvquotecontent = get_post_meta( get_the_id(), 'dvquotecontent', true ); ?>
    <div>
        <blockquote>
            <?php echo apply_filters('the_content',$dvquotecontent); ?>
            <p class="cite"><?php the_title(); ?></p>
        </blockquote>
    </div>
    <?php endwhile; ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#testimonials<?php echo esc_js($random); ?>').quovolver({
        transitionSpeed: 200,
        autoPlay: <?php echo esc_js($autoplay); ?>,
        autoPlaySpeed: <?php echo esc_js($duration); ?>000,
        equalHeight: false,
        navPosition: 'below',
        navPrev: <?php echo esc_js($arrows); ?>,
        navNext: <?php echo esc_js($arrows); ?>,
        navPrevText:"<i class='fa fa-chevron-left'></i>",
        navNextText:"<i class='fa fa-chevron-right'></i>",
        navNum: <?php echo esc_js($numbers); ?>
    });   
});
</script>

<?php }
wp_reset_postdata();
?>