<?php

/* supp
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

add_filter( 'woocommerce_product_tabs', 'woo_product_fabrics_tab' );
function woo_product_fabrics_tab( $tabs ) {
	
	// Adds the new tab
	
	$tabs['fabrics_tab'] = array(
		'title' 	=> __( 'Fabrics', 'woocommerce' ),
		'priority' 	=> 70,
		'callback' 	=> 'woo_product_fabrics_tab_content'
	);

	return $tabs;

}

function woo_product_fabrics_tab_content() {

	// The new tab content

	echo '<h2>New Product Supplies Tab</h2>';
	echo '<p>Here\'s your new product fabrics tab.</p>';
	
}
