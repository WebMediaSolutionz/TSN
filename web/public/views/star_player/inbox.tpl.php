<?php 
	include_once( 'partials/header.tpl.php' );
?>
	<h2><?php echo $lang[ 'inbox' ]; ?></h2>
	<form action="inbox.php" method="post">
		<?php
			foreach ( $conversations as $conversation ) {
				$message = $conversation->get_last_message();
				$profile_img = "UPS/{$conversation->featured_participant->id}/profile.jpg";
				$profile_img = file_exists( $profile_img ) ? $profile_img : "images/{$theme}/default_profile_pic.jpg";
		?>
			<a class="listing block conversation" href="conversation.php?convo_id=<?php echo $conversation->id; ?>">
				<div class="left thumbnail block">
					<img src="<?php echo $profile_img; ?>" />
				</div>
				<div class="left small_gap">
					<div class="left"><?php echo $conversation->display_participants(); ?></div>
					<div class="clear"></div>
					<span class="gray_color"><?php echo $message->message; ?></span>
				</div>
				<div class="right"><span class="gray_color"><?php echo Utils::how_long_ago( $message->date ); ?></span></div>
				<div class="clear"></div>
			</a>
		<?php
			}
		?>
	</form>
<?php 
	include_once( 'partials/footer.tpl.php' );
?>