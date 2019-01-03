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

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<tr>
    <td align="center" height="100%" valign="top" width="100%" bgcolor="#F2F5F7" style="padding:0 15px 20px" class="m_4412137695263643084mobile-padding">
      
      <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse!important;max-width:600px">
        <tbody><tr>
          <td align="center" valign="top" style="font-family:Open Sans,Helvetica,Arial,sans-serif;padding:0 0 25px">
            <table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse!important">
              <tbody><tr>
                <td align="center" bgcolor="#ffffff" style="border-radius:0 0 10px 10px;padding:25px">
                <?php echo svg_valid_email(); ?>
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
                              <a href="<?php echo get_site_url(); ?>'" style="background: #613143;border: 1px solid #613143;border-radius: 14px;color:#ffffff;display:block;font-family:Open Sans,Helvetica,Arial,sans-serif;font-size:16px;padding:14px 26px;text-decoration:none" target="_blank" data-saferedirecturl="">サイトに移動</a>
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
        </tr>

<p></p>

<?php do_action( 'woocommerce_email_footer', $email ); ?>
