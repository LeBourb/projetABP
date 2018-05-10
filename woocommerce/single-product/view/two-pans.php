<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
        <?php echo '.awesome_' .  $key; ?> {
            display: block;
            height: 90vh;
            position: relative;
        }   
        <?php echo '.awesome_' .  $key; ?> .container {
            width: 100%;
            height: 100%;   
            padding: 0;
            display: flex;
            flex-direction: column;
        }
        
        <?php echo '.awesome_' .  $key; ?> .shape-container {
            height: 100%;
            position: relative;
        }
        @media (max-width: 768px) {
            <?php echo '.awesome_' .  $key; ?> .shape-container {
                height: 60%;
            }
        }
        
        <?php echo '.awesome_' .  $key; ?> .shape-trapezoid {
            height: 100%;
            width: 90%;
            left: -20%;
            position: absolute;            
            transition: left 0.4s ease-in-out;
            -o-transition: left 0.4s ease-in-out;
            -ms-transition: left 0.4s ease-in-out;
            -moz-transition: left 0.4s ease-in-out;
            -webkit-transition: left 0.4s ease-in-out;
            /*background-color: red;*/
            clip-path: polygon(0 0, 65% 0%, 90% 100%, 0% 100%);
            -o-clip-path: polygon(0 0, 65% 0%, 90% 100%, 0% 100%);
            -ms-clip-path: polygon(0 0, 65% 0%, 90% 100%, 0% 100%);
            -moz-clip-path: polygon(0 0, 65% 0%, 90% 100%, 0% 100%);
            -webkit-clip-path: polygon(0 0, 65% 0%, 90% 100%, 0% 100%);            
            /* transform: rotate(360deg); 
            background-image: url('<?php echo wp_get_attachment_image_src($media_1, 'medium')[0]; ?>');*/
        }
        <?php echo '.awesome_' .  $key; ?> .shape-trapezoid-inv {
            /*background-color: blue;*/
            height: 100%;
            width: 90%;
            position: absolute;
            left: 40%;
            transition: left 0.4s ease-in-out;
            -o-transition: left 0.4s ease-in-out;
            -ms-transition: left 0.4s ease-in-out;
            -moz-transition: left 0.4s ease-in-out;
            -webkit-transition: left 0.4s ease-in-out;
            clip-path: polygon(5% 0%, 100% 0%, 100% 100%, 30% 100%);
            -o-clip-path: polygon(5% 0%, 100% 0%, 100% 100%, 30% 100%);
            -ms-clip-path: polygon(5% 0%, 100% 0%, 100% 100%, 30% 100%);
            -moz-clip-path: polygon(5% 0%, 100% 0%, 100% 100%, 30% 100%);
            -webkit-clip-path: polygon(5% 0%, 100% 0%, 100% 100%, 30% 100%);
            /*background-image: url('');*/
        }
        
        <?php echo '.awesome_' .  $key; ?>.left-expand .shape-trapezoid-inv {            
            left:60%;
        }
        
        <?php echo '.awesome_' .  $key; ?>.left-expand .shape-trapezoid {
            left:0%;
        }
                
        <?php echo '.awesome_' .  $key; ?>.right-expand .shape-trapezoid-inv {            
            left:20%;
        }
        
        <?php echo '.awesome_' .  $key; ?>.right-expand .shape-trapezoid {
            left: -40%;
        }
        
        <?php echo '.awesome_' .  $key; ?> .parallax-realcontainer {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
        }
        
        <?php echo '.awesome_' .  $key; ?> .innerContainer {
            height: 100%;    
            width: 100%;
        }
        
        <?php echo '.awesome_' .  $key; ?> .innerContainer .label {            
            font-weight: 400;
            letter-spacing: 0.025em;
            font-size: 3em;
            position: relative;
            float: left;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);            
        }
        
    </style>
    
    
    <section id="<?php echo strtolower(str_replace(' ', '', $title));?>" class="<?php echo 'awesome_' .  $key; ?>">
        <div class="container">
            <div class="col-md-12 col-sm-12 wow bounceIn" style="float: none;">
				<div class="section-title">
					<h2><?php echo $title;?></h2>
				</div>
			</div>
            <div class="shape-container">
                
			
                <div class="shape-trapezoid">
                    <div class="parallax-realcontainer img-lazy-load" style="background:linear-gradient( rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) ), url(<?php echo wp_get_attachment_image_src($media_1, 'medium')[0]; ?>) no-repeat center bottom / cover;" data-full-src="<?php echo wp_get_attachment_image_src( $media_1, 'large')[0];?>">
                    </div>
                    <div class="innerContainer">                  
                        <div class="label"><?php echo $text_left;?></div>                          
                    </div>
                </div>
                <div class="shape-trapezoid-inv">
                    <div class="parallax-realcontainer img-lazy-load" style="background:linear-gradient( rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) ), url(<?php echo wp_get_attachment_image_src($media_2, 'medium')[0]; ?>) no-repeat center bottom / cover;" data-full-src="<?php echo wp_get_attachment_image_src( $media_2, 'large')[0];?>">

                    </div>
                    <div class="innerContainer" >                  
                        
                          <div class="label" style="left:44%;"><?php echo $text_right;?></div>                                                        
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <script>
        (function($) {
         $(".awesome_<?php  echo $key; ?> .shape-trapezoid").mouseenter(function() { 
            $("<?php echo '.awesome_' .  $key; ?>").addClass('left-expand');
         });
         $(".awesome_<?php  echo $key; ?> .shape-trapezoid").mouseleave(function() { 
            $("<?php echo '.awesome_' .  $key; ?>").removeClass('left-expand');
         });
         $(".awesome_<?php  echo $key; ?> .shape-trapezoid-inv").mouseenter(function() { 
            $("<?php echo '.awesome_' .  $key; ?>").addClass('right-expand');
         });
         $(".awesome_<?php  echo $key; ?> .shape-trapezoid-inv").mouseleave(function() { 
            $("<?php echo '.awesome_' .  $key; ?>").removeClass('right-expand');
         });
         }(jQuery));
    </script>