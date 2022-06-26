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
    
</style>
<div class="content-body">
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <?php echo $this->Session->flash(); ?>
                    <div class="card-header">
                        <h4 class="card-title">Manage Admin</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-min-width btn-glow mr-1 mb-1 mt-2" data-backdrop="static" data-keyboard="false"  data-toggle="modal" data-target="#modal-default">
                            <i class="la la-plus"></i>
                        </button>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                            <table class="table table-striped table-bordered" id="DataTables_Table_0" cellspacing="0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Modified Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>id</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
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

<div class="modal animated bounceIn" id="modal-default" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php echo $this->Form->create('Admin', array('url' => array('controller' => 'Admin', 'action' => 'add'), 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-2 label-control" for="full_name"> Full Name : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('full_name', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'full_name',
                                        'data-validation-required-message' => "This field is required",
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Full Name',
                                    ));
                                    ?>

                                </div>
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 label-control"  for="email"> Email : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('email', array('error',
                                        'type' => 'email',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'email',
                                        'data-validation-required-message' => "This field is required",
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Email',
                                    ));
                                    ?>
                                </div>
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 label-control"  for="password"> Password : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('password', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'password',
                                        'type' => 'password',
                                        'data-validation-required-message' => "This field is required",
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Password',
                                    ));
                                    ?>
                                </div>
                                <p class="help-block"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="submit" id="submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
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
<div class="modal animated bounceIn bd-example-modal-lg" id="edit" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Admin</h5>
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
        
        var url = "<?php echo URL_PATH;?>Admin/records.json";
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
            "aaSorting"   : [[5, "desc"]],   
            aoColumns: [
                {mData: 'Admin.id'},
                {mData: 'Admin.full_name'},
                {mData: 'Admin.email'},
                {mData: 'Admin.status','class':'project-status'},
                {mData: 'Admin.created_date'},
                {mData: 'Admin.modified_date'},
                {
                    "targets": 5,
                    "searchable": false,
                    "data": null,
                    "wrap": true,  
                    "bSortable": false,
                    "orderable": false,
                    "mRender": function(mData, type, full) {  
//                        var View = '<a href="#" class="btn btn-sm btn-app bg-info" data-backdrop="static" data-keyboard="false" title="View Admin" onclick="ViewModal('+mData.Admin.id+')"><i class="fas fa-info"></i></a>';
                        var edit = '<a href="javascript:void(0);" class="btn btn-primary btn-sm mr-2" data-target="#modal-edit" data-backdrop="static" data-keyboard="false" title="Edit Admin" onclick="EditModal('+mData.Admin.id+')"><i class="ft-edit-1"></i></a>';
                        var delete_id = '<a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Delete Admin" onclick="deleteModal('+mData.Admin.id+')"><i class="ft-trash-2"></i></a>';
                        return   edit + delete_id;
                    },


                },
            ],
            "fnRowCallback" : function(nRow, aData,iDisplayIndex) {
                $('td', nRow).eq(0).html(iDisplayIndex + 1);
            },
            
            "fnCreatedRow": function(nRow, mData, iDataIndex){ 
                if (mData.Admin.status == '1') {
                    $('td:eq(3)', nRow).html('<input type="checkbox" checked class="admin_status" id="'+mData.Admin.id+'" data-group-cls="btn-group-sm" hidden="">');
                } else {
                    $('td:eq(3)', nRow).html('<input type="checkbox" class="admin_status" id="'+mData.Admin.id+'" data-group-cls="btn-group-sm" hidden="">');
                }
             
            },
            "fnDrawCallback": function() {
               $('.admin_status').checkboxpicker();
               
                $('.admin_status:checkbox').checkboxpicker().on('change', function() {
                    var id = $(this).attr('id');
                    var isChecked = $(this).is(':checked');
                    var status_val = 2;
                    if (isChecked) {
                        status_val = 1;
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'Admin/update_status',
                        data: {
                            'id': id, 'status_val': status_val,
                        },
                        success: function (msg) {
                            //alert('done' + msg);
                        }
                    });
                });
            }
        });
        
        
    });
    
    $(function () { 
        $('#AdminAddForm').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                "data[Admin][full_name]": {
                    required: true,
                },
                "data[Admin][email]": {
                    required: true,
                },
                "data[Admin][password]": {
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
                        window.location.href= "<?php echo $this->webroot; ?>Admin/delete/"+id;
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
            url:"<?php echo URL_PATH;?>Admin/edit",
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


