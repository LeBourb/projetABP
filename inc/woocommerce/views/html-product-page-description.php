<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


 
?>

<div id="page_description_tab" class="panel wc-metaboxes-wrapper <?php $is_tabvisible ? '' : 'hidden' ?>">
<script>
    jQuery( function( $ ) {
        // Add rows.
	$( '#users #select-manuf' ).on( 'click', function() {
                var page_description_id = jQuery( "#users option:selected" )['0'].value;
                
		var data         = {
			action:   'woocommerce_select_page_description',
			page_description_id: page_description_id,		
			security: woocommerce_admin_meta_boxes.add_attribute_nonce
		};
                
                var $wrapper     = $( this ).closest( '#page_description_tab' );

		$wrapper.block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});

		$.post( woocommerce_admin_meta_boxes.ajax_url, data, function( response ) {
			$('#product_page_description_field address').replaceWith( response );			
			$wrapper.unblock();
		});

		return false;
	});
        
        // Save attributes and update variations.
	$( '.save_product_page_description' ).on( 'click', function() {

		$( '#woocommerce-product-data' ).block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});

		var data = {
			post_id     : woocommerce_admin_meta_boxes.post_id,
			page_description_id        : jQuery( "#page_description_id" ).val(),
			action      : 'woocommerce_save_selected_page_description',
			security    : woocommerce_admin_meta_boxes.save_attributes_nonce
		};

		$.post( woocommerce_admin_meta_boxes.ajax_url, data, function(response) {                        
                        $( "#page_description_tab" ).replaceWith( response );
                        $( '#woocommerce-product-data' ).unblock();
			// Reload variations panel.
			//var this_page = window.location.toString();
			//this_page = this_page.replace( 'post-new.php?', 'post.php?post=' + woocommerce_admin_meta_boxes.post_id + '&action=edit&' );
                        
		});
	});
        
        function attribute_row_indexes() {
		$( '.product_attributes .woocommerce_attribute' ).each( function( index, el ) {
			$( '.attribute_position', el ).val( parseInt( $( el ).index( '.product_attributes .woocommerce_attribute' ), 10 ) );
		});
	}
    });
</script>
	<div class="toolbar toolbar-top">
		
                <div id="users">
                   <p><?php _e( 'Page:' ); ?></p>                   
                   <?php wp_dropdown_pages( array( 'post_type' =>'page' , 'name' => 'page_description_id' )); ?>                   
                   <input id="select-manuf" type="submit" name="submit" value="select" />
                   </form>
                </div>
			
 
		
		
	</div>
	<div id="product_page_description_field" class="wc-metaboxes">
		<?php
                global $post;
                $page_description_id = get_post_meta( $post->ID, 'product_page_description_id', true );
		include 'html-product-page-description-admin-link.php'; 
		?>
	</div>
	<div class="toolbar">
		<span class="expand-close">
			<a href="#" class="expand_all"><?php _e( 'Expand', 'woocommerce' ); ?></a> / <a href="#" class="close_all"><?php _e( 'Close', 'woocommerce' ); ?></a>
		</span>
		<button type="button" class="button save_product_page_description button-primary"><?php _e( 'Save Page', 'woocommerce' ); ?></button>
	</div>
	
</div>
