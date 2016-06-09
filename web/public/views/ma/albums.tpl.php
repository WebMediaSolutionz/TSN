<?php 
	include_once( 'partials/header.tpl.php' );
?>

<h1>PICTURES</h1>

<?php if ( $current_user->id === $profile_user->id ) { ?>
<a class="btn right" href="album_creation.php">create new album</a>
<?php } ?>

<div class="clear"></div>

<br />

<div class="album_gallery">
	<?php
		// var_dump( $albums );

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