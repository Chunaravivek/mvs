<?php echo $this->Element('all_form_css'); ?>

<?php 
echo  $this->Element('breadcrumb'); 
?>

<div class="content-body">
    <!-- Panel statistic -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info"><?php echo $admin_count; ?></h3>
                                <h6>Admin</h6>
                            </div>
                            <div>
                                <i class="icon-user info font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-info" style="width: <?php echo $admin_count. '%'; ?>;" role="progressbar" aria-valuenow="<?php echo $admin_count; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="success"><?php echo $apps_count; ?></h3>
                                <h6>Applications</h6>
                            </div>
                            <div>
                                <i class="icon-screen-smartphone success font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-success" style="width: <?php echo $apps_count. '%'; ?>;" role="progressbar" aria-valuenow="<?php echo $apps_count; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="warning"><?php echo $acc_count; ?></h3>
                                <h6>Accounts</h6>
                            </div>
                            <div>
                                <i class="icon-credit-card warning font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-warning" style="width: <?php echo $acc_count. '%'; ?>;" role="progressbar" aria-valuenow="<?php echo $acc_count; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="danger"><?php echo $ads_count; ?></h3>
                                <h6>Ads</h6>
                            </div>
                            <div>
                                <i class="icon-book-open danger font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-danger" style="width: <?php echo $ads_count. '%'; ?>;" role="progressbar" aria-valuenow="<?php echo $ads_count; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="yellow"><?php echo $users_count; ?></h3>
                                <h6>Users</h6>
                            </div>
                            <div>
                                <i class="icon-users yellow font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-yellow" style="width: <?php echo $users_count. '%'; ?>;" role="progressbar" aria-valuenow="<?php echo $users_count; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="purple"><?php echo $punjabi_video_count; ?></h3>
                                <h6>Punjabi Videos</h6>
                            </div>
                            <div>
                                <i class="icon-control-play purple font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-purple" style="width: <?php echo $punjabi_video_count. '%'; ?>;" role="progressbar" aria-valuenow="<?php echo $punjabi_video_count; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="teal"><?php echo $god_video_count; ?></h3>
                                <h6>God Videos</h6>
                            </div>
                            <div>
                                <i class="icon-control-play teal font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-teal" style="width: <?php echo $god_video_count. '%'; ?>;" role="progressbar" aria-valuenow="<?php echo $god_video_count; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Panel statistic -->
</div>

<?php echo $this->Element('all_form_js'); ?>