<?php

/*
  Plugin Name: Tickera - serial ticket codes
  Plugin URI: https://tickera.com/
  Description: Generate serial ticket codes
  Author: Tickera.com
  Author URI: https://tickera.com/
  Version: 1.0.1
  TextDomain: tc
  Domain Path: /languages/

  Copyright 2016 Tickera (https://tickera.com/)
 */

require_once(plugin_dir_path( __FILE__ ) . 'includes/classes/class.settings_serial_tickets.php');

add_filter( 'tc_settings_new_menus', 'tc_settings_new_menus_ticket_serial_code' );

function tc_settings_new_menus_ticket_serial_code( $settings_tabs ) {
	$settings_tabs[ 'tickera_ticket_serial_code' ] = __( 'Serial Tickets', 'tc' );
	return $settings_tabs;
}

add_action( 'tc_settings_menu_tickera_ticket_serial_code', 'tc_settings_menu_tickera_ticket_serial_code_show_page' );

function tc_settings_menu_tickera_ticket_serial_code_show_page() {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/admin-pages/settings-tickera_serial_ticket_codes.php' );
}

function tc_get_next_ticket_serial_code() {
	$tc_serial_tickets_setting = get_option( 'tc_serial_tickets_setting', false );

	$tc_custom_ticket_serial_next_number = isset( $tc_serial_tickets_setting[ 'tc_custom_ticket_serial_next_number' ] ) ? $tc_serial_tickets_setting[ 'tc_custom_ticket_serial_next_number' ] : '1';
	$tc_custom_ticket_serial_next_number = (int) $tc_custom_ticket_serial_next_number;

	$tc_custom_ticket_serial_prefix	 = isset( $tc_serial_tickets_setting[ 'tc_custom_ticket_serial_prefix' ] ) ? $tc_serial_tickets_setting[ 'tc_custom_ticket_serial_prefix' ] : '';
	$tc_custom_ticket_serial_sufix	 = isset( $tc_serial_tickets_setting[ 'tc_custom_ticket_serial_sufix' ] ) ? $tc_serial_tickets_setting[ 'tc_custom_ticket_serial_sufix' ] : '';

	$tc_custom_ticket_serial_code_length = isset( $tc_serial_tickets_setting[ 'tc_custom_ticket_serial_code_length' ] ) ? $tc_serial_tickets_setting[ 'tc_custom_ticket_serial_code_length' ] : 10;
	$tc_custom_ticket_serial_pad_string	 = isset( $tc_serial_tickets_setting[ 'tc_custom_ticket_serial_pad_string' ] ) ? $tc_serial_tickets_setting[ 'tc_custom_ticket_serial_pad_string' ] : '0';

	$next_ticket_code	 = str_pad( (string) $tc_custom_ticket_serial_next_number, (int) $tc_custom_ticket_serial_code_length, $tc_custom_ticket_serial_pad_string, STR_PAD_LEFT );
	$next_ticket_code	 = $tc_custom_ticket_serial_prefix . $next_ticket_code . $tc_custom_ticket_serial_sufix;

	$tc_serial_tickets_setting[ 'tc_custom_ticket_serial_next_number' ] = ($tc_custom_ticket_serial_next_number + 1);
	update_option( 'tc_serial_tickets_setting', $tc_serial_tickets_setting );

	return $next_ticket_code;
}

add_filter( 'tc_ticket_code', 'tc_get_next_ticket_serial_code' );

//Addon updater 
if ( function_exists( 'tc_plugin_updater' ) ) {
	tc_plugin_updater( 'serial-ticket-codes', __FILE__ );
}
