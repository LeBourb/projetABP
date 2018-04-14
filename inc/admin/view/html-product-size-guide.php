<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$settings = array(
    'textarea_name' => 'wc_size_guide',
        'quicktags'     => array( 'buttons' => 'em,strong,link' ),
        'tinymce'       => array(
                'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
                'theme_advanced_buttons2' => '',
        ),
        'editor_css'    => '<style>#wp-excerpt-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
);
echo '<div>';
wp_editor( htmlspecialchars_decode( $size_guide), 'wc_size_guide', apply_filters( 'woocommerce_product_size_guide_editor_settings', $settings ) );
echo '</div>';
?>
