<?php
	class LiveshowsCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;

			$theme = static::$theme;
			
			include_once( static::load_template() );
		}
	}
?>