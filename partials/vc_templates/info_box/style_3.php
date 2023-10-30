<?php
/**
 * @var $align_center
 * @var $css_class
 * @var $style
 * @var $image
 * @var $title
 * @var $title_icon
 * @var $content
 * @var $icon
 */

if ( $align_center ) {
	$css_class .= ' align_center';
}

if ( $style ) {
	$css_class .= ' ' . $style;
}
$classstyle='';
if ( ! empty( $title_icon_size ) ) {
	$icon_stylessize = 'font-size: ' . esc_attr( $title_icon_size ) . 'px';
	$classstyle='clastst';
}else{
	$classstyle='';
}

if ( ! empty( $vc_image_size ) ) {
	$image_size = $vc_image_size;
} else {
	$image_size = 'consulting-image-350x250-croped';
}

if ( ! empty( $title_color_custom ) ) {
$sizeco=$title_color_custom;

}

$thumbnail = wp_get_attachment_image( $image, $image_size );

if ( ! empty( $link_title ) ) {
	$link['title'] = $link_title;
}
?>
<div class="info_box<?php echo esc_attr( $css_class ); ?>">
	<div class="info_box_wrapper">
		<?php if ( empty( $vc_image_size ) && $image && $thumbnail ) : ?>
			<div class="info_box_image">
				<?php echo wp_kses_post( consulting_filtered_output( $thumbnail ) ); ?>
			</div>
		<?php elseif ( $image && ! empty( $vc_image_size ) ) : ?>
			<?php $vc_image_data = wp_kses_post( consulting_get_image( $image, $vc_image_size ) ); ?>
			<div class="info_box_image">
				<?php echo wp_kses_post( consulting_filtered_output( $vc_image_data ) ); ?>
			</div>
		<?php endif; ?>
		<div class="info_box_text">
			<?php if ( $title ) : ?>
				<div class="title">
					<div class="icon <?php echo  esc_attr( $classstyle );?>" >
					
						<i class="<?php echo esc_attr( $title_icon ); ?>" style="<?php echo $icon_stylessize; ?>;line-height: 50px; color:<?php echo $sizeco; ?>;"></i>
					</div>
					<h6 class="no_stripe">
						<span><?php echo esc_html( $title ); ?></span>
					</h6>
				</div>
			<?php endif; ?>
			<?php echo wp_kses_post( consulting_filtered_output( $content ) ); ?>
			<?php
			if ( $link['url'] ) {
				if ( ! $link['title'] ) {
					$link['title'] = esc_html__( 'Read More', 'consulting' );
				}
				if ( ! $link['target'] ) {
					$link['target'] = '_self';
				}
				echo '<a class="read_more" target="' . esc_attr( $link['target'] ) . '" href="' . esc_url( $link['url'] ) . '"><span>' . esc_html( $link['title'] ) . '</span>';
				if ( is_array( $icon ) ) {
					if ( array_key_exists( 'library', $icon ) ) {
						echo '<span class="stm_icon">';
						\Elementor\Icons_Manager::render_icon( $icon );
						echo '</span>';
					}
				} else {
					echo '<i class="' . esc_attr( $icon ) . ' stm_icon"></i>';
				}
				echo '</a>';
			}
			?>
		</div>
	</div>
</div>
