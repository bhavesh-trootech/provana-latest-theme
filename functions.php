<?php

add_action( 'wp_enqueue_scripts', 'consulting_child_enqueue_parent_styles');

function consulting_child_enqueue_parent_styles() {

	wp_enqueue_style( 'consulting-style', get_template_directory_uri() . '/style.css', array( 'bootstrap' ), CONSULTING_THEME_VERSION, 'all' );

    $skin = get_theme_mod('site_skin', 'skin_default');
    if ($skin == 'skin_default') {
        wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'consulting-layout' ), CONSULTING_THEME_VERSION, 'all' );
    } else {
        wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'consulting-layout', 'stm-skin-custom-generated' ), CONSULTING_THEME_VERSION, 'all' );
    }
    wp_enqueue_style( 'customcss', get_stylesheet_directory_uri() . '/custom.css' , array(), (string) time(), 'all' );
    //new site CSS
    $is_new_site_menu = get_field("is_new_site_menu");
    if($is_new_site_menu ==1){
    wp_enqueue_style( 'newsitecss', get_stylesheet_directory_uri() . '/css/newsite.css' , array(), (string) time(), 'all' );
    }
    wp_enqueue_style( 'consulting-clac-style', get_stylesheet_directory_uri() . '/calc.css' );
}

//register sidebar
function wpb_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Blog Right sidebar', 'wpb' ),
		'id' => 'blogrightsidebar-1',
		'description' => __( 'The Blog Right sidebar appears on the right on each single  page except the blog page template', 'wpb' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

    register_sidebar( array(
		'name' => __( 'Event and News Right sidebar', 'wpb' ),
		'id' => 'eventnewsrightsidebar',
		'description' => __( 'The Event and News Right sidebar appears on the right on each single  page except the evet and news page template', 'wpb' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

    register_sidebar( array(
		'name' => __( 'Single  News _Event page  Right sidebar', 'wpb' ),
		'id' => 'singlenewseventsidebar',
		'description' => __( 'The Single Event And News  Right sidebar appears on the right on each single  page except the blog page template', 'wpb' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

    register_sidebar( array(
        'name' => __( 'Addtoany Social', 'wpb' ),
        'id' => 'add_to_any_social',
        'description' => __( '', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s addtoanycustom">',
        'after_widget' => '</aside>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ) );
}
add_action( 'widgets_init', 'wpb_widgets_init' );


function singlerightblogdetails(){
     ob_start();
    // Calling the footer sidebar if it exists.
     if ( !dynamic_sidebar( 'blogrightsidebar-1' ) ):
     endif;
     $html=ob_get_clean();
    return $html;

}
add_shortcode('singlerightblogdetails','singlerightblogdetails');


function silderbaernewsmain(){
    ob_start();
    echo '<div id="eventnewsrightsidebar">';
   // Calling the footer sidebar if it exists.
    if ( !dynamic_sidebar( 'eventnewsrightsidebar' ) ):
    endif;
    echo '</div>';
    $html=ob_get_clean();
   return $html;

}
add_shortcode('silderbaernewsmain','silderbaernewsmain');

function singlerightnewsdetails(){
    ob_start();
   // Calling the footer sidebar if it exists.
    if ( !dynamic_sidebar( 'singlenewseventsidebar' ) ):
    endif;
    $html=ob_get_clean();
   return $html;

}
add_shortcode('singlerightnewsdetails','singlerightnewsdetails');



function posttitlecode(){
    ob_start();

     $post_id=get_the_ID();
    $author_id = get_post_field ('post_author', $post_id);
$display_name = get_the_author_meta( 'display_name' , $author_id ); 
$categories = get_the_terms( $post_id,'newsevents');
   ?>

<div class="post_details_wr  consulting_elementor_post_details">
    
<div class="stm_post_info" style="    margin: 0px !important;">
	<div class="stm_post_details clearfix">
		<ul class="clearfix">
			<li class="post_date">
				<i class="fa fa fa-clock-o"></i>
				<?php echo get_the_date('M d,Y',$post_id);?>	</li>
			<li class="post_by">Posted by:				<span><?php echo $display_name;?></span>
			</li>
			<li class="post_cat">Category:				<span><?php echo $categories[0]->name; ?></span>
			</li>
		</ul>
		
	</div>
	</div></div>
    <?php
    $html=ob_get_clean();
   return $html;

}
add_shortcode('posttitlecode','posttitlecode');


function searchnewsevent(){
    ob_start();
 ?>
 <div class="widget widget_search">
 <form method="get" class="search-form" action="<?php echo get_site_url(); ?>">
	<input type="search" class="form-control" placeholder="Search..." value="" name="s">
    <input type="hidden" name="post_type" value="news_event" />
	<button type="submit"><i class="fa fa-search"></i></button>
</form>
</div>
 <?php
$html=ob_get_clean();
return $html;
}
add_shortcode('searchnewsevent','searchnewsevent');

function newsandeventpage(){
    ob_start();
  
   $the_query = new WP_Query( array(
        'post_type'=> 'news_event',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
    ?>
    <div class="posts_grid">
   <ul class="post_list_ul<?php echo esc_attr($posts_class); ?>">
                <?php
                if ($the_query -> have_posts()) :
                    while ($the_query -> have_posts()) : $the_query -> the_post();
                    $eventnews_links = get_post_meta( get_the_ID(), 'eventnews_links', true );
                    if(!empty($eventnews_links)){

                            $perlink=$eventnews_links;
                    }else{
                                $perlink=get_the_permalink(); 

                    }?>
                      <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( has_post_thumbnail() ) { ?>
    <div class="post_thumbnail"><a href="<?php echo $perlink; ?>">
      <?php 
echo get_the_post_thumbnail( get_the_ID(), 'consulting-image-350x204-croped' ); 
      ?>
    <?php echo $textimg; ?></a>
    </div>
<?php } else {
    $imgg=get_site_url().'/wp-content/uploads/2020/06/placeholder-20.gif';
    ?>  
      
    
    <div class="post_thumbnail">
        <a href="<?php echo $perlink; ?>" >
      <img width="350" height="204" src="<?php echo $imgg;?>" 
    class="attachment-consulting-image-350x204-croped size-consulting-image-350x204-croped wp-post-image" alt="AdobeStock_272835623" />		
   </a>
    </div>
     <?php  } ?>
     <?php 
     $categories = get_the_terms( get_the_ID(),'newsevents');
   
    if(!empty( $categories)) {
     ?>
       <div class="category">
                                <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
                                    <span><?php echo $categories[0]->name; ?></span>
                                    <i class="fa fa-chevron-right"></i>
                                </a>
                            </div>
        <?php } ?>	
      
        
<h5><a href="<?php echo $perlink; ?>"  class="secondary_font_color_hv"><?php the_title(); ?></a></h5>
<div class="post_date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></div>
</li>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    get_template_part('partials/content', 'none');
                endif;
                ?>
            </ul>
            </div>
            <?php
echo paginate_links(array(
    'type' => 'list',
    'prev_text' => '<i class="fa fa-chevron-left"></i>',
    'next_text' => '<i class="fa fa-chevron-right"></i>',
));
?>
<?php
 $html=ob_get_clean();
return $html;
}
add_shortcode('newsandeventpage','newsandeventpage');


function hide_submenu() {
?>
<style>
    #toplevel_page_envato-market ,#toplevel_page_custom-elementor-icons,#menu-comments{display:none;}
</style>
<?php
}
add_action('admin_head', 'hide_submenu');


/*
 * Change 'post' name to 'Houses'
 */
 
function provana_edit_admin_menus() {
    global $menu;
    global $submenu;
 
    $menu[5][0] = 'Blogs'; // Change Posts to Blogs
    $submenu['edit.php'][5][0] = 'Blogs';
    $submenu['edit.php'][10][0] = 'Add Blog';
    $submenu['edit.php'][16][0] = 'Blog Tags';
}
 
function provana_change_post_object() {
    global $wp_post_types;
 
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Blogs';
    $labels->singular_name = 'Blog';
    $labels->add_new = 'Add Blogs';
    $labels->add_new_item = 'Add Blog';
    $labels->edit_item = 'Edit Blog';
    $labels->new_item = 'Blog';
    $labels->view_item = 'View Blog';
    $labels->search_items = 'Search Blogs';
    $labels->not_found = 'No Blogs found';
    $labels->not_found_in_trash = 'No Blogs found in Trash';
    $labels->all_items = 'All Blogs';
    $labels->menu_name = 'Blogs';
    $labels->name_admin_bar = 'Blogs';
 
    // print_r($labels);
}
 
add_action( 'admin_menu', 'provana_edit_admin_menus' );
add_action( 'init', 'provana_change_post_object' );


function listofnewsandeventcat(){
    ob_start();
    $args = array(
        'taxonomy' => 'newsevents',
        'orderby' => 'name',
        'order'   => 'ASC',
        'hide_empty'  => 0,
    );

$cats = get_categories($args);
?>
<div class="widget widget_categories">
    <ul>
<?php
foreach($cats as $cat) {
?>
<li class="cat-item cat-item-<?php echo $cat->term_id; ?>"><a title="<?php echo $cat->name; ?>" href="<?php echo get_category_link( $cat->term_id ) ?>">
    <?php echo $cat->name; ?>
</a></li>
<?php
}
echo '</ul></div>';
 $html=ob_get_clean();
    return $html;
}
add_shortcode('listofnewsandeventcat','listofnewsandeventcat');



//add_filter('pre_get_posts','searchfilter');

function searchfilter($query) {

    if ($query->is_search && !is_admin() ) {
        if(isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
            if($type == 'news_event') {
                $query->set('post_type',array('news_event'));
            }
        }else{
            $query->set('post_type',array('post'));
        }
       
    }
    
    return $query;
    }
    
add_filter('pre_get_posts','searchfilter');



function metimg(){
    if ( is_single() && 'post' == get_post_type() ) {
   
       
        $feat_image = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );


     ?>
    <meta property="og:image" content="<?php  echo $feat_image;?>" />
    <?php
    }
}
add_action('wp_head','metimg');
//register custom post_type
function register_cpt_result() {

	$labels = array(
		'name' => __( 'Webinar Topic', 'Webinar Topic' ),
		'singular_name' => __( 'Webinar Topic', 'Webinar Topic' ),
		'add_new' => __( 'Add New', 'Webinar Topic' ),
		'add_new_item' => __( 'Add New Webinar Topic', 'Webinar Topic' ),
		'edit_item' => __( 'Edit Webinar Topic', 'Webinar Topic' ),
		'new_item' => __( 'New Webinar Topic', 'Webinar Topic' ),
		'view_item' => __( 'View Webinar Topic', 'Webinar Topic' ),
		'search_items' => __( 'Search Webinar Topic', 'Webinar Topic' ),
		'not_found' => __( 'No Webinar Topic found', 'Webinar Topic' ),
		'not_found_in_trash' => __( 'No Webinar Topic found in Trash', 'Webinar Topic' ),
		'parent_item_colon' => __( 'Parent Webinar Topic:', 'Webinar Topic' ),
		'menu_name' => __( 'Webinar Topic', 'Webinar Topic' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'supports' =>  array( 'title', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
	);

	register_post_type( 'webinar_topices', $args );
}
add_action( 'init', 'register_cpt_result' );



//register taxonomy
function create_webinar_topices_hierarchical_taxonomy() {
    $labels = array(
      'name' => _x( 'Category', 'taxonomy general name' ),
      'singular_name' => _x( 'Category', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Category' ),
      'all_items' => __( 'All Category' ),
      'parent_item' => __( 'Parent Category' ),
      'parent_item_colon' => __( 'Parent Category:' ),
      'edit_item' => __( 'Edit Category' ), 
      'update_item' => __( 'Update Category' ),
      'add_new_item' => __( 'Add New Category' ),
      'new_item_name' => __( 'New Category Name' ),
      'menu_name' => __( 'Category' ),
    );
    register_taxonomy('webinar_cat',array('webinar_topices'), array(
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => array( 'slug' => 'webinar_cat' ),
    ));
  }
  add_action( 'init', 'create_webinar_topices_hierarchical_taxonomy', 0 );


  function newfix_cat_slug( $taxonomy, $object_type, $args ){
    if( 'webinar_cat' == $taxonomy ){
        remove_action( current_action(), __FUNCTION__ );
        $args['rewrite'] = array( 'slug' => 'webinar-category' );
        register_taxonomy( $taxonomy, $object_type, $args );
    }
}
add_action( 'registered_taxonomy', 'newfix_cat_slug', 10, 3 );


//register custom post_type
function register_cpt_resultnew() {

	$labels = array(
		'name' => __( 'News & Event Posts', 'News_and_Event' ),
		'singular_name' => __( 'News & Event Posts', 'News_and_Event' ),
		'add_new' => __( 'Add New', 'News_and_Event' ),
		'add_new_item' => __( 'Add New News & Event Post', 'News_and_Event' ),
		'edit_item' => __( 'Edit News & Event Post', 'News_and_Event' ),
		'new_item' => __( 'New News & Event Post', 'News_and_Event' ),
		'view_item' => __( 'View News & Event Post', 'News_and_Event' ),
		'search_items' => __( 'Search News & Event Post', 'News_and_Event' ),
		'not_found' => __( 'No News & Event Post found', 'News_and_Event' ),
		'not_found_in_trash' => __( 'No News & Event found in Trash', 'News_and_Event' ),
		'parent_item_colon' => __( 'Parent News & Event:', 'News_and_Event' ),
		'menu_name' => __( 'News & Event Posts', 'News_and_Event' ),
	);

	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'supports' =>  array( 'title', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
	);

	register_post_type( 'news_event', $args );
}
add_action( 'init', 'register_cpt_resultnew' );



//register taxonomy
function create_topics_hierarchical_taxonomy() {
    $labels = array(
      'name' => _x( 'Category', 'taxonomy general name' ),
      'singular_name' => _x( 'Category', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Category' ),
      'all_items' => __( 'All Category' ),
      'parent_item' => __( 'Parent Category' ),
      'parent_item_colon' => __( 'Parent Category:' ),
      'edit_item' => __( 'Edit Category' ), 
      'update_item' => __( 'Update Category' ),
      'add_new_item' => __( 'Add New Category' ),
      'new_item_name' => __( 'New Category Name' ),
      'menu_name' => __( 'Category' ),
    );
    register_taxonomy('newsevents',array('news_event'), array(
      'hierarchical' => true,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'query_var' => true,
      'rewrite' => array( 'slug' => 'newsevents' ),
    ));
  }
  add_action( 'init', 'create_topics_hierarchical_taxonomy', 0 );



  add_action( 'add_meta_boxes', 'provona_add_metaboxeventnew' );
  add_action( 'add_meta_boxes_webinar_topices', 'provona_add_metaboxeventnew' );
  function provona_add_metaboxeventnew() {
  
      add_meta_box(
          'provona_metaboxevent', // metabox ID
          'External Link Details', // title
          'provona_metaboxeventnews_callback', // callback function
          'news_event', // post type or post types in array
          'normal', // position (normal, side, advanced)
          'default' // priority (default, low, high, core)
      );
  
  }
/*Callback function with meta box HTML */
function provona_metaboxeventnews_callback( $post ) {

	$eventnews_links = get_post_meta( $post->ID, 'eventnews_links', true );


	// nonce, actually I think it is not necessary here
	wp_nonce_field( 'somerandomstr', '_mishanonce' );

	echo '<table class="form-table">
		<tbody>
			<tr>
				<th><label for="eventnews_links">Links</label></th>
				<td><input type="text" id="eventnews_links" name="eventnews_links" value="' . esc_attr( $eventnews_links ) . '" class="regular-text"></td>
			</tr>
			
		</tbody>
	</table>';

}



add_action( 'save_post_news_event', 'provona_eventnews_save_meta', 10, 2 );

function provona_eventnews_save_meta( $post_id, $post ) {

	// nonce check
	if ( ! isset( $_POST[ '_mishanonce' ] ) || ! wp_verify_nonce( $_POST[ '_mishanonce' ], 'somerandomstr' ) ) {
		return $post_id;
	}

	// check current user permissions
	$post_type = get_post_type_object( $post->post_type );

	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}

	// Do not save the data if autosave
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// define your own post type here
	if( 'news_event' !== $post->post_type ) {
		return $post_id;
	}

	if( isset( $_POST[ 'eventnews_links' ] ) ) {
		update_post_meta( $post_id, 'eventnews_links', sanitize_text_field( $_POST[ 'eventnews_links' ] ) );
	} else {
		delete_post_meta( $post_id, 'eventnews_links' );
	}
	

	return $post_id;

}




add_action( 'add_meta_boxes', 'provona_add_metabox' );
add_action( 'add_meta_boxes_webinar_topices', 'provona_add_metabox' );
function provona_add_metabox() {

	add_meta_box(
		'provona_metabox', // metabox ID
		'Webinar Details', // title
		'provona_metabox_callback', // callback function
		'webinar_topices', // post type or post types in array
		'normal', // position (normal, side, advanced)
		'default' // priority (default, low, high, core)
	);

}

/*Callback function with meta box HTML */
function provona_metabox_callback( $post ) {

	$webinar_speakers = get_post_meta( $post->ID, 'webinar_speakers', true );
	$webinar_date_time = get_post_meta( $post->ID, 'webinar_date_time', true );
    $webinar_regslink = get_post_meta( $post->ID, 'webinar_regslink', true );

	// nonce, actually I think it is not necessary here
	wp_nonce_field( 'somerandomstr', '_mishanonce' );

	echo '<table class="form-table">
		<tbody>
			<tr>
				<th><label for="webinar_speakers">Speakers</label></th>
				<td><input type="text" id="webinar_speakers" name="webinar_speakers" value="' . esc_attr( $webinar_speakers ) . '" class="regular-text"></td>
			</tr>
			<tr>
				<th><label for="webinar_date_time">Date & time </label></th>
				<td><input type="text" id="webinar_date_time"  class="datepicker" name="webinar_date_time" value="' . esc_attr( $webinar_date_time ) . '" class="regular-text"></td>
			</tr>
            <tr>
				<th><label for="webinar_regslink">Registration link </label></th>
				<td><input type="text" id="webinar_regslink" name="webinar_regslink" value="' . esc_attr( $webinar_regslink ) . '" class="regular-text"></td>
			</tr>
		</tbody>
	</table>';

}



add_action( 'save_post_webinar_topices', 'provona_webinar_save_meta', 10, 2 );

function provona_webinar_save_meta( $post_id, $post ) {

	// nonce check
	if ( ! isset( $_POST[ '_mishanonce' ] ) || ! wp_verify_nonce( $_POST[ '_mishanonce' ], 'somerandomstr' ) ) {
		return $post_id;
	}

	// check current user permissions
	$post_type = get_post_type_object( $post->post_type );

	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}

	// Do not save the data if autosave
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	}

	// define your own post type here
	if( 'webinar_topices' !== $post->post_type ) {
		return $post_id;
	}

	if( isset( $_POST[ 'webinar_speakers' ] ) ) {
		update_post_meta( $post_id, 'webinar_speakers', sanitize_text_field( $_POST[ 'webinar_speakers' ] ) );
	} else {
		delete_post_meta( $post_id, 'webinar_speakers' );
	}
	if( isset( $_POST[ 'webinar_date_time' ] ) ) {
		update_post_meta( $post_id, 'webinar_date_time', sanitize_text_field( $_POST[ 'webinar_date_time' ] ) );
	} else {
		delete_post_meta( $post_id, 'webinar_date_time' );
	}
    if( isset( $_POST[ 'webinar_regslink' ] ) ) {
		update_post_meta( $post_id, 'webinar_regslink', sanitize_text_field( $_POST[ 'webinar_regslink' ] ) );
	} else {
		delete_post_meta( $post_id, 'webinar_regslink' );
	}

	return $post_id;

}




function enqueue_date_picker(){
    wp_enqueue_script(
        'field-date', 
        get_stylesheet_directory_uri() . '/admin/field-date.js', 
        array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'),
        time(),
        true
    );  
  
    wp_enqueue_script( 'timepicker-js', get_stylesheet_directory_uri() . '/admin/jquery-ui-timepicker-addon.min.js', array( 'jquery' ), time(), true );
    wp_enqueue_style( 'timepicker-css', get_stylesheet_directory_uri() . '/admin/jquery-ui-timepicker-addon.min.css' ); 
    

    wp_enqueue_style( 'jquery-ui-datepicker' );
}

add_action('admin_enqueue_scripts', 'enqueue_date_picker');

/*List of Webinar shortcode*/


function listofwebnir(){

    ob_start();

    ?>
 <div class="vacancy_table_wr consulting_elementor_vacancies style_1">

        
<table class="vacancy_table" id="vacancy_table_webinar">
    <thead>
    <tr>
        <th>Webinar Topic</th>
        <th class="speakers">Speakers</th>
        <th>Date & time</th>
        <th>Registration link</th>
    </tr>
    </thead>
    <tbody>
            <?php 
            
            $the_query = new WP_Query( array(
                'post_type'=> 'webinar_topices',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
            ));
            while ($the_query -> have_posts()) : $the_query -> the_post();
                $postid = get_the_ID();
                $title=get_the_title();
                $webinar_speakers = get_post_meta( $postid, 'webinar_speakers', true );
                $webinar_date_time = get_post_meta( $postid, 'webinar_date_time', true );
                $webinar_regslink = get_post_meta( $postid, 'webinar_regslink', true );
            
               ?>
                <tr>
                <td><a href="<?php echo $webinar_regslink; ?>"  target="_blank"><?php echo $title; ?></a></td>
                <td class="speakers"><?php echo $webinar_speakers; ?></td>
                <td><?php echo $webinar_date_time; ?></td>
                <td><a href="<?php echo $webinar_regslink; ?>" target="_blank">View Link</a></td>
            </tr>
               <?php
            endwhile;
            wp_reset_postdata();
            
            ?>
           
                  
    </tbody>
</table>


<script type="text/javascript">
jQuery(document).ready(function () {
    jQuery("#vacancy_table_webinar").tablesorter();
});
</script>
</div>



    <?php

    $html=ob_get_clean();
    return $html;

} 
add_shortcode('listofwebnir','listofwebnir');







function calcfrom(){
	
    ob_start();
    ?>
    <div class="stm_cost_calculator style_1">
    <form>
        <div class="calculator-settings">
            <div class="calc-container vertical">

                <div class="calc-fields calc-list ">
                <div class="calc-item-title"><h3>Estimate your savings</h3></div>
                <div class="width100 ccb">
                    <div class="calc-item__title">First name</div>
                    <div class="calc-input-wrapper ccb-field hs-form-field"><input  class="hs-input" id="firstname" type="text" name="firstname" value="" placeholder="" autocomplete="given-name"></div>
                </div>
                <div class="width100 ccb">
                    <div class="calc-item__title">Last name</div>
                    <div class="calc-input-wrapper ccb-field hs-form-field"><input  class="hs-input" id="lasttname" type="text" name="lasttname" value="" placeholder="" autocomplete="given-name"></div>
                </div>
                <div class="width100 ccb">
                    <div class="calc-item__title">Email*</div>
                    <div class="calc-input-wrapper ccb-field hs-form-field"><input  class="hs-input" id="email" type="email" name="email" placeholder="" value=""></div>
                    <span class="iperror">Please enter a valid email address.</span>
                </div>
               <div class="width100 ccb">
                    <div class="calc-item__title">Number of Disputes (Direct & Indirect)</div>
                    <div class="calc-input-wrapper ccb-field hs-form-field"> <input  class="hs-input" id="number_disputes" type="text" name="firstname" value="35000" placeholder="" autocomplete="given-name"></div>
                </div>
                <div class="width100 ccb">
                    <div class="calc-item__title">Resource salary cost per hour ( $ )</div>
                    <div class="calc-input-wrapper ccb-field hs-form-field"><input  class="hs-input" id="salary_cost" type="text"  placeholder="" value="15"></div>
                </div>
                <div class="width100 ccb">
                    <div class="calc-item__title titlecat"><span>Overhead Cost</span><span>100%</span></div> 
                    <div class="calc-input-wrapper ccb-field hs-form-field">                                    
                        <div class="input rangeInner">
                                        <div id="tooltip"></div>
                                        <input type="range" class="range-slider" id="range_slider" min="0" max="100" value="50" step="1">
                        </div></div>
               </div>

               <div class="width100 ccb">
                    <div class="calc-item__title">Total hourly cost</div>
                    <div class="calc-input-wrapper ccb-field hs-form-field"><input  class="hs-input" id="total_hourly_costspan" type="text"  placeholder="" value="$22.5" readonly></div>
                </div>

               <div class="width100 ccb martintop">
                        <div style="text-align: center;">
                          <a href="#" rel="noopener" id="calculatorCTA" class="calculatorCTA btn-solid-reg ">Calculate your savings</a>
                        </div>
                </div>

                <div id="hiddedivafters">

                <div class="calc-item-title"><h3>Total Summary</h3></div>
                <div class="calc-subtotal-list">
                    <!-- <div class="sub-list-item">
                        <span class="sub-item-title">Total hourly cost</span>
                        <span class="sub-item-value salary_cost" id="total_hourly_costspan"></span>
                    </div> -->
                    <div class="sub-list-item">
                        <span class="sub-item-title">Your Current Monthly Cost</span>
                        <span class="sub-item-value salary_cost" id="CurrentMonthlyCostspan"></span>
                    </div>
                    <div class="sub-list-item">
                        <span class="sub-item-title">Cost with Provana (All inclusive)</span>
                        <span class="sub-item-value salary_cost" id="CostWithProvanaspan"></span>
                    </div>
                    <div class="sub-list-item">
                        <span class="sub-item-title">Annual Cost Savings</span>
                        <span class="sub-item-value salary_cost" id="AnnualCostSavingsspan"></span>
                    </div>
                </div>
              
                <div class="width100 ccb hs-form-field" style="display:none !important;">
                      
                        <input  class="hs-input" id="total_hourly_cost" type="text"  placeholder="" value="">
                        <input  class="hs-input" id="CurrentMonthlyCost" type="text"  placeholder="" value="">
                        <input  class="hs-input" id="CostWithProvana" type="text"  placeholder="" value="">
                        <input  class="hs-input" id="AnnualCostSavings" type="text"  placeholder="" value="">

                    </div>
                </div>


             </div>
           
          
            </div>
        </div>
    </form>
      <div class="hide">
                        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
<script>
  hbspt.forms.create({
    region: "na1",
    portalId: "4398512",
    formId: "5f62bb16-43e3-4ca6-98b8-521594d4b24b"
  });
</script>
                        </div>

                        <style>

                        </style>
                      
                        <script>

                                const
                                        range = document.getElementById('range_slider'),
                                        tooltip = document.getElementById('tooltip'),
                                        setValue = ()=>{
                                            const
                                                newValue = Number( (range.value - range.min) * 100 / (range.max - range.min) ),
                                                newPosition = 16 - (newValue * 0.32);
                                            tooltip.innerHTML = `<span>${range.value}</span>`;
                                            tooltip.style.left = `calc(${newValue}% + (${newPosition}px))`;
                                            document.documentElement.style.setProperty("--range-progress", `calc(${newValue}% + (${newPosition}px))`);
                                        };
                                    document.addEventListener("DOMContentLoaded", setValue);
                                    range.addEventListener('input', setValue);
                            window.addEventListener('message', event => {
                                if(event.data.type === 'hsFormCallback' && event.data.eventName === 'onFormReady') {


                                                                    const
                                        range = document.getElementById('range_slider'),
                                        tooltip = document.getElementById('tooltip'),
                                        setValue = ()=>{
                                            const
                                                newValue = Number( (range.value - range.min) * 100 / (range.max - range.min) ),
                                                newPosition = 16 - (newValue * 0.32);
                                            tooltip.innerHTML = `<span>${range.value}</span>`;
                                            tooltip.style.left = `calc(${newValue}% + (${newPosition}px))`;
                                            document.documentElement.style.setProperty("--range-progress", `calc(${newValue}% + (${newPosition}px))`);
                                        };
                                    document.addEventListener("DOMContentLoaded", setValue);
                                    range.addEventListener('input', setValue);


                                    // const range = document.getElementById('range_slider'),
                                    //       tooltip = document.getElementById('tooltip'),
                                    //       setValue = ()=>{
                                    //           const
                                    //           newValue = Number( (range.value - range.min) * 100 / (range.max - range.min) ),
                                    //                 newPosition = 16 - (newValue * 0.32);
                                    //           tooltip.innerHTML = `<span>${range.value}</span>`;
                                    //           tooltip.style.left = `calc(${newValue}% + (${newPosition}px))`;
                                    //           if (newValue == 100) {
                                    //             document.getElementById("rangehandvalspan").classList.add("hidespanval");
                                    //           }else{
                                    //             document.getElementById("rangehandvalspan").classList.remove("hidespanval");
                                    //           }

                                    //           if (newValue == 0) {
                                    //             document.getElementById("rangezerovalspan").classList.add("hidespanval");
                                    //           }else{
                                    //             document.getElementById("rangezerovalspan").classList.remove("hidespanval");
                                    //           }



                                    //           document.documentElement.style.setProperty("--range-progress", `calc(${newValue}% + (${newPosition}px))`);
                                    //       };
                                    // document.addEventListener("DOMContentLoaded", setValue);
                                    // range.addEventListener('input', setValue);
                                    jQuery('#tooltip').append('<span>'+range.value+'</span>');

                                    var Disputes = 35000;
                                    var OverheadCost = 20;
                                    var Resource = 15;
                                    var total_hourly_cost = 18;
                                    jQuery('.iperror').hide();
                                    //                                     $('.calculatorCTA').addClass('Disabled');
                                    calculate_cost();
                                    jQuery('.hs-form-field input').on('keyup keypress blur change', function(e) {
                                        calculate_cost();
                                    });
                                    jQuery('#range_slider').mousemove(function(){
                                        jQuery('.left.count').removeClass('active');
                                        jQuery('.right.count').removeClass('active');
                                        if(Number(jQuery('#tooltip span').text()) < 20){
                                            jQuery('.left.count').addClass('active');
                                        }else{
                                            jQuery('.left.count').removeClass('active');
                                        }
                                        if(Number(jQuery('#tooltip span').text()) > 65){
                                            jQuery('.right.count').addClass('active');
                                        }else{
                                            jQuery('.right.count').removeClass('active');
                                        }
                                    });
                                    function calculate_cost() {
                                        Disputes = Number(jQuery("#number_disputes").prop('value'));
                                        Resource = Number(jQuery("#salary_cost").prop('value'));
                                        OverheadCost = Number(jQuery("#range_slider").prop('value'));

                                        total_hourly_cost = Resource + ( Resource * OverheadCost / 100);
                                        jQuery('#total_hourly_cost').prop('value', total_hourly_cost);
                                        jQuery('input#total_hourly_costspan').val('$ '+total_hourly_cost);


                                        jQuery('#CurrentMonthlyCost').prop('value', (Disputes * total_hourly_cost / 30 ));

                                        let CurrentMonthlyCost = Number(jQuery("#CurrentMonthlyCost").prop('value').toLocaleString("en"));


                                        jQuery('#CostWithProvana').prop('value', (Disputes * 0.3 ));

                                        let CostWithProvana = Number(jQuery("#CostWithProvana").prop('value').toLocaleString("en"));
                                        jQuery('#AnnualCostSavings').prop('value',((CurrentMonthlyCost - CostWithProvana) * 12).toLocaleString("en"));


                                        jQuery('#CurrentMonthlyCostspan').html('$ '+(Disputes * total_hourly_cost / 30 ));
                                        jQuery('#CostWithProvanaspan').html('$ '+(Disputes * 0.3 ));

                                      
                                        //                                         CurrentMonthlyCost = CurrentMonthlyCost.toFixed(2);
                                     
                                        //                                         CostWithProvana = CostWithProvana.toFixed(2);
                                        jQuery('#AnnualCostSavingsspan').html('$ '+(CurrentMonthlyCost - CostWithProvana) * 12);


                                        jQuery('#hs-form-iframe-0').contents().find('.hs_firstname input').val(jQuery('#firstname').val());
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_lastname input').val(jQuery('#lasttname').val());
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_email input').val(jQuery('#email').val());
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_number_of_disputes input').val('$'+jQuery('#number_disputes').val().toLocaleString("en"));
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_resource_salary_cost_per_hour input').val('$'+jQuery('#salary_cost').val().toLocaleString("en"));
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_overhead_cost input').val(jQuery('#range_slider').val()+'%');
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_total_hourly_cost input').val('$'+jQuery('#total_hourly_cost').val().toLocaleString("en"));
                                    }

                                    jQuery('.calculatorCTA').click(function(e){
                                        e.preventDefault();
                                        jQuery('#CurrentMonthlyCost').prop('value', (Disputes * total_hourly_cost / 30 ));
                                        jQuery('#CostWithProvana').prop('value', (Disputes * 0.3 ));

                                        let CurrentMonthlyCost = Number(jQuery("#CurrentMonthlyCost").prop('value').toLocaleString("en"));
                                        //                                         CurrentMonthlyCost = CurrentMonthlyCost.toFixed(2);
                                        let CostWithProvana = Number(jQuery("#CostWithProvana").prop('value').toLocaleString("en"));
                                        //                                         CostWithProvana = CostWithProvana.toFixed(2);

                                        jQuery('#AnnualCostSavings').prop('value',((CurrentMonthlyCost - CostWithProvana) * 12).toLocaleString("en"));
                                        jQuery('#hs-form-iframe-0').contents().find('.hs-firstname input.hs-input').val(jQuery('#firstname').val()).change();
                                        jQuery('#hs-form-iframe-0').contents().find('.hs-lastname input.hs-input').val(jQuery('#lasttname').val()).change();
                                        jQuery('#hs-form-iframe-0').contents().find('#email-5f62bb16-43e3-4ca6-98b8-521594d4b24b').val(jQuery('#email').val()).change();
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_number_of_disputes input.hs-input').val('$'+jQuery('#number_disputes').val()).change();
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_resource_salary_cost_per_hour input.hs-input').val('$'+jQuery('#salary_cost').val()).change();
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_overhead_cost input.hs-input').val(jQuery('#range_slider').val()+'%').change();
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_total_hourly_cost input.hs-input').val('$'+jQuery('#total_hourly_cost').val()).change();
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_your_current_monthly_cost input.hs-input').val('$'+jQuery('#CurrentMonthlyCost').val().toLocaleString("en")).change();
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_cost_with_provana__all_inclusive_ input.hs-input').val('$'+jQuery('#CostWithProvana').val().toLocaleString("en")).change();
                                        jQuery('#hs-form-iframe-0').contents().find('.hs_annual_cost_savings input.hs-input').val('$'+jQuery('#AnnualCostSavings').val()).change();
                                       // jQuery('[type=submit]').trigger('click');
                                        jQuery("#hs-form-iframe-0").contents().find("#hsForm_5f62bb16-43e3-4ca6-98b8-521594d4b24b [type=submit]").trigger('click');
                                        

                                        setTimeout(function() {
                                            if( jQuery('#hs-form-iframe-0').contents().find('#email-5f62bb16-43e3-4ca6-98b8-521594d4b24b').hasClass('error')){
                                                jQuery('.iperror').text(jQuery('#hs-form-iframe-0').contents().find('.hs-error-msg').text());
                                                jQuery('.iperror').show();
                                            }else{
                                                jQuery('.iperror').hide();
                                                jQuery('.clickShow').show();
                                                jQuery('#hiddedivafters').show();
                                                
                                                //                                                     hbspt.forms.create({ 
                                                //                                                         css: '',
                                                //                                                         portalId: '4398512',
                                                //                                                         target: 'div.hide',
                                                //                                                         formId: '5f62bb16-43e3-4ca6-98b8-521594d4b24b'
                                                //                                                     });
                                            }
                                        }, 1000);


                                    });
                                  
                                }
                            });
                           
                            
                            
                           
                        </script>
          
    
</div>

<style>
    #range_slider { -webkit-appearance: none; width: 100% !important; }
    #range_slider:focus { outline: none; }

    #range_slider::before, #range_slider::after {
        position: absolute;
        top: 2rem;
        color: #333;
        font-size: 14px;
        line-height: 1;
        padding: 3px 5px;
        background-color: rgba(0,0,0,.1);
        border-radius: 4px;
    }
    #range_slider::before { left: 0; content: attr(data-min);  display:none;}
    #range_slider::after { right: 0; content: attr(data-max); display:none;}
    input#range_slider {
    padding: unset !important;
    margin-top: 33px !important;
}
    #range_slider::-webkit-slider-runnable-track {
        width: 100%;
        height: 5px;
        cursor: pointer;
        animate: 0.2s;
        background: linear-gradient(90deg, #6BA132 var(--range-progress), #dee4ec var(--range-progress));
        border-radius: 1rem;
    }
    #range_slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        border: 0.25rem solid #99c776;
        border-radius: 50%;
        background: #99c776 ;
        cursor: pointer;
        height: 25px; width: 25px;
        transform: translateY(calc(-80% + 10px));
    }

    #tooltip {
        position: absolute;
        top: -2.25rem;
    }
    #tooltip span {
        position: absolute;
        text-align: center;
        display: block;
        line-height: 1;
        padding: 0.125rem 0.25rem;
        color: #fff;
        border-radius: 0.125rem;
        background: #99c776 ;
        font-size: 14px;
        left: 50%;
        transform: translate(-50%, 0);
    }
    #tooltip span:before {
        position: absolute;
        content: "";
        left: 50%; bottom: -8px;
        transform: translateX(-50%);
        width: 0; height: 0;
        border: 4px solid transparent;
        border-top-color: #99c776 ;
    }
    #tooltip span:after { 
    content: "%";
    background: #99c776;
    font-size: 13px; 
    margin: 0;
   } 
   span.iperror {color: red;}
    .width100.ccb.martintop {
    margin-top:45px !important;
}
input[type=range]:focus::-ms-fill-upper {
  background: #367ebd;
}
    .titlecat{
    display: flex;
    justify-content: space-between;
    color: rgb(0, 0, 0);
    margin: 0px 0px 8px;
    padding: 0px;
    font-size: 14px;
    text-align: left;
    font-style: normal;
    font-weight: bold;
    text-shadow: rgb(255 255 255 / 0%) 0px 0px 0px;
    letter-spacing: 0px;
}
.calc-subtotal.calc-list {
    visibility: visible !important;
    opacity: 1 !important;
}
.calc-subtotal-list {
    margin-bottom: 35px;
}
span.sub-item-title {
    color: #404040 !important;
    font-size: 16px !important;
    font-family: 'Lato' !important;
}
      #calculatorCTA{
                                font-family: "Lato", Sans-serif;
    font-size: 20px !important;
    font-weight: bold;
    font-style: normal;
    line-height: 28px;
    fill: #FFFFFF;
    color: #FFFFFF;padding: 20px;
    background-color: #2D4EA2;
                            }
                            .calc-fields.calc-list {
    width: 47.5%;
    margin: 0px;
    padding: 50px;
    box-shadow: rgb(255 255 255 / 0%) 0px 0px 0px 0px;
    border-width: 0px;
    border-style: solid;
    border-color: rgb(255, 255, 255);
    border-radius: 10px;
    background-color: rgb(239, 244, 244);
    opacity: 1 !important;
    visibility: visible !important;
}
.ccb-field input {
    height: unset;
    line-height: unset;
    width: 100%;
    display: block;
    font-size: 14px;
    font-weight: 500;
    padding: 5px 15px;
    background-color: #fff;
    border: 1px solid #d0d0d0;
    outline: none;
    box-shadow: none;
    font-family: 'Lato' !important;
    font-size: 14px !important;
    color: #404040 !important;
   
}
.width100.ccb {
    display: block !important;
    width: 100% !important;
    position: relative;
    margin-bottom: 15px;
}
.calc-item__title {
    font-weight: 600 !important;
    color: #404040 !important;
    font-family: 'Lato' !important;
    font-size: 16px !important;
    line-height: 26px !important;
}
@media only screen and (max-width:1024px){
    .calc-subtotal.calc-list.equalhight {
        height: auto !important;
    }
}


    </style>
    <?php
    $html=ob_get_clean();
    return $html;
}
add_shortcode( 'calcfrom', 'calcfrom' );


function casestudiesfrom(){
    ob_start();
    ?>
<script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
<script>
  hbspt.forms.create({
    region: "na1",
    portalId: "4398512",
    formId: "79071a76-c2e1-4640-9ccb-10f955329a3c"
  });
</script>
    <?php
    $html=ob_get_clean();
    return $html;

}
add_shortcode( 'casestudiesfrom', 'casestudiesfrom' );
add_action('wp_footer','footerscript');
function footerscript(){

   ?>

<style>
  a#scroll-up {
    bottom: 20px;
    position: fixed;
    right: 20px;
    display: none;
    background-color: #04a54b;
    opacity: 0.5;
    filter: alpha(opacity=50);
    padding: 8px 15px;
    border-radius: 2px;
    font-size: 20px;
    z-index: 99;
}

a#scroll-up i {
	color: #fff;
}

a#scroll-up:hover {
	opacity: 1;
	filter: alpha(opacity=100); /* For IE8 and earlier */
}

@media only screen and (max-width: 667px) {
        .stm_works_wr.grid_with_filter.style_1 .stm_works .item .info .title ,.blog .post_list_ul h5 {
            height: auto !important;
        }
}
#hsForm_fd330e9e-d371-4349-8c3c-3a4e8d5c62b0 label.hs-error-msg{color: red !important;}
.page-id-12219 .hs_error_rollup {
    display: none;
}

</style>    



<script>
 // For Scroll to top button
 jQuery( '#scroll-up' ).hide();
	jQuery( function () {
		jQuery( window ).scroll( function () {
			if ( jQuery( this ).scrollTop() > 1000 ) {
				jQuery( '#scroll-up' ).fadeIn();
			} else {
				jQuery( '#scroll-up' ).fadeOut();
			}
		} );
		jQuery( 'a#scroll-up' ).click( function () {
			jQuery( 'body,html' ).animate( {
				scrollTop : 0
			}, 800 );
			return false;
		} );
	} );
        
       
        var maxHeight = 0;
jQuery('.equalhight').each(function(){
    var currentHeight = jQuery(this).height();
    if(currentHeight > maxHeight){
        maxHeight = currentHeight;
    }
});
jQuery('.equalwhitecolour .elementor-widget-container').each(function(){
    var currentHeight = jQuery(this).height();
    if(currentHeight > maxHeight){
        maxHeight = currentHeight;
    }
});
jQuery('.stm_works_wr.grid_with_filter.style_1 .stm_works .item .info .title').each(function(){
    var currentHeight = jQuery(this).height();
    if(currentHeight > maxHeight){
        maxHeight = currentHeight;
    }
});

jQuery('.blog .post_list_ul h5').each(function(){
    var currentHeight = jQuery(this).height();
    if(currentHeight > maxHeight){
        maxHeight = currentHeight;
    }
});

jQuery('.analysticdivcol').each(function(){
    var currentHeight = jQuery(this).height();
    if(currentHeight > maxHeight){
        maxHeight = currentHeight;
    }
});
jQuery('.analysticdivcol').height(maxHeight);
jQuery('.equalwhitecolour .elementor-widget-container').height(maxHeight);
jQuery('.stm_works_wr.grid_with_filter.style_1 .stm_works .item .info .title').height(maxHeight);
jQuery('.blog .post_list_ul h5').height(maxHeight);


jQuery('.equalhight').height(maxHeight);
jQuery( window ).resize(function() {
    jQuery('.equalwhitecolour .elementor-widget-container').height(maxHeight);
    jQuery('.stm_works_wr.grid_with_filter.style_1 .stm_works .item .info .title').height(maxHeight);
    jQuery('.equalhight').height(maxHeight);
    jQuery('.blog .post_list_ul h5').height(maxHeight);
});
jQuery(window).on('resize', function(){
    jQuery('.analysticdivcol').height(maxHeight);
    jQuery('.equalwhitecolour .elementor-widget-container').height(maxHeight);
    jQuery('.stm_works_wr.grid_with_filter.style_1 .stm_works .item .info .title').height(maxHeight);
    jQuery('.blog .post_list_ul h5').height(maxHeight);

});
jQuery(document).ready(function(){ 
     jQuery('.analysticdivcol').height(maxHeight); 
     jQuery('.equalhight').height(maxHeight);
     jQuery('.equalwhitecolour .elementor-widget-container').height(maxHeight); 
     jQuery('.stm_works_wr.grid_with_filter.style_1 .stm_works .item .info .title').height(maxHeight);
     jQuery('.blog .post_list_ul h5').height(maxHeight);

      
});
    </script>   


    <?php
}
/*blog*/
/**
 * Add new rewrite rule
 */
function create_new_url_querystring() {
    add_rewrite_rule(
        'blog/([^/]*)$',
        'index.php?name=$matches[1]',
        'top'
    );

    add_rewrite_tag('%blog%','([^/]*)');
}
add_action('init', 'create_new_url_querystring', 999 );


/**
 * Modify post link
 * This will print /blog/post-name instead of /post-name
 */
function append_query_string( $url, $post, $leavename ) {
    
    if ( $post->post_type != 'post' )
            return $url;
    
    if ( $post->post_type == 'post' && isset($_GET['action'] ) && $_GET['action'] == 'elementor' )  return $url;


    if ( false !== strpos( $url, '%postname%' ) ) {
            $slug = '%postname%';
    }
    elseif ( $post->post_name ) {
            $slug = $post->post_name;
    }
    else {
        $slug = sanitize_title( $post->post_title );
    }
    
    $url = home_url( user_trailingslashit( 'blog/'. $slug ) );

    return $url;
}
add_filter( 'post_link', 'append_query_string', 10, 3 );


/**
 * Redirect all posts to new url
 * If you get error 'Too many redirects' or 'Redirect loop', then delete everything below
 */
function redirect_old_urls() {
    if ( ! is_admin() ) {

    if ( is_singular('post') &&  isset($_GET['action'] ) && $_GET['action'] != 'elementor'  ) {
        global $post;
       
        if ( strpos( $_SERVER['REQUEST_URI'], '/blog/') === false) {
           wp_redirect( home_url( user_trailingslashit( "blog/$post->post_name" ) ), 301 );
           exit();
        }
    }
}
}
add_filter( 'template_redirect', 'redirect_old_urls' );
/**/




function wpfooterscript(){
	?>
<script>
	// JQuery code to detect browser

jQuery(document).ready(function() {
    var browser;

  
    if(navigator.userAgent.indexOf("MSIE")!=-1 || navigator.userAgent.indexOf("rv:11.0")!=-1) name = "msie";
    else if(navigator.userAgent.indexOf("Edge")!=-1) name = "microsoft-edge";
    else if(navigator.userAgent.indexOf("Firefox")!=-1) name = "firefox";
    else if(navigator.userAgent.indexOf("Opera")!=-1) name = "opera";
    else if(navigator.userAgent.indexOf("Chrome") != -1) name = "chrome";
    else if(navigator.userAgent.indexOf("Safari")!=-1) name = "safari";

		var OSName="unknown-os";
		if (navigator.appVersion.indexOf("Win")!=-1) OSName="windows";
		if (navigator.appVersion.indexOf("Mac")!=-1) OSName="mac-os";
		if (navigator.appVersion.indexOf("X11")!=-1) OSName="unix";
		if (navigator.appVersion.indexOf("Linux")!=-1) OSName="linux";

		var IEVersion="not-ie";
		if(navigator.userAgent.indexOf("rv:11.0")!=-1) IEVersion = "ie ie-11";
		else if(navigator.userAgent.indexOf("MSIE 10.0")!=-1) IEVersion = "ie ie-10";
		else if(navigator.userAgent.indexOf("MSIE 9.0")!=-1) IEVersion = "ie ie-9";
		else if(navigator.userAgent.indexOf("MSIE 8.0")!=-1) IEVersion = "ie ie-8";
		else if(navigator.userAgent.indexOf("MSIE 7.0")!=-1) IEVersion = "ie ie-7";

		var windowsVersion='not-windows';
		if(navigator.userAgent.indexOf("Windows NT 5.0")!=-1) windowsVersion = "windows-2000";
		else if (navigator.userAgent.indexOf("Windows NT 5.1")!=-1) windowsVersion="windows-xp";
		else if(navigator.userAgent.indexOf("Windows NT 6.0")!=-1) windowsVersion = "windows-vista";
		else if(navigator.userAgent.indexOf("Windows NT 6.1")!=-1) windowsVersion = "windows-7";
		else if(navigator.userAgent.indexOf("Windows NT 6.2")!=-1) windowsVersion = "windows-8";
		else if(navigator.userAgent.indexOf("Windows NT 6.3")!=-1) windowsVersion = "windows-8-1";
		else if(navigator.userAgent.indexOf("Windows NT 10.0")!=-1) windowsVersion = "windows-10";

		var device="not-mobile"
		if (navigator.userAgent.match(/Android|BlackBerry|Kindle|iPhone|iPad|iPod|Opera Mini|IEMobile/i)) device="mobile";

		var isKindle="not-kindle"
		if (navigator.userAgent.match(/Kindle|KFTHWI/i)) isKindle="kindle";
  jQuery('body').addClass(name);
		jQuery('body').addClass(OSName);
		jQuery('body').addClass(device);
		jQuery('body').addClass(IEVersion);
		jQuery('body').addClass(windowsVersion);
		jQuery('body').addClass(isKindle);

	
	

});
	
function scrollToDiv(element,navheight){
    var offset = element.offset();
    var offsetTop = offset.top;
    var totalScroll = offsetTop-navheight;
    console.log('totalScroll :'+totalScroll);
    jQuery('body,html').animate({
    scrollTop: totalScroll
    }, 500);
}

jQuery('#ctabutton').click(function(){
   
    var el = jQuery(this).attr('href');
    var elWrapped = jQuery(el);
    var header_height = jQuery('#header').height() + 120;
    console.log(header_height);
    //var header_height = $('#header-id-goes-here').outerHeight(); You might need outerHeight if you have padding and borders

    scrollToDiv(elWrapped,header_height);
    return false;
});
jQuery('.scrollCTA a.elementor-button-link').click(function(){
   
   var el = jQuery(this).attr('href');
   var elWrapped = jQuery(el);
   var header_height = jQuery('#header').height() + 120;
   console.log('neww:'+header_height);
   //var header_height = $('#header-id-goes-here').outerHeight(); You might need outerHeight if you have padding and borders

   scrollToDiv(elWrapped,header_height);
   return false;
});

jQuery('.scrollAnchor .vc_custom_heading a').click(function(){
   
   var el = jQuery(this).attr('href');
   var elWrapped = jQuery(el);
   var header_height = jQuery('#header').height() + 120;
   console.log('neww:'+header_height);
   //var header_height = $('#header-id-goes-here').outerHeight(); You might need outerHeight if you have padding and borders

   scrollToDiv(elWrapped,header_height);
   return false;
});
</script>
	<?php
}
add_action('wp_footer','wpfooterscript');




 add_action( 'template_redirect', 'redirect_post_type_singlenew' );
 function redirect_post_type_singlenew(){
     if ( ! is_singular( 'news_event' ) )
         return;
    
     $works_slug = explode('/',$_SERVER['REQUEST_URI']);
     
     if(in_array('news_event',array_filter($works_slug))){
         wp_redirect( get_permalink(), 301 );
         exit;
     } 
     
  }
  
 function newevent_remove_slug( $post_link, $post, $leavename ) {
 
     if ( 'news_event' != $post->post_type || 'publish' != $post->post_status ) {
         return $post_link;
     }
     $eventnews_links = get_post_meta($post->ID, 'eventnews_links', true );
     if(!empty($eventnews_links) && !is_admin()){
        $post_link = $eventnews_links;
     }else{
        $post_link = str_replace( '/news_event/', '/', $post_link );
     }
     return $post_link;
 }
 add_filter( 'post_type_link', 'newevent_remove_slug', 10, 3 );
 
 function newevent_parse_request( $query ) {
     
     if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
         return;
     }    
     if ( ! empty( $query->query['name'] ) ) {
         global $wpdb;
         $cpt = $wpdb->get_var("SELECT post_type FROM $wpdb->posts WHERE post_name = '{$query->query['name']}'");
         if($cpt == 'news_event'){
             $query->query['post_type'] = $cpt;
             $query->query_vars['post_type'] = $cpt;
             unset($query->query['page']);
             unset($query->query_vars['page']);
         }
         $query->set( 'post_type', $cpt );
     }
 }
         
 add_action( 'pre_get_posts', 'newevent_parse_request' );



add_filter('post_class', 'set_row_post_class', 10,3);
function set_row_post_class($classes, $class, $post_id){

    $eventnews_links = get_post_meta($post_id, 'eventnews_links', true );
    if( !is_admin() && !empty($eventnews_links)){
        $classes[] = 'external_link_black'; 
    }
    // Return the array
    return $classes;
}

add_action('wp_footer','footerscript_external');
function footerscript_external(){
    ?>
    <script>
        jQuery(document).ready(function(){ 
            jQuery('.external_link_black a').attr('target','_blank')
        });
    </script>

    <!-- <script>
    jQuery(window).on('beforeunload', function(){
        jQuery(window).scrollTop(0);
    });
    </script> -->

    <!-- <style>
       body.safari header#header .logo img{
    height: auto !important;
    }
    </style> -->

<?php }


add_action('wp_head','fbhcript_external');
function fbhcript_external() { ?>
    <style>
        body.safari header#header .logo img{ height:auto !important; }
    </style>
<?php }
/**/
function webinar_hub(){
    ob_start();
  
   $the_query = new WP_Query( array(
        'post_type'=> 'webinar_topices',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    ));
    ?>
    <div class="posts_grid">
   <ul class="post_list_ul<?php echo esc_attr($posts_class); ?>">
                <?php
                if ($the_query -> have_posts()) :
                    while ($the_query -> have_posts()) : $the_query -> the_post();
                    $eventnews_links = get_post_meta( get_the_ID(), 'eventnews_links', true );
                    if(!empty($eventnews_links)){

                            $perlink=$eventnews_links;
                    }else{
                                $perlink=get_the_permalink(); 

                    }?>
                      <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php if ( has_post_thumbnail() ) { ?>
    <div class="post_thumbnail"><a href="<?php echo $perlink; ?>">
      <?php 
echo get_the_post_thumbnail( get_the_ID(), 'consulting-image-350x204-croped' ); 
      ?>
    <?php echo $textimg; ?></a>
    </div>
<?php } else {
    $imgg=get_site_url().'/wp-content/uploads/2020/06/placeholder-20.gif';
    ?>  
      
    
    <div class="post_thumbnail">
        <a href="<?php echo $perlink; ?>" >
      <img width="350" height="204" src="<?php echo $imgg;?>" 
    class="attachment-consulting-image-350x204-croped size-consulting-image-350x204-croped wp-post-image" alt="AdobeStock_272835623" />     
   </a>
    </div>
     <?php  } ?>
     <?php 
     $categories = get_the_terms( get_the_ID(),'webinar_cat');
   
    if(!empty( $categories)) {
     ?>
        <div class="category">
            <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>">
                <span><?php echo $categories[0]->name; ?></span>
                <i class="fa fa-chevron-right"></i>
            </a>
        </div>
        <?php } ?>  
      
        
<h5><a href="<?php echo $perlink; ?>"  class="secondary_font_color_hv"><?php the_title(); ?></a></h5>
<div class="post_date"><i class="fa fa-clock-o"></i> <?php echo get_the_date(); ?></div>
</li>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    get_template_part('partials/content', 'none');
                endif;
                ?>
            </ul>
            </div>
            <?php
echo paginate_links(array(
    'type' => 'list',
    'prev_text' => '<i class="fa fa-chevron-left"></i>',
    'next_text' => '<i class="fa fa-chevron-right"></i>',
));
?>
<?php
 $html=ob_get_clean();
return $html;
}
add_shortcode('webinar_hub','webinar_hub');


/*webinart remove text*/
add_action( 'template_redirect', 'redirect_post_type_singlewebinaer' );
 function redirect_post_type_singlewebinaer(){
     if ( ! is_singular( 'webinar_topices' ) )
         return;
    
     $works_slug = explode('/',$_SERVER['REQUEST_URI']);
     
     if(in_array('webinar_topices',array_filter($works_slug))){
         wp_redirect( get_permalink(), 301 );
         exit;
     } 
     
  }
  
 function singlewebinartopic_remove_slug( $post_link, $post, $leavename ) {
 
     if ( 'webinar_topices' != $post->post_type || 'publish' != $post->post_status ) {
         return $post_link;
     }
     $eventnews_links = get_post_meta($post->ID, 'eventnews_links', true );
     if(!empty($eventnews_links) && !is_admin()){
        $post_link = $eventnews_links;
     }else{
        $post_link = str_replace( '/webinar_topices/', '/', $post_link );
     }
     return $post_link;
 }
 add_filter( 'post_type_link', 'singlewebinartopic_remove_slug', 10, 3 );
 
 function webinartopic_parse_request( $query ) {
     
     if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
         return;
     }    
     if ( ! empty( $query->query['name'] ) ) {
         global $wpdb;
         $cpt = $wpdb->get_var("SELECT post_type FROM $wpdb->posts WHERE post_name = '{$query->query['name']}'");
         if($cpt == 'webinar_topices'){
             $query->query['post_type'] = $cpt;
             $query->query_vars['post_type'] = $cpt;
             unset($query->query['page']);
             unset($query->query_vars['page']);
         }
         $query->set( 'post_type', $cpt );
     }
 }
         
 add_action( 'pre_get_posts', 'webinartopic_parse_request' );




 function getheight_page_template_redirect() {
    
    $heightpx = get_field('page_title_minheaderheight', 'option'); 
    $bgcoloroption = get_field('background_color_in_header', 'option'); 
    $title_color_in_header = get_field('title_color_in_header', 'option');     

    if($bgcoloroption!=''){
       
        ?>
        <style>
            body .page_title{ background-color:<?php echo $bgcoloroption; ?> !important; }
            .page_title.transparent {background: transparent !important;}
        </style>
        <?php

    }

    if(!empty($title_color_in_header)): ?>
       <style>
            body .page_title h1{ color:<?php echo $title_color_in_header; ?> !important; }
            body .page_title .breadcrumbs { color:<?php echo $title_color_in_header; ?> !important; }
            body .page_title h1:after {background: <?php echo $title_color_in_header; ?> !important;}
        </style>
   <?php endif;

    if($heightpx!=''){ ?>

        <style>  
         .page_title{ 
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: <?php echo $heightpx; ?>px; 
            padding: 20px 0 !important;
            flex-wrap: wrap;
        }
        .page_title h1 {
                margin: 0;
             word-break: break-all;padding-top: 0px !important;
        }
       </style>

       

     

    <?php
    }
    
  
     
}
add_action( 'template_redirect', 'getheight_page_template_redirect' );

/****/
require get_stylesheet_directory() . '/inc/custom-functions.php';

/****/
function provana_remove_wp_block_library_css(){
 wp_dequeue_style( 'wp-block-library' );

if(!is_home()):
 wp_dequeue_style( 'font-awesome-min' ); 
endif;

 //wp_dequeue_style( 'font-awesome' ); 

/**Homepage**/
if(is_front_page() || is_page( 7381 ) ||  is_page( 7429 ) || is_page( 7555 ) || is_page( 7586 ) || is_page( 7596 ) || is_page( 7603 ) || is_page( 7623 ) || is_page( 7633 ) || is_page( 8178 ) || is_page( 8320 ) || is_page( 8363 ) || is_page( 8387 ) || is_page( 8439 ) || is_page( 8437 ) || is_page( 8501 ) || is_page( 8503 ) || is_page( 8510 ) || is_page( 8204 ) || is_page( 8204 ) || is_page( 8287 ) || is_home() || is_page( 8932 ) || 'stm_works' == get_post_type() || is_page( 6352 ) || is_page( 1171 ) || is_page( 13396 ) || is_page( 13367 ) ):
    wp_dequeue_style( 'consulting-clac-style' );
    wp_dequeue_style( 'addtoany' );
    wp_dequeue_style( 'select2' ); 
 
    wp_dequeue_script( 'addtoany-jquery' );
    wp_dequeue_script( 'select2' );
    wp_dequeue_script( 'isotope' );
    wp_dequeue_script( 'addtoany-core' );
endif;
/**End Homepage**/

/**products an solutions pages**/
if(is_page( 7381 ) ||  is_page( 7429 ) || is_page( 7555 ) || is_page( 7586 ) || is_page( 7596 ) || is_page( 7603 ) || is_page( 7623 ) || is_page( 7633 ) || is_page( 8178 ) || is_page( 8320 ) || is_page( 8363 ) || is_page( 8387 ) || is_page( 8439 ) || is_page( 8437 ) || is_page( 8501 ) || is_page( 8503 ) || is_page( 8510 ) || is_page( 8433 ) || is_page( 8204 ) || is_page( 8287 ) || is_home() || is_single() || is_page( 8932 ) || 'stm_works' == get_post_type() || is_page( 11750 ) || 'news_event' == get_post_type() || is_page( 6352 ) || is_page( 1171 ) || is_page( 13396 ) || is_page( 13367 ) ):
    wp_dequeue_style( 'slick' );

    wp_dequeue_script( 'slick' );
    wp_dequeue_script( 'Chart' );

endif;
/**End page**/

if(is_single() || is_page( 11750 ) || 'news_event' == get_post_type() ):
    wp_dequeue_style( 'consulting-clac-style' );
    wp_dequeue_style( 'select2' );

    wp_dequeue_script( 'select2' );
    wp_dequeue_script( 'isotope' );
endif;
/****/

if('stm_works' == get_post_type()){
    wp_dequeue_style( 'owl.carousel' );

    wp_dequeue_script( 'owl.carousel' );
}
/****/

} 
add_action( 'wp_enqueue_scripts', 'provana_remove_wp_block_library_css', 100 );




if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Global Settings',
		'menu_title'	=> 'Global Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Theme Header Settings',
	// 	'menu_title'	=> 'Header',
	// 	'parent_slug'	=> 'theme-general-settings',
	// ));
	
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Theme Footer Settings',
	// 	'menu_title'	=> 'Footer',
	// 	'parent_slug'	=> 'theme-general-settings',
	// ));
	
}


function forscriptcss(){
?>
<style>

.stm_news .news_list li h5:before{ display:none !important;}
h4.no_stripe.titlecasestudyc, h4.no_stripe.titlecasestudyc a {
    color: #2F2D71;
    text-decoration: unset !important;
     font-family: Lato !important;
    font-weight: 700;
    font-size: 18px;
    line-height: 22px;
}
</style>
<?php
}
add_action('wp_footer','forscriptcss');



function custom_redirects() {

	
	if ( is_post_type_archive( 'stm_works' ) ) {


		wp_redirect( home_url( '/case-studies/' ) );
	
	}

}
add_action( 'template_redirect', 'custom_redirects' );

/*****/
/*Case study remove text*/
add_action( 'template_redirect', 'redirect_post_type_singlecasestudy' );
 function redirect_post_type_singlecasestudy(){
     if ( ! is_singular( 'stm_works' ) )
         return;
    
     $works_slug = explode('/',$_SERVER['REQUEST_URI']);
     
     if(in_array('stm_works',array_filter($works_slug))){
         wp_redirect( get_permalink(), 301 );
         exit;
     } 
     
  }
  
 function singlecasestudy_remove_slug( $post_link, $post, $leavename ) {
 
     if ( 'stm_works' != $post->post_type || 'publish' != $post->post_status ) {
         return $post_link;
     }
     
    $post_link = str_replace( '/stm_works/', '/', $post_link );
     
     return $post_link;
 }
 add_filter( 'post_type_link', 'singlecasestudy_remove_slug', 10, 3 );
 
 function casestudy_parse_request( $query ) {
     
     if ( ! $query->is_main_query() || 2 != count( $query->query ) || ! isset( $query->query['page'] ) ) {
         return;
     }    
     if ( ! empty( $query->query['name'] ) ) {
         global $wpdb;
         $cpt = $wpdb->get_var("SELECT post_type FROM $wpdb->posts WHERE post_name = '{$query->query['name']}'");
         if($cpt == 'stm_works'){
             $query->query['post_type'] = $cpt;
             $query->query_vars['post_type'] = $cpt;
             unset($query->query['page']);
             unset($query->query_vars['page']);
         }
         $query->set( 'post_type', $cpt );
     }
 }    
 add_action( 'pre_get_posts', 'casestudy_parse_request' );
 /****/

add_action( 'template_redirect', 'webinar_specific_redirect_post' );
function webinar_specific_redirect_post() {
  $queried_post_type = get_query_var('post_type');
  global $post, $wp;
  if($wp->request == 'speechanalytics2.0'){
    $redirectUrl = home_url().'/speechanalytics2-0';
    wp_redirect( $redirectUrl, 301 );
    exit;
  }
  if($wp->request == 'speechanalytics2.0-doffie'){
    $redirectUrl = home_url().'/speechanalytics2-0-doffie';
    wp_redirect( $redirectUrl, 301 );
    exit;
  }
}

/**Make widget video tabs **/
function register_video_tabs_widget( $widgets_manager ) {

    require get_stylesheet_directory() . '/widgets/videotabs-widget.php';
    $widgets_manager->register( new \Elementor_List_Widget() );
    
}
add_action( 'elementor/widgets/register', 'register_video_tabs_widget' );

/**Make video testimonial widget **/
function register_oembed_widget( $widgets_manager ) {

    require get_stylesheet_directory() . '/widgets/video-testimonial-widget.php';

    $widgets_manager->register( new \Elementor_oEmbed_Widget() );

}
add_action( 'elementor/widgets/register', 'register_oembed_widget' );

//register new site footer widget
function footer_newsite_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'New Site Footer1', 'consulting-child' ),
        'id'            => 'new_site_footer1',
        'description'   => __( 'New site footer1.', 'consulting-child' ),
        'before_widget' => '<section id="%1$s" class="widget widget_nav_menu">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget_title no_stripe">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'New Site Footer2', 'consulting-child' ),
        'id'            => 'new_site_footer2',
        'description'   => __( 'New site footer2.', 'consulting-child' ),
        'before_widget' => '<section id="%1$s" class="widget widget_nav_menu">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget_title no_stripe">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'footer_newsite_widgets_init' );
/****/
//add body class for newsite pages
add_filter( 'body_class', 'newsite_body_class' );
function newsite_body_class( $classes ) {
$is_new_site_menu = get_field("is_new_site_menu");
    if ( $is_new_site_menu == 1 ) { 
        $classes[] = 'newsitepage'; // add your class here
    }

    return $classes;
}