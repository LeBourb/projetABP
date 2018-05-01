<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



add_action( 'woocommerce_before_add_to_cart_form', 'wc_before_add_to_cart_shipping_estimate', 10 );
 
function wc_before_add_to_cart_shipping_estimate() {
    global $post;
    $production_id = wc_get_not_stated_production_item($post->ID);
    if($production_id == '') {
        echo '<span>NO PRODUCTION PLANNED !</span>';
    }else {
        $production = wc_get_prod($production_id);
        $start = $production->get_estimated_shipping_start();
        $start = strtotime($start); 
        $start = date("y/m/d",$start);
        $end = $production->get_estimated_shipping_end();
        $end = strtotime($end);
        $end = date("m/d",$end);
        echo '<div class="estimated-ship-date" style="margin-top: 1em;">
            【お届け予定: ' . $start  . '〜' . $end . '】</div>';
    }
}

add_action( 'woocommerce_before_add_to_cart_form', 'wc_before_add_to_cart_size_details', 20 );
 
function wc_before_add_to_cart_size_details() {
   global $post;
   $text = get_post_meta(  $post->ID, 'wc_size_details', true);
   if( !$text || $text == "" ) 
       return;
   
   $text_guide = get_post_meta(  $post->ID, 'wc_size_guide', true);
   
   ?>
    <br><a id="btn_size_details" class="icon-sizing" data-featherlight="#size-details-modal" style="cursor:pointer;"><span>サイズ & アイテム詳細</span></a>
   
   <div id="wc_size_details" style="display:none;    margin-left: auto;
    margin-right: auto;"> 
       <?php  if($text_guide && $text_guide != "") {?><div>サイズの測り方はこちら: <a id="btn_second_size_guide" class="icon-sizing" data-featherlight="#size-guide-modal" style="cursor:pointer;"><span>サイズガイド</span></a></div> 
       <?php }?>
       <div><?php echo $text; ?></div> 
   </div>
   
   <script>
       $('#btn_size_details').click(function() {
           $('.modal-product-details.product').append($('#wc_size_details').show());
           $('.modal-product-details.product .images').hide();
           $('.modal-header #btn-modal-back').show();
           $('.modal-header #modal-title').text("サイズ & アイテム詳細");
       });
       
       $('.modal-header #btn-modal-back').click(function() {
            if(window.second_sizing_guide) {                
                $('.modal-product-details.product #wc_size_details').show();
                $('.modal-product-details.product #wc_size_guide').hide();
                $('.modal-header #modal-title').text("サイズ & アイテム詳細");
                window.second_sizing_guide = false;
            } else {
                $(this).hide();
                $('.modal-product-details.product #wc_size_details').hide();
                $('.modal-product-details.product .images').show();
                $('.modal-header #modal-title').text("");
            }
       });
       
       $('#btn_second_size_guide').click(function() {
            $('.modal-product-details.product').append($('#wc_size_guide').show());
            $('.modal-product-details.product #wc_size_details').hide();            
            $('.modal-header #modal-title').text("サイズガイド");
            window.second_sizing_guide = true;
       });
   </script>
   
   <?php
   
}


add_action( 'woocommerce_before_add_to_cart_form', 'wc_before_add_to_cart_size_guide', 21 );
 
function wc_before_add_to_cart_size_guide() {
   global $post;
   $text = get_post_meta(  $post->ID, 'wc_size_guide', true);
   if( !$text || $text == "" ) 
       return;
   ?>
    <!--a id="btn_size_guide" class="icon-sizing" data-featherlight="#size-guide-modal" style="cursor:pointer;"><span>Sizing Guide</span></a-->
   
   <div id="wc_size_guide" style="display:none;    margin-left: auto;
    margin-right: auto;"> <?php echo $text; ?> </div>
   
   <?php
   
}

add_action( 'woocommerce_before_add_to_cart_form', 'wc_before_add_to_cart_funding', 20 );

function wc_before_add_to_cart_funding() {
    global $post;
    $production_id = wc_get_not_stated_production_item($post->ID);
    $min_order = wc_get_prod_min_order($production_id);
    if($production_id == '') {
        echo '<span>NO PRODUCTION PLANNED !</span>';
    }else if ($min_order > 0) {
        $production = wc_get_prod($production_id);
        $qty = wc_get_prod_total_ordered_item($production_id);
        
        $percent = intval($qty/$min_order*100);
     ?> <style>
        .goalProgress {
            background: #f2f2f2;
            border-radius: 3px;
            overflow: hidden;
            padding: 0;
            margin: 3.35em 0.5em 0;
        }
        .progressBar {
            display: block;
            width: 0;
            height: 7px;
            overflow: hidden;
            padding: 0;
            border-radius: 2px 0 0 2px;
            background: #0f2130;
            color: #0f2130;
            font-size: 0;
            transition: all 2s ease-out;
        }
        .progress-text {
            font-size: 1rem;
            color: #363636;
            float: right;
            margin:0.75em 0.5em 0;
        }
        #days {
            font-size: 1.1rem;
            color: #0f2130;
            float: left;
            text-align: left;
            margin: 0.75em 0.5em 0;
            padding: 0;
        }        
        #price-field {
            line-height: 0.6em;
            margin: 0.7em auto -0.1em;
        }
        #price-field {
            display: flex;
            flex-flow: row nowrap;
            justify-content: center;
        }
        #price-field >* {
            flex-basis: 49%;
        }
        
        @media screen and (max-width: 760px) {
            .progress-text, #days {
                font-size: 9px;
            }
        }
        </style>
        
        <div id="progress-bg">
            <div id="progress">
                <div class="goalProgress almost-full">
                    <div class="progressBar" data-percent="<?php echo $percent; ?>%" style="width:0%;"></div>
                </div>
            </div>
        </div>
        <p id="days">
            <span class="hear-ye">予約受付終了まであと:</span>
            <time class="tricky-countdown" data-funding-end="<?php echo $production->get_funding_end(); ?>"></time>
        </p>
        <span class="progress-text">目標達成度: <?php echo $percent;?>%</span>
        <script>
            var strdate = $('.tricky-countdown').data( 'funding-end' );
            var countDownDate = new Date(strdate).getTime();
            window.setInterval(function() {
                var now = new Date().getTime();
                // Find the distance between now an the count down date
                var distance = countDownDate - now;
                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                // Display the result in the element with id="demo"
                

                // If the count down is finished, write some text 
                if (distance < 0) {
                  $('.tricky-countdown').html("EXPIRED");
                }else {
                    $('.tricky-countdown').html(days + "日 " + hours + "時間 " + minutes + "分 " + seconds + "秒 ");
                }
                
            },1000);            
            $(document).ready(function () {
                $(".btn-reservation").click(function() { 
                    setTimeout(function(){
                        $('.progressBar').css('width',$('.progressBar').data('percent'));
                    },200);
                    
                
                //Do something 
                });
            })
            
        </script>
        <div style="background-color:#e8e8e8;margin:1em;padding:1em;margin-top: 4em;">
            こちらは予約商品のため、<red style="color:red;">注文確定後のキャンセル、返品、交換はできません。</red>
            <br>
            <ul>
            <li>実際の商品は、外見に目立つ変化がない範囲で仕様や寸法が若干異なる場合がございます。</li>
            <li>生産の都合上、お届け時期が予定より前後する場合がございます。</li>
            <li>ご注文後、商品のお届け時期は「MY ORDER」ページより随時ご確認いただけます。</li>
            </ul>
            <red style="color:red;">【お買い物前にご一読ください】<a href="<?php echo get_permalink(get_option('woocommerce_shopping_guide_page_id')); ?>">ご利用ガイド</a></red>
        </div>
            <?php
    } else {
        echo '<span>NO MINIMUM ORDER SET !</span>';
    }
}


