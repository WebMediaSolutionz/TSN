<a class="album_thumb block left" href="signup.php">
	<div class="img_container">
		<img class="" src="<?php echo $video_thumb . '/' . $video->thumbnail; ?>" alt="<?php echo $video->title; ?>" />
	</div>
	<div>
		<?php echo $video->title; ?><br />
		<span class="subscript italics"><?php echo Utils::display_date( $video->upload_date ); ?></span>
	</div>
</a>