<?php if ( $current_user->is_friend( $profile_user ) || ( $profile_user->id === $current_user->id ) ) { ?>
	<div class="status_textarea">
		<form action="profile.php?profile_id=<?php echo $profile_user->id; ?>&action=post_to_wall" method="post">
			<textarea id="status_updater" name="value"></textarea>

			<input type="hidden" name="wall_id" value="<?php echo $profile_user->id; ?>" />
			<input type="hidden" name="author" value="<?php echo $current_user->id; ?>" />

			<br />

			<input id="post_to_wall" type="submit" name="submit" value="<?php echo $lang[ 'post_to_wall' ]; ?>" />
		</form>
	</div>
<?php } ?>

<div id="wall" class="left">
	<?php foreach( $posts as $post ) { ?>
		<?php include( "single_post_{$post->post_type}.tpl.php" ); ?>
	<?php } ?>
</div>