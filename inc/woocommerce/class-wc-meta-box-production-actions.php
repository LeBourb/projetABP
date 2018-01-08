<?php
/**
 * Production Actions
 *
 * Functions for displaying the production actions meta box.
 *
 * @author      WooThemes
 * @category    Admin
 * @package     WooCommerce/Admin/Meta Boxes
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * WC_Meta_Box_Production_Actions Class.
 */
class WC_Meta_Box_Production_Actions {

	/**
	 * Output the metabox.
	 *
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
		/*global $theproduction;

		// This is used by some callbacks attached to hooks such as woocommerce_production_actions which rely on the global to determine if actions should be displayed for certain productions.
		if ( ! is_object( $theproduction ) ) {
			$theproduction = wc_get_production( $post->ID );
		}*/

		$production_actions = apply_filters( 'woocommerce_production_actions', array(
			'send_production_details'              => __( 'Email production details to customer', 'woocommerce' ),
			'send_production_details_admin'        => __( 'Resend new production notification', 'woocommerce' ),
			'regenerate_download_permissions' => __( 'Regenerate download permissions', 'woocommerce' ),
		) );
		?>
		<ul class="production_actions submitbox">

			<?php do_action( 'woocommerce_production_actions_start', $post->ID ); ?>

			<li class="wide" id="actions">
				<select name="wc_production_action">
					<option value=""><?php _e( 'Choose an action...', 'woocommerce' ); ?></option>
					<?php foreach ( $production_actions as $action => $title ) { ?>
						<option value="<?php echo $action; ?>"><?php echo $title; ?></option>
					<?php } ?>
				</select>
				<button class="button wc-reload"><span><?php _e( 'Apply', 'woocommerce' ); ?></span></button>
			</li>

			<li class="wide">
				<div id="delete-action"><?php

					if ( current_user_can( 'delete_post', $post->ID ) ) {

						if ( ! EMPTY_TRASH_DAYS ) {
							$delete_text = __( 'Delete permanently', 'woocommerce' );
						} else {
							$delete_text = __( 'Move to trash', 'woocommerce' );
						}
						?><a class="submitdelete deletion" href="<?php echo esc_url( get_delete_post_link( $post->ID ) ); ?>"><?php echo $delete_text; ?></a><?php
					}
				?></div>

				<input type="submit" class="button save_production button-primary" name="save" value="<?php echo 'auto-draft' === $post->post_status ? esc_attr__( 'Create', 'woocommerce' ) : esc_attr__( 'Update', 'woocommerce' ); ?>" />
			</li>

			<?php do_action( 'woocommerce_production_actions_end', $post->ID ); ?>

		</ul>
		<?php
	}

	/**
	 * Save meta box data.
	 *
	 * @param int $post_id
	 * @param WP_Post $post
	 */
	public static function save( $post_id) {
		// Production data saved, now get it so we can manipulate status.
		$production = null;//wc_get_production( $post_id );
                return;
		// Handle button actions
		if ( ! empty( $_POST['wc_production_action'] ) && ($_POST['post_type'] == 'shop_production') ) {

			$action = wc_clean( $_POST['wc_production_action'] );

			if ( 'send_production_details' === $action ) {
				do_action( 'woocommerce_before_resend_production_emails', $production, 'customer_invoice' );

				// Send the customer invoice email.
				WC()->payment_gateways();
				WC()->shipping();
				WC()->mailer()->customer_invoice( $production );

				// Note the event.
				$production->add_production_note( __( 'Production details manually sent to customer.', 'woocommerce' ), false, true );

				do_action( 'woocommerce_after_resend_production_email', $production, 'customer_invoice' );

				// Change the post saved message.
				add_filter( 'redirect_post_location', array( __CLASS__, 'set_email_sent_message' ) );

			} elseif ( 'send_production_details_admin' === $action ) {

				do_action( 'woocommerce_before_resend_production_emails', $production, 'new_production' );

				WC()->payment_gateways();
				WC()->shipping();
				WC()->mailer()->emails['WC_Email_New_Production']->trigger( $production->get_id(), $production );

				do_action( 'woocommerce_after_resend_production_email', $production, 'new_production' );

				// Change the post saved message.
				add_filter( 'redirect_post_location', array( __CLASS__, 'set_email_sent_message' ) );

			} elseif ( 'regenerate_download_permissions' === $action ) {

				$data_store = WC_Data_Store::load( 'customer-download' );
				$data_store->delete_by_production_id( $post_id );
				wc_downloadable_product_permissions( $post_id, true );

			} else {

				if ( ! did_action( 'woocommerce_production_action_' . sanitize_title( $action ) ) ) {
					do_action( 'woocommerce_production_action_' . sanitize_title( $action ), $production );
				}
			}
		}
	}

	/**
	 * Set the correct message ID.
	 *
	 * @param string $location
	 *
	 * @since  2.3.0
	 *
	 * @static
	 *
	 * @return string
	 */
	public static function set_email_sent_message( $location ) {
		return add_query_arg( 'message', 11, $location );
	}
}
