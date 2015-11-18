<?php
	class IndexCtrl extends ActionCtrl {
		public static function check_session () {
			global $session;

			if ( $session->is_logged_in() ) {
				redirect_to( 'home.php' );
			} else {
				redirect_to( 'login.php' );
			}
		}
	}
?>