$(document).ready(function() {
	//Remove the no-js class if it exists
	var docElement = document.documentElement;
	docElement.className = docElement.className.replace(/\bno-js\b/, 'js');

	//Also add useragent and platform data attributes to the html element
	//---see http://rog.ie/post/9089341529/html5boilerplatejs

	docElement.setAttribute('data-useragent', navigator.userAgent);
	docElement.setAttribute('data-platform', navigator.platform);

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

			$('html.lt-ie9 ol#portfolio li:nth-child(2)').addClass('2-column-rowend');
			$('html.lt-ie9 ol#portfolio li:nth-child(4)').addClass('2-column-rowend');
			$('html.lt-ie9 ol#portfolio li:nth-child(6)').addClass('2-column-rowend');

			$('html.lt-ie9 ol#portfolio li:nth-child(3)').addClass('3-column-rowend');
			$('html.lt-ie9 ol#portfolio li:nth-child(6)').addClass('3-column-rowend');

			$('html.lt-ie ol#portfolio li a aside').hide();

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

			if ($.browser.msie) {
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
	
		//Page animation on load
		var page = $('#wrapper');
		$(page).delay(500).animate({opacity: 1}, 600);

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
					$(page).delay(100).animate({opacity: 0}, 600);
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
});