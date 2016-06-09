<?php 
	include_once( 'partials/header.tpl.php' );
?>

<h1>SUPPORT</h1>

<?php if ( !$message_sent ) { ?>
	<form action="<?php echo $_SERVER[ 'PHP_SELF' ]; ?>" method="post">
		<table>
			<tr>
				<td>
					<label>subject</label>
				</td>
				<td>
					<input type="text" name="subject" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Message</label>
				</td>
				<td>
					<textarea name="message"></textarea>
				</td>
			</tr>
		</table>

		<input type="submit" name="submit" value="send">
	</form>
<?php } else { ?>
	<h4>message sent</h4>
<?php } ?>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>