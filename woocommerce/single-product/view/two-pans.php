<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<style>
        #special-section {
            display: block;
            height: 100vh;
            position: relative;
        }   
        #special-section .container {
            width: 100%;
            height: 100%;   
        }
        
        #special-section .shape-container {
            height: 100%;
            position: relative;
        }
        @media (max-width: 768px) {
            height: 60%;
        }
        
        #special-section .shape-trapezoid {
            height: 100%;
            width: 60%;
            position: absolute;
            /*background-color: red;*/
            clip-path: polygon(0 0, 65% 0%, 90% 100%, 0% 100%);
            /* transform: rotate(360deg); 
            background-image: url('<?php echo wp_get_attachment_image_src($media_1, 'full')[0]; ?>');*/
        }
        #special-section .shape-trapezoid-inv {
            /*background-color: blue;*/
            height: 100%;
            width: 60%;
            position: absolute;
            left: 40%;
            clip-path: polygon(5% 0%, 100% 0%, 100% 100%, 30% 100%);
            /*background-image: url('');*/
        }
        
        #special-section .parallax-realcontainer {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
        }
        
        #special-section .innerContainer {
            position: relative;
        }
        
        #special-section .innerContainer .label {
            margin-top: 36%;
            font-weight: 400;
            letter-spacing: 0.025em;
            font-size: 3em;
            display: block;
        }
        
    </style>
    <section id="special-section" class="">
        <div class="container">
            <div class="col-md-12 col-sm-12 wow bounceIn" style="float: none;">
				<div class="section-title">
					<h2><?php echo $title;?></h2>
				</div>
			</div>
            <div class="row shape-container">
                
			
                <div class="shape-trapezoid">
                    <div class="parallax-realcontainer" style="background:linear-gradient( rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) ), url(<?php echo wp_get_attachment_image_src($media_1, 'full')[0]; ?>) no-repeat center bottom / cover;">
                    </div>
                    <div class="innerContainer">                  
                        <div class="label"><?php echo $text_left;?></div>                          
                    </div>
                </div>
                <div class="shape-trapezoid-inv">
                    <div class="parallax-realcontainer" style="background:linear-gradient( rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) ), url(<?php echo wp_get_attachment_image_src($media_2, 'full')[0]; ?>) no-repeat center bottom / cover;">

                    </div>
                    <div class="innerContainer">                  
                        <div class="wrapper">
                          <div class="label"><?php echo $text_right;?></div>                                                        
                        </div>               
                    </div>
                </div>
                
            </div>
        </div>
    </section>