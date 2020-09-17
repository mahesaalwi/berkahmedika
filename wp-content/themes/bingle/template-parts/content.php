<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bingle
 */

?>
<?php
$bingle_thumbclass = 'thumbnail-disabled';
if(!is_singular() && bingle_is_archive_thumbnail_enabled()){
	$bingle_thumbclass = 'thumb-enabled';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($bingle_thumbclass); ?>>
	<?php 
	if ( is_singular() ) {
		$bingle_single_order = get_theme_mod('bingle_inner_single_meta_elements');
		if($bingle_single_order==''){
			$bingle_single_order = '[{"id":"bingle_titlemeta","name":"Title & Meta","enable":"1"},{"id":"bingle_thumbnail","name":"Thumbnail","enable":"1"},{"id":"bingle_content","name":"Content","enable":"1"},{"id":"bingle_tags","name":"Tags","enable":"1"},{"id":"bingle_postnav","name":"Post Navigation","enable":"1"},{"id":"bingle_comments","name":"Comments","enable":"1"}]';
		}
		$bingle_single_order_arr = json_decode($bingle_single_order,true);
		if($bingle_single_order_arr!=null){
			foreach ($bingle_single_order_arr as $bingle_post_elements) {
				if(isset($bingle_post_elements['enable']) && $bingle_post_elements['enable']=='1'){
					get_template_part('assets/components/posts/post',$bingle_post_elements['id']);		
				}
			}
		}
	}
	else {
		$bingle_archive_order = get_theme_mod('bingle_inner_blog_elements');
		if($bingle_archive_order==''){
			$bingle_archive_order = '[{"id":"bingle_thumbnail","name":"Thumbnail","enable":"1"},{"id":"bingle_titlemeta","name":"Title & Meta","enable":"1"},{"id":"bingle_excerpt","name":"Excerpt","enable":"1"}]';
		}
		$bingle_archive_order_arr = json_decode($bingle_archive_order,true);
		if($bingle_archive_order_arr!=null){
			foreach ($bingle_archive_order_arr as $bingle_post_elements) {
				if(isset($bingle_post_elements['enable']) && $bingle_post_elements['enable']=='1'){
					get_template_part('assets/components/posts/post',$bingle_post_elements['id']);		
				}
			}
		}
	}
	?>
</article><!-- #post-<?php the_ID(); ?> -->
