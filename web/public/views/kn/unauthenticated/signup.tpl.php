<?php 
	include_once( 'partials/header.tpl.php' );
?>

<div class="content">
    <h1>sign up</h1>

	<?php if ( $error_message !== '' ) { ?>
		<div class="error_message">
			<span><?php echo $error_message; ?></span>
		</div>
	<?php } ?>
    
	<form action="signup.php" method="post">
    	<table>
        	<tr>
            	<td><label><?php echo $lang[ 'lbl_firstname' ]; ?>: </label></td>
                <td><input type="text" name="name" id="name" /></td>
            </tr>
            <tr>
            	<td><label><?php echo $lang[ 'lbl_lastname' ]; ?>:</label></td>
                <td><input type="text" name="lastname" /></td>
            </tr>
            <tr>
            	<td><label><?php echo $lang[ 'lbl_email' ]; ?>:</label></td>
                <td><input type="text" name="username" id="username" /></td>
            </tr>
            <tr>
            	<td><label><?php echo $lang[ 'lbl_sex' ]; ?>:</label></td>
                <td>
                	<select class="small" name="sex">
                    	<option value="neither"><?php echo $lang[ 'choose_gender' ]; ?></option>
                        <option value="m"><?php echo $lang[ 'male' ]; ?></option>
                        <option value="f"><?php echo $lang[ 'female' ]; ?></option>
                    </select>
                </td>
            </tr>
            <tr>
            	<td><label><?php echo $lang[ 'lbl_birthdate' ]; ?>:</label></td>
                <td><input type="text" name="birthdate" /></td>
            </tr>
            <tr>
            	<td><label><?php echo $lang[ 'lbl_password' ]; ?>:</label></td>
                <td><input type="password" name="password" id="password" /></td>
            </tr>
            <tr>
            	<td></td>
                <td></td>
            </tr>
        </table>
        
        <br />
        
        <input type="submit" name="submit" value="<?php echo $lang[ 'submit' ]; ?>" />

        <br /><br />

		<a href="login.php"><?php echo $lang[ 'login' ]; ?></a>
    </form>
</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>