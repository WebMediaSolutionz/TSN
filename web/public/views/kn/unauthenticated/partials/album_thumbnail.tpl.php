<?php
	// var_dump( $album );
?>
<a class="album_thumb block left" href="signup.php">
	<div class="img_container">
		<img src="<?php echo "UPS/{$profile_user->id}/pictures/{$album->pictures[0]->thumbnail}"; ?>" alt="<?php echo $album->name; ?>" />
	</div>
	<div>
		<?php echo $album->name; ?><br />
		<span class="subscript"><?php echo count( $album->pictures ) . " photos";?></span>
	</div>
</a>