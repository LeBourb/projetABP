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
            color: #ffffff;
            display: flex;
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
        
        #price-field {
            display: flex;
            font-weight: 700;
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
        
        #variante {
            padding-left: 5%;
            padding-right: 5%;
        }
        
        
        .variante-container {
            /*max-width: 29rem;*/
            margin-left: auto;
            margin-right: auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            height: 100%;
            /*flex-flow: column nowrap;*/
        }
        
        .product-title .tinv-wraper.tinv-wishlist {
            position: absolute;
            right: 0;
        }
        
        acticle.product {
            display: flex;
            flex-wrap: wrap;
        }
        
        #product-carousel {
            height: auto;
        }
         
        #product-carousel .owl-dots {
            position:absolute;
            bottom: 0;
            width: 100%;
        }
        
        #product-carousel .owl-nav {
            position:absolute;
            bottom: 50%;
            width: 100%;
        }
        
        #product-carousel .owl-nav .owl-next {
               float: right;
        }
        
        #product-carousel .owl-nav .owl-prev {
               float: left;
        }
        
        #product-carousel .owl-nav button {
            height: 30px;
            width: 30px;
            border-radius: 35px;
            border: 1px solid rgba(0,0,0,0);
            cursor: pointer;
         
            margin-left: 5px;
            background: rgba(255,255,255,1);
        }
        

        #product-carousel .owl-stage-outer {
            height: 100%;
            width: 100%;
        }

        #product-carousel.owl-carousel .owl-stage {
            /*height: 100%;*/
            width: 100%;
        }

        #product-carousel.owl-carousel .owl-item {
            /*height: 100%;*/
            width: 100%;
           
        }
        #product-carousel.owl-carousel .owl-item img {
            /*height: 100%;*/
            margin-left:auto;
            margin-right:auto;
            width: auto;
            max-height: 100vh;            
        }
                
        @media screen and (max-width: 768px) {        
            
            
        }
        
        .icon-sizing {
            background-image: url(<?php echo get_site_url() . '/wp-content/themes/atelierbourgeonspro/assets/images/sizing.svg'; ?>);
        }
        
        .icon-sizing-guide {
            background-image: url(<?php echo get_site_url() . '/wp-content/themes/atelierbourgeonspro/assets/images/help.svg'; ?>);
        }
        
        #icon-suite .icon-click {
            background-repeat: no-repeat;
            background-position: top center;
            background-size: 29px;
            cursor: pointer;
            display: inline-block;
        }
        
        #icon-suite .icon-click span {
            display: inline-block;
        }
        
        
        #icon-suite .icon-container {
            padding: 4em 1.5em 0;
            text-align: center;
            text-transform: uppercase;
            color: #363636;
            font-size: 1rem;
            font-family: "Avenir Next",Avenir,"HelveticaNeue-Light","Helvetica Neue Light","Helvetica Neue",Helvetica,Arial,"Lucida Grande",sans-serif;
            font-weight: 400;
            font-style: normal;
            letter-spacing: 0.08em;
        }
        
        .product-title {
            text-align: center;
            margin-bottom: 2em;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .product-price {
            display: flex;
            justify-content: center;            
            font-size: 2rem;
        }
        
        .product-price p {
            font-size: 2rem;
        }
        
        .product-price > div {
            display: flex;
            flex-direction: column;            
        }
        
        .product-price .regular {
            margin-left: 2rem;
        }

        
        .product-ctx-nav {
            display: none;
            justify-content: space-between;
            align-items: center;
        }
        
        @media (min-width: 768px) {
            .product-ctx-nav { 
                display: flex;
            }
        }
        
        .product-ctx-nav .woocommerce-breadcrumb {
            margin: 0;
            padding: 2rem;
        }
        
        .product-ctx-nav .prev_next_buttons {
            padding-right: 2.618rem;
        }
        
        
        .alert_container {
            display: block;
            text-align: center;
        }
        
        .alert_container input {
            border: 3px solid #0f2130;
            margin: 0;
            display: block;
            width: 100%;
            
        }
 
        
        .alert_container button {
            width: 250px;
            background-color: #0f2130;
            color: white;
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            height: 5rem;
        }
        
        .product-add-to-cart .woocommerce-variation-add-to-cart ,
        .product-add-to-cart table tbody td {
            padding: 0;
        }
        
        #featured {
            padding: 0;
        }
        
        @media only screen and (min-width: 1024px) {
            #featured {
                height: 100vh;
                overflow: visible;
            }
        }
        
        @media only screen and (max-width: 1023px) {
            #featured {
                min-height: 78vh;
                margin-bottom: 12px;
            }
        }
    </style>
    <!-- =========================
    INTRO SECTION   
============================== -->
    <!--nav class="product-ctx-nav">
    <?php //do_action( 'woocommerce_before_main_content' );
        /*woocommerce_breadcrumb();
        $new_production_id = wc_get_not_stated_production_item($post->ID);        
        if( $new_production_id  == null ) {        
            echo '<div class="prev_next_buttons">';
                // 'product_cat' will make sure to return next/prev from current category
                    $previous = next_post_link('%link', '&larr; PREVIOUS', TRUE, ' ', 'product_cat');
                $next = previous_post_link('%link', 'NEXT &rarr;', TRUE, ' ', 'product_cat');

                echo $previous;
                echo $next;
                

            echo '</div>';
        }*/

    ?>
    </nav-->
<acticle class="product">
	<section id="featured" class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="">
                           <div id="product-carousel" class="fadeOut owl-carousel owl-theme">
                                   <?php 
                                      $attachment_ids = $product->get_gallery_image_ids();
                                      $i=0;
                                      foreach($attachment_ids as $attachment_id) {
                                          //$image_attachment = wp_get_attachment_image_src( $attachment_id , 'medium');  
                                          //$image_full_attachment = wp_get_attachment_image_src( $attachment_id , 'large');  
                                          //// <div class="img-lazy-load" data-full-src="'. $image_full_attachment[0] . '"  style="width:100%;height:100%;background: url(' . $image_attachment[0] . ') no-repeat center bottom / cover;"></div>
                                          //<div  style="width:100%;height:100%;background: url(' . $image_attachment[0] . ') no-repeat center bottom / cover;" src="' . $image_attachment[0] . '" />
                                          //
                                          echo '<div class="item" style="">
                                                    ' . wp_get_attachment_image( $attachment_id, 1442 , array ( 'woocommerce_gallery_thumbnail', 'woocommerce_thumbnail', 'single_product' ), 0) . '                                                   
                                              </div>';
                                      }                                    
                                   ?>
                      </div>
                           <script>
                                jQuery(document).ready(function(){
                                    jQuery('#product-carousel').owlCarousel({
                                        items:1,
                                        smartSpeed:450,
                                        loop:true,
                                        autoplay:true,
                                        autoplayTimeout:4000,
                                        autoplayHoverPause:true,
                                        nav:true,
                                        animateIn:'fadeIn',
                                        animateOut:'fadeOut',
                                    });
                                });
                      </script>                 

             </section>
            <section id="variante" class="col-xs-12 col-sm-12 col-md-6 col-lg-6">   
                <div class="variante-container">  
                    <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12" style="display: flex;justify-content: center;" >
                        <div style="">
                            <div class="product-title">
                                <?php 
                                    woocommerce_template_single_title();                                                    
                                    if ( method_exists('TInvWL_Public_AddToWishlist', 'instance' ) ) {
                                        echo TInvWL_Public_AddToWishlist::instance()->shortcode();
                                    }
                                ?>
                            </div>
                            <div class="product-price">
                                <?php                 
                                    woocommerce_template_single_price();
                                ?>
                            </div>
                            <div class="product-short-description">
                                <?php
                                    echo $product->get_short_description();   
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-12 col-lg-12" style="display: flex;justify-content: center;" >
                        <div style="max-width:29rem; margin-top: 19px;">
                            <div class="product-add-to-cart">
                                <?php
                                    woocommerce_template_single_add_to_cart();
                                ?>
                            </div>
                            <?php
                                global $WOO_Product_Stock_Alert;
                                $WOO_Product_Stock_Alert->frontend->get_alert_form();
                            ?>
                            <div id="icon-suite">
                               <div class="icon-container">
                                    <div class="icon-click icon-sizing" data-t3featherlight="#size-guide-modal"><span style="padding: 45px 10px 0;">Sizing</span></div>
                                    <div class="icon-click icon-sizing-guide" data-t3featherlight="#size-guide-modal"><span style="padding: 45px 10px 0;">Sizing Guide</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
 
<section id="product-in-short" class="">
    <h4 style="margin:2em;" ><?php echo $product->get_data()['short_description']; ?></h4>    
</section>
    <div class="refills-components">
        
    <div id="modal-size" class="modal">
        <input class="modal-state" id="modal-1" type="checkbox" />    
        <div class="modal-fade-screen">
        <div class="modal-inner">
            <div style="position:relative;">
                <div class="modal-close" for="modal-1" style="top:0;right:0;"></div> 
            </div>
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

      </div>
    </div>
        
    <div id="modal-size-guide" class="modal">
        <input class="modal-state" id="modal-1" type="checkbox" />    
        <div class="modal-fade-screen">
        <div class="modal-inner">
            <div style="position:relative;">
                <div class="modal-close" for="modal-1" style="top:0;right:0;"></div> 
            </div>
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
      </div>  
    
    <?php
    echo '<div class="following-description" style="width:100%" >';
    global $post;
    $page_description_id = get_post_meta( $post->ID, 'product_page_description_id', true );    
    $current_post = $post;
    $post = get_post($page_description_id);
    echo apply_filters( 'the_content', $post->post_content ); // BEFORE do_shortcode().
    //get_template_part( 'content', 'page' );
    $post = $current_post;
    echo '</div>';
    /*
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
    }*/
    ?>
    
    
    <style>

        
.product-footer-bar.visible {
    opacity: 1;
}
        
.product-footer-bar {    
    pointer-events: auto;
    transition-duration: .6s;
    transition-delay: .5s;
    position: fixed;
    bottom: 10px;
    left: 10px;
    right: 10px;
    width: auto;
    height: 40px;
    background: #fff;
    z-index: 500;
    opacity: 0;
    transition: opacity .8s;
}

.product-footer-bar .row {
    width: 100%;
    height: 40px;
    border: 1px solid #e7e7e7;
    display: flex;
    flex: 0 1 auto;
    flex-direction: row;
    flex-wrap: wrap;
}

.product-footer-bar .row .right {
    display: flex;
    flex-grow: 1;
}

.product-footer-bar .row .right form{
    width: 100%;
    display: flex;
    justify-content: flex-end;
}

.product-footer-bar .row .right form .ui-customSelect {
    height: 100%;
}
    </style>
    <!--div class="product-footer-bar visible">
    		<div class="row">
    			<div class="left">
	    			<a href="https://www.etq-amsterdam.com/store/" class="button button--rounded button--rounded--square button--rounded--no-border icon--arrow--hover">
                                        <div class="icon icon--arrow arrow--left">
                                    </div>
					</a>
		    		<hr>
		    		<label><?php //woocommerce_template_single_title(); ?></label>
	    		</div>
	    		<div class="right" data-component="product-form" data-product_id="42414">
                            <span>               
                                <span><?php //woocommerce_template_single_price(); ?>
                                </span>
                            </span>    
                                <?php  // Get Available variations?
		/*$get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

		// Load the template.
		wc_get_template( 'single-product/add-to-cart/variable.footer.php', array(
			'available_variations' => $get_variations ? $product->get_available_variations() : false,
			'attributes'           => $product->get_variation_attributes(),
			'selected_attributes'  => $product->get_default_attributes(),
		) ); */?>
                        </div>
    		</div>
    	</div-->
    <script>
    (function($) {
/*
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

$('.icon-sizing').click(function(){alert('hello')})
$('.icon-sizing-guide').click(function(){alert('hello')})
*/
$(document).on('click', '.icon-sizing', function(){     
    $('#modal-size').addClass('modal-open');   
    $(document.body).css('overflow-y','hidden');
});

$(document).on('click', '.icon-sizing-guide', function(){     
    $('#modal-size-guide').addClass('modal-open');   
    $(document.body).css('overflow-y','hidden');
});

$(document).on('click','.modal-close' ,function(){  
 $(this).parent().parent().parent().parent().removeClass('modal-open')
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
</article>
<?php //do_action( 'woocommerce_after_single_product' ); ?>