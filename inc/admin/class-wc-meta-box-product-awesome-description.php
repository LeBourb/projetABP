<?php
/**
 * Product Awesome Description
 *
 * Replaces the standard excerpt box.
 *
 * @author      WooThemes
 * @category    Admin
 * @package     WooCommerce/Admin/Meta Boxes
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * WC_Meta_Box_Product_Awesome_Description Class.
 */
class WC_Meta_Box_Product_Awesome_Description {

	/**
	 * Output the metabox.
	 *
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
            ?><div id="wc_awesome_meta">
<script>
    jQuery( function( $ ) {
        // Add rows.
	$( 'button.add_awesome_description' ).on( 'click', function() {
		var size         = $( '.product_awesome_descriptions .woocommerce_awesome_description' ).length;
		var attribute    = $( 'select.awesome_template_type' ).val();
		var $wrapper     = $( this ).closest( '#wc_awesome_tab' );
		var $attributes  = $wrapper.find( '.product_awesome_descriptions' );
		var product_type = $( 'select#product-type' ).val();
		var data         = {
			action:   'woocommerce_add_awesome_description',
			taxonomy: attribute,
			i:        size,
                        template_type: $('[name="awesome_template_type"]').val(),
                        post_id     : woocommerce_admin_meta_boxes.post_id,
			security: woocommerce_admin_meta_boxes.add_attribute_nonce
		};

		$wrapper.block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});

		$.post( woocommerce_admin_meta_boxes.ajax_url, data, function( response ) {
			$wrapper.replaceWith( response );			
			$wrapper.unblock();
		});

		if ( attribute ) {
			$( 'select.awesome_template_type' ).find( 'option[value="' + attribute + '"]' ).attr( 'disabled','disabled' );
			$( 'select.awesome_template_type' ).val( '' );
		}

		return false;
	});
        
        // Save attributes and update variations.
	$( '.save_awesome_descriptions' ).on( 'click', function() {

		$( '#woocommerce-product-data' ).block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});

		var data = {
			post_id     : woocommerce_admin_meta_boxes.post_id,
			product_type: $( '#product-type' ).val(),
			data        : $( '.product_awesome_descriptions' ).find( 'input, select, textarea' ).serialize(),
			action      : 'woocommerce_save_awesome_descriptions',
			security    : woocommerce_admin_meta_boxes.save_attributes_nonce
		};

		$.post( woocommerce_admin_meta_boxes.ajax_url, data, function(response) {                        
                        $( "#wc_awesome_tab" ).replaceWith( response );
                        $( '#woocommerce-product-data' ).unblock();
                        $('.wc-enhanced-select').select2()
			// Reload variations panel.
			//var this_page = window.location.toString();
			//this_page = this_page.replace( 'post-new.php?', 'post.php?post=' + woocommerce_admin_meta_boxes.post_id + '&action=edit&' );
                        
		});
	});
        /*
        $( 'button.remove_awesome_description').on('click',function(){
            var $wrapper     = $( this ).closest( '#wc_awesome_tab' );
            var data         = {
                    action:   'woocommerce_remove_awesome_description',                    
                    id:        $( this ).attr('id'),
                    post_id     : woocommerce_admin_meta_boxes.post_id,
                    security: woocommerce_admin_meta_boxes.add_attribute_nonce
            };
            $.post( woocommerce_admin_meta_boxes.ajax_url, data, function( response ) {
                    $wrapper.replaceWith( response );			
                    $wrapper.unblock();
            });
            return false;
        });
        */
    }(jQuery));
</script><?php
                include 'view/html-product-awesome-description.php';
                echo '</div>';
		/*$settings = array(
			'textarea_name' => 'awesomedesc',
			'quicktags'     => array( 'buttons' => 'em,strong,link' ),
			'tinymce'       => array(
				'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
				'theme_advanced_buttons2' => '',
			),
			'editor_css'    => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
		);
                
		wp_editor( htmlspecialchars_decode( get_post_meta( $post->ID , 'awesomedesc', true )), 'awesomedesc', apply_filters( 'woocommerce_product_awesome_description_editor_settings', $settings ) );*/
                
	}
        
        /**
        * Save attributes via ajax.
        */
        public static function save() {
           //check_ajax_referer( 'save-advanced-attributes', 'security' );
            
           if ( ! current_user_can( 'edit_products' ) ) {
            wp_die( -1 );
           }        
            $post_id = $_POST['post_id'];
            $id = $_POST['id'];
            $media_id = isset($_POST['media_id']) ? $_POST['media_id'] : '';
            $media_1 = isset($_POST['media_id_1']) ? $_POST['media_id_1'] : '';
            $media_2 = isset($_POST['media_id_2']) ? $_POST['media_id_2'] : '';
            $text = isset($_POST['text']) ? $_POST['text'] : '';
            $title = isset($_POST['title']) ? $_POST['title'] : '';
            $text_left = isset($_POST['text_left']) ? $_POST['text_left'] : '';
            $text_right = isset($_POST['text_right']) ? $_POST['text_right'] : '';
            $template_type = isset($_POST['template_type']) ? $_POST['template_type'] : '';
            $text_color = isset($_POST['text_color']) ? $_POST['text_color'] : '';            
            $text_pos = isset($_POST['text_pos']) ? $_POST['text_pos'] : '';            
            $data = get_post_meta( $post_id, 'wc_awesome_descriptions' , true);       
            $data[$id] = array_merge($data[$id] , array( 'template_type' => $template_type,'text' => $text , 'media_id' => $media_id , 'media_1' => $media_1 , 'media_2' => $media_2 , 'title' => $title, 'text_left' => $text_left , 'text_right' => $text_right , 'text_color' => $text_color , 'text_pos' => $text_pos ) );
            update_post_meta(  $post_id, 'wc_awesome_descriptions' ,  $data );  
            
            self::output( get_post($post_id) ); 
            wp_die();  
        }
        
        /**
        * Save attributes via ajax.
        */
        public static function add() {
           //check_ajax_referer( 'save-advanced-attributes', 'security' );
           ob_start();
           //check_ajax_referer( 'add-advanced-attribute', 'security' );
           if ( ! current_user_can( 'edit_products' ) ) {
                   wp_die( -1 );
           }
            $post_id = $_POST['post_id'];
            $template_type = $_POST['template_type'];
            $data = get_post_meta( $post_id, 'wc_awesome_descriptions' , true);            
            $data[uniqid()] = array( 'template_type' => $template_type);
            
           update_post_meta( $post_id, 'wc_awesome_descriptions', $data );
           self::output( get_post($post_id) ); 
           wp_die();    
        }
        
        public static function remove() {
            $post_id = $_POST['post_id'];
            $id = $_POST['id'];
            $data = get_post_meta( $post_id, 'wc_awesome_descriptions' , true);            
            
            unset($data[$id]);
            update_post_meta( $post_id, 'wc_awesome_descriptions', $data );
           self::output( get_post($post_id) ); 
           wp_die();    
        }
}
