<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<section id="workshop" class="parallax-section">
   <div class="wow bounceIn" style="visibility: visible; animation-name: bounceIn;">
				<div class="section-title" style="text-align: center;">
					<h2>ものづくりは、ものがたり。</h2>					
			</div>
    <div class="scrollbar">
        <div class="handle"><div class="mousearea"></div></div>
</div>
    
    <div id="frame" class="frame">
    <ul id="workshop-items" class="slidee owl-carousel" data-wow-delay="1.7s">
    <?php 
        $args = array( 'post_type' => 'shop_workshop' );
        $workshops = get_posts( $args ); 
        foreach($workshops as $workshop) {              
            $image_meta_val=get_post_meta( $workshop->ID, 'second_featured_image', true);            
            $image = wp_get_attachment_image_src( $image_meta_val, 'large');
            
    ?>
    <li class="my-2 mx-auto p-relative bg-white item" style="width: 360px; overflow: hidden; border-radius: 1px; position: relative;">
         <a href="<?php echo get_permalink($workshop); ?>" style="color: black;" >
        <div style="position:relative;width:100%;height: 18em;">
            <div class="" style="position:absolute;background-color: white; top:0;left:0;padding: 0.4em;">
            <?php echo get_post_meta( $workshop->ID, 'workshop_function', true); ?>
            </div>
            <div style="position:absolute;text-align: center; vertical-align: middle; top:0; bottom:0; right:0; left:0;">
                <div class="read-more" style="">
                READ MORE
                </div>
            </div>
            <?php //echo $image[0]; 
            //print_r($image); ?>
            <div class="background-tile-img" style="background:linear-gradient( rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) ), url(<?php echo $image[0]; ?>) no-repeat center bottom / cover;
                 height: 100%;
    width: 100%;">
                <?php //echo $image[0]; ?>
            </div>
            
        </div>
        
        <div class="">
          

          <h5 class="" style="line-height: 1.25;">
            <?php echo get_the_title($workshop); ?>
          </h5>

          <p class="">
            <?php echo get_the_excerpt($workshop);  ?>            
          </p>

        </div>
        </a>
    </li>
    <?php 
        }        
    ?>  </ul>
        </div>
     <script>
      /*var owl = jQuery('.owl-carousel');
      owl.owlCarousel({
        margin: 10,
        loop: true,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            items: 3
          }
        }
      })*/
    </script>
    <ul class="pages"></ul>
    
</section>
<script>
     jQuery( function( $ ) {
              
        var $frame  = $('#workshop #frame');
		var $slidee = $frame.children('ul').eq(0);
		var $wrap   = $frame.parent();

		// Call Sly on frame
		$frame.sly({
			horizontal: 1,
			itemNav: 'basic',
			smart: 1,
			activateOn: 'click',
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			startAt: 3,
			scrollBar: $wrap.find('.scrollbar'),
			scrollBy: 1,
			pagesBar: $wrap.find('.pages'),
			activatePageOn: 'click',
			speed: 300,
			elasticBounds: 1,			
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1,

		});

	});	
    //$('#workshop #frame').sly(options);
</script>