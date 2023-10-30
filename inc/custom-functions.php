<?php

function provana_remove_js_css(){
global $post;   
/**thank you pages**/
if(is_page( 12085 ) ||  ( $post->post_parent == 12085 ) || is_page( 8552 ) || 'webinar_topices' == get_post_type() ):
    wp_dequeue_style( 'consulting-clac-style' );
    wp_dequeue_style( 'addtoany' );
    wp_dequeue_style( 'select2' ); 
    wp_dequeue_style( 'slick' );
 
    wp_dequeue_script( 'addtoany-jquery' );
    wp_dequeue_script( 'select2' );
    wp_dequeue_script( 'isotope' );
    wp_dequeue_script( 'addtoany-core' );
    wp_dequeue_script( 'slick' );
    wp_dequeue_script( 'Chart' );
endif;
/**End Homepage**/

} 
add_action( 'wp_enqueue_scripts', 'provana_remove_js_css', 100 );

/*****/
function video_testimonial_post_type() {
  
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Video Testimonials', 'Video Testimonials', 'consulting-child' ),
        'singular_name'       => _x( 'Video Testimonial', 'Video Testimonials', 'consulting-child' ),
        'menu_name'           => __( 'Video Testimonials', 'consulting-child' ),
        'parent_item_colon'   => __( 'Parent Video Testimonial', 'consulting-child' ),
        'all_items'           => __( 'All Video Testimonials', 'consulting-child' ),
        'view_item'           => __( 'View Video Testimonial', 'consulting-child' ),
        'add_new_item'        => __( 'Add New Video Testimonial', 'consulting-child' ),
        'add_new'             => __( 'Add New', 'consulting-child' ),
        'edit_item'           => __( 'Edit Video Testimonial', 'consulting-child' ),
        'update_item'         => __( 'Update Video Testimonial', 'consulting-child' ),
        'search_items'        => __( 'Search Video Testimonial', 'consulting-child' ),
        'not_found'           => __( 'Not Found', 'consulting-child' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'consulting-child' ),
    );
      
// Set other options for Custom Post Type
      
    $args = array(
        'label'               => __( 'video Testimonial', 'consulting-child' ),
        'description'         => __( 'Video Testimonial news', 'consulting-child' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'thumbnail' ), 
        'taxonomies'          => array( 'video_category' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
  
    );
      
    // Registering your Custom Post Type
    register_post_type( 'video-testimonial', $args );
}
add_action( 'init', 'video_testimonial_post_type', 0 );
/****/

function register_video_taxonomy() {

    $labelsTax = array(
        'name'              => _x( 'Categories', 'taxonomy general name', 'consulting-child' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'consulting-child' ),
        'search_items'      => __( 'Search Categories', 'consulting-child' ),
        'all_items'         => __( 'All Categories', 'consulting-child' ),
        'view_item'         => __( 'View Video Category', 'consulting-child' ),
        'parent_item'       => __( 'Parent Video Category', 'consulting-child' ),
        'parent_item_colon' => __( 'Parent Video Category:', 'consulting-child' ),
        'edit_item'         => __( 'Edit Video Category', 'consulting-child' ),
        'update_item'       => __( 'Update Video Category', 'consulting-child' ),
        'add_new_item'      => __( 'Add New Video Category', 'consulting-child' ),
        'new_item_name'     => __( 'New Video Category Name', 'consulting-child' ),
        'not_found'         => __( 'No Video Category Found', 'consulting-child' ),
        'back_to_items'     => __( 'Back to Video Category', 'consulting-child' ),
        'menu_name'         => __( 'Category', 'consulting-child' ),
    );

    $argsTax = array(
        'labels'            => $labelsTax,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'video_category' => 'video-category' ),
        'show_in_rest'      => true,
    );


    register_taxonomy( 'video_category', 'video-testimonial', $argsTax );

}
add_action( 'init', 'register_video_taxonomy', 0 );