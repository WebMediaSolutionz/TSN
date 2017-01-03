<?php
	class AddVideoCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page_short;

			$theme = static::$theme;

			if ( $session->is_logged_in() ) {
				$current_user = User::find_by_id( $session->user_id );
				include_once( static::load_template() );
			} else {
				Utils::redirect_to( 'login.php' );
			}
		}

		public static function add_video () {
			
		}
	}
?>