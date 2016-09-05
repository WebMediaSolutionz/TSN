<?php
	class AddPicturesCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;

			$theme = static::$theme;

			if ( $session->is_logged_in() ) {
				$current_user = User::find_by_id( $session->user_id );

				if ( isset( $_GET[ 'album_id' ] ) ) {
					$album = Album::find_by_id( $_GET[ 'album_id' ] );
				} else {
					Utils::redirect_to( 'login.php' );
				}
				
				include_once( static::load_template() );
			} else {
				Utils::redirect_to( 'login.php' );
			}
		}
	}
?>