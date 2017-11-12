<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function wc_meta_box_supplier_fabrics() {
     include 'wc-admin-production-meta-orders.php';
}


add_action( 'add_meta_boxes', 'supplier_meta_boxes' );
if ( ! function_exists( 'supplier_meta_boxes' ) ) {
    function supplier_meta_boxes() {                
        add_meta_box( 'gmp', __( 'Post Google Map', 'gmp-plugin' ), 'gmp_meta_box',  "shop_supplier", 'normal', 'high' );
        add_meta_box( 'woocommerce-supplier-fabrics', __( 'Fabrics', 'woocommerce' ), 'wc_meta_box_supplier_fabrics',  "shop_supplier", 'normal', 'high' );
    }
}