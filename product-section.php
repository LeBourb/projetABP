<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<section id="products" class="parallax-section products-image-homepage">
	
    <div class="items-container">
  <?php
  $args     = array( 'post_type' => 'product' );
  $products = get_posts( $args ); 
  foreach($products as $product_id) {
      $product =  wc_get_product($product_id);
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'large' );

  ?>


  <a href="<?php echo get_permalink($product_id);?>" class="linkWrapper">
      <div class="parallax parallaxWrapper" style="position: relative; overflow: hidden;">
          <div class="parallax-background-children" style="transform: translate3d(-50%, 0px, 0px); position: absolute; left: 50%; transform-style: preserve-3d; backface-visibility: hidden;">
              <div class="parallax-background backgroundContainer">
                  <div class="parallax-realcontainer" style="background:linear-gradient( rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) ), url(<?php echo $image[0]?>) no-repeat center bottom / cover;">

                  </div>

              </div>

          </div>
          <div class="parallax-content" style="position:relative;">
              <div class="innerContainer innerContainer">
                  <div class="wrapperRight wrapperRight">

                  </div>
                  <div class="wrapper">
                      <div class="divider"></div>                                                        
                  </div>
                  <div class="wrapper">
                      <div class="label"><?php echo str_replace("|","<br>",$product->get_title()); ?></div>                                                        
                  </div>                                                    
              </div>                                                
          </div>                                            
      </div>
  </a>
  <?php 
  }				
  ?>
    </div>
                              
</section>

