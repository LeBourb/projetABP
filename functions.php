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
        require 'inc/admin/class-wc-meta-box-product-size-details.php';
        require 'inc/admin/class-wc-meta-box-product-size-guide.php';
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
    <input type="text" class="input-text" name="billing_address_2" id="reg_billing_address_2" value="<?php if ( ! empty( $_POST['billing_address_2'] ) ) esc_attr_e( $_POST['billing_address_2'] ); ?>" required/>
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
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), 'v1.2' );
    wp_enqueue_style( 'animate-style', get_template_directory_uri() . '/assets/css/animate.css', array(), 'v1.2' );
    //wp_enqueue_style( 'fa-solid-style', get_template_directory_uri() . '/assets/css/fa-solid.min.css' , array(), 'v1.3');
    wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/assets/css/font-awesome.min.css' , array(), 'v1.2');
    wp_enqueue_style( 'owl-theme-style', get_template_directory_uri() . '/assets/css/owl.theme.min.css' , array(), 'v1.2');
    wp_enqueue_style( 'owl-carousel-style', get_template_directory_uri() . '/assets/css/owl.carousel.min.css' , array(), 'v.1.2');
    wp_enqueue_style( 'homepage-style', get_template_directory_uri() . '/assets/css/homepage.css' , array(), filemtime( getcwd() .  '/wp-content/themes/atelierbourgeonspro/assets/css/homepage.css' ));
    wp_enqueue_style( 'timeline-style', get_template_directory_uri() . '/assets/css/timeline.min.css' , array(), 'v1.2');
    wp_enqueue_style( 'project-gmap-style', get_template_directory_uri() . '/assets/css/project-gmap.min.css' , array(), 'v1.2');
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/style.min.css' , array(), filemtime( getcwd() .  '/wp-content/themes/atelierbourgeonspro/assets/css/style.min.css' ));
    wp_enqueue_style( 'viewer-style', get_template_directory_uri() . '/assets/css/viewer.min.css' , array(), 'v1.2');
    wp_enqueue_style( 'popup-style', get_template_directory_uri() . '/assets/css/popup.min.css' , array(), 'v1.2');
    
    
    wp_enqueue_script( 'jquery-script', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'jquery-form-script', get_template_directory_uri() . '/assets/js/jquery.form.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'jquery-validate-script', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'jquery-parallax-script', get_template_directory_uri() . '/assets/js/jquery.parallax.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'owl-carousel-script', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'smoothscroll-script', get_template_directory_uri() . '/assets/js/smoothscroll.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'wow-script', get_template_directory_uri() . '/assets/js/wow.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/assets/js/custom.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'easy-pie-chart-script', get_template_directory_uri() . '/assets/js/easy-pie-chart.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'canvas-script', get_template_directory_uri() . '/assets/js/canvas.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'sly-script', get_template_directory_uri() . '/assets/js/sly.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'viewer-script', get_template_directory_uri() . '/assets/js/viewer.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'popup-script', get_template_directory_uri() . '/assets/js/simplepopup.min.js', array(), 'v1.2' );
    wp_enqueue_script( 'img-lazy-load-script', get_template_directory_uri() . '/assets/js/img-lazy-loading.js', array(), filemtime( getcwd() .  '/wp-content/themes/atelierbourgeonspro/assets/js/img-lazy-loading.js' ) );
    //wp_enqueue_script( 'project-gmap-infobox-script', get_template_directory_uri() . '/assets/js/project-gmap-infobox.min.js', array(), 'v1.2' );
    //wp_enqueue_script( 'project-gmap-script', get_template_directory_uri() . '/assets/js/project-gmap.min.js', array(), 'v1.2' );
    
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
    return $array;    
}


add_action( 'woocommerce_update_options' , 'atelierbourgeons_update_pro_terms_conditions' );
function atelierbourgeons_update_pro_terms_conditions() {
    if(isset($_POST['woocommerce_terms_pro_page_id'])) {
        update_option('woocommerce_terms_pro_page_id', $_POST['woocommerce_terms_pro_page_id'] );
    }
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

add_filter( 'woocommerce_shipping_package_name', 'atelierbourgeons_shipping_package_name' , 10 , 3) ;

function atelierbourgeons_shipping_package_name($arg1, $arg2, $arg3) {
    return '配送';
}

add_action( 'woocommerce_update_options' , 'atelierbourgeons_update_shopping_guide' );
function atelierbourgeons_update_shopping_guide() {
    if(isset($_POST['woocommerce_shopping_guide_page_id'])) {
        update_option('woocommerce_shopping_guide_page_id', $_POST['woocommerce_shopping_guide_page_id'] );
    }
}

add_action( 'woocommerce_update_options' , 'atelierbourgeons_update_consumer_notice' );
function atelierbourgeons_update_consumer_notice() {
    if(isset($_POST['woocommerce_consumer_notice_page_id'])) {
        update_option('woocommerce_consumer_notice_page_id', $_POST['woocommerce_consumer_notice_page_id'] );
    }
}

add_action( 'woocommerce_update_options' , 'atelierbourgeons_update_privacy_policy' );
function atelierbourgeons_update_privacy_policy() {
    if(isset($_POST['woocommerce_privacy_policy_page_id'])) {
        update_option('woocommerce_privacy_policy_page_id', $_POST['woocommerce_privacy_policy_page_id'] );
    }
}

add_action( 'woocommerce_update_options' , 'atelierbourgeons_update_contact_form' );
function atelierbourgeons_update_contact_form() {
    if(isset($_POST['woocommerce_contact_form_page_id'])) {
        update_option('woocommerce_contact_form_page_id', $_POST['woocommerce_contact_form_page_id'] );
    }
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
                            この度は、atelier Bourgeons （アトリエブルジョン）の会員登録をご申請いただき、誠にありがとうございます。
                            ビジネス会員の登録認証が完了しましたので、お知らせいたします。下記のアカウントにてログイン後、ビジネス会員価格で商品をご注文いただけます。
                        </p>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" style="padding:20px 0 15px">
                        <table border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse!important">
                          <tbody><tr>
                            <td align="center" style="border-radius:26px" bgcolor="#0570D4">
                              <a href="'. get_site_url() .'" style="background: #613143;border: 1px solid #613143;border-radius: 14px;color:#ffffff;display:block;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:16px;padding:14px 26px;text-decoration:none" target="_blank" data-saferedirecturl="">ビジネス会員価格でバイイングを始める→</a>
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
        $subject = '【ご登録のアカウントを有効化してください】/atelier Bourgeons （ｱﾄﾘｴﾌﾞﾙｼﾞｮﾝ）';   
        $code = sha1( $user->ID . time() ); 
        global $wpdb;
        $wpdb->update( $wpdb->users, array( 'user_activation_key' => $code ), array( 'ID' => $user->ID ) );
        //$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
        $activation_url = add_query_arg( array( 'action' => 'confirm-email', 'key' => $code, 'user' => $user->ID), wp_login_url() );
        $message = mail_new_user_confirm_email($user,$activation_url);
        $txt = txt_new_user_confirm_email($activation_url);
    }else {
        $subject = '【会員認証の完了までしばらくお待ちください】/atelier Bourgeons （ｱﾄﾘｴﾌﾞﾙｼﾞｮﾝ）';
        $message = mail_new_user_checking($user);
        $txt = txt_new_user_checking();
    }
    
    /*$message = '--boundary42 \r\n
Content-type: text/plain; charset=iso-8859-1 \r\n
' . $txt . '  \r\n
--boundary42 \r\n
Content-type: text/html; charset=iso-8859-1 \r\n
 ' . $message . '  \r\n '
            . '--boundary42--';*/
        
    /*function wpse27856_set_content_type(){
        return "multipart/alternative; boundary=boundary42";
    }*/
    //add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
    wp_mail( $user_email, $subject, $message, $headers);
    //remove_filter( 'wp_mail_content_type', 'wpse27856_set_content_type' );
    
    return $status;
}
add_filter( 'new_user_approve_default_status', 'atelierbourgeons_new_user_checking' , 21 ,12);



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
function my_login_redirect( $url, $request, $user ){
    if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
        if( $user->has_cap( 'administrator' ) ) {
            $url = admin_url();
        } else {            
            $url = get_permalink( woocommerce_get_page_id( 'shop' ) );
        }
    }
    return $url;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3 );

add_role( 'customer-pro', 'Professional Customer', array( 'read' => true, 'level_0' => true ) );
//init the meta box
add_action( 'after_setup_theme', 'custom_postimage_setup' );
function custom_postimage_setup(){
    add_action( 'add_meta_boxes', 'custom_postimage_meta_box' );
    add_action( 'save_post', 'custom_postimage_meta_box_save' );
}

function custom_postimage_meta_box(){

    //on which post types should the box appear?
    $post_types = array('post','shop_workshop');
    foreach($post_types as $pt){
        add_meta_box('custom_postimage_meta_box',__( 'More Featured Images', 'yourdomain'),'custom_postimage_meta_box_func',$pt,'side','low');
    }
    add_meta_box( 'awesomefacets', __( 'Add facets', 'woocommerce' ), 'WC_Meta_Box_Product_Awesome_Description::output', 'product');
    add_meta_box( 'productsizedetails', __( 'Size&Details', 'woocommerce' ), 'WC_Meta_Box_Product_Size_Details::output', 'product');
    add_meta_box( 'productsizeguide', __( 'Sizing Guide', 'woocommerce' ), 'WC_Meta_Box_Product_Size_Guide::output', 'product');
}

//add_action( 'save_post', 'WC_Meta_Box_Product_Awesome_Description::save' );
add_action( 'wp_ajax_woocommerce_add_awesome_description', 'WC_Meta_Box_Product_Awesome_Description::add' );
add_action( 'wp_ajax_woocommerce_remove_awesome_description', 'WC_Meta_Box_Product_Awesome_Description::remove' );
add_action( 'wp_ajax_woocommerce_save_awesome_description', 'WC_Meta_Box_Product_Awesome_Description::save' );
add_action( 'save_post', 'WC_Meta_Box_Product_Size_Details::save' );
add_action( 'save_post', 'WC_Meta_Box_Product_Size_Guide::save' );
    
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

add_action('woocommerce_view_order','display_bank_details_and_timeline_order');
 
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
      
}

