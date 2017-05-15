<?php include( 'partials/header.tpl.php' ); ?>

<div class="content">
	<h1>LATEST VIDEOS</h1>

	<div class="album_gallery">
		<?php foreach ( $videos as $video ) { ?>
			<?php include( 'partials/video_thumb.tpl.php' ); ?>
		<?php } ?>
	</div>

	<div class="clearfix"></div>

	<h1>LATEST PHOTO SETS</h1>

	<div class="album_gallery">
		<?php
			foreach ( $albums as $album ) {
				include( 'partials/album_thumbnail.tpl.php' );
			}
		?>
		<div class="clearfix"></div>
	</div>

	<h1>LATEST BLOG POSTS</h1>

	<?php include( 'partials/newsfeed.tpl.php' ); ?>

	<div class="clearfix"></div>
</div>

<?php include( 'partials/footer.tpl.php' ); ?>