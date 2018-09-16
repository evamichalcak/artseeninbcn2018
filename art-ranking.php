<?php
/**
 * Template Name: Art Ranking
 *
 * @package ArtSeenIn2016
 * @subpackage ArtSeenIn2016
 * @since ArtSeenIn2016
 */

if ($_SERVER['QUERY_STRING'] ) {
	parse_str($_SERVER['QUERY_STRING']);
	$cookie_name = "pid";
	$cookie_value = $pid;
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}

get_header();
	echo parse_str( $_SERVER['QUERY_STRING'] );
	?>
		<section id="art-viewer">
	<div class="loading-cover"></div>

	<div class="messages">
		<div class="messages-wrapper">

	    </div>
	</div>

	
<div class="tinder-container">			
<div id="thankYouSlide" class="messages__thanks more-viewer slide-dimension show">
		<div class="thanks-container more-viewer-inner shdw-t-brown" id="ranking_container">
			<?php
				$args = array(
					'orderby' => array( 'comment_count' => 'DESC', 'title' => 'ASC' ),
					'posts_per_page' => '100',
				);
				$loop = new WP_Query( $args );
				echo '<ol>';
				while ( $loop->have_posts() ) : $loop->the_post(); 

					echo '<li><div class="content"><div class="title">';
					the_title();
					echo '</div><div class="visto">';
					$key="asiVisto"; 
					echo get_post_meta($post->ID, $key, true);
					echo '</div></li>';

				endwhile;
				echo '</ol>';
			?>
	</div>
</div>

	</section><!-- /#art-viewer -->

	<section class="project-info">
		<div class="info-col">
			<p>Una iniciativa de:</p>
			<p><a href="http://www.artssspot.com" target="_blank" class="artssspot"><img src="<?php bloginfo('template_url'); ?>/img/logo-artssspot.png" width="100" height="100" alt="" /></a><span class="spacer"></span><a href="https://www.facebook.com/opening.bcn" target="_blank" class="opening"><img src="<?php bloginfo('template_url'); ?>/img/logo-opening.png" width="70" height="70" alt="" /></a></p>
			<p class="lang-ca">Cada any es produeix una gran quantitat d'exposicions i esdeveniments d'art a Barcelona que mereixen la pena. Hem vist emergir una imatge innovadora, fresca i única de l'escena d'art a Barcelona i a través del projecte <em>Art seen in BCN 2016</em> ens agradaria acercártela de forma amigable, divertida i actual.</p>
			<p class="lang-es">Cada año se produce una gran cantidad de exposiciones y eventos de arte en Barcelona que merecen la pena. Hemos visto emerger una imagen innovadora, fresca y única de la escena de arte en Barcelona y a través del proyecto <em>Art seen in BCN 2016</em> nos gustaría acercártela de forma amigable, divertida y actual.</p>	
		</div>
		<div class="info-col">
			<p class="lang-ca"><a href="http://www.artssspot.com" target="_blank" class="artssspot">Artssspot.com</a> es la agenda de arte más completa de Barcelona. Nos entendemos como los "foodies del arte" y queremos acercarte la producción artística de la ciudad.</p>
			<p class="lang-ca">
			<a href="https://www.facebook.com/opening.bcn" target="_blank" class="opening">Opening BCN</a> divulga eventos relacionados con el mundo del arte en Barcelona, documentándolos para su consumo en las redes sociales. </p>
			<p class="lang-es"	><a href="http://www.artssspot.com" target="_blank" class="artssspot">Artssspot.com</a> es la agenda de arte más completa de Barcelona. Nos entendemos como los "foodies del arte" y queremos acercarte la producción artística de la ciudad.</p>
			<p class="lang-es">
			<a href="https://www.facebook.com/opening.bcn" target="_blank" class="opening">Opening BCN</a> divulga eventos relacionados con el mundo del arte en Barcelona, documentándolos para su consumo en las redes sociales. </p>
			<p>Colaboradores:</p>
			<p><a href="http://www.poblenouurbandistrict.com/" target="_blank" class="pud"><img src="<?php bloginfo('template_url'); ?>/img/pud-logo.png" width="60" height="55" alt="" /></a><span class="spacer"></span> <a href="http://www.younggalleryweekend.com/" target="_blank" class="ygw"><img src="<?php bloginfo('template_url'); ?>/img/ygw-logo.png" width="56" height="48" alt="" /></a><span class="spacer"></span> <a href="http://www.bcnstreetart.xyz/" target="_blank" class="streetart"><img src="<?php bloginfo('template_url'); ?>/img/streetart-logo.png" width="45" height="45" alt="" /></a></p>
		</div>
	</section><!-- /.project-info -->

	<script>
	<?php echo 'var user_viewing_data = "' . get_user_meta( get_current_user_id(), 'vvi', true) . '";'; ?>
	<?php echo 'var user_voting_data = "' . get_user_meta( get_current_user_id(), 'vvo', true) . '";'; ?>
	<?php echo 'var user_id = "' . get_current_user_id() . '";'; ?>
	</script>

	<?php
	get_footer(); ?>
			

