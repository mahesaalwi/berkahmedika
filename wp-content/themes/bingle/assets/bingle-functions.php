<?php
/** Custom Controls on Customizer */
require get_template_directory() . '/assets/controls/custom/custom-controls.php';
/** Gradients on Customizer */
require get_template_directory() . '/assets/controls/gradient/gradient.php';
/** Alpha Color on Customizer */
require get_template_directory() . '/assets/controls/alpha-color-picker/alpha-color-picker.php';
/**
 * Customizer additions.
 */
require get_template_directory() . '/assets/customizer/bingle-customizer.php';
require get_template_directory() . '/assets/customizer/bingle-sanitizer.php';
/** Sortable sections settings on Customizer */

/** Draggable section for header and footer */
require get_template_directory() . '/assets/binglednd/bingledragndrop.php';

/** load helpers for header and footer */
require get_template_directory() . '/assets/helpers/header-helper.php';
/** Include Metaboxes */
require get_template_directory() . '/assets/bingle-metaboxes.php';
/** Include Metaboxes */
require get_template_directory() . '/assets/welcome/welcome-config.php';
/** Include Dynamic Css */
require get_template_directory() . '/assets/css/bingle-dynamic-css.php';


if ( ! function_exists( 'bingle_get_section_details' ) ) {
	function bingle_get_section_details( $key,$bingle_order_control='',$section='' ) {
		if(empty($bingle_order_control)){ $bingle_order_control = 'bingle_header_elements_arr'; }
		if(empty($section)){ $section = 'header'; }

		$bingle_defaults = bingle_get_sortable_defaults($section);
		$bingle_sortsec_pos = get_theme_mod( $bingle_order_control, $bingle_defaults );
		
		$position = array_search( $key, array_column( $bingle_sortsec_pos, 'panel' ));

		$return   = $bingle_sortsec_pos[$position];
		return $return;
	}
}

if(!function_exists('bingle_custom_excerpt_length')){
	function bingle_custom_excerpt_length( $length ) {
		$bingle_excerpt_length = get_theme_mod('bingle_inner_blog_excerpt','50');
		return $bingle_excerpt_length;
	}
}
add_filter( 'excerpt_length', 'bingle_custom_excerpt_length', 1 );

/*BreadCrumb*/
if(!function_exists('bingle_breadcrumbs')){
	function bingle_breadcrumbs()
	{
		$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
		$delimiter = '&raquo;';
		$home = esc_html__('Home','bingle'); 
		global $post;
		
		$showCurrent = '1'; // 1 - show current post/page title in breadcrumbs, 0 - don't show
		$before = '<span class="current">'; // tag before the current crumb
		$after = '</span>'; // tag after the current crumb

		$homeLink = home_url();

		if (is_home() || is_front_page())
		{
			if ($showOnHome == 1) echo '<div id="bingle-breadcrumbs"><a href="' . esc_url($homeLink) . '">' . $home . '</a></div>';
		} 
		else
		{
			echo '<div id="bingle-breadcrumbs"><a href="' . esc_url($homeLink) . '">' . $home . '</a> ' . $delimiter . ' ';

			if ( is_category() ) {
				$thisCat = get_category(get_query_var('cat'), false);
				if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
				echo $before . '"' . single_cat_title('', false) . '"' . $after;
			} elseif ( is_search() ) {
				echo $before . 'Search results for "' . get_search_query() . '"' . $after;
			} elseif ( is_day() ) {
				echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
				echo $before . get_the_time('d') . $after;
			} elseif ( is_month() ) {
				echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
				echo $before . get_the_time('F') . $after;
			} elseif ( is_year() ) {
				echo $before . get_the_time('Y') . $after;
			} elseif ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo '<a href="' . esc_url($homeLink) . '/' . $slug['slug'] . '/">' . get_theme_mod('eightmedi_pro_breadcrumb_'.get_post_type(),$post_type->labels->singular_name) . '</a>';
					if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
					echo $cats;
					if ($showCurrent == 1) echo $before . get_the_title() . $after;
				}
			} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
				$post_type = get_post_type_object(get_post_type());
				echo $before . get_theme_mod('eightmedi_pro_breadcrumb_'.get_post_type(),$post_type->labels->singular_name) . $after;
			} elseif ( is_attachment() ) {
				$parent = get_post($post->post_parent);
				$cat = get_the_category($parent->ID); 
				if($cat!=null){
					$cat = $cat[0];
					echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
				}
				if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			} elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) echo $before . get_the_title() . $after;
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $breadcrumbs[$i];
					if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
				}
				if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			} elseif ( is_tag() ) {
				echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
			} elseif ( is_author() ) {
				global $author;
				$userdata = get_userdata($author);
				echo $before . 'Articles posted by ' . $userdata->display_name . $after;
			} elseif ( is_404() ) {
				echo $before . 'Error 404' . $after;
			}

			if ( get_query_var('paged') ) {
				if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ' ('.__('Page' , 'bingle') . ' ' . get_query_var('paged').')';
				}
			}
			echo '</div>';
		}
	}
}

if(!function_exists('bingle_is_archive_thumbnail_enabled')){
	function bingle_is_archive_thumbnail_enabled(){
		$bingle_thumb_enabled = false;
		$bingle_archive_order = get_theme_mod('bingle_inner_blog_elements');
		if($bingle_archive_order==''){
			$bingle_archive_order = '[{"id":"bingle_thumbnail","name":"Thumbnail","enable":"1"},{"id":"bingle_titlemeta","name":"Title & Meta","enable":"1"},{"id":"bingle_excerpt","name":"Excerpt","enable":"1"}]';
		}
		$bingle_archive_order_arr = json_decode($bingle_archive_order,true);
		if($bingle_archive_order_arr!=null){
			foreach ($bingle_archive_order_arr as $bingle_post_elements) {
				if(isset($bingle_post_elements['id']) && $bingle_post_elements['id']=='bingle_thumbnail'){
					if(isset($bingle_post_elements['enable']) && $bingle_post_elements['enable']=='1'){	
						$bingle_thumb_enabled = true;
					}
				}
			}
		}
		return $bingle_thumb_enabled;
	}
}

if(!function_exists('bingle_header_scripts')){
	function bingle_header_scripts(){
		$header_bg_v = get_header_image();
		echo "<style type='text/css' media='all'>";
		if(($header_bg_v)){
			$header_bg_v =   'body:not(.home) .site-header, body.home .site-header { background: url("'.esc_url($header_bg_v).'") no-repeat scroll left top rgba(0, 0, 0, 0); position: relative; background-size: cover; }';
			echo wp_kses_post($header_bg_v);
			echo "\n";
		}
		echo "</style>\n";
	}
}
add_action('wp_head','bingle_header_scripts');

if ( class_exists( 'woocommerce' ) ){
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	//remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	//remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

	if(!function_exists('bingle_wrapper_start')){
		function bingle_wrapper_start() {
			echo '<div class="ed-container"><div id="primary" class="content-area">';
		}
	}
	//add_action('woocommerce_before_main_content', 'bingle_wrapper_start', 10);

	if(!function_exists('bingle_wrapper_end')){
		function bingle_wrapper_end() {
			echo '</div>';
			$bingle_sidebar=get_theme_mod('bingle_woocommerce_sidebar_layout','right-sidebar');
			if($bingle_sidebar=='left-sidebar'){
				get_sidebar('left');
			}elseif($bingle_sidebar=='right-sidebar'){
				get_sidebar('right');
			}else{
				remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
			}
			echo '</div>';
		}
	}
	//add_action('woocommerce_after_main_content','bingle_wrapper_end',9);
}

/* actions for header */
add_action('bingle_inner_page_titles','bingle_inner_page_titles_cb',10);
if(!function_exists('bingle_inner_page_titles_cb')){
	function bingle_inner_page_titles_cb() {
		if(is_page() && !is_front_page() && !is_home()){
			$bingle_single_page_style = get_the_post_thumbnail_url();
			if(!empty($bingle_single_page_style)){
				$bingle_single_page_style = ' style="background-image: url('.$bingle_single_page_style.'); background-size: cover;"';
			}
			echo '<div class="bingle-header-title"'.$bingle_single_page_style.'>';
			echo '<div class="site-content">';
			the_title('<h1 class="bing-page-title">','</h1>');
			bingle_breadcrumbs();
			echo '</div>';
			echo '</div>';
		}
	}
}
add_action('bingle_main_header','bingle_main_header_cb',10);
if(!function_exists('bingle_main_header_cb')){
	function bingle_main_header_cb() {
		?>
		<header id="masthead" class="site-header">
			<div class="bingle-header-wrap">
				<?php 
				$bingle_header_sections_order = bingle_get_section_order('header');
				
				if($bingle_header_sections_order!='[]'){
					foreach($bingle_header_sections_order as $sec=>$sections){
						$bingle_get_section_item_count = bingle_get_section_item_count($sections);
						if($bingle_get_section_item_count>0){
							$secid = str_replace('-','_',strtolower($sec));
							$sec_wrapper = $sec.'-'.get_theme_mod('bingle_header_style_'.$secid,'bingle-wrapper').' '.$sec.'-elem-wrap header-elements-wrap';
							$secclass = $sec." bingle-header-container ";
							echo '<div class="'.esc_attr($secclass).'">';
							echo '<div class="'.esc_attr($sec_wrapper).'">';
							foreach($sections as $area){
								if(isset($area['enable'])){
									$enable_area = $area['enable'];
									if($enable_area!=0 && isset($area['section'])){
										get_template_part('assets/components/header/'.$area['section']);					
									}
								}
							}
							echo '</div>';
							echo '</div>';
						}
					}
				}
				?>
			</div>
			<div class="bingle-mobile-header">
				<?php
				get_template_part('assets/components/header/site-branding');
				get_template_part('assets/components/header/nav-menu');
				?>
			</div>			
		</header><!-- #masthead -->
		<?php
	}
}


add_action('bingle_archive_header','bingle_archive_header_cb',10);
if(!function_exists('bingle_archive_header_cb')){
	function bingle_archive_header_cb() {
		?>
		<header class="page-header">
			<?php
			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );
			?>
		</header><!-- .page-header -->
		<?php
	}
}

add_action('bingle_archive_sidebar','bingle_archive_sidebar_cb',10);
if(!function_exists('bingle_archive_sidebar_cb')){
	function bingle_archive_sidebar_cb() {
		get_sidebar();
	}
}

add_action('bingle_page_post_sidebar','bingle_page_post_sidebar_cb',10);
if(!function_exists('bingle_page_post_sidebar_cb')){
	function bingle_page_post_sidebar_cb() {
		get_sidebar();
	}
}

add_action('bingle_main_footer','bingle_main_footer_cb',10);
if(!function_exists('bingle_main_footer_cb')){
	function bingle_main_footer_cb() {
		?>
		<footer id="colophon" class="site-footer">
			<div class="bingle-footer-wrap">
				<?php
				$bingle_footer_sections_order = bingle_get_section_order('footer');
				if($bingle_footer_sections_order!='[]'){
					foreach($bingle_footer_sections_order as $sec=>$sections){
						$bingle_get_section_item_count = bingle_get_section_item_count($sections);
						if($bingle_get_section_item_count>0){
							$secid = str_replace('-','_',strtolower($sec));
							$sec_wrapper = $sec.'-'.get_theme_mod('bingle_footer_style_'.$secid,'bingle-wrapper').' '.$sec.'-elem-wrap footer-elements-wrap';
							$secclass = $sec." bingle-footer-container";
							echo '<div class="'.esc_attr($secclass).'">';
							echo '<div class="'.esc_attr($sec_wrapper).'">';
							foreach($sections as $area){
								if(isset($area['enable'])){
									$enable_area = $area['enable'];
									if($enable_area!=0 && isset($area['section'])){
										get_template_part('assets/components/footer/'.$area['section']);					
									}
								}
							}
							echo '</div>';
							echo '</div>';
						}
					}
				}
				?>
			</div>
			<div id="bingle-top">
				<span class="dashicons dashicons-arrow-up-alt2"></span>
			</div>
		</footer><!-- #colophon -->
		<?php
	}
}
