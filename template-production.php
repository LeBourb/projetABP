<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * The template for displaying the login page.
 *
 * This page template will display any functions hooked into the `login` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: In-Production
 *
 * @package storefront
 */

get_header();

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<div>
    <h3>L’atelier</h3>
    <p>NOS MACHINES TOURNENT À FOND.</p>
        

</div>

<h3><i>Currently In Production</i></h3>
<div class="atelier-product funding">
<?php
//if ( woocommerce_product_loop() ) {

	

	//woocommerce_product_loop_start();

	//if ( wc_get_loop_prop( 'total' ) ) {
            //print_r($GLOBALS['woocommerce_loop']);
            global $wp_query;
            //print_r($wp_query->query_vars);
            // The Query
            global $post;
            $atelier_id = get_option("woocommerce_atelier_page_id");
            $production_id = get_option("woocommerce_production_page_id");
            $shop_id = wc_get_page_id("shop");
            $args = array(
                'post_type' => 'shop_production',
                'post_status' => array('wc-supplies-ordered','wc-supp-delivered','wc-in-production' )
            );
            $wp_query = new WP_Query( $args );
            echo '<ul class="custom-products">';
		while ( $wp_query->have_posts() ) {
                    
			$wp_query->the_post();                      
                        
			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );

			include 'woocommerce/atelier-product-tile.php';
		}
                echo '</ul>';
	

	//woocommerce_product_loop_end();

?>
</div>

<?php

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );

get_footer();