<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.


<-- =========================
    PRODUCTIon SECTION   
============================== -->
 */
        global $post;
        $production_id = null;
        $prod_ids = get_post_ids_by_meta_key_and_value('_product_id', $post->ID);
        if(is_array($prod_ids)) {
            foreach( $prod_ids as $prod_id) {
                if(get_post_status($prod_id) == 'wc-not-started') {
                    $production_id = $prod_id;
                    break;
                }
            }
        }
        if ($production_id != null) {
            $date_final = wc_get_time_ordering_closure($production_id);
            $date_diff = date_diff ( new DateTime() , $date_final );   
            
        ?>
<section id="timeline" class="parallax-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 wow bounceIn">
				<div class="section-title">
					<h2>Time Planning</h2>
					<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
				</div>
                
				<div class="section-title">
					<h2>Remaining Time before closure</h2>				
				
           <ul class="pie-time">
  <li class="chart" data-percent="75"><span><?php echo $date_diff->d;?></span>Jours</li>
  <li class="chart" data-percent="15"><span><?php echo $date_diff->h;?></span>Heures</li>  
</ul>
                                        
                                        </div>
                
                <div class="section-title">
                          <!-- PRODUCTION MINIMUM ORDER BAR -->
     <style>
         .bar{
            position:absolute;
            height:25px;
            width:300px;
            border:solid #999 1px;
            background-color:#ccc;
        }
         </style>
        <script>
$("#bar1").ready(function() {
    $('.count').each(function () {
      $(this).prop('Counter',0).animate({
          Counter: $(this).text()                
      }, {
          duration: 4000,
          easing: 'swing',
          step: function (now) {
           $(this).text(Math.ceil(now));
          }
      });
    });
    $('.meter').each(function () {
      $(this).prop('width',0).animate({                
          width: $(this).data("width") + "%",
      }, {
          duration: 4000,
          easing: 'swing'                
      });
    });
});
        </script>
     <div style="margin:40px auto; width:302px;">
	
        <?php
        $qty = wc_get_prod_total_ordered_item($production_id);
        $min_order = wc_get_prod_min_order($production_id);
        $max = $min_order + 10;
        if ($qty > $min_order ) {
            $max = $qty + 10;
        }
        //echo '<div style="text-align:center;"><h4>Current Order: ' . $qty . ' </h4></div>';
        echo '<div style="text-align:center;"><h4>Minimum Order: ' . $min_order . '</h4></div>';
        echo '</div>';
        echo '<div id="bar1" class="progress-bar-indication" style="position:relative; height:3em;">
             <span class="ind" style="width: 2px;margin-left:' . ($min_order/$max)*100 . '%; position: absolute;height: 120%;vertical-align: middle;z-index: 1000;background-color: blue;">    
  </span>
  <span class="meter" style="position:absolute; width:0" data-width="'. ($qty/$max)*100 . '">    
  </span>
<span class="count" style="width:100%; position:absolute; font-size:2em" data-width="'. ($qty/$max)*100 . '">
    ' . ($qty) . '
  </span>  
</div>';
         
        ?>
         
	
	<!--<span id="barInputLabel"></span>-->

                </div>
			</div>
		
            </div>
        
        <div class="row">
            <?php include 'wc-timeline-single-product.php';?> 
    </div>
     
</section>
        <?php }
        ?>