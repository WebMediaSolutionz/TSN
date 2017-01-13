<?php
	class BioCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page;

			$theme = static::$theme;

			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			if ( defined( 'PROFILE_USER' ) ) {
				$profile_user = User::find_by_id( PROFILE_USER );
			}

			if ( isset( $session->user_id ) ) {
				$current_user = User::find_by_id( $session->user_id );

				$posts = $current_user->get_newsfeed_posts();

				foreach ( $posts as $post ) {
					$post->you_like = Likes::you_like( $current_user->id, $post );
					$post->comments = Comments::get_comments_for_item( $post );

					foreach ( $post->comments as $comment ) {
						$comment->you_like = Likes::you_like( $current_user->id, $comment );
					}
				}

				$current_user_img = "UPS/{$current_user->id}/profile.jpg";
				$current_user_img = file_exists( $current_user_img ) ? $current_user_img : "images/{$theme}/default_profile_pic.jpg";
			}

			include_once( ( isset( $_GET[ 'mode' ] ) && $_GET[ 'mode' ] === 'edit' && isset( $session->user_id ) && isset( $profile_user ) && ( $session->user_id === $profile_user->id ) ) ? static::load_template( 'bio_edit' ) : static::load_template() );
		}

		public static function update_bio () {
			global $session;

			if ( isset( $_POST[ 'submit' ] ) ) {
				$current_user = User::find_by_id( $session->user_id );

				$current_user->bio = ( isset( $_POST[ 'bio' ] ) ) ? $_POST[ 'bio' ] : $current_user->bio;

				$current_user->save();

				utils::redirect_to( 'bio.php' );
			}
		}
	}
?>