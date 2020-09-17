/**
 * Extended File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

 ( function( $ ) {

 	'use strict';

 	var api = wp.customize;

 	function bingle_dynamic_css_targets( value ) {
 		var css_styles_targets = '<style id="customizer_dynamic_css_' + value + '" type="text/css"></style>';
 		if ( ! $( '#customizer_dynamic_css_' + value ).length) {
 			$( '#bingle_main_css-inline-css' ).after( css_styles_targets );
 		}
 	}

 	// container wrapper width.
 	api( 'bingle_container_width', function(value) {
 		value.bind(function(newval) {
 			bingle_dynamic_css_targets( 'bingle_container_width' );
 			var width = '.bingle-wrapper { width: ' + newval + 'px; }';
 			$( '#customizer_dynamic_css_bingle_container_width' ).text( width );

 		});
 	});

	// Page section margin and padding.
	api( 'bingle_container_marginpadding', function(value) {
		value.bind(function(newval) {
			bingle_dynamic_css_targets( 'bingle_container_marginpadding' );
			var values_array = newval.split(', ');
			values_array = values_array.map(function(item,key) { // Replaces '-' with '0'
				if(key > 3){
					return '-' === item ? '0px' : item + 'px ';
				}else{
					return '-' === item ? 'auto' : item + 'px ';
				}
			});
			var style = '.bingle-container { margin: ' + values_array[0] + ' ' + values_array[1] + ' ' + values_array[2] + ' ' + values_array[3] + '' + '; padding: ' + values_array[4] + ' ' + values_array[5] + ' ' + values_array[6] + ' ' + values_array[7] + '' + ' ;}';
			$( '#customizer_dynamic_css_bingle_container_marginpadding' ).text( style );

		});
	});

	$.each(['top','main','bottom'], function( index,secvalue ) {
		
		// background color.
		api( 'bingle_header_bkgcolor_'+secvalue+'_header', function(value) {
			value.bind(function(newval) {
				bingle_dynamic_css_targets( 'bingle_header_bkgcolor_'+secvalue+'_header' );
				var newcolor = '.'+secvalue+'-header.bingle-header-container { background-color: ' + newval + ' !important; }';
				$( '#customizer_dynamic_css_bingle_header_bkgcolor_'+secvalue+'_header' ).text( newcolor );

			});
		});

		// wrapper width.
		api( 'bingle_header_width_'+secvalue+'_header', function(value) {
			value.bind(function(newval) {
				bingle_dynamic_css_targets( 'bingle_header_width_'+secvalue+'_header' );
				var width = '.'+secvalue+'-header-bingle-wrapper { width: ' + newval + 'px; margin: 0 auto; }';
				$( '#customizer_dynamic_css_bingle_header_width_'+secvalue+'_header' ).text( width );

			});
		});

		// section margin and padding.
		api( 'bingle_header_marginpadding_'+secvalue+'_header', function(value) {
			value.bind(function(newval) {
				bingle_dynamic_css_targets( 'bingle_header_marginpadding_'+secvalue+'_header' );
				var values_array = newval.split(', ');
			values_array = values_array.map(function(item,key) { // Replaces '-' with '0'
				if(key > 3){
					return '-' === item ? '0px' : item + 'px ';
				}else{
					return '-' === item ? 'auto' : item + 'px ';
				}
			});
			var style = '.'+secvalue+'-header.bingle-header-container { margin: ' + values_array[0] + ' ' + values_array[1] + ' ' + values_array[2] + ' ' + values_array[3] + '' + '; padding: ' + values_array[4] + ' ' + values_array[5] + ' ' + values_array[6] + ' ' + values_array[7] + '' + ' ;}';
			$( '#customizer_dynamic_css_bingle_header_marginpadding_'+secvalue+'_header' ).text( style );

		});
		});

	});

	$.each(['top','main'], function( index,secvalue ) {
		
		// background color.
		api( 'bingle_footer_bkgcolor_'+secvalue+'_footer', function(value) {
			value.bind(function(newval) {
				bingle_dynamic_css_targets( 'bingle_footer_bkgcolor_'+secvalue+'_footer' );
				var newcolor = '.'+secvalue+'-footer.bingle-footer-container { background-color: ' + newval + '; }';
				$( '#customizer_dynamic_css_bingle_footer_bkgcolor_'+secvalue+'_footer' ).text( newcolor );

			});
		});

		// wrapper width.
		api( 'bingle_footer_width_'+secvalue+'_footer', function(value) {
			value.bind(function(newval) {
				bingle_dynamic_css_targets( 'bingle_footer_width_'+secvalue+'_footer' );
				var width = '.'+secvalue+'-footer-bingle-wrapper { width: ' + newval + 'px; margin: 0 auto; }';
				$( '#customizer_dynamic_css_bingle_footer_width_'+secvalue+'_footer' ).text( width );

			});
		});

		// section margin and padding.
		api( 'bingle_footer_marginpadding_'+secvalue+'_footer', function(value) {
			value.bind(function(newval) {
				bingle_dynamic_css_targets( 'bingle_footer_marginpadding_'+secvalue+'_footer' );
				var values_array = newval.split(', ');
			values_array = values_array.map(function(item,key) { // Replaces '-' with '0'
				if(key > 3){
					return '-' === item ? '0px' : item + 'px ';
				}else{
					return '-' === item ? 'auto' : item + 'px ';
				}
			});
			var style = '.'+secvalue+'-footer-elem-wrap { margin: ' + values_array[0] + ' ' + values_array[1] + ' ' + values_array[2] + ' ' + values_array[3] + '' + '; padding: ' + values_array[4] + ' ' + values_array[5] + ' ' + values_array[6] + ' ' + values_array[7] + '' + ' ;}';
			$( '#customizer_dynamic_css_bingle_footer_marginpadding_'+secvalue+'_footer' ).text( style );

		});
		});

	});

	// container wrapper width.
	api( 'bingle_logo_width', function(value) {
		value.bind(function(newval) {
			bingle_dynamic_css_targets( 'bingle_logo_width' );
			var width = '.site-branding { width: ' + newval + 'px; }';
			$( '#customizer_dynamic_css_bingle_logo_width' ).text( width );

		});
	});

	// Page section margin and padding.
	api( 'bingle_logo_padding', function(value) {
		value.bind(function(newval) {
			bingle_dynamic_css_targets( 'bingle_logo_padding' );
			var values_array = newval.split(', ');
			values_array = values_array.map(function(item,key) { // Replaces '-' with '0'
				return '-' === item ? '0px' : item + 'px ';				
			});
			var style = '.site-branding { padding: ' + values_array[0] + ' ' + values_array[1] + ' ' + values_array[2] + ' ' + values_array[3] + '' + ' ;}';
			$( '#customizer_dynamic_css_bingle_logo_padding' ).text( style );

		});
	});

	// menu container wrapper width.
	api( 'bingle_primarymenu_width', function(value) {
		value.bind(function(newval) {
			bingle_dynamic_css_targets( 'bingle_primarymenu_width' );
			var width = '.header-main-menu { width: ' + newval + 'px; }';
			$( '#customizer_dynamic_css_bingle_primarymenu_width' ).text( width );

		});
	});

	// Page section margin and padding.
	api( 'bingle_primarymenu_marginpadding', function(value) {
		value.bind(function(newval) {
			bingle_dynamic_css_targets( 'bingle_primarymenu_marginpadding' );
			var values_array = newval.split(', ');
			values_array = values_array.map(function(item,key) { // Replaces '-' with '0'
				if(key > 3){
					return '-' === item ? '0px' : item + 'px ';
				}else{
					return '-' === item ? 'auto' : item + 'px ';
				}
			});
			var style = '.header-main-menu { margin: ' + values_array[0] + ' ' + values_array[1] + ' ' + values_array[2] + ' ' + values_array[3] + '' + '; padding: ' + values_array[4] + ' ' + values_array[5] + ' ' + values_array[6] + ' ' + values_array[7] + '' + ' ;}';
			$( '#customizer_dynamic_css_bingle_primarymenu_marginpadding' ).text( style );

		});
	});

	var heade_elem_wid = {
		'bingle_headercustom_section':'site-customhtml',
		'bingle_headersocial_section':'social-links',
		'title_tagline':'site-branding',
		'bingle_headeraddress_section':'site-address',
		'bingle_headerphone_section':'site-phone',
		'bingle_headeremail_section':'site-email',
		'bingle_headercart_section':'cart-wrapper',
		'bingle_headersidemenu_section':'sidewidget-wrapper',
		'bingle_headermenu_section':'header-main-menu',
		'bingle_headersearch_section':'search-wrapper',
		'bingle_headerbutton_section':'site-button',
		'bingle_footer_menu_section':'footermenu',
		'bingle_footer_copyright_section':'site-info',
		'bingle_footer_social':'site-footer .social-links'
	};

	$.each(heade_elem_wid, function( index,secvalue ) {
		api( index+'_width', function(value) {
			value.bind(function(newval) {
				bingle_dynamic_css_targets( index+'_width' );
				var width = '.'+secvalue+' { width: ' + newval + '%; }';
				$( '#customizer_dynamic_css_'+index+'_width' ).text( width );
			});
		});
	});

	// blog wrapper width.
	api( 'bingle_inner_blog_content_width', function(value) {
		value.bind(function(newval) {
			bingle_dynamic_css_targets( 'bingle_inner_blog_content_width' );
			var width = '.archive #primary, .blog #primary, .search #primary { width: ' + newval + '%; } .archive #secondary, .blog #secondary, .search #secondary { width: calc(100% - ' + newval + '%); }';
			$( '#customizer_dynamic_css_bingle_inner_blog_content_width' ).text( width );

		});
	});
	// blog wrapper max width.
	api( 'bingle_inner_blog_content_maxwidth', function(value) {
		value.bind(function(newval) {
			bingle_dynamic_css_targets( 'bingle_inner_blog_content_maxwidth' );
			var width = '.archive.bingle-wrapper-archive .site-content, .blog.bingle-wrapper-archive .site-content, .search.bingle-wrapper-archive .site-content { width: ' + newval + 'px; }';
			$( '#customizer_dynamic_css_bingle_inner_blog_content_maxwidth' ).text( width );

		});
	});
	
	// single page/post width.
	api( 'bingle_inner_single_content_width', function(value) {
		value.bind(function(newval) {
			bingle_dynamic_css_targets( 'bingle_inner_single_content_width' );
			var width = '.single #primary, .page #primary { width: ' + newval + '%; } .single #secondary, .page #secondary { width: calc(100% - ' + newval + '%); }';
			$( '#customizer_dynamic_css_bingle_inner_single_content_width' ).text( width );

		});
	});
	// single page/post max width.
	api( 'bingle_inner_single_content_maxwidth', function(value) {
		value.bind(function(newval) {
			bingle_dynamic_css_targets( 'bingle_inner_single_content_maxwidth' );
			var width = '.single.bingle-wrapper-single .site-content, .page.bingle-wrapper-single .site-content { width: ' + newval + 'px; }';
			$( '#customizer_dynamic_css_bingle_inner_single_content_maxwidth' ).text( width );

		});
	});


} )( jQuery );