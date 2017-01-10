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

		protected $thumb_size = 194;

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

		public static function name_video ( $user ) {
			global $DB, $session;

			$sql = "SELECT `id` FROM `video` WHERE `user_id` = {$session->user_id} ORDER BY `id` DESC LIMIT 1";

			$videos = self::find_by_sql( $sql );

			$num = ( count( $videos ) > 0 ) ? (int) $videos[ 0 ]->id : 0;

			return ++$num . ".mov";
		}

		public static function name_picture ( $user ) {
			global $DB, $session;

			$sql = "SELECT `id` FROM `video` WHERE `user_id` = {$session->user_id} ORDER BY `id` DESC LIMIT 1";

			$videos = self::find_by_sql( $sql );

			$num = ( count( $videos ) > 0 ) ? (int) $videos[ 0 ]->id : 0;

			return $num . ".jpg";
		}

		public static function crop ( $picture, $width, $height ) {
			$im = imagecreatefromjpeg( $picture );

			$ini_x_size = getimagesize( $picture )[ 0 ];
			$ini_y_size = getimagesize( $picture )[ 1 ];

			//the minimum of xlength and ylength to crop.
			$crop_measure = min( $ini_x_size, $ini_y_size );

			$x = ( $ini_x_size - $crop_measure ) / 2;
			$y = ( $ini_y_size - $crop_measure ) / 2;

			$to_crop_array = array( 'x' => $x , 'y' => $y, 'width' => $crop_measure, 'height'=> $crop_measure );

			$thumb_im = imagecrop( $im, $to_crop_array );

			$thumbnail_path = str_replace( '.jpg', '_tn.jpg', $picture );
			$thumbnail_name = explode( '/', $thumbnail_path );
			$thumbnail_name = $thumbnail_name[ count( $thumbnail_name ) - 1 ];

			imagejpeg( $thumb_im, $thumbnail_path, 100 );

			return $thumbnail_name;
		}

		public function upload ( $video, $filename, $thumbnail, $thumb_filename ) {
			global $session;

			$tmp_file = $video[ 'tmp_name' ];
			$tmp_thumb_file = $thumbnail[ 'tmp_name' ];
			$target_file = $filename;
			$target_thumb_file = $thumb_filename;
			$upload_dir = str_replace( '*id*', $session->user_id, USER_PERSONAL_SPACE_VIDEOS );
			$target_file_fullpath = "{$upload_dir}/{$target_file}";
			$target_thumbnail_fullpath = "{$upload_dir}/tn/{$target_thumb_file}";

			$current_user = User::find_by_id( $session->user_id );
			$current_user->make_sure_ups_exists();

			if ( move_uploaded_file( $tmp_file, $target_file_fullpath ) ) {
				if ( move_uploaded_file( $tmp_thumb_file, $target_thumbnail_fullpath ) ) {
					$this->thumbnail = self::crop( $target_thumbnail_fullpath, $this->thumb_size, $this->thumb_size );
				}

				$this->save();
			}
		}

		public function delete () {
			// delete physical video traces
			$mp4_filepath = str_replace( '*id*', PROFILE_USER, USER_PERSONAL_SPACE_VIDEOS ) . "/" . $this->file_mp4;
			$video_thumb_path = str_replace( '*id*', PROFILE_USER, USER_PERSONAL_SPACE_VIDEOS ) . "/tn/" . $this->thumbnail;

			( file_exists( $mp4_filepath ) ) ? unlink( $mp4_filepath ) : null;
			( file_exists ( $video_thumb_path ) ) ? unlink( $video_thumb_path ): null;
			
			// delete record about video
			return parent::delete();
		}
	}

?>