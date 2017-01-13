<?php include( 'partials/header.tpl.php' ); ?>

<div class="content">
	<h1>EDIT ABOUT ME</h1>

	<div class="status_textarea">
		<form method="post" action="bio.php?action=update_bio">
			<textarea class="tinymce" name="bio">
				<?php echo $profile_user->bio; ?>
			</textarea>

			<br />

			<input name="submit" value="save" type="submit">
		</form>
	</div>
</div>

<?php include( 'partials/footer.tpl.php' ); ?>