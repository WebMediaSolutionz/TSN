<?php
	class ConversationCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $redirect_destination;

			$theme = static::$theme;

			$current_user = User::find_by_id( $session->user_id );

			if ( isset( $_GET[ 'convo_id' ] ) ) {
				$conversation = Conversations::find_by_id( $_GET[ 'convo_id' ] );
			} else {
				Utils::redirect_to( 'login.php' );
			}

			include_once( "views/" . static::$theme . "/" . static::$template );
		}

		public static function send_message () {
			global $session;

			if ( isset( $_POST[ 'submit' ] ) ) {
				$message = new Messages;
				$current_user = User::find_by_id( $session->user_id );

				$message->message = $_POST[ 'message' ];
				$message->date = Utils::mysql_datetime();
				$message->read = 0;
				$message->conversation_id = $_POST[ 'convo_id' ];
				$message->user_id = $current_user->id;

				$message->save();
			}
		}

		public static function get_last_convo ( $current_user, $recipient ) {
			global $DB;

			$convos = array();

			$sql = "SELECT `conversation_id`, count(*) AS participants FROM `conversations_users` WHERE `conversation_id` IN ( SELECT a.`conversation_id` FROM `conversations_users` AS a INNER JOIN `conversations_users` AS b ON a.`conversation_id` = b.`conversation_id` WHERE a.user_id = {$current_user->id} AND b.user_id = {$recipient->id} ) GROUP BY `conversation_id` ORDER BY `conversation_id` DESC";

			$result_set = $DB->query( $sql );

			while ( $convos[] = $DB->fetch_array( $result_set ) ) {}

			foreach ( $convos as $convo ) {
				if ( $convo[ 'participants' ] == 2 ) {
					Utils::redirect_to( "conversation.php?convo_id={$convo[ 'conversation_id' ]}" );
				}
			}
		}

		public static function start_new_conversation () {
			global $DB, $session, $current_url;

			$current_user = User::find_by_id( $session->user_id );
			$recipient = User::find_by_id( $_GET[ 'recipient' ] );

			static::get_last_convo( $current_user, $recipient );

			$participants = array( $current_user, $recipient );

			$convo = new Conversations;
			$convo->subject = '';
			$convo->save();

			foreach ( $participants as $participant ) {
				$sql = "INSERT INTO conversations_users (conversation_id, user_id, active) VALUES ({$convo->id}, {$participant->id}, 1)";

				$DB->query( $sql );
			}

			Utils::redirect_to( "conversation.php?convo_id={$convo->id}" );
		}
	}
?>