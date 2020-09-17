<?php
/* Dynamic Css */
function bingle_get_dynamic_styles() {
	$bingle_mp = get_theme_mod('bingle_container_marginpadding','0, -, 0, -, 0, 0, 0, 0');
	$bingle_arr = explode(', ',$bingle_mp);
	foreach ( $bingle_arr as $key=>$val ) {
		if($key > 3){
			('-'===$val)? $bingle_arr[$key] = '0px ' : $bingle_arr[$key] = $val.'px ';
		}else{
			('-'===$val)? $bingle_arr[$key] = 'auto ' : $bingle_arr[$key] = $val.'px ';
		}
	}
	$bingle_container_margin = $bingle_arr[0].$bingle_arr[1].$bingle_arr[2].$bingle_arr[3];
	$bingle_container_padding = $bingle_arr[4].$bingle_arr[5].$bingle_arr[6].$bingle_arr[7];

	$bingle_fmp = get_theme_mod('bingle_footer_marginpadding','0, -, 0, -, 0, 0, 0, 0');
	$bingle_farr = explode(', ',$bingle_fmp);
	foreach ( $bingle_farr as $key=>$val ) {
		if($key > 3){
			('-'===$val)? $bingle_farr[$key] = '0px ' : $bingle_farr[$key] = $val.'px ';
		}else{
			('-'===$val)? $bingle_farr[$key] = 'auto ' : $bingle_farr[$key] = $val.'px ';
		}
	}
	$bingle_footer_margin = $bingle_farr[0].$bingle_farr[1].$bingle_farr[2].$bingle_farr[3];
	$bingle_footer_padding = $bingle_farr[4].$bingle_farr[5].$bingle_farr[6].$bingle_farr[7];

	$bingle_lp = get_theme_mod('bingle_logo_padding','0, 0, 0, 0');
	$bingle_larr = explode(', ',$bingle_lp);
	foreach ( $bingle_larr as $key=>$val ) {
		('-'===$val)? $bingle_larr[$key] = '0px ' : $bingle_larr[$key] = $val.'px ';
	}
	$bingle_logo_padding = $bingle_larr[0].$bingle_larr[1].$bingle_larr[2].$bingle_larr[3];

	$bingle_fmp = get_theme_mod('bingle_primarymenu_marginpadding','0, -, 0, -, 0, 0, 0, 0');
	$bingle_farr = explode(', ',$bingle_fmp);
	foreach ( $bingle_farr as $key=>$val ) {
		if($key > 3){
			('-'===$val)? $bingle_farr[$key] = '0px ' : $bingle_farr[$key] = $val.'px ';
		}else{
			('-'===$val)? $bingle_farr[$key] = 'auto ' : $bingle_farr[$key] = $val.'px ';
		}
	}
	$bingle_primarymenu_margin = $bingle_farr[0].$bingle_farr[1].$bingle_farr[2].$bingle_farr[3];
	$bingle_primarymenu_padding = $bingle_farr[4].$bingle_farr[5].$bingle_farr[6].$bingle_farr[7];

	$bingle_container_width = get_theme_mod('bingle_container_width','1200');


	$custom_css = ".bingle-wrapper { width: {$bingle_container_width}px; }\n";
	$custom_css .= ".bingle-container { margin: {$bingle_container_margin}; padding: {$bingle_container_padding}; }\n";

	$header_sections = array('top','main','bottom');
	foreach ($header_sections as $hsec) {
		$defpm = '0, -, 0, -, 0, 0, 0, 0';
		if($hsec=='main'){			
			$defpm = '0, -, 0, -, 20, 0, 20, 0';
		}
		$bingle_hmp = get_theme_mod('bingle_header_marginpadding_'.$hsec.'_header',$defpm);
		$bingle_harr = explode(', ',$bingle_hmp);
		foreach ( $bingle_harr as $key=>$val ) {
			if($key > 3){
				('-'===$val)? $bingle_harr[$key] = '0px ' : $bingle_harr[$key] = $val.'px ';
			}else{
				('-'===$val)? $bingle_harr[$key] = 'auto ' : $bingle_harr[$key] = $val.'px ';
			}
		}
		$bingle_header_margin = $bingle_harr[0].$bingle_harr[1].$bingle_harr[2].$bingle_harr[3];
		$bingle_header_padding = $bingle_harr[4].$bingle_harr[5].$bingle_harr[6].$bingle_harr[7];

		$bingle_header_width_var = get_theme_mod('bingle_header_width_'.$hsec.'_header','1200');

		$custom_css .= ".{$hsec}-header-bingle-wrapper { width: {$bingle_header_width_var}px; margin: 0 auto; }\n";
		$custom_css .= ".{$hsec}-header.bingle-header-container {";
		$custom_css .= " margin: {$bingle_header_margin}; padding: {$bingle_header_padding};"; 

		if(get_theme_mod('bingle_header_bkgcolor_'.$hsec.'_header','')!=''){
			$bhbk = get_theme_mod('bingle_header_bkgcolor_'.$hsec.'_header',''); 
			$custom_css .= "background-color:{$bhbk} !important;";
		}
		$custom_css .= "}\n";
	}

	$footer_sections = array('top','main');
	foreach ($footer_sections as $hsec) {
		$bingle_hmp = get_theme_mod('bingle_footer_marginpadding_'.$hsec.'_footer','0, -, 0, -, 0, 0, 0, 0');
		$bingle_harr = explode(', ',$bingle_hmp);
		foreach ( $bingle_harr as $key=>$val ) {
			if($key > 3){
				('-'===$val)? $bingle_harr[$key] = '0px ' : $bingle_harr[$key] = $val.'px ';
			}else{
				('-'===$val)? $bingle_harr[$key] = 'auto ' : $bingle_harr[$key] = $val.'px ';
			}
		}
		$bingle_footer_margin = $bingle_harr[0].$bingle_harr[1].$bingle_harr[2].$bingle_harr[3];
		$bingle_footer_padding = $bingle_harr[4].$bingle_harr[5].$bingle_harr[6].$bingle_harr[7];
		$bingle_footer_width_var = get_theme_mod('bingle_footer_width_'.$hsec.'_footer','1200');

		$custom_css .= ".{$hsec}-footer-bingle-wrapper.footer-elements-wrap { width: {$bingle_footer_width_var}px; }\n";
		$custom_css .= ".{$hsec}-footer-elem-wrap { margin: {$bingle_footer_margin}; padding: {$bingle_footer_padding};";

		if(get_theme_mod('bingle_footer_bkgcolor_'.$hsec.'_footer','')!=''){ 
			$bfbkg = get_theme_mod('bingle_footer_bkgcolor_'.$hsec.'_footer','');
			$custom_css .= "background-color:{$bfbkg};";
		}
		$custom_css .= "}\n";
	}

	$header_elements_sections_width = array(
		'bingle_headercustom_section'=>array('site-customhtml','10'),
		'bingle_headersocial_section'=>array('social-links','10'),
		'title_tagline'=>array('site-branding','30'),
		'bingle_headeraddress_section'=>array('site-address','10'),
		'bingle_headerphone_section'=>array('site-phone','10'),
		'bingle_headeremail_section'=>array('site-email','10'),
		'bingle_headercart_section'=>array('cart-wrapper','5'),
		'bingle_headersidemenu_section'=>array('sidewidget-wrapper','5'),
		'bingle_headermenu_section'=>array('header-main-menu','70'),
		'bingle_headersearch_section'=>array('search-wrapper','5'),
		'bingle_headerbutton_section'=>array('site-button','10'),
		'bingle_footer_menu_section'=>array('footermenu','100'),
		'bingle_footer_copyright_section'=>array('site-info','100'),
		'bingle_footer_social'=>array('site-footer .social-links','100')
	);
	foreach ($header_elements_sections_width as $section => $class) {
		$sec_width = get_theme_mod($section.'_width',$class[1]);

		$custom_css .= ".{$class[0]} { width: {$sec_width}%; }\n";
	}

	$bingle_footer_width = get_theme_mod('bingle_footer_width','1200');
	$custom_css .= ".footer-bingle-wrapper { width: {$bingle_footer_width}px; }\n";
	$custom_css .= ".footer-bingle-container { margin: {$bingle_footer_margin}; padding: {$bingle_footer_padding}; }\n";

	$bingle_inner_blog_content_maxwidth = get_theme_mod('bingle_inner_blog_content_maxwidth','1200');
	$custom_css .= ".archive.bingle-wrapper-archive .site-content,
	.blog.bingle-wrapper-archive .site-content,
	.search.bingle-wrapper-archive .site-content,
	.error404 .site-content{ 
		width: {$bingle_inner_blog_content_maxwidth}px;
		margin: 0 auto;
	}\n";

	$bingle_inner_blog_content_width = get_theme_mod('bingle_inner_blog_content_width','70');
	$custom_css .= ".archive #primary,
	.blog #primary,
	.search #primary { 
		width: {$bingle_inner_blog_content_width}%;
	}\n";
	$custom_css .= ".archive #secondary,
	.blog #secondary,
	.search #secondary { 
		width: calc(100% - {$bingle_inner_blog_content_width}%);
	}\n";
	$bingle_inner_single_content_maxwidth = get_theme_mod('bingle_inner_single_content_maxwidth','1200');
	$custom_css .= ".single.bingle-wrapper-single .site-content, .page.bingle-wrapper-single:not(.home) .site-content, .home.page-template-default .site-content { 
		width: {$bingle_inner_single_content_maxwidth}px;
		margin: 0 auto;
	}\n";
	$bingle_inner_single_content_width = get_theme_mod('bingle_inner_single_content_width','70');
	$custom_css .= ".single #primary, .page #primary { 
		width: {$bingle_inner_single_content_width}%;
	}\n";

	$custom_css .= ".single #secondary, .page #secondary {
		width: calc(100% - {$bingle_inner_single_content_width}%);
	}\n";

	$bingle_headerbutton_color = get_theme_mod('bingle_headerbutton_color');
	$bingle_headerbutton_hover_color = get_theme_mod('bingle_headerbutton_hover_color');
	$custom_css .= ".site-button a {
		background: {$bingle_headerbutton_color} !important;
	}\n";
	$custom_css .= ".site-button a:hover {
		background: {$bingle_headerbutton_hover_color} !important;
	}\n";

	// Add output of Customizer settings as inline style.
	wp_add_inline_style( 'bingle-style', $custom_css );

}
add_action( 'wp_enqueue_scripts', 'bingle_get_dynamic_styles' );
