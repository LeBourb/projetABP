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
 * WC_Meta_Box_Page_Workshop_Product_Partnership Class.
 */
class WC_Meta_Box_Page_Workshop_Product_Partnership {

    /**
     * Output the metabox.
     *
     * @param WP_Post $post
     */
    public static function output($post) {
        ?><div id="wc_awesome_meta">
            <?php
            include 'view/html-workshop-product-partnership.php';
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
            $data = get_post_meta($post_id, 'page_awesome_paragraphs', true);
            $data[$id] = array_merge($data[$id], array('template_type' => $template_type, 'text' => $text, 'media_id' => $media_id, 'media_1' => $media_1, 'media_2' => $media_2, 'title' => $title, 'text_left' => $text_left, 'text_right' => $text_right, 'text_color' => $text_color, 'text_pos' => $text_pos));
            update_post_meta($post_id, 'page_awesome_paragraphs', $data);
            self::output(get_post($post_id));
            wp_die();
        }

        /**
         * Save attributes via ajax.
         */
        public static function add_product() {
            //check_ajax_referer( 'save-advanced-attributes', 'security' );
            ob_start();
            //check_ajax_referer( 'add-advanced-attribute', 'security' );
            if (!current_user_can('edit_products')) {
                wp_die(-1);
            }
            $post_id = $_POST['post_id'];
            $product_id = $_POST['product_id'];
            $data = get_post_meta($post_id, 'product_ids', true);
            if(!is_array($data))
                $data = array();
            $data[] = $product_id;
            $data = array_unique ( $data );
            update_post_meta($post_id, 'product_ids', $data);                            
            self::output(get_post($post_id));            
            wp_die();
        }

        public static function remove_product() {
            ob_start();
            //check_ajax_referer( 'add-advanced-attribute', 'security' );
            if (!current_user_can('edit_products')) {
                wp_die(-1);
            }
            $post_id = $_POST['post_id'];
            $product_id = $_POST['product_id'];
            $data = get_post_meta($post_id, 'product_ids', true);
            $data = array_diff($data, array($product_id));
            update_post_meta($post_id, 'product_ids', $data);
            self::output(get_post($post_id));
            wp_die();
        }

    }
    