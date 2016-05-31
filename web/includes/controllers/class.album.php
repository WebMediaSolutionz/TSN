<?php
	class AlbumCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title;

			$theme = static::$theme;
			
			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			if ( isset( $session->user_id ) ) {
				$current_user = User::find_by_id( $session->user_id );
			}

			$page = "";
			
			if ( isset( $_GET[ 'user_id' ] ) ) {
				$page = "albums";
				$profile_user = User::find_by_id( $_GET[ 'user_id' ] );

				$albums = Album::get_albums_for_user( $profile_user->id );

				foreach ( $albums as $x_album ) {
					$x_album->load_pictures();
				}

				static::$template = "albums.tpl.php";

			} else if ( isset( $_GET[ 'album_id' ] ) || isset( $_GET[ 'item_id' ] ) ) {
				$_GET[ 'album_id' ] = ( isset( $_GET[ 'item_id' ]  ) ) ? $_GET[ 'item_id' ] : $_GET[ 'album_id' ];
				
				$page = "album";
				$album = Album::find_by_id( $_GET[ 'album_id' ] );
				$album->load_pictures();

				$album->you_like = Likes::you_like( $current_user->id, $album );
				$album->comments = Comments::get_comments_for_item( $album );

				foreach ( $album->comments as $comment ) {
					$comment->you_like = Likes::you_like( $current_user->id, $comment );
				}

				$albums = Album::get_albums_for_user( $album->user_id );

				foreach ( $albums as $x_album ) {
					if ( $x_album->id === $album->id ) {
						$x_album->load_pictures();
					}
				}

				$profile_user = $picture_owner = User::find_by_id( $album->user_id );

				$profile_img = "UPS/{$picture_owner->id}/profile.jpg";
				$current_user_img = "UPS/{$current_user->id}/profile.jpg";

				$profile_img = file_exists( $profile_img ) ? $profile_img : "images/{$theme}/default_profile_pic.jpg";
				$current_user_img = file_exists( $current_user_img ) ? $current_user_img : "images/{$theme}/default_profile_pic.jpg";
			} else if ( defined( 'PROFILE_USER' ) ) {
				$page = "albums";
				$profile_user = User::find_by_id( PROFILE_USER );

				$albums = Album::get_albums_for_user( $profile_user->id );

				foreach ( $albums as $x_album ) {
					$x_album->load_pictures();
				}

				static::$template = "albums.tpl.php";
			}

			if ( !isset( $_GET[ 'user_id' ] ) && !isset( $_GET[ 'album_id' ] ) && !isset( $_GET[ 'item_id' ] ) && !defined( 'PROFILE_USER' ) ) {
				Utils::redirect_to( 'login.php' );
			}

			include_once( static::load_template() );
		}
	}
?>