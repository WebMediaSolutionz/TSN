<?php 
	include_once( 'header.tpl.php' );
?>

<h2 class="capitalize">
	<span><?php echo $album->name; ?></span><br />

	<span class="automatically_generated_text subscript">
		<?php $plural = count( $album->pictures ) == 1 ? '' : 's'; ?>
		<?php echo count( $album->pictures ) . " picture{$plural} &middot; Last modified: " . Utils::how_long_ago( $album->modified_date ); ?>
	</span>
</h2>

<div class="subscript">
	<a href="album.php?user_id=<?php echo $profile_user->id; ?>">back to <?php echo $profile_user->full_name(); ?>'s albums</a> &middot; <a href="profile.php?profile_id=<?php echo $profile_user->id; ?>">go to <?php echo $profile_user->full_name(); ?>'s profile page</a>
</div>

<?php if ( $current_user->id === $profile_user->id ) { ?>
<a class="btn right" href="add_pictures.php?album_id=<?php echo $album->id; ?>">add pictures</a>
<?php } ?>

<div class="clear"></div>

<br />

<div class="picture_gallery">
	<?php
		foreach ( $album->pictures as $picture ) {
			include( 'partials/picture_thumbnail.tpl.php' );
		}
	?>
</div>

<div class="clear"></div>
<!-- ***** -->
<div class="post_operations actions">
	<span><a href="<?php echo $album->you_like ? static::$action_unlike_link : static::$action_like_link; ?>&album_id=<?php echo $album->id; ?>"><?php echo $album->you_like ? $lang[ 'unlike' ] : $lang[ 'like' ]; ?></a> <!-- &middot; <a href="share.php?picture_id=<?php echo $picture->id; ?>"><?php echo $lang[ 'share' ]; ?></a> --></span>
</div>

<div class="comments">
	<?php foreach ( $album->comments as $comment ) { ?>
		<?php include( "partials/comment.tpl.php" ); ?>
	<?php } ?>

	<div class="comment_posting_section">
		<form action="<?php echo static::$action_comment_link; ?>" method="post">
			<a id="profile_pic_thumbnail" class="left block" href="picture.php?picture_id=<?php echo $picture_owner->id; ?>">
				<img src="<?php echo $current_user_img; ?>" />
			</a>
			<input class="left" type="text" placeholder="Write a comment..." name="value" />
			<input type="hidden" name="album_id" value="<?php echo $album->id; ?>" />
			<input class="left" type="submit" name="submit" value="comment" />
			<div class="clear"></div>
		</form>
	</div>
</div>

<!-- ***** -->

<div class="clear"></div>

<?php 
	include_once( 'footer.tpl.php' );
?>