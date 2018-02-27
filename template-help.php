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
        <a class="custom-block__link" href="/hc/en-us/categories/115000824407-Products">
          <h4 class="custom-block__title">Products</h4>
        </a>
      </div>
      
      <div class="custom-block">
        <a class="custom-block__link" href="/hc/en-us/categories/115000824347-Payment">
          <h4 class="custom-block__title">Payment</h4>
        </a>
      </div>
      
      <div class="custom-block">
        <a class="custom-block__link" href="/hc/en-us/categories/115000828468-The-Workshop">
          <h4 class="custom-block__title">The Workshop</h4>
        </a>
      </div>
      
      <div class="custom-block">
        <a class="custom-block__link" href="/hc/en-us/categories/115000828528-Order-Status">
          <h4 class="custom-block__title">Order Status</h4>
        </a>
      </div>
      
      <div class="custom-block">
        <a class="custom-block__link" href="/hc/en-us/categories/115000828508-Returns-Exchanges">
          <h4 class="custom-block__title">Returns &amp; Exchanges</h4>
        </a>
      </div>
      
      <div class="custom-block">
        <a class="custom-block__link" href="/hc/en-us/categories/115000828448-My-Account">
          <h4 class="custom-block__title">My Account</h4>
        </a>
      </div>
      
    </div>
  </div>

  </div>

<?php
get_footer();