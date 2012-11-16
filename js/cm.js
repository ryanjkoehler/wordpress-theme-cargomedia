$(document).ready (function(){

	$('.team .nav a').on('click', function() {
		var item = $(this);
		var classes = item.find('.pictogram').attr("class").split(/\s/);
		item.parent().toggleClass("active").siblings().removeClass("active");
		$('.teamInfo.' + classes[classes.length -1]).slideToggle().siblings('.teamInfo:visible').slideToggle();
	});


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
});
