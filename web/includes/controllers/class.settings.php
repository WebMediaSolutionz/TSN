<?php
	class SettingsCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination, $current_page;

			$theme = static::$theme;
			$themes = Themes::find_all();

			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			if ( defined( 'PROFILE_USER' ) ) {
				$profile_user = User::find_by_id( PROFILE_USER );
			}
			
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

		public static function update_theme () {
			global $session;

			if ( isset( $_GET[ 'theme_id' ] ) ) {
				$theme = Themes::find_by_id( $_GET[ 'theme_id' ] );
				$session->settings->theme_id = $theme->id;
				$session->settings->update();
			}
		}
	}
?>