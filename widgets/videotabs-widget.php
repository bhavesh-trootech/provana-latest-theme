<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor List Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_List_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Video Tabs Slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Video Tabs Slider', 'elementor-list-widget' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Video Tabs', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Video List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'list_title',
						'label' => esc_html__( 'Logo Title', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'default' => esc_html__( 'Logo Title' , 'textdomain' ),
						'label_block' => true,
					],
					[
						'name' => 'video_tab_image',
						'label' => esc_html__( 'Logo Image', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [	
										'url' => \Elementor\Utils::get_placeholder_image_src(),
									]
					],
					[
						'name' => 'add_video_link',
						'label' => esc_html__( 'Add Video Link', 'textdomain' ),
						'type' => \Elementor\Controls_Manager::URL,
			            'placeholder' => __('https://your-link.com', 'textdomain'),
					]
				],
				'default' => [
					[
						'list_title' => esc_html__( 'Logo Title #1', 'textdomain' ),
						//'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
					[
						'list_title' => esc_html__( 'Logo Title #2', 'textdomain' ),
						//'list_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['list'] ) {
			echo '<div class="videoSliderParent">';

            echo '<div class="titleSlide">';
            echo '<div class="slider slider-title">';
            foreach (  $settings['list'] as $item ) {
			 ?>
			 <div class="vc_custom_heading  consulting_heading_font  text_align_center text-center videoTitles">
			 	<h2 class="consulting-custom-title"><?php echo $item['list_title']; ?></h2>
			 </div>
			<?php }
            echo '</div>';
            echo '</div>';

    
            echo '<div class="logoThumbs">';
			echo '<div class="slider slider-thumb">';
			foreach (  $settings['list'] as $item ) {
			 ?>
                <div class="thumbSlider">
                    <img src="<?php echo esc_url( $item['video_tab_image']['url'] ); ?>">
                </div>
           
			<?php }
			echo '</div>';
			echo '</div>';

 
            echo '<div class="videoSlider">';
                echo '<div class="videoSliderInner slider">';
                    foreach (  $settings['list'] as $itemLinks ) {
                     ?>
                    <div class="videoSlide">
                        <video controls autoplay muted playsinline preload="metadata">
                            <source src="<?php echo esc_url( $itemLinks['add_video_link']['url'] ); ?>" type="video/mp4">
                        </video>
                    </div>
                    <?php }
                    
                echo '</div>';
            echo '</div>';

			echo '</div>';

			?>
			<style>
				.videoSliderInner.slider {position: relative !important;}
				.titleSlide .slick-slide {height: auto;}
				.slider-thumb .slick-slide {height: auto;}
				.videoSliderInner.slider .slick-arrow:before {
				    display: inline-block;
				    font-family: eicons;
				    font-size: inherit;
				    font-weight: 400;
				    font-style: normal;
				    font-variant: normal;
				    line-height: 1;
				    text-rendering: auto;
				    color: #fff;
				    font-size: 32px;
				    opacity: 0.8;
				}
				.videoSliderInner.slider .slick-arrow.slick-prev:before {
				    content: '\e87e';
				}
				.videoSliderInner.slider .slick-arrow.slick-next:before {
				    content: '\e87d';
				}
				.videoSliderInner.slider .slick-arrow.slick-prev {
				    left: -50px;
				}
				.videoSliderInner.slider .slick-arrow.slick-next {
				    right: -50px;
				}
				.videoSliderInner  .slick-slide {height: inherit !important;}
				.videoSliderInner .slick-dots li.slick-active button {background: #04a54b;}
				.videoSliderInner .slick-dots li button {font-size: 0;line-height: 0; display: block; width: 16px !important;  height: 16px !important; padding: 5px; cursor: pointer; color: transparent; border: 0; outline: none; background: #fff; border-radius: 50%;}
				.slider.slider-thumb .slick-track {margin-left: 0;}
				.videoTitles {margin-bottom: 25px !important;}
                 .videoTitles h2 {font-size: 36px; color: #FFFFFF; text-align: center; line-height: 45px;  font-weight: 700 !important;}

                @media (max-width: 1024px) {
				.videoSlider {width: 80%; text-align: center; margin: 0 auto;}
				
			   }

				@media (max-width: 991px) {
				  .logoThumbs .slick-slide .thumbslider img {
				  	padding: 15px 25px;
				  }
				  .videoSliderInner  ul.slick-dots {
					    position: relative;
					    width: max-content;
					    margin: 0 auto;
					}
				}

				@media (max-width: 575px) {
				 .videoSlider {width: 100%;}
				 .logoThumbs .slick-arrow {width: 35px; height: 35px;}
				 .logoThumbs .slick-arrow:before {display: inline-block; font-family: eicons; font-weight: 400; font-style: normal;
    font-variant: normal; line-height: 1; text-rendering: auto; color: #fff; font-size: 30px; opacity: 0.8;}
    .logoThumbs .slick-arrow.slick-prev:before {content: '\e87e';}
    .logoThumbs .slick-arrow.slick-next:before {content: '\e87d';}

				}
			</style>

			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
            
 <?php if(!is_admin()): ?>           
			<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.js"></script>

			<script>
        jQuery( document ).ready(function() {
          jQuery('.thumbSlider').mousedown(function(event) {
            switch (event.which) {
                case 1:
                    jQuery('.thumbSlider a').addClass('mouseClick')
                    break;
                case 2:
                    alert('Middle Mouse button pressed.');
                    break;
                case 3:
                    jQuery('.thumbSlider a').removeClass('mouseClick')
                    break;
                default:
                    alert('You have a strange Mouse!');
            }
        });

        

        jQuery('.videoSliderInner').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: false,
            speed: 1000,
            asNavFor: '.slider-thumb, .slider-title',
            arrows: true,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        infinite: true,
                        dots: true,
                        onAfterChange : function() {
                            player.stopVideo();
                        }
                    }
                },

            ]

        });
        jQuery('.slider-thumb').slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            asNavFor: '.videoSliderInner, .slider-title',
            dots: false,
            arrows: false,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 991,
                    settings: {
                    	slidesToShow: 2,
                        slidesToScroll: 1,
                        arrows: false,
                        dots: false,
                    }
                },
               {
                    breakpoint: 575,
                    settings: {
                    	slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        centerMode: true,
                        centerPadding: '70px',
                    }
                }
            ]

        });

        jQuery('.slider-title').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: '.videoSliderInner, .slider-thumb',
            dots: false,
            arrows: false,
            centerMode: true,
            focusOnSelect: true
        });

        jQuery('.videoSliderInner').on('afterChange', function(event, slick, currentSlide, nextSlide){
            jQuery("video").each(function(){
                jQuery(this).get(0).pause();
            });
            var video_slider = jQuery('.videoSliderInner').find("[data-slick-index='" + currentSlide + "']").find("video")
            if(video_slider.length>0){
                video_slider.get(0).play();
            }
        });

    });


</script>
<?php endif; ?>

			<?php

		}
	}

	protected function content_template() {
		?>
		<# if ( settings.list.length ) { #>
			<dl>
			<# _.each( settings.list, function( item ) { #>
				<dt class="elementor-repeater-item-{{ item._id }}">{{{ item.list_title }}}</dt>
				
			<# }); #>
			</dl>
		<# } #>
		<?php
	}
	
}