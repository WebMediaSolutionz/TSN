<div class="theme_thumb<?php echo ( $session->settings->theme_id === $single_theme->id ) ? ' outline' : ''; ?>">
	<a href="settings.php?action=update_theme&theme_id=<?php echo $single_theme->id?>">
		<img src="<?php echo "views/{$single_theme->name}/thumb.jpg"; ?>">
	</a>
	<br /><br />
	<span><?php echo $single_theme->description; ?></span>
</div>