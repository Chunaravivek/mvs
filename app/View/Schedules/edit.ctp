<?php 

$this->layout = false; 

?>
<?php
    echo $this->Form->create('Schedules', array('url' => '/Schedules/save/'.$id, 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')); 
   
?>
<div class="modal-body">
    <div class="form-body">
        <div class="form-group row">
            <label class="col-sm-3 label-control" for="template1">Select Template : </label>
            <div class="col-sm-9">
                <?php
                echo $this->Form->input('template', array('error',
                    'div' => 'clearfix',
                    'label' => false,
                    'id' => 'template1',
                    'class' => 'select2 col-md-10 template1',
                    'empty' => '-- SELECT Template-- ',
                    'options' => $templates
                ));
                ?>
            </div>
        </div>

        <div class="android_ids">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="android_id1"> TEST :</label>
                <div class="col-md-9 mx-auto">
                    <div class="input-group">
                        <?php
                        echo $this->Form->input('android_id', array('error',
                            'label' => false,
                            'div' => false,
                            'id' => 'android_id1',
                            'class' => 'form-control',
                            'placeholder' => 'Enter Android Ids',
                            'type' => 'text',
                        ));
                        ?>
                        <div class="input-group-append">
                            <button class="btn btn-purple btn-sm tooltip-success popover-notitle bg-purple border-purple" id="test1" data-rel="popover" data-content="default" data-delay="20" type="button">
                                send
                                <i class="la la-bell"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 label-control" for="date1"> Date : </label>
            <div class="col-md-9 mx-auto">
                <div class="controls">
                    <?php
                    echo $this->Form->input('date', array('error',
                        'label' => false,
                        'div' => false,
                        'id' => 'date1',
                        'class' => 'form-control',
                        'type' => 'text'
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
    
    $('#template1').select2({
        allowClear: true,
        placeholder: '-- SELECT TEMPLATES --',
        width: '100%',
    });

    $('#date1').dateDropper({
        dropWidth: 200,
        format: 'd/m/Y',
        defaultDate: new Date(),
    }); 

    
        
    $('[data-rel=popover]').popover({html:true});
        
    $('#test1').on('click', function(){
        var e = $(this);
        if($('#android_id1').val()!="" && $('.template1').val()!=""){
            var android_id = $('#android_id1').val();
            var template_id = $('.template1').val();
            var baseurl = '<?php echo URL_PATH; ?>';
            $.ajax({
                type: 'post',
                url: baseurl+'Schedules/send_notifs',
                data: { 
                   'android_id': android_id, 'template_id':template_id
                },
                cache: true,
                success: function(response){
                    $(e).attr('data-content',response);
                    $(e).popover("show") 
                    $(e).on('shown.bs.popover',function() { 
                        setTimeout(function() {
                        $(e).popover("hide")}, 2000); 
                    }); 
                }
            });
        } else {
            $(this).attr('data-content','template/android_id missing');
            $(this).popover('show');
        }
    });
   
    $(document).on('click', '#edit_submit', function () {

    });
    $('#SchedulesEditForm').validate({
        errorElement: 'div',
        errorClass: 'help-block',
        focusInvalid: false,
        rules: {
            "data[Schedules][type]": {
                required: true,
            },
            "data[Schedules][video_type]": {
                required: true,
            },
            "data[Schedules][category]": {
                required: true,
            },
            "data[Schedules][title]": {
                required: true,
            },
            "data[Schedules][message]": {
                required: true,
            },
            "data[Schedules][android_ids]": {
                required: true,
            },
            "data[Schedules][date]": {
                required: true,
            },
            "data[Schedules][time]": {
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
    
    $("#type1").on("select2:close", function (e) {
        $(this).valid();
    });

    $("#video_type1").on("select2:close", function (e) {
        $(this).valid();
    });

    $("#category1").on("select2:close", function (e) {
        $(this).valid();
    });
});

</script>
