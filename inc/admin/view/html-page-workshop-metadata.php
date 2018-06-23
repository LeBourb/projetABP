<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo '<div>Workshop Metadata</div>';
?> 
<?php
$settings = array(
    'textarea_name' => 'workshop_metadata_text',
        'quicktags'     => array( 'buttons' => 'em,strong,link' ),
        'tinymce'       => array(
                'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
                'theme_advanced_buttons2' => '',
        ),
        'editor_css'    => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
);
echo '<div>';
wp_editor( htmlspecialchars_decode( $text ), 'text_worshop_metadata', apply_filters( 'woocommerce_product_workshop_metadata_editor_settings', $settings ) );
echo '</div>';
?>
<button type="button" class="save_workshop_metadata button">Save</button>    
<button type="button" class="select_media_workshop_metadata button">Add/Change background image</button>

        <div class="custom_postimage_wrapper" id="workshop_metadata_wrapper" style="margin-bottom:20px;">
            <img src="<?php echo wp_get_attachment_image_src( $media_key)[0]; ?>" style="display: <?php echo ($media_key!=''?'block':'none'); ?>" alt="">            
            <input type="hidden" class="media_key" name="meta_id" id="media_workshop_metadata" value="<?php echo $media_key; ?>" />
        </div>
   
<script>
    (function($) {
        function getParameterByName(name, url) {
            if (!url)
                url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                    results = regex.exec(url);
            if (!results)
                return null;
            if (!results[2])
                return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }
        $( 'button.save_workshop_metadata').on('click',function(){
                var $wrapper     = $( this ).closest( '#wc_awesome_tab' );
                var data         = {
                        action:   'woocommerce_save_workshop_metadata',                 
                        post_id     : getParameterByName('post',document.location.href),
                        text:  tinymce.get("text_worshop_metadata").getContent(),
                        media_id: $( '#media_workshop_metadata' ).val()
                };
                $.post( ajaxurl, data, function( response ) {
                        $wrapper.replaceWith( response );			
                        //$wrapper.unblock();
                });
                return false;
        });

        $( 'button.select_media_workshop_metadata').on('click',function(){            
            var $wrapper = jQuery('#workshop_metadata_wrapper');

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
                $wrapper.find('input#media_workshop_metadata').val(img_id);
                $wrapper.find('img').attr('src',img_url);
                $wrapper.find('img').show();
            });
            custom_postimage_uploader.on('open', function(){
                var selection = custom_postimage_uploader.state().get('selection');
                var selected = $wrapper.find('input#workshop_metadata').val();
                if(selected){
                    selection.add(wp.media.attachment(selected));
                }
            });
            custom_postimage_uploader.open();
            return false;
        });
    }(jQuery));
</script>
<!--/div-->