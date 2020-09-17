<?php
$customhtml_icon = get_theme_mod('bingle_headercustom_icon');
$customhtml = get_theme_mod('bingle_headercustom');
?>
<div class="site-customhtml">
	<i class="<?php echo esc_attr($customhtml_icon);?>"></i>
	<div class="customhtml">
		<?php echo do_shortcode($customhtml);?>
	</div>
</div>