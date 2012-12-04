(function($){
	$('a.mobile_menu_list').bind('tap, click', function(){
		//alert('working');
		if($(this).attr('data-status')=='open'){
			mobileMenu.close($(this));
		} else if($(this).attr('data-status')=='close'){
			mobileMenu.open($(this));
		}
		
		return false;
	});
	
	//$('.nyroModal').nyroModal();
	//$('div.section div.m-column div.page').slimScroll();
	
	$('div.l-column').bind('swipeLeft', function(){
		var nav = $('a.mobile_menu_list');
		if(nav.attr('data-status')=='open'){
			nav.trigger('tap, click');
		}
	});
	
	var mobileMenu = {
		close: function(nav){
			$('div.l-column').removeClass('slideInLeft').bind("animationend webkitAnimationEnd MSAnimationEnd", function(){
				var self = $(this);
				self.unbind("animationend webkitAnimationEnd MSAnimationEnd").addClass('slideOutLeft').bind("animationend webkitAnimationEnd MSAnimationEnd", function(){
					var self = $(this);
					self.unbind("webkitAnimationEnd").removeClass('bounceOutLeft').hide();
				});
			});
			$('div.m-column').removeClass('open slideInLeft').bind("animationend webkitAnimationEnd MSAnimationEnd", function(){
				var self = $(this);
				self.unbind("animationend webkitAnimationEnd MSAnimationEnd").addClass('slideOutLeft').bind("animationend webkitAnimationEnd MSAnimationEnd", function(){
					var self = $(this);
					self.unbind("webkitAnimationEnd").removeClass('slideOutLeft');
				});
			});
			nav.attr('data-status','close');	
		},
		open: function(nav){
			$('div.l-column, div.m-column, footer, header').addClass('open slideInLeft').show();
			nav.attr('data-status','open');
		}
	}
	
	
	/*
	$pos = $('.sandbox').offset().top - 0;
	
	$(window).on('scroll', function(){
		if($(window).scrollTop() >= $pos) {
			$('.sandbox').addClass('fixed');
		} else {
			$('.sandbox').removeClass('fixed');
		}
	});
	*/	
})(jQuery);