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
        //add_meta_box( 'mv_order_producion_field', __('Production','woocommerce'), 'order_production_field_for_packaging', 'shop_order', 'side', 'core' );
    }
}

add_action( 'woocommerce_admin_order_item_headers', 'add_order_item_status_header' );
if ( ! function_exists( 'add_order_item_status_header' ) ) {
    function add_order_item_status_header()
    {
        ?><th class="line_status" data-sort="float">Production Status</th>
        <?php
    }
}

add_action( 'woocommerce_admin_order_item_values', 'admin_order_item_production_status' , 40, 2  );
if ( ! function_exists( 'admin_order_item_production_status' ) ) {
    function admin_order_item_production_status($item,  $order_item ) 
    {
        ?><td class="item_status" width="1%">
		<div class="view"> 
			<?php
                               //print_r($order_item->get_meta_data());
                        
                                if(get_class  ( $order_item ) == 'WC_Order_Item_Product') {
                               //$order_item->add_meta_data( 'status', 'NOT ASSOCIATED PRODUCT');
                               $production_id = $order_item->get_meta('_production_id', true);
                               if($production_id == '' ) {
                                   echo "NO PRODUCTION";
                               } else {
                                   $production = get_post($production_id);                                   
                                   echo '<a href="' . get_edit_post_link($production_id) .'"><mark>' . get_post_status( $production_id) . '</mark></a>'; 
                               }
                                }
                               //$production_ids = $proget_post_meta( $post->ID, '_production_id', false );
			?>
		</div>
	</td>
        <?php
    }
}

add_action( 'woocommerce_after_order_itemmeta', 'admin_wc_after_order_itemmeta', 20, 3 );
if ( ! function_exists( 'admin_wc_after_order_itemmeta' ) )
{
    function admin_wc_after_order_itemmeta( $item_id, $item, $_product ) {
        global $wpdb;
        $production_id = wc_get_not_stated_production_item ($_product->get_id());
        if($production_id != '')
            return;
        ?>
        <script type="text/javascript">
        jQuery(function(){

            var go_to_production = function(elem) {
                
                jQuery( '#woocommerce-order-items' ).block({
                    message: null,
                    overlayCSS: {
                            background: '#fff',
                            opacity: 0.6
                    }
                });
                var data = {
                    action:    'woocommerce_go_to_production',
                    post_id:   woocommerce_admin_meta_boxes.post_id,
                    order_item_id : jQuery(elem.target).attr('order_item_id')
                };

                jQuery.post( woocommerce_admin_meta_boxes.ajax_url, data, function( response ) {
                    //jQuery( '#mv_order_producion_field input[name="production_id"]' ).prepend( response );
                    //jQuery( '#mv_order_producion_field input[name="production_id"]' ).attr('value',response);
                    jQuery( "#woocommerce-order-items .woocommerce_order_items_wrapper.wc-order-items-editable" ).replaceWith( response );
                    jQuery( '#woocommerce-order-items' ).unblock();
                });

                return false;
            }

            jQuery( '#woocommerce-order-items' )
                .on( 'click', '.go_to_production_btn', go_to_production );
            
        });
        
        </script>
        <a order_item_id="<?php echo $item_id; ?>" class="button button-small go_to_production_btn"><?php _e( 'Go to Production', 'woocommerce-deposits' ); ?></a>
        
        <?php
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

add_action( 'wp_ajax_woocommerce_go_to_production', 'wc_order_custom_create_production_item' );

        
/**
* Add an attribute row.
*/
function wc_order_custom_associate_with_production_item() {
    ob_start();

    //check_ajax_referer( 'add-advanced-attribute', 'security' );

    if ( ! current_user_can( 'edit_products' ) ) {
            wp_die( -1 );
    }

    if(!function_exists('wc_add_prod_item')) {
        require_once 'wc-prod-item-functions.php';
    }

    
    //$production_ids = wc_add_prod_items( sanitize_text_field( $_POST['post_id'] ) );
    $order_id = sanitize_text_field( $_POST['post_id'] ) ;
    $order_item_id = sanitize_text_field( $_POST['order_item_id'] ) ;
    $production_id = wc_associate_order_item_to_prod_item( $order_id ,  $order_item_id );
       
    WC_Meta_Box_Order_Items::output();
   /* foreach( $production_ids as $production_id ) {
        // This method uses `add_post_meta()` instead of `update_post_meta()`
        add_post_meta( $_POST['post_id'], '_production_id', $production_id );
    }*/
    
      
       
    //echo 'hello: ' . $production_id;

    //update_post_meta( sanitize_text_field( $_POST['post_id'] ), '_production_id', $production_id );

    //include 'wc-admin-view-order-meta-production.php';

    wp_die();
}