<?php 

$this->layout = false; 

?>
<?php
    echo $this->Form->create('GodTags', array('url' => '/GodTags/save/'.$id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); 
?>
<div class="modal-body">
    <div class="form-body">
<!--        <div class="form-group row">
            <label class="col-md-2 label-control"  for="tag_type"> Tag Type : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('tag_type', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'tag_type1',
                        'type' => 'select',
                        'class' => 'tag_type form-control',
                        'options' => $tag_type,
                    ));
                    ?>
                </div>
            </div>
        </div>-->
        <div class="form-group row">
            <label class="col-md-2 label-control" for="name1"> Name : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('name', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'name1',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Name',
                    ));
                    ?>
                </div>
            </div>
        </div>
<!--        <div class="form-group row">
            <label class="col-md-2 label-control" for="tag"> Tag : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('tag', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'tag1',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Tag',
                    ));
                    ?>
                </div>
            </div>
        </div>-->
        <div class="form-group row" id="image_loc">
            <label class="col-md-2 label-control" id="images_file" for="images1"> Image : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    if (isset($this->request->data['GodTags']['images']) && $this->request->data['GodTags']['images'] != '') {
                        echo "<p id='removed-p-tag'>";
                        echo "<img name='images' src=" .$this->request->data['GodTags']['images'] . " height='60px' width='60px'>";
                        echo "<button class='ui-button ui-widget ui-corner-all ml-1' id='confirm-delete-images' title='" . $this->request->data['GodTags']['images'] . "' data-id='".$this->request->data['GodTags']['id']."'><span class='ui-icon ft-image'></span>Delete Images</button>";
                        echo "</p>";
                    } else {
                        echo $this->Form->input('images', array('error',
                            'label' => false,
                            'div' => false,
                            'id' => 'images1',
                            'class' => 'form-control file',
                            'type' => 'file',
                        ));
                    }
                    
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 label-control" for="order"> Order : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('order', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'order',
                        'class' => 'form-control',
                        'type' => 'number',
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
    $('#tag_type1').select2({
        allowClear: true,
        placeholder: '-- SELECT Tag Types --',
        width: '100%',
        ajax: {
            url: '<?php echo URL_PATH;?>GodTags/TagTypeSelect',
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
    
    $(document).on('click', '#edit_submit', function () {

    });
    
    checkEmailSuccess = function(response) {

        switch (jQuery.parseJSON(response).code) {
            case 200:
                toastr.success('Available', 'successfully', { 
                    positionClass: 'toast-top-right',
                    timeOut: 5000,
                    progressBar:!0,
                })
                return "true"; 
            case 201:
                toastr.error('Already Exits Tag', 'Error!', { 
                    positionClass: 'toast-top-right',
                    timeOut: 5000,
                    progressBar:!0,
                })
                break;
            case undefined:
                alert("An undefined error occurred.");
                break;
            default:
                alert("An undefined error occurred");
                break;
        }
        return false;
    };
    
    $('#GodTagsEditForm').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            "data[GodTags][tag_type]": {
                required: true,
            },
            "data[GodTags][name]": {
                required: true,
                remote: {
                    type: "POST",
                    url: "<?php echo URL_PATH;?>GodTags/ifTag",
                    dataType: "json",
                    data: {
                        tag : function() {
                            return $("#name1").val();
                        },
                        id : function() {
                            return <?php echo $this->request->data['GodTags']['id']; ?>;
                        },
                    },
                    beforeSend: function() {
                        var loading = $('#add_submit');
                        loading.prop('disabled', true);
                        loading.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
                    },
                    dataFilter: function(response) {
                        return checkEmailSuccess(response);
                    },
                    complete: function() {
                        var loading = $('#add_submit');
                        loading.prop('disabled', false);
                        loading.html('<i class="la la-check-square-o"></i> Save');
                    },
                },
            },
            "data[GodTags][images]": {
                required: true,
            },
            "data[GodTags][order]": {
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
    
    $('.file').on('change', function () {
        $(this).valid();
    });

    $('.file').each(function () {
        $(this).rules('add', {
            extension: "png|jpg|gif|jpeg|bmp",
            messages: {
                extension: "This field can accept images only!"
            }
        });
    });
    
    $("#tag_type1").on("select2:close", function (e) {
        $(this).valid();
    });
    
    $(document).on('click', '#confirm-delete-images', function (e) {
        var id = $(this).data('id');
        e.preventDefault();
        
        Swal.fire({
            title: "Are you sure want to delete this image?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo URL_PATH; ?>GodTags/delete_image',
                    data: {
                        'id': id,
                    },
                    success: function (msg) {
                        $('#removed-p-tag').remove();
                        $('#image_loc').find('.controls').append('<input type="file" name="data[GodTags][images]" error="error" id="images1" class="form-control file" aria-required="true">');
                        $('#DataTables_Table_0').DataTable().ajax.reload();
                        Swal.fire("Deleted!", "Your Image file has been deleted.", "success");
                    }
                });
                
            } else {
                Swal.fire("Cancelled", "Your Image file is safe :)", "error");
            }
        });
    });
});

</script>
