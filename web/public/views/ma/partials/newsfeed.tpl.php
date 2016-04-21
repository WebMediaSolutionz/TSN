<div id="wall" class="left">
	<?php foreach( $posts as $post ) { ?>
		<?php include( "post_type_{$post->post_type}.tpl.php" ); ?>
	<?php } ?>
</div>