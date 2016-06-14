<a class="album_thumb block left" href="video.php?item_id=<?php echo $video->id; ?>">
	<div class="img_container">
		<img class="" src="<?php echo $video_thumb . '/' . $video->thumbnail; ?>" alt="<?php echo $video->title; ?>" />
	</div>
	<div>
		<?php echo $video->title; ?><br />
		<span class="subscript">uploaded:</span> <span class="subscript italics"><?php echo Utils::display_date( $video->upload_date ); ?></span>
	</div>
</a>