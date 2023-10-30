<?php
$css_class .= ' cols_' . $cols;
$css_class .= ' ' . $style;

$css_class .= ' ' . esc_attr( $grid_with_filter_style );

wp_enqueue_script( 'isotope' );
wp_enqueue_script( 'imagesloaded' );

if( empty( $works_count ) ) {
    $works_count = -1;
}

$all_works = new WP_Query( array(
    'post_type' => 'stm_works',
    'posts_per_page' => $works_count
) );

$categories = get_terms( 'stm_works_category' );
$categories_slug = array();

if( !empty( $works_categories ) ) {
    $categories_arr = array();
    $works_categories_arr = is_array($works_categories) ? $works_categories : explode( ', ', $works_categories );
    foreach( $categories as $cat ) {
        if( in_array( $cat->slug, $works_categories_arr ) ) {
            $categories_arr[] = (object) array( 'name' => $cat->name, 'slug' => $cat->slug );
            $categories_slug[] = $cat->slug;
        }
    }

    $categories = $categories_arr;

    $all_works = new WP_Query( array(
        'post_type' => 'stm_works',
        'posts_per_page' => $works_count,
        'tax_query' => array(
            array(
                'taxonomy' => 'stm_works_category',
                'field' => 'slug',
                'terms' => $categories_slug,
            ),
        ),
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

    <div id="<?php echo esc_attr( $works_id ); ?>" class="stm_works_wr<?php echo esc_attr( $css_class ); ?>">
        <?php if ( $categories ) : ?>
            <ul class="works_filter test553">
                <li class="active"><a href="#all"><?php esc_html_e( 'All', 'consulting' ); ?></a></li>
                <?php foreach( $categories as $cat ): ?>
                    <li>
                        <a href="#<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_attr( $cat->name ); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="stm_works test561">
                <?php while ( $all_works->have_posts() ): $all_works->the_post(); ?>
                    <?php
                    $work_class = '';
                    $term_list = wp_get_post_terms( get_the_ID(), 'stm_works_category' );
                    if( $term_list ) {
                        foreach( $term_list as $term ) {
                            $work_class .= ' ' . $term->slug;
                        }
                    }
                    ?>
                    <div class="item all<?php echo esc_attr( $work_class ); ?>" data-category="<?php echo esc_attr( $work_class ); ?>">

                        <div class="image">
                            <?php

                            $post_thumbnail = consulting_get_image( get_post_thumbnail_id(), $img_size );

                            if( strlen( get_the_title() ) > 71 ) {
                                $title = substr( get_the_title(), 0, 71 ) . "...";
                            }
                            else {
                                $title = get_the_title();
                            }
                            ?>
                            <a href="<?php the_permalink(); ?>"><?php echo consulting_filtered_output( $post_thumbnail ); ?></a>
                        </div>
                        <div class="info">
                            <?php 
                            $termsLists = get_field('select_category');
                            if( $termsLists ): ?>
                                <div class="category">


                                    
                                    <a class="work-first-cat" href="#<?php echo esc_attr( $termsLists[ 0 ]->slug ); ?>">
                                        <span><?php echo esc_html( $termsLists[ 0 ]->name ); ?></span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>

                                    <?php if(!empty($termsLists[ 1 ]->name)): ?>
                                    <a class="work-second-cat" href="#<?php echo esc_attr( $termsLists[ 1 ]->slug ); ?>">
                                        <span><?php echo esc_html( $termsLists[ 1 ]->name ); ?></span>
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <div class="title"><a
                                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </div>
                        </div>


                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>


        <?php endif; ?>

        <?php if(is_page(8932)): ?>
        <script>
        jQuery(document).ready(function($){
            //alert('test');
        var hashVal = location.hash.replace('#', '');

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
<?php endif; ?>

<?php wp_reset_postdata(); ?>

