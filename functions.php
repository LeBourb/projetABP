<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version' => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce = require 'inc/woocommerce/class-storefront-woocommerce.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';

	if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.0.0', '>=' ) ) {
		require 'inc/nux/class-storefront-nux-starter-content.php';
	}
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

function my_translate() {

  //$your_content = ob_get_contents();
   //$your_content = preg_replace( '/\<label for="user_login"\>(.*?)\<br/', 'Usernumia: ', $content );
   //$your_content = preg_replace( '/\<label for="user_email"\>(.*?)\<br/', 'Email Sior:', $content );
    
   //ob_get_clean();
   echo $your_content;
}
add_action( 'register_form', 'my_translate', 40);

function v_getUrl() {
  $url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
  $url .= '://' . $_SERVER['SERVER_NAME'];
  $url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
  $url .= $_SERVER['REQUEST_URI'];
  return $url;
}
function v_forcelogin() {
  if( !is_user_logged_in() ) {
    $url = v_getUrl();
    $whitelist = apply_filters('v_forcelogin_whitelist', array());
    $redirect_url = apply_filters('v_forcelogin_redirect', $url);
    if( preg_replace('/\?.*/', '', $url) != preg_replace('/\?.*/', '', wp_login_url()) && !in_array($url, $whitelist) ) {
      wp_safe_redirect( wp_login_url( $redirect_url ), 302 ); exit();
    }
  }
}
//add_action('init', 'v_forcelogin');

/**
 * @snippet       Add First & Last Name to My Account Register Form - WooCommerce
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=21974
 * @author        Rodolfo Melogli
 * @credits       Claudio SM Web
 * @compatible    WC 3.2.1
 */
 
///////////////////////////////
// 1. ADD FIELDS
 
add_action( 'woocommerce_register_form_start', 'bbloomer_add_name_woo_account_registration' );
 
function bbloomer_add_name_woo_account_registration() {
    ?>
 
    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>
 
    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>
 
    <div class="clear"></div>
 
    <p class="form-row form-row-wide">
    <label for="reg_billing_company"><?php _e( 'Shop Name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_company" id="reg_billing_company" value="<?php if ( ! empty( $_POST['billing_company'] ) ) esc_attr_e( $_POST['billing_company'] ); ?>" />
    </p>
    
    <p class="form-row form-row-wide">
    <label for="reg_url"><?php _e( 'Shop Web Site', 'woocommerce' ); ?></label>
    <input type="text" class="input-text" name="url" id="reg_url" value="<?php if ( ! empty( $_POST['url'] ) ) esc_attr_e( $_POST['url'] ); ?>" />
    </p>
    
    <p class="form-row form-row-wide">
    <label for="reg_billing_address_1"><?php _e( 'Shop Address 1', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_address_1" id="reg_billing_address_1" value="<?php if ( ! empty( $_POST['billing_address_1'] ) ) esc_attr_e( $_POST['billing_address_1'] ); ?>" />
    </p>
    
    <p class="form-row form-row-wide">
    <label for="reg_billing_address_1"><?php _e( 'Shop Address 2', 'woocommerce' ); ?></label>
    <input type="text" class="input-text" name="billing_address_2" id="reg_billing_address_2" value="<?php if ( ! empty( $_POST['billing_address_2'] ) ) esc_attr_e( $_POST['billing_address_2'] ); ?>" />
    </p>
    
    <p class="form-row form-row-wide">
    <label for="reg_billing_city"><?php _e( 'Shop City', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_city" id="reg_billing_address_2" value="<?php if ( ! empty( $_POST['billing_city'] ) ) esc_attr_e( $_POST['billing_city'] ); ?>" />
    </p>
    
    
    <p class="form-row form-row-wide">
    <label for="reg_billing_postcode"><?php _e( 'Shop ZIP Code', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_postcode" id="reg_billing_postcode" value="<?php if ( ! empty( $_POST['billing_postcode'] ) ) esc_attr_e( $_POST['billing_postcode'] ); ?>" />
    </p>
    
    
    <p class="form-row form-row-wide">
    <label ><?php _e( 'Shop Country', 'woocommerce' ); ?></label>
    <label >Japan</label>
    </p>
    <?php
}
 
///////////////////////////////
// 2. VALIDATE FIELDS
 
add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3 );
 
function bbloomer_validate_name_fields( $errors, $username, $email ) {
    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
        $errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
        $errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_company'] ) && empty( $_POST['billing_company'] ) ) {
        $errors->add( 'billing_company_error', __( '<strong>Error</strong>: Shop name is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_address_1'] ) && empty( $_POST['billing_address_1'] ) ) {
        $errors->add( 'billing_address_1', __( '<strong>Error</strong>: Shop name is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_city'] ) && empty( $_POST['billing_city'] ) ) {
        $errors->add( 'billing_city', __( '<strong>Error</strong>: Shop city address is required!.', 'woocommerce' ) );
    }
    if ( isset( $_POST['billing_postcode'] ) && empty( $_POST['billing_postcode'] ) ) {
        $errors->add( 'billing_postcode', __( '<strong>Error</strong>: Shop city postcode is required!.', 'woocommerce' ) );
    }
    return $errors;
}
 
///////////////////////////////
// 3. SAVE FIELDS
 
add_action( 'woocommerce_created_customer', 'bbloomer_save_name_fields' );
 
function bbloomer_save_name_fields( $customer_id ) {
    if ( isset( $_POST['billing_first_name'] ) ) {
        update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        update_user_meta( $customer_id, 'shipping_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
        update_user_meta( $customer_id, 'account_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
    }
    if ( isset( $_POST['billing_last_name'] ) ) {
        update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
        update_user_meta( $customer_id, 'shipping_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
        update_user_meta( $customer_id, 'account_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
    }
    if ( isset( $_POST['email'] ) ) {
        update_user_meta( $customer_id, 'billing_email', sanitize_text_field( $_POST['email'] ) );
        update_user_meta( $customer_id, 'user_login', sanitize_text_field( $_POST['email'] ) );
    }
    if ( isset( $_POST['url'] ) ) {
        update_user_meta( $customer_id, 'url', sanitize_text_field( $_POST['url'] ) );
    }
    if ( isset( $_POST['billing_company'] ) ) {
        update_user_meta( $customer_id, 'billing_company', sanitize_text_field( $_POST['billing_company'] ) );     
        update_user_meta( $customer_id, 'shipping_company', sanitize_text_field( $_POST['shipping_company'] ) );     
    }
    if ( isset( $_POST['billing_address_1'] ) ) {
        update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );     
        update_user_meta( $customer_id, 'shipping_address_1', sanitize_text_field( $_POST['shipping_address_1'] ) );     
    }
    if ( isset( $_POST['billing_address_2'] ) ) {
        update_user_meta( $customer_id, 'billing_address_2', sanitize_text_field( $_POST['billing_address_2'] ) );     
        update_user_meta( $customer_id, 'shipping_address_2', sanitize_text_field( $_POST['shipping_address_2'] ) );     
    }
    if ( isset( $_POST['billing_city'] ) ) {
        update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );     
        update_user_meta( $customer_id, 'shipping_city', sanitize_text_field( $_POST['shipping_city'] ) );     
    }
    if ( isset( $_POST['billing_postcode'] ) ) {
        update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );     
        update_user_meta( $customer_id, 'shipping_postcode', sanitize_text_field( $_POST['shipping_postcode'] ) );     
    }
    update_user_meta( $customer_id, 'billing_country', 'Japan' );
    
    update_user_status( $customer_id, 'spam', 1 );
}
