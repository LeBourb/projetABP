<script>
    window.addEventListener("DOMContentLoaded", function() {
        // Select the node that will be observed for mutations
        const targetNode = document.querySelector('.product-add-to-cart');
        
        var $select = jQuery('form.variations_form.cart select');
        
        
         /**
            * See if attributes match.
            * @return {Boolean}
            */
         var isMatch = function( variation_attributes, attributes ) {
                   var match = true;
                   for ( var attr_name in variation_attributes ) {
                           if ( variation_attributes.hasOwnProperty( attr_name ) ) {
                                   var val1 = variation_attributes[ attr_name ];
                                   var val2 = attributes[ attr_name ];
                                   if ( val1 !== undefined && val2 !== undefined && val1.length !== 0 && val2.length !== 0 && val1 !== val2 ) {
                                           match = false;
                                   }
                           }
                   }
                   return match;
           };
        
        /**
            * Find matching variations for attributes.
            */
        var findMatchingVariations = function( variations, attributes ) {
                   var matching = [];
                   for ( var i = 0; i < variations.length; i++ ) {
                           var variation = variations[i];

                           if ( isMatch( variation.attributes, attributes ) ) {
                                   matching.push( variation );
                           }
                   }
                   return matching;
           };

          
        var onChange = function(evt) {
            var variationData = jQuery(document.querySelector('.variations_form.cart')).data( 'product_variations' );
            var selection = {};
            $select.each(function(idx, slc) {
                selection[jQuery(slc).data('attribute_name')] = slc.value;
            })
            
            var variations = findMatchingVariations( variationData, selection );
            if(variations.length == 1) {
                 document.querySelector('.product-price .regular .price').innerHTML = variations[0].price_html;
                 var pre_sale = document.querySelector('.product-price .pre_sale .price');
                 if(pre_sale) pre_sale.innerHTML = variations[0].pre_sale_price_html;
            }
        }
        
        $select.change(onChange);
        
        onChange();
        
            /*

        // Options for the observer (which mutations to observe)
        const config = { attributes: true, childList: true, subtree: true };

        // Callback function to execute when mutations are observed
        const callback = function(mutationsList, observer) {
            // Use traditional 'for loops' for IE 11
        for(let mutation of mutationsList) {
                if (mutation.type === 'childList') {
                    console.log('A child node has been added or removed.');
                }
                else if (mutation.type === 'attributes') {
                    console.log('The ' + mutation.attributeName + ' attribute was modified.');
                }
            }
            var sourceNode = document.querySelector('.product-add-to-cart span.woocommerce-Price-amount.amount');
            var variationData = document.querySelector('.variations_form.cart').data( 'product_variations' );
            var targetNode = document.querySelector('.product-price .price.variable');
            alert('change');
        };

        // Create an observer instance linked to the callback function
        const observer = new MutationObserver(callback);

        // Start observing the target node for configured mutations
        observer.observe(targetNode, config);
        */
    });
</script>


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
    $variable_class = '';
    
    if($that->is_type( 'variable' ) && !empty($that->get_available_variations( ))) {
        $variable_class = 'variable';
        $variations = $that->get_available_variations( );
        if($variations[0]['variation_id']) {
            $pre_sale_price = wc_price(get_post_meta($variations[0]['variation_id'],'pre_sale_price',true));
            $priv_sale_price = wc_price(get_post_meta($variations[0]['variation_id'],'priv_sale_price',true));
        }
        $regular_price = wc_price($variations[0]['display_regular_price']);        
    }else {        
        $pre_sale_price = wc_price(get_post_meta($that->get_id(),'pre_sale_price',true));
        $priv_sale_price = wc_price(get_post_meta($that->get_id(),'priv_sale_price',true));
        $regular_price = wc_price($that->get_regular_price());        
    }
    global $post;
    $new_production_id = wc_get_not_stated_production_item($that->get_id());   
    if($new_production_id) {
        $user = wp_get_current_user(); 
        $role = ( array ) $user->roles;
        if(in_array( 'customer-pro', $role )) {
            return '<div class="priv-sale ' . $variable_class . ' "><small>卸価格: </small><div class="price">' . $priv_sale_price . '</div></div>'            
                . '<div class="regular ' . $variable_class . ' "><small>通常価格: </small><del><div class="price">' . $regular_price .'</div></del></div>';            
        }

        return '<div class="pre-sale ' . $variable_class . ' "><small>先行予約価格: </small><div class="price">' . $pre_sale_price . '</div></div>'            
                . '<div class="regular ' . $variable_class . ' "><small>通常価格: </small><del><div class="price">' . $regular_price .'</div></del></div> ';
    }
    return '<div class="regular "><div class="price">' . wc_price($that->get_price()) . '</div></div>';
    //wc_price($that->get_regular_price())
    //. '<span class="pre-sale"><del>' . $pre_sale_price . '</del><small>Pre-Sale</small></span>'
}


add_filter( 'woocommerce_get_price_html', 'wc_custom_product_price', 20 , 2 );


function wc_custom_product_get_stock_html( $html, $product) {
    return '';
}
add_filter( 'woocommerce_get_stock_html', 'wc_custom_product_get_stock_html', 10 ,2);



function wc_custom_product_available_variation( $output , $product, $variation) { 
    $output['pre_sale_price_html'] = wc_price(get_post_meta($product->get_id(),'pre_sale_price',true));
    return $output;
}
add_filter( 'woocommerce_available_variation', 'wc_custom_product_available_variation', 10 ,3);

function wc_custom_product_show_variation_price( $show_variation_price, $product, $variation) { 
    return true;
}
add_filter( 'woocommerce_show_variation_price', 'wc_custom_product_show_variation_price', 10 ,3 );


//add_filter( 'woocommerce_variable_price_html' , 'wc_custom_variable_product_price', 20 , 3 );