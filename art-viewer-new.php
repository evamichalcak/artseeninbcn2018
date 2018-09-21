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

body {
	background: #eee url('<?php echo get_bloginfo('template_url') ?>/img/explosion-grey.gif') center bottom;
  background-size: cover;
}

.intro-container {

    position: absolute;

    width: 100%;

    height: 100%;

    /*height: 100%;*/

    top: 0;

    background: #eee url('<?php echo get_bloginfo('template_url') ?>/img/explosion-grey.gif') center bottom;
    background-size: cover;

    z-index: 10000;

    text-align: right;

}

@media (min-width: 768px) {
  .intro-container {
    display: flex;
    justify-content: center;

  }
}

.intro-container .intro-wrapper {

  align-self: flex-start;

  width: 100%;

  font-size: 22px;

}

.intro-container .intro-wrapper p {

  margin: .2em auto;

  max-width: 750px;

}

@media (min-width: 481px) and (min-height: 481px) {

  .intro-container .intro-wrapper {

    font-size: 28px;

  }

}


@media (min-width: 1025px) and (min-height: 580px) {

  .intro-container .intro-wrapper {

    font-size: 32px;

  }

}

/*
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

  -webkit-backface-visibility: hidden; 

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

}*/



/*------INTRO START-----*/

.intro-logo {
  height: 100%;
  width: 100%;
  margin: 0;
  display: flex;
  align-content: center;
  justify-content: flex-start;
}
.logoout .intro-logo {
  flex: 1 1 50%;
}

@media (min-width: 768px) {
  .intro-logo {
    height: 50vh;
    width: 50vw;
  }
}

blockquote {
  font: italic 300 55px/1 Montserrat Light, sans-serif;
  color: #fff;
  margin: auto;
  text-shadow: 0 0 #000, -1px 0.5px black, -2px 1px black, -3px 1.5px black, -4px 2px black, -5px 2.5px black, -6px 3px black, -7px 3.5px black, -8px 4px black, -9px 4.5px black, -10px 5px black, -11px 5.5px black, -12px 6px black, -13px 6.5px black, -14px 7px black, -15px 7.5px black, -16px 8px black, -17px 8.5px black, -18px 9px black, -19px 9.5px black, -20px 10px black, -21px 10.5px black, -22px 11px black, -23px 11.5px black, -24px 12px black, -25px 12.5px black, -26px 13px black, -27px 13.5px black, -28px 14px black, -29px 14.5px black, -30px 15px black, -31px 15.5px black, -32px 16px black, -33px 16.5px black, -34px 17px black, -35px 17.5px black, -36px 18px black, -37px 18.5px black, -38px 19px black, -39px 19.5px black, -40px 20px black, -41px 20.5px black, -42px 21px black, -43px 21.5px black, -44px 22px black, -45px 22.5px black, -46px 23px black, -47px 23.5px black, -48px 24px black, -49px 24.5px black, -50px 25px black, -51px 25.5px black, -52px 26px black, -53px 26.5px black, -54px 27px black, -55px 27.5px black, -56px 28px black, -57px 28.5px black, -58px 29px black, -59px 29.5px black, -60px 30px black, -61px 30.5px black, -62px 31px black, -63px 31.5px black, -64px 32px black, -65px 32.5px black, -66px 33px black, -67px 33.5px black, -68px 34px black, -69px 34.5px black, -70px 35px black, -71px 35.5px black, -72px 36px black, -73px 36.5px black, -74px 37px black, -75px 37.5px black, -76px 38px black, -77px 38.5px black, -78px 39px black, -79px 39.5px black, -80px 40px black, -81px 40.5px black, -82px 41px black, -83px 41.5px black, -84px 42px black, -85px 42.5px black, -86px 43px black, -87px 43.5px black, -88px 44px black, -89px 44.5px black, -90px 45px black, -91px 45.5px black, -92px 46px black, -93px 46.5px black, -94px 47px black, -95px 47.5px black, -96px 48px black, -97px 48.5px black, -98px 49px black, -99px 49.5px black, -100px 50px black, -101px 50.5px black, -102px 51px black, -103px 51.5px black, -104px 52px black, -105px 52.5px black, -106px 53px black, -107px 53.5px black, -108px 54px black, -109px 54.5px black, -110px 55px black, -111px 55.5px black, -112px 56px black, -113px 56.5px black, -114px 57px black, -115px 57.5px black, -116px 58px black, -117px 58.5px black, -118px 59px black, -119px 59.5px black, -120px 60px black, -121px 60.5px black, -122px 61px black, -123px 61.5px black, -124px 62px black, -125px 62.5px black, -126px 63px black, -127px 63.5px black, -128px 64px black, -129px 64.5px black, -130px 65px black, -131px 65.5px black, -132px 66px black, -133px 66.5px black, -134px 67px black, -135px 67.5px black, -136px 68px black, -137px 68.5px black, -138px 69px black, -139px 69.5px black, -140px 70px black, -141px 70.5px black, -142px 71px black, -143px 71.5px black, -144px 72px black, -145px 72.5px black, -146px 73px black, -147px 73.5px black, -148px 74px black, -149px 74.5px black, -150px 75px black, -151px 75.5px black, -152px 76px black, -153px 76.5px black, -154px 77px black, -155px 77.5px black, -156px 78px black, -157px 78.5px black, -158px 79px black, -159px 79.5px black, -160px 80px black, -161px 80.5px black, -162px 81px black, -163px 81.5px black, -164px 82px black, -165px 82.5px black, -166px 83px black, -167px 83.5px black, -168px 84px black, -169px 84.5px black, -170px 85px black, -171px 85.5px black, -172px 86px black, -173px 86.5px black, -174px 87px black, -175px 87.5px black, -176px 88px black, -177px 88.5px black, -178px 89px black, -179px 89.5px black, -180px 90px black, -181px 90.5px black, -182px 91px black, -183px 91.5px black, -184px 92px black, -185px 92.5px black, -186px 93px black, -187px 93.5px black, -188px 94px black, -189px 94.5px black, -190px 95px black, -191px 95.5px black, -192px 96px black, -193px 96.5px black, -194px 97px black, -195px 97.5px black, -196px 98px black, -197px 98.5px black, -198px 99px black, -199px 99.5px black, -200px 100px black, -201px 100.5px black, -202px 101px black, -203px 101.5px black, -204px 102px black, -205px 102.5px black, -206px 103px black, -207px 103.5px black, -208px 104px black, -209px 104.5px black, -210px 105px black, -211px 105.5px black, -212px 106px black, -213px 106.5px black, -214px 107px black, -215px 107.5px black, -216px 108px black, -217px 108.5px black, -218px 109px black, -219px 109.5px black, -220px 110px black, -221px 110.5px black, -222px 111px black, -223px 111.5px black, -224px 112px black, -225px 112.5px black, -226px 113px black, -227px 113.5px black, -228px 114px black, -229px 114.5px black, -230px 115px black, -231px 115.5px black, -232px 116px black, -233px 116.5px black, -234px 117px black, -235px 117.5px black, -236px 118px black, -237px 118.5px black, -238px 119px black, -239px 119.5px black, -240px 120px black, -241px 120.5px black, -242px 121px black, -243px 121.5px black, -244px 122px black, -245px 122.5px black, -246px 123px black, -247px 123.5px black, -248px 124px black, -249px 124.5px black, -250px 125px black, -251px 125.5px black, -252px 126px black, -253px 126.5px black, -254px 127px black, -255px 127.5px black, -256px 128px black, -257px 128.5px black, -258px 129px black, -259px 129.5px black, -260px 130px black, -261px 130.5px black, -262px 131px black, -263px 131.5px black, -264px 132px black, -265px 132.5px black, -266px 133px black, -267px 133.5px black, -268px 134px black, -269px 134.5px black, -270px 135px black, -271px 135.5px black, -272px 136px black, -273px 136.5px black, -274px 137px black, -275px 137.5px black, -276px 138px black, -277px 138.5px black, -278px 139px black, -279px 139.5px black, -280px 140px black, -281px 140.5px black, -282px 141px black, -283px 141.5px black, -284px 142px black, -285px 142.5px black, -286px 143px black, -287px 143.5px black, -288px 144px black, -289px 144.5px black, -290px 145px black, -291px 145.5px black, -292px 146px black, -293px 146.5px black, -294px 147px black, -295px 147.5px black, -296px 148px black, -297px 148.5px black, -298px 149px black, -299px 149.5px black, -300px 150px black, -301px 150.5px black, -302px 151px black, -303px 151.5px black, -304px 152px black, -305px 152.5px black, -306px 153px black, -307px 153.5px black, -308px 154px black, -309px 154.5px black, -310px 155px black, -311px 155.5px black, -312px 156px black, -313px 156.5px black, -314px 157px black, -315px 157.5px black, -316px 158px black, -317px 158.5px black, -318px 159px black, -319px 159.5px black, -320px 160px black, -321px 160.5px black, -322px 161px black, -323px 161.5px black, -324px 162px black, -325px 162.5px black, -326px 163px black, -327px 163.5px black, -328px 164px black, -329px 164.5px black, -330px 165px black, -331px 165.5px black, -332px 166px black, -333px 166.5px black, -334px 167px black, -335px 167.5px black, -336px 168px black, -337px 168.5px black, -338px 169px black, -339px 169.5px black, -340px 170px black, -341px 170.5px black, -342px 171px black, -343px 171.5px black, -344px 172px black, -345px 172.5px black, -346px 173px black, -347px 173.5px black, -348px 174px black, -349px 174.5px black, -350px 175px black, -351px 175.5px black, -352px 176px black, -353px 176.5px black, -354px 177px black, -355px 177.5px black, -356px 178px black, -357px 178.5px black, -358px 179px black, -359px 179.5px black, -360px 180px black, -361px 180.5px black, -362px 181px black, -363px 181.5px black, -364px 182px black, -365px 182.5px black, -366px 183px black, -367px 183.5px black, -368px 184px black, -369px 184.5px black, -370px 185px black, -371px 185.5px black, -372px 186px black, -373px 186.5px black, -374px 187px black, -375px 187.5px black, -376px 188px black, -377px 188.5px black, -378px 189px black, -379px 189.5px black, -380px 190px black, -381px 190.5px black, -382px 191px black, -383px 191.5px black, -384px 192px black, -385px 192.5px black, -386px 193px black, -387px 193.5px black, -388px 194px black, -389px 194.5px black, -390px 195px black, -391px 195.5px black, -392px 196px black, -393px 196.5px black, -394px 197px black, -395px 197.5px black, -396px 198px black, -397px 198.5px black, -398px 199px black, -399px 199.5px black, -400px 200px black, -401px 200.5px black, -402px 201px black, -403px 201.5px black, -404px 202px black, -405px 202.5px black, -406px 203px black, -407px 203.5px black, -408px 204px black, -409px 204.5px black, -410px 205px black, -411px 205.5px black, -412px 206px black, -413px 206.5px black, -414px 207px black, -415px 207.5px black, -416px 208px black, -417px 208.5px black, -418px 209px black, -419px 209.5px black, -420px 210px black, -421px 210.5px black, -422px 211px black, -423px 211.5px black, -424px 212px black, -425px 212.5px black, -426px 213px black, -427px 213.5px black, -428px 214px black, -429px 214.5px black, -430px 215px black, -431px 215.5px black, -432px 216px black, -433px 216.5px black, -434px 217px black, -435px 217.5px black, -436px 218px black, -437px 218.5px black, -438px 219px black, -439px 219.5px black, -440px 220px black, -441px 220.5px black, -442px 221px black, -443px 221.5px black, -444px 222px black, -445px 222.5px black, -446px 223px black, -447px 223.5px black, -448px 224px black, -449px 224.5px black, -450px 225px black, -451px 225.5px black, -452px 226px black, -453px 226.5px black, -454px 227px black, -455px 227.5px black, -456px 228px black, -457px 228.5px black, -458px 229px black, -459px 229.5px black, -460px 230px black, -461px 230.5px black, -462px 231px black, -463px 231.5px black, -464px 232px black, -465px 232.5px black, -466px 233px black, -467px 233.5px black, -468px 234px black, -469px 234.5px black, -470px 235px black, -471px 235.5px black, -472px 236px black, -473px 236.5px black, -474px 237px black, -475px 237.5px black, -476px 238px black, -477px 238.5px black, -478px 239px black, -479px 239.5px black, -480px 240px black, -481px 240.5px black, -482px 241px black, -483px 241.5px black, -484px 242px black, -485px 242.5px black, -486px 243px black, -487px 243.5px black, -488px 244px black, -489px 244.5px black, -490px 245px black, -491px 245.5px black, -492px 246px black, -493px 246.5px black, -494px 247px black, -495px 247.5px black, -496px 248px black, -497px 248.5px black, -498px 249px black, -499px 249.5px black, -500px 250px black, -501px 250.5px black, -502px 251px black, -503px 251.5px black, -504px 252px black, -505px 252.5px black, -506px 253px black, -507px 253.5px black, -508px 254px black, -509px 254.5px black, -510px 255px black, -511px 255.5px black, -512px 256px black, -513px 256.5px black, -514px 257px black, -515px 257.5px black, -516px 258px black, -517px 258.5px black, -518px 259px black, -519px 259.5px black, -520px 260px black, -521px 260.5px black, -522px 261px black, -523px 261.5px black, -524px 262px black, -525px 262.5px black, -526px 263px black, -527px 263.5px black, -528px 264px black, -529px 264.5px black, -530px 265px black, -531px 265.5px black, -532px 266px black, -533px 266.5px black, -534px 267px black, -535px 267.5px black, -536px 268px black, -537px 268.5px black, -538px 269px black, -539px 269.5px black, -540px 270px black, -541px 270.5px black, -542px 271px black, -543px 271.5px black, -544px 272px black, -545px 272.5px black, -546px 273px black, -547px 273.5px black, -548px 274px black, -549px 274.5px black, -550px 275px black, -551px 275.5px black, -552px 276px black, -553px 276.5px black, -554px 277px black, -555px 277.5px black, -556px 278px black, -557px 278.5px black, -558px 279px black, -559px 279.5px black, -560px 280px black, -561px 280.5px black, -562px 281px black, -563px 281.5px black, -564px 282px black, -565px 282.5px black, -566px 283px black, -567px 283.5px black, -568px 284px black, -569px 284.5px black, -570px 285px black, -571px 285.5px black, -572px 286px black, -573px 286.5px black, -574px 287px black, -575px 287.5px black, -576px 288px black, -577px 288.5px black, -578px 289px black, -579px 289.5px black, -580px 290px black, -581px 290.5px black, -582px 291px black, -583px 291.5px black, -584px 292px black, -585px 292.5px black, -586px 293px black, -587px 293.5px black, -588px 294px black, -589px 294.5px black, -590px 295px black, -591px 295.5px black, -592px 296px black, -593px 296.5px black, -594px 297px black, -595px 297.5px black, -596px 298px black, -597px 298.5px black, -598px 299px black, -599px 299.5px black, -600px 300px black, -601px 300.5px black, -602px 301px black, -603px 301.5px black, -604px 302px black, -605px 302.5px black, -606px 303px black, -607px 303.5px black, -608px 304px black, -609px 304.5px black, -610px 305px black, -611px 305.5px black, -612px 306px black, -613px 306.5px black, -614px 307px black, -615px 307.5px black, -616px 308px black, -617px 308.5px black, -618px 309px black, -619px 309.5px black, -620px 310px black, -621px 310.5px black, -622px 311px black, -623px 311.5px black, -624px 312px black, -625px 312.5px black, -626px 313px black, -627px 313.5px black, -628px 314px black, -629px 314.5px black, -630px 315px black, -631px 315.5px black, -632px 316px black, -633px 316.5px black, -634px 317px black, -635px 317.5px black, -636px 318px black, -637px 318.5px black, -638px 319px black, -639px 319.5px black, -640px 320px black, -641px 320.5px black, -642px 321px black, -643px 321.5px black, -644px 322px black, -645px 322.5px black, -646px 323px black, -647px 323.5px black, -648px 324px black, -649px 324.5px black, -650px 325px black, -651px 325.5px black, -652px 326px black, -653px 326.5px black, -654px 327px black, -655px 327.5px black, -656px 328px black, -657px 328.5px black, -658px 329px black, -659px 329.5px black, -660px 330px black, -661px 330.5px black, -662px 331px black, -663px 331.5px black, -664px 332px black, -665px 332.5px black, -666px 333px black, -667px 333.5px black, -668px 334px black, -669px 334.5px black, -670px 335px black, -671px 335.5px black, -672px 336px black, -673px 336.5px black, -674px 337px black, -675px 337.5px black, -676px 338px black, -677px 338.5px black, -678px 339px black, -679px 339.5px black, -680px 340px black, -681px 340.5px black, -682px 341px black, -683px 341.5px black, -684px 342px black, -685px 342.5px black, -686px 343px black, -687px 343.5px black, -688px 344px black, -689px 344.5px black, -690px 345px black, -691px 345.5px black, -692px 346px black, -693px 346.5px black, -694px 347px black, -695px 347.5px black, -696px 348px black, -697px 348.5px black, -698px 349px black, -699px 349.5px black, -700px 350px black, -701px 350.5px black, -702px 351px black, -703px 351.5px black, -704px 352px black, -705px 352.5px black, -706px 353px black, -707px 353.5px black, -708px 354px black, -709px 354.5px black, -710px 355px black, -711px 355.5px black, -712px 356px black, -713px 356.5px black, -714px 357px black, -715px 357.5px black, -716px 358px black, -717px 358.5px black, -718px 359px black, -719px 359.5px black, -720px 360px black, -721px 360.5px black, -722px 361px black, -723px 361.5px black, -724px 362px black, -725px 362.5px black, -726px 363px black, -727px 363.5px black, -728px 364px black, -729px 364.5px black, -730px 365px black, -731px 365.5px black, -732px 366px black, -733px 366.5px black, -734px 367px black, -735px 367.5px black, -736px 368px black, -737px 368.5px black, -738px 369px black, -739px 369.5px black, -740px 370px black, -741px 370.5px black, -742px 371px black, -743px 371.5px black, -744px 372px black, -745px 372.5px black, -746px 373px black, -747px 373.5px black, -748px 374px black, -749px 374.5px black, -750px 375px black, -751px 375.5px black, -752px 376px black, -753px 376.5px black, -754px 377px black, -755px 377.5px black, -756px 378px black, -757px 378.5px black, -758px 379px black, -759px 379.5px black, -760px 380px black, -761px 380.5px black, -762px 381px black, -763px 381.5px black, -764px 382px black, -765px 382.5px black, -766px 383px black, -767px 383.5px black, -768px 384px black, -769px 384.5px black, -770px 385px black, -771px 385.5px black, -772px 386px black, -773px 386.5px black, -774px 387px black, -775px 387.5px black, -776px 388px black, -777px 388.5px black, -778px 389px black, -779px 389.5px black, -780px 390px black, -781px 390.5px black, -782px 391px black, -783px 391.5px black, -784px 392px black, -785px 392.5px black, -786px 393px black, -787px 393.5px black, -788px 394px black, -789px 394.5px black, -790px 395px black, -791px 395.5px black, -792px 396px black, -793px 396.5px black, -794px 397px black, -795px 397.5px black, -796px 398px black, -797px 398.5px black, -798px 399px black, -799px 399.5px black, -800px 400px black, -801px 400.5px black, -802px 401px black, -803px 401.5px black, -804px 402px black, -805px 402.5px black, -806px 403px black, -807px 403.5px black, -808px 404px black, -809px 404.5px black, -810px 405px black, -811px 405.5px black, -812px 406px black, -813px 406.5px black, -814px 407px black, -815px 407.5px black, -816px 408px black, -817px 408.5px black, -818px 409px black, -819px 409.5px black, -820px 410px black, -821px 410.5px black, -822px 411px black, -823px 411.5px black, -824px 412px black, -825px 412.5px black, -826px 413px black, -827px 413.5px black, -828px 414px black, -829px 414.5px black, -830px 415px black, -831px 415.5px black, -832px 416px black, -833px 416.5px black, -834px 417px black, -835px 417.5px black, -836px 418px black, -837px 418.5px black, -838px 419px black, -839px 419.5px black, -840px 420px black, -841px 420.5px black, -842px 421px black, -843px 421.5px black, -844px 422px black, -845px 422.5px black, -846px 423px black, -847px 423.5px black, -848px 424px black, -849px 424.5px black, -850px 425px black, -851px 425.5px black, -852px 426px black, -853px 426.5px black, -854px 427px black, -855px 427.5px black, -856px 428px black, -857px 428.5px black, -858px 429px black, -859px 429.5px black, -860px 430px black, -861px 430.5px black, -862px 431px black, -863px 431.5px black, -864px 432px black, -865px 432.5px black, -866px 433px black, -867px 433.5px black, -868px 434px black, -869px 434.5px black, -870px 435px black, -871px 435.5px black, -872px 436px black, -873px 436.5px black, -874px 437px black, -875px 437.5px black, -876px 438px black, -877px 438.5px black, -878px 439px black, -879px 439.5px black, -880px 440px black, -881px 440.5px black, -882px 441px black, -883px 441.5px black, -884px 442px black, -885px 442.5px black, -886px 443px black, -887px 443.5px black, -888px 444px black, -889px 444.5px black, -890px 445px black, -891px 445.5px black, -892px 446px black, -893px 446.5px black, -894px 447px black, -895px 447.5px black, -896px 448px black, -897px 448.5px black, -898px 449px black, -899px 449.5px black, -900px 450px black, -901px 450.5px black, -902px 451px black, -903px 451.5px black, -904px 452px black, -905px 452.5px black, -906px 453px black, -907px 453.5px black, -908px 454px black, -909px 454.5px black, -910px 455px black, -911px 455.5px black, -912px 456px black, -913px 456.5px black, -914px 457px black, -915px 457.5px black, -916px 458px black, -917px 458.5px black, -918px 459px black, -919px 459.5px black, -920px 460px black, -921px 460.5px black, -922px 461px black, -923px 461.5px black, -924px 462px black, -925px 462.5px black, -926px 463px black, -927px 463.5px black, -928px 464px black, -929px 464.5px black, -930px 465px black, -931px 465.5px black, -932px 466px black, -933px 466.5px black, -934px 467px black, -935px 467.5px black, -936px 468px black, -937px 468.5px black, -938px 469px black, -939px 469.5px black, -940px 470px black, -941px 470.5px black, -942px 471px black, -943px 471.5px black, -944px 472px black, -945px 472.5px black, -946px 473px black, -947px 473.5px black, -948px 474px black, -949px 474.5px black, -950px 475px black, -951px 475.5px black, -952px 476px black, -953px 476.5px black, -954px 477px black, -955px 477.5px black, -956px 478px black, -957px 478.5px black, -958px 479px black, -959px 479.5px black, -960px 480px black, -961px 480.5px black, -962px 481px black, -963px 481.5px black, -964px 482px black, -965px 482.5px black, -966px 483px black, -967px 483.5px black, -968px 484px black, -969px 484.5px black, -970px 485px black, -971px 485.5px black, -972px 486px black, -973px 486.5px black, -974px 487px black, -975px 487.5px black, -976px 488px black, -977px 488.5px black, -978px 489px black, -979px 489.5px black, -980px 490px black, -981px 490.5px black, -982px 491px black, -983px 491.5px black, -984px 492px black, -985px 492.5px black, -986px 493px black, -987px 493.5px black, -988px 494px black, -989px 494.5px black, -990px 495px black, -991px 495.5px black, -992px 496px black, -993px 496.5px black, -994px 497px black, -995px 497.5px black, -996px 498px black, -997px 498.5px black, -998px 499px black, -999px 499.5px black, -1000px 500px black, 0 -1px  #000, 1px 0  #000, 1px 1px  #000;
}

@media (min-width: 481px) and (min-height: 481px) {
  blockquote {
    font-size: 75px;
  }
}

blockquote span {
  display: block;
  -webkit-transform: translate3d(-50vw, 30vw, 0);
          transform: translate3d(-50vw, 30vw, 0);
  opacity: 0;
  transition: all 1s cubic-bezier(0.65, 0.02, 0.23, 1);
}
blockquote span:nth-child(1) {
  transition-delay: 0.1s;
  z-index: 1;
}
blockquote span:nth-child(2) {
  transition-delay: 0.2s;
  z-index: 2;
}
blockquote span:nth-child(3) {
  transition-delay: 0.3s;
  z-index: 3;
}
blockquote.animate span {
  opacity: 1;
  position: relative;
}
blockquote.animate span:nth-child(1) {
  -webkit-transform: translate3d(20px, 0, 0);
          transform: translate3d(20px, 0, 0);
  transition-delay: 0.6s;
}
blockquote.animate span:nth-child(2) {
  -webkit-transform: translate3d(40px, 0, 0);
          transform: translate3d(40px, 0, 0);
  transition-delay: 0.5s;
}
blockquote.animate span:nth-child(3) {
  -webkit-transform: translate3d(60px, 0, 0);
          transform: translate3d(60px, 0, 0);
  transition-delay: 0.4s;
}



/*------INTRO END------*/






.intro-text {
  color: #000;
  margin: 0;
  /*visibility: hidden;*/
  padding: 10px;
  height: 10vh;
  max-height: 10vh;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-end;
  z-index: 0;
  opacity: 0;
}

.logoout .intro-text {
  height: auto;
  max-height: 1000px;
  opacity: 1;
  transition: all .5s ease-in .6s;
}


@media (min-width: 768px) {
  .intro-text {
    display: block;
    flex: 1 1 50%;
    right: 0;
    bottom: 15%;
    max-height: none;
    position: absolute;
    width: 50vw;
    opacity: 0;
  }
  .logoout .intro-text {
    height: auto;
  }
}

.intro-text small a {

  color: #000;

  text-decoration: none;

}

.intro-text small {

  font-size: 70%;

  max-width: 600px;	

  width: 80%;

}
/*
.logoout .intro-text {

  visibility: visible;

  color: #fff;

  text-shadow: 4px 4px 8px #333;

  transition: color .5s ease-in .6s, text-shadow .5s ease-in .6s, z-index 1s linear 1s;

  z-index: 1;

}*/

/*.logoout .intro-text small a {

  color: #fff;

  transition: color .5s ease-in .6s;

}*/

.lang-buttons {

  display: flex;

  justify-content: flex-end;

  opacity: 0;

}

.logoout .lang-buttons {

  opacity: 1;

  transition: opacity .5s ease-in .6s;

}

.intro-text .nav-btn__wrapper {
  height: 75px;
  padding-top: 5px;
}

.intro-text .nav-btn > i {

    margin: -2px 0 0 3px;

    display: inline-block;

}

.intro-text .nav-btn {
  background-color: #000;
  border-radius: 50%;
  cursor: pointer;
  height: 72px;
  line-height: 72px;
  text-decoration: none;
  width: 72px;
  display: inline-block;
  transition: margin-top .1s linear, margin-left .1s linear, box-shadow .1s ease-out;
  text-align: center;
}


.intro-text .nav-btn:active,
.intro-text .nav-btn:hover {
  margin-top: -2px;
  margin-left: -2px;
  transition: margin-top .2s linear, margin-left .2s linear, box-shadow .2s ease-out;
  box-shadow: 3px 3px 0px #000;
  color: #000;
  background-color: #fff;
  border: solid 1px #555;
}

.intro-text .nav-btn:active {
  margin-top: -1px;
  margin-left: -1px;
  box-shadow: 1px 1px 0px #000;
}

/*
.logoout .intro-text {

  opacity: 1;

  transition: opacity .5s ease-in .6s;

}*/



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

		    	<div class="more-viewer-inner"></div>

		    </div>

		

			<div id="tinderslide">

			    <ul id="tinderslideList" class="slide-dimension">

			        <li id="loaderSlide" class="slide-dimension info-slide"><div class="loading"><span class="loading-blink">Loading...</span><div class="loader"><span id="loader-percentage">0</span>%</div></div></li>

			    </ul>

			</div><!-- /#tinderslide -->



			<div class="actions-container slide-dimension">

				<div class="actions">

			        <a href="#" class="dislike dislike-action">

			        	<i class="icon-x"></i>

			        	<i class="icon-arrow-left"></i>

			        </a>

			        <a href="#" class="like like-action">

			        	<i class="icon-heart-shape-outline"></i>

			        	<i class="icon-arrow-right"></i>

			        </a>

			    </div><!-- /.actions -->

		    </div><!-- /.actions-container -->



	    </div><!-- /.tinder-container -->

	    <div id="howToIntro" class="intro-container"><div class="intro-wrapper">



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

			<p><span class="lang-ca">Repassa la selecció, vota els teus favorits, però sobretot, descobreix el millor art de Barcelona de 2018.</span><span class="lang-es">Repasa la selección, vota tus favoritos, pero sobre todo, descubre el mejor arte de Barcelona de 2018.</span><span class="lang-en">Review the selection, vote your favorites, but above all, discover the best art of Barcelona in 2018.</span></p>



			<div class="nav-btn__wrapper"><a href="#!" class="nav-btn vote-start"><i class="icon-arrow-right"></i></a></div>

		



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

			<p><span class="lang-ca">Repassa la selecció, vota els teus favorits, però sobretot, descobreix el millor art de Barcelona de 2018.</span><span class="lang-es">Repasa la selección, vota tus favoritos, pero sobre todo, descubre el mejor arte de Barcelona de 2018.</span><span class="lang-en">Review the selection, vote your favorites, but above all, discover the best art of Barcelona in 2018.</span></p>

			<p>

				<small>

					<span class="lang-ca">Els teus vots no es comptabilitzaran en el accès previ. Per poder votar hauràs de desloguearte <a href="http://asib.theme/wp-login.php/?action=logout" target="_blank">http://asib.theme/wp-login.php/?action=logout</a> i accedir a través de <a href = "http://asib.theme/" target = "_blank"> http://asib.theme/ </a></span>

					<span class="lang-es">Tus votos no se contabilizarán en el aceso previo. Para poder votar tendrás que desloguearte <a href="http://asib.theme/wp-login.php/?action=logout" target="_blank">http://asib.theme/wp-login.php/?action=logout</a> y acceder a través de <a href="http://asib.theme/" target="_blank">http://asib.theme/</a></span>

					<span class="lang-en">Your votes will not be counted in the previous access. To be able to vote you will have to logout <a href="http://asib.theme/wp-login.php/?action=logout" target="_blank">http://asib.theme/wp-login.php/?action=logout</a> and access through <a href = "http://asib.theme/" target = "_blank"> http://asib.theme/ </a></span>

				</small>

			</p>



			<div class="nav-btn__wrapper"><a href="#!" class="nav-btn vote-start"><i class="icon-arrow-right"></i></a></div>

		</div>

	<?php } else { ?>

		<div class="login-modal-wrapper">

			<div class="login-modal">

				<p>

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



			<p><span class="lang-ca">Entre Artssspot i Opening BCN hem seleccionat 100 de les millors obres d'art que hem vist durant l'any 2018 a Barcelona i el públic ha votat els seus 25 favorits.</span><span class="lang-es">Entre Artssspot y Opening BCN hemos seleccionado 100 de las mejores obras de arte que hemos visto durante el año 2018 en Barcelona y el público ha votado sus 25 favoritos.</span><span class="lang-en">Between Artssspot and Opening BCN we have selected 100 of the best works of art we have seen during the year 2018 in Barcelona and the public has voted their 25 favorites.</span></p>


				<small>

					<span class="lang-ca">Pots consultar el rànquing complet aquí <a href="http://asib.theme/ranking" target="_blank">http://asib.theme/ranking</a></span>

					<span class="lang-es">Puedes consultar el ranking completo aquí<a href="http://asib.theme/ranking" target="_blank">http://asib.theme/ranking</a></span>

					<span class="lang-en">You can check the full ranking here <a href="http://asib.theme/ranking" target="_blank"> http://asib.theme/ranking </a></span>

				</small>

			</p>



			<div class="nav-btn__wrapper"><a href="#!" class="nav-btn vote-start"><i class="icon-arrow-right"></i></a></div>

		</div>

<?php } else { ?>

	<div class="intro-text">

		<div class="lang-buttons">

			<a href="#!" class="demo-pill ctrl-btn es-ca">Català</a>

			<a href="#!" class="demo-pill ctrl-btn es-es">Castellano</a>

			<a href="#!" class="demo-pill ctrl-btn en-en">English</a>

		</div>





		<p><span class="lang-ca">Vota el millor art de 2017. <br />A partir l'1 de gener de 2019.</span><span class="lang-es">Vota el mejor arte de 2019. <br />A partir del 1 de enero de 2018.</span><span class="lang-en">Vote for the best art of 2017. <br />Start on January 1, 2019.</span></p>



		<p><small><span class="lang-ca">Una iniciativa de:</span><span class="lang-es">Una iniciativa de:</span><span class="lang-en">An initiative by:</span> <span><a href="http://www.artssspot.com" target="_blank" class="artssspot">Artssspot.com</a>, <a href="https://www.facebook.com/opening.bcn" target="_blank" class="opening">Opening BCN</a></span></small></p>

		<small><span class="lang-ca">Col·laboren:</span><span class="lang-es">Colaboran:</span><span class="lang-en">Collaborating:</span> <span><a href="http://www.poblenouurbandistrict.com/" target="_blank">Poblenou Urban District</a>, <a href="http://www.younggalleryweekend.com/" target="_blank">Young Gallery Weekend</a>, <a href="http://www.galeriescatalunya.com/" target="_blank">Gremi de Galeries d'Art de Catalunya</a>, <a href="http://www.lhdistrictecultural.cat/" target="_blank">L'Hospitalet Districte Cultural</a>, <a href="http://www.bcnstreetart.xyz/" target="_blank">BCN Street Art</a></span></small></p>

	</div>

<?php } ?>



<div class="intro-logo">

<!-- 
	<span data-text="Art" class="backgroundclip textshadow word-art">Art </span> 

	<span data-text="seen" class="backgroundclip textshadow size word-seen">seen </span> 

	<span data-text="in" class="backgroundclip textshadow word-in">in </span> 

	<span data-text="BCN&nbsp;'17" class="backgroundclip textshadow word-bcn">BCN&nbsp;'17</span>
-->

<blockquote>
  <span>Art</span>
  <span>seen in</span>
  <span>BCN'18</span>
</blockquote>

</div>







</div></div>



	</section><!-- /#art-viewer -->







<script>

(function() {

  var tt = setTimeout(function(){
    document.getElementById('howToIntro').classList.add('logoout');
  }, 2000);

  document.querySelector('blockquote').classList.toggle('animate');



	jQuery('.vote-start').on('click tap', function() {

		jQuery('#howToIntro').fadeOut();

		if (proceed) {

			jQuery(document).trigger('asi.proceed');

		} else {

			proceed = true;

		}

	});

  })();

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

			



