<?php
function register_dvsections_posttype() {
    $labels = array(
        'name'              => esc_attr__( 'Sections', 'divergentcpt' ),
        'singular_name'     => esc_attr__( 'Section', 'divergentcpt' ),
        'add_new'           => esc_attr__( 'Add new section', 'divergentcpt' ),
        'add_new_item'      => esc_attr__( 'Add new section', 'divergentcpt' ),
        'edit_item'         => esc_attr__( 'Edit section', 'divergentcpt' ),
        'new_item'          => esc_attr__( 'New section', 'divergentcpt' ),
        'view_item'         => esc_attr__( 'View section', 'divergentcpt' ),
        'search_items'      => esc_attr__( 'Search sections', 'divergentcpt' ),
        'not_found'         => esc_attr__( 'No section found', 'divergentcpt' ),
        'not_found_in_trash'=> esc_attr__( 'No section found in trash', 'divergentcpt' ),
        'parent_item_colon' => esc_attr__( 'Parent sections:', 'divergentcpt' ),
        'menu_name'         => esc_attr__( 'Sections', 'divergentcpt' )
    );

    $taxonomies = array();
 
    $supports = array('title','editor','thumbnail');
 
    $post_type_args = array(
        'labels'            => $labels,
        'singular_label'    => esc_attr__('Section', 'divergentcpt'),
        'public'            => true,
        'exclude_from_search' => true,
        'show_ui'           => true,
        'show_in_nav_menus' => false,
        'publicly_queryable'=> true,
        'query_var'         => true,
        'capability_type'   => 'post',
        'has_archive'       => false,
        'hierarchical'      => false,
        'rewrite'           => array( 'slug' => 'sections', 'with_front' => false ),
        'supports'          => $supports,
        'menu_position'     => 99,
        'menu_icon'         => 'dashicons-admin-page',
        'taxonomies'        => $taxonomies
    );
    register_post_type('dvsections',$post_type_args);
}
add_action('init', 'register_dvsections_posttype');

function divergent_map( $meta_boxes ) {
    $prefix = 'divergent'; // Prefix for all fields
    $meta_boxes['divergent_mapbox'] = array(
        'id' => 'divergent_mapbox',
        'title' => esc_attr__( 'Google Map (Optional)', 'divergentcpt'),
        'object_types' => array('dvsections'), // post type
        'context' => 'normal',
        'priority' => 'default',
        'show_names' => false, // Show field names on the left
        'fields' => array(
            array(
                'desc' => esc_attr__( 'Activate Google Map ( Find your Coordinates; mondeca.com/index.php/en/any-place-en )', 'divergentcpt'),
                'id' => $prefix . 'dvmap',
                'type' => 'checkbox'
            ),
            array(
                'desc' => esc_attr__( 'Latitude', 'divergentcpt'),
                'id' => $prefix . 'dvlocation_latitude',
                'default' => '40.71278',
                'type' => 'text'
            ),
            array(
                'desc' => esc_attr__( 'Longitude', 'divergentcpt'),
                'id' => $prefix . 'dvlocation_longitude',
                'default' => '-74.00594',
                'type' => 'text'
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'cmb2_meta_boxes', 'divergent_map' );
?>