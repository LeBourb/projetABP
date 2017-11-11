<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function wc_meta_box_production_orders() {
    include 'wc-admin-production-meta-orders.php';
}

function wc_meta_box_production_info() {
    global $post;
    if(!class_exists('WC_Meta_Box_Production_Data')) {
        require_once 'class-wc-meta-box-production-data.php';
    }
    WC_Meta_Box_Production_Data::output($post);
}

function wc_meta_box_production_product_image() {
    global $post;
    if(!function_exists('wc_get_production_product')) {
        require_once 'wc-prod-item-functions.php';
    }
    $product = wc_get_production_product($post->ID);
    if ( has_post_thumbnail( $product->get_id() ) ) {
        $attachment_ids[0] = get_post_thumbnail_id( $product->get_id() );
        $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' ); ?>    
        <img src="<?php echo $attachment[0] ; ?>" class="card-image"  />
    <?php    
    }                    
}


add_action( 'add_meta_boxes', 'production_meta_boxes' );
if ( ! function_exists( 'production_meta_boxes' ) ) {
    function production_meta_boxes() {                
        add_meta_box( 'woocommerce-production-meta', __( 'Meta', 'woocommerce' ), 'wc_meta_box_production_info',  "shop_production", 'normal', 'high' );
        add_meta_box( 'woocommerce-production-orders', __( 'Orders', 'woocommerce' ), 'wc_meta_box_production_orders', "shop_production", 'normal', 'high' );        
        add_meta_box( 'woocommerce-production-product-image', __( 'Product Image', 'woocommerce' ), 'wc_meta_box_production_product_image', "shop_production", 'side', 'default' );        
    }
}



