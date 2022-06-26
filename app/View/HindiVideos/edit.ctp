<?php 

$this->layout = false; 

?>
<?php
    echo $this->Form->create('HindiVideos', array('url' => '/HindiVideos/save/'.$id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); 
?>
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
                            'id' => 'tags_id1',
                            'class' => 'form-control',
                            'type' => 'select',
                            'multiple' => 'multiple',
                        ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row" id="image_loc">
            <label class="col-md-2 label-control" for="url1"> Video : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    if (isset($this->request->data['HindiVideos']['url']) && $this->request->data['HindiVideos']['url'] != '') {
                        $url = $this->request->data['HindiVideos']['url'];
                        echo "<p id='removed-p-tag'>";
                        echo '<video controls poster="' . $url . ".jpg" . '" style="height: 200px;width: 350px"><source src="' . $url . '" type="video/mp4"></video>';
                        echo "<button class='ui-button ui-widget ui-corner-all ml-1' id='confirm-delete-images' title='" . $url . "' data-id='".$this->request->data['HindiVideos']['id']."'><span class='ui-icon ft-image'></span>Delete HindiVideos</button>";
                        echo "</p>";
                    } else {
                        echo $this->Form->input('url', array('error',
                            'label' => false,
                            'div' => false,
                            'id' => 'url1',
                            'class' => 'form-control file',
                            'type' => 'file',
                        ));
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 label-control" for="views"> Views : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('views', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'views',
                        'min' => 0,
                        'class' => 'form-control',
                        'type' => 'number',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 label-control" for="downloads"> Downloads : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('downloads', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'downloads',
                        'min' => 0,
                        'class' => 'form-control',
                        'type' => 'number',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 label-control" for="date-timepicker2"> Date/Time : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('modified_date', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'date-timepicker2',
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
    <button type="submit" id="edit_submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
    <button type="reset" class="btn btn-danger">Reset <i class="la la-refresh position-right"></i></button>
</div>
</form>

<script type="text/javascript">
$(document).ready(function(){
    
    $(document).on('click', '#edit_submit', function () {

    });
    
    $('#app_id2').select2({
        allowClear: true,
        placeholder: '-- SELECT APP --',
        width: '100%',
        ajax: {
            url: '<?php echo URL_PATH; ?>HindiVideos/AppSelect',
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
    
    $('#tags_id1').select2({
        allowClear: true,
        placeholder: 'Choose Tags...',
        width: '100%',
    });

    $('#date-timepicker2').pickadate({
        format: 'dd/mm/yyyy',
        formatSubmit: 'dd/mm/yyyy',
    });
    
    $('#HindiVideosEditForm').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            "data[HindiVideos][app_id]": {
                required: true,
            },
            "data[HindiVideos][title]": {
                required: true,
            },
            "data[HindiVideos][tags_id][]": {
                required: true,
            },
            "data[HindiVideos][tags]": {
                required: true,
            },
            "data[HindiVideos][views]": {
                required: true,
            },
            "data[HindiVideos][downloads]": {
                required: true,
            },
            "data[HindiVideos][modified_date]": {
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
    
    $('#url1').on('change', function () {
        $(this).valid();
    });
    
    $("#tags_id1").on("select2:close", function (e) {
        $(this).valid();
    });
    
    $("#app_id2").on("select2:close", function (e) {
        $(this).valid();
    });

    $('#url1').each(function () {
        $(this).rules('add', {
            extension: "mp4",
            messages: {
                extension: "Please, upload mp4 files only!"
            }
        });
    });
    
    $(document).on('click', '#confirm-delete-images', function (e) {
        var id = $(this).data('id');
        e.preventDefault();
        
        Swal.fire({
            title: "Are you sure want to delete this video?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo URL_PATH; ?>HindiVideos/delete_image',
                    data: {
                        'id': id,
                    },
                    success: function (msg) {
                        $('#removed-p-tag').remove();
                        $('#image_loc').find('.controls').append('<input type="file" name="data[HindiVideos][url]" error="error" id="url1" class="form-control file"">');
                        $('#DataTables_Table_0').DataTable().ajax.reload();
                        Swal.fire("Deleted!", "Your Video file has been deleted.", "success");
                    }
                });
                
            } else {
                Swal.fire("Cancelled", "Your Video file is safe :)", "error");
            }
        });
    });
});

</script>
