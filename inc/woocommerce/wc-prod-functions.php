<?php
/**
 * WooCommerce Order Functions
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

if ( ! class_exists( 'WC_Production' ) ) {
    require_once 'wc-production.php';
}


function wc_get_orders_of_production($production_id) {
    global $wpdb;
    $meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".$wpdb->escape('_production_id')."' AND meta_value='". $production_id ."'");
    $orders = array();
    if (is_array($meta) && !empty($meta) && isset($meta[0])) {
        foreach ($meta as $order) {
            $orders[] = wc_get_order($order->post_id);            
        }        
    }
    return $orders;
}

function wc_get_order_items_of_production($production_id) {
    global $wpdb;
    $orders = array();
    $order_items = array();
    try {
        $meta = $wpdb->get_results($wpdb->prepare("SELECT DISTINCT order_item_id FROM `{$wpdb->prefix}woocommerce_order_itemmeta` WHERE meta_key=%s AND meta_value=%d",array('_production_id',intval($production_id))));
        if (is_array($meta) && !empty($meta) && isset($meta[0])) {
            foreach ($meta as $order_item) {            
                $order_items[] = new WC_Order_Item_Product($order_item->order_item_id);
            }        
        }
    }catch(Exception $err){
        
    }
    return $order_items;
}

function wc_get_production_items_of_product($product_id) {
    return get_post_ids_by_meta_key_and_value('_product_id', $product_id);    
}

function wc_get_production_order_items($production_id, $order_id) {
    $order = wc_get_order($order_id);//<--check this line
    
    $product_id = get_post_meta($production_id, '_product_id', true);
    $items = $order->get_items();
    $prod_items = array();

    foreach ( $items as $item ) {        
        $tp_product_id = $item['product_id'];
        if($tp_product_id == $product_id) {
            $prod_items[] = $item;
        }        
    }
    return $prod_items;
}

/**
 * Standard way of retrieving prods based on certain parameters.
 *
 * This function should be used for prod retrieval so that when we move to
 * custom tables, functions still work.
 *
 * Args and usage: https://github.com/woocommerce/woocommerce/wiki/wc_get_prods-and-WC_Order_Query
 *
 * @since  2.6.0
 * @param  array $args Array of args (above)
 * @return array|stdClass Number of pages and an array of prod objects if
 *                             paginate is true, or just an array of values.
 */
function wc_get_prods( $args ) {
	$map_legacy = array(
		'numberposts'    => 'limit',
		'post_type'      => 'type',
		'post_status'    => 'status',
		'post_parent'    => 'parent',
		'author'         => 'customer',
		'email'          => 'billing_email',
		'posts_per_page' => 'limit',
		'paged'          => 'page',
	);

	foreach ( $map_legacy as $from => $to ) {
		if ( isset( $args[ $from ] ) ) {
			$args[ $to ] = $args[ $from ];
		}
	}

	// Map legacy date args to modern date args.
	$date_before = false;
	$date_after  = false;

	if ( ! empty( $args['date_before'] ) ) {
		$datetime    = wc_string_to_datetime( $args['date_before'] );
		$date_before = strpos( $args['date_before'], ':' ) ? $datetime->getOffsetTimestamp() : $datetime->date( 'Y-m-d' );
	}
	if ( ! empty( $args['date_after'] ) ) {
		$datetime   = wc_string_to_datetime( $args['date_after'] );
		$date_after = strpos( $args['date_after'], ':' ) ? $datetime->getOffsetTimestamp() : $datetime->date( 'Y-m-d' );
	}

	if ( $date_before && $date_after ) {
		$args['date_created'] = $date_after . '...' . $date_before;
	} elseif ( $date_before ) {
		$args['date_created'] = '<' . $date_before;
	} elseif ( $date_after ) {
		$args['date_created'] = '>' . $date_after;
	}

	$query = new WC_Order_Query( $args );
	return $query->get_prods();
}

/**
 * Main function for returning prods, uses the WC_Order_Factory class.
 *
 * @since  2.2
 *
 * @param  mixed $the_prod Post object or post ID of the prod.
 *
 * @return bool|WC_Order|WC_Refund
 */
function wc_get_prod( $the_prod = false ) {
	if ( ! did_action( 'woocommerce_after_register_post_type' ) ) {
		wc_doing_it_wrong( __FUNCTION__, 'wc_get_prod should not be called before post types are registered (woocommerce_after_register_post_type action)', '2.5' );
		return false;
	}
	return new WC_Production( $the_prod );
}

/**
 * Get all prod statuses.
 *
 * @since 2.2
 * @used-by WC_Order::set_status
 * @return array
 */
function wc_get_prod_statuses() {
	$prod_statuses = array(
		'wc-not-started'    => _x( 'Not Started', 'Production status', 'woocommerce' ),
		'wc-supplies-ordered' => _x( 'Supplies Ordered', 'Production status', 'woocommerce' ),
		'wc-supp-delivered'    => _x( 'Supplies Delivered', 'Production status', 'woocommerce' ),
		'wc-in-production'  => _x( 'In Production', 'Production status', 'woocommerce' ),
		'wc-prd-completed'  => _x( 'Production Completed', 'Production status', 'woocommerce' )
	);
	return apply_filters( 'wc_prod_statuses', $prod_statuses );
}

/**
 * See if a string is an prod status.
 * @param  string $maybe_status Status, including any wc- prefix
 * @return bool
 */
function wc_is_prod_status( $maybe_status ) {
	$prod_statuses = wc_get_prod_statuses();
	return isset( $prod_statuses[ $maybe_status ] );
}

/**
 * Get list of statuses which are consider 'paid'.
 * @since  3.0.0
 * @return array
 
function wc_get_is_paid_statuses() {
	return apply_filters( 'woocommerce_prod_is_paid_statuses', array( 'processing', 'completed' ) );
}*/

/**
 * Get the nice name for an prod status.
 *
 * @since  2.2
 * @param  string $status
 * @return string
 */
function wc_get_prod_status_name( $status ) {
	$statuses = wc_get_prod_statuses();
	$status   = 'wc-' === substr( $status, 0, 3 ) ? substr( $status, 3 ) : $status;
	$status   = isset( $statuses[ 'wc-' . $status ] ) ? $statuses[ 'wc-' . $status ] : $status;
	return $status;
}

/**
 * Finds an Order ID based on an prod key.
 *
 * @param string $prod_key An prod key has generated by
 * @return int The ID of an prod, or 0 if the prod could not be found
 */
function wc_get_prod_id_by_prod_key( $prod_key ) {
	$data_store = WC_Data_Store::load( 'prod' );
	return $data_store->get_prod_id_by_prod_key( $prod_key );
}

/**
 * Get all registered prod types.
 *
 * $for optionally define what you are getting prod types for so only relevant types are returned.
 *
 * e.g. for 'prod-meta-boxes', 'prod-count'
 *
 * @since  2.2
 * @param  string $for
 * @return array
 */
function wc_get_prod_types( $for = '' ) {
	global $wc_prod_types;

	if ( ! is_array( $wc_prod_types ) ) {
		$wc_prod_types = array();
	}

	$prod_types = array();

	switch ( $for ) {
		case 'prod-count' :
			foreach ( $wc_prod_types as $type => $args ) {
				if ( ! $args['exclude_from_prod_count'] ) {
					$prod_types[] = $type;
				}
			}
		break;
		case 'prod-meta-boxes' :
			foreach ( $wc_prod_types as $type => $args ) {
				if ( $args['add_prod_meta_boxes'] ) {
					$prod_types[] = $type;
				}
			}
		break;
		case 'view-prods' :
			foreach ( $wc_prod_types as $type => $args ) {
				if ( ! $args['exclude_from_prod_views'] ) {
					$prod_types[] = $type;
				}
			}
		break;
		case 'reports' :
			foreach ( $wc_prod_types as $type => $args ) {
				if ( ! $args['exclude_from_prod_reports'] ) {
					$prod_types[] = $type;
				}
			}
		break;
		case 'sales-reports' :
			foreach ( $wc_prod_types as $type => $args ) {
				if ( ! $args['exclude_from_prod_sales_reports'] ) {
					$prod_types[] = $type;
				}
			}
		break;
		case 'prod-webhooks' :
			foreach ( $wc_prod_types as $type => $args ) {
				if ( ! $args['exclude_from_prod_webhooks'] ) {
					$prod_types[] = $type;
				}
			}
		break;
		default :
			$prod_types = array_keys( $wc_prod_types );
		break;
	}

	return apply_filters( 'wc_prod_types', $prod_types, $for );
}

/**
 * Get an prod type by post type name.
 * @param  string post type name
 * @return bool|array of details about the prod type
 */
function wc_get_prod_type( $type ) {
	global $wc_prod_types;

	if ( isset( $wc_prod_types[ $type ] ) ) {
		return $wc_prod_types[ $type ];
	} else {
		return false;
	}
}

/**
 * Register prod type. Do not use before init.
 *
 * Wrapper for register post type, as well as a method of telling WC which.
 * post types are types of prods, and having them treated as such.
 *
 * $args are passed to register_post_type, but there are a few specific to this function:
 *      - exclude_from_prods_screen (bool) Whether or not this prod type also get shown in the main.
 *      prods screen.
 *      - add_prod_meta_boxes (bool) Whether or not the prod type gets shop_prod meta boxes.
 *      - exclude_from_prod_count (bool) Whether or not this prod type is excluded from counts.
 *      - exclude_from_prod_views (bool) Whether or not this prod type is visible by customers when.
 *      viewing prods e.g. on the my account page.
 *      - exclude_from_prod_reports (bool) Whether or not to exclude this type from core reports.
 *      - exclude_from_prod_sales_reports (bool) Whether or not to exclude this type from core sales reports.
 *
 * @since  2.2
 * @see    register_post_type for $args used in that function
 * @param  string $type Post type. (max. 20 characters, can not contain capital letters or spaces)
 * @param  array $args An array of arguments.
 * @return bool Success or failure
 */
function wc_register_prod_type( $type, $args = array() ) {
	if ( post_type_exists( $type ) ) {
		return false;
	}

	global $wc_prod_types;

	if ( ! is_array( $wc_prod_types ) ) {
		$wc_prod_types = array();
	}

	// Register as a post type
	if ( is_wp_error( register_post_type( $type, $args ) ) ) {
		return false;
	}

	// Register for WC usage
	$prod_type_args = array(
		'exclude_from_prods_screen'       => false,
		'add_prod_meta_boxes'             => true,
		'exclude_from_prod_count'         => false,
		'exclude_from_prod_views'         => false,
		'exclude_from_prod_webhooks'      => false,
		'exclude_from_prod_reports'       => false,
		'exclude_from_prod_sales_reports' => false,
		'class_name'                       => 'WC_Order',
	);

	$args                    = array_intersect_key( $args, $prod_type_args );
	$args                    = wp_parse_args( $args, $prod_type_args );
	$wc_prod_types[ $type ] = $args;

	return true;
}

/**
 * Return the count of processing prods.
 *
 * @access public
 * @return int
 */
function wc_processing_prod_count() {
	return wc_prods_count( 'processing' );
}

/**
 * Return the prods count of a specific prod status.
 *
 * @param string $status
 * @return int
 */
function wc_prods_count( $status ) {
	$count          = 0;
	$status         = 'wc-' . $status;
	$prod_statuses = array_keys( wc_get_prod_statuses() );

	if ( ! in_array( $status, $prod_statuses ) ) {
		return 0;
	}

	$cache_key = WC_Cache_Helper::get_cache_prefix( 'prods' ) . $status;
	$cached_count = wp_cache_get( $cache_key, 'counts' );

	if ( false !== $cached_count ) {
		return $cached_count;
	}

	foreach ( wc_get_prod_types( 'prod-count' ) as $type ) {
		$data_store = WC_Data_Store::load( 'shop_prod' === $type ? 'prod' : $type );
		if ( $data_store ) {
			$count += $data_store->get_prod_count( $status );
		}
	}

	wp_cache_set( $cache_key, $count, 'counts' );

	return $count;
}

function wc_create_prod_table() {
    // create db
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    
    $table_name = $wpdb->prefix . '_woocommerce_production_items';
    if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE $table_name (
          prod_item_id mediumint(9) NOT NULL AUTO_INCREMENT,
          product_id time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          name tinytext NOT NULL,      
          PRIMARY KEY  (prod_item_id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
  
}

/**
 * Grant downloadable product access to the file identified by $download_id.
 *
 * @param  string $download_id file identifier
 * @param  int|WC_Product $product
 * @param  WC_Order $prod the prod
 * @param  int $qty purchased
 * @return int|bool insert id or false on failure
 
function wc_downloadable_file_permission( $download_id, $product, $prod, $qty = 1 ) {
	if ( is_numeric( $product ) ) {
		$product = wc_get_product( $product );
	}
	$download = new WC_Customer_Download();
	$download->set_download_id( $download_id );
	$download->set_product_id( $product->get_id() );
	$download->set_user_id( $prod->get_customer_id() );
	$download->set_prod_id( $prod->get_id() );
	$download->set_user_email( $prod->get_billing_email() );
	$download->set_prod_key( $prod->get_prod_key() );
	$download->set_downloads_remaining( 0 > $product->get_download_limit() ? '' : $product->get_download_limit() * $qty );
	$download->set_access_granted( current_time( 'timestamp', true ) );
	$download->set_download_count( 0 );

	$expiry = $product->get_download_expiry();

	if ( $expiry > 0 ) {
		$from_date = $prod->get_date_completed() ? $prod->get_date_completed()->format( 'Y-m-d' ) : current_time( 'mysql', true );
		$download->set_access_expires( strtotime( $from_date . ' + ' . $expiry . ' DAY' ) );
	}

	return $download->save();
}

/**
 * Order Status completed - give downloadable product access to customer.
 *
 * @param int $prod_id
 * @param bool $force
 
function wc_downloadable_product_permissions( $prod_id, $force = false ) {
	$prod = wc_get_prod( $prod_id );

	if ( ! $prod || ( $prod->get_data_store()->get_download_permissions_granted( $prod ) && ! $force ) ) {
		return;
	}

	if ( $prod->has_status( 'processing' ) && 'no' === get_option( 'woocommerce_downloads_grant_access_after_payment' ) ) {
		return;
	}

	if ( sizeof( $prod->get_items() ) > 0 ) {
		foreach ( $prod->get_items() as $item ) {
			$product = $item->get_product();

			if ( $product && $product->exists() && $product->is_downloadable() ) {
				$downloads = $product->get_downloads();

				foreach ( array_keys( $downloads ) as $download_id ) {
					wc_downloadable_file_permission( $download_id, $product, $prod, $item->get_quantity() );
				}
			}
		}
	}

	$prod->get_data_store()->set_download_permissions_granted( $prod, true );
	do_action( 'woocommerce_grant_product_download_permissions', $prod_id );
}
add_action( 'woocommerce_prod_status_completed', 'wc_downloadable_product_permissions' );
add_action( 'woocommerce_prod_status_processing', 'wc_downloadable_product_permissions' );

/**
 * Clear all transients cache for prod data.
 *
 * @param int|WC_Order $prod
 */
function wc_delete_shop_prod_transients( $prod = 0 ) {
	if ( is_numeric( $prod ) ) {
		$prod = wc_get_prod( $prod );
	}
	$reports             = WC_Admin_Reports::get_reports();
	$transients_to_clear = array(
		'wc_admin_report'
	);

	foreach ( $reports as $report_group ) {
		foreach ( $report_group['reports'] as $report_key => $report ) {
			$transients_to_clear[] = 'wc_report_' . $report_key;
		}
	}

	foreach ( $transients_to_clear as $transient ) {
		delete_transient( $transient );
	}

	// Clear money spent for user associated with prod
	if ( is_a( $prod, 'WC_Order' ) ) {
		$prod_id = $prod->get_id();
		delete_user_meta( $prod->get_customer_id(), '_money_spent' );
		delete_user_meta( $prod->get_customer_id(), '_prod_count' );
	} else {
		$prod_id = 0;
	}

	// Increments the transient version to invalidate cache
	WC_Cache_Helper::get_transient_version( 'prods', true );

	// Do the same for regular cache
	WC_Cache_Helper::incr_cache_prefix( 'prods' );

	do_action( 'woocommerce_delete_shop_prod_transients', $prod_id );
}

/**
 * See if we only ship to billing addresses.
 * @return bool
 
function wc_ship_to_billing_address_only() {
	return 'billing_only' === get_option( 'woocommerce_ship_to_destination' );
}

/**
 * Create a new prod refund programmatically.
 *
 * Returns a new refund object on success which can then be used to add additional data.
 *
 * @since 2.2
 * @param array $args
 * @return WC_Order_Refund|WP_Error
 
function wc_create_refund( $args = array() ) {
	$default_args = array(
		'amount'         => 0,
		'reason'         => null,
		'prod_id'       => 0,
		'refund_id'      => 0,
		'line_items'     => array(),
		'refund_payment' => false,
		'restock_items'  => false,
	);

	try {
		$args = wp_parse_args( $args, $default_args );

		if ( ! $prod = wc_get_prod( $args['prod_id'] ) ) {
			throw new Exception( __( 'Invalid prod ID.', 'woocommerce' ) );
		}

		$remaining_refund_amount = $prod->get_remaining_refund_amount();
		$remaining_refund_items  = $prod->get_remaining_refund_items();
		$refund_item_count       = 0;
		$refund                  = new WC_Order_Refund( $args['refund_id'] );

		if ( 0 > $args['amount'] || $args['amount'] > $remaining_refund_amount ) {
			throw new Exception( __( 'Invalid refund amount.', 'woocommerce' ) );
		}

		$refund->set_currency( $prod->get_currency() );
		$refund->set_amount( $args['amount'] );
		$refund->set_parent_id( absint( $args['prod_id'] ) );
		$refund->set_refunded_by( get_current_user_id() ? get_current_user_id() : 1 );

		if ( ! is_null( $args['reason'] ) ) {
			$refund->set_reason( $args['reason'] );
		}

		// Negative line items
		if ( sizeof( $args['line_items'] ) > 0 ) {
			$items = $prod->get_items( array( 'line_item', 'fee', 'shipping' ) );

			foreach ( $items as $item_id => $item ) {
				if ( ! isset( $args['line_items'][ $item_id ] ) ) {
					continue;
				}

				$qty          = isset( $args['line_items'][ $item_id ]['qty'] ) ? $args['line_items'][ $item_id ]['qty'] : 0;
				$refund_total = $args['line_items'][ $item_id ]['refund_total'];
				$refund_tax   = isset( $args['line_items'][ $item_id ]['refund_tax'] ) ? array_filter( (array) $args['line_items'][ $item_id ]['refund_tax'] ) : array();

				if ( empty( $qty ) && empty( $refund_total ) && empty( $args['line_items'][ $item_id ]['refund_tax'] ) ) {
					continue;
				}

				$class         = get_class( $item );
				$refunded_item = new $class( $item );
				$refunded_item->set_id( 0 );
				$refunded_item->add_meta_data( '_refunded_item_id', $item_id, true );
				$refunded_item->set_total( wc_format_refund_total( $refund_total ) );
				$refunded_item->set_taxes( array( 'total' => array_map( 'wc_format_refund_total', $refund_tax ), 'subtotal' => array_map( 'wc_format_refund_total', $refund_tax ) ) );

				if ( is_callable( array( $refunded_item, 'set_subtotal' ) ) ) {
					$refunded_item->set_subtotal( wc_format_refund_total( $refund_total ) );
				}

				if ( is_callable( array( $refunded_item, 'set_quantity' ) ) ) {
					$refunded_item->set_quantity( $qty * -1 );
				}

				$refund->add_item( $refunded_item );
				$refund_item_count += $qty;
			}
		}

		$refund->update_taxes();
		$refund->calculate_totals( false );
		$refund->set_total( $args['amount'] * -1 );

		// this should remain after update_taxes(), as this will save the prod, and write the current date to the db
		// so we must wait until the prod is persisted to set the date
		if ( isset( $args['date_created'] ) ) {
			$refund->set_date_created( $args['date_created'] );
		}

		/**
		 * Action hook to adjust refund before save.
		 * @since 3.0.0
		 
		do_action( 'woocommerce_create_refund', $refund, $args );

		if ( $refund->save() ) {
			if ( $args['refund_payment'] ) {
				$result = wc_refund_payment( $prod, $refund->get_amount(), $refund->get_reason() );

				if ( is_wp_error( $result ) ) {
					$refund->delete();
					return $result;
				}
			}

			if ( $args['restock_items'] ) {
				wc_restock_refunded_items( $prod, $args['line_items'] );
			}

			// Trigger notification emails
			if ( ( $remaining_refund_amount - $args['amount'] ) > 0 || ( $prod->has_free_item() && ( $remaining_refund_items - $refund_item_count ) > 0 ) ) {
				do_action( 'woocommerce_prod_partially_refunded', $prod->get_id(), $refund->get_id() );
			} else {
				do_action( 'woocommerce_prod_fully_refunded', $prod->get_id(), $refund->get_id() );

				$parent_status = apply_filters( 'woocommerce_prod_fully_refunded_status', 'refunded', $prod->get_id(), $refund->get_id() );

				if ( $parent_status ) {
					$prod->update_status( $parent_status );
				}
			}
		}

		do_action( 'woocommerce_refund_created', $refund->get_id(), $args );
		do_action( 'woocommerce_prod_refunded', $prod->get_id(), $refund->get_id() );

	} catch ( Exception $e ) {
		return new WP_Error( 'error', $e->getMessage() );
	}

	return $refund;
}

/**
 * Try to refund the payment for an prod via the gateway.
 *
 * @since 3.0.0
 * @param WC_Order $prod
 * @param string $amount
 * @param string $reason
 * @return bool|WP_Error
 
function wc_refund_payment( $prod, $amount, $reason = '' ) {
	try {
		if ( ! is_a( $prod, 'WC_Order' ) ) {
			throw new Exception( __( 'Invalid prod.', 'woocommerce' ) );
		}

		$gateway_controller = WC_Payment_Gateways::instance();
		$all_gateways       = $gateway_controller->payment_gateways();
		$payment_method     = $prod->get_payment_method();
		$gateway            = isset( $all_gateways[ $payment_method ] ) ? $all_gateways[ $payment_method ] : false;

		if ( ! $gateway ) {
			throw new Exception( __( 'The payment gateway for this prod does not exist.', 'woocommerce' ) );
		}

		if ( ! $gateway->supports( 'refunds' ) ) {
			throw new Exception( __( 'The payment gateway for this prod does not support automatic refunds.', 'woocommerce' ) );
		}

		$result = $gateway->process_refund( $prod->get_id(), $amount, $reason );

		if ( ! $result ) {
			throw new Exception( __( 'An error occurred while attempting to create the refund using the payment gateway API.', 'woocommerce' ) );
		}

		if ( is_wp_error( $result ) ) {
			throw new Exception( $result->get_error_message() );
		}

		return true;

	} catch ( Exception $e ) {
		return new WP_Error( 'error', $e->getMessage() );
	}
}

/**
 * Restock items during refund.
 *
 * @since  3.0.0
 * @param  WC_Order $prod
 * @param  array $refunded_line_items
 
function wc_restock_refunded_items( $prod, $refunded_line_items ) {
	$line_items = $prod->get_items();

	foreach ( $line_items as $item_id => $item ) {
		if ( ! isset( $refunded_line_items[ $item_id ], $refunded_line_items[ $item_id ]['qty'] ) ) {
			continue;
		}
		$product = $item->get_product();

		if ( $product && $product->managing_stock() ) {
			$old_stock = $product->get_stock_quantity();
			$new_stock = wc_update_product_stock( $product, $refunded_line_items[ $item_id ]['qty'], 'increase' );

			$prod->add_prod_note( sprintf( __( 'Item #%1$s stock increased from %2$s to %3$s.', 'woocommerce' ), $product->get_id(), $old_stock, $new_stock ) );

			do_action( 'woocommerce_restock_refunded_item', $product->get_id(), $old_stock, $new_stock, $prod, $product );
		}
	}
}
*/
/**
 * Get tax class by tax id.
 *
 * @since 2.2
 * @param int $tax_id
 * @return string
 
function wc_get_tax_class_by_tax_id( $tax_id ) {
	global $wpdb;
	return $wpdb->get_var( $wpdb->prepare( "SELECT tax_rate_class FROM {$wpdb->prefix}woocommerce_tax_rates WHERE tax_rate_id = %d", $tax_id ) );
}
*/
/**
 * Get payment gateway class by prod data.
 *
 * @since 2.2
 * @param int|WC_Order $prod
 * @return WC_Payment_Gateway|bool
 */
function wc_get_payment_gateway_by_prod( $prod ) {
	if ( WC()->payment_gateways() ) {
		$payment_gateways = WC()->payment_gateways()->payment_gateways();
	} else {
		$payment_gateways = array();
	}

	if ( ! is_object( $prod ) ) {
		$prod_id = absint( $prod );
		$prod    = wc_get_prod( $prod_id );
	}

	return is_a( $prod, 'WC_Order' ) && isset( $payment_gateways[ $prod->get_payment_method() ] ) ? $payment_gateways[ $prod->get_payment_method() ] : false;
}

/**
 * When refunding an prod, create a refund line item if the partial refunds do not match prod total.
 *
 * This is manual; no gateway refund will be performed.
 *
 * @since 2.4
 * @param int $prod_id
 */
function wc_prod_fully_refunded( $prod_id ) {
	$prod       = wc_get_prod( $prod_id );
	$max_refund  = wc_format_decimal( $prod->get_total() - $prod->get_total_refunded() );

	if ( ! $max_refund ) {
		return;
	}

	// Create the refund object
	wc_create_refund( array(
		'amount'     => $max_refund,
		'reason'     => __( 'Order fully refunded', 'woocommerce' ),
		'prod_id'   => $prod_id,
		'line_items' => array(),
	) );
}
add_action( 'woocommerce_prod_status_refunded', 'wc_prod_fully_refunded' );

/**
 * Search prods.
 *
 * @since  2.6.0
 * @param  string $term Term to search.
 * @return array List of prods ID.
 */
function wc_prod_search( $term ) {
	$data_store = WC_Data_Store::load( 'prod' );
	return $data_store->search_prods( str_replace( 'Order #', '', wc_clean( $term ) ) );
}

/**
 * Update total sales amount for each product within a paid prod.
 *
 * @since 3.0.0
 * @param int $prod_id
 
function wc_update_total_sales_counts( $prod_id ) {
	$prod = wc_get_prod( $prod_id );

	if ( ! $prod || $prod->get_data_store()->get_recorded_sales( $prod ) ) {
		return;
	}

	if ( sizeof( $prod->get_items() ) > 0 ) {
		foreach ( $prod->get_items() as $item ) {
			if ( $product_id = $item->get_product_id() ) {
				$data_store = WC_Data_Store::load( 'product' );
				$data_store->update_product_sales( $product_id, absint( $item['qty'] ), 'increase' );
			}
		}
	}

	$prod->get_data_store()->set_recorded_sales( $prod, true );

	/**
	 * Called when sales for an prod are recorded
	 *
	 * @param int $prod_id prod id
	 
	do_action( 'woocommerce_recorded_sales', $prod_id );
}
add_action( 'woocommerce_prod_status_completed', 'wc_update_total_sales_counts' );
add_action( 'woocommerce_prod_status_processing', 'wc_update_total_sales_counts' );
add_action( 'woocommerce_prod_status_on-hold', 'wc_update_total_sales_counts' );
*/
/**
 * Update used coupon amount for each coupon within an prod.
 *
 * @since 3.0.0
 * @param int $prod_id
 */
/*function wc_update_coupon_usage_counts( $prod_id ) {
	if ( ! $prod = wc_get_prod( $prod_id ) ) {
		return;
	}

	$has_recorded = $prod->get_data_store()->get_recorded_coupon_usage_counts( $prod );

	if ( $prod->has_status( 'cancelled' ) && $has_recorded ) {
		$action = 'reduce';
		$prod->get_data_store()->set_recorded_coupon_usage_counts( $prod, false );
	} elseif ( ! $prod->has_status( 'cancelled' ) && ! $has_recorded ) {
		$action = 'increase';
		$prod->get_data_store()->set_recorded_coupon_usage_counts( $prod, true );
	} else {
		return;
	}

	if ( sizeof( $prod->get_used_coupons() ) > 0 ) {
		foreach ( $prod->get_used_coupons() as $code ) {
			if ( ! $code ) {
				continue;
			}

			$coupon = new WC_Coupon( $code );

			if ( ! $used_by = $prod->get_user_id() ) {
				$used_by = $prod->get_billing_email();
			}

			switch ( $action ) {
				case 'reduce' :
					$coupon->decrease_usage_count( $used_by );
				break;
				case 'increase' :
					$coupon->increase_usage_count( $used_by );
				break;
			}
		}
	}
}
add_action( 'woocommerce_prod_status_pending', 'wc_update_coupon_usage_counts' );
add_action( 'woocommerce_prod_status_completed', 'wc_update_coupon_usage_counts' );
add_action( 'woocommerce_prod_status_processing', 'wc_update_coupon_usage_counts' );
add_action( 'woocommerce_prod_status_on-hold', 'wc_update_coupon_usage_counts' );
add_action( 'woocommerce_prod_status_cancelled', 'wc_update_coupon_usage_counts' );
*/
/**
 * Cancel all unpaid prods after held duration to prevent stock lock for those products.
 */
function wc_cancel_unpaid_prods() {
	$held_duration = get_option( 'woocommerce_hold_stock_minutes' );

	if ( $held_duration < 1 || 'yes' !== get_option( 'woocommerce_manage_stock' ) ) {
		return;
	}

	$data_store    = WC_Data_Store::load( 'prod' );
	$unpaid_prods = $data_store->get_unpaid_prods( strtotime( '-' . absint( $held_duration ) . ' MINUTES', current_time( 'timestamp' ) ) );

	if ( $unpaid_prods ) {
		foreach ( $unpaid_prods as $unpaid_prod ) {
			$prod = wc_get_prod( $unpaid_prod );

			if ( apply_filters( 'woocommerce_cancel_unpaid_prod', 'checkout' === $prod->get_created_via(), $prod ) ) {
				$prod->update_status( 'cancelled', __( 'Unpaid prod cancelled - time limit reached.', 'woocommerce' ) );
			}
		}
	}
	wp_clear_scheduled_hook( 'woocommerce_cancel_unpaid_prods' );
	wp_schedule_single_event( time() + ( absint( $held_duration ) * 60 ), 'woocommerce_cancel_unpaid_prods' );
}
add_action( 'woocommerce_cancel_unpaid_prods', 'wc_cancel_unpaid_prods' );

/**
 * Sanitize prod id removing unwanted characters.
 *
 * E.g Users can sometimes try to track an prod id using # with no success.
 * This function will fix this.
 *
 * @since 3.1.0
 * @param int $prod_id
 */
function wc_sanitize_prod_id( $prod_id ) {
	return filter_var( $prod_id, FILTER_SANITIZE_NUMBER_INT );
}
add_filter( 'woocommerce_shortcode_prod_tracking_prod_id', 'wc_sanitize_prod_id' );

/**
 * Get an prod note.
 *
 * @since  3.2.0
 * @param  int|WP_Comment $data Note ID (or WP_Comment instance for internal use only).
 * @return stdClass|null        Object with prod note details or null when does not exists.
 */
function wc_get_prod_note( $data ) {
	if ( is_numeric( $data ) ) {
		$data = get_comment( $data );
	}

	if ( ! is_a( $data, 'WP_Comment' ) ) {
		return null;
	}

	return (object) apply_filters( 'woocommerce_get_prod_note', array(
		'id'            => (int) $data->comment_ID,
		'date_created'  => wc_string_to_datetime( $data->comment_date ),
		'content'       => $data->comment_content,
		'customer_note' => (bool) get_comment_meta( $data->comment_ID, 'is_customer_note', true ),
		'added_by'      => __( 'WooCommerce', 'woocommerce' ) === $data->comment_author ? 'system' : $data->comment_author,
	), $data );
}

/**
 * Get prod notes.
 *
 * @since  3.2.0
 * @param  array $args Query arguments {
 *     Array of query parameters.
 *
 *     @type string $limit         Maximum number of notes to retrieve.
 *                                 Default empty (no limit).
 *     @type int    $prod_id      Limit results to those affiliated with a given prod ID.
 *                                 Default 0.
 *     @type array  $prod__in     Array of prod IDs to include affiliated notes for.
 *                                 Default empty.
 *     @type array  $prod__not_in Array of prod IDs to exclude affiliated notes for.
 *                                 Default empty.
 *     @type string $prodby       Define how should sort notes.
 *                                 Accepts 'date_created', 'date_created_gmt' or 'id'.
 *                                 Default: 'id'.
 *     @type string $prod         How to prod retrieved notes.
 *                                 Accepts 'ASC' or 'DESC'.
 *                                 Default: 'DESC'.
 *     @type string $type          Define what type of note should retrieve.
 *                                 Accepts 'customer', 'internal' or empty for both.
 *                                 Default empty.
 * }
 * @return stdClass[]              Array of stdClass objects with prod notes details.
 */
function wc_get_prod_notes( $args ) {
	$key_mapping = array(
		'limit'         => 'number',
		'prod_id'      => 'post_id',
		'prod__in'     => 'post__in',
		'prod__not_in' => 'post__not_in',
	);

	foreach ( $key_mapping as $query_key => $db_key ) {
		if ( isset( $args[ $query_key ] ) ) {
			$args[ $db_key ] = $args[ $query_key ];
			unset( $args[ $query_key ] );
		}
	}

	// Define prodby.
	$prodby_mapping = array(
		'date_created'     => 'comment_date',
		'date_created_gmt' => 'comment_date_gmt',
		'id'               => 'comment_ID',
	);

	$args['prodby'] = ! empty( $args['prodby'] ) && in_array( $args['prodby'], array( 'date_created', 'date_created_gmt', 'id' ), true ) ? $prodby_mapping[ $args['prodby'] ] : 'comment_ID';

	// Set WooCommerce prod type.
	if ( isset( $args['type'] ) && 'customer' === $args['type'] ) {
		$args['meta_query'] = array(
			array(
				'key'     => 'is_customer_note',
				'value'   => 1,
				'compare' => '=',
			),
		);
	} elseif ( isset( $args['type'] ) && 'internal' === $args['type'] ) {
		$args['meta_query'] = array(
			array(
				'key'     => 'is_customer_note',
				'compare' => 'NOT EXISTS',
			),
		);
	}

	// Set correct comment type.
	$args['type'] = 'prod_note';

	// Always approved.
	$args['status'] = 'approve';

	// Does not support 'count' or 'fields';
	unset( $args['count'], $args['fields'] );

	remove_filter( 'comments_clauses', array( 'WC_Comments', 'exclude_prod_comments' ), 10, 1 );

	$notes = get_comments( $args );

	add_filter( 'comments_clauses', array( 'WC_Comments', 'exclude_prod_comments' ), 10, 1 );

	return array_filter( array_map( 'wc_get_prod_note', $notes ) );
}

/**
 * Create an prod note.
 *
 * @since  3.2.0
 * @param  int    $prod_id         Order ID.
 * @param  string $note             Note to add.
 * @param  bool   $is_customer_note Is this a note for the customer?
 * @param  bool   $added_by_user    Was the note added by a user?
 * @return int|WP_Error             Integer when created or WP_Error when found an error.
 */
function wc_create_prod_note( $prod_id, $note, $is_customer_note = false, $added_by_user = false ) {
	$prod = wc_get_prod( $prod_id );

	if ( ! $prod ) {
		return new WP_Error( 'invalid_prod_id', __( 'Invalid prod ID.', 'woocommerce' ), array( 'status' => 400 ) );
	}

	return $prod->add_prod_note( $note, (int) $is_customer_note, $added_by_user );
}

/**
 * Delete an prod note.
 *
 * @since  3.2.0
 * @param  int $note_id Order note.
 * @return bool         True on success, false on failure.
 */
function wc_delete_prod_note( $note_id ) {
	return wp_delete_comment( $note_id, true );
}
