<?php
/**
 * Bingle Theme Metabox Options
 *
 * @package Bingle
 */

add_action('add_meta_boxes', 'bingle_add_sidebar_layouts');

function bingle_add_sidebar_layouts() {
	add_meta_box(
		'bingle_sidebar_layout',
		__('Sidebar Layout','bingle'),
		'bingle_sidebar_layout_callback',
		'post',
		'normal',
		'high'
	);

	add_meta_box(
		'bingle_sidebar_layout',
		__('Sidebar Layout','bingle'),
		'bingle_sidebar_layout_callback',
		'page',
		'normal',
		'high'
	);
}


$bingle_sidebar_layout = array(
	'sidebar-left' => array(
		'value'     => 'sidebar-left',
		'label'     => __( 'Left sidebar', 'bingle' ),
		'thumbnail' => get_template_directory_uri().'/assets/images/sidebar-left.png'
	), 
	'sidebar-right' => array(
		'value' => 'sidebar-right',
		'label' => __( 'Right sidebar', 'bingle' ),
		'thumbnail' => get_template_directory_uri().'/assets/images/sidebar-right.png'
	),
	'sidebar-none' => array(
		'value'     => 'sidebar-none',
		'label'     => __( 'No sidebar', 'bingle' ),
		'thumbnail' => get_template_directory_uri().'/assets/images/sidebar-none.png'
	)
);

function bingle_sidebar_layout_callback()
{ 
	global $post , $bingle_sidebar_layout;
	wp_nonce_field( basename( __FILE__ ), 'bingle_sidebar_layout_nonce' ); 
	?>
	<table class="form-table">
		<tr>
			<td colspan="4"><em class="f13"><?php esc_html_e('Choose Sidebar Template','bingle'); ?></em></td>
		</tr>
		<tr>
			<td>
				<?php  
				foreach ($bingle_sidebar_layout as $field) {  
					$bingle_sidebar_metalayout = get_post_meta( $post->ID, 'bingle_sidebar_layout', true ); ?>

					<div class="radio-image-wrapper" style="float:left; margin-right:30px;">
						<label class="description">
							<span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" /></span></br>
							<input type="radio" name="bingle_sidebar_layout" value="<?php echo esc_attr($field['value']); ?>" <?php checked( $field['value'], $bingle_sidebar_metalayout ); if(empty($bingle_sidebar_metalayout) && $field['value']=='right-sidebar'){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html($field['label']); ?>
						</label>
					</div>
					<?php 
				}
				?>
				<div class="clear"></div>
			</td>
		</tr>
	</table>
	<?php
} 

/**
 * save the custom metabox data
 * @hooked to save_post hook
 */
function bingle_save_sidebar_layout( $post_id ) { 
	global $bingle_sidebar_layout, $post; 

    // Verify the nonce before proceeding.
	if ( !isset( $_POST[ 'bingle_sidebar_layout_nonce' ] ) || !wp_verify_nonce( sanitize_text_field(wp_unslash($_POST[ 'bingle_sidebar_layout_nonce' ])), basename( __FILE__ ) ) )
		return;

    // Stop WP from clearing custom fields on autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
		return;

	if(isset($_POST['post_type'])){
		if ('page' == $_POST['post_type']) {  
			if (!current_user_can( 'edit_page', $post_id ) )  
				return $post_id;  
		} elseif (!current_user_can( 'edit_post', $post_id ) ) {  
			return $post_id;  
		}
	}

	foreach ($bingle_sidebar_layout as $field) {  
        //Execute this saving function
		$old = get_post_meta( $post_id, 'bingle_sidebar_layout', true); 
		$new = "";
		if(isset($_POST['bingle_sidebar_layout'])){
			$new = sanitize_text_field(wp_unslash($_POST['bingle_sidebar_layout']));
		}
		if ($new && $new != $old) {  
			update_post_meta($post_id, 'bingle_sidebar_layout', $new);  
		} elseif ('' == $new && $old) {  
			delete_post_meta($post_id,'bingle_sidebar_layout', $old);  
		} 
     } // end foreach
 }
 add_action('save_post', 'bingle_save_sidebar_layout'); 