<?php

add_filter( 'woocommerce_enable_admin_help_tab', '__return_false');


//Remove WooCommerce Generator tag, styles, and scripts from non WooCommerce pages.
    add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_styles', 99 );

    function child_manage_woocommerce_styles() {

    //remove generator meta tag
    remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );

    //first check that woo exists to prevent fatal errors
    if ( function_exists( 'is_woocommerce' ) ) {

        //dequeue scripts and styles
        if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ) {
        wp_dequeue_style( 'woocommerce_frontend_styles' );
        wp_dequeue_style( 'woocommerce_fancybox_styles' );
        wp_dequeue_style( 'woocommerce_chosen_styles' );
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
        wp_dequeue_script( 'wc_price_slider' );
        wp_dequeue_script( 'wc-single-product' );
        wp_dequeue_script( 'wc-add-to-cart' );
        wp_dequeue_script( 'wc-cart-fragments' );
        wp_dequeue_script( 'wc-checkout' );
        wp_dequeue_script( 'wc-add-to-cart-variation' );
        wp_dequeue_script( 'wc-single-product' );
        wp_dequeue_script( 'wc-cart' );
        wp_dequeue_script( 'wc-chosen' );
        wp_dequeue_script( 'woocommerce' );
        wp_dequeue_script( 'prettyPhoto' );
        wp_dequeue_script( 'prettyPhoto-init' );
        wp_dequeue_script( 'jquery-blockui' );
        wp_dequeue_script( 'jquery-placeholder' );
        wp_dequeue_script( 'fancybox' );
        wp_dequeue_script( 'jqueryui' );
        }
    }
}

// Change the order of the endpoints that appear in My Account Page
    function st_woo_my_account_order() {
        $myorder = array(
        'edit-account' => __( 'Account Details', 'woocommerce' ),
        'orders' => __( 'My Orders', 'woocommerce' ),
        'edit-address' => __( 'Billing Address', 'woocommerce' ),
        'payment-methods' => __( 'Payment Methods', 'woocommerce' ),
        'customer-logout' => __( 'Logout', 'woocommerce' ),
        );
        return $myorder;
    }
    add_filter ( 'woocommerce_account_menu_items', 'st_woo_my_account_order' );

// Change cart subscription price string

function wc_subscriptions_custom_price_string( $pricestring ) {
    $pricestring = str_replace( 'with', 'after a', $pricestring );
    $pricestring = str_replace( 'free trial and a', 'trial for', $pricestring );
    $pricestring = str_replace( 'sign-up fee', '', $pricestring );

    return $pricestring;
}
add_filter( 'woocommerce_subscriptions_product_price_string', 'wc_subscriptions_custom_price_string' );
add_filter( 'woocommerce_subscription_price_string', 'wc_subscriptions_custom_price_string' );


add_filter( 'wc_memberships_allow_cumulative_member_discounts', '__return_false' );


// Checks if coupon can be applied by the current user (based on membership)
function st_can_use_coupon( $coupon ) {

	// Maybe apply restriction for members
	if ( wc_memberships_is_user_member() ) {
		// file_put_contents( 'test.txt', print_r(get_field( 'allow_members', $coupon->get_id() ), true);

		// If Allow checkbox is checked, allow them to use it
		if ( is_object( $coupon ) && get_field( 'allow_members', $coupon->get_id() ) == true ) {
			return true;
		}

		// Otherwise restrict
		else {
			return false;
		}
	}
	// Non-members can always use the coupons
	return true;
}

// Now doing the filtering
add_action( 'init', function() {

	// Disable / Enable coupons based on the setting on the coupon screen
	add_filter( 'woocommerce_coupon_is_valid', function( $valid, $coupon, $discount ){

		$valid = st_can_use_coupon( $coupon );
		return $valid;

	}, 10, 3 );

	// Set up the custom error message
	add_filter( 'woocommerce_coupon_error', function( $message, $code, $coupon ) {

		if ( wc_memberships_is_user_member() && $code == 100 && is_object( $coupon ) && get_field( 'allow_members', $coupon->get_id() ) == false ) {
			$message = __( 'Coupon code cannot be applied to one or more of the member discounted products in your cart.', 'woocommerce' );
		}
		return $message;

	}, 10, 3 );

} );

// auto update cart after quantity change
add_action( 'wp_footer', 'auto_cart_refresh_update_qty' ); 
 
function auto_cart_refresh_update_qty() { 
    if (is_cart()) { 
        ?> 
        <script type="text/javascript"> 
            jQuery('div.woocommerce').on('click', 'input.qty', function(){ 
                jQuery("[name='update_cart']").trigger("click"); 
            }); 
        </script> 
        <?php 
    } 
}

// Login Redirect to /dashboard page

function dashboard_login_redirect( $redirect, $user ) {
    $user_id = $user->ID;
    $redirect = 'https://www.simplertrading.com/dashboard';
    return $redirect;
}

add_filter( 'woocommerce_login_redirect', 'dashboard_login_redirect' );

?>