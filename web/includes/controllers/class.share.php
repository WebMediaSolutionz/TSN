<?php
	class ShareCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination;

			$theme = static::$theme;

			$current_user = User::find_by_id( $session->user_id );

			if ( isset( $_REQUEST[ 'post_id' ] ) ) {
				$post = Post::find_by_id( $_REQUEST[ 'post_id' ] );
				$redirect_destination = Utils::current_page( $_SERVER[ 'HTTP_REFERER' ] );

				$post->you_like = Likes::you_like( $current_user->id, $post );

			} else {
				Utils::redirect_to( 'login.php' );
			}

			include_once( static::load_template() );
		}
	}
?>