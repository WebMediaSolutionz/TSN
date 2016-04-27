<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div>
	<h2>Settings</h2>
	<form action="settings.php" method="POST">
		<table>
			<tr>
				<td>language</td>
				<td>
					<select name="language">
						<option value="en" <?php echo ( $session->settings->language === "en" ) ? "selected" : ""; ?>>english</option>
						<option value="fr" <?php echo ( $session->settings->language === "fr" ) ? "selected" : ""; ?>>french</option>
					</select>
				</td>
				<td>
					<input type="submit" name="submit" value="submit" />
				</td>
			</tr>
			<tr>
				<td>
					<a class="btn" href="settings.php?action=delete_account">delete account</a>
				</td>
			</tr>
		</table>
	</form>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>