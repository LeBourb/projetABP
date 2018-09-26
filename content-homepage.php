<?php
/**
 * The template used for displaying page content in template-homepage.php
 *
 * @package storefront
 */

?>
<?php
$featured_image = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
?>


<!-- =========================
    INTRO SECTION   
============================== -->
<style>
    video { 
        position: absolute;
        top: 50%;
        left: 50%;
        min-width: 100%;
        min-height: 100%;
        max-width: none;
        width: auto;
        height: auto;
        z-index: -100;
        transform: translateX(-50%) translateY(-50%);
        background-size: cover;
        transition: 1s opacity;        
    }
    
    .fb_dialog.fb_dialog_advanced.fb_shrink_active {
        left: 18pt!important;
    }
    
    .concept-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 10px;
        grid-auto-rows: minmax(100px, auto);
    }
    .concept-grid .one {
        grid-column: 2;
        grid-row: 1 / 3;
    }
    .concept-grid .two { 
        grid-column: 1;
        grid-row: 1 / 2;
    }
    .concept-grid .three {
        grid-column: 1;
        grid-row: 2 / 3;
    }
    
    #intro h4 {       
        color: black;
        font-size: 21px;
        /*text-align: start;
        margin-left: 50%;*/
    }
    
    #intro row {
        display: flex;
    }
    
    #intro .welcome-text {
       /* writing-mode: vertical-lr;
        text-orientation: upright; */
    }
    
    #detail .asset-item {
        padding-bottom: 4em;
        padding-top: 4em;
        max-width: 25em;        
    }
    
    #detail .asset-item .bottom-line {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
    }
    
    #detail h5 {
        font-weight: 600;
    }
    
    #register #progressbar {
        margin-top: 0;
    }
    
        
   
    #intro .background-img {
    background-repeat: no-repeat;
    background-attachment: scroll;
    background-clip: border-box;
    background-origin: padding-box;
    background-position-x: right;
    background-position-y: top;
    background-size: cover;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}

#intro .background-img::before {
    content: "";
    display: block;
    height: 100%;
    opacity: 0;
    
    
}
 

#pro .btn {
    margin-left: auto;
    width: 26em;
    display: block;
    margin-right: auto;
    white-space: normal;
}

#intro h3#homepage-catch-phrase {
    line-height: 40px;
    background-color: rgba(255, 255, 255, 0.34);
    color: black;
    padding-top: 20px;
    padding-bottom: 20px;
    padding-left: 5px;
    padding-right: 5px;
    
}

section.full-page {
    height: 100vh
}

.tightwidth {
    display: flex;
    height: 100%;
    text-align: left;
    max-width: 33.333%;
    min-width: 20rem;
    white-space: normal;
    margin-left: 25%;
    align-items: center;
}

@media screen and (max-width:480px) {
    section.full-page {        
        height: 44vh;
    }
}

@media screen and (max-width:768px) {
    #intro h3#homepage-catch-phrase {
        font-size: 1.3em;
    }
    
    #page {
        margin-top: 5rem;
    }
    
    section.full-page {
        height: 65vh;
    }
    
    .tightwidth {
        max-width: none;
        width: 100%;
        max-width: none;
        margin-left: 0;
    }
        
    .tightwidth .button,
    .tightwidth .lead {
        display: none;
    }
    
    .tightwidth .offsetabs {
        text-align: center;
        width: 100%;
    }

}

</style>
<?php 
            $shop_id = wc_get_page_id('shop');
            $attachment_id = get_post_thumbnail_id($shop_id);
            $image_attachment = wp_get_attachment_image_src( $attachment_id , 'medium');  
            $image_full_attachment = wp_get_attachment_image_src( $attachment_id , 'large');  
            ?>
<section id="eshop" class="img-lazy-load full-page" data-full-src="<?php echo $image_full_attachment[0]; ?>"  style="background: url(<?php echo $image_attachment[0]; ?>) no-repeat center bottom / cover;">
    <a href="<?php echo get_permalink($shop_id); ?>" >
    <div class="tightwidth">
        <section class="offsetabs">
            <h2 class="textfits headline">Collection Hiver</h2>
            <div class="lead">By Atelier Bourgeons</div>
            <div class="button">Shop Now</div>
        </section>                
    </div>
    
    </a>
</section>


<!-- =========================
    latelier SECTION   
============================== -->
<?php 
    $atelier_id = get_option('woocommerce_atelier_page_id');
    $attachment_id = get_post_thumbnail_id($atelier_id);
    $image_attachment = wp_get_attachment_image_src( $attachment_id , 'medium');  
    $image_full_attachment = wp_get_attachment_image_src( $attachment_id , 'large');  
?>
<section id="latelier" class="img-lazy-load full-page" data-full-src="<?php echo $image_full_attachment[0]; ?>"  style="background: url(<?php echo $image_attachment[0]; ?>) no-repeat center bottom / cover;">
    <a href="<?php echo get_permalink($atelier_id); ?>" >
    <div class="tightwidth">
        <section class="offsetabs">
            <h2 class="textfits headline">L'atelier Bourgeons</h2>
            <div class="lead">Craft your story</div>
            <div class="button">Fund Now</div>
        </section>                
    </div>
    
    </a>
</section>

<!-- =========================
    VIDEO SECTION   
============================== -->
<section id="pro" class="parallax-section" style="padding-bottom: 2em;">
	<div class="container">
		<div class="row" style="">
                    
                  <!-- Section title
			================================================== 
                  -->
			<div class="wow col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 text-center" style="font-weight: 200;margin-top: 3em;">
				<div class="section-title">
					<h2>For Professional Buyers <br> 事業者（法人 & 個人）の皆様へ</h2>
					<h3>— 卸販売のご案内 —</h3>
				</div>
			</div>  

 

			<div class="wow fadeInUp col-md-6 col-md-offset-0 col-sm-offset-1 col-sm-10" data-wow-delay="1.3s" >
				<p style="text-align: center;letter-spacing: 3px;margin-bottom: 2em;">一枚から卸価格にてご購入可能。<br>
フランス・パリ発のクリエーションを、<br>
効率的にネットでバイイング。
</p>
				<p>atelier Bourgeons アトリエブルジョンでは、事業者（セレクトショップ等の小売業）のお客さま向けに卸販売を行なっております。
</p><p>
当サイトに「ビジネス会員」としてご登録いただくと、会員様のみに公開される「ビジネス会員価格（卸価格）」で商品をお求めいただけます。ミニマムオーダーがなく、一枚からご購入可能ですので、お気軽にネットでのバイイングをお試しいただけるのが利点です。簡単 & 無料で会員登録できますので、この機会にぜひご利用ください。
</p>				
                            <a href="<?php echo Theme_My_Login::get_page_link( 'register' ); ?>/#shop-account" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="2.3s">
                                ビジネス会員登録フォームはこちら
                                （事業者様のみ)
                            </a>

			</div>
			<div class="wow fadeInUp col-md-6  col-md-offset-0 col-sm-offset-1 col-sm-10" data-wow-delay="1.6s">
				
					<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/homepage/apro.jpg">
				
			</div>

		</div>
	</div>
</section>


<!-- Back top -->
<a href="#back-top" class="go-top"><!--i class="fa fa-angle-up"></i-->
    <svg width="40px" height="40px" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 1184q0 13-10 23l-50 50q-10 10-23 10t-23-10l-393-393-393 393q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l466 466q10 10 10 23z"/></svg>
</a>

<?php
return;
?>

	</div>
</div><!-- #post-## -->
