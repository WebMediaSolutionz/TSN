<?php
	require_once( 'functions.php' );
	require_once( 'config.php' );
	require_once( 'lang/' . $current_lang . '.php' );

	// LOADING MODELS
	require_once( 'model/class.database.php' );
	require_once( 'model/class.database_object.php' );
	require_once( 'model/class.album.php' );
	require_once( 'model/class.comments.php' );
	require_once( 'model/class.conversations.php' );
	require_once( 'model/class.item.php' );
	require_once( 'model/class.likes.php' );
	require_once( 'model/class.messages.php' );
	require_once( 'model/class.notification.php' );
	require_once( 'model/class.picture.php' );
	require_once( 'model/class.post.php' );
	require_once( 'model/class.session.php' );
	require_once( 'model/class.settings.php' );
	require_once( 'model/class.themes.php' );
	require_once( 'model/class.track.php' );
	require_once( 'model/class.user.php' );
	require_once( 'model/class.video.php' );

	require_once( 'PHPMailer/class.phpmailer.php' );
	require_once( 'PHPMailer/class.smtp.php' );
	require_once( 'PHPMailer/language/phpmailer.lang-fr.php' );

	require_once( 'model/class.utils.php' );

	require_once( 'controllers/class.action.php' );
	require_once( 'controllers/class.friendship.php' );

	// Composer's autoloader
	require_once('vendor/autoload.php');

	require_once( 'controllers/class.' . Utils::current_page() );
?>