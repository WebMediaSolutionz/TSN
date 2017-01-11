<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div class="content">
	<h1>SETTINGS</h1>
	
	<form action="settings.php" method="POST">
		<table>
			<tr>
				<td>language</td>
				<td>
					<select class="left" name="language">
						<option value="en" <?php echo ( $session->settings->language === "en" ) ? "selected" : ""; ?>>english</option>
						<option value="fr" <?php echo ( $session->settings->language === "fr" ) ? "selected" : ""; ?>>french</option>
					</select>
					<input class="left" type="submit" name="submit" value="submit" />
					<div class="clearfix"></div>
				</td>
			</tr>
			<tr>
				<td>theme</td>
				<td>
					<div class="theme_gallery">
						<?php
							foreach ( $themes as $single_theme ) {
								include( 'partials/theme_thumb.tpl.php' );
							}
						?>
						<div class="clearfix"></div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<a class="btn" href="login.php?action=delete_account">delete account</a>
				</td>
			</tr>
		</table>
	</form>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>