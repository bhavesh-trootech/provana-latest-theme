<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_oEmbed_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Video Testimonial Widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Video Testimonial Widget', 'elementor-oembed-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-code';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'oembed', 'url', 'link' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
    ?>	
    <style>
    	.videoTestimonialMain  ul.works_filter.test553 {background: none;  padding: 0;}
    </style>
<?php

$categories = get_terms( 'video_category' );
$categories_slug = array();
$works_categories = get_terms( array(
    'taxonomy' => 'video_category',
    'hide_empty' => true,
 ) );

$catarr = array();
foreach($works_categories as $catvideos){
	$works_categories_arr[] = $catvideos->slug;
}

if( !empty( $works_categories ) ) {
    $categories_arr = array();
    //$works_categories_arr = is_array($works_categories) ? $works_categories : explode( ', ', $works_categories );
    foreach( $categories as $cat ) {
        if( in_array( $cat->slug, $works_categories_arr ) ) {
            $categories_arr[] = (object) array( 'name' => $cat->name, 'slug' => $cat->slug );
            $categories_slug[] = $cat->slug;
        }
    }

    $categories = $categories_arr;

    $all_works = new WP_Query( array(
        'post_type' => 'video-testimonial',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    ) );
}

$works_id = uniqid( 'stm_works_' );

$has_user_size = false;
if( !$img_size ) {
    $img_size = 'consulting-image-255x182-croped';
}
else {
    $has_user_size = true;
} ?>
<?php if ( $all_works->have_posts() ) : ?>

    <style>
        .stm_works > div:nth-child(3n+1) {clear: left; }
        .stm_works > div {float: left;}

        @media only screen and (max-width: 991px) {
        .stm_works > div:nth-child(3n+1) { clear: inherit; }
    }
    </style>
    <div id="casestudieddiv" class="videoTestimonialSection">
    <div id="<?php echo esc_attr( $works_id ); ?>" class="videoTestimonialMain stm_works_wr consulting_elementor_works cols_3 grid_with_filter style_1">
        <?php if ( $works_categories ) : ?>
            <ul class="works_filter test553">
                <li class="active"><a href="#all"><?php esc_html_e( 'All', 'consulting' ); ?></a></li>
                <?php foreach( $works_categories as $cat ): ?>
                    <li>
                        <a href="#<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_attr( $cat->name ); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="stm_works testrty">
                <?php $i=1; while ( $all_works->have_posts() ): $all_works->the_post(); 
                   $videoPostId = get_the_ID();
                	?>
                    <?php
                    $work_class = '';
                    $term_list = wp_get_post_terms( get_the_ID(), 'video_category' );
                    if( $term_list ) {
                        foreach( $term_list as $term ) {
                            $work_class .= ' ' . $term->slug;
                        }
                    }
                    ?>
                    <div class="item all<?php echo esc_attr( $work_class ); ?>" data-category="<?php echo esc_attr( $work_class ); ?>">
                    	<div class="post-27672 webinar_topices type-webinar_topices status-publish has-post-thumbnail hentry webinar_cat-speech-analytics">

					    <div class="post_thumbnail">
					      <a data-toggle="modal" data-target="#myModal<?php echo $i; ?>" data-videourl="<?php echo get_field("video_url", $videoPostId); ?>">
					      <?php the_post_thumbnail( 'large' ); ?>   
					       </a>
					    </div>

					    <div class="wrap-videodivs">
					    <?php if(!empty(get_field("customer_name", $videoPostId))): ?>
				             <div class="category">
				            <a href="#">
				                <span><?php echo get_field("customer_name", $videoPostId); ?></span>
				                <i class="fa fa-chevron-right"></i>
				            </a>
					        </div>
					    <?php endif; ?>
					        
					<h5><a href="#" data-toggle="modal" data-target="#myModal<?php echo $i; ?>" class="secondary_font_color_hv"><?php echo get_the_title($videoPostId); ?></a></h5>

                    <?php if(!empty(get_field("video_description", $videoPostId))): ?>
					<div class="video-description">
						<p><?php echo wp_trim_words( get_field("video_description", $videoPostId), 20, '...' ); ?></p>
					</div>
				<?php endif; ?>
                    <div class="datewrapdiv">
                    <div class="read_link"><a data-toggle="modal" data-target="#myModal<?php echo $i; ?>">View Now</a></div>
					<div class="post_date"><i class="fa fa-clock-o"></i> <?php echo get_field("video_date", $videoPostId); ?></div>
                    </div>
                    </div>
					</div>

                    </div>
                    <div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					    <div class="modal-dialog" role="document">
					      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        </div>
					        <div class="modal-body">
					          <video class="videoTesti" controls id="video<?php echo $i; ?>" width="100%" height="100%">
					            <source src="<?php echo get_field("video_url", $videoPostId); ?>" type="video/mp4">
					          </video>
					        </div>
					  
					      </div>
					    </div>
					</div>

					<script>
						 jQuery('#myModal<?php echo $i; ?>').on('shown.bs.modal', function () {
						  jQuery('#video<?php echo $i; ?>')[0].play();
						});
						jQuery('#myModal<?php echo $i; ?>').on('hidden.bs.modal', function () {
						  jQuery('#video<?php echo $i; ?>')[0].pause();
						});
					</script>
                <?php $i++; endwhile;
                wp_reset_postdata(); ?>
            </div>


        <?php endif; ?>

        <?php if(is_page(28637) || is_page(28770)): ?>
        <script>
        jQuery(document).ready(function($){

        var hashVal = location.hash.replace('#', '');
        if(hashVal == "all"){
              jQuery(".stm_works div.item").show();
            }

        var $filterButtonGroup = jQuery('ul.works_filter');
        if ( hashVal ) {
            $filterButtonGroup.find('li').removeClass('active');
            $filterButtonGroup.find('li a[href="#'+hashVal+'"]').parent('li').addClass('active');
          }
       
        var $items = jQuery('.stm_works div.item');
        $filterButtonGroup.on( 'click', 'li a', function() {
            
           var $filterButtonGroup = jQuery('ul.works_filter');
           var filterAttr = jQuery(this).attr('href');
           
           jQuery('ul.works_filter li').removeClass('active');
           jQuery(this).parent('li').addClass('active');

            var catslug = jQuery(this).attr('href');
            var catvalue = catslug.replace('#', '');

            if(catvalue == "all"){
              $items.show();
            } else{
            
            var $selecteddata = $items.filter(function() {
              return $(this).data('category').indexOf(catvalue) != -1;
            }).show();
            $items.not($selecteddata).hide();
            
           }
            
          });

        if(hashVal && hashVal !="all"){
            var $selectedHash = $items.filter(function() {
              return $(this).data('category').indexOf(hashVal) != -1;
            }).show();
            $items.not($selectedHash).hide();
        }else if(hashVal == "all"){
            $items.show();
        }

        });
        </script>
       <?php endif; ?>

    </div>

</div>
<?php endif; ?>

<?php wp_reset_postdata(); ?>

    
   <?php
	}

}