<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email_Customer_Registration_Approved_Pro', false ) ) :

/**
 * Customer Reset Password.
 *
 * An email sent to the customer when they reset their password.
 *
 * @class       WC_Email_Customer_Registration_Approved_Pro
 * @version     2.3.0
 * @package     WooCommerce/Classes/Emails
 * @author      WooThemes
 * @extends     WC_Email
 */
class WC_Email_Customer_Registration_Approved_Pro extends WC_Email {

	/**
	 * User login name.
	 *
	 * @var string
	 */
	public $user_login;

	/**
	 * User email.
	 *
	 * @var string
	 */
	public $user_email;

	/**
	 * Reset key.
	 *
	 * @var string
	 */
	public $reset_key;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id               = 'customer_registration_approved_pro';
		$this->customer_email   = true;

		$this->title            = __( 'Registration approved pro', 'woocommerce' );
		$this->description      = __( 'Customer "reset password" emails are sent when customers reset their passwords.', 'woocommerce' );

		$this->template_html    = 'emails/customer-registration-approved-pro.php';
		$this->template_plain   = 'emails/plain/customer-registration-approved-pro.php';

		// Trigger
		add_action( 'woocommerce_registration_approved_pro_notification', array( $this, 'trigger' ), 10, 1 );

		// Call parent constructor
		parent::__construct();
	}

	/**
	 * Get email subject.
	 *
	 * @since  3.1.0
	 * @return string
	 */
	public function get_default_subject() {
		return __( 'ビジネス会員登録の認証が完了しました！', 'woocommerce' );
	}

	/**
	 * Get email heading.
	 *
	 * @since  3.1.0
	 * @return string
	 */
	public function get_default_heading() {
		return __( 'ビジネス会員登録の認証が完了しました！', 'woocommerce' );
	}

	/**
	 * Trigger.
	 *
	 * @param string $user_id
	 */
	public function trigger( $user_id = '' ) {
		$this->setup_locale();

                if ( $user_id ) {
                        $user_info = get_userdata($user_id);
			$this->object     = get_user_by( 'ID', $user_id );
                        $this->user_login = $user_info->data->user_login;
			$this->user_email = stripslashes( $this->object->user_email );
			$this->recipient  = $this->user_email;
		}

		if ( $this->is_enabled() && $this->get_recipient() ) {
			$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
		}

		$this->restore_locale();
	}

	/**
	 * Get content html.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_html() {
		return wc_get_template_html( $this->template_html, array(
			'email_heading' => $this->get_heading(),
			'user_login'    => $this->user_login,
			'reset_key'     => $this->reset_key,
			'blogname'      => $this->get_blogname(),
			'sent_to_admin' => false,
			'plain_text'    => false,
			'email'			=> $this,
		) );
	}

	/**
	 * Get content plain.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_plain() {
		return wc_get_template_html( $this->template_plain, array(
			'email_heading' => $this->get_heading(),
			'user_login'    => $this->user_login,
			'reset_key'     => $this->reset_key,
			'blogname'      => $this->get_blogname(),
			'sent_to_admin' => false,
			'plain_text'    => true,
			'email'			=> $this,
		) );
	}
        
        /**
	 * Get customize register 
	 *
	 * @access public
	 * @return string
	 */
        public function customize_register($wp_customize) {
            
            $wp_customize->add_setting('kt_woomail[' . $setting_key . ']' , array(
                'type'          => 'option',
                'transport'     => isset( $setting['transport'] ) ? $setting['transport'] : 'postMessage',
                'capability'    => Kadence_Woomail_Designer::get_admin_capability(),
                'default'       => isset( $setting['default'] ) ? $setting['default'] : '',
                'sanitize_callback' => isset( $settings['sanitize_callback'] ) ? array(
						'WP_Customize_' . $setting['control_type'] . 'Control',
						$settings['sanitize_callback']
						) : '',
            ));
    
        }
}

endif;

return new WC_Email_Customer_Registration_Approved_Pro();
