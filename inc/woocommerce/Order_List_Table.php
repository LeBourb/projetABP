<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(!class_exists('WP_List_Table')) {
    require_once(ABSPATH.'wp-admin/includes/class-wp-list-table.php');
}

class Order_List_Table extends WP_List_Table {
    private $allServices;
    private $currentServices;
    private $currentServicesData;

    public function __construct(){
        parent::__construct(
            array(
                'singular' => 'service',
                'plural' => 'services',
                'ajax' => false
            )
        );
    }

    private function table_data() {
        global $orders;
        return $orders;
        /*foreach((array) get_terms(array('service'),array('hide_empty' => false)) as $service) {
            $this->allServices[] = array(
                'id' => $service->term_id,
                'serviceTitle' => $service->name,
                'attachments' => array_key_exists($service->term_id,$this->currentServicesData) ? explode(',',$this->currentServicesData[$service->term_id]['attachments']) : array(),
                'lastServiced' =>  (array_key_exists($service->term_id,$this->currentServicesData) && strlen($this->currentServicesData[$service->term_id]['last_serviced']) > 0) ? date('Y-m-d',strtotime($this->currentServicesData[$service->term_id]['last_serviced'])) : '',
                'nextService' =>  (array_key_exists($service->term_id,$this->currentServicesData) && strlen($this->currentServicesData[$service->term_id]['next_service']) > 0) ? date('Y-m-d',strtotime($this->currentServicesData[$service->term_id]['next_service'])) : '',
                'invoices' => ''
            );
        }
        return $this->allServices;*/
    }

    public function column_default($item,$columnName) {
        return array_key_exists($columnName,$item) ? $item[$columnName] : print_r($item,true);
    }

 
    
    	/**
	 * Define custom columns for orders.
	 * @param  array $existing_columns
	 * @return array
	 */
	public function get_columns() {
		$columns                     = array();
		//$columns['cb']               = '<input type="checkbox" />';
		$columns['order_status']     = '<span class="status_head tips" data-tip="' . esc_attr__( 'Status', 'woocommerce' ) . '">' . esc_attr__( 'Status', 'woocommerce' ) . '</span>';
		$columns['order_title']      = __( 'Order', 'woocommerce' );
		$columns['billing_address']  = __( 'Billing', 'woocommerce' );
		$columns['shipping_address'] = __( 'Ship to', 'woocommerce' );
		$columns['customer_message'] = '<span class="notes_head tips" data-tip="' . esc_attr__( 'Customer message', 'woocommerce' ) . '">' . esc_attr__( 'Customer message', 'woocommerce' ) . '</span>';
		$columns['order_notes']      = '<span class="order-notes_head tips" data-tip="' . esc_attr__( 'Order notes', 'woocommerce' ) . '">' . esc_attr__( 'Order notes', 'woocommerce' ) . '</span>';
		$columns['order_date']       = __( 'Date', 'woocommerce' );
                $columns['order_items']      = __( 'Items', 'woocommerce' );
		$columns['order_total']      = __( 'Total', 'woocommerce' );
		//$columns['order_actions']    = __( 'Actions', 'woocommerce' );

		return $columns;
	}
    
    /**
	 * Make columns sortable - https://gist.github.com/906872.
	 *
	 * @param  array $columns
	 * @return array
	 */
	public function get_sortable_columns( ) {
		return array(
			'order_title' => 'ID',
			'order_total' => 'order_total',
			'order_date'  => 'date',
		);		
	}

    
    
    public function get_hidden_columns() {
        return array('id');
    }


    private function sort_data($a,$b) {
        $orderby = empty($_GET['orderby']) ? 'nextService' : $_GET['orderby'];
        $order = empty($_GET['order']) ? 'asc' : $_GET['order'];
        $result = strcmp($a[$orderby],$b[$orderby]);
        return ($order === 'asc') ? $result : -$result;
    }

    public function prepare_items() {       
        $this->_column_headers = array($this->get_columns(),$this->get_hidden_columns(),$this->get_sortable_columns());
        $this->items = $this->table_data();       
    }

    public function column_cb($order) {
        return '<input type="checkbox" />';
    }

    public function column_order_status($order) {
        return sprintf( '<mark class="%s tips" data-tip="%s">%s</mark>', esc_attr( sanitize_html_class( $order->get_status() ) ), esc_attr( wc_get_order_status_name( $order->get_status() ) ), esc_html( wc_get_order_status_name( $order->get_status() ) ) );
    }

    public function column_order_title($order) {
        $htùm = '';
        if ( $order->get_customer_id() ) {
                $user     = get_user_by( 'id', $order->get_customer_id() );
                $username = '<a href="user-edit.php?user_id=' . absint( $order->get_customer_id() ) . '">';
                $username .= esc_html( ucwords( $user->display_name ) );
                $username .= '</a>';
        } elseif ( $order->get_billing_first_name() || $order->get_billing_last_name() ) {
                /* translators: 1: first name 2: last name */
                $username = trim( sprintf( _x( '%1$s %2$s', 'full name', 'woocommerce' ), $order->get_billing_first_name(), $order->get_billing_last_name() ) );
        } elseif ( $order->get_billing_company() ) {
                $username = trim( $order->get_billing_company() );
        } else {
                $username = __( 'Guest', 'woocommerce' );
        }

        /* translators: 1: order and number (i.e. Order #13) 2: user name */
        $html = sprintf(
                __( '%1$s by %2$s', 'woocommerce' ),
                '<a href="' . admin_url( 'post.php?post=' . absint( $order->get_id() ) . '&action=edit' ) . '" class="row-title"><strong>#' . esc_attr( $order->get_order_number() ) . '</strong></a>',
                $username
        );

        if ( $order->get_billing_email() ) {
                $html .= '<small class="meta email"><a href="' . esc_url( 'mailto:' . $order->get_billing_email() ) . '">' . esc_html( $order->get_billing_email() ) . '</a></small>';
        }

        $html .= '<button type="button" class="toggle-row"><span class="screen-reader-text">' . __( 'Show more details', 'woocommerce' ) . '</span></button>';
                                return $html;

    }

    public function column_billing_address($order) {
        $html = '';
        if ( $address = $order->get_formatted_billing_address() ) {
                $html = esc_html( preg_replace( '#<br\s*/?>#i', ', ', $address ) );
        } else {
                $html = '&ndash;';
        }

        if ( $order->get_billing_phone() ) {
                $html .= '<small class="meta">' . __( 'Phone:', 'woocommerce' ) . ' ' . esc_html( $order->get_billing_phone() ) . '</small>';
        }
        return $html;
    }

    public function column_shipping_address($order) {
        $html = '';
        if ( $address = $order->get_formatted_shipping_address() ) {
                $html = '<a target="_blank" href="' . esc_url( $order->get_shipping_address_map_url() ) . '">' . esc_html( preg_replace( '#<br\s*/?>#i', ', ', $address ) ) . '</a>';
        } else {
                $html =  '&ndash;';
        }

        if ( $order->get_shipping_method() ) {
                $html .=  '<small class="meta">' . __( 'Via', 'woocommerce' ) . ' ' . esc_html( $order->get_shipping_method() ) . '</small>';
        }
        return $html;
    }

    public function column_customer_message($order) {
        $html = '';
        if ( $order->get_customer_note() ) {
                $html = '<span class="note-on tips" data-tip="' . wc_sanitize_tooltip( $order->get_customer_note() ) . '">' . __( 'Yes', 'woocommerce' ) . '</span>';
        } else {
                $html = '<span class="na">&ndash;</span>';
        }
        return $html;
    }
    
    public function column_order_notes($order) {
        $comment_count = get_comment_count($order->get_id());
        $comment_count = $comment_count['all'];
        $html = '';
        /*print('*************');
            print($comment_count);
            print('*************');*/
            if ( $comment_count ) {

                    $latest_notes = wc_get_order_notes( array(
                            'order_id' => $order->get_id(),
                            'limit'    => 1,
                            'orderby'  => 'date_created_gmt',
                    ) );

                    $latest_note = current( $latest_notes );

                    if ( isset( $latest_note->content ) && 1 == $comment_count ) {
                            $html =  '<span class="note-on tips" data-tip="' . wc_sanitize_tooltip( $latest_note->content ) . '">' . __( 'Yes', 'woocommerce' ) . '</span>';
                    } elseif ( isset( $latest_note->content ) ) {
                            /* translators: %d: notes count */
                       $html =  '<span class="note-on tips" data-tip="' . wc_sanitize_tooltip( $latest_note->content . '<br/><small style="display:block">' . sprintf( _n( 'Plus %d other note', 'Plus %d other notes', ( $comment_count - 1 ), 'woocommerce' ), $comment_count - 1 ) . '</small>' ) . '">' . __( 'Yes', 'woocommerce' ) . '</span>';
                    } else {
                            /* translators: %d: notes count */
                            $html = '<span class="note-on tips" data-tip="' . wc_sanitize_tooltip( sprintf( _n( '%d note', '%d notes', $comment_count, 'woocommerce' ), $comment_count ) ) . '">' . __( 'Yes', 'woocommerce' ) . '</span>';
                    }
            } else {
                    $html = '<span class="na">&ndash;</span>';
            }
        return $html;
    }
    
    public function column_order_date($order) {
        return sprintf(
                '<time datetime="%1$s" title="%2$s">%3$s</time>',
                esc_attr( $order->get_date_created()->date( 'c' ) ),
                esc_html( $order->get_date_created()->date_i18n( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ) ) ),
                esc_html( $order->get_date_created()->date_i18n( apply_filters( 'woocommerce_admin_order_date_format', get_option( 'date_format' ) ) ) )
        );
    }
    
    public function column_order_total($order) {
        $html = $order->get_formatted_order_total();
        if ( $order->get_payment_method_title() ) {
                $html .= '<small class="meta">' . __( 'Via', 'woocommerce' ) . ' ' . esc_html( $order->get_payment_method_title() ) . '</small>';
        }
        return $html;
    }
    
    public function column_order_actions($order) {
        $html = '';

        $actions = array();

        if ( $order->has_status( array( 'pending', 'on-hold' ) ) ) {
                $actions['processing'] = array(
                        'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=processing&order_id=' . $order->get_id() ), 'woocommerce-mark-order-status' ),
                        'name'      => __( 'Processing', 'woocommerce' ),
                        'action'    => "processing",
                );
        }

        if ( $order->has_status( array( 'pending', 'on-hold', 'processing' ) ) ) {
                $actions['complete'] = array(
                        'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=completed&order_id=' . $order->get_id() ), 'woocommerce-mark-order-status' ),
                        'name'      => __( 'Complete', 'woocommerce' ),
                        'action'    => "complete",
                );
        }

        $actions['view'] = array(
                'url'       => admin_url( 'post.php?post=' . $order->get_id() . '&action=edit' ),
                'name'      => __( 'View', 'woocommerce' ),
                'action'    => "view",
        );

        $actions = apply_filters( 'woocommerce_admin_order_actions', $actions, $order );

        foreach ( $actions as $action ) {
                $html .= sprintf( '<a class="button tips %s" href="%s" data-tip="%s">%s</a>', esc_attr( $action['action'] ), esc_url( $action['url'] ), esc_attr( $action['name'] ), esc_attr( $action['name'] ) );
        }
        return $html;
        
    }
    
    public function column_order_items($order) {
        $product_list = '';
        $order_items = $order->get_items();
        $prodct_name = array();
        global $product_id;
        foreach( $order_items as $item ) {
            if ( $product_id == $item->get_product_id() ) {
                $prodct_name[] = $item['name']."x".$item['qty'];
            }
            
        }
        $product_list = implode( ',', $prodct_name );
        return $product_list;
    }
    

    
    
    
}

function saveServices($postID) {
    if(empty($_POST) || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)) {
        return;
    }
    $servicesData = array();
    $services = array();
    foreach($_POST['services'] as $service) {
        if(isset($service['enable'])) {
            $services[] = (string) $service['enable'];
                $servicesData[$service['id']] = $service;
        }
    }
    empty($servicesData) ? delete_post_meta($postID,'currentServices') : update_post_meta($postID,'currentServices',$servicesData);
    wp_set_object_terms($postID,$services,'service');
}
add_action('save_post','saveServices');
