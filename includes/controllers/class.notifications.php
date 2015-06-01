<?php
	class NotificationsCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination, $current_page;

			$theme = static::$theme;

			$current_page = "notifications";
			$current_user = User::find_by_id( $session->user_id );

			include_once( "views/" . static::$theme . "/" . static::$template );
		}
	}
?>