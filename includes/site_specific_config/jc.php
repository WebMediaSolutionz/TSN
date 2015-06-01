<?php
	defined( 'SITE_NAME' ) ? null : define( 'SITE_NAME', 'Jane Chocka' );
	defined( 'PROFILE_USER' ) ? null : define( 'PROFILE_USER', 71 );

	$page_title = SITE_NAME;

	switch ( $environment ) {
		case 'dev':		defined( 'DB_DOMAIN' ) 		? null : define( 'DB_DOMAIN', 	'localhost' );
						defined( 'DB_USERNAME' ) 	? null : define( 'DB_USERNAME', 'mckenzy2' ); 
						defined( 'DB_PASSWORD' ) 	? null : define( 'DB_PASSWORD', 'LTZwwZvB6u9d75eP' ); 
						defined( 'DB_DATABASE' ) 	? null : define( 'DB_DATABASE', 'webmedj6_social_network' ); 
						defined( 'SITE_EMAIL' ) 	? null : define( 'SITE_EMAIL', 'info@webmediasolutionz.com' ); 
						defined( 'SUPPORT_EMAIL' ) 	? null : define( 'SUPPORT_EMAIL', 'support@webmediasolutionz.com' ); 

						defined( 'MAIL_SERVER' ) 	? null : define( 'MAIL_SERVER', 'mail.webmediasolutionz.com' ); 
						defined( 'MAIL_PORT' ) 		? null : define( 'MAIL_PORT', '26' ); 
						defined( 'MAIL_USERNAME' ) 	? null : define( 'MAIL_USERNAME', 'info@webmediasolutionz.com' ); 
						defined( 'MAIL_PASSWORD' ) 	? null : define( 'MAIL_PASSWORD', 'i&p{8S%VI&P}' ); 

						defined( 'DOMAIN' ) 		? null : define( 'DOMAIN', 	'localhost/~mpierre1/thesocialnetwork/public' );
						break;

		case 'staging':	defined( 'DB_DOMAIN' ) 		? null : define( 'DB_DOMAIN', 	'localhost' );
						defined( 'DB_USERNAME' ) 	? null : define( 'DB_USERNAME', 'webmedj6_tsn' ); 
						defined( 'DB_PASSWORD' ) 	? null : define( 'DB_PASSWORD', 'zWkwMIutlO;$' ); 
						defined( 'DB_DATABASE' ) 	? null : define( 'DB_DATABASE', 'webmedj6_social_network' ); 
						defined( 'SITE_EMAIL' ) 	? null : define( 'SITE_EMAIL', 'info@webmediasolutionz.com' ); 
						defined( 'SUPPORT_EMAIL' ) 	? null : define( 'SUPPORT_EMAIL', 'support@webmediasolutionz.com' ); 

						defined( 'MAIL_SERVER' ) 	? null : define( 'MAIL_SERVER', 'mail.webmediasolutionz.com' ); 
						defined( 'MAIL_PORT' ) 		? null : define( 'MAIL_PORT', '26' ); 
						defined( 'MAIL_USERNAME' ) 	? null : define( 'MAIL_USERNAME', 'info@webmediasolutionz.com' ); 
						defined( 'MAIL_PASSWORD' ) 	? null : define( 'MAIL_PASSWORD', 'i&p{8S%VI&P}' ); 

						defined( 'DOMAIN' ) 		? null : define( 'DOMAIN', 	$current_url );
						break;

		case 'live':	defined( 'DB_DOMAIN' ) 		? null : define( 'DB_DOMAIN', 	'localhost' );
						defined( 'DB_USERNAME' ) 	? null : define( 'DB_USERNAME', 'webmedj6_social' ); 
						defined( 'DB_PASSWORD' ) 	? null : define( 'DB_PASSWORD', 'M~&)4@2GE19-' ); 
						defined( 'DB_DATABASE' ) 	? null : define( 'DB_DATABASE', 'webmedj6_social_network' ); 
						defined( 'SITE_EMAIL' ) 	? null : define( 'SITE_EMAIL', 'info@webmediasolutionz.com' ); 
						defined( 'SUPPORT_EMAIL' ) 	? null : define( 'SUPPORT_EMAIL', 'support@webmediasolutionz.com' ); 
						
						defined( 'MAIL_SERVER' ) 	? null : define( 'MAIL_SERVER', 'mail.webmediasolutionz.com' ); 
						defined( 'MAIL_PORT' ) 		? null : define( 'MAIL_PORT', '26' ); 
						defined( 'MAIL_USERNAME' ) 	? null : define( 'MAIL_USERNAME', 'info@webmediasolutionz.com' ); 
						defined( 'MAIL_PASSWORD' ) 	? null : define( 'MAIL_PASSWORD', 'i&p{8S%VI&P}' ); 

						defined( 'DOMAIN' ) 		? null : define( 'DOMAIN', 	$current_url  );
						break;
	}
?>