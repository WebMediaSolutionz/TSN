<?php
	$author = User::find_by_id( $post->user_id );
	$profile_img = "UPS/{$author->id}/profile.jpg";

	$profile_img = file_exists( $profile_img ) ? $profile_img : "images/default_profile_pic.jpg";
?>

<div class="single_post post_type_<?php echo $post->post_type; ?>">
	<a id="profile_pic_thumbnail" class="left block" href="profile.php?profile_id=<?php echo $author->id; ?>">
		<img src="<?php echo $profile_img; ?>" />
	</a>
	<div class="left left_part">
		<span><a href="profile.php?profile_id=<?php echo $author->id; ?>"><?php echo $author->full_name(); ?></a></span><br />
		<span><?php echo $post->value; ?></span><br />
		<div class="post_operations italics">
			<span class="automated_post"><?php echo Utils::how_long_ago( $post->post_date ); ?></span>
		</div>
	</div>
	<?php if ( $author->id === $current_user->id || $profile_user->id === $current_user->id ) { ?>
	<div class="post_actions right">
		<a class="delete_post block" href="profile.php?profile_id=<?php echo $profile_user->id; ?>&action=delete_post&post_id=<?php echo $post->id; ?>">
			<span class="hide">delete</span>
		</a>
	</div>
	<?php } ?>
	<div class="clear"></div>        
</div>