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
    $main_image = get_post_thumbnail_id( $product->get_id() );
$product_image = wp_get_attachment_image_src($main_image , 'single-post-thumbnail' );
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
            background: url(<?php echo $product_image[0] ?  $product_image[0] : ''; ?>) 50% 0 repeat-y fixed;
            -webkit-background-size: cover;
            background-size: cover;
            background-position-y: <?php 
                $image_metas_y = get_post_meta( $main_image, 'focus_position_y', true );
                if($image_metas_y != "") {
                    echo "$image_metas_y%";
                }
                else {
                    echo 'center';
                }
            ?>;
            background-position-x: <?php
                $image_metas_x = get_post_meta( $main_image, 'focus_position_x', true );
                if($image_metas_x != "") {
                    echo "$image_metas_x%";
                }
                else {
                    echo 'center';
                }
            ?>;
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
        
        .product-description {
            min-width: 350px;
            margin-left: auto;
            margin-right: auto;
        }
        div.modal-product-details.product .images {
            margin-top: 20px;
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
				<a href="#overview" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="2.3s">LEARN MORE</a>
                                <?php if(is_user_logged_in()) { ?>
                                    <a id="reservation" class="btn btn-lg btn-danger smoothScroll wow fadeInUp btn-reservation" data-wow-delay="2.3s">RESERVE NOW</a>
                                <?php } else  { ?>
                                    <a id="reservation" href="<?php echo Theme_My_Login::get_page_link( 'login' ); ?>" class="btn btn-lg btn-danger smoothScroll wow fadeInUp" data-wow-delay="2.3s">RESERVE NOW</a>
                                <?php }?>        
			</div>


		</div>
	</div>
</section>
<section id="product-in-short" class="">
    <h4 style="margin:2em;" ><?php echo $product->get_data()['short_description']; ?></h4>
</section>
    <div class="refills-components">
        <?php if(is_user_logged_in()) { ?>
<div id="modal-reservation" class="modal">
    <input class="modal-state" id="modal-1" type="checkbox" />
    
    <div class="modal-fade-screen">
        <div class="modal-inner">
        <div class="modal-close" for="modal-1"></div>
        <div class="modal-product-details product">
            <div class="images" style="display:flex;">
                <div class="woocommerce-product-gallery__image" style="width:50%; padding: 2em;">
                    <!--img class="wp-post-image"></img-->
                    
                         <div id="product-carousel" class="fadeOut owl-carousel owl-theme">
                             <?php 
                                $attachment_ids = $product->get_gallery_image_ids();
                                foreach($attachment_ids as $attachment_id) {
                                    $image_attachment_url = wp_get_attachment_url( $attachment_id ); 
                                    echo '<div class="item">
                                            <img src='. $image_attachment_url . ' />
                                        </div>';
                                }                                    
                             ?>
                             
                </div>
                     <script>
                        $('#product-carousel').owlCarousel({
                            animateOut: 'slideOutDown',
                            animateIn: 'flipInX',
                            items:1,
                            margin:30,
                            stagePadding:30,
                            smartSpeed:450,
                            loop:true,
                            autoplay:true,
                            autoplayTimeout:1000,
                            autoplayHoverPause:true
                        });
   
                </script>
            </div>
            <div class="product-description">
                <?php do_action( 'woocommerce_single_product_summary' ); ?>
            </div>
        </div>
    </div>
      
    </div>
</div>
        <?php } else { 
            // login panel
            ?>
        <div id="modal-login" class="modal">
    <input class="modal-state" id="modal-1" type="checkbox" />
    
    <div class="modal-fade-screen">
        <div class="modal-inner">
        <div class="modal-close" for="modal-1"></div>
       
            <?php //woocommerce_login_form( ); 
            $widget = new Theme_My_Login_Widget();
            $widget->widget(array(),array());?>
       
    </div>
      
    </div>
</div>
            
        <?php } ?>
    </div>
<!-- =========================
        NAV BAR
    ============================== -->
<div class="container-11-189" data-reactid="90">
    <div class="limitWidth-11-191" data-reactid="91">
        <div class="leftContent-11-193" data-reactid="92">
            <div class="title-11-192" data-reactid="93"><?php 
            global $product;
            echo str_replace("|","<br>",$product->get_title());?></div>
            <div class="linkContainer-11-195" data-reactid="94">
                <a class="sectionLink-11-196" href="#user-experience" data-reactid="95">Galery</a>
                <a class="sectionLink-11-196" href="#interior" data-reactid="96">Details</a>
                <a class="sectionLink-11-196" href="#powertrain" data-reactid="97">Fabrics</a>
                <a class="sectionLink-11-196" href="#exterior" data-reactid="98">Workshop</a>
            </div>                  
        </div><!-- react-text: 99 --><!-- /react-text -->
        <div id="reservation" class="container-15-202" >            
            <a class="btn btn-lg btn-danger btn-reservation" <?php if(!is_user_logged_in()) { echo 'href="'. Theme_My_Login::get_page_link( 'login' ) .'"'; } ?>>RESERVE NOW</a>            
        </div> 
    </div>
</div>
    <!-- =========================
        IMAGE SECTION   
    ============================== -->
    <section id="gallery" class="parallax-section">
            <div class="container">
                    <div class="row">
                        <div id="am-container" class="">
                            <?php
                                $attachment_ids = $product->get_gallery_image_ids();
                                $idx=0;
                                $buffer_cell = array();
                                $lg_used_col = 0;
                                $md_used_col = 0;
                                $sm_used_col = 0;
                                $idx=0;
                                
                                while ( count($attachment_ids) || count($buffer_cell)) {
                                    $attachment_id = null;
                                    $image_attachment_url = null;
                                    $width = 0;
                                    $height = 0;
                                    if(count($attachment_ids)) {
                                        $attachment_id = array_shift($attachment_ids);                                    
                                        $image_attachment_url = wp_get_attachment_url( $attachment_id ); 
                                        $image_meta = wp_get_attachment_image_src($attachment_id,'full');
                                        $width = $image_meta[1];
                                        $height = $image_meta[2];
                                    } 
                                    
                                    if( ( $width > $height || count($buffer_cell) ) && $lg_used_col <= 6 && $md_used_col <= 4 && $sm_used_col <= 0)  {                                        
                                        if(!count($buffer_cell) && $width > $height) {
                                            echo '<div href="'. $image_attachment_url .'" class="wow fadeInUp col-lg-6 col-md-8 col-sm-12 col-xs-12" data-wow-delay="0.3s" data-lightbox="roadtrip" style="cursor:pointer;">
                                                <img src="' . $image_attachment_url . '" class="img-responsive" alt="sponsors">	
                                                <div class="overlay" style="opacity: 0.9; display:none;"></div>
                                                </div>';
                                            $lg_used_col += 6;
                                            $md_used_col += 8;
                                            $sm_used_col += 12;
                                        }else if(count($buffer_cell)) {
                                            $cell = array_shift ( $buffer_cell );
                                            echo $cell;
                                            $lg_used_col += 6;
                                            $md_used_col += 8;
                                            $sm_used_col += 12;
                                        }                            
                                        else if ($width > $height) {
                                            $buffer_cell[] = '<div href="'. $image_attachment_url .'" class="wow fadeInUp col-lg-6 col-md-8 col-sm-12 col-xs-12" data-wow-delay="0.3s" data-lightbox="roadtrip" style="cursor:pointer;">
                                            <img src="' . $image_attachment_url . '" class="img-responsive" alt="sponsors">	
                                                <div class="overlay" style="opacity: 0.9; display:none;"></div>
                                                </div>';                                            
                                        }
                                        
                                    }
                                    else if ($width > $height && $image_attachment_url != null) {
                                        $buffer_cell[] = '<div href="'. $image_attachment_url .'" class="wow fadeInUp col-lg-6 col-md-8 col-sm-12 col-xs-12" data-wow-delay="0.3s" data-lightbox="roadtrip" style="cursor:pointer;">
                                        <img src="' . $image_attachment_url . '" class="img-responsive" alt="sponsors">	
                                            <div class="overlay" style="opacity: 0.9; display:none;"></div>
                                            </div>';                                  
                                    }
                                    //$image_url = wp_get_attachment_image_src( $image_attachment_id );
                                    else if ($width <= $height){
                                        
                                        echo '<div href="'. $image_attachment_url .'" class="wow fadeInUp col-lg-3 col-md-4 col-sm-6 col-xs-6" data-wow-delay="0.3s" data-lightbox="roadtrip" style="cursor:pointer;">
                                        <img src="' . $image_attachment_url . '" class="img-responsive" alt="sponsors">	
                                            <div class="overlay" style="opacity: 0.9; display:none;"></div>				   
                                        </div>';
                                        $lg_used_col += 3;
                                        $md_used_col += 4;
                                        $sm_used_col += 6;
                                    }
                                    if(!count($attachment_ids) && ($lg_used_col >= 9 ) ) {
                                       $lg_used_col = 12;
                                    }
                                    if(!count($attachment_ids) && ($md_used_col >= 8 ) ) {
                                       $md_used_col = 12;
                                    }
                                    if(!count($attachment_ids) && ($sm_used_col >= 6 ) ) {
                                       $sm_used_col = 12;
                                    }
                                    
                                    /*echo '$attachment_ids: ' . count($attachment_ids);
                                    echo '$buffer_cell: ' . count($buffer_cell);
                                    echo '$lg_used_col: ' . $lg_used_col;
                                    echo '$md_used_col: ' . $md_used_col;
                                    echo '$sm_used_col: ' . $sm_used_col;*/
                                    
                                        
                                    if($lg_used_col >= 12) {
                                        echo '<div class="clearfix visible-lg"></div>';                                        
                                        $lg_used_col = 0;
                                    }
                                    if($md_used_col >= 12) {
                                        echo '<div class="clearfix visible-md"></div>';       
                                        $md_used_col = 0;
                                    }
                                    if($sm_used_col >= 12) {
                                        echo '<div class="clearfix visible-xs"></div>';
                                        echo '<div class="clearfix visible-sm"></div>';
                                        $sm_used_col = 0;
                                    }
                                                                            
                                    //break;
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
        Awesome SECTIONS   
    ============================== -->
    <?php
    $data = get_post_meta( $post->ID, 'wc_awesome_descriptions', true );
    foreach ($data as $key => $item) { 
        //select template ?
        
        $awesome_value = isset($item['text']) ? $item['text'] : '';
        $meta_key = isset($item['media_id']) ? $item['media_id'] : '';
        $media_1 = isset($item['media_1']) ? $item['media_1'] : '';
        $media_2 = isset($item['media_2']) ? $item['media_2'] : '';
        $title = isset($item['title']) ? $item['title'] : '';
        $text_left = isset($item['text_left']) ? $item['text_left'] : '';
        $text_right = isset($item['text_right']) ? $item['text_right'] : '';
        if (isset($item['template_type']) && $item['template_type'] == "two-pans") {
               include('single-product/view/two-pans.php');
        } else {
            //include('html-product-awesome-description-elem.php');
            include('single-product/view/parallax-right.php');
        }
        
    }
    ?>
    
    <!-- =========================
        Details SECTION   
    ============================== -->
    <!--section id="overview" class="parallax-section">
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
                                    //print_r($product->get_data()['description']);
                                     //$product_details;;
                                    ?>
                                    
                            </div>
                            <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.6s">
                                    
                                    <?php
                                    // DISPLAY STAMP
                                    //<h3>New Event is a fully responsive one-page template for events, conferences or workshops.</h3>
                                    //$postid = the_ID();
                                    //get_the_title($workshop_id);
                                    //include 'wc-stamps-single-product.php';
                                     //$product_details;;
                                    ?>
                                    
                            </div>


                    </div>
            </div>
    </section-->
    <!-- =========================
        WORKSHOP SECTION   
    ============================== -->
    <!--section id="sect-workshop" class="parallax-section">
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
                              
                                    /*$workshop_post = get_post($workshop_id);
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
                                   */ ?>
                                    
                            </div>

                            <div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.9s">
                                    <img src="<?php //echo $image_url[0]?>" class="img-responsive" alt="Overview">
                            </div>

                    </div>
            </div>
    </section!-->
    
    <!-- =========================
    PRODUCTS SECTION   
============================== -->
<section id="products" class="parallax-section">
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
			<div id="owl-products" class="owl-carousel">
                            
                            <?php                                 
                                $data = get_post_meta( $product->get_id(), 'product_fabrics', true );                                
                                if(is_array($data) && array_key_exists('product_fabric_id',$data)){
                                    $product_fabric_ids = $data['product_fabric_id'] ;    
                                    $index        = -1;                                    
                                    if($product_fabric_ids) {
                                        foreach ( $product_fabric_ids as $fabric_id ) {
                                            $index++;
                                            $image_attachment_id = null;
                                            $image_url = null;
                                            $price = null;
                                            $supplier = null;


                                            $image_attachment_id = get_post_meta( $fabric_id, 'image_attachment_id', true);
                                            $image_url = wp_get_attachment_image_src( $image_attachment_id );
                                            $price = get_post_meta( $fabric_id, 'price_term', true);
                                            $supplier_id = get_post_meta( $fabric_id, 'supplier_id', true);
                                            $fabric = get_term_by('id', $fabric_id, 'pa_fabric');
                                                
                                            
                                            echo '<div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.9s">
                                                    <div class="products-wrapper">
                                                        <img src="'. $image_url[0] . '" class="img-responsive" alt="products">
                                                        <div class="products-thumb">
                                                            <h3>' . $fabric->name . '</h3></a>  
                                                                <h4>' . $fabric->description . '</h4>
                                                                <p>Supplier: <a href="' . get_permalink($supplier_id) . '">' . get_the_title($supplier_id) . '</a></p>
                                                        </div>
                                                    </div>
                                                    </div>';
                                        }
                                    }
                                }
                                $data = get_post_meta( $product->get_id(), 'product_supplies', true );
                                if(is_array($data) && array_key_exists('product_supply_id',$data)){
                                    $product_supply_ids = $data['product_supply_id'] ;    
                                    $index        = -1;                                    
                                    if($product_supply_ids) {
                                        foreach ( $product_supply_ids as $supply_id ) {
                                            $index++;
                                            $image_attachment_id = null;
                                            $image_url = null;
                                            $price = null;
                                            $supplier = null;


                                            $image_attachment_id = get_post_meta( $supply_id, 'image_attachment_id', true);
                                            $image_url = wp_get_attachment_image_src( $image_attachment_id );
                                            $price = get_post_meta( $supply_id, 'price_term', true);
                                            $supplier_id = get_post_meta( $supply_id, 'supplier_id', true);
                                            $supply = get_term_by('id', $supply_id, 'pa_supply');
                                                
                                            
                                            echo '<div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.9s">
                                                    <div class="products-wrapper">
                                                        <img src="'. $image_url[0] . '" class="img-responsive" alt="products">
                                                        <div class="products-thumb">
                                                            <h3>' . $supply->name . '</h3></a>  
                                                                <h4>' . $supply->description . '</h4>
                                                                <p>Supplier: <a href="' . get_permalink($supplier_id) . '">' . get_the_title($supplier_id) . '</a></p>
                                                        </div>
                                                    </div>
                                                    </div>';
                                        }
                                    }
                                }
                            ?>

				
			</div>

		</div>
	</div>
</section>
    

    <!-- Back top -->
    <a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>
<!--/div-->
<script>
var viewer = new Viewer(document.getElementById('am-container'), {toolbar:false, title:false});
// leave preview if click outside box: 
var RectContains = function (Ax,w,Ay,h,x, y) {
    console.log('Ax: ' + Ax);
    console.log('w: ' + w);
    console.log('Ay: ' + Ay);
    console.log('h: ' + h);
    console.log('x: ' + x);
    console.log('y: ' + y);
    return Ax <= x && x <= Ax + w &&
        Ay <= y && y <= Ay + h;    
}
$('#am-container').on('shown',function(){
    console.log('shown!');
    $('.viewer-container .viewer-canvas').click(function(evt) {
        console.log(evt);
        Ay = $('.viewer-container .viewer-canvas img')[0].offsetTop;
        h = $('.viewer-container .viewer-canvas img')[0].offsetHeight;        
        Ax= $('.viewer-container .viewer-canvas img')[0].offsetLeft;
        w = $('.viewer-container .viewer-canvas img')[0].offsetWidth;
        x = evt.clientX;
        y = evt.clientY;
        if(!RectContains(Ax,w,Ay,h,x,y)){
            viewer.hide();
        }
    })
});

</script>
<script type='text/javascript'>
<?php if(is_user_logged_in()) { ?>            
$(document).on('click', '#reservation', function(){     
    $('#modal-reservation').addClass('modal-open');    
});

$(document).on('click','#modal-reservation .modal-close' ,function(){ 
 $('#modal-reservation').removeClass('modal-open'); 
});
<?php } ?>


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
            z-index: 50;            
            font-family: Roboto;
            background-color: black;
            display: none;
    }
    
    .container {
        width: 100%;
    }
    
    .sectionLink-11-196 {
        color: white;
        font-size: 18px;
        line-height: 1.75;
        font-weight: 300;
        letter-spacing: 0.4px;
        text-decoration: none;
        display: block;
        text-align: center;
    }

    .sectionLink-11-196:after {
        color: #808080;
        content: "|";
        font-size: 14px;    
        line-height: 30px;

    }
    
    .modal-product-details {
        display:flex;
        flex-wrap: wrap;
    }
    
    .modal-product-details .images {
        flex-grow: 1;
    }
    
    @media screen and (min-width: 1024px) {
        .container-11-189 {            
            position: fixed;
            bottom: 0;
            display:block;
        }
        .limitWidth-11-191 {
            display: flex;
        }
        .leftContent-11-193 {
            width: 75%; 
            display: flex; 
            align-items: center;
        }
         .title-11-192 {
            width: 32.3%;
            font-size: 26px;
            font-weight: 300;
            line-height: 1.2rem;
            letter-spacing: .1rem;
        }
        .sectionLink-11-196 {
            display: flex;
        }
        .sectionLink-11-196:after {
            margin-left: 36px; 
            margin-right: 36px;
            display: flex;
        }
        sectionLink-11-196 {
            display:flex;
        }
        .linkContainer-11-195 {
            width: 77.7%;
            flex-grow: 1;
            display: flex;
        }
    }
    .limitWidth-11-191 {
        width: 100%;
        margin: auto;
        padding: 20px;
        max-width: 1596px;
        align-items: center;
        justify-content: space-between;
    }
    
    .title-11-192 {
        font-size: 20px;
        font-weight: 100;
        line-height: 2.2rem;
        letter-spacing: .1rem;
    }



#content .col-full {
    padding : 0;
}

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
 
div#reservation {
    display: flex;
}

div#reservation .btn {
    margin-top: 0;
    margin-left: auto;
    margin-right: auto;
}
</style>

<?php //do_action( 'woocommerce_after_single_product' ); ?>