<?php
	class LoginCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;

			$username = "";
			$password = "";
			$error_message = "";
			
			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			$theme = static::$theme;

			if ( isset( $session->user_id ) ) {
				$current_user = User::find_verified_by_id( $session->user_id );
			}

			if ( isset( $_POST[ 'submit' ] ) ) {
				$username = trim( $_POST[ 'username' ] );
				$password = trim( $_POST[ 'password' ] );

				$found_user = User::authenticate( $username, $password );

				if ( $found_user ) {
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

		public static function delete_account () {
			global $session, $DB;

			$current_user = User::find_by_id( $session->user_id );
			$current_user->delete_account();
		}
	}
?>