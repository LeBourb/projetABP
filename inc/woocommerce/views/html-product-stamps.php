<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;
 
?>

<div id="stamps_tab" class="panel wc-metaboxes-wrapper <?php $is_tabvisible ? '' : 'hidden' ?>">
    <script>
    jQuery( function( $ ) {
        // Add rows.
	$( 'button.add_product_stamp' ).on( 'click', function() {
		var attribute    = $( 'select.product_stamp_taxonomy' ).val();
		var $wrapper     = $( this ).closest( '#stamps_tab' );
		var $attributes  = $wrapper.find( '.product_stamps' );
		var product_type = $( 'select#product-type' ).val();
                var selected_stamp = $('#select_product_stamp').val()
                
		var data         = {
			action:   'woocommerce_select_stamps',			
			selected_stamp: selected_stamp,
                        i: $('.product_stamps').children().length,
			security: woocommerce_admin_meta_boxes.add_attribute_nonce
		};

		$wrapper.block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});

		$.post( woocommerce_admin_meta_boxes.ajax_url, data, function( response ) {
                    $attributes.append( response );

                    if ( 'variable' !== product_type ) {
                            $attributes.find( '.enable_variation' ).hide();
                    }

                    $( document.body ).trigger( 'wc-enhanced-select-init' );
                    attribute_row_indexes();
                    $wrapper.unblock();

                    $( document.body ).trigger( 'woocommerce_added_product_stamp' );
		});

		/*if ( attribute ) {
                    $( 'select.product_stamp_taxonomy' ).find( 'option[value="' + attribute + '"]' ).attr( 'disabled','disabled' );
                    $( 'select.product_stamp_taxonomy' ).val( '' );
		}*/

		return false;
	});
        
        // Save attributes and update variations.
	$( '.save_product_stamps' ).on( 'click', function() {

		$( '#woocommerce-product-data' ).block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});

		var data = {
			post_id     : woocommerce_admin_meta_boxes.post_id,
			product_type: $( '#product-type' ).val(),
			data        : $( '.product_stamps' ).find( 'input, select, textarea' ).serialize(),
			action      : 'woocommerce_save_product_stamps',
			security    : woocommerce_admin_meta_boxes.save_attributes_nonce
		};

		$.post( woocommerce_admin_meta_boxes.ajax_url, data, function(response) {                        
                        $( "#stamps_tab" ).replaceWith( response );
                        $( '#woocommerce-product-data' ).unblock();
                        $('.wc-enhanced-select').select2()
			// Reload variations panel.
			//var this_page = window.location.toString();
			//this_page = this_page.replace( 'post-new.php?', 'post.php?post=' + woocommerce_admin_meta_boxes.post_id + '&action=edit&' );
                        
		});
	});
        
        function attribute_row_indexes() {
		$( '.product_attributes .woocommerce_attribute' ).each( function( index, el ) {
			$( '.attribute_position', el ).val( parseInt( $( el ).index( '.product_attributes .woocommerce_attribute' ), 10 ) );
		});
	}
        
                
 jQuery('#stamps_tab').on( 'click', '.remove_product_stamp', function() {
                            var conf = confirm('<?php _e('Are you sure you want remove this stamps from your product?', 'custom-attributes'); ?>');
                            if (conf) {
                                jQuery(this).parent(['.woocommerce_product_stamp']).parent().remove()
                                
                                //alert( option );
                                //jQuery(option).find('input').val('');
                                //jQuery(option).hide();
                            }
                            return false;
                        });
                        
    });
</script>
    <div class="toolbar toolbar-top">
        <span class="expand-close">
                <a href="#" class="expand_all"><?php _e( 'Expand', 'woocommerce' ); ?></a> / <a href="#" class="close_all"><?php _e( 'Close', 'woocommerce' ); ?></a>
        </span>
        <!--select name="product_stamp_taxonomy" class="product_stamp_taxonomy"-->
                <?php
                        //global $wc_product_attributes;
                        //print_r($post);
                        //$data = get_post_meta( $post->ID, 'waaf_attributes', true );
                        //$attribute_names = $data['advanced_attribute_names'];                
                        // Array of defined attribute taxonomies
                        //$attribute_taxonomies = wc_get_attribute_taxonomies();

                        //if ( ! empty( $attribute_taxonomies ) ) {
                          //      foreach ( $attribute_taxonomies as $tax ) {
                                    
                                    
                                    //$attribute_taxonomy_name = wc_attribute_taxonomy_name( $tax->attribute_name );
                                    wp_dropdown_categories( array ( 'taxonomy' => 'pa_stamp' , 'hide_empty' => false, 'id' => 'select_product_stamp' , 'name' => 'select_product_stamp')  );
                                    /*$terms = get_terms( array(
                                        'taxonomy' => 'pa_stamps',
                                        'hide_empty' => false,
                                    ) );
                                    print_r($terms);*/
                            //}
                           /* if( $param_term->parent && !in_array($param_term->parent,$processed_parent )) {
                                    
                                    $term_children = get_term_children( $parent_term->term_id , $attribute_name );                                                
                                    $term_children = array_intersect($attribute_params, $term_children);                                
                                    foreach($term_children as $child_term_id) {
                                        $custom_value = $attribute_values[$child_term_id];  
                                        echo '<td>' . $custom_value . '</td>';
                                    }   
                                    // check if attribute is already selected
                                    $attribute_taxonomy_name = wc_attribute_taxonomy_name( $tax->attribute_name );
                                    $label = $tax->attribute_label ? $tax->attribute_label : $tax->attribute_name;
                                    if($tax->attribute_type == 'advanced_attribute' && !in_array ( $attribute_taxonomy_name , $attribute_names) ) {                                                
                                        echo '<option value="' . esc_attr( $attribute_taxonomy_name ) . '">' . esc_html( $label ) . '</option>';
                                    }
                                }*/
                            //    }
                        //}

                ?>
        <!--/select-->
        <button type="button" class="button add_product_stamp"><?php _e( 'Add Stamp', 'woocommerce' ); ?></button>
	</div>
	<div class="product_stamps wc-metaboxes">
		<?php
			// Product attributes - taxonomies and custom, ordered, with visibility and variation attributes set                           
                        $data = get_post_meta( $post->ID, 'product_stamps', true );
                        if(is_array($data) && array_key_exists('product_stamp_id',$data)){
                            $product_stamp_ids = $data['product_stamp_id'];    
                            $index        = -1;
                            
                            if($product_stamp_ids) {
                                foreach ( $product_stamp_ids as $stamp_id ) {
                                    $index++;                                                                      
                                    include('html-product-stamps-content.php');
                                }
                            }
                        }
		?>
	</div>
	<div class="toolbar">
		<span class="expand-close">
			<a href="#" class="expand_all"><?php _e( 'Expand', 'woocommerce' ); ?></a> / <a href="#" class="close_all"><?php _e( 'Close', 'woocommerce' ); ?></a>
		</span>
		<button type="button" class="button save_product_stamps button-primary"><?php _e( 'Save Product Stamps', 'woocommerce' ); ?></button>
	</div>
	<?php do_action( 'woocommerce_product_options_attributes' ); ?>
</div>
