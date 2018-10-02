<?php

/**

 * ArtSeenIn2016 functions and definitions.

 *

 * @link https://developer.wordpress.org/themes/basics/theme-functions/

 *

 * @package ArtSeenIn2016

 */



if ( ! function_exists( 'artseenin2016_setup' ) ) :

/**

 * Sets up theme defaults and registers support for various WordPress features.

 *

 * Note that this function is hooked into the after_setup_theme hook, which

 * runs before the init hook. The init hook is too late for some features, such

 * as indicating support for post thumbnails.

 */

function artseenin2016_setup() {

	/*

	 * Make theme available for translation.

	 * Translations can be filed in the /languages/ directory.

	 * If you're building a theme based on ArtSeenIn2016, use a find and replace

	 * to change 'artseenin2016' to the name of your theme in all the template files.

	 */

	load_theme_textdomain( 'artseenin2016', get_template_directory() . '/languages' );



	// Add default posts and comments RSS feed links to head.

	add_theme_support( 'automatic-feed-links' );



	/*

	 * Let WordPress manage the document title.

	 * By adding theme support, we declare that this theme does not use a

	 * hard-coded <title> tag in the document head, and expect WordPress to

	 * provide it for us.

	 */

	add_theme_support( 'title-tag' );



	/*

	 * Enable support for Post Thumbnails on posts and pages.

	 *

	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/

	 */

	add_theme_support( 'post-thumbnails' );



	// This theme uses wp_nav_menu() in one location.

	register_nav_menus( array(

		'primary' => esc_html__( 'Primary', 'artseenin2016' ),

	) );



	/*

	 * Switch default core markup for search form, comment form, and comments

	 * to output valid HTML5.

	 */

	add_theme_support( 'html5', array(

		'search-form',

		'comment-form',

		'comment-list',

		'gallery',

		'caption',

	) );



	// Set up the WordPress core custom background feature.

	add_theme_support( 'custom-background', apply_filters( 'artseenin2016_custom_background_args', array(

		'default-color' => 'ffffff',

		'default-image' => '',

	) ) );

}

endif;

add_action( 'after_setup_theme', 'artseenin2016_setup' );



/**

 * Set the content width in pixels, based on the theme's design and stylesheet.

 *

 * Priority 0 to make it available to lower priority callbacks.

 *

 * @global int $content_width

 */

function artseenin2016_content_width() {

	$GLOBALS['content_width'] = apply_filters( 'artseenin2016_content_width', 640 );

}

add_action( 'after_setup_theme', 'artseenin2016_content_width', 0 );



/**

 * Register widget area.

 *

 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar

 */

function artseenin2016_widgets_init() {

	register_sidebar( array(

		'name'          => esc_html__( 'Sidebar', 'artseenin2016' ),

		'id'            => 'sidebar-1',

		'description'   => esc_html__( 'Add widgets here.', 'artseenin2016' ),

		'before_widget' => '<section id="%1$s" class="widget %2$s">',

		'after_widget'  => '</section>',

		'before_title'  => '<h2 class="widget-title">',

		'after_title'   => '</h2>',

	) );

}

add_action( 'widgets_init', 'artseenin2016_widgets_init' );



/**

 * Enqueue scripts and styles.

 */

function artseenin2016_scripts() {



 	$theme_url  = get_template_directory_uri();     // Used to keep our Template Directory URL

    $ajax_url   = admin_url( 'admin-ajax.php' );        // Localized AJAX URL







    // Finally enqueue our script

    wp_enqueue_script( 'um-modifications' );



  	wp_enqueue_style( 'styles-jTinder', get_template_directory_uri() . '/js/jTinder-master/css/jTinder.css',false,'1.1','all');

	wp_enqueue_style( 'artseenin2016-style', get_stylesheet_uri() );



	wp_enqueue_script( 'artseenin2016-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );



	wp_enqueue_script( 'artseenin2016-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );





	wp_enqueue_script( 'jquery-transform2d', get_template_directory_uri() . '/js/jTinder-master/js/jquery.transform2d.js', array(), '20151215', true );

	wp_enqueue_script( 'jquery-jTinder', get_template_directory_uri() . '/js/jTinder-master/js/jquery.jTinder.js', array('jquery-transform2d'), '20151215', true );

	wp_enqueue_script( 'art-app', get_template_directory_uri() . '/js/app.js', array('jquery-transform2d', 'jquery-jTinder'), '20151215', true );



	//Slider/Viewer

  	//wp_enqueue_style( 'styles-unslider', get_template_directory_uri() . '/js/unslider/css/unslider.css');

 //   	wp_enqueue_script( 't-poly', get_template_directory_uri() . '/js/node_modules/tocca/bind.polyfill.js', array(), '20151215', true );

	// wp_enqueue_script( 't-prefix', get_template_directory_uri() . '//cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js', array(), '20151215', true );

	// wp_enqueue_script( 'tocca', get_template_directory_uri() . '/js/node_modules/tocca/Tocca.min.js', array('t-poly'), '20151215', true );

  	//wp_enqueue_script( 'unslider', get_template_directory_uri() . '/js/unslider/js/unslider-min.js', array('jquery-swipe'), '20151215', true );

    // Localize Our Script so we can use `ajax_url`

    wp_localize_script(

        'art-app',

        'ajax_url',

        $ajax_url

    );



 

  // we need to create a JavaScript variable to store our API endpoint...   

  wp_localize_script( 'art-app', 'AppAPI', array( 'url' => get_bloginfo('wpurl').'/api/') ); // this is the API address of the JSON API plugin

  // ... and useful information such as the theme directory and website url

  wp_localize_script( 'art-app', 'BlogInfo', array( 'url' => get_bloginfo('template_directory').'/', 'site' => get_bloginfo('wpurl')) );





	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}

}

add_action( 'wp_enqueue_scripts', 'artseenin2016_scripts' );



/**

 * Implement the Custom Header feature.

 */

require get_template_directory() . '/inc/custom-header.php';



/**

 * Custom template tags for this theme.

 */

require get_template_directory() . '/inc/template-tags.php';



/**

 * Custom functions that act independently of the theme templates.

 */

require get_template_directory() . '/inc/extras.php';



/**

 * Customizer additions.

 */

require get_template_directory() . '/inc/customizer.php';



/**

 * Load Jetpack compatibility file.

 */

require get_template_directory() . '/inc/jetpack.php';











/* start um*/



/**

 * AJAX Callback

 * Always Echos and Exits

 */

function um_modifications_callback() {



    // Ensure we have the data we need to continue

    if( ! isset( $_POST ) || empty( $_POST ) || ! is_user_logged_in() ) {



        // If we don't - return custom error message and exit

        header( 'HTTP/1.1 400 Empty POST Values' );

        echo 'Could Not Verify POST Values.';

        exit;

    }



    $user_id        = get_current_user_id();                            // Get our current user ID

    $um_val1         = sanitize_text_field( $_POST['vvi'] );      // Sanitize our user meta value

    $um_val2         = sanitize_text_field( $_POST['vvo'] );      // Sanitize our user meta value

    #$um_user_email  = sanitize_text_field( $_POST['user_email'] );      // Sanitize our user email field



    update_user_meta( $user_id, 'vvi', $um_val1 );                // Update our user meta

    update_user_meta( $user_id, 'vvo', $um_val2 );                // Update our user meta



    exit;

}

add_action( 'wp_ajax_nopriv_um_cb', 'um_modifications_callback' );

add_action( 'wp_ajax_um_cb', 'um_modifications_callback' );



/* end um */





function um_modifications_all_callback() {



    // Ensure we have the data we need to continue

    if( ! isset( $_POST ) || empty( $_POST ) || ! is_user_logged_in() ) {



        // If we don't - return custom error message and exit

        header( 'HTTP/1.1 400 Empty POST Values' );

        echo 'Could Not Verify POST Values.';

        exit;

    }



    $um_val1  = sanitize_text_field( $_POST['vvi'] );      // Sanitize our user meta value

    $um_val2  = sanitize_text_field( $_POST['vvo'] );      // Sanitize our user meta value

   



    $blogusers = get_users( array( 'fields' => array( 'id' )));

	foreach ( $blogusers as $user ) {

	    update_user_meta( $user->id, 'vvi', $um_val1 );                // Update our user meta

	    update_user_meta( $user->id, 'vvo', $um_val2 );                // Update our user meta

	}

    exit;

}

add_action( 'wp_ajax_nopriv_um_all_cb', 'um_modifications_all_callback' );

add_action( 'wp_ajax_um_all_cb', 'um_modifications_all_callback' );



/* end um */









// REMOVED ALL CUSTOMIZED LOGIN CODE (Legacy????)

// /* start customize login */

// function my_custom_login() {

// echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-styles.css" />';

// }

// add_action('login_head', 'my_custom_login');





// function my_login_logo_url() {

// return get_bloginfo( 'url' );

// }

// add_filter( 'login_headerurl', 'my_login_logo_url' );



// function my_login_logo_url_title() {

// return 'Your Site Name and Info';

// }

// add_filter( 'login_headertitle', 'my_login_logo_url_title' );



// function my_login_head() {

// remove_action('login_head', 'wp_shake_js', 12);

// }

// add_action('login_head', 'my_login_head');



// function admin_login_redirect( $redirect_to, $request, $user )

// {

// global $user;

// if( isset( $user->roles ) && is_array( $user->roles ) ) {

// if( in_array( "administrator", $user->roles ) ) {

// return $redirect_to;

// } else {

// return home_url();

// }

// }

// else

// {

// return $redirect_to;

// }

// }

// add_filter("login_redirect", "admin_login_redirect", 10, 3);

// /* end customize login */



add_action('after_setup_theme', 'remove_admin_bar');

 

function remove_admin_bar() {

if (!current_user_can('administrator') && !is_admin()) {

  show_admin_bar(false);

}

}



/* start block dashboard for non admins */

add_action( 'init', 'blockusers_init' );

function blockusers_init() {

if ( is_admin() && ! current_user_can( 'administrator' ) &&

! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {

wp_redirect( home_url() );

exit;

}

}

/* end block dashboard for non admins */



/* start hide admin bar for non admins */

add_action('set_current_user', 'cc_hide_admin_bar');

function cc_hide_admin_bar() {

  if (!current_user_can('edit_posts')) {

    show_admin_bar(false);

  }

}

/* end hide admin bar for non admins */



/* custom loginstyles */

function my_login_stylesheet() {

    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/style-login.css' );

    wp_enqueue_script( 'custom-login', get_stylesheet_directory_uri() . '/style-login.js' );

}

add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );





/* Login with password according to: http://slobodanmanic.com/249/wordpress-set-password-during-registration/ 





// Add Password, Repeat Password and Are You Human fields to WordPress registration form

// http://wp.me/p1Ehkq-gn

add_action( 'register_form', 'ts_show_extra_register_fields' );

function ts_show_extra_register_fields(){

?>

	<p>

		<label for="password">Contrasenya<br/>

		<input id="password" class="input" type="password" tabindex="30" size="25" value="" name="password" />

		</label>

	</p>

	<p>

		<label for="repeat_password">Repeteix la contrasenya<br/>

		<input id="repeat_password" class="input" type="password" tabindex="40" size="25" value="" name="repeat_password" />

		</label>

	</p>

	<p>

		<label for="are_you_human" style="font-size:11px">Comprovem que no ets un robot: La selecció d'art, de quin any és?<br/>

		<input id="are_you_human" class="input" type="text" tabindex="40" size="25" value="" name="are_you_human" />

		</label>

	</p>

<?php

}

// Check the form for errors

add_action( 'register_post', 'ts_check_extra_register_fields', 10, 3 );

function ts_check_extra_register_fields($login, $email, $errors) {

	if ( $_POST['password'] !== $_POST['repeat_password'] ) {

		$errors->add( 'passwords_not_matched', "<strong>ERROR</strong>: Les contrasenyes han de coincidir" );

	}

	if ( strlen( $_POST['password'] ) < 8 ) {

		$errors->add( 'password_too_short', "<strong>ERROR</strong>: La contrasenya ha de tenir almenys 8 caràcters" );

	}

	if ( $_POST['are_you_human'] !== '2018' ) {

		$errors->add( 'not_human', "<strong>ERROR</strong>: Ets un robot? Comprova el formulari ..." );

	}

}



// Storing WordPress user-selected password into database on registration

// http://wp.me/p1Ehkq-gn

add_action( 'user_register', 'ts_register_extra_fields', 100 );

function ts_register_extra_fields( $user_id ){

	$userdata = array();

	$userdata['ID'] = $user_id;

	if ( $_POST['password'] !== '' ) {

		$userdata['user_pass'] = $_POST['password'];

	}

	$new_user_id = wp_update_user( $userdata );

}



// Editing WordPress registration confirmation message

// http://wp.me/p1Ehkq-gn

add_filter( 'gettext', 'ts_edit_password_email_text' );

function ts_edit_password_email_text ( $text ) {

	if ( $text == 'A password will be e-mailed to you.' ) {

		$text = 'Si deixes el camp de contrasenya buit es generarà una per a tu. La contrasenya ha de tenir almenys vuit caràcters.';

	}

	return $text;

}*/


/*
// add are you human check functionality add_action( 'register_form', 'ts_show_extra_register_fields' );

add_action( 'register_form', 'ts_show_extra_register_fields' );

function ts_show_extra_register_fields(){

?>

	<p>

		<label for="are_you_human" style="font-size:11px">Comprovem que no ets un robot: La selecció d'art, de quin any és?<br/>

		<input id="are_you_human" class="input" type="text" tabindex="40" size="25" value="" name="are_you_human" />

		</label>

	</p>

<?php

}

// Check the are you human field

add_action( 'register_post', 'ts_check_extra_register_fields', 10, 3 );

function ts_check_extra_register_fields($login, $email, $errors) {

	if ( $_POST['are_you_human'] !== '2018' ) {

		$errors->add( 'not_human', "<strong>ERROR</strong>: Ets un robot? Comprova el formulari ..." );

	}

}

*/





// disable random password suggestion (https://www.itsupportguides.com/knowledge-base/wordpress/wordpress-how-to-disable-random-password-for-password-resets/)

add_filter( 'random_password', 'itsg_disable_random_password', 10, 2 );



function itsg_disable_random_password( $password ) {

    $action = isset( $_GET['action'] ) ? $_GET['action'] : '';

    if ( 'wp-login.php' === $GLOBALS['pagenow'] && ( 'rp' == $action  || 'resetpass' == $action ) ) {

        return '';

    }

    return $password;

}





// disable inforcement of "strong" PW (https://wordpress.stackexchange.com/questions/216183/loosen-disable-password-policy)

add_action( 'wp_print_scripts', 'DisableStrongPW', 100 );



function DisableStrongPW() {

    if ( wp_script_is( 'wc-password-strength-meter', 'enqueued' ) ) {

        wp_dequeue_script( 'wc-password-strength-meter' );

    }

}