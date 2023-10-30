<?php

wp_enqueue_script( 'slick' );
wp_enqueue_style( 'slick' );

if( !empty( $style ) ) {
    $css_class .= ' ' . esc_attr( $style );
}

$args = array(
    'post_type' => 'stm_works',
    'posts_per_page' => $count
);

if ($category != 'all') {
    $args['stm_works_category'] = $category;
}

if ($per_row) {
    $css_class .= ' per_row_' . $per_row;
} else {
    $per_row = 1;
}

if ($disable_carousel) {
    $css_class .= ' disable_carousel';
}

if (empty($thumb_size)) {
    $thumb_size = '350x350';
}
if (stm_check_layout('layout_ankara')) {
    $thumb_size = '200x200';
}

$testimonials = new WP_Query($args);
$id = uniqid('partners_carousel_');

$autoplay_carousel_js = 'false';
if (!empty($autoplay_carousel) and $autoplay_carousel == 'yes') {
    $autoplay_carousel_js = 'true';
}
?>
<?php if ($testimonials->have_posts()): ?>
    <div class="<?php echo esc_attr($css_class); ?>" id="<?php echo esc_attr($id); ?>">
        <?php while ($testimonials->have_posts()): $testimonials->the_post(); ?>

            <?php if ($style == 'style_1') : ?>
                <?php if (stm_check_layout('layout_14') || stm_check_layout('layout_lyon') and !$disable_carousel): ?>
                    <div class="testimonial casestyulist">
                        <?php
                        $author_photo = consulting_get_image(get_post_thumbnail_id(), $thumb_size);
                        ?>
                        <div class="image">
                            <?php if ($link['url']): ?>
                                <a href="<?php echo esc_url($link['url']); ?>">
                                    <?php echo consulting_filtered_output($author_photo); ?>
                                </a>
                            <?php else: ?>
                                <?php echo consulting_filtered_output($author_photo); ?>
                            <?php endif; ?>
                        </div>
                        <div class="info">
                            <?php
                            $position = get_post_meta(get_the_ID(), 'testimonial_position', true);
                            $company = get_post_meta(get_the_ID(), 'testimonial_company', true);
                            ?>

                            <div class="heading_font"><?php the_excerpt(); ?></div>
                            <h4 class="no_stripe">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                    <?php  echo wp_trim_words( get_the_title(), 10 ); ?>
                                </a>
                            </h4>
                          
                        </div>
                    </div>
                <?php elseif ((stm_check_layout('layout_15')
                        || stm_check_layout('layout_18')
                        || stm_check_layout('layout_stockholm')
                        || stm_check_layout('layout_osaka')
                        || stm_check_layout('layout_budapest')
                        || stm_check_layout('layout_barcelona')) && !$disable_carousel): ?>
                    <?php
                    $bg_image = get_post_meta(get_the_id(), 'testimonial_bg_img', true);
                    $video_url = get_post_meta(get_the_id(), 'testimonial_video_url', true);
                    $position = get_post_meta(get_the_ID(), 'testimonial_position', true);
                    $company = get_post_meta(get_the_ID(), 'testimonial_company', true);

                    if (empty($bg_image)) {
                        $bg_image = '';
                    } else {
                        $bg_image = wp_get_attachment_image_src($bg_image, 'full');
                        if (!empty($bg_image[0])) {
                            $bg_image = 'style="background-image:url(' . $bg_image[0] . ')"';
                        } else {
                            $bg_image = '';
                        }
                    }
                    ?>
                    <div class="testimonial casestyulist2" <?php echo sanitize_text_field($bg_image); ?>>
                        <div class="info">
                            <div class="container">
                                <?php if (!empty($video_url)): ?>
                                    <a href="#" data-url="<?php echo esc_attr($video_url); ?>"
                                       class="stm_video_url stm_fancy-iframe"></a>
                                <?php endif; ?>
                                <div class="stm_testimonial_excerpt"><i><?php the_excerpt(); ?></i></div>
                                <h4 class="no_stripe">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h4>
                               
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="testimonial casestyulist3">
                        <?php

                        $author_photo = consulting_get_image(get_post_thumbnail_id(), $thumb_size);
                        ?>
                        <div class="image">
                            <?php if ($link['url']): ?>
                                <a href="<?php echo esc_url($link['url']); ?>"><?php echo consulting_filtered_output($author_photo); ?></a>
                            <?php else: ?>
                                <?php echo consulting_filtered_output($author_photo); ?>
                            <?php endif; ?>
                        </div>
                        <div class="info">
                            <h4 class="no_stripe">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                            </h4>
                          
                          
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php elseif ($style == 'style_2') : ?>

                <div class="item">
                    <div class="testimonial casestyulist5"><?php the_excerpt(); ?></div>
                    <div class="testimonial-info clearfix">
                        <div class="testimonial-image"><?php the_post_thumbnail('consulting-image-50x50-croped'); ?></div>
                        <div class="testimonial-text">
                            <div class="name"><?php the_title(); ?></div>
                          
                        </div>
                    </div>
                </div>
            <?php elseif ($style == 'style_3') : ?>

                <div class="testimonial casestyulist4">
                    <div class="testimonial_inner">
                        <?php if (!$disable_image and has_post_thumbnail()): ?>
                            <?php
                            $author_photo = consulting_get_image(get_post_thumbnail_id(), $thumb_size);
                            ?>
                            <div class="image">
                                <span>
                                <?php if ($link['url']): ?>
                                    <a href="<?php echo esc_url($link['url']); ?>"><?php echo consulting_filtered_output($author_photo); ?></a>
                                <?php else: ?>
                                    <?php echo consulting_filtered_output($author_photo); ?>
                                <?php endif; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <div class="info">
                            <div class="stm_testimonials_content_unit"><?php the_excerpt(); ?></div>
                            <h6 class="no_stripe">
                                 <a href="<?php echo get_the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h6>
                           
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        <?php endwhile; ?>
    </div>
    <?php if (!$disable_carousel): ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                "use strict";
                var <?php echo esc_attr($id) ?> =
                $("#<?php echo esc_attr($id) ?>");
                var slickRtl = false;

                if ($('body').hasClass('rtl')) {
                    slickRtl = true;
                }

                <?php
                $opt = 'arrows: false,';
                if (!$disable_carousel_arrows) {
                    $opt = 'arrows: true,';
                    $opt .= 'prevArrow:"<div class=\"slick_prev\"><i class=\"fa fa-chevron-left\"></i></div>",';
                    $opt .= 'nextArrow: "<div class=\"slick_next\"><i class=\"fa fa-chevron-right\"></i></div>",';
                }
                ?>

                <?php echo esc_attr($id) ?>.
                slick({
                    rtl: slickRtl,
                    dots: <?php echo (stm_check_layout('layout_ankara')) ? 'true' : 'false'; ?>,
                    infinite: true,
                    <?php echo consulting_filtered_output($opt); ?>
                    autoplaySpeed: 5000,
                    autoplay: <?php echo esc_js($autoplay_carousel_js); ?>,
                    slidesToShow: <?php echo esc_js($per_row); ?>,
                    cssEase: "cubic-bezier(0.455, 0.030, 0.515, 0.955)",
                    responsive: [
                        {
                            breakpoint: 769,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            });
        </script>
    <?php endif; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>