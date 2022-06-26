<?php
$this->layout = false;
?>
<?php
echo $this->Form->create('Cities', array('url' => '/Cities/save/' . $id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data'));
?>
<div class="modal-body">
    <div class="form-body">
        <div class="form-group row">
            <label class="col-md-3 label-control"  for="type_id"> Select Types : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    $types_arr = array(1 => 'City', 2 => 'State', 3 => 'Country');
                    echo $this->Form->input('type_id', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'type_id',
                        'type' => 'select',
                        'class' => 'type_id form-control',
                        'empty' => '-- SELECT Types-- ',
                        'options' => $types_arr
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control"  for="name"> Name : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('name', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'name',
                        'type' => 'text',
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
    $(document).ready(function () {
        $('#account_id_1').select2({
            allowClear: true,
            placeholder: '-- SELECT ACCOUNT --',
            width: '100%',
            ajax: {
                url: '<?php echo URL_PATH; ?>Cities/AccountsSelect',
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

        checkEmailSuccess = function (response) {

            switch (jQuery.parseJSON(response).code) {
                case 200:
                    toastr.success('Available', 'successfully', {
                        positionClass: 'toast-top-right',
                        timeOut: 5000,
                        progressBar: !0,
                    })
                    return "true";
                case 201:
                    toastr.warning('Already Exits', 'Warning!', {
                        positionClass: 'toast-top-right',
                        timeOut: 5000,
                        progressBar: !0,
                    })
                    break;
                case 401:
                    toastr.error('Unavailable', 'Error!', {
                        positionClass: 'toast-top-right',
                        timeOut: 5000,
                        progressBar: !0,
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

        $('#CitiesEditForm').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                "data[Cities][name]": {
                    required: true,
                },
                "data[Cities][type_id]": {
                    required: true,
                },
            },
            submitHandler: function (form) {
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
