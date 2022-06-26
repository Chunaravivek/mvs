<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: Add user');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<section class="content-header">
  <h1>
    Add Admin
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo WEB_ROOT;?>Dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo WEB_ROOT . '/' . $this->request->params['controller']; ?>"><?php echo $this->request->params['controller']; ?></a></li>
    <li class="active"><?php echo $this->request->params['action'] .' ' . $this->request->params['controller']; ?></li>
</ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-body">
                    <?php
                        echo $this->Form->create('Admin', array('url' => array('controller' => 'Admin', 'action' => 'add'), 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); 
                    ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Full Name : </label>
                        <div class="col-xs-10 col-sm-5">
                            <?php
                            echo $this->Form->input('full_name', array('error',
                                'div' => 'clearfix',
                                'label' => false,
                                'id' => 'full_name',
                                'class' => 'form-control',
                            ));
                            ?>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email : </label>
                        <div class="col-xs-10 col-sm-5">
                            <?php
                            echo $this->Form->input('email', array('error',
                                'div' => 'clearfix',
                                'label' => false,
                                'type' => 'email',
                                'id' => 'email',
                                'class' => 'form-control',
                            ));
                            ?>
                            
                        </div>
                    </div>
                                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Password : </label>
                        <div class="col-xs-10 col-sm-5">
                            <?php
                            echo $this->Form->input('password', array('error',
                                'div' => 'clearfix',
                                'label' => false,
                                'type' => 'password',
                                'id' => 'password',
                                'class' => 'form-control',
                            ));
                            ?>
                            
                        </div>
                    </div>
                                    
                                    
                    <?php
                    echo '<div class="col-sm-10 text-center">';
                        echo $this->Form->submit('submit', array(
                            'div' => false,
                            'id'=>'submit',
                            'class' => 'btn btn-sm btn-primary mar_right5'
                        ));

                        echo $this->Form->button('Cancel', array(
                            'type'=>'button',
                            'class' => 'btn btn-sm btn-danger',
                            'div' => false,
                            'onclick' => 'cancelFrm();'
                        ));
                    echo '</div>';
                    echo $this->Form->end();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        $("#submit").click(function () {
            if ($("#AdminAddForm").valid() === true) {
                $("#AdminAddForm").submit();
            }
        });
        $('#AdminAddForm').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                "data[Admin][email]": {
                    required: true,
                    emailExt: true,
                },
                "data[Admin][full_name]": {
                    required: true,
                },
                "data[Admin][password]": {
                    required: true,
                },
                messages: {
                    "data[Admin][email]": {
                         required: "Please enter email address",
                         emailExt: "Please enter valid email address",
                    }
                }
            },
            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            },

            success: function (e) {
                $(e).closest('.form-group').removeClass('has-error').addClass('has-info');
                $(e).remove();
            },

            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            },
        });
        jQuery.validator.addMethod("emailExt", function(value, element, param) {
            return value.match(/^\s*(([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+([;.](([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5}){1,25})+)*\s*$/);
        },'Please enter your valid email address');
    });

    function cancelFrm()
    {
        window.location.href = "<?php echo $this->webroot;?>Admin/index";
    }
</script>
