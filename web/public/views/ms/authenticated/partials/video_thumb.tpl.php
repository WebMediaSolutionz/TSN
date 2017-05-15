<!--<a class="btn" href="vids.php?action=delete_video&video_id=<?php echo $video->id; ?>">delete</a>-->
<a class="album_thumb block left" href="video.php?item_id=<?php echo $video->id; ?>">
	<div class="overlay"></div>

	<div class="img_container">
		<img class="" src="<?php echo $video_thumb . '/' . $video->thumbnail; ?>" alt="<?php echo $video->title; ?>" />
	</div>
	<div>
		<?php echo $video->title; ?><br />
		<span class="subscript italics"><?php echo Utils::display_date( $video->upload_date ); ?></span>
	</div>
</a>