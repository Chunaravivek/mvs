<?php
    echo $this->Element('all_form_css'); 
?>

<?php echo  $this->Element('breadcrumb'); ?>

<style>
    p.help-block > ul {
        padding: 0 !important;
    }
    
/*    .modal {
        z-index: 9999 !important;
    }*/
    
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
    
    @media screen and (max-width: 375px) {
        .form-ads-number {
            max-width: 40%;
            width: 40%
        }

        .form-ads-select {
            max-width: 50%;
            width: 50%
        }
        
        .col-12.col-sm-12.col-md-6.col-xl-4.col-xxl-3.pl-0 {
            padding-left: 15px !important;
        }
    }
    
    .dt-buttons.btn-group {
        float: right;
    }
    
    div#DataTables_Table_0_filter {
        margin-right: 10px;
    }
    
</style>
<div class="content-body">
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <?php echo $this->Session->flash(); ?>
                    <div class="card-header">
                        <h4 class="card-title">Manage Ipwiseads</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-2 apps-box-button">
                                <button type="button" class="btn btn-outline-primary btn-glow mr-1 mb-1 mt-2" data-backdrop="static" data-keyboard="false"  data-toggle="modal" data-target="#modal-default">
                                    <i class="la la-plus"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-glow mr-1 mb-1 mt-2" id="delete_multiple">
                                    <i class="la la-trash"></i>
                                </button>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-2">
                                <div class="form-group">
                                    <label>Account Name</label>
                                    <select class="form-control" id="form-field-select-1">
                                        <option value="">-- SELECT ACCOUNT --</option>
                                        <?php foreach ($accs as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
<!--                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-2">
                                <div class="form-group">
                                    <label>Apps Name</label>
                                    <select class="form-control" id="form-field-select-2">
                                        <option value="">-- SELECT APPS --</option>
                                        <?php foreach ($apps as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                            <table class="table table-striped table-bordered" id="DataTables_Table_0">
                                <thead>
                                    <tr>
                                        <th class="check">
                                            <input type="checkbox" id="selectAll" value="" />
                                        </th>
                                        <th>id</th>
                                        <th>Account Name</th>
                                        <th>App Name</th>
                                        <th>Area</th>
                                        <th>Status</th>
                                        <th>Updated Status</th>
                                        <th>Created Date</th>
                                        <th>Modified Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>id</th>
                                        <th>Account Name</th>
                                        <th>App Name</th>
                                        <th>Area</th>
                                        <th>Status</th>
                                        <th>Updated Status</th>
                                        <th>Created Date</th>
                                        <th>Modified Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal animated" id="modal-default" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Ipwiseads</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php echo $this->Form->create('Ipwiseads', array('url' => array('controller' => 'Ipwiseads', 'action' => 'add'), 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); ?>
            
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
                                        'id' => 'acc_id',
                                        'type' => 'select',
                                        'class' => 'form-control',
                                        'options' => false,
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
                                        'id' => 'app_code',
                                        'type' => 'select',
                                        'class' => 'form-control',
                                        
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12 col-sm-3 col-md-3 col-lg-3 col-xxl-2 label-control" for="ip"> Area : </label>
                            <div class="validations col-12 col-sm-9 col-md-9 col-lg-9 col-xxl-4">
                                <div class="controls">
                                    <?php
                                        $types_arr = array(1 => 'City' , 2 => 'State', 3 => 'Country');
                                        echo $this->Form->input('city_id', array('error',
                                            'label' => false,
                                            'div' => false,
                                            'id' => 'ip',
                                            'type' => 'select',
                                            'multiple' => 'multiple',
                                            'class' => 'form-control',
                                            'empty' => '-- SELECT Types -- ',
                                            'options' => $ip

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
                                        'value' => '0'
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
                                        'id' => 'anim',
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
                                        'id' => 'ad_call',
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
                                        'id' => 'qureka_ad',
                                        'type' => 'checkbox',
                                        'class' => 'form-control',
                                        'data-group-cls' => 'btn-group-sm',
                                        'default' => '1',
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
                                        'id' => 'adptive_banner',
                                        'type' => 'checkbox',
                                        'class' => 'form-control',
                                        'data-group-cls' => 'btn-group-sm',
                                        'default' => '1',
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
                                        'id' => 'app_status',
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
                                        'id' => 'in_house',
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
                                        'id' => 'open_inter',
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
                                        'id' => 'ad_dialogue',
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
                                        'id' => 'exit_native_ad',
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
                                        'value' => '1',
                                        'default' => '1',
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
                                        'value' => '1',
                                        'default' => '1',
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
                                        'value' => '1',
                                        'default' => '1',
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
                                        'value' => '1',
                                        'default' => '1',
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
                                            'value' => '0',
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
                                            'value' => '0',
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
                                            'value' => '3',
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
                                            'value' => '1',
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
                                            'value' => '09:10',
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
                                            'value' => '23:59',
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
                                        'value' => '3',
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
                                        'value' => 'https://play.google.com/store/apps/details?id=com.bhulekh.anyror.satbarautara.gujaratbhulekh.landrecords.gujaratROR'
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
                                        'value' => 'https://api.airtable.com/v0/appNNVZVVuqCOSiJL/roomvideo?api_key=keyUoKrn18vvgYnKd&sort%5B0%5D%5Bfield%5D=ID'
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
                                        'value' => 'ac_name'
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
                                        'value' => 'girl6g4@gmail.com'
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
                                        'value' => 'http://1341.win.qureka.com/'
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
                                        'value' => 'test',
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
                                        'value' => 'ca-app-pub-3940256099942544/3419835294'
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
                                        'value' => 'ca-app-pub-3940256099942544/3419835294'
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
                                        'value' => 'ca-app-pub-3940256099942544/3419835294'
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
                                        'value' => 'ca-app-pub-3940256099942544/1033173712'
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
                                        'value' => 'ca-app-pub-3940256099942544/1033173712'
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
                                        'value' => 'ca-app-pub-3940256099942544/1033173712'
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
                                        'value' => 'ca-app-pub-3940256099942544/1033173712'
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
                                        'value' => 'ca-app-pub-3940256099942544/3419835294'
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
                                        'value' => 'ca-app-pub-3940256099942544/6300978111'
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
                                        'value' => 'ca-app-pub-3940256099942544/2247696110'
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
                                        'value' => 'ca-app-pub-3940256099942544/2247696110'
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
                                        'value' => 'ca-app-pub-3940256099942544/2247696110'
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
                                        'value' => 'ca-app-pub-3940256099942544/2247696110'
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
                                        'value' => ''
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
                                        'value' => ''
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
                                        'value' => ''
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
                                        'value' => ''
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
                                        'value' => ''
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer text-right">
                    <button type="submit" id="add_submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
                    <button type="reset" class="btn btn-danger">Reset <i class="la la-refresh position-right"></i></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal data Delete -->
<div id="conf-modal-dialog" title="Confirm">
    Are you sure want to delete this record?
</div>

<!-- Modal data details edit -->
<div class="modal animated bd-example-modal-lg" id="edit" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Ipwiseads</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="Edit-Content">

            </div>
        </div>
    </div>
</div>

<?php echo $this->Element('all_form_js'); ?>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready( function () {
        $('#anim').checkboxpicker();
        $('#ad_call').checkboxpicker();
        $('#adptive_banner').checkboxpicker();
        $('#qureka_ad').checkboxpicker();
        $('#app_status').checkboxpicker();
        $('#in_house').checkboxpicker();
        $('#ad_dialogue').checkboxpicker();
        $('#open_inter').checkboxpicker();
        $('#exit_native_ad').checkboxpicker();
        $('#vpn_detect').checkboxpicker();
        $('#banner_native').checkboxpicker();
        $('#nav_bar').checkboxpicker();
        $('#rec_apps').checkboxpicker();
        $('#native_pre_load').checkboxpicker();
        $('#multiple_start').checkboxpicker();
    });
</script>

<script type="text/javascript" language="javascript" class="init">
    $(document).ready( function () {
      
        $('#acc_id').select2({
            allowClear: true,
            placeholder: '-- SELECT ACCOUNTS --',
            width: '100%',
            ajax: {
                url: '<?php echo URL_PATH;?>Ipwiseads/AccountsSelect',
                dataType: 'json',
                data: function (data) {
                    return {
                        searchTerm: data.term // search term
                    };
                },
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                      results: data
                    };
                },
                cache: true
            }
        });
        
        $('#app_code').select2({
            allowClear: true,
            placeholder: '-- SELECT App --',
            width: '100%',
        });
        
        $('#acc_id').on('select2:select', function (e) {
            var ac_id = e.params.data;
            $('#app_code').empty(); //remove all existing options
            $.ajax({
                type: 'post',
                url: '<?php echo URL_PATH; ?>Ipwiseads/get_application',
                data: {
                    'ac_id': ac_id.id
                },
                cache: true,
                success: function (data) {
                    $('#app_code').empty(); //remove all child nodes
                    var newOption = $(data);
                    $('#app_code').append(newOption);
                    $('#app_code').val("").trigger("change");
                }
            });
        });
        
        $('#form-field-select-1').select2({
            allowClear: true,
            placeholder: '-- SELECT ACCOUNT --',
            width: '100%',
        });
        
        $('#form-field-select-2').select2({
            allowClear: true,
            placeholder: '-- SELECT APPS --',
            width: '100%',
        });
        
        var url = "<?php echo URL_PATH;?>Ipwiseads/records.json";
        $("#DataTables_Table_0").DataTable({
            'dom': "<'row'<'col-sm-12'>>" +"<'row'<'col-sm-12'>>" +"<'row ads_manager_report'<'col-sm-6'l><'col-12 col-sm-12 text-center col-md-6'Bf>>t<'row'<'col-sm-12 col-md-5 columns'i><'col-sm-12 col-md-7 columns'p>>",
            buttons: [
                {
                    extend: 'colvis',
                    postfixButtons: [ 'colvisRestore' ],
                    columns: '1,2,3,4,5,6,7,8',
                    className : '',
                },
            ],
            
            "responsive"  : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'asutoWidth'  : false,
            'autoWidth'   : false,
            "bAutoWidth"  : false,
            'lengthMenu'  : [[10, 20, 25, 50, -1], [10, 20, 25, 50, 'All']],
            'serverSide'  : true,
            'processing'  : true,
            "sAjaxSource" : url,
            "aaSorting"   : [[8, "desc"]], 
            aoColumns: [
                {
                    "targets": 0,
                    "searchable": false,
                    "data": null,
                    "wrap": false,
                    "paging": false,
                    "bSortable": false,
                    "orderable": false,
                    "bSort": false,
                    "bSearchable": false,
                    'width': '1%',
                    "mRender": function (mData, type, full) {
                        return  '<input type="checkbox" id="checkall" class="video_checkbox" name="mydata" data-video-id=' + mData.Ipwiseads.id + '>';
                    },
                },
                {mData: 'Ipwiseads.id'},
                {mData: 'Ipwiseads.account_name',"searchable": false,"bSortable": false,"orderable": false},
                {mData: 'Ipwiseads.app_name'},
                {mData: 'Ipwiseads.ip'},
                {mData: 'Ipwiseads.status','class':'project-status'},
                {mData: 'Ipwiseads.update_status'},
                {mData: 'Ipwiseads.created_date'},
                {mData: 'Ipwiseads.modified_date'},
                {
                    "targets": -1,
                    "searchable": false,
                    "data": null,
                    "wrap": true,  
                    "bSortable": false,
                    "orderable": false,
                    "mRender": function(mData, type, full) {  
//                        var View = '<a href="#" class="btn btn-sm btn-app bg-info" data-backdrop="static" data-keyboard="false" title="View Ipwiseads" onclick="ViewModal('+mData.Ipwiseads.id+')"><i class="fas fa-info"></i></a>';
                        var edit = '<a href="javascript:void(0);" class="btn btn-primary btn-sm mr-2" data-target="#modal-edit" data-backdrop="static" data-keyboard="false" title="Edit Ipwiseads" onclick="EditModal('+mData.Ipwiseads.id+')"><i class="ft-edit-1"></i></a>';
                        var delete_id = '<a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Delete Ipwiseads" onclick="deleteModal('+mData.Ipwiseads.id+')"><i class="ft-trash-2"></i></a>';
                        return   edit + delete_id;
                    },


                },
            ],
            "fnRowCallback" : function(nRow, aData,iDisplayIndex) {
//                $('td', nRow).eq(0).html(iDisplayIndex + 1);
            },
            
            "fnCreatedRow": function(nRow, mData, iDataIndex){ 
             
                if (mData.Ipwiseads.status == '1') {
                    $('td:eq(5)', nRow).html('<input type="checkbox" checked class="Ipwiseads_status" id="'+mData.Ipwiseads.id+'" data-group-cls="btn-group-sm" hidden="">');
                } else {
                    $('td:eq(5)', nRow).html('<input type="checkbox" class="Ipwiseads_status" id="'+mData.Ipwiseads.id+'" data-group-cls="btn-group-sm" hidden="">');
                }
                
                if (mData.Ipwiseads.update_status == '1') {
                    $('td:eq(6)', nRow).html('Not Updated');
                } else {
                    $('td:eq(6)', nRow).html('Updated');
                }
             
            },
            "fnDrawCallback": function() {
                $('.Ipwiseads_status').checkboxpicker();
               
                $('.Ipwiseads_status:checkbox').checkboxpicker().on('change', function() {
                    var id = $(this).attr('id');
                    var isChecked = $(this).is(':checked');
                    var status_val = 2;
                    if (isChecked) {
                        status_val = 1;
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'Ipwiseads/update_status',
                        data: {
                            'id': id, 'status_val': status_val,
                        },
                        success: function (msg) {
                            //alert('done' + msg);
                        }
                    });
                });
                
                $('#selectAll').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    labelHover: true,
                    cursor: true,
                    
                });
                
                $('.video_checkbox').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    labelHover: true,
                    cursor: true
                });
                
                $('#selectAll').on('ifChanged', function(event){
                    
                    if (event.target.checked == true) {
                        $('.video_checkbox').iCheck('check');
                    } else {
                        $('.video_checkbox').iCheck('uncheck');
                    }
                });
                
                $('.video_checkbox').on('ifUnchecked', function(){
                    $("th.check.sorting_disabled").find('.icheckbox_flat-green.checked').removeClass('checked');
                });
            }
        }); 
        
        $('#form-field-select-1').on('change', function(e) {
            var acc_id = $(this).val();
            var app_name = $('#form-field-select-2').val();
            $('#DataTables_Table_0').DataTable().ajax.url("Ipwiseads/records?acc_id="+acc_id).load();
        });
        
//        $('#form-field-select-2').on('change', function(e) {
//            var account_id = $(this).val();
//            var account_id = $('#form-field-select-1').val();
//            $('#DataTables_Table_0').DataTable().ajax.url("Applications/records?account_id="+account_id).load();
//        });
    });
    
    $(function () { 
        $('#IpwiseadsAddForm').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                "data[Ipwiseads][acc_id]": {
                    required: true,
                },
                "data[Ipwiseads][app_code]": {
                    required: true,
                },
                
                "data[Ipwiseads][city_id][]": {
                    required: true,
                },
                
            },
            
            submitHandler: function(form) {
                $this = $('#add_submit');
                $this.prop('disabled', true);
                $this.css('cursor', 'no-drop');
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
        
        $("#acc_id").on("select2:close", function (e) {
            $(this).valid();
        });
        
        $("#app_code").on("select2:close", function (e) {
            $(this).valid();
        });
        
        $("#ip").on("select2:close", function (e) {
            $(this).valid();
        });
    });

    
    $( "#conf-modal-dialog" ).hide();
    function deleteModal(id) {
        $( "#conf-modal-dialog" ).show();
        $( "#conf-modal-dialog" ).dialog({
            autoOpen: true,
            resizable: false,
            height: "auto",
            width: 400,
            modal: true,
            buttons :  { 
                "MyButton" : {
                    text: "OK",
                    id: "confirmOk",
                    click: function(){
                        $("#confirmOk").attr('data-user', id);
                        $this = $('#confirmOk');
                        $this.prop('disabled', true);
                        $this.css('cursor', 'no-drop');
                        var this_delete = $("#confirmCancel");
                        this_delete.remove();
                        $this.html('<span class="spinner-border spinner-border-sm" disabled role="status" aria-hidden="true" style="cursor: no-drop;"></span>Loading...');
                        window.location.href= "<?php echo $this->webroot; ?>Ipwiseads/delete/"+id;
                    }   
                }, 
                "MyButton1" : {
                    text: "Cancel",
                    id: "confirmCancel",
                    click: function(){
                        $(this).dialog('close');
                    }   
                } 
            }
        });
    }
    
    $(function() {
    });
    
    function EditModal(id) {
        $('#edit').modal({
            backdrop: 'static',
            keyboard: false
        });
        $("#edit").modal('show');	
        $("#edit").attr('data-user', id);

        $.ajax({
            type:"POST",
            dataType: '',
            data:{id:id}, 
            url:"<?php echo URL_PATH;?>Ipwiseads/edit",
            cache:false,
            success : function(data) {
                $('.Edit-Content').html(data);
                return data;
            },
            error : function() {
               alert('error');

            }
        });
    }
    
    $(document).on("click", "#delete_multiple", function () {
        var user = [];
        $(".video_checkbox:checked").each(function () {
            user.push($(this).data('video-id'));
        });
        if (user.length <= 0) {
            Swal.fire("Please select records.", "Cancelled", "info");
        } else {
            
            WRN_PROFILE_DELETE = "Are you sure you want to delete " + (user.length > 1 ? "these" : "this") + " row?";
            Swal.fire({
            title: WRN_PROFILE_DELETE,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            }).then((result) => {
                if (result.value == true) {
                    var selected_values = user.join(",");
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo URL_PATH; ?>Ipwiseads/deleteAll',
                        data: {
                            id : selected_values
                        },
                        success: function (response) {
//                            window.location = response;
                            Swal.fire("Your Image file has been deleted.", "Deleted!", "success");
                            $('#DataTables_Table_0').DataTable().ajax.reload();
                            return response;
                            
                        }
                    });

                } else {
                    Swal.fire("Your Records is safe :)", "Cancelled", "error");
                }
            });
        }
    });
</script>


