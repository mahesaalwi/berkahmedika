<?php
$phone_icon = get_theme_mod('bingle_header_phone_icon');
$phone = get_theme_mod('bingle_header_phone');
?>
<div class="site-phone">
	<i class="<?php echo esc_attr($phone_icon);?>"></i>
	<div class="phone"><?php echo wp_kses_post($phone); ?></div>
</div>