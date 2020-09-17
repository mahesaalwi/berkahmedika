<?php
$bingle_footer_copyright_text = get_theme_mod('bingle_footer_copyright_text','');
?>
<div class="site-info">
	<?php
	if(!empty($bingle_footer_copyright_text)){
		echo wp_kses_post($bingle_footer_copyright_text);
	}else{
		esc_html_e('Copyright','bingle');echo esc_html(' &copy; '.date('Y'));
	}
	?>
	<span class="sep"> | </span>
	<?php
	/* translators: 1: Theme name, 2: Theme author. */
	printf( esc_html__( 'WordPress Theme: %1$s', 'bingle' ),'<a href="'.esc_url('https://accesspressthemes.com/wordpress-themes/bingle/').'">Bingle</a>' );
	?>
</div>