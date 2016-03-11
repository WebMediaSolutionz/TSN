<?php

	class Track extends Item {
		protected static $table_name = "track";
		public static $db_fields = array(
			'id'			=> 		'auto-increment',
			'album_id' 		=> 		'int',
			'user_id' 		=> 		'int',
			'filename' 		=> 		'string',
			'filetype' 		=> 		'string',
			'position' 		=> 		'int', 
			'upload_date' 	=> 		'datetime', 
			'caption' 		=> 		'string'
			);
		public $id;
		public $album_id;
		public $user_id;
		public $filename;
		public $filetype;
		public $position;
		public $next;
		public $previous;
		public $upload_date;
		public $caption;
		public $you_like;
		public $comments;
	}

?>