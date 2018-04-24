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
        font-family: "Times New Roman", Times, serif;
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
    
    #register #progressbar {
        margin-top: 0;
    }
    
    #intro .container {
        width: 100%;
    }
    
    @font-face {
        font-family: TestFont;
        src: url(<?php echo get_site_url() . '/wp-content/themes/atelierbourgeonspro/assets/fonts/AppliMincho.otf'?>);
        
    }
    
    #intro .container ,
    #intro .container .row,    
    #intro .container .row .col-md-12 ,
    #intro .container .row .col-md-12 .welcome-text-container , 
    #intro .container .row .col-md-12 .welcome-text-container .welcome-text ,
    #intro .container .row .col-md-12 .welcome-text-container .welcome-text .desc-wider {
        height: 100%;
    }
    
    #intro .container p , 
    #intro .container span {
        color: black; 
        background: #ffffff61;
        font-family: TestFont;
    }
    
    #intro .container p {
        line-height: 2;
        font-size: 2em;
        writing-mode: vertical-lr;
        color: #16170a;                
    }
    #intro .container span {
        font-size: 1.4em;
        writing-mode: vertical-lr;
        line-height: 1;
        letter-spacing: 6px;
        color: #16170a;
    }
    @media (min-width: 1200px) {

#intro .container p.desc-left{
    margin-left: 2em;
    height: 100%;
}
#intro .container p.desc-wider{
    line-height: 7;
}
    }
   @media (max-width: 750px) {
#intro .container{
    width: 100%;
}
#intro .container p.desc-wider{
    line-height: 3;
    font-size: 1.4em;
}
#intro .container span{
    font-size: 1.1em;
}
#intro .container .welcome-buttons {
    display:none;
}
}

#pro .btn {
    margin-left: auto;
    width: 26em;
    display: block;
    margin-right: auto;
    white-space: normal;
}
</style>
<section id="intro" class="parallax-section">
     <?php // echo wp_video_shortcode( array() );//
    //echo wp_get_attachment_url(  );
    // 
           global $post;
        $videos = get_attached_media( 'video', $post->ID );
        $video = reset($videos);
        //https://la-cascade.io/video-en-background/
 ?>
<video id="bgvid" playsinline autoplay muted loop >

<source src="<?php echo wp_get_attachment_url( $video->ID );?>" type="video/mp4">
</video>  <!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button  -->

	<div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12">
				<div class="wow welcome-text-container" data-wow-delay="0.9s" style="display: flex;" >                                       
                                    <div class="welcome-text" style="display:flex;position:  absolute;left: 0;">
                                    <p class="desc-left" style="">
							アトリエブルジョン。
                                    </p>                    <span>atelier Bourgeons</span>
                                    <p class="desc-wider">両方からお洒落するレディースブランド<br>
                                    </p>
                                    </div>
                                    <div class="welcome-text" style="padding-top: 20%;
    width: 39%;
    margin-left: auto;
    margin-right: auto;"> <a href="#overview" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="2.3s"><?php _e('LEARN MORE','atelierbourgeons') ?></a>
				<a href="#register" class="btn btn-lg btn-danger smoothScroll wow fadeInUp" data-wow-delay="2.3s"><?php _e('REGISTER NOW','atelierbourgeons') ?></a>
                                </div>
                                    <div class="welcome-text welcome-buttons" style="position: absolute;right: 0;overflow: hidden;">
                                    <p class="desc-wider">「デザイン」 と 「ものづくりの背景」
                                    <br>                                    
                                    －外身も中身も、かっこよく。－
                                    		</p>
                                        </div>
                                </div><!--h1 class="wow fadeInUp" data-wow-delay="1.6s"><?php //echo get_post_meta( $post->ID , 'Home Page Title', true ); ?></h1-->
				
			</div>


		</div>
	</div>
</section>


<!-- =========================
    OVERVIEW SECTION   
============================== -->
<section id="overview" class="parallax-section">
	<div class="container">
		<div class="row" style="display: flex; align-items: center;">

			<div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.6s" style="text-align: center;">                            
                            <p>－外身も中身も、かっこよく。－
                                <br>
                                ……………………………………………………… 
                                <br>
                                DESIGN & CREATED in FRANCE
                                <br>
                                パリ郊外のアトリエで創る、
                                <br>
                                さりげなくエッジの効いたデザイン
                                <br>
                                × 
                                <br>
                                HIGH QUALITY TEXTILE CRAFTED by ARTISANS
                                <br>
                                職人たちが織りなす技
                                <br>
                                ×  
                                <br>
                                ECOLOGICAL & ETHICAL MATERIALS ・ PROCESSING
                                <br>
                                地球と生き物に配慮した素材と加工
                                <br>
                                …………………………………………………………
                                <br>
                                こだわりのデザインと着心地は外せない。
                                <br>
                                でも、その背景だって大切だ。
                                <br>
                                全てのモノは、限りある資源を使い、
                                <br>
                                誰かの仕事でできている。
                                <br>
                                atelier Bourgeons アトリエブルジョンは、
                                <br>
                                外身（デザイン）と中身（ものづくりの背景）、
                                <br>
                                両方からのお洒落を提案するレディースブランドです。
                                <br>
                        </p>
			</div>
					
			<div class="wow fadeInUp col-md-6 col-sm-6 " data-wow-delay="0.9s">
                            <div class="concept-grid">
                                <div class="one" style="width: 87%;">
                                    <img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/homepage/amb_1.jpg" class="img-responsive" alt="Overview">
                                </div>
                                <div class="two">
                                    <img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/homepage/amb_3.jpg" class="img-responsive" alt="Overview">
                                </div>
                                <div class="three">
                                    <img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/homepage/amb_2.jpg" class="img-responsive" alt="Overview">
                                </div>
                            </div>
			</div>

		</div>
            
            
	</div>
</section>


<!-- =========================
    DETAIL SECTION   
============================== -->
<section id="detail" class="parallax-section">
	<div class="container" style="width:100%;">
		<div class="row" style="display:flex;flex-wrap:wrap;justify-content: center;">

			<!--div class="wow fadeInLeft col-md-4 col-sm-4" data-wow-delay="0.3s">
				<i class="fa fa-handshake-o"></i>
				<h3>650 Participants</h3>
				<p>Quisque ut libero sapien. Integer tellus nisl, efficitur sed dolor at, vehicula finibus massa. Sed tincidunt metus sed eleifend suscipit.</p>
			</div-->

                        <?php
                            $pages = get_pages(array(
                                'meta_key' => '_wp_page_template',
                                'meta_value' => 'template-help.php'
                            ));    
                            $help_url = get_permalink($pages[0]->ID);
                        ?>
			<div class="asset-item wow fadeInRight col-xs-6 col-sm-4 col-md-4 col-lg-4" data-wow-delay="0.9s">
				<i class="fa">
                                    <img style="width: 1em;" src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/icon/secure-payment.png"></img>
                                </i>    
                                <h5>安全&快適なネットショッピング</h5>
                                <h4>PRIVACY POLICY & SECURE PAIEMENT</h4>
                                <p>本サイトは「SSL」というセキュリティー技術を採用しており、注文時に入力される全ての個人情報は暗号化によって安全に送信されます。また、当店利用のオンライン決済サービスStripeは、 カード業界の国際安全基準 (PCI DSS) で最も安全な「Level 1」を取得しています。 安心してお買い物をお楽しみください。</p>
                                <div class="bottom-line">
                                    <a href="<?php echo get_permalink(get_option('woocommerce_privacy_policy_page_id')); ?>" class="btn btn-lg btn-default" data-wow-delay="2.3s" style="visibility: visible; font-size: 0.8em;">プライバシーポリシー</a>
                                </div>
			</div>
                        <div class="clearfix visible-xs"></div>                        
                        <div class="asset-item wow fadeInRight col-xs-6 col-sm-4 col-md-4 col-lg-4" data-wow-delay="0.9s">				
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
                        <div class="clearfix visible-xs"></div>                        
                        <div class="asset-item wow fadeInRight col-xs-6 col-sm-4 col-md-4 col-lg-4" data-wow-delay="0.9s">				
                                <i class="fa">
                                    <img style="width: 1em;" src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/icon/deposit.png"></img>
                                </i>   
                                <h5>予約注文限定の特別価格で、通常よりもおトクに。</h5>
				<h4>ADVANTAGE OF PRE-ORDER</h4>
				<p>予めご注文をいただき、必要な枚数だけ無駄なく生産すれば、コストの削減に繋がります。浮いたコストの分だけ価格を下げ、予約注文だけの「特別価格」で商品を提供できのです。</p>
                                <div class="bottom-line">                                    
                                    <a href="#products" class="btn btn-lg btn-default" style="visibility: visible; font-size: 0.8em;">商品ページ</a>
                                </div>
                                <!--a href="<?php //echo $help_url;?>/#tracking" class="btn btn-lg btn-default" style="visibility: visible; font-size: 0.8em;">商品ページ</a-->
			</div>      
                        <div class="clearfix visible-xs"></div>
                        <div class="clearfix visible-sm"></div>
                        <div class="clearfix visible-md"></div>
			<div class="asset-item wow fadeInRight col-xs-6 col-sm-4 col-md-4 col-lg-4" data-wow-delay="0.9s">
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
                        <div class="clearfix visible-xs"></div>                        
                        <div class="asset-item wow fadeInRight col-xs-6 col-sm-4 col-md-4 col-lg-4" data-wow-delay="0.9s">
				<i class="fa">
                                    <img style="width: 1em;" src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/icon/tracking-order.png"></img>
                                </i>   
				<h5>商品の生産状況からお届け予定まで、サイト上で常に確認可能。</h5>
				<h4>TRAKING SYSTEM OF YOUR ORDER</h4>
				<p>商品の注文後、当サイトにログイン→「MY ORDER」ページにて、商品の生産状況やお届け予定日をいつでもお好きな時に確認できます。</p>
                                <div class="bottom-line">
                                    <a href="<?php echo Theme_My_Login::get_page_link( 'register' ); ?>" class="btn btn-lg btn-default" style="visibility: visible; font-size: 0.8em;">ログイン・登録フォーム</a>
                                </div>
			</div>
		</div>
	</div>
</section>


<!-- =========================
    VIDEO SECTION   
============================== -->
<section id="video" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="wow fadeInUp col-md-6 col-sm-10" data-wow-delay="1.3s" style="text-align: center;letter-spacing: 6px;">
				<h3 style="margin-top: 16%;">Video - Collection</h3>
				<h3>A/W 2018-19</h3>				
			</div>
			<div class="wow fadeInUp col-md-6 col-sm-10" data-wow-delay="1.6s">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/XdMXlHwCBQM" allowfullscreen></iframe>
				</div>
			</div>

		</div>
	</div>
</section>


<!-- =========================
    PRODUCTS SECTION       
============================== -->
<?php include('product-section.php') ?>
<!-- =========================
    WORKSHOP SECTION   
//include('workshop-section.php') 
============================== -->
<!-- =========================
    MATERIALS SECTION   
//include('materials-section.php') 
============================== --> 
<!-- =========================
   Map of resellers
//include 'reseller-map.php';
============================== --> 

<!-- =========================
   REGISTER SECTION   
============================== -->

<section id="register" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="wow fadeInUp col-md-5 col-sm-5" data-wow-delay="0.6s">
				<h3 style="font-weight: 0;">今すぐ会員登録！</h3>				
				<h5>このサイトのネットショッピングは、会員登録制です。こちらの登録フォームから簡単＆無料で登録できます。</h5>
                                <h5>プライバシーポリシー</h5>
			</div>

			<div class="wow fadeInUp col-md-7 col-sm-7" data-wow-delay="1s">
                            <div class="steps" id="steps">
                                    <?php
		
		//nm_wpregistration_register_url
		//print_r(get_option('nm_wpregistration_settings'));
                $theme_my_login = Theme_My_Login::get_object();
                $instance = $theme_my_login->get_active_instance();
                echo $instance->display('register');
                //echo get_option('nm_wpregistration_register_url');
            //echo $nm_wpregistration->get_option('_register_url');
                    ?>
                        </div>
			</div>

			<div class="col-md-1"></div>

		</div>
	</div>
</section>

<script>
    jQuery( document ).ready( function() {
        $( document ).on( 'click', '#register-form-submit' , function(e) {
            var register_url='<?php
		
		//nm_wpregistration_register_url
		//print_r(get_option('nm_wpregistration_settings'));
                $theme_my_login = Theme_My_Login::get_object();
                $instance = $theme_my_login->get_active_instance();
                echo $instance->get_action_url('register');
                //echo get_option('nm_wpregistration_register_url');
            //echo $nm_wpregistration->get_option('_register_url');
                    ?>';
                            
            e.preventDefault();            
        });
    });
</script>
<!-- =========================
    FAQ SECTION   
============================== -->
<!--section id="faq" class="parallax-section">
	<div class="container">
		<div class="row">

			<!-- Section title
			================================================== 
			<div class="wow bounceIn col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10 text-center">
				<div class="section-title">
					<h2>Do you have Questions?</h2>
					<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
				</div>
			</div>

			<div class="wow fadeInUp col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10" data-wow-delay="0.9s">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  					<div class="panel panel-default">
   						<div class="panel-heading" role="tab" id="headingOne">
      						<h4 class="panel-title">
        						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          							 What is Responsive Design?
        						</a>
      						</h4>
    					</div>
   						<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      						<div class="panel-body">
        						<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet, wisi risus purus augue vulputate voluptate neque, curabitur dolor libero sodales vitae elit massa. Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
								<p>Nunc eu nibh vel augue mollis tincidunt id efficitur tortor. Sed pulvinar est sit amet tellus iaculis hendrerit. Mauris justo erat, rhoncus in arcu at, scelerisque tempor erat.</p>
      						</div>
   						 </div>
 					</div>

    				<div class="panel panel-default">
   						<div class="panel-heading" role="tab" id="headingTwo">
      						<h4 class="panel-title">
        						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          							What are latest UX Developments?
        						</a>
      						</h4>
    					</div>
   						<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      						<div class="panel-body">
                            	<p>Nunc eu nibh vel augue mollis tincidunt id efficitur tortor. Sed pulvinar est sit amet tellus iaculis hendrerit. Mauris justo erat, rhoncus in arcu at, scelerisque tempor erat.</p>
        						<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet, wisi risus purus augue vulputate voluptate neque, curabitur dolor libero sodales vitae elit massa. Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
      						</div>
   						 </div>
 					</div>

 					<div class="panel panel-default">
   						<div class="panel-heading" role="tab" id="headingThree">
      						<h4 class="panel-title">
        						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          							What things about Social Media will be discussed?
        						</a>
      						</h4>
    					</div>
   						<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      						<div class="panel-body">
                            	<p>Aenean vulputate finibus justo et feugiat. Ut turpis lacus, dapibus quis justo id, porttitor tempor justo. Quisque ut libero sapien. Integer tellus nisl, efficitur sed dolor at, vehicula finibus massa.</p>
        						<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet, wisi risus purus augue vulputate voluptate neque, curabitur dolor libero sodales vitae elit massa. Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
      						</div>
   						 </div>
 					 </div>

 				 </div>
			</div>

		</div>
	</div>
</section>



<!-- =========================
    VENUE SECTION   
============================== -->
<!--section id="venue" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="wow fadeInLeft col-md-offset-1 col-md-5 col-sm-8" data-wow-delay="0.9s">
				<h2>Venue</h2>
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Dolore magna aliquam erat volutpat.</p>
				<h4>New Event</h4>
  				<h4>120 Market Street, Suite 110</h4>
  				<h4>San Francisco, CA 10110</h4>
				<h4>Tel: 010-020-0120</h4>		
			</div>

		</div>
	</div>
</section-->

<!-- =========================
    VIDEO SECTION   
============================== -->
<section id="pro" class="parallax-section">
	<div class="container">
		<div class="row" style="font-family: TestFont;">
                    
                  <!-- Section title
			================================================== 
                  -->
			<div class="wow bounceIn col-md-10 col-sm-offset-1 col-sm-10 text-center" style="font-weight: 200;margin-top: 3em;">
				<div class="section-title">
					<h2>For Professional Buyers - 事業者（法人 & 個人）の皆様へ</h2>
					<h3>— 卸販売のご案内 —</h3>
				</div>
			</div>  

 

			<div class="wow fadeInUp col-md-6 col-sm-10" data-wow-delay="1.3s" >
				<p style="text-align: center;letter-spacing: 3px;margin-bottom: 2em; 
    font-size: 1.4em;">一枚から卸価格にてご購入可能。<br>
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
			<div class="wow fadeInUp col-md-6 col-sm-10" data-wow-delay="1.6s">
				
					<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/homepage/apro.jpg">
				
			</div>

		</div>
	</div>
</section>


<!-- Back top -->
<a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>



	</div>
</div><!-- #post-## -->
