<?php
	class SettingsCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination, $current_page;

			$theme = static::$theme;

			$current_page = "settings";
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

			include_once( "views/" . static::$theme . "/" . static::$template );
		}

		public static function delete_account () {
			global $session, $DB;

			$current_user = User::find_by_id( $session->user_id );
			$current_user->delete_account();
		}
	}
?>