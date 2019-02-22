<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

include 'atelier-product-tile.php';
return;


// Ensure visibility.
$new_production_id = wc_get_not_stated_production_item($post->ID);                     
if ( !$product || empty( $product ) || ! $product->is_visible() || $new_production_id ) {
	return;
}
?>

<li <?php wc_product_class('col-lg-3 col-md-4 col-sm-6 col-xs-6'); ?>>
    <?php
	$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink($product->get_id()), $product );
		?>
                <a href="<?php echo esc_url( $link ); ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                    
                    <?php

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
			
                        //	$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

                        
                        $attachment_id = $product->get_image_id();
                        $image_attachment = wp_get_attachment_image_src( $attachment_id , 'medium');  
                        $image_full_attachment = wp_get_attachment_image_src( $attachment_id , 'large');  
                        //
                        
        
                        
    
                        ?>
                        <div class="item" style="width:100%;height:100%;">
                                <div class="product-over-details" data-id="1">
                                    <h3 class="title"><?php echo get_the_title(); ?></h3>
                                    <p class="price"><?php echo $product->get_price_html();?></p>                                    
                                    <?php
                                        if( $product->is_type( 'variable' )  && !empty($product->get_available_variations( ))) {
                                            $variations = $product->get_available_variations( );
                                            echo '<ul class="product-variation">';
                                            foreach($variations as $variation) {
                                                if ($variation['variation_is_active'] && $variation['variation_is_visible']) {
                                                    //$variation->is_in_stock
                                                    if(sizeof($variation['attributes']) == 1) {
                                                        $attrs = $variation['attributes'];
                                                        reset($attrs);
                                                        $first_key = key($attrs);
                                                        if(!$variation['is_in_stock']) {
                                                            echo '<li class="item"><del>' . $attrs[$first_key] . '</del></li>';                                                            
                                                        }else {
                                                            echo '<li class="item">' . $attrs[$first_key] . '</li>';
                                                        }
                                                        
                                                    }
                                                }
                                            } 
                                            echo '</ul>';
                                        }
                                    ?>
                                                                  
                                </div>
                                <div class="img-lazy-load thumb-img-back" data-full-src="<?php echo $image_full_attachment[0]; ?>"  style="width:100%;height:100%;background:url('<?php echo $image_attachment[0];?>') no-repeat center bottom / cover;"></div>
                                </div>
                            </a>

<?php
	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
                        
        ?>
        <div class="product-tile-footer">               
            <div class="title">
                <?php echo get_the_title(); ?> -
            </div>
            
            <div class="price">
                <?php echo $product->get_price_html(); ?>        
            </div>   

         </div>
</li>
