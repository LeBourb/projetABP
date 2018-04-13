<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($parallex_left) {
    echo '<div>PARALLAX LEFT</div>';
} else {
    echo '<div>PARALLAX RIGHT</div>';
}
$settings = array(
    'textarea_name' => $awesome_key,
        'quicktags'     => array( 'buttons' => 'em,strong,link' ),
        'tinymce'       => array(
                'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
                'theme_advanced_buttons2' => '',
        ),
        'editor_css'    => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
);
echo '<div>';
wp_editor( htmlspecialchars_decode( $awesome_value), 'text_' . $awesome_key, apply_filters( 'woocommerce_product_awesome_description_editor_settings', $settings ) );
echo '</div>';
?>
<button id="<?php echo $awesome_key;?>" type="button" class="remove_awesome_description button">Remove</button>                        
<button id="<?php echo $awesome_key;?>" type="button" class="save_awesome_description button">Save</button>    
<button id="<?php echo $awesome_key;?>" type="button" class="select_media_awesome_description button">Add/Change background image</button>
<?php

        
        ?>
        <div class="custom_postimage_wrapper" id="<?php echo $awesome_key; ?>_wrapper" style="margin-bottom:20px;">
            <img src="<?php echo wp_get_attachment_image_src( $meta_key)[0]; ?>" style="display: <?php echo ($meta_key!=''?'block':'none'); ?>" alt="">            
            <input type="hidden" class="media_key" name="meta_id" id="media_<?php echo $awesome_key; ?>" value="<?php echo $meta_key; ?>" />
        </div>
    <?php  ?>
   
<script>
    $( 'button#<?php echo $awesome_key;?>.remove_awesome_description').on('click',function(){
            var $wrapper     = $( this ).closest( '#wc_awesome_tab' );
            var id = $( this ).attr('id'); 
            var data         = {
                    action:   'woocommerce_remove_awesome_description',                    
                    id:        id,
                    post_id     : woocommerce_admin_meta_boxes.post_id,
                    security: woocommerce_admin_meta_boxes.add_attribute_nonce
            };
            $.post( woocommerce_admin_meta_boxes.ajax_url, data, function( response ) {
                    $wrapper.replaceWith( response );			
                    $wrapper.unblock();
            });
            return false;
    });
    $( 'button#<?php echo $awesome_key;?>.save_awesome_description').on('click',function(){
            var $wrapper     = $( this ).closest( '#wc_awesome_tab' );
            var id = $( this ).attr('id');             
            var data         = {
                    action:   'woocommerce_save_awesome_description',                    
                    id:        id,
                    post_id     : woocommerce_admin_meta_boxes.post_id,
                    text:  tinymce.get("text_5ac3f8f89d250").getContent(),
                    media_id: $( '#media_' + id ).val(),
                    security: woocommerce_admin_meta_boxes.add_attribute_nonce
            };
            $.post( woocommerce_admin_meta_boxes.ajax_url, data, function( response ) {
                    $wrapper.replaceWith( response );			
                    $wrapper.unblock();
            });
            return false;
    });

 $( 'button#<?php echo $awesome_key;?>.select_media_awesome_description').on('click',function(){
        var key = $(this).attr('id');
        var $wrapper = jQuery('#'+key+'_wrapper');

        custom_postimage_uploader = wp.media.frames.file_frame = wp.media({
            title: '<?php _e('select image','yourdomain'); ?>',
            button: {
                text: '<?php _e('select image','yourdomain'); ?>'
            },
            multiple: false
        });
        custom_postimage_uploader.on('select', function() {

            var attachment = custom_postimage_uploader.state().get('selection').first().toJSON();
            var img_url = attachment['url'];
            var img_id = attachment['id'];
            $wrapper.find('input#media_'+key).val(img_id);
            $wrapper.find('img').attr('src',img_url);
            $wrapper.find('img').show();
        });
        custom_postimage_uploader.on('open', function(){
            var selection = custom_postimage_uploader.state().get('selection');
            var selected = $wrapper.find('input#'+key).val();
            if(selected){
                selection.add(wp.media.attachment(selected));
            }
        });
        custom_postimage_uploader.open();
        return false;
    });
</script>
<!--/div-->