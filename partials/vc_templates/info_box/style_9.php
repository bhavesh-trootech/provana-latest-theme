<?php
/**
 * @var $align_center
 * @var $css_class
 * @var $style
 */

if ( $align_center ) {
	$css_class .= ' align_center';
}

if ( $style ) {
	$css_class .= ' ' . $style;
}

if ( ! empty( $link_title ) ) {
	$link['title'] = $link_title;
}
?>
<div class="infobox <?php echo esc_attr( $css_class ); ?>">
	<?php if ( ! empty( $infobox_label ) ) : ?>
		<div class="infobox_label heading_font third_bg_color">
			<?php echo esc_html( $infobox_label ); ?>
		</div>
	<?php endif; ?>
	<?php if ( ! empty( $title ) ) : ?>
		<div class="infobox_title_wrap">
			<h4 class="infobox_title"><?php echo esc_html( $title ); ?></h4>
		</div>
	<?php endif; ?>
	<?php if ( ! empty( $content ) ) : ?>
		<div class="infobox_content base_font_color">
			<?php echo wp_kses_post( $content ); ?>
		</div>
	<?php endif; ?>
</div>
