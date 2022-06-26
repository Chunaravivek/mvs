<?php
    echo $this->Element('all_form_css'); 
?>

<?php echo  $this->Element('breadcrumb'); ?>

<style>
    p.help-block > ul {
        padding: 0 !important;
    }
    
    .modal {
        z-index: 9999 !important;
    }
    
    .project-status .btn-group.btn-group-sm {
        background-color: #0000002e;
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
                        <h4 class="card-title">Manage Users</h4>
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
<!--                                <button type="button" class="btn btn-outline-primary btn-glow mr-1 mb-1 mt-2" data-backdrop="static" data-keyboard="false"  data-toggle="modal" data-target="#modal-default">
                                    <i class="la la-plus"></i>
                                </button>-->
                                <button type="button" class="btn btn-outline-danger btn-glow mr-1 mb-1 mt-2" id="delete_multiple">
                                    <i class="la la-trash"></i>
                                </button>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-2">
                                <div class="form-group">
                                    <label>Account Name</label>
                                    <select class="form-control select2" id="form-field-select-1">
                                        <option value="">-- SELECT Apps --</option>
                                        <?php foreach ($apps as $key => $value) { ?>
                                            <option value="<?php echo $key; ?>"><?php echo $value; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                            <table class="table table-striped table-bordered" id="DataTables_Table_0" cellspacing="0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr>
                                        <th class="check">
                                            <input type="checkbox" id="selectAll" value="" />
                                        </th>
                                        <th>id</th>
                                        <th>name</th>
                                        <th>city_ip</th>
                                        <th>city_name</th>
                                        <th>country</th>
                                        <th>state</th>
                                        <th>email</th>
                                        <th>subscribe</th>
                                        <th>install_status</th>
                                        <th>notifs_status</th>
                                        <th>tag</th>
                                        <th>token_updated</th>
                                        <th>last_sent</th>
                                        <th>time</th>
                                        <th>last_lat</th>
                                        <th>last_long</th>
                                        <th>pin_code</th>
                                        <th>timezone</th>
                                        <th>device_model</th>
                                        <th>device_name</th>
                                        <th>device_memory</th>
                                        <th>device_os</th>
                                        <th>device_id</th>
                                        <th>app_code</th>
                                        <th>app_version</th>
                                        <th>api_key</th>
                                        <th>device_token</th>
                                        <th>device_type</th>
                                        <th>android_id</th>
                                        <th>fb_id</th>
                                        <th>gender</th>
                                        <th>last_access</th>
                                        <th>device_api</th>
                                        <th>created_date</th>
                                        <th>modified_date</th>
                                        <th>status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>id</th>
                                        <th>name</th>
                                        <th>city_ip</th>
                                        <th>city_name</th>
                                        <th>country</th>
                                        <th>state</th>
                                        <th>email</th>
                                        <th>subscribe</th>
                                        <th>install_status</th>
                                        <th>notifs_status</th>
                                        <th>tag</th>
                                        <th>token_updated</th>
                                        <th>last_sent</th>
                                        <th>time</th>
                                        <th>last_lat</th>
                                        <th>last_long</th>
                                        <th>pin_code</th>
                                        <th>timezone</th>
                                        <th>device_model</th>
                                        <th>device_name</th>
                                        <th>device_memory</th>
                                        <th>device_os</th>
                                        <th>device_id</th>
                                        <th>app_code</th>
                                        <th>app_version</th>
                                        <th>api_key</th>
                                        <th>device_token</th>
                                        <th>device_type</th>
                                        <th>android_id</th>
                                        <th>fb_id</th>
                                        <th>gender</th>
                                        <th>last_access</th>
                                        <th>device_api</th>
                                        <th>created_date</th>
                                        <th>modified_date</th>
                                        <th>status</th>
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

<!-- Modal data Delete -->
<div id="conf-modal-dialog" title="Confirm">
    Are you sure want to delete this record?
</div>

<!-- Modal data details edit -->
<div class="modal animated bounceIn bd-example-modal-lg" id="edit" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Users</h5>
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
        $('#form-field-select-1').select2({
            allowClear: true,
            placeholder: '-- SELECT APPS --',
            width: '100%',
        });
        
        var url = "<?php echo URL_PATH;?>Users/records.json";
        $("#DataTables_Table_0").DataTable({
            'dom': "<'row'<'col-sm-12'>>" +"<'row'<'col-sm-12'>>" +"<'row ads_manager_report'<'col-sm-6'l><'col-12 col-sm-12 text-center col-md-6'Bf>>t<'row'<'col-sm-12 col-md-5 columns'i><'col-sm-12 col-md-7 columns'p>>",
            buttons: [
                {
                    extend: 'colvis',
                    postfixButtons: [ 'colvisRestore' ],
                    columns: '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36',
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
            "aaSorting"   : [[35, "desc"]],   
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
                        return  '<input type="checkbox" id="checkall" class="video_checkbox" name="mydata" data-video-id=' + mData.Users.id + '>';
                    },
                },
                {mData: 'Users.id'},
                {mData: 'Users.name'},
                {mData: 'Users.city_ip'},
                {mData: 'Users.city_name'},
                {mData: 'Users.country'},
                {mData: 'Users.state'},
                {mData: 'Users.email'},
                {mData: 'Users.subscribe'},
                {mData: 'Users.install_status'},
                {mData: 'Users.notifs_status'},
                {mData: 'Users.tag'},
                {mData: 'Users.token_updated'},
                {mData: 'Users.last_sent'},
                {mData: 'Users.time'},
                {mData: 'Users.last_lat'},
                {mData: 'Users.last_long'},
                {mData: 'Users.pin_code'},
                {mData: 'Users.timezone'},
                {mData: 'Users.device_model'},
                {mData: 'Users.device_name'},
                {mData: 'Users.device_memory'},
                {mData: 'Users.device_os'},
                {mData: 'Users.device_id'},
                {mData: 'Users.app_code'},
                {mData: 'Users.app_version'},
                {mData: 'Users.api_key'},
                {mData: 'Users.device_token'},
                {mData: 'Users.device_type'},
                {mData: 'Users.android_id'},
                {mData: 'Users.fb_id'},
                {mData: 'Users.gender'},
                {mData: 'Users.last_access'},
                {mData: 'Users.device_api'},
                {mData: 'Users.created_date'},
                {mData: 'Users.modified_date'},
                {mData: 'Users.status','class':'project-status'},
            ],
            "fnRowCallback" : function(nRow, aData,iDisplayIndex) {
//                $('td', nRow).eq(0).html(iDisplayIndex + 1);
            },
            
            "fnCreatedRow": function(nRow, mData, iDataIndex){ 
                if (mData.Users.status == '1') {
                    $('td:eq(36)', nRow).html('<input type="checkbox" checked class="Users_status" id="'+mData.Users.id+'" data-group-cls="btn-group-sm" hidden="">');
                } else {
                    $('td:eq(36)', nRow).html('<input type="checkbox" class="Users_status" id="'+mData.Users.id+'" data-group-cls="btn-group-sm" hidden="">');
                }
            },
            "fnDrawCallback": function() {
                $('.Users_status').checkboxpicker();

                $('.Users_status:checkbox').checkboxpicker().on('change', function () {
                    var id = $(this).attr('id');
                    var isChecked = $(this).is(':checked');
                    var status_val = 0;
                    if (isChecked) {
                        status_val = 1;
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'Users/update_status',
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
            var app_code = $(this).val();
            $('#DataTables_Table_0').DataTable().ajax.url("Users/records?app_code="+app_code).load();
        });
        
    });
    
    $(function () { 
        $('#UsersAddForm').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                "data[Users][full_name]": {
                    required: true,
                },
                "data[Users][email]": {
                    required: true,
                },
                "data[Users][password]": {
                    required: true,
                },
            },
            submitHandler: function(form) {
                $this = $('#add_submit');
                $this.prop('disabled', true);
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
                        window.location.href= "<?php echo $this->webroot; ?>Users/delete/"+id;
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
            url:"<?php echo URL_PATH;?>Users/edit",
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
</script>


