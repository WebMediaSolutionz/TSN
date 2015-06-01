<?php 
	include_once( 'header.tpl.php' );
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
			</tr>
		</table>
		<input type="submit" name="submit" value="submit" />
	</form>
</div>

<?php 
	include_once( 'footer.tpl.php' );
?>