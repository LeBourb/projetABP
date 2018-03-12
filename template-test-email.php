<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * The template for displaying the login page.
 *
 * This page template will display any functions hooked into the `login` action.
 * By default this includes a variety of product displays and the page content itself. To change the order or toggle these components
 * use the Homepage Control plugin.
 * https://wordpress.org/plugins/homepage-control/
 *
 * Template name: Test_Email
 *
 * @package storefront
 */
echo atelierbourgeons_new_user_approved( '' );
$user = new WP_User( '67' );
echo mail_new_user_checking( $user );
echo mail_new_user_confirm_email( 'tomtom', 'tomtom@gmail.com' );

?>
