(function($) {
 /* jQuery Pre loader
  -----------------------------------------------*/
$(window).load(function(){
    $('.preloader').fadeOut(1000); // set duration in brackets    
});


/* Mobile Navigation
    -----------------------------------------------*/
$(window).scroll(function() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});


/* HTML document is loaded. DOM is ready. 
-------------------------------------------*/
$(document).ready(function() {

  /* Hide mobile menu after clicking on a link
    -----------------------------------------------*/
    $('.navbar-collapse a').click(function(){
        $(".navbar-collapse").collapse('hide');
    });


 /* Parallax section
    -----------------------------------------------*/
  function initParallax() {
    $('#intro').parallax("100%", 0.1);
    $('#overview').parallax("100%", 0.3);
    $('#detail').parallax("100%", 0.2);
    $('#video').parallax("100%", 0.3);
    $('#products').parallax("100%", 0.1);
    $('#program').parallax("100%", 0.2);
    $('#register').parallax("100%", 0.1);
    $('#faq').parallax("100%", 0.3);
    $('#venue').parallax("100%", 0.1);
    $('#sponsors').parallax("100%", 0.3);
    $('#contact').parallax("100%", 0.2);

  }
  initParallax();


  /* Owl Carousel
  -----------------------------------------------*/
  $(document).ready(function() {
    $("#owl-products").owlCarousel({
      autoPlay: 6000,
      items : 4,
      itemsDesktop : [1199,2],
      itemsDesktopSmall : [979,1],
      itemsTablet: [768,1],
      itemsTabletSmall: [985,2],
      itemsMobile : [479,1],
    });
  });


  /* Back top
  -----------------------------------------------*/
    $(window).scroll(function() {
        if ($(this).scrollTop() > 200) {
        $('.go-top').css("display", "flex").fadeIn(200);
        } else {
          $('.go-top').fadeOut(200);
        }
        });   
        // Animate the scroll to top
      $('.go-top').click(function(event) {
        event.preventDefault();
      $('html, body').animate({scrollTop: 0}, 300);
      })


  /* wow
  -------------------------------*/
  new WOW({ mobile: false }).init();

  });

// Ajax register call
$("#register-form").validate({
  submitHandler: function(form) {
    event.preventDefault();
        $( '#register' ).block({
            message: null,
            overlayCSS: {
                    background: '#fff',
                    opacity: 0.6
            }
        });

        var data = {
            //data        : $( '#register-form' ).find( 'input, select, textarea' ).serialize(),
            action      : 'register',
            user_login: $('#register-form [name="userid"]')[0].value ,
            user_email: $('#register-form [name="email"]')[0].value, 
            billing_first_name: $('#register-form [name="firstname"]')[0].value,
            billing_last_name:$('#register-form [name="lastname"]')[0].value,
            billing_company: $('#register-form [name="company"]')[0].value,
            url: $('#register-form [name="url"]')[0].value, 
            billing_address_1: $('#register-form [name="address_1"]')[0].value,
            billing_address_2: $('#register-form [name="address_2"]')[0].value, 
            billing_city: $('#register-form [name="city"]')[0].value, 
            billing_postcode: $('#register-form [name="postcode"]')[0].value,             
            'wp-submit': 'Register'
            //security    : woocommerce_admin_meta_boxes.save_attributes_nonce
        };

        $.post( document.URL.split('?')[0] + 'wp-login.php?action=register', data, function(response) {                        
            //$( "#waaf_tab" ).replaceWith( response );     
             $( '#register' ).unblock();
            var parsed_resp = $(response);
            if(parsed_resp.find('#login_error').length){
                alert(parsed_resp.find('#login_error')[0].innerText);
            }else {
                $('#register .container .row').empty();                
                $('#register .container .row').append('<div class="svg"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="-263.5 236.5 26 26"><g class="svg-success"><circle cx="-250.5" cy="249.5" r="12"/><path d="M-256.46 249.65l3.9 3.74 8.02-7.8"/></g></svg></div>');    
                $('#register .container .row').append(parsed_resp.find('.message'));     
                
            }             
            //$('.wc-enhanced-select').select2()
            // Reload variations panel.
            //var this_page = window.location.toString();
            //this_page = this_page.replace( 'post-new.php?', 'post.php?post=' + woocommerce_admin_meta_boxes.post_id + '&action=edit&' );

        });
  }
});

// Perform AJAX login on form submit
$('form#signin-form #submit').on('click', function(e){
    //$('form#login p.status').show().text(ajax_login_object.loadingmessage);
    $.post(document.URL.split('?')[0] + 'wp-login.php?action=login',
        { 
            log:$('form#signin-form #userid').val(), 
            pwd:$('form#signin-form #password').val(), 
            'wp-submit':'Log In',
            //redirect_to:'http://127.0.0.1:10080/wordpress/shop'
        },
        function(response){            
            var parsed_resp = $(response);
            if(parsed_resp.find('#login_error').length){
                alert(parsed_resp.find('#login_error')[0].innerText);
            }else {
                document.location.href = document.URL.split('?') + "/shop";
            }     
        }
    );
    e.preventDefault();
});
   /* $('#submit').click(function(event) {
       //alert('toto!');
        var isValid = $(event.target).parents('form').isValid();
        if(!isValid) {
          event.preventDefault(); //prevent the default action
          return;
        }
        
        
      })*/

$('a').smoothScroll({
    speed: 1000
});
var scrollPosition, scrollDirection;
$( document ).scroll(function() {
    scrollDirection = 'DOWN';

    if (scrollPosition && scrollPosition > document.documentElement.scrollTop) {
      scrollDirection = 'UP';
    }
    
    scrollPosition = document.documentElement.scrollTop;
    updateMenuBar();
});


  updateMenuBar = function (){
    //scrollPosition, scrollDirection } = this.state;

    if (scrollPosition === 0) {
      $('.navbar').show();
      return;
    }
    if (scrollDirection === 'DOWN' && scrollPosition < 400) {
      $('.navbar').show();
    } else if (scrollDirection === 'UP' && scrollPosition > 0) {
      $('.navbar').show();
    } else {
      $('.navbar').hide();
    }
  }

}(jQuery));