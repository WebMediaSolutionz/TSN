<?php
	class InboxCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination, $current_page;

			$theme = static::$theme;

			$current_page = "inbox";
			$current_user = User::find_by_id( $session->user_id );
			$conversations = Conversations::get_users_conversations( $current_user->id );

			foreach ( $conversations as $conversation ) {
				$conversation->get_conversation_messages();
				$conversation->get_featured_participant();
			}

			include_once( "views/" . static::$theme . "/" . static::$template );
		}
	}
?>