<?php 
	include_once( 'header.tpl.php' );
?>

<div class="picture">
	<audio controls>
		<source src="<?php echo $track_path; ?>" type="audio/mpeg">
		Your browser does not support the audio tag.
	</audio> 

	<br /><br />

	<a id="profile_pic_thumbnail" class="left block" href="<?php echo $redirect_destination; ?>">
		<img src="<?php echo $profile_img; ?>" />
	</a>

	<div class="">
		<span><a href="<?php echo $redirect_destination; ?>"><?php echo $track_owner->full_name(); ?></a></span><br />
		<div class="caption">
			<span><?php echo $track->caption; ?></span>
		</div>
	</div>

	<div class="post_operations actions">
		<span><a href="<?php echo $track->you_like ? static::$action_unlike_link : static::$action_like_link; ?>&track_id=<?php echo $track->id; ?>"><?php echo $track->you_like ? $lang[ 'unlike' ] : $lang[ 'like' ]; ?></a> <!-- &middot; <a href="share.php?track_id=<?php echo $track->id; ?>"><?php echo $lang[ 'share' ]; ?></a> --></span> &middot; <span class="automated_post">Uploaded <?php echo Utils::how_long_ago( $track->upload_date ); ?></span>
	</div>

	<div class="comments">
		<?php foreach ( $track->comments as $comment ) { ?>
			<?php include( "partials/comment.tpl.php" ); ?>
		<?php } ?>

		<div class="comment_posting_section">
			<form action="<?php echo static::$action_comment_link; ?>" method="post">
				<a id="profile_pic_thumbnail" class="left block" href="track.php?track_id=<?php echo $track_owner->id; ?>">
					<img src="<?php echo $current_user_img; ?>" />
				</a>
				<input class="left" type="text" placeholder="Write a comment..." name="value" />
				<input type="hidden" name="track_id" value="<?php echo $track->id; ?>" />
				<input class="left" type="submit" name="submit" value="comment" />
				<div class="clear"></div>
			</form>
		</div>
	</div>
</div>

<?php 
	include_once( 'footer.tpl.php' );
?>