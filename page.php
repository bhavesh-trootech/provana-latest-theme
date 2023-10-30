<?php consulting_get_header(); ?>

	<div class="content-area">

		<?php
			while ( have_posts() ) {
				the_post();

				get_template_part( 'partials/content', 'page' );

			}
		?>

	</div>

<?php 
$is_new_site_menu = get_field("is_new_site_menu");
if($is_new_site_menu == 1):
get_footer( 'new-site' ); 
else:
get_footer(); 
endif;
?>