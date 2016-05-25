<?php
	class PictureCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination;

			$theme = static::$theme;

			$current_user = User::find_by_id( $session->user_id );

			if ( isset( $_GET[ 'picture_id' ] ) || isset( $_GET[ 'item_id' ] ) ) {
				$_GET[ 'picture_id' ] = ( isset( $_GET[ 'item_id' ]  ) ) ? $_GET[ 'item_id' ] : $_GET[ 'picture_id' ];

				$picture = Picture::find_by_id( $_GET[ 'picture_id' ] );

				$next_pic = $picture->get_next_picture();
				$prev_pic = $picture->get_previous_picture();

				$picture->you_like = Likes::you_like( $current_user->id, $picture );
				$picture->comments = Comments::get_comments_for_item( $picture );

				foreach ( $picture->comments as $comment ) {
					$comment->you_like = Likes::you_like( $current_user->id, $comment );
				}

				$picture_owner = User::find_by_id( $picture->user_id );
				$album = ALbum::find_by_id( $picture->album_id );

				$profile_img = "UPS/{$picture_owner->id}/profile.jpg";
				$current_user_img = "UPS/{$current_user->id}/profile.jpg";

				$picture_path = "UPS/{$picture_owner->id}/pictures/{$picture->filename}";

				$profile_img = file_exists( $profile_img ) ? $profile_img : "images/{$theme}/default_profile_pic.jpg";
				$current_user_img = file_exists( $current_user_img ) ? $current_user_img : "images/{$theme}/default_profile_pic.jpg";
			} else {
				Utils::redirect_to( 'login.php' );
			}

			include_once( static::load_template() );
		}

		public static function delete_picture () {
			$picture = Picture::find_by_id( $_GET[ 'picture_id' ] );
			$next_picture = $picture->get_next_picture();
			$picture->delete();
			Utils::redirect_to( "picture.php?picture_id={$next_picture->id}" );
		}
	}
?>