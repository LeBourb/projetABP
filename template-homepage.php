<?php
/**
 * The template for displaying the homepage.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Homepage
 *
 * @package storefront
 */

get_header(); ?>
            <div class="featherlight" style="display: none">
                        <div class="content-nav"></div>
                        <button class="featherlight-close-icon featherlight-close" aria-label="Close" tabindex="-1">✕</button>
                        <div class="featherlight-content">                           
                            
                            <div id="shipping-modal" class="featherlight-inner">
                                <div id="shipping-modal-content">
                                    <div class="content-area">
                                        
                                    </div>                                  
                                </div>
                              </div>
                            
                        </div>
                    </div>


	<div id="primary" class="content-area">
		<!--main id="main" class="site-main" role="main"-->

			<?php
			/**
			 * Functions hooked in to homepage action
			 *
			 * @hooked storefront_homepage_content      - 10
			 * @hooked storefront_product_categories    - 20
			 * @hooked storefront_recent_products       - 30
			 * @hooked storefront_featured_products     - 40
			 * @hooked storefront_popular_products      - 50
			 * @hooked storefront_on_sale_products      - 60
			 * @hooked storefront_best_selling_products - 70
			 */
			//do_action( 'homepage' );
                        storefront_homepage_content();
                        ?>

		<!--/main--><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();
