<?php

	class MySqlDatabase {

		public $last_query;
		private $connection;
		private $magic_quotes_active;
		private $real_escape_string_exists;

		function __construct() {
			$this->open_connection();
			$this->magic_quotes_active = get_magic_quotes_gpc();
			$this->real_escape_string_exists = function_exists( 'mysql_real_escape_string' );

		}

		public function open_connection () {
			$this->connection = new mysqli( DB_DOMAIN, DB_USERNAME, DB_PASSWORD, DB_DATABASE, 3306 );
	
			if ( $this->connection->connect_errno ) {
				echo "connection failed<br /><br />";
				exit;
			}
		}

		public function close_connection () {
			if ( isset( $this->connection ) ) {
				$this->connection->close();
				unset( $this->connection );
			}
		}

		public function query ( $sql ) {
			$this->last_query = $sql;
			$result = $this->connection->query( $sql );
			$this->confirm_query( $result );

			return $result;
		}

		private function confirm_query ( $result ) {
			global $environment;

			if ( !$result ) {
				$output = "database query failed: " . $this->connection->connect_error . "<br /><br />";

				if ( $environment != "live" ) {
					$output .= "Last SQL query: " . $this->last_query;
				}

				die ( $output );
			} 
		}

		public function escape_value ( $value ) {
			if ( $this->real_escape_string_exists ) { // PHP v.4.3.0 or higher
				// undo any magic quote effects so so mysql_real_escape_string can do the work
				if ( $this->magic_quotes_active ) {
					$value = stripslashes( $value );
				}

				$value = $this->connection->real_escape_string( $value );
			} else { // before PHP v4.3.0
				// if magic quotes aren't already on then add slashes manually
				if ( !$this->magic_quotes_active ) {
					$value = addslashes( $value );
				}
				// if magic quotes are active, then the slashes already exist
			}

			return $value;
		}

		// "database-neutral" methods
		public function fetch_array ( $result_set ) {
			return $result_set->fetch_assoc();
		}

		public function num_rows ( $result_set ) {
			return $result_set->num_rows;
		}

		public function insert_id () {
			// get the last id inserted over the current db connection
			return $this->connection->insert_id;
		}

		public function affected_rows () {
			return $this->connection->affected_rows;
		}
	}

	$DB = new MySqlDatabase();
?>