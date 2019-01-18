<?php
/* ----------------------------------------------------------
Iframe widget
------------------------------------------------------------- */

add_action( 'widgets_init', 'divergent_iframe_widget' );

function divergent_iframe_widget() {
	register_widget( 'divergent_iframewidget' );
}

class divergent_iframewidget extends WP_Widget {

    function __construct() {
		parent::__construct(
			'divergent-iframe-widget', // Base ID
			esc_attr__('DV Iframe', 'divergentcpt'), // Name
			array( 'description' => esc_attr__('Responsive Iframe Widget', 'divergentcpt'), ) // Args
		);
	}
	
	public function widget( $args, $instance ) {
		extract( $args );
        $iframeurl = $instance['iframeurl'];

		echo $args['before_widget'];
        
        if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
     
        echo do_shortcode('[iframecode url="' . esc_url($iframeurl) . '"]');
		
		echo $args['after_widget'];
	}
	 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['iframeurl'] = $new_instance['iframeurl'];

		return $instance;
	}

	
	public function form( $instance ) {
		$defaults = array( 'title' => '', 'iframeurl' => 'https://www.youtube.com/embed/kuceVNBTJio');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Title:', 'divergentcpt'); ?></label>
    <input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
</p>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'iframeurl' )); ?>"><?php esc_attr_e('Iframe Url:', 'divergentcpt'); ?></label>
    <input id="<?php echo esc_attr($this->get_field_id( 'iframeurl' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'iframeurl' )); ?>" value="<?php if (isset($instance['iframeurl'])) { echo esc_attr($instance['iframeurl']); } ?>" style="width:100%;" />
</p>
<?php }} ?>
<?php

/* ----------------------------------------------------------
Flickr widget
------------------------------------------------------------- */

add_action( 'widgets_init', 'divergent_flickr_widget' );

function divergent_flickr_widget() {
	register_widget( 'divergent_flickrwidget' );
}

class divergent_flickrwidget extends WP_Widget {

    function __construct() {
		parent::__construct(
			'divergent-flickr-widget', // Base ID
			esc_attr__('DV Flickr', 'divergentcpt'), // Name
			array( 'description' => esc_attr__('Flickr Feed Widget', 'divergentcpt'), ) // Args
		);
	}
	
	public function widget( $args, $instance ) {
		extract( $args );
        $randomid = rand();
		$name = '<ul id="flickr' . esc_attr($randomid) . '" class="cv-flickr-box"></ul><div class="clear"></div>';
        $itemnumber = $instance['itemnumber'];
        $flickrid = apply_filters('widget_title', $instance['flickrid'] );

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		
		if ( $name ) {
			printf( $name );
        }
        
        if ( $flickrid ) { ?>
        
<script type="text/javascript">
jQuery(document).ready(function() {
"use strict";
jQuery('#flickr<?php echo esc_js($randomid); ?>').jflickrfeed({
    limit: <?php echo esc_js($itemnumber); ?>,
    qstrings: { id: "<?php echo $flickrid; ?>"},
    itemTemplate:
	'<li>' +
		'<a class="cv-flickr-photo" href="{{image_b}}" data-sub-html="{{title}}">' +
			'<img src="{{image_s}}" alt="{{title}}" />' +
		'</a>' +
	'</li>'
}, function () {
    jQuery("#flickr<?php echo esc_js($randomid); ?>").lightGallery({
        selector:'.cv-flickr-photo',
        mode: 'lg-slide-vertical',
        zoom:false,
        fullScreen:false,
        autoplay:false,
        autoplayControls :false,
        thumbnail:true,
        download:false,
        counter:true
    });
    jQuery(this).find('img').error(function(){jQuery(this).hide();});
});
});    
</script>
			
        <?php }		
		echo $args['after_widget'];
	}
	 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( esc_attr($new_instance['title']) ) : '';
        $instance['itemnumber'] = strip_tags( $new_instance['itemnumber'] );
        $instance['flickrid'] = strip_tags( $new_instance['flickrid'] );

		return $instance;
	}

	
	public function form( $instance ) {
		$defaults = array( 'title' => '', 'name' => '', 'itemnumber' => '10','flickrid' => '52617155@N08');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Title:', 'divergentcpt'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
		</p>
<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'itemnumber' )); ?>"><?php esc_attr_e('Maximum Item Number:', 'divergentcpt'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'itemnumber' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'itemnumber' )); ?>" value="<?php echo esc_attr($instance['itemnumber']); ?>" style="width:100%;" />
		</p>
<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'flickrid' )); ?>"><?php esc_attr_e('Flickr ID:', 'divergentcpt'); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'flickrid' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickrid' )); ?>" value="<?php echo esc_attr($instance['flickrid']); ?>" style="width:100%;" />
		</p>
<?php }} ?>
<?php

/* ----------------------------------------------------------
Latest Posts widget
------------------------------------------------------------- */

add_action( 'widgets_init', 'divergent_posts_widget' );

function divergent_posts_widget() {
	register_widget( 'divergent_postswidget' );
}

class divergent_postswidget extends WP_Widget {

    function __construct() {
		parent::__construct(
			'divergent-posts-widget', // Base ID
			esc_attr__('DV Latest Posts', 'divergentcpt'), // Name
			array( 'description' => esc_attr__('Latest Posts List Widget', 'divergentcpt'), ) // Args
		);
	}
	
	public function widget( $args, $instance ) {
		extract( $args );
        $maxposts = $instance['maxposts'];
        $displayimg = $instance['displayimg'];

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}  
        
        $posts_query = new WP_Query( array('posts_per_page' => $maxposts) );
?>
<ul class="cv-sidebar-posts">
    <?php while($posts_query->have_posts()) : $posts_query->the_post(); ?>
    <li class="<?php if ((!has_post_thumbnail()) || ($displayimg == 'no')) { echo esc_attr('withoutthumb'); } ?>">
        <?php if ((has_post_thumbnail()) && ($displayimg == 'yes')) { ?>
        <?php 
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail', true);
$thumb_url = $thumb_url_array[0];
        ?>
        <div class="cv-sidebar-posts-img">
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo esc_url($thumb_url); ?>" alt="" />
            </a>
        </div>
        <?php } ?>
        <a href="<?php the_permalink(); ?>" class="cv-sidebar-post-title"><?php the_title(); ?></a>
        <p class="cv-sidebar-post-date"><?php echo esc_attr(the_time(get_option('date_format'))); ?></p>
    </li>
    <?php endwhile; ?>
</ul>
<?php 
        wp_reset_postdata();
        echo $args['after_widget'];
	}
	 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['maxposts'] = $new_instance['maxposts'];
        $instance['displayimg'] = $new_instance['displayimg'];

		return $instance;
	}

	
	public function form( $instance ) {
		$defaults = array( 'title' => '', 'maxposts' => '4');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Title:', 'divergentcpt'); ?></label>
    <input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
</p>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'maxposts' )); ?>"><?php esc_attr_e('Maximum number of posts:', 'divergentcpt'); ?></label>
    <input id="<?php echo esc_attr($this->get_field_id( 'maxposts' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'maxposts' )); ?>" value="<?php if (isset($instance['maxposts'])) { echo esc_attr($instance['maxposts']); } ?>" onkeypress="return validate(event)" type="number" style="width:100%;" />
</p>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'displayimg' )); ?>"><?php esc_attr_e('Display Thumbnail:', 'divergentcpt'); ?></label>
    <select name="<?php echo esc_attr($this->get_field_name( 'displayimg' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'displayimg' )); ?>">
        <option value="yes" <?php if (isset($instance['displayimg'])) { if ($instance['displayimg'] == 'yes') { echo esc_attr('selected="selected"'); }} ?>>Yes</option>
        <option value="no" <?php if (isset($instance['displayimg'])) { if ($instance['displayimg'] == 'no') { echo esc_attr('selected="selected"'); }} ?>>No</option>
    </select>
</p>
<?php }} ?>