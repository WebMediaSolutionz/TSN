<div id="friends_widget" class="left widget">
	<?php
		$num = $profile_user->get_number_of_friends();
		$num_friends = $num !== 1 ? $lang[ 'number_of_friends' ] : $lang[ 'number_of_friend' ];
	?>
	<div class="widget_title">
		<h4 class="capitalize"><a href="friends.php"><?php echo str_replace("*#*", $num, $num_friends ) ?></a></h4>
	</div>
	<?php if ( count( $friends ) === 0 ) { ?>
		<p>you do not have any friends for the moment. perhaps you could browse our <a href='friends.php'>friends</a> section and look for some friends of you or meet a few interesting people.</p>
	<?php } else { ?>
		<?php
			foreach ( $friends as $user ) {
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
						<span class="subscript italics"><?php echo str_replace("*#*", $num, $num_friends ) ?></span>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		<?php
			}
		?>
	<?php } ?>
</div>