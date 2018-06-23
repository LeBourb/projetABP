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

<div id="workshop_products_section" class="panel wc-metaboxes-wrapper">
    
    <div class="toolbar toolbar-top">
        <span class="expand-close">
                <a href="#" class="expand_all"><?php _e( 'Expand', 'woocommerce' ); ?></a> / <a href="#" class="close_all"><?php _e( 'Close', 'woocommerce' ); ?></a>
        </span>
        <!--select name="worshop_product_taxonomy" class="worshop_product_taxonomy"-->
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
    wp_dropdown_posts( array( 'post_type' => 'product' ,	//                'depth' => 0, 'child_of' => 0,
	                'id' => 'product_id')
    ); 
    
                                    /*$terms = get_terms( array(
                                        'taxonomy' => 'pa_supply',
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
        <button type="button" class="button add_worshop_product"><?php _e( 'Add Product', 'woocommerce' ); ?></button>
	</div>
	<div class="product_supplies wc-metaboxes">
		<?php
			// Product attributes - taxonomies and custom, ordered, with visibility and variation attributes set                           
                        $data = get_post_meta( $post->ID, 'product_ids' , true);
                        if(is_array($data)){                            
                            foreach ( $data as $product_id ) {
                                $product = wc_get_product($product_id);
                                include 'html-page-workshop-product-content.php';
                            }
                            
                        }
		?>
	</div>	
	<?php do_action( 'woocommerce_product_options_attributes' ); ?>
    <script>
    jQuery( function( $ ) {
         function getParameterByName(name, url) {
            if (!url)
                url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                    results = regex.exec(url);
            if (!results)
                return null;
            if (!results[2])
                return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }
        // Add rows.
	$( 'button.add_worshop_product' ).on( 'click', function() {
		var $wrapper     = $( this ).closest( '#workshop_products_section' );
		var $attributes  = $wrapper.find( '.product_supplies' );
		var product_type = $( 'select#product-type' ).val();
                
		var data         = {
			action:   'woocommerce_add_workshop_product_partnership',			
                        product_id: $('#product_id').val(),
                        post_id: getParameterByName('post',document.location.href)
		};

		$.post( ajaxurl, data, function( response ) {
                    $wrapper.replaceWith( response );
		});


		return false;
	});
        
        // Add rows.
	$( 'a.remove_workshop_product' ).on( 'click', function() {
		var $wrapper     = $( this ).closest( '#workshop_products_section' );
		
                
		var data         = {
			action:   'woocommerce_remove_workshop_product_partnership',
                        product_id: $(this).data('product-id'),
                        post_id: getParameterByName('post',document.location.href)
		};

		$.post( ajaxurl, data, function( response ) {
                    $wrapper.replaceWith( response );                
		});


		return false;
	});
        
        
        function attribute_row_indexes() {
		$( '.product_attributes .woocommerce_attribute' ).each( function( index, el ) {
			$( '.attribute_position', el ).val( parseInt( $( el ).index( '.product_attributes .woocommerce_attribute' ), 10 ) );
		});
	}
        
                        
    });
</script>
</div>
