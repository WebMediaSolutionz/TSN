<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div class="content">
	<h1>SETTINGS</h1>

	<h2>language</h2>

	<form action="settings.php" method="POST">
		<select class="left" name="language">
			<option value="en" <?php echo ( $session->settings->language === "en" ) ? "selected" : ""; ?>>english</option>
			<option value="fr" <?php echo ( $session->settings->language === "fr" ) ? "selected" : ""; ?>>french</option>
		</select>
		<input class="btn capitalize left left_gap" type="submit" name="submit" value="submit" />
		<div class="clearfix"></div>
	</form>

	<br />

	<h2>theme</h2>

	<div class="theme_gallery">
		<?php
			foreach ( $themes as $single_theme ) {
				include( 'partials/theme_thumb.tpl.php' );
			}
		?>
		<div class="clearfix"></div>
	</div>

	<br />

	<a class="btn" href="login.php?action=delete_account">delete account</a>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>