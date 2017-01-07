<?php
	class AddVideoCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page_short;

			$theme = static::$theme;

			if ( $session->is_logged_in() ) {
				$current_user = User::find_by_id( $session->user_id );
				include_once( static::load_template() );
			} else {
				Utils::redirect_to( 'login.php' );
			}
		}

		public static function add_video () {
			global $session;

			if ( isset( $_POST[ 'submit' ] ) ) {
				$video = new Video;

				$video->album_id = 0;
				$video->user_id = $session->user_id;
				$video->file_mp4 = Video::name_video( User::find_by_id( $session->user_id ) );
				$video->thumbnail = str_replace( '.mov', '.jpg', $video->file_mp4 );
				$video->position = 1;
				$video->upload_date = Utils::mysql_datetime();
				$video->title = $_POST[ 'title' ];

				$video->save();

				$video->upload( $_FILES[ 'video' ], $video->file_mp4, $_FILES[ 'thumbnail' ], $video->thumbnail );
			}

			Utils::redirect_to( "video.php?item_id={$video->id}" );
		}
	}
?>