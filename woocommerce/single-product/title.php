<?php
/**
 * Single Product title
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/title.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author     WooThemes
 * @package    WooCommerce/Templates
 * @version    1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<h3 class="product_title" style="line-height:unset;">
<?php    
    echo str_replace("|","<br>",get_the_title());
?>
</h3>
<?php
if ( method_exists('TInvWL_Public_AddToWishlist', 'instance' ) ) {
        echo TInvWL_Public_AddToWishlist::instance()->shortcode();
    }
