<?php

	class Likes extends DatabaseObject {
		protected static $table_name = "likes";
		public static $db_fields = array(
			'id'			=> 		'auto-increment',
			'user_id' 		=> 		'int',
			'post_id' 		=> 		'int',
			'comment_id' 	=> 		'int',
			'picture_id' 	=> 		'int',
			'album_id' 		=> 		'int',
			'video_id' 		=> 		'int',
			'track_id' 		=> 		'int',
			'date' 			=> 		'datetime'
			);
		public $id;
		public $user_id;
		public $post_id;
		public $comment_id;
		public $picture_id;
		public $album_id;
		public $video_id;
		public $track_id;
		public $date;

		public static function unlike ( $user_id, $item ) {
			global $DB;

			$item_type = strtolower( get_class( $item ) );

			switch ( $item_type ) {
				case 'comments'		:		$item_type = 'comment';
											break;
			}

			$sql = "DELETE FROM " . static::$table_name . " ";
			$sql .= "WHERE user_id=" . $DB->escape_value( $user_id ) . " ";
			$sql .= "AND {$item_type}_id=" . $DB->escape_value( $item->id ) . " ";
			$sql .= "LIMIT 1";

			$DB->query( $sql );
			
			return ( $DB->affected_rows() == 1 );
		}

		public static function you_like ( $user_id, $item ) {
			global $DB, $session;

			$item_type = strtolower( get_class( $item ) );

			switch ( $item_type ) {
				case 'comments'		:		$item_type = 'comment';
											break;
			}

			$sql = "SELECT * FROM " . static::$table_name . " ";
			$sql .= "WHERE user_id = {$user_id} ";
			$sql .= "AND {$item_type}_id = {$item->id} ";
			$sql .= "LIMIT 1";

			$result_set = $DB->query( $sql );

			$object_array = array();

			while ( $row = $DB->fetch_array( $result_set ) ) {
				$object_array[] = static::instantiate( $row );
			}
			return ( count( $object_array ) === 1 );
		}

		public static function likers ( $item, $except_for_this_user_id ) {
			global $DB, $session;

			$item_type = strtolower( get_class( $item ) );

			switch ( $item_type ) {
				case 'comments'		:		$item_type = 'comment';
											break;
			}

			$sql = "SELECT user_id FROM " . static::$table_name . " ";
			$sql .= "WHERE {$item_type}_id = {$item->id} ";
			$sql .= "AND user_id != {$except_for_this_user_id}";

			$result_set = $DB->query( $sql );

			$users = array();

			while ( $row = $DB->fetch_array( $result_set ) ) {
				$object = static::instantiate( $row );
				$users[] = User::find_by_id( $object->user_id );
			}
			return $users;
		}
	}

?>