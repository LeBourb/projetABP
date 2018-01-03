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
        require 'inc/woocommerce/wc-custom-admin-order.php';
        require 'inc/woocommerce/wc-custom-admin-production.php';
        require 'inc/woocommerce/wc-custom-admin-workshop.php';
        require 'inc/woocommerce/wc-custom-admin-supplier.php';
        require 'inc/woocommerce/wc-product-attribute-workshop.php';
        require 'inc/woocommerce/wc-product-attribute-supply.php';
        require 'inc/woocommerce/wc-product-attribute-fabrics.php';
        require 'inc/woocommerce/class-wc-product-attribute-supply-form.php';
        require 'inc/woocommerce/class-wc-product-attribute-fabrics-form.php';
        require 'inc/woocommerce/wc-custom-product-supplies-tab.php';
        require 'inc/woocommerce/wc-checkout_terms_conditions_popup.php';
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
add_filter( 'registration_errors', 'bbloomer_validate_name_fields',40, 3 );
 
function bbloomer_validate_name_fields( $errors, $username, $email ) {
    global $_POST;
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
add_action('user_register', 'bbloomer_save_name_fields', 60, 1);
 
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
    if ( isset( $_POST['billing_postcode'] ) ) {
        update_user_meta( $customer_id, 'billing_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );     
        update_user_meta( $customer_id, 'shipping_postcode', sanitize_text_field( $_POST['billing_postcode'] ) );     
    }
    update_user_meta( $customer_id, 'billing_country', 'JPY' );
    
    //update_user_status( $customer_id, 'spam', 1 );
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

add_action( 'init', 'create_prod_post_type' );
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
}


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

add_action( 'woocommerce_before_checkout_form', 'my_checkout_msg' );

function my_checkout_msg() {
	echo '<p>To validate your order, you must pay 30% of the total price, Thank you!</p>';
}

function create_post_type_production() {
  register_post_type( 'shop_production',
    array(
      'labels' => array(
        'name' => __( 'Productions' ),
        'singular_name' => __( 'Production' )
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true
    )
  );
  register_post_type( 'shop_workshop',
    array(
      'labels' => array(
        'name' => __( 'Workshops' ),
        'singular_name' => __( 'Workshop' )
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
}
add_action( 'init', 'create_post_type_production' );
if (!function_exists('get_post_id_by_meta_key_and_value')) {
	/**
	 * Get post id from meta key and value
	 * @param string $key
	 * @param mixed $value
	 * @return int|bool
	 * @author David M&aring;rtensson <david.martensson@gmail.com>
	 */
	function get_post_id_by_meta_key_and_value($key, $value) {
		global $wpdb;
		$meta = $wpdb->get_results("SELECT * FROM `".$wpdb->postmeta."` WHERE meta_key='".$wpdb->escape($key)."' AND meta_value='".$wpdb->escape($value)."'");
		if (is_array($meta) && !empty($meta) && isset($meta[0])) {
			$meta = $meta[0];
		}		
		if (is_object($meta)) {
			return $meta->post_id;
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

//add_role( 'workshop_role', 'Workshop', array( 'read' => true, 'level_0' => true ) );
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
}

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

