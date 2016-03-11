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
			'date' 							=> 		'datetime',
			'read' 							=> 		'int'
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
		public $read;
		public $item;

		public function create () {
			global $environment;
			parent::create();

			$settings = Settings::get_settings_for( $this->user_id );

			if ( $settings->email_notifications ) {
				$user = User::find_by_id( $this->user_id );

				if ( $environment != 'dev' ) {
					Utils::sendmail( $user, 'notification', $this->type );
				}
			}
		}

		public static function get_notifications_for ( $user_id ) {
			global $DB;

			$notifications = static::find_by_sql( "SELECT * FROM " . static::$table_name . " WHERE user_id = {$user_id} ORDER BY date DESC" );

			foreach ( $notifications as $notification ) {
				if ( $notification->post_id ) {
					$notification->item = Post::find_by_id( $notification->post_id );
				} else if ( $notification->picture_id ) {
					$notification->item = Picture::find_by_id( $notification->picture_id );
				} else if ( $notification->album_id ) {
					$notification->item = Album::find_by_id( $notification->album_id );
				} else if ( $notification->video_id ) {
					$notification->item = Video::find_by_id( $notification->video_id );
				} else if ( $notification->track_id ) {
					$notification->item = Track::find_by_id( $notification->track_id );
				} else if ( $notification->comment_id ) {
					$notification->item = Comments::find_by_id( $notification->comment_id );
				}
			}

			return $notifications;
		}

		public static function get_unread_notifications_for ( $user_id ) {
			return static::find_by_sql( "SELECT * FROM " . static::$table_name . " WHERE user_id = {$user_id} AND `read` = 0 ORDER BY date DESC" );
		}
	}

?>