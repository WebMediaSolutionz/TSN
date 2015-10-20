<?php
	$user = User::find_by_id( $notification->action_initiator_user_id );
	$other_user = User::find_by_id( $notification->item_owner_user_id );
	$notification_string = null;
	$third_party = ( $other_user->id === $current_user->id );
	$item_type = ( ( strtolower( get_class( $notification->item ) ) ) == 'comments' ) ? 'comment' : ( strtolower( get_class( $notification->item ) ) );
	$item_id = $notification->item->id;

	$thing_type = $item_type;
	$thing_id = $item_id;

	switch( $notification->type ) {
		case 'liked'		:	$notification_string = ( $third_party  ) ? "<strong>*user_name*</strong> likes your <strong>*item_type*</strong>" : "<strong>*user_name*</strong> likes <strong>*other_user_name*</strong>'s' <strong>*item_type*</strong>";
								break;

		case 'commented'	:	$notification_string = ( $third_party  ) ? "<strong>*user_name*</strong> commented on your <strong>*item_type*</strong>" : "<strong>*user_name*</strong> commented on <strong>*other_user_name*</strong>'s' <strong>*item_type*</strong>";
								break;
	}

	if ( $item_type == 'comment' || $item_type === 'post' ) {
		$value = ( strlen( $notification->item->value ) >= 100 ) ? substr( $notification->item->value, 0, 97 ) . "..." : $notification->item->value;
		$notification_string .= " :\"{$value}\"";
	}

	if ( $item_type == 'comment' ) {
		$thing = null;
		
		if ( $notification->item->post_id ) {
			$thing = Post::find_by_id( $notification->item->post_id );
		} else if ( $notification->item->picture_id ) {
			$thing = Picture::find_by_id( $notification->item->picture_id );
		} else if ( $notification->item->album_id ) {
			$thing = Album::find_by_id( $notification->item->album_id );
		} else if ( $notification->item->video_id ) {
			$thing = Video::find_by_id( $notification->item->video_id );
		} else if ( $notification->item->track_id ) {
			$thing = Track::find_by_id( $notification->item->track_id );
		}

		$thing_owner = User::find_by_id( $thing->user_id );

		$notification_string .= ( $third_party ) ? " on his " . strtolower( get_class( $thing ) ) : " on <strong>" . $thing_owner->full_name() . "</strong>'s " . strtolower( get_class( $thing ) );

		$thing_type = strtolower( get_class( $thing ) );
		$thing_id = $thing->id;
	}
?>

<a href="<?php echo "{$thing_type}.php?item_id={$thing_id}"; ?>" class="notification<?php echo $notification->read ? "" : " unread"; ?>">
	<div id="profile_pic_thumbnail" class="left block">
		<img src="..." />
	</div>
	<div class="left left_part">
		<div>
			<span><?php echo  str_replace( '*item_id*', $notification->item->id, str_replace( '*item_type*', $item_type, str_replace( '*other_user_name*', $other_user->full_name(), str_replace( '*other_user_id*', $other_user->id, str_replace( '*user_name*', $user->full_name(), str_replace( '*user_id*', $user->id, $notification_string ) ) ) ) ) ); ?></span>
		</div>
		<span class="automated_post subscript"><?php echo Utils::how_long_ago( $notification->date ); ?></span>
	</div>
	<div class="right actions">
		<!-- <a class="<?php echo $notification->read ? "read": "unread"; ?>" href="notifications.php?action=mark_notification_as&notification_id=<?php echo $notification->id; ?>&status=<?php echo $notification->read ? "unread": "read"; ?>">
			<span><?php echo $notification->read ? "mark as unread": "mark as read"; ?></span>
		</a> -->
	</div>
	<div class="clear"></div>
</a>