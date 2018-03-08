<?php
/**
 * WooCommerce compatibility.
 */

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}

/*  WooCommerce Extra Features
 *
 * Change number of related products on product page
 * ==================================== */

if ( ! function_exists( 'delicio_wc_menu_cartitem' ) ) :
/**
 * Generates list item for WooCommerce cart to be used in nav menu.
 */
function delicio_wc_menu_cartitem() {
	global $woocommerce;

	if ( ! current_theme_supports( 'woocommerce' ) ) return;
	if ( ! option::is_on( 'cart_icon' ) ) return;

	return '<li class="menu-item"><a href="' . wc_get_cart_url() . '" title="' . __( 'View your shopping cart', 'wpzoom' ) . '" class="cart-button">' . '<span>' . sprintf( _n( '%d item &ndash; ', '%d items &ndash; ', $woocommerce->cart->get_cart_contents_count(), 'wpzoom' ), $woocommerce->cart->get_cart_contents_count() ) . $woocommerce->cart->get_cart_total() . '</span></a></li>';
}
endif;

if ( ! function_exists( 'delicio_add_to_cart_fragment' ) ) :
function delicio_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	?>
	<a class="cart-button" href="<?php echo wc_get_cart_url(); ?>"
	   title="<?php _e( 'View your shopping cart', 'wpzoom' ); ?>"><?php echo sprintf( _n( '%d item', '%d items', $woocommerce->cart->cart_contents_count, 'wpzoom' ), $woocommerce->cart->cart_contents_count ); ?> &ndash; <?php echo $woocommerce->cart->get_cart_total(); ?></a>
	<?php

	$fragments['a.cart-button'] = ob_get_clean();

	return $fragments;
}
endif;
add_filter( 'add_to_cart_fragments', 'delicio_add_to_cart_fragment' );

if ( ! function_exists( 'delicio_woocommerce_breadcrumbs' ) ) :
function delicio_woocommerce_breadcrumbs( $defaults ) {
    $defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb"><div class="wrapper">';
    $defaults['wrap_after'] = '</div></nav>';
    return $defaults;
}
endif;
add_filter( 'woocommerce_breadcrumb_defaults', 'delicio_woocommerce_breadcrumbs' );