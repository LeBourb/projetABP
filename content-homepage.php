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
<section id="intro" class="parallax-section">
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

			<div class="wow fadeInLeft col-md-4 col-sm-4" data-wow-delay="0.3s">
				<i class="fa fa-group"></i>
				<h3>650 Participants</h3>
				<p>Quisque ut libero sapien. Integer tellus nisl, efficitur sed dolor at, vehicula finibus massa. Sed tincidunt metus sed eleifend suscipit.</p>
			</div>

			<div class="wow fadeInUp col-md-4 col-sm-4" data-wow-delay="0.6s">
				<i class="fa fa-clock-o"></i>
				<h3>24 Programs</h3>
				<p>Quisque ut libero sapien. Integer tellus nisl, efficitur sed dolor at, vehicula finibus massa. Sed tincidunt metus sed eleifend suscipit.</p>
			</div>

			<div class="wow fadeInRight col-md-4 col-sm-4" data-wow-delay="0.9s">
				<i class="fa fa-microphone"></i>
				<h3>11 Speakers</h3>
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
	<div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12 wow bounceIn">
				<div class="section-title">
					<h2>Creative Speakers</h2>
					<p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
				</div>
			</div>

			<!-- Testimonial Owl Carousel section
			================================================== -->
			<div id="owl-speakers" class="owl-carousel">
                                <?php
                                $args     = array( 'post_type' => 'product' );
                                $products = get_posts( $args ); 
                                foreach($products as $product_id) {
                                   $product =  wc_get_product($product_id);
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id() ), 'single-post-thumbnail' );
                                    echo '<div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.9s">
					<a href="' . get_permalink($product_id) . '"><div class="speakers-wrapper">
                                            <img src="' . $image[0] . '" class="img-responsive" alt="speakers">
                                            <div class="speakers-thumb">
                                                <h3>' . $product->get_title() . '</h3>								
                                            </div>
					</div></a>
                                    </div>';
                                }
				
                                ?>

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
				</div-->
				
			</div>

		</div>
	</div>
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
				<form id="register-form">
                                    <ul>
					<li class="current_step">
						<input name="userid" type="text" class="form-control" id="userid" placeholder="Shop Name" required>
					</li>
                                        <li>
						<input name="email" type="email" class="form-control" id="email" placeholder="Email Address" required>
					</li>
                                        <li>
						<input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
					</li>
                                        <li>
						<input name="confirm_password" type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" required>
					</li>
					<li>
						<input name="firstname" type="text" class="form-control" id="firstname" placeholder="First Name" required>
					</li>
					<li>
						<input name="lastname" type="text" class="form-control" id="lastname" placeholder="Last Name" required>
					</li>
					<li>
						<input name="phone" type="telephone" class="form-control" id="phone" placeholder="Phone Number" required>
					</li>
                                        <li>
						<input name="email" type="email" class="form-control" id="email" placeholder="Email Address" required>
					</li>
                                        <li>
						<input name="url" type="text" class="form-control" id="url" placeholder="Web Site" >
					</li>
                                        <li>
						<input name="address_1" type="text" class="form-control" id="address_1" placeholder="Address" required>
					</li>
                                        <li>
						<input name="city" type="text" class="form-control" id="city" placeholder="City" required>
					</li>
                                        <li>
						<input name="postcode" type="text" class="form-control" id="postcode" placeholder="Postcode" required>
					</li>
                                        <li>
                                            <div class="col-md-offset-6 col-md-6 col-sm-offset-1 col-sm-10">
                                            <!--name="submit"  class="form-control"-->
						<input  id="submit" class="form-control" type="submit" value="REGISTER">
                                            </div>
                                        </li>
                                    </ul>                                        
					
                                                                                
				</form>
                        </div>
			</div>

			<div class="col-md-1"></div>

		</div>
	</div>
</section>


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
    .edgtf-full-section-inner {
        display: flex;
        padding: 20px;
    }
    .vc_col-sm-3 {
        width : 30%;
    }
</style>
<section id="icons" class="parallax-section">
	<div class="icons">
            
	<div class="clearfix edgtf-full-section-inner">
            <div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element  wpb_animate_when_almost_visible wpb_fadeIn fadeIn wpb_start_animation animated">
		<div class="wpb_wrapper">
			<p><img class="aligncenter wp-image-1494 size-full" title="JAPAN-made" src="http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-eu-made-alicante.png" alt="EU-made" width="283" height="283" srcset="http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-eu-made-alicante.png 283w, http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-eu-made-alicante-100x100.png 100w" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>JAPAN made</strong></p>
<p>This garment is made in Barcelona. Here is where we live, and here is where we work hand by hand with all our manufacturers.</p>
<p><em>We love Barcelona.</em></p>
<p><strong>EU-made (Alicante)</strong></p>
<p>This garment is made in the European city of Alicante, only 3 hours away from Barcelona. We visit our manufacturers there whenever it is necessary to control the production process.</p>
<p><em>It is always a pleasure to travel to Alicante because it is always sunny!</em></p>

		</div>
	</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element  wpb_animate_when_almost_visible wpb_fadeIn fadeIn wpb_start_animation animated">
		<div class="wpb_wrapper">
			<p><img class="aligncenter wp-image-1495 size-full" title="EU-materials" src="http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-eu-materials.png" alt="EU-materials" width="283" height="283" srcset="http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-eu-materials.png 283w, http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-eu-materials-100x100.png 100w" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>EU-materials</strong></p>
<p>The fabric used to make this garment is made in the EU. All the people involved in it’s production process are protected by the EU law.</p>
<p><em>The hands that make this fabric are treated with the same respect as your hands.</em></p>

		</div>
	</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element  wpb_animate_when_almost_visible wpb_fadeIn fadeIn wpb_start_animation animated">
		<div class="wpb_wrapper">
			<p><img class="aligncenter wp-image-1497 size-full" title="Recycled" src="http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-recycled.png" alt="Recycled" width="283" height="283" srcset="http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-recycled.png 283w, http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-recycled-100x100.png 100w" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>Recycled</strong></p>
<p>This garment is made with a yarn that comes from textile waste. Textile waste is sourced and turned into a recycled yarn that is finally weaved into a new fabric.</p>
<p><em>Less waste is more landfill for all.</em></p>

		</div>
	</div>
</div></div></div>
            <div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element  wpb_animate_when_almost_visible wpb_fadeIn fadeIn wpb_start_animation animated">
		<div class="wpb_wrapper">
			<p><img class="aligncenter wp-image-1496 size-full" title="Low Carbon Footprint" src="http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-low-carbon-footprint.png" alt="Low Carbon Footprint" width="283" height="283" srcset="http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-low-carbon-footprint.png 283w, http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-low-carbon-footprint-100x100.png 100w" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>Low Carbon Footprint</strong></p>
<p>The greenhouse gases released to produce this garment are very low due to the proximity of all the suppliers and manufacturers involved in it’s production process.</p>
<p><em>The air we breathe is thankful for that.</em></p>

		</div>
	</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element  wpb_animate_when_almost_visible wpb_fadeIn fadeIn wpb_start_animation animated">
		<div class="wpb_wrapper">
			<p><img class="aligncenter wp-image-1500 size-full" title="Vegan" src="http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-vegan.png" alt="Vegan" width="283" height="283" srcset="http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-vegan.png 283w, http://cus.cat/wp-web/wp-content/uploads/2016/12/stamp-vegan-100x100.png 100w" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>Vegan</strong></p>
<p>This garment is made with materials that do not come from animals.</p>
<p><em>Cruelty-free garment.</em></p>

		</div>
	</div>
</div></div></div><!--div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element  wpb_animate_when_almost_visible wpb_fadeIn fadeIn wpb_start_animation animated">
		<div class="wpb_wrapper">
			<p><img class="aligncenter wp-image-1490 size-full" title="GOTS" src="http://cus.cat/wp-web/wp-content/uploads/2016/12/gots.png" alt="GOTS" width="283" height="283" srcset="http://cus.cat/wp-web/wp-content/uploads/2016/12/gots.png 283w, http://cus.cat/wp-web/wp-content/uploads/2016/12/gots-100x100.png 100w" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>GOTS certified</strong></p>
<p><span class="value-link"><a href="http://www.global-standard.org/" target="_blank">GOTS</a></span> (Global Organic Textile Standard), is the world’s leading certification for organic fabrics. It ensures environmental and social responsibility on textile and fabric production.</p>
<p><em>Certified is always a bonus.</em></p>

		</div>
	</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element  wpb_animate_when_almost_visible wpb_fadeIn fadeIn wpb_start_animation animated">
		<div class="wpb_wrapper">
			<p><img class="aligncenter wp-image-1491 size-full" title="Oeko-Tex®" src="http://cus.cat/wp-web/wp-content/uploads/2016/12/oeko-tex.png" alt="Oeko-Tex®" width="283" height="283" srcset="http://cus.cat/wp-web/wp-content/uploads/2016/12/oeko-tex.png 283w, http://cus.cat/wp-web/wp-content/uploads/2016/12/oeko-tex-100x100.png 100w" sizes="(max-width: 283px) 100vw, 283px"><br>
<strong>Oeko-Tex® Standard</strong></p>
<p>The dyes and inks used to digital print this fabric are <span class="value-link"><a href="http://www.oeko-tex.com/" target="_blank">Oeko-Tex®</a></span> certified. This means that they have non-toxic components.</p>
<p><em>It’s a happy-skin garment.</em></p>

		</div>
	</div>
</div></div></div-->
        </div>
            <div data-edgtf_header_style="edgtf-dark-header" class="vc_row wpb_row vc_row-fluid edgtf-section vc_custom_1484649695431 edgtf-content-aligment-left edgtf-grid-section" style=""><div class="clearfix edgtf-section-inner"><div class="edgtf-section-inner-margin clearfix"><div class="edgtf-row-animations-holder edgtf-element-from-fade" data-animation="edgtf-element-from-fade"><div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"></div></div></div><div class="wpb_column vc_column_container vc_col-sm-6"><div class="vc_column-inner "><div class="wpb_wrapper">
<div class="edgtf-section-title edgtf-section-align-center" style="font-size: 28px">
	Fabrics and environment</div><div class="vc_empty_space" style="height: 20px"><span class="vc_empty_space_inner"></span></div>

	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<p style="text-align: center;">We select all our fabrics according to high quality standards and from companies that demonstrate an ongoing commitment to reducing environmental impact. The clothing is dyed in Europe and is completely free of any toxic substances. We only use mills that ensure that wastewater is correctly treated before being returned to the environment.&nbsp;We only work with certified dyes such as <span class="value-link"><a href="http://www.global-standard.org/" target="_blank" rel="noopener noreferrer">GOTS</a>, <a href="http://www.oeko-tex.com/" target="_blank" rel="noopener noreferrer">Oeko-Tex®</a> and <a href="https://www.inditex.com/en/sustainability/product/health_quality_standards" target="_blank" rel="noopener noreferrer">Clear to Wear®</a></span>.</p>
<p style="text-align: center;">Learn more about the fabrics we work with:</p>

		</div>
	</div>
<div class="vc_empty_space" style="height: 40px"><span class="vc_empty_space_inner"></span></div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"></div></div></div></div></div></div></div></div>
<div data-edgtf_header_style="edgtf-dark-header" class="vc_row wpb_row vc_row-fluid edgtf-section vc_custom_1484649687569 edgtf-content-aligment-left edgtf-grid-section" style=""><div class="clearfix edgtf-section-inner"><div class="edgtf-section-inner-margin clearfix"><div class="edgtf-row-animations-holder edgtf-element-from-fade" data-animation="edgtf-element-from-fade"><div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"></div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<p style="text-align: center;"><strong>Organic cotton</strong><br>
Organic cotton is grown without the use of chemical pesticides or fertilizers. The aim is to achieve a balance with nature and contribute to a more biologically diverse agriculture. We use organic cotton made in France, Portugal, the Czech Republic, Lithuania, Turkey and Pakistan. It is all <span class="value-link"><a href="http://www.global-standard.org/" target="_blank" rel="noopener noreferrer">GOTS certified</a></span>.</p>
<p style="text-align: center;"><strong>Tencel®</strong><br>
Lenzing <span class="value-link"><a href="http://www.lenzing-fibers.com/en/tencel/" target="_blank" rel="noopener noreferrer">Tencel®</a></span> fibre comes from the pulp of eucalyptus trees. The wood pulp is processed in a “closed loop system” in which 99% of the chemicals are recovered and recycled with minimum waste and low emissions. The <span class="value-link"><a href="http://www.lenzing-fibers.com/en/tencel/" target="_blank" rel="noopener noreferrer">Tencel®</a></span> we use is made in Spain and in Portugal.</p>

		</div>
	</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper">
	<div class="wpb_text_column wpb_content_element ">
		<div class="wpb_wrapper">
			<p style="text-align: center;"><strong>Recycled Wool</strong><br>
The manufacture of this fabric begins with the sourcing of pre-consumer waste yarn and fabrics from European countries. The waste is converted into fibre using a mechanical process. It is then spun into yarn and finally becomes a new recycled wool fabric. It is blended with 30% polyamide to gain resistance as it has a recycled origin. This fabric is made in Italy.</p>
<p style="text-align: center;"><strong>Hemp</strong><br>
Hemp is highly productive, easy and fast to cultivate. It does not need agrochemicals to grow and enriches the soil with its deep roots.&nbsp;The hemp we use is made in Italy.</p>
<p style="text-align: center;"><strong>Organic wool</strong><br>
This wool comes from sheep that have been raised on feed which is free from fertilizers or pesticides and has not been subject to mulling practices. The wool is <span class="value-link"><a href="http://www.global-standard.org/" target="_blank" rel="noopener noreferrer">GOTS certified</a></span> and made in Lithuania.</p>

		</div>
	</div>
</div></div></div><div class="wpb_column vc_column_container vc_col-sm-3"><div class="vc_column-inner "><div class="wpb_wrapper"></div></div></div></div></div></div></div></div>

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


<!-- =========================
    CONTACT SECTION   
============================== -->
<section id="contact" class="parallax-section">
	<div class="container">
		<div class="row">

			<div class="wow fadeInUp col-md-offset-1 col-md-5 col-sm-6" data-wow-delay="0.6s">
				<div class="contact_des">
					<h3>New Event</h3>
					<p>Proin sodales convallis urna eu condimentum. Morbi tincidunt augue eros, vitae pretium mi condimentum eget. Suspendisse eu turpis sed elit pretium congue.</p>
					<p>Mauris at tincidunt felis, vitae aliquam magna. Sed aliquam fringilla vestibulum. Praesent ullamcorper mauris fermentum turpis scelerisque rutrum eget eget turpis.</p>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet. Dolore magna aliquam erat volutpat. Lorem ipsum dolor.</p>
					<a href="#" class="btn btn-danger">DOWNLOAD NOW</a>
				</div>
			</div>

			<div class="wow fadeInUp col-md-5 col-sm-6" data-wow-delay="0.9s">
				<div class="contact_detail">
					<div class="section-title">
						<h2>Keep in touch</h2>
					</div>
                                    <?php wp_login_form(  ); ?> 
					<form id="signin-form">
						<!--input name="name" type="password" class="form-control" id="name" placeholder="Name"-->
					  	<input name="userid" type="text" class="form-control" id="userid" placeholder="Email or UserID">
                                                <input name="password" type="password" class="form-control" id="password" placeholder="Password">
					  	<!--textarea name="message" rows="5" class="form-control" id="message" placeholder="Message"></textarea-->
						<div class="col-md-6 col-sm-10">
							<input name="submit" type="submit" class="form-control" id="submit" value="SEND">
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</section>


<!-- =========================
    FOOTER SECTION   
============================== -->
<!--footer>
	<div class="container">
		<div class="row">

			<div class="col-md-12 col-sm-12">
				<p class="wow fadeInUp" data-wow-delay="0.6s">Copyright &copy; 2016 Your Company 
                    
                    | Design: <a rel="nofollow" href="http://www.templatemo.com/page/1" target="_parent">Templatemo</a></p>

				<ul class="social-icon">
					<li><a href="#" class="fa fa-facebook wow fadeInUp" data-wow-delay="1s"></a></li>
					<li><a href="#" class="fa fa-twitter wow fadeInUp" data-wow-delay="1.3s"></a></li>
					<li><a href="#" class="fa fa-dribbble wow fadeInUp" data-wow-delay="1.6s"></a></li>
					<li><a href="#" class="fa fa-behance wow fadeInUp" data-wow-delay="1.9s"></a></li>
					<li><a href="#" class="fa fa-google-plus wow fadeInUp" data-wow-delay="2s"></a></li>
				</ul>

			</div>
			
		</div>
	</div>
</footer-->


<!-- Back top -->
<a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>



	</div>
</div><!-- #post-## -->
