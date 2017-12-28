<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<script type='text/javascript'>
    
$(document).on('click', '#reservation', function(){ 
  $('#modal-reservation').addClass('modal-open');
});

$(document).on('click','#modal-reservation .modal-close' ,function(){ 
 $('#modal-reservation').removeClass('modal-open');
});

</script>
    
<style>
    .container-11-189 {
        width: 100%;
        color: white;
        bottom: 0;
        z-index: 50;
        position: fixed;
        font-family: Roboto;
        background-color: black;
    }
    .limitWidth-11-191 {
        width: 100%;
        margin: auto;
        padding: 36px;
        display: flex;
        max-width: 1596px;
        align-items: center;
        justify-content: space-between;
    }
    .leftContent-11-193 {
        width: 75%;
        display: flex;
        align-items: center;
    }
    .title-11-192 {
    width: 22.3%;
    font-size: 26px;
    font-weight: 300;
    line-height: 1.2rem;
    letter-spacing: .1rem;
}
.linkContainer-11-195 {
    width: 77.7%;
    flex-grow: 1;
}
.sectionLink-11-196 {
    color: white;
    font-size: 18px;
    line-height: 1.75;
    font-weight: 300;
    letter-spacing: 0.4px;
    text-decoration: none;
}

.sectionLink-11-196:after {
    color: #808080;
    content: "|";
    font-size: 14px;
    margin-left: 36px;
    line-height: 30px;
    margin-right: 36px;
}

#content .col-full {
    padding : 0;
}

.modal.modal-open {
  display: block;  
 .modal-fade-screen {
    
    visibility: visible;
    opacity: 1;
    .modal-inner {
        top: 5%;
    }
 }
}
#reservation .btn {
    margin-top: 0;
}
</style>
<div class="refills-components">
<div id="modal-reservation" class="modal">
    <input class="modal-state" id="modal-1" type="checkbox" />
    <div class="modal-fade-screen">
        <div class="modal-inner">
        <div class="modal-close" for="modal-1"></div>
        <?php do_action( 'woocommerce_single_product_summary' ); ?>
    </div>
      
    </div>
</div>
    </div>

<div class="container-11-189" data-reactid="90">
    <div class="limitWidth-11-191" data-reactid="91">
        <div class="leftContent-11-193" data-reactid="92">
            <div class="title-11-192" data-reactid="93">FF 91</div>
            <div class="linkContainer-11-195" data-reactid="94">
                <a class="sectionLink-11-196" href="#user-experience" data-reactid="95">UX</a>
                <a class="sectionLink-11-196" href="#interior" data-reactid="96">Interior</a>
                <a class="sectionLink-11-196" href="#powertrain" data-reactid="97">Powertrain</a>
                <a class="sectionLink-11-196" href="#exterior" data-reactid="98">Exterior</a>
            </div>                  
        </div><!-- react-text: 99 --><!-- /react-text -->
        <div id="reservation" class="container-15-202" >
            <button class="btn btn-lg btn-danger">RESERVATION</button>
        </div> 
    </div>
</div>