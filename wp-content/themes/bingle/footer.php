<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bingle
 */

?>

</div><!-- #content -->
<?php do_action('bingle_main_footer'); ?>
</div><!-- #page -->
<?php
$header_layout = get_theme_mod('bingle_header_layout_setting','lay0');
if( is_active_sidebar('bingle-sidemenuwidget') ||  ($header_layout=='lay0')) : ?>
	<div class="sidemenuwidget">
		<span class="sidemenuwidget-close"></span>
		<?php 
		if($header_layout=='lay0'){			
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
				'container_class' => 'menu-primary-menu-container'
			) );
		}
		?>
		<?php dynamic_sidebar('bingle-sidemenuwidget'); ?>
	</div>
<?php endif; ?>
<?php wp_footer(); ?>
<style id="bingle_main_css-inline-css" type="text/css"></style>
</body>
</html>
