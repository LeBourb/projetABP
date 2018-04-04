<?php
/**
 * The template for displaying the help.
 *
 * This page template will display any functions hooked into the `homepage` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Help
 *
 * @package storefront
 */

get_header();
?>
<style>
    .custom-block:nth-child(3n+1) {
        clear: left;
    }
    
    .container-help {
        margin-top: 8%;
    }

     .custom-block {
        text-align: center;
    }
    .custom-block {
        margin-bottom: 60px;
        padding-left: 0 !important;
        padding-right: 0 !important;
        display: inline-block;
        margin-right: 60px;
        cursor: pointer;
    }
      
    .custom-blocks {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        color: black;
        justify-content: center;
        padding-left: 10%;
        padding-right: 10%;
    }
    .custom-block__title {
        font-size: 12px;
        letter-spacing: 1.5px; 
        color: #363636 !important;
        font-weight: 450;
        text-transform: uppercase;
        padding-top: 30%;
    }
    .custom-block__link {
        display: block;
        width: 300px;
        height: 200px;
        border: 2px solid #363636;
    }
    
    @media (max-width: 480px) {
       .custom-block {
           margin-right: 0;
           margin-bottom: 40px;
       }
       
       .custom-block__title {
           padding-top: 28%;
       }
       .custom-block__link {
            width: 200px;
            height: 140px;
       }
    }
</style>
<div class="container-help" data-home-page="">
  <div class="container-inner custom-blocks__wrapper">
    <div class="custom-blocks clearfix" id="custom-blocks">
      
      <div class="custom-block">
        <a class="custom-block__link" id="help-product"  href="#product">
          <h4 class="custom-block__title">Products</h4>
        </a>
      </div>
      
      <div class="custom-block">
        <a class="custom-block__link" id="help-payment" href="#payment">
          <h4 class="custom-block__title">Payment</h4>
        </a>
      </div>
      
      <div class="custom-block">
        <a class="custom-block__link" id="help-order-status" href="#order-status">
          <h4 class="custom-block__title">Order Status</h4>
        </a>
      </div>
      
      <div class="custom-block">
        <a class="custom-block__link" id="help-returns-exchanges"  href="#returns-exchanges">
          <h4 class="custom-block__title">Returns &amp; Exchanges</h4>
        </a>
      </div>
        
      <div class="custom-block">
        <a class="custom-block__link" id="help-deposit"  href="#deposit">
          <h4 class="custom-block__title">Deposit</h4>
        </a>
      </div>
        
      <div class="custom-block">
        <a class="custom-block__link" id="help-account-types" href="#account-types">
          <h4 class="custom-block__title">Account Types</h4>
        </a>
      </div>
      
    </div>
    </div>
    <div id="modal-reservation" class="modal">
        <div class="modal-fade-screen">
            <div class="modal-inner">
            <div class="modal-close" for="modal-1"></div>

                <div class="win-content" id="win-help-product" display="none">
                  <h4>Product</h4>  
                  <p>Haec igitur lex in amicitia sanciatur, ut neque rogemus res turpes nec faciamus rogati. Turpis enim excusatio est et minime accipienda cum in ceteris peccatis, tum si quis contra rem publicam se amici causa fecisse fateatur. Etenim eo loco, Fanni et Scaevola, locati sumus ut nos longe prospicere oporteat futuros casus rei publicae. Deflexit iam aliquantum de spatio curriculoque consuetudo maiorum.</p>  
                </div>    
                <div class="win-content" id="win-help-payment"  display="none" >
                    <h4>Payment</h4>  
                    <p>Haec igitur lex in amicitia sanciatur, ut neque rogemus res turpes nec faciamus rogati. Turpis enim excusatio est et minime accipienda cum in ceteris peccatis, tum si quis contra rem publicam se amici causa fecisse fateatur. Etenim eo loco, Fanni et Scaevola, locati sumus ut nos longe prospicere oporteat futuros casus rei publicae. Deflexit iam aliquantum de spatio curriculoque consuetudo maiorum.</p>  
                </div>
                <div class="win-content" id="win-help-order-status" display="none">
                    <h4>Order Status</h4>  
                    <p>Haec igitur lex in amicitia sanciatur, ut neque rogemus res turpes nec faciamus rogati. Turpis enim excusatio est et minime accipienda cum in ceteris peccatis, tum si quis contra rem publicam se amici causa fecisse fateatur. Etenim eo loco, Fanni et Scaevola, locati sumus ut nos longe prospicere oporteat futuros casus rei publicae. Deflexit iam aliquantum de spatio curriculoque consuetudo maiorum.</p>  
                </div>
                <div class="win-content" id="win-help-deposit"  display="none">
                    <h4>Deposit</h4>  
                    <p>Haec igitur lex in amicitia sanciatur, ut neque rogemus res turpes nec faciamus rogati. Turpis enim excusatio est et minime accipienda cum in ceteris peccatis, tum si quis contra rem publicam se amici causa fecisse fateatur. Etenim eo loco, Fanni et Scaevola, locati sumus ut nos longe prospicere oporteat futuros casus rei publicae. Deflexit iam aliquantum de spatio curriculoque consuetudo maiorum.</p>  
                </div>
                <div class="win-content" id="win-help-returns-exchanges"  display="none">
                    <h4>Returns &amp; Exchanges</h4>  
                    <p>Haec igitur lex in amicitia sanciatur, ut neque rogemus res turpes nec faciamus rogati. Turpis enim excusatio est et minime accipienda cum in ceteris peccatis, tum si quis contra rem publicam se amici causa fecisse fateatur. Etenim eo loco, Fanni et Scaevola, locati sumus ut nos longe prospicere oporteat futuros casus rei publicae. Deflexit iam aliquantum de spatio curriculoque consuetudo maiorum.</p>  
                </div>
                <div class="win-content" id="win-help-account-types"  display="none">
                    <h4>Account Types</h4>  
                    <p>Haec igitur lex in amicitia sanciatur, ut neque rogemus res turpes nec faciamus rogati. Turpis enim excusatio est et minime accipienda cum in ceteris peccatis, tum si quis contra rem publicam se amici causa fecisse fateatur. Etenim eo loco, Fanni et Scaevola, locati sumus ut nos longe prospicere oporteat futuros casus rei publicae. Deflexit iam aliquantum de spatio curriculoque consuetudo maiorum.</p>  
                </div>
            </div>        
        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        $('.custom-block__link').click(function(){
            $('.modal').addClass('modal-open');
            $('.modal .win-content').hide();
            $('#win-' + $(this).attr('id')).show();
        });
        $(document).on('click','#modal-reservation .modal-close' ,function(){ 
            $('.modal').removeClass('modal-open'); 
        });
        if(location.hash != "" ) {
            $('.modal').addClass('modal-open');
            $('.modal .win-content').hide();
            $('#win-help-' + location.hash.replace('#','')).show();
        }
    });
    </script>
    <style>
    .modal.modal-open {
        display: block;   
    }

    .modal.modal-open .modal-fade-screen {    
        visibility: visible;
        opacity: 1;
        padding: 0em;
    }

    .modal.modal-open .modal-fade-screen .modal-inner {
        width: 90%;
        max-height: 100%;
    }

    .modal-close {
        z-index: 100;
    }
 
    </style>
<?php
get_footer();