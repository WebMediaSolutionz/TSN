<?php
	class TrackCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination;

			$theme = static::$theme;

			$current_user = User::find_by_id( $session->user_id );

			if ( isset( $_GET[ 'track_id' ] ) ) {
				$track = Track::find_by_id( $_GET[ 'track_id' ] );

				$track->you_like = Likes::you_like( $current_user->id, $track );
				$track->comments = Comments::get_comments_for_item( $track );

				foreach ( $track->comments as $comment ) {
					$comment->you_like = Likes::you_like( $current_user->id, $comment );
				}

				$track_owner = User::find_by_id( $track->user_id );
				$profile_img = "UPS/{$track_owner->id}/profile.jpg";
				$current_user_img = "UPS/{$current_user->id}/profile.jpg";

				$track_path = "UPS/{$track_owner->id}/tracks/{$track->filename}";

				$profile_img = file_exists( $profile_img ) ? $profile_img : "images/{$theme}/default_profile_pic.jpg";
				$current_user_img = file_exists( $current_user_img ) ? $current_user_img : "images/{$theme}/default_profile_pic.jpg";
			} else {
				Utils::redirect_to( 'login.php' );
			}

			include_once( static::load_template() );
		}

		public static function delete_track () {
			$track = track::find_by_id( $_GET[ 'track_id' ] );
			$track->delete();
		}
	}
?>