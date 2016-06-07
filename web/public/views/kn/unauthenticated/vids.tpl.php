<?php include( 'partials/header.tpl.php' ); ?>

<div class="content">
	<h1>VIDEOS</h1>

	<div>
		<?php foreach ( $videos as $video ) { ?>
			<?php include( 'partials/video_thumb.tpl.php' ); ?>
		<?php } ?>
	</div>

	<div class="clearfix"></div>
</div>

<?php include( 'partials/footer.tpl.php' ); ?>