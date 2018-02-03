<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $image_attachment_id = null;
    $image_url = null;
    
    
    if($stamp_id) {
        $image_attachment_id = get_term_meta( $stamp_id, 'image_attachment_id', true);
        $image_url = wp_get_attachment_image_src( $image_attachment_id );        
    }
    //

    ?>

    <div data-taxonomy="<?php echo esc_attr( $stamp_id ); ?>" class="woocommerce_product_stamp wc-metabox closed">

	<h3>
		<a href="#" class="remove_product_stamp delete"><?php _e( 'Remove', 'woocommerce' ); ?></a>
		<div class="handlediv" title="<?php esc_attr_e( 'Click to toggle', 'woocommerce' ); ?>"></div>
		<strong class="attribute_name"><?php echo esc_html( get_term_by( 'id', $stamp_id, 'pa_stamp' )->name);  ?></strong>
                
	</h3>
        <input type="hidden" class="product_stamp_id" name="product_stamp_id[<?php echo $index;?>]" value="<?php echo $stamp_id;?>"/>
        <div class='image-preview-wrapper'>
    <?php 
    
    if($image_url) {
        echo '<img id="image-preview" src="' . $image_url[0] . '" width="' . $image_url[1] . '" height="' . $image_url[2] . '">';
    }else {
        echo '<img id="image-preview" src="" width="100" height="100" style="max-height: 100px; width: 100px;">';
    }
    echo '</div>';
    
?>    
</div>

