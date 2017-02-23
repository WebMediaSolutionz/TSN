<?php
	class FriendsCtrl extends FriendshipCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination, $current_page;

			if ( defined( 'PROFILE_USER' ) ) {
				$profile_user = User::find_by_id( PROFILE_USER );
			}

			if ( $session->is_logged_in() ) {
				$theme = static::$theme;
				$current_page = static::$current_page;
				$current_page_short = static::$current_page_short;
				
				$current_user = User::find_verified_by_id( $session->user_id );

				$friends = $current_user->get_friends();
				$followers = $current_user->get_followers();
				$leaders = $current_user->get_leaders();

				$users = array( $friends, $followers, $leaders );

				$searched = null;
				$found = null;

				if ( isset( $_POST[ 'submit' ] ) ) {
					$searched = User::identify( $_POST[ 'username' ] );

					$found = ( $searched !== null );
					$email = $_POST[ 'username' ];
				}

				include_once( static::load_template() );
			} else {
				Utils::redirect_to( 'login.php' );
			}
		}
	}
?>