<?php 
	include_once( 'partials/header.tpl.php' );
?>
	
	<form action="<?php echo static::$action_share_link; ?>&post_id=<?php echo $post->id; ?>" method="post">
		<input type="hidden" name="redirect_destination" value="<?php echo $redirect_destination; ?>" />
		<select class="destination" name="destination">
			<option value="<?php echo $current_user->id; ?>">on your own wall</option>
			<!-- <option value="">on my friends wall</option> -->
		</select>
		<textarea id="status_updater" name="value"></textarea>
		<?php include( 'partials/simplified_post.tpl.php' ); ?>
		<input class="block right left_gap" type="submit" name="submit" value="Share">
		<a class="block right" href="<?php echo $redirect_destination; ?>">cancel</a>
		<div class="clear"></div>
	</form>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>