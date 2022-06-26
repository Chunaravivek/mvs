<?php 

$this->layout = false; 

?>
<?php
    echo $this->Form->create('Accounts', array('url' => '/Accounts/save/'.$id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); 
?>
<div class="modal-body">
    <div class="form-body">
        <div class="form-group row">
            <label class="col-md-2 label-control" for="name"> Name : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('name', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'name',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Name',
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
    $('#AccountsEditForm').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            "data[Accounts][name]": {
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
});

</script>
