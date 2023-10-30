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
	<?php if ( ! empty( $title ) ) : ?>
		<h4 class="infobox_title"><?php echo esc_html( $title ); ?></h4>
	<?php endif; ?>
	<?php if ( ! empty( $content ) ) : ?>
		<div class="infobox_content">
			<?php echo wp_kses_post( $content ); ?>
		</div>
	<?php endif; ?>
	<?php if ( ! empty( $link['url'] ) ) : ?>
		<?php
		if ( empty( $link['title'] ) ) {
			$link['title'] = esc_html__( 'Read more', 'consulting' );
		}
		?>
		<a href="<?php echo esc_url( $link['url'] ); ?>" class="infobox_link">
			<i class="stm-lnr-arrow-right third_bg_color"></i>
			<?php echo wp_kses_post( $link['title'] ); ?>
		</a>
	<?php endif; ?>
</div>
