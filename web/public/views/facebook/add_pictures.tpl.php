<?php 
	include_once( 'partials/header.tpl.php' );
?>

<h2 class="capitalize"><span>add pictures to album: <?php echo $album->name; ?></span></h2>

<form action="album_creation.php?action=create" method="post" enctype="multipart/form-data">
	<input type="hidden" name="album_id" value="<?php echo $album->id; ?>" />
	<table>
		<tr>
			<td>
				<label class="capitalize">pictures</label>
			</td>
			<td>
				<input type="file" name="pictures" multiple="multiple">
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="submit" name="submit">
			</td>
		</tr>
	</table>
</form>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>