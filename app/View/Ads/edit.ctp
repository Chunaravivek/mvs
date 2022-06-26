<?php 

$this->layout = false; 

?>
<style>
    .project-status .btn-group.btn-group-sm,
    .form-group .btn-group.btn-group-sm {
        background-color: #0000002e;
    }
    
    label.col-md-5.label-control.exit_native_ad {
        padding: 0;
        text-align: left;
        width: 33%;
    }
    
    label.col-md-5.label-control.back_ad_count {
/*        text-align: left;
        padding-right: 0;
        max-width: 38%;*/
    }
    
    .form-ads-number {
        max-width: 40%;
        width: 40%
    }
    
    .form-ads-select {
        max-width: 55%;
        width: 55%
    }
    
</style>
<?php
    echo $this->Form->create('Ads', array('url' => '/Ads/save/'.$id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); 
?>
<div class="modal-body">
    <div class="form-body">
        <div class="form-group row">
            <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-xxl-2 label-control" for="acc_id"> Account Name : </label>
            <div class="validations col-12 col-sm-9 col-md-9 col-lg-9 col-xxl-4">
                <div class="controls">
                    <?php
                    echo $this->Form->input('acc_id', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'acc_id1',
                        'type' => 'select',
                        'class' => 'form-control',
                        'empty' => '-- SELECT ACCOUNT-- ',
                        'options' => $accounts
                    ));
                    ?>

                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-xxl-2 label-control" for="app_code"> Apps Name : </label>
            <div class="validations col-12 col-sm-9 col-md-9 col-lg-9 col-xxl-4">
                <div class="controls">
                    <?php
                    echo $this->Form->input('app_code', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'app_code1',
                        'type' => 'select',
                        'class' => 'form-control',
                        'empty' => ' -- Select App -- ',
                        'options' => $applications

                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-3 col-md-3 col-xxl-2 label-control" for="mediation"> Mediation : </label>
            <div class="validations col-12 col-sm-9 col-md-9 col-xxl-4">
                <div class="controls">
                    <?php
                    echo $this->Form->input('mediation', array('error',
                        'type' => 'number',
                        'min' => 0,
                        'max' => 1,
                        'div' => false,
                        'label' => false,
                        'id' => 'mediation',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
                <div class="col-sm-12 text-right">
                    <?php
                    echo '(1=Facebook & 0= Admob)'
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row offset-md-0 offset-lg-1">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-6 col-xxl-4 label-control" for="anim"> Anim : </label>
                <?php
                    echo $this->Form->input('anim', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'anim1',
                        'type' => 'checkbox',
                        'class' => 'form-control',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-6 col-xxl-4 label-control" for="ad_call"> Ad Call : </label>
                <?php
                    echo $this->Form->input('ad_call', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'ad_call1',
                        'type' => 'checkbox',
                        'class' => 'form-control',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-4 label-control" for="qureka_ad"> Qureka Ad : </label>
                <?php
                    echo $this->Form->input('qureka_ad', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'qureka_ad1',
                        'type' => 'checkbox',
                        'class' => 'form-control',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-5 label-control" for="adptive_banner"> Adptive Banner : </label>
                <?php
                    echo $this->Form->input('adptive_banner', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'adptive_banner1',
                        'type' => 'checkbox',
                        'class' => 'form-control',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
        </div>
        <div class="form-group row offset-md-0 offset-lg-1">
            <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-4 label-control" for="app_status"> App Status : </label>
                <?php
                    echo $this->Form->input('app_status', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'app_status1',
                        'type' => 'checkbox',
                        'class' => 'form-control mb-1',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-4 label-control" for="in_house"> in_house : </label>
                <?php
                    echo $this->Form->input('in_house', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'in_house1',
                        'type' => 'checkbox',
                        'class' => 'form-control mb-1',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-4 label-control" for="open_inter"> open_inter : </label>
                <?php
                    echo $this->Form->input('open_inter', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'open_inter1',
                        'type' => 'checkbox',
                        'class' => 'form-control mb-1',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-5 label-control" for="ad_dialogue"> ad_dialogue : </label>
                <?php
                    echo $this->Form->input('ad_dialogue', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'ad_dialogue1',
                        'type' => 'checkbox',
                        'class' => 'form-control mb-1',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
        </div>
        <div class="form-group row offset-md-0 offset-lg-1">
            <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-5 label-control exit_native_ad" for="exit_native_ad"> exit_native_ad : </label>
                <?php
                    echo $this->Form->input('exit_native_ad', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'exit_native_ad1',
                        'type' => 'checkbox',
                        'class' => 'form-control mb-1',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-5 label-control exit_native_ad" for="vpn_detect"> vpn_detect : </label>
                <?php
                    echo $this->Form->input('vpn_detect', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'vpn_detect',
                        'type' => 'checkbox',
                        'class' => 'form-control mb-1',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-5 label-control exit_native_ad" for="banner_native"> banner_native : </label>
                <?php
                    echo $this->Form->input('banner_native', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'banner_native',
                        'type' => 'checkbox',
                        'class' => 'form-control mb-1',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-5 label-control exit_native_ad" for="nav_bar"> nav_bar : </label>
                <?php
                    echo $this->Form->input('nav_bar', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'nav_bar',
                        'type' => 'checkbox',
                        'class' => 'form-control mb-1',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-5 label-control exit_native_ad" for="rec_apps"> rec_apps : </label>
                <?php
                    echo $this->Form->input('rec_apps', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'rec_apps',
                        'type' => 'checkbox',
                        'class' => 'form-control mb-1',
                        'data-group-cls' => 'btn-group-sm',
                    ));

                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-5 label-control exit_native_ad" for="native_pre_load"> native_pre_load : </label>
                <?php
                    echo $this->Form->input('native_pre_load', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'native_pre_load',
                        'type' => 'checkbox',
                        'class' => 'form-control mb-1',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-4 col-xxl-3 mb-1">
                <label class="col-6 col-sm-7 col-md-7 col-xxl-5 label-control exit_native_ad" for="multiple_start"> multiple_start : </label>
                <?php
                    echo $this->Form->input('multiple_start', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'multiple_start',
                        'type' => 'checkbox',
                        'class' => 'form-control mb-1',
                        'data-group-cls' => 'btn-group-sm',
                    ));
                ?>
            </div>
        </div>
        <div class="form-group row offset-md-0 offset-lg-2 offset-xl-1">
            <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-xxl-3 pl-0">
                <div class="row">
                    <label class="col-6 col-sm-4 col-md-6 col-xxl-5 label-control back_ad_count" for="back_ad_count"> Back Ad Count : </label>
                    <?php
                        echo $this->Form->input('back_ad_count', array(
                            'error',
                            'label' => false,
                            'div' => false,
                            'id' => 'back_ad_count',
                            'type' => 'number',
                            'class' => 'form-control form-control-sm input-sm form-ads-number mb-1',
                        ));
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-xxl-3 pl-0">
                <div class="row">
                    <label class="col-6 col-sm-4 col-md-6 col-xxl-5 label-control back_ad_count" for="forward_ad_count"> Forward Ad Count : </label>
                    <?php
                        echo $this->Form->input('forward_ad_count', array(
                            'error',
                            'label' => false,
                            'div' => false,
                            'id' => 'forward_ad_count',
                            'type' => 'number',
                            'class' => 'form-control form-control-sm input-sm form-ads-number mb-1',
                        ));
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-xxl-3 pl-0">
                <div class="row">
                    <label class="col-6 col-sm-4 col-md-6 col-xxl-4 label-control back_ad_count" for="xcount"> Xcount : </label>
                    <?php
                        echo $this->Form->input('xcount', array(
                            'error',
                            'label' => false,
                            'div' => false,
                            'id' => 'xcount',
                            'type' => 'number',
                            'class' => 'form-control form-control-sm input-sm form-ads-number mb-1',
                        ));
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-xxl-3 pl-0">
                <div class="row">
                    <label class="col-6 col-sm-4 col-md-6 col-xxl-4 label-control back_ad_count" for="xminute"> Xminute : </label>
                    <?php
                        echo $this->Form->input('xminute', array(
                            'error',
                            'label' => false,
                            'div' => false,
                            'id' => 'xminute',
                            'type' => 'number',
                            'class' => 'form-control form-control-sm input-sm form-ads-number mb-1',
                        ));
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-xxl-3 pl-0">
                <div class="row">
                    <label class="col-6 col-sm-4 col-md-6 col-xxl-5 label-control back_ad_count" for="native_start_time"> Native Start Time : </label>
                    <?php
                        echo $this->Form->input('native_start_time', array(
                            'error',
                            'label' => false,
                            'div' => false,
                            'id' => 'native_start_time',
                            'type' => 'text',
                            'autocomplete' => 'off',
                            'class' => 'form-control form-control-sm input-sm form-ads-number mb-1',
                        ));
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-xxl-3 pl-0">
                <div class="row">
                    <label class="col-6 col-sm-4 col-md-6 col-xxl-5 label-control back_ad_count" for="native_end_time"> Native End Time : </label>
                    <?php
                        echo $this->Form->input('native_end_time', array(
                            'error',
                            'label' => false,
                            'div' => false,
                            'id' => 'native_end_time',
                            'type' => 'text',
                            'autocomplete' => 'off',
                            'class' => 'form-control form-control-sm input-sm form-ads-number mb-1',
                        ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row offset-md-0 offset-lg-2 offset-xl-1 col-xxl-10">
            <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                <div class="row">
                    <label class="col-5 col-sm-4 col-sm-4 col-md-5 label-control back_ad_count" for="position1"> position1 : </label>
                    <?php
                    $positions1 = array('' => '-- Select Position1 --', '0' => 'inter', '1' => 'open');
                    echo $this->Form->input('position1', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'position1',
                        'class' => 'form-control form-control-sm input-sm form-ads-select mb-1',
                        'empty' => '-- SELECT Position1 -- ',
                        'options' => $positions1,
                    ));  
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                <div class="row">
                    <label class="col-5 col-sm-4 col-sm-4 col-md-5 label-control back_ad_count" for="position2"> position2 : </label>
                    <?php
                    $positions2 = array('' => '-- Select Position2 --', '0' => 'inter', '1' => 'open');
                    echo $this->Form->input('position2', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'position2',
                        'class' => 'form-control form-control-sm input-sm form-ads-select mb-1',
                        'empty' => '-- SELECT Position2 -- ',
                        'options' => $positions2,
                    ));  
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                <div class="row">
                    <label class="col-5 col-sm-4 col-md-5 label-control back_ad_count" for="position3"> position3 : </label>
                    <?php
                    $positions3 = array('' => '-- Select Position3 --', '0' => 'inter', '1' => 'open');
                    echo $this->Form->input('position3', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'position3',
                        'class' => 'form-control form-control-sm input-sm form-ads-select mb-1',
                        'empty' => '-- SELECT Position3 -- ',
                        'options' => $positions3,
                    ));  
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                <div class="row">
                    <label class="col-5 col-sm-4 col-md-5 label-control back_ad_count" for="forward_ad"> forward_ad : </label>
                    <?php
                    $forward_ad = array('' => '-- Select forward_ad --', '0' => 'position1', '1' => 'position2', '2' => 'position3');
                    echo $this->Form->input('forward_ad', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'forward_ad',
                        'class' => 'form-control form-control-sm input-sm form-ads-select mb-1',
                        'empty' => '-- SELECT forward_ad --',
                        'options' => $forward_ad,
                    ));  
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                <div class="row">
                    <label class="col-5 col-sm-4 col-md-5 label-control back_ad_count" for="back_ad"> back_ad : </label>
                    <?php
                    $back_ad = array('' => '-- Select back_ad --', '0' => 'position1', '1' => 'position2', '2' => 'position3');
                    echo $this->Form->input('back_ad', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'back_ad',
                        'class' => 'form-control form-control-sm input-sm form-ads-select mb-1',
                        'empty' => '-- SELECT back_ad -- ',
                        'options' => $back_ad,
                    ));  
                    ?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-xxl-3">
                <div class="row">
                    <label class="col-5 col-sm-4 col-md-5 label-control back_ad_count" for="native_size"> native_size : </label>
                    <?php
                    $native_size = array('' => '-- Select native_size --', '1' => 'small', '2' => 'medium', '3' => 'large');
                    echo $this->Form->input('native_size', array(
                        'error',
                        'label' => false,
                        'div' => false,
                        'id' => 'native_size',
                        'class' => 'form-control form-control-sm input-sm form-ads-select mb-1',
                        'empty' => '-- SELECT native_size -- ',
                        'options' => $native_size,
                    ));  
                    ?>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xxl-12 mb-2 row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 row">
                <label class="col-12 col-sm-4 col-md-12 col-lg-5 col-xxl-2 label-control" for="path"> start_screen : </label>
                <div class="col-12 col-sm-8 col-md-12 col-lg-4 col-xxl-10">
                    <div class="controls">
                        <?php
                        echo $this->Form->input('start_screen', array('error',
                            'div' => false,
                            'label' => false,
                            'id' => 'start_screen',
                            'type' => 'number',
                            'class' => 'form-control',
                            'value' => '1'
                        ));
                        ?>
                    </div>
                </div>

            </div>
            <div class="col-12 col-sm-4 col-md-12 col-lg-8 col-xxl-2 row">
                <label class="col-12 col-sm-4 col-md-12 col-lg-2 col-xxl-2 label-control" for="path"> start_texts : </label>
                <div class="col-12 col-sm-8 col-md-12 col-lg-10 col-xxl-10">
                    <div class="controls">
                        <?php
                        echo $this->Form->input('start_texts', array('error',
                            'div' => false,
                            'label' => false,
                            'id' => 'start_texts',
                            'type' => 'text',
                            'class' => 'form-control',
                            'value' => 'START,LET\'S START,NEXT,CLICK TO START,GET START'
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="path"> app_redirect_path : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('path', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'path',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="url"> live_videocall_url : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('url', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'url',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="ac_name"> Ac Name : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('ac_name', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'ac_name',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="email"> Email : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('email', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'email',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="qureka_url"> Qureka Url : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('qureka_url', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'qureka_url',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_app_id"> google_app_id : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_app_id', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_app_id',
                        'class' => 'form-control',
                        'type' => 'text',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_appopen"> google_appopen : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_appopen', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_appopen',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_appopen_2"> google_appopen_2 : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_appopen_2', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_appopen_2',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_appopen_3"> google_appopen_3 : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_appopen_3', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_appopen_3',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_fullad"> google_fullad : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_fullad', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_fullad',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_fullad_2"> google_fullad_2 : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_fullad_2', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_fullad_2',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_fullad_3"> google_fullad_3 : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_fullad_3', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_fullad_3',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_fullad_splash"> google_fullad_splash : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_fullad_splash', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_fullad_splash',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_reward_ad"> google_reward_ad : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_reward_ad', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_reward_ad',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_banner"> google_banner : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_banner', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_banner',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_native"> google_native : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_native', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_native',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_native_2"> google_native_2 : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_native_2', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_native_2',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_native_3"> google_native_3 : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_native_3', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_native_3',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="google_native_banner"> google_native_banner : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('google_native_banner', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'google_native_banner',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="fb_full_ad"> fb_full_ad : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('fb_full_ad', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'fb_full_ad',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="fb_banner"> fb_banner : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('fb_banner', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'fb_banner',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="fb_full_native"> fb_full_native : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('fb_full_native', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'fb_full_native',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="fb_native_banner"> fb_native_banner : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('fb_native_banner', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'fb_native_banner',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-12 col-sm-4 col-md-3 col-xxl-2 label-control" for="fb_dialog"> fb_dialog : </label>
            <div class="col-12 col-sm-8 col-md-9 col-xxl-10 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('fb_dialog', array('error',
                        'div' => false,
                        'label' => false,
                        'id' => 'fb_dialog',
                        'class' => 'form-control',
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer text-right">
    <button type="submit" id="edit_submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
    <button type="reset" class="btn btn-danger">Reset <i class="la la-refresh position-right"></i></button>
</div>
</form>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready( function () {
        $('#anim1').checkboxpicker();
        $('#ad_call1').checkboxpicker();
        $('#adptive_banner1').checkboxpicker();
        $('#qureka_ad1').checkboxpicker();
        $('#app_status1').checkboxpicker();
        $('#in_house1').checkboxpicker();
        $('#ad_dialogue1').checkboxpicker();
        $('#open_inter1').checkboxpicker();
        $('#exit_native_ad1').checkboxpicker();
        $('#vpn_detect1').checkboxpicker();
        $('#banner_native1').checkboxpicker();
        $('#nav_bar1').checkboxpicker();
        $('#rec_apps1').checkboxpicker();
        $('#native_pre_load1').checkboxpicker();
        $('#multiple_start1').checkboxpicker();
        
        $("#acc_id1").on("select2:close", function (e) {
            $(this).valid();
        });
        
        $("#app_code1").on("select2:close", function (e) {
            $(this).valid();
        });
    });
    
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('#acc_id1').select2({
        allowClear: true,
        placeholder: '-- SELECT ACCOUNT --',
        width: '100%',
    });
    
    $('#app_code1').select2({
        allowClear: true,
        placeholder: '-- SELECT App --',
        width: '100%',
    });
    
    $('#acc_id1').on('select2:select', function (e) {
        var ac_id = e.params.data;
        $('#app_code1').empty(); //remove all existing options
        $.ajax({
            type: 'post',
            url: '<?php echo URL_PATH; ?>Ads/get_application',
            data: {
                'ac_id': ac_id.id
            },
            cache: true,
            success: function (data) {
                $('#app_code1').empty(); //remove all child nodes
                var newOption = $(data);
                $('#app_code1').append(newOption);
                $('#app_code1').val("").trigger("change");

            }
        });
    });
        
    $(document).on('click', '#edit_submit', function () {

    });
    $('#AdsEditForm').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            "data[Ads][acc_id]": {
                required: true,
            },
            "data[Ads][app_code]": {
                required: true,
            },
        },
        submitHandler: function(form) {
            $this = $('#edit_submit');
            $this.prop('disabled', true);
            $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
            form.submit();
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.validations').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
            $(element).siblings('.select2').removeClass('is-valid');
            
            $(element).siblings('.select2').addClass('select-box-section is-invalid');
            $(element).parents('.form-group').find('.label-control').addClass('text-danger');

        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');

            $(element).siblings('.select2').removeClass('select-box-section is-invalid');
            $(element).parents('.form-group').find('.label-control').removeClass('text-danger');

            $(element).siblings('.select2').addClass('select-box-section is-valid');
            $(element).parents('.form-group').find('.label-control').addClass('text-success');
        }
    });
});

</script>
