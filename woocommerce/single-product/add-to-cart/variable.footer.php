<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.1
 */
defined( 'ABSPATH' ) || exit;
global $product;
$attribute_keys = array_keys( $attributes );
do_action( 'woocommerce_before_add_to_cart_form' ); 


if( !function_exists('get_variation_from_term_slug') ) { 
    function get_variation_from_term_slug($variations, $attribute , $slug_id) {    
        foreach($variations as $variation ) {
            $var_attr = $variation['attributes'];
            if( array_key_exists ('attribute_' . $attribute, $var_attr) && $var_attr['attribute_' . $attribute] == $slug_id ) {
                return $variation;
            }
        }
        return null;
    }
}



?>

<style>
.variations_form.row.cart .ui-customSelect-dropdown {
    bottom: 46px;
}
</style>


<form class="variations_form row cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ); // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
                
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>		
						
						<div class="attribute">
							<?php   
                                                                
                                                                
								/*wc_dropdown_variation_attribute_options( array(
									'options'   => $options,
									'attribute' => $attribute_name,
									'product'   => $product,
								) );*/
               

		

                $attribute             = $attribute_name;
		$name                  = 'attribute_' . sanitize_title( $attribute );
		$id                    = sanitize_title( $attribute );
		$class                 = '';
		$show_option_none      = false;
		$show_option_none_text = '';
                $selected_key     = 'attribute_' . sanitize_title( $attribute );
                $selected = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( urldecode( wp_unslash( $_REQUEST[ $selected_key ] ) ) ) : $product->get_variation_default_attribute( $attribute ); // WPCS: input var ok, CSRF ok, sanitization ok.
                

		if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
			$attributes = $product->get_variation_attributes();
			$options    = $attributes[ $attribute ];
		}

		$html  = '<select id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '" name="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( sanitize_title( $attribute ) ) . '" data-show_option_none="' . ( $show_option_none ? 'yes' : 'no' ) . '">';
                                
                if ( ! empty( $options ) ) {
			if ( $product && taxonomy_exists( $attribute ) ) {
				// Get terms if this is a taxonomy - ordered. We need the names too.
				$terms = wc_get_product_terms( $product->get_id(), $attribute, array(
					'fields' => 'all',
				) );
                                $variations = $product->get_available_variations( );
                                
				foreach ( $terms as $term ) {
					if ( in_array( $term->slug, $options, true ) ) {
                                                $value = $term->name;
                                                $variation = get_variation_from_term_slug($variations, $attribute, $term->slug);
                                                //print_r($variation);
                                                
                                                if($variation['is_in_stock'] == 1) {
                                                    $html .= '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected ), $term->slug, false ) . ' class="">' . $value . '</option>';
                                                }else {
                                                    $html .= '<option value="' . esc_attr( $term->slug ) . '" ' . selected( sanitize_title( $selected ), $term->slug, false ) . ' class="not-in-stock">' . $value . '</option>';
                                                }
					}
				}
                                //throw new Exception('Hello');
			} /*else {
				foreach ( $options as $option ) {
					// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
					$selected = sanitize_title( $args['selected'] ) === $args['selected'] ? selected( $args['selected'], sanitize_title( $option ), false ) : selected( $args['selected'], $option, false );
					$html    .= '<option value="' . esc_attr( $option ) . '" ' . $selected . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
				}
			}*/
		}

		$html .= '</select>';
								echo $html;//end( $attribute_keys ) === $attribute_name ? '' : '';
							?>
					</div>
				<?php endforeach; ?>
			                <?php
    global $post;
    $production_id = wc_get_not_stated_production_item($post->ID);
    if($production_id !== '') {        
        $production = wc_get_prod($production_id);
        $start = $production->get_estimated_shipping_start();
        $start = strtotime($start); 
        $start = date("y/m/d",$start);
        $end = $production->get_estimated_shipping_end();
        $end = strtotime($end);
        $end = date("m/d",$end);
        echo '<div class="estimated-ship-date" style="margin-top: 1em; padding: 1em 1.41575em; text-align: center;">
            【お届け予定: ' . $start  . '〜' . $end . '】</div>';
    }

                
		
		woocommerce_quantity_input( array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
		) );
?>
	<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
                


                
	<?php endif; ?>

</form>
<script>
    (function($) {
        $('.variations_form.row select').customSelect();
    }(jQuery));
    </script>

