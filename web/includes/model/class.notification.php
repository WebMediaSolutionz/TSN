<?php

	class Notification extends DatabaseObject {
		protected static $table_name = "notifications";
		public static $db_fields = array(
			'id'							=> 		'auto-increment',
			'type' 							=> 		'string',
			'user_id' 						=> 		'int',
			'action_initiator_user_id' 		=> 		'int',
			'item_owner_user_id' 			=> 		'int',
			'post_id' 						=> 		'int',
			'picture_id' 					=> 		'int',
			'album_id' 						=> 		'int',
			'video_id' 						=> 		'int',
			'track_id' 						=> 		'int',
			'comment_id' 					=> 		'int',
			'date' 							=> 		'datetime'
			);

		public $id;
		public $type;
		public $user_id;
		public $action_initiator_user_id;
		public $item_owner_user_id;
		public $post_id;
		public $picture_id;
		public $album_id;
		public $video_id;
		public $track_id;
		public $comment_id;
		public $date;

		public function save () {
			parent::save();

			$settings = Settings::get_settings_for( $this->user_id );

			if ( $settings->email_notifications ) {
				$user = User::find_by_id( $this->user_id );
				Utils::sendmail( $user, 'notification', $this->type );
			}
		}

		public static function get_notifications_for ( $user_id ) {
			global $DB;

			return static::find_by_sql( "SELECT * FROM " . static::$table_name . " WHERE user_id = {$user_id} ORDER BY date DESC" );
		}

		public static function get_unread_notifications_for ( $user_id ) {
			global $DB;

			return static::find_by_sql( "SELECT * FROM " . static::$table_name . " WHERE user_id = {$user_id} AND `read` = 1 ORDER BY date DESC" );
		}
	}

?>