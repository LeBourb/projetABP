<style>
    .tooltip-item .tooltip::after {
        display: none;
    }
    .tooltip {
        width: 10em;
        padding: 0;
    }
</style>
    <?php
			// Product attributes - taxonomies and custom, ordered, with visibility and variation attributes set                           
                        $data = get_post_meta( $post->ID, 'product_stamps', true );
                        if(is_array($data) && array_key_exists('product_stamp_id',$data)){
                            $product_stamp_ids = $data['product_stamp_id'];    
                            $index        = -1;
                            
                            if($product_stamp_ids) {
                                echo '<div style="display:flex;">';
                                foreach ( $product_stamp_ids as $stamp_id ) {
                                    $image_attachment_id = get_term_meta( $stamp_id, 'image_attachment_id', true);
                                    $term = get_term( $stamp_id, 'pa_stamp' );
                                    $image_url = wp_get_attachment_image_src( $image_attachment_id );            
                                    if($image_url) {
                                        
                                        echo '<div class="tooltip-item">';
                                        echo '<img id="image-preview" style="padding:0;" src="' . $image_url[0] . '" width="' . $image_url[1] . '" height="' . $image_url[2] . '">';
                                        echo '<p>' . $term->name . '</p>' ;
                                        echo '<div class="tooltip">
                                            <p>' . $term->description  . '</p>
                                          </div>';
                                        echo '</div>';
                                    } 
                                }
                                echo '</div>';
                            }
                        }
?>
