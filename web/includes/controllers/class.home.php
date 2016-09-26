<?php
	class HomeCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page;

			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;
			
			$theme = static::$theme;

			if ( DEFAULT_THEME === 'kn' && defined( 'PROFILE_USER' ) ) {
				$profile_user = $current_user = User::find_by_id( PROFILE_USER );

				$videos = Video::get_last_few_of_user( $profile_user->id, 3 );
				$video_thumb = str_replace( '*id*', $profile_user->id, USER_PERSONAL_SPACE_VIDEOS ) . "/tn";

				$albums = Album::get_last_few_of_user( $profile_user->id, 4 );

				foreach ( $albums as $x_album ) {
					$x_album->load_pictures();
				}

				$posts = Post::get_last_few_of_user( $profile_user->id, 3 );

				$current_user_img = "UPS/{$profile_user->id}/profile.jpg";
				$current_user_img = file_exists( $current_user_img ) ? $current_user_img : "views/{$theme}/authenticated/images/default_profile_pic.jpg";

				foreach ( $posts as $post ) {
					$post->you_like = Likes::you_like( $profile_user->id, $post );
					$post->comments = Comments::get_comments_for_item( $post );

					foreach ( $post->comments as $comment ) {
						$comment->you_like = Likes::you_like( $profile_user->id, $comment );
					}
				}
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
				$current_user_img = file_exists( $current_user_img ) ? $current_user_img : "views/{$theme}/authenticated/images/default_profile_pic.jpg";
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