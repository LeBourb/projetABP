<?php
/**
 * WooCommerce Order Item Functions
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
function wc_add_prod_item( $prod_id, $item_array ) {
	$prod_id = absint( $prod_id );

	if ( ! $prod_id ) {
		return false;
	}

	$defaults = array(
		'prod_item_name' => '',
		'prod_item_type' => 'line_item',
	);

	$item_array = wp_parse_args( $item_array, $defaults );
	$data_store = WC_Data_Store::load( 'prod-item' );
	$item_id    = $data_store->add_prod_item( $prod_id, $item_array );
	$item       = WC_Order_Factory::get_prod_item( $item_id );

	do_action( 'woocommerce_new_prod_item', $item_id, $item, $prod_id );

	return $item_id;
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
 * WooCommerce Order Item Meta API - Update term meta.
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
 * WooCommerce Order Item Meta API - Add term meta.
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
 * WooCommerce Order Item Meta API - Delete term meta.
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
 * WooCommerce Order Item Meta API - Get term meta.
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
