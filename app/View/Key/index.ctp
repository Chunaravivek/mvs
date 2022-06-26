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
                        <h4 class="card-title">Manage Key</h4>
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
                            <table class="table table-striped table-bordered display" cellspacing="0" id="DataTables_Table_0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="check">
                                            <input type="checkbox" id="selectAll">
                                        </th>
                                        <th>id</th>
                                        <th>App Name</th>
                                        <th>Api Key</th>
                                        <th>client_key1</th>
                                        <th>client_key2</th>
                                        <th>client_key3</th>
                                        <th>client_key4</th>
                                        <th>client_key5</th>
                                        <th>client_key6</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Modified Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>id</th>
                                        <th>App Name</th>
                                        <th>Api Key</th>
                                        <th>client_key1</th>
                                        <th>client_key2</th>
                                        <th>client_key3</th>
                                        <th>client_key4</th>
                                        <th>client_key5</th>
                                        <th>client_key6</th>
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
                <h4 class="modal-title">Add Key</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php echo $this->Form->create('Key', array('url' => array('controller' => 'Key', 'action' => 'add'), 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-2 label-control"  for="app_id"> Application : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('app_code', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'app_id',
                                        'type' => 'select',
                                        'class' => 'app_id form-control',
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-2 label-control" for="client_key1"> client_key1 : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('client_key1', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'client_key1',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter client_key1',
                                    ));
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-2 label-control" for="client_key2"> client_key2 : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('client_key2', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'client_key2',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter client_key2',
                                    ));
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-2 label-control" for="client_key3"> client_key3 : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('client_key3', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'client_key3',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter client_key3',
                                    ));
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-2 label-control" for="client_key4"> client_key4 : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('client_key4', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'client_key4',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter client_key4',
                                    ));
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-2 label-control" for="client_key5"> client_key5 : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('client_key5', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'client_key5',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter client_key5',
                                    ));
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-2 label-control" for="client_key6"> client_key6 : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('client_key6', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'client_key6',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter client_key6',
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
<div class="modal animated bounceIn bd-example-modal-lg" id="edit" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Key</h5>
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
        
        $('.app_id').select2({
            allowClear: true,
            placeholder: '-- SELECT App --',
            width: '100%',
            ajax: {
                url: '<?php echo URL_PATH; ?>Key/ApplicationsSelect',
                dataType: 'json',
//                delay: 250,
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
        
        var url = "<?php echo URL_PATH;?>Key/records.json";
        $("#DataTables_Table_0").DataTable({
            'dom': 'Rlfrtip',
            'dom': "<'row'<'col-sm-12'>>" +"<'row'<'col-sm-12'>>" +"<'row ads_manager_report'<'col-sm-6'l><'col-12 col-sm-12 text-center col-md-6'Bf>>t<'row'<'col-sm-12 col-md-5 columns'i><'col-sm-12 col-md-7 columns'p>>",
            buttons: [
                {
                    extend: 'colvis',
                    postfixButtons: [ 'colvisRestore' ],
                    columns: '1,2,3,4,5,6,7,8,9,10,11,12,13',
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
            "aaSorting"   : [[12, "desc"]],   
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
                        return  '<input type="checkbox" id="checkall" class="video_checkbox" name="mydata" data-video-id=' + mData.Key.id + '>';
                    },
                },
                {mData: 'Key.id'},
                {mData: 'Key.app_name',"searchable": false,"bSortable": false,"orderable": false,},
                {mData: 'Key.api_key'},
                {mData: 'Key.client_key1'},
                {mData: 'Key.client_key2'},
                {mData: 'Key.client_key3'},
                {mData: 'Key.client_key4'},
                {mData: 'Key.client_key5'},
                {mData: 'Key.client_key6'},
                {mData: 'Key.status','class':'project-status'},
                {mData: 'Key.created_date'},
                {mData: 'Key.modified_date'},
                {
                    "targets": -1,
                    "searchable": false,
                    "data": null,
                    "wrap": true,  
                    "bSortable": false,
                    "orderable": false,
                    "mRender": function(mData, type, full) {  
//                        var View = '<a href="#" class="btn btn-sm btn-app bg-info" data-backdrop="static" data-keyboard="false" title="View Key" onclick="ViewModal('+mData.Key.id+')"><i class="fas fa-info"></i></a>';
                        var edit = '<a href="javascript:void(0);" class="btn btn-primary btn-sm mr-2" data-target="#modal-edit" data-backdrop="static" data-keyboard="false" title="Edit Key" onclick="EditModal('+mData.Key.id+')"><i class="ft-edit-1"></i></a>';
                        var delete_id = '<a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Delete Key" onclick="deleteModal('+mData.Key.id+')"><i class="ft-trash-2"></i></a>';
                        return   edit + delete_id;
                    },


                },
            ],
            "fnRowCallback" : function(nRow, aData,iDisplayIndex) {
//                $('td', nRow).eq(0).html(iDisplayIndex + 1);
            },
            
            "fnCreatedRow": function(nRow, mData, iDataIndex){ 
                if (mData.Key.status == '1') {
                    $('td:eq(10)', nRow).html('<input type="checkbox" checked class="Key_status" id="'+mData.Key.id+'" data-group-cls="btn-group-sm" hidden="">');
                } else {
                    $('td:eq(10)', nRow).html('<input type="checkbox" class="Key_status" id="'+mData.Key.id+'" data-group-cls="btn-group-sm" hidden="">');
                }
             
            },
            "fnDrawCallback": function() {
                $('.Key_status').checkboxpicker();
               
                $('.Key_status:checkbox').checkboxpicker().on('change', function() {
                    var id = $(this).attr('id');
                    var isChecked = $(this).is(':checked');
                    var status_val = 0;
                    if (isChecked) {
                        status_val = 1;
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'Key/update_status',
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
        
        var table = $('#DataTables_Table_0').DataTable();
        new $.fn.dataTable.ColReorder(table);
        
    });
    
    $(function () { 
        $('#KeyAddForm').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                "data[Key][app_code]": {
                    required: true,
                },
                "data[Key][api_key]": {
                    required: true,
                },
                "data[Key][client_key1]": {
                    required: true,
                },
//                "data[Key][client_key2]": {
//                    required: true,
//                },
//                "data[Key][client_key3]": {
//                    required: true,
//                },
//                "data[Key][client_key4]": {
//                    required: true,
//                },
//                "data[Key][client_key5]": {
//                    required: true,
//                },
//                "data[Key][client_key6]": {
//                    required: true,
//                },
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
        
//        $('#app_id').on('change', function(e) {
//            var account_id = $(this).val();
//            $('#DataTables_Table_0').DataTable().ajax.url("Applications/records?account_id="+account_id).load();
//        });
        
        $(".app_id").on("select2:close", function (e) {
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
            url:"<?php echo URL_PATH;?>Key/edit",
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
                        url: '<?php echo URL_PATH; ?>Key/deleteAll',
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


