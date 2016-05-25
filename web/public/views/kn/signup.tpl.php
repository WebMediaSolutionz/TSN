<!-- <h1>SIGNUP PAGE</h1>

<p><?php //echo $message; ?></p>

<form action="signup.php" method="post">
	First Name: <input type="text" name="name" maxlength="30" value="<?php //echo  htmlentities( $first_name ); ?>" />
	Last Name: <input type="text" name="lastname" maxlength="30" value="<?php //echo  htmlentities( $last_name ); ?>" />
	Username: <input type="text" name="username" maxlength="30" value="<?php //echo  htmlentities( $username ); ?>" />
	Sex: 
	<select name="sex">
		<option value="m">Male</option>
		<option value="f">Female</option>
	</select>
	birthdate: <input type="text" name="birthdate" maxlength="30" value="<?php //echo  htmlentities( $birthdate ); ?>" />
	Password: <input type="password" name="password" maxlength="30" value="<?php //echo  htmlentities( $password ); ?>" />
	<input type="submit" name="submit" maxlength="30" value="send" />
</form>

<br />

<a href="login.php">login</a> -->

<!-- ********************************************************* -->

<?php 
	include_once( 'partials/header2.tpl.php' );
?>

<div>
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