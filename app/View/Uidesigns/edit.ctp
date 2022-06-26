<?php 

$this->layout = false; 

?>
<?php
    echo $this->Form->create('Uidesigns', array('url' => '/Uidesigns/save/'.$id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); 
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
            <label class="col-md-2 label-control" for="description"> Description : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('description', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'description',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Description',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row" id="image_loc">
            <label class="col-md-2 label-control" id="images_file" for="image1"> Image : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    if (isset($this->request->data['Uidesigns']['images']) && $this->request->data['Uidesigns']['images'] != '') {
                        echo "<p id='removed-p-tag'>";
                        echo "<img name='image' src=" .$this->request->data['Uidesigns']['images'] . " height='60px' width='60px'>";
                        echo "<button class='ui-button ui-widget ui-corner-all ml-1' id='confirm-delete-image' title='" . $this->request->data['Uidesigns']['images'] . "' data-id='".$this->request->data['Uidesigns']['id']."'><span class='ui-icon ft-image'></span>Delete Image</button>";
                        echo "</p>";
                    } else {
                        echo $this->Form->input('images', array('error',
                            'label' => false,
                            'div' => false,
                            'id' => 'image1',
                            'class' => 'form-control file',
                            'type' => 'file',
                        ));
                    }
                    
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
                toastr.error('Already Exits Title', 'Error!', { 
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

    $('#UidesignsAddForm').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            "data[Uidesigns][title]": {
                required: true,
                remote: {
                    type: "POST",
                    url: "<?php echo URL_PATH;?>Uidesigns/ifTag",
                    dataType: "json",
                    data: {
                        tag : function() {
                            return $("#title").val();
                        },
                        id : function() {
                            return <?php echo $this->request->data['Uidesigns']['id']; ?>;
                        },
                    },
                    beforeSend: function() {
                        var loading = $('#edit_submit');
                        loading.prop('disabled', true);
                        loading.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
                    },
                    dataFilter: function(response) {
                        return checkEmailSuccess(response);
                    },
                    complete: function() {
                        var loading = $('#edit_submit');
                        loading.prop('disabled', false);
                        loading.html('<i class="la la-check-square-o"></i> Save');
                    },
                },
            },
            "data[Uidesigns][description]": {
                required: true,
            },
            "data[Uidesigns][images]": {
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
    
    $(document).on('click', '#confirm-delete-image', function (e) {
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
                    url: '<?php echo URL_PATH; ?>Uidesigns/delete_image',
                    data: {
                        'id': id,
                    },
                    success: function (msg) {
                        $('#removed-p-tag').remove();
                        $('#image_loc').find('.controls').append('<input type="file" name="data[Uidesigns][images]" error="error" id="image1" class="form-control file" aria-required="true">');
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
