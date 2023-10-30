<?php
/**
 * @var $align_center
 * @var $css_class
 * @var $style
 * @var $title
 * @var $content
 * @var $icon
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
<div class="info_box<?php echo esc_attr( $css_class ); ?>">
	<?php if ( $title ) : ?>
		<div class="title">
			<h3><?php echo esc_html( $title ); ?></h3>
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
