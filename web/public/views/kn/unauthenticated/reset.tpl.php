<?php 
    include_once( 'partials/header.tpl.php' );
?>

<div class="content">
    <h1>RESET YOUR PASSWORD</h1>

    <p>Choose another password</p>

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
    <form action="reset.php" method="post">
        <table>
            <tr>
                <td>
                    <label><?php echo $lang[ 'lbl_password' ] ?>: </label>
                </td>
                <td>
                    <input type="password" name="password" maxlength="30" />
                    <input type="hidden" name="user_id" value="<?php echo $user->id; ?>" />
                </td>
            </tr>
        </table>
        
        <br />
        
        <input type="submit" name="submit" value="submit" />
    </form>
    <br />
    <a href="login.php"><?php echo $lang[ 'login' ]; ?></a>
</div>

<?php 
    include_once( 'partials/footer.tpl.php' );
?>