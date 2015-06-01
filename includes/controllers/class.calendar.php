<?php
	class CalendarCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page;

			$theme = static::$theme;

			$current_page = "calendar";
			$current_user = User::find_by_id( $session->user_id );

			include_once( "views/" . static::$theme . "/" . static::$template );
		}
	}
?>