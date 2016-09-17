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
    
	<!-- <form action="signup.php" method="post">
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
    </form> -->

    <!--
    <form action="thanks.php" method="POST">
        <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<?php echo STRIPE_PUBLIC_KEY; ?>"
            data-name="<?php echo SITE_NAME; ?>"
            data-description="membership"
            data-currency="cad"
            data-amount="2000">
        </script>
    </form>
    -->

    <form class="subscription_form" action="thanks.php" method="POST">
        <span class="payment-errors"></span>

        <div class="left">
            <p>get membership</p>
        
            <table>
                <tr>
                    <td><label><?php echo $lang[ 'lbl_firstname' ]; ?>: </label></td>
                    <td><input type="text" name="firstname" /></td>
                </tr>
                <tr>
                    <td><label><?php echo $lang[ 'lbl_lastname' ]; ?>:</label></td>
                    <td><input type="text" name="lastname" /></td>
                </tr>
                <tr>
                    <td><label><?php echo $lang[ 'lbl_email' ]; ?>:</label></td>
                    <td><input type="text" name="username" /></td>
                </tr>
                <tr>
                    <td><label><?php echo $lang[ 'lbl_password' ]; ?>:</label></td>
                    <td><input type="password" name="password" /></td>
                </tr>
                <tr>
                    <td><label>Card Number:</label></td>
                    <td><input type="text" size="20" data-stripe="number"></td>
                </tr>
                <tr>
                    <td><label>Expiration (MM/YY):</label></td>
                    <td><input type="text" size="2" data-stripe="exp_month"> <span> / </span> <input type="text" size="2" data-stripe="exp_year"></td>
                </tr>
                <tr>
                    <td><label>CVC:</label></td>
                    <td><input type="text" size="4" data-stripe="cvc"></td>
                </tr>
            </table>
        </div>

        <div class="left">
            <p>choose membership plan</p>

            <table>
                <tr>
                    <td><input type="radio" name="plan" value="gold" checked></td>
                    <td><label>gold plan</label></td>
                </tr>
                <tr>
                    <td><input type="radio" name="plan" value="silver"></td>
                    <td><label>silver plan</label></td>
                </tr>
                <tr>
                    <td><input type="radio" name="plan" value="bronze"></td>
                    <td><label>bronze plan</label></td>
                </tr>
            </table>
        </div>

        <div class="clear"></div>

        <input type="submit" class="submit" value="<?php echo $lang[ 'submit' ]; ?>">



        <!-- <div class="form-row">
            <label>
                <span>Card Number</span>
                <input type="text" size="20" data-stripe="number">
            </label>
        </div>

        <div class="form-row">
            <label>
                <span>Expiration (MM/YY)</span>
                <input type="text" size="2" data-stripe="exp_month">
            </label>
            <span> / </span>
            <input type="text" size="2" data-stripe="exp_year">
        </div>

        <div class="form-row">
            <label>
                <span>CVC</span>
                <input type="text" size="4" data-stripe="cvc">
            </label>
        </div>

        <input type="submit" class="submit" value="Submit Payment"> -->
    </form>


</div>

<?php 
	include_once( 'partials/footer.tpl.php' );
?>