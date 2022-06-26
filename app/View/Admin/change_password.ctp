<?php
?>

<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="#"><b>Adx</b>Reports</a>
        </div>
        <h4><?php echo $this->Session->flash(); ?></h4>
        <div class="card-body">
            <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
            <?php echo $this->Form->create('Admin', array('url' => array('controller' => 'Admin', 'action' => 'ChangePassword/'.$id), 'class' => '', 'enctype' => 'multipart/form-data')); ?>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="data[Admin][password]" placeholder="Password" required="">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Change password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="<?php echo WEB_ROOT;?>Admin/login">cancel</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>



