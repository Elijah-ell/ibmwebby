(function ($, root, undefined) {

	$(function () {

		'use strict';

		// DOM ready, take it away

		// fullwidth
        $(window).resize(function(){
			$('.fullwidth').each(function(){
				$(this).width($(window).width());
				var marginLeft = ($(this).parent().width() - $(window).width()) / 2;
				$(this).css({
					'margin-left': marginLeft,
					'opacity' : 1
				});
			});
        }).resize();


		// btn logouts
		$('.btn-logout a').attr('href',logoutlink);

		// select2
		// $('select').select2();
	});

})(jQuery, this);
