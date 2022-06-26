<?php 
//echo "<pre>";
//print_r($this->params['action']);
//exit;
?>
<div class="main-menu menu-fixed menu-dark menu-native-scroll menu-accordion menu-shadow expanded" data-scroll-to-active="true">
    <div class="main-menu-content ps">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item <?php if($this->params['controller'] == 'Dashboard' && $this->params['action'] == 'index') {echo 'active menu-collapsed-open';} ?>">
                <a href="<?php echo URL_PATH; ?>Dashboard">
                    <i class="la la-dashboard"></i>
                    <span class="menu-title" data-i18n="Dashboard">Dashboard</span>
                </a>
            </li>
            <li class=" nav-item <?php if($this->params['controller'] == 'Dashboard' && $this->params['action'] == 'Stats') {echo 'active menu-collapsed-open';} ?>">
                <a href="<?php echo URL_PATH; ?>Dashboard/Stats">
                    <i class="la la-dashboard"></i>
                    <span class="menu-title" data-i18n="Statistics">Statistics</span>
                </a>
            </li>
            <li class=" nav-item <?php if($this->params['controller'] == 'Accounts') {echo 'active menu-collapsed-open';} ?>">
                <a href="<?php echo URL_PATH; ?>Accounts">
                    <i class="la la-credit-card"></i>
                    <span class="menu-title" data-i18n="Accounts">Accounts</span>
                </a>
            </li>
            <li class=" nav-item <?php if($this->params['controller'] == 'Applications') {echo 'active menu-collapsed-open';} ?>">
                <a href="<?php echo URL_PATH; ?>Applications">
                    <i class="la la-font"></i>
                    <span class="menu-title" data-i18n="Applications">Applications</span>
                </a>
            </li>
            <li class=" nav-item <?php if($this->params['controller'] == 'Ads') {echo 'active menu-collapsed-open';} ?>">
                <a href="<?php echo URL_PATH; ?>Ads">
                    <i class="la la-buysellads"></i>
                    <span class="menu-title" data-i18n="Ads">Ads</span>
                </a>
            </li>
<!--            <li class=" nav-item <?php if($this->params['controller'] == 'DesignTypes') {echo 'active menu-collapsed-open';} ?>">
                <a href="<?php echo URL_PATH; ?>DesignTypes">
                    <i class="la la-mars-double"></i>
                    <span class="menu-title" data-i18n="DesignTypes">Design Types</span>
                </a>
            </li>-->
            <li class="nav-item has-sub <?php echo in_array($this->request['controller'], array('Cities', 'Ipwiseads')) ? 'menu-collapsed-open' : ''; ?>">
                <a href="javascript:void(0);">
                    <i class="la la-play-circle"></i>
                    <span class="menu-title" data-i18n="ip_ads">Ip Ads</span>
                </a>
                <ul class="menu-content">
                    <li class=" nav-item <?php if($this->params['controller'] == 'Cities') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>Cities">
                            <i class="la la-tag"></i>
                            <span class="menu-title" data-i18n="Cities">Cities</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'Ipwiseads') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>Ipwiseads">
                            <i class="la la-tag"></i>
                            <span class="menu-title" data-i18n="Ipwiseads">Ipwiseads</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-sub <?php echo in_array($this->request['controller'], array('PunjabiTagTypes', 'PunjabiTags', 'PunjabiVideos','PunjabiImages')) ? 'menu-collapsed-open' : ''; ?>">
                <a href="javascript:void(0);">
                    <i class="la la-play-circle"></i>
                    <span class="menu-title" data-i18n="Mii_Punjabi">Mii Punjabi</span>
                </a>
                <ul class="menu-content">
<!--                    <li class=" nav-item <?php if($this->params['controller'] == 'PunjabiTagTypes') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>PunjabiTagTypes">
                            <i class="la la-tags"></i>
                            <span class="menu-title" data-i18n="PunjabiTagTypes">Tag Types</span>
                        </a>
                    </li>-->
                    <li class=" nav-item <?php if($this->params['controller'] == 'PunjabiTags') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>PunjabiTags">
                            <i class="la la-tag"></i>
                            <span class="menu-title" data-i18n="Tags">Tags</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'PunjabiVideos') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>PunjabiVideos">
                            <i class="la la-file-video-o"></i>
                            <span class="menu-title" data-i18n="Videos">Videos</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'PunjabiImages') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>PunjabiImages">
                            <i class="la la-image"></i>
                            <span class="menu-title" data-i18n="Images">Images</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($this->params['controller'] == 'PunjabiTextStatus') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>PunjabiTextStatus">
                            <i class="la la-sticky-note-o"></i>
                            <span class="menu-title" data-i18n="PunjabiTextStatus">Text Status</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($this->params['controller'] == 'PunjabiMakers') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>PunjabiMakers">
                            <i class="la la-play-circle"></i>
                            <span class="menu-title" data-i18n="PunjabiMakers">Makers</span>
                        </a>
                    </li>
<!--                    <li class="nav-item has-sub <?php echo in_array($this->request['controller'], array('PunjabiTextCategories', 'PunjabiTextCategories2' ,'PunjabiTextStatus')) ? 'menu-collapsed-open' : ''; ?>">
                        <a href="javascript:void(0);">
                            <i class="la la-text-height"></i>
                            <span class="menu-title" data-i18n="Text Status">Text Status</span>
                        </a>
                        <ul class="menu-content">
                            <li class="nav-item <?php if($this->params['controller'] == 'PunjabiTextCategories') {echo 'active';} ?>">
                                <a href="<?php echo URL_PATH; ?>PunjabiTextCategories">
                                    <i class="la la-list"></i>
                                    <span class="menu-title" data-i18n="PunjabiTextCategories">Text Categories</span>
                                </a>
                            </li>
                            <li class="nav-item <?php if($this->params['controller'] == 'PunjabiTextCategories2') {echo 'active';} ?>">
                                <a href="<?php echo URL_PATH; ?>PunjabiTextCategories2">
                                    <i class="la la-list-alt"></i>
                                    <span class="menu-title" data-i18n="PunjabiTextCategories2">Text Categories2</span>
                                </a>
                            </li>
                            <li class="nav-item <?php if($this->params['controller'] == 'PunjabiTextStatus') {echo 'active';} ?>">
                                <a href="<?php echo URL_PATH; ?>PunjabiTextStatus">
                                    <i class="la la-sticky-note-o"></i>
                                    <span class="menu-title" data-i18n="PunjabiTextStatus">Text Status</span>
                                </a>
                            </li>
                        </ul>
                    </li>-->
                </ul>
            </li>
            <li class="nav-item has-sub <?php echo in_array($this->request['controller'], array('GodTagTypes', 'GodTags', 'GodVideos', 'GodImages')) ? 'menu-collapsed-open' : ''; ?>">
                <a href="javascript:void(0);">
                    <i class="la la-play-circle"></i>
                    <span class="menu-title" data-i18n="Mii_God">Mii God</span>
                </a>
                <ul class="menu-content">
                    <li class=" nav-item <?php if($this->params['controller'] == 'GodTags') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>GodTags">
                            <i class="la la-tag"></i>
                            <span class="menu-title" data-i18n="Tags">Tags</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'GodVideos') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>GodVideos">
                            <i class="la la-file-video-o"></i>
                            <span class="menu-title" data-i18n="Videos">Videos</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'GodImages') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>GodImages">
                            <i class="la la-image"></i>
                            <span class="menu-title" data-i18n="Images">Images</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($this->params['controller'] == 'GodTextStatus') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>GodTextStatus">
                            <i class="la la-sticky-note-o"></i>
                            <span class="menu-title" data-i18n="GodTextStatus">Text Status</span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($this->params['controller'] == 'GodMakers') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>GodMakers">
                            <i class="la la-play-circle"></i>
                            <span class="menu-title" data-i18n="GodMakers">Makers</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-sub <?php echo in_array($this->request['controller'], array('HindiTags', 'HindiVideos', 'HindiImages')) ? 'menu-collapsed-open' : ''; ?>">
                <a href="javascript:void(0);">
                    <i class="la la-play-circle"></i>
                    <span class="menu-title" data-i18n="Mii_Hindi">Mii Hindi</span>
                </a>
                <ul class="menu-content">
                    <li class=" nav-item <?php if($this->params['controller'] == 'HindiTags') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>HindiTags">
                            <i class="la la-tag"></i>
                            <span class="menu-title" data-i18n="Tags">Tags</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'HindiVideos') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>HindiVideos">
                            <i class="la la-file-video-o"></i>
                            <span class="menu-title" data-i18n="Videos">Videos</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'HindiImages') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>HindiImages">
                            <i class="la la-image"></i>
                            <span class="menu-title" data-i18n="Images">Images</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-sub <?php echo in_array($this->request['controller'], array('GujaratiTags', 'GujaratiVideos', 'GujaratiImages')) ? 'menu-collapsed-open' : ''; ?>">
                <a href="javascript:void(0);">
                    <i class="la la-play-circle"></i>
                    <span class="menu-title" data-i18n="Mii_Gujarati">Mii Gujarati</span>
                </a>
                <ul class="menu-content">
                    <li class=" nav-item <?php if($this->params['controller'] == 'GujaratiTags') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>GujaratiTags">
                            <i class="la la-tag"></i>
                            <span class="menu-title" data-i18n="Tags">Tags</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'GujaratiVideos') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>GujaratiVideos">
                            <i class="la la-file-video-o"></i>
                            <span class="menu-title" data-i18n="Videos">Videos</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'GujaratiImages') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>GujaratiImages">
                            <i class="la la-image"></i>
                            <span class="menu-title" data-i18n="Images">Images</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-sub <?php echo in_array($this->request['controller'], array('WishesTags', 'WishesVideos', 'WishesImages')) ? 'menu-collapsed-open' : ''; ?>">
                <a href="javascript:void(0);">
                    <i class="la la-play-circle"></i>
                    <span class="menu-title" data-i18n="Mii_Wishes">Mii Wishes</span>
                </a>
                <ul class="menu-content">
                    <li class=" nav-item <?php if($this->params['controller'] == 'WishesTags') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>WishesTags">
                            <i class="la la-tag"></i>
                            <span class="menu-title" data-i18n="Tags">Tags</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'WishesVideos') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>WishesVideos">
                            <i class="la la-file-video-o"></i>
                            <span class="menu-title" data-i18n="Videos">Videos</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'WishesImages') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>WishesImages">
                            <i class="la la-image"></i>
                            <span class="menu-title" data-i18n="Images">Images</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-sub <?php echo in_array($this->request['controller'], array('Uidesigns', 'Templates')) ? 'menu-collapsed-open' : ''; ?>">
                <a href="javascript:void(0);">
                    <i class="la la-bell-o"></i>
                    <span class="menu-title" data-i18n="Templates">Templates</span>
                </a>
                <ul class="menu-content">
                    <li class=" nav-item <?php if($this->params['controller'] == 'Uidesigns') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>Uidesigns">
                            <i class="la la-reorder"></i>
                            <span class="menu-title" data-i18n="Uidesigns">Ui Designs</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'TemplateTypes') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>TemplateTypes">
                            <i class="la la-reorder"></i>
                            <span class="menu-title" data-i18n="TemplateTypes">Template Types</span>
                        </a>
                    </li>
                    <li class=" nav-item <?php if($this->params['controller'] == 'Templates') {echo 'active';} ?>">
                        <a href="<?php echo URL_PATH; ?>Templates">
                            <i class="la la-reorder"></i>
                            <span class="menu-title" data-i18n="Templates">Templates</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item <?php if($this->params['controller'] == 'Notifications') {echo 'active';} ?>">
                <a href="<?php echo URL_PATH; ?>Notifications">
                    <i class="la la-bell"></i>
                    <span class="menu-title" data-i18n="Notifications">Notifications</span>
                </a>
            </li>
            <li class=" nav-item <?php if($this->params['controller'] == 'Schedules') {echo 'active';} ?>">
                <a href="<?php echo URL_PATH; ?>Schedules">
                    <i class="la la-clock-o"></i>
                    <span class="menu-title" data-i18n="Schedules">Schedules</span>
                </a>
            </li>
            <li class=" nav-item <?php if($this->params['controller'] == 'Users') {echo 'active';} ?>">
                <a href="<?php echo URL_PATH; ?>Users">
                    <i class="la la-users"></i>
                    <span class="menu-title" data-i18n="Users">Users</span>
                </a>
            </li>
<!--            <li class=" nav-item <?php if($this->params['controller'] == 'Key') {echo 'active';} ?>">
                <a href="<?php echo URL_PATH; ?>Key/info">
                    <i class="la la-key"></i>
                    <span class="menu-title" data-i18n="Key">Key</span>
                </a>
            </li>-->
            <li class=" nav-item <?php if($this->params['controller'] == 'Key') {echo 'active';} ?>">
                <a href="<?php echo URL_PATH; ?>Key">
                    <i class="la la-key"></i>
                    <span class="menu-title" data-i18n="Key">Key</span>
                </a>
            </li>
            <li class=" nav-item <?php if($this->params['controller'] == 'Admin') {echo 'active menu-collapsed-open';} ?>">
                <a href="<?php echo URL_PATH; ?>Admin">
                    <i class="la la-user"></i>
                    <span class="menu-title" data-i18n="Admin">Admin</span>
                </a>
            </li>
            <li class=" nav-item <?php if($this->params['controller'] == 'Settings') {echo 'active menu-collapsed-open';} ?>">
                <a href="<?php echo URL_PATH; ?>Settings">
                    <i class="la la-gears"></i>
                    <span class="menu-title" data-i18n="Settings">Settings</span>
                </a>
            </li>
            <li class=" nav-item">
                <a href="<?php echo URL_PATH; ?>Admin/logout">
                    <i class="la la-sign-out"></i>
                    <span class="menu-title" data-i18n="logout">Logout</span>
                </a>
            </li>
        </ul>
<!--        <div class="ps__rail-x" style="">
            <div class="ps__thumb-x" tabindex="0" style=""></div>
        </div>
        <div class="ps__rail-y" style="">
            <div class="ps__thumb-y" tabindex="0" style=""></div>
        </div>-->
    </div>
    
</div>

