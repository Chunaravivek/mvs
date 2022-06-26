<?php 

$this->layout = false; 

?>
<?php
    echo $this->Form->create('Admin', array('url' => '/Admin/save/'.$id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); 
?>
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
    <button type="submit" id="edit_submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
    <button type="reset" class="btn btn-danger">Reset <i class="la la-refresh position-right"></i></button>
</div>
</form>

<script type="text/javascript">
$(document).ready(function(){
   
    $(document).on('click', '#edit_submit', function () {

    });
    
    $('#AdminEditForm').validate({
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
