<?php 
	include_once( 'partials/header.tpl.php' );
?>

<?php include( "partials/post_type_{$post->post_type}.tpl.php" ); ?>

<div class="clear"></div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>