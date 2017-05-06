<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div class="content">
    <h1><?php echo $page_title; ?></h1>
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
					<input type="text" name="username" />
        		</td>
			</tr>
            <tr>
            	<td>
        			<label><?php echo $lang[ 'lbl_password' ] ?>: </label>
				</td>
                <td>
					<input type="password" name="password" />
				</td>
            </tr>
            <tr>
                <td>
					<a href="identify.php"><?php echo $lang[ 'forgot password' ]; ?></a>
                </td>
			</tr>
        </table>
        
        <br />
        
        <input class="btn left capitalize" type="submit" name="submit" value="submit" />
        <a class="btn capitalize left left_gap" href="signup.php"><?php echo $lang[ 'create an account' ]; ?></a>
        <div class="clearfix"></div>
    </form>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>