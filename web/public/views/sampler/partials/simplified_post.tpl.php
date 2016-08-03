<?php
	$author = User::find_by_id( $post->user_id );
	$recipient = User::find_by_id( $post->wall_id );

	$same_person = ( $author->id === $recipient->id );

	$profile_img = "UPS/{$author->id}/profile.jpg";
	$current_user_img = "UPS/{$current_user->id}/profile.jpg";
	$profile_img = file_exists( $profile_img ) ? $profile_img : "images/{$theme}/default_profile_pic.jpg";
	$current_user_img = file_exists( $current_user_img ) ? $current_user_img : "images/{$theme}/default_profile_pic.jpg";
?>

<div class="single_post post_type_<?php echo $post->post_type; ?>">
	<a id="profile_pic_thumbnail" class="left block" href="profile.php?profile_id=<?php echo $author->id; ?>">
		<img src="<?php echo $profile_img; ?>" />
	</a>
	<div class="left left_part">
		<span>
			<a href="profile.php?profile_id=<?php echo $author->id; ?>"><?php echo $author->full_name(); ?></a>

			<?php if ( !$same_person ) { ?>
				&raquo; <a href="profile.php?profile_id=<?php echo $recipient->id; ?>"><?php echo $recipient->full_name(); ?></a>
			<?php } ?>
		</span>

		<br />

		<span><?php echo $post->value; ?></span><br /><br />
		<div class="post_operations italics">
			<span class="automated_post"><?php echo Utils::how_long_ago( $post->post_date ); ?></span>
		</div>
		<div class="post_operations actions">
			<span><a href="home.php?action=<?php echo $post->you_like ? 'unlike' : 'like'; ?>&post_id=<?php echo $post->id; ?>"><?php echo $post->you_like ? $lang[ 'unlike' ] : $lang[ 'like' ]; ?></a></span>
		</div>
	</div>
	<div class="clear"></div>      
</div>