<?php if( class_exists( 'WooCommerce' ) ) :
	$cart_icon = get_theme_mod('bingle_header_cart_icon','fab fa-opencart');
	$show_dropdown = get_theme_mod('bingle_header_cart_dropdown','yes');
	$cart_dropdown_clas = '';
	if(!empty($show_dropdown)){
		$cart_dropdown_clas = 'cart-dropdown-'.$show_dropdown;
	}
	?>
	<div class="cart-wrapper <?php echo esc_attr($cart_dropdown_clas);?>">
		<span class="cart">
			<i class="<?php echo esc_attr($cart_icon);?>"></i>
			<i class="cart-counter"><?php echo absint(WC()->cart->get_cart_contents_count()); ?></i>
		</span>

		<?php
		if($show_dropdown=='yes'){
			the_widget( 'WC_Widget_Cart', 'title=' );
		}
		?>
	</div>
<?php endif;
?>