<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function wc_custom_product_price($price, $that) {
    /*
$prices = $this->get_variation_prices( true );

if ( empty( $prices['price'] ) ) {
        $price = apply_filters( 'woocommerce_variable_empty_price_html', '', $this );
} else {
        $min_price     = current( $prices['price'] );
        $max_price     = end( $prices['price'] );
        $min_reg_price = current( $prices['regular_price'] );
        $max_reg_price = end( $prices['regular_price'] );

        if ( $min_price !== $max_price ) {
                $price = wc_format_price_range( $min_price, $max_price );
        } elseif ( $this->is_on_sale() && $min_reg_price === $max_reg_price ) {
                $price = wc_format_sale_price( wc_price( $max_reg_price ), wc_price( $min_price ) );
        } else {
                $price = wc_price( $min_price );
        }

        $price = apply_filters( 'woocommerce_variable_price_html', $price . $this->get_price_suffix(), $this );*/
    //$prices = $that->get_variation_prices( true ); //$prices['regular_price']
    
    $pre_sale_price = null;
    $priv_sale_price = null;
    $regular_price = null; 
    
    if($that->is_type( 'variable' ) && !empty($that->get_available_variations( ))) {
        $variations = $that->get_available_variations( );
        if($variations[0]['variation_id']) {
            $pre_sale_price = wc_price(get_post_meta($variations[0]['variation_id'],'pre_sale_price',true));
            $priv_sale_price = wc_price(get_post_meta($variations[0]['variation_id'],'priv_sale_price',true));
        }
        $regular_price = wc_price($variations[0]['display_regular_price']);        
    }else {        
        $pre_sale_price = wc_price(get_post_meta($that->get_id(),'pre_sale_price',true));
        $priv_sale_price = wc_price(get_post_meta($that->get_id(),'priv_sale_price',true));
        $regular_price = wc_price($that->get_regular_price());        
    }
    global $post;
    $new_production_id = wc_get_not_stated_production_item($that->get_id());   
    if($new_production_id) {
        $user = wp_get_current_user(); 
        $role = ( array ) $user->roles;
        if(in_array( 'customer-pro', $role )) {
            return '<div class="priv-sale"><small>卸価格: </small>' . $priv_sale_price . '</div>'            
                . '<div class="regular"><small>通常価格: </small><del>' . $regular_price .'</del></div>';            
        }

        return '<div class="pre-sale"><small>先行予約価格: </small>' . $pre_sale_price . '</div>'            
                . '<div class="regular"><small>通常価格: </small><del>' . $regular_price .'</del></div> ';
    }
    return '<div class="price">' . wc_price($that->get_price()) . '</div>';
    //wc_price($that->get_regular_price())
    //. '<span class="pre-sale"><del>' . $pre_sale_price . '</del><small>Pre-Sale</small></span>'
}


add_filter( 'woocommerce_get_price_html', 'wc_custom_product_price', 20 , 2 );


function wc_custom_product_get_stock_html( $html, $product) {
    return '';
}
add_filter( 'woocommerce_get_stock_html', 'wc_custom_product_get_stock_html', 10 ,2);


//add_filter( 'woocommerce_variable_price_html' , 'wc_custom_variable_product_price', 20 , 3 );