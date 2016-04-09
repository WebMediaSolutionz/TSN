<?php
	class FileNotFoundCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;

			$theme = static::$theme;

			include_once( "views/" . static::$theme . "/" . static::$template );
		}
	}
?>