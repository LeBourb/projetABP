<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Free_Blog
 */

get_header();
?>

<?php 
get_sidebar( 'left' );
?>
<script>
    window.appticles={
        config:{
            SHOP_NAME:"MY SHOP",
            API_CATEGORIES_URL:"<?php echo get_site_url(); ?>/wp-json/wp/v2/categories/",
            API_PRODUCTS_URL:"<?php echo get_site_url(); ?>/wp-json/wp/v2/products/",
            API_PRODUCT_URL:"<?php echo get_site_url(); ?>/wp-json/wp/v2/product/",
            API_REVIEWS_URL:"<?php echo get_site_url(); ?>/wp-json/pwacommercepro/reviews/",
            API_VARIATIONS_URL:"<?php echo get_site_url(); ?>/wp-json/pwacommercepro/product-variations/",
            API_CHECKOUT_URL:"<?php echo get_site_url(); ?>/wp-json/pwacommercepro/proceed-checkout",
            CHECKOUT_URL:"<?php echo get_site_url(); ?>/checkout/",CURRENCY:"$",OFFLINE:!0
        }
    }
</script>
	<div id="primary" class="content-area" style="padding-top: 7rem;">
		<main id="blog" class="site-main" style="max-width: 1400px;margin-left: auto;margin-right: auto;">
			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

