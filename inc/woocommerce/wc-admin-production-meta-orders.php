<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wpdb;

// Get the payment gateway
if(!function_exists('wc_get_orders_of_production')) {
    require_once 'wc-prod-functions.php';
}
global $post;
//$order_ids = wc_get_orders_of_production($post->ID);
//$payment_gateway = wc_get_payment_gateway_by_order( $order );

// Get line items
/*
$line_items          = $order->get_items( apply_filters( 'woocommerce_admin_order_item_types', 'line_item' ) );
$discounts           = $order->get_items( 'discount' );
$line_items_fee      = $order->get_items( 'fee' );
$line_items_shipping = $order->get_items( 'shipping' );
*/
if ( ! class_exists( 'Order_List_Table' ) ) {
    require_once( 'Order_List_Table.php' );
}
//global $post_type_object, $wpdb;
global $orders, $product_id;
$orders = wc_get_orders_of_production($post->ID);
$product_id = get_post_meta($post->ID, '_product_id', true);

$exampleListTable = new Order_List_Table();
$exampleListTable->prepare_items();
?>
    <div class="wrap">
        <div id="icon-users" class="icon32"></div>
        
        <?php $exampleListTable->display(); ?>
    </div>
                        