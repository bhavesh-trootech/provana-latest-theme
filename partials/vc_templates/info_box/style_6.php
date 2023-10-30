<?php
/**
 * @var $align_center
 * @var $css_class
 * @var $style
 * @var $title_icon
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

$icon_styles = array();
$icon_style  = '';

if ( ! empty( $title_icon_size ) ) {
	$icon_styles[] = 'font-size: ' . esc_attr( $title_icon_size ) . 'px';
}

if ( ! empty( $icon_styles ) && is_array( $icon_styles ) ) {
	$icon_style = implode( '; ', $icon_styles );
}

if ( ! empty( $link_title ) ) {
	$link['title'] = $link_title;
}
?>
<div class="info_box<?php echo esc_attr( $css_class ); ?>">
	<div class="info_box_text">
		<div class="title">
			<div class="icon">
				<i class="<?php echo esc_attr( $title_icon ); ?>" style="<?php echo esc_attr( sanitize_text_field( $icon_style ) ); ?>"></i>
			</div>
			<h5 class="no_stripe">
				<?php
				if ( $link['url'] ) {
					echo ' <a href="' . esc_url( $link['url'] ) . '">' . esc_html( $title ) . '</a>';
				}
				?>
			</h5>
		</div>
		<?php echo wp_kses_post( consulting_filtered_output( $content ) ); ?>
		<?php
		if ( $link['url'] ) {
			if ( ! $link['title'] ) {
				$link['title'] = esc_html__( 'Read more', 'consulting' );
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
