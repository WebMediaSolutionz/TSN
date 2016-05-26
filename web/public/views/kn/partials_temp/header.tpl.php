<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $page_title; ?></title>
        
        <link rel="stylesheet" type="text/css" href="styles/<?php echo $theme; ?>/css/styles.css" />
    </head>
    
    <body>
        <div class="outer-container">
            <div class="inner-container">
                <header>
                    <div class="section1">
                        <div class="left">
                            <div>
                                <h3><?php echo $page_title; ?></h3>
                                <span>the official site of <?php echo $page_title; ?></span>
                            </div>
                        </div>
                        <div class="right">
                            <span>Welcome, <?php echo $current_user->full_name(); ?> | <a href="login.php?action=logout">logout</a></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="section2">
                        <img src="images/<?php echo $theme; ?>/site_banner.jpg" />
                    </div>
                    
                    <div class="section3">
                        <nav class="main">
                            <ul class="no_styles left">
                                <li class="left">
                                    <a href="home.php"><span>home</span></a>
                                </li>
                                <li class="left">
                                    <a href="bio.php"><span>about me</span></a>
                                </li>
                                <li class="left">
                                    <a href="calendar.php"><span>calendar</span></a>
                                </li>
                                <li class="left">
                                    <a href="vids.php"><span>videos</span></a>
                                </li>
                                <li class="left">
                                    <a href="pics.php"><span>photos</span></a>
                                </li>
                                <li class="left">
                                    <a href="liveshows.php"><span>live shows</span></a>
                                </li>
                                <li class="left">
                                    <a href="#"><span>tip me</span></a>
                                </li>
                                <li class="left">
                                    <a href="blog.php"><span>blog</span></a>
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
                                <li class="left">
                                    <a href="login.php?action=logout"><span>logout</span></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </nav>
                    </div> 
                </header>