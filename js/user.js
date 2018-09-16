function deleteCookie( name ) {
		if( getCookie( name ) ) {
			document.cookie = name + "=" +
				" ;expires=Thu, 01 Jan 1970 00:00:01 GMT";
			}
	}

	function getCookie(name) {
		console.log('getCooooooookie: '+document.cookie);
		var value = "; " + document.cookie;
		console.log(document.cookie);
		var parts = value.split("; " + name + "=");
		if (parts.length == 2) return parts.pop().split(";").shift();
	}

	//get user viewing array
	function get_user_viewing_info() {
		var user_cookie = getCookie('artseeninbcn2016');
		console.log('cookie: '+user_cookie);
		//console.log((new Date%9e6).toString(36).replace(/[0-9]/g, ''));
		if (user_cookie === undefined) {
			console.log('cookie is off');
			return false;
		} else {
			console.log('cookie is on');
			return user_cookie;
		}
	}

	function setCookie(cname, cvalue) {
		console.log('setting');
	    var expires = "expires=Thu, 10 Feb 2017 00:00:01 GMT";
	    document.cookie = cname + "=" + cvalue + " ;" + expires;
	    //document.cookie = cname + "=" + cvalue;
	}

	//set user viewing cookie
	function set_user_viewing_cookie(newVal) {
		console.log(cookieName);
		var user_cookie = getCookie(cookieName);
		if (user_cookie === undefined) {
			console.log('-----setting--undefined-------'+newVal);
			setCookie(cookieName, newVal)
			//document.cookie = 'artseeninbcn2016=123' + ((new Date%9e6).toString(36).replace(/[0-9]/g, '')) + '; expires=Wed, 31 Feb 2017 00:01:00 UTC;';
		} else {
			return user_cookie;
		}
	}