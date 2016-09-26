<?php
	defined( 'SITE_NAME' ) ? null : define( 'SITE_NAME', 'Kylee Nash' );
	defined( 'DEFAULT_THEME' ) ? null : define( 'DEFAULT_THEME', 'kn' );
	defined( 'PROFILE_USER' ) ? null : define( 'PROFILE_USER', 89 );
	defined( 'AUTHENTICATION_REQUIRED' ) ? null : define( 'AUTHENTICATION_REQUIRED', false );

	$page_title = SITE_NAME;

	require_once( "{$environment}_config.php" );
?>