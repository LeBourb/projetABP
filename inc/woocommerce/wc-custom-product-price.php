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
    
    if(!is_a($that, 'WC_Product_Variation') && !is_a($that, 'WC_Product_Simple') && !empty($that->get_available_variations( ))) {
        $variations = $that->get_available_variations( );
        $pre_sale_price = wc_price(get_post_meta($variations[0]['variation_id'],'pre_sale_price',true));
        $priv_sale_price = wc_price(get_post_meta($variations[0]['variation_id'],'priv_sale_price',true));
        $regular_price = wc_price($variations[0]['display_regular_price']);        
    }else {
        $pre_sale_price = wc_price(get_post_meta($that->get_id(),'pre_sale_price',true));
        $priv_sale_price = wc_price(get_post_meta($that->get_id(),'priv_sale_price',true));
        $regular_price = wc_price($that->get_regular_price());        
    }
    $user = wp_get_current_user(); 
    $role = ( array ) $user->roles;
    if(in_array( 'customer-pro', $role )) {
        return '<b id="price-field" class="price crowdfunding" itemprop="offers" itemscope="" itemtype="//schema.org/Offer">'
            . '<span class="priv-sale"><small>Priv-Sale: </small>' . $priv_sale_price . '</span>'            
            . '<span class="pre-sale" style="font-size:0.7em;margin-left:1em;"><small>Pre-Sale: </small><del>' . $pre_sale_price . '</del></span>'
            . '<span class="regular" style="font-size:0.7em;margin-left:1em;"><small>Regular: </small><del>' . $regular_price .'</del></span>'
            . '</b>';
    }
    
    return '<b id="price-field" class="price crowdfunding" itemprop="offers" itemscope="" itemtype="//schema.org/Offer">'
            . '<span class="pre-sale"><small>Pre-Sale: </small>' . $pre_sale_price . '</span>'            
            . '<span class="regular" style="font-size:0.7em;margin-left:1em;"><small>Regular: </small><del>' . $regular_price .'</del></span> '
            . '</b>';
    //wc_price($that->get_regular_price())
    //. '<span class="pre-sale"><del>' . $pre_sale_price . '</del><small>Pre-Sale</small></span>'
}


add_filter( 'woocommerce_get_price_html', 'wc_custom_product_price', 20 , 2 );


//add_filter( 'woocommerce_variable_price_html' , 'wc_custom_variable_product_price', 20 , 3 );