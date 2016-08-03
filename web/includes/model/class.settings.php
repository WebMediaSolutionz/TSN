<?php
	class Settings extends DatabaseObject {
		protected static $table_name = "settings";
		public static $db_fields = array(
			'user_id'				=> 		'int',
			'theme_id'				=> 		'int',
			'theme' 				=> 		'auto-increment', 
			'language' 				=> 		'string',
			'email_notifications'	=>		'bool'
			);
		public $user_id;
		public $theme_id;
		public $theme;
		public $language;
		public $email_notifications;
		public static function get_settings_for ( $user_id ) {
			$sql = "SELECT s.`user_id`, s.`theme_id`, t.`name` AS `theme`, s.`language`, s.`email_notifications` FROM `" . static::$table_name . "` AS s LEFT JOIN `themes` AS t ON s.`theme_id` = t.`id` WHERE s.`user_id` = {$user_id}";
			$settings_arr = static::find_by_sql( $sql );
			return array_shift( $settings_arr );
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
					case 'string' 	:		$att_values_quotes[ $field ] = "'{$attributes[ $field ]}'";
											break;
					case 'bool'		:
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
		}
		public function update () {
			global $DB;
			$attributes = $this->sanitized_attributes();
			$attribute_pairs = array();
			$att_values_quotes = array();
			foreach ( static::$db_fields as $field => $type ) {
				switch ( $type ) {
					case 'string' 	:		$att_values_quotes[ $field ] = "'{$attributes[ $field ]}'";
											break;
					case 'bool'		:
					case 'int'		:		$att_values_quotes[ $field ] = (int) $attributes[ $field ];
											break;
				}
			}
			foreach( $att_values_quotes as $key => $value ) {
				$attribute_pairs[] = "{$key}={$value}";
			}
			$sql = "UPDATE  " . static::$table_name . " SET  ";
			$sql .= join( ", ", $attribute_pairs );
			$sql .= " WHERE user_id=" . $DB->escape_value( $this->user_id );
			$DB->query( $sql );
			
			return ( $DB->affected_rows() == 1 );
		}
	}
?>