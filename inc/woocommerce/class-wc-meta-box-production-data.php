<?php
/**
 * Production Data
 *
 * Functions for displaying the production data meta box.
 *
 * @author 		WooThemes
 * @category 	Admin
 * @package 	WooCommerce/Admin/Meta Boxes
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if(!function_exists('wc_get_prod')) {
    require_once 'wc-prod-functions.php';
}
if(!function_exists('wc_get_production_statuses')) {
    require_once 'wc-prod-item-functions.php';
}

/**
 * WC_Meta_Box_Production_Data Class.
 */
class WC_Meta_Box_Production_Data {

	/**
	 * Billing fields.
	 *
	 * @var array
	 */
	protected static $billing_fields = array();

	/**
	 * Shipping fields.
	 *
	 * @var array
	 */
	protected static $shipping_fields = array();

	/**
	 * Init billing and shipping fields we display + save.
	 */
	public static function init_address_fields() {

		self::$billing_fields = apply_filters( 'woocommerce_admin_billing_fields', array(
			'first_name' => array(
				'label' => __( 'First name', 'woocommerce' ),
				'show'  => false,
			),
			'last_name' => array(
				'label' => __( 'Last name', 'woocommerce' ),
				'show'  => false,
			),
			'company' => array(
				'label' => __( 'Company', 'woocommerce' ),
				'show'  => false,
			),
			'address_1' => array(
				'label' => __( 'Address line 1', 'woocommerce' ),
				'show'  => false,
			),
			'address_2' => array(
				'label' => __( 'Address line 2', 'woocommerce' ),
				'show'  => false,
			),
			'city' => array(
				'label' => __( 'City', 'woocommerce' ),
				'show'  => false,
			),
			'postcode' => array(
				'label' => __( 'Postcode / ZIP', 'woocommerce' ),
				'show'  => false,
			),
			'country' => array(
				'label'   => __( 'Country', 'woocommerce' ),
				'show'    => false,
				'class'   => 'js_field-country select short',
				'type'    => 'select',
				'options' => array( '' => __( 'Select a country&hellip;', 'woocommerce' ) ) + WC()->countries->get_allowed_countries(),
			),
			'state' => array(
				'label' => __( 'State / County', 'woocommerce' ),
				'class'   => 'js_field-state select short',
				'show'  => false,
			),
			'email' => array(
				'label' => __( 'Email address', 'woocommerce' ),
			),
			'phone' => array(
				'label' => __( 'Phone', 'woocommerce' ),
			),
		) );

		self::$shipping_fields = apply_filters( 'woocommerce_admin_shipping_fields', array(
			'first_name' => array(
				'label' => __( 'First name', 'woocommerce' ),
				'show'  => false,
			),
			'last_name' => array(
				'label' => __( 'Last name', 'woocommerce' ),
				'show'  => false,
			),
			'company' => array(
				'label' => __( 'Company', 'woocommerce' ),
				'show'  => false,
			),
			'address_1' => array(
				'label' => __( 'Address line 1', 'woocommerce' ),
				'show'  => false,
			),
			'address_2' => array(
				'label' => __( 'Address line 2', 'woocommerce' ),
				'show'  => false,
			),
			'city' => array(
				'label' => __( 'City', 'woocommerce' ),
				'show'  => false,
			),
			'postcode' => array(
				'label' => __( 'Postcode / ZIP', 'woocommerce' ),
				'show'  => false,
			),
			'country' => array(
				'label'   => __( 'Country', 'woocommerce' ),
				'show'    => false,
				'type'    => 'select',
				'class'   => 'js_field-country select short',
				'options' => array( '' => __( 'Select a country&hellip;', 'woocommerce' ) ) + WC()->countries->get_shipping_countries(),
			),
			'state' => array(
				'label' => __( 'State / County', 'woocommerce' ),
				'class'   => 'js_field-state select short',
				'show'  => false,
			),
		) );
	}

	/**
	 * Output the metabox.
	 *
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
		global $theproduction;

		if ( ! is_object( $theproduction ) ) {
			$theproduction = wc_get_prod( $post->ID );
		}

		$production = $theproduction;

		self::init_address_fields();

		if ( WC()->payment_gateways() ) {
			$payment_gateways = WC()->payment_gateways->payment_gateways();
		} else {
			$payment_gateways = array();
		}
		$production_type_object = get_post_type_object( $post->post_type );
		wp_nonce_field( 'woocommerce_save_data', 'woocommerce_meta_nonce' );
		?>
		<style type="text/css">
			#post-body-content, #titlediv { display:none }
		</style>
		<div class="panel-wrap woocommerce">
			<input name="post_title" type="hidden" value="<?php echo empty( $post->post_title ) ? __( 'Production', 'woocommerce' ) : esc_attr( $post->post_title ); ?>" />
			<input name="post_status" type="hidden" value="<?php echo esc_attr( $post->post_status ); ?>" />
			<div id="production_data" class="panel">

				<h2><?php
					/* translators: 1: production type 2: production number */
					printf(
						esc_html__( '%1$s #%2$s details', 'woocommerce' ),
						$production_type_object->labels->singular_name,
						$production->get_production_number()
					);
				?></h2>
				<p class="production_number"><?php

					
					if ( $ip_address = $production->get_workshop_ip_address() ) {
						/* translators: %s: IP address */
						printf(
							__( 'Customer IP: %s', 'woocommerce' ),
							'<span class="woocommerce-Production-customerIP">' . esc_html( $ip_address ) . '</span>'
						);
					}
				?></p>

				<div class="production_data_column_container">
					<div class="production_data_column">
						<h3><?php _e( 'General Details', 'woocommerce' ); ?></h3>

						<p class="form-field form-field-wide"><label for="production_date"><?php _e( 'Production date:', 'woocommerce' ) ?></label>
                                                    <input type="text" class="date-picker" name="production_date" id="production_date" maxlength="10" value="<?php echo date_i18n( 'Y-m-d', strtotime( $production->get_production_date() ) ); ?>" pattern="<?php echo esc_attr( apply_filters( 'woocommerce_date_input_html_pattern', '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])' ) ); ?>" />@&lrm;                                                        
						</p>

						<p class="form-field form-field-wide"><label for="production_minimum"><?php _e( 'Minimum Order:', 'woocommerce' ) ?></label>
                                                    <input type=number name="production_minimum" step=1 value="<?php echo intval( $production->get_production_minimum() ); ?>" /> 
						</p>
                                                
						<select id="production_status" name="production_status" class="wc-enhanced-select">
							<?php
								$statuses = wc_get_production_statuses();
								foreach ( $statuses as $status => $status_name ) {
									echo '<option value="' . esc_attr( $status ) . '" ' . selected( $status, '' . $production->get_status( 'edit' ), false ) . '>' . esc_html( $status_name ) . '</option>';
								}
							?>
						</select>
                                        </p>

						<?php do_action( 'woocommerce_admin_production_data_after_production_details', $production ); ?>
					</div>					
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<?php
	}

	/**
	 * Save meta box data.
	 *
	 * @param int $production_id Production ID.
	 */
	public static function save( $production_id ) {
		//self::init_address_fields();

		// Ensure gateways are loaded in case they need to insert data into the emails.
		//WC()->payment_gateways();
		//WC()->shipping();

		// Get production object.
               
		$production = new WC_Production( $production_id );
                
		//$props = array();

		// Create production key.
		/*if ( ! $production->get_production_key() ) {
			$props['production_key'] = 'wc_' . apply_filters( 'woocommerce_generate_production_key', uniqid( 'production_' ) );
		}

		// Update customer.
		$customer_id = isset( $_POST['customer_user'] ) ? absint( $_POST['customer_user'] ) : 0;
		if ( $customer_id !== $production->get_customer_id() ) {
			$props['customer_id'] = $customer_id;
		}

		// Update billing fields.
		if ( ! empty( self::$billing_fields ) ) {
			foreach ( self::$billing_fields as $key => $field ) {
				if ( ! isset( $field['id'] ) ) {
					$field['id'] = '_billing_' . $key;
				}

				if ( ! isset( $_POST[ $field['id'] ] ) ) {
					continue;
				}

				if ( is_callable( array( $production, 'set_billing_' . $key ) ) ) {
					$props[ 'billing_' . $key ] = wc_clean( $_POST[ $field['id'] ] );
				} else {
					$production->update_meta_data( $field['id'], wc_clean( $_POST[ $field['id'] ] ) );
				}
			}
		}

		// Update shipping fields.
		if ( ! empty( self::$shipping_fields ) ) {
			foreach ( self::$shipping_fields as $key => $field ) {
				if ( ! isset( $field['id'] ) ) {
					$field['id'] = '_shipping_' . $key;
				}

				if ( ! isset( $_POST[ $field['id'] ] ) ) {
					continue;
				}

				if ( is_callable( array( $production, 'set_shipping_' . $key ) ) ) {
					$props[ 'shipping_' . $key ] = wc_clean( $_POST[ $field['id'] ] );
				} else {
					$production->update_meta_data( $field['id'], wc_clean( $_POST[ $field['id'] ] ) );
				}
			}
		}

		if ( isset( $_POST['_transaction_id'] ) ) {
			$props['transaction_id'] = wc_clean( $_POST['_transaction_id'] );
		}

		
		

		// Save production data.
		*/
                
		// Update date.
		if ( !empty( $_POST['production_date'] ) ) {
			$date = gmdate( 'Y-m-d H:i:s', strtotime( $_POST['production_date'] . ' 00:00:00' ) );
                        if(!$production->meta_exists( 'production_date' ) ) {
                            $production->add_meta_data( 'production_date' , $date, true);
                        }else {
                            $production->update_meta_data( 'production_date', $date );
                        }
		}
                
                //Update production minium
                if ( !empty( $_POST['production_minimum'] ) ) {
                        $min = $_POST['production_minimum'];
                        if(!$production->meta_exists( 'production_minimum' ) ) {
                            $production->add_meta_data( 'production_minimum' , $min, true);
                        }else {
                            $production->update_meta_data( 'production_minimum', $min );
                        }
                }
                if ( !empty( $_POST['production_status'] ) ) {
                    $production->set_status( wc_clean( $_POST['production_status'] ), '', true );
                }
		$production->save();
	}
}
