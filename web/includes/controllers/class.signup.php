<?php
	class SignupCtrl extends ActionCtrl {
		public static function load () {
			global $session, $page_title, $lang;

			if ( $session->is_logged_in() ) {
				redirect_to( 'home.php' );
			}

			$theme = static::$theme;
			
			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			if ( defined( 'PROFILE_USER' ) ) {
				$profile_user = User::find_by_id( PROFILE_USER );
			}

			$error_message = "";

			if ( isset( $_POST[ 'submit' ] ) ) {
				$first_name = trim( $_POST[ 'firstname' ] );
				$last_name = trim( $_POST[ 'lastname' ] );
				$username = trim( $_POST[ 'username' ] );
				$sex = trim( $_POST[ 'sex' ] );
				$birthdate = trim( $_POST[ 'birthdate' ] );
				$password = trim( $_POST[ 'password' ] );

				$user = new User;

				$user->name = $first_name;
				$user->lastname = $last_name;
				$user->username = $username;
				$user->sex = $sex;
				$user->birthdate = $birthdate;
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
				$sex = "";
				$birthdate = "";
				$password = "";

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