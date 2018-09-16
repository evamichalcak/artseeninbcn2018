
<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php 
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?>" class="site-logo"></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?>" class="site-logo"></a></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->
