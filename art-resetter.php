<?php
/**
 * Template Name: Art Resetter
 *
 * @package ArtSeenIn2016
 * @subpackage ArtSeenIn2016
 * @since ArtSeenIn2016
 */

parse_str( $_SERVER['QUERY_STRING'] );
$cookie_name = "pid";
$cookie_value = $pid;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day


if ( is_user_logged_in() && current_user_can('administrator')) {

	get_header(); 


$blogposts = get_posts(array(
            'numberposts'   => -1, // get all posts.
            'fields'        => 'ids', // Only get post IDs
        ));

        foreach ( $blogposts as $post ) {           // Update our user meta
            echo $post . ',';
        }
        echo  '<br><br>';
$blogposts2 = get_posts(array(
            'orderby'   => 'meta_value_num',
            'meta_key'  => '_viewmecount',
            'numberposts'   => -1, // get all posts.
            'fields'        => 'ids', // Only get post IDs
            'order'         => 'ASC',
            )
        );

        foreach ( $blogposts2 as $post ) {           // Update our user meta
            echo $post . ',';
        }

$user_id = get_current_user_id();                            // Get our current user ID

$user_meta1 = get_user_meta( get_current_user_id(), 'vvi', true);
$user_meta2 = get_user_meta( get_current_user_id(), 'vvo', true);

echo '<br><br>Current user views: ' . $user_meta1 . '<br><br>';
echo 'Current user votes: ' . $user_meta2 . '<br><br>';


#reset user viewing info
#reset post views (editable)
	?>

	<div>
	<form id="form-user">
	Reset viewing info for current user
	<input type="hidden" name="reset" value="">
	<input type="submit" value="Go!"/></form></div><br><br>

    <div>
    <form id="form-user-all">
	Reset viewing info all users
	<input type="hidden" name="reset" value="">
	<input type="submit" value="Go!"/></form></div><br><br>

    <div>
    <form id="form-post-all-views">
    Reset all post views to 1
    <input type="hidden" name="reset" value="">
    <input type="submit" value="Go!"/></form></div><br><br>

    <div>
    <form id="form-post-all-votes">
    Reset all post votes to 0
    <input type="hidden" name="reset" value="">
    <input type="submit" value="Go!"/></form></div><br><br>

    <div>
	<form id="test">
	test
	<input type="text" name="resetVale" value="" id="resetVale">
	<input type="submit" value="Go!"/></form></div><br><br>

<script>
var user_viewing_data = '';



(function($) {

    viewmegetposts();

$('#form-user-all').on('submit', function() {
	$.ajax( {
        url : ajax_url,                 // Use our localized variable that holds the AJAX URL
        type: 'POST',                   // Declare our ajax submission method ( GET or POST )
        data: {                         // This is our data object
            action  : 'um_all_cb',          // AJAX POST Action
            'vvi': '',       // Replace `um_key` with your user_meta key name
            'vvo': '',       // Replace `um_key` with your user_meta key name
        }
    } )
    .success( function( results ) {
        alert( 'All User Meta Updated!' );
    } )
    .fail( function( data ) {
        alert( 'Request failed: ' + data.statusText );
    });
    return false;
});

$('#form-post-all-views').on('submit', function() {
    viewmeresetview();

    return false;
});

$('#form-post-all-votes').on('submit', function() {
    viewmeresetvotes();
    return false;
});

$('#form-user').on('submit', function() {
	$.ajax( {
        url : ajax_url,                 // Use our localized variable that holds the AJAX URL
        type: 'POST',                   // Declare our ajax submission method ( GET or POST )
        data: {                         // This is our data object
            action  : 'um_cb',          // AJAX POST Action
            'vvi': '',       // Replace `um_key` with your user_meta key name
            'vvo': '',       // Replace `um_key` with your user_meta key name
        }
    } )
    .success( function( results ) {
        alert( 'My User Meta Updated!' );
    } )
    .fail( function( data ) {
        alert( 'Request failed: ' + data.statusText );
    });
    return false;
});



$('#test').on('submit', function() {
	var v = $('#resetVale').val();
	viewmesave(v, v);

    return false;
});

})(jQuery);

</script>


<?php get_footer();
		
} else { 
wp_redirect('/');
} ?>


			

