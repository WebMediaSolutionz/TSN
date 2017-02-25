<a class="album_thumb block left" href="picture.php?picture_id=<?php echo $picture->id; ?>">
	<div class="img_container">
		<img alt="<?php echo $picture->caption; ?>" src="<?php echo "UPS/{$profile_user->id}/pictures/{$picture->thumbnail}"; ?>" />
	</div>
</a>