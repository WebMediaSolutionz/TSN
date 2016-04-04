<?php
	class BlogCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page;

			$theme = static::$theme;

			$current_page = "blog";
			$current_user = User::find_by_id( $session->user_id );

			$posts = $current_user->get_newsfeed_posts();

			foreach ( $posts as $post ) {
				$post->you_like = Likes::you_like( $current_user->id, $post );
				$post->comments = Comments::get_comments_for_item( $post );

				foreach ( $post->comments as $comment ) {
					$comment->you_like = Likes::you_like( $current_user->id, $comment );
				}
			}

			include_once( "views/" . static::$theme . "/" . static::$template );
		}
	}
?>