<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Hook Woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();
$workshop_id = get_post_meta( $product->get_id(), 'product_workshop_id' , true);
$image = wp_get_attachment_url( $attachment_ids[1] );
?>
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/viewer.js"></script>
<link rel="stylesheet" href="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/css/viewer.css">

<style>
    .parallax-window {
        max-height: 30em;
        overflow: hidden;
        position: relative;
        text-align: center;
        width: 100%;
    }

    .parallax-static-content {
        color: #9A9A8A;
        padding: 9em 0;
        position: relative;
        z-index: 9;
    }

    .parallax-background {        
        background-position: top;
        background-size: cover;
        background-color: beige;
        height: 60em;
        left: 0;
        position: absolute;
        top: - 30em / 3;
        width: 100%;
    }
    
    .parallax-section {
        width: 100%;
    }
</style>

<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * Hook: woocommerce_before_single_product_summary.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		//do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<?php
			/**
			 * Hook: Woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			//do_action( 'woocommerce_single_product_summary' );
		?>
	</div>

	<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
    
    <!--
    =========================
        WORKSHOP SECTION   
    ============================== 
    -->
    <?php 
        $post = get_post($workshop_id);
        $wallpaper = get_post_meta( $workshop_id, 'second_featured_image',true);
        $mainfeatureimage = get_post_meta( $workshop_id, 'third_featured_image', true);
        
    ?>
    <style>
        #sect-workshop {
            background: url(<?php echo wp_get_attachment_image_src( $wallpaper, 'large' )[0]; ?>) 50% 0 repeat-y fixed;
            -webkit-background-size: cover;
            background-size: cover;
            background-position: center center;
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
        #product-intro {
            background: url(<?php echo $image; ?>) 50% 0 repeat-y fixed;
            -webkit-background-size: cover;
            background-size: cover;
            background-position: center center;
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
        .go-top {
            bottom: 5em;
        }
    </style>
    <!-- =========================
    INTRO SECTION   
============================== -->
<section id="product-intro" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12">
				<h3 class="wow bounceIn" data-wow-delay="0.9s"><?php echo $product->get_title(); ?></h3>
				<h1 class="wow fadeInUp" data-wow-delay="1.6s"><?php echo $product->get_data()['short_description']; ?></h1>
				<a href="#overview" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="2.3s">LEARN MORE</a>
				<a id="reservation" href="#register" class="btn btn-lg btn-danger smoothScroll wow fadeInUp" data-wow-delay="2.3s">RESERVE NOW</a>
			</div>


		</div>
	</div>
</section>
    <!-- =========================
        IMAGE SECTION   
    ============================== -->
    <section id="gallery" class="parallax-section">
            <div class="container">
                    <div class="row">

                            <div class="wow bounceIn col-md-12 col-sm-12">
                                    <div class="section-title">
                                            <h2>Galeries</h2>
                                            <p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
                                    </div>
                            </div>
                        <div id="am-container">
                            <?php
                                $attachment_ids = $product->get_gallery_image_ids();
                                foreach ( $attachment_ids as $attachment_id ) {
                                    $image_attachment_url = wp_get_attachment_url( $attachment_id );                                    
                                    //$image_url = wp_get_attachment_image_src( $image_attachment_id );
                                    echo '<div href="'. $image_attachment_url .'" class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.3s" data-lightbox="roadtrip" style="cursor:pointer;">
                                        <img src="' . $image_attachment_url . '" class="img-responsive" alt="sponsors">	
                                            <div class="overlay" style="opacity: 0.9; display:none;"></div>
				   
                                    </div>';
                                }
                            ?>
                            </div>
                            

                            <!--div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.6s">
                                    <img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img2.jpg" class="img-responsive" alt="sponsors">	
                            </div>

                            <div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.9s">
                                    <img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img3.jpg" class="img-responsive" alt="sponsors">	
                            </div>

                            <div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="1s">
                                    <img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img4.jpg" class="img-responsive" alt="sponsors">	
                            </div-->

                    </div>
            </div>
    </section>
    <!-- =========================
        Details SECTION   
    ============================== -->
    <section id="overview" class="parallax-section">
            <div class="container">
                    <div class="row">

                            <div class="wow bounceIn col-md-12 col-sm-12">
                                <div class="section-title">
                                    <h2>Details</h2>
                                </div>
                            </div>
                            <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.6s">
                                    
                                    <?php
                                    //<h3>New Event is a fully responsive one-page template for events, conferences or workshops.</h3>
                                    //$postid = the_ID();
                                    //get_the_title($workshop_id);
                                    print_r($product->get_data()['description']);
                                     //$product_details;;
                                    ?>
                                    
                            </div>


                    </div>
            </div>
    </section>
    <!-- =========================
        WORKSHOP SECTION   
    ============================== -->
    <section id="sect-workshop" class="parallax-section">
            <div class="container">
                    <div class="row">

                            <div class="wow bounceIn col-md-12 col-sm-12">
                                <div class="section-title">
                                    <h2>Workshop</h2>
                                </div>
                            </div>
                            <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.6s">
                                    
                                    <?php
                                    //<h3>New Event is a fully responsive one-page template for events, conferences or workshops.</h3>
                                    //$postid = the_ID();
                                    //get_the_title($workshop_id);
                              
                                    $post = get_post($workshop_id);
                                    echo '<h3>' . $post->post_title . '</h3>';
                                    echo '<p>' . $post->post_content . '</p>';
                                    $wallpaper = get_post_meta( $workshop_id, 'second_featured_image',true);
                                    $mainfeatureimage = get_post_meta( $workshop_id, 'third_featured_image', true);
                                    
                                    $wallpaper_url = wp_get_attachment_image_src( $wallpaper , 'large');
                                    $image_url = wp_get_attachment_image_src( $mainfeatureimage , 'large');
                                    
                                    //print_r($post);
                                    //$workshop_id = get_post_meta( $product->get_id(), 'product_workshop_id' , true);
                                    //echo $workshop_id;
                                    //$title = get_the_title($workshop_id);
                                    //<p>This is a Bootstrap v3.3.6 layout that is responsive and mobile friendly. You may download and modify this template for your website. Please tell your friends about templatemo.</p>
                                    //<p>Quisque facilisis scelerisque venenatis. Nam vulputate ultricies luctus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
                                    ?>
                                    
                            </div>

                            <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.9s">
                                    <img src="<?php echo $image_url[0]?>" class="img-responsive" alt="Overview">
                            </div>

                    </div>
            </div>
    </section>
    
    <!-- =========================
    SPEAKERS SECTION   
============================== -->
<section id="speakers" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12 wow bounceIn">
				<div class="section-title">
					<h2>Fabrics</h2>
					<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
				</div>
			</div>

			<!-- Testimonial Owl Carousel section
			================================================== -->
			<div id="owl-speakers" class="owl-carousel">
                            
                            <?php                                 
                                $data = get_post_meta( $product->get_id(), 'product_fabrics', true );
                                if(is_array($data) && array_key_exists('product_fabric_id',$data)){
                                    $product_fabric_ids = $data['product_fabric_id'];    
                                    $index        = -1;
                                    $quantities = $data['product_fabric_quantity'];  
                                    if($product_fabric_ids) {
                                        foreach ( $product_fabric_ids as $fabric_id ) {
                                            $index++;
                                            $quantity = $quantities[$index];                                    
                                            $image_attachment_id = null;
                                            $image_url = null;
                                            $price = null;
                                            $supplier = null;


                                                $image_attachment_id = get_post_meta( $fabric_id, 'image_attachment_id', true);
                                                $image_url = wp_get_attachment_image_src( $image_attachment_id );
                                                $price = get_post_meta( $fabric_id, 'price_term', true);
                                                $supplier = get_post_meta( $fabric_id, 'supplier_id', true);
                                                $supplier =get_the_title( $supplier );
                                            
                                            echo '<div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.9s">
                                                    <div class="speakers-wrapper">
                                                        <img src="'. $image_url[0] . '" class="img-responsive" alt="speakers">
                                                        <div class="speakers-thumb">
                                                            <h3>' . $supplier . '</h3>
                                                            <h6>Price: ' . $price .  '</h6>
                                                        </div>
                                                    </div>
                                                    </div>';
                                        }
                                    }
                                }
                            ?>

				<!--
				<div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.6s">
					<div class="speakers-wrapper">
						<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/speakers-img2.jpg" class="img-responsive" alt="speakers">
							<div class="speakers-thumb">
								<h3>David Yoon</h3>
								<h6>Creative Director</h6>
							</div>
					</div>
				</div>

				<div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.9s">
					<div class="speakers-wrapper">
						<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/speakers-img3.jpg" class="img-responsive" alt="speakers">
							<div class="speakers-thumb">
								<h3>Je Mary Lee</h3>
								<h6>Web Specialist</h6>
							</div>
					</div>
				</div>

				<div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.6s">
					<div class="speakers-wrapper">
						<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/speakers-img4.jpg" class="img-responsive" alt="speakers">
							<div class="speakers-thumb">
								<h3>Johnathan Doe</h3>
								<h6>Frontend Dev</h6>
							</div>
					</div>
				</div>

				<div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.6s">
					<div class="speakers-wrapper">
						<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/speakers-img5.jpg" class="img-responsive" alt="speakers">
							<div class="speakers-thumb">
								<h3>Elite Hamilton</h3>
								<h6>Marketing Guru</h6>
							</div>
					</div>
				</div>
				-->
			</div>

		</div>
	</div>
</section>
    
<!-- =========================
    SPEAKERS SECTION   
============================== -->
<style>
    @keyframes dash {
      to {
        stroke-dashoffset: 0;
      }
    }
    @keyframes fade-in {
        from {
            opacity: 0;
        }  to {
            opacity: 1;
        }
    }
    @keyframes rot-opacity {      
        0% {
            transform: rotate3d(0,1,0,60deg);
            opacity: 0;
        }   
        50% {
            transform: rotate3d(0,1,0,160deg);
            opacity: 0.4;
        }
        100% {
            transform: rotate3d(0,1,0,0deg);
            opacity: 1;
        }
    }
    line {
        animation: dash 5s linear forwards;    
        stroke-dashoffset: 1000;
        stroke-dasharray: 1000;        
    }
    #line-1 {
        animation-delay: 3s;
    }
    #line-2 {
        animation-delay: 4s;
    }
    #line-3 {
        animation-delay: 5s;
    }
    #line-4 {
        animation-delay: 6s;
    }
    #line-5 {
        animation-delay: 7s;
    }
    #circle-1 {
        animation-delay: 3s;
    }
    #circle-2 {
        animation-delay: 4s;
    }
    #circle-3 {
        animation-delay: 4s;
    }
    @keyframes circle-width {
      to {
        transform: scale(1);
      }
    }
    
    .circle {
        background: #004165;
        width: 10px;
        height: 10px;
        margin: auto;
        border-radius: 100%;
        overflow: hidden;
        animation:grow 2s 1 forwards;    
    }
    .parent-circle {
        height: 20px;
        width: 20px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        opacity: 0;
        animation:fade-in 2s 1 forwards;  
        
    }
    
    .now {
       animation:fade-in 2s linear forwards; 
       animation-delay: 6s;
       opacity:0;
    }
    
    .eventBubble {
        animation:rot-opacity 2s 1 forwards;
        opacity: 0;
    }
    
    #event1Bubble {        
        animation-delay: 3s; 
    }
    #event2Bubble {        
        animation-delay: 4s; 
    }
    #event3Bubble {        
        animation-delay: 5s; 
    }
    #parent-circle-1 , 
    #parent-circle-1 .circle {
        animation-delay: 3s; 
    }
    #parent-circle-2 ,
    #parent-circle-2 .circle {
        animation-delay: 4s; 
    }
    #parent-circle-3 ,
    #parent-circle-3 .circle {
        animation-delay: 5s; 
    }
    
    #dot-end {        
        animation:fade-in 2s 1 forwards;
        animation-delay: 7s;
        opacity: 0;
    }

    @keyframes grow {
        0% {
            transform: scale( 0 );
            opacity: 0;
        }   
        50% {
            transform: scale( 0.7 );
            opacity: 0.5;
        }
        100% {
            transform: scale( 1 );
            opacity: 1;
        }
    }
     
</style>
<section id="timeline" class="parallax-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 wow bounceIn">
				<div class="section-title">
					<h2>Time Planning</h2>
					<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
				</div>
                
				<div class="section-title">
					<h2>Remaining Time before closure</h2>				
				
           <ul class="pie-time">
  <li class="chart" data-percent="75"><span>26</span>Jours</li>
  <li class="chart" data-percent="15"><span>15</span>Heures</li>  
</ul>
                                        </div>
			</div>
		
            </div>
        
        <div class="row">
            <div class="Timeline item wow fadeInUp" data-wow-delay="0.6s">

  <svg height="5" width="200">
  <line id="line-1" x1="0" y1="0" x2="200" y2="0" style="stroke:#004165;stroke-width:5" />
  
  <!--animate 
    xlink:href="#my-line-1"
    attributeName="x2"
    from="0"
    to="200" 
    dur="1s"
    begin="1s"
    fill="freeze"
    id="myline1-anim"/-->    
</svg>

  <div class="event1">
    
    <div class="event1Bubble eventBubble" id="event1Bubble" style="">
      <div class="eventTime">
        <div class="DayDigit">02</div>
        <div class="Day">
           Wednesday
          <div class="MonthYear">february 2016</div>
        </div>
      </div>
      <div class="eventTitle">Profile Created</div>
    </div>
    <div class="parent-circle" id="parent-circle-1">
    <div class="circle">

    </div>
    </div>
    <!--svg height="20" width="20">
       <circle id="my-circle-1" cx="10" cy="11" r="5" fill="#004165" />
       <div class="circle">
        </div>
       <!--animate 
    xlink:href="#my-circle-1"
    attributeName="r"
    from="0"
    to="5" 
    dur="1s"
    begin="myline1-anim.begin + 1s"
    fill="freeze" />
     </svg-->
    
  </div>
  
  <svg height="5" width="300">
  <line id="line-2" x1="0" y1="0" x2="300" y2="0" style="stroke:#004165;stroke-width:5" />
</svg>

  <div class="event2">
    
    <div class="event2Bubble eventBubble" id="event2Bubble">
      <div class="eventTime">
        <div class="DayDigit">17</div>
        <div class="Day">
           Thursday
          <div class="MonthYear">April 2016</div>
        </div>
      </div>
      <div class="eventTitle">Phone Interview</div>
    </div>     <!--svg height="20" width="20">
    <circle cx="10" cy="11" r="5" fill="#004165" />
    </svg-->
      <div class="parent-circle" id="parent-circle-2">
    <div class="circle">

    </div>
    </div>
  </div>
  
  <svg height="5" width="50">
  <line id="line-3" x1="0" y1="0" x2="50" y2="0" style="stroke:#004165;stroke-width:5" />
</svg>

  <div class="now">
    NOW
  </div>  
    
  
  <svg height="5" width="150">
  <line id="line-4" x1="0" y1="0" x2="150" y2="0" style="stroke:rgba(162, 164, 163, 0.37);stroke-width:5" />
</svg>
  <div class="event3 futureGray ">
    <div class="event1Bubble eventBubble" id="event3Bubble">
      <div class="eventTime">
        <div class="DayDigit">05</div>
        <div class="Day">
           Tuesday
          <div class="MonthYear">May 2016</div>
        </div>
      </div>
      <div class="eventTitle">Anticipated Hire</div>
    </div>
      <!--svg height="20" width="20">
    <circle cx="10" cy="11" r="5" fill="rgba(162, 164, 163, 0.37)" />
    </svg-->
      <div class="parent-circle" id="parent-circle-3">
    <div class="circle">

    </div>
    </div>
  </div>
<svg height="5" width="50">
<line id="line-5" x1="0" y1="0" x2="50" y2="0" style="stroke:#004165;stroke-width:5" /> 
</svg>
<div id="dot-end">
    <svg height="20" width="42" >
    <line id="line-6" x1="1" y1="0" x2="1" y2="20" style="stroke:#004165;stroke-width:2" /> 
    <circle cx="11" cy="10" r="3" fill="#004165" />  
    <circle cx="21" cy="10" r="3" fill="#004165" />  
    <circle cx="31" cy="10" r="3" fill="#004165" />    
    <line id="line-7" x1="41" y1="0" x2="41" y2="20" style="stroke:#004165;stroke-width:2" /> 
    </svg>  
</div>
</div>
        </div>
        <style>
            #timeline {
                background-image: linear-gradient(135deg, #eaa2a7, #d39296);
            }
.chart{
  display: inline-block;
  text-align: center;
  width: 95px;
  height: 95px;
  margin: 0 10px;
  vertical-align: top;
  position: relative;
    box-sizing: border-box;
    padding-top: 22px;
}
  .chart span{
    display: block;
    font-size: 2em;
    font-weight: normal;
  }

  .chart canvas{
    position: absolute;
    left: 0;
    top: 0;
  }
  
  .pie-time{
      margin-left: 40%;
  }

  
            </style>
            <script>
                
        var options = {
          scaleColor: false,
          trackColor: 'rgba(255,255,255,0.3)',
          barColor: '#E7F7F5',
          lineWidth: 6,
          lineCap: 'butt',
          size: 95
        };

        window.addEventListener('DOMContentLoaded', function() {
          var charts = [];
          [].forEach.call(document.querySelectorAll('.chart'),  function(el) {
            charts.push(new EasyPieChart(el, options));
          });
        });
            </script>
    </div>
</section>

    <!-- Back top -->
    <a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>
</div>
<script>
var viewer = new Viewer(document.getElementById('am-container'), {toolbar:false, title:false});
</script>   
<?php do_action( 'woocommerce_after_single_product' ); ?>