<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div class="content">
	<h1 class="capitalize"><span>add video</span></h1>

	<form action="add_video.php?action=add_video" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>
					<label class="capitalize">title</label>
				</td>
				<td>
					<input type="text" name="title">
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
					<label class="capitalize">thumbnail</label>
				</td>
				<td>
					<input type="file" name="thumbnail">
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