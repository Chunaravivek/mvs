<?php 

$this->layout = false; 

?>
<?php
    echo $this->Form->create('GodTextStatus', array('url' => '/GodTextStatus/save/'.$id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); 
    $options = array('' => $GodTags);
?>
<div class="modal-body">
    <div class="form-body">
        <div class="form-group row">
            <label class="col-md-3 label-control"  for="tag_id"> Tag : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('tag_id', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'tag_id1',
                        'type' => 'select',
                        'class' => 'tag_id1 form-control',
                        'options' => $options
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="text"> Text : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('text', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'text',
                        'class' => 'form-control',
                        'placeholder' => 'Enter Text',
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
    $('.tag_id1').select2({
        allowClear: true,
        placeholder: '-- SELECT Tags --',
        width: '100%',
        ajax: {
            url: '<?php echo URL_PATH; ?>GodTextStatus/TagSelect',
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
    $('#GodTextStatusEditForm').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            "data[GodTextStatus][tag_id]": {
                required: true,
            },
            "data[GodTextStatus][text]": {
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
    
    $(".tag_id1").on("select2:close", function (e) {
        $(this).valid();
    });
});

</script>
