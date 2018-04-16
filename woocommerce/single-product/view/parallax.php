<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<style>
        .awesome_<?php echo $key;?> {
            background: url(<?php echo wp_get_attachment_image_src( $item['media_id'], 'large')[0]; ?>) 50% 0 repeat-y fixed;
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
        
        .awesome_<?php echo $key;?> p {
            color: <?php if($text_color=="white") echo "white"; else echo "black"; ?>
        }
</style>
<section id="<?php echo strtolower(str_replace(' ', '', $title));?>" class="parallax-section <?php echo 'awesome_' .  $key; ?>">
    <div class="container">
        <div class="row">
            <div class="col-md-4 <?php if($text_pos=="left") echo "col-md-offset-1"; else echo "col-md-offset-7"; ?>">            
                <?php echo $item['text'];?>
            </div>
        </div>
    </div>
</section>
