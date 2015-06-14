<?php
	$user = User::find_by_id( $notification->action_initiator_user_id );
	$other_user = User::find_by_id( $notification->item_owner_user_id );
	$notification_string = null;

	switch( $notification->type ) {
		case 'liked'		:	$notification_string = "<a href='profile.php?profile_id=*user_id*'>*user_name*</a> likes your photo";
								break;

		case 'commented'	:	$notification_string = "<a href='profile.php?profile_id=*user_id*'>*user_name*</a> commented on your photo";
								break;
	}
?>

<div class="notification">
	<a id="profile_pic_thumbnail" class="left block" href="profile.php?profile_id=<?php echo $user->id; ?>">
		<img src="..." />
	</a>
	<div class="left left_part">
		<div>
			<div>
				<span><?php echo  str_replace( '*user_name*', $user->full_name(), str_replace( '*user_id*', $user->id, $notification_string ) ); ?></span>
			</div>
			<span class="automated_post"><?php echo Utils::how_long_ago( $notification->date ); ?></span>
		</div>
	</div>
	<div class="clear"></div>
</div>