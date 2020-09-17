<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Template Name: Blog Layout
 * @package Bingle
 */
?>
<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bingle
 */
function bingle__new_body_classes( $classes ) {
	
	$classes = array('custom-blog-layout archive category category-uncategorized category-1 logged-in admin-bar wp-custom-logo hfeed bingle-wrapper-archive elementor-default customize-support');

	$header_layout = get_theme_mod('bingle_header_layout_setting','lay1');
	$classes[] = 'header-'.$header_layout;

	$footer_layout = get_theme_mod('bingle_footer_layout_setting','lay1');
	$classes[] = 'footer-'.$footer_layout;
	
	$archive_layout = get_theme_mod('bingle_inner_blog_layout','list');
	
	if($archive_layout=='list'){
		$archive_layout='grid';
		$classes[] = 'archive-sidebar-none';
	}else{
		$archive_layout='list';
		$classes[] = 'archive-sidebar-right';
	}
	$classes[] = 'archive archive-'.$archive_layout;

	return $classes;
}
add_filter( 'body_class', 'bingle__new_body_classes' );
get_header();
?>
<style type="text/css">
	.archive-sidebar-none #primary, .single-sidebar-none #primary {
		width: 100%;
	}
</style>
<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php

		$posts_args = new WP_Query( array( 'posts_per_page' => '6' ) );
		if ( $posts_args->have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( $posts_args->have_posts() ) :
				$posts_args->the_post();

				
				$bingle_thumbclass = 'thumbnail-disabled';
				if(!is_singular() && bingle_is_archive_thumbnail_enabled()){
					$bingle_thumbclass = 'thumb-enabled';
				}
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class($bingle_thumbclass); ?>>
					<?php 

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
					
					?>
				</article><!-- #post-<?php the_ID(); ?> -->
				<?php

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();