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
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * WC_Meta_Box_Page_Workshop_Metadata Class.
 */
class WC_Meta_Box_Page_Workshop_Metadata {

    /**
     * Output the metabox.
     *
     * @param WP_Post $post
     */
    public static function output($post) {
        $data = get_post_meta($post->ID, 'page_workshop_metadata', true);
        $text = isset($data['text']) ? $data['text'] : '';
        $media_key = isset($data['media_id']) ? $data['media_id'] : '';
        ?><div id="wc_awesome_meta">
            <?php
            include 'view/html-page-workshop-metadata.php';
            echo '</div>';

            
        }

        /**
         * Save attributes via ajax.
         */
        public static function save() {
            //check_ajax_referer( 'save-advanced-attributes', 'security' );

            if (!current_user_can('edit_products')) {
                wp_die(-1);
            }
            $post_id = $_POST['post_id'];
            $media_id = isset($_POST['media_id']) ? $_POST['media_id'] : '';
            $text = isset($_POST['text']) ? $_POST['text'] : '';
            $data = get_post_meta($post_id, 'page_workshop_metadata', true);
            if(!is_array($data))
                $data = array();
            $data = array_merge($data, array('text' => $text, 'media_id' => $media_id ));
            update_post_meta($post_id, 'page_workshop_metadata', $data);
            self::output(get_post($post_id));
            wp_die();
        }


    }
    