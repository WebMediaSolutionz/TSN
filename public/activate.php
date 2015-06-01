<?php

	require_once('../includes/initialize.php');

	$message = "";

	if ( isset( $_GET[ 'verification_key' ] ) ) {
		if ( User::activate( $_GET[ 'verification_key' ] ) ) {
			Utils::redirect_to( 'login.php?status=activated' );
		} else {
			Utils::redirect_to( 'login.php?status=unactivated' );
		}
	} else {
		Utils::redirect_to( 'login.php?status=unactivated' );
	}
?>