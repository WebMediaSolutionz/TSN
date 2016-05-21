<?php
	class FriendsCtrl extends FriendshipCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination, $current_page;

			$theme = static::$theme;

			$current_page = "friends";
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

			include_once( "views/" . static::$theme . "/" . static::$template );
		}
	}
?>