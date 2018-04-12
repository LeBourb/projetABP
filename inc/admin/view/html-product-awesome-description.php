<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

    <div id="wc_awesome_tab">        
	<div class="toolbar toolbar-top">
		<span class="expand-close">
			<a href="#" class="expand_all"><?php _e( 'Expand', 'woocommerce' ); ?></a> / <a href="#" class="close_all"><?php _e( 'Close', 'woocommerce' ); ?></a>
		</span>
		<select name="awesome_template_type" class="awesome_template_type">
			<?php
				/*global $wc_product_attributes;
                                print_r($post);
                                $data = get_post_meta( $post->ID, 'wc_awesome_descriptions', true );
                                $attribute_names = $data['awesome_description_names'];                
				// Array of defined attribute taxonomies
				$attribute_taxonomies = wc_get_attribute_taxonomies();

				if ( ! empty( $attribute_taxonomies ) ) {
					foreach ( $attribute_taxonomies as $tax ) {
                                            // check if attribute is already selected
                                            $attribute_taxonomy_name = wc_attribute_taxonomy_name( $tax->attribute_name );
                                            $label = $tax->attribute_label ? $tax->attribute_label : $tax->attribute_name;
                                            if($tax->attribute_type == 'awesome_description' && !in_array ( $attribute_taxonomy_name , $attribute_names) ) {                                                
                                                echo '<option value="' . esc_attr( $attribute_taxonomy_name ) . '">' . esc_html( $label ) . '</option>';
                                            }
					}
				}*/
                                
			?>
                    <option value="parallax-left">Parallax Left</option>
                    <option value="parallax-right">Parallax Right</option>
                    <option value="two-pans">Two Pans</option>
		</select>
		<button type="button" class="button add_awesome_description"><?php _e( 'Add', 'woocommerce' ); ?></button>
	</div>
	<div class="product_awesome_descriptions wc-metaboxes">
		<?php
			// Product attributes - taxonomies and custom, ordered, with visibility and variation attributes set
                
                        $data = get_post_meta( $post->ID, 'wc_awesome_descriptions', true );
                        if(is_array($data)){                            
                            foreach ( $data as $key => $item ) {                                
                                $awesome_key = $key;
                                $awesome_value = isset($item['text']) ? $item['text'] : '';
                                $meta_key = isset($item['media_id']) ? $item['media_id'] : '';
                                $media_1 = isset($item['media_1']) ? $item['media_1'] : '';
                                $media_2 = isset($item['media_2']) ? $item['media_2'] : '';
                                $title = isset($item['title']) ? $item['title'] : '';
                                $text_left = isset($item['text_left']) ? $item['text_left'] : '';
                                $text_right = isset($item['text_right']) ? $item['text_right'] : '';
                                if ($item['template_type'] == "two-pans") {
                                       include('html-product-awesome-two-pans.php');
                                } else {
                                    
                                    include('html-product-awesome-description-elem.php');
                                }
                            }
                        }
		?>
	</div>	
	<?php do_action( 'woocommerce_product_options_attributes' ); ?>
    </div>
</div>
