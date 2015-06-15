<?php
	$author = User::find_by_id( $post->user_id );
	$author_img = "UPS/{$author->id}/profile.jpg";
	$author_img = file_exists( $author_img ) ? $author_img : "images/{$theme}/default_profile_pic.jpg";

	$picture = Picture::find_by_id( $post->picture_id );

	$other_guy = User::find_by_id( $post->shared_post->user_id );
?>
<div class="single_post post_type_<?php echo $post->post_type; ?>">
	<?php include( "post_top_part.tpl.php" ); ?>

		<br />

		<div class="caption">
			<span><?php echo $picture->caption; ?></span>
		</div>

		<a href="picture.php?picture_id=<?php echo $picture->id; ?>">
			<img alt="<?php echo $picture->caption; ?>" src="<?php echo "UPS/{$author->id}/pictures/{$picture->filename}"; ?>" />
		</a>

		<?php include( "shared_content_details.tpl.php" ); ?>

		<div class="post_operations actions">
			<span><a href="<?php echo $post->you_like ? static::$action_unlike_link : static::$action_like_link; ?>&post_id=<?php echo $post->id; ?>"><?php echo $post->you_like ? $lang[ 'unlike' ] : $lang[ 'like' ]; ?></a> &middot; <a href="share.php?post_id=<?php echo $post->id; ?>"><?php echo $lang[ 'share' ]; ?></a><?php echo count( $post->get_likers() ) === 1 ? ' &middot; 1 like' : ( count( $post->get_likers() ) !== 0 ? ' &middot; ' . count( $post->get_likers() ) . ' likes': '' );?></span>
		</div>
	</div>
	<?php if ( $author->id === $current_user->id ) { ?>
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