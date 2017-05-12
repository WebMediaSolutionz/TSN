<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div class="content">
	<h2 class="capitalize">
		<span><?php echo $album->name; ?></span><br />
	</h2>

	<div class="subscript">
		<div class="left">
			<a href="<?php echo "album.php?album_id={$album->id}"; ?>">Back to photo set</a> &middot; <a href="album.php?user_id=<?php echo $picture_owner->id; ?>">back to photo sets</a>
		</div>

		<div class="right">
			<a href="picture.php?picture_id=<?php echo $prev_pic->id; ?>">Previous</a> &middot; <a href="picture.php?picture_id=<?php echo $next_pic->id; ?>">Next</a>
		</div>

		<div class="clearfix"></div>
	</div>

	<br />

	<div class="picture">
		<div class="img_container center">
			<a class="inline-block" href="picture.php?picture_id=<?php echo $next_pic->id; ?>">
				<img alt="<?php echo $picture->caption; ?>" src="<?php echo $picture_path; ?>" />
			</a>
		</div>
		

		<?php if ( $picture->user_id === $current_user->id ) { ?>
			<br /><br />

			<div>
				<a class="btn" href="picture.php?picture_id=<?php echo $picture->id; ?>&action=delete_picture&picture_id=<?php echo $picture->id; ?>">delete</a>
			</div>
		<?php } ?>

		<br /><br />

		<div class="item_comment_section">
			<a id="profile_pic_thumbnail" class="left block" href="<?php echo $redirect_destination; ?>">
				<img src="<?php echo $profile_img; ?>" />
			</a>

			<div class="">
				<span><a href="<?php echo $redirect_destination; ?>"><?php echo $picture_owner->full_name(); ?></a></span><br />
				<div class="caption">
					<span><?php echo $picture->caption; ?></span>
				</div>
			</div>

			<div class="post_operations actions">
				<span><a class="js-action js-like" href="<?php echo $picture->you_like ? static::$action_unlike_link : static::$action_like_link; ?>&picture_id=<?php echo $picture->id; ?>"><?php echo $picture->you_like ? $lang[ 'unlike' ] : $lang[ 'like' ]; ?></a> &middot; <a class="js-action js-comment" href="#">Comment</a><!-- &middot; <a href="share.php?picture_id=<?php echo $picture->id; ?>"><?php echo $lang[ 'share' ]; ?></a> --><span class="js-nb_likes"><?php echo count( $picture->get_likers() ) === 1 ? ' &middot; 1 like' : ( count( $picture->get_likers() ) !== 0 ? ' &middot; ' . count( $picture->get_likers() ) . ' likes': '' );?></span><span class="js-nb_comments"><?php echo count( $picture->get_commenters() ) === 1 ? ' &middot; 1 comment' : ( count( $picture->get_commenters() ) !== 0 ? ' &middot; ' . count( $picture->get_commenters() ) . ' comments': '' );?></span></span> &middot; <span class="automated_post">Uploaded <?php echo Utils::how_long_ago( $picture->upload_date ); ?></span>
			</div>

			<div class="comments">
				<?php foreach ( $picture->comments as $comment ) { ?>
					<?php include( "partials/comment.tpl.php" ); ?>
				<?php } ?>

				<div class="comment_posting_section">
					<form action="<?php echo static::$action_comment_link; ?>" method="post">
						<a id="profile_pic_thumbnail" class="left block" href="picture.php?picture_id=<?php echo $picture_owner->id; ?>">
							<img src="<?php echo $current_user_img; ?>" />
						</a>
						<input class="left js-input_comment" type="text" placeholder="Write a comment..." name="value" />
						<input type="hidden" name="picture_id" value="<?php echo $picture->id; ?>" />
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