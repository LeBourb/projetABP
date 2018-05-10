<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<style>
        .awesome_<?php echo $key;?> {
            background: url(<?php echo wp_get_attachment_image_src( $item['media_id'], 'medium')[0]; ?>) 50% 0 repeat-y fixed;
            -webkit-background-size: cover;
            background-size: cover;
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
            background-position-y: <?php 
                $image_metas_y = get_post_meta( $item['media_id'], 'focus_position_y', true );
                if($image_metas_y != "") {
                    echo "$image_metas_y%";
                }
                else {
                    echo 'center';
                }
            ?>;
            background-position-x: <?php
                $image_metas_x = get_post_meta( $item['media_id'], 'focus_position_x', true );
                if($image_metas_x != "") {
                    echo "$image_metas_x%";
                }
                else {
                    echo 'center';
                }
            ?>;
        }
        
        .awesome_<?php echo $key;?> p , 
        .awesome_<?php echo $key;?> h1,
        .awesome_<?php echo $key;?> h2,
        .awesome_<?php echo $key;?> h3,
        .awesome_<?php echo $key;?> h4 {
            color: <?php if($text_color=="white") echo "white"; else echo "black"; ?>
        }
                
        .awesome_<?php echo $key;?> h1 {
            font-size: 20px;
        }
        
        .awesome_<?php echo $key;?> h2 {
            font-size: 18px;
        }
                
        .awesome_<?php echo $key;?> p {
            font-size: 16px;
        }
                
        @media (max-width: 768px) {
            .awesome_<?php echo $key;?> .container {
                background-color: white;
                color: black;
                opacity: 0.7;
                padding: 2em;
            }
            .awesome_<?php echo $key;?> .container p ,
            .awesome_<?php echo $key;?> .container h1 ,
            .awesome_<?php echo $key;?> .container h2 {
                color: black;
            }
            
            .awesome_<?php echo $key;?> .container h1 {
                font-size: 16px;
            }
            
            .awesome_<?php echo $key;?> .container h2 {
                font-size: 14px;
            }
            
            .awesome_<?php echo $key;?> .container p {
                font-size: 12px;
            }
        }
        
         @media (max-width: 400px) {
            .awesome_<?php echo $key;?> .container h1 {
                font-size: 13px;
            }
            
            .awesome_<?php echo $key;?> .container h2 {
                font-size: 12px;
            }
            
            .awesome_<?php echo $key;?> .container p {
                font-size: 11px;
            }
         }
</style>
<section id="<?php echo strtolower(str_replace(' ', '', $title));?>" class="parallax-section <?php echo 'awesome_' .  $key; ?> img-lazy-load" data-full-src="<?php echo wp_get_attachment_image_src( $item['media_id'], 'large')[0];?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6 <?php 
            if($text_pos=="left") {
                echo " col-md-offset-1 "; 
                echo " col-lg-offset-1 "; 
            }
            else {
                echo " col-md-offset-6 ";
                echo " col-lg-offset-6 "; 
            }?>">            
                <?php echo $item['text'];?>
            </div>
        </div>
    </div>
</section>
