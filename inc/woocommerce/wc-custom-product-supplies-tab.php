<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

add_filter( 'woocommerce_product_tabs', 'woo_product_supplies_tab' );
function woo_product_supplies_tab( $tabs ) {
	
	// Adds the new tab
	
	$tabs['supplies_tab'] = array(
		'title' 	=> __( 'Supplies', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'woo_product_supplies_tab_content'
	);

	return $tabs;

}

function woo_product_supplies_tab_content() {

	// The new tab content

	echo '<h2>New Product Supplies Tab</h2>';
	echo '<p>Here\'s your new product supplies tab.</p>';
	
}
