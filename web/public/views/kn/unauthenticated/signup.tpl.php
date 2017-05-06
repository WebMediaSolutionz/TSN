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

    <form class="subscription_form" action="thanks.php" method="POST">
        <span class="payment-errors"></span>

        <div class="left">
            <p>account information</p>
        
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
            </table>

            <br /><br />

            <p>payment information</p>

            <table>
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

        <div class="left pricepoints">
            <p>choose membership plan</p>

            <table>
                <tr>
                    <td>
                        <a href="#" class="block pricepoint js-action js-pricepoint">
                            <input class="left" type="radio" name="plan" value="bronze">
                            <label class="left">
                                <span class="period">3 Day Trial</span><br />
                                <span class="desc italics">You will be billed $4.95 for the trial period*</span>
                            </label>

                            <div class="right price">
                                <span>$4.</span><sup>95</sup>
                            </div>

                            <div class="clear"></div>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#" class="block pricepoint js-action js-pricepoint">
                            <input class="left" type="radio" name="plan" value="silver">
                            <label class="left">
                                <span class="period">1 Month</span><br />
                                <span class="desc italics">Billed in one payment of $29.99</span>
                            </label>

                            <div class="right price">
                                <span>$29.</span><sup>99</sup><sub>/month</sub>
                            </div>

                            <div class="clear"></div>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#" class="block pricepoint js-action js-pricepoint current">
                            <input class="left" type="radio" name="plan" value="gold" checked>
                            <label class="left">
                                <span class="period">12 Months</span><br />
                                <span class="desc italics">Billed yearly in one installment of $119.99</span>
                            </label>

                            <div class="right price">
                                <span>$10.</span><sup>00</sup><sub>/month</sub>
                            </div>

                            <div class="clear"></div>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="clear"></div>

        <input type="submit" class="btn submit capitalize" value="<?php echo $lang[ 'submit' ]; ?>">



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