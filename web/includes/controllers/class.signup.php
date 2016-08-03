<?php
	class SignupCtrl extends ActionCtrl {
		public static function load () {
			global $session, $page_title, $lang;

			$theme = static::$theme;

			$error_message = "";

			if ( isset( $_POST[ 'submit' ] ) ) {
				$first_name = trim( $_POST[ 'name' ] );;
				$last_name = trim( $_POST[ 'lastname' ] );
				$username = trim( $_POST[ 'username' ] );
				$password = trim( $_POST[ 'password' ] );

				$user = new User;

				$user->name = $first_name;
				$user->lastname = $last_name;
				$user->username = $username;
				$user->password = $password;
				$user->generate_verification_key();

				if ( $user->save() ) {
					$email_subject = $lang[ 'sign up email subject' ];
					$email_message = str_replace( '{{verification_key}}', $user->verification_key, $lang[ 'sign up email message' ]);
					$message = $lang[ 'sign up message' ];

					Utils::sendmail( $user, $email_subject, $email_message );

					Utils::redirect_to( 'login.php?status=success' );
				} else {
					$error_message = "there was a problem creating your account";
				}

			} else {
				$first_name = "";
				$last_name = "";
				$username = "";
				$password = "";

				$error_message = "";
			}

			include_once( "views/" . static::$theme . "/" . static::$template );
		}

		public static function check_session () {
			global $session;

			if ( $session->is_logged_in() ) {
				redirect_to( 'index.php' );
			}
		}
	}
?>