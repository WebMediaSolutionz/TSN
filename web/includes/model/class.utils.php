<?php
	
	class utils {
		public static function redirect_to ( $location ) {
			header("Location: {$location}");
			exit;
		}

		public static function strip_query_string ( $location ) {
			$needle = '&action';
			$needle = strpos( $location, $needle ) ? $needle : '?action'; 
			$location = explode( $needle, $location );
			$location = $location[ 0 ];

			self::redirect_to( $location );
		}

		public static function sendmail ( $user, $subject, $message, $support = false ) {
			$mail = new PHPMailer();

			if ( !$support ) {
				$mail->FromName = SITE_NAME;
				$mail->From = MAIL_USERNAME;

				if ( !is_string( $user ) ) {
					$mail->AddAddress( $user->username, $user->full_name() );
				} else {
					$mail->AddAddress( $user, $user );
				}
				
			} else {
				if ( !is_string( $user ) ) {
					$mail->FromName = $user->full_name();
					$mail->From = $user->username;
				} else {
					$mail->FromName = $user;
					$mail->From = $user;
				}

				$mail->AddAddress( SUPPORT_EMAIL, SITE_NAME );
			}

			$mail->IsSMTP();
			$mail->Host = MAIL_SERVER;
			$mail->Port = MAIL_PORT;
			$mail->SMTPAuth = true;
			$mail->Username = MAIL_USERNAME;
			$mail->Password = MAIL_PASSWORD;

			$mail->Subject = $subject;
			$mail->Body = $message;

			$mail->WordWrap = 50; 
			$mail->isHTML(true);  

			return $mail->Send();
		}

		public static function load_view ( $tpl ) {
			$tpl = "views/{$tpl}.tpl.php";

			include( $tpl );
		}

		public static function display_date ( $date ) {
			global $lang;
			
			return date( $lang['date_display'], strtotime( $date ) );
		}

		public static function mysql_datetime ( $date = null ) {
			return is_null( $date ) ? date( "Y-m-d H:i:s" ) : date( "Y-m-d H:i:s", strtotime( $date ) );
		}

		public static function upload_img ( $img ) {
			global $session;

			$tmp_file = $img[ 'tmp_name' ];
			$target_file = "profile.jpg";
			$upload_dir = str_replace( '*id*', $session->user_id, USER_PERSONAL_SPACE );

			$current_user = User::find_by_id( $session->user_id );
			$current_user->make_sure_ups_exists();

			return move_uploaded_file( $tmp_file, "{$upload_dir}/{$target_file}" );
		}

		public static function how_long_ago ( $time ) {
			global $lang;

			$time_ago = time() - strtotime( $time );

			$minute = 60;
			$hour = $minute * 60;
			$day = $hour * 24;
			$week = $day * 7;
			$month = $week * 4;

			if ( $time_ago >= $month ) {
				$time_ago = date("D F jS, Y", strtotime( $time ) );
			} else if ( $time_ago >= $day ) {
				$time_ago = $time_ago / $day;
				$time_ago = (int)$time_ago;
				$time_ago = str_replace('*days*', $time_ago, ( $time_ago > 1 ) ? $lang[ 'days_ago' ] : $lang[ 'day_ago' ] );
			} else if ( $time_ago >= $hour ) {
				$time_ago = $time_ago / $hour;
				$time_ago = (int)$time_ago;
				$time_ago = str_replace('*hours*', $time_ago, ( $time_ago > 1 ) ? $lang[ 'hours_ago' ] : $lang[ 'hour_ago' ] );
			} else if ( $time_ago >= $minute ) {
				$time_ago = $time_ago / $minute;
				$time_ago = (int)$time_ago;
				$time_ago = str_replace('*minutes*', $time_ago, ( $time_ago > 1 ) ? $lang[ 'minutes_ago' ] : $lang[ 'minute_ago' ] );
			}  else {
				$time_ago = $lang[ 'seconds_ago' ];
			}

			return $time_ago;
		}

		public static function current_page ( $style = null, $page = null ) {
			$page = ( $page === null ) ? $_SERVER[ 'PHP_SELF' ] : $page;
			$page_arr = explode( '/', $page );
			$page = $page_arr[ count( $page_arr ) - 1 ];

			if ( $style === 'short' ) {
				$page = explode( '.php', $page );
				$page = $page[ 0 ];
			}

			return $page;
		}

		public static function create_action_link ( $link, $action ) {
			return ( strpos( $link, '?' ) === false ) ? "{$link}?action={$action}" : "{$link}&action={$action}";
		}

		public static function randomize ( $arr ) {
			shuffle( $arr );

			return array_slice( $arr, 0, 3 );
		}
	}
?>