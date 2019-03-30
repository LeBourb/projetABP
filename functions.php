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
$storefront_version = '5.0.5';

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
require 'inc/customize/home-first-section.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce = require 'inc/woocommerce/class-storefront-woocommerce.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
        require 'inc/woocommerce/wc-custom-admin-order.php';
        require 'inc/woocommerce/wc-custom-admin-production.php';
        require 'inc/woocommerce/wc-custom-admin-workshop.php';
        require 'inc/woocommerce/wc-custom-add-to-cart.php';        
        require 'inc/woocommerce/wc-custom-admin-supplier.php';
        require 'inc/woocommerce/wc-product-attribute-workshop.php';
        require 'inc/woocommerce/wc-product-attribute-page-description.php';
        require 'inc/woocommerce/wc-product-attribute-supply.php';
        require 'inc/woocommerce/wc-product-attribute-fabrics.php';
        require 'inc/woocommerce/wc-product-attribute-stamps.php';
        require 'inc/woocommerce/wc-product-attribute-productions.php';
        require 'inc/woocommerce/class-wc-product-attribute-supply-form.php';
        require 'inc/woocommerce/class-wc-product-attribute-fabrics-form.php';        
        require 'inc/woocommerce/wc-prod-admin-variable-pre-sale.php';
        require 'inc/woocommerce/wc-custom-product-price.php';
        require 'inc/woocommerce/gateways/class-wc-gateway-bacs-jp.php';
        require 'inc/woocommerce/wc-custom-product-supplies-tab.php';
        require 'inc/woocommerce/wc-checkout_terms_conditions_popup.php';        
        require 'inc/admin/class-wc-meta-box-product-awesome-description.php';
        require 'inc/admin/class-wc-meta-box-page-awesome-paragraph.php';
        require 'inc/admin/class-wc-meta-box-page-product-workshop-partnership.php';
        require 'inc/admin/class-wc-meta-box-page-workshop-metadata.php';
        require 'inc/admin/class-wc-meta-box-product-size-details.php';
        require 'inc/admin/class-wc-meta-box-product-size-guide.php';
        //require 'inc/emails/class-wc-email-customer-registration-approval-request-pro.php';
        //require 'inc/emails/class-wc-email-customer-registration-approved-pro.php';
        //require 'inc/emails/class-wc-email-customer-registration-denied-pro.php';
        //require 'inc/emails/class-wc-email-customer-registration-new-user-checking-pro.php';
        //require 'inc/emails/class-wc-email-customer-registration-new-user-confirm-email.php';
        //require 'inc/woocommerce/wc-custom-product-workshop-tab.php';
        //require 'inc/woocommerce/wc-custom-product-fabrics-tab.php';
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
    bbloomer_add_name_woo_account_registration();
    //ob_get_clean();
   //echo $your_content;
}
//add_action( 'register_form', 'my_translate', 40);

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
 
//add_action( 'woocommerce_register_form_start', 'bbloomer_add_name_woo_account_registration' );
add_action( 'register_form', 'bbloomer_add_name_woo_account_registration' );

 
function bbloomer_add_name_woo_account_registration() {    
    ?>
 
    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" required/>
    </p>
 
    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" required/>
    </p>
 
    <div class="clear"></div>
 
    <p class="form-row form-row-wide">
    <label for="reg_billing_company"><?php _e( '運営されている店舗の名前', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_company" id="reg_billing_company" value="<?php if ( ! empty( $_POST['billing_company'] ) ) esc_attr_e( $_POST['billing_company'] ); ?>" required/>
    </p>
    
    <p class="form-row form-row-wide">
    <label for="reg_url"><?php _e( '店舗ウェブサイト', 'woocommerce' ); ?></label>
    <input type="text" class="input-text" name="url" id="reg_url" value="<?php if ( ! empty( $_POST['url'] ) ) esc_attr_e( $_POST['url'] ); ?>" />
    </p>
    
    <p class="form-row form-row-wide">
    <label for="reg_billing_address_1"><?php _e( '店舗の住所１', 'woocommerce' ); ?> <span class="required">*</span></label>
    <i>（ネットショップのみで実店舗がない場合は、代表者様の居住地）</i>

    <input type="text" class="input-text" name="billing_address_1" id="reg_billing_address_1" value="<?php if ( ! empty( $_POST['billing_address_1'] ) ) esc_attr_e( $_POST['billing_address_1'] ); ?>" required/>
    </p>
    
    <p class="form-row form-row-wide">
    <label for="reg_billing_address_1"><?php _e( '店舗の住所２', 'woocommerce' ); ?></label>
    <input type="text" class="input-text" name="billing_address_2" id="reg_billing_address_2" value="<?php if ( ! empty( $_POST['billing_address_2'] ) ) esc_attr_e( $_POST['billing_address_2'] ); ?>"/>
    </p>
    
    <p class="form-row form-row-wide">
    <label for="reg_billing_city"><?php _e( '都道府県', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_city" id="reg_billing_address_2" value="<?php if ( ! empty( $_POST['billing_city'] ) ) esc_attr_e( $_POST['billing_city'] ); ?>" required/>
    </p>
    
    
    <p class="form-row form-row-wide">
    <label for="reg_billing_postcode"><?php _e( '郵便番号', 'woocommerce' ); ?> <span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_postcode" id="reg_billing_postcode" value="<?php if ( ! empty( $_POST['billing_postcode'] ) ) esc_attr_e( $_POST['billing_postcode'] ); ?>" required/>
    </p>
    
    
    <p class="form-row form-row-wide">
    <label ><?php _e( '国', 'woocommerce' ); ?></label>
    <label >日本</label>
    </p>
    <?php
}
 
///////////////////////////////
// 2. VALIDATE FIELDS
 
//add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3 );
add_filter( 'registration_errors', 'bbloomer_validate_name_fields' );
 
function bbloomer_validate_name_fields(  $errors  ) {
    //global $_POST;

    // Make sure $errors is a WP_Error object
    //if ( empty( $errors ) )
      //      $errors = new WP_Error(); 
    
    if ( isset( $_POST['account-type'] ) && empty( $_POST['account-type'] ) ) {
        $errors->add( 'account_type_error', __( '<strong>Error</strong>: Account type is required!', 'woocommerce' ) );
    }
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
    if( isset( $_POST['pass1'] ) && isset($_POST['pass2'] ) && $_POST['pass1'] != $_POST['pass2'] ) {        
        $errors->add( 'passport', __( '<strong>Error</strong>: Password must be identic.', 'woocommerce' ) );
    }
    return $errors;
}
 
///////////////////////////////
// 3. SAVE FIELDS
 
//add_action( 'woocommerce_created_customer', 'bbloomer_save_name_fields' );
//add_action('user_register', 'bbloomer_save_name_fields', 60, 1);
add_action('register_new_user', 'bbloomer_save_name_fields', 160, 1);
 
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
        update_user_meta( $customer_id, 'shipping_company', sanitize_text_field( $_POST['billing_company'] ) );     
    }
    if ( isset( $_POST['billing_address_1'] ) ) {
        update_user_meta( $customer_id, 'billing_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );     
        update_user_meta( $customer_id, 'shipping_address_1', sanitize_text_field( $_POST['billing_address_1'] ) );     
    }
    if ( isset( $_POST['billing_address_2'] ) ) {
        update_user_meta( $customer_id, 'billing_address_2', sanitize_text_field( $_POST['billing_address_2'] ) );     
        update_user_meta( $customer_id, 'shipping_address_2', sanitize_text_field( $_POST['billing_address_2'] ) );     
    }
    if ( isset( $_POST['billing_city'] ) ) {
        update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );     
        update_user_meta( $customer_id, 'shipping_city', sanitize_text_field( $_POST['billing_city'] ) );     
    }
    if ( isset( $_POST['pass1'] ) ) {
        wp_set_password( $_POST['pass1'],  $customer_id );
    }
    if ( isset( $_POST['billing_postcode'] ) ) {
        update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );     
        update_user_meta( $customer_id, 'shipping_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );     
    }
    if ( isset( $_POST['account-type'] ) ) {        

        // Make sure user isn't already "Pending"
        if ( $_POST['account-type'] == 'professional'  ) {
            $user = new WP_User( $customer_id );
            // Set user to "Pending" role
            $user->remove_role( 'customer' );
            $user->add_role( 'customer-pro' );
        }
        
   
    }
    
    update_user_meta( $customer_id, 'billing_country', 'JPY' );
    
    //update_user_status( $customer_id, 'spam', 1 );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );    

    
function theme_enqueue_styles() {   
    $theme              = wp_get_theme( 'storefront' );
    $storefront_version = $theme['Version'];
    
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), 'v1.2' );
    wp_enqueue_style( 'animate-style', get_template_directory_uri() . '/assets/css/animate.min.css', array(), 'v1.2' );
    
    //wp_enqueue_style( 'fa-solid-style', get_template_directory_uri() . '/assets/css/fa-solid.min.css' , array(), 'v1.3');
    //wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/assets/css/font-awesome.min.css' , array(), 'v1.2');
    //wp_enqueue_style( 'owl-theme-style', get_template_directory_uri() . '/assets/css/owl.theme.min.css' , array(), 'v1.2');
    //wp_enqueue_style( 'owl-carousel-style', get_template_directory_uri() . '/assets/css/owl.carousel.min.css' , array(), 'v.2.3.4');
    //wp_enqueue_style( 'owl-theme-style', get_template_directory_uri() . '/assets/css/owl.theme.default.min.css' , array());
    //wp_enqueue_style( 'homepage-style', get_template_directory_uri() . '/assets/css/homepage.min.css' , array(), filemtime( getcwd() .  '/wp-content/themes/atelierbourgeonspro/assets/css/homepage.css' ));
    wp_enqueue_style( 'timeline-style', get_template_directory_uri() . '/assets/css/timeline.min.css' , array(), 'v1.2');
    wp_enqueue_style( 'project-gmap-style', get_template_directory_uri() . '/assets/css/project-gmap.min.css' , array(), 'v1.2');
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/style.min.css' , array(), filemtime( getcwd() .  '/wp-content/themes/atelierbourgeonspro/assets/css/style.min.css' ));
    wp_enqueue_style( 'viewer-style', get_template_directory_uri() . '/assets/css/viewer.min.css' , array(), 'v1.2');
    wp_enqueue_style( 'popup-style', get_template_directory_uri() . '/assets/css/popup.min.css' , array(), 'v1.2');
    wp_enqueue_style( 'jquery-ui-style', get_template_directory_uri() . '/assets/css/jquery-ui.css' , array());
    
    //test
    wp_enqueue_style( 'workshop-style', get_template_directory_uri() . '/assets/css/workshop.css' , array(), filemtime( getcwd() .  '/wp-content/themes/atelierbourgeonspro/assets/css/workshop.css' ));
    wp_enqueue_style( 'customSelect-style', get_template_directory_uri() . '/assets/css/jquery.customSelect.css' , array());
    
    
    wp_enqueue_script( 'jquery-ui-script', get_template_directory_uri() . '/assets/js/jquery-ui.js', array() );
    wp_enqueue_script( 'jquery-form-script', get_template_directory_uri() . '/assets/js/jquery.form.min.js', array(), $storefront_version );
    wp_enqueue_script( 'jquery-validate-script', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', array(), $storefront_version);
    wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), $storefront_version );
    wp_enqueue_script( 'jquery-parallax-script', get_template_directory_uri() . '/assets/js/jquery.parallax.min.js', array(), $storefront_version );
    wp_enqueue_script( 'owl-carousel-script', get_template_directory_uri() . '/assets/js/owl.carousel.js', array(), 'v.3.4' );
    wp_enqueue_script( 'smoothscroll-script', get_template_directory_uri() . '/assets/js/smoothscroll.min.js', array(), $storefront_version );
    wp_enqueue_script( 'wow-script', get_template_directory_uri() . '/assets/js/wow.min.js', array(), $storefront_version );
    wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/assets/js/custom.min.js', array(), '2.2.6.7' );
    //wp_enqueue_script( 'easy-pie-chart-script', get_template_directory_uri() . '/assets/js/easy-pie-chart.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'canvas-script', get_template_directory_uri() . '/assets/js/canvas.min.js', array(), $storefront_version );
    wp_enqueue_script( 'sly-script', get_template_directory_uri() . '/assets/js/sly.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'viewer-script', get_template_directory_uri() . '/assets/js/viewer.min.js', array(), $storefront_version );
    wp_enqueue_script( 'popup-script', get_template_directory_uri() . '/assets/js/simplepopup.min.js', array(), $storefront_version );
    wp_enqueue_script( 'img-lazy-load-script', get_template_directory_uri() . '/assets/js/img-lazy-loading.min.js', array(), filemtime( getcwd() .  '/wp-content/themes/atelierbourgeonspro/assets/js/img-lazy-loading.min.js' ) );
    wp_enqueue_script( 'customSelect-script', get_template_directory_uri() . '/assets/js/jquery.customSelect.js', array(), 'v.3.2' );
    //wp_enqueue_script( 'project-gmap-infobox-script', get_template_directory_uri() . '/assets/js/project-gmap-infobox.min.js', array(), 'v1.2' );
    //wp_enqueue_script( 'project-gmap-script', get_template_directory_uri() . '/assets/js/project-gmap.min.js', array(), 'v1.2' );     
    
    if ( is_home() ){
        //wp_enqueue_style( 'blog-style', get_template_directory_uri() . '/assets/css/blog.min.css', array(), filemtime( getcwd() .  '/wp-content/themes/atelierbourgeonspro/assets/css/blog.min.css' ) );
        //wp_enqueue_style( 'blog-style-common', get_template_directory_uri() . '/assets/css/blog-common.min.css' );
        wp_register_script( 'blog-stylejs', get_template_directory_uri() . '/assets/js/blog.min.js' );
        //wp_enqueue_script( 'blog-stylejs');
    } 
    
}


add_action('admin_menu', 'register_my_custom_submenu_page');


function register_my_custom_submenu_page() {
    
    //add_submenu_page( 'edit.php?post_type=shop_production', __( 'Attributes', 'woocommerce' ), __( 'Attributes', 'woocommerce' ), 'manage_product_terms', 'product_attributes', array( $this, 'attributes_page' ) );
    
    add_submenu_page( 'woocommerce', 'Productions', 'Productions', 'manage_options', 'edit.php?post_type=shop_production');//, 'my_custom_submenu_page_callback' ); 
    add_submenu_page( 'woocommerce', 'Workshops', 'Workshops', 'manage_options', 'edit.php?post_type=shop_workshop');//, 'my_custom_submenu_page_callback' ); 
    add_submenu_page( 'woocommerce', 'Suppliers', 'Suppliers', 'manage_options', 'edit.php?post_type=shop_supplier');//, 'my_custom_submenu_page_callback' ); 
}

function my_custom_submenu_page_callback() {
    echo '<h3>My Custom Submenu Page</h3>';
    echo '<h3>hello you</h3>';
    //$loop = new WP_Query( array( 'post_type' => 'production', 'posts_per_page' => 10 ) );
    if ( !class_exists( 'WC_Report_Production_List' ) ) {
	require_once 'inc/woocommerce/class-admin-wc-prod-list.php';
    }
    $myListTable = new WC_Report_Production_List();
    echo '<div class="wrap"><h2>My List Table Test</h2>'; 
    $myListTable->prepare_items(); 
    $myListTable->display(); 
    echo '</div>'; 
    /*while ( $loop->have_posts() ) : $loop->the_post();
      the_title();
      echo '<div>';
      the_content();
      echo '</div>';
    endwhile;*/ 

}

add_action( 'manage_prod_posts_custom_column', 'render_prod_columns' );

add_action( 'woocommerce_order_item_meta_start', 'atelierbourgeons_order_item_production_status' , 10, 2 );
function atelierbourgeons_order_item_production_status( $item_name, $item ) {
         $production_id = $item->get_meta('_production_id',true);
         $html = '';
         if($production_id == '') {
             return;             
         }
         else {
             $html = '<p>生産状況: ';
             $status = get_post_status($production_id);
             switch($status) {
                case 'wc-not-started':
                    $html .= '注文受付中';
                    break;
                case 'wc-supplies-ordered':
                    $html .= '生産用生地・資材の手配中';
                    break;
                case 'wc-supp-delivered':
                    $html .= '生地・資材を工場に発送完了';
                    break;
                case 'wc-in-production':
                    $html .= '生産中';
                    break;
                case 'wc-in-production':
                    $html .= '生産完了';
                    break;                       
                default:
                    //$html .= $status;
                    $html .= '生産前（予約注文受付期間）';
                    break;
             }
             $html .= '</p>';
         }         
         print($html);
 }


function add_attachment_field_position_x( $form_fields, $post ) {
    $form_fields['focus_position_x'] = array(
        'label' => 'Focus Position X (%)',
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'focus_position_x', true ),
        'helps' => '% of image on x axis'
    );
    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'add_attachment_field_position_x', 10, 2 );

function add_attachment_field_position_y( $form_fields, $post ) {
    $form_fields['focus_position_y'] = array(
        'label' => 'Focus Position Y (%)',
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'focus_position_y', true ),
        'helps' => '% of image on y axis'
    );
    return $form_fields;
}
add_filter( 'attachment_fields_to_edit', 'add_attachment_field_position_y', 11, 2 );

function add_attachment_field_position_x_save( $post, $attachment ) {
    if( isset( $attachment['focus_position_x'] ) )
    update_post_meta( $post['ID'], 'focus_position_x', $attachment['focus_position_x'] );

    return $post;
}
add_filter( 'attachment_fields_to_save', 'add_attachment_field_position_x_save', 10, 2 );

function add_attachment_field_position_y_save( $post, $attachment ) {
    if( isset( $attachment['focus_position_y'] ) )
    update_post_meta( $post['ID'], 'focus_position_y', $attachment['focus_position_y'] );

    return $post;
}
add_filter( 'attachment_fields_to_save', 'add_attachment_field_position_y_save', 11, 3 );


add_filter( 'woocommerce_order_button_text', 'atelierbourgeons_order_button_text' );
function atelierbourgeons_order_button_text( ) {
    return '注文を確定する';
}

add_filter( 'woocommerce_date_format', 'atelierbourgeons_date_format' );
function atelierbourgeons_date_format( ) {
    return 'Y年m月d日';
}



/**
* Output custom columns for prods.
*
* @param string $column
*/
function render_prod_columns( $column ) {
    global $post, $the_prod;

    if ( empty( $the_prod ) || $the_prod->get_id() != $post->ID ) {
            $the_prod = wc_get_prod( $post );
    }

    // Only continue if we have a prod.
    if ( empty( $the_prod ) ) {
            return;
    }

    switch ( $column ) {
            case 'thumb' :
                    echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . $the_prod->get_image( 'thumbnail' ) . '</a>';
                    break;
            case 'name' :
                    $edit_link = get_edit_post_link( $post->ID );
                    $title     = _draft_or_post_title();

                    echo '<strong><a class="row-title" href="' . esc_url( $edit_link ) . '">' . esc_html( $title ) . '</a>';

                    _post_states( $post );

                    echo '</strong>';

                    if ( $post->post_parent > 0 ) {
                            echo '&nbsp;&nbsp;&larr; <a href="' . get_edit_post_link( $post->post_parent ) . '">' . get_the_title( $post->post_parent ) . '</a>';
                    }

                    // Excerpt view
                    if ( isset( $_GET['mode'] ) && 'excerpt' == $_GET['mode'] ) {
                            echo apply_filters( 'the_excerpt', $post->post_excerpt );
                    }

                    get_inline_data( $post );

                    /* Custom inline data for woocommerce. */
                    echo '
                            <div class="hidden" id="woocommerce_inline_' . absint( $post->ID ) . '">
                                    <div class="menu_order">' . absint( $the_prod->get_menu_order() ) . '</div>
                                    <div class="sku">' . esc_html( $the_prod->get_sku() ) . '</div>
                                    <div class="regular_price">' . esc_html( $the_prod->get_regular_price() ) . '</div>
                                    <div class="sale_price">' . esc_html( $the_prod->get_sale_price() ) . '</div>
                                    <div class="weight">' . esc_html( $the_prod->get_weight() ) . '</div>
                                    <div class="length">' . esc_html( $the_prod->get_length() ) . '</div>
                                    <div class="width">' . esc_html( $the_prod->get_width() ) . '</div>
                                    <div class="height">' . esc_html( $the_prod->get_height() ) . '</div>
                                    <div class="shipping_class">' . esc_html( $the_prod->get_shipping_class() ) . '</div>
                                    <div class="visibility">' . esc_html( $the_prod->get_catalog_visibility() ) . '</div>
                                    <div class="stock_status">' . esc_html( $the_prod->get_stock_status() ) . '</div>
                                    <div class="stock">' . esc_html( $the_prod->get_stock_quantity() ) . '</div>
                                    <div class="manage_stock">' . esc_html( wc_bool_to_string( $the_prod->get_manage_stock() ) ) . '</div>
                                    <div class="featured">' . esc_html( wc_bool_to_string( $the_prod->get_featured() ) ) . '</div>
                                    <div class="prod_type">' . esc_html( $the_prod->get_type() ) . '</div>
                                    <div class="prod_is_virtual">' . esc_html( wc_bool_to_string( $the_prod->get_virtual() ) ) . '</div>
                                    <div class="tax_status">' . esc_html( $the_prod->get_tax_status() ) . '</div>
                                    <div class="tax_class">' . esc_html( $the_prod->get_tax_class() ) . '</div>
                                    <div class="backorders">' . esc_html( $the_prod->get_backorders() ) . '</div>
                            </div>
                    ';

            break;
            case 'sku' :
                    echo $the_prod->get_sku() ? esc_html( $the_prod->get_sku() ) : '<span class="na">&ndash;</span>';
                    break;
            case 'prod_type' :
                    if ( $the_prod->is_type( 'grouped' ) ) {
                            echo '<span class="prod-type tips grouped" data-tip="' . esc_attr__( 'Grouped', 'woocommerce' ) . '"></span>';
                    } elseif ( $the_prod->is_type( 'external' ) ) {
                            echo '<span class="prod-type tips external" data-tip="' . esc_attr__( 'External/Affiliate', 'woocommerce' ) . '"></span>';
                    } elseif ( $the_prod->is_type( 'simple' ) ) {

                            if ( $the_prod->is_virtual() ) {
                                    echo '<span class="prod-type tips virtual" data-tip="' . esc_attr__( 'Virtual', 'woocommerce' ) . '"></span>';
                            } elseif ( $the_prod->is_downloadable() ) {
                                    echo '<span class="prod-type tips downloadable" data-tip="' . esc_attr__( 'Downloadable', 'woocommerce' ) . '"></span>';
                            } else {
                                    echo '<span class="prod-type tips simple" data-tip="' . esc_attr__( 'Simple', 'woocommerce' ) . '"></span>';
                            }
                    } elseif ( $the_prod->is_type( 'variable' ) ) {
                            echo '<span class="prod-type tips variable" data-tip="' . esc_attr__( 'Variable', 'woocommerce' ) . '"></span>';
                    } else {
                            // Assuming that we have other types in future
                            echo '<span class="prod-type tips ' . esc_attr( sanitize_html_class( $the_prod->get_type() ) ) . '" data-tip="' . esc_attr( ucfirst( $the_prod->get_type() ) ) . '"></span>';
                    }
                    break;
            case 'price' :
                    echo $the_prod->get_price_html() ? $the_prod->get_price_html() : '<span class="na">&ndash;</span>';
                    break;
            case 'prod_cat' :
            case 'prod_tag' :
                    if ( ! $terms = get_the_terms( $post->ID, $column ) ) {
                            echo '<span class="na">&ndash;</span>';
                    } else {
                            $termlist = array();
                            foreach ( $terms as $term ) {
                                    $termlist[] = '<a href="' . admin_url( 'edit.php?' . $column . '=' . $term->slug . '&post_type=prod' ) . ' ">' . $term->name . '</a>';
                            }

                            echo implode( ', ', $termlist );
                    }
                    break;
            case 'featured' :
                    $url = wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_feature_prod&prod_id=' . $post->ID ), 'woocommerce-feature-prod' );
                    echo '<a href="' . esc_url( $url ) . '" aria-label="' . __( 'Toggle featured', 'woocommerce' ) . '">';
                    if ( $the_prod->is_featured() ) {
                            echo '<span class="wc-featured tips" data-tip="' . esc_attr__( 'Yes', 'woocommerce' ) . '">' . __( 'Yes', 'woocommerce' ) . '</span>';
                    } else {
                            echo '<span class="wc-featured not-featured tips" data-tip="' . esc_attr__( 'No', 'woocommerce' ) . '">' . __( 'No', 'woocommerce' ) . '</span>';
                    }
                    echo '</a>';
                    break;
            case 'is_in_stock' :

                    if ( $the_prod->is_in_stock() ) {
                            $stock_html = '<mark class="instock">' . __( 'In stock', 'woocommerce' ) . '</mark>';
                    } else {
                            $stock_html = '<mark class="outofstock">' . __( 'Out of stock', 'woocommerce' ) . '</mark>';
                    }

                    if ( $the_prod->managing_stock() ) {
                            $stock_html .= ' (' . wc_stock_amount( $the_prod->get_stock_quantity() ) . ')';
                    }

                    echo apply_filters( 'woocommerce_admin_stock_html', $stock_html, $the_prod );

                    break;
            default :
                    break;
    }
}
add_filter( 'manage_prod_posts_columns', 'prod_columns' );


function atelierbourgeons_tml_message( $message, $action ) {
    //if($action == 'login')
    
    if ( isset($_GET['action']) && $_GET['action'] == 'confirm-email' && isset($_GET['key']) && isset($_GET['user']) ) {
        
        global $wpdb;  
        $row = $wpdb->get_row( $wpdb->prepare( "SELECT ID, user_activation_key FROM $wpdb->users WHERE ID = %s", $_GET['user'] ) );        
        
        //$message .= $_GET['key'];
        if(hash_equals( $row->user_activation_key, $_GET['key'])) {
            $message .= 'ありがとうございます！お客さまのアカウントが有効になりました。こちらからログインしてください。';
            update_user_meta( $_GET['user'], 'pw_user_status', 'approved'  );
            WC()->mailer()->emails['WC_Email_Customer_Registration_New_User_Registered']->trigger($_GET['user']);
            //pw_new_user_approve()->update_user_status( $_GET['user'] , 'approved' );
        }
    }
   return $message;
}
add_filter( 'tml_action_template_message', 'atelierbourgeons_tml_message' , 23 ,10);



add_filter( 'woocommerce_payment_gateways_settings', 'atelierbourgeons_pro_terms_conditions' , 23 ,10);
/*$settings = apply_filters( 'woocommerce_payment_gateways_settings', array(

				array(
					'title' => __( 'Checkout process', 'woocommerce' ),
					'type'  => 'title',
					'id'    => 'checkout_process_options',
				));
*/
function atelierbourgeons_pro_terms_conditions( $array ) {
    $array[] = array(
            'title'    => __( 'Terms and conditions Pro', 'woocommerce' ),
            'desc'     => __( 'If you define a "Terms" page the customer will be asked if they accept them when checking out.', 'woocommerce' ),
            'id'       => 'woocommerce_terms_pro_page_id',
            'default'  => '',
            'class'    => 'wc-enhanced-select-nostd',
            'css'      => 'min-width:300px;',
            'type'     => 'single_select_page',
            'args'     => array( 'exclude' => wc_get_page_id( 'checkout' ) ),
            'desc_tip' => true,
            'autoload' => false,
    );
    $array[] = array(
            'title'    => __( 'Shopping guide', 'woocommerce' ),
            'desc'     => __( 'This page help customer to under understand the process of buying stuffs', 'woocommerce' ),
            'id'       => 'woocommerce_shopping_guide_page_id',
            'default'  => '',
            'class'    => 'wc-enhanced-select-nostd',
            'css'      => 'min-width:300px;',
            'type'     => 'single_select_page',
            'args'     => array(  ),
            'desc_tip' => true,
            'autoload' => false,
    );
    $array[] = array(
            'title'    => __( 'Consumer Notice', 'woocommerce' ),
            'desc'     => __( 'This page help customer to be aware of what is important', 'woocommerce' ),
            'id'       => 'woocommerce_consumer_notice_page_id',
            'default'  => '',
            'class'    => 'wc-enhanced-select-nostd',
            'css'      => 'min-width:300px;',
            'type'     => 'single_select_page',
            'args'     => array(  ),
            'desc_tip' => true,
            'autoload' => false,
    );
    $array[] = array(
            'title'    => __( 'Privacy Policy', 'woocommerce' ),
            'desc'     => __( 'This page explain about the data privacy policy', 'woocommerce' ),
            'id'       => 'woocommerce_privacy_policy_page_id',
            'default'  => '',
            'class'    => 'wc-enhanced-select-nostd',
            'css'      => 'min-width:300px;',
            'type'     => 'single_select_page',
            'args'     => array(  ),
            'desc_tip' => true,
            'autoload' => false,
    );
    $array[] = array(
            'title'    => __( 'Contact Form', 'woocommerce' ),
            'desc'     => __( 'This is the form contact', 'woocommerce' ),
            'id'       => 'woocommerce_contact_form_page_id',
            'default'  => '',
            'class'    => 'wc-enhanced-select-nostd',
            'css'      => 'min-width:300px;',
            'type'     => 'single_select_page',
            'args'     => array(  ),
            'desc_tip' => true,
            'autoload' => false,
    );
    $array[] = array(
            'title'    => __( 'Collection', 'woocommerce' ),
            'desc'     => __( 'La collection', 'woocommerce' ),
            'id'       => 'woocommerce_collection_page_id',
            'default'  => '',
            'class'    => 'wc-enhanced-select-nostd',
            'css'      => 'min-width:300px;',
            'type'     => 'single_select_page',
            'args'     => array(  ),
            'desc_tip' => true,
            'autoload' => false,
    );
     $array[] = array(
            'title'    => __( 'Concept', 'woocommerce' ),
            'desc'     => __( 'Concept', 'woocommerce' ),
            'id'       => 'woocommerce_concept_page_id',
            'default'  => '',
            'class'    => 'wc-enhanced-select-nostd',
            'css'      => 'min-width:300px;',
            'type'     => 'single_select_page',
            'args'     => array(  ),
            'desc_tip' => true,
            'autoload' => false,
    );
     $array[] = array(
            'title'    => __( 'Atelier', 'woocommerce' ),
            'desc'     => __( 'This is l\'Atelier', 'woocommerce' ),
            'id'       => 'woocommerce_atelier_page_id',
            'default'  => '',
            'class'    => 'wc-enhanced-select-nostd',
            'css'      => 'min-width:300px;',
            'type'     => 'single_select_page',
            'args'     => array(  ),
            'desc_tip' => true,
            'autoload' => false,
    );
    $array[] = array(
            'title'    => __( 'In Production', 'woocommerce' ),
            'desc'     => __( 'In Production eshop page', 'woocommerce' ),
            'id'       => 'woocommerce_production_page_id',
            'default'  => '',
            'class'    => 'wc-enhanced-select-nostd',
            'css'      => 'min-width:300px;',
            'type'     => 'single_select_page',
            'args'     => array(  ),
            'desc_tip' => true,
            'autoload' => false,
    );
    $array[] = array(
            'title'    => __( 'B to B Page', 'woocommerce' ),
            'desc'     => __( 'B to B Page', 'woocommerce' ),
            'id'       => 'woocommerce_btob_page_id',
            'default'  => '',
            'class'    => 'wc-enhanced-select-nostd',
            'css'      => 'min-width:300px;',
            'type'     => 'single_select_page',
            'args'     => array(  ),
            'desc_tip' => true,
            'autoload' => false,
    );
    $array[] = array(
            'title'    => __( 'Collection Ete', 'woocommerce' ),
            'desc'     => __( 'La collection été', 'woocommerce' ),
            'id'       => 'woocommerce_collection_summer_page_id',
            'default'  => '',
            'class'    => 'wc-enhanced-select-nostd',
            'css'      => 'min-width:300px;',
            'type'     => 'single_select_page',
            'args'     => array(  ),
            'desc_tip' => true,
            'autoload' => false,
    );
    return $array;    
}


add_action( 'woocommerce_update_options' , 'atelierbourgeons_update_pro_terms_conditions' );
function atelierbourgeons_update_pro_terms_conditions() {
    if(isset($_POST['woocommerce_terms_pro_page_id'])) {
        update_option('woocommerce_terms_pro_page_id', $_POST['woocommerce_terms_pro_page_id'] );
    }
}

add_filter( 'woocommerce_shipping_chosen_method', 'atelierbourgeons_shipping_chosen_method' , 40, 3);
function atelierbourgeons_shipping_chosen_method($default, $package_rates, $chosen_method ) {
    foreach ($package_rates as $package_rate) {
        if($package_rate->__get('method_id') ==  'free_shipping') {
            return $package_rate->__get('id');
        }    
    }
    return $default;
}
    




add_filter( 'woocommerce_get_terms_page_id', 'atelierbourgeons_get_terms_page_id' , 40 , 1);
function atelierbourgeons_get_terms_page_id( $page_id ) {
    $user = wp_get_current_user(); 
    $role = ( array ) $user->roles;
    
    if(in_array( 'customer-pro', $role )) {   
        $pro_post_id = get_option('woocommerce_terms_pro_page_id');
        
        return get_post($pro_post_id)->ID;
        //return get_option('woocommerce_terms_pro_page_id');
        //return $page_id;
    }
    return $page_id;
}

function atelierbourgeons_woocommerce_coupons_enabled( $enable_coupon ) {
    $user = wp_get_current_user(); 
    $role = ( array ) $user->roles;    
    if(in_array( 'customer-pro', $role )) {   
        $enable_coupon = false;        
    }
    return $enable_coupon;
}
add_filter( 'woocommerce_coupons_enabled', 'atelierbourgeons_woocommerce_coupons_enabled' , 10 , 1 );

add_filter( 'woocommerce_shipping_package_name', 'atelierbourgeons_shipping_package_name' , 10 , 3) ;

function atelierbourgeons_shipping_package_name($arg1, $arg2, $arg3) {
    return '配送<small>(￥30000以上で送料無料)</small>';
}

add_action( 'woocommerce_update_options' , 'atelierbourgeons_update_shopping_guide' );
function atelierbourgeons_update_shopping_guide() {
    if(isset($_POST['woocommerce_shopping_guide_page_id'])) {
        update_option('woocommerce_shopping_guide_page_id', $_POST['woocommerce_shopping_guide_page_id'] );
    }
}

add_filter( 'woocommerce_account_menu_items', 'atelierbourgeons_account_menu_items', 10, 1 );
function atelierbourgeons_account_menu_items($items) {
    $items['orders'] = 'ご注文履歴';
    $items['edit-account'] = 'アカウント詳細・パスワードの変更';
    return $items;
}

add_action( 'woocommerce_update_options' , 'atelierbourgeons_update_options' );
function atelierbourgeons_update_options() {
    if(isset($_POST['woocommerce_consumer_notice_page_id'])) {
        update_option('woocommerce_consumer_notice_page_id', $_POST['woocommerce_consumer_notice_page_id'] );
    }
    if(isset($_POST['woocommerce_privacy_policy_page_id'])) {
        update_option('woocommerce_privacy_policy_page_id', $_POST['woocommerce_privacy_policy_page_id'] );
    }
    if(isset($_POST['woocommerce_contact_form_page_id'])) {
        update_option('woocommerce_contact_form_page_id', $_POST['woocommerce_contact_form_page_id'] );
    }
    if(isset($_POST['woocommerce_atelier_page_id'])) {
        update_option('woocommerce_atelier_page_id', $_POST['woocommerce_atelier_page_id'] );
    }
    if(isset($_POST['woocommerce_btob_page_id'])) {
        update_option('woocommerce_btob_page_id', $_POST['woocommerce_btob_page_id'] );
    }
    if(isset($_POST['woocommerce_collection_page_id'])) {
        update_option('woocommerce_collection_page_id', $_POST['woocommerce_collection_page_id'] );
    }
    if(isset($_POST['woocommerce_collection_summer_page_id'])) {
        update_option('woocommerce_collection_summer_page_id', $_POST['woocommerce_collection_summer_page_id'] );
    }
    if(isset($_POST['woocommerce_concept_page_id'])) {
        update_option('woocommerce_concept_page_id', $_POST['woocommerce_concept_page_id'] );
    }

}

add_filter( 'wc_stripe_description', 'atelierbourgeons_stripe_description', 10, 2);
//wpautop( wp_kses_post( $description ) ), $this->id );
function atelierbourgeons_stripe_description($description , $id) {
    if(!strpos($description, 'TEST MODE ENABLED' )) {
        /*$description = '<p>※ カード決済で使用するシステム「Stripe」は、PayPalに並び世界で最も高い支持を得る決済サービスです（日本では2016年に導入開始）。その高度な安全性は多くの企業から信頼を置かれ、現在１０万社以上の商取引に利用されています。《<a href="https://stripe.com/jp/customers">導入企業一覧</a>》《<a href="https://stripe.com/jp/payments">Stripe会社情報</a>》</p>
                    <p>※ カードコード（CVC）とは、カード裏面に記載されている暗証番号です。 通常、カード裏面の署名欄に記載された番号の下3桁がそれに値します。</p>';
         * 
         */
        $description = '<p>※ 当サイト利用の決済サービス「<a href="https://stripe.com/jp/">Stripe</a>」は、カード業界の国際基準 (PCI DSS) で最も安全な Level 1 を取得し、世界で１０万社以上の商取引に利用されています。安心してお買い物をお楽しみください。《<a href="https://stripe.com/jp/customers">導入企業一覧</a>》</p>';

    }
    return $description;
}

add_filter( 'woocommerce_gateway_icon', 'atelierbourgeons_gateway_icon' , 10 ,2  );
function atelierbourgeons_gateway_icon($icons_str, $id) {    
    if($id=="stripe") {
        $icons_str .= ' <img src="' . WC_STRIPE_PLUGIN_URL . '/assets/images/jcb.svg" class="stripe-jcb-icon stripe-icon" alt="JCB" /> ';
        $icons_str .= ' <img src="' . WC_STRIPE_PLUGIN_URL . '/assets/images/diners.svg" class="stripe-diners-icon stripe-icon" alt="Diners" /> ';
        $icons_str = '<div id="' . $id .'">' . $icons_str . '</div>';
    }
    return $icons_str;
}

function atelierbourgeons_new_user_approved( $user ) {
    //if($action == 'login')
    /*$pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'template-test-email.php'
    )); 
    echo "page id emails ! ";
    foreach($pages as $page){
        echo $page->ID.'<br />'; 
    }*/
    $message = atelierbourgeons_html_email_template_header('ビジネス会員登録の認証が完了しました！');
    $message .= '<tr>
    <td align="center" height="100%" valign="top" width="100%" bgcolor="#F2F5F7" style="padding:0 15px 20px" class="m_4412137695263643084mobile-padding">
      
      <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse!important;max-width:600px">
        <tbody><tr>
          <td align="center" valign="top" style="font-family:Open Sans,Helvetica,Arial,sans-serif;padding:0 0 25px">
            <table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse!important">
              <tbody><tr>
                <td align="center" bgcolor="#ffffff" style="border-radius:0 0 10px 10px;padding:25px">
                ' . svg_valid_email() .'
                  <table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse!important">
                    <tbody><tr>
                      
                    </tr>
                    <tr>
                      <td align="center" style="font-family:Open Sans,Helvetica,Arial,sans-serif">
                        <h2></h2>
                        <p>
                            atelier Bourgeons （アトリエブルジョン）の ビジネス会員登録にお申し込みいただき、誠にありがとうございます。 会員の登録認証が完了しましたので、お知らせいたします。ログイン後、ビジネス会員様のみに公開される卸価格にて商品をご購入いただけます。
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" style="padding:20px 0 15px">
                        <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse!important">
                          <tbody><tr>
                            <td align="center" style="border-radius:26px" bgcolor="#0570D4">
                              <a href="'. get_site_url() .'" style="background: #613143;border: 1px solid #613143;border-radius: 14px;color:#ffffff;display:block;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:16px;padding:14px 26px;text-decoration:none" target="_blank" data-saferedirecturl="">サイトに移動</a>
                            </td>
                          </tr>
                        </tbody></table>
                      </td>
                    </tr>                    
                  </tbody></table>
                </td>
              </tr>
            <tr>
            <td align="left" style="padding:20px 0 15px">
            ※本メールに関してお心当たりがない場合、または何かご不明点がございましたら、恐れ入りますがその旨をご記入のうえ<a href="mailto:contact@atelierbourgeons.com">contact@atelierbourgeons.com</a>までお問い合わせください。
            </td>
            </tr>
            </tbody></table>
          </td>
        </tr>';
	
    //$message .= __( 'To set or reset your password, visit the following address:', 'new-user-approve' ) . "\r\n\r\n";
    //$message .= "{reset_password_url}";
    $message .= atelierbourgeons_html_email_template_footer();
    return $message;
}
add_filter( 'new_user_approve_approve_user_message_default', 'atelierbourgeons_new_user_approved' , 21 ,12);

function abourgeons_woomail_email_types ( $types ) {    
    $types['customer_registration_approved_pro'] = 'Customer Registration Approved Pro'; 
    $types['customer_registration_denied_pro'] = 'Customer Registration Denied Pro'; 
    $types['customer_registration_approval_request_pro'] = 'Customer Registration Approval Request Pro'; 
    $types['customer_registration_new_user_confirm_email'] = 'Customer Registration New User Confirm Email'; 
    $types['customer_registration_new_user_checking_pro'] = 'Customer Registration New User Pro Checking'; 
    $types['customer_registration_new_user_registered'] = 'Customer Registration New User Registered'; 
    //if(class_exists('WC_Email_Customer_Registration_Approved'))
      //  throw new Exception ('Hello World');
    return $types;    
}
add_filter( 'kadence_woomail_email_types', 'abourgeons_woomail_email_types' , 10 ,1);

function abourgeons_email_classes($classes){
    /*require_once 'inc/emails/class-wc-email-customer-registration-approved-pro.php';
    require_once 'inc/emails/class-wc-email-customer-registration-denied-pro.php';
    require_once 'inc/emails/class-wc-email-customer-registration-approval-request-pro.php';
    require_once 'inc/emails/class-wc-email-customer-registration-new-user-confirm-email.php';
    require_once 'inc/emails/class-wc-email-customer-registration-new-user-checking-pro.php';
    */
    $classes['WC_Email_Customer_Registration_Approved_Pro'] = include( 'inc/emails/class-wc-email-customer-registration-approved-pro.php' );    
    $classes['WC_Email_Customer_Registration_Denied_Pro'] = include( 'inc/emails/class-wc-email-customer-registration-denied-pro.php' );    
    $classes['WC_Email_Customer_Registration_Approval_Request_Pro'] = include( 'inc/emails/class-wc-email-customer-registration-approval-request-pro.php' );        
    $classes['WC_Email_Customer_Registration_New_User_Confirm_Email'] = include( 'inc/emails/class-wc-email-customer-registration-new-user-confirm-email.php' );
    $classes['WC_Email_Customer_Registration_New_User_Checking_Pro'] = include( 'inc/emails/class-wc-email-customer-registration-new-user-checking-pro.php' );
    $classes['WC_Email_Customer_Registration_New_User_Registered'] = include( 'inc/emails/class-wc-email-customer-registration-new-user-registered.php' );
    //print_r($classes);
    return $classes;    
}
add_filter( 'woocommerce_email_classes', 'abourgeons_email_classes' , 10 ,1);

function abourgeons_woomail_email_type_class_name_array($classes){
    $classes['customer_registration_approved_pro'] = 'WC_Email_Customer_Registration_Approved_Pro'; 
    $classes['customer_registration_denied_pro'] = 'WC_Email_Customer_Registration_Denied_Pro'; 
    $classes['customer_registration_approval_request_pro'] = 'WC_Email_Customer_Registration_Approval_Request_Pro';
    $classes['customer_registration_new_user_confirm_email'] = 'WC_Email_Customer_Registration_New_User_Confirm_Email'; 
    $classes['customer_registration_new_user_checking_pro'] = 'WC_Email_Customer_Registration_New_User_Checking_Pro'; 
    $classes['customer_registration_new_user_registered'] = 'WC_Email_Customer_Registration_New_User_Registered'; 
    //print_r($classes);
    return $classes;    
}
add_filter( 'kadence_woomail_email_type_class_name_array', 'abourgeons_woomail_email_type_class_name_array', 10 , 1 );

function tinymce_fix_table_styles() {	
  echo '<script>jQuery(function($){
    if (typeof tinymce !== "undefined") {
      tinymce.overrideDefaults({
        table_default_attributes:{},
        table_default_styles:{}
      });
    }
  });</script>';
}
add_action('admin_footer', 'tinymce_fix_table_styles');

/*function atelierbourgeons_new_user_approve_subject ( $subject ) {
    return '【ビジネス会員登録の認証が完了しました】/atelier Bourgeons （ｱﾄﾘｴﾌﾞﾙｼﾞｮﾝ）';
}

add_filter( 'new_user_approve_approve_user_subject', 'atelierbourgeons_new_user_approve_subject' , 10 , 1 );
*/
/*
function atelierbourgeons_new_user_checking( $status, $user_id ) {
    //if($action == 'login')
    
    
    $user = new WP_User( $user_id );

    wp_cache_delete( $user->ID, 'users' );
    wp_cache_delete( $user->data->user_login, 'userlogins' );
    
    // send email to user telling of approval
    $user_login = stripslashes( $user->data->user_login );
    $user_email = stripslashes( $user->data->user_email );

    $admin_email = 'contact@atelierbourgeons.com';    
    $from_name = 'atelier Bourgeons アトリエブルジョン';
    $headers = array('From: "' . $from_name . '" <' . $admin_email . '>');
    //$headers = 'From: atelierbourgeons \r\n';
    $headers[] = 'MIME-Version: 1.0;';
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
            
    // multi part email
    //$headers[] = '';
    //$headers[] = '';
    
    $message = null;
    $txt = null;
    if ($status == "confirm-email") {
        $subject = '【ご登録完了まであと少しです】/atelier Bourgeons （ｱﾄﾘｴﾌﾞﾙｼﾞｮﾝ）';   
        $code = sha1( $user->ID . time() ); 
        global $wpdb;
        $wpdb->update( $wpdb->users, array( 'user_activation_key' => $code ), array( 'ID' => $user->ID ) );
        //$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
        $activation_url = add_query_arg( array( 'action' => 'confirm-email', 'key' => $code, 'user' => $user->ID), wp_login_url() );
        $message = mail_new_user_confirm_email($user,$activation_url);
    }else {
        $subject = '【会員認証の完了までしばらくお待ちください】/atelier Bourgeons （ｱﾄﾘｴﾌﾞﾙｼﾞｮﾝ）';
        $message = mail_new_user_checking($user);
    }
    
    //$message = '--boundary42 \r\n
//Content-type: text/plain; charset=iso-8859-1 \r\n
//' . $txt . '  \r\n
//--boundary42 \r\n
//Content-type: text/html; charset=iso-8859-1 \r\n
// ' . $message . '  \r\n '
//            . '--boundary42--';
        
    //function wpse27856_set_content_type(){
    //    return "multipart/alternative; boundary=boundary42";
    //}
    //add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
    wp_mail( $user_email, $subject, $message, $headers);
    //remove_filter( 'wp_mail_content_type', 'wpse27856_set_content_type' );
    
    return $status;
}
add_filter( 'new_user_approve_default_status', 'atelierbourgeons_new_user_checking' , 21 ,12);
*/


/**
* Define custom columns for prods.
* @param  array $existing_columns
* @return array
*/
function prod_columns( $existing_columns ) {
       if ( empty( $existing_columns ) && ! is_array( $existing_columns ) ) {
               $existing_columns = array();
       }

       unset( $existing_columns['title'], $existing_columns['comments'], $existing_columns['date'] );

       $columns          = array();
       $columns['cb']    = '<input type="checkbox" />';
       $columns['thumb'] = '<span class="wc-image tips" data-tip="' . esc_attr__( 'Image', 'woocommerce' ) . '">' . __( 'Image', 'woocommerce' ) . '</span>';
       $columns['name']  = __( 'Name', 'woocommerce' );

       if ( wc_prod_sku_enabled() ) {
               $columns['sku'] = __( 'SKU', 'woocommerce' );
       }

       if ( 'yes' === get_option( 'woocommerce_manage_stock' ) ) {
               $columns['is_in_stock'] = __( 'Stock', 'woocommerce' );
       }

       $columns['price']        = __( 'Price', 'woocommerce' );
       $columns['prod_cat']  = __( 'Categories', 'woocommerce' );
       $columns['prod_tag']  = __( 'Tags', 'woocommerce' );
       $columns['featured']     = '<span class="wc-featured parent-tips" data-tip="' . esc_attr__( 'Featured', 'woocommerce' ) . '">' . __( 'Featured', 'woocommerce' ) . '</span>';
       $columns['prod_type'] = '<span class="wc-type parent-tips" data-tip="' . esc_attr__( 'Type', 'woocommerce' ) . '">' . __( 'Type', 'woocommerce' ) . '</span>';
       $columns['date']         = __( 'Date', 'woocommerce' );

       return array_merge( $columns, $existing_columns );

}

/*add_action( 'init', 'create_prod_post_type' );
function create_prod_post_type() {
  register_post_type( 'production',
    array(
      'labels' => array(
        'name' => __( 'Productions' ),
        'singular_name' => __( 'Production' )
      ),
      'public' => true
    )
  );
}*/


/**
 * Legacy product contains all deprecated methods for this class and can be
 * removed in the future.
 */

function wc_production_data_store( $stores ) {
	$stores['production'] = 'WC_Prod_Data_Store';
	return $stores;
}

add_filter( 'woocommerce_data_stores', 'wc_production_data_store' , 98);


//add_action( 'woocommerce_review_order_before_order_total', 'custom_cart_total' );
/*add_action( 'woocommerce_before_cart_totals', 'custom_cart_total' );
function custom_cart_total() {

    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
            return;

    WC()->cart->total *= 0.30;
    //var_dump( WC()->cart->total);
}*/

function create_post_type_production() {
    
    //global $wp_roles;
    //$wp_roles->add_cap( 'administrator', "edit_shop_production" );
    $role = get_role( 'administrator' );
    
    $role->add_cap( 'create_shop_productions' ); 
    $role->add_cap( 'publish_shop_productions' ); 
    $role->add_cap( 'edit_shop_productions' );     
    $role->add_cap( 'edit_others_shop_productions' );     
    $role->add_cap( 'delete_shop_productions' ); 
    $role->add_cap( 'delete_others_shop_productions' ); 
    $role->add_cap( 'read_private_shop_production' ); 
    $role->add_cap( 'edit_shop_production' ); 
    $role->add_cap( 'delete_shop_production' ); 
    $role->add_cap( 'read_shop_production' ); 
    
    $role = get_role( 'shop_manager' );
        
    $role->add_cap( 'create_shop_productions' ); 
    $role->add_cap( 'publish_shop_productions' ); 
    $role->add_cap( 'edit_shop_productions' );     
    $role->add_cap( 'edit_others_shop_productions' );     
    $role->add_cap( 'delete_shop_productions' ); 
    $role->add_cap( 'delete_others_shop_productions' ); 
    $role->add_cap( 'read_private_shop_production' ); 
    $role->add_cap( 'edit_shop_production' ); 
    $role->add_cap( 'delete_shop_production' ); 
    $role->add_cap( 'read_shop_production' ); 
    
  register_post_type( 'shop_production',
    array(
      'labels' => array(
        'name' => __( 'Productions' ),
        'singular_name' => __( 'Production' )
      ),
      'public' => true,
    //'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
      'has_archive' => true,
      'hierarchical' => true,
        "capability_type" => "shop_production",
        'capabilities' => array(
           'create_posts' => 'create_shop_productions',
            'publish_posts' => 'publish_shop_productions',
            'edit_posts' => 'edit_shop_productions',
            'edit_others_posts' => 'edit_others_shop_productions',
            'delete_posts' => 'delete_shop_productions',
            'delete_others_posts' => 'delete_others_shop_productions',
            'read_private_posts' => 'read_private_shop_productions',
            'edit_post' => 'edit_shop_production',
            'delete_post' => 'delete_shop_production',
            'read_post' => 'read_shop_production'
        ),
        "map_meta_cap" => true,
    )
  );
  register_post_type( 'shop_workshop',
    array(
      'labels' => array(
        'name' => __( 'Workshops' ),
        'singular_name' => __( 'Workshop' )
      ),
      'supports' => array (
          'title',
        'editor', 
        'excerpt', 
        'thumbnail', 
        'custom-fields', 
        'revisions' 
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true
    )
  );
  register_post_type( 'shop_supplier',
    array(
      'labels' => array(
        'name' => __( 'Suppliers' ),
        'singular_name' => __( 'Supplier' )
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true
    )
  );
  register_post_type( 'shop_reseller',
    array(
      'labels' => array(
        'name' => __( 'Resellers' ),
        'singular_name' => __( 'Reseller' )
      ),
      'supports' => array (
          'title',
        'editor', 
        'excerpt', 
        'thumbnail', 
        'custom-fields', 
        'revisions' 
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true
    )
  );
}
add_action( 'init', 'create_post_type_production' );


if (!function_exists('get_post_ids_by_meta_key_and_value')) {
	/**
	 * Get post id from meta key and value
	 * @param string $key
	 * @param mixed $value
	 * @return int|bool
	 * @author David M&aring;rtensson <david.martensson@gmail.com>
	 */
	function get_post_ids_by_meta_key_and_value($key, $value) {
		global $wpdb;
                $post_ids = array();
                
		$meta = $wpdb->get_results($wpdb->prepare("SELECT * FROM `$wpdb->postmeta` WHERE meta_key=%s AND meta_value=%d",array($key,intval($value))));                
		if (is_array($meta) && !empty($meta) && isset($meta[0])) {                        
                        foreach($meta as $post_itm ) {
                            array_push($post_ids, $post_itm->post_id);
                        }
                        return $post_ids;
		}		
		else if (is_object($meta)) {
			array_push($post_ids, $meta->post_id) ;
                        return $post_ids;
		}
		else {
			return null;
		}
	}
}




/**
 * WordPress function for redirecting users on login based on user role
 */
/*
function my_login_redirect( $url, $request, $user ){
    if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        if( $user->has_cap( 'administrator' ) ) {
            $url = admin_url();
        } else {            
            $url = get_home_url();
        }
    }
    return $url;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3 );
*/

add_filter( 'woocommerce_return_to_shop_redirect', 'abourgons_return_to_shop_redirect' );
function abourgons_return_to_shop_redirect($wc_get_page_permalink) {
     return get_home_url();
}

       /*
function my_login_error( $errors ){
    print_r($errors);
}
add_filter('login_errors', 'my_login_error', 10, 1 );
      */  
add_role( 'customer-pro', 'Professional Customer', array( 'read' => true, 'level_0' => true ) );
//init the meta box
add_action( 'after_setup_theme', 'custom_postimage_setup' );
function custom_postimage_setup(){
    add_action( 'add_meta_boxes', 'custom_postimage_meta_box' );
    add_action( 'save_post_shop_product', 'custom_postimage_meta_box_save' );
}

function custom_postimage_meta_box(){

    //on which post types should the box appear?
    $post_types = array('post','shop_workshop');
    foreach($post_types as $pt){
        add_meta_box('custom_postimage_meta_box',__( 'More Featured Images', 'yourdomain'),'custom_postimage_meta_box_func',$pt,'side','low');
    }
    add_meta_box( 'awesomepagefacets', __( 'Add Page Awesome Paragraph', 'woocommerce' ), 'WC_Meta_Box_Page_Awesome_Paragraph::output', 'shop_workshop');
    add_meta_box( 'pageworkshopproductpartnershipfacet', __( 'Product', 'woocommerce' ), 'WC_Meta_Box_Page_Workshop_Product_Partnership::output', 'shop_workshop');
    add_meta_box( 'pageworkshopmetadatafacet', __( 'Workshop Metadata', 'woocommerce' ), 'WC_Meta_Box_Page_Workshop_Metadata::output', 'shop_workshop');
    add_meta_box( 'awesomefacets', __( 'Add facets', 'woocommerce' ), 'WC_Meta_Box_Product_Awesome_Description::output', 'product');
    add_meta_box( 'productsizedetails', __( 'Size&Details', 'woocommerce' ), 'WC_Meta_Box_Product_Size_Details::output', 'product');
    add_meta_box( 'productsizeguide', __( 'Sizing Guide', 'woocommerce' ), 'WC_Meta_Box_Product_Size_Guide::output', 'product');    
    add_meta_box( 'woocommerce-product-parent-page', __( 'Parent Page', 'woocommerce' ), 'wc_meta_box_product_parent_page', "product", 'side', 'default' );        

}

function wc_meta_box_product_parent_page() {
    /**
         * Filters the arguments used to generate a Pages drop-down element.
         *
         * @since 3.3.0
         *
         * @see wp_dropdown_pages()
         *
         * @param array   $dropdown_args Array of arguments used to generate the pages drop-down.
         * @param WP_Post $post          The current post.
         */
        global $post;
        
        $page_id = get_post_meta($post->ID, '_parent_page_id', true);
        $dropdown_args = array(
            'post_type'        => 'page',
            'exclude_tree'     => $post->ID,
            'selected'         => $page_id,
            'name'             => 'parent_id',
            'show_option_none' => __('(no parent)'),
            'sort_column'      => 'menu_order, post_title',
            'echo'             => 0,
        );
        
        $pages = wp_dropdown_pages( $dropdown_args );
              
        if ( ! empty($pages) ) :
        ?>
        <p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="parent_id"><?php _e( 'Parent' ); ?></label></p>
        <?php echo $pages; ?>
        <?php
        endif; // end empty pages check
}

function WC_Meta_Box_Product_Parent_Id_save($post_id) {
    if (isset( $_POST['parent_id'] ) ) {
        update_post_meta( $post_id, '_parent_page_id', $_POST['parent_id']  );
    } 
    }

//add_action( 'save_post', 'WC_Meta_Box_Product_Awesome_Description::save' );
add_action( 'wp_ajax_woocommerce_add_awesome_description', 'WC_Meta_Box_Product_Awesome_Description::add' );
add_action( 'wp_ajax_woocommerce_remove_awesome_description', 'WC_Meta_Box_Product_Awesome_Description::remove' );
add_action( 'wp_ajax_woocommerce_save_awesome_description', 'WC_Meta_Box_Product_Awesome_Description::save' );
add_action( 'wp_ajax_woocommerce_add_awesome_paragraph', 'WC_Meta_Box_Page_Awesome_Paragraph::add' );
add_action( 'wp_ajax_woocommerce_remove_awesome_paragraph', 'WC_Meta_Box_Page_Awesome_Paragraph::remove' );
add_action( 'wp_ajax_woocommerce_save_awesome_paragraph', 'WC_Meta_Box_Page_Awesome_Paragraph::save' );
add_action( 'wp_ajax_woocommerce_add_workshop_product_partnership', 'WC_Meta_Box_Page_Workshop_Product_Partnership::add_product' );
add_action( 'wp_ajax_woocommerce_save_workshop_metadata', 'WC_Meta_Box_Page_Workshop_Metadata::save' );
add_action( 'wp_ajax_woocommerce_remove_workshop_product_partnership', 'WC_Meta_Box_Page_Workshop_Product_Partnership::remove_product' );

add_action( 'save_post_product', 'WC_Meta_Box_Product_Size_Details::save' );
add_action( 'save_post_product', 'WC_Meta_Box_Product_Size_Guide::save' );
add_action( 'save_post_product', 'WC_Meta_Box_Product_Parent_Id_save' );
function custom_postimage_meta_box_func($post){

    //an array with all the images (ba meta key). The same array has to be in custom_postimage_meta_box_save($post_id) as well.
    $meta_keys = array('second_featured_image','third_featured_image');

    foreach($meta_keys as $meta_key){
        $image_meta_val=get_post_meta( $post->ID, $meta_key, true);
        ?>
        <div class="custom_postimage_wrapper" id="<?php echo $meta_key; ?>_wrapper" style="margin-bottom:20px;">
            <img src="<?php echo ($image_meta_val!=''?wp_get_attachment_image_src( $image_meta_val)[0]:''); ?>" style="width:100%;display: <?php echo ($image_meta_val!=''?'block':'none'); ?>" alt="">
            <a class="addimage button" onclick="custom_postimage_add_image('<?php echo $meta_key; ?>');"><?php _e('add image','yourdomain'); ?></a><br>
            <a class="removeimage" style="color:#a00;cursor:pointer;display: <?php echo ($image_meta_val!=''?'block':'none'); ?>" onclick="custom_postimage_remove_image('<?php echo $meta_key; ?>');"><?php _e('remove image','yourdomain'); ?></a>
            <input type="hidden" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo $image_meta_val; ?>" />
        </div>
    <?php } ?>
    <script>
    function custom_postimage_add_image(key){

        var $wrapper = jQuery('#'+key+'_wrapper');

        custom_postimage_uploader = wp.media.frames.file_frame = wp.media({
            title: '<?php _e('select image','yourdomain'); ?>',
            button: {
                text: '<?php _e('select image','yourdomain'); ?>'
            },
            multiple: false
        });
        custom_postimage_uploader.on('select', function() {

            var attachment = custom_postimage_uploader.state().get('selection').first().toJSON();
            var img_url = attachment['url'];
            var img_id = attachment['id'];
            $wrapper.find('input#'+key).val(img_id);
            $wrapper.find('img').attr('src',img_url);
            $wrapper.find('img').show();
            $wrapper.find('a.removeimage').show();
        });
        custom_postimage_uploader.on('open', function(){
            var selection = custom_postimage_uploader.state().get('selection');
            var selected = $wrapper.find('input#'+key).val();
            if(selected){
                selection.add(wp.media.attachment(selected));
            }
        });
        custom_postimage_uploader.open();
        return false;
    }

    function custom_postimage_remove_image(key){
        var $wrapper = jQuery('#'+key+'_wrapper');
        $wrapper.find('input#'+key).val('');
        $wrapper.find('img').hide();
        $wrapper.find('a.removeimage').hide();
        return false;
    }
    </script>
    <?php
    wp_nonce_field( 'custom_postimage_meta_box', 'custom_postimage_meta_box_nonce' );
}

function custom_postimage_meta_box_save($post_id){
    if ( ! current_user_can( 'edit_posts', $post_id ) ){ return 'not permitted'; }

    if (isset( $_POST['custom_postimage_meta_box_nonce'] ) && wp_verify_nonce($_POST['custom_postimage_meta_box_nonce'],'custom_postimage_meta_box' )){

        //same array as in custom_postimage_meta_box_func($post)
        $meta_keys = array('second_featured_image','third_featured_image');
        foreach($meta_keys as $meta_key){
            if(isset($_POST[$meta_key]) && intval($_POST[$meta_key])!=''){
                update_post_meta( $post_id, $meta_key, intval($_POST[$meta_key]));
            }else{
                update_post_meta( $post_id, $meta_key, '');
            }
        }
    }
    
}

/*$classname = apply_filters( 'woocommerce_product_class', self::get_classname_from_product_type( $product_type ), $product_type, 'variation' === $product_type ? 'product_variation' : 'product', $product_id );
*/

function atelierbourgeons_product_class($classname) {

require_once 'inc/woocommerce/classes/class-wc-abourgeons-product-simple.php';   
 require_once 'inc/woocommerce/classes/class-wc-abourgeons-product-variation.php';   
 
 if($classname == 'WC_Product_Variable' && class_exists('AB_Product_Variation')) {
     return 'AB_Product_Variation';
 }else if ($classname == 'WC_Product_Simple' && class_exists('AB_Product_Simple')) {
     return 'AB_Product_Simple';
 }
 return $classname;
}
add_filter( 'woocommerce_product_class', 'atelierbourgeons_product_class');

add_filter( 'woocommerce_get_breadcrumb', 'atelierbourgeons_get_breadcrumb' ,10, 2);
function atelierbourgeons_get_breadcrumb($crumbs, $item) {
//    throw new Exception('heeeelloo :' . $crumbs);
  //  var_dump( $crumbs );
        global $post;
        $new_production_id = wc_get_not_stated_production_item($post->ID);        
        if( $new_production_id  !== '' ) {
            $atelier_id = get_option('woocommerce_atelier_page_id');
            $crumbs = array( array( get_the_title( $atelier_id ) , get_permalink($atelier_id) ) , 
                array( get_the_title( ) ) );
        }else if (is_product($new_production_id)) {
            $shop_id = get_option('woocommerce_collection_page_id');
            $crumbs[0] = array( get_the_title($shop_id)  ,get_permalink( $shop_id));
        }
        return $crumbs;
}

/*add_action('woocommerce_view_order','display_bank_details_and_timeline_order');
 
function display_bank_details_and_timeline_order($order_id)
{
 $order=new WC_Order( $order_id );
  //if ( $order->payment_method !== 'bacs') return;
  
  if ( $order->get_payment_method() == 'bacs') {
    //echo $order->payment_method_title;
    $bacs = new WC_Gateway_BACS();
    //print_r( $bacs->account_details);
      $bacs->thankyou_page( $order_id);
    }
    echo '<section id="order-timeline">';
    include 'woocommerce/wc-timeline-single-product.php'; 
    echo '</section>';
      
}*/



	/**
	 * Create dropdown HTML content of posts
	 *
	 * The content can either be displayed, which it is by default or retrieved by
	 * setting the 'echo' argument. The 'include' and 'exclude' arguments do not
	 * need to be used; all published posts will be displayed in that case.
	 *
	 * Supports all WP_Query arguments
	 * @see https://codex.wordpress.org/Class_Reference/WP_Query
	 *
	 * The available arguments are as follows:
	 *
	 * @author Myles McNamara
	 * @website https://smyl.es
	 * @updated March 29, 2016
	 *
	 * @since 1.0.0
	 *
	 * @param array|string $args {
	 *     Optional. Array or string of arguments to generate a drop-down of posts.
	 *     {@see WP_Query for additional available arguments.
	 *
	 *     @type string       $show_option_all         Text to show as the drop-down default (all).
	 *                                                 Default empty.
	 *     @type string       $show_option_none        Text to show as the drop-down default when no
	 *                                                 posts were found. Default empty.
	 *     @type int|string   $option_none_value       Value to use for $show_option_non when no posts
	 *                                                 were found. Default -1.
	 *     @type array|string $show_callback           Function or method to filter display value (label)
	 *
	 *     @type string       $orderby                 Field to order found posts by.
	 *                                                 Default 'post_title'.
	 *     @type string       $order                   Whether to order posts in ascending or descending
	 *                                                 order. Accepts 'ASC' (ascending) or 'DESC' (descending).
	 *                                                 Default 'ASC'.
	 *     @type array|string $include                 Array or comma-separated list of post IDs to include.
	 *                                                 Default empty.
	 *     @type array|string $exclude                 Array or comma-separated list of post IDs to exclude.
	 *                                                 Default empty.
	 *     @type bool|int     $multi                   Whether to skip the ID attribute on the 'select' element.
	 *                                                 Accepts 1|true or 0|false. Default 0|false.
	 *     @type string       $show                    Post table column to display. If the selected item is empty
	 *                                                 then the Post ID will be displayed in parentheses.
	 *                                                 Accepts post fields. Default 'post_title'.
	 *     @type int|bool     $echo                    Whether to echo or return the drop-down. Accepts 1|true (echo)
	 *                                                 or 0|false (return). Default 1|true.
	 *     @type int          $selected                Which post ID should be selected. Default 0.
	 *     @type string       $select_name             Name attribute of select element. Default 'post_id'.
	 *     @type string       $id                      ID attribute of the select element. Default is the value of $select_name.
	 *     @type string       $class                   Class attribute of the select element. Default empty.
	 *     @type array|string $post_status             Post status' to include, default publish
	 *     @type string       $who                     Which type of posts to query. Accepts only an empty string or
	 *                                                 'authors'. Default empty.
	 * }
	 * @return string String of HTML content.
	 */
	function wp_dropdown_posts( $args = '' ) {
		$defaults = array(
			'selected'              => FALSE,
			'pagination'            => FALSE,
			'posts_per_page'        => - 1,
			'post_status'           => 'publish',
			'cache_results'         => TRUE,
			'cache_post_meta_cache' => TRUE,
			'echo'                  => 1,
			'select_name'           => 'post_id',
			'id'                    => '',
			'class'                 => '',
			'show'                  => 'post_title',
			'show_callback'         => NULL,
			'show_option_all'       => NULL,
			'show_option_none'      => NULL,
			'option_none_value'     => '',
			'multi'                 => FALSE,
			'value_field'           => 'ID',
			'order'                 => 'ASC',
			'orderby'               => 'post_title',
		);
		$r = wp_parse_args( $args, $defaults );
		$posts  = get_posts( $r );
		$output = '';
		$show = $r['show'];
		if( ! empty($posts) ) {
			$name = esc_attr( $r['select_name'] );
			if( $r['multi'] && ! $r['id'] ) {
				$id = '';
			} else {
				$id = $r['id'] ? " id='" . esc_attr( $r['id'] ) . "'" : " id='$name'";
			}
			$output = "<select name='{$name}'{$id} class='" . esc_attr( $r['class'] ) . "'>\n";
			if( $r['show_option_all'] ) {
				$output .= "\t<option value='0'>{$r['show_option_all']}</option>\n";
			}
			if( $r['show_option_none'] ) {
				$_selected = selected( $r['show_option_none'], $r['selected'], FALSE );
				$output .= "\t<option value='" . esc_attr( $r['option_none_value'] ) . "'$_selected>{$r['show_option_none']}</option>\n";
			}
			foreach( (array) $posts as $post ) {
				$value   = ! isset($r['value_field']) || ! isset($post->{$r['value_field']}) ? $post->ID : $post->{$r['value_field']};
				$_selected = selected( $value, $r['selected'], FALSE );
				$display = ! empty($post->$show) ? $post->$show : sprintf( __( '#%d (no title)' ), $post->ID );
				if( $r['show_callback'] ) $display = call_user_func( $r['show_callback'], $display, $post->ID );
				$output .= "\t<option value='{$value}'{$_selected}>" . esc_html( $display ) . "</option>\n";
			}
			$output .= "</select>";
		}
		/**
		 * Filter the HTML output of a list of pages as a drop down.
		 *
		 * @since 1.0.0
		 *
		 * @param string $output HTML output for drop down list of posts.
		 * @param array  $r      The parsed arguments array.
		 * @param array  $posts  List of WP_Post objects returned by `get_posts()`
		 */
		$html = apply_filters( 'wp_dropdown_posts', $output, $r, $posts );
		if( $r['echo'] ) {
			echo $html;
		}
		return $html;
	}

if ( ! function_exists( 'free_blog_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function free_blog_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'free_blog_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function free_blog_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'free-blog' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark" style="">' . $time_string . '</a>'
		);
                
                if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'free-blog' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( '%1$s', 'free-blog' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'free-blog' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( '%1$s', 'free-blog' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
                
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;


if ( ! function_exists( 'free_blog_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function free_blog_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'free-blog' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'free_blog_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function free_blog_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more', 10);