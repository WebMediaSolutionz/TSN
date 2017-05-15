<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div class="content">
	<h1><?php echo $video->title; ?></h1>

	<div class="picture">
		<video controls> 
			<source src="<?php echo $video_path_mp4; ?>" type="video/mp4">
			<source src="<?php echo $video_path_3gp; ?>" type="video/3gp">
			<source src="<?php echo $video_path_ogv; ?>" type="video/ogg"> 
			<source src="<?php echo $video_path_webm; ?>" type="video/webm"> 
			Your browser does not support the video tag.
		</video>

		<?php if ( $video->user_id === $current_user->id ) { ?>
			<br /><br />

			<div>
				<a class="btn" href="video.php?video_id=<?php echo $video->id; ?>&action=delete_video&video_id=<?php echo $video->id; ?>">delete</a>
			</div>
		<?php } ?>

		<br /><br />

		<div class="item_comment_section">
			<a id="profile_pic_thumbnail" class="left block" href="<?php echo $redirect_destination; ?>">
				<img src="<?php echo $profile_img; ?>" />
			</a>

			<div class="">
				<span><a href="<?php echo $redirect_destination; ?>"><?php echo $video_owner->full_name(); ?></a></span><br />
				<div class="caption">
					<span><?php echo $video->caption; ?></span>
				</div>
			</div>

			<div class="post_operations actions">
				<span><a class="js-action js-like" href="<?php echo $video->you_like ? static::$action_unlike_link : static::$action_like_link; ?>&video_id=<?php echo $video->id; ?>"><?php echo $video->you_like ? $lang[ 'unlike' ] : $lang[ 'like' ]; ?></a> &middot; <a class="js-action js-comment" href="#">Comment</a><!-- &middot; <a href="share.php?video_id=<?php echo $video->id; ?>"><?php echo $lang[ 'share' ]; ?></a> --></span> <span class="js-nb_likes"><?php echo count( $video->get_likers() ) === 1 ? ' &middot; 1 like' : ( count( $video->get_likers() ) !== 0 ? ' &middot; ' . count( $video->get_likers() ) . ' likes': '' );?></span><span class="js-nb_comments"><?php echo count( $video->get_commenters() ) === 1 ? ' &middot; 1 comment' : ( count( $video->get_commenters() ) !== 0 ? ' &middot; ' . count( $video->get_commenters() ) . ' comments': '' );?></span> &middot; <span class="automated_post">Uploaded <?php echo Utils::how_long_ago( $video->upload_date ); ?></span>
			</div>

			<div class="comments">
				<?php foreach ( $video->comments as $comment ) { ?>
					<?php include( "partials/comment.tpl.php" ); ?>
				<?php } ?>

				<div class="comment_posting_section">
					<form action="<?php echo static::$action_comment_link; ?>" method="post">
						<a id="profile_pic_thumbnail" class="left block" href="video.php?video_id=<?php echo $video_owner->id; ?>">
							<img src="<?php echo $current_user_img; ?>" />
						</a>
						<input class="left js-input_comment" type="text" placeholder="Write a comment..." name="value" />
						<input type="hidden" name="video_id" value="<?php echo $video->id; ?>" />
						<input type="hidden" name="current_user_id" value="<?php echo $current_user->id; ?>" />
						<input type="hidden" name="current_user_fullname" value="<?php echo $current_user->full_name(); ?>" />
						<input class="left js-submit_comment" type="submit" name="submit" value="comment" />
						<div class="clear"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>