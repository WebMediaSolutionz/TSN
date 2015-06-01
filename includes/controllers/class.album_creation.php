<?php
	class AlbumCreationCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;

			$theme = static::$theme;

			$current_user = User::find_by_id( $session->user_id );
			
			include_once( "views/{$theme}/album_creation.tpl.php" );
		}

		public static function create () {
			global $session;

			if ( isset( $_POST[ 'submit' ] ) ) {
				if ( isset( $_POST[ 'album_name' ] ) ) {
					$album = new Album;

					$album->user_id = $session->user_id;
					$album->name = $_POST[ 'album_name' ];

					$album->save();	

					$album_id = $album->id;
				} else if ( isset( $_POST[ 'album_id' ] ) ) {
					$album_id = $_POST[ 'album_id' ];
				}

				$picture = new picture;

				$picture->album_id = $album_id;
				$picture->user_id = $session->user_id;
				$picture->filename = Picture::name_picture( User::find_by_id( $session->user_id ) );

				$picture->save();
				$picture->upload( $_FILES[ 'pictures' ] );
			}

			// Utils::redirect_to( "album.php?user_id={$session->user_id}" );
			Utils::redirect_to( "album.php?album_id={$album_id}" );
		}
	}
?>