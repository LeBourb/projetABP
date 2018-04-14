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
class WC_Meta_Box_Product_Size_Details {

	/**
	 * Output the metabox.
	 *
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
            
            $size_details = get_post_meta(  $post->ID, 'wc_size_details', true);  
            echo '<div id="wc_size_details_container">';

                include 'view/html-product-size-details.php';
                echo '</div>';
		
	}
        
        /**
        * Save attributes via ajax.
        */
        public static function save() {
           //check_ajax_referer( 'save-advanced-attributes', 'security' );
            
           if ( ! current_user_can( 'edit_products' ) ) {
            wp_die( -1 );
           }        
            $post_id = $_POST['post_ID'];            
            update_post_meta(  $post_id, 'wc_size_details' ,  $_POST['wc_size_details'] );  
            
            //self::output( get_post($post_id) ); 
            //wp_die();  
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
