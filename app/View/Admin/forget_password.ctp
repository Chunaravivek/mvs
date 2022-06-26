<?php ?>
<style>
    .login-box.publisher_login {
        margin: 0px auto;
    }
</style>
<div class="login-box" style="min-height: 320px;">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#"><b>Play</b>Scraper</a>
            </div>
            <h4><?php echo $this->Session->flash(); ?></h4>
            <div class="card-body">
                <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
                <?php echo $this->Form->create('Admin', array('url' => array('controller' => 'Admin', 'action' => 'ForgetPassword'), 'class' => '', 'enctype' => 'multipart/form-data')); ?>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="data[Admin][email]" placeholder="Email" required="">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="<?php echo WEB_ROOT;?>Admin/login">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
</div>



