<?php

	class User extends DatabaseObject {
		protected static $table_name = "users";
		public static $db_fields = array(
			'id'				=> 'auto-increment',
			'name' 				=> 'string', 
			'lastname' 			=> 'string', 
			'middlename' 		=> 'string', 
			'sex' 				=> 'string', 
			'birthdate' 		=> 'datetime', 
			'username' 			=> 'string', 
			'password' 			=> 'string', 
			'ip' 				=> 'string', 
			'address' 			=> 'string', 
			'city' 				=> 'string',
			'province' 			=> 'string',
			'state' 			=> 'string', 
			'country' 			=> 'string', 
			'zipcode' 			=> 'string', 
			'relationship' 		=> 'string', 
			'interested_in' 	=> 'string', 
			'school' 			=> 'string', 
			'major' 			=> 'string', 
			'level' 			=> 'string', 
			'work' 				=> 'string', 
			'position' 			=> 'string', 
			'occupation' 		=> 'string', 
			'interests' 		=> 'string', 
			'verification_key' 	=> 'string',
			'verified'			=>	'int'
			);
		public $id;
		public $name;
		public $lastname;
		public $middlename;
		public $sex;
		public $birthdate;
		public $username;
		public $password;
		public $ip;
		public $address;
		public $city;
		public $province;
		public $state;
		public $country;
		public $zipcode;
		public $relationship;
		public $interested_in;
		public $school;
		public $major;
		public $level;
		public $work;
		public $position;
		public $occupation;
		public $interests; 
		public $verification_key;
		public $verified;

		public static function find_verified_by_id ( $id = 0 ) {
			global $DB;

			$result_array = static::find_by_sql( "SELECT * FROM " . static::$table_name . " WHERE id = {$id} AND verified = 1 LIMIT 1" );
			return !empty( $result_array ) ? array_shift( $result_array ): false;
		}

		public static function find_all_verified_but ( $id = 0 ) {
			global $DB;

			return static::find_by_sql( "SELECT * FROM " . static::$table_name . " WHERE id != {$id} AND verified = 1" );
		}

		public static function authenticate ( $username = "", $password = "" ) {
			global $DB;

			$username = $DB->escape_value( $username );
			$password = $DB->escape_value( $password );

			$sql = "SELECT * FROM " . self::$table_name . " ";
			$sql .= "WHERE username = '{$username}' ";
			$sql .= "AND password = '{$password}' ";
			$sql .= "AND verified = 1 ";
			$sql .= "LIMIT 1";

			$result_array = self::find_by_sql( $sql );

			return !empty( $result_array ) ? array_shift( $result_array ) : false;
		}

		public static function activate ( $verification_key ) {
			$user = static::verify_user( $verification_key );

			if ( !is_null( $user ) ) {
				$user->verified = true;
				$user->verification_key = '';
				$user->update();
				$user->prep_account();

				return true;
			}

			return false;
		}

		public function deactivate () {
			$this->verified = false;
			$this->verification_key = '';
			$this->update();

			return true;
		}

		public static function update_password ( $user_id, $password ) {
			$user = static::find_by_id( $user_id );

			if ( !is_null( $user ) ) {
				$user->password = $password;
				$user->verification_key = "";

				$user->save();

				return true;
			}

			return false;
		}

		public static function exists ( $username ) {
			global $DB;

			$username = $DB->escape_value( $username );

			$sql = "SELECT * FROM " . self::$table_name . " ";
			$sql .= "WHERE username = '{$username}' ";
			$sql .= "LIMIT 1";

			$result_array = self::find_by_sql( $sql );

			return !empty( $result_array );
		}

		public static function identify ( $username ) {
			if ( static::exists( $username ) ) {
				global $DB;

				$username = $DB->escape_value( $username );

				$sql = "SELECT * FROM " . self::$table_name . " ";
				$sql .= "WHERE username = '{$username}' ";
				$sql .= "LIMIT 1";

				$result_array = self::find_by_sql( $sql );

				return !empty( $result_array ) ? array_shift( $result_array ) : false;
			}

			return null;
		}

		protected function prep_account () {
			global $session;

			$this->make_sure_ups_exists();

			$session->settings = new Settings;

			$session->settings->user_id = $this->id;
			$session->settings->theme_id = Themes::get_id_for_theme();
			$session->settings->language = "en";
			$session->settings->create();

			$this->create_friend_list();

			if ( defined( 'PROFILE_USER' ) ) {
				$this->send_friend_request( PROFILE_USER );
			}
		}

		public function make_sure_ups_exists () {
			$users_ups = str_replace( '*id*', $this->id, USER_PERSONAL_SPACE );

			if ( !file_exists( $users_ups ) ) {
				if ( !mkdir( $users_ups ) ) {
					exit( "error: couldn't create directory" );
				} else {
					mkdir( $users_ups . "/pictures" );
					mkdir( $users_ups . "/videos" );
					mkdir( $users_ups . "/tracks" );
				}
			}
		}

		public function delete_account ( $delete_level = 1 ) {
			global $session, $DB;

			if ( $delete_level === 2 ) {
				$ups = str_replace( '*id*', $this->id, USER_PERSONAL_SPACE );

				if (is_dir( $ups )) {
				    rmdir( $ups );
				}

				$this->delete();
			} else if ( $delete_level === 1 ) {
				$this->deactivate();
			}

			$session->logout();
		}

		public static function verify_user ( $verification_key = "" ) {
			global $DB;

			$key = $DB->escape_value( $verification_key );

			$sql = "SELECT * FROM " . self::$table_name . " ";
			$sql .= "WHERE verification_key = '{$key}' ";
			$sql .= "LIMIT 1";

			$result_array = static::find_by_sql( $sql );

			return !empty( $result_array ) ? array_shift( $result_array ) : null;
		}

		public function full_name () {
			if ( isset( $this->name ) && isset( $this->lastname ) ) {
				return $this->name . " " . $this->lastname;
			}

			return "";
		}

		public function location () {
			global $lang;

			$location = "";

			if ( ( $this->city !== 0 && $this->city !== "" ) && ( ( $this->province !== 0 && $this->province !== "" ) || ( $this->state !== 0 && $this->state !== "" ) ) ) {
				
				$prov_state = "";
				$state_or_prov = "";

				$prov_state = ( ( $this->province !== 0 ) ) ? $this->province : $this->state;

				$location = "{$this->city}, " . ucfirst( strtolower( $prov_state ) );
			}

			if ( ( $this->country !== 0 && $this->country !== "" ) && ( $location !== "" ) ) {
				$location .= ", " . $lang[ 'lbl_country_arr' ][ $this->country ];
			}

			return $location;
		}

		public function generate_verification_key () {
			$this->verification_key = sha1( mt_rand( 10000, 99999 ) . time() . $this->username );
		}

		public function get_friend_list_id ( $friendlist = 'default' ) {
			global $DB;

			$object_array = array();
			$friendlist = $DB->escape_value( $friendlist );

			$sql = "SELECT id FROM friend_lists WHERE name = '{$friendlist}' AND user_id = {$this->id} LIMIT 1";
			$result_set = $DB->query( $sql );

			$row = $DB->fetch_array( $result_set );

			return (int) $row[ 'id' ];
		}

		public function get_friends ( $friendlist = 'default' ) {
			global $DB;

			$object_array = array();
			$friendlist = $DB->escape_value( $friendlist );

			$sql = "SELECT * FROM users WHERE id IN ( SELECT user_id FROM friend_lists_users WHERE friend_list_id = ( SELECT id FROM friend_lists WHERE name = '{$friendlist}' AND user_id = {$this->id} LIMIT 1 ))";

			$result_set = $DB->query( $sql );

			while ( $row = $DB->fetch_array( $result_set ) ) {

				$user = static::instantiate( $row );

				if ( $this->is_follower( $user ) ) {
					$object_array[] = $user;
				}
			}

			return $object_array;
		}

		public function get_leaders ( $friendlist = 'default' ) {
			global $DB;

			$object_array = array();
			$friendlist = $DB->escape_value( $friendlist );

			$sql = "SELECT * FROM users WHERE id IN ( SELECT user_id FROM friend_lists_users WHERE friend_list_id = ( SELECT id FROM friend_lists WHERE name = '{$friendlist}' AND user_id = {$this->id} LIMIT 1 ))";

			$result_set = $DB->query( $sql );

			while ( $row = $DB->fetch_array( $result_set ) ) {
				$user = static::instantiate( $row );

				if ( !$this->is_friend( $user ) ) {
					$object_array[] = $user;
				}
			}

			return $object_array;
		}

		public function get_followers ( $friendlist = 'default' ) {
			global $DB;

			$object_array = array();
			$friendlist = $DB->escape_value( $friendlist );

			$sql = "SELECT * FROM users WHERE id IN ( SELECT user_id FROM friend_lists WHERE id IN ( SELECT friend_list_id FROM `friend_lists_users` WHERE user_id = {$this->id} ));";

			$result_set = $DB->query( $sql );

			while ( $row = $DB->fetch_array( $result_set ) ) {
				$user = static::instantiate( $row );

				if ( !$this->is_friend( $user ) ) {
					$object_array[] = $user;
				}
			}

			return $object_array;
		}

		public function get_strangers () {
			$users = static::find_all_verified_but( $this->id );
			$strangers = array();

			foreach ( $users as $user ) {
				if ( !$this->is_friend( $user ) && !$this->is_leader( $user ) && !$this->is_follower( $user ) ) {
					$strangers[] = $user;
				}
			}

			return $strangers;
		}

		public function get_number_of_friends ( $friendlist = 'default' ) {
			return count( $this->get_friends( $friendlist ) );
		}

		public function send_friend_request ( $leader_user_id ) {
			global $DB;

			$user = User::find_by_id( $leader_user_id );			

			if ( !$this->is_leader( $user ) ) {
				$friend_list_id = $this->get_friend_list_id();
				$leader_user_id = $DB->escape_value( $leader_user_id );

				$sql = "INSERT INTO friend_lists_users (friend_list_id, user_id) VALUES ({$friend_list_id}, {$leader_user_id})";

				$DB->query( $sql );
			}
		}

		public function accept_friend_request ( $follower_user_id ) {
			$post1 = new Post;
			$post2 = new Post;

			$post1->new_friendship_was_created( $this->id, $follower_user_id );	
			$post2->new_friendship_was_created( $follower_user_id, $this->id );		

			$this->send_friend_request( $follower_user_id );
		}

		public function deny_friend_request ( $follower_user_id ) {
			$this->cancel_friend_request( $follower_user_id );
		}

		public function cancel_friend_request ( $leader_user_id ) {
			global $DB;

			$friend_list_id = $this->get_friend_list_id();
			$leader_user_id = $DB->escape_value( $leader_user_id );

			$sql = "DELETE FROM friend_lists_users WHERE friend_list_id = {$friend_list_id} AND user_id = {$leader_user_id}";

			$DB->query( $sql );
		}

		public function is_leader ( $user ) {
			global $DB;

			$friend_list_id = $this->get_friend_list_id();

			$sql = "SELECT count(*) AS leader FROM friend_lists_users WHERE friend_list_id = {$friend_list_id} AND user_id = {$user->id} LIMIT 1";

			$result_set = $DB->query( $sql );

			$row = $DB->fetch_array( $result_set );

			return ( $row[ 'leader' ] == 1 );
		}

		public function is_follower ( $user ) {
			global $DB;

			$follower_friend_list_id = $user->get_friend_list_id();

			$sql = "SELECT count(*) AS follower FROM friend_lists_users WHERE friend_list_id = {$follower_friend_list_id} AND user_id = {$this->id} LIMIT 1";
			$result_set = $DB->query( $sql );

			$row = $DB->fetch_array( $result_set );

			return ( $row[ 'follower' ] == 1 );
		}

		public function is_friend ( $user ) {
			return ( $this->is_leader( $user ) && $user->is_leader( $this ) );
		}

		public static function delete_friend ( $friend_user_id) {
			global $DB, $session;

			$current_user = self::find_by_id( $session->user_id );
			$ex_friend = self::find_by_id( $friend_user_id );

			$current_user_friend_list_id = $current_user->get_friend_list_id();
			$ex_friend_friend_list_id = $ex_friend->get_friend_list_id();

			$sql1 = "DELETE FROM friend_lists_users WHERE friend_list_id = {$current_user_friend_list_id} AND user_id = {$ex_friend->id} LIMIT 1";
			$sql2 = "DELETE FROM friend_lists_users WHERE friend_list_id = {$ex_friend_friend_list_id} AND user_id = {$current_user->id} LIMIT 1";

			$DB->query( $sql1 );
			$DB->query( $sql2 );
		}

		public function create_friend_list ( $friendlist = "default" ) {
			global $DB;

			$friendlist = $DB->escape_value( $friendlist );

			$sql = "INSERT INTO friend_lists (name, user_id) VALUES ('{$friendlist}', {$this->id})";

			$DB->query( $sql );
		}

		public function get_wall_posts () {
			global $DB;

			$sql = "SELECT * FROM posts WHERE wall_id = {$this->id} ORDER BY post_date DESC";

			$result_set = $DB->query( $sql );

			$object_array = array();

			while ( $row = $DB->fetch_array( $result_set ) ) {
				$post = Post::instantiate( $row );

				switch ( $post->post_type ) {
					case '5' 	:		$post->shared_post = Post::find_by_id( $post->post_id );
										break;

					case '7'	:		$post->shared_post = Picture::find_by_id( $post->picture_id );
										break;
				}

				$object_array[] = $post;
			}

			return $object_array;			
		}

		public function get_newsfeed_posts () {
			global $DB;

			$sql = "SELECT * FROM posts WHERE post_type IN ( 3, 5, 6, 7 ) AND ( wall_id IN ( SELECT user_id FROM friend_lists_users WHERE friend_list_id = ( SELECT id FROM friend_lists WHERE name = 'default' AND user_id = {$this->id} LIMIT 1 )) OR wall_id = {$this->id} ) ORDER BY post_date DESC";

			$result_set = $DB->query( $sql );

			$object_array = array();

			while ( $row = $DB->fetch_array( $result_set ) ) {
				$post = Post::instantiate( $row );

				switch ( $post->post_type ) {
					case '5' 	:		$post->shared_post = Post::find_by_id( $post->post_id );
										break;

					case '7'	:		$post->shared_post = Picture::find_by_id( $post->picture_id );
										break;
				}

				$object_array[] = $post;
			}

			return $object_array;			
		}
	}

?>