<?php
/**
 * WooCommerce Production Item Functions
 *
 * Functions for prod specific things.
 *
 * @author      WooThemes
 * @category    Core
 * @package     WooCommerce/Functions
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add a item to an prod (for example a line item).
 *
 * @param int $prod_id
 * @param array $item_array
 * @return int|bool Item ID or false
 */
function wc_add_prod_items( $order_id ) {
	$prod_id = absint( $order_id );
        

	if ( ! $prod_id ) {
		return false;
	}
        
        $order = wc_get_order($order_id);//<--check this line

        $paymethod = $order->payment_method_title;
        $orderstat = $order->get_status();

        $items = $order->get_items();
        $array_ids = array();

        foreach ( $items as $item ) {
            $product_name = $item['name'];
            $product_id = $item['product_id'];
            $product_variation_id = $item['variation_id'];

            
            $defaults = array(
                    'prod_item_name' => '',
                    'prod_item_type' => 'line_item',
            );
            
            

            $product = wc_get_product( $product_id );
            $post_id = get_post_id_by_meta_key_and_value('_product_id', $product_id);
            if($post_id == null){
                $id = wp_insert_post(array('post_title'=> $product->get_name().'_production', 'post_type'=>'shop_production', 'post_content'=>'demo text'));
                add_post_meta($id, '_product_id', $product_id, true);
                if(!in_array($id,$array_ids)) {
                    $array_ids[] = $id;
                }                
            }else {
                if(!in_array($post_id,$array_ids)) {
                    $array_ids[] = $post_id;
                }
            }

        }
        
        return $array_ids;

}

/**
 * Update an item for an prod.
 *
 * @since 2.2
 * @param int $item_id
 * @param array $args either `prod_item_type` or `prod_item_name`
 * @return bool true if successfully updated, false otherwise
 */
function wc_update_prod_item( $item_id, $args ) {
	$data_store = WC_Data_Store::load( 'prod-item' );
	$update     = $data_store->update_prod_item( $item_id, $args );

	if ( false === $update ) {
		return false;
	}

	do_action( 'woocommerce_update_prod_item', $item_id, $args );

	return true;
}

/**
 * Delete an item from the prod it belongs to based on item id.
 *
 * @access public
 * @param int $item_id
 * @return bool
 */
function wc_delete_prod_item( $item_id ) {

	if ( ! $item_id = absint( $item_id ) ) {
		return false;
	}

	$data_store = WC_Data_Store::load( 'prod-item' );

	do_action( 'woocommerce_before_delete_prod_item', $item_id );

	$data_store->delete_prod_item( $item_id );

	do_action( 'woocommerce_delete_prod_item', $item_id );

	return true;
}

/**
 * WooCommerce Production Item Meta API - Update term meta.
 *
 * @access public
 * @param mixed $item_id
 * @param mixed $meta_key
 * @param mixed $meta_value
 * @param string $prev_value (default: '')
 * @return bool
 */
function wc_update_prod_item_meta( $item_id, $meta_key, $meta_value, $prev_value = '' ) {
	$data_store = WC_Data_Store::load( 'prod-item' );
	if ( $data_store->update_metadata( $item_id, $meta_key, $meta_value, $prev_value ) ) {
		WC_Cache_Helper::incr_cache_prefix( 'object_' . $item_id ); // Invalidate cache.
		return true;
	}
	return false;
}

/**
 * WooCommerce Production Item Meta API - Add term meta.
 *
 * @access public
 * @param mixed $item_id
 * @param mixed $meta_key
 * @param mixed $meta_value
 * @param bool $unique (default: false)
 * @return int New row ID or 0
 */
function wc_add_prod_item_meta( $item_id, $meta_key, $meta_value, $unique = false ) {
        
	$data_store = WC_Data_Store::load( 'prod-item' );
	if ( $meta_id = $data_store->add_metadata( $item_id, $meta_key, $meta_value, $unique ) ) {
		WC_Cache_Helper::incr_cache_prefix( 'object_' . $item_id ); // Invalidate cache.
		return $meta_id;
	}
	return 0;
}

/**
 * WooCommerce Production Item Meta API - Delete term meta.
 *
 * @access public
 * @param mixed $item_id
 * @param mixed $meta_key
 * @param string $meta_value (default: '')
 * @param bool $delete_all (default: false)
 * @return bool
 */
function wc_delete_prod_item_meta( $item_id, $meta_key, $meta_value = '', $delete_all = false ) {
	$data_store = WC_Data_Store::load( 'prod-item' );
	if ( $data_store->delete_metadata( $item_id, $meta_key, $meta_value, $delete_all ) ) {
		WC_Cache_Helper::incr_cache_prefix( 'object_' . $item_id ); // Invalidate cache.
		return true;
	}
	return false;
}

/**
 * WooCommerce Production Item Meta API - Get term meta.
 *
 * @access public
 * @param mixed $item_id
 * @param mixed $key
 * @param bool $single (default: true)
 * @return mixed
 */
function wc_get_prod_item_meta( $item_id, $key, $single = true ) {
	$data_store = WC_Data_Store::load( 'prod-item' );
	return $data_store->get_metadata( $item_id, $key, $single );
}

/**
 * Get prod ID by prod item ID.
 *
 * @param  int $item_id
 * @return int
 */
function wc_get_prod_id_by_prod_item_id( $item_id ) {
	$data_store = WC_Data_Store::load( 'prod-item' );
	return $data_store->get_prod_id_by_prod_item_id( $item_id );
}


add_action('woocommerce_thankyou', 'add_to_production_item', 10, 1);

function add_to_production_item($order_id) { //<--check this line

    //create an order instance
    $order = wc_get_order($order_id);//<--check this line

    $paymethod = $order->payment_method_title;
    $orderstat = $order->get_status();
    
    $items = $order->get_items();


    foreach ( $items as $item ) {
        $product_name = $item['name'];
        $product_id = $item['product_id'];
        $product_variation_id = $item['variation_id'];
        
       // wc_add_prod_item($product_id, $order_id);
        
        
    }

    
}



/**
 * Get all order statuses.
 *
 * @since 2.2
 * @used-by WC_Production::set_status
 * @return array
 */
function wc_get_production_statuses() {
	$production_statuses = array(
		'wc-pending'    => _x( 'Pending payment', 'Production status', 'woocommerce' ),
		'wc-processing' => _x( 'Processing', 'Production status', 'woocommerce' ),
		'wc-on-hold'    => _x( 'On hold', 'Production status', 'woocommerce' ),
		'wc-completed'  => _x( 'Completed', 'Production status', 'woocommerce' ),
		'wc-cancelled'  => _x( 'Cancelled', 'Production status', 'woocommerce' ),
		'wc-refunded'   => _x( 'Refunded', 'Production status', 'woocommerce' ),
		'wc-failed'     => _x( 'Failed', 'Production status', 'woocommerce' ),
	);
	return $production_statuses;
}

function wc_get_production_product($production_id) {
    $product_id = get_post_meta($production_id, '_product_id', true);
    return wc_get_product($product_id);
}