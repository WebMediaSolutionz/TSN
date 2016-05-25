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
                            <a href="home.php">
                                <h1 class="uppercase"><?php echo $page_title; ?></h1>
                                <span class="uppercase">official website of <?php echo $page_title; ?></span>
                            </a>
                        </div>
                        <div class="right">
                            <?php if ( Utils::current_page( 'short' ) !== 'login' ) { ?>
                                <a class="capitalize" href="login.php">member login</a>
                            <?php } ?>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="section2">
                        <img src="images/<?php echo $theme; ?>/site_banner.jpg" />
                    </div>
                    
                    <div class="section3">
                        <?php include( 'nav.tpl.php' );?>
                    </div> 
                </header>