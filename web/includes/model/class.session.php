<?php
	class Session {
		private $logged_in = false;
		public $user_id;
		public $permission = 'subscriber';
		public $settings;

		function __construct() {
			session_start();
			$this->check_login();
		}

		private function check_login () {
			if ( isset( $_SESSION[ 'user_id' ] ) ) {
				$this->user_id = $_SESSION[ 'user_id' ];

				if ( defined( 'PROFILE_USER' ) ) {
					$this->permission = ( $this->user_id == PROFILE_USER ) ? 'performer' : 'subscriber';
				}
				
				$this->logged_in = true;
				$this->settings = Settings::get_settings_for( $this->user_id );
			} else {
				unset( $this->user_id );
				$this->logged_in = false;
			}
		}

		public function is_logged_in () {
			return $this->logged_in;
		}

		public function login ( $user ) {
			if ( $user ) {
				$this->user_id = $_SESSION[ 'user_id' ] = $user->id;
				$this->logged_in = true;
				$this->settings = Settings::get_settings_for( $this->user_id );
			}
		}

		public function logout () {
			unset( $_SESSION[ 'user_id' ] );
			unset( $this->user_id );
			$this->logged_in = false;
			$this->settings = null;
		}
	}

	$session = new Session();
?>