<?php
/**
 * @var $align_center
 * @var $css_class
 * @var $style
 * @var $image
 * @var $title
 * @var $content
 */

if ( $align_center ) {
	$css_class .= ' align_center';
}

if ( $style ) {
	$css_class .= ' ' . $style;
}

if ( ! empty( $vc_image_size ) ) {
	$image_size = $vc_image_size;
} else {
	$image_size = 'consulting-image-350x204-croped';
}

$thumbnail = wp_get_attachment_image( $image, $image_size );
?>
<div class="info_box<?php echo esc_attr( $css_class ); ?>">
	<?php if ( $image ) : ?>
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
	<?php endif; ?>

	<?php if ( $title ) : ?>
		<div class="title">
			<h4 class="no_stripe"><?php echo esc_html( $title ); ?></h4>
		</div>
	<?php endif; ?>
	<?php echo wp_kses_post( consulting_filtered_output( $content ) ); ?>
</div>
