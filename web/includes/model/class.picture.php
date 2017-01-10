<?php

	class Picture extends Item {
		protected static $table_name = "picture";
		public static $db_fields = array(
			'id'			=> 		'auto-increment',
			'album_id' 		=> 		'int',
			'user_id' 		=> 		'int',
			'filename' 		=> 		'string',
			'thumbnail' 	=> 		'string',
			'filetype' 		=> 		'string',
			'position' 		=> 		'int', 
			'upload_date' 	=> 		'datetime', 
			'caption' 		=> 		'string'
			);
		public $id;
		public $album_id;
		public $user_id;
		public $filename;
		public $thumbnail;
		public $filetype;
		public $position;
		public $next;
		public $previous;
		public $upload_date;
		public $caption;
		public $you_like;
		public $comments;

		protected $thumb_size = 194;
		protected static $pic_max_width = 960;

		public function get_next_picture () {
			$album = Album::find_by_id( $this->album_id );
			$album->load_pictures();

			for ( $i = 0;  $i < count( $album->pictures );  $i++ ) { 
				if ( $this->id == $album->pictures[ $i ]->id ) {
					return ( ++$i <= ( count( $album->pictures ) - 1 ) ) ? $album->pictures[ $i ] : $album->pictures[ 0 ];
				}
			}
		}

		public function get_previous_picture () {
			$album = Album::find_by_id( $this->album_id );
			$album->load_pictures();

			for ( $i = 0;  $i < count( $album->pictures );  $i++ ) { 
				if ( $this->id == $album->pictures[ $i ]->id ) {
					return ( --$i > 0 ) ? $album->pictures[ $i ] : $album->pictures[ count( $album->pictures ) - 1 ];
				}
			}
		}

		public function upload ( $img ) {
			global $session;

			$tmp_file = $img[ 'tmp_name' ];
			$target_file = $this->filename;
			$upload_dir = str_replace( '*id*', $session->user_id, USER_PERSONAL_SPACE_PICTURES );
			$target_file_fullpath = "{$upload_dir}/{$target_file}";

			$current_user = User::find_by_id( $session->user_id );
			$current_user->make_sure_ups_exists();

			if ( move_uploaded_file( $tmp_file, $target_file_fullpath ) ) {
				$this->thumbnail = self::crop( $target_file_fullpath, $this->thumb_size, $this->thumb_size );
				$this->save();

				self::resize( "UPS/{$this->user_id}/pictures/{$this->thumbnail}", $this->thumb_size, $this->thumb_size );
				self::resize( $target_file_fullpath );
			}
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

		public static function resize ( $picture, $new_width = null, $new_height = null ) {
			// Content type
			// header('Content-Type: image/jpeg');

			// Get new dimensions
			list( $width, $height ) = getimagesize( $picture );

			if ( $new_width === null && $new_height === null ) {
				if ( $width > self::$pic_max_width ) {
					$new_width = self::$pic_max_width;
					$new_height = $new_width * $height / $width;
				} else {
					$new_width = $width;
					$new_height = $height;
				}
			}

			// Resample
			$image_p = imagecreatetruecolor( $new_width, $new_height );
			$image = imagecreatefromjpeg( $picture );
			imagecopyresampled( $image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

			// Output
			imagejpeg($image_p, $picture, 100);
		}

		public function delete () {
			// delete physical video traces
			$picture_path = str_replace( '*id*', PROFILE_USER, USER_PERSONAL_SPACE_PICTURES )  . "/" . $this->filename;
			$picture_thumb_path = str_replace( '*id*', PROFILE_USER, USER_PERSONAL_SPACE_PICTURES ) . "/" . $this->thumbnail;

			( file_exists( $picture_path ) ) ? unlink( $picture_path ) : null;
			( file_exists( $picture_thumb_path ) ) ? unlink( $picture_thumb_path ) : null;

			// delete record about picture
			return parent::delete();
		}

		public static function name_picture ( $user ) {
			global $DB, $session;

			$sql = "SELECT `id` FROM `picture` WHERE `user_id` = {$session->user_id} ORDER BY `id` DESC LIMIT 1";

			$pictures = self::find_by_sql( $sql );

			$num = ( count( $pictures ) > 0 ) ? (int) $pictures[ 0 ]->id : 0;

			return ++$num . ".jpg";
		}
	}

?>