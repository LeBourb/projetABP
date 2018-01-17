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
				<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/overview-img.jpg" class="img-responsive" alt="Overview">
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
							<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img1.jpg" class="img-responsive" alt="program">
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
							<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img2.jpg" class="img-responsive" alt="program">
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
							<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img3.jpg" class="img-responsive" alt="program">
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
							<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img4.jpg" class="img-responsive" alt="program">
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
							<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img5.jpg" class="img-responsive" alt="program">
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
							<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img6.jpg" class="img-responsive" alt="program">
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
							<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img7.jpg" class="img-responsive" alt="program">
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
							<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img8.jpg" class="img-responsive" alt="program">
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
							<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/program-img9.jpg" class="img-responsive" alt="program">
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
				<form id="register-form">
                                        <input name="userid" type="text" class="form-control" id="userid" placeholder="User ID" required>
					<input name="firstname" type="text" class="form-control" id="firstname" placeholder="First Name" required>
					<input name="lastname" type="text" class="form-control" id="lastname" placeholder="Last Name" required>
					<input name="phone" type="telephone" class="form-control" id="phone" placeholder="Phone Number" required>
					<input name="email" type="email" class="form-control" id="email" placeholder="Email Address" required>
                                        <input name="company" type="text" class="form-control" id="company" placeholder="Company Name" required>
                                        <input name="url" type="text" class="form-control" id="url" placeholder="Web Site" >
                                        <input name="address_1" type="text" class="form-control" id="address_1" placeholder="Address 1" required>
                                        <input name="address_2" type="text" class="form-control" id="address_2" placeholder="Address 2">
                                        <input name="city" type="text" class="form-control" id="city" placeholder="City" required>
                                        <input name="postcode" type="text" class="form-control" id="postcode" placeholder="Postcode" required>
					<div class="col-md-offset-6 col-md-6 col-sm-offset-1 col-sm-10">
                                            <!--name="submit"  class="form-control"-->
						<input  id="submit" class="form-control" type="submit" value="REGISTER">
					</div>
                                                                                
				</form>
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
				<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img1.jpg" class="img-responsive" alt="sponsors">	
			</div>

			<div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.6s">
				<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img2.jpg" class="img-responsive" alt="sponsors">	
			</div>

			<div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="0.9s">
				<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img3.jpg" class="img-responsive" alt="sponsors">	
			</div>

			<div class="wow fadeInUp col-md-3 col-sm-6 col-xs-6" data-wow-delay="1s">
				<img src="wp-content/themes/atelierbourgeonspro/assets/images/testhomepage/sponsor-img4.jpg" class="img-responsive" alt="sponsors">	
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
<footer>
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
</footer>


<!-- Back top -->
<a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>



	</div>
</div><!-- #post-## -->
