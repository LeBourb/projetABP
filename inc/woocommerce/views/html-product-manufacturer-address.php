<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

          
function get_formatted_billing_name_and_address($user_id) {
    $customer      = new WC_Customer( $user_id );
    $address = '';
    $address .=  $customer->get_email();
    $address .= "<br>";
    $address .=  $customer->get_first_name();
    $address .= " ";
    $address .=  $customer->get_last_name();
    $address .= "<br>";
    $address .=  $customer->get_username();
    $address .= "<br>";
    $address .=  $customer->get_role();
    $address .= "<br>";
    //billing :
    $address .=  $customer->get_billing_first_name();
    $address .= " ";
    $address .=  $customer->get_billing_last_name();
    $address .= "<br>";
    $address .=  $customer->get_billing_company();
    $address .= "<br>";
    $address .=  $customer->get_billing_address_1();
    $address .= "<br>";
    $address .=  $customer->get_billing_address_2();
    $address .= "<br>";
    $address .=  $customer->get_billing_city();
    $address .= "<br>";
    $address .=  $customer->get_billing_state();
    $address .= "<br>";
    $address .=  $customer->get_billing_postcode();
    $address .= "<br>";
    $address .=  $customer->get_billing_country();
    $address .= "<br>";
    $address .=  $customer->get_billing_email();
    $address .= "<br>";
    $address .=  $customer->get_billing_phone();
    return $address;
}

echo '<address>';
	// Product attributes - taxonomies and custom, ordered, with visibility and variation attributes set

                        if(absint($manufacturer_id)) {
                            echo get_formatted_billing_name_and_address($manufacturer_id);
                        }
echo '</address>';                       

?>
