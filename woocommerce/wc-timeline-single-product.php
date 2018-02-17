<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($production_id)) {
    _e('This order is not included in any production','atelierbourgeons');
    return;
}
    
?>
<style>
    @keyframes dash {
      to {
        stroke-dashoffset: 0;
      }
    }
    @keyframes fade-in {
        from {
            opacity: 0;
        }  to {
            opacity: 1;
        }
    }
    @keyframes rot-opacity {      
        0% {
            transform: rotate3d(0,1,0,60deg);
            opacity: 0;
        }   
        50% {
            transform: rotate3d(0,1,0,160deg);
            opacity: 0.4;
        }
        100% {
            transform: rotate3d(0,1,0,0deg);
            opacity: 1;
        }
    }
    line {
        animation: dash 5s linear forwards;    
        stroke-dashoffset: 1000;
        stroke-dasharray: 1000;        
    }
    #line-1 {
        animation-delay: 3s;
    }
    #line-2 {
        animation-delay: 4s;
    }
    #line-3 {
        animation-delay: 5s;
    }
    #line-4 {
        animation-delay: 6s;
    }
    #line-5 {
        animation-delay: 7s;
    }
    #circle-1 {
        animation-delay: 3s;
    }
    #circle-2 {
        animation-delay: 4s;
    }
    #circle-3 {
        animation-delay: 4s;
    }
    @keyframes circle-width {
      to {
        transform: scale(1);
      }
    }
    
    .circle {
        background: #004165;
        width: 10px;
        height: 10px;
        margin: auto;
        border-radius: 100%;
        overflow: hidden;
        animation:grow 2s 1 forwards;    
    }
    .parent-circle {
        height: 20px;
        width: 20px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        opacity: 0;
        animation:fade-in 2s 1 forwards;  
        
    }
    
    .now {
       animation:fade-in 2s linear forwards; 
       animation-delay: 6s;
       opacity:0;
    }
    
    .eventBubble {
        animation:rot-opacity 2s 1 forwards;
        opacity: 0;
    }
    
    #event1Bubble {        
        animation-delay: 3s; 
    }
    #event2Bubble {        
        animation-delay: 4s; 
    }
    #event3Bubble {        
        animation-delay: 5s; 
    }
    #parent-circle-1 , 
    #parent-circle-1 .circle {
        animation-delay: 3s; 
    }
    #parent-circle-2 ,
    #parent-circle-2 .circle {
        animation-delay: 4s; 
    }
    #parent-circle-3 ,
    #parent-circle-3 .circle {
        animation-delay: 5s; 
    }
    
    #dot-end {        
        animation:fade-in 2s 1 forwards;
        animation-delay: 7s;
        opacity: 0;
    }

    @keyframes grow {
        0% {
            transform: scale( 0 );
            opacity: 0;
        }   
        50% {
            transform: scale( 0.7 );
            opacity: 0.5;
        }
        100% {
            transform: scale( 1 );
            opacity: 1;
        }
    }
     
</style>

<h2>
        Timeline
    </h2>
<div class="Timeline item wow fadeInUp" data-wow-delay="0.6s">
    
  <?php
  $production_status = wc_get_production_status($production_id);
  if($production_status == 'wc-not-started' ) { ?>
  <svg height="5" width="50">
  <line id="line-1" x1="0" y1="0" x2="50" y2="0" style="stroke:#004165;stroke-width:5" />
</svg>

  <div class="now">
    NOW
  </div>  
    
  
  <svg height="5" width="100">
  <line id="line-2" x1="0" y1="0" x2="150" y2="0" style="stroke:rgba(162, 164, 163, 0.37);stroke-width:5" />
</svg>
<?php }else { ?>  
  <svg height="5" width="200">
  <line id="line-1" x1="0" y1="0" x2="200" y2="0" style="stroke:#004165;stroke-width:5" />
  </svg>
<?php }?>  
  <!--animate 
    xlink:href="#my-line-1"
    attributeName="x2"
    from="0"
    to="200" 
    dur="1s"
    begin="1s"
    fill="freeze"
    id="myline1-anim"/-->    


  <div class="event1">
    
    <div class="event1Bubble eventBubble" id="event1Bubble" style="">
        <?php $start_date = wc_get_time_ordering_closure($production_id) ?>
      <div class="eventTime">
        <div class="DayDigit" data-date="<?php echo $start_date->format('Y-m-d');?>"></div>
        <ul style="margin: 0;width: auto;">
        <li class="Month" data-date="<?php echo $start_date->format('Y-m-d');?>"></li>
        <li class="Year" data-date="<?php echo $start_date->format('Y-m-d');?>"></li>
        </ul>
      </div>
      <div class="eventTitle"><?php _e('Ordering completed','woocommerce');?></div>
    </div>
    <div class="parent-circle" id="parent-circle-1">
    <div class="circle">

    </div>
    </div>
    <!--svg height="20" width="20">
       <circle id="my-circle-1" cx="10" cy="11" r="5" fill="#004165" />
       <div class="circle">
        </div>
       <!--animate 
    xlink:href="#my-circle-1"
    attributeName="r"
    from="0"
    to="5" 
    dur="1s"
    begin="myline1-anim.begin + 1s"
    fill="freeze" />
     </svg-->
    
  </div>
  
 <svg height="5" width="100">
  <line id="line-2" x1="0" y1="0" x2="300" y2="0" style="stroke:#004165;stroke-width:5" />
</svg>


  <div class="event2">
    
    <div class="event2Bubble eventBubble" id="event2Bubble">
        <?php $start_prod = wc_get_production_date($production_id) ?>
      <div class="eventTime">
        <div class="DayDigit" data-date="<?php echo $start_prod->format('Y-m-d');?>"></div>
        <ul style="margin: 0;width: auto;">
            <li class="Month" data-date="<?php echo $start_prod->format('Y-m-d');?>"></li>
            <li class="Year" data-date="<?php echo $start_prod->format('Y-m-d');?>"></li>
        </ul>
      </div>
      <div class="eventTitle"><?php _e('Production start','woocommerce');?></div>
    </div>     <!--svg height="20" width="20">
    <circle cx="10" cy="11" r="5" fill="#004165" />
    </svg-->
      <div class="parent-circle" id="parent-circle-2">
    <div class="circle">

    </div>
    </div>
  </div>
  
<?php if($production_status != 'wc-not-started' && $production_status != 'wc-prd-completed' ) { ?>
  <svg height="5" width="50">
  <line id="line-3" x1="0" y1="0" x2="50" y2="0" style="stroke:#004165;stroke-width:5" />
</svg>

  <div class="now">
    NOW
  </div>  
    
  
  <svg height="5" width="250">
  <line id="line-4" x1="0" y1="0" x2="150" y2="0" style="stroke:rgba(162, 164, 163, 0.37);stroke-width:5" />
</svg>
<?php }else { ?>
 <svg height="5" width="350">
  <line id="line-4" x1="0" y1="0" x2="150" y2="0" style="stroke:rgba(162, 164, 163, 0.37);stroke-width:5" />
</svg>
<?php } ?>
  <div class="event3 futureGray ">
      <?php $end_prod = wc_get_production_end($production_id) ?>
    <div class="event1Bubble eventBubble" id="event3Bubble">
      <div class="eventTime">
        <div class="DayDigit" data-date="<?php echo $end_prod->format('Y-m-d');?>"></div>
        <ul style="">
            <li class="Month" data-date="<?php echo $end_prod->format('Y-m-d');?>"></li>
            <li class="Year" data-date="<?php echo $end_prod->format('Y-m-d');?>"></li>
        </ul>
      </div>
      <div class="eventTitle"><?php _e('Production completed','woocommerce');?></div>
    </div>
      <!--svg height="20" width="20">
    <circle cx="10" cy="11" r="5" fill="rgba(162, 164, 163, 0.37)" />
    </svg-->
      <div class="parent-circle" id="parent-circle-3">
    <div class="circle">

    </div>
    </div>
  </div>
<svg height="5" width="50">
<line id="line-5" x1="0" y1="0" x2="50" y2="0" style="stroke:#004165;stroke-width:5" /> 
</svg>
<div id="dot-end">
    <svg height="20" width="42" >
    <line id="line-6" x1="1" y1="0" x2="1" y2="20" style="stroke:#004165;stroke-width:2" /> 
    <circle cx="11" cy="10" r="3" fill="#004165" />  
    <circle cx="21" cy="10" r="3" fill="#004165" />  
    <circle cx="31" cy="10" r="3" fill="#004165" />    
    <line id="line-7" x1="41" y1="0" x2="41" y2="20" style="stroke:#004165;stroke-width:2" /> 
    </svg>  
</div>
</div>
   
        <style>
            #timeline {
                background-image: linear-gradient(135deg, #eaa2a7, #d39296);
            }
.chart{
  display: inline-block;
  text-align: center;
  width: 95px;
  height: 95px;
  margin: 0 10px;
  vertical-align: top;
  position: relative;
    box-sizing: border-box;
    padding-top: 22px;
}
  .chart span{
    display: block;
    font-size: 2em;
    font-weight: normal;
  }

  .chart canvas{
    position: absolute;
    left: 0;
    top: 0;
  }
  
  .pie-time{
      margin-left: 40%;
  }

  
            </style>
            <script>
                
        var options = {
          scaleColor: false,
          trackColor: 'rgba(255,255,255,0.3)',
          barColor: '#E7F7F5',
          lineWidth: 6,
          lineCap: 'butt',
          size: 95
        };

        window.addEventListener('DOMContentLoaded', function() {
          var charts = [];
          [].forEach.call(document.querySelectorAll('.chart'),  function(el) {
            charts.push(new EasyPieChart(el, options));
          });
        });
    $('.DayDigit').each(function() {    
        var date = new Date($(this).data('date')),
       locale = navigator.language,          
       day = date.toLocaleDateString(locale, { day: "2-digit" });         
       $(this).text(day);
    });
    $('.Month').each(function() {    
        var date = new Date($(this).data('date')),
       locale = navigator.language,          
       month = date.toLocaleDateString(locale, { month: "long" });         
       $(this).text(month);
    });
    $('.Year').each(function() {
       var date = new Date($(this).data('date')),
       locale = navigator.language,          
       year = date.toLocaleDateString(locale, { year: "numeric" });
       
       $(this).text(year);
    });
 
    
            </script>