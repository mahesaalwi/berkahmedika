<?php
if(!function_exists('bingle_get_section_item_count')){
	function bingle_get_section_item_count($sec_name){
		$i=0;
		foreach ($sec_name as $sec) {
			if($sec!=null){
				if($sec['enable']!=0){
					$i++;
				}
			}
		}
		return $i;
	}
}

if(!function_exists('bingle_get_section_index')){
	function bingle_get_section_index($sec_name){
		$bingle_hfls = bingle_get_sortable_defaults();
		return $bingle_hfls;
	}
}

add_action( 'wp_ajax_bingle_get_layout_structure', 'bingle_get_layout_structure_cb' );
if(!function_exists('bingle_get_layout_structure_cb')){
	function bingle_get_layout_structure_cb(){
		//order of draggable header elements
		$section 	= wp_unslash($_POST['section']);
		$layout 	= wp_unslash($_POST['layout']);
		$bingle_hfls = bingle_get_sortable_defaults();

		if(!class_exists('WooCommerce')){
			unset($bingle_hfls['header']['main-header'][4]);
		}

		if($section=='header'){
			if($layout=='lay0'){
				$bingle_lay_hfls = array(
					'header' => array(
						'main-header' => array(
							$bingle_hfls['header']['main-header'][0], //site branding
							$bingle_hfls['header']['main-header'][5] //sidemenu
						)
					)
				);
			}
			elseif($layout=='lay1'){
				$bingle_lay_hfls = array(
					'header' => array(
						'top-header' => array(
							$bingle_hfls['header']['top-header'][0], //customhtml
							$bingle_hfls['header']['top-header'][1], //social
						),
						'main-header' => array(
							$bingle_hfls['header']['main-header'][0], //site branding
							$bingle_hfls['header']['main-header'][1], //address
							$bingle_hfls['header']['main-header'][2], // email
							$bingle_hfls['header']['main-header'][3], //phone
							//$bingle_hfls['header']['main-header'][5] //sidemenu
						),
						'bottom-header' => array(
							$bingle_hfls['header']['bottom-header'][0], //nav menu
							$bingle_hfls['header']['bottom-header'][1], //search
							$bingle_hfls['header']['bottom-header'][2] //button
						)
					)
				);
			}elseif($layout=='lay2'){
				$bingle_lay_hfls = array(
					'header' => array(
						'top-header' => array(
							$bingle_hfls['header']['top-header'][1], //social
							$bingle_hfls['header']['main-header'][3], //email
							$bingle_hfls['header']['main-header'][2] //phone
						),
						'main-header' => array(
							$bingle_hfls['header']['main-header'][0], //site branding
							$bingle_hfls['header']['bottom-header'][0], //nav menu
							$bingle_hfls['header']['bottom-header'][1], //search
							$bingle_hfls['header']['main-header'][4] //cart
						),
					)
				);
			}elseif($layout=='lay3'){
				$bingle_lay_hfls = array(
					'header' => array(
						'top-header' => array(
							$bingle_hfls['header']['main-header'][2], //phone
							$bingle_hfls['header']['bottom-header'][2] //button
						),
						'main-header' => array(
							$bingle_hfls['header']['main-header'][0], //site branding
							$bingle_hfls['header']['bottom-header'][0], // nav menu
							$bingle_hfls['header']['bottom-header'][1], //search
							$bingle_hfls['header']['main-header'][4], //cart
							$bingle_hfls['header']['main-header'][5] //sidemenu
						), 
					)
				);
			}elseif($layout=='lay4'){
				$bingle_lay_hfls = array(
					'header' => array(
						'main-header' => array(
							$bingle_hfls['header']['main-header'][0], //site branding
							$bingle_hfls['header']['bottom-header'][0], //nav menu
							$bingle_hfls['header']['top-header'][1], //social
							$bingle_hfls['header']['bottom-header'][1], //search
							$bingle_hfls['header']['main-header'][4] //cart
						),
					)
				);
			}elseif($layout=='lay5'){
				$bingle_lay_hfls = array(
					'header' => array(
						'top-header' => array(
							$bingle_hfls['header']['main-header'][0], //site branding
						),
						'main-header' => array(
							$bingle_hfls['header']['top-header'][0], //customhtml
							$bingle_hfls['header']['bottom-header'][0], //nav menu
						),
						'bottom-header' => array(
							$bingle_hfls['header']['main-header'][2], //phone
							$bingle_hfls['header']['bottom-header'][1], //search
						)
					)
				);
			}elseif($layout=='lay6'){
				$bingle_lay_hfls = array(
					'header' => array(
						'top-header' => array(
							$bingle_hfls['header']['main-header'][0], //site branding
							$bingle_hfls['header']['main-header'][1], //address
							$bingle_hfls['header']['main-header'][3], //email						
							$bingle_hfls['header']['main-header'][2], //phone
						),
						'main-header' => array(
							$bingle_hfls['header']['bottom-header'][0], //nav menu
							$bingle_hfls['header']['main-header'][4], //cart
							$bingle_hfls['header']['bottom-header'][1], //search
							$bingle_hfls['header']['bottom-header'][2] //button
						),
					)
				);
			}elseif($layout=='lay7'){
				$bingle_lay_hfls = array(
					'header' => array(
						'top-header' => array(
							$bingle_hfls['header']['main-header'][3], //email
							$bingle_hfls['header']['main-header'][2], //phone
							$bingle_hfls['header']['top-header'][1], //social
						),
						'main-header' => array(
							$bingle_hfls['header']['main-header'][0], //site branding
							$bingle_hfls['header']['bottom-header'][0], //nav menu
							$bingle_hfls['header']['main-header'][4], //cart
							$bingle_hfls['header']['bottom-header'][1], //search
							$bingle_hfls['header']['bottom-header'][2] //button
						),
					)
				);
			}elseif($layout=='lay8'){
				$bingle_lay_hfls = array(
					'header' => array(
						'main-header' => array(
							$bingle_hfls['header']['main-header'][0], //site branding
							$bingle_hfls['header']['bottom-header'][0], //nav menu
							$bingle_hfls['header']['main-header'][4], //cart
							$bingle_hfls['header']['bottom-header'][1], //search
						),
					)
				);
			}elseif($layout=='lay9'){
				$bingle_lay_hfls = array(
					'header' => array(
						'top-header' => array(
							$bingle_hfls['header']['top-header'][0], //customhtml
							$bingle_hfls['header']['top-header'][1], //social
						),
						'main-header' => array(
							$bingle_hfls['header']['main-header'][0], //site branding
							$bingle_hfls['header']['bottom-header'][0], //nav menu
							$bingle_hfls['header']['bottom-header'][2], //button
							$bingle_hfls['header']['bottom-header'][1], //search
							$bingle_hfls['header']['main-header'][5], //sidemenu
						),
					)
				);
			}elseif($layout=='lay10'){
				$bingle_lay_hfls = array(
					'header' => array(
						'top-header' => array(
							$bingle_hfls['header']['main-header'][0], //site branding
							$bingle_hfls['header']['top-header'][0], //customhtml
						),
						'main-header' => array(
							$bingle_hfls['header']['bottom-header'][0], //nav menu
						),
						'bottom-header' => array(
							$bingle_hfls['header']['main-header'][2], //phone
							$bingle_hfls['header']['main-header'][3], //email
							$bingle_hfls['header']['top-header'][1], //social
						),
					)
				);
			}elseif($layout=='lay11'){
				$bingle_lay_hfls = array(
					'header' => array(
						'top-header' => array(
							$bingle_hfls['header']['top-header'][0], //customhtml
							$bingle_hfls['header']['top-header'][1], //social
						),
						'main-header' => array(
							$bingle_hfls['header']['main-header'][0], //site branding
							$bingle_hfls['header']['main-header'][1], //address
							$bingle_hfls['header']['main-header'][2], //phone
							$bingle_hfls['header']['main-header'][3], //email
							$bingle_hfls['header']['main-header'][4], //cart
							$bingle_hfls['header']['main-header'][5], //sidemenu
						),
						'bottom-header' => array(
							$bingle_hfls['header']['bottom-header'][0], //nav menu
							$bingle_hfls['header']['bottom-header'][1], //search
							$bingle_hfls['header']['bottom-header'][2] //button
						)
					)
				);
			}else{
				$bingle_lay_hfls = array('header' => array());
			}
			$bingle_lay_hfls['footer'] = array(
				'top-footer' => array($bingle_hfls['footer']['top-footer'][0]),
				'main-footer' => array($bingle_hfls['footer']['main-footer'][0],$bingle_hfls['footer']['main-footer'][1]),
			);
		}else{
			$bingle_lay_hfls = $bingle_hfls;
		}

		$newbinglesecOrder = json_encode($bingle_lay_hfls);

		set_theme_mod( 'bingle_dragndrop_sections_order',$newbinglesecOrder);
		set_theme_mod('bingle_header_layout_setting',$layout);
		$bingle_dnd_html = bingle_customzier_dnd_ajaxtemplate($bingle_lay_hfls);

		print($bingle_dnd_html); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}


if(!function_exists('bingle_customzier_dnd_ajaxtemplate')){
	function bingle_customzier_dnd_ajaxtemplate($section_area){
		ob_start();
		ob_get_clean();
		$i=0;
		if($section_area!='[]'){
			foreach ($section_area as $section=>$areas) {
				?>
				<div id="<?php echo esc_attr($section); ?>" class="<?php echo ($i!=0)?'hidden':'';?> sectionDragnDrop">
					<label class="main-sec-title"><?php echo esc_html(ucwords($section));?></label>
					<p class="info">
						<i class="dashicons dashicons-warning"></i><?php esc_html_e('Click on Items to go to their respective settings.','bingle');?> 
						<br/>
						<i class="dashicons dashicons-warning"></i><?php esc_html_e('Drag Items between/within Sections to change their position.','bingle');?> 
					</p>
					<?php
					$header_layout = get_theme_mod('bingle_header_layout_setting','lay0');
					$footer_layout = get_theme_mod('bingle_footer_layout_setting','lay2');?>
					<div class="section-<?php echo esc_attr($section); ?> header-<?php echo esc_attr($header_layout);?> footer-<?php echo esc_attr($footer_layout);?>">
						<?php
						foreach ($areas as $area_id=>$area) {
							?>
							<label class="inner-sec-title"><?php echo esc_html(ucwords(str_replace('-',' ',$area_id)));?></label>
							<a class="sec-setting" href="#bingle_<?php echo esc_html((str_replace('-','_',$area_id)));?>_section_designs" rel="bingle-section"><i class="dashicons dashicons-admin-generic"></i></a>
							<div id="<?php echo esc_attr($area_id); ?>" class="<?php echo esc_attr($area_id); ?> bingleDrag connectedSortable">
								<?php
								foreach ($area as $settings) {
									if($settings!=null){
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
				$i++;
			}
		}
		?>
		<input type="hidden" id="save-area-section-reorder" name="save-area-section-reorder" value="">
		<?php
		wp_die();		
	}
}