<?php
/*
  Plugin Name: Woocommerce Attribute Advanced Form - Reshaping product attributes
  Plugin URI: http://wp-analytify.com/
  Description: Attributes must be better !
  Version: 1.0
  Author: Romain Fanchini
  Author URI: http://twitter.com/hiddenpearls
  License: GPLv2+
  Text Domain: woocommerce-attribute-advanced-form
*/
return;

class Product_Attribute_Productions_Form {

  // Constructor
    function __construct() {
        return;
        add_action( 'admin_menu', array( $this, 'woo_advform_add_menu' ));
        register_activation_hook( __FILE__, array( $this, 'woo_advform_install' ) );
        register_deactivation_hook( __FILE__, array( $this, 'woo_advform_uninstall' ) );
        
        add_filter("product_attributes_type_selector" , function( $array ){
            $array["advanced_attribute"] = __( 'Advanced Attribute', 'woocommerce' );
            return $array ;
        });
        
        //add_action( 'woocommerce_product_option_terms', array( $this, 'woo_advform_option_terms' ) );
        
        add_action('init', array($this, 'init'));
    }
    
    /**
     * Initialization hook that registers actions for all available product attribute taxonomies.
     */
    public function init() {
        return;
        if (function_exists('wc_get_attribute_taxonomies')) {
            foreach (wc_get_attribute_taxonomies() as $pa) {
                
                if(!strcmp($pa->attribute_type,'advanced_attribute')) {  
                    register_taxonomy("pa_{$pa->attribute_name}", $pa , array('hierarchical' => true));                    
                    add_action("pa_{$pa->attribute_name}_add_form_fields", array($this, 'attribute_add_field'), 10);
                    add_action("pa_{$pa->attribute_name}_edit_form_fields", array($this, 'attribute_edit_field'), 10);
                    add_action("created_pa_{$pa->attribute_name}", array($this, 'save_field'), 10, 1);
                    add_action("edited_pa_{$pa->attribute_name}", array($this, 'save_field'), 10, 1);
                }
            }
        }
        //add_action('woocommerce_after_add_attribute_fields', array($this, 'display_taxonomy_fields'), 10);
        //add_action('woocommerce_after_edit_attribute_fields', array($this, 'display_taxonomy_fields'), 10);
        add_action('woocommerce_attribute_added', array($this, 'taxonomy_save_field'), 10, 2);
        add_action('woocommerce_attribute_updated', array($this, 'taxonomy_save_field'), 10, 2);
        // Save meta.
        //add_action( 'woocommerce_process_product_meta', array( &$this, 'save_tab_advanced_attributes' ) );
        
        
        
        $ajax_events = array(
            'add_product_productions'                                    => false,
            'add_new_product_productions'                                => false,
            'save_product_productions'                                  => false
        );
        // rely on woocommerce attribute
        foreach ( $ajax_events as $ajax_event => $nopriv ) {
            add_action( 'wp_ajax_woocommerce_' . $ajax_event, array( $this, $ajax_event ) );
        }
        
        // Add write panel tab.
        add_action( 'woocommerce_product_write_panel_tabs', array( $this, 'add_tab' ) );
        // Create write panel.
        add_action( 'woocommerce_product_data_panels', array( $this, 'tab_view' ) );
        // Save meta.
        //add_action( 'woocommerce_process_product_meta', array( &$this, 'save_tab_options' ) );
        
        //require_once('views/waaf-display-advanced-attributes.php');
        
    }
    
    
    /**
     * Prints a text-area field with label for defining a product tab description of a new product attribute.
     * 
     * @param string $taxonomy The current product attribute taxonomy.
     */
    public function attribute_edit_field($term, $taxonomy = null){
      
        $this->media_selector_settings_page_callback();
        $this->price_settings_page_callback();
        $this->supplier_settings_page_callbak();
    }
    
    
    // define the wp_ajax_woocommerce_<ajax_event> callback 
    function action_wp_ajax_woocommerce_ajax_event( $array ) { 
        // make action magic happen here... 
    }
    
    
    function media_selector_settings_page_callback() {

            wp_enqueue_media();

            ?><div class='image-preview-wrapper'>
                    <img id='image-preview' src='' width='100' height='100' style='max-height: 100px; width: 100px;'>
            </div>
            <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
            <input type='hidden' name='image_attachment_id' id='image_attachment_id' value=''>               
                
                <?php
    }
    
    function price_settings_page_callback() {
            ?>
            <input type="text" class="product_price_settings_callback" name="price_settings_page_callback" value="" />
            <?php
    }
    
    function supplier_settings_page_callback() {
            ?>
            <input type="text" class="product_price_settings_callback" name="price_settings_page_callback" value="" />
            <?php
    }
    
    
    
        /**
     * Prints a text-area field with label for defining a product tab description of a new product attribute.
     * 
     * @param string $taxonomy The current product attribute taxonomy.
     */
    function attribute_add_field($taxonomy = null) {        
        ?>
	<?php 
        $this->media_selector_settings_page_callback();//if ( is_taxonomy_hierarchical($taxonomy) ) : 
        $this->price_settings_page_callback();
        $this->supplier_settings_page_callback();
        ?>
	               
	<?php //endif; // is_taxonomy_hierarchical() ?>
        <?php                
    }

    /*
      * Actions perform at loading of admin menu
      */
    function woo_advform_add_menu() {
        //add_action( 'admin_notices', array( $this, 'woocommerce_notinstalled_notice__error') );
        /*add_menu_page( 'Analytify simple', 'Analytify', 'manage_options', 'analytify-dashboard', array(
                          __CLASS__,
                         'wpa_page_file_path'
                        ), plugins_url('images/wp-analytics-logo.png', __FILE__),'2.2.9');

        add_submenu_page( 'analytify-dashboard', 'Analytify simple' . ' Dashboard', ' Dashboard', 'manage_options', 'analytify-dashboard', array(
                              __CLASS__,
                             'wpa_page_file_path'
                            ));

        add_submenu_page( 'analytify-dashboard', 'Analytify simple' . ' Settings', '<b style="color:#f9845b">Settings</b>', 'manage_options', 'analytify-settings', array(
                              __CLASS__,
                             'wpa_page_file_path'
                            ));
         *
         */
    }

    /*
     * Actions perform on loading of menu pages
     */
    function woo_advform_page_file_path() {



    }
    
    function save_field () {
        
    }
    
    function woo_advform_option_terms ($attribute_taxonomy) {
        if($attribute_taxonomy->attribute_type == 'advanced_attribute' ) {
                $this->woo_advform_admin_product_attribute($attribute_taxonomy);
                return;
                              ?>
                <select multiple="multiple" data-placeholder="<?php esc_attr_e( 'Select terms', 'woocommerce' ); ?>" class="multiselect attribute_values wc-enhanced-select" name="attribute_values[<?php echo $i; ?>][]">
                <?php
                $args = array(
                        'orderby'    => 'name',
                        'hide_empty' => 0,
                        'parent' => 0,
                );
                $taxonomy = 'pa_' . $attribute_taxonomy->attribute_name;
                //
                $all_terms = get_terms( $taxonomy, apply_filters( 'woocommerce_product_attribute_terms', $args ) );
                
                if ( $all_terms ) {
                    foreach ( $all_terms as $term ) {
                        $options = array();
                        $term_children = get_term_children( $term->term_id , $term->taxonomy );
                        print_r($term_children);
                        if(is_array($term_children) && sizeof($term_children) > 0) {
                            echo '<optgroup label="Swedish Cars">';                            
                            foreach ( $term_children as $child_term_id ) {
                                $child_term = get_term_by( 'id', $child_term_id, $taxonomy );
                                echo '<option value="' . esc_attr( $child_term->term_id ) . '" ' . selected( in_array( $child_term->term_id, $options ), true, false ) . '>' . esc_attr( apply_filters( 'woocommerce_product_attribute_term_name', $child_term->name, $child_term ) ) . '</option>';
                            }
                            echo '</optgroup>';
                        }else {
                            echo '<option value="' . esc_attr( $term->term_id ) . '" ' . selected( in_array( $term->term_id, $options ), true, false ) . '>' . esc_attr( apply_filters( 'woocommerce_product_attribute_term_name', $term->name, $term ) ) . '</option>';
                        }
                    }
                }
                ?>
                </select>
                <button class="button plus select_all_attributes"><?php _e( 'Select all', 'woocommerce' ); ?></button>
                <button class="button minus select_no_attributes"><?php _e( 'Select none', 'woocommerce' ); ?></button>
                <button class="button fr plus add_new_attribute"><?php _e( 'Add new', 'woocommerce' ); ?></button>
                <?php
        } 
        
    }
    
    function woocommerce_notinstalled_notice__error() {
        $class = 'notice notice-error';
        $message = __( 'Woocommerce Attribute Advanced Form needs Woocommerce to be activated.', 'woo-advform-text-domain' );

        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
    }

    /*
     * Actions perform on activation of plugin
     */
    function woo_advform_install() {
            
        /**
        * Check if WooCommerce is active
        **/
        if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            // Put your plugin code here
            global  $wpdb;
            $wpdb->query( "ALTER TABLE {$wpdb->term_relationships} ADD quantity varchar(10) NULL;" );
            
        }else {            
            add_action( 'admin_notices', array( $this, 'woocommerce_notinstalled_notice__error') );
        }

    }

    /*
     * Actions perform on de-activation of plugin
     */
    function woo_advform_uninstall() {
        
    }
    
    function woo_advform_admin_product_attribute($attribute_taxonomy) {
        ?>
        <div id="custom_tab_data" class="panel woocommerce_attributes_panel wc-metaboxes-wrapper">								
            <div id="custom_tab_data_attributes" class="wc-metaboxes">
            <?php
                $loop = 0;
                // Text attributes should list terms pipe separated
                /*$terms = $attribute->get_terms();
                foreach ( $terms as $term ) {
                        require( 'custom_attributes_html.php' );
                        //print_r( $option );
                        $loop++;
                }*/
            ?>
            </div>
            <div class="toolbar">
                <button type="button" class="button add_new_custom_option button-primary"><?php _e( 'New Custom Option', 'custom-attributes' ); ?></button>
            </div>
            <script type="text/javascript">
                jQuery(function(){
                    jQuery('#custom_tab_data').on( 'click', '.add_new_custom_option', function() {
                        //alert();
                        var loop = jQuery('#custom_tab_data_attributes .woocommerce_product_option').size();

                        var html = '<?php
                            ob_start();
                            $option['name'] = '';
                            $option['required'] = '';
                            $option['type'] = 'custom';
                            $option['attributes'] = array();
                            $loop = "{loop}";
                            require( 'custom_attributes_html.php' );
                            $html = ob_get_clean();
                            echo str_replace( array( "\n", "\r" ), '', str_replace( "'", '"', $html ) );
                        ?>';
                        html = html.replace( /{loop}/g, loop );
                        jQuery('#custom_tab_data_attributes').append( html );
                        jQuery('.clear_class'+loop).val( '' );  
                    });
                    jQuery('#custom_tab_data').on( 'click', '.remove_option', function() {
                        var conf = confirm('<?php _e('Are you sure you want remove this option?', 'custom-attributes'); ?>');
                        if (conf) {
                            var option = jQuery(this).closest('.woocommerce_product_option');
                            //alert( option );
                            jQuery(option).find('input').val('');
                            jQuery(option).hide();
                        }
                        return false;
                    });
                    jQuery('#custom_tab_data_attributes').sortable({
                        items:'.woocommerce_product_option',
                        cursor:'move',
                        axis:'y',
                        handle:'h3',
                        scrollSensitivity:50,
                        helper:function(e,ui){
                            return ui;
                        },
                        start:function(event,ui){
                            ui.item.css('border-style', 'dashed');
                        },
                        stop:function(event,ui){
                            ui.item.removeAttr('style');
                            attributes_row_indexes();
                        }
                    });
                    function attributes_row_indexes() {
                        jQuery('#custom_tab_data .woocommerce_product_option').each(function(index, sel) {
                                jQuery('.product_option_position', sel).val( parseInt( index ) ); 
                        });
                    };

                });
            </script>
	    <style>
                #custom_tab_data input {
                    min-width: 139px;
                }
                #custom_tab_data label {
                    margin: 0;
                }
            </style>
        </div>
<?php
    }
    
    /**
    * Add an attribute row.
    */
    function add_product_productions() {
           ob_start();

           //check_ajax_referer( 'add-advanced-attribute', 'security' );

           if ( ! current_user_can( 'edit_products' ) ) {
                   wp_die( -1 );
           }

           $i             = absint( $_POST['i'] );
           $metabox_class = array();
           $attribute     = new WC_Product_Attribute();

           $attribute->set_id( wc_attribute_taxonomy_id_by_name( sanitize_text_field( $_POST['taxonomy'] ) ) );
           $attribute->set_name( sanitize_text_field( $_POST['taxonomy'] ) );
           $attribute->set_visible( apply_filters( 'woocommerce_attribute_default_visibility', 1 ) );
           $attribute->set_variation( apply_filters( 'woocommerce_attribute_default_is_variation', 0 ) );

           if ( $attribute->is_taxonomy() ) {
                   $metabox_class[] = 'taxonomy';
                   $metabox_class[] = $attribute->get_name();
           }

           include( 'admin/views/html-product-advanced-attribute.php' );
           wp_die();
    }

    /**
    * Add a new attribute via ajax function.
    */
    function add_new_advanced_attribute() {
           check_ajax_referer( 'add-advanced-attribute', 'security' );

           if ( current_user_can( 'manage_product_terms' ) ) {
                   $taxonomy = esc_attr( $_POST['taxonomy'] );
                   $term     = wc_clean( $_POST['term'] );

                   if ( taxonomy_exists( $taxonomy ) ) {

                           $result = wp_insert_term( $term, $taxonomy );

                           if ( is_wp_error( $result ) ) {
                                   wp_send_json( array(
                                           'error' => $result->get_error_message(),
                                   ) );
                           } else {
                                   $term = get_term_by( 'id', $result['term_id'], $taxonomy );
                                   wp_send_json( array(
                                           'term_id' => $term->term_id,
                                           'name'    => $term->name,
                                           'slug'    => $term->slug,
                                   ) );
                           }
                   }
           }
           wp_die( -1 );
    }

    	/**
	 * Prepare attributes for save.
	 *
	 * @param array $data
	 *
	 * @return array
	 */
	function prepare_attributes( $data = false ) {
            $attributes = array();

            if ( ! $data ) {
                $data = $_POST;
            }

            if ( isset( $data['advanced_attribute_names'], $data['advanced_attribute_params'] , $data['advanced_attribute_values'] ) ) {
                $attribute_names         = $data['advanced_attribute_names'];                
                $attribute_names_max_key = max( array_keys( $attribute_names ) );

                for ( $i = 0; $i <= $attribute_names_max_key; $i++ ) {
                    $attribute_id               = 0;
                    $attribute_name             = wc_clean( $attribute_names[ $i ] );
                    $attribute_params           = $data['advanced_attribute_params'][$attribute_names[ $i ]];
                    $attribute_values           = $data['advanced_attribute_values'][$attribute_names[ $i ]]; 
                    $attribute_params_positions = $data['advanced_attribute_param_position'][$attribute_names[ $i ]]; 
                    $attribute_visibility       = isset( $data['advanced_attribute_visibility'] ) ? $data['advanced_attribute_visibility'] : array();
                    //$attribute_variation        = isset( $data['attribute_variation'] ) ? $data['attribute_variation'] : array();
                    $attribute_position         = $data['attribute_position'];
                    $attribute_params_max_key   = max( array_keys( $attribute_params ) );
                    if ( 'pa_' === substr( $attribute_name, 0, 3 ) ) {
                        $attribute_id = wc_attribute_taxonomy_id_by_name( $attribute_name );
                    }
                    if ( empty( $attribute_names[ $i ] )  ) {
                        continue;
                    }
                    
                    $attribute = new WC_Product_Advanced_Attribute();
                    $attribute->set_id( $attribute_id );
                    $attribute->set_name( $attribute_name );                        
                    $attribute->set_position( $attribute_position[ $i ] );
                    $attribute->set_visible( isset( $attribute_visibility[ $i ] ) );
                    $attribute->set_attributes( isset( $attribute_attributes[ $i ] ) );
                    for ( $j = 0; $j <= $attribute_params_max_key; $j++ ) {
                        if ( empty( $attribute_params[ $j ] )  ) {
                            continue;
                        }
                        $attribute_param_name = $attribute_params[ $j ];
                        $attribute_param_position = $attribute_params_positions[ $j ];
                        $attribute_param_value = $attribute_values[ $j ];
                        //$options = isset( $attribute_params[ $j ] ) ? $attribute_values[ $i ] : '';
                        
/*                        if ( is_array( $options ) ) {
                            // Term ids sent as array.
                            $options = wp_parse_id_list( $options );
                        } else {
                            // Terms or text sent in textarea.
                            $options = 0 < $attribute_id ? wc_sanitize_textarea( wc_sanitize_term_text_based( $options ) ) : wc_sanitize_textarea( $options );
                            $options = wc_get_text_attributes( $options );
                        }*/

                        $attribute->add_param( $attribute_param_name , $attribute_param_value, $attribute_param_position);                        
                        //$attribute->set_positions( isset( $attribute_positions[ $i ] ) );                        
                    }
                    $attributes[] = $attribute;
                }
            }
            return $attributes;
    }
        
    /**
    * Save attributes via ajax.
    */
    function save_advanced_attributes() {
           //check_ajax_referer( 'save-advanced-attributes', 'security' );

           if ( ! current_user_can( 'edit_products' ) ) {
                   wp_die( -1 );
           }

           parse_str( $_POST['data'], $data );
           global $post;
           $post = get_post( $_POST['post_id'] ); 
           /*$attributes   = $this->prepare_attributes( $data );
           $product_id   = absint( $_POST['post_id'] );
           $product_type = ! empty( $_POST['product_type'] ) ? wc_clean( $_POST['product_type'] ) : 'simple';
           $classname    = WC_Product_Factory::get_product_classname( $product_id, $product_type );
           $product      = new $classname( $product_id );
           */
           //$product->set_advanced_attributes( $attributes );
            /*$attributes = array_fill_keys( array_keys( $this->get_attributes( 'edit' ) ), null );
            foreach ( $raw_attributes as $attribute ) {
                    if ( is_a( $attribute, 'WC_Product_Attribute' ) ) {
                            $attributes[ sanitize_title( $attribute->get_name() ) ] = $attribute;
                    }
            }*/

            //uasort( $attributes, 'wc_product_attribute_uasort_comparison' );
            //$product->set_prop( 'advanced_attributes', $attributes );
           update_post_meta( $_POST['post_id'], 'waaf_attributes', $data );
           if(PLL()) {
                $post_ids = PLL()->model->post->get_translations($_POST['post_id']);
                foreach($post_ids as $post_id) {
                    update_post_meta( $post_id, 'waaf_attributes', $data );
                }
           }else {
                update_post_meta( $_POST['post_id'], 'waaf_attributes', $data );
           }
           //$product->save();
           //
           $this->tab_view();
           //echo 'toto is on the floor!';
           wp_die();
    }
    
    
    /**
    * Add new tab.
    */
    function add_tab() {
            echo '<li class="advanced_tab attribute_options waaf_tab"><a href="#waaf_tab">' . __( 'Advanced Attributes', 'wcgmcf' ) . '</a></li>';
    }
    /**
    * Tab content.
    */
    function tab_view() {
           global $post, $product;
           $product_object = $product;
           $is_tabvisible = 1;
           include('admin/views/html-product-data-advanced-attributes.php');
           ?>
                
           <?php
    }
    
}
new Product_Attribute_Productions_Form();

?>