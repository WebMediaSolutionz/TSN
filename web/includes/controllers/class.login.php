<?php
	class LoginCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;

			$username = "";
			$password = "";
			$error_message = "";

			$theme = static::$theme;

			if ( isset( $_POST[ 'submit' ] ) ) {
				$username = trim( $_POST[ 'username' ] );
				$password = trim( $_POST[ 'password' ] );

				$found_user = User::authenticate( $username, $password );

				if ( $found_user ) {
					$session->login( $found_user );
					redirect_to( 'profile.php' );
				} else {
					$error_message = "Username/password combination incorrect.";
				}
			} else if ( isset( $_GET[ 'status' ] ) ) {
				if ( $_GET[ 'status' ] == 'success' ) {
					$confirmation = $lang[ 'sign up message' ];
				} else if ( $_GET[ 'status' ] == 'activated' ) {
					$confirmation = $lang[ 'activated message' ];
				} else if ( $_GET[ 'status' ] == 'unactivated' ) {
					$error_message = "...";
				}
			}

			include_once( "views/" . static::$theme . "/" . static::$template );
		}

		public static function check_session () {
			global $session;

			if ( $session->is_logged_in() ) {
				redirect_to( 'profile.php' );
			}
		}

		public static function logout () {
			global $session;

			$session->logout();
			redirect_to( 'login.php' );
		}
	}
?>