<?php $this->Form->create() ?>
<div class="container-fluid py-5 body-bg d-flex h100 ">
    <div class="row align-self-center w100">
        <div class="col-md-12 ">
            <h2 class="text-center text-white mb-4">Please Sign in</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">

                    <!-- form card login -->
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h3 class="mb-0">Login</h3>
                        </div>
                        <div class="card-body">
                            <?= $this->Flash->render(); ?>
                            <form class="form" role="form" autocomplete="off" id="formLogin" novalidate="" method="POST">
                                <div class="form-group">
                                    <?= $this->Form->control('email', [
                                        'class' => 'form-control form-control-lg rounded-0',
                                        'type' => 'email'
                                    ]) ?>
                                    <div class="invalid-feedback">Oops, you missed this one.</div>
                                </div>
                                <div class="form-group">
                                    <?= $this->Form->control('password', [
                                        'class' => 'form-control form-control-lg rounded-0',
                                        'type' => 'password'
                                    ]) ?>
                                    <div class="invalid-feedback">Enter your password too!</div>
                                </div>

                                <?= $this->Form->button(__('Login'), ['class' => 'btn btn-success btn-lg float-right']) ?>
                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->

                </div>


            </div>
            <!--/row-->

        </div>
        <!--/col-->
    </div>
    <!--/row-->
</div>
<!--/container-->
<?= $this->Form->end() ?>
