<?php
	class SupportCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page;

			$theme = static::$theme;

			$current_page = "support";
			$current_user = User::find_by_id( $session->user_id );
			$message_sent = false;

			if ( isset( $_POST[ 'submit' ] ) ) {
				$subject = $_POST[ 'subject' ];
				$message = $_POST[ 'message' ];

				Utils::sendmail( $current_user, $subject, $message, true );
				$message_sent = true;
			}

			include_once( "views/" . static::$theme . "/" . static::$template );
		}
	}
?>