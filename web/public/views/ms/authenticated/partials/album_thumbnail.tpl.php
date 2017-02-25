<?php
	$album_thumb = ( $album->nbr_of_items > 0 ) ? "UPS/{$profile_user->id}/pictures/{$album->pictures[0]->thumbnail}" : "views/{$theme}/common/images/{$album->empty_album_pic}";
?>
<a class="album_thumb block left" href="album.php?album_id=<?php echo $album->id; ?>">
	<div class="img_container">
		<img src="<?php echo $album_thumb; ?>" alt="<?php echo $album->name; ?>" />
	</div>
	<div>
		<?php echo $album->name; ?><br />
		<span class="subscript"><?php echo count( $album->pictures ) . " photos";?></span>
	</div>
</a>