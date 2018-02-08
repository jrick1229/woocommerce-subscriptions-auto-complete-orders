<?php
/**
* Plugin Name: WooCommerce Subscriptions - Auto-Complete Orders
* Plugin URI: https://github.com/Prospress/woocommerce-subscriptions-order-complete-orders
* Description: Auto completes orders upon subscription creation and upon payment confirmation on renewal orders.
* Author: Prospress Inc.
* Author URI: http://prospress.com/
* Version: 1.0
* License: GPLv3
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
* @package		WooCommerce Subscriptions
* @author		Prospress Inc.
* @since		1.0
*/

add_action( 'woocommerce_thankyou', 'woocommerce_subscriptions_auto_complete_order' );
add_action( 'woocommerce_payment_complete', 'woocommerce_subscriptions_auto_complete_order' );
function woocommerce_subscriptions_auto_complete_order( $order_id ) { 
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}
