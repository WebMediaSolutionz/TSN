<ul class="no_styles right">
    <li class="left hide">
        <a href="#"><span>favourites</span></a>
    </li>
    <li class="left hide">
        <a href="#"><span>conversation</span></a>
    </li>
    <?php if ( $profile_user->id === $current_user->id ) { ?>
        <li class="left">
            <a class="<?php echo ( $current_page_short === 'dashboard' ) ? 'current' : ''; ?>" href="dashboard.php"><i class="fa fa-tachometer" aria-hidden="true"></i></a>
        </li>
    <?php } ?>
    <li class="left">
        <a class="<?php echo ( $current_page_short === 'settings' ) ? 'current' : ''; ?>" href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i></a>
    </li>
    <li class="left hide">
        <a href="login.php?action=logout"><span>logout</span></a>
    </li>
</ul>