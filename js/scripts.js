$(window).load(function() {

	var page = $('#wrapper');

	//Page animation on load
	setTimeout(function() {
		$('html.js #wrapper').fadeIn(600);
	}, 200);
});

$(document).ready(function() {

	//Remove the no-js class if it exists
	var docElement = document.documentElement;
	docElement.className = docElement.className.replace(/\bno-js\b/, 'js');

	//Put the page into a variable
	var page = $('#wrapper');

	//If it's a HiDPI display, replace the favicon with the @2x favicon

	if(window.devicePixelRatio == 2) {
		var favicon = $('link[rel="shortcut icon"]');

			for(var i = 0; i < favicon.length; i++) {

				var imageType = favicon[i].href.substr(-4);
				var imageName = favicon[i].href.substr(0, favicon[i].href.length - 4);
				imageName += "@2x" + imageType;

				favicon[i].href = imageName;

			}
	}

	//IE Scripts for CSS

		/*
		I'm gonna be honest with you; I hate continuously writing nth-child scripts.

		So, I'm going to give them a class instead. Particularly since I don't jQuery likes percentages.
		*/

			//Add classes per navigation item.

			$('html.lt-ie9 nav[role="navigation"] ul li:nth-child(1)').addClass('navigation-item-1');
			$('html.lt-ie9 nav[role="navigation"] ul li:nth-child(2)').addClass('navigation-item-2');
			$('html.lt-ie9 nav[role="navigation"] ul li:nth-child(3)').addClass('navigation-item-3');
			$('html.lt-ie9 nav[role="navigation"] ul li:nth-child(4)').addClass('navigation-item-4');

			//Add classes per social link item
			$('html.lt-ie9 nav.social-networking ul li:nth-child(1) a').addClass('twitter');
			$('html.lt-ie9 nav.social-networking ul li:nth-child(2) a').addClass('dribbble');
			$('html.lt-ie9 nav.social-networking ul li:nth-child(3) a').addClass('forrst');
			$('html.lt-ie9 nav.social-networking ul li:nth-child(4) a').addClass('facebook');

			$('html.lt-ie9 ol#portfolio li a aside').hide();

				$('html.lt-ie9 ol#portfolio li a').hover(function() {
					$(this).find('aside').show();
				});

	$('article.portfolio-item').closest('body').addClass('view-item');

	//Twitter plugin
	//---see http://www.queness.com/post/8567/create-a-dead-simple-twitter-feed-with-jquery
	iainsTweets = {
		user: 'iainspad',
		numTweets: 3,
		appendTo: 'ul.tweets',

		loadTweets: function() {
			$.ajax({
				url: 'http://api.twitter.com/1/statuses/user_timeline.json/',
				type: 'GET',
				dataType: 'jsonp',
				data: {
					screen_name: iainsTweets.user,
					include_rts: true,
					count: iainsTweets.numTweets,
					include_entities: true
				},
				success: function(data, textStatus, xhr) {
					var html = '<li>tweet<span>time</span></li>';
					for(var i = 0; i < data.length; i++ ){
						$(iainsTweets.appendTo).append(
							html.replace('tweet', iainsTweets.ify.clean(data[i].text))
								.replace(/USER/g, data[i].user.screen_name)
								.replace('time', iainsTweets.timeAgo(data[i].created_at))
								.replace(/ID/g, data[i].id_str)
						);
					}
				}
			});
		},

		timeAgo: function(dateString) {
			var rightNow = new Date();
			var then = new Date(dateString);

			if (navigator.userAgent.match(/MSIE/i)) {
				then = Date.parse(dateString.replace(/( \+)/, ' UTC$1'));
			}

			var timeDiff = rightNow - then;

			var second = 1000,
				minute = second * 60,
				hour = minute * 60,
				day = hour * 24,
				week = day * 7;

			if (isNaN(timeDiff) || timeDiff < 0) {
				return ""; //Return blank if string is unknown
			}
			if (timeDiff < second * 2) {
				return "right now";
			}
			if (timeDiff < minute) {
				return Math.floor(timeDiff / second) + " seconds ago";
			}
			if (timeDiff < minute * 2) {
				return "about a minute ago";
			}
			if (timeDiff < hour) {
				return Math.floor(timeDiff / minute) + " minutes ago";
			}
			if (timeDiff < hour * 2) {
				return "about an hour ago";
			}
			if (timeDiff < day) {
				return Math.floor(timeDiff / hour) + " hours ago";
			}
			if (timeDiff > day && timeDiff < day * 2) {
				return "yesterday";
			}
			if (timeDiff < day * 365) {
				return Math.floor(timeDiff / day) + " days ago";
			}
			else {
				return "over a year ago";
			}
		},

		ify: {
			link: function(tweet) {
				return tweet.replace(/\b(((https*\:\/\/)|www\.)[^\"\']+?)(([!?,.\)]+)?(\s|$))/g, function(link, m1, m2, m3, m4) {
					var http = m2.match(/w/) ? 'http://' : '';
					return '<a target="blank" href="' + http + m1 + '">' + ((m1.length > 25) ? m1.substr(0, 24) + '...' : m1) + '</a>' + m4;
				});
			},
			at: function(tweet) {
				return tweet.replace(/\B[@＠]([a-zA-Z0-9_]{1,20})/g, function(m, username) {
					return '<a target="blank" href="http://twitter.com/intent/user?screen_name=' + username + '">@' + username + '</a>';
				});
			},
			hash: function(tweet) {
				return tweet.replace(/(^|\s+)#(\w+)/gi, function(m, before, hash) {
					return before + '<a target="blank" class="teal" href="http://twitter.com/search?q=%23' + hash + '">#' + hash + '</a>';
				});
			},

			clean: function(tweet) {
				return this.hash(this.at(this.link(tweet)));
			}
		}
	};

	//Start the tweet plugin!! GO GO GO!!
	iainsTweets.loadTweets();

	//Prettify
	$('pre > code').addClass('prettyprint linenums');

		$('pre[rel="html"] > code').addClass('lang-html');
		$('pre[rel="css"] > code').addClass('lang-css');
		$('pre[rel="js"] > code').addClass('lang-js');
		$('pre[rel="php"] > code').addClass('lang-php');

	prettyPrint();

	//Page Animations

		//UX controls
			//---Left and Right key navigation between posts

			$('body.single').keydown(function(e) {
				var url = false;
					key = e.which;
				if(key == 37) {
					var prev = $('#portfolio-navigation ul li a[rel="prev"]');
					url = $(prev).attr('href');
					$(prev).css({
						'opacity' : '1',
						'margin-left' : '10px'
					}).animate(300);
				} else if (key == 39) {
					var next = $('#portfolio-navigation ul li a[rel="next"]'); 
					url = $(next).attr('href');
					$(next).css({
						'opacity' : '1',
						'margin-right' : '10px'
					}).animate(300);
				}
				if (url) {
					$(page).delay(100).fadeOut(400);
					setTimeout(function() {window.location = url}, 600);
				}
			});

		//Page animation upon anchor click
		$('body.site a').click(function(e) {
			var url = $(this).attr('href');
				target = $(this).attr('target');
			if(url && target != 'blank'){
				$(page).delay(100).animate({opacity: 0}, 600, function() {
					setTimeout(function() {window.location = url}, 600);
				});
				return false;
			}
		});


	//If the browser does not support HTML5 placeholders(We're looking at you, IE 8 + 7)
	$('html-lt.ie9 [placeholder]').focus(function() {
		var field = $(this);
		if (field.val() == field.attr('placeholder')) {
			field.val('');
			field.removeClass('placeholder');
		}
	}).blur(function() {
		var field = $(this);
		if(field.val() == '' || field.val() == field.attr('placeholder')) {
			field.addClass('placeholder');
			field.val(field.attr('placeholder'));
		}
	}).blur();


	//Form Validation via AJAX

	$('.error').hide();

		$('#contact-form').submit(function() {

			var form = $('form#contact-form'),
				name = $('input#name'),
				email = $('input#email'),
				message = $('textarea#message'),
				hasError = false;

				if(name.val() == '') {
					hasError = true;
					$('.error').show();
					$('.error ul').append('<li>You have not entered a name.</li>');
					return false;
				}

				if(email.val() == '') {
					hasError = true;
					$('.error').show();
					$('.error ul').append('<li>You haven\'t entered an E-mail address.</li>');
					return false;
				}

				if(message.val() == '') {
					hasError = true;
					$('.error').show();
					$('.error ul').append('<li>You haven\'t entered a message.</li>');
					return false;
				} else if(message.val().length < 20) {
					hasError = true;
					$('.error').show();
					$('.error ul').append('<li>Your message must be greater than 20 characters.</li>');
					return false;
				}

				var dataString = $(this).serialize();

				$.ajax({
					type: "POST",
					url: form.attr('action'),
					data: dataString,
					success: function() {
						$(form).before('<div class="success"><h5>Thanks ' + name.val() + '! Your E-mail has been sent.</h5></div>');
						$('.error').hide();
					}
				});
			return false;
		});

});