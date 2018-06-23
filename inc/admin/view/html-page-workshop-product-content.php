<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $image_attachment_id = null;
    $image_url = null;
    $price = null;
    $supplier = null;
    if($product->get_id()) {
        $image_attachment_id = get_post_thumbnail_id( $product->get_id());
        $image_url = wp_get_attachment_image_src( $image_attachment_id );
        $price = get_term_meta( $product->get_id(), 'price_term', true);
        $supplier = get_term_meta( $product->get_id(), 'supplier_id', true);
        $supplier =get_the_title( $supplier );
    }
    //

    ?>

    <div data-taxonomy="<?php echo esc_attr( $product->get_id() ); ?>" class="woocommerce_product_supply wc-metabox closed">

	<h3>
            <a href="#" class="remove_workshop_product delete" data-product-id="<?php echo $product->get_id();?>"><?php _e( 'Remove', 'woocommerce' ); ?></a>
		<div class="handlediv" title="<?php esc_attr_e( 'Click to toggle', 'woocommerce' ); ?>"></div>                
	</h3>
        <input type="hidden" class="product_supply_id" name="product_supply_id[<?php echo $index;?>]" value="<?php echo $product->get_id();?>"/>
        <div class='image-preview-wrapper'>
    <?php 
    
    if($image_url) {
        echo '<img id="image-preview" src="' . $image_url[0] . '" width="' . $image_url[1] . '" height="' . $image_url[2] . '">';
    }else {
        echo '<img id="image-preview" src="" width="100" height="100" style="max-height: 100px; width: 100px;">';
    }
    echo '</div>';
    echo '<p><strong><label for="name">Name: </label></strong>' . $product->get_title() . '</p>';                
    
?>
</div>

