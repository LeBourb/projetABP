<?php
/**
 * Customer Reset Password email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-registration-approved.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); 

?>    
   <tr>
    <td align="center" height="100%" valign="top" width="100%" bgcolor="#F2F5F7" style="padding:0 15px 20px" class="m_4412137695263643084mobile-padding">
      
      <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse!important;max-width:600px">
        <tbody><tr>
          <td align="center" valign="top" style="font-weight: 100;font-size: 18px;">
            <table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse!important">
              <tbody><tr>
                <td align="center" bgcolor="#ffffff" style="border-radius:0 0 10px 10px;padding:25px">
                <?php echo svg_spinner_email(); ?>
                  <table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse!important">
                    <tbody><tr>
                      
                    </tr>
                    <tr>
                      <td align="center" style="">                        
                        <?php 
                            /*$email_body = Kadence_Woomail_Customizer::opt( $key . '_body' );
                            if ( ! empty( $email_body ) ) {
                                $email_body = Kadence_Woomail_Designer::filter_subtitle( $email_body, $email );                                
                            }
                            echo 'body: ' . $email_body;
                             * 
                             */
                        ?>
                        <p style="">
                            atelier Bourgeons （アトリエブルジョン）への会員登録にお申し込みいただき、誠にありがとうございます。下記のURLをクリックして、登録を完了してください。
                  </p><p>会員登録認証用URL:
                      <a href="<?php echo $activation_url; ?>"><?php echo $activation_url ?></a>
             </p>
                      </td>
                    </tr>                    
                  </tbody></table>
                </td>
              </tr>
              
                <tr>
                    <td align="left" style="padding:20px 0 15px">
                        <p>※URLのクリックにて登録認証されるまではお手続きが完了しませんので、ご注意ください。
<p>※本メールに関してお心当たりがない場合、または何かご不明な点がございましたら、恐れ入りますがその旨をご記入のうえ<a href="mailto:contact@atelierbourgeons.com">contact@atelierbourgeons.com</a>までお問い合わせください。</p>
<p>※本メールは、会員登録申請の際にご入力いただいたメールアドレスへ自動送信しています。</p>
                    </td>
                </tr>
            </tbody></table>
          </td>
        </tr>
<p></p>

<?php 
    
    do_action( 'woocommerce_email_footer', $email );
?>
