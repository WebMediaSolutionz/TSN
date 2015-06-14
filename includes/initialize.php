<?php
	require_once( 'functions.php' );
	require_once( 'config.php' );
	require_once( 'lang/' . $current_lang . '.php' );

	// LOADING MODELS
	require_once( 'model/class.database.php' );
	require_once( 'model/class.database_object.php' );
	require_once( 'model/class.session.php' );
	require_once( 'model/class.user.php' );
	require_once( 'model/class.settings.php' );

	require_once( 'model/class.post.php' );
	require_once( 'model/class.messages.php' );
	require_once( 'model/class.conversations.php' );
	require_once( 'model/class.likes.php' );
	require_once( 'model/class.notification.php' );

	require_once( 'PHPMailer/class.phpmailer.php' );
	require_once( 'PHPMailer/class.smtp.php' );
	require_once( 'PHPMailer/language/phpmailer.lang-fr.php' );

	require_once( 'model/class.utils.php' );

	require_once( 'controllers/class.action.php' );
	require_once( 'controllers/class.friendship.php' );
	require_once( 'controllers/class.' . Utils::current_page() );
?>