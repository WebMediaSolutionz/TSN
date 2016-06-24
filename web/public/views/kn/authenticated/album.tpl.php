<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div class="content">
	<h2 class="capitalize">
		<span><?php echo $album->name; ?></span><br />

		<span class="automatically_generated_text subscript">
			<?php $plural = count( $album->pictures ) == 1 ? '' : 's'; ?>
		</span>
	</h2>

	<div class="subscript">
		<a href="album.php?user_id=<?php echo $profile_user->id; ?>">back to photo sets</a>
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

	<div class="clearfix"></div>
	<!-- ***** -->
	<div class="post_operations actions">
		<span><a class="js-action js-like" href="<?php echo $album->you_like ? static::$action_unlike_link : static::$action_like_link; ?>&album_id=<?php echo $album->id; ?>"><?php echo $album->you_like ? $lang[ 'unlike' ] : $lang[ 'like' ]; ?></a> &middot; <a class="js-action js-comment" href="#">Comment</a><span class="js-nb_likes"><?php echo count( $album->get_likers() ) === 1 ? ' &middot; 1 like' : ( count( $album->get_likers() ) !== 0 ? ' &middot; ' . count( $album->get_likers() ) . ' likes': '' );?></span><?php echo count( $album->get_commenters() ) === 1 ? ' &middot; 1 comment' : ( count( $album->get_commenters() ) !== 0 ? ' &middot; ' . count( $album->get_commenters() ) . ' comments': '' );?></span>
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
				<input class="left js-input_comment" type="text" placeholder="Write a comment..." name="value" />
				<input type="hidden" name="album_id" value="<?php echo $album->id; ?>" />
				<input type="hidden" name="current_user_id" value="<?php echo $current_user->id; ?>" />
				<input type="hidden" name="current_user_fullname" value="<?php echo $current_user->full_name(); ?>" />
				<input class="left js-submit_comment" type="submit" name="submit" value="comment" />
				<div class="clear"></div>
			</form>
		</div>
	</div>

	<!-- ***** -->

	<div class="clear"></div>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>