<?php
$address_icon = get_theme_mod('bingle_header_address_icon');
$address = get_theme_mod('bingle_header_address');
?>
<div class="site-address">
	<i class="<?php echo esc_attr($address_icon);?>"></i>
	<div class="address"><?php echo wp_kses_post($address); ?></div>
</div>