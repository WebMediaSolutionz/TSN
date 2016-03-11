<?php
	class AddPicturesCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;

			$theme = static::$theme;

			$current_user = User::find_by_id( $session->user_id );

			$album = Album::find_by_id( $_GET[ 'album_id' ] );
			
			include_once( "views/" . static::$theme . "/" . static::$template );
		}
	}
?>