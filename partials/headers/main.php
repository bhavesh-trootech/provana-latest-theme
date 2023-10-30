<div id="fullpage" class="content_wrapper">
<?php if( !is_404() ) : ?>
	<div id="menu_toggle_button" style="display: none;">
		<button>&nbsp;</button>
	</div>
    <header id="header">
        <?php
            if( defined( 'STM_HB_VER' ) && consulting_theme_option( 'header_builder' ) == 'pear_builder' ) {
                do_action( 'stm_hb', array( 'header' => 'stm_hb_settings' ) );
            } else {
                if( consulting_theme_option( 'top_bar', false ) ) {
                    get_template_part( 'partials/headers/top_bar' );
                }
                get_template_part( 'partials/headers/styles/' . consulting_theme_option( 'header_style', 'header_style_1' ) );
            }
        ?>
    </header>
    <div id="main" <?php if( consulting_theme_option( 'footer_show_hide', false ) ): ?>class="footer_hide"<?php endif; ?>>
        <?php get_template_part( 'partials/title_box' ); ?>
        <div class="<?php echo esc_attr( apply_filters( 'consulting_main_container_class', 'container' ) ); ?>">
<?php endif; ?>