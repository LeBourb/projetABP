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
					<h2><?php echo get_post_meta( $post->ID, 'Workshop Title', true); ?></h2>
					<p><?php echo get_post_meta( $post->ID, 'Workshop Sub Title', true);?></p>				</div>
			</div>
    <div class="scrollbar">
        <div class="handle"><div class="mousearea"></div></div>
</div>
    <div id="frame" class="frame">
    <ul id="workshop-items" class="slidee" data-wow-delay="1.7s">
    <?php 
        $args = array( 'post_type' => 'shop_workshop' );
        $workshops = get_posts( $args ); 
        foreach($workshops as $workshop) {              
            $image_meta_val=get_post_meta( $workshop->ID, 'second_featured_image', true);            
            $image = wp_get_attachment_image_src( $image_meta_val, 'large');
            
    ?>
    <li class="my-2 mx-auto p-relative bg-white shadow-1 blue-hover" style="width: 360px; overflow: hidden; border-radius: 1px; position: relative;">
        <img src="<?php echo $image[0]; ?>" alt="Man with backpack"    
            class="d-block w-full"
            style="max-height: 175px;
    min-width: 100%;
    width: auto;
    max-width: none;
">
        <div class="px-2 py-2">
          <p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px">
            <?php echo get_post_meta( $workshop->ID, 'workshop_function', true); ?>
          </p>

          <h1 class="ff-serif font-weight-normal text-black card-heading mt-0 mb-1" style="line-height: 1.25;">
            <?php echo get_the_title($workshop); ?>
          </h1>

          <p class="mb-1">
            <?php echo get_the_excerpt($workshop);  ?>            
          </p>

        </div>

        <a href="<?php echo get_permalink($workshop); ?>" class="text-uppercase d-inline-block font-weight-medium lts-2px ml-2 mb-2 text-center styled-link" style="position:absolute;bottom:0;margin-bottom:0;">
          <?php _e('Read More','atelierbourgeons'); ?>
        </a>
    </li>
    <?php 
        }        
    ?>  </ul>
        </div>
    <ul class="pages"></ul>
    
</section>
<script>
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

		
    //$('#workshop #frame').sly(options);
</script>