<nav class="main">
    <ul class="no_styles left">
        <li class="left">
            <a class="<?php echo ( $current_page_short === 'home' ) ? 'current' : ''; ?>" href="home.php"><span>home</span></a>
        </li>
        <li class="left">
            <a class="<?php echo ( $current_page_short === 'bio' ) ? 'current' : ''; ?>" href="bio.php"><span>about me</span></a>
        </li>
        <li class="left">
            <a class="<?php echo ( $current_page_short === 'calendar' ) ? 'current' : ''; ?>" href="calendar.php"><span>calendar</span></a>
        </li>
        <li class="left">
            <a class="<?php echo ( $current_page_short === 'vids' || $current_page_short === 'video' ) ? 'current' : ''; ?>" href="vids.php"><span>videos</span></a>
        </li>
        <li class="left">
            <a class="<?php echo ( $current_page_short === 'album' || $current_page_short === 'picture' ) ? 'current' : ''; ?>" href="album.php?user_id=<?php echo PROFILE_USER; ?>"><span>photo sets</span></a>
        </li>
        <li class="left">
            <a class="<?php echo ( $current_page_short === 'liveshows' ) ? 'current' : ''; ?>" href="liveshows.php"><span>live shows</span></a>
        </li>
        <li class="left">
            <a class="<?php echo ( $current_page_short === 'tips' ) ? 'current' : ''; ?>" href="#"><span>tip me</span></a>
        </li>
        <li class="left">
            <a class="<?php echo ( $current_page_short === 'blog' ) ? 'current' : ''; ?>" href="blog.php"><span>blog</span></a>
        </li>
    </ul>

    <ul class="no_styles right">
        <li class="left">
            <a href="#"><span>favourites</span></a>
        </li>
        <li class="left">
            <a href="#"><span>conversation</span></a>
        </li>
        <li class="left">
            <a href="#"><span>settings</span></a>
        </li>
        <li class="left hide">
            <a href="login.php?action=logout"><span>logout</span></a>
        </li>
    </ul>
    <div class="clearfix"></div>
</nav>