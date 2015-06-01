<?php

	class Comments extends DatabaseObject {
		protected static $table_name = "comments";
		public static $db_fields = array(
			'id'			=> 		'auto-increment',
			'value' 		=> 		'string',
			'user_id' 		=> 		'int',
			'post_id' 		=> 		'int', 
			'picture_id' 	=> 		'int',
			'album_id' 		=> 		'int',
			'video_id' 		=> 		'int',
			'track_id' 		=> 		'int',
			'date' 			=> 		'auto-increment'
			);
		public $id;
		public $value;
		public $user_id;
		public $post_id;
		public $picture_id;
		public $album_id;
		public $video_id;
		public $track_id;
		public $date;
		public $you_like;

		public static function get_comments_for_item ( $item ) {
			global $DB;

			$item_type = strtolower( get_class( $item ) );

			switch ( $item_type ) {
				case 'post' 	:	$sql = "SELECT * FROM " . static::$table_name . " WHERE post_id = {$item->id} ORDER BY date";
									break;

				case 'picture' 	:	$sql = "SELECT * FROM " . static::$table_name . " WHERE picture_id = {$item->id} ORDER BY date";
									break;

				case 'album' 	:	$sql = "SELECT * FROM " . static::$table_name . " WHERE album_id = {$item->id} ORDER BY date";
									break;

				case 'video' 	:	$sql = "SELECT * FROM " . static::$table_name . " WHERE video_id = {$item->id} ORDER BY date";
									break;

				case 'track' 	:	$sql = "SELECT * FROM " . static::$table_name . " WHERE track_id = {$item->id} ORDER BY date";
									break;
			}

			return self::find_by_sql( $sql );
		}

		public static function delete_comments_on_post ( $post_id ) {
			global $DB;

			$sql = "DELETE FROM " . static::$table_name . " WHERE post_id = {$post_id}";

			$DB->query( $sql );
			
			return ( $DB->affected_rows() == 1 );
		}
	}

?>