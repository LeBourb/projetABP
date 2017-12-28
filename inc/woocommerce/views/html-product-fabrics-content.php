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
    
    if($fabric_id) {
        $image_attachment_id = get_post_meta( $fabric_id, 'image_attachment_id', true);
        $image_url = wp_get_attachment_image_src( $image_attachment_id );
        $price = get_post_meta( $fabric_id, 'price_term', true);
        $supplier = get_post_meta( $fabric_id, 'supplier_id', true);
        $supplier =get_the_title( $supplier );
    }
    //

    ?>

    <div data-taxonomy="<?php echo esc_attr( $fabric_id ); ?>" class="woocommerce_product_fabric wc-metabox closed">

	<h3>
		<a href="#" class="remove_product_fabric delete"><?php _e( 'Remove', 'woocommerce' ); ?></a>
		<div class="handlediv" title="<?php esc_attr_e( 'Click to toggle', 'woocommerce' ); ?>"></div>
		<strong class="attribute_name"><?php echo esc_html( get_term_by( 'id', $fabric_id, 'pa_fabric' )->name);  ?></strong>
                
	</h3>
        <input type="hidden" class="product_fabric_id" name="product_fabric_id[<?php echo $index;?>]" value="<?php echo $fabric_id;?>"/>
        <div class='image-preview-wrapper'>
    <?php 
    
    if($image_url) {
        echo '<img id="image-preview" src="' . $image_url[0] . '" width="' . $image_url[1] . '" height="' . $image_url[2] . '">';
    }else {
        echo '<img id="image-preview" src="" width="100" height="100" style="max-height: 100px; width: 100px;">';
    }
    echo '</div>';
    echo '<p><strong><label for="name">Price: </label></strong>' . $price . '</p>';            
    echo '<p><strong><label for="name">Supplier: </label></strong>' . $supplier . '</p>';            
    
?>
    <tr class="form-field form-required term-name-wrap">
    <th scope="row"><label for="name">Quantity</label></th>
    <td>
      <input type="text" class="product_price_settings_callback" name="product_fabric_quantity[<?php echo $index;?>]" value="<?php if($quantity)echo $quantity; ?>" />
    </td>
     </tr>
</div>

