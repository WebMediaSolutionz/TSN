<?php
	class PostCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination;

			if ( defined( 'PROFILE_USER' ) ) {
				$profile_user = User::find_by_id( PROFILE_USER );
			}

			if ( $session->is_logged_in() ) {
				$theme = static::$theme;

				$current_user = User::find_by_id( $session->user_id );
				$current_user_img = "UPS/{$current_user->id}/profile.jpg";
				$current_user_img = file_exists( $current_user_img ) ? $current_user_img : "images/{$theme}/default_profile_pic.jpg";

				if ( isset( $_GET[ 'post_id' ] ) || isset( $_GET[ 'item_id' ] ) ) {
					$_GET[ 'post_id' ] = ( isset( $_GET[ 'item_id' ]  ) ) ? $_GET[ 'item_id' ] : $_GET[ 'post_id' ];

					$post = Post::find_by_id( $_GET[ 'post_id' ] );

					$post->you_like = Likes::you_like( $current_user->id, $post );
					$post->comments = Comments::get_comments_for_item( $post );

					foreach ( $post->comments as $comment ) {
						$comment->you_like = Likes::you_like( $current_user->id, $comment );
					}
				} else {
					Utils::redirect_to( 'login.php' );
				}

				include_once( static::load_template() );
			} else {
				Utils::redirect_to( 'login.php' );
			}
		}

		public static function delete_post () {
			$post = Post::find_by_id( $_GET[ 'post_id' ] );
			$post->delete();
		}
	}
?>