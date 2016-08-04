<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div id="container">
	<div id="content">	
		<div>
			<h2 class="capitalize"><?php echo $profile_user->full_name(); ?></h2>
			<div class="left">
				<div id="profile_image">
					<img src="<?php echo $profile_img; ?>" />
				</div>

				<br />

				<div class="actions">
					<form action="profile.php?profile_id=<?php echo $profile_user->id; ?>&action=transfer" method="post">
						<input type="hidden" name="sender_id" value="<?php echo $current_user->id; ?>">
						<input type="hidden" name="recipient_id" value="<?php echo $profile_user->id; ?>">
						<input type="hidden" name="max_transfer_amount" value="<?php echo $current_user->balance; ?>">

						<input class="js-amount" type="text" name="amount">
						<input class="js-submit" type="submit" name="submit" value="send money">

						<br /><br />

						<span class="js-error-message"><?php echo $error_message; ?></span>
					</form>
				</div>
			</div>

			<div class="right">
				<table>
					<?php foreach ( User::$db_fields as $field => $value ) { ?>
						<?php if ( $field != 'id' && $field != 'password' && $field != 'ip' && $field != 'verification_key' && $field != 'verified' && $profile_user->$field != '' && $profile_user->$field != '0' ) { ?>
							<tr>
								<?php include( 'partials/profile_info.tpl.php' ); ?>
							</tr>
						<?php } ?>
					<?php } ?>
				</table>
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