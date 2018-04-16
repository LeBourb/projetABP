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

function wc_meta_box_production_total_table() {
    if(!class_exists('Production_Product_Total_Table')) {
        require_once 'class_admin_production_product_total_table.php';
    }
    global $post,$production_id;
    $production_id = $post->ID;
    $prod_total_table = new Production_Product_Total_Table();
    $prod_total_table->prepare_items();
    $prod_total_table->display();
}


function wc_meta_box_production_product_image() {
    global $post;
    if(!function_exists('wc_get_production_product')) {
        require_once 'wc-prod-item-functions.php';
    }
    $product = wc_get_production_product($post->ID);
    if ( has_post_thumbnail( $product->get_id() ) ) {
        $attachment_ids[0] = get_post_thumbnail_id( $product->get_id() );
        $attachment = wp_get_attachment_image_src($attachment_ids[0] ); ?>    
        <img src="<?php echo $attachment[0] ; ?>" class="card-image"  />
    <?php    
    }                    
}

require_once 'class-wc-meta-box-production-actions.php';
add_action( 'add_meta_boxes', 'production_meta_boxes' );
if ( ! function_exists( 'production_meta_boxes' ) ) {
    function production_meta_boxes() {                
       add_meta_box( 'woocommerce-production-meta', __( 'Production meta', 'woocommerce' ), 'wc_meta_box_production_info',  "shop_production", 'normal', 'high' );
        add_meta_box( 'woocommerce-production-orders', __( 'Production Orders', 'woocommerce' ), 'wc_meta_box_production_orders', "shop_production", 'normal', 'default' );        
       add_meta_box( 'woocommerce-production-total-table', __( 'Total Production', 'woocommerce' ), 'wc_meta_box_production_total_table', "shop_production", 'normal', 'high' );        
        add_meta_box( 'woocommerce-production-product-image', __( 'Product Image', 'woocommerce' ), 'wc_meta_box_production_product_image', "shop_production", 'side', 'default' );        
        add_meta_box( 'woocommerce-production-actions', sprintf( __( '%s actions', 'woocommerce' ), 'Production' ), 'WC_Meta_Box_Production_Actions::output', "shop_production", 'side', 'high' );
        remove_meta_box( 'submitdiv', 'shop_production', 'side' );
    }
}
 if(!class_exists('WC_Meta_Box_Production_Data')) {
        require_once 'class-wc-meta-box-production-data.php';
    }
add_action( 'save_post', 'WC_Meta_Box_Production_Actions::save' , 1, 2 );
add_action( 'save_post', 'WC_Meta_Box_Production_Data::save' , 1, 2 );






