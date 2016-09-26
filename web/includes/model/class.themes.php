<?php

	class Themes extends DatabaseObject {
		protected static $table_name = "themes";
		public static $db_fields = array(
			'id'			=> 		'auto-increment',
			'name' 			=> 		'string',
			'description' 	=> 		'string'
			);
		public $id;
		public $name;
		public $description;

		public static function get_id_for_theme ( $theme = DEFAULT_THEME ) {
			global $DB;

			$result = null;
			$theme = $DB->escape_value( $theme );

			$sql = "SELECT * FROM " . self::$table_name . " ";
			$sql .= "WHERE name = '{$theme}' ";
			$sql .= "LIMIT 1";

			$result_array = self::find_by_sql( $sql );

			if ( !empty( $result_array ) ) {
				$result = array_shift( $result_array );

				return $result->id;
			}

			return false;
		}

		public static function get_theme_for_id ( $id ) {
			global $DB;

			$result = null;
			$theme = $DB->escape_value( $id );

			$sql = "SELECT * FROM " . self::$table_name . " ";
			$sql .= "WHERE id = {$id} ";
			$sql .= "LIMIT 1";

			$result_array = self::find_by_sql( $sql );

			if ( !empty( $result_array ) ) {
				$result = array_shift( $result_array );

				return $result->theme;
			}

			return false;
		}
	}

?>