<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


add_action( 'add_meta_boxes', 'workshop_meta_boxes' );
if ( ! function_exists( 'workshop_meta_boxes' ) ) {
    function workshop_meta_boxes() {                
        add_meta_box( 'gmp', __( 'Post Google Map', 'gmp-plugin' ), 'gmp_meta_box',  "shop_workshop", 'normal', 'high' );
        add_meta_box( 'gmp', __( 'Post Google Map', 'gmp-plugin' ), 'gmp_meta_box',  "shop_reseller", 'normal', 'high' );
    }
}
	