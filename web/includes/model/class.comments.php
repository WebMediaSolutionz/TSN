<?php

	class Comments extends Item {
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
			'date' 			=> 		'datetime'
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

		public static function commenters ( $item, $except_for_this_user_id = null ) {
			global $DB, $session;

			$item_type = strtolower( get_class( $item ) );

			$users = array();

			if ( $item_type != "comments" ) {
				switch ( $item_type ) {
					case 'comments'		:		$item_type = 'comment';
												break;
				}

				$sql = "SELECT user_id FROM " . static::$table_name . " ";
				$sql .= "WHERE {$item_type}_id = {$item->id} ";

				if ( $except_for_this_user_id != null ) {
					$sql .= "AND user_id != {$except_for_this_user_id}";
				}

				$result_set = $DB->query( $sql );

				while ( $row = $DB->fetch_array( $result_set ) ) {
					$object = static::instantiate( $row );
					$users[] = User::find_by_id( $object->user_id );
				}
			}

			return $users;
		}

		public function get_related_item () {
			$item = null;

			if ( $this->post_id !== '0'  ) {
				$item = Post::find_by_id( $this->post_id );
			} else if ( $this->picture_id !== '0' ) {
				$item = Picture::find_by_id( $this->picture_id );
			} else if ( $this->album_id !== '0' ) {
				$item = Album::find_by_id( $this->album_id );
			} else if ( $this->video_id !== '0' ) {
				$item = Video::find_by_id( $this->video_id );
			} else if ( $this->track_id !== '0' ) {
				$item = Track::find_by_id( $this->track_id );
			}

			return $item;
		}
	}

?>