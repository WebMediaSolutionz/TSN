<?php include( 'partials/header.tpl.php' ); ?>

<div class="content">
	<h1>ABOUT ME</h1>

	<?php if ( $current_user->id === $profile_user->id ) { ?>
	<a class="btn right" href="bio.php?mode=edit">edit about me</a>
	<?php } ?>
	<div class="clearfix"></div>

	<?php echo $profile_user->bio; ?>
</div>

<?php include( 'partials/footer.tpl.php' ); ?>