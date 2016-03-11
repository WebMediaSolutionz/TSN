<?php
	$author = User::find_by_id( $comment->user_id );
	$profile_img = "UPS/{$author->id}/profile.jpg";

	$profile_img = file_exists( $profile_img ) ? $profile_img : "images/{$theme}/default_profile_pic.jpg";
?>

<div class="comment">
	<div class="left left_part">
		<span><a href="profile.php?profile_id=<?php echo $author->id; ?>"><?php echo $author->full_name(); ?></a></span>
		<span><?php echo $comment->value; ?></span>
		<div class="post_operations italics">
			<span class="automated_post"><?php echo Utils::how_long_ago( $comment->date ); ?></span> 
			<span><a href="<?php echo $comment->you_like ? static::$action_unlike_link: static::$action_like_link; ?>&comment_id=<?php echo $comment->id; ?>"><?php echo $comment->you_like ? $lang[ 'unlike' ] : $lang[ 'like' ]; ?></a></span>
		</div>
	</div>
	<?php if ( $comment->user_id === $current_user->id ) { ?>
		<div class="post_actions right">
			<a class="delete_post block" href="<?php echo static::$action_delete_comment_link; ?>&comment_id=<?php echo $comment->id; ?>">
				<span class="hide">delete</span>
			</a>
		</div>
	<?php } ?>
	<div class="clear"></div>   
</div>