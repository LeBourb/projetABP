<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Adding Meta container admin shop_order pages
add_action( 'add_meta_boxes', 'order_producion_meta_boxes' );
if ( ! function_exists( 'order_producion_meta_boxes' ) )
{
    function order_producion_meta_boxes()
    {
        add_meta_box( 'mv_order_producion_field', __('Production','woocommerce'), 'order_production_field_for_packaging', 'shop_order', 'side', 'core' );
    }
}

// Adding Meta field in the meta container admin shop_order pages
if ( ! function_exists( 'order_production_field_for_packaging' ) )
{
    function order_production_field_for_packaging()
    {
        global $post;

        $meta_field_data = get_post_meta( $post->ID, '_production_id', true ) ? get_post_meta( $post->ID, '_production_id', true ) : '';
        
        ?>
        <script type="text/javascript">
        jQuery(function(){

            var create_production = function() {
                
                jQuery( '#mv_order_producion_field' ).block({
                    message: null,
                    overlayCSS: {
                            background: '#fff',
                            opacity: 0.6
                    }
                });

                var data = {
                    action:    'woocommerce_create_production',
                    post_id:   woocommerce_admin_meta_boxes.post_id
                };

                jQuery.post( woocommerce_admin_meta_boxes.ajax_url, data, function( response ) {
                    //jQuery( '#mv_order_producion_field input[name="production_id"]' ).prepend( response );
                    //jQuery( '#mv_order_producion_field input[name="production_id"]' ).attr('value',response);
                    jQuery( "#mv_order_producion_field #production-info-meta" ).replaceWith( response );
                    jQuery( '#mv_order_producion_field' ).unblock();
                });

                return false;
            }

            jQuery( '#mv_order_producion_field' )
                .on( 'click', '.create_production', create_production );
            
        });
        
        </script>
        <?php
        
        include 'wc-admin-view-order-meta-production.php';
        
        //if ( "" == get_edit_post_link( $production_id ) ) {
            // The post does not exist
          // $production_id = null;
        //} 
        

    }
}

// Save the data of the Meta field
add_action( 'save_post', 'mv_save_wc_order_production_field', 10, 1 );
if ( ! function_exists( 'mv_save_wc_order_production_field' ) )
{

    function mv_save_wc_order_production_field( $post_id ) {
        return;
        // We need to verify this with the proper authorization (security stuff).

        // Check if our nonce is set.
        if ( ! isset( $_POST[ 'mv_other_meta_field_nonce' ] ) ) {
            return $post_id;
        }
        $nonce = $_REQUEST[ 'mv_other_meta_field_nonce' ];

        //Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce ) ) {
            return $post_id;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check the user's permissions.
        if ( 'page' == $_POST[ 'post_type' ] ) {

            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {

            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }
        // --- Its safe for us to save the data ! --- //

        // Sanitize user input  and update the meta field in the database.
        update_post_meta( $post_id, '_production_id', $_POST[ 'my_field_name' ] );
    }
}


// Display field value on the order edit page (not in custom fields metabox)
add_action( 'woocommerce_admin_order_data_after_billing_address', 'order_production_field_display_admin_order_meta', 10, 1 );
function order_production_field_display_admin_order_meta($order){
    $my_custom_field = get_post_meta( $order->get_id(), '_production_id', true );
    if ( ! empty( $my_custom_field ) ) {
        echo '<p><strong>'. __("Production", "woocommerce").':</strong> ' . get_post_meta( $order->get_id(), '_production_id', true ) . '</p>';
    }
}

add_action( 'wp_ajax_woocommerce_create_production', 'wc_order_custom_create_production_item' );

        
/**
* Add an attribute row.
*/
function wc_order_custom_create_production_item() {
    ob_start();

    //check_ajax_referer( 'add-advanced-attribute', 'security' );

    if ( ! current_user_can( 'edit_products' ) ) {
            wp_die( -1 );
    }

    if(!function_exists('wc_add_prod_items')) {
        require_once 'wc-prod-item-functions.php';
    }

    
    $production_ids = wc_add_prod_items( sanitize_text_field( $_POST['post_id'] ) );
       
    foreach( $production_ids as $production_id ) {
        // This method uses `add_post_meta()` instead of `update_post_meta()`
        add_post_meta( $_POST['post_id'], '_production_id', $production_id );
    }
    
    $post = get_post($_POST['post_id']);
    include 'wc-admin-view-order-meta-production.php';
       
       
    //echo 'hello: ' . $production_id;

    //update_post_meta( sanitize_text_field( $_POST['post_id'] ), '_production_id', $production_id );

    //include 'wc-admin-view-order-meta-production.php';

    wp_die();
}