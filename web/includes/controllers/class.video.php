<?php
	class VideoCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination;

			$theme = static::$theme;
			
			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			$current_user = User::find_by_id( $session->user_id );

			if ( isset( $_GET[ 'video_id' ] ) || isset( $_GET[ 'item_id' ] ) ) {
				$_GET[ 'video_id' ] = ( isset( $_GET[ 'item_id' ]  ) ) ? $_GET[ 'item_id' ] : $_GET[ 'video_id' ];
				
				$video = Video::find_by_id( $_GET[ 'video_id' ] );

				$video->you_like = Likes::you_like( $current_user->id, $video );
				$video->comments = Comments::get_comments_for_item( $video );

				foreach ( $video->comments as $comment ) {
					$comment->you_like = Likes::you_like( $current_user->id, $comment );
				}

				$video_owner = User::find_by_id( $video->user_id );
				$profile_img = "UPS/{$video_owner->id}/profile.jpg";
				$current_user_img = "UPS/{$current_user->id}/profile.jpg";

				$video_path_mp4 = "UPS/{$video_owner->id}/videos/{$video->file_mp4}";
				$video_path_3gp = "UPS/{$video_owner->id}/videos/{$video->file_3gp}";
				$video_path_ogv = "UPS/{$video_owner->id}/videos/{$video->file_ogv}";
				$video_path_webm = "UPS/{$video_owner->id}/videos/{$video->file_webm}";

				$profile_img = file_exists( $profile_img ) ? $profile_img : "views/{$theme}/images/default_profile_pic.jpg";
				$current_user_img = file_exists( $current_user_img ) ? $current_user_img : "views/{$theme}/images/default_profile_pic.jpg";
			} else {
				Utils::redirect_to( 'login.php' );
			}

			include_once( static::load_template() );
		}

		public static function delete_video () {
			$video = Video::find_by_id( $_GET[ 'video_id' ] );
			$video->delete();
		}
	}
?>