<?php
	class BlogCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page;

			$theme = static::$theme;

			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			$current_user_img = "images/{$theme}/default_profile_pic.jpg";

			if ( isset( $session->user_id ) ) {
				$current_user = User::find_by_id( $session->user_id );
				$profile_user = ( defined( 'PROFILE_USER' ) ) ? User::find_by_id( PROFILE_USER ) : null;

				$current_user_img = "UPS/{$current_user->id}/profile.jpg";
				$current_user_img = file_exists( $current_user_img ) ? $current_user_img : "views/{$theme}/authenticated/images/default_profile_pic.jpg";

				$posts = $current_user->get_newsfeed_posts();

				foreach ( $posts as $post ) {
					$post->you_like = Likes::you_like( $current_user->id, $post );
					$post->comments = Comments::get_comments_for_item( $post );

					foreach ( $post->comments as $comment ) {
						$comment->you_like = Likes::you_like( $current_user->id, $comment );
					}
				}
			} else if ( defined( 'PROFILE_USER' ) ) {
				$current_user = User::find_by_id( PROFILE_USER );

				$current_user_img = "UPS/{$current_user->id}/profile.jpg";
				$current_user_img = file_exists( $current_user_img ) ? $current_user_img : "views/{$theme}/authenticated/images/default_profile_pic.jpg";

				$posts = $current_user->get_newsfeed_posts();

				foreach ( $posts as $post ) {
					$post->you_like = Likes::you_like( $current_user->id, $post );
					$post->comments = Comments::get_comments_for_item( $post );

					foreach ( $post->comments as $comment ) {
						$comment->you_like = Likes::you_like( $current_user->id, $comment );
					}
				}
			}

			include_once( static::load_template() );
		}

		public static function post_to_wall () {
			$post = new Post;

			$post->wall_id = $post->user_id = $_POST[ 'wall_id' ];
			$post->value = $_POST[ 'value' ];
			$post->post_type = 3;
			$post->post_date = Utils::mysql_datetime();

			$post->save();

			if ( isset( $_REQUEST[ 'response_type' ] ) && $_REQUEST[ 'response_type' ] === 'json' ) {
				$post_arr = (array) $post;

				header( 'Content-type: application/json' );
				exit( json_encode( $post_arr ) );
			}

			// static::notify( 'liked', $like->user_id, $item );
		}

		public static function delete_post () {
			$post = Post::find_by_id( $_GET[ 'post_id' ] );
			$post->delete();

			if ( isset( $_REQUEST[ 'response_type' ] ) && $_REQUEST[ 'response_type' ] === 'json' ) {
				exit( json_encode( array( 'status' => true ) ) );
			}
		}
	}
?>