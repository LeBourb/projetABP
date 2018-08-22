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
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post,$product,$production;

$production_id = $post->ID;
$production = wc_get_prod($production_id);
$product_id = get_post_meta($production_id, '_product_id', true);
$product = wc_get_product($product_id);

// Ensure visibility
?>
<li <?php post_class(); ?>>
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
		
		$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink($product->get_id()), $product );

		echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';

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
                        //<div  style="width:100%;height:100%;background: url(' . $image_attachment[0] . ') no-repeat center bottom / cover;" src="' . $image_attachment[0] . '" />
        
                        
    
                        
                        
                        echo '<div class="item" style="width:100%;height:100%;">
                                <span class="woocommerce-loop-product__title">' . get_the_title() . '</span>
                                <div class="img-lazy-load thumb-img-back" data-full-src="'. $image_full_attachment[0] . '"  style="width:100%;height:100%;background: url(' . $image_attachment[0] . ') no-repeat center bottom / cover;"></div>
                            </div></a>';


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
        <div class="prod-item-footer">               
            <div class="funding-countdown">
                <span class="hear-ye">予約受付終了まであと:</span>
                <time class="tricky-countdown" data-funding-end="<?php echo $production->get_funding_end(); ?>"></time>
            </div>
            <?php echo $product->get_price_html(); ?>
            <a href="<?php echo esc_url( $link ); ?>" class="button">FUND NOW</a>
         </div>
<?php


	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	//do_action( 'woocommerce_after_shop_loop_item' );
	?>
</li>
