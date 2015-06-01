<?php
	class ActionCtrl {
		public static $current_page;
		public static $action_like_link;
		public static $action_unlike_link;
		public static $action_comment_link;
		public static $action_delete_comment_link;
		public static $action_delete_post_link;
		public static $action_share_link;
		public static $theme;
		public static $template;

		public static function init () {
			global $session;
			
			static::$current_page = Utils::current_page( $_SERVER[ 'REQUEST_URI' ] );
			static::$action_like_link = Utils::create_action_link( static::$current_page, 'like' );
			static::$action_unlike_link = Utils::create_action_link( static::$current_page, 'unlike' );
			static::$action_comment_link = Utils::create_action_link( static::$current_page, 'comment' );
			static::$action_delete_comment_link = Utils::create_action_link( static::$current_page, 'delete_comment' );
			static::$action_delete_post_link = Utils::create_action_link( static::$current_page, 'delete_post' );
			static::$action_share_link = Utils::create_action_link( static::$current_page, 'share' );

			if ( isset( $session->settings ) ) {
				static::$theme = $session->settings->theme;
				require_once( '../includes/lang/' . $session->settings->language . '.php' );
			} else {
				static::$theme = "facebook";
				require_once( '../includes/lang/en.php' );
			}

			static::$template = explode( '/', $_SERVER[ 'SCRIPT_FILENAME' ] );
			static::$template = static::$template[ count( static::$template ) - 1 ];
			static::$template = str_replace( '.php', '.tpl.php', static::$template );

			$classname = get_called_class();

			if ( $classname !== 'LoginCtrl' ) {
				static::check_session();
			}

			if ( $session->is_logged_in() && isset( $_GET[ 'action' ] ) ) {
				if ( method_exists( $classname, $_GET[ 'action' ] ) ) {
					$classname::$_GET[ 'action' ]();
				}

				Utils::strip_query_string( $_SERVER[ 'REQUEST_URI' ] );
				$session->settings = static::get_settings_for( $session->user_id );
			}

			static::load();
		}

		public static function get_settings_for ( $user_id ) {
			if ( $user_id ) {
				$sql = "SELECT * FROM settings WHERE user_id = {$user_id} LIMIT 1";

				$settings = Settings::find_by_sql( $sql );
				$settings = array_shift( $settings );
				// $settings->theme = static::get_theme( $settings->theme_id );

				return $settings;
			}
		}

		public static function get_theme ( $id ) {
			if ( $id ) {
				$sql = "SELECT name FROM themes WHERE id = {$id} LIMIT 1";

				return Settings::find_by_sql( $sql );
			}
		}

		public static function check_session () {
			global $session;

			if ( !$session->is_logged_in() ) {
				redirect_to( 'login.php' );
			}
		}

		public static function like () {
			global $session;

			$like = new Likes;

			$like->user_id = $session->user_id;

			if ( isset( $_GET[ 'post_id' ] ) ) {
				$like->post_id = $_GET[ 'post_id' ];
			} else if ( isset( $_GET[ 'comment_id' ] ) ) {
				$like->comment_id = $_GET[ 'comment_id' ];
			} else if ( isset( $_GET[ 'picture_id' ] ) ) {
				$like->picture_id = $_GET[ 'picture_id' ];
			} else if ( isset( $_GET[ 'album_id' ] ) ) {
				$like->album_id = $_GET[ 'album_id' ];
			}

			$like->save();
		}

		public static function unlike () {
			global $session;

			if ( isset( $_GET[ 'post_id' ] ) ) {
				$item = Post::find_by_id( $_GET[ 'post_id' ] );
			} else if ( isset( $_GET[ 'comment_id' ] ) ) {
				$item = Comments::find_by_id( $_GET[ 'comment_id' ] );
			} else if ( isset( $_GET[ 'picture_id' ] ) ) {
				$item = Picture::find_by_id( $_GET[ 'picture_id' ] );
			} else if ( isset( $_GET[ 'album_id' ] ) ) {
				$item = Album::find_by_id( $_GET[ 'album_id' ] );
			} else if ( isset( $_GET[ 'video_id' ] ) ) {
				// get video object
			}

			Likes::unlike( $session->user_id, $item );
		}

		public static function share () {
			global $session;

			$post = new Post;
			$shared_post_id = $_GET[ 'post_id' ];
			$shared_post = Post::find_by_id( $shared_post_id );
			$user = User::find_by_id( $shared_post->user_id );

			$post->wall_id = $_POST[ 'destination' ];
			$post->user_id = $session->user_id;
			$post->post_id = $shared_post_id;
			$post->shared_post = $shared_post;
			$post->value = $_POST[ 'value' ];

			switch ( $shared_post->post_type ) {
				case 3 :
				case 5 :	$post->post_type = 5;
							break;

				case 6 :
				case 7 :	$post->post_type = 7;
							$post->picture_id = $shared_post->picture_id;
							break;			
			}
			

			$post->save();

			Utils::redirect_to( $_POST[ 'redirect_destination' ] );
		}

		public static function comment () {
			global $session;

			$comment = new Comments;

			$comment->value = $_POST[ 'value' ];
			$comment->user_id = $session->user_id;

			if ( isset( $_POST[ 'post_id' ] ) ) {
				$comment->post_id = $_POST[ 'post_id' ];
			} else if ( isset( $_POST[ 'picture_id' ] ) ) {
				$comment->picture_id = $_POST[ 'picture_id' ];
			} else if ( isset( $_POST[ 'album_id' ] ) ) {
				$comment->album_id = $_POST[ 'album_id' ];
			}

			$comment->save();
		}

		public static function delete_comment () {
			global $session;

			$comment = Comments::find_by_id( $_GET[ 'comment_id' ] );

			$comment->delete();
		}

		public static function load () {}
	}
?>