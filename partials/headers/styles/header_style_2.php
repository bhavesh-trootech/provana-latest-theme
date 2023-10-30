<?php

$page_id = consulting_page_id();

$logo_tmp_src = '';

$logo = consulting_get_logo_url( 'logo', get_template_directory_uri() . '/assets/images/tmp/' . $logo_tmp_src . 'logo_default.svg' );

$dark_logo = consulting_get_logo_url( 'dark_logo', get_template_directory_uri() . '/assets/images/tmp/' . $logo_tmp_src . 'logo_dark.svg' );

$header_inverse = get_post_meta( $page_id, 'header_inverse', false );

$header_information = (bool) consulting_theme_option( 'header_information_box', false );

$header_information_mobile = (bool) consulting_theme_option( 'mobile_header_information_box', false );

$header_hours = consulting_theme_option( 'header_working_hours', '' );

$header_address = consulting_theme_option( 'header_address', '' );

$header_phone = consulting_theme_option( 'header_phone', '' );

$header_wpml = (bool) consulting_theme_option( 'header_wpml_switcher', false );

$header_wpml_mobile = (bool) consulting_theme_option( 'header_wpml_switcher_mobile', false );

$wc_header_cart = (bool) consulting_theme_option( 'wc_cart_hide', false );

$wc_mobile_cart = (bool) consulting_theme_option( 'wc_cart_mobile_hide', false );

$header_search_box = (bool) consulting_theme_option( 'header_search_box', false );

$header_mobile_search_box = (bool) consulting_theme_option( 'mobile_header_search_box', false );

$header_mobile_socials = (bool) consulting_theme_option( 'mobile_socials_show_hide', false );
$apply_conditional_menu = get_field("apply_conditional_menu");
$is_new_site_menu = get_field("is_new_site_menu");
?>

<div class="header-box <?php echo $is_new_site_menu; ?> <?php if($is_new_site_menu == 1) { echo "newSiteSocial"; } ?>
	<?php
	if ( ! $header_wpml_mobile ) :
		?>
		hide_wpml_on_mobile
		<?php endif; ?>
		<?php if($apply_conditional_menu == 1) { echo "new_header";	} ?>
	">
	<div class="container">
		<div class="logo-box">
			<div class="logo logo-desktop test1">
				<?php if ( $dark_logo ) : ?>
					<?php if ( ! empty( $header_inverse[0] ) && $logo ) : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php echo wp_kses( consulting_get_logo_indents(), array() ); ?>>
							<img src="<?php echo esc_url( $logo ); ?>" style="width: <?php echo esc_attr( consulting_theme_option( 'logo_width' ) ); ?>px; height: auto !important;" alt="<?php bloginfo( 'name' ); ?>" />
						</a>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php echo wp_kses( consulting_get_logo_indents(), array() ); ?>>
							<img src="<?php echo esc_url( $dark_logo ); ?>" style="width: <?php echo esc_attr( consulting_theme_option( 'logo_width' ) ); ?>px; height: auto !important;" alt="<?php bloginfo( 'name' ); ?>" />
						</a>
					<?php endif; ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>
			</div>
			<div class="logo logo-mobile test2">
				<?php if ( $dark_logo ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php echo wp_kses( consulting_get_logo_indents(), array() ); ?>>
						<img src="<?php echo esc_url( $dark_logo ); ?>" style="width: <?php echo esc_attr( consulting_theme_option( 'logo_width' ) ); ?>px; height: auto !important;" alt="<?php bloginfo( 'name' ); ?>" />
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>
			</div>

			<?php //if($apply_conditional_menu != 1): ?>
			<div class="menu-toggle">
				<button>&nbsp;</button>
			</div>
			<?php //endif; ?>
		</div>

		<div class="nav-box">
			<?php

			if($apply_conditional_menu == 1):

            if( have_rows('add_menu_items') ):
			 ?>
				<ul class="googleAdsMenus">
					<?php  while( have_rows('add_menu_items') ) : the_row(); 
                     $select_page = get_sub_field('select_page');
					?>
					<li><a href="<?php echo get_the_permalink($select_page->ID); ?>"><?php echo get_the_title($select_page->ID); ?></a></li>
					<?php endwhile; ?>
				</ul>
			<?php endif;
            elseif($is_new_site_menu == 1):
            wp_nav_menu(
				array(
					'menu' => 'New site menu',
					//'theme_location' => 'consulting-primary_menu',
					'container'      => false,
					'depth'          => 4,
					'menu_class'     => 'main_menu_nav',
				)
			);
			 else:
			wp_nav_menu(
				array(
					'menu' => 'Primary Mega Menu',
					//'theme_location' => 'consulting-primary_menu',
					'container'      => false,
					'depth'          => 4,
					'menu_class'     => 'main_menu_nav',
				)
			);
			endif;
			?>
		</div>

		<?php if ( $header_information ) : ?>
			<div class="contact-info-box
			<?php
			if ( ! $header_information_mobile ) :
				?>
				hide_on_mobile
			<?php endif; ?>">
			<?php if ( $header_address ) : ?>
				<div class="contact-info">
					<div class="icon">
						<?php echo consulting_get_icon( 'header_address_icon' ); ?>
					</div>
					<div class="text">
						<?php printf( _x( '%s', 'Header address', 'consulting' ), $header_address ); ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( $header_hours ) : ?>
				<div class="contact-info">
					<div class="icon"><?php echo consulting_get_icon( 'header_working_hours_icon', 'fa-phone' ); ?></div>
					<div class="text">
						<?php printf( _x( '%s', 'Header hours', 'consulting' ), $header_hours ); ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( $header_phone ) : ?>
				<div class="contact-info">
					<div class="icon"><?php echo consulting_get_icon( 'header_phone_icon' ); ?></div>
					<div class="text">
						<?php printf( _x( '%s', 'Header phone', 'consulting' ), $header_phone ); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php
		if(($apply_conditional_menu != 1) ):
		$socials = consulting_get_socials();
		if ( consulting_theme_option( 'header_socials_box', false ) ) :
			?>
			<div class="socials-box
				<?php
				if ( ! $header_mobile_socials ) :
					?>
					hide_on_mobile
					<?php endif; ?>
				">
				<?php foreach ( $socials as $key => $val ) : ?>
					<a target="_blank" href="<?php echo esc_attr( $val ); ?>">
						<i class="fa fa-<?php echo esc_attr( $key ); ?>">&nbsp;</i>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; endif; ?>

		<?php if ( class_exists( 'WooCommerce' ) && $wc_header_cart ) : ?>
			<div class="header_cart
			<?php
			if ( ! $wc_mobile_cart ) :
				?>
				hide_on_mobile
				<?php endif; ?>
			">
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
					<i class="stm-shopping-cart8">&nbsp;</i><?php get_template_part( 'partials/mini', 'cart' ); ?></a>
			</div>
		<?php endif; ?>

		<?php if ( $header_search_box ) : ?>
			<div class="header_search header_search_in_popup
			<?php
			if ( ! $header_mobile_search_box ) :
				?>
				hide_on_mobile
				<?php endif; ?>
			">
				<i class="fa fa-search search-icon">&nbsp;</i>
				<?php get_search_form( true ); ?>
			</div>
		<?php endif; ?>

		<?php
		if ( function_exists( 'icl_object_id' ) && $header_wpml ) {
			if ( consulting_theme_option( 'header_wpml_switcher_style', false ) === 'wpml_default' ) {
				echo '<div class="lang_sel header_lang_sel">';
				do_action( 'wpml_add_language_selector' );
				echo '</div>';
			} else {
				consulting_topbar_lang();
			}
		}
		?>
	</div>
</div>