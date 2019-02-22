<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of class-wc-abourgeons-product-variation
 *
 * @author smash
 */
class AB_Product_Variation extends WC_Product_Variable {
//put your code here
    /*function __construct() {
        parent::__construct();     
    }*/
    /**
	 * Returns the product's active price.
	 *
	 * @param  string $context What the value is for. Valid values are view and edit.
	 * @return string price
	 */
	public function get_price( $context = 'view' ) {
            //throw new Exception($this);
            $variations = $this->get_available_variations( );
            if($variations[0]['variation_id']) {
                $new_production_id = wc_get_not_stated_production_item($this->get_id());               
                if($new_production_id) {
                    $user = wp_get_current_user(); 
                    $role = ( array ) $user->roles;
                    if(in_array( 'customer-pro', $role )) {
                        return get_post_meta($variations[0]['variation_id'],'priv_sale_price',true);
                    }else {
                        return get_post_meta($variations[0]['variation_id'],'pre_sale_price',true);
                    }
                }
            }
            return $this->get_prop( 'price', $context );
	}
}
