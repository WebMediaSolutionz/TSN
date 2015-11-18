<div id="albums_widget" class="left widget">
	<div class="widget_title">
		<h4 class="capitalize"><a href="album.php?user_id=<?php echo $profile_user->id; ?>">albums</a></h4>
	</div>
	<?php foreach ( $albums as $album ) { ?>
		<?php include( 'album_thumbnail.tpl.php' ); ?>
	<?php } ?>
</div>