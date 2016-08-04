<?php

	function __autoload ( $class_name ) {
		$class_name = strtolower( $class_name );
		$file_found = false;

		$possible_paths = array(
			"../includes/{$class_name}.php",
			"../includes/class.{$class_name}.php",
			"../includes/model/{$class_name}.php",
			"../includes/model/class.{$class_name}.php"
		);

		foreach ( $possible_paths as $path ) {
			if ( file_exists( $path ) ) {
				require_once( $path );
				$file_found = true;
			} 
		}

		if ( !$file_found ) {
			die( "The file {$class_name}.php could not be found." );
		}
	}

	function redirect_to ( $location ) {
		header("Location: {$location}");
		exit;
	}

	function sendmail ( $to, $subject, $message) {
		$headers = "From: " . SITE_EMAIL . "\n";
		$headers .= "Reply-To: " . SITE_EMAIL . "\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-Type: text/html; charset=iso-8859-1\n";

		return mail( $to, $subject, $message, $headers);
	}

	function set_environment () {
		global $site_code, $environment, $baseurl;

		$domain = $_SERVER[ 'HTTP_HOST' ];				

		if ( is_numeric ( strpos( $domain, "localhost" ) ) ) {
			$environment = "dev";
		}

		$url = $_SERVER[ 'PHP_SELF' ];

		if ( is_numeric ( strpos( $url, "SAMPLER" ) ) ) {
			$site_code = "sampler";
		}

		$baseurl = $domain . $url;
		$baseurl = explode( '/', $baseurl );
		array_pop( $baseurl );
		$baseurl = implode( '/', $baseurl );
	}
?>