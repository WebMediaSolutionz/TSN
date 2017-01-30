<?php
	class AlbumCreationCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;

			if ( defined( 'PROFILE_USER' ) ) {
				$profile_user = User::find_by_id( PROFILE_USER );
			}

			if ( $session->is_logged_in() ) {
				$theme = static::$theme;
				$current_page = static::$current_page;
				$current_page_short = static::$current_page_short;

				$current_user = User::find_by_id( $session->user_id );
				
				include_once( static::load_template() );
			} else {
				Utils::redirect_to( 'login.php' );
			}
		}

		public static function create () {
			global $session;

			if ( isset( $_POST[ 'submit' ] ) ) {
				if ( isset( $_POST[ 'album_name' ] ) ) {
					$album = new Album;

					$album->user_id = $session->user_id;
					$album->name = $_POST[ 'album_name' ];
					$album->creation_date = Utils::mysql_datetime();
					$album->modified_date = Utils::mysql_datetime();

					$album->save();	

					$album_id = $album->id;
				} else if ( isset( $_POST[ 'album_id' ] ) ) {
					$album_id = $_POST[ 'album_id' ];
				}

				$picture = new picture;

				$picture->album_id = $album_id;
				$picture->user_id = $session->user_id;
				$picture->filename = Picture::name_picture( User::find_by_id( $session->user_id ) );
				$picture->upload_date = Utils::mysql_datetime();

				$picture->save();
				$picture->upload( $_FILES[ 'pictures' ] );
			}

			Utils::redirect_to( "album.php?album_id={$album_id}" );
		}
	}
?>