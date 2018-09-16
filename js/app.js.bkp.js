(function($) {

	// DOM
	var allContainer = "#art-viewer";
	var slider = "#tinderslide";
	var sliderList = "#tinderslideList";
	var cookieName = "artseeninbcn2016";
	var loaderDisplay = "#loader-percentage";
	// var savingMessage = "#savingMessage";
	var thankYouSlide = "#thankYouSlide";
	var savedVotes= "#savedVotes";
	var unsavedVotes= "#unsavedVotes";
	// var saveVotes = "#saveVotes";
	// var saveVotesText = "#saveVotesText";
	// var saveVotesSaved = "#saveVotesSaved";
	// var saveVotesContainer = "#saveVotesContainer";
	var counterContainer = "#counterContainer";
	var totalContainer = "#totalContainer";
	// var resetVotes = "#resetVotes";
	var hideOnLast = ".hide-on-last";
	var dislike = ".dislike-action";
	var like = ".like-action";
	var previewOnly = "#previewOnly";
	var previewOnlyBtn = "#previewOnly_btn";
	var howToIntro = "#howToIntro";
	var rankingContainer = "#ranking_container";
	var expoContainer = "#expo_container";

	//constans
	var maxImages = 12;
	var winningImages = 100;
	var maxPreloadImages = 10;
	var voteOpen = true;

	// variables
	var post_query;
	var posts;
	var image_loader = 0;
	var imgCounter = 1;
	// var hasNewVotes = false;
	var showdemotour = false;



	//-----------------------------------------

	// INITIALIZE

	//-----------------------------------------

	function initialize(post_query) {


		var previous_actions = get_user_viewing_info();
		var cookie_actions = getCookie('uviews');
		var cookie_votes = getCookie('uvotes');
		var info = savedVotes;

		if (voteOpen) {
			// post display
			// if there are no previous actions but a cookie, load them from cookie
			if ((previous_actions == '0') && (cookie_actions != undefined)) {
				console.log('cookie beeing read');
				user_viewing_data = cookie_actions;
				user_voting_data = cookie_votes;
				previous_actions = cookie_actions.split(',');
				info = unsavedVotes;
			}

			// there are no previous actions, setup slider and determine whether to show demo
			if (previous_actions == '0') {
				preload_images(post_query);
				$(loaderDisplay).on('asi.allLoaded', function() {
					print_posts(post_query);
					slider_setup();
				});
				showdemotour = true;

			// if there are previous actions, setup slider excluding viewed posts and inform user
			} else if (previous_actions instanceof Array) {
				preload_images(post_query);
				$(loaderDisplay).on('asi.allLoaded', function() {
					console.log('init');
					print_posts(clean_post_array(previous_actions, post_query));
					slider_setup();
				});
				inform_user(info);

			// if previous actions is "done"
			} else {
				// ***REFACTOR*** print in slider, not in jTinder
				//clean_screen();
				preview_only();
			}

			// event setup
			// saves viewing and voting into DB ***REMOVE***
			// $(saveVotes).on('click', function() {
			// 	save_views_votes(user_viewing_data, user_voting_data); // removed function
			// });

			// marks state as unsaved votes and informs user ***REMOVE***
			// $(allContainer).on('asi.newVotes', function() {
			// 	console.log('asi.newVotes');
			// 	if (hasNewVotes == true) {
			// 		$(saveVotesSaved).hide();
			// 		$(saveVotesText).show();
			// 	} else {
			// 		$(saveVotesText).hide();
			// 		$(saveVotesSaved).show();
			// 	}
			// 	$(saveVotesContainer).show();
			// });

			// reinit voting ***REMOVE***
			// $(resetVotes).on('click', function() {
			// 	reinit();
			// });

			// like binding
			$(like).on('click', function() {
				$(slider).jTinder('like');
			});
			// dislike binding
			$(dislike).on('click', function() {
				$(slider).jTinder('dislike');
			});
			// intro ani
			$('#howToIntro').removeClass('logoin');
			var tt = setTimeout(function(){
				$('#howToIntro').addClass('logoout');
			}, 8);
			// start button binding: hide intro, show demo if required ***TODO: disable jTinder during demo***
			$('.vote-start').on('click tap', function() {
				$('#howToIntro').fadeOut();
				if (showdemotour) {
					demoTour();
				}
			});
			// language chooser
			$('.ctrl-btn.es-ca').on('click', function() {
				$('body').removeClass('es-es');
				$('body').removeClass('en-en');
				$('body').addClass('es-ca');
			});
			$('.ctrl-btn.es-es').on('click', function() {
				$('body').removeClass('es-ca');
				$('body').removeClass('en-en');
				$('body').addClass('es-es');
			});
			$('.ctrl-btn.en-en').on('click', function() {
				$('body').removeClass('es-ca');
				$('body').removeClass('es-es');
				$('body').addClass('en-en');
			});
			// project info slideup on bottom bar
			$('.site-branding').on('click', function() {
				$(this).toggleClass('open');
			});
			// disable sliding behaviour when clicking links in project info
			$('.site-branding .share-container a, .site-branding .project-info a').on('click', function(e) {
				e.stopPropagation();
			});

		// vote is not open, print winners, print ranking, set to viewing only
		} else {
			//print_winners(post_query);
			//print_ranking(post_query);
		}
		console.log('user_viewing_data on init: ' + user_viewing_data);
	}

	function slider_setup() {
		// if post in query, show requested post
		show_start_post();
		// if all posts are through, hide messages and start finish actions ***REMOVE***
		if (imgCounter >= maxImages) {
			$(unsavedVotes).hide();
			$(savedVotes).hide();
			finish(user_voting_data);
		}
		// update image counter
		$(counterContainer).html(imgCounter);
		$(totalContainer).html(maxImages);
		// setup jTinder ***REFACTOR*** this needs to distinguish preview-only state!
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
		// add viewing state to visible post
		$('.slider-image:last-child').addClass('viewing');
		// write sharing links into footer ***REFACTOR***
		$('.fbshare-action').attr("href", $('.viewing .share-fb').attr('href'));
		$('.washare-action').attr("href", $('.viewing .share-wa').attr('href'));
		$('.twshare-action').attr("href", $('.viewing .share-tw').attr('href'));
		// write post content into more-viewer, set up more-viewer events ***REFACTOR***
		$('.more-viewer .more-viewer-inner').html($('.viewing .more').html());
		$('.more-viewer .more-viewer-inner').data('postid', $('.viewing').data('postid'));
		$('#tinderslide').on('click touchstart', '.more-action', function(e) {
			e.preventDefault();
			$(this).toggleClass('open');
			$('.more, .more-viewer').toggleClass('show');
			var p_id = $('.more-viewer').data('postid');
			// google analytics event ***REFACTOR***
			if ($('.more').hasClass('show')) {
				//window.dataLayer.push({'event': 'clickOnMore', 'postid': p_id});
			}
		});
		// deactivate jTinder events on slide info
		$('#tinderslide').on('touchstart mousedown touchmove mousemove touchend mouseup', '.content', function(e) {
			e.stopPropagation();
		});	
	}


	// ***REFACTOR***: no previeOnlyBtn, show message and setup slider in previw-only mode!
	function preview_only() {
		console.log('prev');
			$(previewOnlyBtn).on('click', function() {
				preload_images(post_query);
				$(loaderDisplay).on('asi.allLoaded', function() {
					print_posts(post_query);
					slider_setup();
				});
			});
			$(previewOnly).show();
		console.log('prev2');
	}

	function demoTour() {
		// generate html part 1
		var demo1 =  '<div class="demo-tour slide-dimension">';
		demo1 += '<span class="demo-pill"><span class="demo--1"><span class="lang-ca">Arrastra la imatge per votar</span>';
		demo1 += '<span class="lang-es">Arrastra la imagen para votar</span>';
		demo1 += '<span class="lang-en">Drag the image to vote</span></span>';
		demo1 += '<span class="demo--2"><span class="lang-ca">A la dreta si t\'agrada</span>';
		demo1 += '<span class="lang-es">A la derecha si te gusta</span>';
		demo1 += '<span class="lang-en">To the right if you like it</span></span>';
		demo1 += '<span class="demo--3"><span class="lang-ca">A l\'esquerra per descartar</span>';
		demo1 += '<span class="lang-es">A la izquierda para descartar</span>';
		demo1 += '<span class="lang-en">To the left to dismiss it</span></span></span>';
		demo1 += '<span class="demo--4 demo-pill"><span class="lang-ca">O utilitza els botons</span>';
		demo1 += '<span class="lang-es">O utiliza los botones</span>';
		demo1 += '<span class="lang-en">Or use the buttons</span></span></div>';

		// generate html part 2
		var demo2 = '<span class="demo--5 demo-pill"><span class="lang-ca">Més info sobre l\'obra</span>';
		demo2 += '<span class="lang-es">Más info sobre la obra</span>';
		demo2 += '<span class="lang-en">More info about the work</span></span>';

		// generate html part 3
		var demo3 = '<span class="demo--6 demo-pill"><span class="lang-ca">Comparteix el que t\'agrada</span>';
		demo3 += '<span class="lang-es">Comparte lo que te gusta</span>';
		demo3 += '<span class="lang-en">Share if you like it</span></span>';

		// generate html part 4
		var demo4 = '<span class="demo--7 demo-pill"><span class="lang-ca">Més info sobre la iniciativa</span>';
		demo4 += '<span class="lang-es">Más info sobre la iniciativa</span>';
		demo4 += '<span class="lang-en">More info about the initiative</span></span>';

		// append html to correct elements
		$('.viewing').append(demo1);
		$('.viewing .more-action').append(demo2);
		$('.share-container').append(demo3);
		$('.logo-container').append(demo4);

		// hide demo elements after animation is over ***REFACTO***: needs to also reactivate jTinder functionality (see line 129)
		var tt = setTimeout(function(){
			$('.demo-tour, .demo-pill').hide();
		}, 22000);

	}


	//-----------------------------------------

	// HANDLE POSTS

	//-----------------------------------------

	//get posts ordered by view count from DB and initialize on success ***REFACTOR*** needs to check if voting open and if not, do orderby comments count
	function get_posts() {
		var wpQueryString;
		if(voteOpen) {	
			wpQueryString = 'get_posts?orderby=meta_value&meta_key=_viewmecount&order=DESC&count=12';
		} else {
			wpQueryString = 'get_posts?orderby=meta_value&meta_key=_viewmecount&order=DESC&count=12';
		}
		$.ajax({
				url: AppAPI.url + wpQueryString,
				dataType: 'json',
				success: function( resp ) {
					post_query = resp['posts'];
					console.log(post_query);
					initialize(post_query);
				},
				error: function( req, status, err ) {
					console.log( 'something went wrong', status, err );
				}
			});
	}

	//preload images
	function preload_images(post_query) {
		// first check if there is a startpost and if yes, preload it
		var pid = getCookie('pid');
		if (pid !== undefined) {
			$.each(post_query, function(index, post) {
				if (post.id == pid) {
					var img = new Image();
					img.src = post.thumbnail_images.full.url;
				}
			});
		}
		console.log('loading images');
		//get last 10 images and load them
		var last10 = post_query.slice(-10);
		$.each(last10, function(index, post) {
		console.log(post.thumbnail_images.full.url);
			var img = new Image();
			img.src = post.thumbnail_images.full.url;
		    img.onload = update_loader;
		});
		return true;	
	}

	//update loader
	function update_loader() {
		image_loader+=10;
		$(loaderDisplay).html(image_loader);
		if (image_loader == maxPreloadImages) {
			$(loaderDisplay).trigger('asi.allLoaded');
		}
		return true;	
	}

	//generate html for jTinder and print posts if voteOK (IP and cookie detection)
	function print_posts(posts) {
		console.log('printing posts');
		var html = '';
		$.each(posts, function(index, element) {
		    html+='<li class="slider-image slide-dimension panel'+index+'" id="p'+posts[index].id+'" data-postid="'+posts[index].id+'">';
		    html+='<div class="img';
		    html+=(index > (posts.length - 3)) ? ' img-load' : '';
		    html+='" style="background-image: url('+posts[index].thumbnail_images.full.url+');"><div class="loader"><div class="ball-clip-rotate"><div></div></div></div></div>';
		    //html+='<img class="img" width="450" height="450" src="'+posts[index].thumbnail_images.full.url+'"/>';
		    html+='<div class="content">';
		    html+='<div class="artist shdw-t-grey">'+posts[index].custom_fields.asiArtista[0]+'</div>';
		    html+='<div class="title shdw-t-grey">'+posts[index].custom_fields.asiTitulo[0]+'</div>';
		    html+='<div class="visto shdw-t-grey"><span class="lang-ca">Vist a:</span><span class="lang-es">Visto en:</span><span class="lang-en">Seen at:</span> '+posts[index].custom_fields.asiVisto[0]+'</div><span class="more-action shdw-t-grey"></span>';
		    html+='<div class="share">';
		    html+='<a href="https://www.facebook.com/sharer/sharer.php?u='+posts[index].custom_fields.asiCompartir[0]+'?utm_source=fbshare" class="share-fb">fb</a>';
		    html+='<a href="whatsapp://send?text='+posts[index].custom_fields.asiCompartir[0]+'?utm_source=washare" class="share-wa">wa</a>';
		    html+='<a href="https://twitter.com/home?status='+posts[index].custom_fields.asiCompartir[0]+'?utm_source=twshare" class="share-tw">tw</a>';
		    html+='</div></div>';
		    html+='<div class="more slide-dimension"><p class="art-work-info"><span class="title">'+posts[index].custom_fields.asiTitulo[0]+'</span><br/>de '+posts[index].custom_fields.asiArtista[0]+'</p>'+posts[index].content+'</div>';
		    html+='<div class="icon-heart-shape-outline like slide-dimension shdw-b-grey"></div><div class="icon-x dislike slide-dimension shdw-b-grey"></div></li>';
		});
		// check for the voteOK variable set by php
		if ( voteOK ) {
			$(sliderList).html(html);
			return true;
		}
	}

	//print winning posts as slider ***REFACTOR*** for viewing only state during voting
	function print_winners(posts) {
		console.log('printing posts');
		var last25 = post_query.slice(-25);
		var html ='<div class="my-slider"><ul>';
		$.each(last25, function(index, element) {
			html+='<li>' + posts[index].custom_fields.asiArtista[0] + '</li>';
		});
		html+='</ul></div>';
		$(expoContainer).html(html);
		$('.my-slider').unslider();
		return true;
	}

	//print ranking 
	function print_ranking(posts) {
		console.log('printing ranking');
		var html = '<ol>';
		$.each(posts, function(index, element) {
		    html+='<li><div class="content">';
		    html+='<div class="title">'+posts[index].custom_fields.asiArtista[0]+'</div>';
		    html+='<div class="visto">'+posts[index].custom_fields.asiVisto[0]+'</div>';
		    html+='</div></li>';
		});
		html+='</ol>';
		$(rankingContainer).html(html);
		return true;
	}


	//remove all posts already viewed
	function clean_post_array(user_viewing_array, post_query) {
		console.log('cleaning posts');
		var posts = post_query.filter(function(post) {
		  return user_viewing_array.indexOf(post['id']+'') == -1;
		});
		return posts;
	}

	//check for cookie pid and if present, set start post
	function show_start_post() {
		console.log('show start post');
		var pid = getCookie('pid');
		if (pid === undefined) {
			return false;
		} else {
			$('#p'+pid).insertAfter($('.slider-image:last-child')).find('.img').addClass('img-load');
			return true;
		}
	}



	//-----------------------------------------

	// HANDLE USER VIEWING INFO

	//-----------------------------------------

	// checks to set viewing state: new, done or return an array
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

	// creating string array with viewing info or adding new post to it
	function add_post_to_viewing_data(post_id) {
		// ***REFACTOR*** this probably needs to be "user_viewing_data !== undefined" or "user_viewing_data.length <= 0"
		if ((user_viewing_data == undefined) || (user_viewing_data.length > 0)) {
			user_viewing_data += ',' + post_id;
		} else {
			user_viewing_data += post_id;
		}
		return true;
	}

	// ***REMOVE*** creating string array with voting info or adding new post to it 
	// function add_post_to_voting_data(post_id) {
	// 	// ***REFACTOR*** this probably needs to be "user_voting_data !== undefined" or "user_voting_data.length <= 0"
	// 	if ((user_voting_data == undefined) || (user_voting_data.length > 0)) {
	// 		user_voting_data += ',' + post_id;
	// 	} else {
	// 		user_voting_data += post_id;
	// 	}
	// 	return true;
	// }


	//inform user that they have already started voting
	function inform_user(elem) {
		$(elem).show();
		var tt = setTimeout(function(){
			$(elem).hide();
		}, 10000);
	}


	//-----------------------------------------

	// HANDLE SWIPE

	//-----------------------------------------

	//save post view to local array and cookie ***REFACTOR*** this is probably not needed or it should save view also to DB
	function save_post_view(post_id) {
		console.log('!!!save post view');
		add_post_to_viewing_data(post_id);
		setCookie('uviews', user_viewing_data);
		// save viewing array in cookie

		return true;
	}

	//save post vote as cookie ***REFACTOR*** this is probably not needed, it should save vote as comment instead
	function save_post_vote(post_id) {
		// add_post_to_voting_data(post_id); // removed function
		setCookie('uvotes', user_voting_data);
		return true;
	}

	//update markup on slide change
	function update_viewing_class(post_id) {
		// preload next image
		$('.img-load:first-of-type').parent().prev().find('.img').addClass('img-load');
		// close more-info, if open
		$('.more, .more-viewer').removeClass('show');
		//switch viewing class
		$('#p'+post_id).removeClass('viewing');
		$('#p'+post_id).prev().addClass('viewing');
		//load new slide content into actions section
		$('.fbshare-action').attr("href", $('.viewing .share-fb').attr('href'));
		$('.washare-action').attr("href", $('.viewing .share-wa').attr('href'));
		$('.twshare-action').attr("href", $('.viewing .share-tw').attr('href'));
		$('.more-viewer .more-viewer-inner').html($('.viewing .more').html());
		$('.more-viewer .more-viewer-inner').data('postid', $('.viewing').data('postid'));
		return true;
	}

	//actions on dismissing ***REFACTOR*** update viewing, save view into DB, update cookie 
	function on_dismiss(post_id) {
		console.log('viewing cookie: ' + user_viewing_data);
		// update jTinder view
		update_viewing_class(post_id);
		// ***ADD*** save to cookie or call save_post_veiw
		//save_post_view(post_id);
		// ***REMOVE****
		//checkNewVotes(1);
		// save view to DB
		viewmeviewvotestore(post_id, 0);
		// update counter
		update_image_counter();
		return true;
	}

	function on_like(post_id) {
		update_viewing_class(post_id);
		// ***ADD*** save to cookie or call save_post_veiw
		//save_post_view(post_id);
		//save_post_vote(post_id);
		// ***REMOVE****
		//checkNewVotes(1);
		// save view to DB and generate comment
		viewmeviewvotestore(post_id, 1);
		// update counter
		update_image_counter();
		return true;
	}

	// ***REMOVE**** this was only needed to show message that saving is needed
	// function checkNewVotes(toggle) {
	// 	console.log('checking new votes');
	// 	if (toggle != hasNewVotes) {
	// 		hasNewVotes = toggle;
	// 		$(allContainer).trigger('asi.newVotes');
	// 	}
	// }

	function update_image_counter() {
		// if all images are viewed, do finish actions
		if (imgCounter >= maxImages) {
			$(unsavedVotes).hide();
			$(savedVotes).hide();
			finish(user_voting_data);
		} else {
			// update counter		
			imgCounter++;
			$(counterContainer).html(imgCounter);
		}
	}



	//-----------------------------------------

	// HANDLE COOKIES

	//-----------------------------------------
	
	//helper function to get cookie content by name
	function getCookie(name) {
		var value = "; " + document.cookie;
		var parts = value.split("; " + name + "=");
		if (parts.length == 2) return parts.pop().split(";").shift();
	}

	function setCookie(cname, cvalue) {
	    var expires = "expires=Thu, 10 Feb 2018 00:00:01 GMT";
	    document.cookie = cname + "=" + cvalue + " ;" + expires;
	}

	function deleteCookie(cname) {
	  	document.cookie = cname + '=done; expires=Thu, 01 Jan 1975 00:00:01 GMT;';
	}



	//-----------------------------------------

	// HANDLE ABORT AND FINISH

	//-----------------------------------------

	// actions on exit ***REMOVE*** bulk DB save is not needed anymore
	// function save_views_votes(user_viewing_data, user_voting_data) {
	// 	viewmeusersave(user_viewing_data, user_voting_data);
	// 	//checkNewVotes(0);
	// 	//alert_user
	// 	return null;
	// }

	// actions on exit ***REFACTOR*** what does hideOnLast hide?
	function clean_screen() {
		$(hideOnLast).hide();
		$(thankYouSlide).show();
		$(allContainer).addClass('finished');
		return true;
	}
 
	//display thanks
	function finish(user_voting_data) {
		$(sliderList).html('<li class="info-slide"><div class="saving shdw-t-brown"><span class="lang-ca">Gràcies per participar!</span><span class="lang-es">¡Gracias por participar!</span><span class="lang-en">Thanks for taking part!</span></li>');
		// ***REMOVE*** bulk save to DB is not needed anymore
		// viewmesave(user_viewing_data, user_voting_data);
		// ***REFACTOR*** not waiting for asi.saved anymore
		$(document).on('asi.saved', function() {			
			console.log('asi.saved has been fired!');
			// save_views_votes('done', user_voting_data); // removed function
			// $(saveVotesContainer).hide();
			clean_screen();
			// ***REFACTOR*** cookies should not be deleted but set to 'done'
			deleteCookie('uviews');
			deleteCookie('uvotes');
			// ***REMOVE*** duplicte from clean_screen?
			$(hideOnLast).hide();
		});
		return true;
	}

	// ***REMOVE*** reinit not possible anymore
	// function reinit() {
	// 	deleteCookie('uviews');
	// 	deleteCookie('uvotes');
	// 	location.reload();
	// }

// EXEC!!!!!!
get_posts();
	
})(jQuery);