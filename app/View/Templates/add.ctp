<?php
    echo $this->Element('all_form_css'); 
?>

<?php echo  $this->Element('breadcrumb'); ?>

<style>
    .fixed-positions {
        position: fixed;
        width: 26%;
    }
</style>
<div class="content-body">
    <!-- DOM - jQuery events table -->
    <section id="dom">
        <div class="row">
            <div class="col-12">
                <div class="card" style="padding-bottom: 100px;">
                    <?php echo $this->Session->flash(); ?>
                    <div class="card-header">
                        <h4 class="card-title">Manage Templates Add</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-8 order-2 order-xl-1">
                                    <?php echo $this->Form->create('Templates', array('url' => array('controller' => 'Templates', 'action' => 'add'), 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="type"> Type : </label>
                                            <div class="col-md-9">
                                                <div class="controls">                           
                                                    <?php
                                                    echo $this->Form->input('template_type', array('error',
                                                        'div' => false,
                                                        'label' => false,
                                                        'id' => 'template_type',
                                                        'class' => 'form-control temp_type col-md-10',
                                                        'required' => 'required',
                                                        'empty' => '-- Select TYPE -- ',
                                                        'options' => $temp_types
                                                    ));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="account" style="display: none">
                                            <div class="form-group row"> 
                                                <label class="col-sm-3 label-control" for="account_id" > Developer Account : </label>
                                                <div class="col-md-9"> 
                                                    <div class="controls">                           
                                                        <?php
                                                        echo $this->Form->input('account_id', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'account_id',
                                                            'class' => 'form-control account col-md-10',
                                                            'required' => 'required',
                                                            'empty' => '-- Select ACCOUNT -- ',
                                                            'options' => $accounts
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="application" style="display: none"> 
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="app_code"> Select Application : </label>
                                                <div class="col-md-9">
                                                    <div class="controls">                           
                                                        <?php
                                                        echo $this->Form->input('app_code', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'app_code',
                                                            'class' => 'form-control application col-md-10',
                                                            'required' => 'required',
                                                            'empty' => '-- Select Applications -- ',
                                                            'options' => $applications
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 label-control" for="sent_type">Select UI : </label>
                                            <div class="col-md-9">
                                                <div class="controls">                           
                                                    <?php
                                                    echo $this->Form->input('type', array('error',
                                                        'div' => false,
                                                        'label' => false,
                                                        'id' => 'type',
                                                        'class' => 'form-control uidesign col-md-10',
                                                        'required' => 'required',
                                                        'empty' => '-- Select UI -- ',
                                                        'options' => $uidesigns
                                                    ));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bgcolor" style="display: none;">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="bgcolor"> Background Color : </label>
                                                <div class="col-sm-9"> 
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->input('bgcolor', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'bgcolor',
                                                            'type' => 'text',
                                                            'class' => 'form-control col-md-12 input-sm',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 label-control" for="title">Title : </label>
                                            <div class="col-sm-9">
                                                <div class="controls">
                                                    <?php
                                                    echo $this->Form->input('title', array('error',
                                                        'div' => false,
                                                        'label' => false,
                                                        'id' => 'title',
                                                        'class' => 'form-control col-md-10',
                                                        'type' => 'text'
                                                    ));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="title_bgcolor" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="title_bgcolor"> Title Background Color : </label>
                                                <div class="col-sm-9">
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->input('title_bgcolor', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'title_bgcolor',
                                                            'type' => 'text',
                                                            'class' => 'form-control col-md-12 input-sm',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="title_text_color" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="title_text_color"> Title Text Color : </label>
                                                <div class="col-sm-9"> 
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->input('title_text_color', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'title_text_color',
                                                            'type' => 'text',
                                                            'class' => 'form-control col-md-12 input-sm',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="user_field" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="user_field"> Select User Field : </label>
                                                <div class="col-sm-9">      
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->input('user_field', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'user_field',
                                                            'class' => 'form-control col-md-10',
                                                            'options' => ""
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="option1" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="option1">Option 1 : </label>
                                                <div class="col-sm-9">  
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->input('option1', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'option1',
                                                            'class' => 'form-control col-md-10',
                                                            'type' => 'text'
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class=option2" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="option2"> Option 2 : </label>
                                                <div class="col-sm-9">    
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->input('option2', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'option2',
                                                            'class' => 'form-control col-md-10',
                                                            'type' => 'text'
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 label-control" for="msg">Message : </label>
                                            <div class="col-sm-9">
                                                <div class="controls">
                                                    <?php
                                                    echo $this->Form->input('msg', array('error',
                                                        'div' => false,
                                                        'label' => false,
                                                        'id' => 'msg',
                                                        'class' => 'form-control col-md-10',
                                                        'type' => 'textarea'
                                                    ));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="msgcolor" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="msgcolor"> Message Color : </label>
                                                <div class="col-sm-9">
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->input('msgcolor', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'msgcolor',
                                                            'class' => 'form-control col-md-12 input-sm',
                                                            'type' => 'text'
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="img_top" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="img_position_top"> Image Position(top/bottom) : </label>
                                                <div class="col-sm-9">   
                                                    <div class="controls">
                                                        <input type="checkbox" id="img_position_top" name="data[Templates][img_top]" class="switch-toggle input-sm" data-off-color="danger" checked="" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="close_button_exist" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="close_button_exist"> Close Button Exist : </label>
                                                <div class="col-sm-9">                                                       
                                                    <div class="controls">
                                                        <input class="switch-toggle" id="close_button_exist" type="checkbox" data-off-color="danger" name="data[Templates][close_button_exist]">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="close_button_icon" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Close Icon(b/w) : </label>
                                                <div class="col-sm-9">                                                       
                                                    <div class="controls">
                                                        <input class="switch-toggle" type="checkbox" data-off-color="danger" name="data[Templates][close_button_icon]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="full_image" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Full Image : </label>
                                                <div class="col-sm-9">                                                       
                                                    <div class="controls">
                                                        <input class="switch-toggle" type="checkbox" data-off-color="danger" name="data[Templates][full_image]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
 
                                        <div class="btn_seprator" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Button Separator : </label>
                                                <div class="col-sm-9">                                                       
                                                    <div class="controls">
                                                        <input class="switch-toggle" type="checkbox" data-off-color="danger" name="data[Templates][btn_seprator]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
 
                                        <div class="param1" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Parameter 1 : </label>
                                                <div class="col-sm-9">                                                       
                                                    <div class="controls">
                                                        <input class="switch-toggle" type="checkbox" data-off-color="danger" name="data[Templates][param1]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
 
                                        <div class="param2" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Parameter 2 : </label>
                                                <div class="col-sm-9">                                                       
                                                    <div class="controls">
                                                        <input class="switch-toggle" type="checkbox" data-off-color="danger" name="data[Templates][param2]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
 
                                        <div class="singlebtn" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Single Button : </label>
                                                <div class="col-sm-9">                                                       
                                                    <div class="controls">
                                                        <input class="switch-toggle" type="checkbox" data-off-color="danger" name="data[Templates][singlebtn]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="imageorlink" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Image/Link : </label>
                                                <div class="col-sm-9">                                                       
                                                    <div class="controls">
                                                        <input class="switch-toggle" type="checkbox" data-off-color="danger" name="data[Templates][imageorlink]">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="close_button_color" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Close Background : </label>
                                                <div class="col-sm-9">   
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->input('close_button_color', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'close_button_color',
                                                            'class' => 'form-control col-md-12 input-sm',
                                                            'type' => 'text'
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="img_file" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="form-field-1">Choose Image : </label>
                                                <div id="file_set" class="col-sm-9">
                                                    <div class="controls">
                                                    </div>
                                                    <?php
                                                    echo $this->Form->input('img_file', array('error',
                                                        'div' => false,
                                                        'label' => false,
                                                        'id' => 'img_file',
                                                        'class' => 'form-control col-md-10 file',
                                                        'type' => 'file',
                                                    ));
                                                    ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div cass="image" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message">Image Link : </label>
                                                <div class="col-sm-9">
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->input('image', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'image',
                                                            'class' => 'form-control col-md-10',
                                                            'required' => 'required',
                                                            'type' => 'text'
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="btnmargin" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Button Margin : </label>
                                                <div class="col-sm-9"> 
                                                    <div class="controls">
                                                    </div>
                                                    <?php
                                                    echo $this->Form->input('btnmargin', array('error',
                                                        'div' => false,
                                                        'label' => false,
                                                        'id' => 'btnmargin',
                                                        'class' => 'form-control col-md-10',
                                                        'required' => 'required',
                                                        'type' => 'text'
                                                    ));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="button1_text" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Button1 Text : </label>
                                                <div class="col-sm-9">
                                                    <div class="controls">
                                                    </div>
                                                    <?php
                                                    echo $this->Form->input('button1_text', array('error',
                                                        'div' => false,
                                                        'label' => false,
                                                        'id' => 'button1_text',
                                                        'class' => 'form-control col-md-10',
                                                        'type' => 'text'
                                                    ));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="button1_color" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Button1 Color : </label>
                                                <div class="col-sm-9">
                                                    <div class="controls">
                                                    </div>
                                                    <?php
                                                    echo $this->Form->input('button1_color', array('error',
                                                        'div' => false,
                                                        'label' => false,
                                                        'id' => 'button1_color',
                                                        'class' => 'form-control col-md-12 input-sm',
                                                        'type' => 'text'
                                                    ));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="button1_text_color" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Button1 Textcolor : </label>
                                                <div class="col-sm-9">
                                                    <div class="controls">
                                                    </div>
                                                    <?php
                                                    echo $this->Form->input('button1_text_color', array('error',
                                                        'div' => false,
                                                        'label' => false,
                                                        'id' => 'button1_text_color',
                                                        'class' => 'form-control col-md-12 input-sm',
                                                        'type' => 'text'
                                                    ));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="button2_text" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Button2 Text : </label>
                                                <div class="col-sm-9">
                                                    <div class="controls">
                                                    </div>
                                                    <?php
                                                    echo $this->Form->input('button2_text', array('error',
                                                        'div' => false,
                                                        'label' => false,
                                                        'id' => 'button2_text',
                                                        'class' => 'form-control col-md-10',
                                                        'type' => 'text',
                                                    ));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="button2_color" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Button2 Color : </label>
                                                <div class="col-sm-9">
                                                    <div class="controls">
                                                    </div>
                                                    <?php
                                                    echo $this->Form->input('button2_color', array('error',
                                                        'div' => false,
                                                        'label' => false,
                                                        'id' => 'button2_color',
                                                        'class' => 'form-control col-md-12 input-sm',
                                                        'type' => 'text',
                                                    ));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="button2_text_color" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Button2 Textcolor : </label>
                                                <div class="col-sm-9">
                                                    <div class="controls">
                                                    </div>
                                                    <?php
                                                    echo $this->Form->input('button2_text_color', array('error',
                                                        'div' => false,
                                                        'label' => false,
                                                        'id' => 'button2_text_color',
                                                        'class' => 'form-control col-md-12 input-sm',
                                                        'type' => 'text',
                                                    ));
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="link" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Link1 : </label>
                                                <div class="col-sm-9">
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->input('link1', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'link1',
                                                            'class' => 'form-control col-md-10',
                                                            'type' => 'text',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="link" style="display: none">
                                            <div class="form-group row">
                                                <label class="col-sm-3 label-control" for="message"> Link2 : </label>
                                                <div class="col-sm-9">
                                                    <div class="controls">
                                                        <?php
                                                        echo $this->Form->input('link2', array('error',
                                                            'div' => false,
                                                            'label' => false,
                                                            'id' => 'link2',
                                                            'class' => 'form-control col-md-10',
                                                            'type' => 'text'
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="form-actions">
                                        <button type="reset" class="btn btn-warning mr-1">
                                            <i class="ft-refresh-ccw"></i> Reset
                                        </button>
                                        <button type="submit" id="add_submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Save
                                        </button>
                                    </div>
                                    </form>
                                </div>
                                <div class="col-12 col-sm-12 col-md-4 order-1 order-xl-2">
                                    <div class="card box-shadow-0 border-primary fixed-positions">
                                        <div class="card-header card-head-inverse bg-primary">
                                            <h4 class="card-title text-white"><i class="ft-camera"></i> Templates Overview</h4>
                                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content collapse show" style="height:430px;">
                                            <div class="card-body">
                                                <div class="control-group">

                                                    <div class="row">
                                                        <div class="col-md-12 center">
                                                            <div class="overview-container" style="display: none">
                                                                <h1 class="text-center" style="display: none">No UI Selected</h1>
                                                            </div>
                                                            <div class="radio-container" style="background-color: white; display: none; height: 190px; width: 310px;  margin-left: 6px; margin-top: -3px;">
                                                                <div id="radio_title_container" class="text-center" style="height: 60px;width: 310px; background-color: white;">
                                                                    <span class="radio_title" style="font-size: 128%; font-weight: bold; line-height: 55px; padding-top: 0; text-align: center; vertical-align: middle;">Title Goes Here!</span>
                                                                </div>
                                                                <div id="radio_answer_container" class="" style="text-align:left; height: 60px;width: 310px; background-color: white; position: relative;">
                                                                    <div class="radio">
                                                                        <div class="form-check">
                                                                            <input type="radio" class="form-check-input" name="form-field-radio">
                                                                            <label class="form-check-label option1_text">
                                                                                option 1
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="radio">
                                                                        <div class="form-check">
                                                                            <input type="radio" class="form-check-input" name="form-field-radio">
                                                                            <label class="form-check-label option2_text">
                                                                                option 2
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr id="radio_btn_seprator" style="margin-bottom: 0;margin-top: 0; display: none;">
                                                                <div id="radio_buttons_container" class="" style="margin-top: 10px;">
                                                                    <div id="radio_button1_container" style="display: inline-block; height: 50px; margin-right: 1px; width: 152px; background-color: white;">
                                                                        <span id="radio_button1_text" style="font-size: 180%; text-align: center; vertical-align: middle; line-height: 47px;">Button1</span>
                                                                    </div>
                                                                    <div id="radio_button2_container" class="" style="display: inline-block;height: 50px; margin-left: 2px; width: 151px; background-color: white;">
                                                                        <span id="radio_button2_text" style="font-size: 180%; text-align: center; vertical-align: middle; line-height: 47px;">Button2</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="forminput-container" style="background-color: white; display: none; height: 180px; width: 310px;  margin-left: 6px; margin-top: -3px;">
                                                                <div id="form_title_container" class="text-center" style="height: 60px;width: 310px; background-color: white;">
                                                                    <span class="form_title" style="font-size: 128%; font-weight: bold; line-height: 55px; padding-top: 0; text-align: center; vertical-align: middle;">Title Goes Here!</span>
                                                                </div>
                                                                <div id="form_answer_container" class="text-center" style="height: 60px;width: 310px; background-color: white; position: relative;">
                                                                    <span class="form_answer" style="position: absolute;left: 0; bottom: 0;  width: 100%;  margin: 0;" ><hr style="height:1px; background-color:#333;"></span>
                                                                </div>
                                                                <hr id="form_btn_seprator" style="margin-bottom: 0;margin-top: 0; display: none;">
                                                                <div id="form_buttons_container" class="text-center" style="margin-top: 10px;">
                                                                    <div id="form_button1_container" style="display: inline-block; height: 50px; margin-right: 1px; width: 152px; background-color: white;">
                                                                        <span id="form_button1_text" style="font-size: 180%; text-align: center; vertical-align: middle; line-height: 47px;">Button1</span>
                                                                    </div>
                                                                    <div id="form_button2_container" class="" style="display: inline-block;height: 50px; margin-left: 2px; width: 151px; background-color: white;">
                                                                        <span id="form_button2_text" style="font-size: 180%; text-align: center; vertical-align: middle; line-height: 47px;">Button2</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="notification_container" style=" position: relative;height: 400px; width: 310px;  margin-left: 6px; margin-top: -3px;display: none;">
                                                                <div id="close-container" class="close-container" style="display: none; margin-left: 288px; margin-bottom: -21px; position: absolute; right: -10px; top: -9px; font-size: 12px; font-weight: bolder;">
                                                                    <svg width="21" height="21">
                                                                    <circle cx="10" cy="10" r="10" stroke="white" stroke-width="1" fill="black" />
                                                                    <text style="font-weight: bolder;" fill="#ffffff"  x="7" y="14">X</text>
                                                                    </svg>
                                                                </div>
                                                                <div id="title_container" class="" style="height: 70px;width: 310px; background-color: white;">
                                                                    <span class="title" style="font-size: 128%; font-weight: bold; line-height: 35px; padding-top: 0; text-align: center; vertical-align: middle;">Title Goes Here!</span>
                                                                </div>
                                                                <div id="image_container" class="text-center" style="">
                                                                    <img class="img2" src="http://www.apps.s4apps.in/uploads/image-placeholder-e1411098766130.jpg" style="height: 140px; width: 280px; "/>
                                                                </div>

                                                                <div id="description_container" class="text-center" style = "height: 140px; width: 310px;">
                                                                    <center>
                                                                        <span class="msg_text" style="font-size: 90%; text-align: center; vertical-align: middle; width: 280px;">Message Goes Here!</span>
                                                                    </center>
                                                                </div>
                                                                <hr id="btn_seprator" style="margin-bottom: 0;margin-top: 0; display: none;">
                                                                <div id="buttons_container" class="text-center" >
                                                                    <div id="button1_container" style="display: inline-block; height: 50px; margin-right: 1px; width: 152px; background-color: white;">
                                                                        <span id="img_button1_text" style="font-size: 180%; text-align: center; vertical-align: middle; line-height: 47px;">Button1</span>
                                                                    </div>
                                                                    <div id="button2_container" class="" style="display: inline-block;height: 50px; margin-left: 2px; width: 151px; background-color: white;">
                                                                        <span id="img_button2_text" style="font-size: 180%; text-align: center; vertical-align: middle; line-height: 47px;">Button2</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php echo $this->Element('all_form_js'); ?>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready( function () {
        
        /* 
         *  Start Validations Templates
         * 
        */        
            $('#TemplatesAddForm').validate({
                errorElement: 'div',
                errorClass: 'help-block',
                focusInvalid: false,
                rules: {
                    "data[Templates][name]": {
                        required: true,
                    },
                    "data[Templates][template_type]": {
                        required: true,
                    },
                    "data[Templates][type]": {
                        required: true,
                    },
                    "data[Templates][app_code]": {
                        required: true,
                    },
                    "data[Templates][account_id]": {
                        required: true,
                    },
                    "data[Templates][bgcolor]": {
                        required: true,
                    },
                    "data[Templates][title]": {
                        required: true,
                    },
                    "data[Templates][title_bgcolor]": {
                        required: true,
                    },
                    "data[Templates][title_text_color]": {
                        required: true,
                    },
                    "data[Templates][btnmargin]": {
                        required: true,
                    },
                    "data[Templates][image]": {
                        required: true,
                    },
                    "data[Templates][img_file]": {
                        required: true,
                    },
                    "data[Templates][msg]": {
                        required: true,
                    },
                    "data[Templates][user_field]": {
                        required: true,
                    },
                },
                submitHandler: function(form) {
                    $this = $('#add_submit');
                    $this.prop('disabled', true);
                    $this.css('cursor', 'no-drop');
                    $this.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');
                    form.submit();
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.col-md-9').append(error);
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
            
            $("#account_id").on("select2:close", function (e) {
                $(this).valid();
            });
            
            $("#app_code").on("select2:close", function (e) {
                $(this).valid();
            });
            
            $("#type").on("select2:close", function (e) {
                $(this).valid();
            });
        /* 
         *  End Validations Templates
         * 
        */
        
        
        /* 
         *  Start Select2 Templates
         * 
        */ 
        
            $('#account_id').select2({
                allowClear: true,
                placeholder: '-- select ACCOUNT --',
                width: '84%',
            });
            
            $('#app_code').select2({
                allowClear: true,
                placeholder: '-- select Applications --',
                width: '84%',
            });
            
            $('#type').select2({
                allowClear: true,
                placeholder: '-- select UI --',
            });
        
        /* 
         *  End Select2 Templates
         * 
        */
        
        /* 
         *  Start Switch Templates
         * 
        */ 
        
            $(".switch-toggle").bootstrapSwitch();
        
        /* 
         *  End Select2 Templates
         * 
        */ 
        
        /* 
         *  Start account_id Change value Get Data Templates
         * 
        */ 
        
            $('#account_id').change(function () {
                console.log(45646);
                var ac_id = $('#account_id').val();
                $('#app_code').empty(); //remove all existing options
                $.ajax({
                    type: 'post',
                    url: '<?php echo URL_PATH; ?>Templates/get_application',
                    data: {
                        'ac_id': ac_id
                    },
                    cache: true,
                    success: function (data) {
                        $('#app_code').append(data);
                    }
                });
            });
        
        /* 
         *  End account_id Change value Get Data Templates
         * 
        */ 
        
        /* 
         *  Start Color To change Templates
         * 
        */
            
            $('#bgcolor').minicolors({
                opacity: false,
                defaultValue: '#ffff',
                control: 'hue',
                textfield: false,
                change: function(hex, opacity) {
                    $('#bgcolor').val(hex);
                    
                    var color2 = hex;
                    
                    $("#notification_container").css('background-color', color2);
                    $(".forminput-container").css('background-color', color2);
                    $(".radio-container").css('background-color', color2);
                    $("#form_answer_container").css('background-color', color2);
                    $("#radio_answer_container").css('background-color', color2);
                }
            });
            
            $('#title_bgcolor').minicolors({
                opacity: false,
                defaultValue: '#ffff',
                control: 'hue',
                textfield: false,
                change: function(hex, opacity) {
                    $('#title_bgcolor').val(hex);
                    
                    var title_container_bg = hex;
                    
                    $("#form_title_container").css('background-color', title_container_bg);
                    $("#radio_title_container").css('background-color', title_container_bg);
                    $("#title_container").css('background-color', title_container_bg);
                }
            });
            
            $('#title_text_color').minicolors({
                opacity: false,
                defaultValue: '#ffff',
                control: 'hue',
                textfield: false,
                change: function(hex, opacity) {
                    $('#title_text_color').val(hex);
                    
                    var title_text_color = hex;
                    
                    $(".title").css('color', title_text_color);
                    $(".form_title").css('color', title_text_color);
                    $(".radio_title").css('color', title_text_color);
                }
            });
            
            $('#msgcolor').minicolors({
                opacity: false,
                defaultValue: '#ffff',
                control: 'hue',
                textfield: false,
                change: function(hex, opacity) {
                    $('#msgcolor').val(hex);
                    
                    var msg_text_color = hex;
                    
                    $(".msg_text").css('color', msg_text_color);
                }
            });
            
            $('#button1_color').minicolors({
                opacity: false,
                defaultValue: '#ffff',
                control: 'hue',
                textfield: false,
                change: function(hex, opacity) {
                    $('#button1_color').val(hex);
                    
                    var button1_color = hex;
                    
                    $("#form_button1_container").css('background-color', button1_color);
                    $("#radio_button1_container").css('background-color', button1_color);
                    $("#button1_container").css('background-color', button1_color);
                }
            });
            
            $('#button1_text_color').minicolors({
                opacity: false,
                defaultValue: '#ffff',
                control: 'hue',
                textfield: false,
                change: function(hex, opacity) {
                    $('#button1_text_color').val(hex);
                    
                    var button1_text_color = hex;
                    
                    $("#form_button1_text").css('color', button1_text_color);
                    $("#radio_button1_text").css('color', button1_text_color);
                    $("#img_button1_text").css('color', button1_text_color);
                }
            });
            
            $('#button2_color').minicolors({
                opacity: false,
                defaultValue: '#ffff',
                control: 'hue',
                textfield: false,
                change: function(hex, opacity) {
                    $('#button2_color').val(hex);
                    
                    var button2_color = hex;
                    
                    $("#form_button2_container").css('background-color', button2_color);
                    $("#radio_button2_container").css('background-color', button2_color);
                    $("#button2_container").css('background-color', button2_color);
                }
            });
            
            $('#close_button_color').minicolors({
                opacity: false,
                defaultValue: '#ffff',
                control: 'hue',
                textfield: false,
                change: function(hex, opacity) {
                    $('#close_button_color').val(hex);
                    
                    var close_button_color = hex;
                    
                    $('circle').css('fill', close_button_color);
                }
            });
            
            $('#button2_text_color').minicolors({
                opacity: false,
                defaultValue: '#ffff',
                control: 'hue',
                textfield: false,
                change: function(hex, opacity) {
                    $('#button2_text_color').val(hex);
                    
                    var button2_text_color = hex;
                    
                    $("#form_button2_text").css('color', button2_text_color);
                    $("#radio_button2_text").css('color', button2_text_color);
                    $("#img_button2_text").css('color', button2_text_color);
                }
            });
        
        /* 
         *  End Color To change Templates
         * 
        */
        
        
        /* 
         *  Start On Click Event Templates
         * 
        */
        
            $('input[name="data[Templates][close_button_exist]"]').on('switchChange.bootstrapSwitch', function (event, state) {
                var close_exist = $(this).is(':checked');
                if (close_exist == true) {
                    $('#close-container').css('display', 'block');
                    $("#close_button_color").prop('required', true);
                    $('.close_button_icon').css('display', 'block');
                    $('.close_button_color').css('display', 'block');
                } else {
                    $('#close-container').css('display', 'none');
                    $('#close-container').css('display', 'none');
                    $("#close_button_color").removeAttr('required');
                    $('.close_button_icon').css('display', 'none');
                    $('.close_button_color').css('display', 'none');
                }
            });
            
            $('input[name="data[Templates][close_button_icon]"]').on('switchChange.bootstrapSwitch', function (event, state) {
                var close_color = $(this).is(':checked');
                if (close_color == true) {
                    $('circle').css('fill', 'white');
                    $('text').css('fill', 'black');
                } else {
                    $('circle').css('fill', 'black');
                    $('text').css('fill', 'white');
                }
            });
            
            $('input[name="data[Templates][full_image]"]').on('switchChange.bootstrapSwitch', function (event, state) {
                var full_image = $(this).is(':checked');
                if (full_image == true) {
                    $('.img2:visible').css('width', '310px');
                } else {
                    $('.img2:visible').css('width', '280px');
                }
            });
            
            $('input[name="data[Templates][btn_seprator]"]').on('switchChange.bootstrapSwitch', function (event, state) {
                var btn_seprator = $(this).is(':checked');
                if (btn_seprator == true) {
                    $('#form_btn_seprator').css('display', 'block');
                    $('#radio_btn_seprator').css('display', 'block');
                    $('#btn_seprator').css('display', 'block');
                    $('#button1_container').css('height', '49px');
                    $('#button2_container').css('height', '49px');
                    $('#form_button1_container').css('height', '49px');
                    $('#form_button2_container').css('height', '49px');
                    $('#radio_button1_container').css('height', '49px');
                    $('#radio_button2_container').css('height', '49px');
                } else {
                    $('#form_btn_seprator').css('display', 'none');
                    $('#radio_btn_seprator').css('display', 'none');
                    $('#btn_seprator').css('display', 'none');
                    $('#button1_container').css('height', '50px');
                    $('#button2_container').css('height', '50px');
                    $('#form_button1_container').css('height', '50px');
                    $('#form_button2_container').css('height', '50px');
                    $('#radio_button1_container').css('height', '50px');
                    $('#radio_button2_container').css('height', '50px');
                }
            });
            
            $("#title").change(function(){
                var titleinput = $('#title').val();
                if(titleinput != '') {
                    $(".title").html(titleinput);
                    $(".form_title").html(titleinput);
                    $(".radio_title").html(titleinput);
                } else {
                    $(".form_title").html("Title Goes Here!");
                    $(".radio_title").html("Title Goes Here!");
                    $(".title").html("Title Goes Here!");
                }
            });
            $("#msg").change(function(){
                var msginput = $('#msg').val();
                if(msginput != '') {
                    $(".msg_text").html(msginput);
                } else {
                    $(".msg_text").html("Message Goes Here!");
                }
            });

            $("#option1").change(function () {
                var option1 = $('#option1').val();
                if (option1 != '') {
                    $(".option1_text").html(" "+option1);
                } else {
                    $(".option1_text").html(" option 1");
                }
            });

            $("#option2").change(function () {
                var option2 = $('#option2').val();
                if (option2 != '') {
                    $(".option2_text").html(" "+option2);
                } else {
                    $(".option2_text").html(" option 2");
                }
            });
            
            $("#button1_text").change(function(){
                var button1_text = $('#button1_text').val();
                if(button1_text != '') {
                    $("#form_button1_text").html(button1_text);
                    $("#radio_button1_text").html(button1_text);
                    $("#img_button1_text").html(button1_text);
                } else {
                    $("#form_button1_text").html("Button1");
                    $("#radio_button1_text").html("Button1");
                    $("#img_button1_text").html("Button1");
                }
            });
            
            $("#button2_text").change(function(){
                var button2_text = $('#button2_text').val();
                if(button2_text != '') {
                    $("#form_button2_text").html(button2_text);
                    $("#radio_button2_text").html(button2_text);
                    $("#img_button2_text").html(button2_text);
                } else {
                    $("#form_button2_text").html("Button2");
                    $("#radio_button2_text").html("Button2");
                    $("#img_button2_text").html("Button2");
                }
            });
            
//            $('input[name="data[Templates][imageorlink]"]').on("change", function () {
            $('input[name="data[Templates][imageorlink]"]').on('switchChange.bootstrapSwitch', function (event, state) {
                var imageorlink = $(this).is(':checked');
                if (imageorlink == true) {
                    $('.image').css('display', 'none');
                    $("#image").removeAttr('required');
                    $('.img_file').css('display', 'block');
                    $("#img_file").prop('required', true);
                } else {
                    $('.img_file').css('display', 'none');
                    $("#img_file").removeAttr('required');
                    $('.image').css('display', 'block');
                    $("#image").prop('required', true);
                }
            });
            
            $('input[name="data[Templates][img_top]"]').on('switchChange.bootstrapSwitch', function (event, state) {
                var img_top = $(this).is(':checked');
                if (img_top == true) {
                    $('#title_container').insertAfter($('#image_container'));
                } else {
                    $('#image_container').insertAfter($('#title_container'));
                }
            });
            
            $('input[name="data[Templates][singlebtn]"]').on('switchChange.bootstrapSwitch', function (e, data) {
                var singlebtn = $(this).is(':checked');
                if (singlebtn == true) {
                    $('#button2_container').css('display', 'none');
                    $('#button1_container').css('width', '310px');
                } else {
                    $('#button2_container').css('display', 'inline-block');
                    $('#button1_container').css('width', '152px');
                }
            });
            
            $("#image").change(function(){
                var image = $('#image').val();
                if(image != '') {
                    $('.img2').attr("src",image);
                } else {
                   $('.img2').attr("src",'http://www.annexofmarion.com/Common/images/jquery/galleria/image-not-found.png');
                }
            });
            
            
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    console.log(reader);
                    reader.onload = function (e) {
                        $('.img2').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('input[name="data[Templates][img_file]"]').change(function(){
                $(this).valid();
                readURL(this);
            });
            
            $('input[name="data[Templates][img_file]"]').each(function () {
                $(this).rules('add', {
                    extension: "png|jpg|gif|jpeg|bmp",
                    messages: {
                        extension: "This field can accept images only!"
                    }
                });
            });
        
        /* 
         *  End On Click Event Templates
         * 
        */
        
        /* 
         *  Start Templates Types
         * 
        */
        
        $('.temp_type').change(function () {
            var temp_type = $(this).val();
            $("#account").css('display', "none");
            $(".account").removeAttr('required');
            $("#application").css('display', "none");
            $(".application").removeAttr('required');
            if(temp_type == 1) {
                $('#account').css('display', 'block');
                $(".account").prop('required', true);
                $('#application').css('display', 'block');
                $(".application").prop('required', true);
            }
        });
        
        $('.uidesign').change(function () {
            
            var type = $(this).val();
            $(".forminput-container").css('display', "none");
            $(".radio-container").css('display', "none");
            $('#notification_container').css('display', 'none');
            $("#bgcolor").removeAttr('required');
            $('.bgcolor').css('display', 'none');
            $("#title_text_color").removeAttr('required');
            $('.title_text_color').css('display', 'none');
            $("#title_bgcolor").removeAttr('required');
            $('.title_bgcolor').css('display', 'none');
            $("#user_field").removeAttr('required');
            $('.user_field').css('display', 'none');
            $("#option1").removeAttr('required');
            $('.option1').css('display', 'none');
            $("#option2").removeAttr('required');
            $('.option2').css('display', 'none');
            $("#msgcolor").removeAttr('required');
            $('.msgcolor').css('display', 'none');
            $('.close_button_exist').css('display', 'none');
            $('.close_button_icon').css('display', 'none');
            $('.img_top').css('display', 'none');
            $('.full_image').css('display', 'none');
            $('.btn_seprator').css('display', 'none');
            $('.param1').css('display', 'none');
            $('.param2').css('display', 'none');
            $('.singlebtn').css('display', 'none');
            $('.imageorlink').css('display', 'none');
            $("#close_button_color").removeAttr('required');
            $('.close_button_color').css('display', 'none');
            $("#image").removeAttr('required');
            $('.image').css('display', 'none');
            $("#img_file").removeAttr('required');
            $('.img_file').css('display', 'none');
            $("#btnmargin").removeAttr('required');
            $('.btnmargin').css('display', 'none');
            $("#button1_text").removeAttr('required');
            $('.button1_text').css('display', 'none');
            $("#button1_color").removeAttr('required');
            $('.button1_color').css('display', 'none');
            $("#button1_text_color").removeAttr('required');
            $('.button1_text_color').css('display', 'none');
            $('.button2_text').css('display', 'none');
            $('.button2_color').css('display', 'none');
            $('.button2_text_color').css('display', 'none');
            $("#link1").removeAttr('required');
            $('.link').css('display', 'none');
            
            //Simple Templates
            if (type == 1) {
            }
            
            //Image Notification
            if (type == 2) {
                $("#bgcolor").prop('required', true);
                $('.bgcolor').css('display', 'block');
                $("#title_text_color").prop('required', true);
                $('.title_text_color').css('display', 'block');
                $("#title_bgcolor").prop('required', true);
                $('.title_bgcolor').css('display', 'block');
                $("#msgcolor").prop('required', true);
                $('.msgcolor').css('display', 'block');
                $('.close_button_exist').css('display', 'block');
                $('.close_button_icon').css('display', 'none');
                $('.close_button_color').css('display', 'none');
                $('.img_top').css('display', 'block');
                $('.full_image').css('display', 'block');
                $('.btn_seprator').css('display', 'block');
                $('.singlebtn').css('display', 'block');
                $("#image").prop('required', true);
                $('.image').css('display', 'block');
                $("#button1_text").removeAttr('required');
                $('.button1_text').css('display', 'block');
                $("#button1_color").removeAttr('required');
                $('.button1_color').css('display', 'block');
                $("#button1_text_color").removeAttr('required');
                $('.button1_text_color').css('display', 'block');
                $('.button2_text').css('display', 'block');
                $('.button2_color').css('display', 'block');
                $('.button2_text_color').css('display', 'block');
                $('.link').css('display', 'block');
                $('.param1').css('display', 'block');
                $('.param2').css('display', 'block');
                $('.imageorlink').css('display', 'block');
            }
            
            //Form with text input
            if (type == 3) {
                $(".forminput-container").css('display', 'block');
                $("#bgcolor").prop('required', true);
                $('.bgcolor').css('display', 'block');
                $("#title_text_color").prop('required', true);
                $('.title_text_color').css('display', 'block');
                $("#title_bgcolor").prop('required', true);
                $('.title_bgcolor').css('display', 'block');
                $("#user_field").prop('required', true);
                $('.user_field').css('display', 'block');
                $('.btn_seprator').css('display', 'block');
                $("#button1_text").prop('required', true);
                $('.button1_text').css('display', 'block');
                $("#button1_color").prop('required', true);
                $('.button1_color').css('display', 'block');
                $("#button1_text_color").prop('required', true);
                $('.button1_text_color').css('display', 'block');
                $('.button2_text').css('display', 'block');
                $('.button2_color').css('display', 'block');
                $('.button2_text_color').css('display', 'block');
            }
            
            //Form with radio buttons
            if (type == 4) {
                $(".radio-container").css('display', 'block');
                $("#bgcolor").prop('required', true);
                $('.bgcolor').css('display', 'block');
                $("#title_text_color").prop('required', true);
                $('.title_text_color').css('display', 'block');
                $("#title_bgcolor").prop('required', true);
                $('.title_bgcolor').css('display', 'block');
                $('.btn_seprator').css('display', 'block');
                $("#button1_text").prop('required', true);
                $('.button1_text').css('display', 'block');
                $("#button1_color").prop('required', true);
                $('.button1_color').css('display', 'block');
                $("#button1_text_color").prop('required', true);
                $('.button1_text_color').css('display', 'block');
                $('.button2_text').css('display', 'block');
                $('.button2_color').css('display', 'block');
                $('.button2_text_color').css('display', 'block');
                $("#user_field").prop('required', true);
                $('.user_field').css('display', 'block');
                $("#option1").prop('required', true);
                $('.option1').css('display', 'block');
                $("#option2").prop('required', true);
                $('.option2').css('display', 'block');
            }
            
            if (type == 5 || type == 6 || type == 7) {
                $('.bgcolor').css('display', 'block');
                $('.title_text_color').css('display', 'block');
                $('.title_bgcolor').css('display', 'block');
                $('.user_field').css('display', 'block');
                $('.option1').css('display', 'block');
                $('.option2').css('display', 'block');
                $('.msgcolor').css('display', 'block');
                $('.close_button_exist').css('display', 'block');
                $('.close_button_icon').css('display', 'block');
                $('.img_top').css('display', 'block');
                $('.full_image').css('display', 'block');
                $('.btn_seprator').css('display', 'block');
                $('.singlebtn').css('display', 'block');
                $('.param1').css('display', 'block');
                $('.param2').css('display', 'block');
                $('.close_button_color').css('display', 'block');
                $('.image').css('display', 'block');
                $('.button1_text').css('display', 'block');
                $('.button1_color').css('display', 'block');
                $('.button1_text_color').css('display', 'block');
                $('.button2_text').css('display', 'block');
                $('.button2_color').css('display', 'block');
                $('.button2_text_color').css('display', 'block');
                $('.link').css('display', 'block');
            }

            if (type != "") {
                
                if(type==2) {
                    $('#notification_container').css('display', 'block');
                    $('.overview-container').css('display', 'none');
                    $('.radio-container').css('display', 'none');
                    $('.noty-overview').css('display', 'none');
                } else if (type == 3) {
                    $('#notification_container').css('display', 'none');
                    $('.overview-container').css('display', 'none');
                    $('.radio-container').css('display', 'none');
                    $('.form-container').css('display', 'block');
                    $('.noty-overview').css('display', 'none');
                } else if (type == 4) {
                    $('#notification_container').css('display', 'none');
                    $('.overview-container').css('display', 'none');
                    $(".radio-container").css('display', "block");                    
                    $('.form-container').css('display', 'none');
                    $('.noty-overview').css('display', 'none');
                } else {
                    $('.overview-container').css('display', 'block');
                    $('.noty-overview').css('display', 'block');
                    $('#notification_container').css('display', 'none');
                    $('#radio-container').css('display', 'none');
                    $.ajax({
                        type: 'post',
                        url: '<?php echo URL_PATH; ?>Templates/get_overview',
                        data: {
                            'type': type
                        },
                        cache: true,
                        success: function (data) {
                            $('.overview-container').html(data);
                        }
                    });    
                }
                
            } else {

            }
            
        });
        
        
        /* 
         *  End Templates Types
         * 
        */
       
        /* 
         *  Start Templates switch change
         * 
        */
            $('.file').each(function () {
                $(this).rules('add', {
                    extension: "png|jpg|gif|jpeg|bmp",
                    messages: {
                        extension: "This field can accept images only!"
                    }
                });
            });
       
            $("#range").hide();
            $("#appid").show();
            $('.device').bind('click', function () {
                //alert($('#android:checked,#iphone:checked').length);
                if ($('#android:checked,#iphone:checked').length > 0) {
                    //$("#both").attr('checked',true);
                    $('#both').attr('disabled', 'disabled').removeAttr('checked');
                }
                if ($('#android:checked,#iphone:checked').length == 1) {
                    //$("#both").attr('checked',false);
                    $('#both').removeAttr('disabled');
                }

            });
            
            $("#both").click(function () {
                if (this.checked) {
                    $('.device').each(function () {
                        this.checked = true;
                    });
                } else {
                    $('.device').each(function () {
                        this.checked = false;
                    });
                }
            });
            
            $("#send_in").change(function () {
                var val = $(this).val();
                if (val == 1)
                {
                    $("#range").show();
                } else
                {
                    $("#range").hide();
                }
            });
            
            $(".send").click(function () {
                var send_val = $(this).val();
                if (send_val == 1)
                {
                    $("#appid").show();
                } else
                {
                    $("#appid").hide();
                }

            });
            
            $("#editor1").html($("#description").text());
            $("#notification_btn").click(function () {
                //alert(1);
                $("#description").text($("#editor1").html());
                $("#TemplatesAddForm").submit();
            });
            
            $("#clear_form").click(function () {
                $("#editor1").html('');
                $("#editor2").html('');
                $(".file").val(" ");
                var name = $(".file-name").attr("class");
            });
        
        /* 
         *  End Templates switch change
         * 
        */
        
        
        $.ajax({
            type: 'post',
            url: 'get_users',
            cache: true,
            success: function (data) {
                $('#user_field').html(data);
            }
        });
        
        
    });
</script>