<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Bank Transfer Payment Gateway.
 *
 * Provides a Bank Transfer Payment Gateway. Based on code by Mike Pepper.
 *
 * @class       WC_Gateway_BACS_JP
 * @extends     WC_Payment_Gateway
 * @version     2.1.0
 * @package     WooCommerce/Classes/Payment
 * @author      WooThemes
 */
class WC_Gateway_BACS_JP extends WC_Payment_Gateway {

	/** @var array Array of locales */
	public $locale;

	/**
	 * Constructor for the gateway.
	 */
	public function __construct() {

		$this->id                 = 'bacs_jp';
		$this->icon               = apply_filters( 'woocommerce_bacs_jp_icon', '' );
		$this->has_fields         = false;
		$this->method_title       = __( 'BACS JP', 'woocommerce' );
		$this->method_description = __( 'Allows payments by BACS JP, more commonly known as direct bank/wire transfer.', 'woocommerce' );

		// Load the settings.
		$this->init_form_fields();
		$this->init_settings();

		// Define user set variables
		$this->title        = $this->get_option( 'title' );
		$this->description  = $this->get_option( 'description' );
		$this->instructions = $this->get_option( 'instructions' );

		// BACS account fields shown on the thanks page and in emails
		$this->account_details = get_option( 'woocommerce_bacs_jp_accounts',
			array(
				array(
					'account_name'   => $this->get_option( 'account_name' ),
					'account_number' => $this->get_option( 'account_number' ),
					'sort_code'      => $this->get_option( 'sort_code' ),
                                        'office_code'    => $this->get_option( 'office_code' ),
                                        'name_office'    => $this->get_option( 'name_office' )
				),
			)
		);
                // 店番号: $account['office_code'] 
                // 預金種目: $account['account_type'] 
                // 店名: $account['name_office'] 

		// Actions
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
		add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'save_account_details' ) );
		add_action( 'woocommerce_thankyou_bacs_jp', array( $this, 'thankyou_page' ) );

		// Customer Emails
		add_action( 'woocommerce_email_before_order_table', array( $this, 'email_instructions' ), 10, 3 );
	}

	/**
	 * Initialise Gateway Settings Form Fields.
	 */
	public function init_form_fields() {

		$this->form_fields = array(
			'enabled' => array(
				'title'   => __( 'Enable/Disable', 'woocommerce' ),
				'type'    => 'checkbox',
				'label'   => __( 'Enable bank transfer', 'woocommerce' ),
				'default' => 'no',
			),
			'title' => array(
				'title'       => __( 'Title', 'woocommerce' ),
				'type'        => 'text',
				'description' => __( 'This controls the title which the user sees during checkout.', 'woocommerce' ),
				'default'     => __( 'Direct bank transfer', 'woocommerce' ),
				'desc_tip'    => true,
			),
			'description' => array(
				'title'       => __( 'Description', 'woocommerce' ),
				'type'        => 'textarea',
				'description' => __( 'Payment method description that the customer will see on your checkout.', 'woocommerce' ),
				'default'     => __( 'Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.', 'woocommerce' ),
				'desc_tip'    => true,
			),
			'instructions' => array(
				'title'       => __( 'Instructions', 'woocommerce' ),
				'type'        => 'textarea',
				'description' => __( 'Instructions that will be added to the thank you page and emails.', 'woocommerce' ),
				'default'     => '',
				'desc_tip'    => true,
			),
			'account_details' => array(
				'type'        => 'account_details',
			),
		);

	}

	/**
	 * Generate account details html.
	 *
	 * @return string
	 */
	public function generate_account_details_html() {

		ob_start();

		$country 	= WC()->countries->get_base_country();
		$locale		= $this->get_country_locale();

		// Get sortcode label in the $locale array and use appropriate one
		$sortcode = isset( $locale[ $country ]['sortcode']['label'] ) ? $locale[ $country ]['sortcode']['label'] : __( 'Sort code', 'woocommerce' );

		?>
		<tr valign="top">
			<th scope="row" class="titledesc"><?php _e( 'Account details', 'woocommerce' ); ?>:</th>
			<td class="forminp" id="bacs_jp_accounts">
				<table class="widefat wc_input_table sortable" cellspacing="0">
					<thead>
						<tr>
							<th class="sort">&nbsp;</th>
							<th><?php _e( '口座名義', 'woocommerce' ); ?></th>
							<th><?php _e( '口座番号', 'woocommerce' ); ?></th>
							<th><?php _e( '銀行名', 'woocommerce' ); ?></th>
							<th><?php _e( '金融機関コード', 'woocommerce' ); ?></th>
							<th><?php _e( '店番号', 'woocommerce' ); ?></th>
                                                        <th><?php _e( '預金種目', 'woocommerce' ); ?></th>
                                                        <th><?php _e( '店名', 'woocommerce' ); ?></th>
						</tr>
					</thead>
					<tbody class="accounts">
						<?php
						$i = -1;
						if ( $this->account_details ) {
							foreach ( $this->account_details as $account ) {
								$i++;

								echo '<tr class="account">
									<td class="sort"></td>
									<td><input type="text" value="' . esc_attr( wp_unslash( $account['account_name'] ) ) . '" name="bacs_jp_account_name[' . $i . ']" /></td>
									<td><input type="text" value="' . esc_attr( $account['account_number'] ) . '" name="bacs_jp_account_number[' . $i . ']" /></td>
									<td><input type="text" value="' . esc_attr( wp_unslash( $account['bank_name'] ) ) . '" name="bacs_jp_bank_name[' . $i . ']" /></td>
									<td><input type="text" value="' . esc_attr( $account['sort_code'] ) . '" name="bacs_jp_sort_code[' . $i . ']" /></td>
                                                                        <td><input type="text" value="' . esc_attr( $account['office_code'] ) . '" name="bacs_jp_office_code[' . $i . ']" /></td>
                                                                        <td><input type="text" value="' . esc_attr( $account['account_type'] ) . '" name="bacs_jp_account_type[' . $i . ']" /></td>
                                                                        <td><input type="text" value="' . esc_attr( $account['name_office'] ) . '" name="bacs_jp_name_office[' . $i . ']" /></td>									
								</tr>';
                                                                // 口座名義: $account['account_name']
                                                                // 口座番号: $account['account_number'] 
                                                                // 銀行名: $account['bank_name']
                                                                // 金融機関コード: $account['sort_code'] 
                                                                // 店番号: $account['office_code'] 
                                                                // 預金種目: $account['account_type'] 
                                                                // 店名: $account['name_office'] 
                                                                





							}
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="7"><a href="#" class="add button"><?php _e( '+ Add account', 'woocommerce' ); ?></a> <a href="#" class="remove_rows button"><?php _e( 'Remove selected account(s)', 'woocommerce' ); ?></a></th>
						</tr>
					</tfoot>
				</table>
				<script type="text/javascript">
					jQuery(function() {
						jQuery('#bacs_jp_accounts').on( 'click', 'a.add', function(){

							var size = jQuery('#bacs_jp_accounts').find('tbody .account').length;

							jQuery('<tr class="account">\
									<td class="sort"></td>\
									<td><input type="text" name="bacs_jp_account_name[' + size + ']" /></td>\
									<td><input type="text" name="bacs_jp_account_number[' + size + ']" /></td>\
									<td><input type="text" name="bacs_jp_bank_name[' + size + ']" /></td>\
									<td><input type="text" name="bacs_jp_sort_code[' + size + ']" /></td>\	
                                                                        <td><input type="text" name="bacs_jp_office_code[' + size + ']" /></td>\	
                                                                        <td><input type="text" name="bacs_jp_account_type[' + size + ']" /></td>\	
                                                                        <td><input type="text" name="bacs_jp_name_office[' + size + ']" /></td>\	                                                                
								</tr>').appendTo('#bacs_jp_accounts table tbody');

							return false;
						});
					});
				</script>
			</td>
		</tr>
		<?php
		return ob_get_clean();

	}

	/**
	 * Save account details table.
	 */
	public function save_account_details() {

		$accounts = array();

		if ( isset( $_POST['bacs_jp_account_name'] ) ) {

			$account_names   = array_map( 'wc_clean', $_POST['bacs_jp_account_name'] );
			$account_numbers = array_map( 'wc_clean', $_POST['bacs_jp_account_number'] );
			$bank_names      = array_map( 'wc_clean', $_POST['bacs_jp_bank_name'] );
			$sort_codes      = array_map( 'wc_clean', $_POST['bacs_jp_sort_code'] );
                        $office_code      = array_map( 'wc_clean', $_POST['bacs_jp_office_code'] );
                        $account_type      = array_map( 'wc_clean', $_POST['bacs_jp_account_type'] );
                        $name_office      = array_map( 'wc_clean', $_POST['bacs_jp_name_office'] );
			foreach ( $account_names as $i => $name ) {
				if ( ! isset( $account_names[ $i ] ) ) {
					continue;
				}

				$accounts[] = array(
					'account_name'   => $account_names[ $i ],
					'account_number' => $account_numbers[ $i ],
					'bank_name'      => $bank_names[ $i ],
					'sort_code'      => $sort_codes[ $i ],
                                        'office_code'      => $office_code[ $i ],
                                        'account_type'      => $account_type[ $i ],
                                        'name_office'      => $name_office[ $i ]
				);
			}
		}

		update_option( 'woocommerce_bacs_jp_accounts', $accounts );

	}

	/**
	 * Output for the order received page.
	 *
	 * @param int $order_id
	 */
	public function thankyou_page( $order_id ) {

		if ( $this->instructions ) {
			echo wpautop( wptexturize( wp_kses_post( $this->instructions ) ) );
		}
		$this->bank_details( $order_id );

	}

	/**
	 * Add content to the WC emails.
	 *
	 * @param WC_Order $order
	 * @param bool $sent_to_admin
	 * @param bool $plain_text
	 */
	public function email_instructions( $order, $sent_to_admin, $plain_text = false ) {

		if ( ! $sent_to_admin && 'bacs_jp' === $order->get_payment_method() && $order->has_status( 'on-hold' ) ) {
			if ( $this->instructions ) {
				echo wpautop( wptexturize( $this->instructions ) ) . PHP_EOL;
			}
			$this->bank_details( $order->get_id() );
		}

	}

	/**
	 * Get bank details and place into a list format.
	 *
	 * @param int $order_id
	 */
	private function bank_details( $order_id = '' ) {

		if ( empty( $this->account_details ) ) {
			return;
		}

		// Get order and store in $order
		$order 		= wc_get_order( $order_id );

		// Get the order country and country $locale
		$country 	= $order->get_billing_country();
		$locale		= $this->get_country_locale();

		// Get sortcode label in the $locale array and use appropriate one
		$sortcode = isset( $locale[ $country ]['sortcode']['label'] ) ? $locale[ $country ]['sortcode']['label'] : __( 'Sort code', 'woocommerce' );

		$bacs_jp_accounts = apply_filters( 'woocommerce_bacs_jp_accounts', $this->account_details );

		if ( ! empty( $bacs_jp_accounts ) ) {
			$account_html = '';
			$has_details  = false;

			foreach ( $bacs_jp_accounts as $bacs_jp_account ) {
				$bacs_jp_account = (object) $bacs_jp_account;

				if ( $bacs_jp_account->account_name ) {
					$account_html .= '<h3 class="wc-bacs-jp-bank-details-account-name">' . wp_kses_post( wp_unslash( $bacs_jp_account->account_name ) ) . ':</h3>' . PHP_EOL;
				}

				$account_html .= '<ul class="wc-bacs-jp-bank-details order_details bacs_jp_jp_details">' . PHP_EOL;

				// BACS account fields shown on the thanks page and in emails
				$account_fields = apply_filters( 'woocommerce_bacs_jp_account_fields', array(
                                        'account_name' => array(
						'label' => '口座名義',
						'value' => $bacs_jp_account->account_name,
					),
					'bank_name' => array(
						'label' => '銀行名',
						'value' => $bacs_jp_account->bank_name,
					),
					'sort_code'     => array(
						'label' => '金融機関コード',
						'value' => $bacs_jp_account->sort_code,
					),
                                        'office_code'     => array(
						'label' => '店番号',
						'value' => $bacs_jp_account->office_code,
					),
                                        'account_type'     => array(
						'label' => '預金種目',
						'value' => $bacs_jp_account->account_type,
					),
                                        'name_office'     => array(
						'label' => '店名',
						'value' => $bacs_jp_account->name_office,
					),
					'account_number' => array(
						'label' => '口座番号',
						'value' => $bacs_jp_account->account_number,
					)
				), $order_id );

				foreach ( $account_fields as $field_key => $field ) {
					if ( ! empty( $field['value'] ) ) {
						$account_html .= '<li class="' . esc_attr( $field_key ) . '">' . wp_kses_post( $field['label'] ) . ': <strong>' . wp_kses_post( wptexturize( $field['value'] ) ) . '</strong></li>' . PHP_EOL;
						$has_details   = true;
					}
				}

				$account_html .= '</ul>';
			}

			if ( $has_details ) {
				echo '<section class="woocommerce-bacs-jp-bank-details"><h2 class="wc-bacs-jp-bank-details-heading">' . __( 'Our bank details', 'woocommerce' ) . '</h2>' . PHP_EOL . $account_html . '</section>';
			}
		}

	}

	/**
	 * Process the payment and return the result.
	 *
	 * @param int $order_id
	 * @return array
	 */
	public function process_payment( $order_id ) {

		$order = wc_get_order( $order_id );

		// Mark as on-hold (we're awaiting the payment)
		$order->update_status( 'on-hold', __( 'Awaiting BACS payment', 'woocommerce' ) );

		// Reduce stock levels
		wc_reduce_stock_levels( $order_id );

		// Remove cart
		WC()->cart->empty_cart();

		// Return thankyou redirect
		return array(
			'result'    => 'success',
			'redirect'  => $this->get_return_url( $order ),
		);

	}

	/**
	 * Get country locale if localized.
	 *
	 * @return array
	 */
	public function get_country_locale() {

		if ( empty( $this->locale ) ) {

			// Locale information to be used - only those that are not 'Sort Code'
			$this->locale = apply_filters( 'woocommerce_get_bacs_jp_locale', array(
				'AU' => array(
					'sortcode'	=> array(
						'label'		=> __( 'BSB', 'woocommerce' ),
					),
				),
				'CA' => array(
					'sortcode'	=> array(
						'label'		=> __( 'Bank transit number', 'woocommerce' ),
					),
				),
				'IN' => array(
					'sortcode'	=> array(
						'label'		=> __( 'IFSC', 'woocommerce' ),
					),
				),
				'IT' => array(
					'sortcode'	=> array(
						'label'		=> __( 'Branch sort', 'woocommerce' ),
					),
				),
				'NZ' => array(
					'sortcode'	=> array(
						'label'		=> __( 'Bank code', 'woocommerce' ),
					),
				),
				'SE' => array(
					'sortcode'	=> array(
						'label'		=> __( 'Bank code', 'woocommerce' ),
					),
				),
				'US' => array(
					'sortcode'	=> array(
						'label'		=> __( 'Routing number', 'woocommerce' ),
					),
				),
				'ZA' => array(
					'sortcode'	=> array(
						'label'		=> __( 'Branch code', 'woocommerce' ),
					),
				),
			) );

		}

		return $this->locale;

	}
}
