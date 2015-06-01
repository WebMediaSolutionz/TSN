<?php
	class VidsCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page;

			$theme = static::$theme;

			$current_page = "videos";
			$current_user = User::find_by_id( $session->user_id );

			include_once( "views/" . static::$theme . "/" . static::$template );
		}
	}
?>