<?php
	$post_title = "";

	switch ( $post->post_type ) {
		case '5'	:		$post_title = "<a class='users_name' href='profile.php?profile_id={$author->id}'>" . $author->full_name() . "</a> shared <a href='profile.php?profile_id={$other_guy->id}'>" . $other_guy->full_name() . "</a>'s <a href='post.php?post_id={$post->shared_post->id}'>post</a>";
							break;

		case '6'	:		$post_title = "<a class='users_name' href='profile.php?profile_id={$author->id}'>" . $author->full_name() . "</a> added a new photo";
							break;

		case '7'	:		$post_title = "<a class='users_name' href='profile.php?profile_id={$author->id}'>" . $author->full_name() . "</a> shared <a href='profile.php?profile_id={$other_guy->id}'>" . $other_guy->full_name() . "</a>'s <a href='picture.php?picture_id={$post->shared_post->id}'>picture</a>";
							break;

		default 	:		$post_title = "<a class='users_name' href='profile.php?profile_id={$author->id}'>" . $author->full_name() . "</a>";
							break;
	}
?>

<div class="pull-left">
	<a id="profile_pic_thumbnail" class="left block" href="profile.php?profile_id=<?php echo $author->id; ?>">
		<img class="img-responsive" src="<?php echo $author_img; ?>" />
	</a>	
</div>
<div class="left left_part pull-left small_left_gap">
	<div>
		<span class="automatically_generated_text">
			<?php echo $post_title; ?>
		</span>

		<?php if ( isset($same_person) && !$same_person ) { ?>
			&raquo; <a href="profile.php?profile_id=<?php echo $recipient->id; ?>"><?php echo $recipient->full_name(); ?></a>
		<?php } ?>
	</div>

	<div class="post_operations italics">
		<span class="automated_post"><?php echo Utils::how_long_ago( $post->post_date ); ?></span>
	</div>
