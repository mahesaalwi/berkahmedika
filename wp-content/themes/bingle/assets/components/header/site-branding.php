<div class="site-branding">
	<?php
	the_custom_logo();
	?>
	<div class="site-title-desc-wrap">
		<?php
		if ( is_front_page() && is_home() ) :
			?>
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php
		else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
		endif;
		$bingle_description = get_bloginfo( 'description', 'display' );
		if ( $bingle_description || is_customize_preview() ) :
			?>
			<p class="site-description"><?php echo esc_html($bingle_description);?></p>
			<?php 
		endif; ?>
	</div>
</div><!-- .site-branding -->