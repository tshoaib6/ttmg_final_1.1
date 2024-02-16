<?= $this->include('./partials/main') ?>

    <head>
        
        <?= $title_meta ?>

        <?= $this->include('./partials/head-css') ?>

    </head>

    <body class="authentication-bg">

        <?php 

                $company_logo_settings = json_decode(get_option('companysettings'),1);
                $company_logo = base_url('uploads/').$company_logo_settings['companylogo'];
                $company_name = $company_logo_settings['companyname'];
                if(session()->has('branch_set'))
                {
                    $company_logo = base_url('uploads/users/').session()->branch_branchlogo;
                }


             ?>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <a href="/" class="mb-5 d-block auth-logo">
                                <img src="<?= $company_logo ?>" alt="" height="120" class="logo logo-dark">
                                <img src="<?= $company_logo ?>" alt="" height="120" class="logo logo-light">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                           <?php if(!isset($link_expired)){ ?>
                            <div class="card-body p-4"> 

                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Register Account</h5>
                                    <p class="text-muted">Please fill all the required Fields.</p>
                                </div> 
                               
                <form action="<?php echo base_url("referral-register");?>" method="post" class="custom-validation" id="registeruserform" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="row p-2 mt-4">

                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="formrow-email-input">First Name *</label>
                            <input type="text" name="firstname" class="form-control rform" required="" id="fname">
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="formrow-email-input">Last Name *</label>
                            <input type="text" name="lastname" class="form-control rform" required="" id="lname" >
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="formrow-email-input">Email *</label>
                            <input type="email" name="email" autocomplete="0" class="form-control" required="" id="email">
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="formrow-email-input">Password *</label>
                             <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="0" minlength="6" id="password" required="">
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="formrow-phone-input">Phone *</label>
                            <input type="text" name="phone" required="" class="form-control" id="phone">
                        </div>
                        <div class="col-sm-6 mb-3">
                        <label class="form-label" for="formrow-address-input">Address *</label>
                             <input type="text" name="address" required="" class="form-control"  id="address">
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="formrow-website-input">Website</label>
                             <input type="text" name="website" class="form-control"  id="website">
                        </div>

                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="formrow-website-input">Coverage Area</label>
                             <input type="text" name="coverage" class="form-control"  id="coverage">
                        </div>
                        <div class="col-sm-6 mb-3">
                            <label class="form-label" for="formrow-website-input">Linkedin Profile</label>
                             <input type="text" name="linkedin" class="form-control"  id="linkedin">
                        </div>
                        <input type="hidden" value="3" name="role">
                        <input type="hidden" value="<?=$vendor_id ?>" name="vendor[]">
                        <input type="hidden" value="<?=$referral_token ?>" name="referral_token">
                        <input type="hidden" value="<?=$referral_id ?>" name="referral_id">
                        <input type="hidden" value="<?=$ref_link ?>" name="ref_link">
                        <div class="mt-3 text-end">
                            <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Register</button>
                        </div>
                    </div>
                </form>
            
                            </div>

                        <?php }else{ ?>


                            <h4 class="text-center mt-2"><?=$link_expired ?></h4>


                        <?php } ?>
                        </div>
                        <div class="mt-5 text-center">
                            <p style="color: <?=session()->branch_branchnavtext ?>;">© <script>document.write(new Date().getFullYear())</script> <?=$company_name ?>.</p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>

        <?= $this->include('./partials/vendor-scripts') ?>
         <!-- parsleyjs -->
        <script src="<?=base_url('assets/libs/parsleyjs/parsley.min.js'); ?>"></script>
        <script>
       $(function () {

        $('.custom-validation').parsley();
        
        
        }); 
       </script>
        <!-- App js 
        <script src="assets/js/app.js"></script>-->

    </body>
</html>
