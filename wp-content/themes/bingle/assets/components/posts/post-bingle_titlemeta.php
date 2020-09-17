<header class="entry-header">
	<?php
	if ( is_singular() ) :
		the_title( '<h1 class="entry-title">', '</h1>' );
	else :
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	endif;
	if ( 'post' === get_post_type() ) :
		?>
		<div class="entry-meta">
			<?php
			$bingle_archive_meta_order = get_theme_mod('bingle_inner_blog_meta_elements');
			if($bingle_archive_meta_order==''){
				$bingle_archive_meta_order = '[{"id":"bingle_author","name":"Author","enable":"1"},{"id":"bingle_date","name":"Date","enable":"1"}]';
			}
			$bingle_archive_meta_order_arr = json_decode($bingle_archive_meta_order,true);
			if($bingle_archive_meta_order_arr!=null){
				foreach ($bingle_archive_meta_order_arr as $bingle_post_meta_elements) {
					if(isset($bingle_post_meta_elements['enable']) && $bingle_post_meta_elements['enable']=='1'){
						if($bingle_post_meta_elements['id']=='bingle_date'){
							bingle_posted_on();
						}
						if($bingle_post_meta_elements['id']=='bingle_author'){
							bingle_posted_by();
						}
					}
				}
			}		
			?>
		</div><!-- .entry-meta -->
	<?php endif; ?>
</header><!-- .entry-header -->