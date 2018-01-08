<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    echo '<div id="production-info-meta">';
    $order = wc_get_order($post->ID);
     //print_r($order->get_items());
    $production_ids = get_post_meta( $post->ID, '_production_id', false );
    if($production_ids != 0){
        
    }
    $count_production_ids = 0;    
    foreach ($production_ids as $production_id) {      
        try {
            $admin_production_url = get_edit_post_link( $production_id );
            if(filter_var($admin_production_url, FILTER_VALIDATE_URL)) {
                echo '<p>';
                echo '<a href="' .$admin_production_url . '">' . get_the_title( $production_id ).  '<a>';
                echo '</p>';
                $count_production_ids++;            
            }
        } catch (Exception $ex) {

        }                
    }
    if($count_production_ids == 0) {
        echo '<input type="button" class="button create_production button-primary" name="create_production" value="Start Production">';
    }
    echo '</div>';