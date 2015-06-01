<?php

	class Messages extends DatabaseObject {
		protected static $table_name = "messages";
		public static $db_fields = array(
			'id'					=> 			'auto-increment',
			'message' 				=> 			'string',
			'date'					=> 			'auto-increment',
			'read'					=> 			'auto-increment',
			'conversation_id'		=> 			'int',
			'user_id'				=> 			'int'
			);
		public $id;
		public $message;
		public $date;
		public $read;
		public $conversation_id;
		public $user_id;

		public static function get_conversation_messages ( $conversation_id ) {
			global $DB;

			$sql = "SELECT * FROM " . static::$table_name . " WHERE conversation_id = {$conversation_id} ORDER BY date";

			return self::find_by_sql( $sql );
		}

		public static function get_conversation_last_message ( $conversation_id ) {
			global $DB;

			$sql = "SELECT * FROM " . static::$table_name . " WHERE conversation_id = {$conversation_id} ORDER BY date";

			return self::find_by_sql( $sql );
		}
	}

?>