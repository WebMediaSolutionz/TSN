<div class="actions">
	<?php if ( $user->is_friend() ) { ?>
		<a class="btn" href="friends.php?action=delete_friend&ex_friend=<?php echo $user->id; ?>"><?php echo $lang[ 'delete_friend' ]; ?></a>
	<?php } else if ( $user->is_leader() ) { ?>
		<a class="btn" href="friends.php?action=cancel_friend_request&leader=<?php echo $user->id; ?>"><?php echo $lang[ 'cancel_friend_request' ]; ?></a>
	<?php } else if ( $user->is_follower() ) { ?>
		<a class="btn left" href="friends.php?action=delete_friend&ex_friend=<?php echo $user->id; ?>"><?php echo $lang[ 'deny' ]; ?></a>
		<a class="btn left margin-left" href="friends.php?action=accept_friend_request&follower=<?php echo $user->id; ?>"><?php echo $lang[ 'accept' ]; ?></a>
		<div class="clear"></div>
	<?php } else { ?>
		<a class="btn" href="friends.php?action=send_friend_request&leader=<?php echo $user->id; ?>"><?php echo $lang[ 'make_friends' ]; ?></a>
	<?php } ?>
</div>