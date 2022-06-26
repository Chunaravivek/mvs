<?php 

$this->layout = false; 

?>
<?php
    echo $this->Form->create('TemplateTypes', array('url' => '/TemplateTypes/save/'.$id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); 
?>
<div class="modal-body">
    <div class="form-body">
        <div class="form-group row">
            <label class="col-md-2 label-control" for="title"> Type : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('type', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'type',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Type',
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
                toastr.error('Already Exits Type', 'Error!', { 
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

    $('#TemplateTypesAddForm').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            "data[TemplateTypes][type]": {
                required: true,
                remote: {
                    type: "POST",
                    url: "<?php echo URL_PATH;?>TemplateTypes/ifTag",
                    dataType: "json",
                    data: {
                        tag : function() {
                            return $("#type").val();
                        },
                        id : function() {
                            return <?php echo $this->request->data['TemplateTypes']['id']; ?>;
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

</script>
