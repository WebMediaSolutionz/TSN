<?php
	class ResetCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination;

			$theme = static::$theme;

			$error_message = "";
			$user = null;

			if ( isset( $_GET[ 'verification_key' ] ) ) {
				$user = User::verify_user( $_GET[ 'verification_key' ] );
			} else if ( isset( $_POST[ 'submit' ] ) && isset( $_POST[ 'user_id' ] ) && isset( $_POST[ 'password' ] ) ) {
				User::update_password( $_POST[ 'user_id' ], $_POST[ 'password' ] );

				Utils::redirect_to( 'login.php?status=reset' );
			} else {
				$error_message = "error";
			}

			if ( $user === null ) {
				Utils::redirect_to( 'login.php' );
			}

			include_once( "views/" . static::$theme . "/" . static::$template );
		}

		public static function check_session () {
			global $session;

			if ( $session->is_logged_in() ) {
				redirect_to( 'home.php' );
			}
		}

		public static function logout () {
			global $session;

			$session->logout();
			redirect_to( 'login.php' );
		}
	}
?>