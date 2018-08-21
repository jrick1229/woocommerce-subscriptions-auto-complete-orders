<?php
/**
 * Plugin Name: WooCommerce Subscriptions - Auto-Complete Orders
 * Plugin URI:  https://github.com/Prospress/woocommerce-subscriptions-auto-complete-orders
 * Description: Auto-completes all orders after successful payment - even subscription renewals.
 * Author:      Prospress Inc.
 * Author URI:  http://prospress.com/
 * Version:     1.1.0
 * License:     GPLv3
 *
 * GitHub Plugin URI: Prospress/woocommerce-subscriptions-auto-complete-orders
 * GitHub Branch: master
 *
 * Copyright 2018 Prospress, Inc.  (email : freedoms@prospress.com)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package WooCommerce Subscriptions
 * @author  Prospress Inc.
 * @since   1.0.0
 */

/**
* Autocomplete subscription 'parent' and 'renewal' orders
*/

add_filter( 'woocommerce_payment_complete_order_status', 'wcs_aco_return_completed', 10, 3);
/**
 * Return "completed" as an order status.
 *
 * This should be attached to the woocommerce_payment_complete_order_status hook.
 *
 * @since 1.1.0
 *
 * @param string $status The current default status.
 * @param object $order The current order.
 * @param int $order_id The current order ID.
 * @return string The filtered default status.
 */
function wcs_aco_return_completed( $status, $order, $order_id ) {

    if( wcs_order_contains_subscription($order, array('parent','renewal') ) ) {
        return 'completed';
    }

    return $status;
}

/**
* Autocomplete 'simple' orders
*/

add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
/**
 * Updates the status of a correctly processed order to 'Complete'
 *
 * @param int $order_id The current order ID.
 */
function custom_woocommerce_auto_complete_order( $order_id ) { 
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}
