$(document).ready (function(){

	$('.team .nav a').on('click', function() {
		var item = $(this);
		var classes = item.find('.pictogram').attr("class").split(/\s/);
		item.parent().toggleClass("active").siblings().removeClass("active");
		$('.teamInfo.' + classes[classes.length -1]).slideToggle().siblings('.teamInfo:visible').slideToggle();
	});

	// Show frame mask
	$(window).resize(function () {
		var maskWidth = ($(this).width() - $('.frame').width()) / 2;
		$('.frameMask').css({width: maskWidth});
		$('.frameMask.left').css({left: -maskWidth});
		$('.frameMask.right').css({right: -maskWidth});
	}).resize();


	// Average Age
	var birthdays = [
		'1985/12/16',
		'1984/12/29',
		'1985/11/02',
		'1985/11/22',
		'1986/7/16',
		'1980/12/26',
		'1984/01/19',
		'1986/8/2'
	];
	var calculateAverageAge = function () {
		var sum = 0;
		var now = new Date().getTime();
		birthdays.forEach(function(birthday) {
			birthday = birthday.split('/');
			birthday = new Date(birthday[0], birthday[1], birthday[2]);
			sum += now - birthday.getTime();
		});
		return (sum / birthdays.length / 1000 / 60 / 60 / 24 / 365).toString().substr(0, 15);
	}

	window.setInterval(function() {
		$('.averageAge').text(calculateAverageAge());
	}, 1000);

	var currentJobCount = 2;
	var menuItem = $("#menu-main a:contains('Jobs')");
	if (currentJobCount > 0) {
		$("<span id='jobCount' />").text(currentJobCount).appendTo(menuItem);
	}

	// rolling links: http://jsdo.it/hakim/rolling-links
	var supports3DTransforms =  document.body.style['webkitPerspective'] !== undefined ||
		document.body.style['MozPerspective'] !== undefined;

	function linkify( selector ) {
		if( supports3DTransforms ) {

			var $nodes = $( selector );

			$nodes.each(function(iterator, node) {
				if ($(node).has('img').length) {
					return;
				}
				if( !node.className || !node.className.match( /roll/g ) ) {
					node.className += ' roll';
					node.innerHTML = '<span data-title="'+ node.text +'">' + node.innerHTML + '</span>';
				}
			});
		}
	}


	linkify( '.entry-content a' );


	// Smooth Scroll: http://css-tricks.com/snippets/jquery/smooth-scrolling/

	function filterPath(string) {
		return string
			.replace(/^\//,'')
			.replace(/(index|default).[a-zA-Z]{3,4}$/,'')
			.replace(/\/$/,'');
	}
	var locationPath = filterPath(location.pathname);
	var scrollElem = scrollableElement('html', 'body');

	$('a[href*=#]').each(function() {
		var thisPath = filterPath(this.pathname) || locationPath;
		if (  locationPath == thisPath
			&& (location.hostname == this.hostname || !this.hostname)
			&& this.hash.replace(/#/,'') ) {
			var $target = $(this.hash), target = this.hash;
			if (target) {
				var targetOffset = $target.offset().top;
				$(this).click(function(event) {
					event.preventDefault();
					$(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
						location.hash = target;
					});
				});
			}
		}
	});

	// use the first element that is "scrollable"
	function scrollableElement(els) {
		for (var i = 0, argLength = arguments.length; i <argLength; i++) {
			var el = arguments[i],
				$scrollElement = $(el);
			if ($scrollElement.scrollTop()> 0) {
				return el;
			} else {
				$scrollElement.scrollTop(1);
				var isScrollable = $scrollElement.scrollTop()> 0;
				$scrollElement.scrollTop(0);
				if (isScrollable) {
					return el;
				}
			}
		}
		return [];
	}

});
