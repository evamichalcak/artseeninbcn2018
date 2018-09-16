(function($) {

	// DOM
	var slider = "#tinderslide";
	var sliderList = "#tinderslideList";
	var cookieName = "artseeninbcn2016";
	var loaderDisplay = "#loader-percentage";
	var savingMessage = "#savingMessage";
	var thankYouSlide = "#thankYouSlide";

	//constans
	var maxImages = 5;
	var information_string = "Tienes una votación inicada, a continuación sólo verás las entradas que te faltan por votar.";

	// variables
	var post_query;
	var posts;
	var image_loader = 0;imgCounter
	var imgCounter = 0;

	// Proceedings
	// 1. get all posts
	// 2. start preloading images
	// 3. get user viewing info: false or viewed_ids
	// 4. if viewed_ids, clean post array
	// 5. generate html
	// 6. when images finised loading, initialize

	//-----------------------------------------

	// INITIALIZE

	//-----------------------------------------

	function initialize(post_query) {
		var previous_actions = get_user_viewing_info();
		//determine if a postid for startpost has been passed
		if (previous_actions == 0) {
			preload_images(post_query);
			$(loaderDisplay).on('asi.allLoaded', function() {
				print_posts(post_query);
				slider_setup();
			});
		} else if (previous_actions instanceof Array) {
			preload_images(post_query);
			$(loaderDisplay).on('asi.allLoaded', function() {
				console.log('init');
				print_posts(clean_post_array(previous_actions, post_query));
				slider_setup();
			});
			inform_user();
		} else {
			$(thankYouSlide).show();
		}
		//window.onbeforeunload = before_close(user_viewing_data);
	}

	function slider_setup() {
		show_start_post();
		imgCounter = $('.slider-image').length;
		if (imgCounter == 0) {
			$(thankYouSlide).show();
		}
		console.log('counter: ' + imgCounter);
		$(slider).jTinder({
		    onDislike: function (item) {
		        console.log('Dislike image ' + $(item).data('postid'));
		        on_dismiss($(item).data('postid'));
		    },
		    onLike: function (item) {
		        console.log('Like image ' + $(item).data('postid'));
		        on_like($(item).data('postid'));
		    },
		    animationRevertSpeed: 200,
		    animationSpeed: 400,
		    threshold: 1,
		    likeSelector: '.like',
		    dislikeSelector: '.dislike'
		});
	}

	//-----------------------------------------

	// HANDLE POSTS

	//-----------------------------------------


	//get posts ordered by view count
	function get_posts() {
		$.ajax({
			url: AppAPI.url + 'get_posts/?order_by=_viewmecount&order=DESC&meta_key=_viewmecount',
			dataType: 'json',
			success: function( resp ) {
				console.log('getting post query');
				post_query = resp['posts'];
				initialize(post_query);
			},
			error: function( req, status, err ) {
				console.log( 'something went wrong', status, err );
			}
		});
	}

	//preload images
	function preload_images(post_query) {
		console.log('loading images');
		$.each(post_query, function(index, post) {
			var img = new Image();
			img.src = post.thumbnail_images.full.url;
		    img.onload = update_loader;
		});
		return true;	
	}

	//update loader
	function update_loader() {
		image_loader++;
		$(loaderDisplay).html(image_loader);
		if (image_loader == maxImages) {
			$(loaderDisplay).trigger('asi.allLoaded');
		}
		return true;	
	}

	//transform remaining posts into 
	function print_posts(posts) {
		console.log('printing posts');
		var html = '';
		$.each(posts, function(index, element) {
		    html+='<li class="slider-image panel'+index+'" id="p'+index+'" data-postid="'+posts[index].id+'">';
		    html+='<div class="img" style="background-image: url('+posts[index].thumbnail_images.full.url+');"></div>';
		    html+='<div class="content">'+posts[index].content+'</div>';
		    html+='<div class="like"></div><div class="dislike"></div></li>';
		});
		$(sliderList).html(html);
		return true;
	}

	//remove all posts already viewed
	function clean_post_array(user_viewing_array, post_query) {
		console.log('cleaning posts');
		var posts = post_query.filter(function(post) {
		  return user_viewing_array.indexOf(post['id']+'') == -1;
		});
		console.log(posts);
		return posts;
	}
	
	//helper function to get cookie content by name
	function getCookie(name) {
		var value = "; " + document.cookie;
		var parts = value.split("; " + name + "=");
		if (parts.length == 2) return parts.pop().split(";").shift();
	}


	//check for cookie pid and if present, set start post
	function show_start_post() {
		var pid = getCookie('pid');
		if (pid === undefined) {
			return false;
		} else {
			$('#p'+pid).appendTo(sliderList);
			return true;
		}
	}


	//-----------------------------------------

	// HANDLE USER VIEWING INFO

	//-----------------------------------------


	function get_user_viewing_info() {
		console.log('getting user viewing info');
		if (user_viewing_data === '') {
			return 0;
		} else if (user_viewing_data === 'done') {
			return 1;
		} else {
			return user_viewing_data.split(',');
		}
	}


	function add_post_to_viewed_data(post_id) {
		console.log('adding user viewing info');
		if (user_viewing_data.length > 0) {
			user_viewing_data += ',' + post_id;
		} else {
			user_viewing_data += post_id;
		}
		return true;
	}

	//set user viewing info before closing !!!!don't use anywhere else: synchronous ajax!!!!
	function send_user_viewing_info(user_viewing_data, callback) {
		console.log('sending user viewing info');
        // Do very simple value validation
        if( user_viewing_data !== '' ) {
            $.ajax( {
            	async: false, 					// set ajax call to sync and force browser to wait until finished
                url : ajax_url,                 // Use our localized variable that holds the AJAX URL
                type: 'POST',                   // Declare our ajax submission method ( GET or POST )
                data: {                         // This is our data object
                    action  : 'um_cb',          // AJAX POST Action
                    'vv': user_viewing_data,       // Replace `um_key` with your user_meta key name
                }
            } )
            .success( function( results ) {
                console.log( 'User Meta Updated!' );
                callback();
            } )
            .fail( function( data ) {
                console.log( data.responseText );
                console.log( 'Request failed: ' + data.statusText );
            } );

        } 
		return true;
	}

	//inform user that they have already started voting
	function inform_user() {
		alert(information_string);
	}


	//-----------------------------------------

	// HANDLE SWIPE

	//-----------------------------------------

	//save post view
	function save_post_view(post_id) {
		viewmeaddvote(post_id);
		return true;
	}

	//save post vote as comment
	function post_vote(post_id) {
		var com = user_id + '-' + post_id;
		$.ajax({
			url: AppAPI.url + 'respond/submit_comment/?post_id='+post_id+'&name=Artssspot&email=info@artssspot.com&content='+com,
			dataType: 'json',
			success: function( resp ) {
				console.log('vote has been cast');
			},
			error: function( req, status, err ) {
				console.log( 'something went wrong with vote', status, err );
			}
		});
		return true;
	}

	//actions on dismissing
	function on_dismiss(post_id) {
		save_post_view(post_id);
		add_post_to_viewed_data(post_id);
		update_image_counter();
		return true;
	}

	function on_like(post_id) {
		add_post_to_viewed_data(post_id);
		//viewmevoteviewstore(post_id, user_viewing_data);
		post_vote(post_id);
		update_image_counter();
		return true;
	}


	// //actions on liking
	// function on_like(post_id) {
	// 	post_vote(post_id);
	// 	on_dismiss(post_id);
	// 	return true;
	// }

	function update_image_counter() {
		imgCounter--;
		console.log(imgCounter);
		if (imgCounter == 0) {
			finish(user_viewing_data);
		}
	}



	//-----------------------------------------

	// HANDLE END AND EXIT

	//-----------------------------------------


	//save user viewing data (could return false, if viewing not finished)
	function update_user_viewing_info(user_viewing_json) {
		return true;
	}

	//alert user about pending votes
	function alert_user() {
		return true;
	}

	//actions on exit
	function before_close(user_viewing_data) {
		$(savingMessage).show();
		send_user_viewing_info(user_viewing_data, function() {
			$(savingMessage).hide();
			console.log('before close done!');
		});
		//alert_user
		return null;
	}

	//display thanks
	function finish(user_viewing_data) {
		send_user_viewing_info('done', function() {
			$(savingMessage).hide();
			console.log('finish done!');
		});
		$(thankYouSlide).show();
		return true;
	}




// TESTS//////////////////////////////////////////



var ttt = {
  "status": "ok",
  "count": 5,
  "count_total": 5,
  "pages": 1,
  "posts": [
    {
      "id": 58,
      "type": "post",
      "slug": "another-art-piece",
      "url": "http://bcn2016.local/2016/11/another-art-piece/",
      "status": "publish",
      "title": "Julia II &#8211; Jaume Plensa",
      "title_plain": "Julia II &#8211; Jaume Plensa",
      "content": "<p>BLABLABLA</p>\n<div id=\"viewme-58\"><span>1 <a onclick=\"viewmeaddvote(58);\">View (by View Me)</a></span></div>",
      "excerpt": "<p>BLABLABLA 1 View (by View Me)</p>\n",
      "date": "2016-11-12 12:05:58",
      "modified": "2016-11-19 18:35:51"
    },
    {
      "id": 53,
      "type": "post",
      "slug": "test-vvvvvote",
      "url": "http://bcn2016.local/2016/11/test-vvvvvote/",
      "status": "publish",
      "title": "Punk Love Eagles &#8211; Okuda Sant Miguel",
      "title_plain": "Punk Love Eagles &#8211; Okuda Sant Miguel",
      "content": "<p>asdas</p>\n<div id=\"viewme-53\"><span>2 <a onclick=\"viewmeaddvote(53);\">View (by View Me)</a></span></div>",
      "excerpt": "<p>asdas 2 View (by View Me)</p>\n",
      "date": "2016-11-08 10:30:27",
      "modified": "2016-11-19 18:38:32"
    },
    {
      "id": 37,
      "type": "post",
      "slug": "rating-test",
      "url": "http://bcn2016.local/2016/11/rating-test/",
      "status": "publish",
      "title": "Gemoetria III  – Jaume Millet",
      "title_plain": "Gemoetria III  – Jaume Millet",
      "content": "<p>Geometries</p>\n<div id=\"viewme-37\"><span>1 <a onclick=\"viewmeaddvote(37);\">View (by View Me)</a></span></div>",
      "excerpt": "<p>Geometries 1 View (by View Me)</p>\n",
      "date": "2016-11-06 19:07:26",
      "modified": "2016-11-19 18:41:22"
    },
    {
      "id": 13,
      "type": "post",
      "slug": "constelaciones-moleculares-daniel-orson-ybarra",
      "url": "http://bcn2016.local/2016/11/constelaciones-moleculares-daniel-orson-ybarra/",
      "status": "publish",
      "title": "Brasilia – Laercio Redondo",
      "title_plain": "Brasilia – Laercio Redondo",
      "content": "<p>Algún texto&#8230;. bla bla!</p>\n<div id=\"viewme-13\"><span>2 <a onclick=\"viewmeaddvote(13);\">View (by View Me)</a></span></div>",
      "excerpt": "<p>Algún texto&#8230;. bla bla! 2 View (by View Me)</p>\n",
      "date": "2016-11-05 09:50:07",
      "modified": "2016-11-19 18:43:41"
    },
    {
      "id": 5,
      "type": "post",
      "slug": "she-never-looked-nice-de-jackie-brown",
      "url": "http://bcn2016.local/2016/11/she-never-looked-nice-de-jackie-brown/",
      "status": "publish",
      "title": "She never looked nice &#8211; Jackie Brown",
      "title_plain": "She never looked nice &#8211; Jackie Brown",
      "content": "<p>333</p>\n<div id=\"viewme-5\"><span>4 <a onclick=\"viewmeaddvote(5);\">View (by View Me)</a></span></div>",
      "excerpt": "<p>333 4 View (by View Me)</p>\n",
      "date": "2016-11-03 20:56:20",
      "modified": "2016-11-19 18:45:26"
      }
  ],
  "query": {
    "ignore_sticky_posts": true,
    "order_by": "_viewmecount",
    "order": "DESC",
    "meta_key": "_viewmecount"
  }
}


// test actions
	//send_user_viewing_info('5,13');


// exec
	get_posts();
	
	



})(jQuery);


