<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Hook Woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
//do_action( 'woocommerce_before_single_product' );
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();
$workshop_id = get_post_meta( $product->get_id(), 'product_workshop_id' , true);
if(isset($attachment_ids[1]))
    $image = wp_get_attachment_url( $attachment_ids[1] );
    $main_image = get_post_thumbnail_id( $product->get_id() );
    $product_image = wp_get_attachment_image_src($main_image , 'large' );
?>


<style>
    #page .col-full {
        padding: 0;
    }
    .parallax-window {
        max-height: 30em;
        overflow: hidden;
        position: relative;
        text-align: center;
        width: 100%;
    }

    .parallax-static-content {
        color: #9A9A8A;
        padding: 9em 0;
        position: relative;
        z-index: 9;
    }

    .parallax-background {        
        background-position: top;
        background-size: cover;
        background-color: beige;
        height: 60em;
        left: 0;
        position: absolute;
        top: - 30em / 3;
        width: 100%;
    }
    
    .parallax-section {
        width: 100%;
    }
</style>



	<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		//do_action( 'woocommerce_after_single_product_summary' );
	?>
    
    <!--
    =========================
        WORKSHOP SECTION   
    ============================== 
    -->
    <?php 
        $workshop_post = get_post($workshop_id);
        $wallpaper = get_post_meta( $workshop_id, 'second_featured_image',true);
        $mainfeatureimage = get_post_meta( $workshop_id, 'third_featured_image', true);
        
    ?>
    <style>
        #sect-workshop {
            background: url(<?php echo wp_get_attachment_image_src( $wallpaper, 'large' )[0]; ?>) 50% 0 repeat-y fixed;
            -webkit-background-size: cover;
            background-size: cover;
            background-position: center center;
            color: #ffffff;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        
        .device-ios .parallax-section , 
        .device-android .parallax-section {
            background-attachment: unset!important;
        }
        #product-intro  {
            width: 100%;            
            background: url(<?php echo $product_image[0] ?  $product_image[0] : ''; ?>) 50% 0 repeat-y fixed;
            background-size: fixed;
            background-position-y: <?php 
                $image_metas_y = get_post_meta( $main_image, 'focus_position_y', true );
                if($image_metas_y != "") {
                    echo "$image_metas_y%";
                }
                else {
                    echo 'center';
                }
            ?>;
            background-position-x: <?php
                $image_metas_x = get_post_meta( $main_image, 'focus_position_x', true );
                if($image_metas_x != "") {
                    echo "$image_metas_x%";
                }
                else {
                    echo 'center';
                }
            ?>;
            color: #ffffff;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            height: 100vh;            
            text-align: center;
        }
        .go-top {
            bottom: 5em;
        }
        
        .product-description {
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
        div.modal-product-details.product .images {
            margin-top: 20px;
        }
        
        div.modal-product-details.product .woocommerce-product-gallery__image {
            width:100%;
        }
        
        .modal .modal-header .modal-close {
            position: relative;              
            top:0;
            right:0;
        }
        
        .modal .modal-header #btn-modal-back {            
            font-size: 1.5em;
            cursor: pointer;
        }
        
        .modal .modal-header {
            padding-bottom: 0;
        }
        
        .modal .modal-header #modal-title {
            flex-grow: 1;
            width: 100%;
        }
        
        .nav.modal-header > li > a.marker-narrow {
            display:none;
        }
        .nav.modal-header > li > a {
            margin:0;
        }
        
        @media screen and (min-width: 1024px) {
            div.modal-product-details.product .woocommerce-product-gallery__image {
                width:50%;
                padding: 2em;
            }
        }
        
        @media screen and (max-width: 760px) {
            #product-intro h3 , 
            #modal-reservation h3 {
                line-height: 36px;
                font-size: 19px;
            }            
            #modal-reservation .product-description {
                width: 100%;                
            }
            #modal-reservation .product-description small {
                font-size: 70%;
            }
            
            .nav.modal-header {
                margin: 0;
                display: flex;
                justify-content: space-between;
            }
            
            .nav.modal-header > li {
                font-size: 0.9em;
                text-align: center;
            }
            
            .nav.modal-header > li > a {
                padding: 11px;
            }
        }
        
        @media screen and (max-width: 450px) {
            .nav.modal-header > li {
                font-size: 0.8em;            
            }
            
            .nav.modal-header > li > a {
                padding: 9px;
                height: 5em;
            }
            
            .nav.modal-header > li > a.marker-narrow {
                display:block;
                padding: 5px;
            }
            .nav.modal-header > li > a.marker-large {
                display:none;
            }              
                
        }
        
        #price-field .woocommerce-Price-amount.amount ,
        #price-field small
        {
            display: block;
            line-height: 20px;
        }
        
        .modal-inner .nav-pills>li.active>a, 
        .modal-inner .nav-pills>li.active>a:focus, 
        .modal-inner .nav-pills>li.active>a:hover {
            background: #b7b7b7;
            border-color: transparent;
        }
        
    </style>
    <!-- =========================
    INTRO SECTION   
============================== -->
<section id="product-intro" class="parallax-section img-lazy-load" data-full-src="<?php echo wp_get_attachment_image_src( $main_image, 'full')[0];?>">
	<div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12">
				<h3 class="wow bounceIn" data-wow-delay="0.9s"><?php echo $product->get_title(); ?></h3>				
                                <a href="#gallery" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="2.3s">Photo Gallery<br>ギャラリー</a>
				<a href="#story" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="2.3s">Story<br>この服のおはなし</a>                                
                                <a id="reservation" class="btn btn-lg btn-danger smoothScroll wow fadeInUp btn-reservation" data-wow-delay="2.3s">Price & Details<br>購入ページ</a>
                                
			</div>


		</div>
	</div>
</section>
<section id="product-in-short" class="">
    <h4 style="margin:2em;" ><?php echo $product->get_data()['short_description']; ?></h4>    
</section>
    <div class="refills-components">
        
<div id="modal-reservation" class="modal">
    <input class="modal-state" id="modal-1" type="checkbox" />
    
    <div class="modal-fade-screen">
        <div class="modal-inner">
            <div style="position:relative;">
        <div class="modal-close" for="modal-1" style="top:0;right:0;"></div> 
        </div>
        <!--div class="modal-header">  </div-->  
            <!-- Nav tabs -->
            <ul class="nav modal-header nav-pills nav-justified" role="tablist" style="margin:0;">
              <li role="presentation" class="active">
                  <a id="btn-tab-product-details" class="marker-narrow" href="#wc-product-details" aria-controls="wc-product-details" role="tab" data-toggle="tab">商品詳細<br>・<br>購入</a>
                  <a id="btn-tab-product-details" class="marker-large" href="#wc-product-details" aria-controls="wc-product-details" role="tab" data-toggle="tab">商品詳細・購入</a>
              </li>
              <li role="presentation">
                  <a id="btn-tab-size-info" class="marker-narrow" href="#wc-size-info" aria-controls="wc-size-info" role="tab" data-toggle="tab">サイズ<br>・<br>素材</a>
                  <a id="btn-tab-size-info" class="marker-large" href="#wc-size-info" aria-controls="wc-size-info" role="tab" data-toggle="tab">サイズ・素材</a>
              </li>
              <li role="presentation">
                  <a id="btn-tab-size-guide" class="marker-narrow" href="#wc-size-guide" aria-controls="wc-size-guide" role="tab" data-toggle="tab">サイズ<br>ガイド</a>
                  <a id="btn-tab-size-guide" class="marker-large" href="#wc-size-guide" aria-controls="wc-size-guide" role="tab" data-toggle="tab">サイズガイド</a>                  
              </li>    
            </ul>
            
        
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="wc-product-details">
                <div class="modal-product-details product">
                  <div class="images" style="display:flex;flex-wrap: wrap;width: 100%;">
                      <div class="woocommerce-product-gallery__image" style="">
                          <!--img class="wp-post-image"></img-->

                               <div id="product-carousel" class="fadeOut owl-carousel owl-theme">
                                   <?php 
                                      $attachment_ids = $product->get_gallery_image_ids();
                                      foreach($attachment_ids as $attachment_id) {

                                          $image_attachment = wp_get_attachment_image_src( $attachment_id , 'medium');  
                                          $image_full_attachment = wp_get_attachment_image_src( $attachment_id , 'large');  
                                          echo '<div class="item">
                                                  <img class="img-lazy-load" data-full-src="'. $image_full_attachment[0] . '" src="'. $image_attachment[0] . '" />
                                              </div>';
                                      }                                    
                                   ?>

                      </div>
                           <script>

                              jQuery('#product-carousel').owlCarousel({
                                  animateOut: 'slideOutDown',
                                  animateIn: 'flipInX',
                                  items:1,
                                  margin:30,
                                  stagePadding:30,
                                  smartSpeed:450,
                                  loop:true,
                                  autoplay:true,
                                  autoplayTimeout:1000,
                                  autoplayHoverPause:true
                              });

                      </script>
                  </div>
                  <div class="product-description">
                      <?php do_action( 'woocommerce_single_product_summary' ); ?>
                  </div>
              </div>
          </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="wc-size-info">
            <?php    
            global $post;
                $text = get_post_meta(  $post->ID, 'wc_size_details', true);
                if( $text && $text != "" ) {
                    $text_guide = get_post_meta(  $post->ID, 'wc_size_guide', true);   
            ?>                
                <div id="wc_size_details" style="margin-left: auto; overflow-x: auto;
                    margin-right: auto;"> 
                <div><?php echo $text; ?></div> 
                </div>
            <?php 
            }
            ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="wc-size-guide">
              <?php  
                $text = get_post_meta(  $post->ID, 'wc_size_guide', true);
                if( $text && $text != "" ) {                    
                ?>
    <!--a id="btn_size_guide" class="icon-sizing" data-featherlight="#size-guide-modal" style="cursor:pointer;"><span>Sizing Guide</span></a-->   
                    <div id="wc_size_guide" style="margin-left: auto; overflow-x: auto;
                        margin-right: auto;"> <?php echo $text; ?> </div>
                <?php }
                ?>
            </div>
        </div>

      </div>
            <!--div class="" id="btn-modal-back" style="display:none;">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" width="15px" height="15px" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path d="M256 504C119 504 8 393 8 256S119 8 256 8s248 111 248 248-111 248-248 248zm116-292H256v-70.9c0-10.7-13-16.1-20.5-8.5L121.2 247.5c-4.7 4.7-4.7 12.2 0 16.9l114.3 114.9c7.6 7.6 20.5 2.2 20.5-8.5V300h116c6.6 0 12-5.4 12-12v-64c0-6.6-5.4-12-12-12z" fill="#626262"/></svg>
            </div-->
            <!--h5 id="modal-title">
            </h5-->
            
        </div>
        
      
    </div>
</div>
<!-- =========================
        NAV BAR
    ============================== -->
<div class="container-11-189" data-reactid="90">
    <div class="limitWidth-11-191" data-reactid="91">
        <div class="leftContent-11-193" data-reactid="92">
            <div class="title-11-192" data-reactid="93"><?php 
            global $product;
            echo str_replace("|","<br>",$product->get_title());?></div>
            <div class="linkContainer-11-195">
                <a class="sectionLink-11-196" href="#gallery">Photo Gallery<br>ギャラリー</a>
                <a class="sectionLink-11-196" href="#story">Story<br>この服のおはなし</a>                
            </div>                  
        </div><!-- react-text: 99 --><!-- /react-text -->
        <div id="reservation" class="container-15-202" >            
            <a class="btn btn-lg btn-danger btn-reservation" >Price & Details<br>購入ページ</a>            
        </div> 
    </div>
</div>

<div class="container-11-190 navbar navbar-hide-top navbar-fixed-bottom" data-reactid="90" style="display:none;">
    <div class="limitWidth-11-192" data-reactid="91">
        <!-- react-text: 99 --><!-- /react-text -->
        <div id="reservation" class="container-15-202">            
            <a class="btn btn-lg btn-danger btn-reservation" style="">購入ページ</a>            
        </div> 
    </div>
</div>
    <!-- =========================
        IMAGE SECTION   
    ============================== -->
    <section id="gallery" class="parallax-section">
            <div class="container">
                    <div class="row" id="parent-am-container-img">
                        <div id="am-container" class="">
                            <?php
                                $attachment_ids = $product->get_gallery_image_ids();
                                $idx=0;
                                $buffer_cell = array();
                                $lg_used_col = 0;
                                $md_used_col = 0;
                                $sm_used_col = 0;
                                $idx=0;
                                
                                while ( count($attachment_ids) || count($buffer_cell)) {
                                    $attachment_id = null;
                                    $image_attachment_url = null;
                                    $image_full_attachment_src = null;
                                    $width = 0;
                                    $height = 0;
                                    if(count($attachment_ids)) {
                                        $attachment_id = array_shift($attachment_ids);     
                                        $image_meta = wp_get_attachment_image_src($attachment_id,'large');
                                        $width = $image_meta[1];
                                        $height = $image_meta[2];
                                        $image_attachment_url = $image_meta[0];
                                        $image_full_attachment_src = wp_get_attachment_image_src($attachment_id,'full');
                                    } 
                                    
                                    if( ( $width > $height || count($buffer_cell) ) && $lg_used_col <= 6 && $md_used_col <= 4 && $sm_used_col <= 0)  {                                        
                                        if(!count($buffer_cell) && $width > $height) {
                                            echo '<div href="'. $image_full_attachment_src[0] .'" class="wow fadeInUp col-lg-6 col-md-8 col-sm-12 col-xs-12" data-wow-delay="0.3s" data-lightbox="roadtrip" style="cursor:pointer;">
                                                <img data-parent-id="parent-am-container-img" data-full-src="'. $image_full_attachment_src[0] . '"  src="' . $image_attachment_url . '" class="img-responsive img-lazy-load" alt="sponsors">	
                                                <div class="overlay" style="opacity: 0.9; display:none;"></div>
                                                </div>';
                                            $lg_used_col += 6;
                                            $md_used_col += 8;
                                            $sm_used_col += 12;
                                        }else if(count($buffer_cell)) {
                                            $cell = array_shift ( $buffer_cell );
                                            echo $cell;
                                            $lg_used_col += 6;
                                            $md_used_col += 8;
                                            $sm_used_col += 12;
                                        }                            
                                        else if ($width > $height) {
                                            $buffer_cell[] = '<div href="'. $image_full_attachment_src[0] .'" class="wow fadeInUp col-lg-6 col-md-8 col-sm-12 col-xs-12" data-wow-delay="0.3s" data-lightbox="roadtrip" style="cursor:pointer;">
                                            <img data-parent-id="parent-am-container-img" data-full-src="'. $image_full_attachment_src[0] . '" src="' . $image_attachment_url . '" class="img-responsive img-lazy-load" alt="sponsors">	
                                                <div class="overlay" style="opacity: 0.9; display:none;"></div>
                                                </div>';                                            
                                        }
                                        
                                    }
                                    else if ($width > $height && $image_attachment_url != null) {
                                        $buffer_cell[] = '<div href="'. $image_full_attachment_src[0] .'" class="wow fadeInUp col-lg-6 col-md-8 col-sm-12 col-xs-12" data-wow-delay="0.3s" data-lightbox="roadtrip" style="cursor:pointer;">
                                        <img data-parent-id="parent-am-container-img" data-full-src="'. $image_full_attachment_src[0] . '" src="' . $image_attachment_url . '" class="img-responsive img-lazy-load" alt="sponsors">	
                                            <div class="overlay" style="opacity: 0.9; display:none;"></div>
                                            </div>';                                  
                                    }
                                    //$image_url = wp_get_attachment_image_src( $image_attachment_id );
                                    else if ($width <= $height){
                                        echo '<div href="'. $image_full_attachment_src[0] .'" class="wow fadeInUp col-lg-3 col-md-4 col-sm-6 col-xs-6" data-wow-delay="0.3s" data-lightbox="roadtrip" style="cursor:pointer;">
                                        <img data-parent-id="parent-am-container-img" data-full-src="'. $image_full_attachment_src[0] . '" src="' . $image_attachment_url . '" class="img-responsive img-lazy-load" alt="sponsors">	
                                            <div class="overlay" style="opacity: 0.9; display:none;"></div>				   
                                        </div>';
                                        $lg_used_col += 3;
                                        $md_used_col += 4;
                                        $sm_used_col += 6;
                                    }
                                    if(!count($attachment_ids) && ($lg_used_col >= 9 ) ) {
                                       $lg_used_col = 12;
                                    }
                                    if(!count($attachment_ids) && ($md_used_col >= 8 ) ) {
                                       $md_used_col = 12;
                                    }
                                    if(!count($attachment_ids) && ($sm_used_col >= 6 ) ) {
                                       $sm_used_col = 12;
                                    }
                                    
                                    /*echo '$attachment_ids: ' . count($attachment_ids);
                                    echo '$buffer_cell: ' . count($buffer_cell);
                                    echo '$lg_used_col: ' . $lg_used_col;
                                    echo '$md_used_col: ' . $md_used_col;
                                    echo '$sm_used_col: ' . $sm_used_col;*/
                                    
                                        
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
                                                                            
                                    //break;
                                }
                            ?>
                            </div>
                            

                            <!--div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.6s">
                                    <img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img2.jpg" class="img-responsive" alt="sponsors">	
                            </div>

                            <div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.9s">
                                    <img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img3.jpg" class="img-responsive" alt="sponsors">	
                            </div>

                            <div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="1s">
                                    <img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img4.jpg" class="img-responsive" alt="sponsors">	
                            </div-->

                    </div>
            </div>
    </section>
    <!-- =========================
        Awesome SECTIONS   
    ============================== -->
    <section id="story">
    </section>
        
    <?php
    $data = get_post_meta( $post->ID, 'wc_awesome_descriptions', true );
    if(is_array($data)) {
        foreach ($data as $key => $item) { 
            //select template ?

            $awesome_value = isset($item['text']) ? $item['text'] : '';
            $meta_key = isset($item['media_id']) ? $item['media_id'] : '';
            $media_1 = isset($item['media_1']) ? $item['media_1'] : '';
            $media_2 = isset($item['media_2']) ? $item['media_2'] : '';
            $title = isset($item['title']) ? $item['title'] : '';
            $text_pos = isset($item['text_pos']) ? $item['text_pos'] : '';
            $text_color = isset($item['text_color']) ? $item['text_color'] : '';
            $text_left = isset($item['text_left']) ? $item['text_left'] : '';
            $text_right = isset($item['text_right']) ? $item['text_right'] : '';
            if (isset($item['template_type']) && $item['template_type'] == "two-pans") {
                include('single-product/view/two-pans.php');
            } else  {          
                include('single-product/view/parallax.php');
            }        
        }
    }
    ?>
    
    <!-- =========================
        Details SECTION   
    ============================== -->
    <!--section id="overview" class="parallax-section">
            <div class="container">
                    <div class="row">

                            <div class="wow bounceIn col-md-12 col-sm-12">
                                <div class="section-title">
                                    <h2>Details</h2>
                                </div>
                            </div>
                            <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.6s">
                                    
                                    <?php
                                    //<h3>New Event is a fully responsive one-page template for events, conferences or workshops.</h3>
                                    //$postid = the_ID();
                                    //get_the_title($workshop_id);
                                    //print_r($product->get_data()['description']);
                                     //$product_details;;
                                    ?>
                                    
                            </div>
                            <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.6s">
                                    
                                    <?php
                                    // DISPLAY STAMP
                                    //<h3>New Event is a fully responsive one-page template for events, conferences or workshops.</h3>
                                    //$postid = the_ID();
                                    //get_the_title($workshop_id);
                                    //include 'wc-stamps-single-product.php';
                                     //$product_details;;
                                    ?>
                                    
                            </div>


                    </div>
            </div>
    </section-->
    <!-- =========================
        WORKSHOP SECTION   
    ============================== -->
    <!--section id="sect-workshop" class="parallax-section">
            <div class="container">
                    <div class="row">

                            <div class="wow bounceIn col-md-12 col-sm-12">
                                <div class="section-title">
                                    <h2>Workshop</h2>
                                </div>
                            </div>
                            <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.6s">
                                    
                                    <?php
                                    //<h3>New Event is a fully responsive one-page template for events, conferences or workshops.</h3>
                                    //$postid = the_ID();
                                    //get_the_title($workshop_id);
                              
                                    /*$workshop_post = get_post($workshop_id);
                                    echo '<h3>' . $workshop_post->post_title . '</h3>';
                                    echo '<p>' . $workshop_post->post_content . '</p>';
                                    $wallpaper = get_post_meta( $workshop_id, 'second_featured_image',true);
                                    $mainfeatureimage = get_post_meta( $workshop_id, 'third_featured_image', true);
                                    
                                    $wallpaper_url = wp_get_attachment_image_src( $wallpaper , 'large');
                                    $image_url = wp_get_attachment_image_src( $mainfeatureimage , 'large');
                                    
                                    $data = get_post_meta( $workshop_id, 'gmp_arr', true );
                                    $title = get_the_title($workshop_id);
                                    $address1 = $data['gmp_address1'];
                                    $city = $data['gmp_city'];
                                    $state = $data['gmp_state'];
                                    $zip = $data['gmp_zip'];


                                    $address = '';
                                    $address .=  $title;
                                    $address .= "<br>";
                                    $address .=  $address1;
                                    $address .= " ";
                                    $address .=  $city;
                                    $address .= "<br>";
                                    $address .=  $state;
                                    $address .= "<br>";
                                    $address .=  $zip;
                                    $address .= "<br>";
                                    echo '<p>' . $address . '</p>';
                                    
                                    //print_r($post);
                                    //$workshop_id = get_post_meta( $product->get_id(), 'product_workshop_id' , true);
                                    //echo $workshop_id;
                                    //$title = get_the_title($workshop_id);
                                    //<p>This is a Bootstrap v3.3.6 layout that is responsive and mobile friendly. You may download and modify this template for your website. Please tell your friends about templatemo.</p>
                                    //<p>Quisque facilisis scelerisque venenatis. Nam vulputate ultricies luctus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
                                   */ ?>
                                    
                            </div>

                            <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.9s">
                                    <img src="<?php //echo $image_url[0]?>" class="img-responsive" alt="Overview">
                            </div>

                    </div>
            </div>
    </section!-->
    
    <!-- =========================
    PRODUCTS SECTION   
============================== -->
    <?php //include('single-product/view/fabrics.php'); ?>


    <!-- Back top -->
    <!--a href="#back-top" class="go-top navbar">
        <svg width="40px" height="40px" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1395 1184q0 13-10 23l-50 50q-10 10-23 10t-23-10l-393-393-393 393q-10 10-23 10t-23-10l-50-50q-10-10-10-23t10-23l466-466q10-10 23-10t23 10l466 466q10 10 10 23z"/></svg>
    </a-->
<!--/div-->
<script>
    (function($) {

var viewer = new Viewer(document.getElementById('am-container'), {toolbar:false, title:false});
// leave preview if click outside box: 
var RectContains = function (Ax,w,Ay,h,x, y) {
    console.log('Ax: ' + Ax);
    console.log('w: ' + w);
    console.log('Ay: ' + Ay);
    console.log('h: ' + h);
    console.log('x: ' + x);
    console.log('y: ' + y);
    return Ax <= x && x <= Ax + w &&
        Ay <= y && y <= Ay + h;    
}
$('#am-container').on('shown',function(){
    console.log('shown!');
    $('.viewer-container .viewer-canvas').click(function(evt) {
        console.log(evt);
        Ay = $('.viewer-container .viewer-canvas img')[0].offsetTop;
        h = $('.viewer-container .viewer-canvas img')[0].offsetHeight;        
        Ax= $('.viewer-container .viewer-canvas img')[0].offsetLeft;
        w = $('.viewer-container .viewer-canvas img')[0].offsetWidth;
        x = evt.clientX;
        y = evt.clientY;
        if(!RectContains(Ax,w,Ay,h,x,y)){
            viewer.hide();
        }
    })
});

$(document).on('click', '#reservation', function(){     
    $('#modal-reservation').addClass('modal-open');   
    $(document.body).css('overflow-y','hidden');
});

$(document).on('click', '#btn-size-info', function(){     
    $('#modal-reservation').addClass('modal-open'); 
    $('#btn-tab-size-info').click();
    $(document.body).css('overflow-y','hidden');
});

$(document).on('click','#modal-reservation .modal-close' ,function(){ 
 $('#modal-reservation').removeClass('modal-open'); 
 $(document.body).css('overflow-y','scroll');
});

}(jQuery));
</script>
    
<style>
    .col-full .woocommerce {
        position: absolute;
        right: 0;
        z-index: 20000;
    }
    
    .container-11-189 {
            width: 100%;
            color: white;
            z-index: 50;            
            font-family: Roboto;
            background-color: black;
            display: none;
    }
    
    .container-11-190 {
        width: 100%;
        color: white;
        z-index: 50;    
        font-size: 1.3em;
        background-color: black;
        position: fixed;
        bottom: 0;
    }
    
    .container {
        width: 100%;
    }
    
    .sectionLink-11-196 {
        color: white;
        font-size: 18px;
        line-height: 1.75;
        font-weight: 300;
        letter-spacing: 0.4px;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .sectionLink-11-196:after {
        color: #808080;
        content: "|";
        font-size: 14px;    
        line-height: 30px;

    }
    
    .modal-product-details {
        display:flex;
        flex-wrap: wrap;
    }
    
    .modal-product-details .images {
        flex-grow: 1;
    }
    
    @media screen and (min-width: 1024px) {
        .container-11-189 {            
            position: fixed;
            bottom: 0;
            display:block;
        }
        .container-11-190 {
            position: fixed;
            bottom: 0;
            display:none!important;
        }
        .limitWidth-11-191 {
            display: flex;
        }
        .leftContent-11-193 {
            width: 75%; 
            display: flex; 
            align-items: center;
        }
         .title-11-192 {
            width: 32.3%;
            font-size: 26px;
            font-weight: 300;
            line-height: 1.2rem;
            letter-spacing: .1rem;
        }
        .sectionLink-11-196 {
            display: flex;
        }
        .sectionLink-11-196:after {
            margin-left: 36px; 
            margin-right: 36px;
            display: flex;
        }
        sectionLink-11-196 {
            display:flex;
        }
        .linkContainer-11-195 {
            width: 47.7%;
            flex-grow: 1;
            display: flex;
        }
    }
    .limitWidth-11-191 {
        width: 100%;
        margin: auto;
        padding: 20px;
        max-width: 1596px;
        align-items: center;
        justify-content: space-between;
    }
    
    .limitWidth-11-192 {
        width: 100%;
        margin: auto;
        padding: 5px;        
        align-items: center;
        justify-content: space-between;
    }
    
    .title-11-192 {
        font-size: 20px;
        font-weight: 100;
        line-height: 2.2rem;
        letter-spacing: .1rem;
    }



#content .col-full {
    padding : 0;
}

.modal.modal-open {
  display: block;   
}

.modal.modal-open .modal-fade-screen {    
    visibility: visible;
    opacity: 1;
    padding: 0em;
}

.modal.modal-open .modal-fade-screen .modal-inner {
    width: 90%;
    max-height: 100%;
}

.modal-close {
    z-index: 100;
}
 
div#reservation {
    display: flex;
}

div#reservation .btn {
    margin-top: 0;
    margin-left: auto;
    margin-right: auto;
}
</style>

<?php //do_action( 'woocommerce_after_single_product' ); ?>