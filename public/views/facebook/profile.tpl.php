<?php 
	include_once( 'header.tpl.php' );
?>

<div id="container">
	<div id="content">	
		<div>
			<h2 class="capitalize"><?php echo str_replace('*user*', $profile_user->full_name(), $lang[ 'users_profile_page' ] ); ?></h2>
			<div class="left">
				<div id="profile_image">
					<img src="<?php echo $profile_img; ?>" />
				</div>

				<br />

				<div class="actions">
					<a class="btn left" href="conversation.php?action=start_new_conversation&recipient=<?php echo $profile_user->id; ?>"><?php echo $lang[ 'send_message' ]; ?></a>
					<?php if ( $current_user->is_friend( $profile_user ) ) { ?>
						<a class="btn left small_gap" href="profile.php?profile_id=<?php echo $user->id; ?>&action=delete_friend&ex_friend=<?php echo $user->id; ?>"><?php echo $lang[ 'delete_friend' ]; ?></a>
					<?php } else if ( $current_user->is_leader( $profile_user ) ) { ?>
						<a class="btn left small_gap" href="profile.php?profile_id=<?php echo $user->id; ?>&action=cancel_friend_request&leader=<?php echo $user->id; ?>"><?php echo $lang[ 'cancel_friend_request' ]; ?></a>
					<?php } else if ( $current_user->is_follower( $profile_user ) ) { ?>
						<a class="btn left small_gap" href="profile.php?profile_id=<?php echo $user->id; ?>&action=delete_friend&ex_friend=<?php echo $user->id; ?>"><?php echo $lang[ 'deny' ]; ?></a>
						<a class="btn left margin-left" href="profile.php?profile_id=<?php echo $user->id; ?>&action=accept_friend_request&follower=<?php echo $user->id; ?>"><?php echo $lang[ 'accept' ]; ?></a>
					<?php } else { ?>
						<a class="btn left small_gap" href="profile.php?profile_id=<?php echo $user->id; ?>&action=send_friend_request&leader=<?php echo $user->id; ?>"><?php echo $lang[ 'make_friends' ]; ?></a>
					<?php } ?>
						<div class="clear"></div>
				</div>
			</div>

			<div class="right">
				<table>
					<?php foreach ( User::$db_fields as $field => $value ) { ?>
						<?php if ( $field != 'id' && $field != 'password' && $field != 'ip' && $field != 'verification_key' && $field != 'verified' && $profile_user->$field != '' && $profile_user->$field != '0' ) { ?>
							<tr>
								<?php include( 'partials/profile_info.tpl.php' ); ?>
							</tr>
						<?php } ?>
					<?php } ?>
				</table>
			</div>
			<div class="clear"></div>

			<div style="visibility: hidden;">
				<span>id: 19</span><br />
				<span>Name: <a href="profile.php?id=">mckenzy2</a></span><br />
				<span>email: the.max.mckenzy@gmail.com</span><br />
			</div>

			<?php include( 'partials/the_wall.tpl.php' ); ?>

			<?php include( 'partials/friend_widget.tpl.php' );?>

			<?php include( 'partials/picture_widget.tpl.php' );?>

			<div class="clear"></div>
		</div>			
	</div>
</div>

<?php 
	include_once( 'footer.tpl.php' );
?>