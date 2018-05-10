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
}

@media screen and (max-width:768px) {
    #intro h3#homepage-catch-phrase {
        font-size: 1.3em;
    }
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
<!--video id="bgvid" playsinline autoplay muted loop >

<source src="<?php //echo wp_get_attachment_url( $video->ID );?>" type="video/mp4">

</video-->  <!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button  -->
  <script id='custom-homepage' type="text/javascript">
        
       (function($) {

        
    var bgimgs  = new Array();
    var bgFocusX = new Array();
   var bgFocusY = new Array();
                <?php 
 
//$images = get_attached_media('image', $post->ID);
$index = 0;
$gallery = get_post_gallery( get_the_ID(), false );
$images = explode ( ',',$gallery['ids']);

foreach($images as $image) { 
    
    
        $index++;
   $image_attributes_medium = wp_get_attachment_image_src($image,'medium');
   $attachment = get_post( $image );
   $image_attributes_large = wp_get_attachment_image_src($image,'large');
   $image_metas_x = get_post_meta( $image, 'focus_position_x', true );//( $image->ID ); 
   if($image_attributes_medium[0] != "") {
        $value = 'bgimgs.push({'
                . 'medium:"' . $image_attributes_medium[0] . '",'
                . 'large:"' . $image_attributes_large[0] . '",'
                . 'loaded:false,'
                . 'description:"' . preg_replace("/[\n\r]/","", $attachment->post_content) . '"'
                . '});';
        if($image_metas_x != "") {
         $focus_x = "$image_metas_x%";
        }
        else {
         $focus_x = 'right';
        }

        $image_metas_y = get_post_meta( $image, 'focus_position_y', true );
        if($image_metas_y != "") {
         $focus_y = "$image_metas_y%";
        }
        else {
         $focus_y = 'center';
        }

        echo ($value);
        echo "bgFocusX.push(\"$focus_x\");";
        echo "bgFocusY.push(\"$focus_y\");";
   }
   ?>
            
            
    
					
    <?php  } ?>
        
        
        $(window).on("load", function() {


           var idx= 0;
           bgimgs.forEach(function(elem){            
               if ( window.innerWidth < 450 ) {
                   $('#intro').append('<img id="img_lowQuality_' + idx + '" src="' + elem.medium + '" style="display:none;">');
               }else {
                   $('#intro').append('<img id="img_highQuality_' + idx + '" src="' + elem.large + '" style="display:none;">');
               }
               $("#img_highQuality_" + idx).off().on("load", function() {            
                   elem.loaded = true;
               });
               idx++;
           }); 

           var i = 1;
           var changeimage = function () {                
               var bgimg = bgimgs[i].medium;
               if(bgimgs[i].loaded) 
                   bgimg = bgimgs[i].large;
               else if (!bgimgs[i].loaded && window.innerWidth >= 450) {
                   return;
               }
               var description = bgimgs[i].description;

               $("#wrapper_bottom").css("opacity", 0);
               $('#wrapper_bottom').css('background-image','url(' + bgimg + ')');         
               $('#wrapper_bottom').css('background-position-x',bgFocusX[i]);
               $('#wrapper_bottom').css('background-position-y',bgFocusY[i]);

       // Your function
       // TODO: you should declare this outside of this scope
               $('#homepage-catch-phrase').removeClass('fadeInUp');
               $('#homepage-catch-phrase').removeClass('animated');
               $('#homepage-catch-phrase').addClass('fadeOutDown');
               $('#homepage-catch-phrase').fadeOut(2000);
               $('#wrapper_bottom')
                   .animate({"opacity": 1}, 2000, function(){
                 //changeImage('#wrapper_top', images[i], 1);
                   //$('#wrapper_top').css('opacity',0);         
                   $('#wrapper_top').css('background-image','url(' + bgimg + ')');         
                   $('#wrapper_top').css('background-position-x',bgFocusX[i]);
                   $('#wrapper_top').css('background-position-y',bgFocusY[i]);
                   $('#homepage-catch-phrase').empty();
                   $('#homepage-catch-phrase').append(description);
                   $('#homepage-catch-phrase').removeClass('animated');
                   $('#homepage-catch-phrase').removeClass('fadeOutDown');
                   $('#homepage-catch-phrase').addClass('fadeInUp');
                   $('#homepage-catch-phrase').fadeIn(1000);

                   //.animate({"opacity": 1}, 500, function(){                    
                       if (++i >= bgimgs.length) { i = 0; } 
                       $("#wrapper_bottom").css("opacity", 0);
                       $('#wrapper_bottom').css('background-image','url(' + bgimg + ')');         
                       $('#wrapper_bottom').css('background-position-x',bgFocusX[i]);
                       $('#wrapper_bottom').css('background-position-y',bgFocusY[i]);
                  // });

                 //changeImage('#wrapper_bottom', images[i]);



             });





           };
           window.setInterval(changeimage, 6000);
   });    

    
    }(jQuery));
</script>
        
        <div id="wrapper_top" class="background-img" style="            
            z-index: 0;
            background-image: url('<?php echo wp_get_attachment_image_src($images[0],'large')[0]; ?>');
            background-position-x: <?php echo get_post_meta( $images[0], 'focus_position_x', true )?>%;
            background-position-y: <?php echo get_post_meta( $images[0], 'focus_position_y', true )?>%;
            ">            
            <div id='wrapper_bottom'  class="background-img" style=" z-index: -1;
            top: 0;
            height: 100%;
            position: absolute;
            width: 100%;">
                

            </div>
        </div>  
    
            
            <?php 
 
/*$images = get_attached_media('image', $post->ID);
$index = 0;

foreach($images as $image) { 
    
    if($index == 0) {
        $index++;
   $image_attributes = wp_get_attachment_image_src($image->ID,'large');
   //<img class="bgimgs" src="<?php echo $image_attributes[0]
     //<img class="bgimgs portrait" src="<?php echo $image_attributes[0]
 
   } }
 * * 
 */?>
 

	<div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12">
                            <h3 class="wow fadeInUp" id="homepage-catch-phrase">
                                <?php  
                                ///print_r($images);
                                $attachment = get_post( $images[0] );
                                echo $attachment->post_content;
                                
                                 ?>
                            </h3>
                            <a href="#overview" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="2.3s">アトリエのこと</a>
				<?php if (!is_user_logged_in()) { ?>
                                    <a href="#register" class="btn btn-lg btn-danger smoothScroll wow fadeInUp hidden-xs" data-wow-delay="2.3s">会員登録</a>
                                <?php } else  { ?>
                                    <a href="#products" class="btn btn-lg btn-danger smoothScroll wow fadeInUp hidden-xs" data-wow-delay="2.3s">商品ページ</a>
                                <?php } ?>
				<!--div class="wow welcome-text-container" data-wow-delay="0.9s" style="position:relative;" >                                       
                                    
                                    <!--div class="welcome-text" style="display:flex;position:  absolute;left: 0;height:100%;">
                                    <p class="desc-left" style="">
							アトリエブルジョン。
                                    </p>                    <span>atelier Bourgeons</span>
                                    <p class="desc-wider">両方からお洒落するレディースブランド<br>
                                    </p>
                                    </div-->
                                    <!--div class="welcome-text welcome-buttons" style="padding-top: 33%;
    width: 50%;
    margin-left: auto;
    margin-right: auto;"> 
                                </div>
                                    <!--div class="welcome-text welcome-text-right" style="position: absolute;right: 0; top:0;overflow: hidden;height:100%;  /*margin-right: 2em;*/">
                                    <p class="desc-wider-right" style="">「デザイン」 と 「ものづくりの背景」
                                    <br>                                    
                                    －外身も中身も、かっこよく。－
                                    		</p>
                                        </div-->
                                <!--/div><!--h1 class="wow fadeInUp" data-wow-delay="1.6s"><?php //echo get_post_meta( $post->ID , 'Home Page Title', true ); ?></h1-->
				
			</div>


		</div>
	</div>
</section>


<!-- =========================
    OVERVIEW SECTION   
============================== -->
<section id="overview" class="">
	<div class="container">
		<div class="row" style="">

			<div class="wow fadeInUp col-md-offset-0 col-sm-offset-1 col-xs-offset-1 col-md-6 col-sm-10 col-xs-10 col-lg-6" data-wow-delay="0.6s" style="text-align: center;">                            
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
					
			<div class="wow fadeInUp col-md-offset-0 col-md-6 col-sm-offset-1 col-xs-offset-1 col-sm-10 col-xs-10 col-lg-6" data-wow-delay="0.9s" style="padding-top:2em;">                            
                            <img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/homepage/concept.jpg">
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
                                <h4>PRIVACY POLICY & SECURE PAYMENT</h4>
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
				<p>予め注文を受けた枚数を生産し、余分な在庫やコストを減らすことで、良心的な価格設定が可能になります。そのため、当サイトにて予約注文していただく個人のお客様には、先行予約の特別価格で商品をお求めいただけます。</p>
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
				<h4>TRACKING SYSTEM OF YOUR ORDER</h4>
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

<?php if(!is_user_logged_in()) { ?>
<section id="register" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="wow fadeInUp col-md-5 col-sm-5" data-wow-delay="0.6s">
				<h3 style="font-weight: 0;">今すぐ会員登録！</h3>				
				<h5>当サイトのウェブショップは、無料会員登録制です。こちらのフォームから簡単にご登録いただけます。</h5>
                                <a href="<?php echo get_permalink(get_option('woocommerce_privacy_policy_page_id')); ?>"><h5>プライバシーポリシー</h5></a>
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
    jQuery( document ).ready( function($) {
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
<?php } ?>
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
