<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email_Customer_Registration_New_User_Checking', false ) ) :

/**
 * Customer Reset Password.
 *
 * An email sent to the customer when they reset their password.
 *
 * @class       WC_Email_Customer_Registration_New_User_Checking
 * @version     2.3.0
 * @package     WooCommerce/Classes/Emails
 * @author      WooThemes
 * @extends     WC_Email
 */
class WC_Email_Customer_Registration_New_User_Checking extends WC_Email {

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
	 * Activation Url.
	 *
	 * @var string
	 */
        public $activation_url;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id               = 'customer_registration_new_user_checking';
		$this->customer_email   = true;

		$this->title            = __( 'Registration approved', 'woocommerce' );
		$this->description      = __( 'Customer "reset password" emails are sent when customers reset their passwords.', 'woocommerce' );

		$this->template_html    = 'emails/customer-registration-new-user-checking.php';
		$this->template_plain   = 'emails/plain/customer-registration-new-user-checking.php';

		// Trigger
		add_action( 'woocommerce_registration_new_user_checking_notification', array( $this, 'trigger' ), 10, 1 );

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
		return __( '【会員認証の完了までしばらくお待ちください】/atelier Bourgeons （ｱﾄﾘｴﾌﾞﾙｼﾞｮﾝ）', 'woocommerce' );
	}

	/**
	 * Get email heading.
	 *
	 * @since  3.1.0
	 * @return string
	 */
	public function get_default_heading() {
		return __( '会員登録のお申し込みありがとうございます！<br>登録完了まであと少しです。', 'woocommerce' );
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
                        $code = sha1( $this->object->ID . time() ); 
                        global $wpdb;
                        $wpdb->update( $wpdb->users, array( 'user_activation_key' => $code ), array( 'ID' => $this->object->ID ) );
                        //$blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
                        $this->activation_url = add_query_arg( array( 'action' => 'confirm-email', 'key' => $code, 'user' => $this->object->ID), wp_login_url() );
                        
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
			'activation_url' => $this->activation_url,
			'blogname'      => $this->get_blogname(),
			'sent_to_admin' => false,
			'plain_text'    => false,
			'email'         => $this,
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
			'activation_url' => $this->activation_url,
			'blogname'      => $this->get_blogname(),
			'sent_to_admin' => false,
			'plain_text'    => true,
			'email'			=> $this,
		) );
	}
        
        /*
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
    }*/
}

endif;

return new WC_Email_Customer_Registration_New_User_Checking();
