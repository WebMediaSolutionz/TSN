<?php
	class HomeCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page;

			$current_page = static::$current_page;
			$theme = static::$theme;

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

			include_once( static::load_template() );
		}

		public static function post_to_wall () {
			if ( isset( $_POST[ 'submit' ] ) ) {
				$post = new Post;

				$post->wall_id = $post->user_id = $_POST[ 'wall_id' ];
				$post->value = $_POST[ 'value' ];
				$post->post_type = 3;
				$post->post_date = Utils::mysql_datetime();

				$post->save();
			}
		}

		public static function delete_post () {
			$post = Post::find_by_id( $_GET[ 'post_id' ] );
			$post->delete();
		}
	}
?>