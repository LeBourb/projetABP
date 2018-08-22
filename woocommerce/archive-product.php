<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>
<style>
    ul.custom-products .product-over-details {
        right: 2rem;
        bottom: 2rem;
        left: 2rem;
        padding: 3.5rem 3rem 3rem;
        background: #fff;
        color: #000;
        z-index: 1;
        display:none;
        position: absolute;
    }
    
    ul.custom-products  .product-over-details .product-variation {
        display: flex;
        justify-content: space-evenly;
        text-transform: uppercase;
    }
    
    
    @media screen and ( min-width: 768px ) {
        ul.custom-products li:hover  .product-over-details {
            display: block;
        }
        
        #page {
            margin-top: 5rem;
        }
        
    }
    
    .thumb-img-back {
        right: 0;
        position: absolute;
        top: 0;
        bottom: 0;
    }
    
    ul.custom-products {
        list-style-type: none;
        margin-left: 1rem;
    }
    
    ul.custom-products li {        
        position: relative;
        display: block;        
    }
    
    ul.custom-products li > a {
        position: relative;
        height: 43rem;
        width: 100%;
        display: block;
    }
    
    ul.custom-products li .product-tile-footer {
        display: flex;
        justify-content: flex-end;
    }        
    
    .woocommerce-products-header {
        padding-bottom: 4rem;
    }
    
    .header-eshop {
        display: flex;
        padding-bottom: 4.5rem;
        border-bottom: 1px solid #e1e1e1;
        text-align: center;
        margin-top: 9rem;
        justify-content: space-around;
        flex-wrap: wrap;
    }
    
    .header-eshop .section {
        flex-grow: 1;
    }
    
    @media screen and (max-width: 450px) {
        ul.custom-products li > a {
            height: 25rem;
        }
    }
        
    
</style>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; 
	
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );       
        
	?>
                
                    
</header>

<?php
if ( woocommerce_product_loop() ) {

	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked wc_print_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	//do_action( 'woocommerce_before_shop_loop' );

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
                $lg_used_col = 0;
                $md_used_col = 0;
                $sm_used_col = 0;
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
                        
                        $lg_used_col += 3;
                        $md_used_col += 4;
                        $sm_used_col += 6;
                        
                        if( $lg_used_col >= 9 ) {
                            $lg_used_col = 12;
                        }
                        if( $md_used_col >= 8 ) {
                            $md_used_col = 12;
                        }
                        if( $sm_used_col >= 6 ) {
                            $sm_used_col = 12;
                        }
                        
                        if($lg_used_col >= 12) {
                            echo '<div class="clearfix visible-lg"></div>';                                        
                            $lg_used_col = 0;
                        }
                        if($md_used_col >= 12) {
                            echo '<div class="clearfix visible-md"></div>';       
                            $md_used_col = 0;
                        }
                        if($sm_used_col >= 12) {
                            echo '<div class="clearfix visible-xs"></div>';
                            echo '<div class="clearfix visible-sm"></div>';
                            $sm_used_col = 0;
                        }
		}
	}

	woocommerce_product_loop_end();

	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	//do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}

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
?>

<div class="header-eshop">                    
                    <div class="section">
                        <p class="title">                        
                            Livraison offerte
                        </p>
                        <p class="text">
                            dès 200€ d'achat en France métropolitaine
                         </p>
                    </div>
                    <div class="section">
                        <p class="title">                        
                            Retours gratuits
                        </p>
                        <p class="text">
                            France métropolitaine, Belgique, Allemagne, UK, Italie, Espagne, Pays-Bas, Portugal, Finlande, Suède, Danemark et Luxembourg
                         </p>
                    </div>
                    <div class="section">
                        <p class="title">                        
                            Paiement sécurisé
                        </p>
                        <p class="text">
                            Visa, Mastercard, Amex, Paypal, Maestro, Sofort, iDEAL
                         </p>
                    </div>
                </div>
                <?php

get_footer( 'shop' );
