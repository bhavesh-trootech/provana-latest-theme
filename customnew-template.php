<?php 
/* Template Name: Automated Compliance Management For Collections */

get_header('new'); 
?>

<div class="content-area">

<?php
while ( have_posts() ) {
    the_post();

    get_template_part( 'partials/content' );

}
?>

</div>  
<?php get_footer();