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
				<h3 class="wow bounceIn" data-wow-delay="0.9s">July 22 - 26 in San Francisco, CA</h3>
				<h1 class="wow fadeInUp" data-wow-delay="1.6s">Web Design Conference</h1>
				<a href="#overview" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="2.3s">LEARN MORE</a>
				<a href="#register" class="btn btn-lg btn-danger smoothScroll wow fadeInUp" data-wow-delay="2.3s">REGISTER NOW</a>
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
				<h3>New Event is a fully responsive one-page template for events, conferences or workshops.</h3>
				<p>This is a Bootstrap v3.3.6 layout that is responsive and mobile friendly. You may download and modify this template for your website. Please tell your friends about templatemo.</p>
				<p>Quisque facilisis scelerisque venenatis. Nam vulputate ultricies luctus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet.</p>
			</div>
					
			<div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.9s">
                            <img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/overview-img.jpg" class="img-responsive" alt="Overview">
			</div>

		</div>
            
            <div class="container">
  <h2>Carousel Example</h2>  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="la.jpg" alt="Los Angeles" style="width:100%;">
      </div>

      <div class="item">
        <img src="chicago.jpg" alt="Chicago" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="ny.jpg" alt="New york" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
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
				<h3>Secure Payment</h3>
				<p>Quisque ut libero sapien. Integer tellus nisl, efficitur sed dolor at, vehicula finibus massa. Sed tincidunt metus sed eleifend suscipit.</p>
			</div>
                    
                        <div class="wow fadeInRight col-md-4 col-sm-4" data-wow-delay="0.9s">
				<i class="fa fa-tasks"></i>
				<h3>Deposit</h3>
				<p>Quisque ut libero sapien. Integer tellus nisl, efficitur sed dolor at, vehicula finibus massa. Sed tincidunt metus sed eleifend suscipit.</p>
			</div>   
                    
                    
			<div class="wow fadeInUp col-md-4 col-sm-4" data-wow-delay="0.6s">
				<i class="fa fa-clock-o"></i>
				<h3>Follow Production</h3>
				<p>Quisque ut libero sapien. Integer tellus nisl, efficitur sed dolor at, vehicula finibus massa. Sed tincidunt metus sed eleifend suscipit.</p>
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
				<h2>Watch Video</h2>
				<h3>Quisque ut libero sapien. Integer tellus nisl, efficitur sed dolor at, vehicula finibus massa. Sed tincidunt metus sed eleifend suscipit.</h3>
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet consectetuer diam nonummy.</p>
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
    SPEAKERS SECTION   
============================== -->
<section id="speakers" class="parallax-section">
	<!--div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12 wow bounceIn">
				<div class="section-title">
					<h2>Creative Speakers</h2>
					<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
				</div>
			</div>

			<!-- Testimonial Owl Carousel section
			==================================================>
			<div id="owl-speakers" class="owl-carousel"-->
                                  <div class="items-container">
                                <?php
                                $args     = array( 'post_type' => 'product' );
                                $products = get_posts( $args ); 
                                foreach($products as $product_id) {
                                    $product =  wc_get_product($product_id);
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'single-post-thumbnail' );
                                    /*echo '<div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.9s">
					<a href="' . get_permalink($product_id) . '"><div class="speakers-wrapper">
                                            <img src="' . $image[0] . '" class="img-responsive" alt="speakers">
                                            <div class="speakers-thumb">
                                                <h3>' . $product->get_title() . '</h3>								
                                            </div>
					</div></a>
                                    </div>';*/
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
                                <!--a href="/us/ff-zero-1" class="linkWrapper-8-308 linkWrapper-8-287" data-reactid="385"><div class="react-parallax parallaxWrapper-8-310 parallaxWrapper-8-288" data-reactid="386" style="position: relative; overflow: hidden;"><div class="react-parallax-background-children" data-reactid="387" style="transform: translate3d(-50%, -11.9363px, 0px); position: absolute; left: 50%; transform-style: preserve-3d; backface-visibility: hidden;"><div class="react-parallax-background backgroundContainer-8-311 backgroundContainer-8-289" data-reactid="388"><div class="container-8-309 container-8-290" data-reactid="389"></div></div></div><div class="react-parallax-content" style="position:relative;" data-reactid="390"><div class="innerContainer-8-312 innerContainer-8-291" data-reactid="391"><div class="wrapperRight-8-314 wrapperRight-8-293" data-reactid="392"><img src="/assets/img/diagonal_se_black.png" role="presentation" class="diagonalLine-8-315 diagonalLine-8-294" data-reactid="393"></div><div class="wrapper-8-313 wrapper-8-292" data-reactid="394"><div class="divider-8-316 divider-8-295" data-reactid="395"></div></div><div class="wrapper-8-313 wrapper-8-292" data-reactid="396"><div class="label-8-317 label-8-296" data-reactid="397">FFZERO1</div></div></div></div></div></a><a href="/our-company" class="linkWrapper-8-319 linkWrapper-8-287" data-reactid="398"><div class="react-parallax parallaxWrapper-8-321 parallaxWrapper-8-288" data-reactid="399" style="position: relative; overflow: hidden;"><div class="react-parallax-background-children" data-reactid="400" style="transform: translate3d(-50%, -11.9363px, 0px); position: absolute; left: 50%; transform-style: preserve-3d; backface-visibility: hidden;"><div class="react-parallax-background backgroundContainer-8-322 backgroundContainer-8-289" data-reactid="401"><div class="container-8-320 container-8-290" data-reactid="402"></div></div></div><div class="react-parallax-content" style="position:relative;" data-reactid="403"><div class="innerContainer-8-323 innerContainer-8-291" data-reactid="404"><div class="wrapperRight-8-325 wrapperRight-8-293" data-reactid="405"><img src="/assets/img/diagonal_se_white.png" role="presentation" class="diagonalLine-8-326 diagonalLine-8-294" data-reactid="406"></div><div class="wrapper-8-324 wrapper-8-292" data-reactid="407"><div class="divider-8-327 divider-8-295" data-reactid="408"></div></div><div class="wrapper-8-324 wrapper-8-292" data-reactid="409"><div class="label-8-328 label-8-296" data-reactid="410">Our Company</div></div></div></div></div></a><a href="/futuresight" class="linkWrapper-8-330 linkWrapper-8-287" data-reactid="411"><div class="react-parallax parallaxWrapper-8-332 parallaxWrapper-8-288" data-reactid="412" style="position: relative; overflow: hidden;"><div class="react-parallax-background-children" data-reactid="413" style="transform: translate3d(-50%, -11.9363px, 0px); position: absolute; left: 50%; transform-style: preserve-3d; backface-visibility: hidden;"><div class="react-parallax-background backgroundContainer-8-333 backgroundContainer-8-289" data-reactid="414"><div class="container-8-331 container-8-290" data-reactid="415"></div></div></div><div class="react-parallax-content" style="position:relative;" data-reactid="416"><div class="innerContainer-8-334 innerContainer-8-291" data-reactid="417"><div class="wrapperRight-8-336 wrapperRight-8-293" data-reactid="418"><img src="/assets/img/diagonal_se_black.png" role="presentation" class="diagonalLine-8-337 diagonalLine-8-294" data-reactid="419"></div><div class="wrapper-8-335 wrapper-8-292" data-reactid="420"><div class="divider-8-338 divider-8-295" data-reactid="421"></div></div><div class="wrapper-8-335 wrapper-8-292" data-reactid="422"><div class="label-8-339 label-8-296" data-reactid="423">FutureSight</div></div></div></div></div></a></div-->

				<!--div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.6s">
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
				
			</div>

		</div>
	</div-->
</section>


<!-- =========================
    PROGRAM SECTION   
============================== -->
<section id="program" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="wow fadeInUp col-md-12 col-sm-12" data-wow-delay="0.6s">
				<div class="section-title">
					<h2>Our Programs</h2>
					<p>Quisque ut libero sapien. Integer tellus nisl, efficitur sed dolor at, vehicula finibus massa. Sed tincidunt metus sed eleifend suscipit.</p>
				</div>
			</div>

			<div class="wow fadeInUp col-md-10 col-sm-10" data-wow-delay="0.9s">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="#fday" aria-controls="fday" role="tab" data-toggle="tab">FIRST DAY</a></li>
					<li><a href="#sday" aria-controls="sday" role="tab" data-toggle="tab">SECOND DAY</a></li>
					<li><a href="#tday" aria-controls="tday" role="tab" data-toggle="tab">THIRD DAY</a></li>
				</ul>
				<!-- tab panes -->
				<div class="tab-content">

					<div role="tabpanel" class="tab-pane active" id="fday">
						<!-- program speaker here -->
						<div class="col-md-2 col-sm-2">
							<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img1.jpg" class="img-responsive" alt="program">
						</div>
						<div class="col-md-10 col-sm-10">
							<h6>
								<span><i class="fa fa-clock-o"></i> 09.00 AM</span> 
								<span><i class="fa fa-map-marker"></i> Room 240</span>
							</h6>
							<h3>Introduction to Design</h3>
							<h4>By Jenny Green</h4>
							<p>Maecenas accumsan metus turpis, eu faucibus ligula interdum in. Mauris at tincidunt felis, vitae aliquam magna. Sed aliquam fringilla vestibulum.</p>
						</div>

						<!-- program divider -->
						<div class="program-divider col-md-12 col-sm-12"></div>

						<!-- program speaker here -->
						<div class="col-md-2 col-sm-2">
							<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img2.jpg" class="img-responsive" alt="program">
						</div>
						<div class="col-md-10 col-sm-10">
							<h6>
								<span><i class="fa fa-clock-o"></i> 10.00 AM</span> 
								<span><i class="fa fa-map-marker"></i> Room 360</span>
							</h6>
							<h3>Front-End Development</h3>
							<h4>By Johnathan Mark</h4>
							<p>Mauris at tincidunt felis, vitae aliquam magna. Sed aliquam fringilla vestibulum. Praesent ullamcorper mauris fermentum turpis scelerisque rutrum eget eget turpis.</p>
						</div>

						<!-- program divider -->
						<div class="program-divider col-md-12 col-sm-12"></div>

						<!-- program speaker here -->
						<div class="col-md-2 col-sm-2">
							<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img3.jpg" class="img-responsive" alt="program">
						</div>
						<div class="col-md-10 col-sm-10">
							<h6>
								<span><i class="fa fa-clock-o"></i> 11.00 AM</span> 
								<span><i class="fa fa-map-marker"></i> Room 450</span>
							</h6>
							<h3>Social Media Marketing</h3>
							<h4>By Johnathan Doe</h4>
							<p>Nam pulvinar, elit vitae rhoncus pretium, massa urna bibendum ex, aliquam efficitur lorem odio vitae erat. Integer rutrum viverra magna, nec ultrices risus rutrum nec.</p>
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="sday">
						<!-- program speaker here -->
						<div class="col-md-2 col-sm-2">
							<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img4.jpg" class="img-responsive" alt="program">
						</div>
						<div class="col-md-10 col-sm-10">
							<h6>
								<span><i class="fa fa-clock-o"></i> 11.00 AM</span> 
								<span><i class="fa fa-map-marker"></i> Room 240</span>
							</h6>
							<h3>Backend Development</h3>
							<h4>By Matt Lee</h4>
							<p>Integer rutrum viverra magna, nec ultrices risus rutrum nec. Pellentesque interdum vel nisi nec tincidunt. Quisque facilisis scelerisque venenatis. Nam vulputate ultricies luctus.</p>
						</div>

						<!-- program divider -->
						<div class="program-divider col-md-12 col-sm-12"></div>

						<!-- program speaker here -->
						<div class="col-md-2 col-sm-2">
							<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img5.jpg" class="img-responsive" alt="program">
						</div>
						<div class="col-md-10 col-sm-10">
							<h6>
								<span><i class="fa fa-clock-o"></i> 01.00 PM</span> 
								<span><i class="fa fa-map-marker"></i> Room 450</span>
							</h6>
							<h3>Web Application Lite</h3>
							<h4>By David Orlando</h4>
							<p>Aliquam faucibus lobortis dolor, id pellentesque eros pretium in. Aenean in erat ut quam aliquet commodo. Vivamus aliquam pulvinar ipsum ut sollicitudin. Suspendisse quis sollicitudin mauris.</p>
						</div>

						<!-- program divider -->
						<div class="program-divider col-md-12 col-sm-12"></div>

						<!-- program speaker here -->
						<div class="col-md-2 col-sm-2">
							<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img6.jpg" class="img-responsive" alt="program">
						</div>
						<div class="col-md-10 col-sm-10">
							<h6>
								<span><i class="fa fa-clock-o"></i> 03.00 PM</span> 
								<span><i class="fa fa-map-marker"></i> Room 650</span>
							</h6>
							<h3>Professional UX Design</h3>
							<h4>By James Lee Mark</h4>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Dolore magna aliquam erat volutpat.</p>
						</div>
					</div>

					<div role="tabpanel" class="tab-pane" id="tday">
						<!-- program speaker here -->
						<div class="col-md-2 col-sm-2">
							<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img7.jpg" class="img-responsive" alt="program">
						</div>
						<div class="col-md-10 col-sm-10">
							<h6>
								<span><i class="fa fa-clock-o"></i> 03.00 PM</span> 
								<span><i class="fa fa-map-marker"></i> Room 750</span>
							</h6>
							<h3>Online Shopping Business</h3>
							<h4>By Michael Walker</h4>
							<p>Aliquam faucibus lobortis dolor, id pellentesque eros pretium in. Aenean in erat ut quam aliquet commodo. Vivamus aliquam pulvinar ipsum ut sollicitudin. Suspendisse quis sollicitudin mauris.</p>
						</div>

						<!-- program divider -->
						<div class="program-divider col-md-12 col-sm-12"></div>

						<!-- program speaker here -->
						<div class="col-md-2 col-sm-2">
							<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img8.jpg" class="img-responsive" alt="program">
						</div>
						<div class="col-md-10 col-sm-10">
							<h6>
								<span><i class="fa fa-clock-o"></i> 05.00 PM</span> 
								<span><i class="fa fa-map-marker"></i> Room 850</span>
							</h6>
							<h3>Introduction to Mobile App</h3>
							<h4>By Cherry Stella</h4>
							<p>Nunc eu nibh vel augue mollis tincidunt id efficitur tortor. Sed pulvinar est sit amet tellus iaculis hendrerit. Mauris justo erat, rhoncus in arcu at, scelerisque tempor erat.</p>
						</div>

						<!-- program divider -->
						<div class="program-divider col-md-12 col-sm-12"></div>

						<!-- program speaker here -->
						<div class="col-md-2 col-sm-2">
							<img src="<?php echo get_site_url()?>/wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img9.jpg" class="img-responsive" alt="program">
						</div>
						<div class="col-md-10 col-sm-10">
							<h6>
								<span><i class="fa fa-clock-o"></i> 07.00 PM</span> 
								<span><i class="fa fa-map-marker"></i> Room 750</span>
							</h6>
							<h3>Bootstrap UI Design</h3>
							<h4>By John David</h4>
							<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Dolore magna aliquam erat volutpat.</p>
						</div>
					</div>

				</div>

		</div>
	</div>
</section>


<!-- =========================
   REGISTER SECTION   
============================== -->

<section id="register" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="wow fadeInUp col-md-7 col-sm-7" data-wow-delay="0.6s">
				<h2>Register Here</h2>
				<h3>Nunc eu nibh vel augue mollis tincidunt id efficitur tortor. Sed pulvinar est sit amet tellus iaculis hendrerit.</h3>
				<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Dolore magna aliquam erat volutpat. Lorem ipsum dolor sit amet consectetuer diam nonummy.</p>
			</div>

			<div class="wow fadeInUp col-md-5 col-sm-5" data-wow-delay="1s">
                            <div class="steps" id="steps">
			<span class="step_nb"></span>
			<p class="form_title">Please Fill The field Bellow</p>
				<!--form id="register-form">
                                    
					
						<input name="userid" type="text" class="form-control" id="userid" placeholder="Shop Name" required>
					
                                        
						<input name="email" type="email" class="form-control" id="email" placeholder="Email Address" required>
					
                                        
						<input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
					
                                        
						<input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" required>
					
					
						<input name="firstname" type="text" class="form-control" id="firstname" placeholder="First Name" required>
					
					
						<input name="lastname" type="text" class="form-control" id="lastname" placeholder="Last Name" required>
					
					
						<input name="phone" type="telephone" class="form-control" id="phone" placeholder="Phone Number" required>
					
                                        
						<input name="url" type="text" class="form-control" id="url" placeholder="Web Site" >
					
                                        
						<input name="address_1" type="text" class="form-control" id="address_1" placeholder="Address" required>
					
                                        
						<input name="city" type="text" class="form-control" id="city" placeholder="City" required>
					
                                        
						<input name="postcode" type="text" class="form-control" id="postcode" placeholder="Postcode" required>
					
                                        
                                            <div class="col-md-offset-6 col-md-6 col-sm-offset-1 col-sm-10">
                                            <!--name="submit"  class="form-control">
						<input  id="register-form-submit" class="form-control" type="submit" value="REGISTER">
                                            </div>
                            
                                                                       
					
                                                                                
				</form-->
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
<section id="faq" class="parallax-section">
	<div class="container">
		<div class="row">

			<!-- Section title
			================================================== -->
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
            
	<div class="stamp" >
		<div >
			<p><img class="aligncenter" title="JAPAN-made" src="<?php echo get_site_url();?>/wp-content/themes/atelierbourgeonspro/assets/images/label/stamp-saw-in-japan.png" alt="EU-made" width="283" height="283" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>JAPAN made</strong></p>
<p>This garment is made in Barcelona. Here is where we live, and here is where we work hand by hand with all our manufacturers.</p>
<p><em>We love Barcelona.</em></p>
<p><strong>EU-made (Alicante)</strong></p>
<p>This garment is made in the European city of Alicante, only 3 hours away from Barcelona. We visit our manufacturers there whenever it is necessary to control the production process.</p>
<p><em>It is always a pleasure to travel to Alicante because it is always sunny!</em></p>

		</div>
	</div>

	<div class="stamp">
		<div>
			<p><img class="aligncenter" title="EU-materials" src="<?php echo get_site_url();?>/wp-content/themes/atelierbourgeonspro/assets/images/label/stamp-fabric-made-in-japan.png" alt="EU-materials" width="283" height="283"  sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>EU-materials</strong></p>
<p>The fabric used to make this garment is made in the EU. All the people involved in it’s production process are protected by the EU law.</p>
<p><em>The hands that make this fabric are treated with the same respect as your hands.</em></p>

		</div>
	</div>

	<div class="stamp">
		<div>
			<p><img class="aligncenter" title="Recycled" src="<?php echo get_site_url();?>/wp-content/themes/atelierbourgeonspro/assets/images/label/stamp-recycled.png" alt="Recycled" width="283" height="283" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>Recycled</strong></p>
<p>This garment is made with a yarn that comes from textile waste. Textile waste is sourced and turned into a recycled yarn that is finally weaved into a new fabric.</p>
<p><em>Less waste is more landfill for all.</em></p>

		</div>
	</div>

	<div class="stamp">
		<div>
			<p><img class="aligncenter" title="Low Carbon Footprint" src="<?php echo get_site_url();?>/wp-content/themes/atelierbourgeonspro/assets/images/label/stamp-low-carbon-footprint.png" alt="Low Carbon Footprint" width="283" height="283" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>Low Carbon Footprint</strong></p>
<p>The greenhouse gases released to produce this garment are very low due to the proximity of all the suppliers and manufacturers involved in it’s production process.</p>
<p><em>The air we breathe is thankful for that.</em></p>

		</div>
	</div>

	<div class="stamp">
		<div>
			<p><img class="aligncenter" title="Vegan" src="<?php echo get_site_url();?>/wp-content/themes/atelierbourgeonspro/assets/images/label/stamp-vegan.png" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>Vegan</strong></p>
<p>This garment is made with materials that do not come from animals.</p>
<p><em>Cruelty-free garment.</em></p>

		</div>
	</div>

	<div class="stamp">
		<div>
			<p><img class="aligncenter" title="Animal Friendly" src="<?php echo get_site_url();?>/wp-content/themes/atelierbourgeonspro/assets/images/label/stamp-cruelty-free.png" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>Animal Friendy</strong></p>
<p>This garment is made with materials that do not come from animals.</p>
<p><em>Cruelty-free garment.</em></p>

		</div>
	</div>
	<div class="stamp">
		<div >
			<p><img class="aligncenter" title="Animal Friendly" src="<?php echo get_site_url();?>/wp-content/themes/atelierbourgeonspro/assets/images/label/stamp-bio.png" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>Animal Friendy</strong></p>
<p>This garment is made with materials that do not come from animals.</p>
<p><em>Cruelty-free garment.</em></p>

		</div>
	</div>
	<div class="stamp">
		<div >
			<p><img class="aligncenter" title="Animal Friendly" src="<?php echo get_site_url();?>/wp-content/themes/atelierbourgeonspro/assets/images/label/stamp-fair-trade.png" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>Animal Friendy</strong></p>
<p>This garment is made with materials that do not come from animals.</p>
<p><em>Cruelty-free garment.</em></p>

		</div>
	</div>
            <!--div ><div ><div >
	<div >
		<div >
			<p><img class="aligncenter wp-image-1490 size-full" title="GOTS" src="http://cus.cat/wp-web/wp-content/uploads/2016/12/gots.png" alt="GOTS" width="283" height="283" srcset="http://cus.cat/wp-web/wp-content/uploads/2016/12/gots.png 283w, http://cus.cat/wp-web/wp-content/uploads/2016/12/gots-100x100.png 100w" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>GOTS certified</strong></p>
<p><span class="value-link"><a href="http://www.global-standard.org/" target="_blank">GOTS</a></span> (Global Organic Textile Standard), is the world’s leading certification for organic fabrics. It ensures environmental and social responsibility on textile and fabric production.</p>
<p><em>Certified is always a bonus.</em></p>

		</div>
	</div>
</div></div></div><div ><div ><div >
	<div >
		<div >
			<p><img class="aligncenter wp-image-1491 size-full" title="Oeko-Tex®" src="http://cus.cat/wp-web/wp-content/uploads/2016/12/oeko-tex.png" alt="Oeko-Tex®" width="283" height="283" srcset="http://cus.cat/wp-web/wp-content/uploads/2016/12/oeko-tex.png 283w, http://cus.cat/wp-web/wp-content/uploads/2016/12/oeko-tex-100x100.png 100w" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>Oeko-Tex® Standard</strong></p>
<p>The dyes and inks used to digital print this fabric are <span class="value-link"><a href="http://www.oeko-tex.com/" target="_blank">Oeko-Tex®</a></span> certified. This means that they have non-toxic components.</p>
<p><em>It’s a happy-skin garment.</em></p>

		</div>
	</div>
</div></div></div-->
        </div>
       <div class="wrapper-eco-fabrics" style="">     
   <div class="header">                           
<div style="font-size: 28px">
	Fabrics and environment</div>

	<div>
		<div>
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
