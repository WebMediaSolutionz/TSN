<?php

	class Video extends Item {
		protected static $table_name = "video";
		public static $db_fields = array(
			'id'			=> 		'auto-increment',
			'album_id' 		=> 		'int',
			'user_id' 		=> 		'int',
			'file_mp4' 		=> 		'string',
			'file_3gp' 		=> 		'string',
			'file_flv'		=>		'string',
			'file_ogv' 		=> 		'string',
			'file_webm' 	=> 		'string',
			'thumbnail'		=>		'string',
			'position' 		=> 		'int', 
			'upload_date' 	=> 		'datetime', 
			'title'			=>		'string',
			'caption' 		=> 		'string'
			);
		public $id;
		public $album_id;
		public $user_id;
		public $file_mp4;
		public $file_3gp;
		public $file_flv;
		public $file_ogv;
		public $file_webm;
		public $thumbnail;
		public $position;
		public $next;
		public $previous;
		public $upload_date;
		public $title;
		public $caption;
		public $you_like;
		public $comments;

		public static function get_videos_for_user ( $user ) {
			global $DB;

			$sql = "SELECT * FROM " . static::$table_name . " ";
			$sql .= "WHERE user_id=" . $DB->escape_value( $user->id ) . " ORDER BY upload_date DESC";

			$videos = static::find_by_sql( $sql );

			return $videos;
		}

		public static function get_last_few_of_user ( $user_id, $number = 5 ) {
			global $DB;

			$sql = "SELECT * FROM " . static::$table_name . " ";
			$sql .= "WHERE user_id=" . $DB->escape_value( $user_id ) . " ORDER BY upload_date DESC ";
			$sql .= "LIMIT " . $DB->escape_value( $number );

			$videos = static::find_by_sql( $sql );

			return $videos;
		}
	}

?>