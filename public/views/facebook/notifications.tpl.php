<?php 
	include_once( 'header.tpl.php' );
?>

<h2>Notifications</h2>

<?php
	foreach ( $notifications as $notification ) {
		include( 'partials/notification.tpl.php' );
	}
?>

<?php 
	include_once( 'footer.tpl.php' );
?>