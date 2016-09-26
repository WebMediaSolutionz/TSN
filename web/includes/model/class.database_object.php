<?php

	class DatabaseObject {
		protected static $table_name;
		public static $db_fields;

		public static function find_all () {
			global $DB;

			return static::find_by_sql( "SELECT * FROM " . static::$table_name );
		}

		public static function find_by_id ( $id = 0 ) {
			global $DB;

			$result_array = static::find_by_sql( "SELECT * FROM " . static::$table_name . " WHERE id = {$id} LIMIT 1" );
			return !empty( $result_array ) ? array_shift( $result_array ): false;
		}

		public static function find_all_but ( $id = 0 ) {
			global $DB;

			return static::find_by_sql( "SELECT * FROM " . static::$table_name . " WHERE id != {$id}" );
		}

		public static function find_by_sql ( $sql = "" ) {
			global $DB;

			$result_set = $DB->query( $sql );

			$object_array = array();

			while ( $row = $DB->fetch_array( $result_set ) ) {
				$object_array[] = static::instantiate( $row );
			}
			return $object_array;
		}

		protected static function instantiate ( $record ) {
			$object = new static;

			foreach ($record as $attribute => $value) {
				if ( $object->has_attribute( $attribute ) ) {
					$object->$attribute = $value;
				}
			}

			return $object;
		}

		protected function has_attribute ( $attribute ) {
			$object_vars = $this->attributes();

			return array_key_exists($attribute, $object_vars);
		}

		protected function attributes () {
			$attributes = array();

			foreach ( static::$db_fields as $field => $type ) {
				if ( property_exists( $this, $field ) ) {
					$attributes[ $field ] = $this->$field;
				}
			}

			return $attributes;
		}

		protected function sanitized_attributes () {
			global $DB;

			$clean_attributes = array();

			foreach ( $this->attributes() as $key => $value ) {
				$clean_attributes[ $key ] = $DB->escape_value( $value );
			}

			return $clean_attributes;
		}

		public function create () {
			global $DB;

			$attributes = $this->sanitized_attributes();
			$att = array();
			$att_values_quotes = array();

			foreach ( static::$db_fields as $field => $type ) {
				if ( $type != 'auto-increment' ) {
					$att[ $field ] = $attributes[ $field ];
				}

				switch ( $type ) {
					case 'datetime'	:
					case 'string' 	:		$att_values_quotes[ $field ] = "'{$attributes[ $field ]}'";
											break;

					case 'int'		:		$att_values_quotes[ $field ] = (int) $attributes[ $field ];
											break;
				}
			}

			// if ( !static::exists( $this->username ) ) {
				$sql = "INSERT INTO " . static::$table_name . " (";
				$sql .= join( ", ", array_keys( $att ) );
				$sql .= ") VALUES (";
				$sql .= join( ", ", array_values( $att_values_quotes ) );
				$sql .= ")";

				if ( $DB->query( $sql ) ) {
					$this->id = $DB->insert_id();
					return true;
				} else {
					return false;
				}
			// } else {
			// 	return false;
			// }
		}

		protected function update () {
			global $DB;

			$attributes = $this->sanitized_attributes();
			$attribute_pairs = array();
			$att_values_quotes = array();

			foreach ( static::$db_fields as $field => $type ) {
				switch ( $type ) {
					case 'datetime'	:
					case 'string' 	:		$att_values_quotes[ $field ] = "'{$attributes[ $field ]}'";
											break;

					case 'int'		:		$att_values_quotes[ $field ] = (int) $attributes[ $field ];
											break;
				}
			}

			foreach( $att_values_quotes as $key => $value ) {
				$attribute_pairs[] = "`{$key}`={$value}";
			}

			$sql = "UPDATE  " . static::$table_name . " SET  ";
			$sql .= join( ", ", $attribute_pairs );
			$sql .= " WHERE id=" . $DB->escape_value( $this->id );

			$DB->query( $sql );
			
			return ( $DB->affected_rows() == 1 );
		}

		public function save () {
			return isset( $this->id ) ? $this->update() : $this->create();
		}

		public function delete () {
			global $DB;

			$sql = "DELETE FROM " . static::$table_name . " ";
			$sql .= "WHERE id=" . $DB->escape_value( $this->id ) . " ";
			$sql .= "LIMIT 1";

			$DB->query( $sql );
			
			return ( $DB->affected_rows() == 1 );
		}

		public static function exists ( $thing ) {
			return false;
		}
	}

?>