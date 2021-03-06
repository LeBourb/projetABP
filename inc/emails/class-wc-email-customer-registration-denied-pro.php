<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email_Customer_Registration_Denied_Pro', false ) ) :

/**
 * Customer Reset Password.
 *
 * An email sent to the customer when they reset their password.
 *
 * @class       WC_Email_Customer_Registration_Denied_Pro
 * @version     2.3.0
 * @package     WooCommerce/Classes/Emails
 * @author      WooThemes
 * @extends     WC_Email
 */
class WC_Email_Customer_Registration_Denied_Pro extends WC_Email {

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
	 * Site url.
	 *
	 * @var string
	 */
        public $site_url;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id               = 'customer_registration_denied_pro';
		$this->customer_email   = true;

		$this->title            = __( 'Registration denied', 'woocommerce' );
		$this->description      = __( 'Customer pro registration has been denied.', 'woocommerce' );

		$this->template_html    = 'emails/customer-registration-denied-pro.php';
		$this->template_plain   = 'emails/plain/customer-registration-denied-pro.php';

		// Trigger
		add_action( 'woocommerce_registration_denied_pro_notification', array( $this, 'trigger' ), 10, 2 );

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
	 * @param string $user_login
	 * @param string $reset_key
	 */
	public function trigger( $user_login = '' ) {
		$this->setup_locale();

		if ( $user_login ) {
			$this->object     = get_user_by( 'login', $user_login );
			$this->user_login = $user_login;
			$this->user_email = stripslashes( $this->object->user_email );
			$this->recipient  = $this->user_email;
                        $this->site_url = $site_url;
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
}

endif;

return new WC_Email_Customer_Registration_Denied_Pro();
