<?php
	class VidsCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page;

			$theme = static::$theme;

			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			if ( isset( $session->user_id ) ) {
				$current_user = User::find_by_id( $session->user_id );
			}
			
			if ( defined( 'PROFILE_USER' ) ) {
				// $page = "videos";
				$profile_user = User::find_by_id( PROFILE_USER );

				$videos = Video::get_videos_for_user( $profile_user );

				$video_thumb = str_replace( '*id*', $profile_user->id, USER_PERSONAL_SPACE_VIDEOS ) . "/tn";
			}

			include_once( static::load_template() );
		}
	}
?>