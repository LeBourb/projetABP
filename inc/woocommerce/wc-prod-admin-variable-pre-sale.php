<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function wc_prod_admin_variable_pre_sale( $loop, $variation_data, $variation) {
    $label = sprintf(__( 'Pre-Sale price (%s)', 'woocommerce' ),
                            get_woocommerce_currency_symbol()
                    );
    woocommerce_wp_text_input( array(
        'id'            => "variable_pre_sale_price{$loop}",
        'name'          => "variable_pre_sale_price[{$loop}]",
        'value'         => get_post_meta($variation->ID, 'pre_sale_price' , true ),
        'data_type'     => 'price',
        'label'         => $label,
        'wrapper_class' => 'form-row form-row-last',
    ) );

}

add_action( 'woocommerce_variation_options_pricing' , 'wc_prod_admin_variable_pre_sale', 20, 3 ); 

function wc_prod_admin_variable_pre_sale_save( $variation_id, $i) {
    update_post_meta($variation_id, 'pre_sale_price', $_POST['variable_pre_sale_price'][ $i ] );
    //add_post_meta('162', 'pre_sale_price', '123' );
}

add_action( 'woocommerce_save_product_variation', 'wc_prod_admin_variable_pre_sale_save', 20, 2 );



function wc_prod_admin_variable_priv_sale( $loop, $variation_data, $variation) {
    $label = sprintf(__( 'Private price (%s)', 'woocommerce' ),
                            get_woocommerce_currency_symbol()
                    );
    woocommerce_wp_text_input( array(
        'id'            => "variable_priv_sale_price{$loop}",
        'name'          => "variable_priv_sale_price[{$loop}]",
        'value'         => get_post_meta($variation->ID, 'priv_sale_price' , true ),
        'data_type'     => 'price',
        'label'         => $label,
        'wrapper_class' => 'form-row form-row-last',
    ) );

}

add_action( 'woocommerce_variation_options_pricing' , 'wc_prod_admin_variable_priv_sale', 20, 3 ); 

function wc_prod_admin_variable_priv_sale_save( $variation_id, $i) {
    update_post_meta($variation_id, 'priv_sale_price', $_POST['variable_priv_sale_price'][ $i ] );
    //add_post_meta('162', 'priv_sale_price', '123' );
}

add_action( 'woocommerce_save_product_variation', 'wc_prod_admin_variable_priv_sale_save', 20, 2 );



function wc_prod_admin_pre_sale( ) {
    global $product_object;
    $label = sprintf(__( 'Pre-Sale price (%s)', 'woocommerce' ),
                            get_woocommerce_currency_symbol()
                    );
    woocommerce_wp_text_input( array(
        'id'            => "pre_sale_price",
        'name'          => "pre_sale_price",
        'value'         => get_post_meta($product_object->get_id(), 'pre_sale_price' , true ),
        'data_type'     => 'price',
        'label'         => $label,
        'wrapper_class' => 'form-row form-row-last',
    ) );

}

add_action( 'woocommerce_product_options_pricing' , 'wc_prod_admin_pre_sale', 20 );


function wc_prod_admin_pre_sale_save( $product ) {
    update_post_meta($product->get_id(), 'pre_sale_price', $_POST['pre_sale_price']);
    //add_post_meta('162', 'priv_sale_price', '123' );
}


add_action( 'woocommerce_admin_process_product_object', 'wc_prod_admin_pre_sale_save' , 20,1 );


function wc_prod_admin_priv_sale( ) {
    $label = sprintf(__( 'Private-Sale price (%s)', 'woocommerce' ),
                            get_woocommerce_currency_symbol()
                    );
    global $product_object;
    woocommerce_wp_text_input( array(
        'id'            => "priv_sale_price",
        'name'          => "priv_sale_price",
        'value'         => get_post_meta($product_object->get_id(), 'priv_sale_price' , true ),
        'data_type'     => 'price',
        'label'         => $label,
        'wrapper_class' => 'form-row form-row-last',
    ) );

}

add_action( 'woocommerce_product_options_pricing' , 'wc_prod_admin_priv_sale', 20 );


function wc_prod_admin_priv_sale_save( $product ) {
    update_post_meta($product->get_id(), 'priv_sale_price', $_POST['priv_sale_price']);
    //add_post_meta('162', 'priv_sale_price', '123' );
}


add_action( 'woocommerce_admin_process_product_object', 'wc_prod_admin_priv_sale_save' , 20,1 );