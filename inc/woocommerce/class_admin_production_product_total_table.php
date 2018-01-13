<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class_admin_production_product_total_items
 *
 * @author smash
 */

if(!class_exists('WP_List_Table')) {
    require_once(ABSPATH.'wp-admin/includes/class-wp-list-table.php');
}


class Production_Product_Total_Table extends WP_List_Table {
    //put your code here
    
    public function __construct(){
        parent::__construct(
            array(
                'singular' => 'service',
                'plural' => 'services',
                'ajax' => false
            )
        );
    }
    
    /**
 * Generates the table navigation above or bellow the table and removes the
 * _wp_http_referrer and _wpnonce because it generates a error about URL too large
 * 
 * @param string $which 
 * @return void
 */
public function display_tablenav( $which ) 
{
    ?>
    <div class="tablenav <?php echo esc_attr( $which ); ?>">

        <div class="alignleft actions">
            <?php $this->bulk_actions(); ?>
        </div>
        <?php
        $this->extra_tablenav( $which );
        $this->pagination( $which );
        ?>
        <br class="clear" />
    </div>
    <?php
}

    private function table_data() {
        global $production_id;
        if(!function_exists('wc_get_order_items_of_production'))
            require_once 'wc-prod-functions.php';
        $order_items = wc_get_order_items_of_production($production_id);
        $table_data = array();
        foreach($order_items as $order_item){
            //$items = wc_get_production_order_items($production_id, $order->get_id());
            //foreach($items as $item) {
                $var_id = $order_item->get_variation_id();//['variation_id'];
                $product_id = $order_item->get_product_id();//['variation_id'];
                $order = $order_item->get_order();
                $metas = $order_item->get_meta_data( );                 
                
                $total_variation = array();
                
                if(array_key_exists ( $var_id , $table_data)){
                    $total_variation = $table_data[$var_id];                    
                    $total_variation['qty'] += $order_item->get_quantity();
                    $total_variation['name'] = $order_item->get_name();
                    $total_variation['total'] += $order_item->get_total();
                }else {
                    $total_variation = array ('name' => $order_item->get_name(), 'qty' => $order_item->get_quantity(), 'total' => $order_item->get_total() , 'subtotal' => $order->get_item_subtotal($order_item,false, true));                    
                }                
                $table_data[$var_id] = $total_variation;
            //}
        }        
        return $table_data;
    }
    
    	public function get_columns() {
		$columns                     = array();
		//$columns['cb']               = '<input type="checkbox" />';
		$columns['name']     = __( 'Variation', 'woocommerce' );		
                $columns['subtotal']      = __( 'Cost', 'woocommerce' );
                $columns['qty']      = __( 'Quantity', 'woocommerce' );
		$columns['total']  = __( 'Total Value', 'woocommerce' );
		//$columns['order_actions']    = __( 'Actions', 'woocommerce' );

		return $columns;
	}
        
        public function column_name($item) {
            return '<span class="na">' . $item['name'] . '</span>';            
        }
        
        public function column_qty($item) {
            return '<span class="na"> x ' .  $item['qty'] . '</span>';
        }
        
        public function column_total($item) {
            return '<span class="na">' . wc_price($item['total']) . '</span>';
        }
        
        public function column_subtotal($item) {
            return '<span class="na">' . wc_price($item['subtotal']) . '</span>';
        }
        
        public function prepare_items() {       
        $this->_column_headers = array($this->get_columns(),$this->get_hidden_columns(),$this->get_sortable_columns());
        $this->items = $this->table_data();       
    }
    
    public function get_sortable_columns( ) {
		return array();		
	}

    
    
    public function get_hidden_columns() {
        return array();
    }


}
