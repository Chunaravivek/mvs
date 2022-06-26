<?php
if (isset($this->request->query['returnURL'])) {
    $returnURL = 'login?returnURL=' . $this->request->query['returnURL'];
} else {
    $returnURL = '';
}
?>
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="row flexbox-container">
                 
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <h4><?php echo $this->Session->flash(); ?></h4>
                            <div class="card-header border-0">
                                <div class="card-title text-center">
                                    <img src="<?php echo $logo; ?>" alt="branding logo">
                                </div>
                            </div>
                            <div class="card-content">
                                <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                    <span><?php echo $description; ?></span>
                                </p>
                                <div class="card-body">
                                    <?php echo $this->Form->create('Admin', array('url' => array('controller' => 'Admin', 'action' => 'login'.isset($returnURL) ? $returnURL: ''), 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')); ?>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" id="email" placeholder="Your Email" name="data[Admin][email]" required="" aria-invalid="false">
                                            <div class="form-control-position">
                                                <i class="la la-user"></i>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="form-control" id="user-password" placeholder="Enter Password" name="data[Admin][password]" required="">
                                            <div class="form-control-position">
                                                <i class="la la-key"></i>
                                            </div>
                                        </fieldset>
                                        <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Login</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>