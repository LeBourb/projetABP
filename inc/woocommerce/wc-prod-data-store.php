<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Abstract Prod Data Store: Stored in CPT.
 *
 * @version  3.0.0
 * @category Class
 * @author   WooThemes
 */
class WC_Prod_Data_Store extends WC_Data_Store_WP implements WC_Object_Data_Store_Interface/*, WC_Abstract_Prod_Data_Store_Interface*/ {

	/**
	 * Internal meta type used to store prod data.
	 *
	 * @var string
	 */
	protected $meta_type = 'post';

	/**
	 * Data stored in meta keys, but not considered "meta" for an prod.
	 *
	 * @since 3.0.0
	 * @var array
	 */
	protected $internal_meta_keys = array(
		'_prod_currency',
		'_cart_discount',
		'_cart_discount_tax',
		'_prod_shipping',
		'_prod_shipping_tax',
		'_prod_tax',
		'_prod_total',
		'_prod_version',
		'_prices_include_tax',
		'_payment_tokens',
	);

	/*
	|--------------------------------------------------------------------------
	| CRUD Methods
	|--------------------------------------------------------------------------
	*/

	/**
	 * Method to create a new prod in the database.
	 * @param WC_Prod $prod
	 */
	public function create( &$prod ) {
		$prod->set_version( WC_VERSION );
		$prod->set_date_created( current_time( 'timestamp', true ) );
		//$prod->set_currency( $prod->get_currency() ? $prod->get_currency() : get_woocommerce_currency() );

		$id = wp_insert_post( apply_filters( 'woocommerce_new_prod_data', array(
			'post_date'     => gmdate( 'Y-m-d H:i:s', $prod->get_date_created( 'edit' )->getOffsetTimestamp() ),
			'post_date_gmt' => gmdate( 'Y-m-d H:i:s', $prod->get_date_created( 'edit' )->getTimestamp() ),
			'post_type'     => $prod->get_type( 'edit' ),
			'post_status'   => 'wc-' . ( $prod->get_status( 'edit' ) ? $prod->get_status( 'edit' ) : apply_filters( 'woocommerce_default_prod_status', 'pending' ) ),
			'ping_status'   => 'closed',
			'post_author'   => 1,
			'post_title'    => $this->get_post_title(),
			'post_password' => uniqid( 'prod_' ),
			'post_parent'   => $prod->get_parent_id( 'edit' ),
			'post_excerpt'  => $this->get_post_excerpt( $prod ),
		) ), true );

		if ( $id && ! is_wp_error( $id ) ) {
			$prod->set_id( $id );
			$this->update_post_meta( $prod );
			$prod->save_meta_data();
			$prod->apply_changes();
			$this->clear_caches( $prod );
		}
	}

	/**
	 * Method to read an prod from the database.
	 *
	 * @param WC_Data $prod
	 *
	 * @throws Exception
	 */
	public function read( &$prod ) {
		//$prod->set_defaults();
$post_object = get_post( $prod->get_id() ) ;
		/*if ( ! $prod->get_id() || ! ( $post_object = get_post( $prod->get_id() ) ) || ! in_array( $post_object->post_type, wc_get_prod_types() ) ) {
			throw new Exception( __( 'Invalid prod.', 'woocommerce' ) );
		}*/


		$prod->set_props( array(
			'parent_id'     => $post_object->post_parent,
			'date_created'  => 0 < $post_object->post_date_gmt ? wc_string_to_timestamp( $post_object->post_date_gmt ) : null,
			'date_modified' => 0 < $post_object->post_modified_gmt ? wc_string_to_timestamp( $post_object->post_modified_gmt ) : null,
			'status'        => $post_object->post_status,
		) );
                //$prod->set_prop('status', $post_object->post_status);
                
  //              $prod->set_status( $post_object->post_status );
//print('Production status:' . $prod->get_status() );//$prod->get_status());
		$this->read_prod_data( $prod, $post_object );
		$prod->read_meta_data();
		$prod->set_object_read( true );
                
		/**
		 * In older versions, discounts may have been stored differently.
		 * Update them now so if the object is saved, the correct values are
		 * stored. @todo When meta is flattened, handle this during migration.
		 */
		/*if ( version_compare( $prod->get_version( 'edit' ), '2.3.7', '<' ) && $prod->get_prices_include_tax( 'edit' ) ) {
			$prod->set_discount_total( (double) get_post_meta( $prod->get_id(), '_cart_discount', true ) - (double) get_post_meta( $prod->get_id(), '_cart_discount_tax', true ) );
		}*/
	}

	/**
	 * Method to update an prod in the database.
	 * @param WC_Prod $prod
	 */
	public function update( &$prod ) {
		$prod->save_meta_data();
		//$prod->set_version( WC_VERSION );

		$changes = $prod->get_changes();

		// Only update the post when the post data changes.
		if ( array_intersect( array( 'date_created', 'date_modified', 'status', 'parent_id', 'post_excerpt' ), array_keys( $changes ) ) ) {
			$post_data = array(
				'post_date'         => gmdate( 'Y-m-d H:i:s', $prod->get_date_created( 'edit' )->getOffsetTimestamp() ),
				'post_date_gmt'     => gmdate( 'Y-m-d H:i:s', $prod->get_date_created( 'edit' )->getTimestamp() ),
				'post_status'       => '' . ( $prod->get_status( 'edit' ) ? $prod->get_status( 'edit' ) : apply_filters( 'woocommerce_default_prod_status', 'pending' ) ),
				//'post_parent'       => $prod->get_parent_id(),
				'post_excerpt'      => $this->get_post_excerpt( $prod ),
				'post_modified'     => isset( $changes['date_modified'] ) ? gmdate( 'Y-m-d H:i:s', $prod->get_date_modified( 'edit' )->getOffsetTimestamp() ) : current_time( 'mysql' ),
				'post_modified_gmt' => isset( $changes['date_modified'] ) ? gmdate( 'Y-m-d H:i:s', $prod->get_date_modified( 'edit' )->getTimestamp() ) : current_time( 'mysql', 1 ),
			);

			/**
			 * When updating this object, to prevent infinite loops, use $wpdb
			 * to update data, since wp_update_post spawns more calls to the
			 * save_post action.
			 *
			 * This ensures hooks are fired by either WP itself (admin screen save),
			 * or an update purely from CRUD.
			 */
			if ( doing_action( 'save_post' ) ) {
				$GLOBALS['wpdb']->update( $GLOBALS['wpdb']->posts, $post_data, array( 'ID' => $prod->get_id() ) );
				clean_post_cache( $prod->get_id() );
			} else {
				wp_update_post( array_merge( array( 'ID' => $prod->get_id() ), $post_data ) );
			}
			$prod->read_meta_data( true ); // Refresh internal meta data, in case things were hooked into `save_post` or another WP hook.
		}
		$this->update_post_meta( $prod );
		$prod->apply_changes();
		$this->clear_caches( $prod );
	}

	/**
	 * Method to delete an prod from the database.
	 * @param WC_Prod $prod
	 * @param array $args Array of args to pass to the delete method.
	 */
	public function delete( &$prod, $args = array() ) {
		$id   = $prod->get_id();
		$args = wp_parse_args( $args, array(
			'force_delete' => false,
		) );

		if ( ! $id ) {
			return;
		}

		if ( $args['force_delete'] ) {
			wp_delete_post( $id );
			$prod->set_id( 0 );
			do_action( 'woocommerce_delete_prod', $id );
		} else {
			wp_trash_post( $id );
			$prod->set_status( 'trash' );
			do_action( 'woocommerce_trash_prod', $id );
		}
	}

	/*
	|--------------------------------------------------------------------------
	| Additional Methods
	|--------------------------------------------------------------------------
	*/

	/**
	 * Excerpt for post.
	 *
	 * @param  WC_prod $prod
	 * @return string
	 */
	protected function get_post_excerpt( $prod ) {
		return '';
	}

	/**
	 * Get a title for the new post type.
	 *
	 * @return string
	 */
	protected function get_post_title() {
		// @codingStandardsIgnoreStart
		/* translators: %s: Prod date */
		return sprintf( __( 'Prod &ndash; %s', 'woocommerce' ), strftime( _x( '%b %d, %Y @ %I:%M %p', 'Prod date parsed by strftime', 'woocommerce' ) ) );
		// @codingStandardsIgnoreEnd
	}

	/**
	 * Read prod data. Can be overridden by child classes to load other props.
	 *
	 * @param WC_Prod $prod
	 * @param object   $post_object
	 * @since 3.0.0
	 */
	protected function read_prod_data( &$prod, $post_object ) {
		$id = $prod->get_id();

		$prod->set_props( array(
			'currency'           => get_post_meta( $id, '_prod_currency', true ),
			'discount_total'     => get_post_meta( $id, '_cart_discount', true ),
			'discount_tax'       => get_post_meta( $id, '_cart_discount_tax', true ),
			'shipping_total'     => get_post_meta( $id, '_prod_shipping', true ),
			'shipping_tax'       => get_post_meta( $id, '_prod_shipping_tax', true ),
			'cart_tax'           => get_post_meta( $id, '_prod_tax', true ),
			'total'              => get_post_meta( $id, '_prod_total', true ),
			'version'            => get_post_meta( $id, '_prod_version', true ),
			'prices_include_tax' => metadata_exists( 'post', $id, '_prices_include_tax' ) ? 'yes' === get_post_meta( $id, '_prices_include_tax', true ) : 'yes' === get_option( 'woocommerce_prices_include_tax' ),
		) );

		// Gets extra data associated with the prod if needed.
		foreach ( $prod->get_extra_data_keys() as $key ) {
			$function = 'set_' . $key;
			if ( is_callable( array( $prod, $function ) ) ) {
				$prod->{$function}( get_post_meta( $prod->get_id(), '_' . $key, true ) );
			}
		}
	}

	/**
	 * Helper method that updates all the post meta for an prod based on it's settings in the WC_Prod class.
	 *
	 * @param $prod WC_Prod
	 * @since 3.0.0
	 */
	protected function update_post_meta( &$prod ) {
		$updated_props     = array();
		$meta_key_to_props = array(
			/*'_prod_currency'     => 'currency',
			'_cart_discount'      => 'discount_total',
			'_cart_discount_tax'  => 'discount_tax',
			'_prod_shipping'     => 'shipping_total',
			'_prod_shipping_tax' => 'shipping_tax',
			'_prod_tax'          => 'cart_tax',
			'_prod_total'        => 'total',
			'_prod_version'      => 'version',
			'_prices_include_tax' => 'prices_include_tax',*/
		);

		$props_to_update = $this->get_props_to_update( $prod, $meta_key_to_props );

		foreach ( $props_to_update as $meta_key => $prop ) {
			$value = $prod->{"get_$prop"}( 'edit' );

			if ( 'prices_include_tax' === $prop ) {
				$value = $value ? 'yes' : 'no';
			}

			if ( update_post_meta( $prod->get_id(), $meta_key, $value ) ) {
				$updated_props[] = $prop;
			}
		}

		do_action( 'woocommerce_prod_object_updated_props', $prod, $updated_props );
	}

	/**
	 * Clear any caches.
	 *
	 * @param WC_Prod $prod
	 * @since 3.0.0
	 */
	protected function clear_caches( &$prod ) {
		clean_post_cache( $prod->get_id() );
		wc_delete_shop_prod_transients( $prod );
		wp_cache_delete( 'prod-items-' . $prod->get_id(), 'prods' );
	}

	/**
	 * Read prod items of a specific type from the database for this prod.
	 *
	 * @param  WC_Prod $prod
	 * @param  string $type
	 * @return array
	 */
	public function read_items( $prod, $type ) {
		global $wpdb;

		// Get from cache if available.
		$items = wp_cache_get( 'prod-items-' . $prod->get_id(), 'prods' );

		if ( false === $items ) {
			$get_items_sql = $wpdb->prepare( "SELECT prod_item_type, prod_item_id, prod_id, prod_item_name FROM {$wpdb->prefix}woocommerce_prod_items WHERE prod_id = %d ORDER BY prod_item_id;", $prod->get_id() );
			$items         = $wpdb->get_results( $get_items_sql );
			foreach ( $items as $item ) {
				wp_cache_set( 'item-' . $item->prod_item_id, $item, 'prod-items' );
			}
			wp_cache_set( 'prod-items-' . $prod->get_id(), $items, 'prods' );
		}

		$items = wp_list_filter( $items, array( 'prod_item_type' => $type ) );

		if ( ! empty( $items ) ) {
			$items = array_map( array( 'WC_Prod_Factory', 'get_prod_item' ), array_combine( wp_list_pluck( $items, 'prod_item_id' ), $items ) );
		} else {
			$items = array();
		}

		return $items;
	}

	/**
	 * Remove all line items (products, coupons, shipping, taxes) from the prod.
	 *
	 * @param WC_Prod $prod
	 * @param string   $type Prod item type. Default null.
	 */
	public function delete_items( $prod, $type = null ) {
		global $wpdb;
		if ( ! empty( $type ) ) {
			$wpdb->query( $wpdb->prepare( "DELETE FROM itemmeta USING {$wpdb->prefix}woocommerce_prod_itemmeta itemmeta INNER JOIN {$wpdb->prefix}woocommerce_prod_items items WHERE itemmeta.prod_item_id = items.prod_item_id AND items.prod_id = %d AND items.prod_item_type = %s", $prod->get_id(), $type ) );
			$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}woocommerce_prod_items WHERE prod_id = %d AND prod_item_type = %s", $prod->get_id(), $type ) );
		} else {
			$wpdb->query( $wpdb->prepare( "DELETE FROM itemmeta USING {$wpdb->prefix}woocommerce_prod_itemmeta itemmeta INNER JOIN {$wpdb->prefix}woocommerce_prod_items items WHERE itemmeta.prod_item_id = items.prod_item_id and items.prod_id = %d", $prod->get_id() ) );
			$wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}woocommerce_prod_items WHERE prod_id = %d", $prod->get_id() ) );
		}
		$this->clear_caches( $prod );
	}

	/**
	 * Get token ids for an prod.
	 *
	 * @param WC_Prod $prod
	 * @return array
	 */
	public function get_payment_token_ids( $prod ) {
		$token_ids = array_filter( (array) get_post_meta( $prod->get_id(), '_payment_tokens', true ) );
		return $token_ids;
	}

	/**
	 * Update token ids for an prod.
	 *
	 * @param WC_Prod $prod
	 * @param array    $token_ids
	 */
	public function update_payment_token_ids( $prod, $token_ids ) {
		update_post_meta( $prod->get_id(), '_payment_tokens', $token_ids );
	}
}
