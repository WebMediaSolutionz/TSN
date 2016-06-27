<?php
	class AddVideosCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;

			$theme = static::$theme;
			
			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			$current_user = User::find_by_id( $session->user_id );
			
			include_once( static::load_template() );
		}

		public static function create () {
			global $session;

			if ( isset( $_POST[ 'submit' ] ) ) {

				$video = new Video;

				$video->user_id = $session->user_id;
				$video->title = $_POST[ 'title' ];
				$video->caption = $_POST[ 'caption' ];
				$video->upload_date = Utils::mysql_datetime();

				$video->save();
				
				$video->upload( $_FILES[ 'video' ] );
			}

			Utils::redirect_to( "vids.php" );
		}
	}
?>