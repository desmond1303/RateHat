/*$(document).click(function(e){

	if($(e.target).closest('.header-subnav').length != 0) return false;

	if($(e.target).closest('.nav-categories').length != 0) {

		if ($('.header-subnav').is(":visible")) {

			$('.header-subnav').animate({'top':'-50px'}, 250, 'easeInSine', function() {$(this).hide();});
			$('.nav-categories .fa-angle-down').removeClass('fa-flip-vertical');
			$('.nav-categories').removeClass('subnav-trigger-active');

		}
		else {

			$('.header-subnav').show().animate({'top':'0px'}, 250, 'easeOutSine');
			$('.nav-categories .fa-angle-down').addClass('fa-flip-vertical');
			$('.nav-categories').addClass('subnav-trigger-active');

		}

		return false;
	}

	$('.header-subnav').animate({'top':'-50px'}, 250, 'easeInSine', function() {$(this).hide();});
	$('.nav-categories .fa-angle-down').removeClass('fa-flip-vertical');
	$('.nav-categories').removeClass('subnav-trigger-active');

});*/