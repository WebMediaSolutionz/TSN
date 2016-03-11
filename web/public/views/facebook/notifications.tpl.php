<?php 
	include_once( 'partials/header.tpl.php' );
?>

<h2>Notifications</h2>

<div class="right">
	<a href="notifications.php?action=mark_all_notifications_as&status=read">Mark All as Read</a>
</div>
<div class="clear"></div>
<br />

<?php
	foreach ( $notifications as $notification ) {
		include( 'partials/notification.tpl.php' );
	}
?>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>