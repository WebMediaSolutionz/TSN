<?php 
	include_once( 'partials/header.tpl.php' );
?>

<h1>VIDEOS</h1>

<div>
	<?php foreach ( $videos as $video ) { ?>
		<?php include( 'partials/video_thumb.tpl.php' ); ?>
	<?php } ?>
</div>

<div class="clear"></div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>