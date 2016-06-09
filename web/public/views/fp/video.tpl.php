<?php 
	include_once( 'partials/header.tpl.php' );
?>

<h1><?php echo $video->title; ?></h1>

<div class="picture">
	<video controls autoplay> 
		<source src="<?php echo $video_path_mp4; ?>" type="video/mp4">
		<source src="<?php echo $video_path_3gp; ?>" type="video/3gp">
		<source src="<?php echo $video_path_ogv; ?>" type="video/ogg"> 
		<source src="<?php echo $video_path_webm; ?>" type="video/webm"> 
		Your browser does not support the video tag.
	</video>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>