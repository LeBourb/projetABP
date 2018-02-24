<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of wc-product-attribute-productions
 *
 * @author smash
 */

class Product_Attribute_Productions {

  // Constructor
    function __construct() {
        
        
        add_filter("product_attributes_type_selector" , function( $array ){
            //$array["product_productions"] = __( 'Productions', 'woocommerce' );
            return $array ;
        });
        
        //add_action( 'woocommerce_product_option_terms', array( $this, 'woo_advform_option_terms' ) );
        
        add_action('init', array($this, 'init'));
    }
    
    /**
     * Initialization hook that registers actions for all available product attribute taxonomies.
     */
    public function init() {
            
                
            //}
        
        //add_action('woocommerce_after_add_attribute_fields', array($this, 'display_taxonomy_fields'), 10);
        //add_action('woocommerce_after_edit_attribute_fields', array($this, 'display_taxonomy_fields'), 10);
        add_action('woocommerce_attribute_added', array($this, 'taxonomy_save_field'), 10, 2);
        add_action('woocommerce_attribute_updated', array($this, 'taxonomy_save_field'), 10, 2);
        // Save meta.
        //add_action( 'woocommerce_process_product_meta', array( &$this, 'save_tab_product_productionss' ) );
        add_action( 'woocommerce_product_after_variable_attributes', array( $this, 'variation_deposit_panel'), 20, 3 );
        add_action( 'woocommerce_save_product_variation', array( $this, 'save_product_variation_data' ), 30, 2 );
        add_action( 'woocommerce_save_product_variation-subscription', array( $this, 'save_product_variation_data' ), 30, 2 );
        
        add_action( 'wp_ajax_woocommerce_create_production', array( $this, 'create_production_item'), 30,2 );
        
        $ajax_events = array(
            'select_productions'                                    => false,
            'add_product_productions'                                => false,
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
    
    
    function media_selector_settings_page_callback($term, $taxonomy = null) {
        ?>
        <tr class="form-field form-required term-name-wrap">
            <th scope="row"><label for="name">Thumbnail</label></th>
            <td>
                <?php
                wp_enqueue_media();
                $image_attachment_id = null;
                $image_url = null;
                if($term) {
                    $image_attachment_id = get_term_meta( $term->term_id, 'image_attachment_id', true);
                    $image_url = wp_get_attachment_image_src( $image_attachment_id );
                }
                //
                
            ?><div class='image-preview-wrapper'>
                <?php 
                if($image_url) {
                    echo '<img id="image-preview" src="' . $image_url[0] . '" width="' . $image_url[1] . '" height="' . $image_url[2] . '">';
                }else {
                    echo '<img id="image-preview" src="" width="100" height="100" style="max-height: 100px; width: 100px;">';
                }
                
                ?>
            </div>
            <input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
            <input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php if($image_attachment_id)echo $image_attachment_id; ?>'>
            </td>
        </tr>
<?php
            
    }

     function price_settings_page_callback($term, $taxonomy = null) {
         $price = null;
         if($term)
             $price = get_term_meta( $term->term_id, 'price_term', true);
            ?>
        <tr class="form-field form-required term-name-wrap">
            <th scope="row"><label for="name">Price</label></th>
            <td>
                <input type="text" class="product_price_settings_callback" name="price_settings_page_callback" value="<?php if($price)echo $price; ?>" />
             </td>
        </tr>
            <?php
    }
    
    function supplier_settings_page_callback($term, $taxonomy = null) {
         $supplier = null;
         if($term)
             $supplier = get_term_meta( $term->term_id, 'supplier_id', true);
            ?>
        <tr class="form-field form-required term-name-wrap">
            <th scope="row"><label for="name">Supplier</label></th>
            <td>
                <!--<input type="text" class="product_supplier_settings_callback" name="supplier_settings_page_callback" value="<?php //if($supplier)echo $supplier; ?>" />-->
                
                   <?php wp_dropdown_pages( array( 'post_type' =>'shop_supplier', 'name' => 'supplier_id' , 'selected' => $supplier )); ?>                   
             </td>
        </tr>
        
            <?php
    }
    
       
    function variation_deposit_panel($loop, $variation_data, $variation) {       
        global $post;
        //print_r( $variation->ID);
        //print_r(get_post_meta( $variation->ID, 'varation_productions' ));
        
        echo '<select multiple="multiple" data-placeholder="' . __( 'Select Productions', 'woocommerce' ) . '" class="multiselect attribute_values wc-enhanced-select" name="varation_productions[' . $loop . ']">';
        $data = get_post_meta( $post->ID, 'product_productions', true );
        $variation_productions = $variation_data['varation_productions'];
        
        if(is_array($data) && array_key_exists('product_production_id',$data)){
            $product_production_ids = $data['product_production_id'];                                
            if($product_production_ids) {
                foreach ( $product_production_ids as $production_id ) {
                        echo '<option value="' . esc_attr( $production_id ) . '" ' . selected( in_array( $production_id, $variation_productions ), true, false ) . '>' . esc_attr( get_term_by( 'id', $production_id, 'pa_production' )->name ) . '</option>';
                }
            }
        }
        echo '</select>';
    }
    
    /**
	 * Save data for variations
	 * @param  int $post_id
	 */
	public function save_product_variation_data( $variation_id, $loop  ) {
                $value = ! empty( $_POST[ 'varation_productions' ][ $loop ] ) ? $_POST[ 'varation_productions' ][ $loop ] : '';
                update_post_meta( $variation_id, 'varation_productions', $value );
	}
    

function media_selector_print_scripts() {

	$my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );

	?><script type='text/javascript'>
		jQuery( document ).ready( function( $ ) {
			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this
			jQuery('#upload_image_button').on('click', function( event ){
				event.preventDefault();
				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}
				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});
				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();
					// Do something with attachment.id and/or attachment.url here
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#image_attachment_id' ).val( attachment.id );
					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});
					// Finally, open the modal
					file_frame.open();
			});
			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});
	</script><?php
}
    /**
     * Prints a text-area field with label for defining a product tab description of a new product attribute.
     * 
     * @param string $taxonomy The current product attribute taxonomy.
     */
    public function attribute_edit_field($term, $taxonomy = null){
       $this->media_selector_settings_page_callback($term, $taxonomy);
       $this->media_selector_print_scripts();
       $this->price_settings_page_callback($term, $taxonomy = null);
       $this->supplier_settings_page_callback($term, $taxonomy = null);
       //add_action( 'admin_footer', 'media_selector_print_scripts' );
    }
    
    
    // define the wp_ajax_woocommerce_<ajax_event> callback 
    function action_wp_ajax_woocommerce_ajax_event( $array ) { 
        // make action magic happen here... 
    }
    
        /**
     * Prints a text-area field with label for defining a product tab description of a new product attribute.
     * 
     * @param string $taxonomy The current product attribute taxonomy.
     */
    function attribute_add_field($taxonomy = null) {        
        ?>
	<?php  
                $term =null;
                $this->media_selector_settings_page_callback($term, $taxonomy);               
               $this->media_selector_print_scripts();
               $this->price_settings_page_callback($term, $taxonomy);
               $this->supplier_settings_page_callback($term, $taxonomy);
       //add_action( 'admin_footer', 'media_selector_print_scripts' );
    }

    

    /*
     * Actions perform on loading of menu pages
     */
    function woo_advform_page_file_path() {



    }
    
    function save_field ($id) {
                
        $image_id = ! empty($_POST['image_attachment_id']) ? $_POST['image_attachment_id'] : '';
        $price = !empty ($_POST['price_settings_page_callback']) ? $_POST['price_settings_page_callback'] : '';
        
        update_term_meta( $id, 'price_term',$price);
        
         //$product->set_prop( 'product_productionss', $attributes );
        update_term_meta( $id, 'image_attachment_id', $image_id );
        
        $supplier = !empty( $_POST['supplier_id'] ) ? $_POST['supplier_id'] : '';
        update_term_meta( $id, 'supplier_id',$supplier);
        //
    }
    
    function woo_advform_option_terms ($attribute_taxonomy) {
        if($attribute_taxonomy->attribute_name == 'pa_production' ) {
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
function create_production_item() {
    ob_start();

    //check_ajax_referer( 'add-advanced-attribute', 'security' );

    if ( ! current_user_can( 'edit_products' ) ) {
            wp_die( -1 );
    }

    if(!function_exists('wc_add_prod_item')) {
        require_once 'wc-prod-item-functions.php';
    }

    
    //$production_ids = wc_add_prod_items( sanitize_text_field( $_POST['post_id'] ) );
    $product_id = sanitize_text_field( $_POST['post_id'] ) ;    
    $production_id = wc_add_prod_item( $product_id );
       
   /* foreach( $production_ids as $production_id ) {
        // This method uses `add_post_meta()` instead of `update_post_meta()`
        add_post_meta( $_POST['post_id'], '_production_id', $production_id );
    }*/
    
    include 'views/html-product-productions.php';
       
       
    //echo 'hello: ' . $production_id;

    //update_post_meta( sanitize_text_field( $_POST['post_id'] ), '_production_id', $production_id );

    //include 'wc-admin-view-order-meta-production.php';

    wp_die();
}
    
    /**
    * Add an attribute row.
    */
    function select_productions() {
           ob_start();

           //check_ajax_referer( 'add-advanced-attribute', 'security' );

           if ( ! current_user_can( 'edit_products' ) ) {
                   wp_die( -1 );
           }
           $production_id = $_POST['selected_production'];
           $index = $_POST['i'];           
           include( 'views/html-product-productions-content.php' );
           wp_die();
    }

    /**
    * Add a new attribute via ajax function.
    */
    function add_new_product_productions() {
           //check_ajax_referer( 'add-advanced-attribute', 'security' );

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
    * Save attributes via ajax.
    */
    function save_product_productions() {
           //check_ajax_referer( 'save-advanced-attributes', 'security' );

           if ( ! current_user_can( 'edit_products' ) ) {
                   wp_die( -1 );
           }

           global $post;
           $post = get_post( $_POST['post_id'] ); 
           $index = get_post( $_POST['i'] );            
           
            parse_str( $_POST['data'], $data );
            //$product->set_prop( 'product_productionss', $attributes );
           update_post_meta( $_POST['post_id'], 'product_productions', $data );
           
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
            echo '<li class="productions_tab"><a href="#productions_tab">' . __( 'Productions', 'wcgmcf' ) . '</a></li>';
    }
    /**
    * Tab content.
    */
    function tab_view() {
           $is_tabvisible = 1;
           global $post;
           $product_id = $post->ID;
           include('views/html-product-productions.php');           
    }
    
}
new Product_Attribute_Productions();

?>