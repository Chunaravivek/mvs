<?php 

$this->layout = false; 

?>
<?php
    echo $this->Form->create('Settings', array('url' => '/Settings/save/'.$id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); 
?>
<div class="modal-body">
    <div class="form-body">
        <div class="form-group row">
            <label class="col-md-3 label-control" for="company_name"> Company Name : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('company_name', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'company_name',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Company Name',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="description"> Description : </label>
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
            <label class="col-md-3 label-control" for="logo"> Logo : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    if (isset($this->request->data['Settings']['logo']) && $this->request->data['Settings']['logo'] != '') {
                        echo "<p id='removed-p-tag'>";
                        echo "<img name='logo' src=" .$this->request->data['Settings']['logo'] . " height='80px' width='150px'>";
                        echo "<button class='ui-button ui-widget ui-corner-all ml-1' id='confirm-delete-logo' title='" . $this->request->data['Settings']['logo'] . "' data-id='".$this->request->data['Settings']['id']."'><span class='ui-icon ft-image'></span>Delete Image</button>";
                        echo "</p>";
                    } else {
                        echo $this->Form->input('logo', array('error',
                            'label' => false,
                            'div' => false,
                            'id' => 'logo1',
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
    
    $('#SettingsEditForm').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            "data[Settings][name]": {
                required: true,
            },
            "data[Settings][image]": {
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
    
    $(document).on('click', '#confirm-delete-logo', function (e) {
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
                    url: '<?php echo URL_PATH; ?>Settings/delete_image',
                    data: {
                        'id': id,
                    },
                    success: function (msg) {
                        $('#removed-p-tag').remove();
                        $('#image_loc').find('.controls').append('<input type="file" name="data[Settings][logo]" error="error" id="logo1" class="form-control file" aria-required="true">');
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
