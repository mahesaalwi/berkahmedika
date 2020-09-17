<div class="social-links">
	<?php 
	$socials = bingle_social_icons_group();

	foreach ($socials as $soc_key=>$soc_label) {

		$icon 			= get_theme_mod('bingle_header_social_icon_'.$soc_key);
		$social_link 	= get_theme_mod('bingle_header_social_'.$soc_key);
		
		if( $icon && $social_link ) : ?>
			<a href="<?php echo esc_url($social_link); ?>" title="<?php echo esc_attr($soc_label);?>" target="_blank"><span class="<?php echo esc_attr($icon); ?>"></span></a>
		<?php endif;
	}
	?>
</div>