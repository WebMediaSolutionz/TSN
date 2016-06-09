<?php 
	include_once( 'partials/header.tpl.php' );
?>
scsc
<h2 class="capitalize">
	<span class="capitalize"><?php echo "{$profile_user->full_name()}'s albums"; ?></span>
</h2>

<div class="left subscript">
	<a href="profile.php?profile_id=<?php echo $profile_user->id; ?>">go to <?php echo $profile_user->full_name(); ?>'s profile page</a>
</div>

<?php if ( $current_user->id === $profile_user->id ) { ?>
<a class="btn right" href="album_creation.php">create new album</a>
<?php } ?>

<div class="clear"></div>

<br />

<div class="album_gallery">
	<?php
		foreach ( $albums as $album ) {
			include( 'partials/album_thumbnail.tpl.php' );
		}
	?>
	<div class="clear"></div>
</div>

<div class="clear"></div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>