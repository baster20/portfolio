<?php
/* ----------------------------------------------------------
Square grid gallery widget
------------------------------------------------------------- */

add_action( 'widgets_init', 'dv_dvsquare_widget' );

function dv_dvsquare_widget() {
	register_widget( 'dv_dvsquarewidget' );
}

class dv_dvsquarewidget extends WP_Widget {

    function __construct() {
		parent::__construct(
			'dv-dvsquare-widget', // Base ID
			esc_attr__('DV Square Grid', 'divergentcpt'), // Name
			array( 'description' => esc_attr__('DV Square Grid Gallery Widget.', 'divergentcpt'), ) // Args
		);
	}
	
	public function widget( $args, $instance ) {
		extract( $args );
        $max = $instance['max'];
        $categoryid = $instance['categoryid'];

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}  
        echo do_shortcode("[dvsquare max='" . esc_attr($max) . "' categoryid='" . esc_attr($categoryid) . "']");
		
		echo $args['after_widget'];
	}
	 
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['max'] = $new_instance['max'];
        $instance['categoryid'] = $new_instance['categoryid'];

		return $instance;
	}
	
	public function form( $instance ) {
		$defaults = array( 'title' => '', 'max' => '99');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_attr_e('Title:', 'divergentcpt'); ?></label>
    <input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
</p>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'max' )); ?>"><?php esc_attr_e('Maximum number of galleries:', 'divergentcpt'); ?></label>
    <input id="<?php echo esc_attr($this->get_field_id( 'max' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'max' )); ?>" value="<?php if (isset($instance['max'])) { echo esc_attr($instance['max']); } ?>" onkeypress="return validate(event)" type="number" style="width:100%;" />
</p>
<?php $squareterms = get_terms( 'dvgallerytaxonomy'); ?>
<p>
    <label for="<?php echo esc_attr($this->get_field_id( 'categoryid' )); ?>"><?php esc_attr_e('Select Category:', 'divergentcpt'); ?></label>
    <select name="<?php echo esc_attr($this->get_field_name( 'categoryid' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'categoryid' )); ?>">
        <option value=""><?php esc_attr_e('All Categories', 'divergentcpt'); ?></option>        
        <?php if ($squareterms && !is_wp_error($squareterms)) { ?>
        <?php foreach( $squareterms as $term ) { ?>
        <?php $termname = $term->name; ?>
        <?php $termid = $term->term_id; ?>
        <option value="<?php echo esc_attr($termid) ?>" <?php if (isset($instance['categoryid'])) { if ($instance['categoryid'] == $termid) { echo esc_attr('selected="selected"'); }} ?>><?php echo esc_attr($termname) ?></option>
        <?php } ?>
        <?php } ?>
    </select>
</p>
<?php }} ?>