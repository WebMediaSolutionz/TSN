<?php 
	include_once( 'header.tpl.php' );
?>
	<h2><?php echo $lang[ 'find_friends' ]; ?></h2>
<?php
	$count = 0;

	foreach ( $users as $other_users ) {
		$section_title = ( $count === 0 ) ? $lang[ "your_friends" ] : $lang[ "other_users" ];
?>
	<h3 class="capitalize"><?php echo $section_title; ?></h3>
<?php
		foreach ( $other_users as $user ) {
?>
			<div class="listing user">
				<div class="identidy left">
					<a class="block thumbnail left" href="profile.php?profile_id=<?php echo $user->id; ?>">
						<?php $profile_img = "UPS/{$user->id}/profile.jpg"; ?>
						<img src="<?php echo file_exists( $profile_img ) ? $profile_img : "images/default_profile_pic.jpg"; ?>" />
					</a>
					<div class="name capitalize left">
						<a href="profile.php?profile_id=<?php echo $user->id; ?>"><?php echo $user->full_name(); ?></a><br />
						<span class="subscript italics"><?php echo $user->location(); ?></span><br /><br />
						<?php
							$num = $user->get_number_of_friends();
							$num_friends = $num !== 1 ? $lang[ 'number_of_friends' ] : $lang[ 'number_of_friend' ];
						?>
						<span class="subscript italics"><?php echo str_replace("*#*", $num, $num_friends ) ?></span>
					</div>
					<div class="clear"></div>
				</div>
				<div class="right">
					<div class="actions">
						<a class="btn left" href="conversation.php?action=start_new_conversation&recipient=<?php echo $user->id; ?>"><?php echo $lang[ 'send_message' ]; ?></a>
						<?php if ( $current_user->is_friend( $user ) ) { ?>
							<a class="btn left small_gap" href="friends.php?action=delete_friend&ex_friend=<?php echo $user->id; ?>"><?php echo $lang[ 'delete_friend' ]; ?></a>
						<?php } else if ( $current_user->is_leader( $user ) ) { ?>
							<a class="btn left small_gap" href="friends.php?action=cancel_friend_request&leader=<?php echo $user->id; ?>"><?php echo $lang[ 'cancel_friend_request' ]; ?></a>
						<?php } else if ( $current_user->is_follower( $user ) ) { ?>
							<a class="btn left small_gap" href="friends.php?action=delete_friend&ex_friend=<?php echo $user->id; ?>"><?php echo $lang[ 'deny' ]; ?></a>
							<a class="btn left margin-left" href="friends.php?action=accept_friend_request&follower=<?php echo $user->id; ?>"><?php echo $lang[ 'accept' ]; ?></a>
							<div class="clear"></div>
						<?php } else { ?>
							<a class="btn left small_gap" href="friends.php?action=send_friend_request&leader=<?php echo $user->id; ?>"><?php echo $lang[ 'make_friends' ]; ?></a>
							<div class="clear"></div>
						<?php } ?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
<?php
		}

		$count++;
	}

	include_once( 'footer.tpl.php' );
?>