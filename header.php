<?php

/**

 * The header for our theme.

 *

 * This is the template that displays all of the <head> section and everything up until <div id="content">

 *

 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials

 *

 * @package ArtSeenIn2016

 */



?><!DOCTYPE html>

<html prefix="og: http://ogp.me/ns#" <?php language_attributes(); ?>>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">

<link href="https://fonts.googleapis.com/css?family=Titan+One&text=ArtseniBCN17%27" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i" rel="stylesheet">



<link rel="apple-touch-icon" sizes="57x57" href="https://www.artssspot.com/wp-content/uploads/2017/03/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="https://www.artssspot.com/wp-content/uploads/2017/03/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="https://www.artssspot.com/wp-content/uploads/2017/03/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="https://www.artssspot.com/wp-content/uploads/2017/03/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="https://www.artssspot.com/wp-content/uploads/2017/03/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="https://www.artssspot.com/wp-content/uploads/2017/03/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="https://www.artssspot.com/wp-content/uploads/2017/03/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="https://www.artssspot.com/wp-content/uploads/2017/03/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="https://www.artssspot.com/wp-content/uploads/2017/03/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="https://www.artssspot.com/wp-content/uploads/2017/03/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="https://www.artssspot.com/wp-content/uploads/2017/03/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="https://www.artssspot.com/wp-content/uploads/2017/03/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="https://www.artssspot.com/wp-content/uploads/2017/03/favicon-16x16.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="https://www.artssspot.com/wp-content/uploads/2017/03/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">





<?php

if ($_SERVER['QUERY_STRING'] ) {

	parse_str($_SERVER['QUERY_STRING']);

	$cookie_name = "pid";

	$cookie_value = $pid;

	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

}

if ($pid) { ?>



	<meta property="og:title" content="<?php echo get_the_title( $pid ) ?> - Art seen in BCN 2017"/>

	<meta property="og:image" content="<?php echo get_the_post_thumbnail_url($pid, 'full') ?>"/>

	<meta property="og:url" content="<?php echo the_permalink() . '?pid=' . $pid; ?>"/>

	<meta name="twitter:title" content="<?php echo get_the_title( $pid ) ?> - Art seen in BCN 2017" />

	<meta name="twitter:image" content="<?php echo get_the_post_thumbnail_url($pid, 'full') ?>" />

	<meta name="twitter:url" content="<?php echo the_permalink() . '?pid=' . $pid; ?>" />



<?php } else { ?>



	<meta property="og:title" content="Art seen in BCN 2017 - El millor art vist a Barcelona el 2017"/>

	<meta property="og:image" content="<?php bloginfo('template_url'); ?>/img/fbimage.jpg"/>

	<!-- <meta property="og:image" content="<?php echo the_permalink(); ?>wp-content/uploads/2017/01/albarran-cabrera-7.jpg"/> -->

	<meta property="og:url" content="<?php echo the_permalink(); ?>"/>

	<meta name="twitter:title" content="Art seen in BCN 2017 - El millor art vist a Barcelona el 2017" />

	<meta name="twitter:image" content="<?php bloginfo('template_url'); ?>/img/twimage.jpg" />

	<!-- <meta name="twitter:image" content="<?php echo the_permalink(); ?>wp-content/uploads/2017/01/albarran-cabrera-7.jpg" /> -->

	<meta name="twitter:url" content="<?php echo the_permalink(); ?>" />



<?php } ?>



<!-- <meta property="og:description" content="Hem preseleccionat 100 obres d'art de l'any passat i el públic ha votat als seus favorits! El resultat és una imatge fresca i amb identitat pròpia de l'art a Barcelona."/> -->

<meta property="og:description" content="Hem preseleccionat 100 obres d'art de l'any passat, ara ajuda'ns a decidir els favorits amb els teus vots! Però sobretot gaudeix de la millor producció artística del 2017 a Barcelona."/>

<meta property="og:type" content="article"/>

<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>



<meta property="fb:app_id" content="328047170906455"/>

<meta name="twitter:card" content="summary" />

<meta name="twitter:site" content="@doartystuff" />

<meta name="twitter:description" content="Hem preseleccionat 100 obres d'art de l'any passat, ara ajuda'ns a decidir els favorits amb els teus vots! Però sobretot gaudeix de la millor producció artística del 2017 a Barcelona." />

<!-- <meta name="twitter:description" content="Hem preseleccionat 100 obres d'art de l'any passat i el públic ha votat als seus favorits! El resultat és una imatge fresca i amb identitat pròpia de l'art a Barcelona." /> -->









<?php wp_head(); ?>



<!-- Google Tag Manager

<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=

'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

})(window,document,'script','dataLayer','GTM-WKNVX23');</script>

 End Google Tag Manager -->



 <!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111741596-1"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());



  gtag('config', 'UA-111741596-1');

</script>





</head>



<body> 



<!-- Google Tag Manager (noscript) 

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKNVX23"

height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> End Google Tag Manager (noscript) -->



<div id="page" class="site">



	<div id="content" class="site-content">

