<?php if ( $session->is_logged_in() && isset( $current_user ) ) { ?>
<div id="status_bar">
	<div class="inner_container">
		<div class="left">
	    	<a href="home.php"><span><?php echo SITE_NAME; ?></span></a><br />
	    </div>
	    
	    <div class="right">
	    	<ul class="no_list_style no_padding">
	    		<li class="left medium_gap"><a href="blog.php">blog</a></li>
	    		<li class="left medium_gap"><a href="pics.php">pictures</a></li>
                <li class="left medium_gap"><a href="vids.php">videos</a></li>
                <li class="left medium_gap"><a href="calendar.php">calendar</a></li>
	    		<li class="left medium_gap"><a href="bio.php">bio</a></li>
	    		<li class="left medium_gap"><a href="support.php">support</a></
	    		<li class="left medium_gap"><a href="login.php?action=logout"><?php echo $lang[ 'logout' ]; ?></a></li>
	    	</ul>
		</div>
		
		<div class="clear"></div>
	</div>
</div>
<?php } ?>