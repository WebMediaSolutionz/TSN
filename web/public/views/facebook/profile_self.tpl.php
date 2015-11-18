<?php 
	include_once( 'header.tpl.php' );
?>

<div id="container">
	<div id="content">	
		<div>
			<?php if ( isset( $message ) ) { ?>
				<div class="<?php echo $message['status']; ?>">
		            <span><?php echo $lang[ $message['prompt_code'] ]; ?></span>
		        </div>
	        <?php } ?>

			<br />

			<h2 class="capitalize"><?php echo str_replace('*user*', $profile_user->full_name(), $lang[ 'users_profile_page' ] ); ?></h2>

			<div id="profile_image" class="left">
				<img src="<?php echo $profile_img; ?>" />
			</div>

			<div class="right">
				<table>
					<tr>
						<td colspan="2"><a class="button" href="profile.php?mode=edit">Edit Profile</a></td>
					</tr>
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

			<?php include( 'partials/the_wall.tpl.php' ); ?>

			<?php include( 'partials/friend_widget.tpl.php' );?>

			<?php include( 'partials/picture_widget.tpl.php' );?>

			<div class="clear"></div>
		</div>			
	</div>
</div>

<?php 
	include_once( 'footer.tpl.php' );
?>