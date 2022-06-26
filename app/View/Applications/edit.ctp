<?php 

$this->layout = false; 

?>
<?php
    echo $this->Form->create('Applications', array('url' => '/Applications/save/'.$id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); 
    $options = array('' => $Accounts);
?>
<div class="modal-body">
    <div class="form-body">
        <div class="form-group row">
            <label class="col-md-3 label-control" for="name"> App Name : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('name', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'name',
                        'class' => 'form-control',
                        'placeholder' => 'Enter App Name',
                    ));
                    ?>

                </div>
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control"  for="package_name"> Package Name : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('package_name', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'package_name1',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Package Name',
                    ));
                    ?>
                </div>
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control"  for="app_version"> App Version : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('app_version', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'app_version',
                        'class' => 'form-control',
                        'placeholder' => 'Enter App Version',
                    ));
                    ?>
                </div>
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control"  for="account_id"> Developer Acc : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('account_id', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'account_id_1',
                        'type' => 'select',
                        'class' => 'account_id_1 form-control',
                        'options' => $options
                    ));
                    ?>
                </div>
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control"  for="firebase_id"> Firebase ID : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('firebase_id', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'firebase_id',
                        'type' => 'text',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Firebase ID',
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
    $('#account_id_1').select2({
        allowClear: true,
        placeholder: '-- SELECT ACCOUNT --',
        width: '100%',
        ajax: {
            url: '<?php echo URL_PATH;?>Applications/AccountsSelect',
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
                toastr.warning('Already Exits', 'Warning!', { 
                    positionClass: 'toast-top-right',
                    timeOut: 5000,
                    progressBar:!0,
                })
                break;
            case 401:
                toastr.error('Unavailable', 'Error!', { 
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
    
    $('#ApplicationsEditForm').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            "data[Applications][name]": {
                required: true,
            },
            "data[Applications][package_name]": {
                required: true,
//                remote: {
//                    type: "POST",
//                    url: "<?php echo URL_PATH;?>Applications/package_name",
//                    dataType: "json",
//                    data: {
//                        package_name : function() {
//                            return $("#package_name1").val();
//                        },
//                        id : function() {
//                            return <?php echo $this->request->data['Applications']['id']; ?>;
//                        },
//                    },
//                    beforeSend: function() {
//                        var loading = $('#edit_submit');
//                        loading.prop('disabled', true);
//                        loading.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
//                    },
//                    dataFilter: function(response) {
//
//                        return checkEmailSuccess(response);
//                    },
//                    complete: function() {
//                        var loading = $('#edit_submit');
//                        loading.prop('disabled', false);
//                        loading.html('<i class="la la-check-square-o"></i> Save');
//                    },
//                },
            },
            "data[Applications][app_version]": {
                required: true,
            },
            "data[Applications][account_id]": {
                required: true,
            },
            "data[Applications][firebase_id]": {
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
        
    $(".account_id_1").on("select2:close", function (e) {
        $(this).valid();
    });
});

</script>
