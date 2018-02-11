<?php
/**
 * The template for displaying the login page.
 *
 * This page template will display any functions hooked into the `login` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Login
 *
 * @package storefront
 */
?>
    <html <?php language_attributes(); ?> class="">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
    <?php
include('navbar.php');
$featured_image = get_the_post_thumbnail_url( get_the_ID() );

?>

	
		<main id="main" class="site-main" role="main" style="background:url(<?php echo $featured_image;?>) no-repeat center fixed; background-size: cover; height: 100%;
    margin: 0;">

			<?php while ( have_posts() ) : the_post();

				do_action( 'storefront_page_before' );

				//get_template_part( 'content', 'page' );
                                remove_action('storefront_page','storefront_page_header');
                                do_action('storefront_page');

				/**
				 * Functions hooked in to storefront_page_after action
				 *
				 * @hooked storefront_display_comments - 10
				 */
				do_action( 'storefront_page_after' );

			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	
</body>
</html>
