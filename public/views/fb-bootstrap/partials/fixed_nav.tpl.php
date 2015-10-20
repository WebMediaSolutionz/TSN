<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php"><?php echo SITE_NAME; ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <!-- <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form> -->
            <ul class="nav navbar-nav navbar-right">
                <li class="left medium_gap<?php echo ( $current_page === 'profile' ) ? ' active' : ''; ?>">
                    <a href="profile.php"><?php echo ucfirst( $current_user->name ); ?></a>
                </li>
                <li class="left medium_gap<?php echo ( $current_page === 'home' ) ? ' active' : ''; ?>">
                    <a href="home.php"><?php echo $lang[ 'home' ]; ?></a>
                </li>
                <!-- <li class="left medium_gap"><a href="messages.php?id={$user_info.id}">messages{$msg_num}</a></li> -->
                <li class="left medium_gap<?php echo ( $current_page === 'notifications' ) ? ' active' : ''; ?>">
                    <a href="notifications.php"><?php echo $lang[ 'notifications' ]; ?></a>
                </li>
                <!-- <li class="left medium_gap"><a href="friends.php">friends{$friends_num}</a></li> -->
                <li class="left medium_gap<?php echo ( $current_page === 'friends' ) ? ' active' : ''; ?>">
                    <a href="friends.php"><?php echo $lang[ 'find_friends' ]; ?></a>
                </li>
                <!-- <li class="left medium_gap"><a href="users.php">all users{$users_num}</a></li> -->
                <li class="left medium_gap<?php echo ( $current_page === 'inbox' ) ? ' active' : ''; ?>">
                    <a href="inbox.php"><?php echo $lang[ 'inbox' ]; ?></a>
                </li>
                <li class="left medium_gap<?php echo ( $current_page === 'settings' ) ? ' active' : ''; ?>">
                    <a href="settings.php"><?php echo $lang[ 'settings' ]; ?></a>
                </li>
                <li class="left medium_gap">
                    <a href="login.php?action=logout"><?php echo $lang[ 'logout' ]; ?></a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>