<?php

	class Post extends Item {
		protected static $table_name = "posts";
		public static $db_fields = array(
			'id'			=> 		'auto-increment',
			'wall_id' 		=> 		'int', 
			'user_id' 		=> 		'int',
			'post_id' 		=> 		'int',
			'picture_id' 	=> 		'int',
			'value' 		=> 		'string', 
			'post_date' 	=> 		'datetime', 
			'post_type' 	=> 		'int'
			);
		public $id;
		public $wall_id;
		public $user_id;
		public $post_id;
		public $picture_id;
		public $shared_post;
		public $value;
		public $post_date;
		public $post_type;
		public $you_like;
		public $comments;

		public function new_friendship_was_created ( $friend1_id, $friend2_id ) {
			$this->wall_id = $friend1_id;
			$this->user_id = $friend2_id;
			$this->post_type = 4;
			$this->post_date = Utils::mysql_datetime();

			$this->save();
		}

		public static function get_last_few_of_user ( $user_id, $number = 5 ) {
			global $DB;

			$sql = "SELECT * FROM " . static::$table_name . " ";
			$sql .= "WHERE user_id=" . $DB->escape_value( $user_id ) . " ORDER BY post_date DESC ";
			$sql .= "LIMIT " . $DB->escape_value( $number );

			$posts = static::find_by_sql( $sql );

			return $posts;
		}
	}

?>