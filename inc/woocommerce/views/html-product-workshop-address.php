<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

          
function get_formatted_billing_name_and_address($workshop_id) {
    $data = get_post_meta( $workshop_id, 'gmp_arr', true );
    $title = get_the_title($workshop_id);
    $address1 = $data['gmp_address1'];
    $city = $data['gmp_city'];
    $state = $data['gmp_state'];
    $zip = $data['gmp_zip'];
    
    
    $address = '';
    $address .=  $title;
    $address .= "<br>";
    $address .=  $address1;
    $address .= " ";
    $address .=  $city;
    $address .= "<br>";
    $address .=  $state;
    $address .= "<br>";
    $address .=  $zip;
    $address .= "<br>";
    
    return $address;
}

echo '<address>';
	// Product attributes - taxonomies and custom, ordered, with visibility and variation attributes set

                        if(absint($workshop_id)) {
                            echo get_formatted_billing_name_and_address($workshop_id);
                        }
echo '</address>';                       

?>
