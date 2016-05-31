<?php
	class LiveshowsCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;

			$theme = static::$theme;
			
			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			if ( isset( $session->user_id ) ) {
				$current_user = User::find_by_id( $session->user_id );
			}
			
			include_once( static::load_template() );
		}
	}
?>