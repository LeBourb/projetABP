<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<style>
        #awesome_<?php echo $key;?> {
            background: url(<?php echo wp_get_attachment_image_src( $item['media_id'])[0]; ?>) 50% 0 repeat-y fixed;
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
        }
</style>
<section id="awesome_<?php echo $key;?>" class="parallax-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 <?php if($parallex_left) echo "col-md-offset-3"; else echo "col-md-offset-7"; ?>">            
                <?php echo $item['text'];?>
            </div>
        </div>
    </div>
</section>
