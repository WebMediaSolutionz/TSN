<?php
	$author = User::find_by_id( $comment->user_id );
	$profile_img = "UPS/{$author->id}/profile.jpg";

	$profile_img = file_exists( $profile_img ) ? $profile_img : $current_user_img;
?>

<div class="comment">
	<a id="profile_pic_thumbnail" class="left block" href="profile.php?profile_id=<?php echo $author->id; ?>">
		<img src="<?php echo $profile_img; ?>" />
	</a>
	<div class="left left_part">
		<span><a href="profile.php?profile_id=<?php echo $author->id; ?>"><?php echo $author->full_name(); ?></a></span>
		<span><?php echo $comment->value; ?></span>

		<?php if ($session->is_logged_in()) { ?>
			<div class="post_operations italics">
				<span class="automated_post"><?php echo Utils::how_long_ago( $comment->date ); ?></span> &middot; <span><a class="js-action js-like" href="<?php echo $comment->you_like ? static::$action_unlike_link: static::$action_like_link; ?>&comment_id=<?php echo $comment->id; ?>"><?php echo $comment->you_like ? $lang[ 'unlike' ] : $lang[ 'like' ]; ?></a><span class="js-nb_likes"><?php echo count( $comment->get_likers() ) == 1 ? ' &middot; 1 like' : ( count( $comment->get_likers() ) !== 0 ? ' &middot; ' . count( $comment->get_likers() ) . ' likes': '' );?></span></span>
			</div>
		<?php } ?>
	</div>
	<?php if ( $comment->user_id === $current_user->id ) { ?>
		<div class="post_actions right">
			<a class="delete_post block js-action js-delete_comment" href="<?php echo static::$action_delete_comment_link; ?>&comment_id=<?php echo $comment->id; ?>">
				<span class="hide">delete</span>
			</a>
		</div>
	<?php } ?>
	<div class="clear"></div>   
</div>