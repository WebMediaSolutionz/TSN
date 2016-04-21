<?php 
	include_once( 'partials/header.tpl.php' );
?>

<h2 class="capitalize"><span>album creation</span></h2>

<form action="album_creation.php?action=create" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td>
				<label class="capitalize">album name</label>
			</td>
			<td>
				<input type="text" name="album_name" />
			</td>
		</tr>
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