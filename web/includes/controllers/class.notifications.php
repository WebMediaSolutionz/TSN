<?php
	class NotificationsCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination, $current_page;

			$theme = static::$theme;

			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;
			
			$current_user = User::find_by_id( $session->user_id );

			$notifications = Notification::get_notifications_for( $current_user->id );

			include_once( static::load_template() );
		}

		public static function mark_all_notifications_as () {
			global $session;

			if ( isset( $_GET[ 'status' ] ) ) {
				$notifications = Notification::get_unread_notifications_for( $session->user_id );

				foreach ( $notifications as $notification ) {
					$notification->read = ( $_GET[ 'status' ] == 'read' );
					$notification->save();
				}
			}
		}
	}
?>