<?php

/**

 * Template Name: Art Viewer New

 *

 * @package ArtSeenIn2016

 * @subpackage ArtSeenIn2016

 * @since ArtSeenIn2016

 */



function get_ip() {

	if ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {

		//check ip from share internet

		$ip = $_SERVER['HTTP_CLIENT_IP'];

	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {

		//to check ip is pass from proxy

		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

	} else {

		$ip = $_SERVER['REMOTE_ADDR'];

	}



	return $ip;

}



$previewPrensa = isset($_GET["premsa"]);



function check_ip() {

	$ip        = get_ip();

	$voted_ips = get_option( 'asib_voted_ips', array() );

	$has_voted = $voted_ips[$ip];



	// If their IP is in the array of voted IPs, they've voted.

	if ( $has_voted > 0 ) {

		if ( $voted_ips[$ip] <= 5 ) {

			$voted_ips[$ip]++;

			update_option( 'asib_voted_ips', $voted_ips );

			return true;

		} else {

			return false;

			//return true;

		}

	} else {

		$voted_ips[$ip] = 1;

		update_option( 'asib_voted_ips', $voted_ips );

		return true;

	}

}



$voteOpen = (date('M Y') == "Jan 2018");
#echo '<!-- xxxx,,, ' . date('j M Y H i s') . ' -->';


$voteOK = is_user_logged_in() || isset($_COOKIE['uviews']) || check_ip();







get_header(); ?>



<style>

.intro-container {

    position: absolute;

    width: 100%;

    height: 100%;

    /*height: 100%;*/

    top: 0;

    background-color: #b0a9a2;

    z-index: 10000;

    text-align: center;

    display: flex;

    justify-content: center;

}

.intro-container .intro-wrapper {

  align-self: center;

  width: 80%;

  font-size: 22px;

}

.intro-container .intro-wrapper p {

  margin: .2em auto;

  max-width: 750px;

}

@media (min-width: 481px) and (min-height: 481px) {

  .intro-container .intro-wrapper {

    font-size: 32px;

  }

}

.intro-logo {

  margin-top: -55px;

}

.logoin .intro-logo > span { 

    opacity: 0;

}

.intro-logo .word-art {

  opacity: 1;

  transition: opacity .3s ease-in .4s;

}

.intro-logo .word-seen {

  opacity: 1;

  transition: opacity .1s ease-in .5s;

}

.intro-logo .word-in {

  opacity: 1;

  transition: opacity .1s ease-in .6s;

}

.intro-logo .word-bcn {

  opacity: 1;

  transition: opacity .2s ease-in .7s;

}

.intro-logo > span { 

    -webkit-backface-visibility: hidden;

}

.logoout .intro-logo .word-art {

  opacity: 0;

  transition: opacity .2s ease-in;

}

.logoout .intro-logo .word-seen {

  opacity: 0;

  transition: opacity .2s ease-in .1s;

}

.logoout .intro-logo .word-in {

  opacity: 0;

  transition: opacity .2s ease-in .2s;

}

.logoout .intro-logo .word-bcn {

  opacity: 0;

  transition: opacity .2s ease-in .3s;

}

.backgroundclip {

  background-image: url('<?php echo get_bloginfo('template_url') ?>/img/eye-red-2.gif');

  background-size: cover;

  color: transparent;

  display: inline-block;

  -webkit-background-clip: text;

  font-family: 'Titan One', sans-serif;

  font-weight: 900;

  font-size: 300%;

  line-height: 1;

  margin: 0 .2em;

  -webkit-text-fill-color: transparent;

  position: relative;

}

.backgroundclip.size {  

  background-position: bottom left;

}

@media (min-width: 370px) and (min-height: 370px) {

  .backgroundclip {

  font-size: 320%;

  }

}

@media (min-width: 520px) and (min-height: 520px) {

  .backgroundclip {

  font-size: 350%;

  }

}

@media (min-width: 895px) and (min-height: 320px) {

  .backgroundclip {

  font-size: 400%;

  }

}

@media (min-width: 768px) and (min-height: 768px) {

  .backgroundclip {

  font-size: 500%;

  }

}

@media (min-width: 1100px) and (min-height: 320px) {

  .backgroundclip {

  font-size: 500%;

  }

}

.textshadow:before {

  -webkit-backface-visibility: hidden; /* Chrome, Safari, Opera */

  backface-visibility: hidden;

  position: absolute;

  top: 0;

  background-image: none;

  background-color: transparent;

  -webkit-text-fill-color: #270907;

  background: none;

  color: #270907;

  -webkit-background-clip: none;

  content: attr(data-text);

  text-shadow: .01em .12em .2em #333;

  z-index: -1;

}

.intro-text {

  color: #b0a9a2;

  text-shadow: none;

  margin: 0 auto;

  visibility: hidden;

  position: absolute;

  left: 0;

  right: 0;

  top: 0;

  height: 100%;

  width: 100%;

  display: flex;

  flex-direction: column;

  justify-content: center;

  align-items: center;

  z-index: 0;

}

.intro-text small a {

  color: #b0a9a2;

  text-decoration: none;

}

.intro-text small {

  font-size: 70%;

  max-width: 600px;	

  width: 80%;

}

.logoout .intro-text {

  visibility: visible;

  color: #fff;

  text-shadow: 4px 4px 8px #333;

  transition: color .5s ease-in .6s, text-shadow .5s ease-in .6s, z-index 1s linear 1s;

  z-index: 1;

}

.logoout .intro-text small a {

  color: #fff;

  transition: color .5s ease-in .6s;

}

.lang-buttons {

  display: flex;

  justify-content: center;

  opacity: 0;

}

.logoout .lang-buttons {

  opacity: 1;

  transition: opacity .5s ease-in .6s;

}

.intro-text .nav-btn > i {

    margin: -2px 0 0 3px;

    display: inline-block;

}

.intro-text .nav-btn {

  margin-top: 1em;

  opacity: 0;

}

.logoout .intro-text .nav-btn {

  opacity: 1;

  transition: opacity .5s ease-in .6s;

}



@keyframes blink {

    from {opacity: 0;}

    to {opacity: 1;}

}

.loading-blink {

	animation: blink .5s alternate infinite;

}



</style>









	<section id="art-viewer">

		<div class="tinder-container">



		    <div class="more-viewer slide-dimension">

		    	<div class="more-viewer-inner shdw-t-brown"></div>

		    </div>

		

			<div id="tinderslide">

			    <ul id="tinderslideList" class="slide-dimension">

			        <li id="loaderSlide" class="slide-dimension info-slide"><div class="loading shdw-t-brown"><span class="loading-blink">Loading...</span><div class="loader"><span id="loader-percentage">0</span>%</div></div></li>

			    </ul>

			</div><!-- /#tinderslide -->



			<div class="actions-container slide-dimension">

				<div class="actions">

			        <a href="#" class="dislike dislike-action">

			        	<i class="icon-x shdw-b-brown"></i>

			        	<i class="icon-arrow-left shdw-b-brown"></i>

			        </a>

			        <a href="#" class="like like-action">

			        	<i class="icon-heart-shape-outline shdw-b-brown"></i>

			        	<i class="icon-arrow-right shdw-b-brown"></i>

			        </a>

			    </div><!-- /.actions -->

		    </div><!-- /.actions-container -->



	    </div><!-- /.tinder-container -->

	    <div id="howToIntro" class="intro-container logoin"><div class="intro-wrapper">



<?php if ( $voteOpen ) { ?>

	<?php if ( $voteOK ) { ?>

		<div class="intro-text">

			<div class="lang-buttons">

				<a href="#!" class="demo-pill ctrl-btn es-ca">Català</a>

				<a href="#!" class="demo-pill ctrl-btn es-es">Castellano</a>

				<a href="#!" class="demo-pill ctrl-btn en-en">English</a>

			</div>



			<!-- <p style="text-transform: uppercase; margin-bottom: 20px;">

				<span class="lang-ca">Ull, no comparteixis aquest enllaç amb tercers!</span>

				<span class="lang-es">¡Ojo, no compartas este enlace con terceros!</span>

				<span class="lang-en">Attention, do not share this link with third parties!</span>

			</p>

			<p>

				<span class="lang-ca">Si us plau, revisa que estigui bé i sense errors d'ortografia la informació visible a la pantalla i que hàgim inclòs tota la informació addicional (crèdits, enllaços, etc.) en la info que apareix fent clic al "+". També revisa la versió en castellá e anglesa, si us plau.</span>

				<span class="lang-es">Por favor, revisa que esté bien y sin errores de ortografía la información visible en la pantalla y que hayamos incluido toda la información adicional (créditos, enlaces, etc.) en la info que aparece haciendo clic en el "+". También, revisá la versión catalana e inglesa, por favor.</span>

				<span class="lang-en">Please check that the information visible on the screen is correct and without errors of spelling and that we have included all additional information (credits, links, etc.) in the slide that appears by clicking on the "+". Please, do also check the catalan and the spanish version.</span>

			</p> -->



			<p><span class="lang-ca">Entre Artssspot i Opening BCN hem seleccionat 100 de les millors obres d'art que hem vist aquest any, ara et toca a tu: </span><span class="lang-es">Entre Artssspot y Opening BCN hemos seleccionado 100 de las

			mejores obras de arte que hemos visto este año, ahora te toca a tí: </span><span class="lang-en">Between Artssspot and Opening BCN we have selected 100 of the

			best works of art that we have seen this year, now it's up to you:</span></p>

			<p><span class="lang-ca">Repassa la selecció, vota els teus favorits, però sobretot, descobreix el millor art de Barcelona de 2017.</span><span class="lang-es">Repasa la selección, vota tus favoritos, pero sobre todo, descubre el mejor arte de Barcelona de 2017.</span><span class="lang-en">Review the selection, vote your favorites, but above all, discover the best art of Barcelona in 2017.</span></p>



			<a href="#!" class="nav-btn vote-start"><i class="icon-arrow-right shdw-b-brown"></i></a>

		



		</div>

	<?php } else { ?>

		<div class="login-modal-wrapper">

			<div class="login-modal">

				<span class="demo-pill">

					<span class="lang-ca">Ja hem rebut una votació des de aquesta connexió. Per poder guardar la teva, necessitem que te registres.</span>

					<span class="lang-es">Ya hemos recibido una votacion desde tu conexión. Para poder guardar la tuya, necesitamos que te registres.</span>

					<span class="lang-en">We have already received a vote from your connection. In order to save yours, we need you to register.</span>

				</span>

				<span class="lang-ca">Entra amb una xarxa social:</span>

				<span class="lang-es">Entra con una red social:</span>

				<span class="lang-en">Sign in with a social network:</span>

				<?php echo do_shortcode('[apsl-login-lite]'); ?>

				<span class="lang-ca">O amb el teu mail:</span>

				<span class="lang-es">O con tu mail:</span>

				<span class="lang-en">Or with your mail:</span>

				<div class="login-form">

					<span class="register-btn btn form-active" onclick="jQuery('.form-active').removeClass('form-active');jQuery(this).addClass('form-active');jQuery('.lwa-register').addClass('form-active');">

						<span class="lang-ca">Registre</span>

						<span class="lang-es">Registro</span>

						<span class="lang-en">Register</span>

					</span>

					<span class="login-btn btn" onclick="jQuery('.form-active').removeClass('form-active');jQuery(this).addClass('form-active');jQuery('.lwa-form').addClass('form-active');">Login</span>

					<?php echo do_shortcode('[login-with-ajax template="modal-register" registration="1"]'); ?>

				</div>

			</div>

	<?php } ?>

<?php } else if ($previewPrensa) { ?>

	<?php if ( $voteOK ) { ?>

		<div class="intro-text">

			<div class="lang-buttons">

				<a href="#!" class="demo-pill ctrl-btn es-ca">Català</a>

				<a href="#!" class="demo-pill ctrl-btn es-es">Castellano</a>

				<a href="#!" class="demo-pill ctrl-btn en-en">English</a>

			</div>



			<p><span class="lang-ca">Entre Artssspot i Opening BCN hem seleccionat 100 de les millors obres d'art que hem vist aquest any, ara et toca a tu: </span><span class="lang-es">Entre Artssspot y Opening BCN hemos seleccionado 100 de las

			mejores obras de arte que hemos visto este año, ahora te toca a tí: </span><span class="lang-en">Between Artssspot and Opening BCN we have selected 100 of the

			best works of art that we have seen this year, now it's up to you:</span></p>

			<p><span class="lang-ca">Repassa la selecció, vota els teus favorits, però sobretot, descobreix el millor art de Barcelona de 2017.</span><span class="lang-es">Repasa la selección, vota tus favoritos, pero sobre todo, descubre el mejor arte de Barcelona de 2017.</span><span class="lang-en">Review the selection, vote your favorites, but above all, discover the best art of Barcelona in 2017.</span></p>

			<p>

				<small>

					<span class="lang-ca">Els teus vots no es comptabilitzaran en el accès previ. Per poder votar hauràs de desloguearte <a href="http://asib.theme/wp-login.php/?action=logout" target="_blank">http://asib.theme/wp-login.php/?action=logout</a> i accedir a través de <a href = "http://asib.theme/" target = "_blank"> http://asib.theme/ </a></span>

					<span class="lang-es">Tus votos no se contabilizarán en el aceso previo. Para poder votar tendrás que desloguearte <a href="http://asib.theme/wp-login.php/?action=logout" target="_blank">http://asib.theme/wp-login.php/?action=logout</a> y acceder a través de <a href="http://asib.theme/" target="_blank">http://asib.theme/</a></span>

					<span class="lang-en">Your votes will not be counted in the previous access. To be able to vote you will have to logout <a href="http://asib.theme/wp-login.php/?action=logout" target="_blank">http://asib.theme/wp-login.php/?action=logout</a> and access through <a href = "http://asib.theme/" target = "_blank"> http://asib.theme/ </a></span>

				</small>

			</p>



			<a href="#!" class="nav-btn vote-start"><i class="icon-arrow-right shdw-b-brown"></i></a>

		</div>

	<?php } else { ?>

		<div class="login-modal-wrapper">

			<div class="login-modal">

				<p class="shdw-t-grey">

					<span class="lang-ca">Entra les teves dades d'usuari per a l'accés previ. Els teus vots no es comptabilitzaran.</span>

					<span class="lang-es">Entra tus datos de usuario para el acceso previo. Tus votos no se contabilizarán.</span>

					<span class="lang-en">Enter your user data for early access. Your votes will not be counted.</span>

				</p>

				<div class="login-form">

					<?php echo do_shortcode('[login-with-ajax template="modal-register-press" registration="0" remember="0"]'); ?>

				</div>

			</div>

	<?php } ?>

<?php } else if (date('Y') == "2018") { ?>

	<div class="intro-text">

			<div class="lang-buttons">

				<a href="#!" class="demo-pill ctrl-btn es-ca">Català</a>

				<a href="#!" class="demo-pill ctrl-btn es-es">Castellano</a>

				<a href="#!" class="demo-pill ctrl-btn en-en">English</a>

			</div>



			<p><span class="lang-ca">Entre Artssspot i Opening BCN hem seleccionat 100 de les millors obres d'art que hem vist durant l'any 2017 a Barcelona i el públic ha votat els seus 25 favorits.</span><span class="lang-es">Entre Artssspot y Opening BCN hemos seleccionado 100 de las mejores obras de arte que hemos visto durante el año 2017 en Barcelona y el público ha votado sus 25 favoritos.</span><span class="lang-en">Between Artssspot and Opening BCN we have selected 100 of the best works of art we have seen during the year 2017 in Barcelona and the public has voted their 25 favorites.</span></p>


				<small>

					<span class="lang-ca">Pots consultar el rànquing complet aquí <a href="http://asib.theme/ranking" target="_blank">http://asib.theme/ranking</a></span>

					<span class="lang-es">Puedes consultar el ranking completo aquí<a href="http://asib.theme/ranking" target="_blank">http://asib.theme/ranking</a></span>

					<span class="lang-en">You can check the full ranking here <a href="http://asib.theme/ranking" target="_blank"> http://asib.theme/ranking </a></span>

				</small>

			</p>



			<a href="#!" class="nav-btn vote-start"><i class="icon-arrow-right shdw-b-brown"></i></a>

		</div>

<?php } else { ?>

	<div class="intro-text">

		<div class="lang-buttons">

			<a href="#!" class="demo-pill ctrl-btn es-ca">Català</a>

			<a href="#!" class="demo-pill ctrl-btn es-es">Castellano</a>

			<a href="#!" class="demo-pill ctrl-btn en-en">English</a>

		</div>





		<p><span class="lang-ca">Vota el millor art de 2017. <br />A partir l'1 de gener de 2018.</span><span class="lang-es">Vota el mejor arte de 2017. <br />A partir del 1 de enero de 2018.</span><span class="lang-en">Vote for the best art of 2017. <br />Start on January 1, 2018.</span></p>



		<p><small><span class="lang-ca">Una iniciativa de:</span><span class="lang-es">Una iniciativa de:</span><span class="lang-en">An initiative by:</span> <span><a href="http://www.artssspot.com" target="_blank" class="artssspot">Artssspot.com</a>, <a href="https://www.facebook.com/opening.bcn" target="_blank" class="opening">Opening BCN</a></span></small></p>

		<small><span class="lang-ca">Col·laboren:</span><span class="lang-es">Colaboran:</span><span class="lang-en">Collaborating:</span> <span><a href="http://www.poblenouurbandistrict.com/" target="_blank">Poblenou Urban District</a>, <a href="http://www.younggalleryweekend.com/" target="_blank">Young Gallery Weekend</a>, <a href="http://www.galeriescatalunya.com/" target="_blank">Gremi de Galeries d'Art de Catalunya</a>, <a href="http://www.lhdistrictecultural.cat/" target="_blank">L'Hospitalet Districte Cultural</a>, <a href="http://www.bcnstreetart.xyz/" target="_blank">BCN Street Art</a></span></small></p>

	</div>

<?php } ?>



<div class="intro-logo">

	<span data-text="Art" class="backgroundclip textshadow word-art">Art </span> 

	<span data-text="seen" class="backgroundclip textshadow size word-seen">seen </span> 

	<span data-text="in" class="backgroundclip textshadow word-in">in </span> 

	<span data-text="BCN&nbsp;'17" class="backgroundclip textshadow word-bcn">BCN&nbsp;'17</span>

</div>







</div></div>



	</section><!-- /#art-viewer -->







<script>

	var introel = document.getElementById('howToIntro');

	//document.fonts.onloadingdone = 

	introel.classList.remove('logoin');

	var tt = setTimeout(function(){

		introel.classList.add('logoout');

	}, 7500);



	jQuery('.vote-start').on('click tap', function() {

		jQuery('#howToIntro').fadeOut();

		if (proceed) {

			jQuery(document).trigger('asi.proceed');

		} else {

			proceed = true;

		}

	});

</script>	   





	<script>

	<?php 

	//$userviews = get_user_meta( get_current_user_id(), 'vvi', true);

	//$tempArray = explode(", ", $userviews);

	//if ( sizeof($tempArray) >= 100 ) {

	//	$userviews = done;

	//}

		echo 'var user_viewing_data = "' . get_user_meta( get_current_user_id(), 'vvi', true) . '";'; 

	?>

	<?php echo 'var user_voting_data = "' . get_user_meta( get_current_user_id(), 'vvo', true) . '";'; ?>

	<?php echo 'var user_id = "' . get_current_user_id() . '";'; ?>

	<?php echo 'var voteOK = "' . $voteOK . '";'; ?>

	<?php echo 'var voteOpen = "' . $voteOpen . '";'; ?>

	<?php echo 'var previewPrensa = "' . $previewPrensa . '";'; ?>

	var proceed = false;



	<?php 

	// echo "var json=". json_encode(get_posts(array(

 //        'orderby'   => 'meta_value',

	// 	'meta_key'  => '_viewmecount',

	// 	'order'		=> 'DESC',

 //    )));

	?>



	</script>



	<?php

	get_footer(); ?>

	<!-- <p id="testtemp" style="position: absolute; top: 0; left: 0; z-index: 10000; width:100%; height:100%; background-color: rgba(0,0,0,.2); margin:0;"></p> -->

			



