        </div>
    </div>
    <!-- END: Content-->
    
    <!-- BEGIN: Customizer-->
        <?php echo $this->Element('customizer'); ?>
    <!-- End: Customizer-->
    
    <!-- BEGIN: Footer-->
        <footer class="footer footer-static footer-light navbar-border navbar-shadow">
            <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
                <span class="float-md-left d-block d-md-inline-block">Copyright © 2019 
                    <a class="text-bold-800 grey darken-2" href="<?php echo URL_PATH; ?>Dashboard">Home</a>
                </span>
                <span class="float-md-right d-none d-lg-block">Hand-crafted &amp; Made with<i class="ft-heart pink"></i>
                    <span id="scroll-top" style="display: inline;">
                    </span>
                </span>
            </p>
        </footer>
    <!-- END: Footer-->
    <div class="sidenav-overlay d-none" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
    <div class="drag-target" style="touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div>
    <!-- BEGIN: Theme JS-->
        <script src="<?php echo URL_PATH; ?>app-assets/js/core/app-menu.min.js"></script>
        <script src="<?php echo URL_PATH; ?>app-assets/js/core/app.min.js"></script>
        <script src="<?php echo URL_PATH; ?>app-assets/js/scripts/customizer.min.js"></script>
        <script src="<?php echo URL_PATH; ?>app-assets/js/scripts/footer.min.js"></script>
        <!--<script src="<?php echo URL_PATH; ?>app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>-->
    <!-- END: Theme JS-->
    
    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
    
    
    <script>
        $(document).ready( function () {
        });
    </script>
    <!-- END: Body-->
</body>
</html>
