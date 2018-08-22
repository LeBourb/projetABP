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


function get_variation_from_term_slug($variations, $attribute , $slug_id) {    
    foreach($variations as $variation ) {
        $var_attr = $variation['attributes'];
        if( array_key_exists ('attribute_' . $attribute, $var_attr) && $var_attr['attribute_' . $attribute] == $slug_id ) {
            return $variation;
        }
    }
    return null;
}



?>
<style>
    
    table.variations input {
        display: none;
    }
    
    table.variations label {
        width:100%;
        overflow: hidden;
        border-color: #adabac;
        border-radius: 0;
        line-height: 27px;        
        padding-left: 20px;
        margin: 0;
    }
    
    table.variations li > input:checked + label {
        background: #999;
        color: #fff;
    }
    
    table.variations li {
        padding: 0;
    }
    
    table.variations li > label {
        margin: 0;
    }
    
    table.variations .ui-customSelect-arrow.ui-customSelect-downArrow,
    table.variations .ui-customSelect-arrow.ui-customSelect-upArrow {         
        background: url(<?php echo get_site_url() . '/wp-content/themes/atelierbourgeonspro/assets/images/drop-arrow.svg'; ?>) no-repeat;
        background-size: 100%;
        border: 0 none;
        display: block;
        height: 8px;
        right: 23px;
        top: 16px;
        width: 14px;
        margin:-right 0.5em;
    }
    
    table.variations .ui-customSelect-window {
        display: flex;
        align-items: center;
        padding: 5px 10px 5px 0px;
    }
    
    table.variations .ui-customSelect-window {
        height: auto;
        cursor: pointer;
        line-height: 27px;
    }
    
    table.variations .ui-customSelect-window span {
        flex-grow: 1;
        display: flex;
        margin: 0;
    }    
    
    
    .single_add_to_cart_button.button {
        width: 100%;
    }
    
    .woocommerce-variation-add-to-cart {
            padding: 1em 1.41575em;
    }
    
    .product-title-price {
        display: flex;
        flex-wrap: wrap;
    }
    
    .product-title-price > div {
        flex-grow: 1;
    }
    
    .single_variation_wrap .quantity {
        text-align: center;
        margin-bottom: 2em;
    }
    
    .single_variation_wrap .quantity input {
        width: 23%;
    }
    
    .ui-customSelect label.not-in-stock {
        text-decoration: line-through;
        color: red;
    }
    
</style>
<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ); // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>					<tr>
						
						<td class="value">
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
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

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
?>
                
		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );
				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );
				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
                


                
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>
<script>
    (function($) {
        $('table.variations select').customSelect();
    }(jQuery));
    </script>
<?php
do_action( 'woocommerce_after_add_to_cart_form' );