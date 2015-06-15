<?php

	class Item extends DatabaseObject {
		public function get_likers () {
			global $session;

			return $likers = Likes::likers( $this );
		}

		public function get_commenters () {
			global $session;

			return $commenters = Comments::commenters( $this );
		}

		public function get_stakeholders () {
			global $session;

			$stakeholders = $likers = Likes::likers( $this, $session->user_id );
			$commenters = Comments::commenters( $this, $session->user_id );

			$found = false;

			foreach ( $commenters as $commenter ) {
				foreach ( $stakeholders as $stakeholder ) {
					if ( $commenter->user_id === $stakeholder->user_id ) {
						$found = true;
					}
				}

				if ( !$found ) {
					$stakeholders[] = $commenter;
				}
			}

			if ( $session->user_id != $this->user_id ) {
				$user = User::find_by_id( $this->user_id );
				$stakeholders[] = $user;
			}
			
			return $stakeholders;
		}
	}

?>