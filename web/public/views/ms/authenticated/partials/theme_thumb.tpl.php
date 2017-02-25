<div class="theme_thumb<?php echo ( $session->settings->theme_id === $single_theme->id ) ? ' active' : ''; ?>">
	<a href="settings.php?action=update_theme&theme_id=<?php echo $single_theme->id?>">
		<h4 class="center"><span><?php echo ( $session->settings->theme_id === $single_theme->id ) ? ' active' : 'activate'; ?></span></h4>
		<img src="<?php echo "views/{$single_theme->name}/thumb.jpg"; ?>">
	</a>
	<br /><br />
	<div><?php echo $single_theme->description; ?></div>
</div>