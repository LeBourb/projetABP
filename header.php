<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php 

if(1) {
    ?>
<title>New Event - Responsive HTML Template</title>
<meta name="description" content="">
<meta name="author" content="">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/css/animate.css">
<link rel="stylesheet" href="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/css/owl.theme.css">
<link rel="stylesheet" href="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/css/homepage.css">
<link rel="stylesheet" href="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/css/timeline.css">
<!-- =========================
     SCRIPTS    
============================== -->
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/jquery.js"></script>
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/jquery.form.js"></script>
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/jquery.validate.js"></script>
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/bootstrap.min.js"></script>
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/jquery.parallax.js"></script>
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/owl.carousel.min.js"></script>
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/smoothscroll.js"></script>
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/wow.min.js"></script>
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/custom.js"></script>
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/easy-pie-chart.js"></script>
<script src="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/js/canvas.js"></script>
 

<!-- Main css -->
<link rel="stylesheet" href="<?php echo get_site_url ()?>/wp-content/themes/atelierbourgeonspro/assets/css/style.css">

<!-- Google Font -->
<link href='https://fonts.googleapis.com/css?family=Poppins:400,500,600' rel='stylesheet' type='text/css'>

</head>
<body data-spy="scroll" data-offset="50" data-target=".navbar-collapse">

<!-- =========================
     PRE LOADER       
============================== -->
<div class="preloader">

	<div class="sk-rotating-plane"></div>

</div>


<!-- =========================
     NAVIGATION LINKS     
============================== -->
<div class="navbar navbar-fixed-top custom-navbar" role="navigation">
	<div class="container">

		<!-- navbar header -->
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
				<span class="icon icon-bar"></span>
			</button>
			<a href="#" class="navbar-brand">New Event</a>
		</div>

		<div class="collapse navbar-collapse">

			<ul class="nav navbar-nav navbar-right">
				
                                <?php
                                // if user connected => display orders ! 
                                //echo wc_get_page_id ( 'view_order' );
                                if(is_user_logged_in()) {
                                    echo '<li><a href="' . get_home_url() . '" >Home</a></li>'; 
                                    echo '<li><a href="' . get_permalink( wc_get_page_id ( 'cart' )) . '" >Cart</a></li>'; 
                                    //echo '<li><a href="' . get_permalink( wc_get_page_id ( 'shop' )) . '" >Shop</a></li>';                                            
                                    $query = new WC_Product_Query( array(
                                        'limit' => 10,
                                        'orderby' => 'date',
                                        'order' => 'DESC',
                                        'return' => 'ids',
                                        'status' => 'publish',
                                    ) );                                    
                                    $product_ids = $query->get_products();
                                    foreach($product_ids as $product_id) {
                                        $product = wc_get_product($product_id);
                                        echo '<li><a href="' . get_permalink( $product_id ) . '" >' . $product->get_title() . '</a></li>';                                            
                                    }
                                    echo '<li><a href="' . get_permalink( wc_get_page_id ( 'myaccount' )) . 'orders/" >Your Orders</a></li>';                                            
                                }else {                                    
                                ?>
                                    <li><a href="#intro" class="smoothScroll">Intro</a></li>
                                    <li><a href="#overview" class="smoothScroll">Overview</a></li>
                                    <li><a href="#speakers" class="smoothScroll">Speakers</a></li>
                                    <li><a href="#program" class="smoothScroll">Programs</a></li>
                                    <li><a href="#register" class="smoothScroll">Register</a></li>
                                    <li><a href="#venue" class="smoothScroll">Venue</a></li>
                                    <li><a href="#sponsors" class="smoothScroll">Sponsors</a></li>
                                    <li><a href="#contact" class="smoothScroll">Contact</a></li>
                                <?php
                                }
                                ?>
			</ul>

		</div>

	</div>
</div>

<?php    
    if(!is_front_page()) {


do_action( 'storefront_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php do_action( 'storefront_before_header' ); ?>

	<!--header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">
		<div class="col-full">

			<?php
			/**
			 * Functions hooked into storefront_header action
			 *
			 * @hooked storefront_skip_links                       - 0
			 * @hooked storefront_social_icons                     - 10
			 * @hooked storefront_site_branding                    - 20
			 * @hooked storefront_secondary_navigation             - 30
			 * @hooked storefront_product_search                   - 40
			 * @hooked storefront_primary_navigation_wrapper       - 42
			 * @hooked storefront_primary_navigation               - 50
			 * @hooked storefront_header_cart                      - 60
			 * @hooked storefront_primary_navigation_wrapper_close - 68
			 */
			//do_action( 'storefront_header' ); ?>

		</div>
	</header><!-- #masthead -->

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 */
	//do_action( 'storefront_before_content' ); ?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full">

		<?php
		/**
		 * Functions hooked in to storefront_content_top
		 *
		 * @hooked woocommerce_breadcrumb - 10
		 */
                  do_action( 'storefront_content_top' );
    }
}