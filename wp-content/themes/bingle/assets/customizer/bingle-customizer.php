<?php
/**
 * bingle Theme Customizer Extended
 *
 * @package bingle
 */
if(is_admin()):
	add_action( 'admin_enqueue_scripts', 'bingle_admin_scripts' );
	function bingle_admin_scripts($hook){
		wp_enqueue_script( 'bingle-adminscript', get_template_directory_uri().'/assets/js/bingle-adminscript.js', array( 'jquery','jquery-ui-sortable' ), '20190924', true );
		$bingle_adminscript = array();
		$bingle_adminscript['ajax_url'] = admin_url( 'admin-ajax.php' );
		wp_localize_script( 'bingle-adminscript', 'bingleAdminAjax', $bingle_adminscript );
	}
endif;
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bingle_extended_customize_preview_js() {
	wp_enqueue_script( 'bingle-custom-izer', get_template_directory_uri() . '/assets/js/bingle-customizer.js', array( 'jquery', 'customize-preview' ), '20190830', true );
}
add_action( 'customize_preview_init', 'bingle_extended_customize_preview_js' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

add_action( 'customize_register', 'bingle_extended_customize_register' );

function bingle_extended_customize_register( $wp_customize ) {

	require get_template_directory() . '/assets/customizer/bingle-cus-general.php';// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	require get_template_directory() . '/assets/customizer/bingle-cus-header.php';// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	require get_template_directory() . '/assets/customizer/bingle-cus-footer.php';// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

	require get_template_directory() . '/assets/customizer/bingle-inner-pages.php';// phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

} // end class


if(!function_exists('bingle_social_icons_group')){
	function bingle_social_icons_group(){
		$social_links = array(
			'facebook' => __('Facebook','bingle'),
			'twitter' => __('Twitter','bingle'),
			'instagram' => __('Instagram','bingle'),
			'pinterest' => __('Pinterest','bingle'),
			'vimeo' => __('Vimeo','bingle'),
			'youtube' => __('You Tube','bingle'),
		);
		return $social_links;
	}
}

add_action('customize_controls_print_scripts', 'bingle_customizer_internal_links');
function bingle_customizer_internal_links() {
	?>
	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				var api = wp.customize;
				api.bind('ready', function() {
					$(['control', 'section', 'panel']).each(function(i, type) {
						$('body').on('click','a[rel="bingle-'+type+'"]',function(e) {
							e.preventDefault();
							var id = $(this).attr('href').replace('#', '');
							if(api[type].has(id)) {
								api[type].instance(id).focus();
							}
						});
					});
				});
			});
		})(jQuery);
	</script>
	<?php
}