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

<header class="woocommerce-products-header">
	<?php if ( false && apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
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
                /*$lg_used_col = 0;
                $md_used_col = 0;
                $sm_used_col = 0;*/
		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );
                        
                        $funding_production = wc_get_not_stated_production_item($post->ID);
                        $in_production = wc_get_in_production_item($post->ID);                     
                        if ( $funding_production || $in_production ) {
                                continue;
                        }

			wc_get_template_part( 'content', 'product' );
                        
                        
                        /*
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
                        }*/
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

                <?php

get_footer( 'shop' );
