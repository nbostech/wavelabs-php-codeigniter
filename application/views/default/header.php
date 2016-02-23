<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>NBOS CI App</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/front.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">PHP App Server</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">About</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($this->session->userdata("token") !== null) { ?>
                    <li><a href="<?php echo base_url(); ?>member/">Dashboard</a></li>
                    <li><a href="<?php echo base_url(); ?>member/profile/">My Profile</a></li>
                    <li><a href="<?php echo base_url(); ?>member/profile_img/">Profile Image</a></li>
                    <li><a href="<?php echo base_url(); ?>member/change_password/">Change Password</a></li>
                    <li><a href="<?php echo base_url(); ?>home/logout/">Logout</a></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url(); ?>home/signup/">Sign up</a></li>
                    <li><a href="<?php echo base_url(); ?>home/login/">Login</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</header>
<div class="container" style="margin-top: 40px;">

