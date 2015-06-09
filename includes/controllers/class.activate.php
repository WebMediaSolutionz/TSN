<?php
	class ActivationCtrl extends ActionCtrl {
		public static function load () {
			$message = "";

			if ( isset( $_GET[ 'verification_key' ] ) ) {
				if ( User::activate( $_GET[ 'verification_key' ] ) ) {
					Utils::redirect_to( 'login.php?status=activated' );
				} else {
					Utils::redirect_to( 'login.php?status=unactivated' );
				}
			} else {
				Utils::redirect_to( 'login.php?status=unactivated' );
			}
		}

		public static function init () {
			static::load();
		}
	}
?>