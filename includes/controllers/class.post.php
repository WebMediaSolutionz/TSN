<?php
	class PostCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination;

			$theme = static::$theme;

			$current_user = User::find_by_id( $session->user_id );
			$current_user_img = "UPS/{$current_user->id}/profile.jpg";
			$current_user_img = file_exists( $current_user_img ) ? $current_user_img : "images/{$theme}/default_profile_pic.jpg";

			if ( isset( $_GET[ 'post_id' ] ) ) {
				$post = Post::find_by_id( $_GET[ 'post_id' ] );

				$post->you_like = Likes::you_like( $current_user->id, $post );
				$post->comments = Comments::get_comments_for_item( $post );

				foreach ( $post->comments as $comment ) {
					$comment->you_like = Likes::you_like( $current_user->id, $comment );
				}
			}

			include_once( "views/" . static::$theme . "/" . static::$template );
		}

		public static function delete_post () {
			$post = Post::find_by_id( $_GET[ 'post_id' ] );
			$post->delete();
		}
	}
?>