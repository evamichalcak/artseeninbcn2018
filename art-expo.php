<?php
/**
 * Template Name: Art Expo
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

	?>
		<section id="art-viewer">	
	
<div class="tinder-container">			
<div id="thankYouSlide" class="messages__thanks">
		<div class="thanks-container concealed" id="expo_container">
			<?php
				$args = array(
					'orderby' => array( 'meta_value_num' => 'DESC', 'title' => 'ASC' ),
					'meta_key'  => '_viewmevotescount',
				    'order' => 'DESC',
					'posts_per_page' => '25',
				);
				$loop = new WP_Query( $args );
				echo '<div class="my-slider"><ul>';
				while ( $loop->have_posts() ) : $loop->the_post(); 

					echo '<li class="slider-item"><div class="image">';
					the_post_thumbnail( 'full' );
					echo '</div><div class="label"><div class="artist">';
					echo get_post_meta( get_the_ID(), 'asiArtista', true );
					echo '</div><div class="location">';
					echo get_post_meta( get_the_ID(), 'asiVisto', true );
					echo '</div></div><div class="info">';
					echo get_post_meta( get_the_ID(), 'asiTitulo', true );
					echo '<br>';
					echo get_post_meta( get_the_ID(), 'asiArtista', true );
					echo '<br><br>';
					the_content();
					echo '</div><div class="more" onclick="jQuery(this).parent().toggleClass(' . "'view-info'" .')"></div></li>';

				endwhile;
				echo '</ul></div>';
			?>
	</div>
</div>

	</section><!-- /#art-viewer -->

	<section class="project-info">
		<div class="info-col">
			<a href="/ranking-art-seen-in-bcn-2016">Veure rànquing complet de les 100 obres participants</a><br>	
			<em><a href="/ranking-art-seen-in-bcn-2016">Ver ranking completo de las 100 obras participantes</a></em><br><br>
			<p class="lang-ca">Cada any es produeix una gran quantitat d'exposicions i esdeveniments d'art a Barcelona que mereixen la pena. Hem vist emergir una imatge innovadora, fresca i única de l'escena d'art a Barcelona i a través del projecte <em>Art seen in BCN 2016</em> ens agradaria acercártela de forma amigable, divertida i actual.</p>
			<p class="lang-es">Cada año se produce una gran cantidad de exposiciones y eventos de arte en Barcelona que merecen la pena. Hemos visto emerger una imagen innovadora, fresca y única de la escena de arte en Barcelona y a través del proyecto <em>Art seen in BCN 2016</em> nos gustaría acercártela de forma amigable, divertida y actual.</p>	
			<p>Una iniciativa de:</p>
			<p><a href="http://www.artssspot.com" target="_blank" class="artssspot"><img src="<?php bloginfo('template_url'); ?>/img/logo-artssspot.png" width="100" height="100" alt="" /></a><span class="spacer"></span><a href="https://www.facebook.com/opening.bcn" target="_blank" class="opening"><img src="<?php bloginfo('template_url'); ?>/img/logo-opening.png" width="70" height="70" alt="" /></a></p>
		</div>
		<div class="info-col">
			<p>Colaboradores:</p>
			<p><a href="http://www.poblenouurbandistrict.com/" target="_blank" class="pud"><img src="<?php bloginfo('template_url'); ?>/img/pud-logo.png" width="60" height="55" alt="" /></a><span class="spacer"></span> <a href="http://www.younggalleryweekend.com/" target="_blank" class="ygw"><img src="<?php bloginfo('template_url'); ?>/img/ygw-logo.png" width="56" height="48" alt="" /></a><span class="spacer"></span> <a href="http://www.bcnstreetart.xyz/" target="_blank" class="streetart"><img src="<?php bloginfo('template_url'); ?>/img/streetart-logo.png" width="45" height="45" alt="" /></a></p>
		</div>
	</section><!-- /.project-info -->

	<script>
	<?php echo 'var user_viewing_data = "' . get_user_meta( get_current_user_id(), 'vvi', true) . '";'; ?>
	<?php echo 'var user_voting_data = "' . get_user_meta( get_current_user_id(), 'vvo', true) . '";'; ?>
	<?php echo 'var user_id = "' . get_current_user_id() . '";'; ?>

	jQuery(document).ready(function($) {
		$('.my-slider').unslider();
		$('#expo_container').removeClass('concealed');

	})

	</script>
	<?php
	get_footer(); ?>
			

