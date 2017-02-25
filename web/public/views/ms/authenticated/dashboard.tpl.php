<?php include( 'partials/header.tpl.php' ); ?>

<div class="content">
	<h1>DASHBOARD</h1>

	<h2>site configuration</h2>

	<p>choose site banners:</p>

	<form action="dashboard.php?action=update_site_info" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<td>
					<label class="capitalize">site banner:</label>
				</td>
				<td>
					<input type="file" name="banner" />
				</td>
				<td>
					<img width="300px" src="<?php echo "UPS/{$profile_user->id}/pictures/site_banner.jpg"; ?>" />
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>
					<label class="capitalize">site "safe for work" banner:</label>
				</td>
				<td>
					<input type="file" name="banner_sfw" />
				</td>
				<td>
					<img width="300px" src="<?php echo "UPS/{$profile_user->id}/pictures/site_banner_sfw.jpg"; ?>" />
				</td>
			</tr>
			<tr>
				<td>
					<input class="btn capitalize" type="submit" value="submit" name="submit">
				</td>
			</tr>
		</table>

		<h2>site stats</h2>

		<table>
			<tr>
				<td>
					<label class="capitalize">number of subscribers:</label>
				</td>
				<td>
					<span><?php echo count( $profile_user->get_followers() ); ?></span>
				</td>
			</tr>
		</table>
	</form>

	<div class="clearfix"></div>
</div>

<?php include( 'partials/footer.tpl.php' ); ?>