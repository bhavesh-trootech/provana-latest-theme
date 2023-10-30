<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <?php do_action( 'consulting_head_start' ); ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
    <?php do_action( 'consulting_head_end' ); ?>


    <!-- Google Tag Manager -->

    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=

    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

    })(window,document,'script','dataLayer','GTM-PGN65FC');</script>

    <!-- End Google Tag Manager -->
    <style>
       body.safari header#header .logo img{height: auto !important;}
       input#email-e9d74017-00c7-4b82-819d-b5e61d7ae966 {width: 100% !important; background: #fff !important; padding: 10px 57px 10px 17px !important; height: 38px !important;}
       #hsForm_e9d74017-00c7-4b82-819d-b5e61d7ae966 .hs-button.primary.large {position: absolute; right: 0;top: 0; border: none; width: 40px;
    height: 38px; line-height: 40px;padding: 0; cursor: pointer; text-align: center; font-size: 11px !important; color: #2D4EA2; outline: 0!important;
    transition: color .3s ease; background: #04A54B;}
           </style>

     <?php if(is_page(7429)): ?>
        <script>
            jQuery(document).ready(function(){
            setTimeout(function () {
               jQuery('#hiddedivafters').hide();
            }, 50);
        });
        </script>
     <?php endif; ?>
</head>
<body <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PGN65FC" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php
    wp_body_open();
    get_template_part('partials/headers/main');
    do_action( 'consulting_header_end' );