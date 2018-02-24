<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


?>

<div id="productions_tab" class="panel wc-metaboxes-wrapper <?php $is_tabvisible ? '' : 'hidden' ?>">
    <script>
    jQuery( function( $ ) {
        // Add rows.
	var create_production = function(elem) {
                
                jQuery( '#productions_tab' ).block({
                    message: null,
                    overlayCSS: {
                            background: '#fff',
                            opacity: 0.6
                    }
                });
                var data = {
                    action:    'woocommerce_create_production',
                    post_id:   woocommerce_admin_meta_boxes.post_id,
                    order_item_id : jQuery(elem.target).attr('order_item_id')
                };

                jQuery.post( woocommerce_admin_meta_boxes.ajax_url, data, function( response ) {
                    //jQuery( '#mv_order_producion_field input[name="production_id"]' ).prepend( response );
                    //jQuery( '#mv_order_producion_field input[name="production_id"]' ).attr('value',response);
                    jQuery( "#productions_tab" ).replaceWith( response );
                    jQuery( '#productions_tab' ).unblock();
                });

                return false;
            }

            jQuery( '#productions_tab' )
                .on( 'click', '.create_production_btn', create_production );
                                   
    });
</script>
    <div class="toolbar toolbar-top">
        <span class="expand-close">
                <a href="#" class="expand_all"><?php _e( 'Expand', 'woocommerce' ); ?></a> / <a href="#" class="close_all"><?php _e( 'Close', 'woocommerce' ); ?></a>
        </span>
        <?php 
                $new_production_id = wc_get_not_stated_production_item($product_id);
                if( $new_production_id  == null ) {
                    echo '<h2>No Production Planned</h2>';
                    echo '<button type="button" class="button create_production_btn">' . __( 'Plan a new Production', 'woocommerce') . '</button>';
                }else {
                    echo '<h2>Production Planned:</h2>';                    
                }
        ?>
        
	</div>
	<div class="product_productions wc-metaboxes">
            <table class="wp-list-table widefat fixed striped services">
            <thead>
            <tr>
                <th scope="col" id="order_status" class="manage-column column-order_status column-primary">
                    <span class="status_head tips" data-tip="Status">Status</span>
                </th>
                <th scope="col" id="order_title" class="manage-column column-order_title sortable desc">                
                        <span>Production</span>
                </th>
                <th scope="col" id="production_start" class="manage-column column-billing_address">Production date</th>
                <th scope="col" id="production_end" class="manage-column column-shipping_address">Production end</th>
                <th scope="col" id="production_minimum" class="manage-column column-shipping_address">Production minimum</th>
                <th scope="col" id="production_number" class="manage-column column-shipping_address">Production number</th>
                <th scope="col" id="est_shipping_start" class="manage-column column-shipping_address">Estimate Shipping start</th>
                <th scope="col" id="est_shipping_end" class="manage-column column-shipping_address">Estimate Shipping end</th>
            </tr>
            </thead>
            <tbody id="the-list" data-wp-lists="list:service">
		<?php
			// Product attributes - taxonomies and custom, ordered, with visibility and variation attributes set                           
                        $production_ids = get_post_ids_by_meta_key_and_value('_product_id', $product_id);
                        if( is_array($production_ids) ) {
                            foreach($production_ids as $production_id) {
                                $production = wc_get_prod( $production_id );
                                ?>
                                <tr>
                                    <td class="order_status column-order_status has-row-actions column-primary" data-colname="Status">
                                            <mark class="processing tips" data-tip="Processing"><?php echo get_post_status($production_id);?></mark>
                                    </td>
                                    <td class="order_title column-order_title" data-colname="Production">                                    
                                        <a href="<?php echo get_edit_post_link( $production_id); ?>" class="row-title"><strong><?php echo get_the_title($production_id);?></strong></a></td>
                                    <td class="production_start column-billing_address" data-colname="Production start"><?php echo date_i18n( 'Y-m-d', strtotime( $production->get_production_date() ) ); ?></td>
                                    <td class="production_end column-shipping_address" data-colname="Production end"><?php echo date_i18n( 'Y-m-d', strtotime( $production->get_production_end() ) ); ?></td>
                                    <td class="production_min column-shipping_address" data-colname="Production minimum"><?php echo $production->get_production_minimum(); ?></td>
                                    <td class="production_number column-shipping_address" data-colname="Production number"><?php echo $production->get_production_number(); ?></td>
                                    <td class="estimate_shipping_start column-customer_message" data-colname="Estimate Shipping start"><span class="na">–</span></td>
                                    <td class="estimate_shipping_end column-customer_message" data-colname="Estimate Shipping start"><span class="na">–</span></td>
                                </tr>
                                <?php	
                            }
                        }
		?>
            </tbody>
        <tfoot>
	<tr></tr>
	</tfoot>

        </table>
	</div>
	<div class="toolbar">
		<span class="expand-close">
			<a href="#" class="expand_all"><?php _e( 'Expand', 'woocommerce' ); ?></a> / <a href="#" class="close_all"><?php _e( 'Close', 'woocommerce' ); ?></a>
		</span>		
	</div>
</div>
