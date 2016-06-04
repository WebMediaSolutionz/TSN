<nav class="main">
    <ul class="no_styles left">
        <li class="left">
            <a class="<?php echo ( $current_page === 'home' ) ? 'current' : ''; ?>" href="home.php"><span>home</span></a>
        </li>
        <li class="left">
            <a class="<?php echo ( $current_page === 'bio' ) ? 'current' : ''; ?>" href="bio.php"><span>about me</span></a>
        </li>
        <li class="left hide">
            <a class="<?php echo ( $current_page === 'calendar' ) ? 'current' : ''; ?>" href="calendar.php"><span>calendar</span></a>
        </li>
        <li class="left">
            <a class="<?php echo ( $current_page === 'vids' ) ? 'current' : ''; ?>" href="vids.php"><span>videos</span></a>
        </li>
        <li class="left">
            <a class="<?php echo ( $current_page === 'album.php' ) ? 'current' : ''; ?>" href="album.php?user_id=<?php echo PROFILE_USER; ?>"><span>photo sets</span></a>
        </li>
        <li class="left hide">
            <a class="<?php echo ( $current_page === 'liveshows.php' ) ? 'current' : ''; ?>" href="liveshows.php"><span>live shows</span></a>
        </li>
        <li class="left hide">
            <a class="<?php echo ( $current_page === 'tips' ) ? 'current' : ''; ?>" href="#"><span>tip me</span></a>
        </li>
        <li class="left">
            <a class="<?php echo ( $current_page === 'blog' ) ? 'current' : ''; ?>" href="blog.php"><span>blog</span></a>
        </li>
    </ul>

    <ul class="no_styles right">
        <li class="left">
            <a href="signup.php"><span>join me</span></a>
        </li>
    </ul>
    <div class="clearfix"></div>
</nav>