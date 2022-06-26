<?php
    echo $this->Element('all_form_css'); 
?>

<?php echo  $this->Element('breadcrumb'); ?>

<style>
    p.help-block > ul {
        padding: 0 !important;
    }
    
    .project-status .btn-group.btn-group-sm {
        background-color: #0000002e;
    }
    
    .popover {
        z-index: 9999;
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
                        <h4 class="card-title">Manage Schedules</h4>
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
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                            <table class="table table-striped table-bordered" id="DataTables_Table_0" cellspacing="0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr>
                                        <th class="check">
                                            <input type="checkbox" id="selectAll">
                                        </th>
                                        <th>id</th>
                                        <th>Templates</th>
                                        <th>Date</th>
                                        <th>Success</th>
                                        <th>Failure</th>
                                        <th>Created Date</th>
                                        <th>Modified Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>id</th>
                                        <th>Templates</th>
                                        <th>Date</th>
                                        <th>Success</th>
                                        <th>Failure</th>
                                        <th>Created Date</th>
                                        <th>Modified Date</th>
                                        <th>Status</th>
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

<div class="modal animated bounceIn" id="modal-default" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Schedules</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php echo $this->Form->create('Schedules', array('url' => array('controller' => 'Schedules', 'action' => 'add'), 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-sm-3 label-control" for="template">Select Template : </label>
                            <div class="col-sm-9">
                                <?php
                                echo $this->Form->input('template', array('error',
                                    'div' => 'clearfix',
                                    'label' => false,
                                    'id' => 'template',
                                    'class' => 'select2 col-md-10 template',
                                    'empty' => '-- SELECT Template-- ',
                                    'options' => $templates
                                ));
                                ?>
                            </div>
                        </div>
                        
                        <div class="android_ids">
                            <div class="form-group row">
                                <label class="col-md-3 label-control" for="android_ids"> TEST :</label>
                                <div class="col-md-9 mx-auto">
                                    <div class="input-group">
                                        <?php
                                        echo $this->Form->input('android_id', array('error',
                                            'label' => false,
                                            'div' => false,
                                            'id' => 'android_id',
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Android Id',
                                            'type' => 'text',
                                        ));
                                        ?>
                                        <div class="input-group-append">
                                            <button class="btn btn-purple btn-sm tooltip-success popover-notitle bg-purple border-purple" id="test" data-rel="popover" data-content="default" data-delay="20" type="button">
                                                send
                                                <i class="la la-bell"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="date"> Date : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('date', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'date',
                                        'class' => 'form-control',
                                        'type' => 'text'
                                    ));
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="submit" id="add_submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
                    <button type="reset" id="add_reset" class="btn btn-danger">Reset <i class="la la-refresh position-right"></i></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal data details edit -->
<div class="modal animated bounceIn bd-example-modal-lg" id="edit" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Schedules</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="Edit-Content">

            </div>
        </div>
    </div>
</div>

<!-- Modal confirm -->
<div class="modal animated bounceIn" id="ConfirmDelete" style="display: none; z-index: 1050;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" id="confirmMessage">
                    Are you sure want to delete this record?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="confirmOk">Ok</button>
                <button type="button" class="btn btn-sm btn-danger" id="confirmCancel">Cancel</button>
            </div>
        </div>
    </div>
</div>

<?php echo $this->Element('all_form_js'); ?>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready( function () {
        $('#template').select2({
            allowClear: true,
            placeholder: '-- SELECT Template --',
            width: '100%',
        });

        $('#date').dateDropper({
            dropWidth: 200,
            format: 'd/m/Y',
            defaultDate: new Date(),
        });
        
        
        $('#test').on('click', function(){
            var e = $(this);
            if($('#android_id').val()!="" && $('.template').val()!=""){
                var android_id = $('#android_id').val();
                var template_id = $('.template').val();
                var baseurl = '<?php echo URL_PATH; ?>';
                $.ajax({
                    type: 'post',
                    url: baseurl+'Schedules/send_notifs',
                    data: { 
                       'android_id': android_id, 'template_id':template_id
                    },
                    cache: true,
                    success: function(response){
                        $(e).attr('data-content',response);
                        $(e).popover("show") 
                        $(e).on('shown.bs.popover',function() { 
                            setTimeout(function() {
                            $(e).popover("hide")}, 2000); 
                        }); 
                    }
                });
            } else {
                $(this).attr('data-content','template/android_id missing');
                $(this).popover('show');
            }
        });
        
        var url = "<?php echo URL_PATH;?>Schedules/records.json";
        $("#DataTables_Table_0").DataTable({
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
            "aaSorting"   : [[7, "desc"]],   
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
                        return  '<input type="checkbox" id="checkall" class="video_checkbox" name="mydata" data-video-id=' + mData.Schedules.id + '>';
                    },
                },
                {mData: 'Schedules.id'},
                {mData: 'Schedules.template'},
                {mData: 'Schedules.date'},
                {mData: 'Schedules.success'},
                {mData: 'Schedules.failure'},
                {mData: 'Schedules.created_date'},
                {mData: 'Schedules.modified_date'},
                {mData: 'Schedules.status','class':'project-status'},
                {
                    "targets": -1,
                    "searchable": false,
                    "data": null,
                    "wrap": true,  
                    "bSortable": false,
                    "orderable": false,
                    "mRender": function(mData, type, full) {  
//                        var View = '<a href="#" class="btn btn-sm btn-app bg-info" data-backdrop="static" data-keyboard="false" title="View PunjabiTags" onclick="ViewModal('+mData.PunjabiTags.id+')"><i class="fas fa-info"></i></a>';
                        var edit = '<a href="javascript:void(0);" class="btn btn-primary btn-sm mr-2" data-target="#modal-edit" data-backdrop="static" data-keyboard="false" title="Edit PunjabiTags" onclick="EditModal('+mData.Schedules.id+')"><i class="ft-edit-1"></i></a>';
                        var delete_id = '<a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Delete PunjabiTags" onclick="deleteModal('+mData.Schedules.id+')"><i class="ft-trash-2"></i></a>';
                        return   edit + delete_id;
                    },


                },
            ],
            "fnRowCallback" : function(nRow, aData,iDisplayIndex) {
//                $('td', nRow).eq(0).html(iDisplayIndex + 1);
            },
            
            "fnCreatedRow": function(nRow, mData, iDataIndex){ 
                if (mData.Schedules.status == '1') {
                    $('td:eq(8)', nRow).html('<input type="checkbox" checked class="Schedules_status" id="'+mData.Schedules.id+'" data-group-cls="btn-group-sm" hidden="">');
                } else {
                    $('td:eq(8)', nRow).html('<input type="checkbox" class="Schedules_status" id="'+mData.Schedules.id+'" data-group-cls="btn-group-sm" hidden="">');
                }
             
            },
            "fnDrawCallback": function() {
                $('.Schedules_status').checkboxpicker();
               
                $('.Schedules_status:checkbox').checkboxpicker().on('change', function() {
                    var id = $(this).attr('id');
                    var isChecked = $(this).is(':checked');
                    var status_val = 0;
                    if (isChecked) {
                        status_val = 1;
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'Schedules/update_status',
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
        
        
    });
    
    $(function () { 
        $('#SchedulesAddForm').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                "data[Schedules][type]": {
                    required: true,
                },
                "data[Schedules][video_type]": {
                    required: true,
                },
                "data[Schedules][category]": {
                    required: true,
                },
                "data[Schedules][title]": {
                    required: true,
                },
                "data[Schedules][message]": {
                    required: true,
                },
                "data[Schedules][android_ids]": {
                    required: true,
                },
                "data[Schedules][date]": {
                    required: true,
                },
                "data[Schedules][time]": {
                    required: true,
                },
            },
            submitHandler: function(form) {
                $this = $('#add_submit');
                $this.prop('disabled', true);
                var this_delete = $("#add_reset");
                this_delete.remove();
                $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
                form.submit();
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.col-md-9.mx-auto').append(error);
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
        
        $("#type").on("select2:close", function (e) {
            $(this).valid();
        });
        
        $("#video_type").on("select2:close", function (e) {
            $(this).valid();
        });
        
        $("#category").on("select2:close", function (e) {
            $(this).valid();
        });
    });

    
    function deleteModal(id) {
            $('#ConfirmDelete').modal({
                backdrop: 'static',
                keyboard: false
            });
           $("#confirmOk").attr('data-user', id);
    }
    
    $(function() {
        $(document).on('click', '#confirmOk', function () {
               
                var userId = $("#confirmOk").attr('data-user');
                $this = $('#confirmOk');
                $this.prop('disabled', true);
                $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
                var this_delete = $("#confirmCancel");
                this_delete.remove();
               window.location.href= "<?php echo $this->webroot; ?>Schedules/delete/"+userId;
        });

        $(document).on('click', '#confirmCancel', function () {
            $("#ConfirmDelete").modal('hide');
        });
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
            url:"<?php echo URL_PATH;?>Schedules/edit",
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
            $('#selectAll').iCheck('uncheck');
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
                        url: '<?php echo URL_PATH; ?>Schedules/deleteAll',
                        data: {
                            id : selected_values
                        },
                        success: function (response) {
//                            window.location = response;
                            Swal.fire("Your Image file has been deleted.", "Deleted!", "success");
                            $('#DataTables_Table_0').DataTable().ajax.reload();
                            $('#selectAll').iCheck('uncheck');
                            return response;
                            
                        }
                    });

                } else {
                    $('#selectAll').iCheck('uncheck');
                    $('.video_checkbox').iCheck('uncheck');
                    Swal.fire("Your Records is safe :)", "Cancelled", "error");
                }
            });
        }
    });
</script>


