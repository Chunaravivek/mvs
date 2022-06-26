<?php 

$this->layout = false; 

?>
<?php
    echo $this->Form->create('Key', array('url' => '/Key/save/'.$id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); 
    $options = array('' => $Application);
?>
<div class="modal-body">
    <div class="form-body">
        <div class="form-group row">
            <label class="col-md-2 label-control"  for="app_id1"> Application : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('app_code', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'app_id1',
                        'type' => 'select',
                        'class' => 'app_id1 form-control',
                        'options' => $options
                    ));
                    ?>
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
    <button type="submit" id="edit_submit" class="btn btn-primary"><i class="la la-check-square-o"></i> Save</button>
    <button type="reset" class="btn btn-danger">Reset <i class="la la-refresh position-right"></i></button>
</div>
</form>

<script type="text/javascript">
$(document).ready(function(){
    $('#app_id1').select2({
        allowClear: true,
        placeholder: '-- SELECT App --',
        width: '100%',
        ajax: {
            url: '<?php echo URL_PATH;?>Key/ApplicationsSelect',
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
    
    $('#KeyEditForm').validate({
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
//            "data[Key][client_key2]": {
//                required: true,
//            },
//            "data[Key][client_key3]": {
//                required: true,
//            },
//            "data[Key][client_key4]": {
//                required: true,
//            },
//            "data[Key][client_key5]": {
//                required: true,
//            },
//            "data[Key][client_key6]": {
//                required: true,
//            },
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
        
    $("#app_id1").on("select2:close", function (e) {
        $(this).valid();
    });
});

</script>
