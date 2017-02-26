<?php
	class DashboardCtrl extends ActionCtrl {
		public static function load () {
			global $session, $lang, $page_title, $current_page;

			$theme = static::$theme;

			$current_user = User::find_by_id( $session->user_id );
			$current_page = static::$current_page;
			$current_page_short = static::$current_page_short;

			if ( defined( 'PROFILE_USER' ) ) {
				$profile_user = User::find_by_id( PROFILE_USER );

				if ( $current_user->id !== $profile_user->id ) {
					Utils::redirect_to( 'filenotfound.php' );
				}
			}

			if ( isset( $session->user_id ) ) {
				$current_user = User::find_by_id( $session->user_id );
			}

			include_once( static::load_template() );
		}

		public static function update_site_info () {
			global $session;

			if ( isset( $_POST[ 'submit' ] ) && $_POST[ 'submit' ] === 'submit' ) {
				if ( isset( $_FILES[ 'banner' ] ) ) {
					$picture = new picture;

					$picture->user_id = $session->user_id;
					$picture->filename = Picture::name_picture( 'site_banner' );
					$picture->upload_date = Utils::mysql_datetime();

					$picture->save();
					$picture->upload( $_FILES[ 'banner' ], false );
				}

				if ( isset( $_FILES[ 'banner_sfw' ] ) ) {
					$picture = new picture;

					$picture->user_id = $session->user_id;
					$picture->filename = Picture::name_picture( 'site_banner_sfw' );
					$picture->upload_date = Utils::mysql_datetime();

					$picture->save();
					$picture->upload( $_FILES[ 'banner_sfw' ], false );
				}
			}

			Utils::redirect_to( 'dashboard.php' );
		}
	}
?>