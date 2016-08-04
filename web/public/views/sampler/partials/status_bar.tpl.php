<?php if ( $session->is_logged_in() && isset( $current_user ) ) { ?>
<div id="status_bar">
	<div class="inner_container">
		<div class="left">
	    	<a href="home.php"><span><?php echo SITE_NAME; ?></span></a><br />
	    </div>
	    
	    <div class="right">
	    	<ul class="no_list_style no_padding">
	    		<li class="left medium_gap"><a href="profile.php">Profile</a></li>
	    		<!-- <li class="left medium_gap"><a href="home.php"><?php // echo $lang[ 'home' ]; ?></a></li> -->
	    		<!-- <li class="left medium_gap"><a href="messages.php?id={$user_info.id}">messages{$msg_num}</a></li> -->
                <!-- <li class="left medium_gap"><a href="notifications.php"><?php // echo $lang[ 'notifications' ]; ?></a></li> -->
	    		<!-- <li class="left medium_gap"><a href="friends.php">friends{$friends_num}</a></li> -->
                <li class="left medium_gap"><a href="friends.php">Users</a></li>
	    		<!-- <li class="left medium_gap"><a href="users.php">all users{$users_num}</a></li> -->
	    		<!-- <li class="left medium_gap"><a href="inbox.php"><?php // echo $lang[ 'inbox' ]; ?></a></li> -->
	    		<!-- <li class="left medium_gap"><a href="settings.php"><?php // echo $lang[ 'settings' ]; ?></a></li> -->
	    		<li class="left medium_gap"><a href="login.php?action=logout"><?php echo $lang[ 'logout' ]; ?></a></li>
	    	</ul>
		</div>
		
		<div class="clear"></div>
	</div>
</div>
<?php } ?>