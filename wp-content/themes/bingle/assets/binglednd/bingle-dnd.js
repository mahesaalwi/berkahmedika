jQuery(document).ready(function($) {
	'use_strict';

	$('.bingle-drag-sec').each(function(){
		var myId = $(this).attr('id');
		if( $(this).hasClass('section-disable')){
			$( '#accordion-section-' + myId ).addClass( 'section-disable' );
		}
	});

	$('#sub-accordion-panel-bingle_header_elements li:first-child').after('<a class="bingle-cus-linkto" href="#bingle_header_layout_setting" rel="bingle-control"><h3 class="accordion-section-title"><i class="dashicons dashicons-undo"></i>Back to Layouts</h3></a>');
	$('#customize-control-bingle_header_layout_setting').prepend('<a class="bingle-cus-linkto" href="#bingle_header_elements" rel="bingle-panel"><h3 class="accordion-section-title"><i class="dashicons dashicons-redo"></i>Manage Elements</h3></a>');
	$('#sub-accordion-panel-bingle_footer_elements li:first-child').after('<a class="bingle-cus-linkto" href="#bingle_footer_layout_setting" rel="bingle-control"><h3 class="accordion-section-title"><i class="dashicons dashicons-undo"></i>Back to Layouts</h3></a>');
	$('#customize-control-bingle_footer_layout_setting').prepend('<a class="bingle-cus-linkto" href="#bingle_footer_elements" rel="bingle-panel"><h3 class="accordion-section-title"><i class="dashicons dashicons-redo"></i>Manage Elements</h3></a>');

	$('#accordion-panel-bingle_header_panel, #accordion-panel-bingle_header_elements').click(function(){
		$('.bingle-dnd.demo').addClass('bingle-dnd-active');
		$('.bingle-dnd .btn-close-dnd').removeClass('hidden');
		if($('.bingle-dnd.demo #header').hasClass('active')===false){
			$('.bingle-dnd .sectionDragnDrop').removeClass('active').addClass('hidden');
			$('.bingle-dnd.demo #header').removeClass('hidden').addClass('active');
		}
	});
	$('#accordion-panel-bingle_footer_panel, #accordion-panel-bingle_footer_elements').click(function(){
		$('.bingle-dnd.demo').addClass('bingle-dnd-active');
		$('.bingle-dnd .btn-close-dnd').removeClass('hidden');
		if($('.bingle-dnd.demo #footer').hasClass('active')===false){
			$('.bingle-dnd .sectionDragnDrop').removeClass('active').addClass('hidden');
			$('.bingle-dnd.demo #footer').removeClass('hidden').addClass('active');
		}
	});

	$('body').on('click','a[rel="bingle-close"]',function() {
		$('.bingle-dnd').toggleClass('bingle-dnd-active');
		$('.bingle-dnd .btn-close-dnd i').toggleClass('dashicons-arrow-up-alt2');		
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$('.bingle-dnd .btn-close-dnd span').text('Close');
		}else{
			$(this).addClass('active');
			$('.bingle-dnd .btn-close-dnd span').text($('.sectionDragnDrop.active .main-sec-title').text());
		}
	});

	$(".bingleDrag").sortable({
		connectWith: ".connectedSortable",
		update: function( event, ui ) {
			bingle_area_order();
		}
	})
	.disableSelection();

	/**
	* Section Reorder
	*/
	//bingle_area_order();
	function bingle_area_order(){
		var secfullOrderList = [];
		$('.sectionDragnDrop').each(function(){
			var secOrderList = {};
			var secArea = {};
			var thisParentId = $(this).attr('id');
			$(this).find('.bingleDrag').each(function(){
				var thisId = $(this).attr('id');
				var areaList = $(this).sortable('toArray');

				var s_ordered = [];
				$.each(areaList, function( index, areaId ) {
					var mySec = $('#' + areaId).attr('data-sec');
					var enable = '1';
					if( $( '#' + areaId ).hasClass( 'section-disable' ) ){        
						var enable = '0';
					}
					s_ordered.push({'panel':areaId,'section':mySec,'enable':enable});
				});
				areaList = s_ordered;

				secArea[thisId] = areaList;
			});
			secOrderList[thisParentId] = secArea;
			secfullOrderList.push(secOrderList);
		});
		secfullOrderList = JSON.stringify(secfullOrderList);
		$('input#save-area-section-reorder').val(secfullOrderList);
		$.ajax({
			url: bingleDnDAjax.ajax_url,
			type: 'post',
			dataType: 'html',
			data: {
				'action': 'bingle_save_sections_order',
				'binglesecOrder':secfullOrderList
			}
		})
		.done( function( data ) {
			wp.customize.previewer.refresh();
		});
	}

	//bingle_save_value_eyeclick();
	//function bingle_save_value_eyeclick(){
		$( 'body' ).on('click','.bingle-drag-sec .section-trigger',function(){
			var parent_sel = $( this ).parent();
			if( parent_sel.hasClass( 'section-disable' ) ) {
				parent_sel.removeClass( 'section-disable' );
				$( '#accordion-section-' + parent_sel.attr('id') ).removeClass( 'section-disable' );
				$(this).removeClass('dashicons-hidden').addClass( 'dashicons-visibility' );
			}
			else {
				parent_sel.addClass( 'section-disable' );
				$(this).removeClass('dashicons-visibility').addClass( 'dashicons-hidden' );
				$( '#accordion-section-' + parent_sel.attr('id') ).addClass( 'section-disable' );
			}
			bingle_area_order();
		});
	//}

	$('body').on('click','#customize-control-bingle_header_layout_setting label[rel="change-layout"]',function(e){
		e.preventDefault();
		$(this).find('input').prop('checked','checked');
		var layHeader = $(this).find('input').val();
		$.ajax({
			url: bingleAdminAjax.ajax_url,
			type: 'post',
			dataType: 'html',
			data: {
				'action': 'bingle_get_layout_structure',
				'layout': layHeader,
				'section': 'header',
			}
		})
		.done( function( data ) {
			$('.demo-inner-wrap').html(data);
			$(".bingleDrag").sortable({
				connectWith: ".connectedSortable",
				update: function( event, ui ) {
					bingle_area_order();
				}
			})
			.disableSelection();
			wp.customize.previewer.refresh();

			$('.bingle-drag-sec').each(function(){
				var myId = $(this).attr('id');
				if( $(this).hasClass('section-disable')){
					$( '#accordion-section-' + myId ).addClass( 'section-disable' );
				}else{
					$( '#accordion-section-' + myId ).removeClass( 'section-disable' );
				}
			});
		});
	});

});