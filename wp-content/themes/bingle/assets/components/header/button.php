<?php
$bingle_header_button_text = get_theme_mod('bingle_header_button_text');
$bingle_header_button_link = get_theme_mod('bingle_header_button_link');
if(!empty($bingle_header_button_text) && !empty($bingle_header_button_link)){
	?>
	<div class="site-button">
		<a href="<?php echo esc_url($bingle_header_button_link);?>"><?php echo esc_html($bingle_header_button_text);?></a>
	</div>
	<?php
}