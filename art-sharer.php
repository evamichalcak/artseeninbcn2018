<?php
/**
 * Template Name: Art Sharer
 *
 * @package ArtSeenIn2016
 * @subpackage ArtSeenIn2016
 * @since ArtSeenIn2016
 */
 ?>
	
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,300i" rel="stylesheet">

<link rel="apple-touch-icon" sizes="57x57" href="http://www.doartystuff.com/wp-content/uploads/2015/07/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="http://www.doartystuff.com/wp-content/uploads/2015/07/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="http://www.doartystuff.com/wp-content/uploads/2015/07/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="http://www.doartystuff.com/wp-content/uploads/2015/07/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="http://www.doartystuff.com/wp-content/uploads/2015/07/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="http://www.doartystuff.com/wp-content/uploads/2015/07/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="http://www.doartystuff.com/wp-content/uploads/2015/07/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="http://www.doartystuff.com/wp-content/uploads/2015/07/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="http://www.doartystuff.com/wp-content/uploads/2015/07/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="http://www.doartystuff.com/wp-content/uploads/2015/07/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="http://www.doartystuff.com/wp-content/uploads/2015/07/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="http://www.doartystuff.com/wp-content/uploads/2015/07/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="http://www.doartystuff.com/wp-content/uploads/2015/07/favicon-16x16.png">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="http://www.doartystuff.com/wp-content/uploads/2015/07/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<meta property="og:title" content="Art seen in BCN 2016 - El millor art vist a Barcelona el 2016"/>
<meta property="og:type" content="article"/>
<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
<meta property="fb:app_id" content="328047170906455"/>

<meta name="twitter:card" content="summary" />
<meta name="twitter:url" content="<?php echo the_permalink(); ?>wp-login.php?action=register" />
<meta name="twitter:site" content="@doartystuff" />
<meta name="twitter:title" content="Art seen in BCN 2016 - El millor art vist a Barcelona el 2016" />
<meta name="twitter:description" content="Hem preseleccionat 100 obres d'art de l'any passat, ara ajuda'ns a trobar els 25 millors amb els teus vots! Però sobretot gaudeix de la millor producció artística del 2016 a Barcelona." />



<?php wp_head(); ?>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WKNVX23');</script>
<!-- End Google Tag Manager -->

</head>

<body <?php body_class(); ?>> 

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKNVX23"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'artseenin2016' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?>" class="site-logo"></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?>" class="site-logo"></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<div class="site-description hide-on-last">
					<p class="lang-ca">Vota el millor art del 2016 a Barcelona.</p>
					<p class="lang-es">Vota el mejor arte de 2016 en Barcelona.</p>
				</div>
			<?php
			endif; ?>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
	
	

	<section id="art-viewer" class="share-page">

	<div id="thankYouSlide" class="messages__thanks">
		<div class="thanks-container">
			<?php
			while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php

			if ( has_post_thumbnail() ) {
				the_post_thumbnail('full');
			} 


			echo ( '<h1 class="entry-title"><span class="lang-ca">Aquesta obra de ' . get_post_meta( get_the_ID(), 'share-author', true ) . "  està entre el millor art vist a Barcelona en l'any 2016!</span>" );
			echo ( '<span class="lang-es">Esta obra de ' . get_post_meta( get_the_ID(), 'share-author', true ) . ' está entre el mejor arte visto en Barcelona en el año 2016!</span></h1>' );

		echo ( '<div class="visto">
			<span class="lang-ca">Vist a</span> / <span class="lang-es">Visto en</span>:
			<a href="' . get_post_meta( get_the_ID(), 'share-visto-link', true ) . '" class="visto-link" target="_blank">' . get_post_meta( get_the_ID(), 'share-visto', true ) .'</a></div>');
?>
			

	</div><!-- .entry-content -->

</article><!-- #post-## -->


			<?php endwhile; // End of the loop.
			?>
		</div>
	</div>
	

	</section><!-- /#art-viewer -->
	<div class="share-info-block">
		<p class="lang-ca">Entre Artssspot.com i Opening BCN hem preseleccionat 100 obres d'art. Ajuda'ns a trobar les 25 millors amb el teu vot!</p> 
		<p class="lang-es">Entre Artssspot.com y Opening BCN hemos preseleccionado 100 obras de arte. ¡Ayúdanos a encontrar las 25 mejores con tu voto!</p> 

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>?pid=<?php echo get_post_meta( get_the_ID(), 'share-post', true ); ?>" class="share-cta orange-btn">Participa</a>


		<hr />

		<div class="share-about">
			<div class="container">
				<p>Una iniciativa de:</p> 
				<p><a href="http://www.artssspot.com" target="_blank" class="artssspot"><img src="<?php bloginfo('template_url'); ?>/img/artssspot-outline.png" width="70" height="70" alt="" /></a><span class="spacer"></span><a href="https://www.facebook.com/opening.bcn" target="_blank" class="opening"><img src="<?php bloginfo('template_url'); ?>/img/opening-outline.png" width="55" height="55" alt="" /></a></p> 
			</div>
			<div class="container">
				<p>Colaboran:</p>
				<p><a href="http://www.poblenouurbandistrict.com/" target="_blank" class="pud"><img src="<?php bloginfo('template_url'); ?>/img/pud-outline.png" width="60" height="55" alt="" /></a><span class="spacer"></span> <a href="http://www.younggalleryweekend.com/" target="_blank" class="ygw"><img src="<?php bloginfo('template_url'); ?>/img/ygw-outline.png" width="56" height="48" alt="" /></a><span class="spacer"></span> <a href="http://www.bcnstreetart.xyz/" target="_blank" class="streetart"><img src="<?php bloginfo('template_url'); ?>/img/streetart-outline.png" width="45" height="45" alt="" /></a></p>
			</div>
		</div>
	</div>

			

