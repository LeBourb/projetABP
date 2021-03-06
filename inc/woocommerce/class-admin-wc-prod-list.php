<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

if ( ! function_exists( 'wc_get_prod' ) ) {
	require_once( 'wc-prod-functions.php' );
}

/**
 * WC_Report_Stock.
 *
 * @author      WooThemes
 * @category    Admin
 * @package     WooCommerce/Admin/Reports
 * @version     2.1.0
 */
class WC_Report_Production_List extends WP_List_Table {

	/**
	 * Max items.
	 *
	 * @var int
	 */
	protected $max_items;

	/**
	 * Constructor.
	 */
	public function __construct() {

		parent::__construct( array(
			'singular'  => 'stock',
			'plural'    => 'stock',
			'ajax'      => false,
		) );
	}

	/**
	 * No items found text.
	 */
	public function no_items() {
		_e( 'No production found.', 'woocommerce' );
	}
        
        

	/**
	 * Don't need this.
	 *
	 * @param string $position
	 */
	public function display_tablenav( $position ) {

		if ( 'top' !== $position ) {
			parent::display_tablenav( $position );
		}
	}

	/**
	 * Output the report.
	 */
	public function output_report() {

		$this->prepare_items();
		echo '<div id="poststuff" class="woocommerce-reports-wide">';
		$this->display();
		echo '</div>';
	}

	/**
	 * Get column value.
	 *
	 * @param mixed $item
	 * @param string $column_name
	 */
	public function column_default( $item, $column_name ) {
		global $product;
		if ( ! $product || $product->get_id() !== $item->ID ) {			
                        $product = wc_get_prod( $item->ID );
                        
		}
		if ( ! $product ) {
			return;
		}

		switch ( $column_name ) {

                        case 'production' :
				/*if ( $sku = $product->get_sku() ) {
					echo esc_html( $sku ) . ' - ';
				}*/

				echo esc_html( $product->get_name() );

				// Get variation data.
				if ( $product->is_type( 'variation' ) ) {
					echo '<div class="description">' . wp_kses_post( wc_get_formatted_variation( $product, true ) ) . '</div>';
				}
			break;	
                    
                        case 'product' :
				/*if ( $sku = $product->get_sku() ) {
					echo esc_html( $sku ) . ' - ';
				}*/

				echo esc_html( $product->get_name() );

				// Get variation data.
				if ( $product->is_type( 'variation' ) ) {
					echo '<div class="description">' . wp_kses_post( wc_get_formatted_variation( $product, true ) ) . '</div>';
				}
			break;
                        
                        case 'orders' :
				if ( $sku = $product->get_sku() ) {
					echo esc_html( $sku ) . ' - ';
				}

				echo esc_html( $product->get_name() );

				// Get variation data.
				if ( $product->is_type( 'variation' ) ) {
					echo '<div class="description">' . wp_kses_post( wc_get_formatted_variation( $product, true ) ) . '</div>';
				}
			break;

			case 'parent' :
				if ( $item->parent ) {
					echo esc_html( get_the_title( $item->parent ) );
				} else {
					echo '-';
				}
			break;

			case 'stock_status' :
				if ( $product->is_in_stock() ) {
					$stock_html = '<mark class="instock">' . __( 'In stock', 'woocommerce' ) . '</mark>';
				} else {
					$stock_html = '<mark class="outofstock">' . __( 'Out of stock', 'woocommerce' ) . '</mark>';
				}
				echo apply_filters( 'woocommerce_admin_stock_html', $stock_html, $product );
			break;

			case 'stock_level' :
				echo esc_html( $product->get_stock_quantity() );
			break;

			case 'wc_actions' :
				?><p>
					<?php
						$actions = array();
						$action_id = $product->is_type( 'variation' ) ? $item->parent : $item->id;

						$actions['edit'] = array(
							'url'       => admin_url( 'post.php?post=' . $action_id . '&action=edit' ),
							'name'      => __( 'Edit', 'woocommerce' ),
							'action'    => "edit",
						);

						if ( $product->is_visible() ) {
							$actions['view'] = array(
								'url'       => get_permalink( $action_id ),
								'name'      => __( 'View', 'woocommerce' ),
								'action'    => "view",
							);
						}

						$actions = apply_filters( 'woocommerce_admin_stock_report_product_actions', $actions, $product );

						foreach ( $actions as $action ) {
							printf(
								'<a class="button tips %1$s" href="%2$s" data-tip="%3$s">%4$s</a>',
								esc_attr( $action['action'] ),
								esc_url( $action['url'] ),
								sprintf( esc_attr__( '%s product', 'woocommerce' ), $action['name'] ),
								esc_html( $action['name'] )
							);
						}
					?>
				</p><?php
			break;
		}
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	public function get_columns() {

		$columns = array(
                        'production'      => __( 'Production', 'woocommerce' ),
			'product'      => __( 'Product', 'woocommerce' ),
			'status'  => __( 'Status', 'woocommerce' ),		
			'wc_actions'   => __( 'Actions', 'woocommerce' ),
		);

		return $columns;
	}

	/**
	 * Prepare customer list items.
	 */
	public function prepare_items() {

		$this->_column_headers = array( $this->get_columns(), array(), $this->get_sortable_columns() );
		$current_page          = absint( $this->get_pagenum() );
		$per_page              = apply_filters( 'woocommerce_admin_stock_report_products_per_page', 20 );

		//$this->get_items( $current_page, $per_page );

		/**
		 * Pagination.
		 */
		$this->set_pagination_args( array(
			'total_items' => $this->max_items,
			'per_page'    => $per_page,
			'total_pages' => ceil( $this->max_items / $per_page ),
		) );
                
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 10,
                );

                // 2. on exécute la query
                $my_query = new WP_Query($args);
                
                //$this->_column_headers = array($columns, $hidden, $sortable);
                $this->items = $my_query->posts;;
	}
}
