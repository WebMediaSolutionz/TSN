<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div id="container">
	<div id="content">	
		<div>
			<h2 class="capitalize"><?php echo $profile_user->full_name(); ?></h2>
			<div id="profile_image" class="left">
				<img src="<?php echo $profile_img; ?>" />
			</div>

			<div class="right">
				<form action="profile.php" enctype="multipart/form-data" method="POST">
					<table>
						<?php foreach ( User::$db_fields as $field => $value ) { ?>
							<?php if ( $field != 'id' && $field != 'password' && $field != 'ip' && $field != 'verification_key' && $field != 'verified' ) { ?>
								<tr>
									<td><?php echo $lang[ 'lbl_' . $field ]; ?>: </td>
									<td class="text_align_right">
										<?php 
											$input_value = null;

											switch ( $field ) {
												case 'sex'				:		
												case 'interested_in'	:
												case 'relationship'		:
												case 'province'			:
												case 'state'			:
												case 'country'			:		echo "<select name='{$field}'>";

																				$index = "lbl_{$field}_arr";
																				foreach ( $lang[ $index ] as $field_key => $field_value ) {
																					$selected = ( $profile_user->$field == $field_key ) ? 'selected' : '';
																					echo "<option value='{$field_key}' {$selected}>{$field_value}</option>";
																				}

																				echo "</select>";
																				break;

												default 				:		$input_value = $profile_user->$field;
																				echo "<input type='text' name='{$field}' value='{$input_value}' />";
																				break;
											}
										 ?>
									</td>
								</tr>
							<?php } ?>
						<?php } ?>
						<tr>
							<td><?php echo $lang[ 'lbl_profile_picture' ]; ?>:</td>
							<td>
								<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo IMG_MAX_UPLOAD_SIZE; ?>" />
								<input type="file" name="profile_picture" />
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<a class="btn left" href="profile.php"><?php echo $lang[ 'cancel' ]; ?></a>
								<input class="btn left margin-left" type="submit" name="submit" value="<?php echo $lang[ 'save' ]; ?>" />
								<div class="clear"></div>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="clear"></div>

			<div style="visibility: hidden;">
				<span>id: 19</span><br />
				<span>Name: <a href="profile.php?id=">mckenzy2</a></span><br />
				<span>email: the.max.mckenzy@gmail.com</span><br />
			</div>

			<div class="clear"></div>
		</div>			
	</div>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>