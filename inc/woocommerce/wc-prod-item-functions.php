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

        $paymethod = $order->get_payment_method_title();
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

function  wc_associate_order_item_to_prod_item( $order_id , $order_item_id ) {
    $order = wc_get_order($order_id);//<--check this line

    $paymethod = $order->get_payment_method_title();
    $orderstat = $order->get_status();


    $item = $order->get_item($order_item_id);
    $production_id = $item->get_meta('_production_id');
    if($production_id == '') {            
        
        $product_id = $item['product_id'];
        
        $new_production_id = wc_get_not_stated_production_item ($product_id);
        
        if( $new_production_id == null ) {
            return -1;
        }
        $item->add_meta_data( '_production_id', $new_production_id, true );
        $item->save_meta_data();
    }

    return $new_production_id;

}



function wc_add_prod_item( $product_id ) {
    $production_id = wc_get_not_stated_production_item ($product_id);
    $product = wc_get_product($product_id);
    $numb = wc_get_count_production_items($product_id);
    if($production_id == '') {
        $production_id = wp_insert_post(array('post_title'=> $product->get_name().'_production_' . ++$numb, 'post_type'=>'shop_production', 'post_content'=>'demo text' , 'post_status' => 'wc-not-started'));
        add_post_meta($production_id, '_product_id', $product_id, true);        
    }
    return $production_id; 
}

function wc_get_not_stated_production_item ($product_id) {
    $production_ids = get_post_ids_by_meta_key_and_value('_product_id', $product_id);
    if(!is_array($production_ids)) {        
        return '';
    }    
    foreach($production_ids as $production_id) {
        if (get_post_status($production_id) == 'wc-not-started' ) {
            return $production_id;            
        }
    }
    return '';
}

function wc_get_count_production_items( $product_id ) {
    $production_ids = get_post_ids_by_meta_key_and_value('_product_id', $product_id);
    return count($production_ids);
}

function wc_get_prod_total_ordered_item( $production_id ) {
        if(!function_exists('wc_get_order_items_of_production'))
            require_once 'wc-prod-functions.php';
        $qty = 0;
        $order_items = wc_get_order_items_of_production($production_id);    
        if(isset($order_tems) && is_array($order_tems)) {
            foreach($order_items as $order_item){
                $qty += $order_item->get_quantity();            
            } 
        }
        return $qty;
}

function wc_get_prod_min_order( $production_id ) {
    $production = new WC_Production($production_id);    
    return intval($production->get_production_minimum());
}

function wc_get_time_ordering_closure($production_id) {
 $production = new WC_Production($production_id);      
 $date = new DateTime($production->get_production_date());
 //default: 10 days before 
 return $date->sub(new DateInterval('P10D')); 
}

function wc_get_production_end($production_id) {
 $production = new WC_Production($production_id);      
 return new DateTime($production->get_production_end());
}

function wc_get_production_date($production_id) {
 $production = new WC_Production($production_id);      
 return new DateTime($production->get_production_date());
}

function wc_get_production_status($production_id) {
 $production = new WC_Production($production_id);      
 return $production->get_status();
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

    $paymethod = $order->get_payment_method_title();
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
		'wc-not-started'    => _x( 'Not Started', 'Production status', 'woocommerce' ),
		'wc-supplies-ordered' => _x( 'Supplies Ordered', 'Production status', 'woocommerce' ),
		'wc-supp-delivered'    => _x( 'Supplies Delivered', 'Production status', 'woocommerce' ),
		'wc-in-production'  => _x( 'In Production', 'Production status', 'woocommerce' ),
		'wc-prd-completed'  => _x( 'Production Completed', 'Production status', 'woocommerce' )		
	);
	return $production_statuses;
}

function wc_get_production_product($production_id) {
    $product_id = get_post_meta($production_id, '_product_id', true);
    return wc_get_product($product_id);
}



/**
* Register our custom post statuses, used for order status.
*/
function wc_register_production_status() {
        //0. Not Started.
//1. Supplies Ordered.
//1. Supplies Delivered.
//2. In Production.
//3. Production Completed.
//4. In Delivery.
//5. Delivery Completed.
        $production_statuses = array(
                        'wc-not-started'    => array(
                                'label'                     => _x( 'Not Started', 'Production status', 'woocommerce' ),
                                'public'                    => false,
                                'exclude_from_search'       => false,
                                'show_in_admin_all_list'    => true,
                                'show_in_admin_status_list' => true,
                                'label_count'               => _n_noop( 'Not started <span class="count">(%s)</span>', 'Pending start <span class="count">(%s)</span>', 'woocommerce' ),
                        ),
                        'wc-supplies-ordered' => array(
                                'label'                     => _x( 'Supplies Ordered', 'Production status', 'woocommerce' ),
                                'public'                    => false,
                                'exclude_from_search'       => false,
                                'show_in_admin_all_list'    => true,
                                'show_in_admin_status_list' => true,
                                'label_count'               => _n_noop( 'Supplies ordered <span class="count">(%s)</span>', 'Supplies ordered <span class="count">(%s)</span>', 'woocommerce' ),
                        ),
                        'wc-supp-delivered'    => array(
                                'label'                     => _x( 'Supplies Delivered', 'Production status', 'woocommerce' ),
                                'public'                    => false,
                                'exclude_from_search'       => false,
                                'show_in_admin_all_list'    => true,
                                'show_in_admin_status_list' => true,
                                'label_count'               => _n_noop( 'Supplies Delivered <span class="count">(%s)</span>', 'Supplies Delivered <span class="count">(%s)</span>', 'woocommerce' ),
                        ),
                        'wc-in-production'  => array(
                                'label'                     => _x( 'In Production', 'Production status', 'woocommerce' ),
                                'public'                    => false,
                                'exclude_from_search'       => false,
                                'show_in_admin_all_list'    => true,
                                'show_in_admin_status_list' => true,
                                'label_count'               => _n_noop( 'Completed <span class="count">(%s)</span>', 'Completed <span class="count">(%s)</span>', 'woocommerce' ),
                        ),
                        'wc-prd-completed'  => array(
                                'label'                     => _x( 'Production Completed', 'Production status', 'woocommerce' ),
                                'public'                    => false,
                                'exclude_from_search'       => false,
                                'show_in_admin_all_list'    => true,
                                'show_in_admin_status_list' => true,
                                'label_count'               => _n_noop( 'Production Completed <span class="count">(%s)</span>', 'Production Completed <span class="count">(%s)</span>', 'woocommerce' ),
                        )
                );
        

        foreach ( $production_statuses as $production_status => $values ) {
                register_post_status( $production_status, $values );
        }
}
add_action( 'init', 'wc_register_production_status', 60, 2 );