<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-1">
        <h2 class="content-header-title"><?php echo $this->request->params['controller']; ?></h2>
    </div>
    <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-12">
        <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo URL_PATH; ?>Dashboard">Home</a>
                </li>
                <?php 
                 if ($this->request->params['controller'] && $this->request->params['action'] == 'add' || $this->request->params['action'] == 'edit') {
                ?>
                    <li class="breadcrumb-item <?php if ($this->request->params['controller']) { echo 'active'; } ?>">
                        <a href="<?php echo URL_PATH.$this->request->params['controller']; ?><?php echo $this->request->params['controller']; ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item <?php if ($this->request->params['controller']) { echo 'active'; } ?>">
                        <?php echo $this->request->params['controller'] . ' ' . $this->request->params['action']; ?>
                    </li>
                <?php 
                } else {
                ?>
                    <li class="breadcrumb-item <?php if ($this->request->params['controller']) { echo 'active'; } ?>">
                        <?php echo $this->request->params['controller']; ?>
                    </li>
                <?php 
                }
                ?>
            </ol>
        </div>
    </div>
</div>