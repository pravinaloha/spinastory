<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Spin A Story">
        <meta name="keyword" content="SpinaStory">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">

        <title><?php echo $this->config->item('page_title'); ?></title>

        <!-- Put Header file here -->
        <?php echo put_headers(); ?>
        
        <?php $strBaseUrl   = base_url(); ?>

        <!-- Set java-script constant variables here -->
        <script>
            var base_url    = '<?php echo $strBaseUrl; ?>';
            var page_count  = '<?php echo $this->config->item('page_count'); ?>';
        </script>
        
    </head>
    <body>
        <span id="page_count" val="<?php echo $this->config->item('page_count'); ?>"></span>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand show_stories" href="<?php echo $strBaseUrl; ?>">SpinAStory</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="<?php echo $strBaseUrl; ?>" class="show_stories" title="Stories">Stories</a>
                            <span class="story-bubble">0</span>
                        </li>
                        <li>
                            <a href="<?php echo $strBaseUrl; ?>friend" class="show_friends" title="Friends">Friends</a>
                            <span class="friend-bubble">0</span>
                        </li>
                        <li>
                            <a href="<?php echo $strBaseUrl; ?>notification" class="show_notifications" title="Notifications">Notifications</a>
                            <span class="notification-bubble">0</span>
                        </li>
                    </ul>
                    
                    <div id="notification" class="hide"><div class="notification"></div></div>
                    <div id="friend" class="hide"><div class="friend"></div></div>
                    <div id="story" class="hide"><div class="story"></div></div>
                    
                </div>
            </div>
            <div class="spin_header_message hide"></div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-3 col-md-13 col-md-offset-0 main">