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
        $end = $production->get_estimated_shipping_end();
        echo '<div class="estimated-ship-date">
            <p>Estimated Shipping: <span>' . $start  . '–' . $end . '</span></p></div>';
    }
}

add_action( 'woocommerce_before_add_to_cart_form', 'wc_before_add_to_cart_funding', 20 );

function wc_before_add_to_cart_funding() {
    global $post;
    $production_id = wc_get_not_stated_production_item($post->ID);
    if($production_id == '') {
        echo '<span>NO PRODUCTION PLANNED !</span>';
    }else {
        $production = wc_get_prod($production_id);
        $qty = wc_get_prod_total_ordered_item($production_id);
        $min_order = wc_get_prod_min_order($production_id);
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
            margin-right: 0.5em;
            margin-top: -1.25em;
        }
        #days {
            font-size: 1.1rem;
            color: #0f2130;
            text-align: left;
            margin: 0.75em 0.5em 0;
            padding: 0;
        }        
        .price.crowdfunding small {
            display: block;
            margin-top: 1.3em;
            font-size: 1.2rem;
            line-height: 1em;
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
        </style>
        
        <div id="progress-bg">
            <div id="progress">
                <div class="goalProgress almost-full">
                    <div class="progressBar" data-percent="<?php echo $percent; ?>%" style="width:0%;"></div>
                </div>
            </div>
        </div>
        <p id="days">
            <span class="hear-ye">Funding ends in:</span>
            <time class="tricky-countdown" data-funding-end="<?php echo $production->get_funding_end(); ?>"></time>
        </p>
        <span class="progress-text"><?php echo $percent;?>% Funded</span>
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
                    $('.tricky-countdown').html(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
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
            <?php
    }
}

