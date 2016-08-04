<?php

	$site_code = null;
	$environment = null;
	$current_page = null;
	$baseurl = null;

	set_environment();

	$current_lang = ( isset( $_GET[ 'lang' ] ) ) ? $_GET[ 'lang' ] : 'en';	

	require_once( "site_specific_config/{$site_code}/config.php" );

	defined( 'PARENT_COMPANY' ) ? null : define( 'PARENT_COMPANY', 'Web Media Solutionz' );
	defined( 'PARENT_COMPANY_WEBSITE' ) ? null : define( 'PARENT_COMPANY_WEBSITE', 'http://www.webmediasolutionz.com' );

	defined( 'DEFAULT_THEME' ) ? null : define( 'DEFAULT_THEME', 'sampler' );
?>