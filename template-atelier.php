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
 * Template name: Atelier
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
	<?php if ( 0 && apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
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
    <p>We design new products. You crowd fund them and save 20%. Our planet takes on less waste. We deliver them when they’re seasonally appropriate. Everybody wins.
        </p>
        

</div>
    <div id="welcome-to-atelier" class=" owl-carousel owl-theme" style="display:flex;flex-wrap:wrap;justify-content: center;">
        <div class="item">
                <i class="fa">
                    <img style="width: 1em;" src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/icon/secure-payment.png"></img>
                </i>    
                <h5>安全&快適なネットショッピング</h5>
                <h4>PRIVACY POLICY & SECURE PAYMENT</h4>
                <p>本サイトは「SSL」というセキュリティー技術を採用しており、注文時に入力される全ての個人情報は暗号化によって安全に送信されます。また、当店利用のオンライン決済サービスStripeは、 カード業界の国際安全基準 (PCI DSS) で最も安全な「Level 1」を取得しています。 安心してお買い物をお楽しみください。</p>
                <div class="bottom-line">
                    <a href="<?php echo get_permalink(get_option('woocommerce_privacy_policy_page_id')); ?>" class="btn btn-lg btn-default" data-wow-delay="2.3s" style="visibility: visible; font-size: 0.8em;">プライバシーポリシー</a>
                </div>
        </div>                                
        <div class="item">				
                <i class="fa">
                    <img style="width: 1em;" src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/icon/flexible-payment.png"></img>
                </i>   
                <h5>最初に全額払わなくてもOK！状況に応じて選べるお支払い方法</h5>
                <h4>FLEXIBILITY OF PAYMENT</h4>
                <p>商品をご予約いただく際に、「全額前払い」「分割２回払い」のいずれかをご指定いただけます。お支払い方法は、「クレジットカード払い」または「銀行振込」からお選びいただけ、分割払いの際は、その都度お支払い方法が変更可能です。</p>
                <div class="bottom-line">
                    <a href="<?php echo get_permalink(get_option('woocommerce_shopping_guide_page_id')); ?>" class="btn btn-lg btn-default"  style="visibility: visible; font-size: 0.8em;">ご利用ガイド</a>
                </div>
        </div>                             
        <div class="item">				
                <i class="fa">
                    <img style="width: 1em;" src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/icon/deposit.png"></img>
                </i>   
                <h5>予約注文限定の特別価格で、通常よりもおトクに。</h5>
                <h4>ADVANTAGE OF PRE-ORDER</h4>
                <p>予め注文を受けた枚数を生産し、余分な在庫やコストを減らすことで、良心的な価格設定が可能になります。そのため、当サイトにて予約注文していただく個人のお客様には、先行予約の特別価格で商品をお求めいただけます。</p>
                <div class="bottom-line">                                    
                    <a href="#products" class="btn btn-lg btn-default" style="visibility: visible; font-size: 0.8em;">商品ページ</a>
                </div>
                <!--a href="<?php //echo $help_url;?>/#tracking" class="btn btn-lg btn-default" style="visibility: visible; font-size: 0.8em;">商品ページ</a-->
        </div>      
        <div class="item">
                <i class="fa">
                    <img style="width: 1em;" src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/icon/no-minimum-order.png"></img>
                </i>   
                <h5>事業者様には、一枚から卸売価格でご提供。</h5>
                <h4>No MINUMUM ORDER FOR B to B SALES</h4>
                <p>事業者（小売業・ブティック等）のお客様は、当サイトにご登録後、卸価格で商品をお求めいただけます。一枚から購入可能なので、簡単・気軽にネットでの買い付けをお試しいただけます。</p>
                <div class="bottom-line">
                    <a href="<?php echo Theme_My_Login::get_page_link( 'register' ); ?>/#shop-account" class="btn btn-lg btn-default" style="visibility: visible; font-size: 0.8em;">ビジネス会員登録フォーム</a>
                </div>
        </div>            
        <div class="item">
                <i class="fa">
                    <img style="width: 1em;" src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/icon/tracking-order.png"></img>
                </i>   
                <h5>商品の生産状況からお届け予定まで、サイト上で常に確認可能。</h5>
                <h4>TRACKING SYSTEM OF YOUR ORDER</h4>
                <p>商品の注文後、当サイトにログイン→「MY ORDER」ページにて、商品の生産状況やお届け予定日をいつでもお好きな時に確認できます。</p>
                <div class="bottom-line">
                    <a href="<?php echo Theme_My_Login::get_page_link( 'register' ); ?>" class="btn btn-lg btn-default" style="visibility: visible; font-size: 0.8em;">ログイン・登録フォーム</a>
                </div>
        </div>
    </div>
     <script>
                               jQuery(document).ready(function(){
                            jQuery('#welcome-to-atelier').owlCarousel({
                                  items:1,
                                  smartSpeed:450,
                                  loop:true,
                                  autoplay:true,
                                  autoplayTimeout:4000,
                                  autoplayHoverPause:true,
                                  responsiveClass:true,
                                  responsive: {
                                    // breakpoint from 768 up
                                    768 : {
                                        items:2,
                                        nav:true
                                    },
                                    // breakpoint from 768 up
                                    980 : {
                                        items:2,
                                        nav:true
                                    },
                                    1024: {
                                        items:3,
                                        nav:true
                                    }
                                }
                              });
   
});
                      </script>     
<h3><i>Currently Funding</i></h3>
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
                'post_status' => 'wc-not-started'
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