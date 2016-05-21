<?php
	class LiveshowsCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;
			
			include_once( "views/" . static::$theme . "/" . static::$template );
		}
	}
?>