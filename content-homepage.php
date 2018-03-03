<?php
/**
 * The template used for displaying page content in template-homepage.php
 *
 * @package storefront
 */

?>
<?php
$featured_image = get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
?>


<!-- =========================
    INTRO SECTION   
============================== -->
<style>
    video { 
        position: absolute;
        top: 50%;
        left: 50%;
        min-width: 100%;
        min-height: 100%;
        max-width: none;
        width: auto;
        height: auto;
        z-index: -100;
        transform: translateX(-50%) translateY(-50%);
        background-size: cover;
        transition: 1s opacity;        
    }
    
    .fb_dialog.fb_dialog_advanced.fb_shrink_active {
        left: 18pt!important;
    }
</style>
<section id="intro" class="parallax-section">
     <?php // echo wp_video_shortcode( array() );//
    //echo wp_get_attachment_url(  );
    // 
           global $post;
        $videos = get_attached_media( 'video', $post->ID );
        $video = reset($videos);
        //https://la-cascade.io/video-en-background/
 ?>
<video poster="https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/polina.jpg" id="bgvid" playsinline autoplay muted loop >

<source src="<?php echo wp_get_attachment_url( $video->ID );?>" type="video/mp4">
</video>  <!-- WCAG general accessibility recommendation is that media such as background video play through only once. Loop turned on for the purposes of illustration; if removed, the end of the video will fade in the same way created by pressing the "Pause" button  -->

	<div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12">
				<h3 class="wow bounceIn" data-wow-delay="0.9s"><?php echo get_post_meta( $post->ID , 'Home Page Date', true ); ?></h3>
				<h1 class="wow fadeInUp" data-wow-delay="1.6s"><?php echo get_post_meta( $post->ID , 'Home Page Title', true ); ?></h1>
				<a href="#overview" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="2.3s"><?php _e('LEARN MORE','atelierbourgeons') ?></a>
				<a href="#register" class="btn btn-lg btn-danger smoothScroll wow fadeInUp" data-wow-delay="2.3s"><?php _e('REGISTER NOW','atelierbourgeons') ?></a>
			</div>


		</div>
	</div>
</section>


<!-- =========================
    OVERVIEW SECTION   
============================== -->
<section id="overview" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.6s">
				<h3><?php echo get_post_meta( $post->ID , 'Project Details Title', true ); ?></h3>
				<p><?php echo get_post_meta( $post->ID , 'Project Details Description', true ); ?></p>
			</div>
					
			<div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.9s">
                            <img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/overview-img.jpg" class="img-responsive" alt="Overview">
			</div>

		</div>
            
            
	</div>
</section>


<!-- =========================
    DETAIL SECTION   
============================== -->
<section id="detail" class="parallax-section">
	<div class="container">
		<div class="row">

			<!--div class="wow fadeInLeft col-md-4 col-sm-4" data-wow-delay="0.3s">
				<i class="fa fa-handshake-o"></i>
				<h3>650 Participants</h3>
				<p>Quisque ut libero sapien. Integer tellus nisl, efficitur sed dolor at, vehicula finibus massa. Sed tincidunt metus sed eleifend suscipit.</p>
			</div-->


			<div class="wow fadeInRight col-md-4 col-sm-4" data-wow-delay="0.9s">
				<i class="fa fa-lock"></i>
				<h3><?php echo get_post_meta( $post->ID , 'Detail Secure Payment Title', true ); ?></h3>
				<p><?php echo get_post_meta( $post->ID , 'Detail Secure Payment Description', true ); ?></p>
			</div>
                    
                        <div class="wow fadeInRight col-md-4 col-sm-4" data-wow-delay="0.9s">
				<i class="fa fa-tasks"></i>
				<h3><?php echo get_post_meta( $post->ID , 'Detail Deposit Title', true ); ?></h3>
				<p><?php echo get_post_meta( $post->ID , 'Detail Deposit Description', true ); ?></p>
			</div>   
                    
                    
			<div class="wow fadeInUp col-md-4 col-sm-4" data-wow-delay="0.6s">
				<i class="fa fa-clock-o"></i>
				<h3><?php echo get_post_meta( $post->ID , 'Detail Follow Production Title', true ); ?></h3>
				<p><?php echo get_post_meta( $post->ID , 'Detail Follow Production Description', true ); ?></p>
			</div>

		</div>
	</div>
</section>


<!-- =========================
    VIDEO SECTION   
============================== -->
<section id="video" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="wow fadeInUp col-md-6 col-sm-10" data-wow-delay="1.3s">
				<h2><?php echo get_post_meta( $post->ID , 'Video Title', true ); ?></h2>
				<h3><?php echo get_post_meta( $post->ID , 'Video Sub Title', true ); ?></h3>
				<p><?php echo get_post_meta( $post->ID , 'Video Description', true ); ?></p>
			</div>
			<div class="wow fadeInUp col-md-6 col-sm-10" data-wow-delay="1.6s">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/XDPwXQjAlB0" allowfullscreen></iframe>
				</div>
			</div>

		</div>
	</div>
</section>


<!-- =========================
    PRODUCTS SECTION   
============================== -->
<section id="products" class="parallax-section products-image-homepage">
	
    <div class="items-container">
  <?php
  $args     = array( 'post_type' => 'product' );
  $products = get_posts( $args ); 
  foreach($products as $product_id) {
      $product =  wc_get_product($product_id);
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'single-post-thumbnail' );

  ?>


  <a href="<?php echo get_permalink($product_id);?>" class="linkWrapper">
      <div class="parallax parallaxWrapper" style="position: relative; overflow: hidden;">
          <div class="parallax-background-children" style="transform: translate3d(-50%, 0px, 0px); position: absolute; left: 50%; transform-style: preserve-3d; backface-visibility: hidden;">
              <div class="parallax-background backgroundContainer">
                  <div class="parallax-realcontainer" style="background:linear-gradient( rgba(0, 0, 0, 0), rgba(0, 0, 0, 0) ), url(<?php echo $image[0]?>) no-repeat center bottom / cover;">

                  </div>

              </div>

          </div>
          <div class="parallax-content" style="position:relative;">
              <div class="innerContainer innerContainer">
                  <div class="wrapperRight wrapperRight">

                  </div>
                  <div class="wrapper">
                      <div class="divider"></div>                                                        
                  </div>
                  <div class="wrapper">
                      <div class="label"><?php echo $product->get_title(); ?></div>                                                        
                  </div>                                                    
              </div>                                                
          </div>                                            
      </div>
  </a>
  <?php 
  }				
  ?>
    </div>
                              
</section>


<!-- =========================
    WORKSHOP SECTION   
============================== -->
<section id="workshop" class="parallax-section">
   <div class="wow bounceIn" style="visibility: visible; animation-name: bounceIn;">
				<div class="section-title" style="text-align: center;">
					<h2><?php echo get_post_meta( $post->ID, 'Workshop Title', true); ?></h2>
					<p><?php echo get_post_meta( $post->ID, 'Workshop Sub Title', true);?></p>				</div>
			</div>
    <div class="scrollbar">
        <div class="handle"><div class="mousearea"></div></div>
</div>
    <div id="frame" class="frame">
    <ul id="workshop-items" class="slidee" data-wow-delay="1.7s">
    <?php 
        $args = array( 'post_type' => 'shop_workshop' );
        $workshops = get_posts( $args ); 
        foreach($workshops as $workshop) {              
            $image_meta_val=get_post_meta( $workshop->ID, 'second_featured_image', true);            
            $image = wp_get_attachment_image_src( $image_meta_val, 'large');
            
    ?>
    <li class="my-2 mx-auto p-relative bg-white shadow-1 blue-hover" style="width: 360px; overflow: hidden; border-radius: 1px; position: relative;">
        <img src="<?php echo $image[0]; ?>" alt="Man with backpack"    
            class="d-block w-full"
            style="max-height: 175px;
    min-width: 100%;
    width: auto;
    max-width: none;
">
        <div class="px-2 py-2">
          <p class="mb-0 small font-weight-medium text-uppercase mb-1 text-muted lts-2px">
            <?php echo get_post_meta( $workshop->ID, 'workshop_function', true); ?>
          </p>

          <h1 class="ff-serif font-weight-normal text-black card-heading mt-0 mb-1" style="line-height: 1.25;">
            <?php echo get_the_title($workshop); ?>
          </h1>

          <p class="mb-1">
            <?php echo get_the_excerpt($workshop);  ?>            
          </p>

        </div>

        <a href="<?php echo get_permalink($workshop); ?>" class="text-uppercase d-inline-block font-weight-medium lts-2px ml-2 mb-2 text-center styled-link" style="position:absolute;bottom:0;margin-bottom:0;">
          <?php _e('Read More','atelierbourgeons'); ?>
        </a>
    </li>
    <?php 
        }        
    ?>  </ul>
        </div>
    <ul class="pages"></ul>
    
</section>
<script>
    var $frame  = $('#workshop #frame');
		var $slidee = $frame.children('ul').eq(0);
		var $wrap   = $frame.parent();

		// Call Sly on frame
		$frame.sly({
			horizontal: 1,
			itemNav: 'basic',
			smart: 1,
			activateOn: 'click',
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			startAt: 3,
			scrollBar: $wrap.find('.scrollbar'),
			scrollBy: 1,
			pagesBar: $wrap.find('.pages'),
			activatePageOn: 'click',
			speed: 300,
			elasticBounds: 1,			
			dragHandle: 1,
			dynamicHandle: 1,
			clickBar: 1,

		});

		
    //$('#workshop #frame').sly(options);
</script>





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
            </ul>
			</div>

		</div>
	</div>
</section>
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
            });
        }
            
        $('.featherlight .content-area').append($(this).find('.content').clone());
        $('.featherlight').show();
        $('.featherlight .btn ').removeClass('active');
        $(this).addClass('active');
        $('.featherlight .content-area .content').show();     
        $('.featherlight').attr('target',$(this).attr('target'));
    });
    
    $('.featherlight-close-icon.featherlight-close').on('click', function(){
        $('.featherlight').hide();
    });
</script>

<!-- =========================
   Map of resellers
============================== -->

<section id="reseller-map" class="parallax-section">
    <?php include 'reseller-map.php'; ?>
</section>

<!-- =========================
   REGISTER SECTION   
============================== -->

<section id="register" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="wow fadeInUp col-md-7 col-sm-7" data-wow-delay="0.6s">
				<h2><?php echo get_post_meta( $post->ID , 'Register Title', true ); ?></h2>
				<h3><?php echo get_post_meta( $post->ID , 'Register Sub Title', true ); ?></h3>
				<p><?php echo get_post_meta( $post->ID , 'Register Description', true ); ?></p>
			</div>

			<div class="wow fadeInUp col-md-5 col-sm-5" data-wow-delay="1s">
                            <div class="steps" id="steps">
			<span class="step_nb"></span>
			<p class="form_title">Please Fill The field Bellow</p>
				
                                    <?php
		
		//nm_wpregistration_register_url
		//print_r(get_option('nm_wpregistration_settings'));
                $theme_my_login = Theme_My_Login::get_object();
                $instance = $theme_my_login->get_active_instance();
                echo $instance->display('register');
                //echo get_option('nm_wpregistration_register_url');
            //echo $nm_wpregistration->get_option('_register_url');
                    ?>
                        </div>
			</div>

			<div class="col-md-1"></div>

		</div>
	</div>
</section>

<script>
    jQuery( document ).ready( function() {
        $( document ).on( 'click', '#register-form-submit' , function(e) {
            var register_url='<?php
		
		//nm_wpregistration_register_url
		//print_r(get_option('nm_wpregistration_settings'));
                $theme_my_login = Theme_My_Login::get_object();
                $instance = $theme_my_login->get_active_instance();
                echo $instance->get_action_url('register');
                //echo get_option('nm_wpregistration_register_url');
            //echo $nm_wpregistration->get_option('_register_url');
                    ?>';
                            
            e.preventDefault();            
        });
    });
</script>
<!-- =========================
    FAQ SECTION   
============================== -->
<!--section id="faq" class="parallax-section">
	<div class="container">
		<div class="row">

			<!-- Section title
			================================================== 
			<div class="wow bounceIn col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10 text-center">
				<div class="section-title">
					<h2>Do you have Questions?</h2>
					<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
				</div>
			</div>

			<div class="wow fadeInUp col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10" data-wow-delay="0.9s">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  					<div class="panel panel-default">
   						<div class="panel-heading" role="tab" id="headingOne">
      						<h4 class="panel-title">
        						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          							 What is Responsive Design?
        						</a>
      						</h4>
    					</div>
   						<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      						<div class="panel-body">
        						<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet, wisi risus purus augue vulputate voluptate neque, curabitur dolor libero sodales vitae elit massa. Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
								<p>Nunc eu nibh vel augue mollis tincidunt id efficitur tortor. Sed pulvinar est sit amet tellus iaculis hendrerit. Mauris justo erat, rhoncus in arcu at, scelerisque tempor erat.</p>
      						</div>
   						 </div>
 					</div>

    				<div class="panel panel-default">
   						<div class="panel-heading" role="tab" id="headingTwo">
      						<h4 class="panel-title">
        						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          							What are latest UX Developments?
        						</a>
      						</h4>
    					</div>
   						<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      						<div class="panel-body">
                            	<p>Nunc eu nibh vel augue mollis tincidunt id efficitur tortor. Sed pulvinar est sit amet tellus iaculis hendrerit. Mauris justo erat, rhoncus in arcu at, scelerisque tempor erat.</p>
        						<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet, wisi risus purus augue vulputate voluptate neque, curabitur dolor libero sodales vitae elit massa. Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
      						</div>
   						 </div>
 					</div>

 					<div class="panel panel-default">
   						<div class="panel-heading" role="tab" id="headingThree">
      						<h4 class="panel-title">
        						<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          							What things about Social Media will be discussed?
        						</a>
      						</h4>
    					</div>
   						<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      						<div class="panel-body">
                            	<p>Aenean vulputate finibus justo et feugiat. Ut turpis lacus, dapibus quis justo id, porttitor tempor justo. Quisque ut libero sapien. Integer tellus nisl, efficitur sed dolor at, vehicula finibus massa.</p>
        						<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet, wisi risus purus augue vulputate voluptate neque, curabitur dolor libero sodales vitae elit massa. Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
      						</div>
   						 </div>
 					 </div>

 				 </div>
			</div>

		</div>
	</div>
</section>


<!-- =========================
    ICONS SECTION   
============================== -->
<style>
    .collection-stamp {
        display: flex;
        flex-wrap: wrap;
        padding: 20px;
        justify-content: center;
    }
    .stamp {
        width: 13em;
        margin: 1em;
    }
    .wrapper-eco-fabrics {
  display: grid;
  grid-gap: 10px;
  grid-auto-rows: minmax(100px, auto);
  width: 40%;
  min-width: 300px;
  margin-left: auto;
  margin-right: auto;
  text-align: center;
}

.wrapper-eco-fabrics .header {
    grid-column: 1 / 4;
    grid-row: 1;
}
.wrapper-eco-fabrics .one {
  grid-column: 1;
  grid-row: 2;
}
.wrapper-eco-fabrics .two { 
  grid-column: 2;
  grid-row: 2;
}
.wrapper-eco-fabrics .three {
  grid-column: 1;
  grid-row: 3 / 5;
}
.wrapper-eco-fabrics .four {
  grid-column: 2;
  grid-row: 3;
}
.wrapper-eco-fabrics .five {
  grid-column: 2;
  grid-row: 4;
}
</style>
<section id="icons" class="parallax-section">
	<div class="icons">
            
	<div class="collection-stamp">
            
                
                <?php $all_terms = get_terms( 'pa_stamp', apply_filters( 'woocommerce_product_attribute_terms', array(
                        'hide_empty' => false,
                        )  ) );
                
                if ( $all_terms ) {
                    foreach ( $all_terms as $term ) { 
                        $image_attachment_id = get_term_meta( $term->term_id, 'image_attachment_id', true);                        
                        $image_url = wp_get_attachment_image_src( $image_attachment_id );        
                        ?>
                        <div class="stamp" >
                            <div>
                                <p><img class="aligncenter" title="JAPAN-made" src="<?php echo $image_url[0];?>"><br>
                                    <strong><?php echo $term->name; ?></strong>
                                </p>
                                <p><?php echo $term->description; ?></p>
		</div>
                    </div>  <?php }                        
                }                
                ?>
        </div>
       <div class="wrapper-eco-fabrics" style="">     
   <div class="header">                           
<div style="font-size: 28px">
	Fabrics and environment</div>
	<div><div>
			<p style="text-align: center;">We select all our fabrics according to high quality standards and from companies that demonstrate an ongoing commitment to reducing environmental impact. The clothing is dyed in Europe and is completely free of any toxic substances. We only use mills that ensure that wastewater is correctly treated before being returned to the environment.&nbsp;We only work with certified dyes such as <span class="value-link"><a href="http://www.global-standard.org/" target="_blank" rel="noopener noreferrer">GOTS</a>, <a href="http://www.oeko-tex.com/" target="_blank" rel="noopener noreferrer">Oeko-Tex®</a> and <a href="https://www.inditex.com/en/sustainability/product/health_quality_standards" target="_blank" rel="noopener noreferrer">Clear to Wear®</a></span>.</p>
<p style="text-align: center;">Learn more about the fabrics we work with:</p>

		</div>
	</div>
</div>

                    
			<p class="one"><strong>Organic cotton</strong><br>
Organic cotton is grown without the use of chemical pesticides or fertilizers. The aim is to achieve a balance with nature and contribute to a more biologically diverse agriculture. We use organic cotton made in France, Portugal, the Czech Republic, Lithuania, Turkey and Pakistan. It is all <span class="value-link"><a href="http://www.global-standard.org/" target="_blank" rel="noopener noreferrer">GOTS certified</a></span>.</p>
                        
<p  class="two" style="text-align: center;"><strong>Tencel®</strong><br>
Lenzing <span><a>Tencel®</a></span> fibre comes from the pulp of eucalyptus trees. The wood pulp is processed in a “closed loop system” in which 99% of the chemicals are recovered and recycled with minimum waste and low emissions. The <span class="value-link"><a href="http://www.lenzing-fibers.com/en/tencel/" target="_blank" rel="noopener noreferrer">Tencel®</a></span> we use is made in Spain and in Portugal.</p>


                    
			<p class="three" style="text-align: center;"><strong>Recycled Wool</strong><br>
The manufacture of this fabric begins with the sourcing of pre-consumer waste yarn and fabrics from European countries. The waste is converted into fibre using a mechanical process. It is then spun into yarn and finally becomes a new recycled wool fabric. It is blended with 30% polyamide to gain resistance as it has a recycled origin. This fabric is made in Italy.</p>

                        <p class="four" style="text-align: center;"><strong>Hemp</strong><br>
Hemp is highly productive, easy and fast to cultivate. It does not need agrochemicals to grow and enriches the soil with its deep roots.&nbsp;The hemp we use is made in Italy.</p>
                        
<p class="five" style="text-align: center;"><strong>Organic wool</strong><br>
This wool comes from sheep that have been raised on feed which is free from fertilizers or pesticides and has not been subject to mulling practices. The wool is <span class="value-link"><a href="http://www.global-standard.org/" target="_blank" rel="noopener noreferrer">GOTS certified</a></span> and made in Lithuania.</p>

	</div>
    
            

	</div>
</section>

<!-- =========================
    VENUE SECTION   
============================== -->
<section id="venue" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="wow fadeInLeft col-md-offset-1 col-md-5 col-sm-8" data-wow-delay="0.9s">
				<h2>Venue</h2>
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Dolore magna aliquam erat volutpat.</p>
				<h4>New Event</h4>
  				<h4>120 Market Street, Suite 110</h4>
  				<h4>San Francisco, CA 10110</h4>
				<h4>Tel: 010-020-0120</h4>		
			</div>

		</div>
	</div>
</section>


<!-- =========================
    SPONSORS SECTION   
============================== -->
<section id="sponsors" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="wow bounceIn col-md-12 col-sm-12">
				<div class="section-title">
					<h2>Our Sponsors</h2>
					<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
				</div>
			</div>

			<div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.3s">
				<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img1.jpg" class="img-responsive" alt="sponsors">	
			</div>

			<div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.6s">
				<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img2.jpg" class="img-responsive" alt="sponsors">	
			</div>

			<div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.9s">
				<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img3.jpg" class="img-responsive" alt="sponsors">	
			</div>

			<div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="1s">
				<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img4.jpg" class="img-responsive" alt="sponsors">	
			</div>

		</div>
	</div>
</section>

<!-- Back top -->
<a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>



	</div>
</div><!-- #post-## -->
