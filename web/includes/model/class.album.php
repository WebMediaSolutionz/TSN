<?php

	class Album extends Item {
		protected static $table_name = "album";
		public static $db_fields = array(
			'id'				=> 		'auto-increment',
			'user_id' 			=> 		'int',
			'name' 				=> 		'string',
			'nbr_of_items'		=>		'int',
			'empty_album_pic'	=>		'string',
			'creation_date' 	=> 		'datetime',
			'modified_date' 	=> 		'datetime'
			);
		public $id;
		public $user_id;
		public $name;
		public $nbr_of_items = 0;
		public $empty_album_pic = 'empty_album.jpg';
		public $creation_date;
		public $modified_date;
		public $pictures;

		public static function get_albums_for_user ( $user_id ) {
			global $DB;

			$sql = "SELECT * FROM " . static::$table_name . " ";
			$sql .= "WHERE user_id=" . $DB->escape_value( $user_id ) . " ORDER BY name";

			$albums = static::find_by_sql( $sql );

			return $albums;
		}

		public function load_pictures () {
			global $DB;

			$sql = "SELECT * FROM picture ";
			$sql .= "WHERE album_id=" . $DB->escape_value( $this->id ) . " ORDER BY position";

			$this->pictures = Picture::find_by_sql( $sql );
			$this->nbr_of_items = count( $this->pictures );
		}

		public static function get_last_few_of_user ( $user_id, $number = 5 ) {
			global $DB;

			$sql = "SELECT * FROM " . static::$table_name . " ";
			$sql .= "WHERE user_id=" . $DB->escape_value( $user_id ) . " ORDER BY modified_date DESC ";
			$sql .= "LIMIT " . $DB->escape_value( $number );

			$albums = static::find_by_sql( $sql );

			return $albums;
		}
	}

?>