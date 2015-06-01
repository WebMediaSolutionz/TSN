<?php

	class Conversations extends DatabaseObject {
		protected static $table_name = "conversations";
		public static $db_fields = array(
			'id'				=> 'auto-increment',
			'subject' 			=> 'string'
			);
		public $id;
		public $subject;
		public $messages;
		public $participants;
		public $featured_participant;

		public static function get_users_conversations ( $user_id ) {
			global $DB;

			$sql = "SELECT * FROM conversations WHERE id IN ( SELECT conversation_id FROM conversations_users WHERE user_id = {$user_id} )";

			return self::find_by_sql( $sql );
		}

		public function get_conversation_messages () {
			global $DB;

			$this->messages = Messages::get_conversation_messages( $this->id );
		}

		public function get_last_message () {
			return array_pop( $this->messages );
		}

		public function get_conversation_participants ( $inclusive = false ) {
			global $DB, $session;

			$current_user = User::find_by_id( $session->user_id );
			$participants = array();

			$sql = "SELECT user_id FROM conversations_users WHERE conversation_id = {$this->id} AND user_id <> {$current_user->id}";
	
			$result_set = $DB->query( $sql );

			while ( $row = $DB->fetch_array( $result_set ) ) {
				$participants[] = User::find_by_id( $row[ 'user_id' ] );
			}

			return $this->participants = $participants;
		}

		public function get_featured_participant () {
			$participants = $this->get_conversation_participants();
			return $this->featured_participant = array_pop( $participants );
		}

		public function display_participants () {
			$participants_string = array();

			foreach ( $this->participants as $paticipant ) {
				$participants_string[] = "{$paticipant->full_name()}";
			}

			return implode( ', ', $participants_string );
		}

		public static function find_by_id ( $id = 0 ) {
			$conversation = parent::find_by_id( $id );

			$conversation->get_conversation_messages();
			return $conversation;
		}

		public static function start_new_conversation () {
			global $DB, $session, $current_url;

			$current_user = User::find_by_id( $session->user_id );
			$recipient = User::find_by_id( $_GET[ 'recipient' ] );

			$participants = array( $current_user, $recipient );

			$convo = new Conversation;
			$convo->subject = '';
			$convo->save();

			foreach ( $participants as $participant ) {
				$sql = "INSERT INTO conversations_users ('conversation_id', 'user_id', 'active') VALUES ({$convo->id}, {$participant->id}, 1)";

				$DB->query( $sql );
			}

			// echo $current_url;
			// Utils::redirect_to( "conversation.php?convo_id={$convo->id}" );

			return $convo;
		}
	}

?>