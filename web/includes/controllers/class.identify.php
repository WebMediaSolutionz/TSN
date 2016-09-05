<?php
	class IdentifyCtrl extends ActionCtrl {
		public static function load () {
			global $session, $page_title, $lang;

			if ( $session->is_logged_in() ) {
				redirect_to( 'home.php' );
			}

			$theme = static::$theme;

			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			$error_message = "";

			if ( isset( $_POST[ 'submit' ] ) ) {
				$username = trim( $_POST[ 'username' ] );

				$user = User::identify( $username );

				if ( $user ) {
					$user->generate_verification_key();
					$user->save();

					$email_subject = $lang[ 'reset password subject' ];
					$email_message = str_replace( '{{verification_key}}', $user->verification_key, $lang[ 'reset your password' ]);
					$message = $lang[ 'sign up message' ];

					Utils::sendmail( $user, $email_subject, $email_message );
				} else {
					$error_message = "there was a problem finding your account";
				}

			} else {
				$username = "";

				$error_message = "";
			}

			include_once( static::load_template() );
		}

		public static function check_session () {
			global $session;

			if ( $session->is_logged_in() ) {
				static::$authentication = "authenticated";

				redirect_to( 'index.php' );
			}

			static::$authentication = "unauthenticated";
		}
	}
?>