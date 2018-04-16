<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<section id="materials" class="parallax-section">
<div class="container">
		<div class="row">

			<div class="wow fadeInLeft col-md-offset-1 col-md-5 col-sm-8" data-wow-delay="0.9s">
				<ul class="list-materials">
                <li>
                    <button class="btn" target="Wool">
                        <div>Wool</div>
                        <div class="content" style="display:none;">
                                        <h3>Free Domestic Shipping</h3>
                                        <p>All domestic U.S. orders for in-stock items are shipped free of charge.</p>
                                        <p>Please allow two business days to fulfill and issue you a a tracking number (unless there is a red delayed date posted in the product description). Once you receive your tracking number, you should expect&nbsp;your package within 2–4 business days.</p>
                                        <p>Please note that while we&nbsp;will issue you a tracking number once we have sent out your package, you may not be able to track your package immediately. You must wait until your package is scanned in by the Postal Service for tracking to activate.</p>
                                        <p>Orders placed for Workshop items require a shipping fee of $6. These orders will ship during the&nbsp;estimated shipping period noted on the product page.</p>
                                    </div>
                        </button>
                    
                </li>
                  <li>
                    <button class="btn" target="Silk">
                        <div>Silk</div>
                        <div class="content" style="display:none;">
                                        <h3>Returns</h3>
                                        <p>To start the process, click the button in your Shipping or Delivery confirmation email. You can return an item for a full refund or store credit within 60 days of having received it. More on that here. There are some exceptions, though.Free Domestic Shipping</p>
                                    </div>
                        </button>
                    
                </li>
                <li>
                    <button class="btn btn-project-map" target="ProjectMap">  
                        <div>Project Map</div>
                        <div class="background content" style="display:none;">
                                        <?php //include('project-map.php'); ?>
                                    </div>
                        </button>
                    
                </li>
            </ul>
			</div>

		</div>
	</div>
<script>
    $('#materials .btn').on('click', function(){                
        if($('.featherlight .content-nav').find('ul.list-materials').length == 0) {
            $('.featherlight .content-nav').append($(this).parents('#materials ul.list-materials').clone());
            $('.featherlight .btn ').on('click', function(){                
                $('.featherlight .btn ').removeClass('active');
                $(this).addClass('active');
                $('.featherlight .content-area').empty();
                $('.featherlight .content-area').append($(this).find('.content').clone());
                $('.featherlight .content-area .content').show();   
                $('.featherlight').attr('target',$(this).attr('target'));
                if($(this).hasClass('btn-project-map')) {
                    atelierBMap($('.featherlight .content-area').find('#project-map')[0],$('.featherlight .content-area').find('#project-map-def')[0]);
                }
            });
        }
            
        $('.featherlight .content-area').append($(this).find('.content').clone());
        $('.featherlight').show();
        $('.featherlight .btn ').removeClass('active');
        $(this).addClass('active');
        $('.featherlight .content-area .content').show();     
        $('.featherlight').attr('target',$(this).attr('target'));
        
        
        if($(this).hasClass('btn-project-map')) {
            atelierBMap($('.featherlight .content-area').find('#project-map')[0],$('.featherlight .content-area').find('#project-map-def')[0]);
        }
                
    });
    
    $('.featherlight-close-icon.featherlight-close').on('click', function(){
        $('.featherlight').hide();
    });
</script>
</section>