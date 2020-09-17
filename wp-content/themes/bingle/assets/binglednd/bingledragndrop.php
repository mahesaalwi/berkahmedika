<?php

if(!function_exists('bingle_get_sortable_defaults')){
	function bingle_get_sortable_defaults($section=''){
		//order of draggable header elements
		$bingle_defaults = array(
			'header'=>	array(
				'top-header'=>array(
					'0' => array( 
						'panel' => 'bingle_headercustom_section',
						'section' => 'customhtml',
						'enable' => '0' 
					),
					'1' => array( 
						'panel' => 'bingle_headersocial_section',
						'section' => 'social',
						'enable' => '0' 
					),
					
				),
				'main-header' => array(
					'0' => array( 
						'panel' => 'title_tagline',
						'section' => 'site-branding',
						'enable' => '1' 
					) ,
					'1' => array( 
						'panel' => 'bingle_headeraddress_section',
						'section' => 'address',
						'enable' => '0' 
					),
					'2' => array( 
						'panel' => 'bingle_headerphone_section',
						'section' => 'phone',
						'enable' => '0' 
					),
					'3' => array( 
						'panel' => 'bingle_headeremail_section',
						'section' => 'email',
						'enable' => '0' 
					),
					'4' => array( 
						'panel' => 'bingle_headercart_section',
						'section' => 'cart',
						'enable' => '0' 
					),
					'5' => array( 
						'panel' => 'bingle_headersidemenu_section',
						'section' => 'sidemenu',
						'enable' => '1' 
					),					
				),
				'bottom-header' => array (
					'0' => array( 
						'panel' => 'bingle_headermenu_section',
						'section' => 'nav-menu',
						'enable' => '0' 
					),
					'1' => array( 
						'panel' => 'bingle_headersearch_section',
						'section' => 'search',
						'enable' => '0' 
					),
					'2' => array( 
						'panel' => 'bingle_headerbutton_section',
						'section' => 'button',
						'enable' => '0' 
					)
				),
			),
			'footer'=>	array(
				'top-footer' => array(
					'0' => array( 
						'panel' => 'bingle_footer_menu_section',
						'section' => 'footermenu',
						'enable' => '0' 
					)
				),
				'main-footer' => array(
					'0' => array( 
						'panel' => 'bingle_footer_copyright_section',
						'section' => 'copyright',
						'enable' => '1' 
					),
					'1' => array( 
						'panel' => 'bingle_footer_social',
						'section' => 'footersocial',
						'enable' => '0' 
					)
				)
			)
		);
		if(empty($section)){
			return $bingle_defaults;	
		}
		if(!class_exists('WooCommerce')){
			unset($bingle_defaults['header']['main-header'][4]);
		}
		return $bingle_defaults[$section];
	}
}

if ( ! function_exists( 'bingle_get_section_position' ) ) {
	function bingle_get_section_position( $key,$section='' ) {
		if(empty($section)){ $section = 'header'; }
		$bingle_sortsec_pos = bingle_get_section_order($section);
		$return   = '0';
		if(($bingle_sortsec_pos!='[]')){
			$position = array_search( $key, array_column( $bingle_sortsec_pos, 'panel' ));
			$return   = ( $position + 1 ) * 10;
		}
		return $return;
	}
}

if(!function_exists('bingle_get_section_order')){
	function bingle_get_section_order($section=''){
		$bingle_defaults = json_encode(bingle_get_sortable_defaults());
		//$bingle_sections_order = $bingle_defaults; //reset values if sections are added
		$bingle_sections_order = get_theme_mod('bingle_dragndrop_sections_order',$bingle_defaults);
		$bingle_sections_order = json_decode($bingle_sections_order,true);
		
		if(($bingle_sections_order!='[]' && ($bingle_sections_order!=null))){
			$order_return = $bingle_sections_order;
		}else{
			$order_return = json_decode($bingle_defaults,true);
		}

		if(!empty($section)){
			return $order_return[$section];
		}
		else{
			return $order_return;
		}
	}
}

add_action( 'wp_ajax_bingle_save_sections_order', 'bingle_save_sections_order_cb' );
function bingle_save_sections_order_cb() {
	if ( isset( $_POST['binglesecOrder']) ) {
		$binglesecOrder = wp_unslash($_POST['binglesecOrder']);
		$binglesecOrder = stripslashes($binglesecOrder);
		$binglesecOrder = json_decode($binglesecOrder,true);
		$newbinglesecOrder = array();
		foreach($binglesecOrder as $bsk=>$bsv){
			foreach ($bsv as $key => $value) {
				$newbinglesecOrder[$key] = $value;
			}
		}
		$newbinglesecOrder = json_encode($newbinglesecOrder);

		set_theme_mod( 'bingle_dragndrop_sections_order',$newbinglesecOrder);
		echo 'success';
	}
	wp_die();
}

if(is_admin()):
	add_action( 'admin_enqueue_scripts', 'bingle_admin_dragndrop' );
	function bingle_admin_dragndrop($hook){
		wp_enqueue_style( 'bingle-dndstyle', get_template_directory_uri() . '/assets/binglednd/bingle-dnd.css');
		wp_enqueue_script( 'bingle-dnd', get_template_directory_uri().'/assets/binglednd/bingle-dnd.js', array( 'jquery','jquery-ui-sortable','jquery-ui-resizable' ), '20190918', true );
		$bingle_dnd = array();
		$bingle_dnd['ajax_url'] = admin_url( 'admin-ajax.php' );
		wp_localize_script( 'bingle-dnd', 'bingleDnDAjax', $bingle_dnd );
	}

	add_action( 'customize_controls_print_footer_scripts', 'bingle_customzier_drag_drop_template' );
	if(!function_exists('bingle_customzier_drag_drop_template')){
		function bingle_customzier_drag_drop_template(){
			?>
			<div class="bingle-dnd demo">
				<div class="demo-inner">
					<a rel="bingle-close" class="btn-close-dnd hidden" href="javascript:void(0);">
						<span><?php esc_html_e('Close','bingle');?></span>
						<i class="dashicons dashicons-arrow-down-alt2"></i>
					</a>
					<div class="demo-inner-wrap clear">
						<?php
						$section_area = bingle_get_section_order();
						$i=0;
						if($section_area!='[]'){
							foreach ($section_area as $section=>$areas) {
								$i++;
								?>
								<div id="<?php echo esc_attr($section); ?>" class="hidden sectionDragnDrop">
									<label class="main-sec-title"><?php echo esc_html(ucwords($section));?></label>
									<p class="info">
										<i class="dashicons dashicons-warning"></i><?php esc_html_e('Click on Items to go to their respective settings.','bingle');?> 
										<br/>
										<i class="dashicons dashicons-warning"></i><?php esc_html_e('Drag Items between/within Sections to change their position.','bingle');?> 
									</p>
									<?php
									$header_layout = get_theme_mod('bingle_header_layout_setting','lay1');
									$footer_layout = get_theme_mod('bingle_footer_layout_setting','lay1');?>
									<div class="section-<?php echo esc_attr($section); ?> header-<?php echo esc_attr($header_layout);?> footer-<?php echo esc_attr($footer_layout);?>">
										<?php
										foreach ($areas as $area_id=>$area) {
											?>
											<label class="inner-sec-title"><?php echo esc_html(ucwords(str_replace('-',' ',$area_id)));?></label>
											<a class="sec-setting" href="#bingle_<?php echo esc_html((str_replace('-','_',$area_id)));?>_section_designs" rel="bingle-section"><i class="dashicons dashicons-admin-generic"></i></a>
											<div id="<?php echo esc_attr($area_id); ?>" class="<?php echo esc_attr($area_id); ?> bingleDrag connectedSortable">
												<?php
												foreach ($area as $settings) {
													if($settings!=null && isset($settings['section'])){
														$secclass = 'bingle-drag-sec';
														if($settings['enable']==0){ $secclass .= ' section-disable'; }
														?>
														<div id="<?php echo esc_attr($settings['panel']);?>" class="<?php echo esc_attr($secclass);?>" data-sec="<?php echo esc_attr($settings['section']);?>">
															<i class="dashicons dashicons-<?php echo ($settings['enable']==0)?'hidden':'visibility';?> section-trigger"></i>
															<a title="<?php esc_attr_e('Click to go to settings.','bingle');?>" href="#<?php echo esc_attr($settings['panel']);?>" rel="bingle-section">
																<?php echo esc_attr(ucwords(str_replace('-',' ',$settings['section'])));?>
															</a>
															<i class="dashicons dashicons-move section-drag"></i>
														</div>
														<?php
													}
												}
												?>
											</div>
											<?php	
										}
										?>
									</div>
								</div>
								<?php
							}
						}
						?>
						<input type="hidden" id="save-area-section-reorder" name="save-area-section-reorder" value="">
					</div>
				</div>
			</div>
			<?php	
		}
	}
endif;