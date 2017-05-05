<?php
	class LoginCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;

			if ( $session->is_logged_in() ) {
				redirect_to( 'home.php' );
			}

			$username = "";
			$password = "";
			$error_message = "";
			
			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			$theme = static::$theme;

			if ( defined( 'PROFILE_USER' ) ) {
				$profile_user = User::find_by_id( PROFILE_USER );
			}

			if ( isset( $session->user_id ) ) {
				$current_user = User::find_verified_by_id( $session->user_id );
			}

			if ( isset( $_POST[ 'submit' ] ) ) {
				$username = trim( $_POST[ 'username' ] );
				$password = trim( $_POST[ 'password' ] );

				$found_user = User::authenticate( $username, $password );

				// TODO: tighten this up to display nicer message if membership has expired, check if it's a paying website, should create flag for that
				if ( $found_user && Utils::within_last_24_hours( $found_user->membership_end_date ) ) {
					$session->login( $found_user );
					redirect_to( 'home.php' );
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

			include_once( static::load_template() );
		}

		public static function logout () {
			global $session;

			$session->logout();
			redirect_to( 'login.php' );
		}

		public static function delete_account () {
			global $session, $DB;

			$current_user = User::find_by_id( $session->user_id );
			$current_user->delete_account();
		}
	}
?>