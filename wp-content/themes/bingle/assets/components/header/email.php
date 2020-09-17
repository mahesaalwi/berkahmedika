<?php
$email_icon = get_theme_mod('bingle_header_email_icon');
$email = get_theme_mod('bingle_header_email');
?>
<div class="site-email">
	<i class="<?php echo esc_attr($email_icon);?>"></i>
	<div class="email"><?php echo wp_kses_post($email); ?></div>
</div>