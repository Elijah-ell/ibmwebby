<?php
global $tc;

$tc->remove_order_session_data_only(); //remove tc_order from session

$cart_contents = $tc->get_cart_cookie();

$tc_general_settings = get_option( 'tc_general_setting', false );

if ( isset( $tc_general_settings[ 'force_login' ] ) && $tc_general_settings[ 'force_login' ] == 'yes' && !is_user_logged_in() ) {
	?>
	<div class="force_login_message"><?php printf( __( 'Please %s to see this page', 'tc' ), '<a href="' . apply_filters( 'tc_force_login_url', wp_login_url( $tc->get_payment_slug( true ) ), $tc->get_payment_slug( true ) ) . '">' . __( 'Log In', 'tc' ) . '</a>' ); ?></div>
	<?php
} else {
	if ( empty( $cart_contents ) ) {
		@wp_redirect( $tc->get_cart_slug( true ) );
		tc_js_redirect( $tc->get_cart_slug( true ) );
		exit;
	}
	$tc->cart_payment( true );
}

$_SESSION[ 'tc_gateway_error' ] = '';
?>
