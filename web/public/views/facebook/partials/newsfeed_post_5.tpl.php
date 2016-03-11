<?php
	$author = User::find_by_id( $post->user_id );
	$other_guy = User::find_by_id( $post->shared_post->user_id );
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
			<a href="profile.php?profile_id=<?php echo $author->id; ?>"><?php echo $author->full_name(); ?></a> shared <a href='profile.php?profile_id=<?php echo $other_guy->id; ?>'><?php echo $other_guy->full_name(); ?></a>'s <a href='post.php?post_id=<?php echo $post->shared_post->id; ?>'>post</a>

			<?php if ( !$same_person ) { ?>
				&raquo; <a href="profile.php?profile_id=<?php echo $recipient->id; ?>"><?php echo $recipient->full_name(); ?></a>
			<?php } ?>
		</span>

		<br /><br />

		<span><?php echo $post->value; ?></span>

		<br /><br />

		<div class="shared_content italics subscript">
			<span><?php echo $post->shared_post->value; ?></span><br /><br />
		</div>

		<br />

		<div class="post_operations italics">
			<span class="automated_post"><?php echo Utils::how_long_ago( $post->post_date ); ?></span>
		</div>
		<div class="post_operations actions">
			<span><a href="<?php echo $post->you_like ? static::$action_unlike_link: static::$action_like_link; ?>&post_id=<?php echo $post->id; ?>"><?php echo $post->you_like ? $lang[ 'unlike' ] : $lang[ 'like' ]; ?></a> &middot; <a href="share.php?post_id=<?php echo $post->id; ?>"><?php echo $lang[ 'share' ]; ?></a></span>
		</div>
	</div>
	<?php if ( $author->id === $current_user->id || $recipient->id === $current_user->id ) { ?>
		<div class="post_actions right">
			<a class="delete_post block" href="<?php echo static::$action_delete_post_link; ?>&post_id=<?php echo $post->id; ?>">
				<span class="hide">delete</span>
			</a>
		</div>
	<?php } ?>
	<div class="clear"></div>
	<div class="comments">
		<?php foreach ( $post->comments as $comment ) { ?>
			<?php include( "comment.tpl.php" ); ?>
		<?php } ?>

		<div class="comment_posting_section">
			<form action="<?php echo static::$action_comment_link; ?>" method="post">
				<a id="profile_pic_thumbnail" class="left block" href="profile.php?profile_id=<?php echo $author->id; ?>">
					<img src="<?php echo $current_user_img; ?>" />
				</a>
				<input class="left" type="text" placeholder="Write a comment..." name="value" />
				<input type="hidden" name="post_id" value="<?php echo $post->id; ?>" />
				<input class="left" type="submit" name="submit" value="comment" />
				<div class="clear"></div>
			</form>
		</div>
	</div>
	<div class="clear"></div>        
</div>