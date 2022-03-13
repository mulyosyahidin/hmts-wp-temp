<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly




add_filter('woocommerce_add_to_cart_fragments', 'boosted_elements_woocommerce_cart_total_count');
function boosted_elements_woocommerce_cart_total_count( $fragments ) {
	global $woocommerce;
	ob_start();
	?>

    <div id="boosted-elements-cart-subtotal-button"><a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="boosted-elements-cart-link<?php if ( WC()->cart->get_cart_contents_count() == 0 ) : ?> boosted-cart-empty-hide<?php endif ?>"><div id="boosted-elements-cart-subtotal"><?php echo WC()->cart->get_cart_subtotal(); ?></div><div class="boosted-elements-cart-icon"><i class="eicon-cart-medium"></i><span class="boosted-elements-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span></div> </a></div>
    
	
	<?php
	$fragments['#boosted-elements-cart-subtotal-button'] = ob_get_clean();
	return $fragments;

}

add_filter('woocommerce_add_to_cart_fragments', 'boosted_elements_woocommerce_cart_fragment');
function boosted_elements_woocommerce_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>

    <ul id="boosted-elements-cart-product-list">
        <?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
            
			<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :
				$_product = $cart_item['data'];
				// Only display if allowed
				if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
					continue;
				// Get price
				$product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();
				$product_price = apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key );
				?>
			<li>
				<a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">

					<?php echo wp_kses($_product->get_image() , true); ?>

					<div class="boosted-elements-cart-mini-text">
						<h6><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?></h6>
						<?php echo wp_kses( wc_get_formatted_cart_item_data( $cart_item ), true ); ?>
						<span class="boosted-elements-mini-cart-quantity"><?php printf( '%s &times; %s', $cart_item['quantity'], $product_price ); ?></span>
					</div>
					<div class="clearfix-boosted-element"></div>
				</a>
			
				<?php
					echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
						'<a href="%s" class="boosted-elements-min-cart-remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
						esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
						__( 'Remove this item', 'boosted-elements-progression' ),
						esc_attr( $cart_item['product_id'] ),
						esc_attr( $_product->get_sku() )
					), $cart_item_key );
				?>
			
				<div class="clearfix-boosted-element"></div>
			</li>
			<?php endforeach; ?>
            
            
		<?php else : ?>
			<li><div class="boosted-elements-mini-cart-empty"><?php esc_html_e('No products in the cart.', 'boosted-elements-progression'); ?></div></li>
		<?php endif; ?>
        
    </ul>
	
    
	
	<?php
	$fragments['#boosted-elements-cart-product-list'] = ob_get_clean();
	return $fragments;

}



add_filter('woocommerce_add_to_cart_fragments', 'boosted_elements_woocommerce_cart_subtotal');
function boosted_elements_woocommerce_cart_subtotal( $fragments ) {
	global $woocommerce;
	ob_start();
	?>

   <div id="boosted-elements-mini-cart-subtotal"><?php esc_html_e('Subtotal:', 'boosted-elements-progression'); ?> <span class="boosted-elements-total-number-add"><?php echo wp_kses($woocommerce->cart->get_cart_subtotal(), true ); ?></span> </div>
	
	<?php
	$fragments['#boosted-elements-mini-cart-subtotal'] = ob_get_clean();
	return $fragments;

}
