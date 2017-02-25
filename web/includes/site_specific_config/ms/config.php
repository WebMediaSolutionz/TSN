<?php
	defined( 'SITE_NAME' ) ? null : define( 'SITE_NAME', 'Mama Sita' );
	defined( 'DEFAULT_THEME' ) ? null : define( 'DEFAULT_THEME', 'ms' );
	defined( 'PROFILE_USER' ) ? null : define( 'PROFILE_USER', 108 );
	defined( 'AUTHENTICATION_REQUIRED' ) ? null : define( 'AUTHENTICATION_REQUIRED', false );

	$page_title = SITE_NAME;

	require_once( "{$environment}_config.php" );
?>