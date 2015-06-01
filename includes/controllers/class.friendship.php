<?php
	class FriendshipCtrl extends ActionCtrl {
		public static function send_friend_request () {
			global $session;

			$current_user = User::find_by_id( $session->user_id );

			if ( isset( $_GET[ 'leader' ] )  ) {
				$current_user->send_friend_request( $_GET[ 'leader' ] );
			}
		}

		public static function cancel_friend_request () {
			global $session;

			$current_user = User::find_by_id( $session->user_id );

			if ( isset( $_GET[ 'leader' ] )  ) {
				$current_user->cancel_friend_request( $_GET[ 'leader' ] );
			}
		}

		public static function accept_friend_request () {
			global $session;

			$current_user = User::find_by_id( $session->user_id );

			if ( isset( $_GET[ 'follower' ] )  ) {
				$current_user->accept_friend_request( $_GET[ 'follower' ] );
			}
		}

		public static function deny_friend_request () {
			global $session;

			$current_user = User::find_by_id( $session->user_id );

			if ( isset( $_GET[ 'follower' ] )  ) {
				$current_user->deny_friend_request( $_GET[ 'follower' ] );
			}
		}

		public static function delete_friend () {
			global $session;

			$current_user = User::find_by_id( $session->user_id );

			if ( isset( $_GET[ 'ex_friend' ] )  ) {
				User::delete_friend( $_GET[ 'ex_friend' ] );
			}
		}
	}
?>