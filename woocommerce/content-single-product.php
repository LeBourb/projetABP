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
//do_action( 'woocommerce_before_single_product' );
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

global $product;

$attachment_ids = $product->get_gallery_image_ids();
$workshop_id = get_post_meta( $product->get_id(), 'product_workshop_id' , true);
if(isset($attachment_ids[1]))
    $image = wp_get_attachment_url( $attachment_ids[1] );
?>
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/viewer.js"></script>
<link rel="stylesheet" href="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/css/viewer.css">

<style>
    #page .col-full {
        padding: 0;
    }
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



	<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		//do_action( 'woocommerce_after_single_product_summary' );
	?>
    
    <!--
    =========================
        WORKSHOP SECTION   
    ============================== 
    -->
    <?php 
        $workshop_post = get_post($workshop_id);
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
            background: url(<?php echo $image ?  $image : ''; ?>) 50% 0 repeat-y fixed;
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
<!-- =========================
        NAV BAR
    ============================== -->
<div class="container-11-189" data-reactid="90">
    <div class="limitWidth-11-191" data-reactid="91">
        <div class="leftContent-11-193" data-reactid="92">
            <div class="title-11-192" data-reactid="93"><?php 
            global $product;
            echo $product->get_title();?></div>
            <div class="linkContainer-11-195" data-reactid="94">
                <a class="sectionLink-11-196" href="#user-experience" data-reactid="95">Galery</a>
                <a class="sectionLink-11-196" href="#interior" data-reactid="96">Details</a>
                <a class="sectionLink-11-196" href="#powertrain" data-reactid="97">Fabrics</a>
                <a class="sectionLink-11-196" href="#exterior" data-reactid="98">Workshop</a>
            </div>                  
        </div><!-- react-text: 99 --><!-- /react-text -->
        <div id="reservation" class="container-15-202" >
            <button class="btn btn-lg btn-danger">RESERVATION</button>
        </div> 
    </div>
</div>
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
                              
                                    $workshop_post = get_post($workshop_id);
                                    echo '<h3>' . $workshop_post->post_title . '</h3>';
                                    echo '<p>' . $workshop_post->post_content . '</p>';
                                    $wallpaper = get_post_meta( $workshop_id, 'second_featured_image',true);
                                    $mainfeatureimage = get_post_meta( $workshop_id, 'third_featured_image', true);
                                    
                                    $wallpaper_url = wp_get_attachment_image_src( $wallpaper , 'large');
                                    $image_url = wp_get_attachment_image_src( $mainfeatureimage , 'large');
                                    
                                    $data = get_post_meta( $workshop_id, 'gmp_arr', true );
                                    $title = get_the_title($workshop_id);
                                    $address1 = $data['gmp_address1'];
                                    $city = $data['gmp_city'];
                                    $state = $data['gmp_state'];
                                    $zip = $data['gmp_zip'];


                                    $address = '';
                                    $address .=  $title;
                                    $address .= "<br>";
                                    $address .=  $address1;
                                    $address .= " ";
                                    $address .=  $city;
                                    $address .= "<br>";
                                    $address .=  $state;
                                    $address .= "<br>";
                                    $address .=  $zip;
                                    $address .= "<br>";
                                    echo '<p>' . $address . '</p>';
                                    
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
            <?php include 'wc-timeline-single-product.php';?> 
    </div>
</section>

    <!-- Back top -->
    <a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>
<!--/div-->
<script>
var viewer = new Viewer(document.getElementById('am-container'), {toolbar:false, title:false});
</script>
<script type='text/javascript'>
    
$(document).on('click', '#reservation', function(){ 
  $('#modal-reservation').addClass('modal-open');
});

$(document).on('click','#modal-reservation .modal-close' ,function(){ 
 $('#modal-reservation').removeClass('modal-open');
});

</script>
    
<style>
    .col-full .woocommerce {
        position: absolute;
        right: 0;
        z-index: 20000;
    }
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
        padding: 20px;
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
div#reservation {
    display: flex;
}

div#reservation button.btn {
    margin-top: 0;
    margin-left: auto;
    margin-right: auto;
}
</style>

<?php //do_action( 'woocommerce_after_single_product' ); ?>