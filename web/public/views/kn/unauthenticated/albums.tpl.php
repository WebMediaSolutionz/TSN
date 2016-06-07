<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div class="content">
	<h1>photo sets</h1>

	<div class="album_gallery">
		<?php
			foreach ( $albums as $album ) {
				include( 'partials/album_thumbnail.tpl.php' );
			}
		?>
		<div class="clearfix"></div>
	</div>

	<div class="clear"></div>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>