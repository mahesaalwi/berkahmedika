<?php
$header_layout = get_theme_mod('bingle_header_layout_setting','lay0');
if( is_active_sidebar('bingle-sidemenuwidget') ||  ($header_layout=='lay0')) :
	?>
<div class="sidewidget-wrapper">
	<button type="button" class="sidewidget-icon">
		<span class="nav-svg">
			<span class="dots"></span>
			<svg width="50" height="50" version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			viewBox="0 524.5 2000 2000.5" enable-background="new 0 524.5 2000 2000.5" xml:space="preserve">
			<path class="x" fill="none" stroke="#000000" stroke-miterlimit="10" d="M1410.5,1235.2H589.3"/>
			<path class="x" fill="none" stroke="#000000" stroke-miterlimit="10" d="M1410.5,1815H589.3"/>
			<path class="yy" fill="none" stroke="#000000" stroke-miterlimit="10" d="M1410.5,1524.7c0,0-821.2,0-821.2,0c-211.3,0-260,98-218.2,217.6
			l0,0.1c90.1,260.7,337.6,447.9,628.9,447.9c367.4,0,665.2-297.8,665.2-665.2c0-79-13.8-154.8-39.1-225.2"/>
			<path class="yy" fill="none" stroke="#000000" stroke-miterlimit="10" d="M589.3,1524.7c0,0,821.2,0,821.2,0c211.3,0,260-98,218.2-217.6l0-0.1
			c-90.1-260.7-337.6-447.9-628.9-447.9c-367.4,0-665.2,297.8-665.2,665.2c0,79,13.8,154.8,39.1,225.2"/></svg>
		</span>
	</button>
	<span class="sidewidgetactive-icon"></span>
</div>
<?php 
endif;