<?php
	if ( isset( $post->shared_post->value ) && $post->shared_post->value != '' ) {
?>
	<div class="<?php echo isset( $post->shared_post->value ) ? 'shared_content ' : ''; ?>italics subscript">
		<?php
			$shared_post_author = User::find_by_id( $post->shared_post->user_id );
		?>
		<div><a href="profile.php?profile_id=<?php echo $shared_post_author->id; ?>"><?php echo $shared_post_author->full_name(); ?></a></div>

		<br />

		<div><?php echo $post->shared_post->value; ?></div>
	</div>
<?php } ?>