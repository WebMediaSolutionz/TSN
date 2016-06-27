<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div class="content">
	<h2 class="capitalize">
		<span>add videos</span>
	</h2>

	<form action="add_videos.php?action=create" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>
					<label class="capitalize">title</label>
				</td>
				<td>
					<input type="text" name="title" />
				</td>
			</tr>
			<tr>
				<td>
					<label class="capitalize">caption</label>
				</td>
				<td>
					<input type="text" name="caption" />
				</td>
			</tr>
			<tr>
				<td>
					<label class="capitalize">video</label>
				</td>
				<td>
					<input type="file" name="video">
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="submit" name="submit">
				</td>
			</tr>
		</table>
	</form>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>