<!DOCTYPE html>
<html class="loaded" lang="en" data-textdirection="ltr">
    <!-- BEGIN: Head-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="<?php echo $description; ?>">
        <meta name="keywords" content="<?php echo $keywords; ?>">
        <meta name="author" content="VIVEK">
        <title>Admin Login</title>
        
        <!-- BEGIN: Vendor JS-->
        <script src="<?php echo URL_PATH; ?>app-assets/vendors/js/vendors.min.js"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/vendors/css/vendors.min.css">
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
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/css/core/menu/menu-types/vertical-menu.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/css/core/colors/palette-gradient.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>app-assets/css/pages/error.min.css">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo URL_PATH; ?>assets/css/style.css">
        <!-- END: Custom CSS-->

    </head>
    <!-- END: Head-->
    
    <!-- BEGIN: Body-->
    <body class="vertical-layout vertical-menu 1-column blank-page  pace-done" data-open="click" data-menu="vertical-menu" data-col="1-column">
        <!-- BEGIN: Content-->
            <?php echo $this->fetch('content'); ?>
        <!-- END: Content-->
        
        <!-- BEGIN: Page Vendor JS-->
            <script src="<?php echo URL_PATH; ?>app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
            <script src="<?php echo URL_PATH; ?>app-assets/vendors/js/forms/icheck/icheck.min.js"></script>
            
        <!-- END: Page Vendor JS-->
        
        <!-- BEGIN: Theme JS-->
            <script src="<?php echo URL_PATH; ?>app-assets/js/core/app-menu.min.js"></script>
            <script src="<?php echo URL_PATH; ?>app-assets/js/core/app.min.js"></script>
        <!-- END: Theme JS-->
        
        <!-- BEGIN: Page JS-->
            <script src="<?php echo URL_PATH; ?>app-assets/js/scripts/forms/form-login-register.min.js"></script>
        <!-- END: Page JS-->
    <!-- END: Body-->
    </body>
</html>

