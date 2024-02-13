<?= $this->include('partials/main') ?>

    <head>
        
        <?= $title_meta ?>

        <?= $this->include('partials/head-css') ?>

    </head>

    <body class="authentication-bg">

        <?php 

                $company_logo = base_url('assets/images/ttmg-logo-crm.png');
                $company_name = 'TTMG';
                if($session->has('branch_set'))
                {
                    $company_logo = base_url('uploads/users/').$session->branch_branchlogo;
                    $company_name = $session->branch_branchname;
                }


             ?>
        <div class="account-pages my-5  pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div>
                            
                            <a href="/" class="mb-5 d-block auth-logo">
                                <img src="<?= $company_logo ?>" alt="" height="120" class="logo logo-dark">
                                <img src="<?= $company_logo ?>" alt="" height="120" class="logo logo-light">
                            </a>
                            <div class="card">
                               
                                <div class="card-body p-4"> 
    
                                    <div class="text-center mt-2">
                                        <h5 class="text-primary">Reset Password</h5>
                                        <p class="text-muted">Reset Password with <?=$company_name ?>.</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <?php if($session->getFlashdata('error')){ ?>
                                        <div class="alert alert-danger rounded-0">
                                            <?= $session->getFlashdata('error') ?>
                                        </div>
                                    <?php }else if($session->getFlashdata('success')){ ?>
                                        <div class="alert alert-success rounded-0">
                                            <?= $session->getFlashdata('success') ?>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="alert alert-success text-center mb-4" role="alert">
                                            Enter your Email and instructions will be sent to you!
                                        </div>
                                    <?php } ?>
                                        <form action="<?= base_url('recover-password') ?>" method="POST">
            
                                            <div class="mb-3">
                                                <label class="form-label" for="useremail">Email</label>
                                                <input type="email" name="email" class="form-control" id="useremail" placeholder="Enter email">
                                            </div>
                                            
                                            <div class="mt-3 text-end">
                                                <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Reset</button>
                                            </div>
                
    
                                            <div class="mt-4 text-center">
                                                <p class="mb-0">Remember It ? <a href="<?=base_url() ?>" class="fw-medium text-primary"> Signin </a></p>
                                            </div>
                                        </form>
                                    </div>
                
                                </div>
                            </div>
                            <div class="mt-5 text-center">
                                <p>© <script>document.write(new Date().getFullYear())</script> TTMG.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

        <?= $this->include('partials/vendor-scripts') ?>

        <!-- App js 
        <script src="assets/js/app.js"></script>-->

    </body>
</html>
