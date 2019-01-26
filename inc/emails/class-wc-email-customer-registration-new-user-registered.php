<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email_Customer_Registration_New_User_Registered', false ) ) :

/**
 * Customer Reset Password.
 *
 * An email sent to the customer when they reset their password.
 *
 * @class       WC_Email_Customer_Registration_New_User_Registered
 * @version     2.3.0
 * @package     WooCommerce/Classes/Emails
 * @author      WooThemes
 * @extends     WC_Email
 */
class WC_Email_Customer_Registration_New_User_Registered extends WC_Email {

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
	 * Constructor.
	 */
	public function __construct() {

		$this->id               = 'customer_registration_new_user_registered';
		$this->customer_email   = true;

		$this->title            = __( 'Registration approved', 'woocommerce' );
		$this->description      = __( 'Customer "reset password" emails are sent when customers reset their passwords.', 'woocommerce' );

		$this->template_html    = 'emails/customer-registration-new-user-registered.php';
		$this->template_plain   = 'emails/plain/customer-registration-new-user-registered.php';
                
                $this->setting = array( 'live_method'   => 'replace',
                                        'selectors'     => array(
                                                '#body_checking .more'
                                        ),
                                        'active_callback' => array(
                                                'Kadence_Woomail_Customizer',
                                                'active_woo_callback'
                ));

		// Trigger
		add_action( 'woocommerce_registration_new_user_registered_notification', array( $this, 'trigger' ), 10, 1 );
                add_action( 'customize_register', array( $this, 'customize') );
                add_action( 'wp_footer', array( $this, 'print_live_preview_scripts' ), 999 );
                
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
		return __( 'ビジネス会員登録へのお申し込み<br>ありがとうございます', 'woocommerce' );
	}

	/**
	 * Trigger.
	 *
	 * @param string $user_id
	 * @param string $reset_key
	 */
	public function trigger( $user_id = '' ) {
		$this->setup_locale();

		if ( $user_id ) {
                        $user_info = get_userdata($user_id);
			$this->object     = get_user_by( 'ID', $user_id );
                        $this->user_login = $user_info->data->user_login;
			$this->user_email = stripslashes( $this->object->user_email );
			$this->recipient  = get_option( 'admin_email' );
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
			'blogname'      => $this->get_blogname(),
			'sent_to_admin' => false,
			'plain_text'    => true,
			'email'			=> $this,
		) );
	}
        
        public function customize($wp_customize) {
            $wp_customize->add_setting( $this->id . '_more', array(
                'default'        => 'Default Text For Footer Section',
            ));
            $wp_customize->add_control( $this->id .'_more', array(
                'label'         => __('More Info Text', 'kadence-woocommerce-email-designer'),
                'type'          => 'textarea',
                'section'       => 'kt_woomail_mtype',
                'settings'    	=> $this->id . '_more',
                'transport' =>   'postMessage',
                //'capability'    	=> Kadence_Woomail_Designer::get_admin_capability(),
                'priority'   => 10,
                'default'       => '',
                'original'      => ''                
            ));   
            
     
        }
        
        public function print_live_preview_scripts(){
            
            $setting = $this->setting;
            
            // No live method
            if ( ! isset( $setting['live_method'] ) ) {
            //        continue;
            }
            
            // Open container
			$scripts = '<script type="text/javascript" description="hello_test">'                                                                
                                . 'jQuery(document).ready(function() {';

            // Iterate over selectors
            if ( in_array( $setting['live_method'], array( 'css', 'property' ) ) && ! empty( $setting['selectors'] ) ) {
                    foreach ( $setting['selectors'] as $selector => $properties ) {

                            // Iterate over properties
                            foreach ( $properties as $property ) {

                                    // CSS value change
                                    if ( ! isset( $setting['live_method'] ) || $setting['live_method'] === 'css' ) {
                                            $scripts .= "wp.customize('$this->id', function(value) {
                                            value.bind(function(newval) {
                                            newval = newval + (typeof suffixes['$this->id'] !== 'undefined' ? suffixes['$this->id'] : '');
                                            newval = prepare(newval, '$this->id', '$selector');
                                            jQuery('$selector').css('$property', '').attr('style', function(i, s) { return (s||'') + '$property: ' + newval + ';' });
                                            });
                                            });";
                                    }

                                    // DOM object property
                                    if ( $setting['live_method'] === 'property' ) {
                                            $scripts .= "wp.customize('$this->id', function(value) {
                                            value.bind(function(newval) {
                                            newval = newval + (typeof suffixes['$this->id'] !== 'undefined' ? suffixes['$this->id'] : '');
                                            newval = prepare(newval, '$this->id', '$selector');
                                            jQuery('$selector').prop('$property', newval);
                                            });
                                            });";
                                    }
                            }
                    }
            }

            // HTML Replace
            if ( $setting['live_method'] === 'replace' && ! empty( $setting[ 'selectors' ] ) ) {
                    foreach ( $setting['selectors'] as $selector ) {
                            $original = ( ! empty( $setting['original'] ) ? json_encode( $setting['original'] ) : 'placeholder' );
                            $scripts .= 'wp.customize("' . $this->id . '_more", function(value) {
                            value.bind(function(newval) {
                            newval = (newval !== "" ? newval : $original);
                            newval = prepare(newval, "' . $this->id . '_more", "' . $selector . '");
                            jQuery("' . $selector . '").html(newval);
                            });
                            });';
                    }
            }
    

            // Close container and return
            echo $scripts . '});</script>';
        }
        
}

endif;

return new WC_Email_Customer_Registration_New_User_Registered();
