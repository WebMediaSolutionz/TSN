<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div class="content">
    <h1>Forgot Password</h1>

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
	<form action="identify.php" method="post">
    	<table>
        	<tr>
            	<td>
        			<label><?php echo $lang[ 'lbl_email' ] ?>: </label>
				</td>
                <td>
        			<input type="text" name="username" maxlength="30" />
        		</td>
			</tr>
        </table>
        
        <br />
        
        <input type="submit" name="submit" value="submit" />
    </form>
    <br />
    <a href="signup.php"><?php echo $lang[ 'create an account' ]; ?></a><br />
    <a href="login.php"><?php echo $lang[ 'login' ]; ?></a>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>