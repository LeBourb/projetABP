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
                    <option value="paragraph">Paragraph</option>
		</select>
		<button type="button" class="button add_awesome_description"><?php _e( 'Add', 'woocommerce' ); ?></button>
	</div>
	<div class="product_awesome_descriptions wc-metaboxes">
		<?php
			// Product attributes - taxonomies and custom, ordered, with visibility and variation attributes set
                
                        $data = get_post_meta( $post->ID, 'page_awesome_paragraphs', true );
                        if(is_array($data)){                            
                            foreach ( $data as $key => $item ) {                                
                                $awesome_key = $key;
                                $awesome_value = isset($item['text']) ? $item['text'] : '';
                                $meta_key = isset($item['media_id']) ? $item['media_id'] : '';
                                $media_1 = isset($item['media_1']) ? $item['media_1'] : '';
                                $media_2 = isset($item['media_2']) ? $item['media_2'] : '';
                                $title = isset($item['title']) ? $item['title'] : '';
                                $text_pos = isset($item['text_pos']) ? $item['text_pos'] : '';
                                $text_left = isset($item['text_left']) ? $item['text_left'] : '';
                                $text_right = isset($item['text_right']) ? $item['text_right'] : '';
                                $text_color = isset($item['text_color']) ? $item['text_color'] : '';                                
                                if (isset($item['template_type']) && $item['template_type'] == "paragraph") {
                                    include('html-page-awesome-paragraph-image.php');
                                }
                            }
                        }
		?>
	</div>	
	<?php do_action( 'woocommerce_product_options_attributes' ); ?>
    </div>
</div>
