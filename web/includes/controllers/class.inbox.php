<?php
	class InboxCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination, $current_page;

			if ( defined( 'PROFILE_USER' ) ) {
				$profile_user = User::find_by_id( PROFILE_USER );
			}

			if ( $session->is_logged_in() ) {
				$theme = static::$theme;
				$current_page = static::$current_page;
				$current_page_short = static::$current_page_short;
				
				$current_user = User::find_by_id( $session->user_id );
				$conversations = Conversations::get_users_conversations( $current_user->id );

				foreach ( $conversations as $conversation ) {
					$conversation->get_conversation_messages();
					$conversation->get_featured_participant();
				}

				include_once( static::load_template() );
			} else {
				Utils::redirect_to( 'login.php' );
			}
		}
	}
?>