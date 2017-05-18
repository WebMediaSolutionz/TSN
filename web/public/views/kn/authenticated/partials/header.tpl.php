<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $page_title; ?></title>

        <link rel="stylesheet" type="text/css" href="views/<?php echo $theme; ?>/authenticated/styles/css/lib/fontawesome/font-awesome.css" />
        
        <link rel="stylesheet" type="text/css" href="views/<?php echo $theme; ?>/authenticated/styles/css/styles.css" />
    </head>
    
    <body>
        <?php include_once("analyticstracking.tpl.php"); ?>
        <input type="hidden" name="stripe_pk" value="<?php echo STRIPE_PUBLIC_KEY; ?>">

        <div class="outer-container">
            <div class="inner-container">
                <header>
                    <div class="section1">
                        <div class="site_title">
                            <div>
                                <h1><a href="home.php"><?php echo $page_title; ?></a></h1>
                            </div>
                        </div>
                        <div class="left">
                            <span class="italics capitalize">the official site of <?php echo $page_title; ?></span>
                        </div>
                        <div class="right capitalize">
                            <span class="greeting">Welcome, <?php echo $current_user->full_name(); ?></span> <div class="pipe"></div> <span><a href="login.php?action=logout">logout</a></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="section2">
                        <img src="<?php echo "UPS/{$profile_user->id}/pictures/site_banner.jpg"; ?>" />
                    </div>
                    
                    <div class="section3">
                        <?php include( 'nav.tpl.php' ); ?>
                    </div> 
                </header>