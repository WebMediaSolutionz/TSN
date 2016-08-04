<?php 
	include_once( 'partials/header.tpl.php' );
?>
	<h2>Users</h2>
<?php

	foreach ( $users as $other_users ) {
		foreach ( $other_users as $user ) {
?>
			<div class="listing user">
				<div class="identidy left">
					<a class="block thumbnail left" href="profile.php?profile_id=<?php echo $user->id; ?>">
						<?php $profile_img = "UPS/{$user->id}/profile.jpg"; ?>
						<img src="<?php echo file_exists( $profile_img ) ? $profile_img : "images/{$theme}/default_profile_pic.jpg"; ?>" />
					</a>
					<div class="name capitalize left">
						<a href="profile.php?profile_id=<?php echo $user->id; ?>"><?php echo $user->full_name(); ?></a><br />
						<span class="subscript italics"><?php echo $user->location(); ?></span><br /><br />
						<?php
							$num = $user->get_number_of_friends();
							$num_friends = $num !== 1 ? $lang[ 'number_of_friends' ] : $lang[ 'number_of_friend' ];
						?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="right">
					<div class="balance">
						<span><?php echo $user->balance; ?>$</span>
					</div>
					<div class="actions">
						
					</div>
				</div>
				<div class="clear"></div>
			</div>
<?php
		}
	}

	include_once( 'partials/footer.tpl.php' );
?>