<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if(!class_exists('WC_Prod_Data_Store')) {
    require_once 'wc-prod-data-store.php';
}

/**
 * Abstract Product Class
 *
 * The WooCommerce product class handles individual product data.
 *
 * @version  3.0.0
 * @package  WooCommerce/Abstracts
 * @category Abstract Class
 * @author   WooThemes
 */
class WC_Production extends WC_Data  {

	/**
	 * This is the name of this object type.
	 * @var string
	 */
	protected $object_type = 'production';

	/**
	 * Post type.
	 * @var string
	 */
	protected $post_type = 'production';

	/**
	 * Cache group.
	 * @var string
	 */
	protected $cache_group = 'productions';

	/**
	 * Stores product data.
	 *
	 * @var array
	 */
	protected $data = array(
		'name'               => '',
		'slug'               => '',
		'date_created'       => null,
		'date_modified'      => null,
		'status'             => false,
		'featured'           => false,
		'catalog_visibility' => 'visible',
		'description'        => '',
                'product_id'        => null,
                'order_ids'         => array(),
	);

	/**
	 * Supported features such as 'ajax_add_to_cart'.
	 *
	 * @var array
	 */
	protected $supports = array();

	/**
	 * Get the product if ID is passed, otherwise the product is new and empty.
	 * This class should NOT be instantiated, but the wc_get_product() function
	 * should be used. It is possible, but the wc_get_product() is preferred.
	 *
	 * @param int|WC_Product|object $product Product to init.
	 */
	public function __construct( $production = 0 ) {
		if ( is_numeric( $production ) && $production > 0 ) {
			$this->set_id( $production );
		} elseif ( $production instanceof self ) {
			$this->set_id( absint( $production->get_id() ) );
		} elseif ( ! empty( $production->ID ) ) {
			$this->set_id( absint( $production->ID ) );
		} else {
			$this->set_object_read( true );
		}
                $this->data = array(
		'name'               => '',
		'slug'               => '',
		'date_created'       => null,
		'date_modified'      => null,
		'status'             => false,
		'featured'           => false,
		'catalog_visibility' => 'visible',
		'description'        => '',
                'product_id'        => null,
                'order_ids'         => array(),
	);
		$this->data_store = WC_Data_Store::load( 'production' );
		if ( $this->get_id() > 0 ) {
			$this->data_store->read( $this );
		}
	}

	/**
	 * Get internal type. Should return string and *should be overridden* by child classes.
	 *
	 * The product_type property is deprecated but is used here for BW compatibility with child classes which may be defining product_type and not have a get_type method.
	 *
	 * @since 3.0.0
	 * @return string
	 */
	public function get_type() {
		return isset( $this->production_type ) ? $this->production_type : 'simple';
	}

	/*
	|--------------------------------------------------------------------------
	| Getters
	|--------------------------------------------------------------------------
	|
	| Methods for getting data from the product object.
	*/

	/**
	 * Get product name.
	 *
	 * @since 3.0.0
	 * @param  string $context
	 * @return string
	 */
	public function get_name( $context = 'view' ) {
		return $this->get_prop( 'name', $context );
	}

	/**
	 * Get product slug.
	 *
	 * @since 3.0.0
	 * @param  string $context
	 * @return string
	 */
	public function get_slug( $context = 'view' ) {
		return $this->get_prop( 'slug', $context );
	}

	/**
	 * Get product created date.
	 *
	 * @since 3.0.0
	 * @param  string $context
	 * @return WC_DateTime|NULL object if the date is set or null if there is no date.
	 */
	public function get_date_created( $context = 'view' ) {
		return $this->get_prop( 'date_created', $context );
	}

	/**
	 * Get product modified date.
	 *
	 * @since 3.0.0
	 * @param  string $context
	 * @return WC_DateTime|NULL object if the date is set or null if there is no date.
	 */
	public function get_date_modified( $context = 'view' ) {
		return $this->get_prop( 'date_modified', $context );
	}

	/**
	 * Get product status.
	 *
	 * @since 3.0.0
	 * @param  string $context
	 * @return string
	 */
	public function get_status( $context = 'view' ) {
          
            return $this->get_prop( 'status', $context );
	}

	/**
	 * If the product is featured.
	 *
	 * @since 3.0.0
	 * @param  string $context
	 * @return boolean
	 */
	public function get_featured( $context = 'view' ) {
		return $this->get_prop( 'featured', $context );
	}

	/**
	 * Get catalog visibility.
	 *
	 * @since 3.0.0
	 * @param  string $context
	 * @return string
	 */
	public function get_catalog_visibility( $context = 'view' ) {
		return $this->get_prop( 'catalog_visibility', $context );
	}

	/**
	 * Get product description.
	 *
	 * @since 3.0.0
	 * @param  string $context
	 * @return string
	 */
	public function get_description( $context = 'view' ) {
		return $this->get_prop( 'description', $context );
	}

        
        /**
	 * Get SKU (Stock-keeping unit) - product unique ID.
	 *
	 * @param  string $context
	 * @return string
	 */
	public function get_product_id( $context = 'view' ) {
		return $this->get_prop( 'product_id', $context );
	}

	/**
	 * Returns the product's active price.
	 *
	 * @param  string $context
	 * @return string price
	 */
	public function get_price( $context = 'view' ) {
		return $this->get_prop( 'price', $context );
	}


	/**
	 * Get upsell IDs.
	 *
	 * @since 3.0.0
	 * @param  string $context
	 * @return array
	 */
	public function get_order_ids( $context = 'view' ) {
            return $this->get_prop( 'order_ids', $context );
	}
        
        public function get_production_number() {
            return '54';
        }
        
        public function get_workshop_ip_address() {
            return "545";
        }


	/*
	|--------------------------------------------------------------------------
	| Setters
	|--------------------------------------------------------------------------
	|
	| Functions for setting product data. These should not update anything in the
	| database itself and should only change what is stored in the class
	| object.
	*/

	/**
	 * Set product name.
	 *
	 * @since 3.0.0
	 * @param string $name Product name.
	 */
	public function set_name( $name ) {
		$this->set_prop( 'name', $name );
	}

	/**
	 * Set product slug.
	 *
	 * @since 3.0.0
	 * @param string $slug Product slug.
	 */
	public function set_slug( $slug ) {
		$this->set_prop( 'slug', $slug );
	}

	/**
	 * Set product created date.
	 *
	 * @since 3.0.0
	 * @param string|integer|null $date UTC timestamp, or ISO 8601 DateTime. If the DateTime string has no timezone or offset, WordPress site timezone will be assumed. Null if their is no date.
	 */
	public function set_date_created( $date = null ) {
		$this->set_date_prop( 'date_created', $date );
	}

	/**
	 * Set product modified date.
	 *
	 * @since 3.0.0
	 * @param string|integer|null $date UTC timestamp, or ISO 8601 DateTime. If the DateTime string has no timezone or offset, WordPress site timezone will be assumed. Null if their is no date.
	 */
	public function set_date_modified( $date = null ) {
		$this->set_date_prop( 'date_modified', $date );
	}

	/**
	 * Set product status.
	 *
	 * @since 3.0.0
	 * @param string $status Product status.
	 */
	public function set_status( $status ) {
		$this->set_prop( 'status', $status );
	}

	/**
	 * Set if the product is featured.
	 *
	 * @since 3.0.0
	 * @param bool|string
	 */
	public function set_featured( $featured ) {
		$this->set_prop( 'featured', wc_string_to_bool( $featured ) );
	}

	/**
	 * Set catalog visibility.
	 *
	 * @since 3.0.0
	 * @throws WC_Data_Exception
	 * @param string $visibility Options: 'hidden', 'visible', 'search' and 'catalog'.
	 */
	public function set_catalog_visibility( $visibility ) {
		$options = array_keys( wc_get_product_visibility_options() );
		if ( ! in_array( $visibility, $options, true ) ) {
			$this->error( 'product_invalid_catalog_visibility', __( 'Invalid catalog visibility option.', 'woocommerce' ) );
		}
		$this->set_prop( 'catalog_visibility', $visibility );
	}

	/**
	 * Set product description.
	 *
	 * @since 3.0.0
	 * @param string $description Product description.
	 */
	public function set_description( $description ) {
		$this->set_prop( 'description', $description );
	}

	/**
	 * Set product short description.
	 *
	 * @since 3.0.0
	 * @param string $short_description Product short description.
	 */
	public function set_product_id( $short_description ) {
		$this->set_prop( 'short_description', $short_description );
	}


	/**
	 * Set the product's active price.
	 *
	 * @param string $price Price.
	 */
	public function set_price( $price ) {
		$this->set_prop( 'price', wc_format_decimal( $price ) );
	}
	/**
	 * Set the product categories.
	 *
	 * @since 3.0.0
	 * @param array $term_ids List of terms IDs.
	 */
	public function set_order_ids( $term_ids ) {
		$this->set_prop( 'order_ids', array_unique( array_map( 'intval', $term_ids ) ) );
	}
        
        


	/*
	|--------------------------------------------------------------------------
	| Other Methods
	|--------------------------------------------------------------------------
	*/

	/**
	 * Ensure properties are set correctly before save.
	 * @since 3.0.0
	 */
	public function validate_props() {
		// Before updating, ensure stock props are all aligned. Qty and backorders are not needed if not stock managed.
		/*if ( ! $this->get_manage_stock() ) {
			$this->set_stock_quantity( '' );
			$this->set_backorders( 'no' );

		// If we are stock managing and we don't have stock, force out of stock status.
		} elseif ( $this->get_stock_quantity() <= get_option( 'woocommerce_notify_no_stock_amount' ) && 'no' === $this->get_backorders() ) {
			$this->set_stock_status( 'outofstock' );

		// If the stock level is changing and we do now have enough, force in stock status.
		} elseif ( $this->get_stock_quantity() > get_option( 'woocommerce_notify_no_stock_amount' ) && array_key_exists( 'stock_quantity', $this->get_changes() ) ) {
			$this->set_stock_status( 'instock' );
		}*/
	}

	/**
	 * Save data (either create or update depending on if we are working on an existing product).
	 *
	 * @since 3.0.0
	 * @return int
	 */
	public function save() {
		$this->validate_props();

		if ( $this->data_store ) {
			// Trigger action before saving to the DB. Use a pointer to adjust object props before save.
			do_action( 'woocommerce_before_' . $this->object_type . '_object_save', $this, $this->data_store );

			if ( $this->get_id() ) {
				$this->data_store->update( $this );
			} else {
				$this->data_store->create( $this );
			}
			/*if ( $this->get_parent_id() ) {
				wc_deferred_product_sync( $this->get_parent_id() );
			}*/
		}
		return $this->get_id();
	}

	/*
	|--------------------------------------------------------------------------
	| Conditionals
	|--------------------------------------------------------------------------
	*/

	/**
	 * Check if a product supports a given feature.
	 *
	 * Product classes should override this to declare support (or lack of support) for a feature.
	 *
	 * @param string $feature string The name of a feature to test support for.
	 * @return bool True if the product supports the feature, false otherwise.
	 * @since 2.5.0
	 */
	public function supports( $feature ) {
		return apply_filters( 'woocommerce_product_supports', in_array( $feature, $this->supports ) ? true : false, $feature, $this );
	}

	/**
	 * Returns whether or not the product post exists.
	 *
	 * @return bool
	 */
	public function exists() {
		return false !== $this->get_status();
	}

	/**
	 * Checks the product type.
	 *
	 * Backwards compatibility with downloadable/virtual.
	 *
	 * @param string|array $type Array or string of types
	 * @return bool
	 */
	public function is_type( $type ) {
		return ( $this->get_type() === $type || ( is_array( $type ) && in_array( $this->get_type(), $type ) ) );
	}

	/**
	 * Checks if a product is downloadable.
	 *
	 * @return bool
	 */
	public function is_downloadable() {
		return apply_filters( 'woocommerce_is_downloadable', true === $this->get_downloadable(), $this );
	}

	/**
	 * Checks if a product is virtual (has no shipping).
	 *
	 * @return bool
	 */
	public function is_virtual() {
		return apply_filters( 'woocommerce_is_virtual', true === $this->get_virtual(), $this );
	}

	/**
	 * Returns whether or not the product is featured.
	 *
	 * @return bool
	 */
	public function is_featured() {
		return true === $this->get_featured();
	}

	/**
	 * Check if a product is sold individually (no quantities).
	 *
	 * @return bool
	 */
	public function is_sold_individually() {
		return apply_filters( 'woocommerce_is_sold_individually', true === $this->get_sold_individually(), $this );
	}

	/**
	 * Returns whether or not the product is visible in the catalog.
	 *
	 * @return bool
	 */
	public function is_visible() {
		$visible = 'visible' === $this->get_catalog_visibility() || ( is_search() && 'search' === $this->get_catalog_visibility() ) || ( ! is_search() && 'catalog' === $this->get_catalog_visibility() );

		if ( 'publish' !== $this->get_status() && ! current_user_can( 'edit_post', $this->get_id() ) ) {
			$visible = false;
		}

		if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) && ! $this->is_in_stock() ) {
			$visible = false;
		}

		return apply_filters( 'woocommerce_product_is_visible', $visible, $this->get_id() );
	}

	/**
	 * Returns false if the product cannot be bought.
	 *
	 * @return bool
	 */
	public function is_purchasable() {
		return apply_filters( 'woocommerce_is_purchasable', $this->exists() && ( 'publish' === $this->get_status() || current_user_can( 'edit_post', $this->get_id() ) ) && '' !== $this->get_price(), $this );
	}

	/**
	 * Returns whether or not the product is on sale.
	 *
	 * @param  string $context What the value is for. Valid values are view and edit.
	 * @return bool
	 */
	public function is_on_sale( $context = 'view' ) {
		if ( '' !== (string) $this->get_sale_price( $context ) && $this->get_regular_price( $context ) > $this->get_sale_price( $context ) ) {
			$on_sale = true;

			if ( $this->get_date_on_sale_from( $context ) && $this->get_date_on_sale_from( $context )->getTimestamp() > current_time( 'timestamp', true ) ) {
				$on_sale = false;
			}

			if ( $this->get_date_on_sale_to( $context ) && $this->get_date_on_sale_to( $context )->getTimestamp() < current_time( 'timestamp', true ) ) {
				$on_sale = false;
			}
		} else {
			$on_sale = false;
		}
		return 'view' === $context ? apply_filters( 'woocommerce_product_is_on_sale', $on_sale, $this ) : $on_sale;
	}

	/**
	 * Returns whether or not the product has dimensions set.
	 *
	 * @return bool
	 */
	public function has_dimensions() {
		return ( $this->get_length() || $this->get_height() || $this->get_width() ) && ! $this->get_virtual();
	}

	/**
	 * Get product name with SKU or ID. Used within admin.
	 *
	 * @return string Formatted product name
	 */
	public function get_formatted_name() {
		if ( $this->get_sku() ) {
			$identifier = $this->get_sku();
		} else {
			$identifier = '#' . $this->get_id();
		}
		return sprintf( '%2$s (%1$s)', $identifier, $this->get_name() );
	}

	/**
	 * Get min quantity which can be purchased at once.
	 *
	 * @since  3.0.0
	 * @return int
	 */
	public function get_min_purchase_quantity() {
		return 1;
	}

	/**
	 * Get max quantity which can be purchased at once.
	 *
	 * @since  3.0.0
	 * @return int Quantity or -1 if unlimited.
	 */
	public function get_max_purchase_quantity() {
		return $this->is_sold_individually() ? 1 : ( $this->backorders_allowed() || ! $this->managing_stock() ? -1 : $this->get_stock_quantity() );
	}

	/**
	 * Get the add to url used mainly in loops.
	 *
	 * @return string
	 */
	public function add_to_cart_url() {
		return apply_filters( 'woocommerce_product_add_to_cart_url', $this->get_permalink(), $this );
	}

	/**
	 * Get the add to cart button text for the single page.
	 *
	 * @return string
	 */
	public function single_add_to_cart_text() {
		return apply_filters( 'woocommerce_product_single_add_to_cart_text', __( 'Add to cart', 'woocommerce' ), $this );
	}

	/**
	 * Get the add to cart button text.
	 *
	 * @return string
	 */
	public function add_to_cart_text() {
		return apply_filters( 'woocommerce_product_add_to_cart_text', __( 'Read more', 'woocommerce' ), $this );
	}

	/**
	 * Returns the main product image.
	 *
	 * @param string $size (default: 'shop_thumbnail')
	 * @param array $attr
	 * @param bool $placeholder True to return $placeholder if no image is found, or false to return an empty string.
	 * @return string
	 */
	public function get_image( $size = 'shop_thumbnail', $attr = array(), $placeholder = true ) {
		if ( has_post_thumbnail( $this->get_id() ) ) {
			$image = get_the_post_thumbnail( $this->get_id(), $size, $attr );
		} elseif ( ( $parent_id = wp_get_post_parent_id( $this->get_id() ) ) && has_post_thumbnail( $parent_id ) ) {
			$image = get_the_post_thumbnail( $parent_id, $size, $attr );
		} elseif ( $placeholder ) {
			$image = wc_placeholder_img( $size );
		} else {
			$image = '';
		}
		return apply_filters( 'woocommerce_product_get_image', wc_get_relative_url( $image ), $this, $size, $attr, $placeholder );
	}

	/**
	 * Returns the product shipping class SLUG.
	 *
	 * @return string
	 */
	public function get_shipping_class() {
		if ( $class_id = $this->get_shipping_class_id() ) {
			$term = get_term_by( 'id', $class_id, 'product_shipping_class' );

			if ( $term && ! is_wp_error( $term ) ) {
				return $term->slug;
			}
		}
		return '';
	}

	/**
	 * Returns a single product attribute as a string.
	 * @param  string $attribute to get.
	 * @return string
	 */
	public function get_attribute( $attribute ) {
		$attributes = $this->get_attributes();
		$attribute  = sanitize_title( $attribute );

		if ( isset( $attributes[ $attribute ] ) ) {
			$attribute_object = $attributes[ $attribute ];
		} elseif ( isset( $attributes[ 'pa_' . $attribute ] ) ) {
			$attribute_object = $attributes[ 'pa_' . $attribute ];
		} else {
			return '';
		}
		return $attribute_object->is_taxonomy() ? implode( ', ', wc_get_product_terms( $this->get_id(), $attribute_object->get_name(), array( 'fields' => 'names' ) ) ) : wc_implode_text_attributes( $attribute_object->get_options() );
	}

	/**
	 * Get the total amount (COUNT) of ratings, or just the count for one rating e.g. number of 5 star ratings.
	 * @param  int $value Optional. Rating value to get the count for. By default returns the count of all rating values.
	 * @return int
	 */
	public function get_rating_count( $value = null ) {
		$counts = $this->get_rating_counts();

		if ( is_null( $value ) ) {
			return array_sum( $counts );
		} elseif ( isset( $counts[ $value ] ) ) {
			return absint( $counts[ $value ] );
		} else {
			return 0;
		}
	}


	/**
	 * Returns the availability of the product.
	 *
	 * @return string[]
	 */
	public function get_availability() {
		return apply_filters( 'woocommerce_get_availability', array(
			'availability' => $this->get_availability_text(),
			'class'        => $this->get_availability_class(),
		), $this );
	}

	/**
	 * Get availability text based on stock status.
	 *
	 * @return string
	 */
	protected function get_availability_text() {
		if ( ! $this->is_in_stock() ) {
			$availability = __( 'Out of stock', 'woocommerce' );
		} elseif ( $this->managing_stock() && $this->is_on_backorder( 1 ) ) {
			$availability = $this->backorders_require_notification() ? __( 'Available on backorder', 'woocommerce' ) : '';
		} elseif ( $this->managing_stock() ) {
			$availability = wc_format_stock_for_display( $this );
		} else {
			$availability = '';
		}
		return apply_filters( 'woocommerce_get_availability_text', $availability, $this );
	}

	/**
	 * Get availability classname based on stock status.
	 *
	 * @return string
	 */
	protected function get_availability_class() {
		if ( ! $this->is_in_stock() ) {
			$class = 'out-of-stock';
		} elseif ( $this->managing_stock() && $this->is_on_backorder( 1 ) ) {
			$class = 'available-on-backorder';
		} else {
			$class = 'in-stock';
		}
		return apply_filters( 'woocommerce_get_availability_class', $class, $this );
	}
}
