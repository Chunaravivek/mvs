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
    
</style>
<div class="content-body">
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <?php echo $this->Session->flash(); ?>
                    <div class="card-header">
                        <h4 class="card-title">Manage God Makers</h4>
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
                                    <label>Tags Name</label>
                                    <select class="form-control select2" multiple  id="form-field-select-1">
                                        <option value="">-- SELECT Tags --</option>
                                        <?php foreach ($tags as $key => $value) { ?>
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
                                            <input type="checkbox" id="selectAll">
                                        </th>    
                                        <th>id</th>
                                        <th>Tags</th>
                                        <th>Title</th>
                                        <th>Videos</th>
                                        <th>images</th>
                                        <th>Zips</th>
                                        <th>Views</th>
                                        <th>Downloads</th>
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
                                        <th>Tags</th>
                                        <th>Title</th>
                                        <th>Videos</th>
                                        <th>images</th>
                                        <th>Zips</th>
                                        <th>Views</th>
                                        <th>Downloads</th>
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
                <h4 class="modal-title">Add God Makers</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php echo $this->Form->create('GodMakers', array('url' => array('controller' => 'GodMakers', 'action' => 'add'), 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-2 label-control" for="title"> Title : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('title', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'title',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Title',
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 label-control" for="tags_id"> Tags : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                        echo $this->Form->input('tags_id', array('error',
                                            'label' => false,
                                            'div' => false,
                                            'id' => 'tags_id',
                                            'class' => 'form-control',
                                            'type' => 'select',
//                                            'multiple' => 'multiple',
                                        ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 label-control" for="url"> Video : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('url', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'url',
                                        'class' => 'form-control file',
                                        'type' => 'file',
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 label-control" for="date-timepicker"> Date : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('modified_date', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'date-timepicker',
                                        'class' => 'form-control',
                                        'type' => 'text',
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

<div class="modal animated bounceIn" id="modal-default-yt" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add YouTube GodMakers </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php echo $this->Form->create('GodMakers', array('url' => array('controller' => 'GodMakers', 'action' => 'ytadd'), 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="yturl"> Youtube Video URL : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('yturl', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'yturl',
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Youtube Video URL',
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="tags_id"> Tag : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                        echo $this->Form->input('tags_id', array('error',
                                            'label' => false,
                                            'div' => false,
                                            'id' => 'tags_id2',
                                            'class' => 'form-control',
                                            'type' => 'select',
                                            'multiple' => 'multiple',
                                            'empty' => 'Choose Tags...'
                                        ));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 label-control" for="date-timepicker1"> Date/Time : </label>
                            <div class="col-md-9 mx-auto">
                                <div class="controls">
                                    <?php
                                    echo $this->Form->input('modified_date', array('error',
                                        'label' => false,
                                        'div' => false,
                                        'id' => 'date-timepicker1',
                                        'class' => 'form-control',
                                        'type' => 'text',
                                    ));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="submit" id="add_yt_submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
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
                <h5 class="modal-title" id="exampleModalLongTitle">Edit GodMakers</h5>
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
        $('#app_id').select2({
            allowClear: true,
            placeholder: '-- SELECT APP --',
            width: '100%',
            ajax: {
                url: '<?php echo URL_PATH; ?>GodMakers/AppSelect',
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
        
        $('#tags_id').select2({
            allowClear: true,
            placeholder: 'Choose Tags...',
            width: '100%',
        });
        
        $('#tags_id2').select2({
            allowClear: true,
            placeholder: 'Choose Tags...',
            width: '100%',
        });
        
        $('#form-field-select-1').select2({
            allowClear: true,
            placeholder: '-- SELECT Tags --',
            width: '100%',
        });
        
        $('#date-timepicker').pickadate({
            format: 'dd/mm/yyyy',
            formatSubmit: 'dd/mm/yyyy',
	});
        
        $('#date-timepicker1').pickadate({
            format: 'dd/mm/yyyy',
            formatSubmit: 'dd/mm/yyyy',
	});
        
        var url = "<?php echo URL_PATH;?>GodMakers/records.json";
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
            "aaSorting"   : [[11, "desc"]],   
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
                        return  '<input type="checkbox" id="checkall" class="video_checkbox" name="mydata" data-video-id=' + mData.GodMakers.id + '>';
                    },
                },
                {mData: 'GodMakers.id'},
                {mData: 'GodMakers.tags'},
                {mData: 'GodMakers.title'},
                {mData: 'GodMakers.url'},
                {mData: 'GodMakers.image'},
                {mData: 'GodMakers.zip'},
                {mData: 'GodMakers.views'},
                {mData: 'GodMakers.downloads'},
                {mData: 'GodMakers.status','class':'project-status'},
                {mData: 'GodMakers.created_date'},
                {mData: 'GodMakers.modified_date'},
                {
                    "targets": -1,
                    "searchable": false,
                    "data": null,
                    "wrap": true,  
                    "bSortable": false,
                    "orderable": false,
                    "mRender": function(mData, type, full) {  
//                        var View = '<a href="#" class="btn btn-sm btn-app bg-info" data-backdrop="static" data-keyboard="false" title="View GodMakers" onclick="ViewModal('+mData.GodMakers.id+')"><i class="fas fa-info"></i></a>';
                        var edit = '<a href="javascript:void(0);" class="btn btn-primary btn-sm mr-2" data-target="#modal-edit" data-backdrop="static" data-keyboard="false" title="Edit GodMakers" onclick="EditModal('+mData.GodMakers.id+')"><i class="ft-edit-1"></i></a>';
                        var delete_id = '<a href="javascript:void(0);" class="btn btn-danger btn-sm" title="Delete GodMakers" onclick="deleteModal('+mData.GodMakers.id+')"><i class="ft-trash-2"></i></a>';
                        return   delete_id;
                    },


                },
            ],
            "fnRowCallback" : function(nRow, aData,iDisplayIndex) {
//                $('td', nRow).eq(0).html(iDisplayIndex + 1);
            },
            
            "fnCreatedRow": function(nRow, mData, iDataIndex){ 
                var thumb = mData.GodMakers.url  + '.jpg';
                $('td:eq(4)', nRow).html('<video controls poster="' + mData.GodMakers.image + '" style="height: 200px;width: 350px"><source src="' + mData.GodMakers.url + '" type="video/mp4"></video>');
//                $('td:eq(4)', nRow).html('<a class="ui-button ui-widget ui-corner-all mb-2" href="' + mData.GodMakers.url + '" target="_blank"><span class="ui-icon ft-play"></span></a>');
                $('td:eq(5)', nRow).html('<a class="ui-button ui-widget ui-corner-all mb-2" href="' + mData.GodMakers.image + '" target="_blank"><span class="ui-icon ft-camera"></span></a>');
                $('td:eq(6)', nRow).html(mData.GodMakers.zip);
                if (mData.GodMakers.status == '1') {
                    $('td:eq(9)', nRow).html('<input type="checkbox" checked class="GodMakers_status" id="'+mData.GodMakers.id+'" data-group-cls="btn-group-sm" hidden="">');
                } else {
                    $('td:eq(9)', nRow).html('<input type="checkbox" class="GodMakers_status" id="'+mData.GodMakers.id+'" data-group-cls="btn-group-sm" hidden="">');
                }
             
            },
            "fnDrawCallback": function() {
                $('.GodMakers_status').checkboxpicker();
               
                $('.GodMakers_status:checkbox').checkboxpicker().on('change', function() {
                    var id = $(this).attr('id');
                    var isChecked = $(this).is(':checked');
                    var status_val = 0;
                    if (isChecked) {
                        status_val = 1;
                    }
                    $.ajax({
                        type: 'POST',
                        url: 'GodMakers/update_status',
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
            var tags_id = $(this).val();
            $('#DataTables_Table_0').DataTable().ajax.url("GodMakers/records?tags_id="+tags_id).load();
        });
        
    });
    
    $(function () { 
        $('#GodMakersAddForm').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                "data[GodMakers][app_id]": {
                    required: true,
                },
                "data[GodMakers][yturl]": {
                    required: true,
                    url: true,
                },
                "data[GodMakers][title]": {
                    required: true,
                },
                "data[GodMakers][url]": {
                    required: true,
                },
                "data[GodMakers][tags_id]": {
                    required: true,
                },
                "data[GodMakers][views]": {
                    required: true,
                },
                "data[GodMakers][downloads]": {
                    required: true,
                },
                "data[GodMakers][modified_date]": {
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
        
        $('#GodMakersYtaddForm').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                "data[GodMakers][yturl]": {
                    required: true,
                    url: true,
                },
                "data[GodMakers][title]": {
                    required: true,
                },
                "data[GodMakers][tags_id][]": {
                    required: true,
                },
                "data[GodMakers][views]": {
                    required: true,
                },
                "data[GodMakers][downloads]": {
                    required: true,
                },
                "data[GodMakers][modified_date]": {
                    required: true,
                },
            },
            submitHandler: function(form) {
                $this = $('#add_yt_submit');
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
        
        $('.file').on('change', function () {
            $(this).valid();
        });
        
        $("#tags_id").on("select2:close", function (e) {
            $(this).valid();
        });
        
        $("#app_id").on("select2:close", function (e) {
            $(this).valid();
        });
        
        $("#tags_id2").on("select2:close", function (e) {
            $(this).valid();
        });
        
        $('.file').each(function () {
            $(this).rules('add', {
                extension: "mp4",
                messages: {
                    extension: "Please, upload mp4 files only!"
                }
            });
        });
    });

    
    $( "#conf-modal-dialog" ).hide();
    function deleteModal(id) {
        $( "#conf-modal-dialog" ).show();
        $( "#conf-modal-dialog" ).dialog({
            autoOpen: true,
            resizable: false,
            height: "auto",
            width: "auto",
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
                        window.location.href= "<?php echo $this->webroot; ?>GodMakers/delete/"+id;
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
            url:"<?php echo URL_PATH;?>GodMakers/edit",
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
                        url: '<?php echo URL_PATH; ?>GodMakers/deleteAll',
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


