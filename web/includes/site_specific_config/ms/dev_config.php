<?php
	defined( 'DB_DOMAIN' ) 		? null : define( 'DB_DOMAIN', 	'localhost' );
	defined( 'DB_USERNAME' ) 	? null : define( 'DB_USERNAME', 'root' ); 
	defined( 'DB_PASSWORD' ) 	? null : define( 'DB_PASSWORD', '' );
	defined( 'DB_DATABASE' ) 	? null : define( 'DB_DATABASE', 'TSN2' ); 

	defined( 'SITE_EMAIL' ) 	? null : define( 'SITE_EMAIL', 'info@webmediasolutionz.com' ); 
	defined( 'SUPPORT_EMAIL' ) 	? null : define( 'SUPPORT_EMAIL', 'support@webmediasolutionz.com' ); 

	defined( 'MAIL_SERVER' ) 	? null : define( 'MAIL_SERVER', 'mail.webmediasolutionz.com' ); 
	defined( 'MAIL_PORT' ) 		? null : define( 'MAIL_PORT', '26' ); 
	defined( 'MAIL_USERNAME' ) 	? null : define( 'MAIL_USERNAME', 'info@webmediasolutionz.com' ); 
	defined( 'MAIL_PASSWORD' ) 	? null : define( 'MAIL_PASSWORD', 'i&p{8S%VI&P}' ); 

	defined( 'DOMAIN' ) 		? null : define( 'DOMAIN', $baseurl );

	defined( 'STRIPE_SECRET_KEY' ) 	? null : define( 'STRIPE_SECRET_KEY', 'sk_test_mZ2l8KNk19ZdmsAgOUphYtSa' );
	defined( 'STRIPE_PUBLIC_KEY' ) 	? null : define( 'STRIPE_PUBLIC_KEY', 'pk_test_TG0gp4lQqTmiW1knsK07AA1t' );
?>