<?php 
	include_once( 'partials/header.tpl.php' );
?>

<?php
	foreach ( $conversation->messages as $message ) {
		include( "partials/single_message.tpl.php" );
	}
?>
	<form action="conversation.php?convo_id=<?php echo $conversation->id; ?>&action=send_message" method="post">
		<textarea id="write_message" name="message"></textarea>
		<input type="hidden" name="convo_id" value="<?php echo $conversation->id; ?>" />

		<br />

		<input id="post_to_wall" type="submit" name="submit" value="<?php echo $lang[ 'send_message' ]; ?>" />
	</form>
<?php 
	include_once( 'partials/footer.tpl.php' );
?>