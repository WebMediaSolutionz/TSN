<?php
	class SettingsCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination, $current_page;

			$theme = static::$theme;

			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;
			
			$current_user = User::find_by_id( $session->user_id );

			if ( isset( $_POST[ 'submit' ] ) ) {
				foreach( $_POST as $key => $value ) {
					if ( $key !== 'submit' ) {
						$session->settings->$key = $value;
					}
				}

				$session->settings->update();

				require( '../includes/lang/' . $session->settings->language . '.php' );

				$message = array(
					"status"				=>			"confirmation",
					"prompt_code"			=>			"profile update success"
				);
			}

			include_once( static::load_template() );
		}

		public static function check_session () {
			global $session;

			if ( !$session->is_logged_in() ) {
				redirect_to( 'login.php' );
			}
		}
	}
?>