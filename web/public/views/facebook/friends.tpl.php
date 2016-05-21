<?php 
	include_once( 'partials/header.tpl.php' );
?>
	<h2><?php echo $lang[ 'find_friends' ]; ?></h2>
<?php
	$count = 0;

	foreach ( $users as $other_users ) {
		switch ( $count ) {
			case 0 : 	$section_title = $lang[ "your_friends" ];
						break;

			case 1 : 	$section_title = $lang[ "your_followers" ];
						break;

			case 2 : 	$section_title = $lang[ "your_leaders" ];
						break;
		}
?>
	<h3 class="capitalize"><?php echo $section_title; ?></h3>
<?php
		foreach ( $other_users as $user ) {
			include( 'partials/user_id.php' );
		}

		$count++;
	}

?>
	<h3 class="capitalize">Search by email</h3>

	<form action="friends.php" method="post">
		<label>email</label>
		<input type="text" name="username" maxlength="30" />
		<input type="submit" name="submit" value="search" />
	</form>

	<br />

<?php
	if ( $found ) {
		$user = $searched;

		include( 'partials/user_id.php' );
	} else if ( isset( $_POST[ 'submit' ] ) ) {
?>
	<span>the email <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a> does not match any of the users currently in this network. do you want to send that person an invitation to join the network?</span>

	<a href="friends.php?action=send_invitation&email=<?php echo $email; ?>&user_id=<?php echo $current_user->id; ?>">yes</a>
	<a href="friends.php">No</a>
<?php
	}

	include_once( 'partials/footer.tpl.php' );
?>