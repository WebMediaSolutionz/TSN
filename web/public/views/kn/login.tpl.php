<?php 
	include_once( 'partials/header.tpl.php' );
?>
<h1>test</h1>
<div>
	<?php if ( $error_message !== '' ) { ?>
		<div class="error_message">
			<span><?php echo $error_message; ?></span>
		</div>
	<?php } ?>
    <?php if ( isset( $confirmation ) ) { ?>
        <div class="confirmation">
            <span><?php echo $confirmation; ?></span>
        </div>
    <?php } ?>
	<form action="login.php" method="post">
    	<table>
        	<tr>
            	<td>
        			<label><?php echo $lang[ 'lbl_email' ] ?>: </label>
				</td>
                <td>
        			<input type="text" name="username" maxlength="30" />
        		</td>
			</tr>
            <tr>
            	<td>
        			<label><?php echo $lang[ 'lbl_password' ] ?>: </label>
				</td>
                <td>
        			<input type="password" name="password" maxlength="30" />
				</td>
            </tr>
            <tr>
                <td>
                    <a href="identify.php"><?php echo $lang[ 'forgot password' ]; ?></a>
                </td>
			</tr>
        </table>
        
        <br />
        
        <input type="submit" name="submit" value="submit" />
    </form>
    <br />
    <a href="signup.php"><?php echo $lang[ 'create an account' ]; ?></a>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>