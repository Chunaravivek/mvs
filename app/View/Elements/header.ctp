<!DOCTYPE html>
<html class="loaded" lang="en" data-textdirection="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $keywords; ?>">
        <meta name="author" content="VIVEK">
        <title><?php echo $title_for_layout; ?></title>

<!--        <link rel="apple-touch-icon" href="<?php echo URL_PATH; ?>app-assets/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo URL_PATH; ?>app-assets/images/ico/favicon.ico">-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">

        <!-- BEGIN: Vendor JS-->
            <script src="<?php echo URL_PATH; ?>app-assets/vendors/js/vendors.min.js?time=<?php echo time(); ?>"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/vendors/css/vendors.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/vendors/css/weather-icons/climacons.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/fonts/meteocons/style.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/vendors/css/forms/icheck/icheck.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/vendors/css/forms/icheck/custom.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/vendors/css/extensions/toastr.css">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/css/bootstrap-extended.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/css/colors.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/css/components.min.css">
        <!-- END: Theme CSS-->

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/css/core/menu/menu-types/vertical-menu.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/css/core/colors/palette-gradient.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/fonts/simple-line-icons/style.min.css">
        <!--<link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/css/pages/dashboard-ecommerce.min.css">-->
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/css/plugins/extensions/toastr.min.css">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>assets/css/style.css?time=<?php echo time(); ?>">
        <!-- END: Custom CSS-->

        <script src="<?php echo URL_PATH; ?>app-assets/vendors/js/extensions/toastr.min.js"></script>
    </head>

    <body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar  menu-expanded pace-done" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
        <!-- BEGIN: Header-->
        <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
        <!--<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">-->
            <div class="navbar-wrapper">
                <div class="navbar-header">
                    <ul class="nav navbar-nav flex-row">
                        <li class="nav-item mobile-menu d-lg-none mr-auto">
                            <a class="nav-link nav-menu-main menu-toggle hidden-xs is-active" href="#">
                                <i class="ft-menu font-large-1"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="navbar-brand" href="<?php echo URL_PATH; ?>Dashboard">
                                <img class="brand-logo" alt="MVS admin logo" src="<?php echo URL_PATH; ?>app-assets/images/logo/logo.png">
                                <h3 class="brand-text">MVS</h3>
                            </a>
                        </li>
                        <li class="nav-item d-lg-none">
                            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile">
                                <i class="la la-ellipsis-v"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="navbar-container content">
                    <div class="collapse navbar-collapse" id="navbar-mobile">
                        <ul class="nav navbar-nav mr-auto float-left">
                            <li class="nav-item d-none d-lg-block">
                                <a class="nav-link nav-menu-main menu-toggle hidden-xs is-active" href="#">
                                    <i class="ft-menu"></i>
                                </a>
                            </li>
                            <li class="nav-item d-none d-lg-block">
                                <a class="nav-link nav-link-expand" href="#">
                                    <i class="ficon ft-maximize"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav float-right">
                            <li class="dropdown dropdown-user nav-item">
                                <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                    <span class="mr-1 user-name text-bold-700"><?php echo $this->Session->read('full_name'); ?></span>
                                    <span class="avatar avatar-online">
                                        <img src="<?php echo URL_PATH; ?>app-assets/images/portrait/small/avatar-s-19.png" alt="avatar">
                                        <i></i>
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <!--<a class="dropdown-item" href="<?php echo URL_PATH; ?>Profiles"><i class="ft-user"></i> Edit Profile</a>-->
                                    <!--<div class="dropdown-divider"></div>-->
                                    <a class="dropdown-item" href="<?php echo URL_PATH; ?>Admin/logout"><i class="ft-power"></i> Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- END: Header-->
        
        <!-- BEGIN: Main Menu-->
            <?php echo $this->element('leftbar'); ?>
        <!-- END: Main Menu-->

        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-overlay"></div>
    
            <div class="content-wrapper">

