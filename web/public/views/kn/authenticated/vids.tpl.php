<?php include( 'partials/header.tpl.php' ); ?>

<div class="content">
	<h1>VIDEOS</h1>

	<?php if ( $current_user->id === $profile_user->id ) { ?>
		<a class="btn right" href="add_videos.php">add video</a>
		<div class="clear"></div>
	<?php } ?>

	<div>
		<?php foreach ( $videos as $video ) { ?>
			<?php include( 'partials/video_thumb.tpl.php' ); ?>
		<?php } ?>
	</div>

	<div class="clearfix"></div>
</div>

<?php include( 'partials/footer.tpl.php' ); ?>