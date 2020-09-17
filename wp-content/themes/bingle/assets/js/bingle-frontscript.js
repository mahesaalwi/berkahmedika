jQuery(document).ready(function($) {
	
	'use strict';

	$('.search-wrapper').on('click','.search-icon',function(){
		$(this).parents('.search-wrapper').toggleClass('active');
	});
	$('.sidewidget-wrapper').on('click','.sidewidget-icon',function(e){
		$(this).toggleClass('active');
		$('body').toggleClass('sidemenu-active');
	});

	/* close if clicked outside divs for search and sidemenu */
	$(document).mouseup(function(e) {
		var sidemenu = $(".sidemenuwidget");
		if (!sidemenu.is(e.target) && sidemenu.has(e.target).length === 0) {
			$('.sidewidget-icon').removeClass('active');
			$('body').removeClass('sidemenu-active');
		}
		var searchwrap = $(".search-wrapper");
		if (!searchwrap.is(e.target) && searchwrap.has(e.target).length === 0) {
			searchwrap.removeClass('active');
		}
	});

	$('body').on('click','.menu-toggle',function(){
		$(this).toggleClass('active');
		$(this).next('div').slideToggle();
	});

	$('.header-lay10 li.menu-item-has-children').prepend('<span class="dashicons dashicons-arrow-down-alt2 open-submenu"></span>');

	jQuery('body.header-lay10').on('click','li.menu-item-has-children .open-submenu',function(){
		jQuery(this).siblings('.sub-menu').slideToggle();
		jQuery(this).parent('li').toggleClass('submenu-active');
	});


	if(!$('body').hasClass('footer-lay3')){
		$('#bingle-top').css('right', -65);
		$(window).scroll(function () {
			if ($(this).scrollTop() > 300) {
				$('#bingle-top').css('right', 20);
			} else {
				$('#bingle-top').css('right', -65);
			}
		});
	}

	$("#bingle-top").click(function () {
		$('html,body').animate({scrollTop: 0}, 600);
	});

});