<?php
    echo $this->Element('all_form_css'); 
?>

<?php echo  $this->Element('breadcrumb'); ?>

<style>
    p.help-block > ul {
        padding: 0 !important;
    }
    
    .test-status .btn-group.btn-group-sm {
        background-color: #0000002e;
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
                        <h4 class="card-title">Manage Notifications</h4>
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
                                        <th>Account</th>
                                        <th>Application</th>
                                        <th>App Code</th>
                                        <th>Success</th>
                                        <th>Failure</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>id</th>
                                        <th>Templates</th>
                                        <th>Account</th>
                                        <th>Application</th>
                                        <th>App Code</th>
                                        <th>Success</th>
                                        <th>Failure</th>
                                        <th>Created Date</th>
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
                <h4 class="modal-title">Add Notifications</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php echo $this->Form->create('Notifications', array('url' => array('controller' => 'Notifications', 'action' => 'add'), 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group row"> 
                            <label class="col-sm-3 label-control" for="account_id" > Developer Account : </label>
                            <div class="col-md-9"> 
                                <div class="controls">                           
                                    <?php
                                    echo $this->Form->input('account_id', array('error',
                                        'div' => false,
                                        'label' => false,
                                        'id' => 'account_id',
                                        'class' => 'select2 form-control account col-md-10',
                                        'empty' => '-- Select ACCOUNT -- ',
                                        'options' => $accounts
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row"> 
                            <label class="col-sm-3 label-control" for="account_id" > Select Application : </label>
                            <div class="col-md-9"> 
                                <div class="controls">                           
                                    <?php
                                    echo $this->Form->input('app_name', array('error',
                                        'div' => false,
                                        'label' => false,
                                        'id' => 'app_name',
                                        'multiple' => 'multiple',
                                        'class' => 'select2 form-control account col-md-10',
                                        'empty' => '-- Select Application -- ',
                                        'options' => $applications,
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 label-control" for="sent_type">Select UI : </label>
                            <div class="col-md-9">
                                <div class="controls">                           
                                    <?php
                                    echo $this->Form->input('type', array('error',
                                        'div' => false,
                                        'label' => false,
                                        'id' => 'type',
                                        'class' => 'form-control uidesign col-md-10',
                                        'required' => 'required',
                                        'empty' => '-- Select UI -- ',
                                        'options' => $uidesigns
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 label-control" for="title">Title : </label>
                            <div class="col-sm-9">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('title', array('error',
                                        'div' => false,
                                        'label' => false,
                                        'id' => 'title',
                                        'class' => 'form-control col-md-10',
                                        'type' => 'text'
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 label-control" for="msg">Message : </label>
                            <div class="col-sm-9">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('msg', array('error',
                                        'div' => false,
                                        'label' => false,
                                        'id' => 'msg',
                                        'class' => 'form-control col-md-10',
                                        'type' => 'textarea'
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="template" style="display: none;">
                            <div class="form-group row">
                                <label class="col-sm-3 label-control" for="template_id">Select Template : </label>
                                <div class="col-sm-9">
                                    <?php
                                    echo $this->Form->input('template_id', array('error',
                                        'div' => 'clearfix',
                                        'label' => false,
                                        'id' => 'template_id',
                                        'class' => 'select2 col-md-10 template_id',
                                        'empty' => '-- SELECT Template-- ',
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="reminder"> Reminder : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls test-status">
                                    <?php
                                    echo $this->Form->input('reminder', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'reminder',
                                        'data-group-cls' => 'btn-group-sm',
                                        'class' => 'form-control copy',
                                        'type' => 'checkbox'
                                    ));
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="test"> TEST : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls test-status">
                                    <?php
                                    echo $this->Form->input('test', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'test',
                                        'data-group-cls' => 'btn-group-sm',
                                        'class' => 'form-control copy',
                                        'type' => 'checkbox'
                                    ));
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="android_ids" style="display:none">
                            <div class="form-group row">
                                <label class="col-sm-3 label-control" for="message">Android Ids : </label>
                                <div class="col-sm-9">                                                       
                                    <?php
                                    echo $this->Form->input('android_ids', array('error',
                                        'div' => false,
                                        'label' => false,
                                        'id' => 'android_ids',
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

<!-- Modal data Delete -->
<div id="conf-modal-dialog" title="Confirm">
    Are you sure want to delete this record?
</div>

<!-- Modal data details edit -->
<div class="modal animated bounceIn bd-example-modal-lg" id="edit" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Notifications</h5>
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
        $('#type').select2({
            allowClear: true,
            placeholder: '-- SELECT UI --',
            width: '100%',
        });
        
        $('#account_id').select2({
            allowClear: true,
            placeholder: '-- SELECT ACCOUNT --',
            width: '100%',
        });
        
        $('#app_name').select2({
            allowClear: true,
            placeholder: '-- SELECT Application --',
            width: '100%',
        });
        
        $('#template_id').select2({
            allowClear: true,
            placeholder: '-- SELECT Template --',
            width: '100%',
        });
        
        $('#test').checkboxpicker();
        $('#reminder').checkboxpicker();
        
        $('.uidesign').change(function () {
            var type = $(this).val();
           
            if(type == 1) {
                $('.template').css('display', 'none');
                $("#template_id").removeAttr('required');
                $('.simple').css('display', 'block');
                $('.simple').css('display', 'block');
                $("#title").prop('required', true);
                $("#msg").prop('required', true);
            } else {
                $('.template').css('display', 'block');
                $("#template_id").prop('required', true);
                $('.simple').css('display', 'none');
                $('.simple').css('display', 'none');
                $("#title").removeAttr('required');
                $("#msg").removeAttr('required');
                
                $('form').find("input[type=text], textarea, colorpicker, checkbox").val("");
                $('#template_id').empty(); //remove all existing options
                
                $.ajax({
                    type: 'post',
                    url: '<?php echo URL_PATH; ?>Notifications/get_template',
                    data: {
                        'type': type
                    },
                    cache: true,
                    dataType: 'json',
                    success: function (data) {
                        $('#template_id').append(data);
                        var $select_elem = $("#template_id");
//                        console.log($select_elem);
                        $select_elem.empty();
                        $.each(data, function (idx, obj) {
                            $select_elem.append('<option value="' + obj.id + '">' + obj.title + '</option>');
                        });
                        $("#template_id").trigger("change")
                        $("#template_id").select2();
                    }
                });
            }
        });
        
        $('#test:checkbox').checkboxpicker().on('change', function(e) {
            var imageorlink = $(this).is(':checked');
            if (imageorlink == true) {
                $('.android_ids').css('display', 'block');
                $("#android_ids").prop('required', true);
            } else {
                $('.android_ids').css('display', 'none');
                $("#android_ids").removeAttr('required');
            }
        });
        
        $('#account_id').change(function () {
            var ac_id = $('#account_id').val();
            $('#app_name').empty(); //remove all existing options
            $.ajax({
                type: 'post',
                url: '<?php echo URL_PATH; ?>Notifications/get_application',
                data: {
                    'ac_id': ac_id
                },
                cache: true,
                success: function (data) {
//                     console.log( data );
                    $('#app_name').empty();
                        
                    if (data == 'sorry') {
                        $('#app_name').val(null);
                    } else {
                        $('#app_name').append(data);
                    }
                }
            });
        });
        
        var url = "<?php echo URL_PATH;?>Notifications/records.json";
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
                        return  '<input type="checkbox" id="checkall" class="video_checkbox" name="mydata" data-video-id=' + mData.Notifications.id + '>';
                    },
                },
                {mData: 'Notifications.id'},
                {mData: 'Notifications.template'},
                {mData: 'Notifications.account'},
                {mData: 'Notifications.application'},
                {mData: 'Notifications.app_code'},
                {mData: 'Notifications.success'},
                {mData: 'Notifications.failure'},
                {mData: 'Notifications.created_date'},
            ],
            "fnRowCallback" : function(nRow, aData,iDisplayIndex) {
//                $('td', nRow).eq(0).html(iDisplayIndex + 1);
            },
            
            "fnCreatedRow": function(nRow, mData, iDataIndex){ 
            },
            "fnDrawCallback": function() {
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
        $('#NotificationsAddForm').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                "data[Notifications][account_id]": {
                    required: true,
                },
                "data[Notifications][app_name][]": {
                    required: true,
                },
                "data[Notifications][title]": {
                    required: true,
                },
                "data[Notifications][msg]": {
                    required: true,
                },
                "data[Notifications][android_ids]": {
                    required: true,
                },
            },
            submitHandler: function(form) {
                $this = $('#add_submit');
                $this.prop('disabled', true);
                $this.css('cursor', 'no-drop');
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
                        window.location.href= "<?php echo $this->webroot; ?>Key/delete/"+id;
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
            url:"<?php echo URL_PATH;?>Notifications/edit",
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
                        url: '<?php echo URL_PATH; ?>Notifications/deleteAll',
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


