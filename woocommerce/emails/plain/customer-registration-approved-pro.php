<?php
/**
 * Customer Reset Password email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/plain/customer-registration-approved.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates/Emails/Plain
 * @version 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

echo "= " . $email_heading . " =\n\n";

echo __( 'atelier Bourgeons （アトリエブルジョン）の ビジネス会員登録にお申し込みいただき、誠にありがとうございます。 会員の登録認証が完了しましたので、お知らせいたします。ログイン後、ビジネス会員様のみに公開される卸価格にて商品をご購入いただけます。', 'woocommerce' ) . "\r\n\r\n";
echo esc_url( network_home_url( '/' ) ) . "\r\n\r\n";
echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";
echo '※本メールに関してお心当たりがない場合、または何かご不明点がございましたら、恐れ入りますがその旨をご記入のうえ contact@atelierbourgeons.com までお問い合わせください。';
echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );
