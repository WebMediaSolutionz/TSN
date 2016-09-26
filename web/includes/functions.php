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
		} elseif ( is_numeric ( strpos( $domain, "staging" ) ) || is_numeric( strpos( $domain, "webmediasolutionz.com" ) ) ) {
			$environment = "staging";
		} else {
			$environment = "live";
		}

		$url = $_SERVER[ 'PHP_SELF' ];

		if ( is_numeric ( strpos( $url, "thesocialnetwork" ) ) || is_numeric ( strpos( $url, "TSN2" ) ) ) {
			$site_code = 'tsn';
		} else if ( is_numeric ( strpos( $url, "MA" ) ) ) {
			$site_code = "ma";
		} else if ( is_numeric ( strpos( $url, "FP" ) ) || is_numeric ( strpos( $url, "fight_pass" ) ) ) {
			$site_code = "fp";
		} else if ( is_numeric ( strpos( $url, "janechoka" ) ) ) {
			$site_code = "jc";
		} else if ( is_numeric ( strpos( $url, "meimaza" ) ) ) {
			$site_code = "mm";
		} else if ( is_numeric ( strpos( $url, "karinevandal" ) ) ) {
			$site_code = "kv";
		} else if ( is_numeric ( strpos( $url, "kyleenash" ) ) || is_numeric ( strpos( $url, "KN" ) ) ) {
			$site_code = "kn";
		}

		$baseurl = $domain . $url;
		$baseurl = explode( '/', $baseurl );
		array_pop( $baseurl );
		$baseurl = implode( '/', $baseurl );
	}
?>