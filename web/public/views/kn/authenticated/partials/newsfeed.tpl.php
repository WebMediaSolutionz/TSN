<?php if ( $session->permission === 'performer' ) { ?>
	<div class="status_textarea">
		<h2 class="capitalize"><?php echo $lang['newsfeed']; ?></h2>
		<form action="home.php?action=post_to_wall" method="post">
			<textarea id="status_updater" name="value"></textarea>

			<input type="hidden" name="wall_id" value="<?php echo $current_user->id; ?>" />

			<br />

			<input id="post_to_wall" type="submit" name="submit" value="<?php echo $lang[ 'post_to_wall' ]; ?>" />
		</form>
	</div>
<?php } ?>

<div id="wall" class="left">
	<?php foreach( $posts as $post ) { ?>
		<?php include( "post_type_{$post->post_type}.tpl.php" ); ?>
	<?php } ?>
</div>