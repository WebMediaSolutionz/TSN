<?php

	$site_code = null;
	$environment = null;
	$current_page = null;

	set_environment();

	$current_lang = ( isset( $_GET[ 'lang' ] ) ) ? $_GET[ 'lang' ] : 'en';	

	require_once( "site_specific_config/{$site_code}/config.php" );

	defined( 'PARENT_COMPANY' ) ? null : define( 'PARENT_COMPANY', 'Web Media Solutionz' );
	defined( 'PARENT_COMPANY_WEBSITE' ) ? null : define( 'PARENT_COMPANY_WEBSITE', 'http://www.webmediasolutionz.com' );
	defined( 'USER_PERSONAL_SPACE' ) ? null : define( 'USER_PERSONAL_SPACE', 'UPS/*id*' );

	defined( 'USER_PERSONAL_SPACE_PICTURES' ) ? null : define( 'USER_PERSONAL_SPACE_PICTURES', USER_PERSONAL_SPACE . '/pictures' );
	defined( 'USER_PERSONAL_SPACE_VIDEOS' ) ? null : define( 'USER_PERSONAL_SPACE_VIDEOS', USER_PERSONAL_SPACE . '/videos' );
	defined( 'USER_PERSONAL_SPACE_TRACKS' ) ? null : define( 'USER_PERSONAL_SPACE_TRACKS', USER_PERSONAL_SPACE . '/tracks' );

	defined( 'IMG_MAX_UPLOAD_SIZE' ) ? null : define( 'IMG_MAX_UPLOAD_SIZE', 1000000 );	
?>