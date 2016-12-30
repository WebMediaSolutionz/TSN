<?php
	class ThanksCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page;

			$theme = static::$theme;

			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			$customer = static::process_payment();

			include_once( static::load_template() );
		}

		public static function process_payment () {
			global $lang;

			\Stripe\Stripe::setApiKey( STRIPE_SECRET_KEY );

			if ( isset( $_POST[ 'stripeToken' ] ) ) {
				$token = $_POST[ 'stripeToken' ];

				try {
					// \Stripe\Plan::create( array (
					// 	"amount" 	=> 	2000,
					// 	"interval" 	=> 	"month",
					// 	"name" 		=> 	"Amazing Gold Plan",
					// 	"currency" 	=> 	"cad",
					// 	"id" 		=> 	"gold")
					// );

					// creating the customer
					$customer = \Stripe\Customer::create( array (
						"source" 	=> 	$token,
						"plan" 		=> 	$_POST[ 'plan' ],
						"email" 	=> 	$_POST[ 'username' ] )
					);

					$first_name = trim( $_POST[ 'firstname' ] );
					$last_name = trim( $_POST[ 'lastname' ] );
					$username = trim( $_POST[ 'username' ] );
					$password = trim( $_POST[ 'password' ] );

					$user = new User;

					$user->name = $first_name;
					$user->lastname = $last_name;
					$user->birthdate = Utils::mysql_datetime();
					$user->username = $username;
					$user->password = $password;
					$user->verified = 1;
					

					if ( $user->save() ) {
						$email_subject = $lang[ 'sign up email subject' ];
						$email_message = str_replace( '{{verification_key}}', $user->verification_key, $lang[ 'sign up email message' ]);
						$message = $lang[ 'sign up message' ];

						// Utils::sendmail( $user, $email_subject, $email_message );

						// Utils::redirect_to( 'login.php?status=success' );
					}

					return $customer;

					// \Stripe\Charge::create( array(
					// 	"amount" => 2000,
					// 	"currency" => "cad",
					// 	"card" => $token,
					// 	"description" => "charge this guy" // new subscriber's email
					// ));

					// create new user, everything is good. activate the user
				} catch ( Stripe_CardError $e ) {
					// Do something with the error here. redirect to error page, payment didn't go through
				}
			}
		}
	}
?>